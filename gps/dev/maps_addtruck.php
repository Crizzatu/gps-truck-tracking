<?php
require("inc_header_ps.php");
require('../_private/logo.php');
	require_once('../lib/trucks.php');
	require_once('../lib/PeopleAssignments.php');
	mysql_select_db($db_name, $oConn);

// 2014-09-16 Truck Box Update ^CS
// 2014-06-16 Updated For New GPS ^CS

if ($_POST['save'] <> "")
{
	$truck = new Trucks();
	$truck->TruckName = $_POST['TruckName'];
	$truck->TruckID = $_POST['TruckID'];
	$truck->CustomerId = $_SESSION['customerId'];
	$truck->Insert();
	header("Location: maps_trucks.php#Phone");
	exit();
}

?>

<form action="maps_addtruck.php" method="POST" enctype="application/x-www-form-urlencoded" id="truck_add">
	<p>
		<label class="formstyle">Select Driver:</label>
		<select class="validate" id="TruckID" name="TruckID">
			<option value='0'>Select...</option>
			<?php
				$drivers = PeopleAssignments::GetAssignableGPS($_SESSION['customerId']);
				PeopleAssignments::RenderSelectOptions($drivers);
			?>
		</select><br />
		<label class="formstyle">Driver GPS Display Name :</label>
		<input type="text" class="validate" id="TruckName" name="TruckName"/><br />
	</p>
	<p>
		<input type="hidden" name="save" value="1" />
		<input type="submit" id="submit" value="Add Drivers Phone"/>
	</p>
</form>

<div style="text-align:center">
<a onClick="ajax_hideTooltip()">close</a>
</div>