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
$url=str_replace("buyerDetails.php","",$url);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<title>Buyer&nbsp;Profile</title>

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
echo"<a class='navbar-brand' href='#'>ATRTCM".$ptm_year." Delegate</a>";
?></div>

<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
<?php
if(isset($_SESSION['mas_user_name']) && $_SESSION['mas_user_name'] == 'Y')
{
	echo "<ul class='nav navbar-nav side-nav'>";
		echo "<li class='active'><a href='business-calendarsellermicroenterprice.php'><i class='fa fa-home'></i>&nbsp;Micro&nbsp;Home</a></li>";
		echo "<li><a href='business-calendarseller.php'><i class='fa fa-home'></i>&nbsp;Normal&nbsp;Home</a></li>";
		echo "<li><a href='sellerhome2.php'><i class='fa fa-home'></i>&nbsp;Set2&nbsp;Home</a></li>";
		echo "<li><a href='advanceBuyerList.php'><i class='fa fa-search'></i>&nbsp;Advance Buyer List<br>
		<font class='sidebar-alt'>".$advance_buyer_list."</font></a></li>";
		echo "<li><a href='viewAppointmentRequestBuyer.php'><i class='fa fa-briefcase'></i>Appointment Requests</a></li>";
		echo "<li><a href='confirmAppointmentRequestBuyer.php'><i class='fa fa-briefcase'></i>&nbsp;Confirm Appointment Requests</a></li>";
/*		echo "<li><a href='rejectAppointmentRequestBuyer.php'><i class='fa fa-thumbs-o-down'></i>&nbsp;Rejection of unwanted appointment requests<br>
		<font class='sidebar-alt'>".$rejection_app_date."</font></a></li>";	
		echo "<li><a href='business-calendarsellerconfirm.php'><i class='fa fa-book'></i>&nbsp;Business Calendar</a></li>
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

	<li><a href="advanceBuyerList.php"><i class="fa fa-search"></i>&nbsp;Advance Buyer List<br>
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
				echo "<li><a href='viewAppointmentRequestBuyer.php'><i class='fa fa-briefcase'></i>
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
						echo "<li><a href='business-calendarsellerconfirm.php'><i class='fa fa-book'></i>&nbsp;Business Calendar</a></li>";
/*		
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
*/						
			}
			else
			{
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
$email="";

							require_once("query/connectivity.php");
							$qry=mysql_query("select * from buyer_missing_fields where buyer_com_id=".$_GET['id']." and buyer_missing_fields_status='Y'");
							if(mysql_num_rows($qry)>0 && $rsp=mysql_fetch_array($qry))
							{
$email = $rsp['EMail_A'];
$buyercomdear = $rsp['CompanyName'];
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
							<?php
							if (isset($_GET['fk']))
							{
								
									$on="";
									$dereq="";
									$avsd="";
									$tq=mysql_query("select * from date_settings where settings_status='Y'");
									if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
									{
										$avsd = $rs['available_slot'];
										$on = $rs['app_rejection_on'];
										if ($_GET['fk'] == 'abl')
										{
										?>
											<input type='button' class='btn btn-default' style='width:250px;' value='Back To Advance Buyer List' onClick="location.replace('advanceBuyerList.php');">
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
											<input type='button' class='btn btn-default' style='width:250px;' value='Back To Confirm Appointment Request' onClick="location.replace('confirmAppointmentRequestBuyer.php');">
										<?php
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
										?>
													<input type='button' class='btn btn-default' style='width:250px;' value='Back To Confirm Appointment Request' onClick="location.replace('confirmAppointmentRequestBuyer.php');">
										<?php	
													}
													else
													{
										?>
											<input type='button' class='btn btn-default' style='width:250px;' value='Back To Appoinment Request' onClick="location.replace('appointmentRequestBuyerList.php');">			
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
											<input type='button' class='btn btn-default' style='width:250px;' value='Back To Confirm Appointment Request' onClick="location.replace('confirmAppointmentRequestBuyer.php');">
										<?php
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
										?>
													<input type='button' class='btn btn-default' style='width:250px;' value='Back To Confirm Appointment Request' onClick="location.replace('confirmAppointmentRequestBuyer.php');">
										<?php	
													}
													else
													{
										?>
											<input type='button' class='btn btn-default' style='width:250px;' value='Back To View Appoinment Request' onClick="location.replace('viewAppointmentRequestBuyer.php');">			
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
											<input type='button' class='btn btn-default' style='width:250px;' value='Back To Confirm Appoinment Request' onClick="location.replace('confirmAppointmentRequestBuyer.php');">
										<?php
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
										?>
													<input type='button' class='btn btn-default' style='width:250px;' value='Back To Confirm Appointment Request' onClick="location.replace('confirmAppointmentRequestBuyer.php');">
										<?php	
													}
													else
													{
										?>
											<input type='button' class='btn btn-default' style='width:250px;' value='Back To View Appoinment Request' onClick="location.replace('viewAppointmentRequestBuyer.php');">			
										<?php
													}
												}
											}
										}
										else if ($_GET['fk'] == 'rrs')
										{
										?>
											<input type='button' class='btn btn-default' style='width:350px;' value='Back To Rejection Of Unwanted Appointment Requests' onClick="location.replace('rejectAppointmentRequestBuyer.php');">
										<?php
										}
										else if ($_GET['fk'] == 'avsu')
										{
										?>
											<input type='button' class='btn btn-default' style='width:250px;' value='Back To Available Slot' onClick="location.replace('availableslotseller.php');">
										<?php
										}
										else if ($_GET['fk'] == 'adbc')
										{
										?>
											<input type='button' class='btn btn-default' style='width:250px;' value='Back To Cancellations' onClick="location.replace('advanceBuyerCancellationList.php');">
										<?php
										}
										else if ($_GET['fk'] == 'nbc')
										{
										?>
											<input type='button' class='btn btn-default' style='width:250px;' value='Back To New Registrations' onClick="location.replace('advanceNewBuyerList.php');">
										<?php
										}
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
									if ($_GET['fk'] == 'avsu')
									{
										$tq=mysql_query("select * from date_settings where settings_status='Y'");
										if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
										{
											if(($_GET['fk'] != 'cars') && ($_GET['fk'] != 'adbc') && ($_GET['fk'] != 'rrs'))
											{
									?>
										<input type='button' class='btn btn-default' style='width:250px;' value='Email Request' data-toggle='modal' data-target='#myModal'>
									<?php
											}
										}
									}
									else
									{
											if(($_GET['fk'] != 'cars') && ($_GET['fk'] != 'adbc') && ($_GET['fk'] != 'rrs'))
											{
								
													$b=false;
													$q=mysql_query("select * from delegate_requests where requested_delegate_id='".$_SESSION['user_name']."' and request_mode='S'");
													if(mysql_num_rows($q)>0 && $r=mysql_fetch_array($q))
													{
														$b=true;
													}
													if($b)
													{
										?>
										<!--
														<input type='button' class='btn btn-default' style='width:250px;' value='Confirm Appointment Request' onClick="location.replace('confirmAppointmentRequestBuyer.php');">
										-->
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
											if($vappon == 'Y')
											{
													$b=false;
													$q=mysql_query("select * from delegate_requests where requested_delegate_id='".$_SESSION['user_name']."' and request_mode='S'");
													if(mysql_num_rows($q)>0 && $r=mysql_fetch_array($q))
													{
														$b=true;
													}
													if($b)
													{
										?>
									
													<input type='button' class='btn btn-default' style='width:250px;' value='Confirm Appointment Request' onClick="location.replace('confirmAppointmentRequestBuyer.php');">
									
										<?php	
													}
													else
													{
										?>
										    
										<!-- Viroj 6-July-15
											<input type='button' class='btn btn-default' style='width:250px;' value='Appoinment Requests' onClick="location.replace('appointmentRequestBuyerList.php');">	
										-->	
											<input type='button' class='btn btn-default' style='width:250px;' value='Requests This Buyer' onClick="location.replace('query/tempRequestBuyerList.php?id=<?php echo $_GET['id']; ?>');">
										<?php
													}
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
										?>
										<!--
													<input type='button' class='btn btn-default' style='width:250px;' value='Confirm Appointment Request' onClick="location.replace('confirmAppointmentRequestBuyer.php');">
										-->
										<?php	
													}
													else
													{
										?>
											<input type='button' class='btn btn-default' style='width:250px;' value='Appoinment Requests' onClick="location.replace('appointmentRequestBuyerList.php');">	
										<?php
													}										
											}
													
									}

								}	
							}
							
							}
							else
							{
								if(($_GET['fk'] != 'cars') && ($_GET['fk'] != 'adbc') && ($_GET['fk'] != 'rrs'))
								{
							?>
							<!--
								<input type='button' class='btn btn-default' style='width:250px;' value='Email Request' data-toggle='modal' data-target='#myModal1'>
							-->
							<?php
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
													$q=mysql_query("select * from delegate_requests where requested_delegate_id='".$_SESSION['user_name']."' and request_mode='S'");
													if(mysql_num_rows($q)>0 && $r=mysql_fetch_array($q))
													{
														$b=true;
													}
													if($b)
													{
										?>
										<!--
													<input type='button' class='btn btn-default' style='width:250px;' value='Confirm Appointment Request' onClick="location.replace('confirmAppointmentRequestBuyer.php');">
										-->
										<?php	
													}
													else
													{
										?>
											<input type='button' class='btn btn-default' style='width:250px;' value='Appoinment Requests' onClick="location.replace('appointmentRequestBuyerList.php');">	
										<?php
													}
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
										?>
										<!--
													<input type='button' class='btn btn-default' style='width:250px;' value='Confirm Appointment Request' onClick="location.replace('confirmAppointmentRequestBuyer.php');">
										-->
										<?php	
													}
													else
													{
										?>
											<input type='button' class='btn btn-default' style='width:250px;' value='Appoinment Requests' onClick="location.replace('appointmentRequestBuyerList.php');">	
										<?php
													}										
											}
													
									}

								}
