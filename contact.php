<?php
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from form and sanitize it
    $name = strip_tags(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $message = strip_tags(trim($_POST['message']));

    // Check if data is complete
    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Please complete the form and try again.";
        exit;
    }

    // Set the recipient email address
    $to = "lenhi4945@gmail.com"; // Update this to your email address

    // Set the email subject
    $subject = "Contact Form Submission from $name";

    // Build the email content
    $txt = "Name: $name\n";
    $txt .= "Email: $email\n";
    $txt .= "Message:\n$message\n";

    // Build the email headers
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "CC: somebodyelse@example.com"; // Update or remove this line as needed

    // Send the email
    if (mail($to, $subject, $txt, $headers)) {
        http_response_code(200);
        header("Location: last.html"); // Redirect to a thank you page
        exit;
    } else {
        http_response_code(500);
        echo "Oops! Something went wrong and we couldn't send your message.";
    }
} else {
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}
?>
