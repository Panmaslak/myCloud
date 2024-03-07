<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Zań</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2 class="mt-5">Formularz rejestracji</h2>
        <form method="post" action="addUser.php">
            <div class="form-group">
                <label for="user">Login:</label>
                <input type="text" class="form-control" id="user" name="user" maxlength="20" size="20">
            </div>
            <div class="form-group">
                <label for="pass">Hasło:</label>
                <input type="password" class="form-control" id="pass" name="pass" maxlength="20" size="20">
            </div>
            <div class="form-group">
                <label for="confirm-pass">Powtórz hasło:</label>
                <input type="password" class="form-control" id="confirm-pass" name="confirm-pass" maxlength="20" size="20">
            </div>
            <button type="submit" class="btn btn-primary">Zarejestruj się</button>
        </form>

        <p class="mt-3">Posiadasz już konto? <a href="index.php">Zaloguj się!</a></p>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
