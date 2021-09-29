<?php
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

    use PHPMailer\PHPMailer\PHPMailer;
    require_once 'PHPMailer/Exception.php';
    require_once 'PHPMailer/PHPMailer.php';
    require_once 'PHPMailer/SMTP.php';

    $mail = new PHPMailer(true);
    $alert = '';

    if (isset($_POST['submit'])){
        
        $from = $_POST['Email'];
        $name = $_POST['name'];
        $subject2 = "You have been registered successfully.";
        $message = "Client: ".$name." has registered.\n\n";
        $message2 = "We will get back to you shortly.\n\n";
        $headers = "From: ".$from;
        $headers2 = "From: ".$mailto;

        try{
            $mail->isSMTP();
            $mail->host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->username = "tinninobu@gmail.com";
            $mail->password = "Tinni@1306";
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->port='587';
            $mail->setFrom('tinninobu@gmail.com');
            $mail->addAddress('tinninobu@gmail.com');
            $mail->isHTML(true)
            $mail->Subject = "One user registered";
            $mail->Body = "name: $name <br> email: $from <br> registered.";
            $mail->send();
            $alert = '<div class="alert-success"><span>You have been successfully registered. We will get back to you shortly.</span></div>';
        }   catch (Exception $e){
            $alert = '<div class="alert-error"><span>Something went wrong.</span></div>';
        }
    }
?> 
