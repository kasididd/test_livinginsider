<?php
require_once 'connect.php';

// ดำเนินการ query เพื่อดึงข้อมูล
$query = $conn->query("SELECT * FROM loan_calculations");

// ตรวจสอบว่ามีข้อมูลหรือไม่
if ($query->num_rows > 0) {
    $result = array();
    while($rowData = $query->fetch_assoc()){
        $result[] = $rowData; 
    }
} else {
    // ถ้าไม่มีข้อมูลในฐานข้อมูล ให้ส่งคืนรายการว่าง
    $result = array();
}

// กำหนดค่า header สำหรับ JSON response
header('Content-Type: application/json');

// ส่งคืนผลลัพธ์เป็น JSON
echo json_encode($result);
