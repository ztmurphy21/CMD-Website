<?php
// this is the code for the form that will be implemented on the contact page


$errors = '';
$myemail = 'ztmurphy21@gmail.com';//<-- Currently using a test email address, this won't actually do anything...
if(empty($_POST['name'])  ||
   empty($_POST['email']) ||
   empty($_POST['message']))
{
    $errors .= "\n Error: all fields are required";
}
$name = $_POST['name'];
$email_address = $_POST['email'];
$message = $_POST['message'];
if(filter_var($email_address, FILTER_VALIDATE_EMAIL)){ // Use php filter_var
    $errors .= "<br/> Error: Invalid email address";
}
if($errors != ''){
    die($errors."<br/><a href='javascript:history.back(1);'>Back</a>"); //Use die if there are errors to just bail and echo. Only good for this simple text stuff
}

$to = $myemail;
$email_subject = "Contact form submission: $name";
$email_body = "You have received a new message. ".
  " Here are the details:\n Name: $name \n ".
  "Email: $email_address\n Message \n $message";
$headers = "From: $myemail\n";
$headers .= "Reply-To: $email_address";
mail($to, $email_subject, $email_body, $headers);

header('Location: http://'.$_SERVER['HTTP_HOST'].'/contact-form-thank-you.html');

?>
