<?php
// echo "connection";

$conn =new mysqli("db","root","root","pdfdb");

// echo ($conn);
// $output = $conn->query("SELECT * FROM studens");
// echo $result;
$query =  $conn->query("SELECT * FROM users");
$result = array();
   while($rowData = $query->fetch_assoc()){
       $result[] = $rowData; 
}		
header('Content-Type: application/json');
      echo json_encode($result);