<?php
// require 'vendor/autoload.php'; // If you're using Composer (recommended)
// Comment out the above line if not using Composer
 require("sendgrid-php.php");
// If not using Composer, uncomment the above line and
// download sendgrid-php.zip from the latest release here,
// replacing <PATH TO> with the path to the sendgrid-php.php file,
// which is included in the download:
// https://github.com/sendgrid/sendgrid-php/releases

session_start();
    header('location:cropdisease.html');
    $Name = $_POST['Name'];
    $Contact = $_POST['Contact'];
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];
    
    $conn = new mysqli('localhost', 'root', '','registrationform');
    if($conn->connect_error){
        die('connection failed:'.$conn->connect_error);
    }
    else{
        $stmt = $conn->prepare("INSERT into registrationform(Name, Contact, Email, Password) VALUES (?,?,?,?) ");
        $stmt->bind_param("ssss",$Name,$Contact,$Email,$Password);
        $stmt->execute();
        echo "successfull";
        $stmt->close();
        $conn->close();
    }

$email = new \SendGrid\Mail\Mail();
$email->setFrom("tinninobu@gmail.com", "Example User");
$email->setSubject("one user registered");
$email->addTo("$Email", "$Name");
$email->addContent("text/plain", "registered user");
$email->addContent(
   "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
);
$sendgrid = new \SendGrid('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');
try {
   $response = $sendgrid->send($email);
   print $response->statusCode() . "\n";
   print_r($response->headers());
   print $response->body() . "\n";
} catch (Exception $e) {
   echo 'Caught exception: '. $e->getMessage() ."\n";
}

