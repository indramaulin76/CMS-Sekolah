# 🏫 CMS Sekolah - SMA Tunas Harapan

<p align="center">
  <img src="public/images/logo.png" alt="Logo SMA Tunas Harapan" width="120">
</p>

<p align="center">
  <strong>Content Management System untuk Website Sekolah</strong><br>
  Dibangun dengan Laravel 12, FilamentPHP v3, Livewire v3, dan Tailwind CSS
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.3-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/FilamentPHP-3.x-FDAE4B?style=for-the-badge&logo=laravel&logoColor=white" alt="Filament">
  <img src="https://img.shields.io/badge/Livewire-3.x-FB70A9?style=for-the-badge&logo=livewire&logoColor=white" alt="Livewire">
  <img src="https://img.shields.io/badge/Docker-Ready-2496ED?style=for-the-badge&logo=docker&logoColor=white" alt="Docker">
</p>

---

## 📋 Daftar Isi

- [Fitur](#-fitur)
- [Tech Stack](#-tech-stack)
- [Persyaratan Sistem](#-persyaratan-sistem)
- [Instalasi](#-instalasi)
  - [Menggunakan Docker (Rekomendasi)](#menggunakan-docker-rekomendasi)
  - [Instalasi Manual](#instalasi-manual)
- [Konfigurasi](#-konfigurasi)
- [Struktur Proyek](#-struktur-proyek)
- [Panel Admin](#-panel-admin)
- [Kredensial Default](#-kredensial-default)
- [Lisensi](#-lisensi)

---

## ✨ Fitur

### 🌐 Frontend Website
- **Beranda** - Hero section, artikel terbaru, sambutan kepala sekolah
- **Artikel & Berita** - Sistem artikel dengan kategori dan pagination
- **Agenda/Event** - Kalender kegiatan sekolah
- **Galeri** - Album foto kegiatan sekolah
- **Halaman Statis** - Profil, Visi Misi, Kontak, dll
- **PPDB Online** - Penerimaan Peserta Didik Baru dengan formulir pendaftaran lengkap

### 🛠️ Panel Admin (FilamentPHP)
- **Manajemen Artikel** - CRUD artikel dengan rich text editor
- **Manajemen Kategori** - Organisasi artikel berdasarkan kategori
- **Manajemen Event** - Kelola agenda dan kegiatan sekolah
- **Galeri Foto** - Upload dan kelola album foto
- **Halaman Statis** - Kelola konten halaman profil, visi misi, dll
- **Kepala Sekolah** - Kelola data dan sambutan kepala sekolah
- **PPDB** - Kelola periode dan pendaftaran siswa baru
- **Manajemen User** - Kelola pengguna admin

### 🎨 Desain & UX
- Responsive design untuk semua perangkat
- Modern UI dengan Tailwind CSS
- Animasi smooth dengan Alpine.js
- SEO-friendly

---

## 🛠 Tech Stack

| Teknologi | Versi | Deskripsi |
|-----------|-------|-----------|
| **Laravel** | 12.x | PHP Framework |
| **PHP** | 8.3+ | Backend Language |
| **FilamentPHP** | 3.x | Admin Panel |
| **Livewire** | 3.x | Dynamic Components |
| **Tailwind CSS** | 3.x | Styling Framework |
| **Alpine.js** | - | JavaScript Framework |
| **Vite** | - | Build Tool |
| **MariaDB/MySQL** | - | Database |
| **Nginx** | Alpine | Web Server |
| **Docker** | - | Containerization |

---

## 💻 Persyaratan Sistem

### Menggunakan Docker
- Docker Engine 20.10+
- Docker Compose 2.0+
- 2GB RAM minimum

### Instalasi Manual
- PHP >= 8.3
- Composer 2.x
- Node.js >= 18.x & NPM
- MySQL 8.x / MariaDB 10.x
- Git

---

## 🚀 Instalasi

### Menggunakan Docker (Rekomendasi)

1. **Clone Repository**
   ```bash
   git clone <repository-url> web-sekolah
   cd web-sekolah
   ```

2. **Setup Environment**
   ```bash
   cp .env.example .env
   ```

3. **Buat Docker Network (jika belum ada)**
   ```bash
   docker network create dev-network
   ```

4. **Jalankan Container**
   ```bash
   # Tanpa database (gunakan database eksternal)
   docker compose up -d

   # Dengan database built-in
   docker compose --profile with-db up -d
   ```

5. **Install Dependencies & Setup**
   ```bash
   # Masuk ke container
   docker exec -it web-sekolah-app sh

   # Install PHP dependencies
   composer install

   # Generate application key
   php artisan key:generate

   # Jalankan migrasi & seeder
   php artisan migrate --seed

   # Install & build assets
   npm install
   npm run build

   # Create storage link
   php artisan storage:link
   ```

6. **Akses Aplikasi**
   - Website: http://localhost:8001
   - Panel Admin: http://localhost:8001/admin

---

### Instalasi Manual

1. **Clone Repository**
   ```bash
   git clone <repository-url> web-sekolah
   cd web-sekolah
   ```

2. **Install PHP Dependencies**
   ```bash
   composer install
   ```

3. **Setup Environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Konfigurasi Database**
   
   Edit file `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=cms_sekolah
   DB_USERNAME=root
   DB_PASSWORD=your_password
   ```

5. **Jalankan Migrasi & Seeder**
   ```bash
   php artisan migrate --seed
   ```

6. **Install & Build Frontend Assets**
   ```bash
   npm install
   npm run build
   ```

7. **Create Storage Link**
   ```bash
   php artisan storage:link
   ```

8. **Jalankan Development Server**
   ```bash
   # Opsi 1: Menggunakan composer script (recommended)
   composer dev

   # Opsi 2: Manual
   php artisan serve
   npm run dev  # di terminal terpisah
   ```

9. **Akses Aplikasi**
   - Website: http://localhost:8000
   - Panel Admin: http://localhost:8000/admin

---

## ⚙️ Konfigurasi

### Environment Variables

| Variable | Deskripsi | Default |
|----------|-----------|---------|
| `APP_NAME` | Nama aplikasi | SMA Tunas Harapan |
| `APP_ENV` | Environment (local/production) | local |
| `APP_URL` | URL aplikasi | http://localhost |
| `DB_HOST` | Host database | mysql |
| `DB_DATABASE` | Nama database | cms_sekolah |
| `DB_USERNAME` | Username database | sail |
| `DB_PASSWORD` | Password database | password |
| `RECAPTCHA_SITE_KEY` | Google reCAPTCHA site key | - |
| `RECAPTCHA_SECRET_KEY` | Google reCAPTCHA secret key | - |

---

## 📁 Struktur Proyek

```
web-sekolah/
├── app/
│   ├── Enums/              # PHP Enums (Status, Types)
│   ├── Filament/           # FilamentPHP Admin Panel
│   │   ├── Pages/          # Custom admin pages
│   │   └── Resources/      # CRUD Resources
│   │       ├── CategoryResource.php
│   │       ├── EventResource.php
│   │       ├── GalleryResource.php
│   │       ├── HeadmasterResource.php
│   │       ├── PageResource.php
│   │       ├── PostResource.php
│   │       ├── PpdbPeriodResource.php
│   │       ├── PpdbRegistrationResource.php
│   │       └── UserResource.php
│   ├── Mail/               # Email templates
│   ├── Models/             # Eloquent Models
│   └── Rules/              # Custom validation rules
├── config/                 # Configuration files
├── database/
│   ├── migrations/         # Database migrations
│   └── seeders/            # Database seeders
├── docker/
│   └── nginx/              # Nginx configuration
├── public/                 # Public assets
├── resources/
│   ├── css/                # Stylesheets
│   ├── js/                 # JavaScript files
│   └── views/              # Blade templates
│       ├── components/     # Reusable components
│       ├── posts/          # Article pages
│       ├── events/         # Event pages
│       ├── gallery/        # Gallery pages
│       ├── pages/          # Static pages
│       └── ppdb/           # PPDB pages
├── routes/                 # Route definitions
├── storage/                # Storage files
├── docker-compose.yml      # Docker Compose config
├── Dockerfile              # Docker build config
└── README.md               # This file
```

---

## 🔐 Panel Admin

Akses panel admin di `/admin` dengan fitur:

| Modul | Deskripsi |
|-------|-----------|
| **Posts** | Kelola artikel, berita, dan pengumuman |
| **Categories** | Kelola kategori artikel |
| **Events** | Kelola agenda dan kegiatan sekolah |
| **Gallery** | Kelola album dan foto galeri |
| **Pages** | Kelola halaman statis (Profil, Visi Misi, dll) |
| **Headmasters** | Kelola data kepala sekolah |
| **PPDB Periods** | Kelola periode PPDB |
| **PPDB Registrations** | Kelola pendaftaran siswa baru |
| **Users** | Kelola pengguna admin |

---

## 🔑 Kredensial Default

> ⚠️ **PENTING**: Segera ganti password setelah instalasi untuk keamanan!

| Role | Email | Password |
|------|-------|----------|
| Admin | `admin@smatunasharapan.sch.id` | `password` |
| Humas | `humas@smatunasharapan.sch.id` | `password` |
| Kesiswaan | `kesiswaan@smatunasharapan.sch.id` | `password` |

---

## 📝 Development Commands

```bash
# Jalankan development server dengan hot reload
composer dev

# Jalankan queue worker
php artisan queue:work

# Clear semua cache
php artisan optimize:clear

# Regenerate autoload
composer dump-autoload

# Format kode dengan Laravel Pint
./vendor/bin/pint

# Jalankan tests
php artisan test
```

---

## 🐳 Docker Commands

```bash
# Start containers
docker compose up -d

# Stop containers
docker compose down

# View logs
docker compose logs -f

# Masuk ke container app
docker exec -it web-sekolah-app sh

# Rebuild container
docker compose build --no-cache
```

---

## 📄 Lisensi

Proyek ini bersifat **proprietary** dan dikembangkan khusus untuk SMA Tunas Harapan.

---

<p align="center">
  Made with ❤️ using Laravel
</p>
