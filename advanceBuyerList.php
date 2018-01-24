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

<title>Advance&nbsp;Buyer&nbsp;List</title>

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
<style>
ul.ij-options li {
    background:url('images/close.png') no-repeat 100% center;
    background-size: 20px 20px;
    width: 35em;

}
</style>
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
		echo "<li><a href='business-calendarsellermicroenterprice.php'><i class='fa fa-home'></i>&nbsp;Micro&nbsp;Home</a></li>";
		echo "<li><a href='business-calendarseller.php'><i class='fa fa-home'></i>&nbsp;Normal&nbsp;Home</a></li>";
		echo "<li><a href='sellerhome2.php'><i class='fa fa-home'></i>&nbsp;Set2&nbsp;Home</a></li>";
		echo "<li class='active'><a href='advanceBuyerList.php'><i class='fa fa-search'></i>&nbsp;Advance Buyer List<br>
		<font class='sidebar-alt'>".$advance_buyer_list."</font></a></li>";
		echo "<li><a href='viewAppointmentRequestBuyer.php'><i class='fa fa-briefcase'></i>View Appointment Requests</a></li>";		
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

	<li class="active"><a href="advanceBuyerList.php"><i class="fa fa-search"></i>&nbsp;Advance	Buyer List<br>
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
				echo "<li><a href='viewAppointmentRequestBuyer.php'><i class='fa fa-briefcase'></i>
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
		class="fa fa-user"></i>&nbsp;&nbsp;<?php echo $_SESSION['comname']; ?> <b class="caret"></b></a>
	<ul class="dropdown-menu">
		<?php echo"<li><a href=\"sellerDetailsown.php?id=".$_SESSION['did']."\"> <i class='fa fa-user'></i> Profile</a></li>"; ?>
		<li class="divider"></li>
		<li><a href="delegate_logout.php"><i class="fa fa-power-off"></i> Log Out</a></li>
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
<h3 class="panel-title">ADVANCE BUYER LIST</h3>
</div>
<div class="panel-body">
<div class="panel-body">
<div class="table-responsive">
<table	class="table table-bordered table-hover table-striped tablesorter">
	<thead>
		<tr>
			<th colspan=2>Advanced Search</i></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td style='width:400px;'>By Organisation Name</td>
			<td><input type='text' class='form-control' name='selcompany' id='selcompany' style='width:500px;' /> </td>
		</tr>
		<tr>
			<td>By Activities / Adventures Seeking</td>
			<td>
				<ul class="ij-options" id="selbuyprofilemultiple">

			    </ul>
			    <select id="selbuyprofilemultipleselect" class='form-control' style='width:500px;display:inherit;'>
					<option value='0' selected>All Buyer Profile</option>
					<option value='1' >Cultural Tourism</option>
					<option value='2' >Ecotourism</option>
					<option value='3' >Wildlife Observation, Bird Watching, Safari</option>
					<option value='4' >Expedition Cruising</option>
					<option value='5' >Mountain Tourism (i.e. Climbing, Trekking, Hiking)</option>
					<option value='6' >Cycling, Motor biking</option>
					<option value='7' >Water Sports (i.e. Snorkelling, Diving, Rafting, Kayaking)</option>
					<option value='8' >Extreme Sports (i.e. Bungee Jumping, Paragliding, Parachuting, Zip-Lining, Surfing)</option>
					<option value='9' >National Tourism Organisation / Regional Tourism Organisation</option>
					<option value='10' >Inbound Adventure Tour Operator</option>
					<option value='11' >Family Adventure</option>
					<option value='12' >Accommodation</option>
					<option value='13' >Transportation</option>
					<option value='14' >Outdoor Equipment Retailers</option>
					<option value='15' >Sport Gear Retailers</option>
					<!-- <option value='26' >Family Adventure</option> -->
					<option value='00' >Others</option>
				</select>
				<button style="vertical-align: middle;" onclick="selectIngredient2($(this).prev().get(0));">Add</button>
			(OR condition)</td>
		</tr>
		<tr>
			<td>By Country</td>
			<td>
				<ul class="ij-options" id="selcountrymultiple">

			    </ul>
			    <select id="selcountrymultipleselect" class='form-control' style='width:500px;display:inherit;'>
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
								echo "<option value='".$rs['country_id']."'>".$rs['country_name']."</option>";						
							}
						}
					?>
				</select>
				<button style="vertical-align: middle;" onclick="selectIngredient2($(this).prev().get(0));">Add</button> (OR condition)
			</td>
		</tr>
<!--		
		<tr>
			<td>By 1<sup>st</sup> time attendance</td>
			<td><select id='selbuyer' name='selbuyer'  class='form-control' style='width:500px;'>
				<option value='0' selected>Select All</option>
				<option value='1' >Yes</option>
				<option value='2' >No</option>			
			</select></td>
		</tr>
