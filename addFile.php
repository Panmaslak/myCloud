<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>
</body>
</html>


<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit(); 
}

$user = $_SESSION["username"];
$baseDir = "users/".$user."/";

if(isset($_POST['targetDir'])) {
    $targetDir = $baseDir . $_POST['targetDir'] . "/";
} else {
    $targetDir = $baseDir;
}

$target_file = $targetDir . basename($_FILES["fileToUploadName"]["name"]);

if (move_uploaded_file($_FILES["fileToUploadName"]["tmp_name"], $target_file)) {
 echo "<div class='alert alert-success' role='alert'>Plik " . htmlspecialchars(basename($_FILES['fileToUploadName']['name'])) . " został pomyślnie przesłany.</div>";

} else {
    echo "<div class='alert alert-danger' role='alert'>Wystąpił problem z przesyłaniem pliku.</div>";
}
?>

<a href="index1.php" class="btn btn-primary">Powrót</a>

