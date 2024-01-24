<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prescriptions;
use App\Models\HealthMetrics;
use Illuminate\Support\Str;
use Carbon\Carbon;

class HealthInfoController extends Controller
{
    // handles all the health info functions 

    public function __construct(){
       
    }

    public function index(){

        // get all the prescriptions for the user 
        $user_id = Auth()->user()->id;
        $get_user_prescriptions = Prescriptions::where('user_id', $user_id)->latest()->simplePaginate(4);
       
        $format_dates = $get_user_prescriptions->map(function ($item) {
            // Assuming $item->start_date and $item->end_date are in Y-m-d format (e.g., "2023-08-02")
            $start_date = Carbon::parse($item->start_date);
            $end_date = Carbon::parse($item->end_date);

            // Format the start date as "2nd August 2023"
            $formatted_start_date = $start_date->format('jS F Y');

            // Format the end date as "2nd August 2023"
            $formatted_end_date = $end_date->format('jS F Y');

            // Add the formatted dates to the item as new attributes
            $item->formatted_start_date = $formatted_start_date;
            $item->formatted_end_date = $formatted_end_date;

            return $item;
        })->toArray();

        // return $get_user_prescriptions;

        if(!$get_user_prescriptions){
            toastr()->error('Prescription could not be fetched, Try again later');
        }

        // fetch the health metrics 

        $fetch_health_metrics = HealthMetrics::where('user_id', $user_id)->latest()->simplePaginate(5);

        // return ($fetch_health_metrics);
        
        // toastr()->success('Prescriptions fetched successfully');

        return view('healthinfo')->with(['prescriptions' => $get_user_prescriptions, 'healthmetrics' => $fetch_health_metrics]);
    }

    public function save_medication(Request $request){

        // medication_name, medication_mode, start_date, end_date, medication_frequency, daily_time

        $request->validate([
            'medication_name' => ['required', 'string', 'max:255'],
            'medication_mode' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'medication_frequency' => ['required', 'string', 'max:255']
        ]);


        // add sugar level, Pulse rates, blood pressure 

        // add the notice 

        // move the calendar to the top 

        // fix the sms 

        $prescription = Prescriptions::create([
            'medication_name' => $request->medication_name,
            'medication_mode' => $request->medication_mode,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date ?? null,
            'daily_time'=> $request->daily_time ?? null,
            'user_id' => Auth()->user()->id,
            'code' => Str::random(8),
            'medication_frequency' => $request->medication_frequency,
        ]);


        if(!$prescription){
        
            toastr()->error('Prescription could not be added, Try again later');
    
            return redirect()->back();
        }

        toastr()->success('Prescription Added Successfully');

        return redirect()->back();
    }

    public function update_prescription(Request $request){
        $request->validateWithBag('prescriptionUpdate', [
            'code' => ['required', 'string', 'max:255'],
            'medication_name' => ['required', 'string', 'max:255'],
            'medication_mode' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'medication_frequency' => ['required', 'string', 'max:255']
        ]);
    
        $code = $request->code;
    
        $prescription = Prescriptions::where('code', $code)->first();
    
        // dd($prescription);
        if (!$prescription) {
            toastr()->error('Sorry, Prescription could not be found');
            return redirect()->back();
        }
        
        $update_prescription = $prescription->update([
            'medication_name' => $request->medication_name,
            'medication_mode' => $request->medication_mode,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'daily_time' => $request->daily_time,
            'user_id' => auth()->user()->id,
            'medication_frequency' => $request->medication_frequency,
        ]);
    
        if (!$update_prescription) {
            toastr()->error('Prescription could not be updated');
            return redirect()->back();
        }
    
        toastr()->success('Prescription Updated Successfully');
        return redirect()->back();
    }
    

    public function remove_prescription(Request $request){

        $request->validateWithBag('prescriptionDeletion', [
            'code' => ['required', 'string', 'max:255']
        ]);

        $code = $request->code;

        $prescription = Prescriptions::where('code',$code);

        if(!$prescription){

            toastr()->error('Sorry Prescription could not be found');
    
            return redirect()->back();
        }


        $delete_prescription = $prescription->delete();

        // $title = 'Delete User!';
        // $text = "Are you sure you want to delete?";

        // confirmDelete($title, $text);


        if(!$delete_prescription){

            toastr()->error('Prescription could not be deleted');
    
            return redirect()->back();
        }

        toastr()->success('Prescription Deleted Successfully');
    
        return redirect()->back();
    }

    public function add_health_metrics(Request $request){

        // sugar_level, pulse_rate, blood_pressure_top_value, blood_pressure_bottom_value

        $request->validate([
            'sugar_level' => ['required', 'string', 'max:255'],
            'pulse_rate' => ['required', 'string', 'max:255'],
            'blood_pressure_top_value' => ['required', 'string', 'max:255'],
            'blood_pressure_bottom_value' => ['required', 'string', 'max:255']
        ]);


        // add sugar level, Pulse rates, blood pressure 

        // add the notice 

        // move the calendar to the top 

        // fix the sms 

        $health_metrics = HealthMetrics::create([
            'user_id' => Auth()->user()->id,
            'sugar_level' => $request->sugar_level,
            'pulse_rate' => $request->pulse_rate,
            'blood_pressure_top_value' => $request->blood_pressure_top_value,
            'blood_pressure_bottom_value' => $request->blood_pressure_bottom_value ?? null,
        ]);


        if(!$health_metrics){
        
            toastr()->error('Health Metrics could not be added, Try again later');
    
            return redirect()->back();
        }

        toastr()->success('Health Metrics Added Successfully');

        return redirect()->back();
    }
}
