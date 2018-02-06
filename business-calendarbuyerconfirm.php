<?php
require_once("query/connectivity.php");

session_start();
$edateo = mysql_query("select* from emaildate where emaildate_status = 'Y'");
	if(mysql_num_rows($edateo)>0)
	{
		if($edateoo=mysql_fetch_array($edateo))
		{ 
			$bussinessconfirm_date=$edateoo['bussinessconfirm_date'];
		}
	}
/*if(!isset($_SESSION['did']))
{
	header("Location:delegate_login.php?mes=Session has Expired");
}*/
?>
<!DOCTYPE html>
<style>
td
{
	font-family:Arial;
	font-size:14px;
	color:rgb(0,0,0);
}
td
{
	font-family:Arial;
	font-size:14px;
	color:rgb(0,0,0);
}
th
{
	font-family:Arial;
	font-size:14px;
	font-weight:bold;
}
.classname {
	
	display:inline-block;
	color:#777777;
	font-family:arial;
	font-size:20px;
	font-weight:normal;
	font-style:normal;
	height:36px;
	
	
	text-decoration:none;
	text-align:center;
	text-shadow:1px 1px 0px #ffffff;
}.classname:hover {
	
	color:#777777;
	text-decoration:none;
}.classname:active {
	position:relative;
	
	text-decoration:none;
	color:#000000;
	}
</style>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<title>Buyer&nbsp;Confirm</title>

<!-- Bootstrap core CSS -->
<link href="css/bootstrap.css" rel="stylesheet">

<!-- Add custom CSS here -->
<link href="css/sb-admin.css" rel="stylesheet">
<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
<!-- Page Specific CSS -->
<link rel="stylesheet" href="css/morris-0.4.3.min.css">
</head>

<body>

	<div id="wrapper">
		<!-- Sidebar -->
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<?php
$edateo = mysql_query("select* from emaildate where emaildate_status = 'Y'");
	if(mysql_num_rows($edateo)>0)
	{
		if($edateoo=mysql_fetch_array($edateo))
		{
			$bussinessconfirm_date=$edateoo['bussinessconfirm_date'];
			$allemail=$edateoo['allemail'];
			$alldate=$edateoo['alldate'];
			$count_end_date=$edateoo['count_end_date'];
			$bussinessconfirm_date=$edateoo['bussinessconfirm_date'];
			$ptmday4=$edateoo['ptmday4'];
			$advance_buyer_list=$edateoo['advance_buyer_list'];
			$rejection_app_date=$edateoo['rejection_app_date'];
			$preadd_list=$edateoo['preadd_list'];
			$ptm_year=$edateoo['ptm_year'];
			$copy_right_year=$edateoo['copy_right_year'];

		}
	}
