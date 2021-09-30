<?php
    session_start();
    header('location:nitroreg.html');
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
?> 
    