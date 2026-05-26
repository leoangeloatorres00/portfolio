set -e
echo "Deploying the application..."

php artisan down
echo "Putting the application into maintenance mode..."

git pull origin main
echo "Pulling the latest changes from the main branch..."

php artisan migrate --force
echo "Running database migrations..."

php artisan queue:restart
echo "Queue workers restarted..."

sleep 5
echo "Give enough time for worker to finish their current job..."

pkill -f "php artisan queue:work"
echo "Kill other worker before start a new..."

nohup php artisan queue:work > /dev/null 2>&1 &
echo "Run the queue worker..."

php artisan up
echo "Bringing the application back up..."

chmod -R 775 storage bootstrap/cache
echo "Setting permissions..."

php artisan optimize:clear
echo "Clearing caches..."

php artisan config:cache
echo "Caching configuration..."

echo "Deployment completed successfully!"