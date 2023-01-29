<?php
if (isset($_POST['Email'])) {

    $email_to = "jiterewa@gmail.com";
    $email_subject = "ASG CV submit";

    function problem($error)
    {
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br><br>";
        echo $error . "<br><br>";
        echo "Please go back and fix these errors.<br><br>";
        die();
    }

    // validation expected data exists
    if (
        !isset($_POST['FirstName']) ||
        !isset($_POST['LastName']) ||
        !isset($_POST['Email']) ||
        !isset($_POST['Message'])
    ) {
        problem('We are sorry, but there appears to be a problem with the form you submitted.');
    }

    $firstname = $_POST['FirstName']; // required
    $lastname = $_POST['LastName']; // required
    $email = $_POST['Email']; // required
    $message = $_POST['Message']; // required

    if (!isset($_POST['Company'])) {
        $company = 'Company information not provided';
    }

    if (!isset($_POST['Position'])) {
        $company = 'Position information not provided';
    }

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if (!preg_match($email_exp, $email)) {
        $error_message .= 'The Email address you entered does not appear to be valid.<br>';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if (!preg_match($string_exp, $firstname)) {
        $error_message .= 'The First Name you entered does not appear to be valid.<br>';
    }

    if (!preg_match($string_exp, $lastname)) {
        $error_message .= 'The Last Name you entered does not appear to be valid.<br>';
    }

    if (strlen($message) < 2) {
        $error_message .= 'The Message you entered do not appear to be valid.<br>';
    }

    if (strlen($error_message) > 0) {
        problem($error_message);
    }

    $email_message = "Form details below.\n\n";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "FirstName: " . clean_string($firstname) . "\n";
    $email_message .= "LastName: " . clean_string($lastname) . "\n";
    $email_message .= "Company: " . clean_string($company) . "\n";
    $email_message .= "Position: " . clean_string($position) . "\n";
    $email_message .= "Email: " . clean_string($email) . "\n";
    $email_message .= "Message: " . clean_string($message) . "\n";

    // create email headers
    $headers = 'From: ' . $email . "\r\n" .
        'Reply-To: ' . $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);

    $html_string = str_replace($form_thank_you, 'Thank you for submitting your request.', $html_string);
}
?>
