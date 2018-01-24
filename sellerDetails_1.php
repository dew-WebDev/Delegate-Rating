<?php
require_once("query/connectivity.php");
session_start();
if(!isset($_SESSION['did']))
{
	header("Location:delegate_login.php?mes=Session has Expired");
}

/*echo basename($_SERVER['REQUEST_URI'])."----><br>";
echo $_SERVER['QUERY_STRING']."---->";
die();*/
$url =basename($_SERVER['REQUEST_URI']);
$url=str_replace("sellerDetails.php","",$url);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<title>Seller&nbsp;Profile</title>

<!-- Bootstrap core CSS -->
<link href="css/bootstrap.css" rel="stylesheet">

<!-- Add custom CSS here -->
<link href="css/sb-admin.css" rel="stylesheet">
<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
<!-- Page Specific CSS -->
<link rel="stylesheet" href="css/morris-0.4.3.min.css">
<link rel="stylesheet" href="css/documentation.css">
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
	echo "<li><a href='business-calendarbuyeroneday.php'><i class='fa fa-home'></i>&nbsp;One&nbsp;Day&nbsp;Home</a></li>";
	echo "<li class='active'><a href='business-calendarbuyer.php'><i class='fa fa-home'></i>&nbsp;Normal&nbsp;Home</a></li>";
	echo "<li><a href='buyerhome2.php'><i class='fa fa-home'></i>&nbsp;Set2&nbsp;Home</a></li>";	
	echo "<li><a href='advanceSellerList.php'><i class='fa fa-search'></i> Advance Seller List<br><font class='sidebar-alt'>".$advance_buyer_list."</font></a></li>";
	echo "<li><a href='appointmentRequestSellerList.php'><i class='fa fa-briefcase'></i>Appointment Requests</a></li>";
	echo "<li><a href='confirmAppointmentRequestSeller.php'><i class='fa fa-briefcase'></i>Confirm&nbsp;Appointment Requests</a></li>";
	echo "<li><a href='rejectAppointmentRequestSeller.php'><i class='fa fa-thumbs-o-down'></i>&nbsp;Rejection of unwanted appointment requests<br>
	<font class='sidebar-alt'>".$rejection_app_date."</font></a></li>";
	echo"<li><a href='business-calendarbuyerconfirm.php'><i class='fa fa-book'></i>&nbsp;Business Calendar</a></li>
		<li><a href='availableslotbuyer.php'><i class='fa fa-clock-o'></i>&nbsp;Available Slot</a></li>
		<li class='dropdown open'><a href='#' style='background-color: #056495;' data-toggle='dropdown'><i class='fa fa-plus'></i> Pre Addendeum
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
			echo "<li><a href='confirmAppointmentRequestSeller.php'><i class='fa fa-briefcase'></i>
	Appointment Requests</a></li>";
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
		Appointment Requests</a></li>";
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
				echo "<li><a href='rejectAppointmentRequestSeller.php'><i class='fa fa-thumbs-o-down'></i>&nbsp;Rejection of unwanted appointment requests<br>
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
		if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
		{
			$allon = $rs['set2on'];
			if($allon == 'Y')
			{
					echo"
	<li><a href='business-calendarbuyerconfirm.php'><i class='fa fa-book'></i>&nbsp;Business Calendar</a></li>
	<li><a href='availableslotbuyer.php'><i class='fa fa-clock-o'></i>&nbsp;Available Slot</a></li>
<li class='dropdown open'><a href='#' style='background-color: #056495;'
			data-toggle='dropdown'><i class='fa fa-plus'></i> Pre Addendeum
		List <b class='caret'></b><font class='sidebar-alt'>".$preadd_list."</font></a>
		<ul class='dropdown-menu'>
				<li><a href='advanceSellerCancellationList.php'>Cancellations</a></li>
				<li><a href='advanceNewSellerList.php'>New Registrations</a></li>
		</ul>
	</li>

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
								data-toggle='dropdown'><i class='fa fa-plus'></i> Pre Addendeum
							List <b class='caret'></b><font class='sidebar-alt'>".$preadd_list."</font></a>
							<ul class='dropdown-menu'>
									<li><a href='#'>Cancellations</a></li>
									<li><a href='#'>New Registrations</a></li>
							</ul>
						</li>";
			}	
		}	
