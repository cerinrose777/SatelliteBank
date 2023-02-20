<html>
<?php
include "nav.php";
include "config.php";
?>
<head>
	<title>Sparks Foundation Banking System</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	
	<body class="crn">
<div class="container">
	<center><h2 class="crn-2"> Transaction history</h2>
	<br>
	<div class="table-responsive-sm">
		<table class="tab-3">
			<thead>
				<tr>
					<th class="pi-3">Si.no</th>
					<th class="pi-3">Sender</th>
					<th class="pi-3">Reciever</th>
					<th class="pi-3">Amount</th>
					<th  class="pi-3">Date and Time</th>
				</tr>
			</thead>
			<tbody>
				<?php include "config.php";
				$sql="SELECT * FROM transaction";
				$query =mysqli_query($conn,$sql);
				while($rows = mysqli_fetch_assoc($query))
				{
					?>
					<tr>
						<td class="ti-3"><?php echo $rows['sno'];?></td>
						<td class="ti-3"><?php echo $rows['sender'];?></td>
						<td class="ti-3"><?php echo $rows['receiver'];?></td>
						<td class="ti-3"><?php echo $rows['balance'];?></td>
						<td class="ti-3"><?php echo $rows['datetime'];?></td>

						<?php
					}
					?>
			</tbody>
		</table>

	</div>
</div></center>
	</body>
</head>
</html>