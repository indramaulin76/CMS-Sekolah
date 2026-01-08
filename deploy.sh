#!/bin/bash

# Deployment Script untuk CMS Sekolah
# Usage: ./deploy.sh

set -e

echo "🚀 Starting deployment..."

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Check if .env exists
if [ ! -f .env ]; then
    echo -e "${RED}ERROR: .env file not found!${NC}"
    echo "Copy .env.production.example to .env and configure it first:"
    echo "  cp .env.production.example .env"
    echo "  nano .env"
    exit 1
fi

# Check if APP_KEY is set
if ! grep -q "APP_KEY=base64:" .env; then
    echo -e "${YELLOW}WARNING: APP_KEY not set. Generating...${NC}"
    docker compose -f docker-compose.production.yml run --rm app php artisan key:generate
fi

echo "📦 Building Docker images..."
docker compose -f docker-compose.production.yml build

echo "🔄 Stopping old containers..."
docker compose -f docker-compose.production.yml down

echo "🚀 Starting containers..."
docker compose -f docker-compose.production.yml up -d

echo "⏳ Waiting for containers to be ready..."
sleep 10

echo "📦 Installing Composer dependencies..."
docker exec cms-sekolah-app composer install --optimize-autoloader --no-dev

echo "🔑 Generating APP_KEY if not set..."
docker exec cms-sekolah-app php artisan key:generate --force

echo "⏳ Waiting for database to be ready..."
sleep 5

echo "🗄️  Running migrations..."
docker exec cms-sekolah-app php artisan migrate --force

echo "🔗 Creating storage symlink..."
docker exec cms-sekolah-app php artisan storage:link

echo "🧹 Optimizing application..."
docker exec cms-sekolah-app php artisan optimize
docker exec cms-sekolah-app php artisan filament:optimize

echo "📝 Publishing Livewire assets..."
docker exec cms-sekolah-app php artisan livewire:publish --assets

echo "✅ Deployment completed!"
echo ""
echo "📊 Container status:"
docker compose -f docker-compose.production.yml ps
echo ""
echo -e "${GREEN}🎉 Application is now running!${NC}"
echo "Visit: https://smatunasharapan.sch.id"
echo ""
echo "Useful commands:"
echo "  View logs: docker logs -f cms-sekolah-app"
echo "  Stop: docker compose -f docker-compose.production.yml down"
echo "  Restart: docker compose -f docker-compose.production.yml restart"
