<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MedicationEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    public $prescription;

    public function __construct($prescription)
    {
        //

        $this->prescription = $prescription;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Medication Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {

        $medication_name = $this->prescription->medication_name;
        $medication_code = $this->prescription->code;
        $start_date = $this->prescription->start_date;
        $end_date = $this->prescription->end_date;
        $daily_time = $this->prescription->daily_time ?? 'N/A'; 
        $medication_frequency = $this->prescription->medication_frequency;
        $patient_email = $this->prescription->email;

        $patient_name = $this->prescription->name ?? 'N/A';

        return new Content(
            view: 'mails.medication',
            with: [
                'medication_name' => $medication_name,
                'medication_code' => $medication_code,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'daily_time' => $daily_time,
                'patient_email' => $patient_email,
                'medication_frequency' => $medication_frequency,
                'patient_name' => $patient_name
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
