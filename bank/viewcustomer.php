<html>
<?php
include "nav.php";
include "config.php";
$sql = "SELECT * FROM users";
$result = mysqli_query($conn,$sql);
?>
<head>
    <title>Sparks Foundation Banking System</title>
    <link rel="stylesheet" type="text/css" href="style.css">
   
    <body class="amd">
<div class="container">
    <h1 class="crn-1">USER DETAILS</h1>
    <br>
    <div class="row">
        <div class="container-rm">
            <div class="container-sm">
            <center><table class=" tab-1">
                <thead>
                <tr class="vro">
                    <th class="pi-1">Si.no</th>
                    <th class="pi-1">Name</th>
                    <th class="pi-1">Account No</th>
                    <th class="pi-1">Mail-Id</th>
                     <th class="pi-1">Balance</th>
                    <th class="pi-1">     </th>
                </tr>
            </thead>
            <tbody>
                <?php while ($rows=mysqli_fetch_assoc($result)) {
                 ?>
                 <tr>
                 <td class="ti-1"><?php echo $rows['id'] ?></td>
                 <td class="ti-1"><?php echo $rows['name'] ?></td>
                 <td class="ti-1"><?php echo $rows['accountno'] ?></td>
                 <td class="ti-1"><?php echo $rows['email'] ?></td>
                 <td class="ti-1"><?php echo $rows['balance'] ?></td>
                 <td class="ti-1"><a href="transfer.php?id= <?php echo $rows['id'] ;?>"> <button type="button" class="btn-1">OPEN</button></a></td>
             </tr>
             <?php
                } ?>
            </tbody>
        </table></center>

</div>
    </body>
</head>
</html>