?>	
	
	<li><a href="delegate_logout.php"><i class="fa fa-sign-out"></i>
	Logout</a></li>

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
<div id="page-wrapper"><!-- /.row -->
<div class="row">
<div class="col-lg-12">
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title">SELLER PROFILE</h3>
</div>
<div class="panel-body">
<div class="panel-body">
<div class="table-responsive" id='ajaxResult'><?php
$email="";
							require_once("query/connectivity.php");
							$qry=mysql_query("select * from seller_missing_fields where seller_com_id=".$_GET['id']." and seller_missing_fields_status='Y'");
							if(mysql_num_rows($qry)>0 && $rsp=mysql_fetch_array($qry))
							{
$email = $rsp['txtemail'];
$sellercomdear = $rsp['txtcname'];
								$cid="";
								$q=mysql_query("select company_id as cid from seller_company where seller_com_id=".$_GET['id']);
								if(mysql_num_rows($q)>0 && $res=mysql_fetch_assoc($q))
								{
									$cid=$res['cid'];
								}
								$jd="";
								$fname="";
								$pos="";
								$qry1=mysql_query("select * from mas_seller where delegate='1' and mas_seller_status='Y' and mas_seller_com_id=".$_GET['id']." limit 1");
								if(mysql_num_rows($qry1)>0 && $rs1=mysql_fetch_array($qry1))
								{
									if($rs1['fullname'] != "")
									{

										$fname=$rs1['fullname'];	
									}
									if($rs1['position'] != "")
									{
										$pos=$rs1['position'];	
									}	
								}
							?>
<table
	class="table table-bordered table-hover table-striped tablesorter">
	<thead>
		<tr>
			<th colspan=2>Seller Information</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td style='width: 300px;'>Registration No</td>
			<td style='width: 700px;'><?php echo $cid; ?></td>
		</tr>
		<tr>
			<td>Organisation Name</td>
			<td><?php echo $rsp['txtcname']; ?></td>
		</tr>
		<tr>
			<td>Country</td>
			<td><?php
											$q=mysql_query("select * from countries where country_status='Y' and country_id =".$rsp['CNT_ID']);
											if(mysql_num_rows($q)>0 && $rs=mysql_fetch_array($q))
												{
														echo $rs['country_name'];
												}
										?></td>
		</tr>
		<tr>
			<td>Website</td>
			<td><?php echo $rsp['txtwsite']; ?></td>
		</tr>
		<tr>
			<td colspan=2>&nbsp;</td>
		</tr>
		<tr>
			<th colspan=2>Primary Seller Delegate Information</th>
		</tr>
		<tr>
			<td>Full Name</td>
			<td><?php echo $fname; ?></td>
		</tr>
		<tr>
			<td>Job Title</td>
			<td><?php echo $pos; ?></td>
		</tr>
		<tr>
			<td colspan=2>&nbsp;</td>
		</tr>
		<tr>
			<th colspan=2>Company Description</th>
		</tr>
		<tr rowspan=3>
			<td colspan=2>
			<p style='text-align: justify; width: 100%;'><?php echo $rsp['com_desc']; ?></p>
			</td>
		</tr>
		<tr>
			<th colspan=2>Company's Business Profiles</th>
		</tr>
		<tr rowspan=3>
			<td colspan=2>
				<ul>
				<?php
					$com = "";	
					if($rsp['servtype1'] != ""){ 
						$com.="<li>Accommodation - Hotel Chains</li>";
					}
					if($rsp['servtype2'] != ""){ 
						$com.="<li>Accommodation - Independent Hotels</li>";
					}
					if($rsp['servtype3'] != ""){ 
						$com.="<li>Accommodation - Resorts</li>";
					}
					if($rsp['servtype4'] != ""){ 
						$com.="<li>Accommodation - Serviced Apartments</li>";
					}
					if($rsp['servtype5'] != ""){ 
						$com.="<li>Airlines</li>";
					}
					if($rsp['servtype6'] != ""){ 
						$com.="<li>National / Regional Tourism Organisations</li>";
					}
					if($rsp['servtype7'] != ""){ 
						$com.="<li>Inbound Tour Operators</li>";
					}
					if($rsp['servtype8'] != ""){ 
						$com.="<li>Professional Conference Organisers</li>";
					}
					if($rsp['servtype9'] != ""){ 
						$com.="<li>Destination Management Companies</li>";
					}
					if($rsp['servtype10'] != ""){ 
						$com.="<li>Day Cruise Operators</li>";
					}
					if($rsp['servtype11'] != ""){ 
						$com.="<li>Regional / International Cruise Operators</li>";
					}
					if($rsp['servtype12'] != ""){ 
						$com.="<li>Car Rental</li>";
					}
					if($rsp['servtype13'] != ""){ 
						$com.="<li>Adventure Tour Operators</li>";
					}
					if($rsp['servtype14'] != ""){ 
						$com.="<li>Dive Operators</li>";
					}
					if($rsp['servtype15'] != ""){ 
						$com.="<li>Attractions / Museums / Galleries</li>";
					}
					if($rsp['servtype16'] != ""){ 
						$com.="<li>Rail Travel</li>";
					}
					if($rsp['servtype17'] != ""){ 
						$com.="<li>Theme Parks</li>";
					}
					if($rsp['servtype18'] != ""){ 
						$com.="<li>Nature / National Parks</li>";
					}
					if($rsp['servtype19'] != ""){ 
						$com.="<li>Restaurants</li>";
					}
					if($rsp['servtype20'] != ""){ 
						$com.="<li>Travel Media</li>";
					}
					if($rsp['servtype21'] != ""){ 
						$com.="<li>Travel Technology Companies</li>";
					}
					if($rsp['servtype22'] != ""){ 
						$com.="<li>Travel Web Portal</li>";
					}
					if($rsp['servtype23'] != ""){ 
						$com.="<li>Meeting / Convention Venue</li>";
					}
					if($rsp['servtype24'] != ""){ 
						$com.="<li>Spas</li>";
					}
					if($rsp['servtype25'] != ""){ 
						$com.="<li>Golf Courses</li>";
					}
					if($rsp['servtype26'] != ""){ 
						$com.="<li>Sports / Special Events</li>";
					}
					if($rsp['servtype27'] != ""){ 
						$com.="<li>".$rsp['otherservtype27']."</li>";
					}
					echo $com;
				?>
				</ul>
				</td>
			</tr>
			<tr>
				<th colspan=2>Wish to seek buyers from</th>
			</tr>
			<tr rowspan=3>
				<td colspan=2>
					<ul>
						<?php
							$k=0;
							$qinc=0;
							$r1=mysql_query("select * from region_assignment ra,region_country_assignment rca where ra.assignment_id=rca.assignment_id and ra.seller_missing_id=".$rsp['field_id']);
							if(mysql_num_rows($r1))
							{
								while($q1=mysql_fetch_array($r1))
								{
									$regarr[$qinc] =  $q1['country_name'];
									$qinc+=1;
								}
							}
							$q=mysql_query("select * from region where region_status='Y' order by region_id");
							if(mysql_num_rows($q)>0)
							{
								while($r=mysql_fetch_array($q))
								{
									$q1=mysql_query("select * from countries where country_status='Y' and region_id=".$r['region_id']." order by region_id");
									if(mysql_num_rows($q1)>0)
									{
										$con = "";
										while($r1=mysql_fetch_array($q1))
										{
											foreach($regarr as $region)
											{
												if($region == $r1['country_name'])
												{
													$con.="<li>".$r1['country_name']."</li>";
												}
											}
										}
										if ($con != "")
										{
											echo "<li>".$r['region_name']."<br><ul>";
											echo $con;
											echo"</ul></li>";
										}
									}
								}
							}
						?>
					<ul>
				</td>

			</tr>
	</tbody>
</table>
<span>
<center>
		<?php
							if (isset($_GET['fk']))
							{
								if ($_GET['fk'] == 'asl')
								{
								?>
									<input type='button' class='btn btn-default' style='width:250px;' value='Back To Advance Seller List' onClick="location.replace('advanceSellerList.php');">
								<?php
								}
								else if ($_GET['fk'] == 'appsl')
								{
									$tq=mysql_query("select * from date_settings where settings_status='Y'");
									if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
									{
										$vappon = $rs['vappon'];
										if($vappon == 'N')
										{
								?>
									<input type='button' class='btn btn-default' style='width:250px;' value='Back To confirm Appoinment Request' onClick="location.replace('confirmAppointmentRequestSeller.php');">
								<?php
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
								?>
									<input type='button' class='btn btn-default' style='width:250px;' value='Back To confirm Appoinment Request' onClick="location.replace('confirmAppointmentRequestSeller.php');">
										
								<?php	
											}
											else
											{
								?>
										<input type='button' class='btn btn-default' style='width:250px;' value='Back To Appoinment Request' onClick="location.replace('appointmentRequestSellerList.php');">
								<?php	
											}
										}
									}									
								}
								else if ($_GET['fk'] == 'vappsl')
								{
									$tq=mysql_query("select * from date_settings where settings_status='Y'");
									if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
									{
										$vappon = $rs['vappon'];
										if($vappon == 'N')
										{	
								?>
									<input type='button' class='btn btn-default' style='width:250px;' value='Back To confirm Appoinment Request' onClick="location.replace('confirmAppointmentRequestSeller.php');">
								<?php
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
								?>
									<input type='button' class='btn btn-default' style='width:250px;' value='Back To confirm Appoinment Request' onClick="location.replace('confirmAppointmentRequestSeller.php');">
										
								<?php	
											}
											else
											{
								?>
										<input type='button' class='btn btn-default' style='width:250px;' value='Back To View Appoinment Request' onClick="location.replace('viewAppointmentRequestSeller.php');">
								<?php	
											}
										}
									}	
								}
								else if ($_GET['fk'] == 'cars')
								{
									$tq=mysql_query("select * from date_settings where settings_status='Y'");
									if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
									{
										$vappon = $rs['vappon'];
										if($vappon == 'N')
										{	
								?>
									<input type='button' class='btn btn-default' style='width:250px;' value='Back To confirm Appoinment Request' onClick="location.replace('confirmAppointmentRequestSeller.php');">
								<?php
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
								?>
									<input type='button' class='btn btn-default' style='width:250px;' value='Back To confirm Appoinment Request' onClick="location.replace('confirmAppointmentRequestSeller.php');">
										
								<?php	
											}
											else
											{
								?>
										<input type='button' class='btn btn-default' style='width:250px;' value='Back To View Appoinment Request' onClick="location.replace('viewAppointmentRequestSeller.php');">
								<?php	
											}
										}
									}	
								}
								else if ($_GET['fk'] == 'rrs')
								{
								?>
									<input type='button' class='btn btn-default' style='width:400px;' value='Back To Rejection Of Unwanted Appointment Requests' onClick="location.replace('rejectAppointmentRequestSeller.php');">
								<?php
								}
								else if ($_GET['fk'] == 'avbu')
								{
								?>
									<input type='button' class='btn btn-default' style='width:250px;' value='Back To Available Slot' onClick="location.replace('availableslotbuyer.php');">
								<?php
								}
								else if ($_GET['fk'] == 'adsc')
								{
								?>
									<input type='button' class='btn btn-default' style='width:250px;' value='Back To Cancellations' onClick="location.replace('advanceSellerCancellationList.php');">
								<?php
								}
								else if ($_GET['fk'] == 'nsc')
								{
								?>
									<input type='button' class='btn btn-default' style='width:250px;' value='Back To New Registrations' onClick="location.replace('advanceNewSellerList.php');">
								<?php
								}
							}
		?>
					<?php
						$tq1=mysql_query("select * from date_settings where settings_status='Y'");
						if(mysql_num_rows($tq1) > 0 && $rs=mysql_fetch_array($tq1))
						{
							$set2on = $rs['set2on'];
							if ($set2on == 'Y')
							{
								if ($_GET['fk'] == 'avbu')
								{
									$tq=mysql_query("select * from date_settings where settings_status='Y'");
									if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
									{
										if(($_GET['fk'] != 'cars') && ($_GET['fk'] != 'adsc') && ($_GET['fk'] != 'rrs'))
										{	
								?>
									<input type='button' class='btn btn-default' style='width:250px;' value='Email Request' data-toggle='modal' data-target='#myModal'>
								<?php
										}
									}
								}
								else
								{
									if(($_GET['fk'] != 'cars') && ($_GET['fk'] != 'adsc') && ($_GET['fk'] != 'rrs'))
									{
										$tq=mysql_query("select * from date_settings where settings_status='Y'");
										if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
										{
												$vappon = $rs['vappon'];
												if($vappon == 'Y')
												{
													$b=false;
													$q=mysql_query("select * from delegate_requests where buyer_com_id=".$_SESSION['did']." and request_mode='B'");
													if(mysql_num_rows($q)>0 && $r=mysql_fetch_array($q))
													{
														$b=true;
													}
													if($b)
													{
						?>
						<!--
							<input type='button' class='btn btn-default' style='width:250px;' value='Confirm Appoinment Request' onClick="location.replace('confirmAppointmentRequestSeller.php');">
						-->
								
						<?php	
													}
													else
													{
						?>
													<input type='button' class='btn btn-default' style='width:250px;' value='Appoinment Requests' onClick="location.replace('appointmentRequestSellerList.php');">
						<?php
													}
												}
											}	
									}
								}
							}
							else
							{
								$tq=mysql_query("select * from date_settings where settings_status='Y'");
										if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
										{
												$vappon = $rs['vappon'];
												if($vappon == 'Y')
												{
													$b=false;
													$q=mysql_query("select * from delegate_requests where buyer_com_id=".$_SESSION['did']." and request_mode='B'");
													if(mysql_num_rows($q)>0 && $r=mysql_fetch_array($q))
													{
														$b=true;
													}
													if($b)
													{
						?>
														<input type='button' class='btn btn-default' style='width:250px;' value='Confirm Appoinment Request' onClick="location.replace('confirmAppointmentRequestSeller.php');">
						
						<?php	
													}
													else
													{
						?>
														<input type='button' class='btn btn-default' style='width:250px;' value='Appoinment Requests' onClick="location.replace('appointmentRequestSellerList.php');">
						<?php
													}
												}
											}
							}
						}	
						else
						{
							$tq=mysql_query("select * from date_settings where settings_status='Y'");
									if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
									{
											$vappon = $rs['vappon'];
											if($vappon == 'Y')
											{
												$b=false;
												$q=mysql_query("select * from delegate_requests where buyer_com_id=".$_SESSION['did']." and request_mode='B'");
												if(mysql_num_rows($q)>0 && $r=mysql_fetch_array($q))
												{
													$b=true;
												}
												if($b)
												{
					?>
													<input type='button' class='btn btn-default' style='width:250px;' value='Confirm Appoinment Request' onClick="location.replace('confirmAppointmentRequestSeller.php');">
					
					<?php	
												}
												else
												{
					?>
													<input type='button' class='btn btn-default' style='width:250px;' value='Appoinment Requests' onClick="location.replace('appointmentRequestSellerList.php');">
					<?php
												}
											}
										}
						}
												/*$tq=mysql_query("select * from date_settings where settings_status='Y' and ((appointment_date <>'0000-00-00') or (appointment_date<>Null)) and available_slot='N'and app_rejection_on='N'");
												if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
												{
										?>
												<input type='button' class='btn btn-default' style='width: 250px;' value='Appoinment Requests' onClick="location.replace('query/tempRequestSellerList.php?id=<?php echo $_GET['id']; ?>');">
												<input type='button' class='btn btn-default' style='width:250px;' value='Email Request' data-toggle='modal' data-target='#myModal'>
										<?php
												//}
											}
								


						/*
							if (isset($_GET['fl']) && $_GET['fk'] != 'cars' && $_GET['fk'] != 'adsc')
							{
								if ($_GET['fk'] == 'avbu')
								{
									$tq=mysql_query("select * from date_settings where settings_status='Y' and available_slot='Y'");
									if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
									{
								?>
									<input type='button' class='btn btn-default' style='width:250px;' value='Email Request' data-toggle='modal' data-target='#myModal'>
								<?php
									}
								}
								else
								{
									if ($_GET['fl'] == '1')
									{
									$tq=mysql_query("select * from date_settings where settings_status='Y' and ((appointment_date <>'0000-00-00') or (appointment_date<>Null)) and available_slot='N'and app_rejection_on='N'");
										if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
										{
											//<input type='button' class='btn btn-default' style='width:250px;' value='Appoinment Requests' onClick="alert('Please note, You have reached your maximum limit of appointment requests')">
								?>
											<input type='button' class='btn btn-default' style='width:250px;' value='Email Request' data-toggle='modal1' data-target='#myModal1'>
								<?php
										}
									}
									else if ($_GET['fl'] == '2')
									{
/*									$tq=mysql_query("select * from date_settings where settings_status='Y' and ((appointment_date <>'0000-00-00') or (appointment_date<>Null)) and available_slot='N'and app_rejection_on='N'");
										if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
										{
											//<input type='button' class='btn btn-default' style='width:250px;' value='Appoinment Requests' onClick="alert('Please note, Your appointment requests have been submitted for further processing')">
								?>
											<input type='button' class='btn btn-default' style='width:250px;' value='Email Request' data-toggle='modal1' data-target='#myModal1'>
								<?php
										//}
									}
								}
							}
							else
							{
								if (isset($_GET['fk']) && $_GET['fk'] != 'cars' && $_GET['fk'] != 'adsc')				
								{
									if ($_GET['fk'] == 'avbu')
									{
									$tq=mysql_query("select * from date_settings where settings_status='Y' and available_slot='Y'");
									if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
									{
								?>
										<input type='button' class='btn btn-default' style='width:250px;' value='Email Request' data-toggle='modal' data-target='#myModal'>
								<?php
										}
									}
									else
									{
										/*$tq=mysql_query("select * from date_settings where settings_status='Y' and ((appointment_date <>'0000-00-00') or (appointment_date<>Null)) and available_slot='N'and app_rejection_on='N'");
										if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
										{
								?>
										<input type='button' class='btn btn-default' style='width: 250px;' value='Appoinment Requests' onClick="location.replace('query/tempRequestSellerList.php?id=<?php echo $_GET['id']; ?>');">
										<input type='button' class='btn btn-default' style='width:250px;' value='Email Request' data-toggle='modal' data-target='#myModal'>
								<?php
										//}
									}
								}
								else
								{
								?>
										<input type='button' class='btn btn-default' style='width:250px;' value='Email Request' data-toggle='modal' data-target='#myModal'>
								<?php
								}
							}
*/




								?>
		<?php
