# 📦 Panduan Deploy CMS Sekolah dengan Docker + Cloudflare Tunnel

## Persyaratan Server

- **OS:** Ubuntu 22.04 LTS / Debian 12 (recommended)
- **RAM:** Minimal 2GB
- **Docker:** v24.0+
- **Docker Compose:** v2.0+
- **Cloudflare Account** dengan akses ke domain

---

## 🚀 Langkah-langkah Deploy

### 1. Persiapan Server

```bash
# Update sistem
sudo apt update && sudo apt upgrade -y

# Install Docker
curl -fsSL https://get.docker.com | sh
sudo usermod -aG docker $USER

# Install Docker Compose
sudo apt install docker-compose-plugin -y

# Logout dan login kembali agar group docker aktif
exit
```

---

### 2. Clone Repository

```bash
# Clone project
cd /opt
sudo git clone https://github.com/username/CMS-Sekolah.git
cd CMS-Sekolah

# Set ownership
sudo chown -R $USER:$USER .
```

---

### 3. Konfigurasi Environment

```bash
# Copy template environment
cp env.production.example .env

# Generate APP_KEY
docker compose -f docker-compose.production.yml run --rm app php artisan key:generate --show
# Copy output key ke .env

# Edit .env dengan nano/vim
nano .env
```

**Yang WAJIB diubah di `.env`:**

| Variable | Keterangan |
|----------|------------|
| `APP_KEY` | Generate dengan command di atas |
| `APP_URL` | URL lengkap dengan https, contoh: `https://sekolah.example.com` |
| `DB_PASSWORD` | Password database yang kuat (min 16 karakter) |
| `DB_ROOT_PASSWORD` | Password root MySQL yang kuat |
| `RECAPTCHA_SITE_KEY` | Dari Google reCAPTCHA Admin |
| `RECAPTCHA_SECRET_KEY` | Dari Google reCAPTCHA Admin |

---

### 4. Build dan Jalankan Container

```bash
# Build image
docker compose -f docker-compose.production.yml build

# Jalankan container
docker compose -f docker-compose.production.yml up -d

# Cek status container
docker compose -f docker-compose.production.yml ps
```

---

### 5. Setup Database dan Laravel

```bash
# Masuk ke container app
docker compose -f docker-compose.production.yml exec app sh

# Di dalam container, jalankan:
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan db:seed --force  # Jika ada seeder
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan filament:optimize

# Build assets (jika belum di-build)
npm ci
npm run build

# Keluar dari container
exit
```

---

### 6. Set Permissions

```bash
# Di luar container
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

---

## ☁️ Setup Cloudflare Tunnel

### 1. Install Cloudflared di Server

```bash
# Download cloudflared
curl -L --output cloudflared.deb https://github.com/cloudflare/cloudflared/releases/latest/download/cloudflared-linux-amd64.deb
sudo dpkg -i cloudflared.deb
```

### 2. Autentikasi Cloudflare

```bash
cloudflared tunnel login
# Browser akan terbuka, pilih domain yang akan digunakan
```

### 3. Buat Tunnel

```bash
# Buat tunnel baru
cloudflared tunnel create cms-sekolah

# Catat Tunnel ID yang muncul
```

### 4. Konfigurasi Tunnel

Buat file `/etc/cloudflared/config.yml`:

```yaml
tunnel: <TUNNEL_ID>
credentials-file: /root/.cloudflared/<TUNNEL_ID>.json

ingress:
  - hostname: sekolah.example.com
    service: http://localhost:8080
    originRequest:
      noTLSVerify: true
  - service: http_status:404
```

### 5. Setup DNS

```bash
# Tambahkan DNS record otomatis
cloudflared tunnel route dns cms-sekolah sekolah.example.com
```

### 6. Jalankan sebagai Service

```bash
# Install sebagai system service
sudo cloudflared --config /etc/cloudflared/config.yml service install

# Start service
sudo systemctl start cloudflared
sudo systemctl enable cloudflared

# Cek status
sudo systemctl status cloudflared
```

---

## ✅ Verifikasi Deployment

### 1. Cek Semua Container Berjalan

```bash
docker compose -f docker-compose.production.yml ps
# Semua container harus STATUS: Up
```

### 2. Cek Log Error

```bash
# Log aplikasi
docker compose -f docker-compose.production.yml logs app