echo"<a class='navbar-brand' href='#'>ATRTCM".$ptm_year." Delegate</a>";
?>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse navbar-ex1-collapse">
<?php
if(isset($_SESSION['mas_user_name']) && $_SESSION['mas_user_name'] == 'Y')
{
	echo "<ul class='nav navbar-nav side-nav'>";
	echo "<li><a href='business-calendarbuyeroneday.php'><i class='fa fa-home'></i>&nbsp;One&nbsp;Day&nbsp;Home</a></li>";
	echo "<li><a href='business-calendarbuyer.php'><i class='fa fa-home'></i>&nbsp;Normal&nbsp;Home</a></li>";
	echo "<li><a href='buyerhome2.php'><i class='fa fa-home'></i>&nbsp;Set2&nbsp;Home</a></li>";	
	echo "<li><a href='advanceSellerList.php'><i class='fa fa-search'></i> Advance Seller List<br><font class='sidebar-alt'>".$advance_buyer_list."</font></a></li>";
	echo "<li><a href='viewAppointmentRequestSeller.php'><i class='fa fa-briefcase'></i>View Appointment Requests</a></li>";
	echo "<li><a href='confirmAppointmentRequestSeller.php'><i class='fa fa-briefcase'></i>Confirm&nbsp;Appointment Requests</a></li>";
/* VM 9-Feb-17
	echo "<li><a href='rejectAppointmentRequestSeller.php'><i class='fa fa-thumbs-o-down'></i>&nbsp;Rejection of unwanted appointment requests<br>
	<font class='sidebar-alt'>".$rejection_app_date."</font></a></li>";
	echo"<li class='active'><a href='business-calendarbuyerconfirm.php'><i class='fa fa-book'></i>&nbsp;Business Calendar</a></li>
		<li><a href='availableslotbuyer.php'><i class='fa fa-clock-o'></i>&nbsp;Available Slot</a></li>
		<li class='dropdown open'><a href='#' style='background-color: #056495;' data-toggle='dropdown'><i class='fa fa-plus'></i> Pre Addendum
		List <b class='caret'></b><font class='sidebar-alt'>".$preadd_list."</font></a>
			<ul class='dropdown-menu'>
				<li><a href='advanceSellerCancellationList.php'>Cancellations</a></li>
				<li><a href='advanceNewSellerList.php'>New Registrations</a></li>
			</ul>
		</li>";
*/		
	echo"<li><a href='delegate_logout.php'><i class='fa fa-sign-out'></i>&nbsp;Logout</a></li>
	</ul>
	";				
}
else
{
?>
<ul class="nav navbar-nav side-nav">
<?php
	if($_SESSION['chk'] == '1')
	{
		$tq=mysql_query("select * from date_settings where settings_status='Y'");
		if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
		{
			$allon = $rs['set2on'];
			if($allon == 'Y')
			{
				echo "<li><a href='buyerhome2.php'><i class='fa fa-home'></i>&nbsp;Home</a></li>";
			}	
			else
			{
				echo "<li><a href='business-calendarbuyeroneday.php'><i class='fa fa-home'></i>&nbsp;Home</a></li>";
			}	
		}	
	}
	else
	{
		$tq=mysql_query("select * from date_settings where settings_status='Y'");
		if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
		{
			$allon = $rs['set2on'];
			if($allon == 'Y')
			{
				echo "<li><a href='buyerhome2.php'><i class='fa fa-home'></i>&nbsp;Home</a></li>";
			}	
			else
			{	
				echo "<li><a href='business-calendarbuyer.php'><i class='fa fa-home'></i>&nbsp;Home</a></li>";
			}
		}	
	}
?>
<!--
	<li><a href="advanceSellerList.php"><i
		class="fa fa-search"></i> Seller List<br></a></li>
--!>
<?php
	$tq=mysql_query("select * from date_settings where settings_status='Y'");
	if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
	{
		$vappon = $rs['vappon'];
		if($vappon == 'N')
		{
			echo "<li><a href='confirmAppointmentRequestSeller.php'><i class='fa fa-briefcase'></i>&nbsp;View Appointment Requests</a></li>";
		}
		else
		{
			$b=false;
			$q=mysql_query("select * from delegate_requests where buyer_com_id=".$_SESSION['did']." and request_mode='B'");
			if(mysql_num_rows($q)>0 && $r=mysql_fetch_array($q))
			{
				$b=true;
			}
			if($b)
			{
				echo "<li><a href='confirmAppointmentRequestSeller.php'><i class='fa fa-briefcase'></i>
		View Appointment Requests</a></li>";
			}
			else
			{
				echo "<li><a href='appointmentRequestSellerList.php'><i class='fa fa-briefcase'></i>
		Appointment Requests</a></li>";
			}
		}
	}	
?>
<?php
		$tq=mysql_query("select * from date_settings where settings_status='Y'");
		$on="";
		$off="";
		if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
		{
			$avsd = $rs['available_slot'];
			$on = $rs['app_rejection_on'];
			if($on == 'Y' && $avsd != 'Y')
			{
/* VM 9-Feb-17				
				echo "<li><a href='rejectAppointmentRequestSeller.php'><i class='fa fa-thumbs-o-down'></i>&nbsp;Rejection of unwanted appointment requests<br>
	<font class='sidebar-alt'>".$rejection_app_date."</font></a></li>";
*/	
			}
			else
			{
/* VM 9-Feb-17				
				echo "<li><a href='#'><i class='fa fa-thumbs-o-down'></i>&nbsp;Rejection of unwanted appointment requests<br>
	<font class='sidebar-alt'>".$rejection_app_date."</font></a></li>";
*/	
			}
		}
?>
<?php
$tq=mysql_query("select * from date_settings where settings_status='Y'");
		if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
		{
			$allon = $rs['set2on'];
			if($allon == 'Y')
			{
				echo"	
					<li class='active'><a href='business-calendarbuyerconfirm.php'><i class='fa fa-book'></i>&nbsp;Business Calendar</a></li>";				
/* VM 9-Feb-17				
				echo"	
					<li class='active'><a href='business-calendarbuyerconfirm.php'><i class='fa fa-book'></i>&nbsp;Business Calendar</a></li>
					<li><a href='availableslotbuyer.php'><i class='fa fa-clock-o'></i>&nbsp;Available Slot</a></li>
					<li class='dropdown open'><a href='#' style='background-color: #056495;'
						data-toggle='dropdown'><i class='fa fa-plus'></i> Pre Addendum
						List <b class='caret'></b><font class='sidebar-alt'>".$preadd_list."</font></a>
						<ul class='dropdown-menu'>
							<li><a href='advanceSellerCancellationList.php'>Cancellations</a></li>
							<li><a href='advanceNewSellerList.php'>New Registrations</a></li>
						</ul>
					</li>";
*/	
			}
	else
			{
				echo "<li><a href='#'><i class='fa fa-book'></i>&nbsp;Business Calendar</a></li>";
/* VM 9-Feb-17						
				echo "<li><a href='#'><i class='fa fa-book'></i>&nbsp;Business Calendar</a></li>
							<li><a href='#'><i class='fa fa-clock-o'></i>&nbsp;Available Slot</a></li>
							<li class='dropdown open'><a href='#' class='dropdown-toggle' style='background-color: #056495;'
								data-toggle='dropdown'><i class='fa fa-plus'></i> Pre Addendum
							List <b class='caret'></b><font class='sidebar-alt'>".$preadd_list."</font></a>
							<ul class='dropdown-menu'>
									<li><a href='#'>Cancellations</a></li>
									<li><a href='#'>New Registrations</a></li>
							</ul>
						</li>";
*/						
			}	
		}	
?>	
	<li><a href="delegate_logout.php"><i class="fa fa-sign-out"></i>&nbsp;Logout</a></li>

</ul>
<?php
}
?>

				<ul class="nav navbar-nav navbar-right navbar-user">
					<li class="dropdown user-dropdown"><a href="#"
						class="dropdown-toggle" data-toggle="dropdown"><i
							class="fa fa-user"></i>&nbsp;&nbsp;<?php echo $_SESSION['comname']; ?>
							<b class="caret"></b>
					</a>
						<ul class="dropdown-menu">
							<?php echo"<li><a href=\"buyerDetailsown.php?id=".$_SESSION['did']."\"> <i class='fa fa-user'></i> Profile</a></li>"; ?>
							<li class="divider"></li>
							<li><a href="delegate_logout.php"><i
									class="fa fa-power-off"></i> Log Out</a>
							</li>
						</ul></li>
				</ul>
			</div>
			<!-- /.navbar-collapse -->
		</nav>

		<div id="page-wrapper">
			<!-- /.row -->

			<div class="row">
				<div class="col-lg-12">
			<?php
			$i=0;
			$q=mysql_query("select bc.company_name, mb.fullname, bc.company_id, bc.cnt_id from buyer_company bc, mas_buyer mb where mb.mas_buyer_com_id=bc.buyer_com_id and mb.mas_buyer_status='Y' and bc.buyer_status='Y' and bc.buyer_com_id = ".$_SESSION['did']." limit 1");
			if(mysql_num_rows($q)>0)
			{
				while($r=mysql_fetch_array($q))
				{

						$bcname= $r['company_name'];
						$bname= $r['fullname'];
						$bcomid= $r['company_id'];
						$cntry="";
						$q1=mysql_query("select * from countries where country_id='".$r['cnt_id']."'"	);
						if(mysql_num_rows($q1)>0 && $r1=mysql_fetch_array($q1))
						{
							$bcountry=$r1['country_name'];
						}
					
				}
			}
			
			?>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-primary">
						<!--<div class="panel-heading">
							<h3 class="panel-title">SESSION</h3>
						</div>-->
					<div class="row">
						<div class="col-lg-4">
							<img src="images/PDFLogo.jpg" style="margin-top:30px;"/>
						</div>
						<div class="col-lg-6" style="margin-top:30px;">
							<span style="font-size:16px; font-weight:Bold; font-family:Arial;">PATA Adventure Travel And Responsible Tourism Conference And Mart <?php echo $ptm_year;?> <br>BUYER APPOINTMENT SCHEDULE <br><?php echo $bcname; ?>, <?php echo $bcountry; ?><br><?php echo $bname; ?> <br>Reg. No : <?php echo $bcomid; ?></span>
						</div>
						<div class="col-lg-2">
							<span style="font-size:16px; font-weight:Bold; font-family:Times;float:right; margin-right:50px; margin-top:30px;"><?php echo $bcomid; ?></span>
						</div>
					</div>
						<div class="panel-body">
							<div class="panel-body">
								<div class="table-responsive">
									
					<?php

