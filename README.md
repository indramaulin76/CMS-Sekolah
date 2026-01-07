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
  <img src="https://img.shields.io/badge/Docker-Ready-2496ED?style=for-the-badge&logo=docker&logoColor=white" alt="Docker">
  <img src="https://img.shields.io/badge/Cloudflare-Tunnel-F38020?style=for-the-badge&logo=cloudflare&logoColor=white" alt="Cloudflare">
</p>

---

## ✨ Fitur Utama

### 🌐 Frontend Website
| Fitur | Deskripsi |
|-------|-----------|
| **Beranda** | Hero section, artikel terbaru, sambutan kepala sekolah |
| **Artikel & Berita** | Sistem artikel dengan kategori dan pagination |
| **Agenda/Event** | Kalender kegiatan sekolah |
| **Galeri** | Album foto kegiatan sekolah |
| **Halaman Statis** | Profil, Visi Misi, Kontak, dll |
| **PPDB Online** | Pendaftaran siswa baru dengan formulir lengkap |

### 🛠️ Panel Admin (FilamentPHP)
- Manajemen Artikel, Kategori, Event, Galeri
- Halaman Statis dengan Rich Text Editor
- PPDB: Periode pendaftaran & verifikasi siswa
- Dashboard statistik dengan widget
- Export PDF kartu pendaftaran

### 🔒 Fitur Keamanan
- ✅ Role-based Access Control (Admin/Superadmin)
- ✅ XSS Protection dengan HtmlSanitizer
- ✅ CSRF Protection
- ✅ reCAPTCHA v3 (invisible) pada form PPDB
- ✅ Rate Limiting pada endpoint sensitif
- ✅ Soft Deletes untuk audit trail
- ✅ Input validation & sanitization
- ✅ Trusted Proxy untuk Cloudflare Tunnel

---

## 🛠 Tech Stack

| Teknologi | Versi | Deskripsi |
|-----------|-------|-----------|
| **Laravel** | 12.x | PHP Framework |
| **PHP** | 8.3+ | Backend Language |
| **FilamentPHP** | 3.x | Admin Panel |
| **Livewire** | 3.x | Dynamic Components |
| **Tailwind CSS** | 3.x | Styling Framework |
| **MariaDB/MySQL** | 10.x | Database |
| **Docker** | - | Containerization |
| **Nginx** | Alpine | Web Server |

---

## 🚀 Quick Start

### Development (Docker)

```bash
# Clone repository
git clone https://github.com/username/CMS-Sekolah.git
cd CMS-Sekolah

# Setup environment
cp .env.example .env

# Buat network & jalankan
docker network create dev-network
docker compose up -d

# Setup Laravel
docker compose exec app sh
composer install
php artisan key:generate
php artisan migrate --seed
npm install && npm run build
php artisan storage:link
exit
```

**Akses:**
- Website: http://localhost:8001
- Admin Panel: http://localhost:8001/admin

### Production (Docker + Cloudflare Tunnel)

📖 Lihat **[panduandeploy.md](panduandeploy.md)** untuk panduan lengkap.

```bash
# Quick production setup
cp env.production.example .env
docker compose -f docker-compose.production.yml up -d
```

---

## 🔐 Kredensial Default

> ⚠️ **PENTING**: Segera ganti password setelah instalasi!

| Role | Email | Password |
|------|-------|----------|
| Admin | `admin@smatunasharapan.sch.id` | `password` |

---

## 📁 Struktur Proyek

```
CMS-Sekolah/
├── app/
│   ├── Filament/           # Admin Panel Resources
│   ├── Helpers/            # HtmlSanitizer, dll
│   ├── Models/             # Eloquent Models
│   └── Rules/              # Custom Validation (ReCaptcha)
├── config/                 # Configuration
├── database/migrations/    # Database Schema
├── docker/nginx/           # Nginx Configuration
├── resources/views/        # Blade Templates
├── routes/                 # Route Definitions
├── docker-compose.yml            # Development
├── docker-compose.production.yml # Production
├── env.production.example        # Production Env Template
└── panduandeploy.md              # Deployment Guide
```

---

## � Docker Commands

```bash
# Development
docker compose up -d
docker compose logs -f
docker compose exec app sh

# Production
docker compose -f docker-compose.production.yml up -d
docker compose -f docker-compose.production.yml logs -f
```

---

## 📝 Maintenance

```bash
# Clear cache
docker compose exec app php artisan optimize:clear

# Run migrations
docker compose exec app php artisan migrate --force

# Rebuild assets
docker compose exec app npm run build
```

---

## 📄 Dokumentasi

- 📖 [Panduan Deploy Production](panduandeploy.md)
- 🔧 [Environment Variables](env.production.example)

---

## 📄 Lisensi

Proyek ini dikembangkan untuk SMA Tunas Harapan.

---

<p align="center">
  Made with ❤️ using Laravel & FilamentPHP
</p>