/*
							if (isset($_GET['fl']))
							{
								if ($_GET['fl'] == '1')
								{
								?>
									<input type='button' class='btn btn-default' style='width:150px;' value='Appoinment Request' onClick="alert('Please note, You have reached your maximum limit of appointment requests')">
								<?php
								}
								else if ($_GET['fl'] == '2')
								{
								?>
									<input type='button' class='btn btn-default' style='width:150px;' value='Appoinment Request' onClick="alert('Please note, Your appointment requests have been submitted for further processing')">
								<?php
								}
							}
							else
							{
							?>
								<input type='button' class='btn btn-default' style='width: 150px;' value='Appoinment Request' onClick="location.replace('query/tempRequestSellerList.php?id=<?php echo $_GET['id']; ?>');">
							<?php
							}
*/
							?>
</center>
</span> <?php
							}
							?></div>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- /.row --></div>
<!-- /#page-wrapper -->
<!-- /#wrapper -->
<?php
	if(isset($_GET['slot']))
	{
?>
<!-- Modal -->
<div class='modal fade' id='myModal' tabindex='-1' role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width: 35%;">
    <div class="modal-content">
	<form action="query/sendAppointmentEmail.php" id="uploadform1" method="post" class="form-horizontal" role="form" accept-charset="utf-8" enctype="multipart/form-data">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Appointment Mail</h4>
      </div>
      <div class="modal-body">
<?php
$slotDesc="";
	$slt=$_GET['slot'];
	$qry=mysql_query("select * from time_slots where time_slot_id=".$slt);
	if(mysql_num_rows($qry)>0 && $rs=mysql_fetch_array($qry))
	{
		$slotDesc = $rs['time_slot_description']."&nbsp;(".$rs['time_slot_date'].")&nbsp;".$rs['time_slot_id_from']."-".$rs['time_slot_id_to'];
		$slotDescemail = $rs['time_slot_description']."&nbsp;on&nbsp;".date('M d',strtotime($rs['time_slot_date']))."&nbsp;during&nbsp;".$rs['time_slot_id_from']."-".$rs['time_slot_id_to']."&nbsp;hrs.";
	}
?>
		<div class="form-group">
			<div class="col-md-1">
				<span class='pull-left' style='font-weight:bold;margin-left:-10px;'>From</span>
			</div>
			<div class="col-md-11">
			<?php
				$qryn=mysql_query("select fullname,email from mas_buyer inner join buyer_delegate_detail on mas_buyer.mas_buyer_id = buyer_delegate_detail.mas_buyer_id and username = '".$_SESSION['user_name']."' and buyer_delegate_status = 'Y' and mas_buyer_status = 'Y'");
			
				if(mysql_num_rows($qryn)>0 && $r=mysql_fetch_array($qryn))
				{
					$sname= $r['fullname'];
					$femail= $r['email'];
					echo "<input type='hidden' name='sname' value='".$sname."'/>";
				}
				?>
			  <input type="text" readonly class="form-control" style='width:100%;' name='txtmfrom' id="txtmfrom" value="<?php echo $femail; ?>" />
			</div>
		</div>
		<div class="form-group" style='display:none;'>
			<div class="col-md-1">
				<span class='pull-left' style='font-weight:bold;margin-left:-10px;'>To</span>
			</div>
			<div class="col-md-11">
			  <input type="text" readonly class="form-control" style='width:100%;' name='txtmto' id="txtmto" value="<?php echo $email; ?>" />
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-1">
				<span class='pull-left' style='font-weight:bold;margin-left:-10px;'>Subject</span>
			</div>
			<div class="col-md-11">
			  <input type="text" readonly class="form-control" style='width:100%;' name='txtmsubject' id="txtmsubject" value="<?php echo "PTM Appointment Request for ".$slotDescemail; ?>"/>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-12">
				<h5 style="margin-left:-10px;">Dear&nbsp;<?php echo $sellercomdear;?>,<br><br>May I request to meet you at <b>PTM <?php echo $ptm_year;?> <?php echo $slotDescemail; ?></b><br><br><b>Please confirm this appointment request by return email.</b></h5>
				<h6 style="margin-left:-10px;">Regards,<br>
				<h6 style="margin-left:-10px;"><?php
													echo $sname;
													echo "<br>";
												?>
				<?php echo $_SESSION['comname']; ?></h6>
				
				<?php echo "<input type='hidden' name='hidmsg' value='May I request to meet you at PTM ".$ptm_year." ".$slotDescemail."'/>"; ?>
				<?php echo "<input type='hidden' name='hidcomname' value='".$_SESSION['comname']."'/>"; ?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-1">
				<span class='pull-left' style='font-weight:bold;margin-left:80px;'>CAPTCHA</span>
			</div>
			<div class="col-md-11">
				<?php
					require_once('query/recaptchalib.php');
					$publickey = "6LcTjfYSAAAAANSltbw8ILGQcQllqjW6SBmtFimr";
					$error = null;
					echo recaptcha_get_html($publickey, $error);
				?>
			</div>
		</div>
      </div>

		<input type='hidden' name='hidslot' id='hidslot' value="<?php echo $_GET['slot']; ?>"  />
		<input type='hidden' name='hidid' id='hidid' value="<?php echo $_GET['id']; ?>" />
		<input type='hidden' name='hidmode' id='hidmode' value='S' />
		<input type='hidden' name='hidcom' id='hidcom' value="<?php if(isset($_GET['selcompany'])){ echo $_GET['selcompany']; } ?>" />
		<input type='hidden' name='hidcon' id='hidcon' value="<?php if(isset($_GET['selcountryse'])){ echo $_GET['selcountryse']; } ?>" />
		
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onClick="getResult1();">Send EMail</button>
      </div>
	 </form>
    </div>
  </div>
</div>
<?php
	}
	else
	{
?>


<!-- Modal1 -->
<div class='modal fade' id='myModal1' tabindex='-1' role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width: 35%;">
    <div class="modal-content">
	<form action="query/sendAppointmentEmailOther.php" id="uploadform2" method="post" class="form-horizontal" role="form" accept-charset="utf-8" enctype="multipart/form-data">
	<input type='hidden' id='hidurl' name='hidurl' value="<?php echo $url; ?>" />
	<input type='hidden' id='hidfk' name='hidfk' value="<?php if(isset($_GET['fk'])){ echo $_GET['fk']; } ?>" />
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Appointment Mail</h4>
      </div>
      <div class="modal-body">
<?php
/*$slotDesc="";
	$slt=$_GET['slot'];
	$qry=mysql_query("select * from time_slots where time_slot_id=".$slt);
	if(mysql_num_rows($qry)>0 && $rs=mysql_fetch_array($qry))
	{
		$slotDesc = $rs['time_slot_description']."&nbsp;(".$rs['time_slot_date'].")&nbsp;".$rs['time_slot_id_from']."-".$rs['time_slot_id_to'];
	}
*/
?>
		<div class="form-group">
			<div class="col-md-1">
				<span class='pull-left' style='font-weight:bold;margin-left:-10px;'>From</span>
			</div>
			<div class="col-md-11">
			<?php
				$qryn=mysql_query("select fullname,email from mas_buyer inner join buyer_delegate_detail on mas_buyer.mas_buyer_id = buyer_delegate_detail.mas_buyer_id and username = '".$_SESSION['user_name']."' and buyer_delegate_status = 'Y' and mas_buyer_status = 'Y'");
			
				if(mysql_num_rows($qryn)>0 && $r=mysql_fetch_array($qryn))
				{
					$sname= $r['fullname'];
					$femail= $r['email'];
					echo "<input type='hidden' name='sname' value='".$sname."'/>";
				}
				?>
					  <input type="text" readonly class="form-control" style='width:100%;' name='txtmfrom' id="txtmfrom" value="<?php echo $femail; ?>" />
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-1">
				<span class='pull-left' style='font-weight:bold;margin-left:-10px;'>Subject</span>
			</div>
			<div class="col-md-11">
			  <input type="text" readonly class="form-control" style='width:100%;' name='txtmsubject' id="txtmsubject" value="<?php echo "PTM Appointment Request for ".$slotDescemail; ?>"/>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-12">
				<h5 style="margin-left:-10px;">Dear&nbsp;<?php echo $sellercomdear;?>,<br><br>May I request to meet you at <b>PTM <?php echo $ptm_year;?> <?php echo $slotDescemail; ?></b><br><br><b>Please confirm this appointment request by return email.</b></h5>
				<h6 style="margin-left:-10px;">Regards,<br>
				<h6 style="margin-left:-10px;"><?php
													echo $sname;
													echo "<br>";
												?>
				<?php echo $_SESSION['comname']; ?></h6>
				
				<?php echo "<input type='hidden' name='hidmsg' value='May I request to meet you at PTM ".$ptm_year." ".$slotDescemail."'/>"; ?>
				<?php echo "<input type='hidden' name='hidcomname' value='".$_SESSION['comname']."'/>"; ?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-1">
				<span class='pull-left' style='font-weight:bold;margin-left:80px;'>&nbsp;</span>
			</div>
			<div class="col-md-11">
				<?php
					require_once('query/recaptchalib.php');
					$publickey = "6LcTjfYSAAAAANSltbw8ILGQcQllqjW6SBmtFimr";
					$error = null;
					echo recaptcha_get_html($publickey, $error);
				?>
			</div>
		</div>
      </div>

		<input type='hidden' name='hidid' id='hidid' value="<?php echo $_GET['id']; ?>" />
		<input type='hidden' name='hidmode' id='hidmode' value='S' />
		<input type='hidden' name='hidcom' id='hidcom' value="<?php if(isset($_GET['selcompany'])){ echo $_GET['selcompany']; } ?>" />
		<input type='hidden' name='hidcon' id='hidcon' value="<?php if(isset($_GET['selcountryse'])){ echo $_GET['selcountryse']; } ?>" />
		
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onClick="getResult2();">Send EMail</button>
      </div>
	 </form>
    </div>
  </div>
</div>
<?php
	}
