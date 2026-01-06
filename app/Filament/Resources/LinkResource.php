<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LinkResource\Pages;
use App\Models\Link;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LinkResource extends Resource
{
    protected static ?string $model = Link::class;

    protected static ?string $navigationIcon = 'heroicon-o-link';
    
    protected static ?string $navigationLabel = 'Tautan Populer';
    
    protected static ?string $modelLabel = 'Tautan';
    
    protected static ?string $pluralModelLabel = 'Tautan Populer';
    
    protected static ?string $navigationGroup = 'Pengaturan';
    
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Tautan')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Judul Tautan')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Dinas Pendidikan'),
                            
                        Forms\Components\TextInput::make('url')
                            ->label('URL Tujuan')
                            ->url()
                            ->required()
                            ->maxLength(255)
                            ->placeholder('https://...'),
                            
                        Forms\Components\Select::make('target')
                            ->label('Target Tab')
                            ->options([
                                '_self' => 'Tab Saat Ini',
                                '_blank' => 'Tab Baru',
                            ])
                            ->default('_blank')
                            ->required(),
                            
                        Forms\Components\TextInput::make('order')
                            ->label('Urutan Tampil')
                            ->numeric()
                            ->default(0),
                            
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                    
                Tables\Columns\TextColumn::make('url')
                    ->label('URL')
                    ->limit(30)
                    ->icon('heroicon-m-link'),
                    
                Tables\Columns\TextColumn::make('target')
                    ->label('Target')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        '_self' => 'Self',
                        '_blank' => 'New Tab',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        '_self' => 'gray',
                        '_blank' => 'info',
                    }),
                    
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Aktif'),
                    
                Tables\Columns\TextColumn::make('order')
                    ->label('Urutan')
                    ->sortable(),
            ])
            ->defaultSort('order', 'asc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active'),
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
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLinks::route('/'),
            'create' => Pages\CreateLink::route('/create'),
            'edit' => Pages\EditLink::route('/{record}/edit'),
        ];
    }
}
