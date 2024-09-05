<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AcceptationFournisseur extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct($fournisseur)
    {
        //
        $this->courriel = $fournisseur;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['email'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Statut de votre demande')
                    ->greeting('Bonjour')
                    ->line('Votre compte fournisseur a été accepté.')
                    ->action('Notification Action', url('/'))
                    ->line('Merci de faire partie de notre organisation !');
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
