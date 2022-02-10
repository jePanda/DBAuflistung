<?php
$query = 'show databases';
$stmt = $con->prepare($query);
$stmt->execute();

$columnCnt=$stmt->columnCount();

?>
<div class="container-fluid">
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
        <th></th>
        <th></th>
        </thead>
        <tbody>
            <tr>
                <?php
                //holt die Werte aus der Zeile
                while($row = $stmt->fetch(PDO::FETCH_OBJ))
                {?>
                    <form method="post" action="?page=showTablesFromSchema">
                        <?php
                    //holt die einzelnen Werte aus der Spalte und speichert sie im nameSchema
                    foreach($row as $col)
                    {?>
                        <td><?php echo $col ?> </td>
                        <td><input class="btn btn-warning" type="submit" value="Details" name="details"></td>
                        <!--nameSchema wird für die Headline uebertragen-->
                        <td><input type="hidden" name="nameSchema" value="<?php echo $col ?>"></td>

                    <?php
                    }
                    echo '</tr></form>';
                }
                ?>
        </tbody>
    </table>
<div class="container-fluid">

