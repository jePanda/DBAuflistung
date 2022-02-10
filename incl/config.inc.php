<?php
$con = getDBCon();

function getDBCon()
{
    //Verbindung zur Datenbank aufbauen und bei Fail eine ErrorMessage ausgeben
    try {
        $host = 'localhost';
        $user = 'root';
        $pw = '';
        $dbName = 'information_schema';

        $con = new PDO('mysql:host=' . $host . ';dbname=' . $dbName . '', $user, $pw);

        // echo 'verbunden';
        return $con;

    } catch (PDOException $e) {
        echo "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
}
?>