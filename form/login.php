<?php
session_start();
include '../components/config.php';

if(isset($_POST['login'])){

    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = $_POST['password'];

    $query = mysqli_query($conn,"SELECT * FROM registered WHERE email='$email'");

    if(mysqli_num_rows($query) > 0){

        $user = mysqli_fetch_assoc($query);

        if(password_verify($password,$user['password'])){

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];

            header("Location: ../employee/index.php");
            exit();

        }else{
            echo "<script>alert('Invalid Password');</script>";
        }

    }else{
        echo "<script>alert('User Not Found');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../style/style1.css">
</head>
<body>

<div class="container">
    <form method="POST" class="form">
        <h2>Login</h2>

        <input type="email" name="email" placeholder="Email" required>

        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" name="login">Login</button>

        <p>Don't have an account?
            <a href="register.php">Register</a>
        </p>
    </form>
</div>

</body>
</html>