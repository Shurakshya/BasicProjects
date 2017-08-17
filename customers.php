<?php include "../inc/dbinfo.inc"; ?>


<?php

/* Connect to MySQL and select the database. */
$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

// test if connection successful

if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();
$database = mysqli_select_db($connection, DB_DATABASE);

/* update name form submit */
if(isset($_POST['submit'])){ //check if form was submitted
  $input = $_POST['name']; //get input text
  $oldname=$_POST['oldname'];
  $message = "Success! You entered: ".$input;

	$query="UPDATE customers SET name='{$input}' WHERE name='{$oldname}' LIMIT 1";
	$result = mysqli_query($connection, $query);
	if($result){
		//success 
		$message="Name update success.";

	}else{
		$message="Name update failed.";
	}
} 

  ?>

  	<?php include "./includes/layouts/header.php"; ?>

    	<div class="container">
    		<div class="well">
				<h2>
					Customers
					<span style="font-size:16px;color:red;" class="text-center"><?php echo $message; ?></span>
					<a href="index.php" style="float:right" class="btn btn-primary">Back to Orders</a>
				</h2>
			</div>

			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
				      	<tr>
					        <th>Id</th>
					        <th>Name</th>
					        <th>Address</th>
					        <th>Zip</th>
					        <th>City</th>
					        <th>Edit</th>
				      	</tr>

					</thead>
					<tbody>
						<?php
							$query= "SELECT * FROM customers";
							$results = mysqli_query($connection , $query);
							if($results){
								while( $data = mysqli_fetch_assoc($results)){
							 		echo "<tr>";

							 		$id=htmlentities($data['id']);
									$customerName = htmlentities($data['name']);
									$address = htmlentities($data['address']);
									$zip=htmlentities($data['zip']);
									$city=htmlentities($data['city']);

									echo "<td> $id </td>";
									echo "<td class='name_form'>
											<div class='toggle_customer'>
												$customerName &nbsp;
												
											</div>

											<form action='' method='post' class='form-inline edit_form' style='display:none'>
											    <div class='form-group'>
											        <label for='name'>Name:</label>
											        <input type='text'class='form-control'  name='name' value='$customerName'>
											    </div>
											    <div class='form-group' style='display:none'>
											        <label for='name'>To change this Name:</label>
											        <input type='text'class='form-control'  name='oldname' value='$customerName'>
											    </div>
											    <button type='submit' name='submit' class='btn btn-default'>Update</button>
											    <button class='btn btn-danger cancel_submit'>Cancel</button>
											</form>

										</td>";

									echo "<td>$address </td>";
									echo "<td> $zip </td>";
									echo "<td> $city </td>";
									echo "<td>
											<i class='glyphicon glyphicon-pencil edit'></i>
										</td>";
									echo "</tr>";
									

								}
							}
							
						?>
					</tbody>
				</table> 
	  		</div>
		
			<?php include "./includes/layouts/footer.php"; ?>
  		</div>

