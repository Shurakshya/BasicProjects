<?php include "../inc/dbinfo.inc"; ?>


<?php

/* Connect to MySQL and select the database. */
$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

// test if connection successful

if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();
$database = mysqli_select_db($connection, DB_DATABASE);

/* update name form submit */
if(isset($_POST['submit'])){ //check if form was submitted
  $input = $_POST['ordername']; //get input text
  $orderId=$_POST['orderId'];
  $message = "Success! You entered: ".$input;

	$query="UPDATE orders SET product_name='{$input}' WHERE id='{$orderId}' LIMIT 1";
	$result = mysqli_query($connection, $query);
	if($result){
		//success 
		$message="Order update success.";

	}else{
		$message="Name update failed.";
	}
} 

  ?>

  	<?php include "./includes/layouts/header.php"; ?>

    	<div class="container">
    		<div class="well">
				<h2>
					Orders
					<span style="font-size:14px;color:red;" class="text-center"><?php echo $message; ?></span>
					<a href="customers.php" style="float:right" class="btn btn-primary">All Customers</a>
				</h2>

			</div>

			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
				      	<tr>
					        <th>Customer &nbsp; <span class="glyphicon glyphicon-arrow-down"></span></th>
					        <th>Orders</th>
					        <th>Sent At</th>
					        <th>Edit</th>
				      	</tr>

					</thead>
					<tbody>
						<?php
							$query= "SELECT product_name,sent_at,address,city,zip,name,orders.id as orderId FROM orders LEFT JOIN customers ON orders.customers_id = customers.id";
							$results = mysqli_query($connection , $query);
							if($results){
								while( $data = mysqli_fetch_assoc($results)){
							 		echo "<tr>";

							 		$id=htmlentities($data['orderId']);
									$customerName = htmlentities($data['name']);
									$address = htmlentities($data['address']);
									$zip=htmlentities($data['zip']);
									$city=htmlentities($data['city']);
									$customersOrder = htmlentities($data['product_name']);
									$date= htmlentities($data['sent_at']);

									echo "<td>
											$customerName &nbsp;
												<i class='glyphicon glyphicon-info-sign info' data-toggle='popover' data-placement='bottom' id='test'>
													<table class='table myPopoverContent table-hover' style='display:none'>
														<thead>
													      	<tr>
														        <th>Name</th>
														        <th>Adress</th>
														        <th>Zip</th>
														        <th>City</th>
													      	</tr>
														</thead>
														<tbody>
															<tr>
																<td>$customerName</td>
																<td>$address</td>
																<td>$zip</td>
																<td>$city</td>
															</tr>
														</tbody>
													</table>
												</i>
											
										</td>";

									echo "<td>
											<div class='toggle_order'>
												$customersOrder &nbsp;
											</div>

											<form action='' method='post' class='form-inline edit_form' style='display:none'>
											    <div class='form-group'>
											        <label for='name'>Order:</label>
											        <input type='text'class='form-control'  name='ordername' value='$customersOrder'>
											    </div>
											    <div class='form-group' style='display:none'>
											        <label for='name'>To change this Name:</label>
											        <input type='text'class='form-control'  name='orderId' value='$id'>
											    </div>
											    <button type='submit' name='submit' class='btn btn-default'>Update</button>
											    <button class='btn btn-danger cancel_submit'>Cancel</button>
											</form>

										</td>";
									echo "<td> $date </td>";
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

