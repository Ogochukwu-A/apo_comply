<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Appointments;

use App\Mail\AppointmentMail;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Mail;

use Twilio\Rest\Client;

class AppointmentController extends Controller
{
    // fetch appointment page 

    public function __construct(){
    
    }

    public function index(){
        return view('appointment');
    }

    public function save_appointment(Request $request){

        // patient_name,patient_email,patient_subject, patient_appointment_time, patient_appointment_date, patient_description

        $request->validate([
            'patient_name' => ['required', 'string', 'max:255'],
            'patient_email' => ['required', 'string', 'max:255'],
            'patient_appointment_time' => ['required', 'date_format:H:i'],
            'patient_appointment_date' => ['required', 'date'],
            'patient_subject' => ['required', 'string', 'max:255']
        ]);

        $prescription = Appointments::create([
            'patient_name' => $request->patient_name,
            'patient_email' => $request->patient_email,
            'patient_appointment_time' => $request->patient_appointment_time,
            'patient_appointment_date' => $request->patient_appointment_date,
            'user_id' => Auth()->user()->id,
            'code' => Str::random(8),
            'patient_subject' => $request->patient_subject,
        ]);


        $appointment_details = [
            'patient_name' => $request->patient_name,
            'patient_email' => $request->patient_email,
            'patient_appointment_time' => $request->patient_appointment_time,
            'patient_appointment_date' => $request->patient_appointment_date,
            'patient_subject' => $request->patient_subject,
        ];

        //  send email here 

        Mail::to($request->user())->send(new AppointmentMail($appointment_details));


        $receiver = Auth()->user()->phone; // Replace with the actual recipient's phone number

        $message = 'Hello ' . auth()->user()->name . 
            ', Your ' . $request->patient_subject . ' appointment with the doctor has been scheduled for ' . date('l jS F Y g:ia', strtotime($request->patient_appointment_date . ' ' . $request->patient_appointment_time ));

        // Create an instance of TwilioServiceController
        $twilioController = new TwilioServiceController();
        
        // Call the sendSms method on the instance
        $sendSms = $twilioController->send_sms($receiver, $message);

        if(!$sendSms){
            toastr()->error('SMS could not be sent, Try again later');
        }

        toastr()->info('SMS has been sent successfully.');

        // send SMS here too 

        if(!$prescription){
        
            toastr()->error('Appointment could not be booked, Try again later');
    
            return redirect()->back();
        }

        toastr()->success('Appointment Booked Successfully');

        toastr()->success('Appointment Confirmation Email sent successfully');

        return redirect()->back();
    }
}
