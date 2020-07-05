<?php
$questionId = -1;
if(isset($_GET["questionId"]) && !empty($_GET["questionId"])){
    $questionId = $_GET["questionId"];

$result = array();
require("common.inc.php");
?>
<?php
if(isset($_POST["updated"])){
    $question = "";
    $answer = "";
    if(isset($_POST["question"]) && !empty($_POST["question"])){
        $question = $_POST["question"];
    }
    if(isset($_POST["answer"]) && !empty($_POST["answer"])) {
        if (is_string($_POST["answer"])) {
            $answer = (string)$_POST["answer"];
        }
    }
    if(!empty($question)){
        try{
            $query = NULL;
            echo "[answer" . $answer . "]";
            $query = "UPDATE Questions set question = :question where id=:id";
            if(isset($query) && !empty($query)) {
                $stmt = getDB()->prepare($query);
                $result = $stmt->execute(array(
                    ":question" => $question,
                    ":id" => $questionId
                ));
                $e = $stmt->errorInfo();
                if ($e[0] != "00000") {
                    echo var_export($e, true);
                } else {
                    if ($result) {
                        echo "Successfully updated question: " . $question;
                    } else {
                        echo "Error updating record";
                    }
                }
            }
            else{
                echo "Failed to find Update.sql file";
            }
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
    }
    if(!empty($answer)){
        try{
            $query = NULL;
            echo "[answer" . $answer . "]";
            $query = "UPDATE Answers set answer = :answer where id=:id";
            if(isset($query) && !empty($query)) {
                $stmt = getDB()->prepare($query);
                $result = $stmt->execute(array(
                    ":answer" => $answer,
                    ":id" => $questionId
                ));
                $e = $stmt->errorInfo();
                if ($e[0] != "00000") {
                    echo var_export($e, true);
                } else {
                    if ($result) {
                        echo "Successfully updated question: " . $answer;
                    } else {
                        echo "Error updating record";
                    }
                }
            }
            else{
                echo "Failed to find Update.sql file";
            }
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
    }

    else{
        echo "Name and answer must not be empty.";
    }
}
}
?>

<?php
//moved the content down here so it pulls the update from the table without having to refresh the page or redirect
//now my success message appears above the form so I'd have to further restructure my code to get the desired output/layout
if($questionId > -1){
    $query = file_get_contents(__DIR__ . "/queries/SelectOne.sql");
    if(isset($query) && !empty($query)) {
        //Note: SQL File contains a "LIMIT 1" although it's not necessary since ID should be unique (i.e., one record)
        try {
            $stmt = getDB()->prepare($query);
            $stmt->execute([":id" => $questionId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
    }
    else{
        echo "Failed to find SelectOne.sql file";
    }
}
else{
    echo "No questionId provided in url, don't forget this or sample won't work.";
}
?>
<script src="js/script.js"></script>
<!-- note although <script> tag "can" be self terminating some browsers require the
full closing tag-->
<form method="POST"onsubmit="return validate(this);">
    <label for="question">question Name
        <!-- since the last assignment we added a required attribute to the form elements-->
        <input type="text" id="question" name="question" value="<?php echo get($result, "question");?>" required />
    </label>
    <label for="answer">answer
        <input type="text" id="answer" name="answer" value="<?php echo get($result, "answer");?>" required min="0"/>
    </label>
    <input type="submit" name="updated" value="Update question & answer"/>
</form>