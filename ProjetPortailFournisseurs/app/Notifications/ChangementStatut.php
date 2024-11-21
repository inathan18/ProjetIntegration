<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ChangementStatut extends Notification
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
        $mail = (new MailMessage)
        ->greeting('Bonjour, ' . $notifiable->name . ' !')
        ->subject('Changement à votre statut de fournisseur')
        ->line('Votre statut de fournisseur a été modifié sur votre profil fournisseur.');
            if ($notifiable->statut == 'A' ){
                $mail->line('Nouveau statut: Actif');
            }
            elseif ($notifiable->statut == 'AR') {
                $mail->line('Nouveau statut: En Révision');
            }
            elseif ($notifiable->statut == 'AT') {
                $mail->line('Nouveau statut: En Attente');
            }
            elseif ($notifiable->statut == 'R') {
                $mail->line('Nouveau statut: Refusé');
            }
        
        $mail->action('Accédez à mon dossier', url('/fournisseur/monDossier'));
        $mail->line('Merci de votre collaboration!');
        return $mail;

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
