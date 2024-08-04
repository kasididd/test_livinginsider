<?php
// $output = shell_exec("python main.py ");
// echo var_dump($output);
$db_serv = 'db';
$db_user = "root";
$db_pass = 'BANANA';
$db_Name = 'pdfdb';
$conn =new mysqli($db_serv,$db_user,$db_pass,$db_Name);