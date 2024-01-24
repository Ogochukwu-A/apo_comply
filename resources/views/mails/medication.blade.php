<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <div class="container text-start">
        {{-- <img src="https://placekitten.com/100/100" alt="Company Logo" class="logo"> --}}
        <!-- Replace with your company logo URL -->
        <h1>{{ str_replace('-', ' ', config('app.name')) }}</h1>
        <p> Hello {{ $patient_name }},</p>

        <p>This is reminder to take your medication</p>


        <p><strong>Medication Name:</strong> {{ $medication_name }}</p>

        {{-- 'medication_name' => $medication_name,
                'medication_code' => $medication_code,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'daily_time' => $applicantName,
                'patient_email' => Auth()->user()->email,
                'medication_frequency' => $patientSubject, --}}


        <p>Thank you for choosing our service.</p>

        <p>Best regards,<br>{{ str_replace('-', ' ', config('app.name')) }}</p>
    </div>
</body>

</html>
