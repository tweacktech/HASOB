<?php


namespace Hasob\FoundationCore\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Hasob\FoundationCore\Models\SiteArtifact;

class SiteArtifactCreatedNotification extends Notification
{

    use Queueable;


    public $siteArtifact;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(SiteArtifact $siteArtifact)
    {
        $this->siteArtifact = $siteArtifact;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->subject('SiteArtifact created successfully')
                                ->markdown(
                                    'mail.siteArtifacts.created',
                                    ['siteArtifact' => $this->siteArtifact]
                                );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [];
    }

}
