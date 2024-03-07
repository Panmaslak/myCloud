<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">

<head>
    <title>Zań</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style type="text/css">
        .tg {
            border-collapse: collapse;
            border-spacing: 0;
        }

        .tg td {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;
        }

        .tg th {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-weight: normal;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;
        }

        .tg .tg-0pky {
            border-color: inherit;
            text-align: left;
            vertical-align: top
        }
    </style>
</head>

<body>

<div class="container mt-3">
    <form method="post" action="addFile.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="fileToUpload">Wybierz plik:</label><br>
            
        
 
            <input type="file" class="form-control-file" id="fileToUpload" name="fileToUploadName" accept="*/*">
            <div id="wyswietlacz"></div>
        </div>
        <input type="submit" class="btn btn-primary" value="Dodaj plik" name="submit">
    </form>

    <?php
    session_start();
    $user = $_SESSION["username"];
    $dbhost = "sql112.epizy.com";
    $dbuser = "epiz_32762504";
    $dbpassword = "Px9R2V2FcqoEV";
    $dbname = "epiz_32762504_myCloud";
    $connection = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
    if (!$connection) {
        echo " MySQL Connection error." . PHP_EOL;
        echo "Errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }

    $resulttt = mysqli_query($connection, "Select ipaddress, time from  break_ins where username = '$user' order by time desc;") or die ("DB error: $dbname");

    $roww = mysqli_fetch_array($resulttt);

    if (isset($_SESSION['communique'])) {
        echo '<span style="color:red">' . $roww['time'] . " Nastąpiła próba logowania na twoje konto z adresu IP " . $roww['ipaddress'] . '</span> <br>';
        unset($_SESSION["communique"]);
    }

    $result = mysqli_query($connection, "Select * from  files where user = '$user' Order by id Desc;") or die ("DB error: $dbname");
    ?>
</div>

    <?php
    $filesInFolder = array();
    $baseDir = "users/$user";
    $currentDir = !empty($_GET['dir']) ? $_GET['dir'] : $baseDir;
    $currentDir = rtrim($currentDir, '/');

    $iterator = new FilesystemIterator($currentDir);



    if ($currentDir != $baseDir) {
        echo "<br><a href='?dir=$baseDir'>Wróć</a><br>";
    }

echo "<a href='logout.php' style='margin-left: 215px; margin-top: 10px;'>Wyloguj się</a><br/>";




    echo "<table class='table'>";
    foreach ($iterator as $entry) {
        $name = $entry->getBasename();
        $filePath = $currentDir . '/' . $name;
        if (is_file($filePath)) {
            echo "<tr>";
            echo "<td>";
            if (in_array(pathinfo($filePath, PATHINFO_EXTENSION), ['gif', 'jpg', 'jpeg', 'png', 'webp'])) {
                echo "<img src='$filePath' style='max-height: 200px; max-width: 200px;'>";
            } else if (in_array(pathinfo($filePath, PATHINFO_EXTENSION), ['mp3', 'mp4'])) {
                echo "<video src='$filePath' style='max-height: 200px; max-width: 200px;' controls></video>";
            } else {
                echo "<i>Brak podglądu</i>";
            }
            echo "</td>";
            echo "<td>$name</td>";
            echo "<td><a href='download.php?file=$filePath'>Pobierz plik</a></td>";
            echo "<td><a href='deleteFile.php?file=$filePath'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
  <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z'/>
  <path d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z'/>
</svg></a></td>";
            echo "</tr>";
        }
    }
    echo "</table>";
    ?>
</div>

</body>

</html>
