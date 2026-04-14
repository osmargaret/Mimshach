<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactFormReceivedNotification extends Notification implements ShouldQueue
{
  use Queueable;
  public $data;

  public function __construct($data)
  {
    $this->data = $data;
  }

  public function via(object $notifiable): array
  {
    return ['mail'];
  }

  public function toMail(object $notifiable): MailMessage
  {
    return (new MailMessage())
      ->subject('New Contact Request Received: ' . ($this->data['subject'] ?? 'No subject provided'))
      ->greeting('Hello Admin,')
      ->line('A new message was submitted through the contact form.')
      ->line('**Name:** ' . $this->data['name'])
      ->line('**Email:** ' . $this->data['email'])
      ->line('**Subject:** ' . ($this->data['subject'] ?? 'No subject provided'))
      ->line('**Message:**')
      ->line($this->data['message'])
      ->action('Reply to ' . $this->data['name'], 'mailto:' . $this->data['email'])
      ->line('Please follow up with the sender as soon as possible.')
      ->salutation('Regards, Mimshach Education Centre');
  }

  /**
   * Get the array representation of the notification.
   *
   * @return array<string, mixed>
   */
  public function toArray(object $notifiable): array
  {
    return [
      //
    ];
  }
}
