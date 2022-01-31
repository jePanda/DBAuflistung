<?php
function getDbConbyName($dbName)
{
    try {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = strval($dbName);

        $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);  

        return $conn;
    }
    catch (PDOException $e)
    {
        echo '<br><div class="alert alert-danger" role="alert">' . $e->getCode() . ' Message ' . $e->getMessage() .'</div>';
    }
}

function getDbCon()
{
    try {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "information_schema";

        $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        return $conn;
    }
    catch (PDOException $e)
    {
        echo '<br><div class="alert alert-danger" role="alert">' . $e->getCode() . ' Message ' . $e->getMessage() .'</div>';
    }
}
?>