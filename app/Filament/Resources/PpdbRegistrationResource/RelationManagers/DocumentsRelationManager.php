<?php

declare(strict_types=1);

namespace App\Filament\Resources\PpdbRegistrationResource\RelationManagers;

use App\Enums\DocumentType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class DocumentsRelationManager extends RelationManager
{
    protected static string $relationship = 'documents';

    protected static ?string $title = 'Dokumen Persyaratan';

    protected static ?string $modelLabel = 'Dokumen';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('type')
                    ->label('Jenis Dokumen')
                    ->options(DocumentType::toSelectArray())
                    ->required()
                    ->native(false)
                    ->helperText(fn ($state) => $state ? DocumentType::from($state)->getDescription() : null),
                
                Forms\Components\FileUpload::make('file_path')
                    ->label('File')
                    ->required()
                    ->directory('ppdb/documents')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'application/pdf'])
                    ->maxSize(2048)
                    ->imagePreviewHeight('150')
                    ->storeFileNamesIn('original_name'),
                
                Forms\Components\Toggle::make('is_verified')
                    ->label('Terverifikasi')
                    ->default(false),
                
                Forms\Components\Textarea::make('rejection_reason')
                    ->label('Alasan Penolakan')
                    ->visible(fn ($get) => !$get('is_verified'))
                    ->rows(2),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->label('Jenis')
                    ->formatStateUsing(fn (DocumentType $state) => $state->getLabel())
                    ->icon(fn (DocumentType $state) => $state->getIcon())
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('original_name')
                    ->label('Nama File')
                    ->limit(30),
                
                Tables\Columns\TextColumn::make('formatted_file_size')
                    ->label('Ukuran'),
                
                Tables\Columns\IconColumn::make('is_verified')
                    ->label('Verified')
                    ->boolean(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Diupload')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_verified')
                    ->label('Status Verifikasi'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Upload Dokumen'),
            ])
            ->actions([
                Tables\Actions\Action::make('preview')
                    ->label('Lihat')
                    ->icon('heroicon-o-eye')
                    ->url(fn ($record) => $record->file_url)
                    ->openUrlInNewTab(),
                
                Tables\Actions\Action::make('verify')
                    ->label('Verifikasi')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => !$record->is_verified)
                    ->action(fn ($record) => $record->verify(auth()->id())),
                
                Tables\Actions\Action::make('reject')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->form([
                        Forms\Components\Textarea::make('reason')
                            ->label('Alasan')
                            ->required(),
                    ])
                    ->action(fn ($record, array $data) => $record->reject(auth()->id(), $data['reason'])),
                
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
