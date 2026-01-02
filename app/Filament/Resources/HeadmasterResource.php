<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeadmasterResource\Pages;
use App\Models\Headmaster;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class HeadmasterResource extends Resource
{
    protected static ?string $model = Headmaster::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $navigationGroup = 'Pengaturan';
    protected static ?string $navigationLabel = 'Kepala Sekolah';
    protected static ?string $modelLabel = 'Kepala Sekolah';
    protected static ?string $pluralModelLabel = 'Kepala Sekolah';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Kepala Sekolah')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Lengkap (dengan gelar)')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Drs. H. Budi Santoso, M.Pd'),

                        Forms\Components\TextInput::make('position')
                            ->label('Jabatan')
                            ->default('Kepala Sekolah')
                            ->maxLength(255),

                        Forms\Components\FileUpload::make('photo')
                            ->label('Foto')
                            ->image()
                            ->imageEditor()
                            ->avatar()
                            ->directory('headmasters'),

                        Forms\Components\Textarea::make('quote')
                            ->label('Kutipan/Quote')
                            ->rows(2)
                            ->placeholder('Pendidikan adalah senjata paling ampuh...'),

                        Forms\Components\RichEditor::make('message')
                            ->label('Sambutan Lengkap')
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Periode & Status')
                    ->schema([
                        Forms\Components\TextInput::make('start_year')
                            ->label('Tahun Mulai Menjabat')
                            ->numeric()
                            ->minValue(1900)
                            ->maxValue(2100),

                        Forms\Components\TextInput::make('end_year')
                            ->label('Tahun Selesai')
                            ->numeric()
                            ->minValue(1900)
                            ->maxValue(2100)
                            ->helperText('Kosongkan jika masih menjabat'),

                        Forms\Components\TextInput::make('order')
                            ->label('Urutan Tampilan')
                            ->numeric()
                            ->default(1),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Sedang Menjabat')
                            ->default(true)
                            ->helperText('Hanya satu yang bisa aktif'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Foto')
                    ->circular(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('position')
                    ->label('Jabatan'),

                Tables\Columns\TextColumn::make('start_year')
                    ->label('Mulai')
                    ->sortable(),

                Tables\Columns\TextColumn::make('end_year')
                    ->label('Selesai')
                    ->default('Sekarang'),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->defaultSort('order');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHeadmasters::route('/'),
            'create' => Pages\CreateHeadmaster::route('/create'),
            'edit' => Pages\EditHeadmaster::route('/{record}/edit'),
        ];
    }
}
