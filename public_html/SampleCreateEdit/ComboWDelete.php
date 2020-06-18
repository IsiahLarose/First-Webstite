<?php
require("config.php");
$connection_string = "mysql:host=$dbhost;dbQuestion=$dbdatabase;charset=utf8mb4";
$db = new PDO($connection_string, $dbuser, $dbpass);
$QuestionId = -1;
$result = array();
function get($arr, $key){
    if(isset($arr[$key])){
        return $arr[$key];
    }
    return "";
}
if(isset($_GET["QuestionId"])){
    $QuestionId = $_GET["QuestionId"];
    $stmt = $db->prepare("SELECT * FROM Survey where id = :id");
    $stmt->execute([":id"=>$QuestionId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if(!$result){
        $QuestionId = -1;
    }
}
else{
    echo "No QuestionId provided in url, don't forget this or sample won't work.";
}
?>

    <form method="POST">
        <label for="Question">Survey Name
            <input type="text" id="Question" Question="Question" value="<?php echo get($result, "Question");?>" />
        </label>
        <label for="A">Answer
            <input type="number" id="A" Question="Answer" value="<?php echo get($result, "Answer");?>" />
        </label>
        <?php if($QuestionId > 0):?>
            <input type="submit" Question="updated" value="Update Survey"/>
            <input type="submit" Question="delete" value="Delete Survey"/>
        <?php elseif ($QuestionId < 0):?>
            <input type="submit" Question="created" value="Create Survey"/>
        <?php endif;?>
    </form>

<?php
if(isset($_POST["updated"]) || isset($_POST["created"]) || isset($_POST["delete"])){
    $delete = isset($_POST["delete"]);
    $Question = $_POST["Question"];
    $Answer = $_POST["Answer"];
    if(!empty($Question) && !empty($Answer)){
        try{
            if($QuestionId > 0) {
                if($delete){
                    $stmt = $db->prepare("DELETE from Survey where id=:id");
                    $result = $stmt->execute(array(
                        ":id" => $QuestionId
                    ));
                }
                else {
                    $stmt = $db->prepare("UPDATE Survey set Question = :Question, Answer=:Answer where id=:id");
                    $result = $stmt->execute(array(
                        ":Question" => $Question,
                        ":Answer" => $Answer,
                        ":id" => $QuestionId
                    ));
                }
            }
            else{
                $stmt = $db->prepare("INSERT INTO Survey (Question, Answer) VALUES (:Question, :Answer)");
                $result = $stmt->execute(array(
                    ":Question" => $Question,
                    ":Answer" => $Answer
                ));
            }
            $e = $stmt->errorInfo();
            if($e[0] != "00000"){
                echo var_export($e, true);
            }
            else{
                echo var_export($result, true);
                if ($result){
                    echo "Successfully interacted with Question: " . $Question;
                }
                else{
                    echo "Error interacting record";
                }
            }
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
    }
    else{
        echo "Name and Answer must not be empty.";
    }
}
?>