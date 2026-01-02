#!/bin/bash
set -e
DIR="/home/indra/Project/web sekolah"
CONTAINER="web-sekolah-app"

echo "Copying GalleryResource to container..."
docker cp "$DIR/app/Filament/Resources/GalleryResource.php" $CONTAINER:/tmp/

echo "Overwriting generated Resource..."
docker exec $CONTAINER sh -c "
    mv /tmp/GalleryResource.php app/Filament/Resources/
    chmod 644 app/Filament/Resources/GalleryResource.php
"

echo "Done!"
