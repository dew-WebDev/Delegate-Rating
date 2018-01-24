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

<title>Seller&nbsp;Own&nbsp;Profile</title>

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
		echo "<li><a href='business-calendarsellermicroenterprice.php'><i class='fa fa-home'></i>&nbsp;Micro&nbsp;Home</a></li>";
		echo "<li class='active'><a href='business-calendarseller.php'><i class='fa fa-home'></i>&nbsp;Normal&nbsp;Home</a></li>";
		echo "<li><a href='sellerhome2.php'><i class='fa fa-home'></i>&nbsp;Set2&nbsp;Home</a></li>";
		echo "<li><a href='advanceBuyerList.php'><i class='fa fa-search'></i>&nbsp;Advance Buyer List<br>
		<font class='sidebar-alt'>".$advance_buyer_list."</font></a></li>";
		echo "<li><a href='appointmentRequestBuyerList.php'><i class='fa fa-briefcase'></i>Appointment Requests</a></li>";
		echo "<li><a href='confirmAppointmentRequestBuyer.php'><i class='fa fa-briefcase'></i>&nbsp;Confirm Appointment Requests</a></li>";
		echo "<li><a href='rejectAppointmentRequestBuyer.php'><i class='fa fa-thumbs-o-down'></i>&nbsp;Rejection of unwanted appointment requests<br>
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
				echo "<li><a href='rejectAppointmentRequestBuyer.php'><i class='fa fa-thumbs-o-down'></i>&nbsp;Rejection of unwanted appointment requests<br>
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
							require_once("query/connectivity.php");
							$qry=mysql_query("select * from seller_missing_fields where seller_com_id=".$_GET['id']." and seller_missing_fields_status='Y'");
							if(mysql_num_rows($qry)>0 && $rsp=mysql_fetch_array($qry))
							{
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
						$com.="<li>Cultural Tourism</li>";
					}
					if($rsp['servtype2'] != ""){ 
						$com.="<li>Ecotourism</li>";
					}
					if($rsp['servtype3'] != ""){ 
						$com.="<li>Wildlife Observation, Bird Watching, Safari</li>";
					}
					if($rsp['servtype4'] != ""){ 
						$com.="<li>Expedition Cruising</li>";
					}
					// if($rsp['servtype5'] != ""){ 
					// 	$com.="<li>Airlines</li>";
					// }
					// if($rsp['servtype6'] != ""){ 
					// 	$com.="<li>National / Regional Tourism Organisations</li>";
					// }
					// if($rsp['servtype7'] != ""){ 
					// 	$com.="<li>Inbound Tour Operators</li>";
					// }
					// if($rsp['servtype8'] != ""){ 
					// 	$com.="<li>Professional Conference Organisers</li>";
					// }
					// if($rsp['servtype9'] != ""){ 
					// 	$com.="<li>Destination Management Companies</li>";
					// }
					if($rsp['servtype10'] != ""){ 
						$com.="<li>Mountain Tourism (i.e. Climbing, Trekking, Hiking)</li>";
					}
					if($rsp['servtype11'] != ""){ 
						$com.="<li>Cycling, Motor biking</li>";
					}
					if($rsp['servtype12'] != ""){ 
						$com.="<li>Water Sports (i.e. Snorkelling, Diving, Rafting, Kayaking)</li>";
					}
					if($rsp['servtype13'] != ""){ 
						$com.="<li>Extreme Sports (i.e. Bungee Jumping, Paragliding, Parachuting, Zip-Lining, Surfing)</li>";
					}
					// if($rsp['servtype14'] != ""){ 
					// 	$com.="<li>Dive Operators</li>";
					// }
					// if($rsp['servtype15'] != ""){ 
					// 	$com.="<li>Attractions / Museums / Galleries</li>";
					// }
					// if($rsp['servtype16'] != ""){ 
					// 	$com.="<li>Rail Travel</li>";
					// }
					// if($rsp['servtype17'] != ""){ 
					// 	$com.="<li>Theme Parks</li>";
					// }
					// if($rsp['servtype18'] != ""){ 
					// 	$com.="<li>Nature / National Parks</li>";
					// }
					if($rsp['servtype19'] != ""){ 
						$com.="<li>National Tourism Organisation / Regional Tourism Organisation</li>";
					}
					if($rsp['servtype20'] != ""){ 
						$com.="<li>Inbound Adventure Tour Operator</li>";
					}
					if($rsp['servtype21'] != ""){ 
						$com.="<li>Family Adventure</li>";
					}
					if($rsp['servtype22'] != ""){ 
						$com.="<li>Accommodation</li>";
					}
					if($rsp['servtype23'] != ""){ 
						$com.="<li>Transportation</li>";
					}
					if($rsp['servtype24'] != ""){ 
						$com.="<li>Outdoor Equipment Retailers</li>";
					}
					if($rsp['servtype25'] != ""){ 
						$com.="<li>Sport Gear Retailers</li>";
					}
					if($rsp['servtype26'] != ""){ 
						$com.="<li>Family Adventure</li>";
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
							
							$r1=mysql_query("select distinct country_name from region_assignment ra,region_country_assignment rca where ra.assignment_id=rca.assignment_id and ra.seller_missing_id=".$rsp['field_id']);
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
							<input type='button' class='btn btn-default' style='width:250px;' value='Back To Advance Buyer List' onClick="location.replace('advanceBuyerList.php');">
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
											<input type='button' class='btn btn-default' style='width:250px;' value='confirm Appoinment Request' onClick="location.replace('confirmAppointmentRequestBuyer.php');">
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
										<input type='button' class='btn btn-default' style='width:250px;' value='confirm Appoinment Request' onClick="location.replace('confirmAppointmentRequestBuyer.php');">
										<?php
													}
													else
													{
										?>	
										<input type='button' class='btn btn-default' style='width:250px;' value='Appoinment Request' onClick="location.replace('query/tempRequestBuyerList.php?id=<?php echo $_GET['id']; ?>');">	
										<?php	
													}
												}
											}
								}
								else if ($_GET['fl'] == '2')
								{
									$tq=mysql_query("select * from date_settings where settings_status='Y'");
											if(mysql_num_rows($tq) > 0 && $rs=mysql_fetch_array($tq))
											{
												$vappon = $rs['vappon'];
												if($vappon == 'N')
												{
										?>
											<input type='button' class='btn btn-default' style='width:250px;' value='confirm Appoinment Request' onClick="location.replace('confirmAppointmentRequestBuyer.php');">
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
										<input type='button' class='btn btn-default' style='width:250px;' value='confirm Appoinment Request' onClick="location.replace('confirmAppointmentRequestBuyer.php');">
										<?php
													}
													else
													{
										?>	
										<input type='button' class='btn btn-default' style='width:250px;' value='Appoinment Request' onClick="location.replace('query/tempRequestBuyerList.php?id=<?php echo $_GET['id']; ?>');">	
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
										if($vappon == 'N')
										{
							?>
							<input type='button' class='btn btn-default' style='width:250px;' value='confirm Appoinment Request' onClick="location.replace('confirmAppointmentRequestBuyer.php');">
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
								<input type='button' class='btn btn-default' style='width:250px;' value='confirm Appoinment Request' onClick="location.replace('confirmAppointmentRequestBuyer.php');">
								<?php
											}
											else
											{
								?>	
								<input type='button' class='btn btn-default' style='width:250px;' value='Appoinment Request' onClick="location.replace('query/tempRequestBuyerList.php?id=<?php echo $_GET['id']; ?>');">	
								<?php	
											}
										}	
									}
							?>
							</center>
</span> <?php
							}
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

<!-- JavaScript -->
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.js"></script> <!--[if lt IE 9]><script src="js/html5shiv.js"></script><script src="js/respond.js"></script><![endif]--></script>
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