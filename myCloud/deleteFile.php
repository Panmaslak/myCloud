<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>
</body>
</html>

<?php
$file = $_GET['file'];

if (unlink($file)) {
    echo "<div class='alert alert-success' role='alert'>Plik został usunięty pomyślnie.</div>";
} else {
    echo "<div class='alert alert-danger' role='alert'>Wystąpił problem z usuwaniem pliku.</div>";
}
?>
<a href="index1.php" class="btn btn-primary">Powrót</a>
