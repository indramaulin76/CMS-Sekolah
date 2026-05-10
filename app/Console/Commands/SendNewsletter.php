<?php

namespace App\Console\Commands;

use App\Mail\NewsletterMail;
use App\Models\NewsletterSubscriber;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendNewsletter extends Command
{
    protected $signature = 'newsletter:send
                            {subject : Judul email}
                            {content : Isi konten email}';

    protected $description = 'Kirim newsletter ke semua subscriber';

    public function handle(): int
    {
        $subject = $this->argument('subject');
        $content = $this->argument('content');

        $subscribers = NewsletterSubscriber::all();

        if ($subscribers->isEmpty()) {
            $this->warn('Tidak ada subscriber.');
            return Command::SUCCESS;
        }

        $bar = $this->output->createProgressBar($subscribers->count());
        $bar->start();

        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email)->send(new NewsletterMail($subject, $content));
            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info("Newsletter berhasil dikirim ke {$subscribers->count()} subscriber.");

        return Command::SUCCESS;
    }
}
