<?php
    session_start();
    //header('location:nitroreg.html');
    $Date = $_POST['Date'];
    $Name = $_POST['Name'];
    $Address = $_POST['Address'];
    $Zone = $_POST['Zone'];
    $Fieldname = $_POST['Fieldname'];
    
    $conn = new mysqli('localhost', 'root', '','registrationform');
    if($conn->connect_error){
        die('connection failed:'.$conn->connect_error);
    }
    else{
        $stmt = $conn->prepare("INSERT into nitrogenstatus(Date, Name, Address, Zone, Fieldname) VALUES (?,?,?,?,?) ");
        $stmt->bind_param("sssss",$Date,$Name,$Address,$Zone,$Fieldname);
        $stmt->execute();
        echo "successfull";
        $stmt->close();
        $conn->close();
    }
?> 