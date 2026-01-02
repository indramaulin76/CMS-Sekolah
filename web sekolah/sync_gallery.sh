#!/bin/bash
set -e
DIR="/home/indra/Project/web sekolah"
CONTAINER="web-sekolah-app"

echo "Copying Gallery files to container..."
docker cp "$DIR/app/Models/Gallery.php" $CONTAINER:/tmp/
docker cp "$DIR/app/Models/GalleryImage.php" $CONTAINER:/tmp/
docker cp "$DIR/database/migrations/2026_01_01_180000_create_galleries_table.php" $CONTAINER:/tmp/
docker cp "$DIR/database/migrations/2026_01_01_180001_create_gallery_images_table.php" $CONTAINER:/tmp/

echo "Moving files inside container..."
docker exec $CONTAINER sh -c "
    mv /tmp/Gallery.php app/Models/ && \
    mv /tmp/GalleryImage.php app/Models/ && \
    mv /tmp/2026_01_01_180000_create_galleries_table.php database/migrations/ && \
    mv /tmp/2026_01_01_180001_create_gallery_images_table.php database/migrations/ && \
    chmod 644 app/Models/Gallery.php app/Models/GalleryImage.php database/migrations/*.php && \
    chown -R www-data:www-data storage bootstrap/cache
"

echo "Running migrate..."
docker exec $CONTAINER php artisan migrate --force

echo "Done!"
