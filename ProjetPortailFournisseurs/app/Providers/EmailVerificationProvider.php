<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Events\Verified;
use App\Listeners\SendWelcomeEmail;
use Illuminate\Support\Facades\Event;

class EmailVerificationProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    protected $listen = [
        Verified::class => [
            SendWelcomeEmail::class,
        ]
        ];
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        parent::boot();
        VerifyEmail::toMailUsing(function (object $notifiable, string $url){
            return (new MailMessage)
            ->subject('Validation de votre adresse courriel')
            ->line('Cliquer sur le bouton ci-dessous pour valider votre adresse courriel.')
            ->action('Valider votre adresse courriel', $url);
        });
    }

    public function handle(Verified $event){

    }

}
