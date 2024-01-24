<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointments;
use App\Models\Prescriptions;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ReminderController extends Controller
{
    // handles all the reminder features 

    public function index(){

        $appointments = Appointments::all();

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
        // return $appointments;
        return view('reminder')->with(['appointments' => $appointments, 'prescriptions' => $get_user_prescriptions]);
    }
}
