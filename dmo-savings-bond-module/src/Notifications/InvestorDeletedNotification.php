<?php


namespace DMO\SavingsBond\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use DMO\SavingsBond\Models\Investor;

class InvestorDeletedNotification extends Notification
{

    use Queueable;


    public $investor;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Investor $investor)
    {
        $this->investor = $investor;
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
        return (new MailMessage)->subject('Investor deleted successfully')
                                ->markdown(
                                    'mail.investors.deleted',
                                    ['investor' => $this->investor]
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
