<?php

namespace Hasob\FoundationCore\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Hasob\FoundationCore\Models\Relationship;

class RelationshipUpdatedNotification extends Notification
{

    use Queueable;


    public $relationship;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Relationship $relationship)
    {
        $this->relationship = $relationship;
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
        return (new MailMessage)->subject('Relationship updated successfully')
                                ->markdown(
                                    'mail.relationships.updated',
                                    ['relationship' => $this->relationship]
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
