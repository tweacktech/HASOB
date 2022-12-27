<?php


namespace DMO\SavingsBond\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use DMO\SavingsBond\Models\Broker;

class BrokerCreatedNotification extends Notification
{

    use Queueable;


    public $broker;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Broker $broker)
    {
        $this->broker = $broker;
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
        return (new MailMessage)->subject('Broker created successfully')
                                ->markdown(
                                    'mail.brokers.created',
                                    ['broker' => $this->broker]
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
