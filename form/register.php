<?php
include '../components/config.php';

if(isset($_POST['register'])){

    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $father_name = mysqli_real_escape_string($conn,$_POST['father_name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = mysqli_query($conn,"SELECT * FROM registered WHERE email='$email'");

    if(mysqli_num_rows($check) > 0){
        echo "<script>alert('Email already exists');</script>";
    }else{

        $query = "INSERT INTO registered(name, father_name,email,password)
                  VALUES('$name', '$father_name','$email','$password')";

        if(mysqli_query($conn,$query)){
            echo "<script>alert('Registration Successful');</script>";
        }else{
            echo "Error";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="../style/style1.css">
</head>
<body>

<div class="container">
    <form method="POST" class="form">
        <h2>Register</h2>

        <input type="text" name="name" placeholder="Full Name" required>

        <input type="text" name="father_name" placeholder="Father Name" required>

        <input type="email" name="email" placeholder="Email" required>

        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" name="register">Register</button>

        <p>Already have an account?
            <a href="login.php">Login</a>
        </p>
    </form>
</div>

</body>
</html>