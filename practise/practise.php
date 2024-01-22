<?php
session_start();
//implementing the $GLOBALS variables
$x = 24;
$y = 2;
function multiply()
{
    $GLOBALS['z'] = $GLOBALS['x'] * $GLOBALS['y'];
}
multiply();
echo "Multiplied value of " . $x . "*" . $y . "=" . $z;


$GLOBALS['a'] = 50;
$GLOBALS['b'] = 20;
function add()
{
    $GLOBALS['c'] = $GLOBALS['a'] + $GLOBALS['b'];
}
add();
echo "</br> Addition value of " . $a . "+" . $b . "=" . $c;


// implementing the $_SERVER global varible
echo " </br></br> Name of the Server is " . "<b>{$_SERVER['SERVER_NAME']}</b>";
echo " </br> Filename  of the Script is  " . "<b>{$_SERVER['PHP_SELF']}</b>";
echo " </br> IP address of the server " . "<b>{$_SERVER['SERVER_ADDR']}</b>";
echo " </br> Directory of the current filename " . "<b>{$_SERVER['SCRIPT_NAME']}</b>";
// echo " </br> URL of the current page" . "<b>{$_SERVER['SCRIPT_URI']}</b>";
echo " </br> PORT no. of the server is in " . "<b>{$_SERVER['SERVER_PORT']}</b>";
?>


<!DOCTYPE html>
<html>

<!-- implementing the request method  -->

