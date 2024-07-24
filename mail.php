<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize it
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate form data
    if (empty($name) || empty($email) || empty($message)) {
        header("Location: {$_SERVER['HTTP_REFERER']}?status=error");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: {$_SERVER['HTTP_REFERER']}?status=error");
        exit;
    }

    // Set the recipient email address
    $to = "your-email@example.com"; // Replace with your email address

    // Set the email subject
    $subject = "New message from your website contact form";

    // Create the email body
    $email_body = "Name: $name\n";
    $email_body .= "Email: $email\n\n";
    $email_body .= "Message:\n$message\n";

    // Set the email headers
    $headers = "From: $email";

    // Send the email
    if (mail($to, $subject, $email_body, $headers)) {
        header("Location: {$_SERVER['HTTP_REFERER']}?status=success");
    } else {
        header("Location: {$_SERVER['HTTP_REFERER']}?status=error");
    }
}
?>
