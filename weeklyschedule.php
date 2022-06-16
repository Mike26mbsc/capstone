<?php
	session_start();
	require_once 'header.php';

	if ($_SESSION['signedin'] == 1) {
		// This function gets the weekdate of a given date
		function getWeekday($date) {
			return date('w', strtotime($date));
		}
?>
<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="#">Schedules</a></li>
	<li class="breadcrumb-item active">Weekly</li>
</ol>
<div class="card">
<div class="card-header">Week of: <?php echo $_POST['weeklyschedulekey'];?></div>
	<div class="card-body">
		<?php if(isset($_POST['selectemployeesubmit'])) { ?>
			<div class="table-responsive">
				<table class="table table-bordered" id="selectschedulesTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Week of</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$sqlselects = 'SELECT *
													 FROM schedules
													 WHERE employeekey=:bvemployeekey';
						$result = $db->prepare($sqlselects);
						$result->bindValue(':bvemployeekey', $_POST['employeekey']);
						$result->execute();
							while ( $row = $result-> fetch() )
								{
									echo '<tr><td>' . $row['schedulestart'] . '</td>
									<td>
										<form name="selectscheduleform" method="post" action="updateschedulesform.php">
											
											
											<input type="hidden" name="employeekey" value="' . $row['employeekey'] . '"/>
											<input type="hidden" name="schedulekey" value="' . $row['schedulekey'] . '"/>
											<input type="submit" name="selectschedulesubmit" value="Select"/>
										</form>
									</td>';
								}
								echo '</tr>';
						?>
					</tbody>
				</table>
			</div>
		<?php } else { ?>
			<!-- Begin by selecting an employee -->
			<div class="table-responsive">
				<table class="table table-bordered" id="selectemployeesTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Week Of: </th>
						<th>First Name</th>
						<th>Position</th>
						<th>Sunday</th>
						<th>Monday</th>
						<th>Tuesday</th>
						<th>Wednesday</th>
						<th>Thursday</th>
						<th>Friday</th>
						<th>Saturday</th>
					</tr>
				</thead>
				<tbody>
<?php
								$sqlselecti = "SELECT * FROM employee 
									       INNER JOIN employeetype ON employee.employeetypekey = employeetype.employeetypekey 
								       			
									       INNER JOIN schedules ON employee.employeekey = schedules.employeekey 
									       WHERE schedules.schedulestart = :bvweeklyschedulekey
									ORDER BY employee.employeekey ASC";
						 			$result = $db->prepare($sqlselecti);
										$result->bindValue(':bvweeklyschedulekey', $_POST['weeklyschedulekey']);
										$result->execute();
											while ( $row = $result-> fetch() )
													{
															echo '<tr><td>' . $row['schedulestart'] . '</td><td> ' . $row['employeefirstname'] .
																             '</td><td> ' . $row['employeetypename'] . '</td>'; 
																
																if(is_null($row['sundaystart'])){ echo '<td>'  ;} 
									else { echo  '<td> ' . date("g:i a", strtotime($row['sundaystart']));} 
									echo '---';
									if(is_null($row['sundayend'])){ echo '</td>';}
								        else { echo date("g:i a", strtotime($row['sundayend'])) . '</td>';}
								
			if(is_null($row['mondaystart'])){ echo '<td>'  ;} 
			else { echo  '<td> ' . date("g:i a", strtotime($row['mondaystart']));} 
			echo '---';
			if(is_null($row['mondayend'])){ echo '</td>';}
		        else { echo date("g:i a", strtotime($row['mondayend'])) . '</td>';}
			
			if(is_null($row['tuesdaystart'])){ echo '<td>'  ;} 
			else { echo  '<td> ' . date("g:i a", strtotime($row['tuesdaystart']));} 
			echo '---';
			if(is_null($row['tuesdayend'])){ echo '</td>';}
		        else { echo date("g:i a", strtotime($row['tuesdayend'])) . '</td>';}
				
			if(is_null($row['wednesdaystart'])){ echo '<td>'  ;} 
			else { echo  '<td> ' . date("g:i a", strtotime($row['wednesdaystart']));} 
			echo '---';
			if(is_null($row['wednesdayend'])){ echo '</td>';}
		        else { echo date("g:i a", strtotime($row['wednesdayend'])) . '</td>';}
			
			if(is_null($row['thursdaystart'])){ echo '<td>'  ;} 
			else { echo  '<td> ' . date("g:i a", strtotime($row['thursdaystart']));} 
			echo '---';
			if(is_null($row['thursdayend'])){ echo '</td>';}
		        else { echo date("g:i a", strtotime($row['thursdayend'])) . '</td>';}
				
			if(is_null($row['fridaystart'])){ echo '<td>'  ;} 
			else { echo  '<td> ' . date("g:i a", strtotime($row['fridaystart']));} 
			echo '---';
			if(is_null($row['fridayend'])){ echo '</td>';}
		        else { echo date("g:i a", strtotime($row['fridayend'])) . '</td>';}
			
			if(is_null($row['saturdaystart'])){ echo '<td>'  ;} 
			else { echo  '<td> ' . date("g:i a", strtotime($row['saturdaystart']));} 
			echo '---';
			if(is_null($row['saturdayend'])){ echo '</td>';}
		        else { echo date("g:i a", strtotime($row['saturdayend'])) . '</td>';}
					
			echo '<td>
				
				<form name="selectscheduleform" method="post" action="updateschedulesform.php">


                                                                                        <input type="hidden" name="employeekey" value="' . $row['employeekey'] . '"/>
                                                                                        <input type="hidden" name="schedulekey" value="' . $row['schedulekey'] . '"/>
                                                                                        <input type="submit" name="selectschedulesubmit" value="update"/>
                                                                                </form>	

			     </td>';
			echo '</tr>';
											}
					?>
				</tbody>		
				
				</table>
			</div>
		<?php } ?>
	</div>
</div>
<script>
$(document).ready( function () {
    $('#selectemployeesTable').DataTable();
		$('#selectschedulesTable').DataTable();
} );
</script>
<?php
} else {
	echo '<p>You are not signed in. Click <a href="signin.php">here</a> to sign in.</p>';
}
	require_once 'footer.php';
?>
