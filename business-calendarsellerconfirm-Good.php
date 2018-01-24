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
</style>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<title>Seller&nbsp;Confirm</title>

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
echo"<a class='navbar-brand' href='#'>ATCM".$ptm_year." Delegate</a>";
?>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse navbar-ex1-collapse">
<?php
if(isset($_SESSION['mas_user_name']) && $_SESSION['mas_user_name'] == 'Y')
{
	echo "<ul class='nav navbar-nav side-nav'>";
		echo "<li><a href='business-calendarsellermicroenterprice.php'><i class='fa fa-home'></i>&nbsp;Micro&nbsp;Home</a></li>";
		echo "<li><a href='business-calendarseller.php'><i class='fa fa-home'></i>&nbsp;Normal&nbsp;Home</a></li>";
		echo "<li><a href='sellerhome2.php'><i class='fa fa-home'></i>&nbsp;Set2&nbsp;Home</a></li>";
		echo "<li><a href='advanceBuyerList.php'><i class='fa fa-search'></i>&nbsp;Advance Buyer List<br>
		<font class='sidebar-alt'>".$advance_buyer_list."</font></a></li>";
		echo "<li><a href='advanceBuyerList.php'><i class='fa fa-briefcase'></i>View Appointment Requests</a></li>";
		echo "<li><a href='confirmAppointmentRequestBuyer.php'><i class='fa fa-briefcase'></i>&nbsp;Confirm Appointment Requests</a></li>";
/*		
		echo "<li><a href='rejectAppointmentRequestBuyer.php'><i class='fa fa-thumbs-o-down'></i>&nbsp;Rejection of unwanted appointment requests<br>
		<font class='sidebar-alt'>".$rejection_app_date."</font></a></li>";	
		echo "<li class='active'><a href='business-calendarsellerconfirm.php'><i class='fa fa-book'></i>&nbsp;Business Calendar</a></li>
			<li><a href='availableslotseller.php'><i class='fa fa-clock-o'></i>&nbsp;Available Slot</a></li>
			<li class='dropdown open'><a href='#' class='dropdown-toggle' style='background-color: #056495;' data-toggle='dropdown'><i class='fa fa-plus'></i> Pre Addendum List <b class='caret'></b><font class='sidebar-alt'>".$preadd_list."</font></a>
			<ul class='dropdown-menu'>
			<li><a href='advanceBuyerCancellationList.php'>Cancellations</a></li>
			<li><a href='advanceNewBuyerList.php'>New Registrations</a></li>
			</ul>
			</li>";
*/			
		echo "<li><a href='delegate_logout.php'><i class='fa fa-sign-out'></i>&nbsp;Logout</a></li>";
	echo "</ul>";
}
else
{
?>
<ul class="nav navbar-nav side-nav">
	
<?php
	if($_SESSION['chk'] == '3')
	{
		$tq=mysql_query("select * from date_settings where settings_status='Y'");
		$on="";
		$off="";
		if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
		{
			$allon = $rs['set2on'];
			if($allon == 'Y')
			{
				echo "<li><a href='sellerhome2.php'><i class='fa fa-home'></i>&nbsp;Home</a></li>";
			}
			else
			{
				echo "<li><a href='business-calendarsellermicroenterprice.php'><i class='fa fa-home'></i>&nbsp;Home</a></li>";
			}
		}		
	}
	else
	{
		$tq=mysql_query("select * from date_settings where settings_status='Y'");
		$on="";
		$off="";
		if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
		{
			$allon = $rs['set2on'];
			if($allon == 'Y')
			{
				echo "<li><a href='sellerhome2.php'><i class='fa fa-home'></i>&nbsp;Home</a></li>";
			}
			else
			{
				echo "<li><a href='business-calendarseller.php'><i class='fa fa-home'></i>&nbsp;Home</a></li>";
			}
		}	
	}
?>

	<li ><a href="advanceBuyerList.php"><i class="fa fa-search"></i>&nbsp;Advance Buyer List<br>
	<font class="sidebar-alt"><?php echo $advance_buyer_list;?></font></a></li>
<?php
	$tq=mysql_query("select * from date_settings where settings_status='Y'");
	if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
	{
		$vappon = $rs['vappon'];
		if($vappon == 'N')
		{
			echo "<li><a href='confirmAppointmentRequestBuyer.php'><i class='fa fa-briefcase'></i>&nbsp;View Appointment Requests</a></li>";
		}
		else
		{
			$b=false;
			$q=mysql_query("select * from delegate_requests where requested_delegate_id='".$_SESSION['user_name']."' and request_mode='S'");
			if(mysql_num_rows($q)>0 && $r=mysql_fetch_array($q))
			{
				$b=true;
			}
			if($b)
			{
				echo "<li><a href='confirmAppointmentRequestBuyer.php'><i class='fa fa-briefcase'></i>
		View Appointment Requests</a></li>";
			}
			else
			{
				echo "<li><a href='advanceBuyerList.php'><i class='fa fa-briefcase'></i>
		View Appointment Requests</a></li>";
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
/*			
			if($on == 'Y' && $avsd != 'Y')
			{
				echo "<li><a href='rejectAppointmentRequestBuyer.php'><i class='fa fa-thumbs-o-down'></i>&nbsp;Rejection of unwanted appointment requests<br>
	<font class='sidebar-alt'>".$rejection_app_date."</font></a></li>";
			}
			else
			{
					echo "<li><a href='#'><i class='fa fa-thumbs-o-down'></i>&nbsp;Rejection of unwanted appointment requests<br>
	<font class='sidebar-alt'>".$rejection_app_date."</font></a></li>";
			}
*/			
		}
?>
<?php
		$tq=mysql_query("select * from date_settings where settings_status='Y'");
		$on="";
		$off="";
		if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
		{
			$allon = $rs['set2on'];
			if($allon == 'Y')
			{
						echo "<li class='active'><a href='business-calendarsellerconfirm.php'><i class='fa fa-book'></i>&nbsp;Business Calendar</a></li>";
/*		
						echo "<li class='active'><a href='business-calendarsellerconfirm.php'><i class='fa fa-book'></i>&nbsp;Business Calendar</a></li>
							<li><a href='availableslotseller.php'><i class='fa fa-clock-o'></i>&nbsp;Available Slot</a></li>
							<li class='dropdown open'><a href='#' class='dropdown-toggle' style='background-color: #056495;'
								data-toggle='dropdown'><i class='fa fa-plus'></i> Pre Addendum
							List <b class='caret'></b><font class='sidebar-alt'>".$preadd_list."</font></a>
							<ul class='dropdown-menu'>
									<li><a href='advanceBuyerCancellationList.php'>Cancellations</a></li>
									<li><a href='advanceNewBuyerList.php'>New Registrations</a></li>
							</ul>
						</li>";
*/						
			}
			else
			{
				echo "<li><a href='#'><i class='fa fa-book'></i>&nbsp;Business Calendar</a></li>";
/*				
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
		class="fa fa-user"></i>&nbsp;&nbsp;<?php echo $_SESSION['comname']; ?> <b class="caret"></b></a>
	<ul class="dropdown-menu">
		<?php echo"<li><a href=\"sellerDetailsown.php?id=".$_SESSION['did']."\"> <i class='fa fa-user'></i> Profile</a></li>"; ?>
		<li class="divider"></li>
		<li><a href="delegate_logout.php"><i class="fa fa-power-off"></i> Log Out</a></li>
	</ul>
	</li>
</ul>

			</div>
			<!-- /.navbar-collapse -->
		</nav>

		<div id="page-wrapper">
			<!-- /.row -->
			<?php
			$q=mysql_query("select sc.company_name, sc.company_id, sc.cnt_id from seller_company sc, mas_seller ms where ms.mas_seller_com_id=sc.seller_com_id and ms.mas_seller_status='Y' and sc.seller_status='Y' and ms.delegate='1' and sc.seller_com_id = ".$_SESSION['did']);
			if(mysql_num_rows($q)>0)
			{
				while($r=mysql_fetch_array($q))
				{
						$scname= $r['company_name'];
						$scomid= $r['company_id'];
						$cntry="";
						$q1=mysql_query("select * from countries where country_id='".$r['cnt_id']."'"	);
						if(mysql_num_rows($q1)>0 && $r1=mysql_fetch_array($q1))
						{
							$scountry=$r1['country_name'];
						}
				}
			}
			
			$q=mysql_query("select fullname from mas_seller inner join seller_delegate_detail on mas_seller.mas_seller_id = seller_delegate_detail.mas_seller_id and username = '".$_SESSION['user_name']."' and seller_delegate_status = 'Y' and mas_seller_status = 'Y'");
			
			if(mysql_num_rows($q)>0 && $r=mysql_fetch_array($q))
			{
				$sname= $r['fullname'];
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
							<span style="font-size:16px; font-weight:Bold; font-family:Arial;">PATA Adventure Travel Conference and Mart <?php echo $ptm_year;?> <br>SELLER APPOINTMENT SCHEDULE <br><?php echo $scname; ?>, <?php echo $scountry; ?> <br><?php echo $sname; ?> <br>Reg. No : <?php echo $scomid; ?></span>
						</div>
						<div class="col-lg-2">
							<span style="font-size:16px; font-weight:Bold; font-family:Times;float:right; margin-right:50px; margin-top:30px;"><?php echo $_SESSION['user_name']; ?></span>
						</div>
					</div>
						
						<div class="panel-body">
							<div class="panel-body">
								<div class="table-responsive">
<?php

echo "<table class='table table-bordered table-hover table-striped tablesorter'>";
echo "<thead><tr><th style='width:10%;text-align:center;'>Date&nbsp;<i class='fa fa-sort'></i></th><th style='width:10%;text-align:center;'>Start Time&nbsp;<i class='fa fa-sort'></i></th><th style='width:10%;text-align:center;'>End Time&nbsp;<i class='fa fa-sort'></i></th><th style='width:32%;text-align:center;'>Details&nbsp;<i class='fa fa-sort'></i></th><th style='width:20%;text-align:center;'>Requested By&nbsp;<i class='fa fa-sort'></i></th><th style='width:20%;text-align:center;'>Signature&nbsp;<i class='fa fa-sort'></i></th></tr></thead>";
//echo "<thead><tr><th>Buyer Company</th><th>Delegate Name</th><th>Date</th><th>Slot Start</th><th>Slot End</th><th>Description</th><th>Booth Number</th></tr></thead>";

			$scid = $_SESSION['msid'];
			/*$qry=mysql_query("select 
			CASE
				WHEN time_slots.slottype = 't' THEN buyer_company.company_name
				ELSE time_slot_description
			END as bcname,
			CASE
				WHEN time_slots.slottype = 't' THEN mas_buyer.fullname
				ELSE ''
			END as bname, 
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
			and mas_seller.mas_seller_id in (select mas_seller_id from seller_delegate_detail where username = '".$_SESSION['user_name']."')
			order by time_slot_date, time_slot_id_from");*/
			
			$qry=mysql_query("select 
			buyer_company.company_id as bcomid, 
			CASE
				WHEN time_slots.slottype = 't' THEN buyer_company.company_name
				ELSE time_slot_description
			END as bcname,
			CASE
				WHEN time_slots.slottype = 't' THEN mas_buyer.fullname
				ELSE ''
			END as bname, 
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
			time_slots.slottype,	
			buyer_company.cnt_id as bcountry_id,
			seller_company.cnt_id as scountry_id,
			time_slots.time_slot_description,
			time_slots.venue,
			mas_buyer.mas_buyer_id as bcid, 
			mas_seller.mas_seller_id as scid
			from 
			( select *, 'g' as slottype from time_slots_generic where time_slot_date > '".$bussinessconfirm_date."' union select *, 't' as slottype from time_slots ) time_slots  
			left join appointments on time_slots.time_slot_id = appointments.time_slot_id and appointments.mas_seller_com_id in (select mas_seller_id from seller_delegate_detail where username = '".$_SESSION['user_name']."')
			left join seller_company on appointments.seller_com_id = seller_company.seller_com_id
			left join buyer_company on appointments.buyer_com_id = buyer_company.buyer_com_id
			left join mas_seller on appointments.mas_seller_com_id = mas_seller.mas_seller_id
			left join mas_buyer on appointments.mas_buyer_com_id = mas_buyer.mas_buyer_id
			left join seller_org_details on appointments.seller_com_id = seller_org_details.seller_com_id and seller_org_details.seller_org_status = 'Y'
			order by time_slot_date, session, in_session");
			
		
			/*if(mysql_num_rows($qry)>0)
			{
				while($krows=mysql_fetch_array($qry))
				{						
					echo "<tbody><tr><td>".$krows['bcname']."</td><td>".$krows['bname']."</td><td>".$krows['time_slot_date']."</td><td>".$krows['time_slot_id_from']."</td><td>".$krows['time_slot_id_to']."</td><td>".$krows['time_slot_description']."</td><td>".$krows['bno']."</td></tr></tbody>";	
				}
			}*/
			
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
					
					$cntry="";
					
					if($krows['scountry_id'] != '')
					{
						$q=mysql_query("select * from countries where country_id=".$krows['scountry_id']);
						if(mysql_num_rows($q)>0 && $r=mysql_fetch_array($q))
						{
							$scountry=$r['country_name'];
						}
					}
					if($krows['bcountry_id'] != '' )
					{
						$q=mysql_query("select * from countries where country_id=".$krows['bcountry_id']);
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
						if($krows['bcomid'] != "")
						{
							$descrip="Reg No : ".$krows['bcomid']."<br>".$krows['bcname'].", ".$cntry."<br>".$krows['bname'];
						}
						else
						{
							$descrip = "";
						}
					}
					
					$sdesc="";
					if($krows['bname'] !="")
					{
						if($arequest == 'MUTUAL')
						{
							echo "<tbody><tr><td>".$krows['time_slot_date']."</td><td>".$krows['time_slot_id_from']."</td><td>".$krows['time_slot_id_to']."</td><td>".$descrip."</td><td style='color:rgb(255,0,0);'>".$arequest."</td><td style='text-align:center;'></td></tr></tbody>";	
						}
						else
						{
							echo "<tbody><tr><td>".$krows['time_slot_date']."</td><td>".$krows['time_slot_id_from']."</td><td>".$krows['time_slot_id_to']."</td><td>".$descrip."</td><td>".$arequest."</td><td style='text-align:center;'></td></tr></tbody>";	
						}
						$sdesc = $krows['time_slot_description'];
					}
					else
					{
						if($descrip=='End of Day 1' || $descrip=='End of Business Session')
						{
							echo "<tbody><tr><td></td><td>".$krows['time_slot_id_from']."</td><td>".$krows['time_slot_id_to']."</td><td style='border: 1px solid grey; text-align:center;color:rgb(0,0,0);background-color:rgb(200,200,200);'>".$descrip."</td><td style='border: 1px solid grey; color:white;background-color:rgb(200,200,200);'></td><td style='border: 1px solid grey; color:white;background-color:rgb(200,200,200);'></td></tr></tbody>";
						}
						else if($descrip == "")
						{
							echo "<tbody><tr><td>".$krows['time_slot_date']."</td><td>".$krows['time_slot_id_from']."</td><td>".$krows['time_slot_id_to']."</td><td>".$descrip."</td><td></td><td style='text-align:center;'></td></tr></tbody>";	
						}
						else
						{
							echo "<tbody><tr><td>".$krows['time_slot_date']."</td><td>".$krows['time_slot_id_from']."</td><td>".$krows['time_slot_id_to']."</td><td style='border: 1px solid grey; color:rgb(255,255,255);background-color:rgb(120,120,120);'>".$descrip."</td><td style='border: 1px solid grey; color:white;background-color:rgb(120,120,120);'></td><td style='border: 1px solid grey; color:white;background-color:rgb(120,120,120);'></td></tr></tbody>";
						}
						
					}				
					//echo "<tbody><tr><td>".$krows['bcname']."</td><td>".$krows['bname']."</td><td>".$krows['time_slot_date']."</td><td>".$krows['time_slot_id_from']."</td><td>".$krows['time_slot_id_to']."</td><td>".$krows['time_slot_description']."</td><td>".$krows['bno']."</td><td>".$krows['type']."</td></tr></tbody>";	
				}
			}

echo "</table>";
					
	?>	
										
										
									
								</div>
<br>
<!-- No more this part for seller 16-Aug-16
<div>
<img src="images/report_question_all.png" />
<div>
-->
<br>
			<!-- /.row -->

								<div class="table-responsive">
<?php

$scid=$_SESSION['user_name'];
			/*$qry1 = "select * from
			(
			select 
			seller_company.seller_com_id as scid,
			buyer_company.buyer_com_id as bcid,
			buyer_company.create_date as registeration_date,
			delegate_login.mas_seller_id as mscid,
			mas_buyer.mas_buyer_id as mbcid,
			seller_company.company_name as scname, 
			mas_seller.fullname as sname, 
			boothNumber as bno, 
			buyer_company.company_name as bcname, 
			mas_buyer.fullname as bname, 
			delegate_requests.appointment_order,
			'Seller Request' as matching_condition
			from 
			seller_company 
			inner join delegate_requests on seller_company.seller_com_id = delegate_requests.seller_com_id
			inner join buyer_company on buyer_company.buyer_com_id = delegate_requests.buyer_com_id
			inner join mas_buyer on buyer_company.buyer_com_id = mas_buyer.mas_buyer_com_id
			left join seller_org_details on seller_company.seller_com_id = seller_org_details.seller_com_id
			inner join delegate_login on delegate_requests.requested_delegate_id = delegate_login.user_name
			inner join mas_seller on delegate_login.mas_seller_id = mas_seller.mas_seller_id
			where request_mode = 'S'
			and 
			delegate_login.mas_seller_id in (select mas_seller_id from seller_delegate_detail where username = '".$scid."')
			and
			delegate_requests.reject <> 'Y'
			and
			mas_buyer.mas_buyer_status = 'Y'
			and
			exists
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

			union
			
			select 
			seller_company.seller_com_id as scid,
			buyer_company.buyer_com_id as bcid,
			buyer_company.create_date as registeration_date,
			delegate_login.mas_seller_id as mscid,
			mas_buyer.mas_buyer_id as mbcid,
			seller_company.company_name as scname, 
			mas_seller.fullname as sname, 
			boothNumber as bno, 
			buyer_company.company_name as bcname, 
			mas_buyer.fullname as bname, 
			delegate_requests.appointment_order,
			'Seller Request' as matching_condition
			from 
			seller_company 
			inner join delegate_requests on seller_company.seller_com_id = delegate_requests.seller_com_id
			inner join buyer_company on buyer_company.buyer_com_id = delegate_requests.buyer_com_id
			inner join mas_buyer on buyer_company.buyer_com_id = mas_buyer.mas_buyer_com_id
			left join seller_org_details on seller_company.seller_com_id = seller_org_details.seller_com_id
			inner join delegate_login on delegate_requests.requested_delegate_id = delegate_login.user_name
			inner join mas_seller on delegate_login.mas_seller_id = mas_seller.mas_seller_id
			where request_mode = 'S'
			and 
			delegate_login.mas_seller_id in (select mas_seller_id from seller_delegate_detail where username = '".$scid."')
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

			union
			
			select 
			seller_company.seller_com_id as scid,
			buyer_company.buyer_com_id as bcid,
			buyer_company.create_date as registeration_date,
			mas_seller.mas_seller_id as mscid,
			mas_buyer.mas_buyer_id as mbcid,
			seller_company.company_name as scname, 
			mas_seller.fullname as sname, 
			boothNumber as bno, 
			buyer_company.company_name as bcname, 
			mas_buyer.fullname as bname, 
			delegate_requests.appointment_order,
			'Buyer Request' as matching_condition
			from 
			seller_company 
			inner join delegate_requests on seller_company.seller_com_id = delegate_requests.seller_com_id
			inner join buyer_company on buyer_company.buyer_com_id = delegate_requests.buyer_com_id
			inner join mas_buyer on buyer_company.buyer_com_id = mas_buyer.mas_buyer_com_id
			left join seller_org_details on seller_company.seller_com_id = seller_org_details.seller_com_id
			inner join mas_seller on seller_company.seller_com_id = mas_seller.mas_seller_com_id
			where request_mode = 'B'
			and 
			mas_seller.mas_seller_id in (select mas_seller_id from seller_delegate_detail where username = '".$scid."')
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
			where tdr.request_mode = 'S'
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
					echo "<tbody><tr><td>".$krows['bcname']."</td><td>".$krows['bname']."</td><td>Unmatched</td></tr></tbody>";	
				}
			}*/
			
			$qry1 ="select * from
			(
			select 
			seller_company.seller_com_id as scid,
			buyer_company.cnt_id as bcountry_id,
			buyer_company.buyer_com_id as bcid,
			buyer_company.company_id as cid,
			buyer_company.create_date as registeration_date,
			delegate_login.mas_seller_id as mscid,
			mas_buyer.mas_buyer_id as mbcid,
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
			left join seller_org_details on seller_company.seller_com_id = seller_org_details.seller_com_id
			inner join delegate_login on delegate_requests.requested_delegate_id = delegate_login.user_name
			inner join mas_seller on delegate_login.mas_seller_id = mas_seller.mas_seller_id
			where request_mode = 'S'
			and 
			delegate_login.mas_seller_id in (select mas_seller_id from seller_delegate_detail where username = '".$scid."')
			and
			mas_buyer.mas_buyer_status = 'Y'
			and
			exists
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

			union
			
			select 
			seller_company.seller_com_id as scid,
			buyer_company.cnt_id as bcountry_id,
			buyer_company.buyer_com_id as bcid,
			buyer_company.company_id as cid,
			buyer_company.create_date as registeration_date,
			delegate_login.mas_seller_id as mscid,
			mas_buyer.mas_buyer_id as mbcid,
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
			left join seller_org_details on seller_company.seller_com_id = seller_org_details.seller_com_id
			inner join delegate_login on delegate_requests.requested_delegate_id = delegate_login.user_name
			inner join mas_seller on delegate_login.mas_seller_id = mas_seller.mas_seller_id
			where request_mode = 'S'
			and 
			delegate_login.mas_seller_id in (select mas_seller_id from seller_delegate_detail where username = '".$scid."')
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

			union
			
			select 
			seller_company.seller_com_id as scid,
			buyer_company.cnt_id as bcountry_id,
			buyer_company.buyer_com_id as bcid,
			buyer_company.company_id as cid,
			buyer_company.create_date as registeration_date,
			mas_seller.mas_seller_id as mscid,
			mas_buyer.mas_buyer_id as mbcid,
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
			inner join mas_buyer on buyer_company.buyer_com_id = mas_buyer.mas_buyer_com_id
			left join seller_org_details on seller_company.seller_com_id = seller_org_details.seller_com_id
			inner join mas_seller on seller_company.seller_com_id = mas_seller.mas_seller_com_id
			where request_mode = 'B'
			and 
			mas_seller.mas_seller_id in (select mas_seller_id from seller_delegate_detail where username = '".$scid."')
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
			where tdr.request_mode = 'S'
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
				echo "<table class='table table-bordered table-hover table-striped tablesorter'>";
//echo "<thead><tr><th style='width:250px;'><b><i>Buyer Company</b></i></th><th style='width:150px;'><b><i>Buyer Name</b></i></th><th style='width:100px;'><b><i>Matching Type</b></i></th></tr></thead>";

echo "<thead><tr><th style='text-align:center;width:50%;'>Unmatched Appointment List&nbsp;<i class='fa fa-sort'></i></th><th style='width:20%;text-align:center;'>Requested by&nbsp;<i class='fa fa-sort'></i></th><th style='text-align:center;'>Remark&nbsp;<i class='fa fa-sort'></i></th></tr></thead><tbody>";
				while($krows=mysql_fetch_array($k))
				{		
					$cntry="";
					$q=mysql_query("select * from countries where country_id=".$krows['bcountry_id']);
					if(mysql_num_rows($q)>0 && $r=mysql_fetch_array($q))
					{
						$cntry=$r['country_name'];
					}				
					
					echo "<tr><td>".$krows['cid'].", ".$krows['bcname'].",<br>".$krows['bname'].", ".$cntry."</td><td >".$krows['matching_condition']."<td></td></tr>";
					//echo "<tr><td>".$krows['bcname']."</td><td>".$krows['bname']."</td><td>Unmatched</td></tr></tbody>";	
				}
			}
			
			
echo "<tr><td colspan='4'><center><input type='button' class='btn btn-default' style='width: 250px;' id='pdfexp' value='Export Pdf' onclick=\"location.replace('seller_confirm_match.php?scid=".$_SESSION['user_name']."');\" ></center></td></tr>";
			
echo "</tbody></table>";
					
	?>	
										
										
									
								</div>
							</div>
						</div>
					</div>
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