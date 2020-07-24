<?php
require("common.inc.php");
$query2 = file_get_contents(__DIR__ . "/queries/UsersTaken.sql");
if(isset($query) && !empty($query) && isset($query2) && !empty($query2)){
    try {
        $stmt = getDB()->prepare($query);
        //we don't need to pass any arguments since we're not filtering the results
        $stmt->execute();
        //Note the fetchAll(), we need to use it over fetch() if we expect >1 record
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = getDB()->prepare($query2);
        //we don't need to pass any arguments since we're not filtering the results
        $stmt->execute();
        //Note the fetchAll(), we need to use it over fetch() if we expect >1 record
        $results2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (Exception $e){
        echo $e->getMessage();
    }
}
?>
    <!--This part will introduce us to PHP templating,
    note the structure and the ":" -->
    <!-- note how we must close each check we're doing as well-->
<?php if(isset($results)):?>
<p>This shows when we have results</p>
<ul>
    <!-- Here we'll loop over all our results and reuse a specific template for each iteration,
    we're also using our helper function to safely return a value based on our key/column name.-->
</ul>
<?php else:?>
    <p>This shows when we don't have results<p>
<?php endif;?>
