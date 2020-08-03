<?php
include_once(__DIR__."/partials/header.partial.php");
include "config.inc.php";

if(Common::is_logged_in()){
    //this will auto redirect if user isn't logged in
}
//TODO: Note, internally calling them questionnaires (and for admin), user facing they're called surveys.
$response = DBH::get_not_available_surveys();
$available = [];
if(Common::get($response, "status", 400) == 200){
    $available = Common::get($response, "data", []);
}
$limit = 25;
$page = isset($_GET['page']) ? $_GET['page']:1;
$start= ($page-1)*$limit;
$query = ("Select from Questionnaires LIMIT $start,$limit");
$result = getDB()->prepare($query);
$Questions = $result->fetch(PDO::FETCH_ASSOC);
$total = $QuesCount[0]['id'];
$pages = ceil($total / $limit);
?>
<div class="container-fluid">
    <h4>Surveys</h4>
    <div class="list-group">
        <?php foreach($available as $s): ?>
            <div class="list-group-item">
                <h6><?php echo Common::get($s, "name", ""); ?></h6>
                <p><?php echo Common::get($s, "description", ""); ?></p>
                <?php if(Common::get($s, "use_max", false)): ?>
                    <div>Max Attempts: <?php echo Common::get($s, "max_attempts", 0);?></div>
                <?php else:?>
                    <div>Daily Attempts: <?php echo Common::get($s, "attempts_per_day", 0);?></div>
                <?php endif; ?>
                <a href="survey.php?s=<?php echo Common::get($s, 'id', -1);?>" class="btn btn-secondary">Results</a>

            </div>
        <?php endforeach; ?>
        <?php if(count($available) == 0):?>
            <div class="list-group-item">
                No surveys available, please check back later.
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="row">
    <div class="col-md-10">
        <nav aria-label="Page Navigation">
            <ul class="Pagination">
                <li>
                    <a href="#" aria-label="=Previous">
                        <span aria-hidden="true">&laquo; Previous</span>
                    </a>
                </li>
                <?php for($i -1; $i<= $pages; $i++)?>
                <li> <a href="index.php?page=<?=$i;?>"><?=$i; ?></a></li>
                <li>
                    <a href="#" aria-label="Next">
                        <span aria-hidden="true">NEXT &raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>