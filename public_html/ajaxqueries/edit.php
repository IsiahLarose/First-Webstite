<?php
if(isset($_POST["created"])){
    $question = $_POST["Question"];
    $answer = $_POST["Answer"];
    if(!empty($question) && !empty($answer)){
        require("config.php");
        $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
        try{
            $db = new PDO($connection_string, $dbuser, $dbpass);
            $stmt = $db->prepare("UPDATE Questions SET (question) VALUES (:question)");
            $result = $stmt->execute(array(
                ":question" => $question,
            ));
            $stmt = $db->prepare("UPDATE Answers SET (answer) VALUES (:answer)");
            $result = $stmt->execute(array(
                ":answer" => $answer,
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