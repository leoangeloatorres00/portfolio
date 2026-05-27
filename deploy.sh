set -e
echo "Deploying the application..."

cp .env.example .env
echo "Create .env"

composer install --ignore-platform-reqs -q --no-ansi --no-interaction --no-scripts --no-progress
echo "Install dependencies"

php artisan key:generate
echo "Generate application key"

echo -e "\nAPP_OWNER=$APP_OWNER\n" >> .env
echo "Add variable to .env"

sed -i "s/^APP_NAME=.*/APP_NAME=$APP_NAME/" .env
sed -i "s/^DB_CONNECTION=.*/DB_CONNECTION=$DB_CONNECTION/" .env
sed -i "s/^MAIL_MAILER=.*/MAIL_MAILER=$MAIL_MAILER/" .env
sed -i "s/^MAIL_HOST=.*/MAIL_HOST=$MAIL_HOST/" .env
sed -i "s/^MAIL_PORT=.*/MAIL_PORT=$MAIL_PORT/" .env
sed -i "s/^MAIL_USERNAME=.*/MAIL_USERNAME=$MAIL_USERNAME/" .env
sed -i "s/^MAIL_PASSWORD=.*/MAIL_PASSWORD=$MAIL_PASSWORD/" .env
sed -i "s/^MAIL_FROM_ADDRESS=.*/MAIL_FROM_ADDRESS=$MAIL_FROM_ADDRESS/" .env
sed -i "s/^MAIL_ENCRYPTION=.*/MAIL_ENCRYPTION=$MAIL_ENCRYPTION/" .env
sed -i "s/^MAIL_FROM_NAME=.*/MAIL_FROM_NAME=$MAIL_FROM_NAME/" .env
sed -i "s/^# DB_HOST=/DB_HOST=/" .env
sed -i "s/^# DB_PORT=/DB_PORT=/" .env
sed -i "s/^# DB_DATABASE=/DB_DATABASE=/" .env
sed -i "s/^# DB_USERNAME=/DB_USERNAME=/" .env
sed -i "s/^# DB_PASSWORD=/DB_PASSWORD=/" .env
echo "Update variable to .env"

php artisan down
echo "Putting the application into maintenance mode..."

php artisan migrate --force
echo "Running database migrations..."

php artisan queue:restart
echo "Queue workers restarted..."

pkill -f "php artisan queue:work" || true
echo "Kill other worker before start a new..."

nohup php artisan queue:work > /dev/null 2>&1 &
echo "Run the queue worker..."

php artisan up
echo "Bringing the application back up..."

php artisan livewire:publish --assets
echo "Publish livewire assets"

php artisan optimize:clear
echo "Clearing caches..."

php artisan config:cache
echo "Caching configuration..."

echo "Deployment completed successfully!"