-->
		<tr>
			<td>&nbsp;</td>
			<td>
				<input type='button' class='btn btn-default' style='width:250px;' id='searchBut' value='Search' onclick="advanceBuyerList_25012017();">
				<input type='button' class='btn btn-default' style='width:250px;' id='allhBut' value='Show All' onClick="loadData();">
			</td>
		</tr>
	</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- /.row --></div>
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
						<input type='hidden' id='svalue' name='svalue' value="like '%'"/>
						<div id='sort'>
						<?php
							echo "<span class='form-control' style='font-size:16px;border:none;'>Please Select :&nbsp;&nbsp;";
							echo "<a href='#' onClick=\"$('#svalue').val('regexp \'^[0-9]\'');$('#index').html('0-9');advanceBuyerList_25012017();\">0-9</a>&nbsp;&nbsp;|&nbsp;&nbsp;";
							for($i=65;$i<=90;$i++)
							{
								echo "<a href='#' onClick=\"$('#svalue').val('like \'".chr($i)."%\'');$('#index').html('".chr($i)."');advanceBuyerList_25012017();\">".chr($i)."</a>&nbsp;&nbsp;|&nbsp;&nbsp;";
							}
							echo "<a href='#' onClick=\"$('#svalue').val('like \'%\'');$('#index').html('A-Z');advanceBuyerList_25012017();\">ALL</a>&nbsp;&nbsp;</span>";
							echo "<span class='form-control' style='font-size:16px;border:none;'>Result : <span id='totSpan'></span> Record(s) : Sorting by Organisation Name (<span id='index'>A-Z</span>)";
						?>
						</div>
						<br>
						<div class="table-responsive" id='ajaxResult' style='width:100%;height:90%;overflow:auto;'>
							
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
<script lang="javascript">
	window.onload = function() 
	{
		advanceBuyerList_25012017();
		
		var options = {
			currentPage: 3,
			totalPages: 10,
			useBootstrapTooltip:true
		}
		$('#example').bootstrapPaginator(options);
	}
	
function loadData()
	{
		$("#selcompany").val("");
		$("#selbuyprofile").val("0");
		$("#selcountry").val("0");
		$("#selbuyer").val("0");
		
		var hidid=$('#hidid').val();
		var selcompany=$('#selcompany').val();
		var selcountry=undefined;
		var selbuyer=$('#selbuyer').val();
		var selbuyprofile=undefined;
		var svalue=$('#svalue').val();

		ajaxfunction("query/advanceBuyerList.php?selbuyprofile="+selbuyprofile+"&id="+hidid+"&svalue="+svalue+"&selcompany="+selcompany+"&selbuyer="+selbuyer+"&selcountry="+selcountry, "ajax(ajaxRequest.responseText,'1');initTableSorter();");
	}

	function advanceBuyerList_25012017(){
		var selbuyprofilemultiple = selectmultipleuldelimiter($('#selbuyprofilemultiple').find('input[value]'),'selbuyprofilemultipleselect');
		var selcountrymultiple = selectmultipleuldelimiter($('#selcountrymultiple').find('input[value]'),'selcountrymultipleselect');

		var hidid=$('#hidid').val();
		var selcompany=$('#selcompany').val();
		var selcountry=selcountrymultiple;
		var selbuyer=$('#selbuyer').val();
		var selbuyprofile=selbuyprofilemultiple;
		var svalue=$('#svalue').val();

		ajaxfunction("query/advanceBuyerList.php?selbuyprofile="+selbuyprofile+"&id="+hidid+"&svalue="+svalue+"&selcompany="+selcompany+"&selbuyer="+selbuyer+"&selcountry="+selcountry, "ajax(ajaxRequest.responseText,'1');initTableSorter();");
		
	}

	function selectIngredient2(select){
	 var $ul = $(select).prev('ul');
	 var value = $(select).val();
	 if(!($ul.find('input[value="0"]').length > 0)){
	 	if(value == '0' && $ul.find('input[value]').length == 0){
	 		if ($ul.find('input[value="' + value + '"]').length == 0){
			 	$ul.append('<li onclick="$(this).remove();"><input type="hidden" value="'+value +'"/>'+$(select).find(':selected').text()+'</li>');
			}
	 	}else if(value != '0'){
		 	if ($ul.find('input[value="' + value + '"]').length == 0){
			 	$ul.append('<li onclick="$(this).remove();"><input type="hidden" value="'+value +'"/>'+$(select).find(':selected').text()+'</li>');
			}
		}
	 }
	}

	function selectmultipleuldelimiter(multipleitem,elm){
	 	var resultitem = undefined;
	 	if(multipleitem.length > 0){
	 		multipleitem.each(function( index, element ) {
			    if(!resultitem){
			    	resultitem = $(element).val();
			    }else{
					resultitem = resultitem +","+ $(element).val();
			    }
			});
	 	}
	 	if(!resultitem){
	 		var selectelmvalue = $('#'+elm).val();
	    	if(selectelmvalue != '0'){
	    		resultitem = selectelmvalue;
	    	}
	    }else{
	    	var selectelmvalue = $('#'+elm).val();
	    	if(selectelmvalue != '0'){
	    		resultitem = resultitem+','+selectelmvalue;
	    	}
	    }
	 	return resultitem;
	 }
</script>
</body>
</html>