<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Appointments;

use App\Mail\AppointmentMail;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Mail;

use Twilio\Rest\Client;

use Illuminate\Support\Facades\View;

class AppointmentController extends Controller
{
    // fetch appointment page 

    public function __construct(){
    
    }

    public function index(){
        return view('appointment');
    }

    public function save_appointment(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'patient_name' => ['required', 'string', 'max:255'],
        'patient_email' => ['required', 'string', 'max:255'],
        'patient_appointment_time' => ['required', 'date_format:H:i'],
        'patient_appointment_date' => ['required', 'date'],
        'patient_subject' => ['required', 'string', 'max:255'],
    ]);

    // Create a new appointment record in the database
    $prescription = Appointments::create([
        'patient_name' => $request->patient_name,
        'patient_email' => $request->patient_email,
        'patient_appointment_time' => $request->patient_appointment_time,
        'patient_appointment_date' => $request->patient_appointment_date,
        'user_id' => Auth()->user()->id,
        'code' => Str::random(8),
        'patient_subject' => $request->patient_subject,
    ]);

    // Prepare data for email and SMS notifications
    $applicantName = Auth()->user()->name ?? 'N/A';
    $applicantEmail = Auth()->user()->email ?? 'N/A';

    $appointment_details = [
        'patient_name' => $request->patient_name,
        'patient_email' => $request->patient_email,
        'patient_appointment_time' => $request->patient_appointment_time,
        'patient_appointment_date' => $request->patient_appointment_date,
        'patient_subject' => $request->patient_subject,
        'applicant_name' => $applicantName,
        'applicant_email' => $applicantEmail,
    ];

    // Render the email body HTML using a Blade view (adjust the view name accordingly)
    // $body_html = View::make('mails.appointment', compact('appointment_details'))->render();

    // Make an API call to send the email
    $from = getenv('MAIL_FROM_ADDRESS');
    $from_name = getenv('MAIL_FROM_NAME');
    $patient_subject = $request->patient_subject;
    $patient_email = $request->patient_email;

    $twilioController = new TwilioServiceController();
    
    $emailContent = $twilioController->generateEmailAppointmentBody($appointment_details);

    // Call the send_email function
    // $send_email = $twilioController->send_email($subject, $from, $from_name, $to, $emailContent);


    $send_email = $twilioController->send_email($patient_subject, $from, $from_name, $patient_email,$emailContent);

    $send_email_two = $twilioController->send_email($patient_subject, $from, $from_name, $applicantEmail,$emailContent);


    // return $send_email;

    // Check the response of the email sending process
    if (!$send_email) {
        toastr()->error('Email could not be sent, Try again later');
        return redirect()->back();
    }

    toastr()->info('Email has been sent successfully.');

    // Uncomment the following lines if you want to send SMS notifications
    // $receiver = Auth()->user()->phone;
    // $message = 'Hello ' . auth()->user()->name . ', Your ' . $request->patient_subject . ' appointment has been scheduled for ' . date('l jS F Y g:ia', strtotime($request->patient_appointment_date . ' ' . $request->patient_appointment_time));
    // $sendSms = $twilioController->send_sms($receiver, $message);

    // // Check the response of the SMS sending process (uncomment if needed)
    // if (!$sendSms) {
    //     toastr()->error('SMS could not be sent, Try again later');
    // }

    // Check if the appointment was successfully booked
    if (!$prescription) {
        toastr()->error('Appointment could not be booked, Try again later');
        return redirect()->back();
    }

    // Display success messages
    toastr()->success('Appointment Booked Successfully');
    toastr()->success('Appointment Confirmation Email sent successfully');

    return redirect()->back();
}
}
