<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="icon" href="logo.png" type="image/x-icon">
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="img">
        <img src="bg.jpeg" alt="Background Image">
    </div>
    <div class="login-container">
        <?php
        // Include configuration and helper files
        include("php/config.php");

        if(isset($_POST['submit'])){
            $username =   $_POST['username'];
            $email =  $_POST['email'];
            $password = $_POST['password'];
            $rpassword=$_POST['rpassword'];
            if($rpassword!=$password){
                echo"<div class='message'><p>Please Enter the correct Password.</p></div>";
                echo "<a href='javascript:self.history.back()'><button class='button'>Go Back</button></a>";
            }else{
            // Check if email already exists
            $verify_query = mysqli_query($con, "SELECT Email FROM users WHERE Email='$email'");
            if(mysqli_num_rows($verify_query) != 0){
                echo "<div class='message'>
                        <p>This Email is already in use. Please try another!</p>
                    </div><br>";
                echo "<a href='javascript:self.history.back()'><button class='button'>Go Back</button></a>";
            } else {
                // Hash the password
                //$hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Insert user data into the database
                $insert_query = mysqli_query($con, "INSERT INTO users(Username, Email, Password) VALUES('$username', '$email', '$password')");
                if($insert_query){
                    echo "<div class='message'>
                            <p>Registered Successfully!</p>
                        </div><br>";
                    echo "<a href='login.php'><button class='button'>Login Now</button></a>";
                } else {
                    echo "<div class='message'>
                            <p>Error occurred. Please try again later!</p>
                        </div><br>";
                    echo "<a href='javascript:self.history.back()'><button class='button'>Go Back</button></a>";
                }
            }
        }
        } else {
        ?>
        <h1>Sign Up</h1>
        <form id="login-form" action="" method="POST">
            <label>Username</label>
            <input type="text" name="username" placeholder="Username" required>
            <label>E-Mail</label>
            <input type="email" name="email" placeholder="E-Mail" required>
            <label>Password</label>
            <input type="password" name="password" placeholder="Password" required>
            <label>Re-Type Password</label>
            <input type="password" name="rpassword" placeholder="Password" required>
            <button type="submit" name="submit">Submit</button>
            <p>Already Signed In? <a href="login.php" class="link">Login</a></p>
        </form>
        <?php } ?>
    </div>
</body>
</html>
