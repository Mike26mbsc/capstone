<?php
require_once 'connect.php';
?>
<table border="1" class="table table-bordered" id="selectemployeesTable" width="100%" cellspacing="0">
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
echo $_POST['weeklyschedulekey'];
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
					
			}
			echo '</tr>';
					?>
				</tbody>
			</table>
