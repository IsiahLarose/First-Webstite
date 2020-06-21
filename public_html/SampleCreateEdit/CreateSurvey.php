<form method="POST">
    <label for="question_text">question_text
        <input type="text" id="question_text" name="question_text" />
    <input type="submit" name="created" value="Create question_text"/>
</form>

<?php
if(isset($_POST["created"])){
    $question_text = $_POST["question_text"];
    if(!empty($question_text)){
        require("config.php");
        $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
        try{
            $db = new PDO($connection_string, $dbuser, $dbpass);
            $stmt = $db->prepare("INSERT INTO question_texts (question_text) VALUES (:question_text,)");
            $result = $stmt->execute(array(
                ":question_text" => $question_text,
            ));
            $e = $stmt->errorInfo();
            if($e[0] != "00000"){
                echo var_export($e, true);
            }
            else{
                echo var_export($result, true);
                if ($result){
                    echo "Successfully inserted new thing: " . $question_text;
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
        echo "question_text must not be empty.";
    }
}
?>