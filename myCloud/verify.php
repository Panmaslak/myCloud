<html>
<HEAD>
<title>Zań</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</HEAD>
<BODY>
<?php
//session_start();
$date = date("Y-m-d");
$time = date("h:i:sa");
$user = $_POST['userl']; // login z formularza
$user = htmlentities ($user, ENT_QUOTES, "UTF-8"); // rozbrojenie potencjalnej bomby w zmiennej $user
$pass = $_POST['passl']; // hasło z formularza
$pass = htmlentities ($pass, ENT_QUOTES, "UTF-8"); // rozbrojenie potencjalnej bomby w zmiennej $pass
$confirmedPass = $_POST['confirm-pass']; // potwierdzenie hasła z formularza
$confirmedPass = htmlentities ($confirmedPass, ENT_QUOTES, "UTF-8"); // rozbrojenie potencjalnej bomby w zmiennej $confirmedPass
$counter = 0;
$dbhost="sql112.epizy.com";
$dbuser="epiz_32762504";
$dbpassword="Px9R2V2FcqoEV";
$dbname="epiz_32762504_myCloud";
$ipaddress = getenv("REMOTE_ADDR");
$connection = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
if (!$connection)
{
    echo " MySQL Connection error." . PHP_EOL;
    echo "Errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
mysqli_query($connection, "SET NAMES 'utf8'"); // ustawienie polskich znaków
$result = mysqli_query($connection, "SELECT * FROM users WHERE username='$user'"); // wiersza, w którym login=login z formularza
$rekord = mysqli_fetch_array($result); // wiersza z BD, struktura zmiennej jak w BD
if(!$rekord) //Jeśli brak, to nie ma użytkownika o podanym loginie
{
    mysqli_close($connection); // zamknięcie połączenia z BD
    header('Location: index.php');
}
else if($rekord['password']==$pass) // czy hasło zgadza się z BD
{ // jeśli $rekord istnieje
    session_start();
    $_SESSION ['loggedin'] = true;
    $_SESSION ['username'] = $user;


    $query = "INSERT INTO goscieportalu (username, correctlogin, incorrectlogin, loginerrors)
            VALUES ('$user', '$date $time', '0000-00-00 00:00:00', '0')";

    mysqli_query($connection, $query);
    mysqli_close($connection);

    header('Location: index1.php');
}
else
{
    session_start();
    $_SESSION ['loggedin'] = false;
    $_SESSION ['username'] = $user;

    $result_gościeportalu = mysqli_query($connection, "SELECT * FROM goscieportalu WHERE username = '$user' ORDER BY id DESC LIMIT 1");

    $rekord_gościeportalu = mysqli_fetch_array($result_gościeportalu);

    $query = "INSERT INTO goscieportalu (username, correctlogin, incorrectlogin, loginerrors)
            VALUES ('$user', '0000-00-00 00:00:00', '$date $time', '0')";
    $counter = $rekord_gościeportalu['loginerrors'];      

    if ($counter < 3)
    {
        $counter++;
        $query = "INSERT INTO goscieportalu (username, correctlogin, incorrectlogin, loginerrors)
        VALUES ('$user', '0000-00-00 00:00:00', '$date $time', '$counter')";
    }
    else
    {
        $_SESSION['accountBlocked'] = true;
        $_SESSION['lockTime'] = time();
        $_SESSION['communique'] = true;
        $counter = 0;

        $query = "INSERT INTO goscieportalu (username, correctlogin, incorrectlogin, loginerrors)
        VALUES ('$user', '0000-00-00 00:00:00', '$date $time', '$counter')";

        $query = "INSERT INTO break_ins (username, ipaddress)
        VALUES ('$user', '$ipaddress')";


    }       
   
     

    mysqli_query($connection, $query);
    mysqli_close($connection);

    header('Location: index1.php');

    
    
    mysqli_close($connection);
    header('Location: index.php');
}


?>
</BODY>
</HTML>