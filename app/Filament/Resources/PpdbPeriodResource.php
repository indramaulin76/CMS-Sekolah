<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Enums\RegistrationPath;
use App\Filament\Resources\PpdbPeriodResource\Pages;
use App\Models\PpdbPeriod;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PpdbPeriodResource extends Resource
{
    protected static ?string $model = PpdbPeriod::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationLabel = 'Periode PPDB';

    protected static ?string $modelLabel = 'Periode PPDB';

    protected static ?string $pluralModelLabel = 'Periode PPDB';

    protected static ?string $navigationGroup = 'PPDB';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Periode')
                    ->description('Data dasar periode PPDB')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('academic_year')
                            ->label('Tahun Ajaran')
                            ->placeholder('2025/2026')
                            ->required()
                            ->maxLength(20),
                        
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Periode')
                            ->placeholder('Gelombang 1')
                            ->required()
                            ->maxLength(100),
                        
                        Forms\Components\TextInput::make('quota')
                            ->label('Kuota Peserta')
                            ->numeric()
                            ->minValue(0)
                            ->default(0)
                            ->required(),
                        
                        Forms\Components\TextInput::make('registration_fee')
                            ->label('Biaya Pendaftaran')
                            ->numeric()
                            ->prefix('Rp')
                            ->default(0),
                    ]),
                
                Forms\Components\Section::make('Jadwal Pendaftaran')
                    ->columns(3)
                    ->schema([
                        Forms\Components\DatePicker::make('start_date')
                            ->label('Tanggal Mulai')
                            ->required()
                            ->native(false),
                        
                        Forms\Components\DatePicker::make('end_date')
                            ->label('Tanggal Selesai')
                            ->required()
                            ->native(false)
                            ->afterOrEqual('start_date'),
                        
                        Forms\Components\DatePicker::make('announcement_date')
                            ->label('Tanggal Pengumuman')
                            ->native(false)
                            ->afterOrEqual('end_date'),
                    ]),
                
                Forms\Components\Section::make('Jalur Pendaftaran')
                    ->schema([
                        Forms\Components\CheckboxList::make('active_paths')
                            ->label('Jalur yang Dibuka')
                            ->options(RegistrationPath::toSelectArray())
                            ->columns(2)
                            ->helperText('Kosongkan untuk membuka semua jalur'),
                    ]),
                
                Forms\Components\Section::make('Deskripsi')
                    ->collapsible()
                    ->schema([
                        Forms\Components\RichEditor::make('description')
                            ->label('Deskripsi')
                            ->columnSpanFull(),
                        
                        Forms\Components\RichEditor::make('requirements')
                            ->label('Persyaratan')
                            ->columnSpanFull(),
                    ]),
                
                Forms\Components\Section::make('Status')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true)
                            ->helperText('Periode yang tidak aktif tidak akan ditampilkan'),
                        
                        Forms\Components\Toggle::make('announcement_published')
                            ->label('Publikasikan Pengumuman')
                            ->default(false)
                            ->helperText('Aktifkan untuk menampilkan daftar siswa yang diterima di halaman publik')
                            ->onIcon('heroicon-m-megaphone')
                            ->offIcon('heroicon-m-eye-slash')
                            ->onColor('success'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('academic_year')
                    ->label('Tahun Ajaran')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Periode')
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('quota')
                    ->label('Kuota')
                    ->numeric()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('registrations_count')
                    ->label('Pendaftar')
                    ->counts('registrations')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('start_date')
                    ->label('Mulai')
                    ->date('d M Y')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('end_date')
                    ->label('Selesai')
                    ->date('d M Y')
                    ->sortable(),
                
                Tables\Columns\BadgeColumn::make('status_label')
                    ->label('Status')
                    ->colors([
                        'gray' => 'Tidak Aktif',
                        'info' => 'Akan Datang',
                        'danger' => 'Selesai',
                        'success' => 'Dibuka',
                    ]),
                
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
            ])
            ->defaultSort('start_date', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('academic_year')
                    ->label('Tahun Ajaran')
                    ->options(fn () => PpdbPeriod::pluck('academic_year', 'academic_year')->toArray()),
                
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListPpdbPeriods::route('/'),
            'create' => Pages\CreatePpdbPeriod::route('/create'),
            'view' => Pages\ViewPpdbPeriod::route('/{record}'),
            'edit' => Pages\EditPpdbPeriod::route('/{record}/edit'),
        ];
    }
}
