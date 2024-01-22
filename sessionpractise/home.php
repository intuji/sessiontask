<!DOCTYPE>
<html>

<head>
    <title>Home Page</title>
</head>

<body>
    <?php
    session_start();
    $_SESSION['username'];
    $_SESSION['email'];
    $_SESSION['userid'];
    include_once "./db/dbconfig.php";

    if (isset($_SESSION['userid'])) {
        echo "<h1> HELLO ! This is Home page...<br></h1>";
        echo " Details of user id No. = " . $_SESSION['userid'] . "<br>";
        echo  "User Name = " . $_SESSION['username'] . "<br>";
        echo " Email Address = " . $_SESSION['email'] . "<br>";
    } else {
        header('location:login.php');
    }
    ?>
    <button><a href='logout.php' style='font-size:18px;'>Logout</a></button>


</body>

</html>