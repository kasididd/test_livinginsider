<?php
// upload pdf to mysqli
$db_serv = 'mysql';
$db_user = "root";
$db_pass = 'root';
$db_Name = 'pdfdb';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
// header('Content-Type: application/json');

// uploadPDF
if(isset($_POST["pdf"])){
if(isset($_POST["pdf"])){
    $base64_string = $_POST["pdf"];
    $outputfile = "pdf/new.pdf" ;
    $filehandler = fopen($outputfile, 'wb' ); 
    fwrite($filehandler, base64_decode($base64_string));
    fclose($filehandler); 
	 shell_exec("python3 pdf.py {$_POST['user']}");
    $return = "success";

}else{
    $return =  "CAN'T UPLOAD";
}
header('Content-Type: application/json');
echo $return;
}


        
$conn =new mysqli($db_serv,$db_user,$db_pass,$db_Name);
	

// upload file csv
if(isset($_POST["csv"])){
if(isset($_POST["name"])){
      $name =  $_POST["name"];
    $sql = "INSERT INTO `csv_cate`(`u_id`, `name`, `time`) VALUES (null,'$name',null)";


    if($conn->query($sql)){
        echo "uploading...";
        $base64_string = $_POST["csv"];
        $outputfile = "csv/new.csv" ;
        $filehandler = fopen($outputfile, 'wb' ); 
        fwrite($filehandler, base64_decode($base64_string));
        fclose($filehandler); 
         shell_exec("python3 csv_1.py {$_POST['name']}");
        $return = "success";
    }
    else{
        $return = "same!";
    }
    $conn->close();

}else{
    $return =  "No image is submited. ".$_POST["image"];
}
header('Content-Type: application/json');
echo ($return);
}




