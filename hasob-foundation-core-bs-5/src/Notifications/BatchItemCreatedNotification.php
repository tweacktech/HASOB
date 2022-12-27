<?php


namespace Hasob\FoundationCore\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Hasob\FoundationCore\Models\BatchItem;

class BatchItemCreatedNotification extends Notification
{

    use Queueable;


    public $batchItem;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(BatchItem $batchItem)
    {
        $this->batchItem = $batchItem;
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
        return (new MailMessage)->subject('BatchItem created successfully')
                                ->markdown(
                                    'mail.batchItems.created',
                                    ['batchItem' => $this->batchItem]
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
