<?php
	session_start();
	require_once 'header.php';

	if ($_SESSION['signedin'] == 1) {
		// Only view this page if it came from the according pages
		if (isset($_POST['updateemployeeselection']) || isset($_POST['update'])) {
			// Define employee key
			$formfield['employeekey'] = $_POST['employeekey'];
			// Data cleansing
			$formfield['username'] = $_POST['username'];
			$formfield['typekey'] = $_POST['type'];
			$formfield['firstname'] = $_POST['firstname'];
			$formfield['lastname'] = $_POST['lastname'];
			$formfield['phone'] = $_POST['phone'];
			$formfield['address'] = $_POST['address'];
			$formfield['city'] = $_POST['city'];
			$formfield['state'] = $_POST['state'];
			$formfield['zip'] = $_POST['zip'];
			$formfield['email'] = $_POST['email'];
			$formfield['password1'] = $_POST['password1'];
			$formfield['password2'] = $_POST['password2'];
			$formfield['pay'] = $_POST['pay'];
?>
<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="#">Employees</a></li>
	<li class="breadcrumb-item active">Update</li>
</ol>
<div class="card">
	<div class="card-header">Update Employees</div>
	<div class="card-body">
		<?php
		// If submit button is pressed
		if (isset($_POST['update'])) {

			// If there's an empty field
			if (empty($formfield['username']) || empty($formfield['typekey']) ||
					empty($formfield['firstname']) || empty($formfield['lastname']) ||
					empty($formfield['phone']) || empty($formfield['address']) ||
					empty($formfield['city']) || empty($formfield['state']) ||
					empty($formfield['zip']) || empty($formfield['email']) ||
					empty($formfield['password1']) || empty($formfield['password2'])) {
						echo '<br /><p class="text-warning">Insert failed: one or more fields are empty.</p>';
			} else {
				// If the two passwords are the same
				if ($formfield['password1'] == $formfield['password2']) {
					// If the password is invalid
					if(strlen($formfield['password1']) < 8
						 && !preg_match("#[0-9]+#", $formfield['password1'])
						 && !preg_match("#[a-z]+#", $formfield['password1'])
						 && !preg_match("#[A-Z]+#", $formfield['password1'])
						 && !preg_match("#\W+#", $formfield['password1'])) {
						echo '<br /><p class="text-warning">Insert failed: password is invalid.</p>';
					} else {
						// Options...
						$options = [
							'cost' => 12,
					//		'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
						];
						// Generate an encrypted password
						$encpass = password_hash($formfield['password1'], PASSWORD_BCRYPT, $options);

						// Try to insert
						try {
							// SQL statement
							$sqlupdate = 'UPDATE employee
														SET employeeusername=:bvusername, employeetypekey=:bvtypekey,
																employeefirstname=:bvfirstname, employeelastname=:bvlastname,
																employeephone=:bvphone, employeeaddress=:bvaddress,
																employeecity=:bvcity, employeestate=:bvstate,
																employeezip=:bvzip, employeeemail=:bvemail,
																employeepassword=:bvpassword, employeepay=:bvpay
														WHERE employeekey=:bvemployeekey';

							// Execution
							$result = $db->prepare($sqlupdate);
							$result->bindValue('bvusername', $formfield['username']);
							$result->bindValue('bvtypekey', $formfield['typekey']);
							$result->bindValue('bvfirstname', $formfield['firstname']);
							$result->bindValue('bvlastname', $formfield['lastname']);
							$result->bindValue('bvphone', $formfield['phone']);
							$result->bindValue('bvaddress', $formfield['address']);
							$result->bindValue('bvcity', $formfield['city']);
							$result->bindValue('bvstate', $formfield['state']);
							$result->bindValue('bvzip', $formfield['zip']);
							$result->bindValue('bvemail', $formfield['email']);
							$result->bindValue('bvpassword', $encpass);
							$result->bindValue('bvpay', $formfield['pay']);
							$result->bindValue('bvemployeekey', $formfield['employeekey']);
							$result->execute();

							// Success
							echo '<div class="alert alert-success" role="alert">Update successful. <a href="updateemployees.php">Back</a></div>';
						} catch (Exception $e) {
							// Exception error
							echo '<br />
										<p class="text-success font-weight-bold">Update failed.</p>
										<p class="text-danger">' . $e->getMessage() . '</p>';
						}
					}
				}
			}
		}
		?>
		<form class="was-validated" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
			<div>
				<div class="row">
					<div class="col-12 col-md-4 mb-3">
						<input name="firstname" type="text" class="form-control" placeholder="First Name" value="<?php echo $formfield['firstname']; ?>" required>
						<div class="valid-feedback">Valid first name</div>
						<div class="invalid-feedback">Invalid first name</div>
					</div>
					<div class="col-12 col-md-4 mb-3">
						<input name="lastname" type="text" class="form-control" placeholder="Last Name" value="<?php echo $formfield['lastname']; ?>" required>
						<div class="valid-feedback">Valid last name</div>
						<div class="invalid-feedback">Invalid last name</div>
					</div>
					<div class="col-12 col-md-4 mb-3">
						<input name="phone" type="text" class="form-control" placeholder="Phone" value="<?php echo $formfield['phone']; ?>" required>
						<div class="valid-feedback">Valid phone</div>
						<div class="invalid-feedback">Invalid phone</div>
					</div>
					<div class="col-12 col-md-6 mb-3">
						<input name="email" type="email" class="form-control" placeholder="Email" value="<?php echo $formfield['email']; ?>" required>
						<div class="valid-feedback">Valid email</div>
						<div class="invalid-feedback">Invalid email</div>
					</div>
					<div class="col-12 col-md-6 mb-3">
						<input name="address" type="text" class="form-control" placeholder="Address" value="<?php echo $formfield['address']; ?>" required>
						<div class="valid-feedback">Valid address</div>
						<div class="invalid-feedback">Invalid address</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 col-md-4 mb-3">
						<input name="city" type="text" class="form-control" placeholder="City" value="<?php echo $formfield['city']; ?>" required>
						<div class="valid-feedback">Valid city</div>
						<div class="invalid-feedback">Invalid city</div>
					</div>
					<div class="col-6 col-md-4 mb-3">
						<select name="state" class="form-control" required>
							<option disabled selected>State</option>
							<?php

									//open files holding state names and abbreviations
								 $stateabbreviation = fopen("states.txt", "r") or die("Error reading file!");
						 	       	 $stateName   = fopen("statenames.txt", "r") or die("Error reading file!");

								 //read abbreviations line by line from the file
								 while (($abbreviation = fgets($stateabbreviation)) !== false) {

									//set variable for state name from other file
									$fullname = fgets($stateName);
								        
									//output option tag opening and state abbreviation	
									echo '<option value="' . trim($abbreviation) . '"';
									
									//make the state that matches formfield[state] the selected option
									if(trim($abbreviation) == $formfield['state']){  echo "selected";}

									//output the state name and close the option tag
 	          				 			echo '>' . trim($fullname) . '</option>';
 	            		           		         }		 
								 
								 // (C) CLOSE FILES
								 fclose($stateabbreviation);
								 fclose($stateName);
									
							?>
			 	               </select>
			 	               <?php 
			 	               // (C) CLOSE FILE
			 	              // fclose($stateabbreviation);
			 	              // fclose($stateName);
			
			 	               ?>

						<div class="valid-feedback">Valid state</div>
						<div class="invalid-feedback">Invalid state</div>
					</div>
					<div class="col-6 col-md-4 mb-3">
						<input name="zip" type="text" class="form-control" placeholder="ZIP" value="<?php echo $formfield['zip']; ?>" required>
						<div class="valid-feedback">Valid zip</div>
						<div class="invalid-feedback">Invalid zip</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 col-md-6 mb-3">
						<input name="username" type="text" class="form-control" placeholder="Username" value="<?php echo $formfield['username']; ?>" required>
						<div class="valid-feedback">Valid username</div>
						<div class="invalid-feedback">Invalid username</div>
					</div>
					<div class="col-12 col-md-6 mb-3">
						<select name="type" class="form-control" required>
							<option disabled selected>User Type</option>
							<?php
							$sqlselectet = "SELECT * FROM employeetype WHERE 1";
							$resultet = $db->prepare($sqlselectet);
							$resultet->execute();

							while ($rowet = $resultet->fetch()) {
								echo '<option value="'. $rowet['employeetypekey'] . '"';
								if ($rowet['employeetypekey'] == $formfield['typekey']) { echo ' selected'; };
								echo '>' . $rowet['employeetypename'] . '</option>';
							}
							?>
						</select>
						<div class="valid-feedback">Valid user type</div>
						<div class="invalid-feedback">Invalid user type</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 col-md-2 mb-3">
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text">$</div>
							</div>
							<input name="pay" type="text" class="form-control" placeholder="Pay" value="<?php echo $formfield['pay']; ?>" required>
							<div class="valid-feedback">Valid pay</div>
							<div class="invalid-feedback">Invalid pay</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 col-md-6 mb-3">
						<input id="password1" name="password1" type="text" class="form-control" placeholder="Password" required>
						<div class="valid-feedback">Valid password</div>
						<div id="password1-feedback" class="invalid-feedback">Invalid password</div>
					</div>
					<div class="col-12 col-md-6 mb-3">
						<input id="password2" name="password2" type="text" class="form-control" placeholder="Confirm Password" required>
						<div id="password2-valid-feedback" class="valid-feedback">Passwords match</div>
						<div id="password2-invalid-feedback" class="invalid-feedback">Passwords do not match</div>
					</div>
				</div>
				<p id="passwordtip" class="mt-3 text-danger mb-3">Passwords must contain an uppercase, lowercase, digit, and 8 characters.</p>
				<div class="row">
					<div class="col-12">
						<input type="hidden" name="employeekey" value="<?php echo $formfield['employeekey']; ?>"/>
						<button name="update" type="submit" class="btn btn-primary">Submit</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript" src="scripts/passwordvalidator.js"></script>
<?php
} else {
	echo '<p>not this time</p>'; // page can not be viewed
}
} else {
		echo '<p>You are not signed in. Click <a href="signin.php">here</a> to sign in.</p>';
}
	require_once 'footer.php';
?>
