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
    $Question = $_POST["Question"];
    $Answer = $_POST["Answer"];
    if(!empty($Question) && !empty($Answer)){
        require("config.php");
        $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
        try{
            $query1= "INSERT INTO Questions (question) VALUES (:question)";
            $query2 = "INSERT INTO Answers (answer) VALUES (:answer)";
            $db = new PDO($connection_string, $dbuser, $dbpass);
            $stmt = $db->prepare($query1,$query2);
            $result = $stmt->execute();
            $e = $stmt->errorInfo();
            if($e[0] != "00000"){
                echo var_export($e, true);
            }
            else{
                echo var_export($result, true);
                if ($result){
                    echo "Successfully inserted new Question & Answer " . $Question;
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