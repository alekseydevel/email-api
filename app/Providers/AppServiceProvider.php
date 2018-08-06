<?php

namespace App\Providers;

use App\Repository\ThemeRepository;
use App\Services\EmailSender;
use App\Services\RabbitProducer;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(EmailSender::class, function() {
            return new EmailSender(new RabbitProducer, new ThemeRepository);
        });
    }
}
