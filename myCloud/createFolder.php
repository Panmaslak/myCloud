<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit(); 
}

$user = $_SESSION["username"];
$folderName = $_POST['pname'];
$path = "users/" . $user . "/" . $folderName;

if (!is_dir($path)) {
    mkdir($path, 0777, true);
    echo "Folder został utworzony pomyślnie.";
} else {
    echo "Folder o podanej nazwie już istnieje.";
}
?>
