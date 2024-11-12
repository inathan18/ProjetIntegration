<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Events\Verified;
use App\Listeners\SendWelcomeEmail;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
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

        VerifyEmail::toMailUsing(function (object $notifiable, string $url){
            return (new MailMessage)
            ->greeting('Bonjour, ' . $notifiable->name . ' !')
            ->subject('Validation de votre adresse courriel')
            ->line('Cliquer sur le bouton ci-dessous pour valider votre adresse courriel.')
            ->action('Valider votre adresse courriel', $url);
        });

        VerifyEmail::createUrlUsing(function($notifiable){
            $verifyUrl = URL::temporarySignedRoute(
                'verification.verify',
                Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
                [
                    'id' => $notifiable->getKey(),
                    'hash' => sha1($notifiable->getEmailForVerification()),
                ]
                );
                return /*'http://127.0.0.1:8000/email/verify?verify_url=' . */$verifyUrl;
        });
    }

    public function handle(Verified $event){

    }

}
