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
			$new_registration_period=$edateoo['new_registration_period'];
			$pre_add_period=$edateoo['pre_add_period'];
		}
	}
echo"<a class='navbar-brand' href='#'>ATCM".$ptm_year." Delegate</a>";
?></div>

<!-- Collect the nav links&#44; forms&#44; and other content for toggling -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
<?php
if(isset($_SESSION['mas_user_name']) && $_SESSION['mas_user_name'] == 'Y')
{
	echo "<ul class='nav navbar-nav side-nav'>";
	echo "<li><a href='business-calendarbuyeroneday.php'><i class='fa fa-home'></i>&nbsp;One&nbsp;Day&nbsp;Home</a></li>";
	echo "<li><a href='business-calendarbuyer.php'><i class='fa fa-home'></i>&nbsp;Normal&nbsp;Home</a></li>";
	echo "<li class='active'><a href='buyerhome2.php'><i class='fa fa-home'></i>&nbsp;Set2&nbsp;Home</a></li>";	
//  echo "<li><a href='advanceSellerList.php'><i class='fa fa-search'></i> Advance Seller List<br><font class='sidebar-alt'>".$advance_buyer_list.
//  	 "</font></a></li>";
	echo "<li><a href='advanceSellerList.php'><i class='fa fa-search'></i> Seller List<br><font class='sidebar-alt'></font></a></li>";
	echo "<li><a href='appointmentRequestSellerList.php'><i class='fa fa-briefcase'></i>View Appointment Requests</a></li>";
	echo "<li><a href='confirmAppointmentRequestSeller.php'><i class='fa fa-briefcase'></i>Confirm&nbsp;View Appointment Requests</a></li>";
/* VM 9-Feb-17	
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
/* VM 9-Feb-17			
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
			}	
/* VM 9-Feb-17 */
			if($allon == 'Y')
			{
					echo"<li><a href='business-calendarbuyerconfirm.php'><i class='fa fa-book'></i>&nbsp;Business Calendar</a></li>";										
			}
			else
			{
					echo "<li><a href='#'><i class='fa fa-book'></i>&nbsp;Business Calendar</a></li>";
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
				echo "<a href='appointmentRequestSellerList.php'>";
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
/* VM 9-Feb-17	
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
*/						
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
/* VM 9-Feb-17				
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
*/						
			}
			else
			{
/* VM 9-Feb-17				
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
						</div>";
			}
			else
			{
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

						</div>";
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
<h3 style="font-size: 20px; color: #993300; font-weight: bold;">Welcome to
    your Business Calendar!</h3><br>

    <p style="font-weight: normal; color: black;">PATA is pleased to inform you
    that the computerized matching of business appointments in accordance to
    the three set criteria in this order:</p>

    <p style="font-weight: normal; color: black;">(1) mutual request, (2) buyer
    request and (3) seller request is completed.</p>

    <p style="font-weight: normal; color: black;">Your ATCM<?php echo $ptm_year;?> Business
    Calendar is now posted online. You are now able to access your calendar by clicking at 'Business Calendar' button on this webpage. This Business Calendar is only provided to buyers whose registration is completed with PATA on/before 22 February 2017.</p>

    <p style="font-weight: normal; color: black;">To download your calendar, after your business calendar is displayed, you just CLICK ‘Export PDF’ button at bottom of the calendar page.</p><br>

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