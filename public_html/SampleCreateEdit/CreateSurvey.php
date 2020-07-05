<form method="POST">
    <label for="Question">Question
        <input type="text" id="Question" name="Question" />
    </label>
    <label for = "Answer"> Answer
        <input type="text" id = "Answer" name = "Answer"
    </label>
    <input type="submit" name="created" value="Create Question"/>
</form>

<?php
if(isset($_POST["created"])){
    $question = $_POST["Question"];
    $answer = $_POST["Answer"];
    if(!empty($question) && !empty($answer)){
        require("config.php");
        require("common.inc.php");
        $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
        $query = file_get_contents(__DIR__ . "/queries/InsertInto.sql");
        try{
            $db = new PDO($connection_string, $dbuser, $dbpass);
            $stmt = $db->prepare("$query");
            $result = $stmt->execute(array(
                ":question" => $question,
                ":answer" => $answer
            ));

            $e = $stmt->errorInfo();
            if($e[0] != "00000"){
                echo var_export($e, true);
            }
            else{
                echo var_export($result, true);
                if ($result){
                    echo "Successfully inserted new Question & Answer " . $question;
                }
                else{
                    echo "Error inserting record";
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