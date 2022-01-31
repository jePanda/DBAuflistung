<?php
include('incl/config.inc.php');
include('incl/helpers.inc.php');
if(isset($_POST['btnAuswahl'])) {
    try {
        $schemaName = $_POST['schema'];
        $dbCon = getDbCon();
        /* returned die Tables des gewählten Schemas */
        $query = 'show tables from ' . $schemaName;

        $stmt = $dbCon->prepare($query);

        $stmt->execute();

        ?>
        <p class="h1">Datenbank auflisten</p>
        <p class="h2">Schema <?php echo $_POST['schema']?></p>
        <table class="table">
        <thead>
        <tr>
            <th scope="col">Tabellen</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>

        <?php
        while ($row = $stmt->fetch(PDO::FETCH_NUM))
        {
            ?>
            <form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); echo "?page=detailTable"; ?>>
                <tr>
                    <!-- listet die einzelnen Tabellen auf -->
                    <td><label for=tables" value="<?php echo $row[0];?>"> <?php echo $row[0]?></label></td>

                    <!--übergibt den table sowie Schemanamen ins post-array -->
                    <td><input type="hidden" name="table" value="<?php echo $row[0] ?>"></td>
                    <td><input type="hidden" name="schemaName" value="<?php echo $schemaName?>"></td>

                    <!-- je nachdem welcher Btn gedrückt wurde wird auf den detailTable weitergeleitet -->
                    <td><input class="btn btn-warning" type="submit" value="Beschreibung" name="btnBeschreibung"</td>
                    <td><input class="btn btn-warning"  type="submit" value="Inhalt" name="btnInhalt"</td>
                </tr>
            </form>
            <?php
        }
            echo '</tbody>';
    }
    catch (PDOException $e) {
            echo '<br><div class="alert alert-danger" role="alert">' . $e->getCode() . ' Message ' . $e->getMessage() .'</div>';
    }
}
else
{?>
    <br><div class="alert alert-danger" role="alert"> Es wurde keine Auswahl getroffen </div>
<?php
}
?>
