<?php
require_once("query/connectivity.php");
session_start();
/*if(!isset($_SESSION['did']))
{
	header("Location:delegate_login.php?mes=Session has Expired");
}*/

$slotDesc = "";

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<title>Available&nbsp;Slot&nbsp;Seller</title>

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
echo"<a class='navbar-brand' href='#'>PTM".$ptm_year." Delegate</a>";
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
		echo "<li><a href='appointmentRequestBuyerList.php'><i class='fa fa-briefcase'></i>Appointment Requests</a></li>";
		echo "<li><a href='confirmAppointmentRequestBuyer.php'><i class='fa fa-briefcase'></i>&nbsp;Confirm Appointment Requests</a></li>";
		echo "<li><a href='rejectAppointmentRequestBuyer.php'><i class='fa fa-thumbs-o-down'></i>&nbsp;Rejection of unwanted appointment requests<br>
		<font class='sidebar-alt'>".$rejection_app_date."</font></a></li>";	
		echo "<li><a href='business-calendarsellerconfirm.php'><i class='fa fa-book'></i>&nbsp;Business Calendar</a></li>
			<li class='active'><a href='availableslotseller.php'><i class='fa fa-clock-o'></i>&nbsp;Available Slot</a></li>
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

					<li><a href="advanceBuyerList.php"><i
							class="fa fa-search"></i>&nbsp;Advance Buyer List<br> <font
							class="sidebar-alt">".$advance_buyer_list."</font>
					</a>
					</li>
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
								<li class='active'><a href='availableslotseller.php'><i class='fa fa-clock-o'></i>&nbsp;Available Slot</a></li>
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
					<li><a href="delegate_logout.php"><i class="fa fa-sign-out"></i>&nbsp;Logout</a>
					</li>
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
							<?php echo"<li><a href=\"sellerDetailsown.php?id=".$_SESSION['did']."\"> <i class='fa fa-user'></i> Profile</a></li>"; ?>
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
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">BUYER AVAILABLE SLOTS</h3>
						</div>
						<div class="panel-body">
							<div class="panel-body">
								<div class="table-responsive">
                <form action="availableslotseller.php" method="get" accept-charset="utf-8" enctype="multipart/form-data">
									<table
										class="table table-bordered table-hover table-striped tablesorter">
										<thead>
											<tr>
												<th colspan=2>AVAILABLE SEARCH:
												</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td style='width: 400px;'>Available Slots</td>
												<td><select id='slot' name='slot'  class='form-control' style="width: 500px;">
				<option selected value='0'>Please Select</option>
				<?php
					function clean($string) {
					   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

					   return preg_replace('/[^A-Za-z0-9\-_\.]/', '', $string); // Removes special chars.
					}
					$qry=mysql_query("select * from time_slots");
					if(mysql_num_rows($qry)>0)
					{
						while($rs=mysql_fetch_array($qry))
						{
							if(isset($_GET['slot']) && $_GET['slot'] == $rs['time_slot_id'])
							{
								$slotDesc = clean($rs['time_slot_description'])."&nbsp;(".clean($rs['time_slot_date']).")&nbsp;".clean($rs['time_slot_id_from'])."-".clean($rs['time_slot_id_to']);
								$slotDescemail = $rs['time_slot_description']."&nbsp;on&nbsp;".date('M d',strtotime($rs['time_slot_date']))."&nbsp;during&nbsp;".$rs['time_slot_id_from']."-".$rs['time_slot_id_to']."&nbsp;hrs.";
							
								echo "<option selected value='".$rs['time_slot_id']."'>".$slotDesc."</option>";			
							}
							else
							{
								echo "<option value='".$rs['time_slot_id']."'>".$rs['time_slot_description']."&nbsp;(".$rs['time_slot_date'].")&nbsp;".$rs['time_slot_id_from']."-".$rs['time_slot_id_to']."</option>";			
							}			
						}
					}
				?></select>
												</td>
											</tr>
											<tr>
												<td style='width: 400px;'>By Organisation Name</td>
												<td><input type='text' class='form-control'
													name='selcompany' id='selcompany' value="<?php if(isset($_GET['selcompany'])) { echo $_GET['selcompany']; } ?>" style='width: 500px;' />
												</td>
											</tr>
											<tr>
			<td>By Country</td>
			<td><select id='selcountryse' name='selcountryse'  class='form-control' style='width:500px;'>
				<option selected value='0'>All Country</option>
				<?php
					$qry=mysql_query("select * from countries where country_status='Y' and country_id in 
									(select distinct(cnt_id) from buyer_company bc 
									inner join buyer_org_details bod on bc.buyer_com_id = bod.buyer_com_id and (bod.buyer_org_status is null or bod.buyer_org_status = 'Y') and (bod.mark_For_Delete is null or bod.mark_For_Delete='0') 
									where bc.buyer_status='Y')
									order by country_name");
					if(mysql_num_rows($qry)>0)
					{
						while($rs=mysql_fetch_array($qry))
						{
							if(isset($_GET['selcountryse']) && $_GET['selcountryse'] == $rs['country_id'])
							{
							echo "<option selected value='".$rs['country_id']."'>".$rs['country_name']."</option>";						
							}
							else
							{
							echo "<option value='".$rs['country_id']."'>".$rs['country_name']."</option>";						
							}
						}
					}
				?></select></td>
		</tr>
											<tr>
												<td colspan=2><button style='float:right;margin-right:210px;' type='submit'>Search</button>
												</td>

											</tr>

										</tbody>
									</table>
</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /.row -->
		</div>
		<!-- /.row -->

		<div id="page-wrapper">
			<!-- /.row -->
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">SEARCH LIST</h3>
						</div>
						<div class="panel-body">
							<div class="panel-body">
								<div class="table-responsive">
									<table
										class="table table-bordered table-hover table-striped tablesorter">

				<thead>
					<tr>
						<th style='text-align:center;'>Company ID&nbsp;<i class="fa fa-sort"></i></th>
						<th style='text-align:center;'>Buyer Company Name&nbsp;<i class="fa fa-sort"></i></th>
						<th style='text-align:center;'>Country&nbsp;<i class="fa fa-sort"></i></th>
						<th style='text-align:center;'>Mail&nbsp;<i class="fa fa-sort"></i></th>
					</tr>
				</thead>
				<tbody>
<?php
if(isset($_GET['slot']) && $_GET['slot'] != '0')
{
	
	$q="
	select * from
	(
	select 
seller_company.seller_com_id as scid,
seller_company.company_name as seller,
buyer_company.company_name as bcomname,
buyer_company.buyer_com_id as bcid,
buyer_company.company_id as compid,
bmf.FirstTimeBuyer as first_time_attending,
c.country_name as cntName,
buyer_company.company_name as buyer,
mas_buyer.mas_buyer_id as mbcid,
seller_delegate_detail.mas_seller_id as mscid,
CASE
	WHEN seller_missing_fields.pavillion_type = '3' AND time_slots.time_slot_date = '".$alldate."' THEN time_slots.time_slot_id
	WHEN seller_missing_fields.pavillion_type = '3' AND time_slots.time_slot_date <> '".$alldate."' THEN '-1'
	ELSE time_slots.time_slot_id
END as time_slot_id,
CASE
	WHEN seller_missing_fields.pavillion_type = '3' AND time_slots.time_slot_date = '".$alldate."' THEN 'A'
	WHEN seller_missing_fields.pavillion_type = '3' AND time_slots.time_slot_date <> '".$alldate."' THEN 'C'
	ELSE 'B'
END as seller_type,
boothNumber,
mas_buyer.email as EMail_A 
from 
buyer_company
left join buyer_missing_fields bmf on buyer_company.buyer_com_id = bmf.buyer_com_id 
left join countries c on c.country_id=buyer_company.cnt_id
inner join seller_company on seller_company.seller_com_id = ".$_SESSION['did']."
inner join buyer_missing_fields on buyer_missing_fields.buyer_com_id = buyer_company.buyer_com_id
inner join mas_seller on seller_company.seller_com_id = mas_seller.mas_seller_com_id
inner join mas_buyer on mas_buyer.mas_buyer_com_id = buyer_company.buyer_com_id
inner join seller_delegate_detail on seller_delegate_detail.mas_seller_id = mas_seller.mas_seller_id
inner join seller_org_details on seller_company.seller_com_id = seller_org_details.seller_com_id
inner join seller_missing_fields on seller_missing_fields.seller_com_id = seller_company.seller_com_id
inner join buyer_org_details on buyer_company.buyer_com_id = buyer_org_details.buyer_com_id
, time_slots
where
seller_company.seller_com_id = ".$_SESSION['did']."
and
mas_seller.mas_seller_status = 'Y'
and
(mas_seller.title_name is not null and mas_seller.title_name <> 'None')
and
(mas_seller.name is not null and mas_seller.name <> '')
and
mas_seller.delegate = '1'
and
seller_delegate_status = 'Y'
and
(mas_buyer.title_name is not null and mas_buyer.title_name <> 'None')
and
(mas_buyer.name is not null and mas_buyer.name <> '')
and
(buyer_missing_fields.prefix_A is not null and mas_buyer.title_name <> 'None' and mas_buyer.mas_buyer_status = 'Y')
and
mas_buyer.name = buyer_missing_fields.FirstName_A
and
(seller_org_details.seller_org_status='Y' or seller_org_details.seller_org_status is null) 
and
(buyer_org_details.buyer_org_status='Y' or buyer_org_details.buyer_org_status is null) 
and 
(seller_org_details.markForDelete is null or seller_org_details.markForDelete <> '1')
and 
(buyer_org_details.mark_for_delete is null or buyer_org_details.mark_for_delete <> '1')
and
(buyer_org_details.pre_addendum='0' or buyer_org_details.pre_addendum is null) 
and
not exists 
(
select time_slot_id from appointments where appointments.seller_com_id = seller_company.seller_com_id and appointments.buyer_com_id = buyer_company.buyer_com_id
)
and 
time_slot_id not in (select time_slot_id from appointments where appointments.buyer_com_id = buyer_company.buyer_com_id)
and
(buyer_missing_fields.buyer_missing_fields_status is null or buyer_missing_fields.buyer_missing_fields_status='Y')
and
(buyer_company.buyer_status is null or buyer_company.buyer_status='Y')
and
(seller_company.seller_status is null or seller_company.seller_status='Y')
and
time_slot_id = '".$_GET['slot']."'
and
buyer_company.company_name like '%".$_GET['selcompany']."%'";

if($_GET['selcountryse'] != 0)
{
$q.=" and buyer_company.cnt_id = ".$_GET['selcountryse'];
}
$q.=" group by compid

union

select 
seller_company.seller_com_id as scid,
seller_company.company_name as seller,
buyer_company.company_name as bcomname,
buyer_company.buyer_com_id as bcid,
buyer_company.company_id as compid,
bmf.FirstTimeBuyer as first_time_attending,
c.country_name as cntName,
buyer_company.company_name as buyer,
mas_buyer.mas_buyer_id as mbcid,
seller_delegate_detail.mas_seller_id as mscid,
'',
CASE
	WHEN seller_missing_fields.pavillion_type = '3' THEN 'A'
	ELSE 'B'
END as seller_type,
boothNumber,
mas_buyer.email as EMail_A 
from 
buyer_company
left join buyer_missing_fields bmf on buyer_company.buyer_com_id = bmf.buyer_com_id 
left join countries c on c.country_id=buyer_company.cnt_id
inner join seller_company on seller_company.seller_com_id = ".$_SESSION['did']."
inner join buyer_missing_fields on buyer_missing_fields.buyer_com_id = buyer_company.buyer_com_id
inner join mas_seller on seller_company.seller_com_id = mas_seller.mas_seller_com_id
inner join mas_buyer on mas_buyer.mas_buyer_com_id = buyer_company.buyer_com_id
inner join seller_delegate_detail on seller_delegate_detail.mas_seller_id = mas_seller.mas_seller_id
inner join seller_org_details on seller_company.seller_com_id = seller_org_details.seller_com_id
inner join seller_missing_fields on seller_missing_fields.seller_com_id = seller_company.seller_com_id
inner join buyer_org_details on buyer_company.buyer_com_id = buyer_org_details.buyer_com_id
where
seller_company.seller_com_id = ".$_SESSION['did']."
and
mas_seller.mas_seller_status = 'Y'
and
(mas_seller.title_name is not null and mas_seller.title_name <> 'None')
and
(mas_seller.name is not null and mas_seller.name <> '')
and
mas_seller.delegate = '1'
and
seller_delegate_status = 'Y'
and
(mas_buyer.title_name is not null and mas_buyer.title_name <> 'None')
and
(mas_buyer.name is not null and mas_buyer.name <> '')
and
(buyer_missing_fields.prefix_A is not null and mas_buyer.title_name <> 'None' and mas_buyer.mas_buyer_status = 'Y')
and
mas_buyer.name = buyer_missing_fields.FirstName_A
and
(seller_org_details.seller_org_status='Y' or seller_org_details.seller_org_status is null) 
and
(buyer_org_details.buyer_org_status='Y' or buyer_org_details.buyer_org_status is null) 
and 
(seller_org_details.markForDelete is null or seller_org_details.markForDelete <> '1')
and 
(buyer_org_details.mark_for_delete is null or buyer_org_details.mark_for_delete <> '1')
and
(buyer_org_details.pre_addendum='2') 
and
not exists 
(
select time_slot_id from appointments where appointments.seller_com_id = seller_company.seller_com_id and appointments.buyer_com_id = buyer_company.buyer_com_id
)
and
(buyer_missing_fields.buyer_missing_fields_status is null or buyer_missing_fields.buyer_missing_fields_status='Y')
and
(buyer_company.buyer_status is null or buyer_company.buyer_status='Y')
and
(seller_company.seller_status is null or seller_company.seller_status='Y')
and
buyer_company.company_name like '%".$_GET['selcompany']."%'";

if($_GET['selcountryse'] != 0)
{
$q.=" and buyer_company.cnt_id = ".$_GET['selcountryse'];
}
$q.=" group by compid
)
bg
group by compid order by bcomname
";
//echo $q;
$qry=mysql_query($q);

		$cnt=0;
		if(mysql_num_rows($qry)>0)
		{
			while($rs=mysql_fetch_array($qry))
			{
				$cnt+=1;
/* 11-Aug-16 Viroj comment out				
				$usrnameemail=$rs['usrname'];
*/				
				if($rs['first_time_attending'] == 1)
				{
					
						echo "<tr><td style='width:10%;'><center>".$rs['compid']."</center></td><td style='width:70%;'><a href='#' onClick=\"redirectPage('".$rs['bcid']."','2','avsu');\">".$rs['buyer']."</a><span id='ftimeid' class='ftimeclass'>&nbsp;&nbsp;&nbsp;First Time&nbsp;&nbsp;&nbsp;</span></td><td style='width:20%;text-align:center;'>".$rs['cntName']."</td><td style='width:20%;'><center><a data-toggle='modal' data-target='#myModal' href='#' onClick=\"getMailDetail('".$rs['bcid']."','".$rs['EMail_A']."','".$rs['bcomname']."');return false;\"><i class='fa fa-envelope'></i></center></td></tr>";

				}
				else
				{
					echo "<tr><td style='width:10%;'><center>".$rs['compid']."</center></td><td style='width:70%;'><a href='#' onClick=\"redirectPage('".$rs['bcid']."','2','avsu');\">".$rs['buyer']."</a></td><td style='width:20%;text-align:center;'>".$rs['cntName']."</td><td style='width:20%;'><center><a data-toggle='modal' data-target='#myModal' href='#' onClick=\"getMailDetail('".$rs['bcid']."','".$rs['EMail_A']."','".$rs['bcomname']."');return false;\"><i class='fa fa-envelope'></i></center></td></tr>";
				}

			}
		}
		
	}
?>
				</tbody>
									</table>
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
<!-- Modal -->
<div class='modal fade' id='myModal' tabindex='-1' role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width: 35%;">
    <div class="modal-content">
	<form action="query/sendAppointmentEmail.php" id="uploadform" method="post" class="form-horizontal" role="form" accept-charset="utf-8" enctype="multipart/form-data">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Appointment Mail</h4>
      </div>
      <div class="modal-body">

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
			  <input type="text" readonly class="form-control" style='width:100%;' name='txtmto' id="txtmto" />
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
				<h5 style="margin-left:-10px;">Dear&nbsp;<span id='dearcom'></span>,<br><br>May I request to meet you at <b>PTM <?php echo $ptm_year;?> <?php echo $slotDescemail."?"; ?></b><br><br><b>Please accept and confirm my appointment request by replying to this email directly.</b></h5>
				<?php
				$qryn=mysql_query("select fullname from mas_seller inner join seller_delegate_detail on mas_seller.mas_seller_id = seller_delegate_detail.mas_seller_id and seller_delegate_detail.username = '".$_SESSION['user_name']."' and seller_delegate_status = 'Y' and mas_seller_status = 'Y'");
			
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
		<input type='hidden' name='hidslot' id='hidslot' />
		<input type='hidden' name='hidid' id='hidid'/>
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
					$('#uploadform').submit();
				}
				else
				{
					$('#uploadform').submit();
					
					
				} 
			}
			);

	}

	function getMailDetail(cid,email,comname)
	{
		$('#hidid').val(cid);
		$('#txtmto').val(email);
		$('#dearcom').text(comname);
		$('#hidslot').val($('#slot').val());
	}
	function redirectPage(id,val1,val2)
	{
		location.replace("buyerDetails.php?id="+id+"&fl="+val1+"&fk="+val2+"&slot="+$('#slot').val()+"&selcompany="+$('#hidcom').val()+"&selcountryse="+$('#hidcon').val());
	}
</script>
		<!-- JavaScript -->
		<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.js"></script>
<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script><script src="js/respond.js"></script>
<![endif]-->
	<script type="text/javascript" src="js/bootstrap-transition.js"></script>
	<script type="text/javascript" src="js/bootstrap-modal.js"></script>
<!-- Page Specific Plugins -->
<script
	src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
<script src="js/morris/chart-data-morris.js"></script>
<script src="js/tablesorter/jquery.tablesorter.js"></script>
<script src="js/tablesorter/tables.js"></script>
<script lang="javascript">
	window.onload = function() 
	{
		initTableSorter();
	}
</script>
</body>
</html>
