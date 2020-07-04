<?php
$QuestionId = -1;
if(isset($_GET["QuestionId"]) && !empty($_GET["QuestionId"])){
    $QuestionId = $_GET["QuestionId"];
}
$result = array();
require("common.inc.php");
?>
<?php
if(isset($_POST["updated"])){
    $Question = "";
    $Answer = "";
    if(isset($_POST["Question"]) && !empty($_POST["Question"])){
        $Question = $_POST["Question"];
    }
    if(isset($_POST["Answer"]) && !empty($_POST["Answer"])) {
        if (is_string($_POST["Answer"])) {
            $Answer = (string)$_POST["Answer"];
        }
    }
    if(!empty($Question) && !empty($Answer)){
        try{
            $query = NULL;
            echo "[Answer" . $Answer . "]";
            $query = file_get_contents(__DIR__ . "/queries/UPDATE.sql");
            if(isset($query) && !empty($query)) {
                $stmt = getDB()->prepare($query);
                $result = $stmt->execute(array(
                    ":Question" => $Question,
                    ":Answer" => $Answer,
                    ":id" => $QuestionId
                ));
                $e = $stmt->errorInfo();
                if ($e[0] != "00000") {
                    echo var_export($e, true);
                } else {
                    if ($result) {
                        echo "Successfully updated Question: " . $Question;
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
        echo "Name and Answer must not be empty.";
    }
}
?>

<?php
//moved the content down here so it pulls the update from the table without having to refresh the page or redirect
//now my success message appears above the form so I'd have to further restructure my code to get the desired output/layout
if($QuestionId > -1){
    $query = file_get_contents(__DIR__ . "/queries/SelectOne.sql");
    if(isset($query) && !empty($query)) {
        //Note: SQL File contains a "LIMIT 1" although it's not necessary since ID should be unique (i.e., one record)
        try {
            $stmt = getDB()->prepare($query);
            $stmt->execute([":id" => $QuestionId]);
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
    echo "No QuestionId provided in url, don't forget this or sample won't work.";
}
?>
<script src="js/script.js"></script>
<!-- note although <script> tag "can" be self terminating some browsers require the
full closing tag-->
<form method="POST"onsubmit="return validate(this);">
    <label for="Question">Question Name
        <!-- since the last assignment we added a required attribute to the form elements-->
        <input type="text" id="Question" name="Question" value="<?php echo get($result, "Question");?>" required />
    </label>
    <label for="Answer">Answer
        <input type="text" id="Answer" name="Answer" value="<?php echo get($result, "Answer");?>" required min="0"/>
    </label>
    <input type="submit" name="updated" value="Update Question & Answer"/>
</form>