echo "Please note that it's compulsory for all buyers to fulfil 100% of the appointments on their business calendar (Total 20 appointments including any EMPTY slots) with ATRTCM2018 Sellers' signatures on the respective appointment slot for schedule in Apr 23 during 0930-1650.";
echo "<br><center>**** Please submit your appointment sheet at the buyer registration counter at the end of the event. ****</center>";
echo "<table class='table table-bordered table-hover table-striped tablesorter'>";
//echo "<thead><tr><th>Seller Company</th><th>Delegate Name</th><th>Date</th><th>Slot Start</th><th>Slot End</th><th>Description</th><th>Booth Number</th></tr></thead>";
echo "<thead><tr><th style='width:10%;text-align:center;'>Date&nbsp;<i class='fa fa-sort'></i></th><th style='width:10%;text-align:center;'>Start Time&nbsp;<i class='fa fa-sort'></i></th><th style='width:10%;text-align:center;'>End Time&nbsp;<i class='fa fa-sort'></i></th><th style='width:30%;text-align:center;'>Details&nbsp;<i class='fa fa-sort'></i></th><th style='width:20%;text-align:center;'>Requested By&nbsp;<i class='fa fa-sort'></i></th><th style='width:20%;text-align:center;'>Signature&nbsp;<i class='fa fa-sort'></i></th></tr></thead>";

			/*$qry=mysql_query("select 
			CASE
				WHEN time_slots.slottype = 't' THEN seller_company.company_name
				ELSE time_slot_description
			END as scname,
			CASE
				WHEN time_slots.slottype = 't' THEN mas_seller.fullname
				ELSE ''
			END as sname, 
			CASE
				WHEN time_slots.slottype = 't' THEN boothNumber 
				ELSE ''
			END as bno, 
			CASE
				WHEN time_slots.slottype = 't' THEN time_slot_description 
				ELSE ''
			END as time_slot_description, 
			time_slot_date, 
			time_slot_id_from, 
			time_slot_id_to, 
			CASE
				WHEN time_slots.slottype = 't' THEN type
				ELSE ''
			END as type, 
			time_slots.time_slot_id, 
			mas_buyer.mas_buyer_id as bcid, 
			mas_seller.mas_seller_id as scid
			from 
			( select *, 'g' as slottype from time_slots_generic union select *, 't' as slottype from time_slots ) time_slots
			left join appointments on time_slots.time_slot_id = appointments.time_slot_id
			left join seller_company on appointments.seller_com_id = seller_company.seller_com_id
			left join buyer_company on appointments.buyer_com_id = buyer_company.buyer_com_id
			left join mas_seller on appointments.mas_seller_com_id = mas_seller.mas_seller_id
			left join mas_buyer on appointments.mas_buyer_com_id = mas_buyer.mas_buyer_id
			left join seller_org_details on appointments.seller_com_id = seller_org_details.seller_com_id
			
			where
			seller_org_details.seller_org_status = 'Y'
			and (mas_buyer.mas_buyer_com_id = ".$_SESSION['did'].")
	    order by time_slot_date, time_slot_id_from");

			

			if(mysql_num_rows($qry)>0)
			{
				while($krows=mysql_fetch_array($qry))
				{
				
					echo "<tbody><tr><td>".$krows['scname']."</td><td>".$krows['sname']."</td><td>".$krows['time_slot_date']."</td><td>".$krows['time_slot_id_from']."</td><td>".$krows['time_slot_id_to']."</td><td>".$krows['time_slot_description']."</td><td>".$krows['bno']."</td></tr></tbody>";	
				}
			}*/
			
			
