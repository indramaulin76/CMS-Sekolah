#!/bin/bash
set -e
DIR="/home/indra/Project/web sekolah"
CONTAINER="web-sekolah-app"

echo "=== START DEBUG ==="
echo "Host file size:"
ls -l "$DIR/database/migrations/2026_01_01_170506_create_pages_table.php"

echo "Copying to container /tmp..."
docker cp "$DIR/database/migrations/2026_01_01_170506_create_pages_table.php" $CONTAINER:/tmp/page_mig.php

echo "Container /tmp file size:"
docker exec $CONTAINER ls -l /tmp/page_mig.php

echo "Moving to destination..."
docker exec $CONTAINER sh -c "
    echo 'Before overwrite:'
    ls -l database/migrations/2026_01_01_170506_create_pages_table.php
    
    mv -f /tmp/page_mig.php database/migrations/2026_01_01_170506_create_pages_table.php
    
    echo 'After overwrite:'
    ls -l database/migrations/2026_01_01_170506_create_pages_table.php
    
    echo 'Content check (first 20 lines):'
    head -n 20 database/migrations/2026_01_01_170506_create_pages_table.php
"

echo "Clearing caches..."
docker exec $CONTAINER php artisan optimize:clear

echo "Refreshing migration for specific file..."
docker exec $CONTAINER php artisan migrate:refresh --path=database/migrations/2026_01_01_170506_create_pages_table.php

echo "Verifying DB Schema..."
docker exec master-db mariadb -uroot -proot cms_sekolah -e "DESCRIBE pages;"

echo "Running PageSeeder..."
docker exec $CONTAINER php artisan db:seed --class=PageSeeder

echo "=== FINISHED ==="
