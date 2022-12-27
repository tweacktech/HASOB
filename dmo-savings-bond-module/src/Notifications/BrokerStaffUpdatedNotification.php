<?php

namespace DMO\SavingsBond\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use DMO\SavingsBond\Models\BrokerStaff;

class BrokerStaffUpdatedNotification extends Notification
{

    use Queueable;


    public $brokerStaff;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(BrokerStaff $brokerStaff)
    {
        $this->brokerStaff = $brokerStaff;
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
        return (new MailMessage)->subject('BrokerStaff updated successfully')
                                ->markdown(
                                    'mail.brokerStaffs.updated',
                                    ['brokerStaff' => $this->brokerStaff]
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
