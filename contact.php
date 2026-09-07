<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit("Invalid request.");
}

$name = trim($_POST["name"] ?? "");
$email = trim($_POST["email"] ?? "");
$service = trim($_POST["service"] ?? "");
$message = trim($_POST["message"] ?? "");

if ($name === "" || $email === "" || $service === "" || $message === "") {
    exit("Please complete all required fields.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit("Please enter a valid email address.");
}

$to = "info@supportglobal-techdriver.com";

$subject = "New Support Request - SupportDigitalTech";

$body = "New support request received.\n\n";
$body .= "Name: " . $name . "\n";
$body .= "Email: " . $email . "\n";
$body .= "Service: " . $service . "\n\n";
$body .= "Request:\n" . $message . "\n";

$headers = "From: SupportDigitalTech <info@supportglobal-techdriver.com>\r\n";
$headers .= "Reply-To: " . $email . "\r\n";

if (mail($to, $subject, $body, $headers)) {
    echo "Your support request has been sent successfully.";
} else {
    echo "Sorry, we couldn't send your request. Please try again.";
}

?>
