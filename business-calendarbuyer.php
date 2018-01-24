<?php
require_once("query/connectivity.php");
session_start();
if(!isset($_SESSION['did']))
{
	header("Location:delegate_login.php?mes=Session has Expired");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width&#44; initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<title>Dashboard</title>

<!-- Bootstrap core CSS -->
<link href="css/bootstrap.css" rel="stylesheet">

<!-- Add custom CSS here -->
<link href="css/sb-admin.css" rel="stylesheet">
<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
<!-- Page Specific CSS -->
<link rel="stylesheet" href="css/morris-0.4.3.min.css">
</head>

<body>

<div id="wrapper"><!-- Sidebar -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
<!-- Brand and toggle get grouped for better mobile display -->
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse"
	data-target=".navbar-ex1-collapse"><span class="sr-only">Toggle
navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span>
<span class="icon-bar"></span></button>
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
			$deadline_app=$edateoo['deadline_app'];
			$rejection_timeline=$edateoo['rejection_timeline'];
		}
	}
echo"<a class='navbar-brand' href='#'>ATRTCM".$ptm_year." Delegate</a>";
?></div>

<!-- Collect the nav links&#44; forms&#44; and other content for toggling -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
<?php
if(isset($_SESSION['mas_user_name']) && $_SESSION['mas_user_name'] == 'Y')
{
	echo "<ul class='nav navbar-nav side-nav'>";
	echo "<li><a href='business-calendarbuyeroneday.php'><i class='fa fa-home'></i>&nbsp;One&nbsp;Day&nbsp;Home</a></li>";
	echo "<li class='active'><a href='business-calendarbuyer.php'><i class='fa fa-home'></i>&nbsp;Normal&nbsp;Home</a></li>";
	echo "<li><a href='buyerhome2.php'><i class='fa fa-home'></i>&nbsp;Set2&nbsp;Home</a></li>";	
	echo "<li><a href='advanceSellerList.php'><i class='fa fa-search'></i> Advance Seller List<br><font class='sidebar-alt'>".$advance_buyer_list."</font></a></li>";
// VM 9-Feb-17
//	echo "<li><a href='appointmentRequestSellerList.php'><i class='fa fa-briefcase'></i>Appointment Requests</a></li>";
	echo "<li><a href='viewAppointmentRequestSeller.php'><i class='fa fa-briefcase'></i>View Appointment Requests</a></li>";
	echo "<li><a href='confirmAppointmentRequestSeller.php'><i class='fa fa-briefcase'></i>Confirm&nbsp;Appointment Requests</a></li>";
	echo "<li><a href='rejectAppointmentRequestSeller.php'><i class='fa fa-thumbs-o-down'></i>&nbsp;Rejection of unwanted appointment requests<br>
	<font class='sidebar-alt'>".$rejection_app_date."</font></a></li>";
	echo"<li><a href='business-calendarbuyerconfirm.php'><i class='fa fa-book'></i>&nbsp;Business Calendar</a></li>
		<li><a href='availableslotbuyer.php'><i class='fa fa-clock-o'></i>&nbsp;Available Slot</a></li>
		<li class='dropdown open'><a href='#' style='background-color: #056495;' data-toggle='dropdown'><i class='fa fa-plus'></i> Pre Addendum
		List <b class='caret'></b><font class='sidebar-alt'>".$preadd_list."</font></a>
			<ul class='dropdown-menu'>
				<li><a href='advanceSellerCancellationList.php'>Cancellations</a></li>
				<li><a href='advanceNewSellerList.php'>New Registrations</a></li>
			</ul>
		</li>";
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
				echo "<li class='active'><a href='buyerhome2.php'><i class='fa fa-home'></i>&nbsp;Home</a></li>";
			}	
			else
			{
				echo "<li class='active'><a href='business-calendarbuyeroneday.php'><i class='fa fa-home'></i>&nbsp;Home</a></li>";
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
				echo "<li class='active'><a href='buyerhome2.php'><i class='fa fa-home'></i>&nbsp;Home</a></li>";
			}	
			else
			{	
				echo "<li class='active'><a href='business-calendarbuyer.php'><i class='fa fa-home'></i>&nbsp;Home</a></li>";
			}
		}	
	}
