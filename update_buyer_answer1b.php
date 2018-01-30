<?php

$SellerInput = $_POST['q22_sellerIdß'];
$SlotID = $_POST['SlotID'];

if ($_POST['q17_typeA'] == 'Yes')
	{
		$QNo1 = "T";
	}
else
	{
		$QNo2 = "T";
	}

$QNo3 = $_POST['q18_typeA18'];

if ($_POST['q11_3'] == 'Definitely “Yes”')
	{
		$QNo4 = "T";
	}
else if ($_POST['q11_3'] == 'Probably “Yes”')
	{
		$QNo5 = "T";
	}
else if ($_POST['q11_3'] == 'Probably “No” (Please explain why)')
	{
		$QNo6 = $_POST['q15_expectedTo15'];
	}
else
	{
		$QNo7 = $_POST['q14_actualGenerated'];
	}

require_once("query/connectivity.php");

	

	if(isset($_POST['IDAnswer']) ){
    

		$sql="INSERT INTO BuyerAnswer1 (BuyerID, UnknownSellerID, SlotID, Ans1, Ans2, Ans3, Ans4, Ans5, Ans6, Ans7, Active) VALUES ('".$_POST['BuyerID']."','".$SellerInput."',".$SlotID.",'".$QNo1."','".$QNo2."','".$QNo3."','".$QNo4."','".$QNo5."','".$QNo6."','".$QNo7."','Y')";

		$sql1="UPDATE BuyerAnswer1 SET Active='N' WHERE ID=".$_POST['IDAnswer']."";
		mysql_query($sql1);

		header("location:survey_update_buyer_success.php");
		
		

	} else{
    
    	header("location:survey_update_buyer_fail.php");
    	

	}
 
// Close connection
mysql_close($link);

	
	

?>