$qry1 ="select 
			seller_company.company_id as scomid, 
			CASE
				WHEN time_slots.slottype = 't' THEN seller_company.company_name
				ELSE time_slot_description
			END as scname,
			CASE
				WHEN time_slots.slottype = 't' THEN mas_seller.fullname
				ELSE ''
			END as sname, 
			CASE
				WHEN time_slots.slottype = 't' THEN boothNumber 
				ELSE ''
			END as bno, 
			CASE
				WHEN time_slots.slottype = 't' THEN time_slot_description 
				ELSE ''
			END as time_slot_description, 
			date_format(time_slot_date,'%b- %d')  as time_slot_date, 
			time_slot_id_from, 
			time_slot_id_to, 
			CASE
				WHEN time_slots.slottype = 't' THEN type
				ELSE ''
			END as type, 
			time_slots.time_slot_id, 
 			time_slots.venue,
			buyer_company.cnt_id as bcountry_id,
			seller_company.cnt_id as scountry_id,
			time_slots.time_slot_description,
 			time_slots.slottype,
			mas_buyer.mas_buyer_id as bcid, 
			mas_seller.mas_seller_id as scid
			from 

			( select *, 'g' as slottype from time_slots_generic where time_slot_date > '".$bussinessconfirm_date."' union select *, 't' as slottype from time_slots ) time_slots  
			left join appointments on time_slots.time_slot_id = appointments.time_slot_id and appointments.buyer_com_id = ".$_SESSION['did']."
			left join seller_company on appointments.seller_com_id = seller_company.seller_com_id
			left join buyer_company on appointments.buyer_com_id = buyer_company.buyer_com_id
			left join mas_seller on appointments.mas_seller_com_id = mas_seller.mas_seller_id
			left join mas_buyer on appointments.mas_buyer_com_id = mas_buyer.mas_buyer_id
			left join seller_org_details on appointments.seller_com_id = seller_org_details.seller_com_id and seller_org_details.seller_org_status = 'Y'

	    order by time_slot_date, session, in_session";
	
			$qry=mysql_query($qry1);
			if(mysql_num_rows($qry)>0)
			{
				while($krows=mysql_fetch_array($qry))
				{
					$arequest="";
					if ($krows['type'] == 'P')
					{
						$arequest="MUTUAL";
					}
					else if($krows['type'] == 'S')
					{
						$arequest="SELLER";
					}
					else
					{
						$arequest="BUYER";
					}
					
					$descrip="";
					

					if($krows['scountry_id'] != '')
					{
						$q=mysql_query("select * from countries where country_id=".$krows['scountry_id']);
						if(mysql_num_rows($q)>0 && $r=mysql_fetch_array($q))
						{
							$cntry=$r['country_name'];
						}
					}
					

					if($krows['slottype'] == 'g')
					{
						if((strcmp($krows['time_slot_description'],"End of Day 1") == 0) || (strcmp($krows['time_slot_description'],"End of Business Session") == 0))
						{
							$descrip = $krows['time_slot_description'];
						}
						else
						{
							if(trim($krows['venue']) != "")
							{
								$descrip = $krows['time_slot_description']."<br>Venue : ".$krows['venue'];
							}
							else
							{
								$descrip = $krows['time_slot_description'];
							}
						}
					}
					else
					{
						if($krows['scomid'] != "")
						{
							$descrip ="Reg No : ".$krows['scomid']."<br>".$krows['scname'].", ".$cntry."<br>Booth No : ".$krows['bno'];
						}
					}

					$sdesc="";
					$flag ='T';
					
					if($krows['sname'] !="")
					{
						if($arequest == 'MUTUAL')
						{
							$SlotID = $krows['time_slot_id'];
							$CheckRatedSellID = $krows['scomid'];

							$RatedSellID1 = mysql_query("select * from BuyerAnswer1 where RatedSellerID='".$CheckRatedSellID."' LIMIT 1");
							$row = mysql_fetch_assoc($RatedSellID1);
							
							$RatedSellerIDAnswer = $row['RatedSellerID'];
							

								if ($RatedSellerIDAnswer == $CheckRatedSellID)

									{

										echo "<tr><td>".$krows['time_slot_date']."</td><td>".$krows['time_slot_id_from']."</td><td>".$krows['time_slot_id_to']."</td><td>".$descrip."</td><td style='color:rgb(255,0,0);'>".$arequest."</td><td style='text-align:center;'>";	

										

											if ($flag=='T')
													{
														echo "<div align='right'><a href='survey_buyer.php?BuyerID=$bcomid&RatedSellerID=$CheckRatedSellID&SlotID=$SlotID' class='classname' target='_blank'><span style='color:#008000'>&#9734;</span></a></div>";

													}

										echo "</td></tr>";			


									}	
								else
									{
										echo "<tr><td>".$krows['time_slot_date']."</td><td>".$krows['time_slot_id_from']."</td><td>".$krows['time_slot_id_to']."</td><td>".$descrip."</td><td style='color:rgb(255,0,0);'>".$arequest."</td><td style='text-align:center;'>";	
										

											if ($flag=='T')
													{
														echo "<div align='right'><a href='survey_buyer.php?BuyerID=$bcomid&RatedSellerID=$CheckRatedSellID&SlotID=$SlotID' class='classname' target='_blank'><span style='color:#FF0000'>&#9734;</span></a></div>";
													}
										echo "</td></tr>";		

									}
								
						}
						else
						{
							$SlotID = $krows['time_slot_id'];
							$CheckRatedSellID = $krows['scomid'];

							$RatedSellID1 = mysql_query("select * from BuyerAnswer1 where RatedSellerID='".$CheckRatedSellID."' LIMIT 1");
							$row = mysql_fetch_assoc($RatedSellID1);
							
							$RatedSellerIDAnswer = $row['RatedSellerID'];
							

								if ($RatedSellerIDAnswer == $CheckRatedSellID)

									{

										echo "<tr><td>".$krows['time_slot_date']."</td><td>".$krows['time_slot_id_from']."</td><td>".$krows['time_slot_id_to']."</td><td>".$descrip."</td><td style='color:rgb(255,0,0);'>".$arequest."</td><td style='text-align:center;'>";	
										
											if ($flag=='T')
													{
														echo "<div align='right'><a href='survey_buyer.php?BuyerID=$bcomid&RatedSellerID=$CheckRatedSellID&SlotID=$SlotID' class='classname' target='_blank'><span style='color:#008000'>&#9734;</span></a></div>";

													}
											echo "</td></tr>";	

									}	
								else
									{
										echo "<tr><td>".$krows['time_slot_date']."</td><td>".$krows['time_slot_id_from']."</td><td>".$krows['time_slot_id_to']."</td><td>".$descrip."</td><td style='color:rgb(255,0,0);'>".$arequest."</td><td style='text-align:center;'>";	
										
											if ($flag=='T')
													{
														echo "<div align='right'><a href='survey_buyer.php?BuyerID=$bcomid&RatedSellerID=$CheckRatedSellID&SlotID=$SlotID' class='classname' target='_blank'><span style='color:#FF0000'>&#9734;</span></a></div>";
													}
										echo "</td></tr>";
													
									}
								
								
						}
					}
					else
					{
						


						if($descrip=='End of Day 1' || $descrip=='End of Business Session')
						{
						echo "<tr><td></td><td>".$krows['time_slot_id_from']."</td><td>".$krows['time_slot_id_to']."</td><td style='border-bottom: 1px solid grey; text-align:center;color:rgb(0,0,0);background-color:rgb(200,200,200);'>".$descrip."</td><td style='text-align:center;color:white;background-color:rgb(200,200,200);'></td><td style='text-align:center;color:white;background-color:rgb(200,200,200);'></td></tr>";
						}
						else if($descrip == "")
						{
							
							$SlotID = $krows['time_slot_id'];

							$result = mysql_query("SELECT MAX(ID) AS max_page FROM BuyerAnswer1 where SlotID='".$SlotID."'");
        					$row = mysql_fetch_array($result);

							$CheckAnswer = mysql_query("select * from BuyerAnswer1 where SlotID='".$SlotID."' and ID='".$row["max_page"]."'");
							$row = mysql_fetch_assoc($CheckAnswer);
							
							$CheckAnswerSlot = $row['SlotID'];


								if ($SlotID == $CheckAnswerSlot)

									{
										echo "<tr><td>".$krows['time_slot_date']."</td><td>".$krows['time_slot_id_from']."</td><td>".$krows['time_slot_id_to']."</td><td>".$descrip."</td><td></td><td style='text-align:center;'>";
										

											if ($flag=='T')
													{
														echo "<div align='right'><a href='survey_buyer_blank.php?BuyerID=$bcomid&SlotID=$SlotID' class='classname' target='_blank'><span style='color:#008000'>&#9734;</span></a></div>";
													}

										echo "</td></tr>";

									}	
								else
									{
										echo "<tr><td>".$krows['time_slot_date']."</td><td>".$krows['time_slot_id_from']."</td><td>".$krows['time_slot_id_to']."</td><td>".$descrip."</td><td></td><td style='text-align:center;'>";
										

											if ($flag=='T')
													{
														echo "<div align='right'><a href='survey_buyer_blank.php?BuyerID=$bcomid&SlotID=$SlotID' class='classname' target='_blank'><span style='color:#FF0000'>&#9734;</span></a></div>";
													}


										echo "</td></tr>";
									}
								
						}
						else
						{
						echo "<tr><td>".$krows['time_slot_date']."</td><td>".$krows['time_slot_id_from']."</td><td>".$krows['time_slot_id_to']."</td><td style='border: 1px solid grey; color:rgb(255,255,255);background-color:rgb(120,120,120);'>".$descrip."</td><td style='border: 1px solid grey;  color:white;background-color:rgb(120,120,120);'></td><td style='border: 1px solid grey; color:white;background-color:rgb(120,120,120);'></td></tr>";
						}	
						
					}
				}
			}
