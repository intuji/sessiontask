<!DOCTYPE>
<html>

<head>
    <title>Register page</title>

    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <?php
    include_once "./db/dbconfig.php";
    //defining variables and setting them to empty value
    $userNameErr =  $emailErr = $passError = $confirmPassError = $commonErr = "";

    if (isset($_POST['register'])) {
        $id = null;
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirmpassword = $_POST["confirmpassword"];

        if (empty($username) || empty($email) || empty($password) || empty($confirmpassword)) {
            $commonErr =  "Warning!!!All field must be filled.Data is not submitted.</br></br>";
        } 
        elseif (!preg_match("/^[a-zA-Z\s]*$/", $username)) {
            $nameErr = "Warning!!!Only alphabets are allowed.";
        } elseif (strlen($username) < 3 || strlen($username) > 30) {
            $userNameErr = "Warning!!!Name should contain 3-30 characters.";
        } elseif($password != $confirmpassword){
            $passError = "Password didnot matched..";
        }
        else {

            // to check the unique emaill validation
            $checkEmailSql = "SELECT * FROM register WHERE email='$email'";
            $emailResult = mysqli_query($conn,$checkEmailSql);
            if ($emailResult && mysqli_num_rows($emailResult)> 0){
                $emailErr =  "This email is already registered..Use another email..";
            }
            else{

                $sql = "INSERT INTO register VALUES ('$id','$username','$email','$password','$confirmpassword')";
                if (mysqli_query($conn, $sql)) {
                    echo "data inserted successfully.";
                    header('location:login.php');
                } else {
                    echo "OOPS something went wrong.." . mysqli_error($conn);
                    header('location:register.php');

                }
                mysqli_close($conn);
            }

        }
    }
    ?>

    <h4>Register Your Account</h4>
    <form method="post" action="">
        Username : <input type="text" name="username" /><span class="error">*<?php echo $userNameErr ?></span><br><br>
        Email : <input type="email" name="email" /><span class="error">*<?php echo $emailErr ?></span><br><br>
        Password : <input type="password" name="password" /><span class="error">*<?php echo $passError ?></span><br><br>
        Confirmpassword : <input type="password" name="confirmpassword" /><span class="error">*<?php echo $confirmPassError ?></span><br><br>
        <span class="error"><?php echo $commonErr ?></span>

        <button><a href="login.php">GOTO LOGIN</a></button>
        <input type="submit" name="register" value="register now" />
    </form>

</body>

</html>