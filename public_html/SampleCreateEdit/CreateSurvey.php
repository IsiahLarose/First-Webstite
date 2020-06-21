<form method="POST">
    <label for="Survey">Survey Question
        <input type="text" id="Question" name="name" />
    </label>
    <label for="A">Answer
        <input type="text" id="A" name="name" />
    </label>
    <input type="submit" name="created" value="Create Question"/>
</form>

<?php
if(isset($_POST["created"])){
    $name = $_POST["name"];
    $text = $_POST["text"];
    if(!empty($name) && !empty($text)){
        require("config.php");
        $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
        try{
            $db = new PDO($connection_string, $dbuser, $dbpass);
            $stmt = $db->prepare("INSERT INTO Survey (name, text) VALUES (:name , :text)");
            $result = $stmt->execute(array(
                ":name" => $name,
                ":text" => $text
            ));
            $e = $stmt->errorInfo();
            if($e[0] != "00000"){
                echo var_export($e, true);
            }
            else{
                echo var_export($result, true);
                if ($result){
                    echo "Successfully inserted new Answer: " . $name;
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