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
	<div class="card-header">Weekly Schedules</div>
	<div class="card-body">
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
						$sqlselects = 'SELECT DISTINCT schedulestart FROM schedules ORDER BY schedulestart ASC';

													 
						$result = $db->prepare($sqlselects);
						$result->execute();
							while ( $row = $result-> fetch() )
								{
									echo '<tr><td>' . $row['schedulestart'] . '</td>
									<td>
										<form name="selectscheduleform" method="post" action="weeklyschedule.php">
											
											
											<input type="hidden" name="weeklyschedulekey" value="' . $row['schedulestart'] . '"/>
											<input type="submit" name="weeklyschedulesubmit" value="Select"/>
										</form>
									</td>';
								}
								echo '</tr>';
						?>
					</tbody>
				</table>
			</div>
	</div>
</div>
<script>
$(document).ready( function () {
		$('#selectschedulesTable').DataTable();
} );
</script>
<?php
} else {
	echo '<p>You are not signed in. Click <a href="signin.php">here</a> to sign in.</p>';
}
	require_once 'footer.php';
?>
