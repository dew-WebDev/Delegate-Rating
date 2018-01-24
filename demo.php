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
			<td>Registration No</td>
			<td><?php echo $cid; ?></td>
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
			</select> </td>
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
			<td><?php echo $rs['Prefix_A'].". ".$rs['FirstName_A']." ".$rs['LastName_A']; ?></td>
		</tr>
		<tr>
			<td>Job Title</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>E-mail</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td colspan=2>&nbsp;</td>
		</tr>
		<tr>
			<th colspan=2>Company Description</th>
		</tr>
		<tr rowspan=3>
			<td colspan=2>&nbsp;</td>
		</tr>
		<tr>
			<th colspan=2>Company's Bussiness Profiles</th>
		</tr>
		<tr rowspan=3>
			<td colspan=2>
			<ul>
				<li></li>
			</ul>
			</td>
		</tr>
		<tr>
			<th colspan=2>Level of responsibility you have for outbound
			business</th>
		</tr>
		<tr rowspan=3>
			<td colspan=2>
			<ul>
				<li></li>
			</ul>
			</td>
		</tr>
		<tr>
			<th colspan=2>Name 5 Countries/destinations you are currently
			sending bussiness to the asia pacific region</th>
		</tr>
		<tr rowspan=3>
			<td colspan=2>
			<ol>
				<li>china</li>
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
				<li>china</li>
			</ol>
			</td>
		</tr>
	</tbody>
</table>
<span>
<center>
<button>Back to Buyer List</button>
<button>Appoinment Request</button>
</center>
</span>
<?php
}
							

?>