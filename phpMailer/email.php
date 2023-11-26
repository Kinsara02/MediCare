<?php

require '../phpMailer/includes/PHPMailer.php';
require '../phpMailer/includes/Exception.php';
require '../phpMailer/includes/SMTP.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

$mail= new PHPMailer();

$mail->isSMTP();

$mail->Host= "smtp.gmail.com";

$mail->SMTPAuth= "true";

$mail->SMTPSecure= "tls";

$mail->PORT= "587";

$mail->Username= "bansalkinsara@gmail.com";

$mail->Password="Kb220702";

$mail->Subject= "Appointment Booking";

$mail->setFrom("bansalkinsara@gmail.com");

$mail->Body= "Plain text";

$mail->addAddress("bansalkinsara@gmail.com");

$mail->Send();

if($mail->Send()){
    echo "Email sent";
}
else{
    echo "No!";
}

$mail->smtpClose();


// // Create database connection
$conn = new mysqli("localhost","root","","edoc");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



// Process form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $patientName = $_POST["patient_name"];
    $doctorName = $_POST["doctor_name"];
    $appointmentTime = $_POST["appointment_time"];
    $googleMeetLink = $_POST["google_meet_link"];

    // Insert appointment into the database
    $sql = "INSERT INTO appointments (patient_name, doctor_name, appointment_time, google_meet_link)
            VALUES ('$patientName', '$doctorName', '$appointmentTime', '$googleMeetLink')";
    // if ($conn->query($sql) === false) {
    //     echo "Error: " . $sql . "<br>" . $conn->error;
    // } else {
    //     // Send email notification
    //     $to = "kinsarabansal@gmail.com";
    //     $subject = "Appointment Notification";
    //     $message = "Hello,\n\nYou have a new appointment scheduled.\n\n";
    //     $message .= "Patient Name: " . $patientName . "\n";
    //     $message .= "Doctor Name: " . $doctorName . "\n";
    //     $message .= "Appointment Time: " . $appointmentTime . "\n";
    //     $message .= "Google Meet Link: " . $googleMeetLink . "\n\n";
    //     $message .= "Please join the meeting using the provided Google Meet link.\n\n";
    //     $message .= "Regards,\nMediCare";

    //     $headers = "From: kinsarabansal@gmail.com";

    //     // Uncomment the line below to send the email
    //     //ini_set("sendmail_from", "kinsarabansal@gmail.com");
    //     ini_set('SMTP', 'kinsarabansal@gmail.com');
    //     ini_set('smtp_port', 587);
    //     if(mail($to, $subject, $message, $headers)) echo "Appointment scheduled successfully. Email notification sent.";
    // }
}
    
?>

<!DOCTYPE html>
<html>
<head>
    <title>Appointment Form</title>
</head>
<body>
    <h2>Appointment Form</h2>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="patient_name">Patient Name:</label><br>
        <input type="text" id="patient_name" name="patient_name" required><br><br>

        <label for="doctor_name">Doctor Name:</label><br>
        <input type="text" id="doctor_name" name="doctor_name" required><br><br>

        <label for="appointment_time">Appointment Time:</label><br>
        <input type="datetime-local" id="appointment_time" name="appointment_time" required><br><br>

        <label for="google_meet_link">Google Meet Link:</label>
        <input type="text" id="google_meet_link" name="google_meet_link" required><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
