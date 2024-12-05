<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\NotificationTemplate;
use Illuminate\Support\Facades\Log;

class ChangementFournisseur extends Notification
{
    use Queueable;
    protected $customSubject;
    protected $customLine1;
    protected $customLine2;

    

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {


        
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
        $content = NotificationTemplate::where('type', 'changementFournisseur')->first();
        Log::Debug($content);
        $subject = $content ? $content->subject : 'Changement à votre profil';
        $line1 = $content ? $content->line1 : 'Un modification a été effectué sur votre profil fournisseur.';
        $line2 = $content ? $content->line2 : 'Merci de votre collaboration!';
        return (new MailMessage)
                    ->greeting('Bonjour, ' . $notifiable->name . ' !')
                    //->subject('Changement à votre profil')
                    ->subject($subject)
                    //->line('Un modification a été effectué sur votre profil fournisseur.')
                    ->line($line1)
                    ->action('Accédez à mon dossier', url('/fournisseur/monDossier'))
                    //->line('Merci de votre collaboration!');
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
