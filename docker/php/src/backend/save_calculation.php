<?php
include './connect.php';

$property_price = $_POST['propertyPrice'];
$interest_rate = $_POST['interestRate'];
$loan_term = $_POST['loanTerm'];
$loan_amount = $_POST['loanAmount'];
$minimum_income = $_POST['minimumIncome'];
$monthly_payment = $_POST['monthlyPayment'];

$sql = "INSERT INTO loan_calculations (property_price, interest_rate, loan_term, loan_amount, minimum_income, monthly_payment)
VALUES ('$property_price', '$interest_rate', '$loan_term', '$loan_amount', '$minimum_income', '$monthly_payment')";

if ($conn->query($sql) === TRUE) {
  echo '<script>
          alert("New record created successfully");
          window.location.href = "../index.html";
        </script>';
} else {
  echo '<script>
          alert("Error: ' . $conn->error . '");
          window.location.href = "../index.html";
        </script>';
}


$conn->close();
?>
