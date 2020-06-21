<?php
require("config.php");
$connection_string = "mysql:host=$dbhost;dbquestion=$dbdatabase;charset=utf8mb4";
$db = new PDO($connection_string, $dbuser, $dbpass);
$thingId = -1;
$result = array();
function get($arr, $key){
    if(isset($arr[$key])){
        return $arr[$key];
    }
    return "";
}
if(isset($_GET["thingId"])){
    $thingId = $_GET["thingId"];
    $stmt = $db->prepare("SELECT * FROM Things where id = :id");
    $stmt->execute([":id"=>$thingId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
}
else{
    echo "No thingId provided in url, don't forget this or sample won't work.";
}
?>

<form method="POST">
    <label for="Survey">Question Name
        <input type="text" id="Question" question="question" />
    </label>
    <label for="A"> Answer
        <input type="Text" id="A" question="Answer" />
    </label>
    <input type="submit" question="created" value="Create Survey"/>
</form>

<?php
if(isset($_POST["updated"])){
    $question = $_POST["question"];
    $Answer= $_POST["Answer"];
    if(!empty($question) && !empty($Answer)){
        try{
            $stmt = $db->prepare("UPDATE Questions set question = :question, Answer=:Answer where id=:id");
            $result = $stmt->execute(array(
                ":question" => $question,
                ":Answer" => $Answer,
                ":id" => $thingId
            ));
            $e = $stmt->errorInfo();
            if($e[0] != "00000"){
                echo var_export($e, true);
            }
            else{
                echo var_export($result, true);
                if ($result){
                    echo "Successfully updated thing: " . $question;
                }
                else{
                    echo "Error updating record";
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