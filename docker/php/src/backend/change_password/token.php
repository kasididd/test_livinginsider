<?php
$db_serv = 'db';
$db_user = "root";
$db_pass = 'BANANA';
$db_Name = 'pdfdb';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: application/json');

        
$conn =new mysqli($db_serv,$db_user,$db_pass,$db_Name);
$email = $_POST['email'];
$token = $_POST['token'];
$sql = "UPDATE `users` SET `token`=$token WHERE user = '$email'";
    try{
        if($conn->query($sql) === TRUE){
            echo ("success");
        }else{
            echo $sql;
        }
    }catch(exception $e){
        echo ("อัปเดทข้อมูลไม่ได้: error :".$e);

    }
    $conn->close();