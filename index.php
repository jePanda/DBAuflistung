<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!-- passt die Breite an das Device an -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Links für Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!--Titel im Tab -->
    <title>Datenbank Auflistung</title>
</head>
<body>
<!--Menüleiste im Bootstrap Design -->
<nav class="navbar navbar-expand-sm bg-info navbar-dark">
    <!--Toggle für Burger-Menü -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <!-- Eintrag im Navigationsbereich -->
            <li class="nav-item">
                <a class="nav-link" href="?page=showDatabases">Information</a></li>
            </li>
        </ul>
    </div>
</nav>

</body>
<main class="container-fluid">
    <?php
    include_once("incl/config.inc.php");
    /* automatisches Seite einbinden, wird Seite nicht gefunden, so wird auf home.php umgeleitet*/
    if(isset($_GET['page']) && (file_exists($_GET['page'] . ".php")))
    {
        include_once($_GET['page'] . ".php");
    }
    else
    {
        include_once("home.php");
    }
    ?>
</main>