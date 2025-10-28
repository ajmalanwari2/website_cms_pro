<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $title;
    protected $message;
    protected $request_employee_id;
    protected $leave_id;
    protected $createdBy;
    protected $urlLink;

    public function __construct($title, $message, $request_employee_id, $leave_id, $createdBy, $urlLink)
    {
        $this->title = $title;
        $this->message = $message;
        $this->request_employee_id = $request_employee_id;
        $this->leave_id = $leave_id;
        $this->createdBy = $createdBy;
        $this->urlLink = $urlLink;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray(object $notifiable): array
    {
        return [
            'request_employee_id' => $this->request_employee_id,
            'leave_id' => $this->leave_id,
            'title' => $this->title,
            'message' => $this->message,
            'created_at' => now(),
            'created_by' => $this->createdBy,
            'url' => $this->urlLink
        ];
    }
}