# Log nginx
docker compose -f docker-compose.production.yml logs nginx
```

### 3. Test Akses Website

- Buka `https://sekolah.example.com` → Harus tampil homepage
- Buka `https://sekolah.example.com/admin` → Harus tampil login Filament
- Buka `https://sekolah.example.com/ppdb` → Harus tampil form PPDB

### 4. Test HTTPS

```bash
curl -I https://sekolah.example.com
# Harus return HTTP/2 200
# Harus ada header security (X-Frame-Options, etc.)
```

---

## 🔧 Troubleshooting

### Error: Mixed Content (HTTP/HTTPS)

**Penyebab:** Laravel tidak mendeteksi HTTPS dari Cloudflare.

**Solusi:** Pastikan `bootstrap/app.php` sudah dikonfigurasi trusted proxy:

```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->trustProxies(at: '*', headers: ...);
})
```

### Error: 502 Bad Gateway

**Penyebab:** PHP-FPM container tidak jalan atau nginx tidak bisa connect.

**Solusi:**
```bash
# Restart containers
docker compose -f docker-compose.production.yml restart

# Cek log
docker compose -f docker-compose.production.yml logs app
```

### Error: Storage Link Tidak Berfungsi

**Penyebab:** Symlink tidak terbuat dengan benar.

**Solusi:**
```bash
docker compose -f docker-compose.production.yml exec app php artisan storage:link
```

### Error: CSRF Token Mismatch

**Penyebab:** Session tidak persist atau cookie domain salah.

**Solusi:** Pastikan di `.env`:
```
SESSION_DRIVER=database
SESSION_SECURE_COOKIE=true
```

---

## 📋 Maintenance Commands

### Update Aplikasi

```bash
cd /opt/CMS-Sekolah

# Pull update terbaru
git pull origin main

# Rebuild jika ada perubahan Dockerfile
docker compose -f docker-compose.production.yml build

# Restart containers
docker compose -f docker-compose.production.yml up -d

# Jalankan migration jika ada
docker compose -f docker-compose.production.yml exec app php artisan migrate --force

# Clear cache
docker compose -f docker-compose.production.yml exec app php artisan optimize:clear
docker compose -f docker-compose.production.yml exec app php artisan optimize
```

### Backup Database

```bash
# Backup
docker compose -f docker-compose.production.yml exec mysql mysqldump -u root -p cms_sekolah > backup_$(date +%Y%m%d).sql

# Restore
docker compose -f docker-compose.production.yml exec -T mysql mysql -u root -p cms_sekolah < backup.sql
```

### View Logs

```bash
# Semua logs
docker compose -f docker-compose.production.yml logs -f

# Log spesifik
docker compose -f docker-compose.production.yml logs -f app
docker compose -f docker-compose.production.yml logs -f nginx
docker compose -f docker-compose.production.yml logs -f mysql
```

### Stop/Start Services

```bash
# Stop semua
docker compose -f docker-compose.production.yml down

# Start semua
docker compose -f docker-compose.production.yml up -d

# Restart spesifik
docker compose -f docker-compose.production.yml restart app
```

---

## 🔒 Security Checklist

- [ ] `APP_DEBUG=false`
- [ ] `APP_ENV=production`
- [ ] `APP_KEY` sudah di-generate
- [ ] `DB_PASSWORD` menggunakan password kuat (16+ karakter)
- [ ] `RECAPTCHA_SITE_KEY` dan `RECAPTCHA_SECRET_KEY` sudah diisi
- [ ] Cloudflare SSL mode: **Full (strict)**
- [ ] Storage permissions: `775` untuk `storage/` dan `bootstrap/cache/`
- [ ] Tidak ada file `.env` yang ter-expose (check via browser)

---

## 📞 Support

Jika mengalami masalah:
1. Cek log dengan `docker compose logs`
2. Pastikan semua environment variable terisi dengan benar
3. Restart containers dengan `docker compose restart`
4. Clear cache dengan `php artisan optimize:clear`

---

**Selamat! CMS Sekolah Anda siap digunakan!** 🎉
