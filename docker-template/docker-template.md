# 🐳 Docker Template untuk Laravel Projects

Template Docker yang bisa digunakan untuk semua project Laravel dengan arsitektur **shared database** dan **nginx reverse proxy**.

---

## 📋 Daftar Isi

- [Arsitektur](#-arsitektur)
- [Struktur File](#-struktur-file)
- [Penjelasan File](#-penjelasan-file)
- [Quick Start](#-quick-start)
- [Konfigurasi Detail](#-konfigurasi-detail)
- [Port Registry](#-port-registry)
- [Useful Commands](#-useful-commands)
- [Troubleshooting](#-troubleshooting)

---

## 🏗️ Arsitektur

```
┌─────────────────────────────────────────────────────────────────┐
│                         dev-network                             │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐           │
│  │ project-1-app│  │ project-2-app│  │ project-3-app│           │
│  │   (PHP-FPM)  │  │   (PHP-FPM)  │  │   (PHP-FPM)  │           │
│  │   port:9000  │  │   port:9000  │  │   port:9000  │           │
│  └──────┬───────┘  └──────┬───────┘  └──────┬───────┘           │
│         │                 │                 │                   │
│         └────────────┬────┴─────────────────┘                   │
│                      │                                          │
│              ┌───────▼────────┐      ┌──────────────┐           │
│              │  nginx-proxy   │      │   master-db  │           │
│              │  :8001, :8002  │      │  (MariaDB)   │           │
│              │     :8003...   │      │   :3306      │           │
│              └───────┬────────┘      └──────────────┘           │
│                      │                                          │
└──────────────────────┼──────────────────────────────────────────┘
                       │
                 ┌─────▼─────┐
                 │  Browser  │
                 │ localhost │
                 └───────────┘
```

### Komponen Utama

| Komponen | Deskripsi |
|----------|-----------|
| `dev-network` | Docker network yang menghubungkan semua container |
| `master-db` | Database MariaDB yang di-share oleh semua project |
| `nginx-proxy` | Reverse proxy yang routing request ke masing-masing project |
| `{project}-app` | Container PHP-FPM untuk setiap project Laravel |

---

## 📁 Struktur File

```
docker-template/
├── Dockerfile           # Image PHP-FPM untuk build container
├── docker-compose.yml   # Konfigurasi services Docker
├── docker/              # (Opsional) Config tambahan
└── README.md            # Dokumentasi ini
```

---

## 📄 Penjelasan File

### 1. Dockerfile

```dockerfile
FROM php:8.3-fpm-alpine
```

| Bagian | Penjelasan |
|--------|------------|
| `php:8.3-fpm-alpine` | Base image PHP 8.3 dengan FPM (FastCGI Process Manager), berbasis Alpine Linux (ringan) |
| `apk add --no-cache` | Install system dependencies (zip, git, curl, library untuk image processing) |
| `docker-php-ext-install` | Install PHP extensions yang dibutuhkan Laravel |
| `COPY --from=composer` | Copy Composer dari official image |
| `WORKDIR /var/www/html` | Set working directory di dalam container |
| `EXPOSE 9000` | Port PHP-FPM untuk menerima request dari nginx |
| `CMD ["php-fpm"]` | Command yang dijalankan saat container start |

**PHP Extensions yang terinstall:**

| Extension | Fungsi |
|-----------|--------|
| `pdo_mysql` | Koneksi ke MySQL/MariaDB |
| `mbstring` | Handle multi-byte string (Unicode) |
| `exif` | Baca metadata gambar |
| `pcntl` | Process control (untuk queue worker) |
| `bcmath` | Operasi matematika presisi tinggi |
| `gd` | Image processing (resize, crop, watermark) |
| `intl` | Internationalization (format tanggal, mata uang) |

---

### 2. docker-compose.yml

#### Service: `app`

```yaml
services:
  app:
    build:
      context: .
      dockerfile: Dockerfile
    container_name: ${APP_NAME:-laravel}-app
    volumes:
      - .:/var/www/html
    environment:
      - APP_ENV=${APP_ENV:-local}
      - DB_HOST=master-db
      - DB_PORT=3306
    networks:
      - dev-network
    restart: unless-stopped
    depends_on:
      - master-db
```

| Key | Penjelasan |
|-----|------------|
| `build.context: .` | Build image dari current directory |
| `build.dockerfile: Dockerfile` | Gunakan file Dockerfile yang ada |
| `container_name: ${APP_NAME:-laravel}-app` | Nama container diambil dari variabel `APP_NAME`, default `laravel-app` |
| `volumes: - .:/var/www/html` | Mount current directory ke `/var/www/html` di container (live reload) |
| `environment` | Environment variables yang di-pass ke container |
| `DB_HOST=master-db` | **PENTING!** Host database adalah nama container `master-db`, bukan `localhost` |
| `networks: - dev-network` | Gabung ke network `dev-network` |
| `restart: unless-stopped` | Auto restart kecuali di-stop manual |
| `depends_on: - master-db` | Tunggu `master-db` sebelum start (hanya jika pakai profile `with-db`) |

#### Service: `master-db` (Opsional)

```yaml
master-db:
  image: mariadb:latest
  container_name: master-db
  environment:
    MYSQL_ROOT_PASSWORD: ${DB_PASSWORD:-secret}
    MYSQL_DATABASE: ${DB_DATABASE:-laravel}
  volumes:
    - master-db-data:/var/lib/mysql
  ports:
    - "3306:3306"
  networks:
    - dev-network
  restart: unless-stopped
  profiles:
    - with-db
```

| Key | Penjelasan |
|-----|------------|
| `image: mariadb:latest` | Gunakan MariaDB official image |
| `MYSQL_ROOT_PASSWORD` | Password root, dari variabel `DB_PASSWORD` atau default `secret` |
| `MYSQL_DATABASE` | Database yang dibuat otomatis saat pertama kali |
| `volumes: - master-db-data:/var/lib/mysql` | Persist data ke volume |
| `ports: - "3306:3306"` | Expose port untuk akses dari host (TablePlus, DBeaver, dll) |
| `profiles: - with-db` | **Hanya jalan jika pakai `--profile with-db`** |

> **💡 Tentang Profiles:**
> - Jalankan TANPA database: `docker-compose up -d`
> - Jalankan DENGAN database: `docker-compose --profile with-db up -d`
> 
> Ini berguna jika Anda sudah punya `master-db` running dari project lain.

#### Networks & Volumes

```yaml
networks:
  dev-network:
    external: true

volumes:
  master-db-data:
    external: true
    name: mysql-pma_mariadb_data
```

| Key | Penjelasan |
|-----|------------|
| `external: true` | Network/volume sudah dibuat di luar, bukan auto-create |
| `name: mysql-pma_mariadb_data` | Nama volume yang sudah ada (dari setup mysql-pma sebelumnya) |

---

## 🚀 Quick Start

### Prerequisites

1. Docker & Docker Compose terinstall
2. Network `dev-network` sudah dibuat
3. (Opsional) Database `master-db` sudah running

### Langkah 1: Copy file ke project baru

```bash
# Copy template ke project Laravel Anda
cp docker-template/Dockerfile /path/to/your/project/
cp docker-template/docker-compose.yml /path/to/your/project/
```

### Langkah 2: Edit `.env` di project

```env
# Nama project (akan jadi nama container)
APP_NAME=nama-project

# Konfigurasi database
DB_CONNECTION=mysql
DB_HOST=master-db           # ⚠️ HARUS master-db, bukan localhost!
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=secret
```

> **⚠️ PENTING:** `DB_HOST` harus `master-db` (nama container database), bukan `localhost` atau `127.0.0.1`!

### Langkah 3: Buat network (jika belum ada)

```bash
# Buat dev-network (aman dijalankan berkali-kali)
docker network create dev-network 2>/dev/null || true
```

**Penjelasan command:**
| Bagian | Fungsi |
|--------|--------|
| `docker network create dev-network` | Buat network bernama `dev-network` |
| `2>/dev/null` | Sembunyikan pesan error (kalau sudah ada) |
| `\|\| true` | Kalau gagal, tetap return sukses (exit code 0) |

### Langkah 4: Jalankan container

```bash
cd /path/to/your/project

# OPSI A: Tanpa database (jika master-db sudah running)
docker-compose up -d --build

# OPSI B: Dengan database (jika belum ada master-db)
docker-compose --profile with-db up -d --build
```

### Langkah 5: Setup Laravel

```bash
# Install dependencies
docker exec -it nama-project-app composer install

# Generate application key
docker exec -it nama-project-app php artisan key:generate

# Run migrations
docker exec -it nama-project-app php artisan migrate

# (Opsional) Run seeders
docker exec -it nama-project-app php artisan db:seed
```

### Langkah 6: Tambahkan ke Nginx Proxy

Buat file baru di `docker-infra/nginx/conf.d/nama-project.conf`:

```nginx
server {
    listen 800X;  # Ganti X dengan nomor unik (lihat Port Registry)
    server_name localhost;
    
    # Path ke folder public Laravel
    root /var/www/nama-project/public;
    index index.php index.html;

    # Pretty URLs untuk Laravel
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    # PHP Processing
    location ~ \.php$ {
        fastcgi_pass nama-project-app:9000;  # ⚠️ Harus sama dengan container_name!
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    # Deny access to .htaccess
    location ~ /\.ht {
        deny all;
    }
}
```

**Penjelasan konfigurasi Nginx:**

| Directive | Penjelasan |
|-----------|------------|
| `listen 800X` | Port yang di-listen nginx (harus unik per project) |
| `server_name localhost` | Hostname (untuk development) |
| `root /var/www/nama-project/public` | Path ke folder public Laravel di dalam container nginx |
| `try_files $uri $uri/ /index.php?$query_string` | Route semua request ke Laravel router |
| `fastcgi_pass nama-project-app:9000` | Forward request PHP ke container PHP-FPM |
| `fastcgi_param SCRIPT_FILENAME` | Beritahu PHP file mana yang dieksekusi |

> **⚠️ PENTING:** `fastcgi_pass` harus sama dengan `container_name` di docker-compose.yml!

### Langkah 7: Update docker-infra/docker-compose.yml

Tambahkan port dan volume mount:

```yaml
services:
  nginx-proxy:
    ports:
      - "8001:8001"  # web-sekolah
      - "8002:8002"  # sop-inventory
      - "800X:800X"  # ← Port project baru
    volumes:
      - ./nginx/conf.d:/etc/nginx/conf.d
      - /path/to/project-1:/var/www/project-1:ro
      - /path/to/project-2:/var/www/project-2:ro
      - /path/to/nama-project:/var/www/nama-project:ro  # ← Volume project baru
```

| Key | Penjelasan |
|-----|------------|
| `800X:800X` | Map port host ke port container |
| `/path/to/project:/var/www/nama-project:ro` | Mount project folder (`:ro` = read-only untuk keamanan) |

### Langkah 8: Restart Nginx Proxy

```bash
cd docker-infra
docker-compose restart nginx-proxy

# Atau reload config saja (tanpa restart)
docker exec nginx-proxy nginx -s reload
```

### Langkah 9: Akses project

Buka browser: `http://localhost:800X`

---

## 🔧 Konfigurasi Detail

### Konsistensi Penamaan

Beberapa nama harus **KONSISTEN** di berbagai file:

| Lokasi | Yang Harus Sama |
|--------|-----------------|
| `.env` → `APP_NAME` | Nama project |
| `docker-compose.yml` → `container_name` | `${APP_NAME}-app` |
| `nginx/conf.d/*.conf` → `fastcgi_pass` | `nama-project-app:9000` |
| `docker-infra/docker-compose.yml` → volume path | `/var/www/nama-project` |
| `nginx/conf.d/*.conf` → `root` | `/var/www/nama-project/public` |

**Contoh untuk project "toko-online":**

```
.env                    → APP_NAME=toko-online
docker-compose.yml      → container_name: toko-online-app
nginx config            → fastcgi_pass toko-online-app:9000
nginx config            → root /var/www/toko-online/public
docker-infra volumes    → /path/to/toko:/var/www/toko-online:ro
```

### Environment Variables

| Variable | Default | Deskripsi |
|----------|---------|-----------|
| `APP_NAME` | `laravel` | Nama project, digunakan untuk container_name |
| `APP_ENV` | `local` | Environment (local/staging/production) |
| `DB_HOST` | - | **Harus** `master-db` |
| `DB_PORT` | `3306` | Port database |
| `DB_DATABASE` | `laravel` | Nama database |
| `DB_USERNAME` | `root` | Username database |
| `DB_PASSWORD` | `secret` | Password database |

---

## 📊 Port Registry

| Port | Project | Status |
|------|---------|--------|
| 8001 | web-sekolah | ✅ Used |
| 8002 | sop-inventory | ✅ Used |
| 8003 | - | 🟢 Available |
| 8004 | - | 🟢 Available |
| 8005 | - | 🟢 Available |
| 8006 | - | 🟢 Available |
| 8007 | - | 🟢 Available |
| 8008 | - | 🟢 Available |
| 8009 | - | 🟢 Available |
| 8010 | - | 🟢 Available |

> **Tips:** Update tabel ini setiap menambah project baru!

---

## 💻 Useful Commands

### Container Management

```bash
# Masuk ke container (bash shell)
docker exec -it nama-project-app sh

# Jalankan artisan command
docker exec -it nama-project-app php artisan [command]

# View container logs
docker logs -f nama-project-app

# View logs dengan timestamp
docker logs -f --timestamps nama-project-app

# Restart container
docker-compose restart

# Rebuild container (setelah edit Dockerfile)
docker-compose up -d --build

# Stop dan hapus container
docker-compose down

# Stop, hapus container + volumes (⚠️ HATI-HATI!)
docker-compose down -v
```

### Laravel Artisan

```bash
# Clear all cache
docker exec -it nama-project-app php artisan optimize:clear

# Run migrations
docker exec -it nama-project-app php artisan migrate

# Rollback migration
docker exec -it nama-project-app php artisan migrate:rollback

# Run seeders
docker exec -it nama-project-app php artisan db:seed

# Create controller
docker exec -it nama-project-app php artisan make:controller NamaController

# Run queue worker
docker exec -it nama-project-app php artisan queue:work

# Run scheduler
docker exec -it nama-project-app php artisan schedule:run
```

### Composer

```bash
# Install dependencies
docker exec -it nama-project-app composer install

# Update dependencies
docker exec -it nama-project-app composer update

# Add package
docker exec -it nama-project-app composer require vendor/package
```

### NPM/Node (jika ada)

```bash
# Install node modules
docker exec -it nama-project-app npm install

# Build assets
docker exec -it nama-project-app npm run build

# Development mode
docker exec -it nama-project-app npm run dev
```

### Network & Debugging

```bash
# List semua container di dev-network
docker network inspect dev-network

# Cek container bisa konek ke database
docker exec -it nama-project-app php artisan tinker
# >>> DB::connection()->getPdo();

# Ping antar container
docker exec -it nama-project-app ping master-db
```

---

## 🔥 Troubleshooting

### 1. "Network dev-network not found"

**Solusi:** Buat network terlebih dahulu

```bash
docker network create dev-network
```

### 2. "Connection refused" ke database

**Kemungkinan penyebab:**
- `DB_HOST` di `.env` bukan `master-db`
- Container `master-db` belum running
- Network tidak terhubung

**Solusi:**

```bash
# Cek apakah master-db running
docker ps | grep master-db

# Jika tidak ada, jalankan dengan profile
docker-compose --profile with-db up -d

# Atau jalankan dari docker-infra
cd docker-infra
docker-compose up -d master-db
```

### 3. Nginx error "upstream not found"

**Penyebab:** Nama container tidak match dengan `fastcgi_pass`

**Solusi:** Pastikan nama di nginx config sama dengan `container_name`:

```nginx
# docker-compose.yml
container_name: toko-online-app

# nginx config
fastcgi_pass toko-online-app:9000;  # ← Harus sama!
```

### 4. Permission denied pada storage/logs

**Solusi:**

```bash
# Masuk ke container
docker exec -it nama-project-app sh

# Fix permissions
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### 5. Changes tidak ter-reflect (cache)

**Solusi:**

```bash
docker exec -it nama-project-app php artisan optimize:clear
docker exec -it nama-project-app php artisan config:clear
docker exec -it nama-project-app php artisan view:clear
docker exec -it nama-project-app php artisan route:clear
```

### 6. Container tidak bisa start

**Solusi:** Cek logs

```bash
docker logs nama-project-app
docker-compose logs app
```

### 7. Port sudah digunakan

**Error:** `bind: address already in use`

**Solusi:**

```bash
# Cari proses yang pakai port
sudo lsof -i :8001

# Atau ganti ke port lain di docker-compose.yml
```

---

## 📚 Referensi

- [Docker Documentation](https://docs.docker.com/)
- [Docker Compose Documentation](https://docs.docker.com/compose/)
- [Laravel Deployment](https://laravel.com/docs/deployment)
- [Nginx Documentation](https://nginx.org/en/docs/)
- [PHP-FPM Configuration](https://www.php.net/manual/en/install.fpm.configuration.php)

---

## 📝 Changelog

| Version | Tanggal | Perubahan |
|---------|---------|-----------|
| 1.0.0 | 2026-01-01 | Initial release dengan dokumentasi lengkap |

---

**Happy Coding! 🚀**
