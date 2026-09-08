<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.html");
    exit;
}

/* Receiving email */
$to = "Paxonteligent.tech@gmail.com";

/* Website/business name */
$brand = "SupportDigitalTech";

/* Get form values */
$name = trim($_POST["name"] ?? "");
$email = trim($_POST["email"] ?? "");
$service = trim($_POST["service"] ?? "");
$message = trim($_POST["message"] ?? "");

/* Basic validation */
if ($name === "" || $email === "" || $service === "" || $message === "") {
    exit("Please complete all required fields.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit("Please enter a valid email address.");
}

/* Prevent header injection */
$name = str_replace(["\r", "\n"], "", $name);
$email = str_replace(["\r", "\n"], "", $email);
$service = str_replace(["\r", "\n"], "", $service);

/* Email subject */
$subject = "New Support Request - " . $name;

/* Email body */
$body = "SupportDigitalTech\n";
$body .= "==============================\n\n";

$body .= "New support request received.\n\n";

$body .= "Customer Name: " . $name . "\n";
$body .= "Customer Email: " . $email . "\n";
$body .= "Service Requested: " . $service . "\n\n";

$body .= "Customer Request:\n";
$body .= $message . "\n\n";

$body .= "==============================\n";
$body .= "SupportDigitalTech\n";

/* Email headers */
$headers = "From: SupportDigitalTech <Paxonteligent.tech@gmail.com>\r\n";
$headers .= "Reply-To: " . $email . "\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

/* Send */
if (mail($to, $subject, $body, $headers)) {

    echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Request Received</title>
        <link rel='stylesheet' href='styles.css'>
    </head>

    <body>

        <div class='contact-box' style='max-width:600px;margin:120px auto;text-align:center;'>
            <h2>Request Received</h2>

            <p>
                Thank you, " . htmlspecialchars($name) . ".
                Your support request has been received.
            </p>

            <a href='index.html' class='cta-button'>
                Return to Website
            </a>
        </div>

    </body>
    </html>
    ";

} else {

    echo "
    <h2>Unable to send your request</h2>
    <p>Please try again later.</p>
    ";
}
?>
