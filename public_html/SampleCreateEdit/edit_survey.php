<?php
require("config.php");
$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
$db = new PDO($connection_string, $dbuser, $dbpass);
$questionId = -1;
$result = array();
function get($arr, $key){
    if(isset($arr[$key])){
        return $arr[$key];
    }
    return "";
}
if(isset($_GET["questionId"])){
    $questionId = $_GET["questionId"];
    $stmt = $db->prepare("SELECT * FROM Questions where id = :id");
    $stmt->execute([":id"=>$questionId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
}
else{
    echo "No questionId provided in url.";
}
?>

<form method="POST">
    <label for="Question">Question
        <input type="text" id="Question" name="Question" value="<?php echo get($result, "Question");?>" />
    </label>
        <input type="submit" name="updated" value="Update Question"/>
</form>

<?php
if(isset($_POST["updated"])){
    $question = $_POST["question"];
    if(!empty($Question)){
        try{
            $stmt = $db->prepare("UPDATE Questions set question = :question where id=:id");
            $result = $stmt->execute(array(
                ":question" => $question,
                ":id" => $questionId
            ));
            $e = $stmt->errorInfo();
            if($e[0] != "00000"){
                echo var_export($e, true);
            }
            else{
                echo var_export($result, true);
                if ($result){
                    echo "Successfully updated Question: " . $question;
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
        echo "Question must not be empty.";
    }
}
?>