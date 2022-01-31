<?php
include('incl/config.inc.php');
include('incl/helpers.inc.php');
if(isset($_POST['btnBeschreibung']))
{
    /* holt die Einträge aus den Tabellen des gewählten Schemas */
    try{
        $schemaName = $_POST['schemaName'];
        $dbCon = getDbCon();
        $query = 'describe ' .$schemaName. '.' . $_POST['table'];

        $stmt = $dbCon->prepare($query);

        $stmt->execute();

        /* zählt die Anzahl der Spalten */
        $columnCnt = $stmt->columnCount();
        ?>

        <p class="h1">Datenbank auflisten</p>
        <p class="h2">Schema <?php echo $schemaName?></p><br>
        <table class="table table">
        <tbody>

         <?php
        /*zum Darstellen der Tabellen-Attribute */
        for($i=0; $i<$columnCnt; $i++)
        {
            /* holt die Überschriften der Spaltennamen raus */
            $meta[] = $stmt->getColumnMeta($i);
            echo '<th>'.$meta[$i]['name'].'</th>';
        }
    while ($row = $stmt->fetch(PDO::FETCH_NUM))
    {
    ?>
        <tr>
            <!-- Ausgabe der Tabelleninformation -->
            <td><label for=field" value="<?php echo $row[0];?>"> <?php echo $row[0]?></label></td>
            <td><label for=type" value="<?php echo $row[1];?>"> <?php echo $row[1]?></label></td>
            <td><label for=null" value="<?php echo $row[2];?>"> <?php echo $row[2]?></label></td>
            <td><label for=key" value="<?php echo $row[3];?>"> <?php echo $row[3]?></label></td>
            <td><label for=default" value="<?php echo $row[4];?>"> <?php echo $row[4]?></label></td>
            <td><label for=extra" value="<?php echo $row[5];?>"> <?php echo $row[5]?></label></td>
        </tr>
    <?php
    }
    echo '</tbody>';
    }
    catch(Exception $e)
    {
        echo 'ERROR: ' . $e->getCode() . 'Message' . $e->getMessage();
    }

}
elseif(isset($_POST['btnInhalt']))
{
    try{
        $schemaName = $_POST['schemaName'];
        /* auf bestimmtes Schema verbinden */
        $dbCon = getDbConbyName($schemaName);

        /* table-Namen rausholen */
        $tableName = $_POST['table'];

        /* select * from rezept.zutat order by 1 asc */
        $query = 'select * from ' . $schemaName . '.'  . $tableName . ' order by 1 asc';

        $stmt = $dbCon->prepare($query);
        $stmt->execute();
        $columnCnt = $stmt->columnCount();
        ?>
        <p class="h1">Datenbank auflisten</p>
        <p class="h3"> <?php echo $tableName?></p>
        <table class="table table">
        <tbody>

        <?php
        /*zum Darstellen der Tabellen-Attribute */
        for($i=0; $i<$columnCnt; $i++)
        {
            /* holt die Tabellenattribute an der Position "name" raus */
            $meta[] = $stmt->getColumnMeta($i);
            echo '<th>'.$meta[$i]['name'].'</th>';
        }

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            echo '<tr>';
            /* eachRow beinhaltet pro Durchgang einen Datensatz*/
            foreach ($row as $eachRow) {
                echo '<td>' . $eachRow . '</td>';
            }
            echo '</tr>';
        }
        echo '</tbody>';
    }
    catch(Exception $e)
    {
        echo '<br><div class="alert alert-danger" role="alert">ERROR ' . $e->getCode() . ' Message ' . $e->getMessage() .'</div>';
    }

}
else
{
    ?>
    <br><div class="alert alert-danger" role="alert"> Es wurde keine Entität ausgewählt </div>
<?php
}
?>