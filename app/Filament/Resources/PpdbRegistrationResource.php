<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Enums\RegistrationStatus;
use App\Filament\Resources\PpdbRegistrationResource\Pages;
use App\Filament\Resources\PpdbRegistrationResource\RelationManagers;
use App\Models\PpdbRegistration;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PpdbRegistrationResource extends Resource
{
    protected static ?string $model = PpdbRegistration::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';

    protected static ?string $navigationLabel = 'Data Pendaftar';

    protected static ?string $modelLabel = 'Pendaftar PPDB';

    protected static ?string $pluralModelLabel = 'Data Pendaftar PPDB';

    protected static ?string $navigationGroup = 'PPDB';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // ========================================
                // SECTION 1: DATA PRIBADI SISWA
                // ========================================
                Forms\Components\Section::make('Data Pribadi Siswa')
                    ->description('Informasi identitas calon peserta didik')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('full_name')
                            ->label('1. Nama Lengkap')
                            ->required()
                            ->maxLength(150)
                            ->columnSpanFull(),
                        
                        Forms\Components\Select::make('gender')
                            ->label('2. Jenis Kelamin')
                            ->options([
                                'Laki-laki' => 'Laki-laki',
                                'Perempuan' => 'Perempuan',
                            ])
                            ->required()
                            ->native(false),
                        
                        Forms\Components\TextInput::make('birth_place')
                            ->label('3. Tempat Lahir')
                            ->required()
                            ->maxLength(100),
                        
                        Forms\Components\DatePicker::make('birth_date')
                            ->label('4. Tanggal Lahir')
                            ->required()
                            ->native(false)
                            ->maxDate(now()),
                        
                        Forms\Components\Select::make('religion')
                            ->label('5. Agama')
                            ->options([
                                'Islam' => 'Islam',
                                'Kristen' => 'Kristen',
                                'Katholik' => 'Katholik',
                                'Buddha' => 'Buddha',
                                'Hindu' => 'Hindu',
                                'Konghucu' => 'Konghucu',
                            ])
                            ->required()
                            ->native(false),
                        
                        Forms\Components\TextInput::make('nisn')
                            ->label('6. NISN')
                            ->maxLength(10)
                            ->unique(ignoreRecord: true)
                            ->helperText('10 digit angka'),
                        
                        Forms\Components\TextInput::make('nik')
                            ->label('8. NIK')
                            ->maxLength(16)
                            ->helperText('16 digit angka'),
                    ]),

                // ========================================
                // SECTION 2: KONTAK & ASAL SEKOLAH
                // ========================================
                Forms\Components\Section::make('Kontak & Asal Sekolah')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('school_origin')
                            ->label('7. Asal Sekolah (SMP/MTs)')
                            ->maxLength(200)
                            ->columnSpanFull(),
                        
                        Forms\Components\TextInput::make('student_phone')
                            ->label('13. Nomor HP Siswa (WA Aktif)')
                            ->tel()
                            ->maxLength(20),
                    ]),

                // ========================================
                // SECTION 3: DATA ORANG TUA & KK
                // ========================================
                Forms\Components\Section::make('Data Orang Tua & Kartu Keluarga')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('kk_number')
                            ->label('9. Nomor Kartu Keluarga')
                            ->maxLength(16)
                            ->helperText('16 digit angka'),
                        
                        Forms\Components\TextInput::make('parent_name')
                            ->label('10. Nama Ayah / Ibu')
                            ->maxLength(150),
                        
                        Forms\Components\Textarea::make('parent_address')
                            ->label('11. Alamat Orang Tua')
                            ->rows(2)
                            ->columnSpanFull(),
                        
                        Forms\Components\TextInput::make('parent_job')
                            ->label('12. Pekerjaan Ortu')
                            ->maxLength(100),
                        
                        Forms\Components\TextInput::make('parent_phone')
                            ->label('14. Nomor HP Orang Tua')
                            ->tel()
                            ->maxLength(20),
                    ]),

                // ========================================
                // SECTION 4: VERIFIKASI (ADMIN ONLY)
                // ========================================
                Forms\Components\Section::make('Verifikasi (Admin)')
                    ->columns(3)
                    ->schema([
                        Forms\Components\Select::make('ppdb_period_id')
                            ->label('Periode PPDB')
                            ->relationship('period', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->disabled(fn ($record) => $record?->exists),
                        
                        Forms\Components\TextInput::make('registration_code')
                            ->label('Nomor Pendaftaran')
                            ->disabled()
                            ->dehydrated(false),
                        
                        Forms\Components\Select::make('status')
                            ->label('Status Pendaftaran')
                            ->options(RegistrationStatus::toSelectArray())
                            ->required()
                            ->native(false),
                        
                        Forms\Components\TextInput::make('received_by')
                            ->label('15. Penerima Pendaftaran')
                            ->maxLength(100)
                            ->helperText('Nama petugas yang menerima'),
                        
                        Forms\Components\Toggle::make('files_submitted')
                            ->label('16. Berkas Sudah Dikumpulkan?')
                            ->onIcon('heroicon-m-check')
                            ->offIcon('heroicon-m-x-mark')
                            ->onColor('success')
                            ->offColor('danger'),
                        
                        Forms\Components\Textarea::make('notes')
                            ->label('Catatan Admin')
                            ->rows(2)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('registration_code')
                    ->label('Kode')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->weight('bold'),
                
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable()
                    ->limit(30),
                
                Tables\Columns\TextColumn::make('nisn')
                    ->label('NISN')
                    ->searchable()
                    ->toggleable(),
                
                Tables\Columns\TextColumn::make('school_origin')
                    ->label('Asal Sekolah')
                    ->searchable()
                    ->limit(25)
                    ->toggleable(),
                
                Tables\Columns\IconColumn::make('files_submitted')
                    ->label('Berkas')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (RegistrationStatus $state) => $state->getLabel())
                    ->color(fn (RegistrationStatus $state) => $state->getColor())
                    ->icon(fn (RegistrationStatus $state) => $state->getIcon()),
                
                Tables\Columns\TextColumn::make('period.name')
                    ->label('Periode')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tgl Daftar')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('ppdb_period_id')
                    ->label('Periode')
                    ->relationship('period', 'name'),
                
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options(RegistrationStatus::toSelectArray()),
                
                Tables\Filters\TernaryFilter::make('files_submitted')
                    ->label('Berkas Dikumpulkan'),
                
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    
                    // Quick Status Actions
                    Tables\Actions\Action::make('verify')
                        ->label('Verifikasi')
                        ->icon('heroicon-o-check-circle')
                        ->color('info')
                        ->requiresConfirmation()
                        ->visible(fn (PpdbRegistration $record) => $record->status === RegistrationStatus::PENDING)
                        ->action(fn (PpdbRegistration $record) => $record->verify(auth()->id())),
                    
                    Tables\Actions\Action::make('accept')
                        ->label('Terima')
                        ->icon('heroicon-o-check-badge')
                        ->color('success')
                        ->requiresConfirmation()
                        ->visible(fn (PpdbRegistration $record) => $record->status === RegistrationStatus::VERIFIED)
                        ->action(fn (PpdbRegistration $record) => $record->accept()),
                    
                    Tables\Actions\Action::make('reject')
                        ->label('Tolak')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->modalHeading('Tolak Pendaftaran')
                        ->form([
                            Forms\Components\Textarea::make('reason')
                                ->label('Alasan Penolakan')
                                ->required(),
                        ])
                        ->visible(fn (PpdbRegistration $record) => in_array($record->status, [RegistrationStatus::PENDING, RegistrationStatus::VERIFIED]))
                        ->action(fn (PpdbRegistration $record, array $data) => $record->reject($data['reason'])),
                    
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\RestoreAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Informasi Pendaftaran')
                    ->columns(3)
                    ->schema([
                        Infolists\Components\TextEntry::make('registration_code')
                            ->label('Nomor Pendaftaran')
                            ->weight('bold')
                            ->copyable(),
                        Infolists\Components\TextEntry::make('period.name')
                            ->label('Periode'),
                        Infolists\Components\TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->formatStateUsing(fn (RegistrationStatus $state) => $state->getLabel())
                            ->color(fn (RegistrationStatus $state) => $state->getColor()),
                    ]),
                
                Infolists\Components\Section::make('Data Pribadi Siswa')
                    ->columns(2)
                    ->schema([
                        Infolists\Components\TextEntry::make('full_name')
                            ->label('Nama Lengkap'),
                        Infolists\Components\TextEntry::make('gender')
                            ->label('Jenis Kelamin'),
                        Infolists\Components\TextEntry::make('birth_info')
                            ->label('TTL'),
                        Infolists\Components\TextEntry::make('religion')
                            ->label('Agama'),
                        Infolists\Components\TextEntry::make('nisn')
                            ->label('NISN'),
                        Infolists\Components\TextEntry::make('nik')
                            ->label('NIK'),
                    ]),
                
                Infolists\Components\Section::make('Kontak & Asal Sekolah')
                    ->columns(2)
                    ->schema([
                        Infolists\Components\TextEntry::make('school_origin')
                            ->label('Asal Sekolah'),
                        Infolists\Components\TextEntry::make('student_phone')
                            ->label('HP Siswa'),
                    ]),
                
                Infolists\Components\Section::make('Data Orang Tua')
                    ->columns(2)
                    ->schema([
                        Infolists\Components\TextEntry::make('kk_number')
                            ->label('No. KK'),
                        Infolists\Components\TextEntry::make('parent_name')
                            ->label('Nama Ortu'),
                        Infolists\Components\TextEntry::make('parent_job')
                            ->label('Pekerjaan'),
                        Infolists\Components\TextEntry::make('parent_phone')
                            ->label('HP Ortu'),
                        Infolists\Components\TextEntry::make('parent_address')
                            ->label('Alamat')
                            ->columnSpanFull(),
                    ]),
                
                Infolists\Components\Section::make('Verifikasi')
                    ->columns(3)
                    ->schema([
                        Infolists\Components\TextEntry::make('received_by')
                            ->label('Penerima'),
                        Infolists\Components\IconEntry::make('files_submitted')
                            ->label('Berkas'),
                        Infolists\Components\TextEntry::make('notes')
                            ->label('Catatan')
                            ->placeholder('Tidak ada catatan'),
                    ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\DocumentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPpdbRegistrations::route('/'),
            'create' => Pages\CreatePpdbRegistration::route('/create'),
            'view' => Pages\ViewPpdbRegistration::route('/{record}'),
            'edit' => Pages\EditPpdbRegistration::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
    
    public static function getNavigationBadge(): ?string
    {
        $count = static::getModel()::pending()->count();
        return $count > 0 ? (string) $count : null;
    }
    
    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }
}
