<?php
$search = "";
$Ascending="Ascending";
$Descending="Descending";
if(isset($_POST["search"])){
    $search = $_POST["search"];
}
?>
    <form method="POST">
        <input type="text" name="search" placeholder="Search for question"
               value="<?php echo $search;?>"/>
        <input type="submit" value="Search"/>
        <select id="SORT BY" name="SORT BY"
            <option value="Ascending">Ascending</option>
            <option value="Descending">Descending</option>
        </select>
    </form>
<?php
if(isset($search)){
    require("common.inc.php");
    $query = file_get_contents(__DIR__ . "/queries/SearchTable.sql");
    $Ascending = file_get_contents(__DIR__ . "/queries/AscendingOrder.sql");
    $Descending = file_get_contents(__DIR__ . "/queries/DescendingOrder.sql");
    if (isset($query) && !empty($query) && isset($Ascending) && isset($Descending)) {
        try {
            $stmt = getDB()->prepare($query);
            $stmt = getDB()->prepare($Ascending);
            $stmt = getDB()->prepare($Descending);

            //Note: With a LIKE query, we must pass the % during the mapping
            $stmt->execute([":question"=>$search]);
            //Note the fetchAll(), we need to use it over fetch() if we expect >1 record
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
?>
    <!--This part will introduce us to PHP templating,
    note the structure and the ":" -->
    <!-- note how we must close each check we're doing as well-->
<?php if(isset($results) && count($results) > 0):?>
    <p>This shows when we have results</p>
    <ul>
        <!-- Here we'll loop over all our results and reuse a specific template for each iteration,
        we're also using our helper function to safely return a value based on our key/column name.-->
        <?php foreach($results as $row):?>
            <li>
                <?php echo get($row, "question")?>
                <a href="delete.php?QuestionId=<?php echo get($row, "id");?>">Delete</a>
            </li>
        <?php endforeach;?>
    </ul>
<?php else:?>
    <p>This shows when we don't have results</p>
<?php endif;?>