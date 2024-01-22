<!DOCTYPE>
<html>

<head>
    <title>login page</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>

    <?php
    session_start();
    include "./db/dbconfig.php";

    $commonErr = "";

    if (isset($_POST["login"])) {

        $email = $_POST['email'];
        $password = $_POST['password'];
        if (empty($email) || empty($password)) {
            $commonErr = "Enter both email and password..";
        } else {
            $sql = "SELECT * FROM register WHERE email = '$email' AND password = '$password'";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $info = mysqli_fetch_assoc($result);

                if (!empty($info['id'])) {
                    session_start();
                    $_SESSION['userid'] = $info['id'];
                    $_SESSION['username'] = $info['username'];
                    $_SESSION['email'] = $info['email'];
                    
                    header("location:home.php");
                    exit(); // Ensure that no further code is executed after redirection
                } else {
                    $commonErr = "Email and password did not match...";
                }
            } else {
                $commonErr = "Error in the query: " . mysqli_error($conn);
            }
        }
    }
    ?>

    <h4>Login To Your Account</h4>
    <form method="POST" action="">
        Email : <input type="email" name="email" /><br><br>
        Password : <input type="password" name="password" /><br><br>
        <span class="error"><?php echo $commonErr ?></span><br><br>
        <input type="submit" name="login" value="login" />
        <button><a href="register.php">register account</a></button>
    </form>

</body>

</html>