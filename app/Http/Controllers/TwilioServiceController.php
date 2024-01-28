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
}
