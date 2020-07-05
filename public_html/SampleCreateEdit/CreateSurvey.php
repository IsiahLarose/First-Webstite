<script src="js/script.js"></script>
<!-- note although <script> tag "can" be self terminating some browsers require the
full closing tag-->
<form method="POST" onsubmit="return validate(this);">
    <label for="thing">Question Name
        <input type="text" id="thing" name="Question" required />
    </label>
    <label for="q">Answer
        <input type="text" id="Answer" name="Answer" required min="0" />
    </label>
    <input type="submit" name="created" value="Create Question"/>
</form>
<?php
if(isset($_POST["created"])) {
    $Question = "";
    $Answer = "";
    if(isset($_POST["Question"]) && !empty($_POST["Question"])){
        $Question = $_POST["Question"];
    }
    if(isset($_POST["$Answer"]) && !empty($_POST["$Answer"])){
        if(is_string($_POST["$Answer"])){
            $$Answer = (string)$_POST["$Answer"];
        }
    }
    //If Question or $Answer is invalid, don't do the DB part
    if(empty($Question) || $Answer ){
        echo "Name or Answer can't be empty";
        die();//terminates the rest of the script
    }
    try {
        require("common.inc.php");
        $query = file_get_contents(__DIR__ . "/queries/InsertInto.sql");
        if(isset($query) && !empty($query)) {
            $stmt = getDB()->prepare($query);
            $result = $stmt->execute(array(
                ":Question" => $Question,
                ":$Answer" => $Answer
            ));
            $e = $stmt->errorInfo();
            if ($e[0] != "00000") {
                echo var_export($e, true);
            } else {
                if ($result) {
                    echo "Successfully inserted new thing: " . $Question;
                } else {
                    echo "Error inserting record";
                }
            }
        }
        else{
            echo "Failed to find INSERT_TABLE_THINGS.sql file";
        }
    }
    catch (Exception $e){
        echo $e->getMessage();
    }
}
?>