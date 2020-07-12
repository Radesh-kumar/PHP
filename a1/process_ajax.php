<?php
	include 'db.php';
	if(isset($_REQUEST['submit_form'])){
			$u_id= mysqli_real_escape_string($conn, strip_tags($_REQUEST['id']));
			$username = mysqli_real_escape_string($conn, strip_tags($_REQUEST['name']));
			$email = mysqli_real_escape_string($conn, strip_tags($_REQUEST['email']));
			$contactnumber = mysqli_real_escape_string($conn, strip_tags($_REQUEST['contactnumber']));
			$notes = mysqli_real_escape_string($conn, strip_tags($_REQUEST['notes']));
		$ins_sql = "INSERT INTO php2 (u_name, u_email, u_number, u_notes,u_id) VALUES ('$username', '$email', '$contactnumber', '$notes','$u_id')";
		$run_sql = mysqli_query($conn, $ins_sql);
	}

	if(isset($_REQUEST['del_id'])){
		$del_sql = "DELETE FROM php2 WHERE u_id = '$_REQUEST[del_id]'";
		$del_run = mysqli_query($conn, $del_sql);
	}

	if(isset($_REQUEST['edit_form'])){
		$edit_id= mysqli_real_escape_string($conn, strip_tags($_REQUEST['edit_id']));
		$edit_username = mysqli_real_escape_string($conn, strip_tags($_REQUEST['edit_username']));
		$edit_email = mysqli_real_escape_string($conn, strip_tags($_REQUEST['edit_email']));
		$edit_contactnumber = mysqli_real_escape_string($conn, strip_tags($_REQUEST['edit_contactnumber']));
		$edit_notes = mysqli_real_escape_string($conn, strip_tags($_REQUEST['edit_notes']));
		$edit_sql = "UPDATE php2 SET u_name = '$edit_username', u_email = '$edit_email', u_number = '$edit_contactnumber', u_notes = '$edit_notes',u_id='$edit_id' WHERE u_id = '$_REQUEST[ed_id]'";
		mysqli_query($conn, $edit_sql);
	}


	$sql = "SELECT * FROM php2";
	$run = mysqli_query($conn, $sql);
	$c = 1;
	while($rows = mysqli_fetch_assoc($run)){
		echo "
			<tr>
				<td>$c</td>
				<td>$rows[u_id]</td>
				<td>$rows[u_name]</td>
				<td>$rows[u_email]</td>
				<td>$rows[u_number]</td>
				<td>$rows[u_notes]</td>
				<td class='text-left'>
					<button class='btn btn-success' data-toggle='modal' data-target='#edit_person$rows[u_id]'>Edit</button>
					<button class='btn btn-danger' onclick=delete_func('$rows[u_id]');>Delete</button>

					<div class='modal fade' id='edit_person$rows[u_id]'>
						<div class='modal-dialog'>
							<div class='modal-content'>

								<div class='modal-header'>Header</div>
								<div class='modal-body'>


									<form onsubmit='return edit_form($rows[u_id]);' id='edit_form$rows[u_id]'>

									<!-- ****While Loop will create all respective forms according $rows[u_id]It will not wait for user to click edit****  -->

									<!-- ***here edit_form$rows[u_id] will create n no. of modals exist using there u_id in database***  -->
									
									<div class='form-group'>
										<label>Id</label>
										<input type='text' value='$rows[u_id]' id='edit_id$rows[u_id]' class='form-control' required>
									</div>

										<div class='form-group'>
											<label>Name</label>
											<input type='text' value='$rows[u_name]' id='edit_username$rows[u_id]' class='form-control' required>
										</div>
										<div class='form-group'>
											<label>Email</label>
											<input type='text' value='$rows[u_email]' id='edit_email$rows[u_id]' class='form-control' required>
										</div>
										<div class='form-group'>
											<label>Contact Number</label>
											<input type='text' value='$rows[u_number]' id='edit_contactnumber$rows[u_id]' class='form-control' required>
										</div>
										<div class='form-group'>
											<label>Notes</label>
											<textarea id='edit_notes$rows[u_id]' class='form-control'>$rows[u_notes]</textarea>
										</div>
										<div class='form-group'>
										<button class='btn btn-info btn-block btn-lg'>Done Editing</button>
									</div>
									</form>
								</div>
								<div class='modal-footer'>
									<div class='text-right'>
										<button class='btn btn-danger' data-dismiss='modal'>Close</button>
									</div>
								</div>
							</div>
						</div>x
					</div>
				</td>
			</tr>
		";
		$c++;
	}
?>
