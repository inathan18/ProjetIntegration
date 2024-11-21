<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Fournisseur;

class NouveauFournisseur extends Notification
{
    use Queueable;
    protected $fournisseur;

    /**
     * Create a new notification instance.
     */
    public function __construct(Fournisseur $fournisseur)
    {
        $this->fournisseur = $fournisseur;
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
        return (new MailMessage)
                    ->subject('Nouveau fournisseur inscrit.')
                    ->line('Un nouveau fournisseur s\'est inscrit sur le portail.')
                    ->line('Nom du fournisseur: ' . $this->fournisseur->name)
                    ->line('Courriel du fournisseur: ' . $this->fournisseur->email)
                    ->action('Voir la fiche du fournisseur', url('/fournisseur/' . $this->fournisseur->id))
                    ->line('Merci de prendre en charge la demande.');

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
