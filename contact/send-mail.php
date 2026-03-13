<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Configuration
    $to_email = "mananroy93@gmail.com";
    $subject = "New Inquiry: Infinity Ads Growth Lead";

    // 2. Data Sanitization
    $full_name = strip_tags(trim($_POST["full_name"]));
    $email     = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message   = strip_tags(trim($_POST["message"]));

    // 3. Validation
    if (empty($full_name) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($message)) {
        http_response_code(400);
        echo "Please complete the form and try again.";
        exit;
    }

    // 4. Email Content
    $email_content = "Name: $full_name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // 5. Email Headers
    $headers = "From: Infinity Ads Web <noreply@infinityads.net>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // 6. Send Email
    if (mail($to_email, $subject, $email_content, $headers)) {
        http_response_code(200);
        echo "Thank you! Your message has been sent.";
    } else {
        http_response_code(500);
        echo "Oops! Something went wrong and we couldn't send your message.";
    }

} else {
    // Not a POST request
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}
?>