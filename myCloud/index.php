<?php declare (strict_types=1);
	session_start();

	if(isset($_SESSION["lockTime"])) {
		$difference = time() - $_SESSION["lockTime"];
		if($difference > 60) {
			unset($_SESSION["lockTime"]);
			unset($_SESSION["accountBlocked"]);
		}
	}
	
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>MyCloud</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <p><b>MyCloud</b></p>

        <form method="post" action="verify.php">
            <div class="form-group">
                <label for="userl">Login:</label>
                <input type="text" class="form-control" name="userl" id="userl" maxlength="20" size="20">
            </div>
            <div class="form-group">
                <label for="passl">Hasło:</label>
                <input type="password" class="form-control" name="passl" id="passl" maxlength="20" size="20">
            </div>
            <?php
            if (isset($_SESSION['accountBlocked'])) {
                $timeDiff = 60 - $difference;
                echo "<div class='alert alert-danger'>Zbyt duża ilość błędnych prób logowania. Proszę poczekaj " . $timeDiff . " sekund przed kolejną próbą</div>";
            } else {
            ?>
            <button type="submit" class="btn btn-primary">Zaloguj się</button><br />
            <?php
            }
            ?>

            Nie masz konta? <a href="index3.php">Zarejestruj się</a>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
