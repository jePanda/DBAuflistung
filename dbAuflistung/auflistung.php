<?php
/* config + helper für die Datenbankverbindung und Funktionen einbinden */
include('incl/config.inc.php');
include('incl/helpers.inc.php');
try {
    $dbCon = getDbCon();
    $query = 'select schema_name as "nameSchema" from information_schema.schemata';
    $stmt = $dbCon->prepare($query);
    $stmt->execute();
    ?>
    <h1>Datenbank auflisten</h1>
    <table class="table table">
    <tr>
        <th scope="col">Schema-Name</th>
        <th scope="col"></th>
        <th scope="col"></th>
    </tr>
    <tbody>

    <?php
    /* holt alle Einträge aus dem DB-Entity raus */
    while($row = $stmt->fetch(PDO::FETCH_OBJ))
    {
    ?>
        <!-- htmlspecialchar - um injections zu vermeiden!
         Weiterleitung auf page detailschema, nachdem btnAuswahl gedrückt wurde -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); echo "?page=detailSchema"; ?>">
        <tr>
            <!--Label für die Anzeige des Schema-Namens -->
            <td><label for=schema" value="<?php echo $row->nameSchema?>"><?php echo $row->nameSchema?></label></td>

            <!--über das hidden-Feld übergeben wir den Schema Namen ins Post-array mit -->
            <td><input type="hidden" name="schema" value="<?php echo $row->nameSchema?>"></td>

            <!-- wenn btnAuswahl gedrückt wurde, erscheint im Postarr['btnAuswahl']=>Auswahl -->
            <td><input class="btn btn-success" type="submit" value="Auswahl" name="btnAuswahl"</td>
        </tr>
        </form>
    <?php
    }
    echo '</tbody>';
}
catch(PDOException $e)
{
    echo '<div class="alert alert-danger" role="alert">' . $e->getCode() . ' Message ' . $e->getMessage() .'</div>';
}


?>