echo "</tbody></table>";
		
	?>										
									
								</div>
<!-- No more this part for seller 16-Aug-16 -->
<div>
<img src="images/report_question_all.png" />
<div>

<br>

								<div class="table-responsive">
									
					<?php
/*

			$qry1 = "select * from
			(
			select 
			seller_company.create_date as registeration_date,
			seller_company.company_name as scname, 
			mas_seller.fullname as sname, 
			boothNumber as bno, 
			buyer_company.company_name as bcname, 
			mas_buyer.fullname as bname, 
			buyer_company.buyer_com_id as bcid,
			delegate_login.mas_buyer_id as mbcid,
			seller_company.seller_com_id as scid,
			mas_seller.mas_seller_id as mscid,
			delegate_requests.appointment_order,
			'Buyer Request' as matching_condition
			from 
			seller_company 
			inner join delegate_requests on seller_company.seller_com_id = delegate_requests.seller_com_id
			inner join buyer_company on buyer_company.buyer_com_id = delegate_requests.buyer_com_id
			inner join mas_seller on seller_company.seller_com_id = mas_seller.mas_seller_com_id
			inner join delegate_login on delegate_requests.requested_delegate_id = delegate_login.user_name
			left join seller_org_details on seller_company.seller_com_id = seller_org_details.seller_com_id
			inner join mas_buyer on mas_buyer.mas_buyer_id = delegate_login.mas_buyer_id
			where request_mode = 'B'
			and 
			(mas_buyer.mas_buyer_com_id = ".$_SESSION['did'].")
			and
			delegate_requests.reject <> 'Y'
			and
			mas_seller.mas_seller_status = 'Y'
			and
			exists
			(
			select 
			request_id
			from 
			seller_company sc
			inner join delegate_requests tdr on sc.seller_com_id = tdr.seller_com_id
			inner join buyer_company bc on bc.buyer_com_id = tdr.buyer_com_id
			where tdr.request_mode = 'S'
			and tdr.seller_com_id = seller_company.seller_com_id
			and tdr.buyer_com_id = buyer_company.buyer_com_id
			) 
			and
			not exists 
			(
			select time_slot_id from appointments where appointments.seller_com_id = seller_company.seller_com_id and appointments.buyer_com_id = buyer_company.buyer_com_id
			)

			union


			select 
			seller_company.create_date as registeration_date,
			seller_company.company_name as scname, 
			mas_seller.fullname as sname, 
			boothNumber as bno, 
			buyer_company.company_name as bcname, 
			mas_buyer.fullname as bname, 
			buyer_company.buyer_com_id as bcid,
			delegate_login.mas_buyer_id as mbcid,
			seller_company.seller_com_id as scid,
			mas_seller.mas_seller_id as mscid,
			delegate_requests.appointment_order,
			'Buyer Request' as matching_condition
			from 
			seller_company 
			inner join delegate_requests on seller_company.seller_com_id = delegate_requests.seller_com_id
			inner join buyer_company on buyer_company.buyer_com_id = delegate_requests.buyer_com_id
			inner join mas_seller on seller_company.seller_com_id = mas_seller.mas_seller_com_id
			inner join delegate_login on delegate_requests.requested_delegate_id = delegate_login.user_name
			left join seller_org_details on seller_company.seller_com_id = seller_org_details.seller_com_id
			inner join mas_buyer on mas_buyer.mas_buyer_id = delegate_login.mas_buyer_id
			where request_mode = 'B'
			and
			(mas_buyer.mas_buyer_com_id = ".$_SESSION['did'].")
			and
			delegate_requests.reject <> 'Y'
			and
			mas_seller.mas_seller_status = 'Y'
			and
			not exists
			(
			select 
			request_id
			from 
			seller_company sc
			inner join delegate_requests tdr on sc.seller_com_id = tdr.seller_com_id
			inner join buyer_company bc on bc.buyer_com_id = tdr.buyer_com_id
			where tdr.request_mode = 'S'
			and tdr.seller_com_id = seller_company.seller_com_id
			and tdr.buyer_com_id = buyer_company.buyer_com_id
			) 
			and
			not exists 
			(
			select time_slot_id from appointments where appointments.seller_com_id = seller_company.seller_com_id and appointments.buyer_com_id = buyer_company.buyer_com_id
			)


			union


			select 
			seller_company.create_date as registeration_date,
			seller_company.company_name as scname, 
			mas_seller.fullname as sname, 
			boothNumber as bno, 
			buyer_company.company_name as bcname, 
			mas_buyer.fullname as bname, 
			buyer_company.buyer_com_id as bcid,
			mas_buyer.mas_buyer_id as mbcid,
			seller_company.seller_com_id as scid,
			delegate_login.mas_seller_id as mscid,
			delegate_requests.appointment_order,
			'Seller Request' as matching_condition
			from 
			seller_company 
			inner join delegate_requests on seller_company.seller_com_id = delegate_requests.seller_com_id
			inner join buyer_company on buyer_company.buyer_com_id = delegate_requests.buyer_com_id
			inner join mas_buyer on buyer_company.buyer_com_id = mas_buyer.mas_buyer_com_id
			inner join delegate_login on delegate_requests.requested_delegate_id = delegate_login.user_name
			left join seller_org_details on seller_company.seller_com_id = seller_org_details.seller_com_id
			inner join mas_seller on delegate_login.mas_seller_id = mas_seller.mas_seller_id
			where request_mode = 'S'
			and
			(mas_buyer.mas_buyer_com_id = ".$_SESSION['did'].")
			and
			delegate_requests.reject <> 'Y'
			and
			mas_buyer.mas_buyer_status = 'Y'
			and
			not exists
			(
			select 
			request_id
			from 
			seller_company sc
			inner join delegate_requests tdr on sc.seller_com_id = tdr.seller_com_id
			inner join buyer_company bc on bc.buyer_com_id = tdr.buyer_com_id
			where tdr.request_mode = 'B'
			and tdr.seller_com_id = seller_company.seller_com_id
			and tdr.buyer_com_id = buyer_company.buyer_com_id
			) 
			and
			not exists 
			(
			select time_slot_id from appointments where appointments.seller_com_id = seller_company.seller_com_id and appointments.buyer_com_id = buyer_company.buyer_com_id
			)
			)
			sel 
			group by scid, bcid
			order by registeration_date";
			
			$k=mysql_query($qry1);
				
			if(mysql_num_rows($k)>0)
			{
				while($krows=mysql_fetch_array($k))
				{

					echo "<tbody><tr><td>".$krows['scname']."</td><td>".$krows['sname']."</td><td>Unmatched</td></tr></tbody>";
				}
			}
			*/
			
			
			$qry1 ="
