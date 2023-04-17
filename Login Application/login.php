<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location:index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
     <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php
        if (isset($_POST["login"])) {
           $email = $_POST["email"];
           $password = $_POST["password"];
            require_once "db.php";
            $sql = "SELECT * FROM user WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if (password_verify($password, $user["password"])) {
                    session_start();
                    $_SESSION["user"] = "yes";
                    header("Location:index.php");
                    die();
                }else{
                    echo "<div class='alert alert-danger'>Password doesn't match</div>";
                }
            }else{
                echo "<div class='alert alert-danger'>Email doesn't match</div>";
            }
        }
        ?>
      <form action="login.php" method="post">
        <label id="head_label">Login Form</label>
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Enter Email:"  >
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Enter Password:" >
        </div>
        <div class="form-btn">
            <input type="submit" name="login" class="btn btn-primary" value="Login" >
        </div>
      </form>
     <div><p>Not registered<a href="registration.php">Register</a></p></div>
    </div>
</body>
</html>