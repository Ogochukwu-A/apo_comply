<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Email Subject</title>
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
        <p> Hello {{ $appointment_details['patient_name'] }},</p>

        <p>Your appointment has been confirmed. Here are the details:</p>


        <p><strong>Patient Name:</strong> {{ $appointment_details['patient_name'] }}</p>
        <p><strong>Patient Email:</strong> {{ $appointment_details['patient_email'] }}</p>
        <p><strong>Appointment Time:</strong> {{ $appointment_details['patient_appointment_time'] }}</p>
        <p><strong>Appointment Date:</strong> {{ $appointment_details['patient_appointment_date'] }}</p>
        <p><strong>Applicant Name:</strong> {{ $applicant_name }}</p>
        <p><strong>Applicant Email:</strong> {{ $applicant_email }}</p>
        <p><strong>Subject:</strong> {{ $appointment_details['patient_subject'] }}</p>


        <p>Thank you for choosing our service.</p>

        <p>Best regards,<br>{{ str_replace('-', ' ', config('app.name')) }}</p>
    </div>
</body>

</html>
