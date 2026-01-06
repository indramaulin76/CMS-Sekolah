<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Enums\RegistrationStatus;
use App\Filament\Resources\PpdbAnnouncementResource\Pages;
use App\Models\PpdbRegistration;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PpdbAnnouncementResource extends Resource
{
    protected static ?string $model = PpdbRegistration::class;

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';

    protected static ?string $navigationLabel = 'Pengumuman PPDB';

    protected static ?string $modelLabel = 'Pengumuman';

    protected static ?string $pluralModelLabel = 'Pengumuman PPDB';

    protected static ?string $navigationGroup = 'PPDB';

    protected static ?int $navigationSort = 3;

    // Only show accepted registrations
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('status', RegistrationStatus::ACCEPTED)
            ->with('period');
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
                    ->weight('bold')
                    ->color('primary'),
                
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable()
                    ->weight('medium')
                    ->limit(30),
                
                Tables\Columns\TextColumn::make('nisn')
                    ->label('NISN')
                    ->searchable()
                    ->toggleable(),
                
                Tables\Columns\TextColumn::make('previous_school')
                    ->label('Asal Sekolah')
                    ->searchable()
                    ->limit(25)
                    ->toggleable(),
                
                Tables\Columns\TextColumn::make('period.name')
                    ->label('Periode')
                    ->sortable()
                    ->badge()
                    ->color('info'),
                
                Tables\Columns\TextColumn::make('period.academic_year')
                    ->label('Tahun Ajaran')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tgl Daftar')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(),
            ])
            ->defaultSort('full_name', 'asc')
            ->filters([
                Tables\Filters\SelectFilter::make('ppdb_period_id')
                    ->label('Periode')
                    ->relationship('period', 'name')
                    ->preload(),
                
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('from')
                            ->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('until')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                
                Tables\Actions\Action::make('print_acceptance')
                    ->label('Cetak Surat')
                    ->icon('heroicon-o-printer')
                    ->color('success')
                    ->url(fn (PpdbRegistration $record): string => route('ppdb.print', $record->registration_code))
                    ->openUrlInNewTab(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('export_excel')
                        ->label('Export Excel')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->color('success')
                        ->action(function ($records) {
                            // TODO: Implement Excel export
                            // For now, just a placeholder
                            return redirect()->back();
                        }),
                ]),
            ])
            ->emptyStateHeading('Belum Ada Siswa yang Diterima')
            ->emptyStateDescription('Siswa yang statusnya "Diterima" akan muncul di sini.')
            ->emptyStateIcon('heroicon-o-megaphone');
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Informasi Penerimaan')
                    ->icon('heroicon-o-check-badge')
                    ->columns(3)
                    ->schema([
                        Infolists\Components\TextEntry::make('registration_code')
                            ->label('Nomor Pendaftaran')
                            ->weight('bold')
                            ->size('lg')
                            ->color('primary')
                            ->copyable(),
                        Infolists\Components\TextEntry::make('period.name')
                            ->label('Periode')
                            ->badge()
                            ->color('info'),
                        Infolists\Components\TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->formatStateUsing(fn (RegistrationStatus $state) => $state->getLabel())
                            ->color(fn (RegistrationStatus $state) => $state->getColor()),
                    ]),
                
                Infolists\Components\Section::make('Data Pribadi')
                    ->icon('heroicon-o-user')
                    ->columns(2)
                    ->schema([
                        Infolists\Components\TextEntry::make('full_name')
                            ->label('Nama Lengkap')
                            ->weight('bold'),
                        Infolists\Components\TextEntry::make('gender')
                            ->label('Jenis Kelamin')
                            ->formatStateUsing(fn ($state) => $state === 'male' ? 'Laki-laki' : 'Perempuan'),
                        Infolists\Components\TextEntry::make('birth_place')
                            ->label('Tempat Lahir'),
                        Infolists\Components\TextEntry::make('birth_date')
                            ->label('Tanggal Lahir')
                            ->date('d F Y'),
                        Infolists\Components\TextEntry::make('religion')
                            ->label('Agama'),
                        Infolists\Components\TextEntry::make('nisn')
                            ->label('NISN')
                            ->weight('medium'),
                        Infolists\Components\TextEntry::make('nik')
                            ->label('NIK'),
                        Infolists\Components\TextEntry::make('kk_number')
                            ->label('No. KK'),
                    ]),
                
                Infolists\Components\Section::make('Kontak & Asal Sekolah')
                    ->icon('heroicon-o-phone')
                    ->columns(2)
                    ->schema([
                        Infolists\Components\TextEntry::make('previous_school')
                            ->label('Asal Sekolah')
                            ->columnSpanFull(),
                        Infolists\Components\TextEntry::make('phone')
                            ->label('HP Siswa'),
                        Infolists\Components\TextEntry::make('email')
                            ->label('Email')
                            ->placeholder('-'),
                    ]),
                
                Infolists\Components\Section::make('Data Orang Tua')
                    ->icon('heroicon-o-users')
                    ->columns(2)
                    ->schema([
                        Infolists\Components\TextEntry::make('parent_name')
                            ->label('Nama Orang Tua'),
                        Infolists\Components\TextEntry::make('parent_occupation')
                            ->label('Pekerjaan')
                            ->placeholder('-'),
                        Infolists\Components\TextEntry::make('parent_phone')
                            ->label('HP Orang Tua'),
                        Infolists\Components\TextEntry::make('parent_address')
                            ->label('Alamat')
                            ->columnSpanFull()
                            ->placeholder('-'),
                    ]),
                
                Infolists\Components\Section::make('Catatan')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        Infolists\Components\TextEntry::make('notes')
                            ->label('Catatan Admin')
                            ->placeholder('Tidak ada catatan')
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPpdbAnnouncements::route('/'),
            'view' => Pages\ViewPpdbAnnouncement::route('/{record}'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        $count = static::getModel()::where('status', RegistrationStatus::ACCEPTED)->count();
        return $count > 0 ? (string) $count : null;
    }
    
    public static function getNavigationBadgeColor(): ?string
    {
        return 'success';
    }
}
