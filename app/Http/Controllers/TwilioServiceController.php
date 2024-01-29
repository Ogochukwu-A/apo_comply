<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Twilio\Rest\Client;

use Illuminate\Support\Facades\Http;

class TwilioServiceController extends Controller
{
    // Holds all Twilio services 

    // protected $twilio;

    // public function __construct(TwilioService $twilio)
    // {
    //     $this->twilio = $twilio;
    // }


    public static function sendMessage($message, $recipients)
    {
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_PHONE_NUMBER");
        $client = new Client($account_sid, $auth_token);
        $client->messages->create($recipients, 
                ['from' => $twilio_number, 'body' => $message] );
    }

    public function send_sms($receiver, $message){
  
        try {
  
            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_AUTH_TOKEN");
            $twilio_number = getenv("TWILIO_PHONE_NUMBER");

            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiver, [
                'from' => $twilio_number, 
                'body' => $message]);
                
            return true;
  
        } catch (Exception $e) {
            dd("Error: ". $e->getMessage());
        }
    }
    
    public function send_email($subject, $from, $from_name, $to, $content) {
    $sms_api_key = getenv('SMS_API_KEY');
    $sms_api_url = getenv('SMS_API_URL');

    $response = Http::get($sms_api_url, [
        'apikey' => $sms_api_key,
        'subject' => $subject,
        'from' => $from,
        'fromName' => $from_name,
        'to' => $to,
        'bodyHtml' => $content,
    ]);

    // return $response; 
    // Decode the JSON
    $responseData = json_decode($response, true);
    
    // Check if 'success' is true or false
    if (isset($responseData['success']) && $responseData['success'] === true) {
        return true;
    } else {
        return false;
    }
}

public function generateEmailAppointmentBody($appointment_details) {
    return "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Your Email Subject</title>
        </head>
        <body>
            <div>
                <h1>Hello {$appointment_details['patient_name']},</h1>
                <p>Your appointment has been confirmed. Here are the details:</p>
                <p><strong>Patient Name:</strong> {$appointment_details['patient_name']}</p>
                <p><strong>Patient Email:</strong> {$appointment_details['patient_email']}</p>
                <p><strong>Appointment Time:</strong> {$appointment_details['patient_appointment_time']}</p>
                <p><strong>Appointment Date:</strong> {$appointment_details['patient_appointment_date']}</p>
                <p><strong>Applicant Name:</strong> {$appointment_details['applicant_name']}</p>
                <p><strong>Applicant Email:</strong> {$appointment_details['applicant_email']}</p>
                <p><strong>Subject:</strong> {$appointment_details['patient_subject']}</p>
                <p>Thank you for choosing our service.</p>
                <p>Best regards,<br>Your Company Name</p>
            </div>
        </body>
        </html>
    ";
}

public function generateEmailMedicationBody($prescription) {
    return "
        <!DOCTYPE html>
        <html lang='en'>
        
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Your Medication Reminder Email</title>
            <style>
                /* Add your styles here */
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                    background-color: #f4f4f4;
                }
        
                .container {
                    width: 100%;
                    max-width: 600px;
                    margin: 0 auto;
                    padding: 20px;
                    background-color: #ffffff;
                    text-align: start;
                }
        
                .logo {
                    max-width: 100px;
                    margin-bottom: 20px;
                }
        
                h1 {
                    color: #333333;
                }
        
                p {
                    color: #666666;
                }
            </style>
        </head>
        
        <body>
            <div class='container text-start'>
                {{-- <img src='https://placekitten.com/100/100' alt='Company Logo' class='logo'> --}}
                <!-- Replace with your company logo URL -->
                <h1>{{ str_replace('-', ' ', config('app.name')) }}</h1>'
                
                <p> Hello {{$prescription['patient_name']}},</p>
    
                <p>This is a reminder to take your medication</p>
        
                <p><strong>Medication Name:</strong> {$prescription['medication_name']}</p>
        
                <p><strong>Start Date:</strong> {$prescription['start_date']}</p>
                <p><strong>End Date:</strong> {$prescription['end_date']}</p>
                <p><strong>Daily Time:</strong> {$prescription['daily_time']}</p>
                <p><strong>Medication Frequency:</strong> {$prescription['medication_frequency']}</p>
                
                <p>Thank you for choosing our service.</p>
        
                <p>Best regards,<br>{{ str_replace('-', ' ', config('app.name')) }}</p>
            </div>
        </body>
        
        </html>";
}
}
