<?php
if(isset($_POST['describe']) || isset($_POST['inhalt']))
{
    $nameSchema = $_POST['nameSchema'];
    $table = $_POST['table'];

    if(isset($_POST['describe']))
    {
        //beschreibt die Attribute der Entity
        $query = 'describe ' . $nameSchema . '.' . $table;
    }
    else if(isset($_POST['inhalt']))
    {
        //gibt die Ergebnisse der Tabelle zurück
        $query='select * from ' . $nameSchema. '.'. $table;
    }
    $stmt = $con->prepare($query);
    $stmt->execute();

    $columnCnt = $stmt->columnCount();
    ?>
    <div class="container-fluid">
        <h1 class="display-4">Schema: <?php echo $nameSchema?> </h1>
        <h2>Tabelle: <?php echo $table?> </h2>
        <table class="table">
            <thead class="thead">
            <?php
            for($i=0; $i<$columnCnt; $i++)
            {
                /* holt die Überschriften der Spaltennamen raus */
                $meta[] = $stmt->getColumnMeta($i);
                echo '<th>'.$meta[$i]['name'].'</th>';
            }
            ?>
            </thead>
            <tbody>
                <tr>
                    <?php
                    //holt die Werte aus der Zeile
                    while($row = $stmt->fetch(PDO::FETCH_OBJ))
                    {?> <form method="post" action="?page=describeOrInhalt"> <?php
                        //holt die einzelnen Werte aus der Spalte und speichert sie im nameSchema
                        foreach($row as $col)
                        {?>
                            <td><?php echo $col ?> </td>
                            <?php
                        }
                        echo '</form></tr>';
                    }
                    ?>
            </tbody>
        </table>
    </div>
<?php
}
?>