/*
							
										if (isset($_GET['fl']) && $_GET['fk'] != 'cars' && $_GET['fk'] != 'adbc')
										{

											if ($_GET['fk'] == 'avsu')
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
												?>
													<input type='button' class='btn btn-default' style='width:250px;' value='Appointment Requests' onClick="alert('Please note, You have reached your maximum limit of appointment requests')">
												<?php
													}
												}
												else if ($_GET['fl'] == '2')
												{
													$tq=mysql_query("select * from date_settings where settings_status='Y' and ((appointment_date <>'0000-00-00') or (appointment_date<>Null)) and available_slot='N'and app_rejection_on='N'");
													if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
													{
												?>
													<input type='button' class='btn btn-default' style='width:250px;' value='Appointment Requests' onClick="alert('Please note, Your appointment requests have been submitted for further processing')">
												<?php
													}
												}
											}
										}
										else
										{
											if (isset($_GET['fk']) && $_GET['fk'] != 'cars' && $_GET['fk'] != 'adbc')				
											{
												if ($_GET['fk'] == 'avsu')
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
													$tq=mysql_query("select * from date_settings where settings_status='Y' and ((appointment_date <>'0000-00-00') or (appointment_date<>Null)) and available_slot='N'and app_rejection_on='N'");
													if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
													{
												?>
													<input type='button' class='btn btn-default' style='width:250px;' value='Appointment Requests' onClick="location.replace('query/tempRequestBuyerList.php?id=<?php echo $_GET['id']; ?>');">
												<?php
													}
												}
											}
										}
*/
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
			$q=mysql_query("select email from mas_seller inner join seller_delegate_detail on mas_seller.mas_seller_id = seller_delegate_detail.mas_seller_id and username = '".$_SESSION['user_name']."' and seller_delegate_status = 'Y' and mas_seller_status = 'Y'");
			
			if(mysql_num_rows($q)>0 && $r=mysql_fetch_array($q))
			{
				$femail= $r['email'];
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
				<h5 style="margin-left:-10px;">Dear&nbsp;<?php echo $buyercomdear;?>,<br><br>May I request to meet you at <b>PTM <?php echo $ptm_year;?> <?php echo $slotDescemail."?"; ?></b><br><br><b>Please accept and confirm my appointment request by replying to this email directly.</b></h5>
				<?php
				$qryn=mysql_query("select fullname from mas_seller inner join seller_delegate_detail on mas_seller.mas_seller_id = seller_delegate_detail.mas_seller_id and username = '".$_SESSION['user_name']."' and seller_delegate_status = 'Y' and mas_seller_status = 'Y'");
			
				if(mysql_num_rows($qryn)>0 && $r=mysql_fetch_array($qryn))
				{
					$sname= $r['fullname'];
					echo "<input type='hidden' name='sname' value='".$sname."'/>";
				}
				?>
				<h6 style="margin-left:-10px;">Regards,<br>
				<h6 style="margin-left:-10px;"><?php
													echo $sname;
													echo "<br>";
												?>
												<?php echo $_SESSION['comname']; ?></h6>
				<?php echo "<input type='hidden' name='hidmsg' value='May I request to meet you at PTM ".$ptm_year." ".$slotDescemail."?'/>"; ?>
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
		<input type='hidden' name='hidmode' id='hidmode' value='B' />
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
				$q=mysql_query("select email from mas_buyer inner join buyer_delegate_detail on mas_buyer.mas_buyer_id = buyer_delegate_detail.mas_buyer_id and username = '".$_SESSION['user_name']."' and buyer_delegate_detail.buyer_delegate_status = 'Y' and mas_buyer.mas_buyer_status = 'Y'");
				
				if(mysql_num_rows($q)>0 && $r=mysql_fetch_array($q))
				{
					$femail= $r['email'];
				}
				?>
				  <input type="text" readonly class="form-control" style='width:100%;' name='txtmfrom' id="txtmfrom" value="<?php echo $femail; ?>" />
			</div>
		</div>
		<div class="form-group">
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
				<h5 style="margin-left:-10px;">Dear&nbsp;<?php echo $buyercomdear;?>,<br><br>May I request to meet you at <b>PTM <?php echo $ptm_year;?> <?php echo $slotDescemail."?"; ?></b><br><br><b>Please accept and confirm my appointment request by replying to this email directly.</b></h5>
				<?php
				$qryn=mysql_query("select fullname from mas_buyer inner join buyer_delegate_detail on mas_buyer.mas_buyer_id = buyer_delegate_detail.mas_buyer_id and mas_buyer.mas_buyer_com_id = ".$_GET['id']." and buyer_delegate_detail.buyer_delegate_status = 'Y' and mas_buyer.mas_buyer_status = 'Y' and mas_buyer.fullname <> 'None.'");
			
				if(mysql_num_rows($qryn)>0 && $r=mysql_fetch_array($qryn))
				{
					$sname= $r['fullname'];
					echo "<input type='hidden' name='sname' value='".$sname."'/>";
				}
				?>
				<h6 style="margin-left:-10px;">Regards,<br>
				<h6 style="margin-left:-10px;"><?php
													echo $sname;
													echo "<br>";
												?>
												<?php echo $_SESSION['comname']; ?></h6>
				<?php echo "<input type='hidden' name='hidmsg' value='May I request to meet you at PTM ".$ptm_year." ".$slotDescemail."?'/>"; ?>
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

		<input type='hidden' name='hidid' id='hidid' value="<?php echo $_GET['id']; ?>" />
		<input type='hidden' name='hidmode' id='hidmode' value='B' />
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
