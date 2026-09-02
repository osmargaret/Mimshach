<?php

namespace App\Notifications;

use App\Models\ConsultationRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ConsultationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public ConsultationRequest $consultationRequest) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $programmes = is_array($this->consultationRequest->programme_of_interest)
            ? implode(', ', $this->consultationRequest->programme_of_interest)
            : (string) $this->consultationRequest->programme_of_interest;

        $countries = is_array($this->consultationRequest->preferred_countries)
            ? implode(', ', $this->consultationRequest->preferred_countries)
            : (string) $this->consultationRequest->preferred_countries;

        $educationLabels = [
            'high_school' => 'High School',
            'bachelor' => "Bachelor's Degree",
            'master' => "Master's Degree",
            'phd' => 'PhD / Doctorate',
            'diploma' => 'Diploma',
        ];

        $education = $educationLabels[$this->consultationRequest->level_of_education]
            ?? ucwords(str_replace('_', ' ', (string) $this->consultationRequest->level_of_education));

        return (new MailMessage)
            ->subject('New Consultation Request: '.$this->consultationRequest->name)
            ->greeting('Hello Admissions Team,')
            ->line('A new consultation request has been submitted on Mimshach.')
            ->line('**Applicant Name:** '.$this->consultationRequest->name)
            ->line('**Email Address:** '.$this->consultationRequest->email)
            ->line('**Phone Number:** '.$this->consultationRequest->phone)
            ->line('**Level of Education:** '.$education)
            ->line('**Programmes of Interest:** '.$programmes)
            ->line('**Preferred Countries:** '.$countries)
            ->line('**Tuition Budget:** $'.number_format((float) $this->consultationRequest->tuition_budget))
            ->action('Reply to '.$this->consultationRequest->name, 'mailto:'.$this->consultationRequest->email)
            ->line('Please review and follow up with the applicant as soon as possible.')
            ->salutation('Regards, Mimshach Education Consultancy');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'id' => $this->consultationRequest->id,
            'name' => $this->consultationRequest->name,
            'email' => $this->consultationRequest->email,
            'phone' => $this->consultationRequest->phone,
            'level_of_education' => $this->consultationRequest->level_of_education,
            'programme_of_interest' => $this->consultationRequest->programme_of_interest,
            'preferred_countries' => $this->consultationRequest->preferred_countries,
            'tuition_budget' => $this->consultationRequest->tuition_budget,
        ];
    }
}