?>
	<li><a href="advanceSellerList.php"><i
		class="fa fa-search"></i> Advance Seller List<br>
	<font class="sidebar-alt"><?php echo $advance_buyer_list;?></font></a></li>
<?php
	$tq=mysql_query("select * from date_settings where settings_status='Y'");
	if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
	{
		$vappon = $rs['vappon'];
		if($vappon == 'N')
		{
			echo "<li><a href='confirmAppointmentRequestSeller.php'><i class='fa fa-briefcase'></i>&nbsp;Appointment Requests</a></li>";
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
// VM 9-Feb-17				
				echo "<li><a href='viewAppointmentRequestSeller.php'><i class='fa fa-briefcase'></i>
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
			if($on == 'Y' && $avsd != 'Y')
			{
				echo "<li><a href='rejectAppointmentRequestSeller.php'><i class='fa fa-thumbs-o-down'></i>&nbsp;Rejection of unwanted appointment requests<br>
	<font class='sidebar-alt'>".$rejection_app_date."</font></a></li>";
			}
			else
			{
/* VM 8-Feb-17				
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
					echo"<li><a href='business-calendarbuyerconfirm.php'><i class='fa fa-book'></i>&nbsp;Business Calendar</a></li>
					<li><a href='availableslotbuyer.php'><i class='fa fa-clock-o'></i>&nbsp;Available Slot</a></li>
					<li class='dropdown open'><a href='#' style='background-color: #056495;' data-toggle='dropdown'><i class='fa fa-plus'></i> Pre Addendum
		List <b class='caret'></b><font class='sidebar-alt'>".$preadd_list."</font></a>
							<ul class='dropdown-menu'>
									<li><a href='advanceSellerCancellationList.php'>Cancellations</a></li>
									<li><a href='advanceNewSellerList.php'>New Registrations</a></li>
							</ul>
					</li>";
			}
			else
			{
/* VM 8-Feb-17				
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
	<b class="caret"></b></a>
	<ul class="dropdown-menu">
		<?php echo"<li><a href=\"buyerDetailsown.php?id=".$_SESSION['did']."\"> <i class='fa fa-user'></i> Profile</a></li>"; ?>
		<li class="divider"></li>
		<li><a href="delegate_logout.php"><i class="fa fa-power-off"></i>
		Log Out</a></li>
	</ul>
	</li>
</ul>
</div>
<!-- /.navbar-collapse --></nav>

<div id="page-wrapper">

<div class="row">
<div class="col-lg-12">
<h1>Buyer Menu</h1>
<ol class="breadcrumb">
	<li class="active"><i class="fa fa-home"></i> Home</li>
</ol>

<div class="row">
<div class="col-lg-4">
<div class="panel panel-danger">
<div class="panel-heading"><a href="advanceSellerList.php">
<div class="row">
<div class="col-xs-3"><i class="fa fa-search fa-3x"></i></div>
<div class="col-xs-9 text-left" style="margin-top: 10px;"><b
	class="announcement-text">Advance Seller List</b></div>
</div>
</a></div>
</div>
</div>
<div class="col-lg-4">
<div class="panel panel-danger">
<div class="panel-heading">
<?php

	$tq=mysql_query("select * from date_settings where settings_status='Y'");
	if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
	{
		$vappon = $rs['vappon'];
		if($vappon == 'N')
		{
			echo "<a href='confirmAppointmentRequestSeller.php'>";
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
				echo "<a href='confirmAppointmentRequestSeller.php'>";
			}
			else
			{
// VM 9-Feb-17				
				echo "<a href='viewAppointmentRequestSeller.php'>";
			}
		}
	}	
?>
<div class="row">
<div class="col-xs-3"><i class="fa fa-briefcase fa-3x"></i></div>
<div class="col-xs-9 text-left" style="margin-top: 10px;"><b
	class="announcement-text">View Appointment Requests</b></div>
</div>
</a></div>
</div>
</div>

<?php
if(isset($_SESSION['mas_user_name']) && $_SESSION['mas_user_name'] == 'Y')
{
		echo 	"<div class='col-lg-4'>
						<div class='panel panel-danger'>
						<div class='panel-heading'><a
							href='rejectAppointmentRequestSeller.php'>
						<div class='row'>
						<div class='col-xs-3'><i class='fa fa-thumbs-o-down fa-3x'></i></div>
						<div class='col-xs-9 text-left' style='margin-top: 10px;'><b
							class='announcement-text'>Rejection of unwanted appointment
						requests</b></div>
						</div></div>
						</a></div>
						</div>";
}
else
{
		$tq=mysql_query("select * from date_settings where settings_status='Y'");
		$on="";
		$off="";
		if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
		{
			$avsd = $rs['available_slot'];
			$on = $rs['app_rejection_on'];
			if($on == 'Y' && $avsd != 'Y')
			{
				echo 	"<div class='col-lg-4'>
						<div class='panel panel-danger'>
						<div class='panel-heading'><a
							href='rejectAppointmentRequestSeller.php'>
						<div class='row'>
						<div class='col-xs-3'><i class='fa fa-thumbs-o-down fa-3x'></i></div>
						<div class='col-xs-9 text-left' style='margin-top: 10px;'><b
							class='announcement-text'>Rejection of unwanted appointment
						requests</b></div>
						</div></div>
						</a></div>
						</div>";		
			}
			else
			{
/* VM 8-Feb-17				
				echo 	"<div class='col-lg-4'>
						<div class='panel panel-danger'>
						<div class='panel-heading'><a href='#'>
						<div class='row'>
						<div class='col-xs-3'><i class='fa fa-thumbs-o-down fa-3x'></i></div>
						<div class='col-xs-9 text-left' style='margin-top: 10px;'><b
							class='announcement-text'>Rejection of unwanted appointment
						requests</b></div>
						</div></div>
						</a></div>
						</div>";
*/						
			}
		}
	}	
