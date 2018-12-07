
<?php


$servername = "linkedin.cx2nnmpqznns.us-east-1.rds.amazonaws.com:3306";
$username = "linkedin_user";
$password = "linkedin_pass";
$dbname = "project";


$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$result = 0; 
$show = array();
 $sql = "SELECT * from userscart where username='pratik'";
 //echo ($sql);
    $result = $conn->query($sql);
	
 if ($result->num_rows > 0) {
    // output data of each row
   /*  echo "            my users               ";
    echo ("<br>");
    echo ("<br>");
    echo "contactid    Name `  Role";
    echo ("<br>"); */
    
    while($row = $result->fetch_assoc()) {
        //echo "First Name: " . $row["username"]. " Last Name" . $row["producturl"]. "<br>";
		array_push($show,$row);
	}
	
} 	
else {
	echo "0 results";
}
//print_r($show);

									foreach($show as $key => $value)
									{
									$url = $show[$key]['producturl'] . "?id=" . $show[$key]['productid'];
									
									$ch = curl_init();
									curl_setopt($ch, CURLOPT_URL, $url); 
									//return the transfer as a string 
									curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		
									// $output contains the output string 
									$result = curl_exec($ch);
									
									$data =  json_decode($result,true);


						
									if (count($data) > 0)
									{						
										foreach($data as $key => $value)
										{		
						
						echo('<tr class="table-head">
													<th class="column-1"></th>
													<th class="column-2">Product</th>
													<th class="column-3">Price</th>
													<th class="column-4 p-l-70">Quantity</th>
													<th class="column-5">Total</th>
												</tr>
						<tr class="table-row">
							<td class="column-1">
								<div class="cart-img-product b-rad-4 o-f-hidden">
									<img src="'.$data[$key]['imagepath'].'" alt="IMG-PRODUCT">
								</div>
							</td>
							<td class="column-2">'.$data[$key]['productname'].'</td>
							<td class="column-3">'.$data[$key]['price'].'</td>
							<td class="column-4">
								<div class="flex-w bo5 of-hidden w-size17">
									<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
										<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
									</button>

									<input class="size8 m-text18 t-center num-product" type="number" name="num-product1" value="1">

									<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
										<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
									</button>
								</div>
							</td>
							<td class="column-5">'.$data[$key]['price'].'</td>
						</tr>');}}}
						?>