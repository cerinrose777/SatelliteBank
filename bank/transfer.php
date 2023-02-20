<?php
include('config.php');

if(isset($_POST['submit']))
{
    $from = $_GET['id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from users where id=$from";
    $query = mysqli_query($conn,$sql);
    $sql1 = mysqli_fetch_array($query);

    $sql = "SELECT * from users where id=$to";
    $query = mysqli_query($conn,$sql);
    $sql2 = mysqli_fetch_array($query);



    
    if (($amount)<0)
   {
        echo '<script type="text/javascript">';
        echo ' alert("Oops! Negative values cannot be transferred")';
        echo '</script>';
    }


  
   
    else if($amount > $sql1['balance']) 
    {
        
        echo '<script type="text/javascript">';
        echo ' alert("Bad Luck! Insufficient Balance")'; 
        echo '</script>';
    }
    


    else if($amount == 0){

         echo "<script type='text/javascript'>";
         echo "alert('Oops! Zero value cannot be transferred')";
         echo "</script>";
     }


    else {
        
                // deducting amount from sender's account
                $newbalance = $sql1['balance'] - $amount;
                $sql = "UPDATE users set balance=$newbalance where id=$from";
                mysqli_query($conn,$sql);
             

                // adding amount to reciever's account
                $newbalance = $sql2['balance'] + $amount;
                $sql = "UPDATE users set balance=$newbalance where id=$to";
                mysqli_query($conn,$sql);
                
                $sender = $sql1['name'];
                $receiver = $sql2['name'];
                $sql = "INSERT INTO transaction(`sender`, `receiver`, `balance`) VALUES ('$sender','$receiver','$amount')";
                $query=mysqli_query($conn,$sql);

                if($query){
                     echo "<script> alert('Transaction Successful');
                                     window.location='transactions.php';
                           </script>";
                    
                }

                $newbalance= 0;
                $amount =0;
        }
    
}
?>
 
<?php
  include 'nav.php';
?>
<<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Transfer money</title>
    <link rel="stylesheet" type="text/css" href="style.css">
   
</head>
<body class="ptr">

	<div class="container">
        <h1 class="smrq">Transaction</h1>
            <?php
                include 'config.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM  users where id=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error : ".$sql."<br>".mysqli_error($conn);
                }
                $rows=mysqli_fetch_assoc($result);
            ?>
            <form method="post" name="tcredit" class="tabletext" ><br>
        <div>
           <center><table class="tab-2">
                <tr>
                    <th class="pi-2">Id</th>
                    <th class="pi-2">Name</th>
                    <th class="pi-2">Email</th>
                    <th class="pi-2">Balance</th>
                </tr>
                <tr>
                    <td class="ti-2"><?php echo $rows['id'] ?></td>
                    <td class="ti-2"><?php echo $rows['name'] ?></td>
                    <td class="ti-2"><?php echo $rows['email'] ?></td>
                    <td class="ti-2"><?php echo $rows['balance'] ?></td>
                </tr>
            </table></center> 
        </div>
        <br>
        <div class="vro"><center><label>Transfer To:</label>
        <select name="to" class="form-control" required>
            <option value="" disabled selected>Choose</option>
            <?php
                include 'config.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM users where id!=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error ".$sql."<br>".mysqli_error($conn);
                }
                while($rows = mysqli_fetch_assoc($result)) {
            ?>
                <option class="opt-transfer"value="<?php echo $rows['id'];?>" >
                
                    <?php echo $rows['name'] ;?> (Balance: 
                    <?php echo $rows['balance'] ;?> ) 
               
                </option>
            <?php 
                } 
            ?>
            <div>
        </select>
        <br>
        <br>
            <label>Amount:</label>
            <input type="number" class="form-control" name="amount" required>   
            <br><br>
                <div class="text-center" >
            <button class="btn-2" name="submit" type="submit" id="btn">Transfer</button>
            </div></center></div>
        </form>
    </div>

</body>
</html>