?>

</div>

<div class="row">
<?php
if(isset($_SESSION['mas_user_name']) && $_SESSION['mas_user_name'] == 'Y')
{
	echo "<div class='col-lg-4'>
						<div class='panel panel-danger'>
						<div class='panel-heading'><a href='business-calendarbuyerconfirm.php'>
						<div class='row'>
						<div class='col-xs-3'><i class='fa fa-book fa-3x'></i></div>						
						<div class='col-xs-9 text-left' style='margin-top: 10px;'><b
							class='announcement-text'>Business Calendar</b></div>
						</div>
						</a></div>
						</div>
						</div>
						<div class='col-lg-4'>
						<div class='panel panel-danger'>
						<div class='panel-heading'><a href='availableslotbuyer.php'>
						<div class='row'>
						<div class='col-xs-3'><i class='fa fa-clock-o fa-3x'></i></div>
						<div class='col-xs-9 text-left' style='margin-top: 10px;'><b
							class='announcement-text'>Available Slot</b></div>
						</div>
						</a></div>
						</div>
						</div>

						<div class='col-lg-4'>
						<div class='panel panel-danger'>
						<div class='panel-heading'>
						<div class='row' style='height: 50px; margin-bottom: -10px;'>
						<div class='col-xs-3'><i class='fa fa-plus fa-3x'></i></div>
						<div class='col-xs-9 text-left' style='margin-top: -8px;'><b
							class='announcement-text'>Pre Addendum List</b>
						<ul style='font-size: 12px; margin-bottom: 0px;'>
						<li><a href='advanceSellerCancellationList.php'>Cancellations</a></li>
						<li><a href='advanceNewSellerList.php'>New Registrations</a></li>
						</ul>
						</div>
						</div>
						</div>
						</div>
						</div>";
}
else
{
		$tq=mysql_query("select * from date_settings where settings_status='Y'");
		if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
		{
			$allon = $rs['set2on'];
			if($allon == 'Y')
			{
				echo "<div class='col-lg-4'>
						<div class='panel panel-danger'>
						<div class='panel-heading'><a href='business-calendarbuyerconfirm.php'>
						<div class='row'>
						<div class='col-xs-3'><i class='fa fa-book fa-3x'></i></div>
						<div class='col-xs-9 text-left' style='margin-top: 10px;'><b
							class='announcement-text'>Business Calendar</b></div>
						</div>
						</a></div>
						</div>
						</div>
						<div class='col-lg-4'>
						<div class='panel panel-danger'>
						<div class='panel-heading'><a href='availableslotbuyer.php'>
						<div class='row'>
						<div class='col-xs-3'><i class='fa fa-clock-o fa-3x'></i></div>
						<div class='col-xs-9 text-left' style='margin-top: 10px;'><b
							class='announcement-text'>Available Slot</b></div>
						</div>
						</a></div>
						</div>
						</div>

						<div class='col-lg-4'>
						<div class='panel panel-danger'>
						<div class='panel-heading'>
						<div class='row' style='height: 50px; margin-bottom: -10px;'>
						<div class='col-xs-3'><i class='fa fa-plus fa-3x'></i></div>
						<div class='col-xs-9 text-left' style='margin-top: -8px;'><b
							class='announcement-text'>Pre Addendum List</b>
						<ul style='font-size: 12px; margin-bottom: 0px;'>
						<li><a href='advanceSellerCancellationList.php'>Cancellations</a></li>
						<li><a href='advanceNewSellerList.php'>New Registrations</a></li>
						</ul>
						</div>
						</div>
						</div>
						</div>
						</div>";
			}
			else
			{
/* VM 8-Feb-17				
				echo "<div class='col-lg-4'>
						<div class='panel panel-danger'>
						<div class='panel-heading'><a href='#'>
						<div class='row'>
						<div class='col-xs-3'><i class='fa fa-book fa-3x'></i></div>
						<div class='col-xs-9 text-left' style='margin-top: 10px;'><b
							class='announcement-text'>Business Calendar</b></div>
						</div>
						</a></div>
						</div>
						</div>
						<div class='col-lg-4'>
						<div class='panel panel-danger'>
						<div class='panel-heading'><a href='#'>
						<div class='row'>
						<div class='col-xs-3'><i class='fa fa-clock-o fa-3x'></i></div>
						<div class='col-xs-9 text-left' style='margin-top: 10px;'><b
							class='announcement-text'>Available Slot</b></div>
						</div>
						</a></div>
						</div>
						</div>

						<div class='col-lg-4'>
						<div class='panel panel-danger'>
						<div class='panel-heading'>
						<div class='row' style='height: 50px; margin-bottom: -10px;'>
						<div class='col-xs-3'><i class='fa fa-plus fa-3x'></i></div>
						<div class='col-xs-9 text-left' style='margin-top: -8px;'><b
							class='announcement-text'>Pre Addendum List</b>
						<ul style='font-size: 12px; margin-bottom: 0px;'>
						<li><a href='#'>Cancellations</a></li>
						<li><a href='#'>New Registrations</a></li>
						</ul>
						</div>
						</div>
						</div>
						</div>
						</div>";
			*/
			}
		}
	}	
