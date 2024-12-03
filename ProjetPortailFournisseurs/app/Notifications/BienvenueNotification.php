<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Fournisseur;
use App\Models\NotificationTemplate;
use Illuminate\Support\Facades\Log;

class BienvenueNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $imagePath = public_path('images/logo.png');
        $imageCid = 'v3r-logo';
        $content = NotificationTemplate::where('type', 'bienvenue')->first();
        Log::Debug($content);
        $subject = $content ? $content->subject : 'Bienvenue';
        $line1 = $content ? $content->line1 : 'Bienvenue sur le Portail des fournisseurs de la ville de Trois-Rivières !';
        $line2 = $content ? $content->line2 : 'Merci de votre intérêt pour notre ville!';
        return (new MailMessage)
                    ->greeting('Bonjour, ' . $notifiable->name . ' !')
                    //->subject('Bienvenue')
                    ->subject($subject)
                    //->line('Bienvenue sur le Portail des fournisseurs de la ville de Trois-Rivières !')
                    ->line($line1)
                    ->action('Connexion au portail', url('/fournisseur/connexion'))
                    ->line($line2);
                    //->line('Merci de votre intérêt pour notre ville!');

    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
