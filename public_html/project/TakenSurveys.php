<?php
include_once(__DIR__."/partials/header.partial.php");

if(Common::is_logged_in()){
    //this will auto redirect if user isn't logged in
}
//TODO: Note, internally calling them questionnaires (and for admin), user facing they're called surveys.
$response = DBH::get_available_surveys();
$available = [];
if(Common::get($response, "status", 400) == 200){
    $available = Common::get($response, "data", []);
}
?>
<div class="container-fluid">
    <h4>Surveys</h4>
    <div class="list-group">
        <?php foreach($available as $s): ?>
            <div class="list-group-item">
                <?php
                $limit = 2;
                $query = "SELECT count(*) FROM Questionnaires";

                $s = $db->query($query);
                $total_results = $s->fetchColumn();
                $total_pages = ceil($total_results/$limit);
                if (!isset($_GET['page'])) {
                    $page = 1;
                } else{
                    $page = $_GET['page'];
                }
                $starting_limit = ($page-1)*$limit;
                $show  = "SELECT * FROM Questionnaire ORDER BY id DESC LIMIT ?,?";

                $r = $db->prepare($show);
                $r->execute([$starting_limit, $limit]);

                while($available = $s->fetch(PDO::FETCH_ASSOC)):
                    ?>
                    <h4><?php echo $re['id'];?></h4>
                    <p><?php echo $res['nama_kat'];?></p>
                    <hr>
                <?php
                endwhile;
                for ($page=1; $page <= $total_pages ; $page++):?>

                    <a href='<?php echo "?page=$page"; ?>' class="links"><?php  echo $page; ?>
                    </a>

                <?php endfor; ?>

            </div>
        <?php endforeach; ?>
        <?php if(count($available) == 0):?>
            <div class="list-group-item">
                No surveys available, please check back later.
            </div>
        <?php endif; ?>
    </div>
</div>


