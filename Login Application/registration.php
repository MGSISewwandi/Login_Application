<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location:index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">
        <?php
        if (isset($_POST["submit"])) {
           $name = $_POST["name"];
            $email = $_POST["email"];
           $contact = $_POST["contact"];    
           $address = $_POST["address"];     
           $password = $_POST["password"];
           $passwordConfirm = $_POST["confirm_password"];
           $passwordHash = password_hash($password, PASSWORD_DEFAULT);

           $errors = array();
           
           if (empty($name) OR empty($email) OR empty($contact) OR empty($address) OR empty($password) OR empty($passwordConfirm)) {
            array_push($errors,"All fields are required");
           }
           if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email is not valid");
           }
           if (strlen($password)<8) {
            array_push($errors,"Password must be at least 8 characters");
           }
           if ($password!==$passwordConfirm) {
            array_push($errors,"Password doesn't match");
           }


           require_once "db.php";

           $sql = "SELECT * FROM user WHERE email = '$email'";
           $result = mysqli_query($conn, $sql);
           $rowCount = mysqli_num_rows($result);
           if ($rowCount>0) {
            array_push($errors,"Email already exists");
           }
           if (count($errors)>0) {
            foreach ($errors as  $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
           }else{
            
            $sql = "INSERT INTO user (name, email, contact, address, password) VALUES ( ?, ?, ?, ?, ? )";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt,"sssss",$name, $email, $contact, $address,  $passwordHash);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>You are registered successfully.</div>";
            }else{
                die("Something went wrong");
            }
           }
          

        }
        ?>
        <form action="registration.php" method="post">
        	<label id="head_label">Registration Form</label>
            <div class="form-group">
                <input type="text" class="form-control" name="name" placeholder="Name:">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email:">
            </div>
             <div class="form-group">
                <input type="text" class="form-control" name="contact" placeholder="Contact No:">
            </div>
             <div class="form-group">
                <input type="text" class="form-control" name="address" placeholder="Home address:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password:">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </div>
        </form>
        <div>
        <div><p>Already Registered  <a href="login.php">  Login</a></p></div>
      </div>
    </div>
</body>
</html>
