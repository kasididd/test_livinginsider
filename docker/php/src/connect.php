<?php
// echo "connection";

$conn =new mysqli("db","root","root","db");

// echo ($conn);
// $output = $conn->query("SELECT * FROM studens");
// echo $result;
$query =  $conn->query("SELECT * FROM loan_table");
$result = array();
   while($rowData = $query->fetch_assoc()){
       $result[] = $rowData; 
}		
header('Content-Type: application/json');
      echo json_encode($result);