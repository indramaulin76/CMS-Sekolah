<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryResource\Pages;
use App\Models\Gallery;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Konten';
    protected static ?string $navigationLabel = 'Galeri Foto';
    protected static ?string $modelLabel = 'Album';
    protected static ?string $pluralModelLabel = 'Galeri Foto';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Album')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Judul Album')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('slug', Str::slug($state))),

                        Forms\Components\TextInput::make('slug')
                            ->label('Slug URL')
                            ->required()
                            ->unique(Gallery::class, 'slug', ignoreRecord: true),

                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi Singkat')
                            ->rows(3)
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('thumbnail')
                            ->label('Cover Album')
                            ->image()
                            ->directory('galleries/covers')
                            ->imageEditor()
                            ->maxSize(2048) // 2MB
                            ->helperText('Format: JPG/PNG. Maks: 2MB. Resolusi saran: 1200x600 px (Rasio 2:1).'),

                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'draft' => 'Draft',
                                'published' => 'Dipublikasikan',
                            ])
                            ->required()
                            ->default('published'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Foto-foto')
                    ->description('Upload foto-foto kegiatan di sini.')
                    ->schema([
                        Forms\Components\Repeater::make('images')
                            ->schema([
                                Forms\Components\FileUpload::make('image')
                                    ->label('Foto')
                                    ->image()
                                    ->directory('galleries/images')
                                    ->required()
                                    ->maxSize(5120) // 5MB
                                    ->columnSpan(2)
                                    ->helperText('Maks: 5MB per foto.'),
                                
                                Forms\Components\TextInput::make('caption')
                                    ->label('Keterangan (Opsional)')
                                    ->columnSpan(2),
                            ])
                            ->defaultItems(0)
                            ->label('Daftar Foto')
                            ->grid(2)
                            ->columnSpanFull()
                            ->addActionLabel('Tambah Foto'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Cover')
                    ->size(80),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul Album')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('images')
                    ->label('Jumlah Foto')
                    ->formatStateUsing(fn ($state) => is_array($state) ? count($state) . ' Foto' : '0 Foto'),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'published' => 'success',
                    }),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Dipublikasikan',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGalleries::route('/'),
            'create' => Pages\CreateGallery::route('/create'),
            'edit' => Pages\EditGallery::route('/{record}/edit'),
        ];
    }
}
