<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Prescriptions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\MedicationEmail;
use App\Http\Controllers\TwilioServiceController;

class MedicationEmailCronJob extends Command
{
    protected $signature = 'app:medication-email-cron-job {user_id}';
    protected $description = 'Send emails / sms for each prescription';

    public function handle()
    {
        $userId = $this->argument('user_id');

        if (!$userId) {
            $this->error('User ID not provided.');
            return;
        }

        // Retrieve user details outside the loop
        $user = User::find($userId);

        if (!$user) {
            $this->error('User not found.');
            return;
        }

        $user_email = $user->email;
        $user_name = $user->name;

        $userPrescriptions = Prescriptions::where('user_id', $userId)->get();

        foreach ($userPrescriptions as $prescription) {
            $start_date = $prescription->start_date;
            $end_date = $prescription->end_date;
            $daily_time = $prescription->daily_time;
            $medication_frequency = $prescription->medication_frequency;

            $prescription->email = $user_email ?? null;
            $prescription->name = $user_name ?? null;

            // dd($prescription);

            if (now()->between($start_date, $end_date)) {
                // Check if the end date is less than or equal to today's date
                if (now()->greaterThan($end_date)) {
                    $this->info('Prescription period has ended for ' . $prescription->medication_name);
                    continue; // Skip to the next prescription
                }

                if ($daily_time) {
                    $dailyTimeToCompare = now()->setTimeFromTimeString($daily_time);
                    if (now()->greaterThanOrEqualTo($dailyTimeToCompare)) {
                        $this->sendMedicationEmail($prescription);
                    }
                } else {
                    switch ($medication_frequency) {
                        case 'once_daily':
                            $this->sendMedicationEmail($prescription);
                            break;

                        case 'twice_daily':
                            $this->sendMedicationEmail($prescription);
                            $this->sendMedicationEmail($prescription, 12);
                            break;

                        case 'thrice_daily':
                            $this->sendMedicationEmail($prescription);
                            $this->sendMedicationEmail($prescription, 6);
                            $this->sendMedicationEmail($prescription, 12);
                            break;

                        case 'once_eight_hours':
                            $this->sendMedicationEmail($prescription);
                            $this->sendMedicationEmail($prescription, 8);
                            break;

                        default:
                            // Handle other cases if needed
                            break;
                    }
                }
            }
        }

        $this->info('Your cron job has run successfully!');
    }

    private function sendMedicationEmail($prescription, $hoursLater = 0)
    {
        $from = getenv('MAIL_FROM_ADDRESS');
        $from_name = getenv('MAIL_FROM_NAME');
        
        $email = $prescription->email;
    
        $scheduledTime = now()->addHours($hoursLater);

        $twilioController = new TwilioServiceController();
    
        $emailContent = $twilioController->generateEmailMedicationBody($prescription);
        
        $subject = "Medication Reminder";
        
        $send_email = $twilioController->send_email($subject, $from, $from_name, $email,$emailContent);

        // $prescription->email = $user_email ?? null;
        
        // Mail::to($prescription->email)->later($scheduledTime, new MedicationEmail($prescription));

        $twilioController = new TwilioServiceController();
        $sendSms = $twilioController->send_sms($prescription->phone, 'Your SMS message here');
    }
}
