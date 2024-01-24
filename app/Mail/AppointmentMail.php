<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Appointments;

class AppointmentMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    public $appointment_details;

    public function __construct($appointment_details)
    {
        // get the appointment details 
        $this->appointment_details = $appointment_details;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Appointment Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {

        $patientName = $this->appointment_details->name ?? 'N/A';
        $patientEmail = $this->appointment_details->email ?? 'N/A';
        $appointmentTime = $this->appointment_details->patient_appointment_time ?? 'N/A';
        $appointmentDate = $this->appointment_details->patient_appointment_date ?? 'N/A';
        $applicantName = Auth()->user()->name ?? 'N/A';
        $applicantEmail = Auth()->user()->email ?? 'N/A';
        $patientSubject = $this->appointment_details->patient_subject ?? 'N/A';
    
        return new Content(
            view: 'mails.appointment',
            with: [
                'patient_name' => $patientName,
                'patient_email' => $patientEmail,
                'patient_appointment_time' => $appointmentTime,
                'patient_appointment_date' => $appointmentDate,
                'applicant_name' => $applicantName,
                'applicant_email' => $applicantEmail,
                'patient_subject' => $patientSubject,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
