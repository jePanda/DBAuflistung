<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<title>Datenbank Auflistung</title>
</head>
<body>
<!--Menüleiste -->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <a class="navbar-brand" href="#"><i class="fas fa-pencil-alt"></i></a>
    <!--Toggle für Burger-Menü -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
<div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
        <!-- Eintrag im Navigationsbereich -->
        <li class="nav-item">
            <a class="nav-link" href="?page=auflistung">Auflistung</a></li>
        </li>
    </ul>
</div>
</nav>

</body>
<main class="container-fluid">
<?php
/* automatisches Seite einbinden */
if(isset($_GET['page']) && (file_exists($_GET['page'] . ".php")))
{
    include_once($_GET['page'] . ".php");
}
else
{
    include_once("output.php");
}
?>
</main>
