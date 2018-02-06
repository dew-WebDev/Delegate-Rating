<?php

if ($_POST['q17_1To'] == 'Slightly')
	{
		$QNo1 = "T";
	}
else if ($_POST['q17_1To'] == 'Moderate')
	{
		$QNo2 = "T";
	}
else
	{
		$QNo3 = "T";
	}

if ($_POST['q18_2Would'] == 'Yes')
	{
		$QNo4 = "T";
	}
else
	{
		$QNo5 = "T";
	}

$QNo7Ans = $_POST['q21_typeA'];

if ($_POST['q20_input20'] == "No")
	{
		$QNo7 = $QNo7Ans;
	}
else
	{
		$QNo6 = "T";
	}


require_once("query/connectivity.php");

	
	$sql="INSERT INTO SellerAnswer1 (SellerID, RatedBuyerID, Ans1, Ans2, Ans3, Ans4, Ans5, Ans6, Ans7, Active) VALUES ('".$_POST['SellerID']."','".$_POST['RatedBuyerID']."','".$QNo1."','".$QNo2."','".$QNo3."','".$QNo4."','".$QNo5."','".$QNo6."','".$QNo7."','Y')";

	if(mysql_query($sql) ){
    header("location:survey_seller_message.php");
    

	} else{
    
   header("location:survey_seller_error.php");
    

	}
 
// Close connection
mysql_close($link);

	

?>
