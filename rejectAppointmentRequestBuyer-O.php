<?php
require_once("query/connectivity.php");
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<title>Reject&nbsp;Appointment&nbsp;Request&nbsp;Buyer</title>

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
			$rejection_msg_date=$edateoo['rejection_msg_date'];
		}
	}
echo"<a class='navbar-brand' href='#'>PTM".$ptm_year." Delegate</a>";
?></div>

<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
<?php
if($_SESSION['mas_user_name'] == 'Y')
{
	echo "<ul class='nav navbar-nav side-nav'>";
		echo "<li><a href='business-calendarsellermicroenterprice.php'><i class='fa fa-home'></i>&nbsp;Micro&nbsp;Home</a></li>";
		echo "<li><a href='business-calendarseller.php'><i class='fa fa-home'></i>&nbsp;Normal&nbsp;Home</a></li>";
		echo "<li><a href='sellerhome2.php'><i class='fa fa-home'></i>&nbsp;Set2&nbsp;Home</a></li>";
		echo "<li><a href='advanceBuyerList.php'><i class='fa fa-search'></i>&nbsp;Advance Buyer List<br>
		<font class='sidebar-alt'>".$advance_buyer_list."</font></a></li>";
		echo "<li><a href='appointmentRequestBuyerList.php'><i class='fa fa-briefcase'></i>Appointment Requests</a></li>";
		echo "<li><a href='confirmAppointmentRequestBuyer.php'><i class='fa fa-briefcase'></i>&nbsp;Confirm Appointment Requests</a></li>";
		echo "<li class='active'><a href='rejectAppointmentRequestBuyer.php'><i class='fa fa-thumbs-o-down'></i>&nbsp;Rejection of unwanted appointment requests<br>
		<font class='sidebar-alt'>".$rejection_app_date."</font></a></li>";	
		echo "<li><a href='business-calendarsellerconfirm.php'><i class='fa fa-book'></i>&nbsp;Business Calendar</a></li>
			<li><a href='availableslotseller.php'><i class='fa fa-clock-o'></i>&nbsp;Available Slot</a></li>
			<li class='dropdown open'><a href='#' class='dropdown-toggle' style='background-color: #056495;' data-toggle='dropdown'><i class='fa fa-plus'></i> Pre Addendum List <b class='caret'></b><font class='sidebar-alt'>".$preadd_list."</font></a>
			<ul class='dropdown-menu'>
			<li><a href='advanceBuyerCancellationList.php'>Cancellations</a></li>
			<li><a href='advanceNewBuyerList.php'>New Registrations</a></li>
			</ul>
			</li>";
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

	<li><a href="advanceBuyerList.php"><i class="fa fa-search"></i>&nbsp;Advance Buyer List<br>
	<font class="sidebar-alt"><?php echo $advance_buyer_list;?></font></a></li>
<?php
	$tq=mysql_query("select * from date_settings where settings_status='Y'");
	if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
	{
		$vappon = $rs['vappon'];
		if($vappon == 'N')
		{
			echo "<li><a href='confirmAppointmentRequestBuyer.php'><i class='fa fa-briefcase'></i>&nbsp;Appointment Requests</a></li>";
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
		Appointment Requests</a></li>";
			}
			else
			{
				echo "<li><a href='appointmentRequestBuyerList.php'><i class='fa fa-briefcase'></i>
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
				echo "<li class='active'><a href='rejectAppointmentRequestBuyer.php'><i class='fa fa-thumbs-o-down'></i>&nbsp;Rejection of unwanted appointment requests<br>
	<font class='sidebar-alt'>".$rejection_app_date."</font></a></li>";
			}
			else
			{
					echo "<li><a href='#'><i class='fa fa-thumbs-o-down'></i>&nbsp;Rejection of unwanted appointment requests<br>
	<font class='sidebar-alt'>".$rejection_app_date."</font></a></li>";
			}
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
						echo "<li><a href='business-calendarsellerconfirm.php'><i class='fa fa-book'></i>&nbsp;Business Calendar</a></li>
							<li><a href='availableslotseller.php'><i class='fa fa-clock-o'></i>&nbsp;Available Slot</a></li>
							<li class='dropdown open'><a href='#' class='dropdown-toggle' style='background-color: #056495;'
								data-toggle='dropdown'><i class='fa fa-plus'></i> Pre Addendum
							List <b class='caret'></b><font class='sidebar-alt'>".$preadd_list."</font></a>
									<ul class='dropdown-menu'>
											<li><a href='advanceBuyerCancellationList.php'>Cancellations</a></li>
											<li><a href='advanceNewBuyerList.php'>New Registrations</a></li>
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
		<?php echo"<li><a href=\"sellerDetailsown.php?id=".$_SESSION['did']."\"> <i class='fa fa-user'></i> Profile</a></li>"; ?>
		<li class="divider"></li>
		<li><a href="delegate_logout.php"><i class="fa fa-power-off"></i>
		Log Out</a></li>
	</ul>
	</li>
</ul>
</div>
<!-- /.navbar-collapse --></nav>

<!-- /.row -->
<div id="page-wrapper"><!-- /.row -->
<div class="row">
<div class="col-lg-12">
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title">REJECTION OF UNWANTED APPOINTMENT REQUESTS</h3>
</div>
<div class="panel-body">
<div class="panel-body">
<center><span style='font-size:16px;'><b><?php echo $_SESSION['comname']; ?></b></span></center>
<?php
	if($_SESSION['chk'] == '3')
	{
		echo "<center><p style='font-size:16px;text-align:justify;'>&nbsp;&nbsp;Please view below appointment requests from buyers. If you do not want PATA to match any requests, please reject them. You are allowed to reject maximum 5 requests. Please print out your appointment requests for your reference. To view your Business Calendar, please log in this system on ".$rejection_msg_date.".</p></center>";
	}
	else
	{
		echo "<center><p style='font-size:16px;text-align:justify;'>&nbsp;&nbsp;Please view below appointment requests from buyers. If you do not want PATA to match any requests, please reject them. You are allowed to reject maximum 10 requests. Please print out your appointment requests for your reference. To view your Business Calendar, please log in this system on ".$rejection_msg_date.".</p></center>";
	}
?>
<div class="table-responsive" id='ajaxResult'
	style='width: 100%; height: 90%; overflow: auto;'></div>
</div>
</div>
</div>
</div>
</div>
<!-- /.row --></div>
<!-- /#page-wrapper --> <!-- /#wrapper --> <!-- JavaScript --> <script
	src="js/jquery-1.10.2.js"></script> <script src="js/bootstrap.js"></script>
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script><script src="js/respond.js"></script>
<![endif]-->
<script src="js/main.js"></script> <!-- Page Specific Plugins --> <script
	src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script> <script
	src="js/morris/chart-data-morris.js"></script> <script
	src="js/tablesorter/jquery.tablesorter.js"></script> <script
	src="js/tablesorter/tables.js"></script> <script lang="javascript">
	window.onload = function() 
	{
		ajaxfunction("query/rejectAppointmentRequestSeller.php", "document.getElementById('ajaxResult').innerHTML = ajaxRequest.responseText;initTableSorter();");
	}
</script>
</body>
</html>