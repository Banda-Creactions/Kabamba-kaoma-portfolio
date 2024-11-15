<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize inputs to prevent security vulnerabilities
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate fields
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo "<script>alert('All fields are required.'); window.history.back();</script>";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format.'); window.history.back();</script>";
        exit;
    }

    // Prepare email
    $to = "nchimzy708@gmail.com"; // Replace with your email
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $email_subject = "New Contact Form Submission: $subject";
    $email_body = "Name: $name\nEmail: $email\n\nMessage:\n$message";

    // Send email
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo "<script>alert('Your message has been sent successfully.'); window.location.href = 'index.html';</script>";
    } else {
        echo "<script>alert('Failed to send your message. Please try again later.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Invalid request.'); window.history.back();</script>";
}
?>
