<?php

namespace App\Filament\Pages;

use App\Models\GeneralSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class Settings extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'Pengaturan';
    protected static ?string $navigationLabel = 'Pengaturan Umum';
    protected static ?string $title = 'Pengaturan Umum Website';
    protected static string $view = 'filament.pages.settings';
    protected static ?int $navigationSort = 2;

    public ?array $data = [];

    public function mount(): void
    {
        $settings = GeneralSetting::first() ?? new GeneralSetting();
        $this->form->fill($settings->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Settings')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Informasi Sekolah')
                            ->schema([
                                Forms\Components\TextInput::make('school_name')
                                    ->label('Nama Sekolah')
                                    ->required(),
                                Forms\Components\TextInput::make('tagline')
                                    ->label('Tagline'),
                                Forms\Components\FileUpload::make('logo')
                                    ->label('Logo Sekolah')
                                    ->image()
                                    ->directory('settings'),
                            ]),
                        
                        Forms\Components\Tabs\Tab::make('Kontak')
                            ->schema([
                                Forms\Components\Textarea::make('address')
                                    ->label('Alamat Lengkap')
                                    ->required(),
                                Forms\Components\TextInput::make('phone')
                                    ->label('Telepon')
                                    ->required(),
                                Forms\Components\TextInput::make('email')
                                    ->label('Email')
                                    ->email()
                                    ->required(),
                                Forms\Components\TextInput::make('whatsapp')
                                    ->label('WhatsApp'),
                                Forms\Components\TextInput::make('office_hours')
                                    ->label('Jam Operasional'),
                            ]),
                        
                        Forms\Components\Tabs\Tab::make('Media Sosial')
                            ->schema([
                                Forms\Components\TextInput::make('facebook_url')
                                    ->label('Facebook URL')
                                    ->url(),
                                Forms\Components\TextInput::make('instagram_url')
                                    ->label('Instagram URL')
                                    ->url(),
                                Forms\Components\TextInput::make('youtube_url')
                                    ->label('YouTube URL')
                                    ->url(),
                                Forms\Components\TextInput::make('tiktok_url')
                                    ->label('TikTok URL')
                                    ->url(),
                                Forms\Components\Textarea::make('map_embed_link')
                                    ->label('Google Maps Embed Code'),
                                Forms\Components\TextInput::make('google_maps_link')
                                    ->label('Link Google Maps')
                                    ->url()
                                    ->placeholder('https://maps.google.com/...'),
                                Forms\Components\TextInput::make('sidebar_video_url')
                                    ->label('Video Sidebar (YouTube URL)')
                                    ->url()
                                    ->placeholder('https://www.youtube.com/watch?v=...'),
                            ]),
                        
                        Forms\Components\Tabs\Tab::make('Hero Section')
                            ->schema([
                                Forms\Components\FileUpload::make('hero_images')
                                    ->label('Foto Hero')
                                    ->image()
                                    ->multiple()
                                    ->maxFiles(10)
                                    ->reorderable()
                                    ->directory('settings/hero')
                                    ->helperText('Upload 1-10 foto. Ukuran rekomendasi: 1920x1080 px (16:9). Foto pertama menjadi gambar utama untuk SEO dan foto akan berganti otomatis setiap 6 detik.'),
                                Forms\Components\TextInput::make('hero_title')
                                    ->label('Judul Hero'),
                                Forms\Components\Textarea::make('hero_subtitle')
                                    ->label('Subtitle Hero'),
                            ]),
                        
                        Forms\Components\Tabs\Tab::make('SEO')
                            ->schema([
                                Forms\Components\Textarea::make('meta_description')
                                    ->label('Meta Description'),
                                Forms\Components\Textarea::make('meta_keywords')
                                    ->label('Meta Keywords'),
                            ]),
                    ])
                    ->columnSpanFull(),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Simpan Pengaturan')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();

        // Keep the legacy field in sync for older views and integrations.
        if (array_key_exists('hero_images', $data)) {
            $heroImages = is_array($data['hero_images']) ? $data['hero_images'] : [];
            $heroImages = array_values($heroImages);
            $data['hero_images'] = $heroImages;
            $data['hero_image'] = $heroImages[0] ?? null;
        }

        $settings = GeneralSetting::first();
        
        if ($settings) {
            $settings->update($data);
        } else {
            GeneralSetting::create($data);
        }

        // Clear cache
        cache()->forget('general_settings');

        Notification::make()
            ->success()
            ->title('Pengaturan berhasil disimpan!')
            ->send();
    }
}
