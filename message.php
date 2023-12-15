<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['Name'];
    $email = $_POST['Email'];
    $subject = $_POST['Subject'];
    $message = $_POST['Message'];

    // Set up the recipient email address
    $to = "jcraven@siue.edu";

    // Set up the email headers
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Compose the email message
    $mailBody = "
        <html>
        <body>
            <h2>New Message from Website Contact Form</h2>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Subject:</strong> $subject</p>
            <p><strong>Message:</strong> $message</p>
        </body>
        </html>
    ";

    // Send the email
    mail($to, $subject, $mailBody, $headers);

    // Redirect back to the form with a success message
    header("Location: thankYou.php");
    exit();
} else {
    // Redirect back to the form with an error message
    header("Location: error.php");
    exit();
}
?>