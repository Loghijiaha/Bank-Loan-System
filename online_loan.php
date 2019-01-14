<?php
function check($db){
echo "Check your eligibility.........Wait.............\n";

	$username=$_SESSION['login_user'];
	$sql = "SELECT * From Fixed_Deposit WHERE (Fixed_Deposit.prefix,Fixed_Deposit.customer_id) =(SELECT prefix,customer_id FROM 		Customer_Login where username='$username') ";
	$result = $db->query($sql);
	sleep(2);

	$res=$db->query("SELECT manager_id From Manager limit 1");
	$data=$res->fetch_assoc();
	$manager_id=$data['manager_id'];

	$manager_id=$data['manager_id'];

	$purpose = readline("Purpose: ");
	$loan_amount = readline("Loan amount: ");
	$period = readline("Period: ");
	$noi = readline("No of installments: ");
	$type ="onl";
	$int_rate=25;
	$basic_income=readline("Basic Income:");
	$fix=readline("Fixed Allowance: ");
	$var=readline("variable allowance: ");
	$over=readline("Over due advance: ");
	$ser=readline("Service period: ");
	$emp=readline("Employment Type: ");

//trigger exception in a "try" block
try {

if ($result->num_rows > 0) {
	   	echo "You are eligible for Online loan request\n";
   	 while($row = $result->fetch_assoc()) {
 	      	 $deposit_id=$row['deposit_id'];
		$prefix=$row['prefix'];
		$customer_id=$row['customer_id'];
		}
$db->autocommit(FALSE);
// 1
// prepare and bind
$stmt = $db->prepare("INSERT INTO Loan 			(prefix,customer_prefix,customer_id,purpose,loan_amount,period,interest_rate,no_of_installments,manager_id) VALUES (?, ?, ?, ? , ? , ? ,?, ?, ?)");
$stmt->bind_param("ssisidiii", $type,$prefix,$customer_id,$purpose,$loan_amount,$period,$int_rate,$noi,$manager_id);
$stmt->execute();
// 2
$stmtw = $db->prepare("INSERT INTO Online_Loan (prefix, deposit_id) VALUES (?, ?)");
$stmtw->bind_param("si", $type, $deposit_id);
// set parameters and execute
$stmtw->execute();
//3
$stmtq = $db->prepare(
"INSERT INTO Loan_Customer (prefix, customer_id,basic_income,fixed_allowance,variable_income,employment_type,service_period,over_due_advances) VALUES (?, ?,? ,? ,?, ? ,? ,?)");
$stmtq->bind_param("sidddsid",$prefix,$customer_id,$basic_income,$fix,$var,$emp,$ser,$over);
// set parameters and execute
$result=$stmtq->execute();
echo $result;
$db->commit();
   	 }else{
	      echo "You are not eligible for Online loan.Please approach nearby bank\n";
	}
}

//catch exception
catch(Exception $e) {
/* Rollback */
$db->rollback();
echo "Erorrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr";
}

}

check($db);

?> 
