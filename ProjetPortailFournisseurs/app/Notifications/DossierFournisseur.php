<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DossierFournisseur extends Notification
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
        return (new MailMessage)
                    ->subject('Demande de création de compte')
                    ->greeting('Bonjour')
                    ->line('Votre compte fournisseur est maintenant créé.')
                    ->line('Vous pouvez maintenant accéder au portail pour consulter le statut de votre demande.')
                    ->line('Vous recevrez aussi un courriel lorsque votre dossier sera traité.')
                    ->action('Notification Action', url('/'))
                    ->line('Merci de votre intérêt envers notre ville !');
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
