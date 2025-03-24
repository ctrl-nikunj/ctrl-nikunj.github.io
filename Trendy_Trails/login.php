<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="logo.png" type="image/x-icon">
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="img">
        <img src="bg.jpeg" alt="Background Image">
    </div>
    <div class="login-container">
        <?php
            include("php/config.php");
            if(isset($_POST['submit'])){
                $email = mysqli_real_escape_string($con, $_POST['email']);
                $password = mysqli_real_escape_string($con, $_POST['password']);

                $result = mysqli_query($con, "SELECT * FROM users WHERE Email ='$email'") or die("Select Error!!");
                if(mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $_SESSION['valid'] = $row['id']; // Storing user ID in session
                    $_SESSION['username'] = $row['Username'];
                    header("Location: home.php");
                    echo "Welcome".$_SESSION['username'];
                    exit(); // Exit to prevent further execution
                } else {
                    echo "<div class='message'>
                            <p>Incorrect Username or Password</p>
                        </div><br>";
                    echo "<a href='login.php'><button class='button'>Go Back</button></a>";
                }
            }
        ?>
        <h1>Login</h1>
        <form id="login-form" action="" method="POST">
            <label>Email</label> <!-- Changed label from "Username" to "Email" -->
            <input type="email" name="email" placeholder="Email" required>
            <label>Password</label>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="submit">Login</button>
            <p>Not Registered Yet?<a href="registration.php" class="link">Sign Up Now!!</a></p>
        </form>
    </div>
</body>
</html>
