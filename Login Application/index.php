<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location:login.php");
}
?>


<!DOCTYPE html>
<html> 
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>User</title>
</head>
<body>      
       
 
    <table > 
    <tr> 
        <th colspan="5"><h2>User Records</h2></th> 
        </tr> 
              <th> ID </th> 
              <th> Name </th> 
              <th> Email </th> 
              <th> Contact </th> 
               <th> Address </th> 
                            
        </tr> 
        
        <?php 
            $conn = mysqli_connect("localhost","root","","register");
            if(!$conn){
    echo("error");
    die("connection Failed.");
}

$sql = "SELECT id,name,email,contact,address from user";
$result = $conn->query($sql);
if($result->num_rows > 0)
     while($row = $result->fetch_assoc()) 
        { 
        ?> 
        <tr> <td><?php echo $row['id']; ?></td> 
        <td><?php echo $row['name']; ?></td> 
        <td><?php echo $row['email']; ?></td> 
        <td><?php echo $row['contact']; ?></td> 
        <td><?php echo $row['address']; ?></td> 
        </tr> 
    <?php 
               } 
          ?> 

    </table> 
   

<br><br>
        <a href="logout.php" class="btn btn-warning">Logout</a>
    
</body>
</html>