set -e
echo "Deploying the application..."

cp .env.example .env
echo "Create .env"

echo -e "\nAPP_OWNER=$APP_OWNER\n" >> .env
echo -e "\nMAIL_ENCRYPTION=$MAIL_ENCRYPTION\n" >> .env
echo "Add variable to .env"

sed -i "s/^APP_NAME=.*/APP_NAME=$APP_NAME/" .env
sed -i "s/^DB_CONNECTION=.*/DB_CONNECTION=$DB_CONNECTION/" .env
sed -i "s/^MAIL_MAILER=.*/MAIL_MAILER=$MAIL_MAILER/" .env
sed -i "s/^MAIL_HOST=.*/MAIL_HOST=$MAIL_HOST/" .env
sed -i "s/^MAIL_PORT=.*/MAIL_PORT=$MAIL_PORT/" .env
sed -i "s/^MAIL_USERNAME=.*/MAIL_USERNAME=$MAIL_USERNAME/" .env
sed -i "s/^MAIL_PASSWORD=.*/MAIL_PASSWORD=$MAIL_PASSWORD/" .env
sed -i "s/^MAIL_FROM_ADDRESS=.*/MAIL_FROM_ADDRESS=$MAIL_FROM_ADDRESS/" .env
sed -i "s/^MAIL_FROM_NAME=.*/MAIL_FROM_NAME=$MAIL_FROM_NAME/" .env
sed -i "s/^# DB_HOST=/DB_HOST=/" .env
sed -i "s/^# DB_PORT=/DB_PORT=/" .env
sed -i "s/^# DB_DATABASE=/DB_DATABASE=/" .env
sed -i "s/^# DB_USERNAME=/DB_USERNAME=/" .env
sed -i "s/^# DB_PASSWORD=/DB_PASSWORD=$DB_PASSWORD/" .env
echo "Update variable to .env"

export NVM_DIR="$HOME/.nvm"
[ -s "$NVM_DIR/nvm.sh" ] && \. "$NVM_DIR/nvm.sh"
node -v
echo "Verify Node Version"

CURRENT_HASH=$(md5sum package-lock.json | cut -d' ' -f1)

if [ -f ".package-lock.hash" ] && [ "$(cat .package-lock.hash)" = "$CURRENT_HASH" ] && [ -d "node_modules" ]; then
  echo "package-lock.json unchanged and node_modules exists. Skipping npm ci."
else
  echo "Changes detected or cache missing. Running npm ci..."
  
  # Install exact dependencies
  npm ci
  
  # Save the new hash for the next CI/CD run
  echo "$CURRENT_HASH" > .package-lock.hash
fi
echo "Install node dependencies"

npm run build
echo "Build assets"

php artisan down
echo "Putting the application into maintenance mode..."

php artisan migrate --force
echo "Running database migrations..."

php artisan queue:restart
echo "Queue workers restarted..."

pkill -f "php artisan queue:work" || true
echo "Kill other worker before start a new..."

php artisan livewire:publish --assets
echo "Publish livewire assets"

sudo chown -R $USER:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
echo "Directory permissions"

php artisan optimize:clear
echo "Clearing caches..."

php artisan config:cache
echo "Caching configuration..."

composer install --ignore-platform-reqs --no-interaction
echo "Install dependencies"

php artisan key:generate
echo "Generate application key"

php artisan up
echo "Bringing the application back up..."

nohup php artisan queue:work > /dev/null 2>&1 &
echo "Run the queue worker..."

echo "Deployment completed successfully!"