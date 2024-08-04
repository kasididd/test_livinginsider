<?php
session_start();
$db_serv = 'db';
$db_user = "root";
$db_pass = 'BANANA';
$db_Name = 'pdfdb';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

        
$conn =new mysqli($db_serv,$db_user,$db_pass,$db_Name);
$_SESSION["userId"] = "1";


if (count($_POST) > 0) {
	$table = 'users';
	$token = $_GET['token'];
	$email = $_GET['email'];
	$pass = $_POST['newPassword'];
	$message = $pass;

	$sql = "UPDATE `$table` SET `password`='$pass' ,`token` = 0  WHERE  user = '$email' and token = '$token'";

	try {
		if ($conn->query($sql) === TRUE) {
			$message = "Password Changed";
		} else {
			echo $conn->query($sql) . $email;
		}
	} catch (exception $e) {
		echo ("อัปเดทข้อมูลไม่ได้ error " . $e);

	}
	$conn->close();

}

?>
<html>
<head>
<title>Change Password</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/form.css" />
<script>
function validatePassword() {
	var  newPassword, confirmPassword, output = true;

	newPassword = document.frmChange.newPassword;
	confirmPassword = document.frmChange.confirmPassword;

	
	if (!newPassword.value) {
		newPassword.focus();
		document.getElementById("newPassword").innerHTML = "โปรดใส่หรัส";
		output = false;
	}
	else if (!confirmPassword.value) {
		confirmPassword.focus();
		document.getElementById("confirmPassword").innerHTML = "โปรดใส่หรัส";
		output = false;
	}
	if (newPassword.value != confirmPassword.value) {
		newPassword.value = "";
		confirmPassword.value = "";
		newPassword.focus();
		document.getElementById("confirmPassword").innerHTML = "รหัสไม่เหมือนกัน";
		output = false;
	}
	return output;
}
</script>
</head>
<body>
	<div class="phppot-container tile-container">
		<form name="frmChange" method="post" action=""
			onSubmit="return validatePassword()">

			<div class="validation-message text-center"><?php if(isset($message)) { echo $message; } ?></div>
			<h2 class="text-center">Change Password</h2>
			<div>
				<div class="row">
					<label class="inline-block">New Password</label> <span
						id="newPassword" class="validation-message"></span><input
						type="password" name="newPassword" class="full-width">

				</div>
				<div class="row">
					<label class="inline-block">Confirm Password</label> <span
						id="confirmPassword" class="validation-message"></span><input
						type="password" name="confirmPassword" class="full-width">

				</div>
				<div class="row">
					<input type="submit" name="submit" value="Submit"
						class="full-width">
				</div>
			</div>

		</form>
	</div>
</body>
</html>