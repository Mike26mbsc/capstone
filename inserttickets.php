<?php
	session_start();
	require_once 'header.php';

	if ($_SESSION['signedin'] == 1) {
		if (preg_match('/...............1......................../', $_SESSION['permission'])) {
?>
<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="#">tickets</a></li>
	<li class="breadcrumb-item active">Insert</li>
</ol>

<div class="card">
	<div class="card-header">Insert ticket</div>
	<div class="card-body">
		<?php if (isset($_POST['insertticketsubmit'])) { //this runs after you have selected the location, the ticket type, and the table if it is dine in ?>
			<?php
				// Date time
				date_default_timezone_set('UTC');
				$date = date('Y-m-d');
				$time = date('h:i:s');

				//enter data into database
				$sqlinsert = 'INSERT INTO tickets (customerkey, ticketdate, tickettime, locationkey, tickettype, tablekey, employeekey, ticketcomplete)
								VALUES (:bvcustomer, :bvdate, :bvtime, :bvlocation, :bvtickettype, :bvtablekey, :bvemployee, 0)';
				$stmtinsert = $db->prepare($sqlinsert);
				$stmtinsert->bindvalue(':bvcustomer', $_POST['customerkey']);
				$stmtinsert->bindvalue(':bvdate', $date);
				$stmtinsert->bindvalue(':bvtime', $time);
				$stmtinsert->bindvalue(':bvlocation', $_POST['locationkey']);
				$stmtinsert->bindvalue(':bvtickettype', $_POST['tickettype']);
				$stmtinsert->bindvalue(':bvtablekey', $_POST['tablekey']);
				$stmtinsert->bindvalue(':bvemployee', $_SESSION['employeekey']);
				$stmtinsert->execute();

				$sqlmax = "SELECT MAX(ticketkey) AS maxid from tickets";
				$resultmax = $db->prepare($sqlmax);
				$resultmax->execute();
				$rowmax = $resultmax->fetch();
				$maxid = $rowmax["maxid"];
			?>
			<p>Selection successful. Please proceed to enter items.</p>
			<form method="post" action="insertticketdetails.php">
				<input type="hidden" name="ticketkey" value = "<?php echo $maxid; ?>" />
				<input type="submit" name="ticketsubmit" value="Proceed" />
			</form>
		<?php 
				
				//this is where the user selects a table 
				// and runs only if the user has chosen a location and wants dine in. 
				//table is selected before going to the next part of selecting a customer. 
				
		} else if (isset($_POST['ticketlocationsubmit']) && $_POST['tickettype'] == 1) { ?>
			<!-- Table selection (if tickettype is dine-in) -->
			<form class="was-validated" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
				<div class="row">
					<div class="col-12 col-md-4 mb-3">
						<select name="tablekey" class="form-control" required>
							<option disabled selected>Table</option>
							<?php
							$sqlselectt = "SELECT * FROM tables WHERE locationkey=:bvlocationkey";
							$resultt = $db->prepare($sqlselectt);
							$resultt->bindValue(':bvlocationkey', $_POST['locationkey']);
							$resultt->execute();

							while ($rowt = $resultt->fetch()) {
								echo '<option value="'. $rowt['tablekey'] . '">' . $rowt['tablename'] . '</option>';
							}
							?>
						</select>
						<div class="valid-feedback">Valid table</div>
						<div class="invalid-feedback">Invalid invalid table</div>
					</div>
				</div>
				<!-- Submit button row -->
				<div class="row">
					<div class="col-12">
						<input type="hidden" name="locationkey" value="<?php echo $_POST['locationkey']; ?>" />
						<input type="hidden" name="tickettype" value="<?php echo $_POST['tickettype']; ?>" />
						<button name="ticketinfosubmit" type="submit" class="btn btn-primary">Submit</button>
					</div>
				</div>
			</form>
			
		<?php  
		
		//THIS IS WHERE THE USER SELECTS A CUSTOMER REGARDLESS OF WHETHER DINE IN OR TAKE OUT
		//If the user wants dine in he will have to select a location and ticket type dine in (tickettype == 1). Then click the ticketlocationsubmit button, 
		//then select a table number and click the ticketinfo submit button. Dine in is covered by the left side of the following if statement by posting the ticketinfosubmit
		//If the user wants take out, you skip right past the table selection and end up going directly to selecting a customer because you didn't need to click the ticketinfosubmit button to select a table.
		//therefore only the ticketlocationsubmit has been clicked but now the tickettype == 0. Took me a second to figure out what was going on here. whew!
		
		} else if (isset($_POST['ticketinfosubmit']) || (isset($_POST['ticketlocationsubmit']) && $_POST['tickettype'] == 0)) { ?>
			<!-- Customer selection -->
			<div class="table-responsive">
				<table class="table table-bordered" id="selectcustomersTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Phone</th>
							<th>Email</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php
						
						//THIS OUTPUTS ALL OF THE INFORMATION RELATIVE TO THE CUSTOMER WITH HIDDEN INPUT VALUES 
						//THAT WILL BE INSERTED INTO THE DATABASE AS AN ticket IS PLACED (customerkey, locationkey, tablekey, tickettype)
						if (isset($_POST['tablekey'])) {
							$formfield['tablekey'] = $_POST['tablekey'];
						} else {
							$formfield['tablekey'] = 0;
						}
						$sqlselectc = "SELECT * FROM customer WHERE 1";
						$result = $db->prepare($sqlselectc);
						$result->execute();
							while ( $row = $result-> fetch() )
								{
									echo '<tr><td>' . $row['customerfirstname'] . '</td><td> ' . $row['customerlastname'] .
									'</td><td> ' . $row['customerphone'] . '</td><td> ' . $row['customeremail'] . '</td>
									<td>
										<form name="insertticketform" method="post" action="' . $_SERVER['PHP_SELF'] . '">
											<input type="hidden" name="customerkey" value="' . $row['customerkey'] . '"/>
											<input type="hidden" name="locationkey" value="' . $_POST['locationkey'] . '" />
											<input type="hidden" name="tablekey" value="' . $formfield['tablekey'] . '" />
											<input type="hidden" name="tickettype" value="' . $_POST['tickettype'] . '" />
											<input type="submit" name="insertticketsubmit" value="Select"/>
										</form>
									</td>';
								}
								echo '</tr>';
						?>
					</tbody>
				</table>
			</div>
		<?php } else 
			//this displays the selection boxes when you first get to the insertticket.php page. 
		
		
		{ ?>
			<form class="was-validated" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
				<div class="row">
					<!-- Locations -->
					<div class="col-12 col-md-4 mb-3">
						<select name="locationkey" class="form-control" required>
							<option disabled selected>Location</option>
							<?php
							$sqlselectl = "SELECT * FROM locations";
							$resultl = $db->prepare($sqlselectl);
							$resultl->execute();

							while ($rowl = $resultl->fetch()) {
								echo '<option value="'. $rowl['locationkey'] . '">' . $rowl['locationname'] . '</option>';
							}
							?>
						</select>
						<div class="valid-feedback">Valid location</div>
						<div class="invalid-feedback">Invalid location</div>
					</div>
					<!-- ticket type -->
					<div class="col-12 col-md-4 mb-3">
						<select name="ordertype" class="form-control" required>
							<option disabled selected>ticket Type</option>
							<option value="1">Dine In</option>
							<option value="0">Carry Out</option>
						</select>
						<div class="valid-feedback">Valid ticket type</div>
						<div class="invalid-feedback">Invalid ticket type</div>
					</div>
				</div>
				<!-- Submit button row -->
				<div class="row">
					<div class="col-12">
						<button name="ticketlocationsubmit" type="submit" class="btn btn-primary">Submit</button>
					</div>
				</div>
			</form>
		<?php } ?>
	</div>
</div>

<script>
$(document).ready( function () {
    $('#selectcustomersTable').DataTable();
} );
</script>

<?php
} else {
	echo '<p>You do not have permission to view this page</p>';
}
} else {
	echo '<p>You are not signed in. Click <a href="signin.php">here</a> to sign in.</p>';
}
	require_once 'footer.php';
?>