?>
<!-- JavaScript -->
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.js"></script> 
<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script><script src="js/respond.js"></script>
<![endif]-->
<script src="js/bootstrap-paginator.js"></script>
<script src="js/main.js"></script>

<!-- Page Specific Plugins -->
<script
	src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
<script src="js/morris/chart-data-morris.js"></script>
<script src="js/tablesorter/jquery.tablesorter.js"></script>
<script src="js/tablesorter/tables.js"></script>
<script>
	function getResult1()
	{
		var val1=$('#recaptcha_challenge_field').val();
		var val2=$('#recaptcha_response_field').val();

		$.post("query/checkCaptcha.php",
			{
				recaptcha_challenge_field:val1,
				recaptcha_response_field:val2 
			},
			function(data,status)
			{
				if(data == 1)
				{
					$('#uploadform1').submit();
				}
				else
				{
					alert("You've entered Wrong Captcha");
					Recaptcha.reload();
				}
			}
			);

	}
	function getResult2()
	{
		var val1=$('#recaptcha_challenge_field').val();
		var val2=$('#recaptcha_response_field').val();

		$.post("query/checkCaptcha.php",
			{
				recaptcha_challenge_field:val1,
				recaptcha_response_field:val2 
			},
			function(data,status)
			{
				if(data == 1)
				{
					$('#uploadform2').submit();
				}
				else
				{
					alert("You've entered Wrong Captcha");
					Recaptcha.reload();
				}
			}
			);

	}
</script>
</body>
</html>
