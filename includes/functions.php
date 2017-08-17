<?php 

	function get orders_and_customers(){
		global $connection;					
		$query= "SELECT product_name,sent_at,address,city,zip,name,orders.id as orderId FROM orders LEFT JOIN customers ON orders.customers_id = customers.id";
		$results = mysqli_query($connection , $query);
		if($results){
			while( $data = mysqli_fetch_assoc($results)){
		 		
		 		$id=htmlentities($data['orderId']);
				$customerName = htmlentities($data['name']);
				$address = htmlentities($data['address']);
				$zip=htmlentities($data['zip']);
				$city=htmlentities($data['city']);
				$customersOrder = htmlentities($data['product_name']);
				$date= htmlentities($data['sent_at']);
				$output= "<tr>";

				$output+= "<td>
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

				$output+= "<td>
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
						    <button type='submit' name='submit' class='btn btn-default'>Update Order</button>
						</form>

					</td>";
				$output+= "<td> $date </td>";
				$output+= "<td>
						<i class='glyphicon glyphicon-pencil edit'></i>&nbsp; &nbsp;
						<i class='glyphicon glyphicon-remove remove'></i>
					</td>";
				$output+= "</tr>";

				return $output;
				

			} //while ends here
		} // if ends
	} // fucntion ends
							
						
?>