?>

</div>
<!-- /.row -->

<div class="row">
<div class="col-lg-12">
<div class="panel panel-primary">
<div class="panel-body"><br>
<h3 style="font-size: 20px; color: #993300; font-weight: bold;">Welcome
to ATRTCM<?php echo $ptm_year;?> Appointment Request Online&#33;</h3>
<br>
<p style="font-weight: normal; color: black;">
It’s now the opportunity to request your business
appointments online.</p>

<p style="font-weight: normal; color: black;">As a buyer who has
completed your ATRTCM<?php echo $ptm_year;?> registration before Dec 22&#44; we invite you to
request and prioritise 25 of your preferred Sellers from the Advance Seller List.
However, please note that the maximum pre-matched appointments that you will receive are only 20. 
PATA will endeavour now to pre&#45;match 100&#37; of the Buyer and Seller appointments using a
computerised matching software&#44; minimising the need for any
on&#45;site or your own appointment scheduling.</p>
<br>
<p style="font-weight: normal; color: black;">Please follow the
instructions below to request your business appointments online:</p>

<p style="font-weight: normal; color: black;">1. To view the
complete list and profile of Sellers registered in time for computerised
appointment matching&#44; please click on the<br>
&nbsp;&nbsp;&nbsp;&nbsp;<b><u>Advance Seller List</b></u>.</p>
<ul>
<li><p style="font-weight: normal; color: black;">The Advance Seller List webpage lists all Sellers by organisations alphabetically. 
You may use the advance search function to find your preferred Seller by organisation name, 
business profile and country representation.</p>
</li>
</ul>
<p style="font-weight: normal; color: black;">
2. To view the seller profile, simply click on the Seller organisation name.</p>
<p style="font-weight: normal; color: black;">
3. To commence your business appointment request, please click on ‘Requests This Seller’ at the bottom of Seller Profile.</p> 
<p style="font-weight: normal; color: black;">
4. PATA recommend to select at least 20 appointment requests.</p>
<p style="font-weight: normal; color: black;">
5. Go to '<b><u>View Appointment Requests</b></u>' for listing of all your selections.</p>
<ul>
<li>
<p style="font-weight: normal; color: black;">
Please remember to click on the 'save' button every time you made some changes.</p>
</li>
<li>
<p style="font-weight: normal; color: black;">
If you do not want to request all 25 appointments at one time, you can logout and revisit this site again later. 
All saved appointment requests will be intact.</p>
</li>
<li>
<p style="font-weight: normal; color: black;">
You can prioritise your appointment requests by using the arrow to move your selections up and down. 
The smaller numbers are more important and will be given priority in the matching process. 
(1 = first priority, 25 = last priority)</p>
</li>
<li>
<p style="font-weight: normal; color: black;">
To delete any requested appointments, simply click on the 'Trash' button (extreme right column) and 
return to the Advance Seller list page to start your request again.</p>
</li>
</ul>
<p style="font-weight: normal; color: black;">
6. After prioritise your 20-25 selection, please ensure by click save button before leaving the page. Once you made exact total 25 selections, the submit button will be activated. If you ensure that all 
your appointment requests are correct, simply click on the 'Submit' button at the bottom of the ‘<b><u>View 
Appointment Requests</b></u>’ to submit your appointment requests to PATA for the computerised appointment matching. 
No changes are allowed after submission.</p>
<p style="font-weight: normal; color: black;">PATA recommend all delegates to make at least 20 requests or as many requests as possible to avoid any hectic on scheduling them onsite. </p>
<p style="font-weight: normal; color: black;">
7. The automatic generated acknowledgement email will be launched only for delegate whom press submit button with TOTAL 25 SELECTIONS. In case there are less than 25 selections, the submission are not required and all selections will be submit automatically on January 18th at 12:00noon (GMT+7 BKK time).</p>
<br>
<h4><strong><u>Important Notes:</u></strong></h4>
<ul>
<li>
<p style="font-weight: normal; color: black;">
Deadline to submit your appointment request is <?php echo $deadline_app;?>.</p>
</li>
<li>
<p style="font-weight: normal; color: black;">
No changes are allowed after the stipulated deadline.</p>

</div>
</div>
</div>
</div>
<!-- /.row --></div>
<!-- /#page-wrapper --></div></div>
<!-- /#wrapper --> <!-- JavaScript --> <script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.js"></script> 
<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script><script src="js/respond.js"></script>
<![endif]-->
 <!-- Page Specific Plugins --> <script
	src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script> <script
	src="js/morris/chart-data-morris.js"></script> <script
	src="js/tablesorter/jquery.tablesorter.js"></script> <script
	src="js/tablesorter/tables.js"></script>
</body>
</html>