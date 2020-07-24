<?php
include_once(__DIR__."/partials/header.partial.php");

if(Common::is_logged_in()){
    //this will auto redirect if user isn't logged in
}
//TODO: Note, internally calling them questionnaires (and for admin), user facing they're called surveys.
$response = DBH::get_not_available_surveys();
$available = [];
if(Common::get($response, "status", 400) == 200){
    $available = Common::get($response, "data", []);
}
?>
<div class="container-fluid">
    <h4>Surveys</h4>
    <div class="list-group">
        <?php foreach($available  as $s): ?>
            <div class="list-group-item">
                <h6><?php echo Common::get($s, "name", ""); ?></h6>
                <p><?php echo Common::get($s, "description", ""); ?></p>
                <?php if(Common::get($s, "use_max", false)): ?>
                    <div>Max Attempts: <?php echo Common::get($s, "max_attempts", 0);?></div>
                <?php else:?>
                    <div>Daily Attempts: <?php echo Common::get($s, "attempts_per_day", 0);?></div>
                <?php endif; ?>

                <?php
                if($available) {
                    require("config.php");
                    $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
                    try {
                        $db = new PDO($connection_string, $dbuser, $dbpass);
                        $stmt = $db->prepare("Select sum(user_id) FROM Questionnaires");
                        $result = $stmt->execute();
                    }
                    catch (Exception $e){
                        echo $e->getMessage();
                    }
                    if($e[0] != "00000"){
                        echo var_export($e, true);
                    }
                    }
                ?>
                <a>Users Participated</a>
            </div>
        <?php endforeach; ?>
        <?php if(count($available) == 0):?>
            <div class="list-group-item">
                No surveys available, please check back later.
            </div>
        <?php endif; ?>
    </div>
</div>