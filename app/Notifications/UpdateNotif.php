<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UpdateNotif extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
     protected $msg;
     protected $username;
     protected $credentials;
     protected $subject;
     public function __construct($subject,$msg,$username,$credentials)
     {
       $this->msg          = $msg;
       $this->username     = $username;
       $this->credentials  = $credentials;
       $this->subject      = $subject;

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
      return (new MailMessage)
                  ->subject($this->subject)
                  ->greeting(' Hello! ' . $this->username)
                  ->line($this->msg)
                  ->line('Below is your new password. Please do not share it to anyone.')
                  ->line('"' .$this->credentials.'"')
                  ->line('Thank you for using our application!');

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
