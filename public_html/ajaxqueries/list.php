<?php
require("common.inc.php");
if(isset($query) && !empty($query)){
    require("config.php");
    $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
    try {
        $stmt = getDB()->prepare("Select * FROM Questionnaires");
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (Exception $e){
        echo $e->getMessage();
    }
}
?>
<?php if(isset($results)):?>
    <p>This shows when we have results</p>
    <ul>
        <!-- Here we'll loop over all our results and reuse a specific template for each iteration,
        we're also using our helper function to safely return a value based on our key/column name.-->
            <li>
                <?php echo get($results, "name");?>
                <?php echo get($results, "user_id");?>
            </li>
    </ul>
<?php else:?>
    <p>This shows when we don't have results</p>
<?php endif;?>
