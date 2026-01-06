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
                        Forms\Components\DatePicker::make('registration_start')
                            ->label('Tanggal Mulai')
                            ->required()
                            ->native(false),
                        
                        Forms\Components\DatePicker::make('registration_end')
                            ->label('Tanggal Selesai')
                            ->required()
                            ->native(false)
                            ->afterOrEqual('registration_start'),
                        
                        Forms\Components\DatePicker::make('announcement_date')
                            ->label('Tanggal Pengumuman')
                            ->native(false)
                            ->afterOrEqual('registration_end'),
                    ]),
                
                // Forms\Components\Section::make('Jalur Pendaftaran')
                //     ->schema([
                //         Forms\Components\CheckboxList::make('active_paths')
                //             ->label('Jalur yang Dibuka')
                //             ->options(RegistrationPath::toSelectArray())
                //             ->columns(2)
                //             ->helperText('Kosongkan untuk membuka semua jalur'),
                //     ]),
                
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
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'draft' => 'Draft',
                                'active' => 'Aktif',
                                'closed' => 'Ditutup',
                            ])
                            ->required()
                            ->default('draft')
                            ->helperText('Hanya periode aktif yang akan ditampilkan di halaman depan'),
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
                
                Tables\Columns\TextColumn::make('registration_start')
                    ->label('Mulai')
                    ->date('d M Y')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('registration_end')
                    ->label('Selesai')
                    ->date('d M Y')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'active' => 'success',
                        'closed' => 'danger',
                        default => 'gray',
                    }),
            ])
            ->defaultSort('registration_start', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('academic_year')
                    ->label('Tahun Ajaran')
                    ->options(fn () => PpdbPeriod::pluck('academic_year', 'academic_year')->toArray()),
                
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'active' => 'Aktif',
                        'closed' => 'Ditutup',
                    ]),
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
