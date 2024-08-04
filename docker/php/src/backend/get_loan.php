<?php
require_once 'connect.php';
$query =  $conn->query("SELECT * FROM loan_calculations");
$result = array();
   while($rowData = $query->fetch_assoc()){
       $result[] = $rowData; 
}		
header('Content-Type: application/json');
      echo json_encode($result);
      