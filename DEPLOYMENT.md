# Deployment Guide - CMS Sekolah

## Quick Start Production Deployment

### Prasyarat
- Server dengan Docker & Docker Compose installed
- Domain sudah pointing ke server
- Reverse proxy (Cloudflare Tunnel / nginx-proxy) atau SSL certificate

### Langkah Deploy

#### 1. Clone Repository
```bash
git clone https://github.com/indramaulin76/CMS-Sekolah.git
cd CMS-Sekolah
```

#### 2. Setup Environment
```bash
# Copy template environment
cp .env.production.example .env

# Edit dan sesuaikan konfigurasi
nano .env
```

**Yang WAJIB diubah:**
- `APP_URL` → domain Anda
- `DB_PASSWORD` → password database yang kuat
- `DB_ROOT_PASSWORD` → password root MySQL yang kuat

#### 3. Pilih Nginx Config

**Jika pakai Reverse Proxy (Cloudflare/nginx-proxy):**
```bash
# Gunakan production config (HTTPS enabled)
cp docker/nginx/default.production.conf docker/nginx/default.conf
```

**Jika tidak pakai reverse proxy:**
```bash
# Tetap gunakan yang sekarang (HTTPS disabled)
# Anda perlu setup SSL sendiri
```

#### 4. Jalankan Deployment Script
```bash
./deploy.sh
```

Script akan otomatis:
- Build Docker images
- Start containers
- Generate APP_KEY (jika belum)
- Run migrations
- Link storage
- Optimize application

#### 5. Verifikasi
```bash
# Cek container running
docker ps

# Cek logs jika ada error
docker logs cms-sekolah-app
docker logs cms-sekolah-nginx
```

#### 6. Akses Website
Buka browser: `https://smatunasharapan.sch.id`

Admin panel: `https://smatunasharapan.sch.id/admin`

---

## Setup dengan Cloudflare Tunnel (Recommended)

### Kelebihan
- ✅ Gratis
- ✅ Auto HTTPS
- ✅ DDoS protection  
- ✅ Tidak perlu port forwarding
- ✅ Tidak perlu kelola SSL certificate

### Steps

1. **Install Cloudflare Tunnel**
```bash
# Download cloudflared
wget https://github.com/cloudflare/cloudflared/releases/latest/download/cloudflared-linux-amd64
chmod +x cloudflared-linux-amd64
sudo mv cloudflared-linux-amd64 /usr/local/bin/cloudflared
```

2. **Login Cloudflare**
```bash
cloudflared tunnel login
```

3. **Create Tunnel**
```bash
cloudflared tunnel create sma-tunnel
```

4. **Configure Tunnel**
Buat file `~/.cloudflared/config.yml`:
```yaml
tunnel: <tunnel-id>
credentials-file: /root/.cloudflared/<tunnel-id>.json

ingress:
  - hostname: smatunasharapan.sch.id
    service: http://localhost:8080
  - service: http_status:404
```

5. **Route DNS**
```bash
cloudflared tunnel route dns sma-tunnel smatunasharapan.sch.id
```

6. **Run Tunnel**
```bash
cloudflared tunnel run sma-tunnel
```

7. **Run as Service** (optional)
```bash
sudo cloudflared service install
sudo systemctl start cloudflared
sudo systemctl enable cloudflared
```

8. **Gunakan Production Nginx Config**
```bash
cp docker/nginx/default.production.conf docker/nginx/default.conf
docker compose -f docker-compose.production.yml restart nginx
```

---

## Maintenance Commands

### Backup Database
```bash
docker exec cms-sekolah-db mysqldump -uroot -p${DB_ROOT_PASSWORD} cms_sekolah > backup-$(date +%Y%m%d).sql
```

### Restore Database
```bash
docker exec -i cms-sekolah-db mysql -uroot -p${DB_ROOT_PASSWORD} cms_sekolah < backup.sql
```

### Update Application
```bash
git pull origin main
docker compose -f docker-compose.production.yml down
docker compose -f docker-compose.production.yml up -d --build
docker exec cms-sekolah-app php artisan migrate --force
docker exec cms-sekolah-app php artisan optimize
```

### View Logs
```bash
# Application logs
docker logs -f cms-sekolah-app

# Nginx logs
docker logs -f cms-sekolah-nginx

# Database logs
docker logs -f cms-sekolah-db
```

### Clear Cache
```bash
docker exec cms-sekolah-app php artisan cache:clear
docker exec cms-sekolah-app php artisan config:clear
docker exec cms-sekolah-app php artisan view:clear
docker exec cms-sekolah-app php artisan optimize
```

---

## Troubleshooting

### Website tidak bisa diakses
1. Cek container running: `docker ps`
2. Cek logs: `docker logs cms-sekolah-app`
3. Cek network: `docker network ls`

### Error 500
1. Cek `.env` sudah benar
2. Cek `APP_KEY` sudah ter-generate
3. Cek permissions storage: `docker exec cms-sekolah-app chmod -R 775 storage bootstrap/cache`

### CSS/JS tidak load
1. Run: `docker exec cms-sekolah-app npm run build`
2. Clear cache: `docker exec cms-sekolah-app php artisan optimize:clear`

### Database connection error
1. Cek `DB_HOST=mysql` di `.env`
2. Cek password benar
3. Tunggu beberapa detik untuk database ready
