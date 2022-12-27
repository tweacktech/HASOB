<?php


namespace Hasob\FoundationCore\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Hasob\FoundationCore\Models\Address;

class AddressCreatedNotification extends Notification
{

    use Queueable;


    public $address;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Address $address)
    {
        $this->address = $address;
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
        return (new MailMessage)->subject('Address created successfully')
                                ->markdown(
                                    'mail.addresses.created',
                                    ['address' => $this->address]
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