if(isset($_POST['action'])){
$ac = $_POST['action'];
if($_POST['table']=="pdf_read"){
if(isset($_POST['comment'])){
		$comment = $_POST['comment'];
}
if(isset($_POST['u_id'])){
		$u_id = $_POST['u_id'];
}
if($ac=="comment"){
$sql = "UPDATE `pdf_read` SET `time`=time, `comment`= '$comment' where `u_id` = $u_id";
$query = $conn->query($sql);
 if($query){
	 $result = "success";
 }else{
	 $result = $sql;
 }
 echo $result;
}
	$table = $_POST['table'];
	if($ac=="GET_ALL"){
	    $sql = "SELECT * FROM `$table`";
		$query = $conn->query($sql);
	     $result = array();
	        while($rowData = $query->fetch_assoc()){
				$result[] = $rowData; 
	    }		header('Content-Type: application/json');
	           echo json_encode($result);
            // echo "Tet";
	}
	if($ac=="SELECT"){
		if (isset($_POST['user']))
			$user = $_POST['user'];
	    $sql = "SELECT * FROM `$table` where `user` = '$user'";
		$query = $conn->query($sql);
	     $result = array();
	        while($rowData = $query->fetch_assoc()){
				$result[] = $rowData; 
	    }		header('Content-Type: application/json');
	           echo json_encode($result);
	}
	if($ac=="DESC"){
		if (isset($_POST['user']))
			$user = $_POST['user'];
	    $sql = "SELECT * FROM `pdf_read` ORDER BY `pdf_read`.`time` DESC";
		$query = $conn->query($sql);
	     $result = array();
	        while($rowData = $query->fetch_assoc()){
				$result[] = $rowData; 
	    }		header('Content-Type: application/json');
	           echo json_encode($result);
	}
	if($ac=="RawSuggest"){
		if (isset($_POST['u_id']))
			$u_id = $_POST['u_id'];
		if (isset($_POST['RawSuggest']))
			$RawSuggest = $_POST['RawSuggest'];
	    $sql = "UPDATE `pdf_read` SET `RawSuggest`='$RawSuggest' where `u_id` = '$u_id'";
		$query = $conn->query($sql);
	     if($query){
	     	$result = "success";
	     }else{
	     	$result = $sql;
	     }
	       
	           echo $result;
	}
	
	if($ac=="SavePDF"){
		if (isset($_POST['u_id']))
			$u_id = $_POST['u_id'];
		if (isset($_POST['RawSuggest']))
			$RawSuggest = $_POST['RawSuggest'];

			$jsonobj = '{"data":'.'"'.$RawSuggest.'"}';
	    $sql = "UPDATE `pdf_read` SET `text`='$RawSuggest', `RawSuggest` = '$jsonobj' where `u_id` = '$u_id'";
		$query = $conn->query($sql);
	     if($query){
	     	$result = 'success';
	     }else{
	     	$result = $sq;
	     }
	       
	           echo $result;
	}
    if($ac=="GET_JSON"){
        if (isset($_POST['u_id']))
            $u_id = $_POST['u_id'];
        if (isset($_POST['RawSuggest']))
            $RawSuggest = $_POST['RawSuggest'];
        $sql = "SELECT * FROM `$table`  where `u_id` = '$u_id'";
        $query = $conn->query($sql);
        $result = array();
           while($rowData = $query->fetch_assoc()){
               $result[] = $rowData;
       }        header('Content-Type: application/json');
              echo json_encode($result);
    }

}


if($_POST['table']=="csv_cate"){    
        $table = $_POST['table'];
		if(isset($_POST['name'])){
			$name = $_POST['name'];
		}
	if($ac=="GET_ALL"){
	    $sql = "SELECT * FROM `$table`";
		$query = $conn->query($sql);
	     $result = array();
	        while($rowData = $query->fetch_assoc()){
				$result[] = $rowData; 
	    }		header('Content-Type: application/json');
	           echo json_encode($result);
	}
	if($ac=="DELETE"){
	    $sql = "DELETE FROM `$table` WHERE name = '$name'";
		if($conn->query($sql)){
		// echo 'DELETE id:'.$name.'succes';
				echo $sql;
		}else{
				echo 'err';
		}
		$conn->close();
	}
}

if($_POST['table']=="csv_manage"){    
$table = $_POST['table'];
if(isset($_POST['u_id'])){
			$u_id = $_POST['u_id'];
}
if(isset($_POST['u_id'])){
			$u_id = $_POST['u_id'];
}
if(isset($_POST['name'])){
			$name = $_POST['name'];
}
if(isset($_POST['Expressions'])){
			$Expressions = $_POST['Expressions'];
}
if(isset($_POST['Suggestion1'])){
			$Suggestion1 = $_POST['Suggestion1'];
}
if(isset($_POST['Suggestion2'])){
			$Suggestion2 = $_POST['Suggestion2'];
}
if($ac=="UpdateRecordE"){
	$sql = "UPDATE `csv_manage` SET `record_e`= record_e+1 where `u_id` = '$u_id'";
	$query = $conn->query($sql);
	 if($query){
		 $result = "success";
	 }else{
		 $result = $sql;
	 }
}
if($ac=="UpdateRecordS1"){
	$sql = "UPDATE `csv_manage` SET `record_s1`= record_s1+1 where `u_id` = '$u_id'";
	$query = $conn->query($sql);
	 if($query){
		 $result = "success";
	 }else{
		 $result = $sql;
	 }
}
if($ac=="UpdateRecordS2"){
	$sql = "UPDATE `csv_manage` SET `record_s2`= record_s2+1 where `u_id` = '$u_id'";
	$query = $conn->query($sql);
	 if($query){
		 $result = "success";
	 }else{
		 $result = $sql;
	 }
}
	if($ac=="ALL"){
	    $sql = "SELECT * FROM `$table`";
		$query = $conn->query($sql);
	     $result = array();
	        while($rowData = $query->fetch_assoc()){
				$result[] = $rowData; 
	    }		header('Content-Type: application/json');
	           echo json_encode($result);
	}
	if($ac=="DESC"){
	    $sql = "SELECT * FROM `csv_manage` ORDER BY `csv_manage`.`record_e` DESC LIMIT 15";
		$query = $conn->query($sql);
	     $result = array();
	        while($rowData = $query->fetch_assoc()){
				$result[] = $rowData; 
	    }		header('Content-Type: application/json');
	           echo json_encode($result);
	}
	if($ac=="ASC"){
	    $sql = "SELECT * FROM `csv_manage` ORDER BY `csv_manage`.`record_e` ASC LIMIT 15";
		$query = $conn->query($sql);
	     $result = array();
	        while($rowData = $query->fetch_assoc()){
				$result[] = $rowData; 
	    }		header('Content-Type: application/json');
	           echo json_encode($result);
	}
	if($ac=="GET_ALL"){
	    $sql = "SELECT * FROM `$table` WHERE name_csv = '$name'";
		$query = $conn->query($sql);
	     $result = array();
	        while($rowData = $query->fetch_assoc()){
				$result[] = $rowData; 
	    }		header('Content-Type: application/json');
	           echo json_encode($result);
	}
	if($ac=="DELETE"){
	    $sql = "DELETE  FROM `$table` WHERE name_csv = '$name'";
	    if($conn->query($sql)){
			// echo 'DELETE id:'.$name.'succes';
					echo $sql;
			}else{
					echo 'err'.$sql;;
			}
		$conn->close();
	}
	if($ac=="DELETE_u_id"){
	    $sql = "DELETE  FROM `$table` WHERE name_csv = '$name'and `u_id` = $u_id";
	    if($conn->query($sql)){
			// echo 'DELETE id:'.$name.'succes';
					echo $sql;
			}else{
					echo 'err'.$sql;;
			}
		$conn->close();
	}
	if($ac=="INSERT_ONE"){
	    $sql = "INSERT INTO `csv_manage`(`u_id`, `name_csv`, `Expressions`, `Suggestion1`, `Suggestion2`, `time`) VALUES (null,'$name','$Expressions','$Suggestion1','$Suggestion2',null)";
	    if($conn->query($sql)){
					echo $sql;
			}else{
					echo 'err   :'.$sql;;
			}
		$conn->close();
	}
}
if($_POST['table']=="users"){    
	$table = $_POST['table'];
	// defualt data
	$data = '{"0":"0"}';
	if(isset($_POST['u_id'])){
				$u_id = $_POST['u_id'];
	}
	if(isset($_POST['user'])){
				$user = $_POST['user'];
	}
	if(isset($_POST['password'])){
				$password = $_POST['password'];
	}
	if(isset($_POST['class'])){
				$approve = 1;
				$class = $_POST['class'];
				if($class == "student"){
					$approve = 0;
				}
	}
	if(isset($_POST['data'])){
				$data = $_POST['data'];

	}
	if(isset($_POST['token'])){
				$token = $_POST['token'];
	}
// รับข้อมูล login
		if($ac=="SELECT"){
			$sql = "SELECT * FROM `$table` WHERE user = '$user' and `password` = '$password' and `approve` = 1";
			$query = $conn->query($sql);
			 $result = array();
				while($rowData = $query->fetch_assoc()){
					$result[] = $rowData; 
			}		header('Content-Type: application/json');
				   if($result){
					echo json_encode($result);
				   }else{
				echo "Error";
				   }
		}
// เลือกข้อมูลจาก username
		if($ac=="USER_DATA"){
			$sql = "SELECT * FROM `$table` WHERE user = '$user'";
			$query = $conn->query($sql);
			 $result = array();
				while($rowData = $query->fetch_assoc()){
					$result[] = $rowData; 
			}		header('Content-Type: application/json');
				   if($result){
					echo json_encode($result);
				   }else{
				echo "Error";
				   }
		}
// เรียกข้อมูล username students
		if($ac=="STUDENTS"){
			$sql = "SELECT * FROM `$table` WHERE class = 'student' ";
			$query = $conn->query($sql);
			 $result = array();
				while($rowData = $query->fetch_assoc()){
					$result[] = $rowData; 
			}		header('Content-Type: application/json');
				   if($result){
					echo json_encode($result);
				   }else{
				echo "Error";
				   }
		}
// ลบข้อมูลออกจากฐานข้อมูล
		if($ac=="DELETE"){
			$sql = "DELETE  FROM `$table` WHERE user = '$user'";
			if($conn->query($sql)){
				// echo 'DELETE id:'.$name.'succes';
						echo $sql;
				}else{
						echo 'err'.$sql;;
				}
			$conn->close();
		}
// register
		if($ac=="INSERT"){
			$sql = "INSERT INTO `users`(`u_id`, `user`, `password`, `class`, `data`, `token`,`approve`) VALUES (null,'$user','$password','$class','$data',0,$approve)";
			
			if($conn->query($sql)){
						echo "sucessfully";		
				}else{
						echo 'err   :'.$sql;;
				}
			$conn->close();
		}
// อับเดทข้อมูล
		if($ac=="UPDATE"){
			$sql = "UPDATE `users` SET `data`='$data' WHERE user = '$user'";
			if($conn->query($sql)){
						echo $sql;
				}else{
						echo 'err   :'.$sql;;
				}
			$conn->close();
		}
		if($ac=="APPROVE"){
			$sql = "UPDATE `users` SET `approve` = 1 WHERE user = '$user'";
			if($conn->query($sql)){
						echo $sql;
				}else{
						echo 'err   :'.$sql;;
				}
			$conn->close();
		}
		if($ac=="FORGET"){
			$sql = "UPDATE `users` SET `u_id`='$u_id',`user`='$user',`password`='$password',`class`='$class',`data`='$data',`token`='$token' WHERE user = $user";
			if($conn->query($sql)){
						echo $sql;
				}else{
						echo 'err   :'.$sql;;
				}
			$conn->close();
		}
	}

	// roomCrude
	if($_POST['table']=="room"){    
		$table = $_POST['table'];
		// defualt data
		$data = '{"0":"0"}';
		if(isset($_POST['u_id'])){
					$u_id = $_POST['u_id'];
		}
		if(isset($_POST['user'])){
					$user = $_POST['user'];
		}
		if(isset($_POST['room_name'])){
					$room_name = $_POST['room_name'];
		}
		
		if(isset($_POST['time'])){
					$time = $_POST['time'];
	
		}
		if(isset($_POST['csv_id'])){
					$csv_id = $_POST['csv_id'];
	
		}
	// รับข้อมูล login
			if($ac=="GET_ALL"){
				$sql = "SELECT * FROM `$table` WHERE user = '$user' and `csv_id` = $csv_id";
				$query = $conn->query($sql);
				 $result = array();
					while($rowData = $query->fetch_assoc()){
						$result[] = $rowData; 
				}		header('Content-Type: application/json');
					   if($result){
						echo json_encode($result);
					   }else{
					echo "Error";
					   }
			}
	// เลือกข้อมูลจาก username
			if($ac=="GET_ID"){
				$sql = "SELECT * FROM `$table` WHERE u_id = $u_id";
				$query = $conn->query($sql);
				 $result = array();
					while($rowData = $query->fetch_assoc()){
						$result[] = $rowData; 
				}		header('Content-Type: application/json');
					   if($result){
						echo json_encode($result);
					   }else{
					echo "Error";
					   }
			}
	// เรียกข้อมูล username students
			if($ac=="STUDENTS"){
				$sql = "SELECT * FROM `$table` WHERE class = 'student' ";
				$query = $conn->query($sql);
				 $result = array();
					while($rowData = $query->fetch_assoc()){
						$result[] = $rowData; 
				}		header('Content-Type: application/json');
					   if($result){
						echo json_encode($result);
					   }else{
					echo "Error";
					   }
			}
	// ลบข้อมูลออกจากฐานข้อมูล
			if($ac=="DELETE"){
				$sql = "DELETE  FROM `$table` WHERE u_id = '$u_id'";
				if($conn->query($sql)){
					// echo 'DELETE id:'.$name.'succes';
							echo $sql;
					}else{
							echo 'err'.$sql;;
					}
				$conn->close();
			}
	// register
			if($ac=="INSERT_ONE"){
				$sql = "INSERT INTO `room`(`room_name`, `user`,`member`,`csv_id` ) VALUES ('$room_name','$user','-1',$csv_id)";
				if($conn->query($sql)){
							echo "sucessfully";		
					}else{
							echo 'err   :'.$sql;;
					}
				$conn->close();
			}
	// อับเดทข้อมูล
			if($ac=="UPDATE"){
				$sql = "UPDATE `$table` SET `room_name`='$room_name' WHERE u_id = $u_id";
				if($conn->query($sql)){
							echo $sql;
					}else{
							echo 'err   :'.$sql;;
					}
				$conn->close();
			}
			if($ac=="ADD_STUDENT"){
				$sql = "UPDATE `$table` SET `member`='$room_name' WHERE u_id = $u_id";
				if($conn->query($sql)){
							echo $sql;
					}else{
							echo 'err   :'.$sql;;
					}
				$conn->close();
			}
			if($ac=="APPROVE"){
				$sql = "UPDATE `users` SET `approve` = 1 WHERE user = '$user'";
				if($conn->query($sql)){
							echo $sql;
					}else{
							echo 'err   :'.$sql;;
					}
				$conn->close();
			}
			if($ac=="FORGET"){
				$sql = "UPDATE `users` SET `u_id`='$u_id',`user`='$user',`password`='$password',`class`='$class',`data`='$data',`token`='$token' WHERE user = $user";
				if($conn->query($sql)){
							echo $sql;
					}else{
							echo 'err   :'.$sql;;
					}
				$conn->close();
			}
		}
}
	