<?php
require("includes/config.php");
$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
$db = new PDO($connection_string, $dbuser, $dbpass);
$QuestionnaireId = -1;
$result = array();
function get($arr, $key){
    if(isset($arr[$key])){
        return $arr[$key];
    }
    return "";
}
if(isset($_GET["QuestionnaireId"])){
    $QuestionnaireId = $_GET["QuestionId"];
    $stmt = $db->prepare("SELECT * FROM Questionnaires where id = :id");
    $stmt->execute([":id"=>$QuestionnaireId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if(!$result){
        $QuestionnaireId = -1;
    }
}
else{
    echo "No QuestionnaireId provided in url, don't forget this or sample won't work.";
}
?>

    <form method="POST">
        <label for="Questionnaire">Questionnaire Name
            <input type="text" id="Questionnaire" name="Questionnaire" value="<?php echo get($result, "Questionnaire");?>" />
        </label>
        <label for ="description">description
               <input type = "text" id = "description" name = "description" value = "<?php echo get($result, "Questionnaire");?>"
        </label>
        <?php if($QuestionnaireId > 0):?>
            <input type="submit" name="updated" value="Update Questionnaire"/>
            <input type="submit" name="delete" value="Delete Questionnaire"/>
        <?php elseif ($QuestionnaireId < 0):?>
            <input type="submit" name="created" value="Create Questionnaire"/>
        <?php endif;?>
    </form>

<?php
if(isset($_POST["updated"]) || isset($_POST["created"]) || isset($_POST["delete"])){
    $delete = isset($_POST["delete"]);
    $Questionnaire = $_POST["Questionnaire"];
    $description = $_POST["description"];
    if(!empty($Questionnaire) && !empty($description)){
        try{
            if($QuestionnaireId > 0) {
                if($delete){
                    $stmt = $db->prepare("DELETE from Questionnaires where id=:id");
                    $result = $stmt->execute(array(
                        ":id" => $QuestionnaireId,
                    ));
                }
                else {
                    $stmt = $db->prepare("UPDATE Questionnaires set Questionnaire = :Questionnaire where id=:id");
                    $result = $stmt->execute(array(
                        ":Questionnaire" => $Questionnaire,
                        ":description" => $description,
                        ":id" => $QuestionnaireId
                    ));
                }
            }
            else{
                $stmt = $db->prepare("INSERT INTO Questionnaires (Questionnaire) VALUES (:Questionnaire)");
                $result = $stmt->execute(array(
                    ":Questionnaire" => $Questionnaire,
                    ":description" => $description
                ));
            }
            $e = $stmt->errorInfo();
            if($e[0] != "00000"){
                echo var_export($e, true);
            }
            else{
                echo var_export($result, true);
                if ($result){
                    echo "Successfully interacted with Questionnaire: " . $Questionnaire;
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
        echo "Questionnaire & description must not be empty.";
    }
}
?>