<body>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        NAME: <input type="text" name="fname">
        <button type="submit">SUBMIT</button>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = isset($_REQUEST['fname']) ? $_REQUEST['fname'] : null;
        if (empty($_REQUEST['fname'])) {
            echo "Name is empty";
        } else {
            echo $_REQUEST['fname'];
        }
    }
    ?>

    <!-- implementing the $_FILES variables  -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
        <input type="file" name="file">
        <input type="submit" value="submit">
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fileinfo = $_FILES['file'];
        if ($fileinfo['error'] == UPLOAD_ERR_NO_FILE) {
            echo "No file uploaded..<br>";
        } else {
            echo "Filename: " . $_FILES['file']['name'] . "<br>";
            echo "Type : " . $_FILES['file']['type'] . "<br>";
            echo "Size : " . $_FILES['file']['size'] . "<br>";
            echo "Temp name: " . $_FILES['file']['tmp_name'] . "<br>";
            echo "Error : " . $_FILES['file']['error'] . "<br>";
        }
    }
    ?>

    <!-- implementing $_ENV global variables -->
    <?php
    putenv("USER=vim vai");
    echo 'The username is: ' . getenv("USER") . '</br></br>';
    ?>

    <!-- implementing the $_COOKIE -->
    <?php
    $cookie_name = "user";
    $cookie_value = "bhim pd lamichhane";
    setcookie($cookie_name, $cookie_value, time() + 86400);
    if (!isset($_COOKIE[$cookie_name])) {
        echo "Cookie named '" . $cookie_name . "' is not set!";
    } else {
        echo "Cookie '" . $cookie_name . "' is set!<br>";
        echo "Value is: " . $_COOKIE[$cookie_name];
    }
    ?>

    <!-- implementing the $_SESSION -->
    <?php
    $_SESSION["fav_player"] = "virat kohli";
    $_SESSION["fav_series"] = "Breaking Bad";
    echo "<br><br>The session variables are set...<br>"
    ?>

    <!-- implementing the error handling using try catch method-->
    <?php
    function divide($numerator, $denominator)
    {
        try {
            if ($denominator == 0) {
                throw new Exception("Division by zero is not allowed.");
            } else if ($denominator < 0) {
                throw new Exception("Division by negative number is not allowed.");
            }
            $result = $numerator / $denominator;
            return $result;
        } catch (Exception $e) {
            echo "Caught exception: " . $e->getMessage() . "<br>";
            return null;
        } finally {
            echo "Finally block executed.<br>";
        }
    }
    $result1 = divide(10, 2);
    echo "Result 1 = $result1<br>";

    $result2 = divide(5, 0);
    echo "Result 2: $result2<br>";

    $result3 = divide(10, -5);
    echo "Result 3 : $result3<br>";
    ?>

    <!-- passing by value -->
    <?php
    function addition($n1, $n2)
    {
        $n1 = 50;
        $sum = $n1 + $n2;
        echo " Sum of the value = " . $sum . "<br>";
    }
    $num1 = 10;
    $num2 = 20;
    addition($num1, $num2);
    echo "pass by value doesnot changes outside the function = " . $num1 . "<br>";

    // passing by reference
    function subtraction(&$n1, &$n2)
    {
        $n1 = 100;
        $sub = $n1 - $n2;
        echo "subtraction = " .  $sub . "<br>";
    }

    $number1 = 20;
    $number2 = 5;
    subtraction($number1, $number2);
    echo "pass by reference value changes outside the function = " . $number1 . "<br>";

    // example of variable function/anonomous function with exception handling.....
    $percent = function ($math, $sci, $com) {
        try {
            if (func_num_args() <> 3) {
                throw new InvalidArgumentException("Invalid number of arguments. Expected 3 arguments.");
            }
            if (!is_numeric($math) || !is_numeric($sci) || !is_numeric($com)) {
                throw new InvalidArgumentException("Arguments must be numeric values only");
            }
            if ($math > 100 || $sci > 100 || $com > 100) {
                throw new ErrorException("Each marks should be less than 100");
            }
            $total = $math + $sci + $com;
            echo "<br> Total marks obtained  = " . $total;
            $per = $total / 3;
            echo "<br> Percentage you get = " . $per;
        } catch (ArgumentCountError $argumentError) {
            echo "<br> Exception Error: " . $argumentError->getMessage();
        } catch (\Throwable $error) {
            echo "<br> Exception Error: " . $error->getMessage();
        }
    };
    $percent(100, 55, 20);

    // practising the try catch Exception handling with recursive function...
    function factorial($n)
    {
        try {
            if ($n < 0) {
                throw new Exception("no factorial value for less than zero(0)");
            }
            if ($n == 0) {
                return 1;
            }
            return $n * factorial($n - 1);
        } catch (\Throwable $error) {
            echo "<br> Exception : " . $error->getMessage();
        }
    }
    $fact_value = factorial(5);
    echo "<br> the factorial value is " . $fact_value . "<br><br>";

    // implmenting the arrays..
    $players = array("warner", "rohit", "virat", "abd", "maxi", "msd", "jaddu", "patcumins", "stark", "rashid", "bumrah");
    print_r($players);

    // associative array with foreach demo
    $age = [
        "jeevan" => 35,
        "loks" => 31,
        "govin" => 29,
        "vim" => 26,

    ];
    foreach ($age as $key => $value) {
        echo $key . " = " . $value . " <br>";
    };

    //multidimension array demo
    echo "<br><br> Multidimension array <br><br>";
    $emp = [
        [0, "lax", "manager", 50000],
        [1, "bikky", "supervisor", 40000],
        [2, "tities", "salesman", 30000],
        [3, "ganni vai", "accountant", 20000],

    ];
    echo "<table border='2px' cellspacing='0' cellpadding='5'>";

    echo "<tr>";

    echo "<th> Emp ID. </th>";
    echo "<th> Name </th>";
    echo "<th> Designation </th>";
    echo "<th> Salary </th>";

    echo "</tr>";
    foreach ($emp as $v1) {
        echo "<tr>";
        foreach ($v1 as $v2) {
            echo "<td>$v2 </td>";
        }
        echo "</tr>";
    }

    echo "</table>";

    // multidimension associative array with foreach looping statement
    echo "<br> multidimension associative arrays <br>";
    $sunwal = [
        "ward7" => ["name" => "mishrauli", "population" => 1500, "occupation" => "teachers"],
        "ward5" => ["name" => "jargha", "population" => 2500, "occupation" => "business"],
        "ward6" => ["name" => "baluwa", "population" => 1000, "occupation" => "fishing"],
        "ward12" => ["name" => "bhumahi", "population" => 5000, "occupation" => "industires and business"]

    ];

    echo "<table border = '1' cellpadding='10'>";

    echo "<tr>";
    echo "<th>  Ward No. </th>";
    echo "<th> Village Name  </th>";
    echo "<th>  Population </th>";
    echo "<th> Occupation  </th>";

    echo "</tr>";
    foreach ($sunwal as $key => $value1) {
        echo "<tr>";
        echo "<td>";
        echo "$key";
        echo "</td>";
        foreach ($value1 as $key => $value2) {
            echo "<td> $value2 </td>";
        }
        echo "</tr>";
    }
    echo "</table>";


    // multidimension array with foreach and list 
    echo "<br> multidimension associative arrays using list()";
    $students = [
        [1, "sanj", "badera", 90, 80, 75, 80],
        [2, "kandel vai", "basa", 95, 75, 70, 70],
        [3, "vim vai", "mishrauli", 88, 80, 65, 80],
        [4, "chaudhary vai", "bhataudi", 85, 70, 60, 75]
    ];
    echo "<table border ='2' cellpadding ='8'>";
    echo "<tr>";
    echo "<th>  ID </th>";
    echo "<th> Name  </th>";
    echo "<th>  Address </th>";
    echo "<th> Math  </th>";
    echo "<th> Science  </th>";
    echo "<th>  Nepali </th>";
    echo "<th> Computer  </th>";
    echo "</tr>";
    foreach ($students as list($id, $name, $address, $math, $sci, $nep, $com)) {
        echo "<br><tr> <td>$id</td> <td>$name</td> <td>$address</td> <td>$math</td> <td>$sci</td> <td>$nep</td> <td>$com</td> </tr>";
    }
    echo "</table>"

    ?>
</body>

</html>