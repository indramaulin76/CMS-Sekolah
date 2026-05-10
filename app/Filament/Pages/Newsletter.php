<?php

namespace App\Filament\Pages;

use App\Mail\NewsletterMail;
use App\Models\NewsletterSubscriber;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Mail;

class Newsletter extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationGroup = 'Pengaturan';
    protected static ?string $navigationLabel = 'Newsletter';
    protected static ?string $title = 'Kelola Newsletter';
    protected static string $view = 'filament.pages.newsletter';
    protected static ?int $navigationSort = 3;

    public ?array $data = [];
    public array $subscribers = [];

    public function mount(): void
    {
        $this->subscribers = NewsletterSubscriber::all()->toArray();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('subject')
                    ->label('Judul Email')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('content')
                    ->label('Isi Konten')
                    ->required()
                    ->rows(10)
                    ->helperText('Tulis konten newsletter di sini.'),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('send')
                ->label('Kirim Newsletter')
                ->submit('send'),
        ];
    }

    public function send(): void
    {
        $data = $this->form->getState();

        $subscribers = NewsletterSubscriber::all();

        if ($subscribers->isEmpty()) {
            Notification::make()
                ->warning()
                ->title('Tidak ada subscriber')
                ->body('Belum ada email yang terdaftar.')
                ->send();
            return;
        }

        $count = 0;
        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email)->send(
                new NewsletterMail($data['subject'], $data['content'])
            );
            $count++;
        }

        $this->form->fill();

        Notification::make()
            ->success()
            ->title("Newsletter berhasil dikirim ke {$count} subscriber!")
            ->send();
    }
}
