<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RegisterEmail extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token,$login,$password)
    {

        $this->token = $token;
        $this->login = $login;
        $this->password = $password;
        
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
            ->subject('Добро пожаловать в "ОПТхимик"!')
            ->line('Поздравляем вас с успешной регистрацией на портале №1 химической промышленности России!')
            ->line('Логин: '.$this->login)
            ->line('Пароль: '.$this->password)
            ->action('Подтвердить Email', url('email/verify', $this->token))
            ->line('Если вы не регистрировались на нашем портале, никаких дальнейших действий не требуется.');
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
