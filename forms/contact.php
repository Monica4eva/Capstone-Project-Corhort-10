<<?php
/**
 * Requires the "PHP Email Form" library
 * The "PHP Email Form" library is available only in the pro version of the template
 * The library should be uploaded to: vendor/php-email-form/php-email-form.php
 * For more info and help: https://bootstrapmade.com/php-email-form/
 */

// Replace contact@example.com with your real receiving email address
$receiving_email_address = 'monicadubesekhwela@gmail.com';

// Check if the PHP Email Form library exists
if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
    include($php_email_form);
} else {
    die('Unable to load the "PHP Email Form" Library!');
}

// Create a new instance of the PHP_Email_Form class
$contact = new PHP_Email_Form;
$contact->ajax = true; // Enable AJAX

// Set email parameters
$contact->to = $receiving_email_address;
$contact->from_name = trim($_POST['name']);
$contact->from_email = trim($_POST['email']);
$contact->subject = trim($_POST['subject']); // Ensure there's a subject field in your form

// Uncomment below code if you want to use SMTP to send emails.
// You need to enter your correct SMTP credentials.
// $contact->smtp = array(
//     'host' => 'example.com',
//     'username' => 'example',
//     'password' => 'pass',
//     'port' => '587'
// );

// Add messages to be sent
$contact->add_message($contact->from_name, 'From'); // Sender's name
$contact->add_message($contact->from_email, 'Email'); // Sender's email
$contact->add_message(trim($_POST['message']), 'Message', 10); // Message content

// Validate required fields
if (empty($contact->from_name) || empty($contact->from_email) || empty($_POST['message'])) {
    echo 'Please fill in all fields.';
    exit; // Stop further execution
}

// Send email and echo the response
echo $contact->send();
?>
