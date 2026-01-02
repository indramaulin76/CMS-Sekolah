#!/bin/bash
set -e
DIR="/home/indra/Project/web sekolah"
CONTAINER="web-sekolah-app"

echo "Copying files to container..."
# Files to be updated in container
docker cp "$DIR/database/migrations/2026_01_01_170506_create_pages_table.php" $CONTAINER:/tmp/
docker cp "$DIR/database/migrations/2026_01_01_170658_create_staff_table.php" $CONTAINER:/tmp/
docker cp "$DIR/app/Models/Staff.php" $CONTAINER:/tmp/
docker cp "$DIR/app/Models/Page.php" $CONTAINER:/tmp/
docker cp "$DIR/database/seeders/PageSeeder.php" $CONTAINER:/tmp/
docker cp "$DIR/app/Filament/Resources/StaffResource.php" $CONTAINER:/tmp/
docker cp "$DIR/app/Filament/Resources/PageResource.php" $CONTAINER:/tmp/

echo "Moving files inside container..."
docker exec $CONTAINER sh -c "
    mv /tmp/2026_01_01_170506_create_pages_table.php database/migrations/ && \
    mv /tmp/2026_01_01_170658_create_staff_table.php database/migrations/ && \
    mv /tmp/Staff.php app/Models/ && \
    mv /tmp/Page.php app/Models/ && \
    mv /tmp/PageSeeder.php database/seeders/ && \
    mv /tmp/StaffResource.php app/Filament/Resources/ && \
    mv /tmp/PageResource.php app/Filament/Resources/ && \
    chmod 644 database/migrations/*.php app/Models/*.php database/seeders/*.php app/Filament/Resources/*.php && \
    chown -R www-data:www-data storage bootstrap/cache
"

echo "Running migrate:fresh..."
docker exec $CONTAINER php artisan migrate:fresh --seed --force

echo "Running PageSeeder..."
docker exec $CONTAINER php artisan db:seed --class=PageSeeder --force

echo "Done!"
