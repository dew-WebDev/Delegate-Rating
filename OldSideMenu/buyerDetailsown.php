<?php
require_once("query/connectivity.php");
session_start();
/*if(!isset($_SESSION['did']))
{
	header("Location:delegate_login.php?mes=Session has Expired");
}*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<title>Buyer&nbsp;Own&nbsp;Profile</title>

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
if(isset($_SESSION['mas_user_name']) && $_SESSION['mas_user_name'] == 'Y')
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
			data-toggle='dropdown'><i class='fa fa-plus'></i> Pre Addendum
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
		<?php echo"<li><a href=\"buyerDetailsown.php?id=".$_SESSION['did']."\"> <i class='fa fa-user'></i> Profile</a></li>"; ?>
		<li class="divider"></li>
		<li><a href="delegate_logout.php"><i class="fa fa-power-off"></i> Log Out</a></li>
	</ul>
	</li>
</ul>
</div>
<!-- /.navbar-collapse --></nav>
<div id="page-wrapper">
<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">BUYER PROFILE</h3>
				</div>
				<div class="panel-body">
					<div class="panel-body">
						<div class="table-responsive" id='ajaxResult'>
						<?php
							require_once("query/connectivity.php");
							$qry=mysql_query("select * from buyer_missing_fields where buyer_com_id=".$_GET['id']." and buyer_missing_fields_status='Y'");
							if(mysql_num_rows($qry)>0 && $rsp=mysql_fetch_array($qry))
							{
								$cid="";
								$q=mysql_query("select company_id as cid from buyer_company where buyer_com_id=".$_GET['id']);
								if(mysql_num_rows($q)>0 && $res=mysql_fetch_assoc($q))
								{
									$cid=$res['cid'];
								}
							?>
							<table
								class="table table-bordered table-hover table-striped tablesorter">
								<thead>
									<tr>
										<th colspan=2>Buyer Information</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td style='width:300px;'>Registration No</td>
										<td style='width:700px;'><?php echo $cid; ?></td>
									</tr>
									<tr>
										<td>By Organisation Name</td>
										<td><?php echo $rsp['CompanyName']; ?></td>
									</tr>
									<tr>
										<td>Country</td>
										<td>
										<?php
											$q=mysql_query("select * from countries where country_status='Y' and country_id =".$rsp['CNT_ID']);
											if(mysql_num_rows($q)>0 && $rs=mysql_fetch_array($q))
												{
														echo $rs['country_name'];
												}
										?>
										</td>
									</tr>
									<tr>
										<td>Website</td>
										<td><?php echo $rsp['WEBSITE']; ?></td>
									</tr>
									<tr>
										<td colspan=2>&nbsp;</td>
									</tr>
									<tr>
										<th colspan=2>Primary Buyer Delegate Information</th>
									</tr>
									<tr>
										<td>Full Name</td>
										<td><?php echo $rsp['Prefix_A'].". ".$rsp['FirstName_A']." ".$rsp['LastName_A']; ?></td>
									</tr>
									<tr>
										<td>Job Title</td>
										<td><?php echo $rsp['JobTitle_A']; ?></td>
									</tr>
									<tr>
										<td colspan=2>&nbsp;</td>
									</tr>
									<tr>
										<th colspan=2>Company Description</th>
									</tr>
									<tr rowspan=3>
										<td colspan=2><p style='text-align:justify;width:100%;'><?php echo $rsp['description']; ?></p></td>
									</tr>
									<tr>
										<th colspan=2>Company's Business Profiles</th>
									</tr>
									<tr rowspan=3>
										<td colspan=2>
											<ul>
											<?php
												$com = "";	
												if($rsp['busitype1'] != "" )
												{
													$com.="<li>Tour Agents / Operator</li>";
												}
												if($rsp['busitype2'] != "")
												{
													$com.="<li>Nature / Outdoor / Wildlife Travel</li>";
												}
												if($rsp['busitype3'] != "")
												{
													$com.="<li>Adventure Travel Agent</li>";
												}
												if($rsp['busitype4'] != "")
												{
													$com.="<li>Travel / Tourism Trade</li>";
												}
												// if($rsp['busitype5'] != "")
												// {
												// 	$com.="<li>Outbound Leisure Travel</li>";
												// }
												// if($rsp['busitype6'] != "")
												// {
												// 	$com.="<li>Outbound Adventure Travel</li>";
												// }
												// if($rsp['busitype7'] != "")
												// {
												// 	$com.="<li>Outbound Golf Travel</li>";
												// }
												// if($rsp['busitype8'] != "")
												// {
												// 	$com.="<li>Outbound Spa & Wellness Travel</li>";
												// }
												// if($rsp['busitype9'] != "")
												// {
												// 	$com.="<li>Meetings & Conventions</li>";
												// }
												// if($rsp['busitype10'] != "")
												// {
												// 	$com.="<li>Exhibitions</li>";
												// }
												// if($rsp['busitype11'] != "")
												// {
												// 	$com.="<li>Honeymoon Tours</li>";
												// }
												// if($rsp['busitype12'] != "")
												// {
												// 	$com.="<li>Dive Tours</li>";
												// }
												// if($rsp['busitype13'] != "")
												// {
												// 	$com.="<li>Cruises</li>";
												// }
												// if($rsp['busitype14'] != "")
												// {
												// 	$com.="<li>Events</li>";
												// }
												// if($rsp['busitype15'] != "")
												// {
												// 	$com.="<li>Youth & Student Travel</li>";
												// }
												// if($rsp['busitype16'] != "")
												// {
												// 	$com.="<li>".$rsp['otherbusitype16']."</li>";
												// }
												if($rsp['otherbusitype'] != "")
												{
													$com.="<li>".$rsp['otherbusitype']."</li>";
												}
												echo $com;
											?>
										</ul>
										</td>
									</tr>
									<tr>
										<th colspan=2>Company Activities Profile</th>
									</tr>
									<tr rowspan=3>
										<td colspan=2>
											<ul>
											<?php
												$com = "";	
												if($rsp['aero1'] != "" )
												{
													$com.="<li>Ballooning</li>";
												}
												if($rsp['aero2'] != "")
												{
													$com.="<li>Hang Gliding</li>";
												}
												if($rsp['aero3'] != "")
												{
													$com.="<li>Sky Diving</li>";
												}
												if($rsp['aero4'] != "")
												{
													$com.="<li>Flying Trapeze</li>";
												}
												if($rsp['aero5'] != "")
												{
													$com.="<li>Parachuting / Paragliding</li>";
												}
												if($rsp['otheraero'] != "")
												{
													$com.="<li>".$rsp['otheraero']."</li>";
												}
												
												if($com != ""){
													echo "<li>Aero Sports<ul>".$com."</ul></li>";
												}

												$com = "";	
												if($rsp['water1'] != "" )
												{
													$com.="<li>Angling / Fishing</li>";
												}
												if($rsp['water2'] != "")
												{
													$com.="<li>Diving / Scuba Diving / Snorkeling</li>";
												}
												if($rsp['water3'] != "")
												{
													$com.="<li>Surfing</li>";
												}
												if($rsp['water4'] != "")
												{
													$com.="<li>Boating</li>";
												}
												if($rsp['water5'] != "")
												{
													$com.="<li>Parasailing</li>";
												}
												if($rsp['water6'] != "")
												{
													$com.="<li>Rafting</li>";
												}
												if($rsp['water7'] != "")
												{
													$com.="<li>Canoeing / Kayaking</li>";
												}
												if($rsp['water8'] != "")
												{
													$com.="<li>Sailing</li>";
												}
												if($rsp['water9'] != "")
												{
													$com.="<li>Water Polo</li>";
												}
												if($rsp['otherwater'] != "")
												{
													$com.="<li>".$rsp['otherwater']."</li>";
												}
												
												if($com != ""){
													echo "<li>Water Sports<ul>".$com."</ul></li>";
												}

												$com = "";	
												if($rsp['summer1'] != "" )
												{
													$com.="<li>	Biking / Cycling</li>";
												}
												if($rsp['summer2'] != "")
												{
													$com.="<li>Camping</li>";
												}
												if($rsp['summer3'] != "")
												{
													$com.="<li>Polo</li>";
												}
												if($rsp['summer4'] != "")
												{
													$com.="<li>Trekking</li>";
												}
												if($rsp['othersummer'] != "")
												{
													$com.="<li>".$rsp['othersummer']."</li>";
												}
												
												if($com != ""){
													echo "<li>Summer Sports<ul>".$com."</ul></li>";
												}

												$com = "";	
												if($rsp['mountain1'] != "" )
												{
													$com.="<li>Cliff Climbing / Wall Climbing</li>";
												}
												if($rsp['mountain2'] != "")
												{
													$com.="<li>Hiking</li>";
												}
												if($rsp['mountain3'] != "")
												{
													$com.="<li>Rappelling</li>";
												}
												if($rsp['mountain4'] != "")
												{
													$com.="<li>Valley Waling</li>";
												}
												if($rsp['othermountain'] != "")
												{
													$com.="<li>".$rsp['othermountain']."</li>";
												}
												
												if($com != ""){
													echo "<li>Mountaineer<ul>".$com."</ul></li>";
												}

												$com = "";	
												if($rsp['nature1'] != "" )
												{
													$com.="<li>	Bird Watching</li>";
												}
												if($rsp['nature2'] != "")
												{
													$com.="<li>Elephant / Camel Riding</li>";
												}
												if($rsp['nature3'] != "")
												{
													$com.="<li>Safari</li>";
												}
												if($rsp['nature4'] != "")
												{
													$com.="<li>Wildlife</li>";
												}
												if($rsp['nature5'] != "")
												{
													$com.="<li>National Park</li>";
												}
												if($rsp['othernature'] != "")
												{
													$com.="<li>".$rsp['othernature']."</li>";
												}
												
												if($com != ""){
													echo "<li>Nature<ul>".$com."</ul></li>";
												}
											?>
										</ul>
										</td>
									</tr>


									<tr>
										<th colspan=2>Activities / Adventures Seeking</th>
									</tr>
									<tr rowspan=3>
										<td colspan=2>
											<ul>
											<?php
												$com = "";	
												if($rsp['seek1'] != "" )
												{
													$com.="<li>Cultural Tourism</li>";
												}
												if($rsp['seek2'] != "")
												{
													$com.="<li>Ecotourism</li>";
												}
												if($rsp['seek3'] != "")
												{
													$com.="<li>	Wildlife Observation, Bird Watching, Safari</li>";
												}
												if($rsp['seek4'] != "")
												{
													$com.="<li>Expedition Cruising</li>";
												}
	
												if($com != ""){
													echo "<li>Soft Adventure<ul>".$com."</ul></li>";
												}

												$com = "";	
												if($rsp['seek5'] != "" )
												{
													$com.="<li>Mountain Tourism (i.e. Climbing, Trekking, Hiking)</li>";
												}
												if($rsp['seek6'] != "")
												{
													$com.="<li>Cycling, Motorbiking</li>";
												}
												if($rsp['seek7'] != "")
												{
													$com.="<li>Water Sports (i.e. Snorkelling, Diving, Rafting, Kayaking)</li>";
												}
												if($rsp['seek8'] != "")
												{
													$com.="<li>Extreme Sports (i.e. Bungee Jumping, Paragliding, Parachuting, Zip-lining, Surfing)</li>";
												}

												if($com != ""){
													echo "<li>Hard Adventure<ul>".$com."</ul></li>";
												}

												$com = "";	
												if($rsp['seek9'] != "" )
												{
													$com.="<li>National Tourism Organisation / Regional Tourism Organisation</li>";
												}
												if($rsp['seek10'] != "")
												{
													$com.="<li>Inbound Adventure Tour Operator</li>";
												}
												if($rsp['seek11'] != "")
												{
													$com.="<li>Family Adventure</li>";
												}
												if($rsp['seek12'] != "")
												{
													$com.="<li>Accommodation</li>";
												}
												if($rsp['seek13'] != "")
												{
													$com.="<li>Transportation</li>";
												}
												if($rsp['seek14'] != "")
												{
													$com.="<li>Outdoor Equipment Retailers</li>";
												}
												if($rsp['seek15'] != "")
												{
													$com.="<li>Sport Gear Retailers</li>";
												}
												if($rsp['otherseek'] != "")
												{
													$com.="<li>".$rsp['otherseek']."</li>";
												}
												if($com != ""){
													echo "<li>General<ul>".$com."</ul></li>";
												}
											?>
										</ul>
										</td>
									</tr>
									<!-- <tr>
										<th colspan=2>Level of responsibility you have for outbound
										business</th>
									</tr>
									<tr rowspan=3>
										<td colspan=2>
										<span>
											<?php
												$co = "";
												if($rsp['levelresp1'] == 1)
												{
													$co.="Final Decision, ";
												}
												if($rsp['levelresp2'] == 2)
												{
													$co.="Research, ";
												}

												if($rsp['levelresp3'] == 3)
												{
													$co.="Recommend, ";
												}
												if($rsp['levelresp4'] == 4)
												{
													$co.="Plan/ Organise, ";
												}
												if($rsp['levelresp5'] == 5)
												{
													$co.="None, ";
												}
												if($rsp['levelresp6'] == 6)
												{
													$co.=$rsp['otherlevelresp6'].", ";
												}
												$co=substr($co,0,-2);
												echo "<ul><li>".$co."</li></ul>";
											?> </span>
										</td>
									</tr>
									<tr>
										<th colspan=2>Name 5 Countries/destinations you are currently
										sending bussiness to the asia pacific region</th>
									</tr>
									<tr rowspan=3>
										<td colspan=2>
										<ol>
											<?php
												for($i=1;$i<=5;$i++)
												{
													if($rsp['btop'.$i] != "" && $rsp['btop'.$i] != "0")
													{
														echo "<li>".$rsp['btop'.$i]."</li>";
													}
												}
											?>
										</ol>
										</td>
									</tr>
									<tr>
										<th colspan=2>Name 5 Countries/destinations you are currently
										planning bussiness to develop bussiness to the asia pacific region</th>
									</tr>
									<tr rowspan=3>
										<td colspan=2>
										<ol>
											<?php
												for($i=1;$i<=5;$i++)
												{
													if($rsp['ctop'.$i] != "" && $rsp['ctop'.$i] != "0")
													{
														echo "<li>".$rsp['ctop'.$i]."</li>";
													}
												}
											?>
										</ol>
										</td>
									</tr> -->
								</tbody>
							</table>
							<span>
							<center>
		<input type='button' class='btn btn-default' style='width: 250px;' value='Back To Advance Seller List' onClick="location.replace('advanceSellerList.php');">
		<?php
					
								if (isset($_GET['fl']))
								{
									if ($_GET['fl'] == '1')
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
								}
								else if (isset($_GET['fl']) && $_GET['fl'] == '2')
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
							else
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
							?>
</center>
							</span>
							<?php
							}
							?>
						</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- /.row -->
</div>
<!-- /#page-wrapper -->
<!-- /#wrapper -->

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

</body>
</html>