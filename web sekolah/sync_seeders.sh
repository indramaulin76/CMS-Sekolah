#!/bin/bash
set -e
DIR="/home/indra/Project/web sekolah"
CONTAINER="web-sekolah-app"

echo "Copying Seeders to container..."
docker cp "$DIR/database/seeders/StaffSeeder.php" $CONTAINER:/tmp/
docker cp "$DIR/database/seeders/GallerySeeder.php" $CONTAINER:/tmp/
docker cp "$DIR/database/seeders/DatabaseSeeder.php" $CONTAINER:/tmp/

echo "Moving files inside container..."
docker exec $CONTAINER sh -c "
    mv /tmp/StaffSeeder.php database/seeders/ && \
    mv /tmp/GallerySeeder.php database/seeders/ && \
    mv /tmp/DatabaseSeeder.php database/seeders/ && \
    chmod 644 database/seeders/*.php
"

echo "Running DB Seed..."
# Using --class to run specific seeders just to be safe and avoid duplicates if re-running full seed
docker exec $CONTAINER php artisan db:seed --class=StaffSeeder
docker exec $CONTAINER php artisan db:seed --class=GallerySeeder

echo "Done!"