select * from
			(
			select 
			seller_company.seller_com_id as scid,
			seller_company.cnt_id as country_id,
			buyer_company.buyer_com_id as bcid,
			seller_company.company_id as cid,
			seller_company.create_date as registeration_date,
			delegate_login.mas_buyer_id as mbcid,
			mas_seller.mas_seller_id as mscid,
			seller_company.company_name as scname, 
			mas_seller.fullname as sname, 
			boothNumber as bno, 
			buyer_company.company_name as bcname, 
			mas_buyer.fullname as bname, 
			delegate_requests.appointment_order,
			'BUYER' as matching_condition
			from 
			seller_company 
			inner join delegate_requests on seller_company.seller_com_id = delegate_requests.seller_com_id
			inner join buyer_company on buyer_company.buyer_com_id = delegate_requests.buyer_com_id
			inner join mas_seller on seller_company.seller_com_id = mas_seller.mas_seller_com_id
			inner join delegate_login on delegate_requests.requested_delegate_id = delegate_login.user_name
			left join seller_org_details on seller_company.seller_com_id = seller_org_details.seller_com_id
			inner join mas_buyer on mas_buyer.mas_buyer_com_id = delegate_login.buyer_com_id
			where request_mode = 'B'
			and 
			(mas_buyer.mas_buyer_com_id = ".$_SESSION['did'].")
			and
			mas_seller.mas_seller_status = 'Y'
			and
			(mas_seller.title_name is not null and mas_seller.title_name <> 'None')
			and
			(mas_seller.name is not null and mas_seller.name <> '')
			and
			mas_seller.delegate = '1'
			and
			seller_org_status = 'Y'
			and
			exists
			(
			select 
			request_id
			from 
			seller_company sc
			inner join delegate_requests tdr on sc.seller_com_id = tdr.seller_com_id
			inner join buyer_company bc on bc.buyer_com_id = tdr.buyer_com_id
			where tdr.request_mode = 'S'
			and tdr.seller_com_id = seller_company.seller_com_id
			and tdr.buyer_com_id = buyer_company.buyer_com_id
			) 
			and
			not exists 
			(
			select time_slot_id from appointments where appointments.seller_com_id = seller_company.seller_com_id and appointments.buyer_com_id = buyer_company.buyer_com_id
			)
		
			union

			select 
			seller_company.seller_com_id as scid,
			seller_company.cnt_id as country_id,
			buyer_company.buyer_com_id as bcid,
			seller_company.company_id as cid,
			seller_company.create_date as registeration_date,
			delegate_login.mas_buyer_id as mbcid,
			mas_seller.mas_seller_id as mscid,
			seller_company.company_name as scname, 
			mas_seller.fullname as sname, 
			boothNumber as bno, 
			buyer_company.company_name as bcname, 
			mas_buyer.fullname as bname, 
			delegate_requests.appointment_order,
			'BUYER' as matching_condition
			from 
			seller_company 
			inner join delegate_requests on seller_company.seller_com_id = delegate_requests.seller_com_id
			inner join buyer_company on buyer_company.buyer_com_id = delegate_requests.buyer_com_id
			inner join mas_seller on seller_company.seller_com_id = mas_seller.mas_seller_com_id
			inner join delegate_login on delegate_requests.requested_delegate_id = delegate_login.user_name
			left join seller_org_details on seller_company.seller_com_id = seller_org_details.seller_com_id
			inner join mas_buyer on mas_buyer.mas_buyer_com_id = delegate_login.buyer_com_id
			where request_mode = 'B'
			and 
			(mas_buyer.mas_buyer_com_id = ".$_SESSION['did'].")
			and
			mas_seller.mas_seller_status = 'Y'
			and
			(mas_seller.title_name is not null and mas_seller.title_name <> 'None')
			and
			(mas_seller.name is not null and mas_seller.name <> '')
			and
			mas_seller.delegate = '1'
			and
			seller_org_status = 'Y'
			and
			not exists
			(
			select 
			request_id
			from 
			seller_company sc
			inner join delegate_requests tdr on sc.seller_com_id = tdr.seller_com_id
			inner join buyer_company bc on bc.buyer_com_id = tdr.buyer_com_id
			where tdr.request_mode = 'S'
			and tdr.seller_com_id = seller_company.seller_com_id
			and tdr.buyer_com_id = buyer_company.buyer_com_id
			) 
			and
			not exists 
			(
			select time_slot_id from appointments where appointments.seller_com_id = seller_company.seller_com_id and appointments.buyer_com_id = buyer_company.buyer_com_id
			)

			union

			select 

			seller_company.seller_com_id as scid,
			seller_company.cnt_id as country_id,
			buyer_company.buyer_com_id as bcid,
			seller_company.company_id as cid,
			seller_company.create_date as registeration_date,
			delegate_login.mas_buyer_id as mbcid,
			mas_seller.mas_seller_id as mscid,
			seller_company.company_name as scname, 
			mas_seller.fullname as sname, 
			boothNumber as bno, 
			buyer_company.company_name as bcname, 
			mas_buyer.fullname as bname, 
			delegate_requests.appointment_order,
			'SELLER' as matching_condition
			from 
			seller_company 
			inner join delegate_requests on seller_company.seller_com_id = delegate_requests.seller_com_id
			inner join buyer_company on buyer_company.buyer_com_id = delegate_requests.buyer_com_id
			inner join mas_buyer on buyer_company.buyer_com_id = mas_buyer.mas_buyer_com_id
			inner join seller_delegate_detail on delegate_requests.requested_delegate_id = seller_delegate_detail.username
			inner join delegate_login on delegate_requests.requested_delegate_id = delegate_login.user_name
			left join seller_org_details on seller_company.seller_com_id = seller_org_details.seller_com_id
			inner join mas_seller on delegate_login.mas_seller_id = mas_seller.mas_seller_id
			inner join buyer_missing_fields on buyer_company.buyer_com_id = buyer_missing_fields.buyer_com_id
			where request_mode = 'S'
			and 
			(mas_buyer.mas_buyer_com_id = ".$_SESSION['did'].")
			and
			mas_buyer.mas_buyer_status = 'Y'
			and
			(mas_buyer.title_name is not null and mas_buyer.title_name <> 'None')
			and
			(mas_buyer.name is not null and mas_buyer.name <> '')
			and
			(buyer_missing_fields.prefix_A is not null and mas_buyer.title_name <> 'None')
			and
			mas_buyer.name = buyer_missing_fields.FirstName_A
			and
			seller_delegate_status = 'Y'
			and
			seller_org_status = 'Y'
			and
			not exists
			(
			select 
			request_id
			from 
			seller_company sc
			inner join delegate_requests tdr on sc.seller_com_id = tdr.seller_com_id
			inner join buyer_company bc on bc.buyer_com_id = tdr.buyer_com_id
			where tdr.request_mode = 'B'
			and tdr.seller_com_id = seller_company.seller_com_id
			and tdr.buyer_com_id = buyer_company.buyer_com_id
			) 
			and
			not exists 
			(
			select time_slot_id from appointments where appointments.seller_com_id = seller_company.seller_com_id and appointments.buyer_com_id = buyer_company.buyer_com_id
			)
			and
			(buyer_missing_fields.buyer_missing_fields_status is null or buyer_missing_fields.buyer_missing_fields_status = 'Y')
			)
			sel 
			group by scid, bcid
			order by registeration_date";
			
			$k=mysql_query($qry1);
				
			if(mysql_num_rows($k)>0)
			{
				echo "<table class='table table-bordered table-hover table-striped tablesorter'>";
					//echo "<thead><tr><th style='width:250px;'><b><i>Seller Company</b></i></th><th style='width:150px;'><b><i>Seller Name</b></i></th><th style='width:100px;'><b><i>Matching Type</b></i></th></tr></thead>";
					echo "<thead><tr><th style='width:50%; text-align:center;'>Unmatched Appointment List&nbsp;<i class='fa fa-sort'></i></th><th style='width:20%;text-align:center;'>Requested by&nbsp;<i class='fa fa-sort'></i></th><th style='text-align:center;'>Remark&nbsp;<i class='fa fa-sort'></i></th></tr></thead><tbody>";
				while($krows=mysql_fetch_array($k))
				{
					$cntry="";
					$q=mysql_query("select * from countries where country_id=".$krows['country_id']);
					if(mysql_num_rows($q)>0 && $r=mysql_fetch_array($q))
					{
						$cntry=$r['country_name'];
					}
					echo "<tr><td style='width: 65%;'>".$krows['cid'].", ".$krows['scname'].",&nbsp;&nbsp;&nbsp;(Booth No: ".$krows['bno'].")<br/>".$krows['sname'].", ".$cntry."</td><td>".$krows['matching_condition']."</td><td></td></tr>";
				}
			}
			
			
echo "<tr><td colspan='4'><center><input type='button' class='btn btn-default' style='width: 250px;' id='pdfexp' value='Export Pdf' onclick=\"location.replace('buyer_confirm_match.php?bcid=".$_SESSION['did']."');\" ></center></td></tr>";

echo "</table>";
		
	?>										
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /.row -->
		</div>
</div>

		<!-- /.row -->
</div>
		<!-- /#page-wrapper -->
</div>
		<!-- /#wrapper -->

		<!-- JavaScript -->
		<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.js"></script> 
<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script><script src="js/respond.js"></script>
<![endif]-->

<!-- Page Specific Plugins -->
<script
	src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
<script src="js/morris/chart-data-morris.js"></script>
<script src="js/tablesorter/jquery.tablesorter.js"></script>
<script src="js/tablesorter/tables.js"></script>

</body>
</html>