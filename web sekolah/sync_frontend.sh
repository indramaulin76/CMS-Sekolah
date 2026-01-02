#!/bin/bash
set -e
DIR="/home/indra/Project/web sekolah"
CONTAINER="web-sekolah-app"

echo "Copying Frontend files to container..."
docker cp "$DIR/app/Http/Controllers/GalleryController.php" $CONTAINER:/tmp/
docker cp "$DIR/app/Http/Controllers/PageController.php" $CONTAINER:/tmp/
docker cp "$DIR/routes/web.php" $CONTAINER:/tmp/

echo "Moving files inside container..."
docker exec $CONTAINER sh -c "
    mv /tmp/GalleryController.php app/Http/Controllers/ && \
    mv /tmp/PageController.php app/Http/Controllers/ && \
    mv /tmp/web.php routes/ && \
    chmod 644 app/Http/Controllers/GalleryController.php app/Http/Controllers/PageController.php routes/web.php
"

echo "Clearing route cache..."
docker exec $CONTAINER php artisan route:clear
docker exec $CONTAINER php artisan view:clear

echo "Done!"
