<?php
if(isset($_POST['details']) && !empty($_POST['nameSchema']))
{
    $nameSchema = $_POST['nameSchema'];

    //select für alle Table eines Schemas
    $selQuery = 'show tables from ' . $nameSchema;
    $stmt = $con->prepare($selQuery);
    $stmt->execute();

    $columnCnt=$stmt->columnCount();
}
else
{?>
    <div class="alert alert-light" role="alert">
        <?php 'keine Variable gesetzt.' ?>
    </div>
    <?php
}
?>

<div class="container-fluid">
    <h1 class="display-4">Schema: <?php echo $nameSchema?></h1>
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
            <th></th>
            <th></th>
        </thead>
        <tbody>
            <tr>
                <?php
                //holt die Werte aus der Zeile
                while($row = $stmt->fetch(PDO::FETCH_OBJ))
                {?>
                <!-- jede Zeile bekommt eine eigene Form um die richtigen Daten im Post-array abzuspeichern-->
                <form method="post" action="?page=describeOrInhalt">
                    <?php
                    //holt die einzelnen Werte aus der Spalte und speichert sie im nameSchema
                    foreach($row as $col)
                    {?>
                        <td><?php echo $col ?> </td>
                        <td><input class="btn btn-warning" type="submit" value="Describe" name="describe"></td>
                        <td><input class="btn btn-warning"  type="submit" value="Inhalt" name="inhalt"></td>
                        <td><input type="hidden" name="table" value="<?php echo $col ?>"></td>
                        <td><input type="hidden" value="<?php echo $nameSchema?>" name="nameSchema"></td>
                        <?php
                    }?>
                    </form>
            </tr>
                <?php
                }
                ?>
            </form>
        </tbody>
    </table>
</div>

