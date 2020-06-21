<form method="POST">
    <label for="Question">Question
        <input type="text" id="Question" name="Question" />
    </label>
    <label for="A">Answer
        <input type="text" id="Answer" name="Answer" />
    </label>
    <input type="submit" name="created" value="Create Question"/>
</form>

<?php
if(isset($_POST["created"])){
    $Question = $_POST["Question"];
    $Answer = $_POST["Answer"];
    if(!empty($Question) && !empty($Answer)){
        require("config.php");
        $connection_string = "mysql:host=$dbhost;dbQuestion=$dbdatabase;charset=utf8mb4";
        try{
            $db = new PDO($connection_string, $dbuser, $dbpass);
            $stmt = $db->prepare("INSERT INTO Things (question, Answer) VALUES (:question, :Answer)");
            $result = $stmt->execute(array(
                ":Question" => $Question,
                ":Answer" => $Answer
            ));
            $e = $stmt->errorInfo();
            if($e[0] != "00000"){
                echo var_export($e, true);
            }
            else{
                echo var_export($result, true);
                if ($result){
                    echo "Successfully inserted new thing: " . $Question;
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
        echo "Name and Answer must not be empty.";
    }
}
?>