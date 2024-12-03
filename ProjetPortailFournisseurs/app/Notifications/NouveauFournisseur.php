<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Fournisseur;
use App\Models\NotificationTemplate;
use Illuminate\Support\Facades\Log;

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
        $content = NotificationTemplate::where('type', 'nouveauFournisseur')->first();
        Log::Debug($content);
        $subject = $content ? $content->subject : 'Nouveau fournisseur inscrit.';
        $line1 = $content ? $content->line1 : 'Un nouveau fournisseur s\'est inscrit sur le portail.';
        $line2 = $content ? $content->line2 : 'Merci de prendre en charge la demande.';
        return (new MailMessage)
                    //->subject('Nouveau fournisseur inscrit.')
                    ->subject($subject)
                    //->line('Un nouveau fournisseur s\'est inscrit sur le portail.')
                    ->line($line1)
                    ->line('Nom du fournisseur: ' . $this->fournisseur->name)
                    ->line('Courriel du fournisseur: ' . $this->fournisseur->email)
                    ->action('Voir la fiche du fournisseur', url('/fournisseur/' . $this->fournisseur->id))
                    //->line('Merci de prendre en charge la demande.');
                    ->line($line2);

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
