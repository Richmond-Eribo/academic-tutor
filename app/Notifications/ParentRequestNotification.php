<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ParentRequestNotification extends Notification
{
    use Queueable;
    private $parent;
    private $teacher;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($parent, $teacher)
    {
        $this->parent = $parent;
        $this->teacher = $teacher;
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
            ->subject('Parent Request!')
            ->greeting('Hello, Admin')
            ->line('This is to notify you that a Parent has made a request for a Teacher')
            ->line('Parent details below:')
            ->line('Name: ' . $this->parent->name)
            ->line('Email: ' . $this->parent->email)
            ->line('Phone: ' . $this->parent->phone)
            ->line('Teacher details below:')
            ->line('Name: ' . $this->teacher->name)
            ->line('Email: ' . $this->teacher->email)
            ->line('Phone: ' . $this->teacher->phone)
            ->line('Subjects: ' . json_decode($this->teacher->subject));
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
