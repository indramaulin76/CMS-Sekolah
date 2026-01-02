# Quick Reference Guide - CMS Sekolah SMA Tunas Harapan

## 📁 Struktur File yang Sudah Dibuat

### Database Layer
```
database/
├── migrations/
│   ├── 2024_12_27_000001_create_categories_table.php
│   ├── 2024_12_27_000002_create_posts_table.php
│   ├── 2024_12_27_000003_create_events_table.php
│   ├── 2024_12_27_000004_create_general_settings_table.php
│   └── 2024_12_27_000005_create_headmasters_table.php
└── seeders/
    ├── DatabaseSeeder.php
    ├── UserSeeder.php
    ├── CategorySeeder.php
    ├── GeneralSettingSeeder.php
    └── HeadmasterSeeder.php
```

### Models
```
app/Models/
├── Category.php
├── Post.php
├── Event.php
├── GeneralSetting.php
└── Headmaster.php
```

## 🔑 Model Relationships

### Category
```php
// Usage
$category = Category::find(1);
$category->posts; // All posts
$category->publishedPosts; // Only published

// Scopes
Category::active()->get(); // Active categories only
```

### Post
```php
// Usage
$post = Post::find(1);
$post->category; // Get category
$post->user; // Get author

// Scopes
Post::published()->get(); // Published posts
Post::featured()->get(); // Featured posts
Post::ofType('news')->get(); // Filter by type

// Increment views
$post->incrementViews();
```

### Event
```php
// Usage
$event = Event::find(1);
$event->user; // Get creator

// Scopes
Event::published()->get(); // Published events
Event::upcoming()->get(); // Future events
Event::past()->get(); // Past events
```

### GeneralSetting (Singleton)
```php
// Always use this
$settings = GeneralSetting::getSettings();
echo $settings->school_name;
echo $settings->tagline;
```

### Headmaster
```php
// Get active headmaster
$headmaster = Headmaster::getActive();
echo $headmaster->name;
echo $headmaster->quote;
echo $headmaster->tenure_period; // "2020 - Sekarang"
```

## 🎨 Frontend Data Mapping (dari code.html)

### Header
- Logo: `$settings->logo`
- Nama Sekolah: `$settings->school_name`
- Tagline: `$settings->tagline`
- Phone: `$settings->phone`
- Email: `$settings->email`

### Hero Section
- Image: `$settings->hero_image`
- Title: `$settings->hero_title`
- Subtitle: `$settings->hero_subtitle`

### Info Bar (Floating Card)
- Alamat: `$settings->address`
- Social Media:
  - Facebook: `$settings->facebook_url`
  - Instagram: `$settings->instagram_url`
  - YouTube: `$settings->youtube_url`

### Artikel Terkini
```php
$posts = Post::published()
    ->latest('published_at')
    ->take(5)
    ->get();

foreach($posts as $post) {
    $post->title;
    $post->thumbnail;
    $post->excerpt;
    $post->published_at; // Format: 25 Des 2025
    $post->category->name; // "Berita"
    $post->user->name; // "Admin"
}
```

### Sidebar - Sambutan Kepala Sekolah
```php
$headmaster = Headmaster::getActive();
$headmaster->name; // "Drs. H. Budi Santoso, M.Pd"
$headmaster->photo;
$headmaster->position; // "Kepala Sekolah"
$headmaster->quote; // Kutipan singkat
```

### Sidebar - Kategori
```php
$categories = Category::active()
    ->withCount('posts')
    ->get();

foreach($categories as $category) {
    $category->name;
    $category->posts_count; // Badge angka
    $category->color; // untuk styling badge
}
```

### Footer
- Alamat: `$settings->address`
- Phone: `$settings->phone`
- Email: `$settings->email`
- Office Hours: `$settings->office_hours`
- Social Links: `$settings->facebook_url`, dll

## 🧪 Testing Queries

Setelah migration & seeding, test di `php artisan tinker`:

```php
// Test Categories
Category::count(); // Should return 4
Category::active()->get();

// Test Settings
$settings = GeneralSetting::first();
$settings->school_name; // "SMA Tunas Harapan"

// Test Headmaster
$kepsek = Headmaster::getActive();
$kepsek->name; // "Drs. H. Budi Santoso, M.Pd"

// Test Users
User::count(); // Should return 3
```

## 🎯 Next Steps

1. **Laravel Project Setup**
   ```bash
   composer create-project laravel/laravel web-sekolah
   cd web-sekolah
   ```

2. **Copy Files**
   - Copy semua migration files ke `database/migrations/`
   - Copy semua seeder files ke `database/seeders/`
   - Copy semua model files ke `app/Models/`

3. **Run Migrations**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

4. **Install FilamentPHP** (Fase 3)
   ```bash
   composer require filament/filament:"^3.0"
   php artisan filament:install --panels
   php artisan make:filament-user
   ```

5. **Create Filament Resources** (Fase 3)
   ```bash
   php artisan make:filament-resource Post
   php artisan make:filament-resource Category
   php artisan make:filament-resource Event
   # dst...
   ```

## 📊 Database ERD (Simplified)

```
┌─────────────┐
│  users      │
└──────┬──────┘
       │
       ├──────────────────┐
       │                  │
┌──────▼──────┐    ┌──────▼──────┐
│  posts      │    │  events     │
│  - title    │    │  - title    │
│  - content  │    │  - event_   │
│  - type     │    │    date     │
└──────┬──────┘    └─────────────┘
       │
       │
┌──────▼──────────┐
│  categories     │
│  - name         │
│  - slug         │
└─────────────────┘

┌─────────────────┐
│ general_        │
│ settings        │
│ (singleton)     │
└─────────────────┘

┌─────────────────┐
│ headmasters     │
│ - is_active     │
│ (singleton)     │
└─────────────────┘
```

## ⚠️ Important Notes

1. **Singleton Tables**: `general_settings` dan `headmasters` biasanya hanya punya 1 active record
2. **Slug**: Auto-generated dari title/name saat create
3. **Soft Delete**: Post menggunakan soft deletes untuk recovery
4. **Foreign Keys**: Cascade on delete untuk menjaga data integrity
5. **Default Password**: `password` - MUST change in production!

## 🔐 Default Credentials

- Admin: `admin@smatunasharapan.sch.id` / `password`
- Humas: `humas@smatunasharapan.sch.id` / `password`
- Kesiswaan: `kesiswaan@smatunasharapan.sch.id` / `password`
