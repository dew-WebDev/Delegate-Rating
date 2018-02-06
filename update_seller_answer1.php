<?php
$SlotID = $_POST['SlotID']; 

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



	if(isset($_POST['IDAnswer']) ){
    

		$sql="INSERT INTO SellerAnswer1 (SellerID, RatedBuyerID, SlotID, Ans1, Ans2, Ans3, Ans4, Ans5, Ans6, Ans7, Active) VALUES ('".$_POST['SellerID']."','".$_POST['RatedBuyerID']."',".$SlotID.",'".$QNo1."','".$QNo2."','".$QNo3."','".$QNo4."','".$QNo5."','".$QNo6."','".$QNo7."','Y')";
		mysql_query($sql);

		$sql1="UPDATE SellerAnswer1 SET Active='N' WHERE ID=".$_POST['IDAnswer']."";
		mysql_query($sql1);

		

		header("location:survey_update_seller_success.php");
		
		

	} else{
    
    	header("location:survey_update_seller_fail.php");
    	

	}
 
// Close connection
mysql_close($link);

	
	

?>
