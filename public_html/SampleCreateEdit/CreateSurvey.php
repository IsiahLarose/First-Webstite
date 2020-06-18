<form method="POST">
    <label for="Survey">Survey Question
        <input type="text" id="Survey" Question="Question" />
    </label>
    <label for="A">Answer
        <input type="Text" id="A" Question="Answer" />
    </label>
    <input type="submit" Question="created" value="Create Survey"/>
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
            $stmt = $db->prepare("INSERT INTO Survey (Question, Answer) VALUES (:Question, :Answer)");
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
                    echo "Successfully inserted new Answer: " . $Question;
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
        echo "Question and Answer must not be empty.";
    }
}
?>