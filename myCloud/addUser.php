<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <title>Zań</title>
</head>

<body>
<div class="container">

    <?php
    $user = $_POST['user']; // login z formularza
    $user = htmlentities($user, ENT_QUOTES, "UTF-8"); // rozbrojenie potencjalnej bomby w zmiennej $user
    $pass = $_POST['pass']; // hasło z formularza
    $pass = htmlentities($pass, ENT_QUOTES, "UTF-8"); // rozbrojenie potencjalnej bomby w zmiennej $pass
    $confirmedPass = $_POST['confirm-pass']; // potwierdzenie hasła z formularza
    $confirmedPass = htmlentities($confirmedPass, ENT_QUOTES, "UTF-8"); // rozbrojenie potencjalnej bomby w zmiennej $confirmedPass

    $link = mysqli_connect("sql112.epizy.com", "epiz_32762504", "Px9R2V2FcqoEV", "epiz_32762504_myCloud"); // połączenie z BD
    if (!$link) {
        echo "Błąd: " . mysqli_connect_errno() . " " . mysqli_connect_error();
    } // obsługa błędu połączenia z BD

    mysqli_query($link, "SET NAMES 'utf8'"); // ustawienie polskich znaków
    $result = mysqli_query($link, "SELECT * FROM users WHERE username='$user'"); 
    $rekord = mysqli_fetch_array($result); 

    if (!$rekord) 
    {
        if (preg_match("#^[a-zA-Z0-9]+$#", $user)) {
            if ($confirmedPass == $pass) {
                $querry = "INSERT INTO users (username, password) VALUES ('$user', '$pass')";
                if ($link->query($querry)) {
                    echo "<div class='alert alert-success' role='alert'>Rejestracja zakończona pomyślnie!</div>";

                } else {
                    echo "<div class='alert alert-danger' role='alert'>Błąd: " . $querry . "<br>" . $link->error . "</div>";
                }
            } else
                echo "<div class='alert alert-warning' role='alert'>Hasła muszą być takie same</div>";

        } else {
            echo "<div class='alert alert-danger' role='alert'>Nazwa użytkownika może zawierać tylko litery i cyfry</div>";
        }

    } else { // jeśli $rekord istnieje
        echo "<div class='alert alert-warning' role='alert'>Użytkownik o podanym loginie już istnieje!</div>";
    }

    mkdir("users/$user");
    ?>

    <a href="index3.php" class="btn btn-primary">Powrót</a>

</div>

</body>

</html>
