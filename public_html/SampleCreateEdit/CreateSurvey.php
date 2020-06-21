<form method="POST">
    <label for="Surveys">Thing Name
        <input type="text" id="Surveys" name="name" />
    </label>
    <label for="A">message_text
        <input type="text" id="q" name="" />
    </label>
    <input type="submit" name="created" value="Create Thing"/>
</form>

<?php
if(isset($_POST["created"])){
    $name = $_POST["name"];
    $text = $_POST["text"];
    if(!empty($name) && !empty(text)){
        require("config.php");
        $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
        try{
            $db = new PDO($connection_string, $dbuser, $dbpass);
            $stmt = $db->prepare("INSERT INTO Survey (name, message_text) VALUES (:name, :message_text)");
            $result = $stmt->execute(array(
                ":name" => $name,
                ":text" => text
            ));
            $e = $stmt->errorInfo();
            if($e[0] != "00000"){
                echo var_export($e, true);
            }
            else{
                echo var_export($result, true);
                if ($result){
                    echo "Successfully inserted new Surveys: " . $name;
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
        echo "Question and text must not be empty.";
    }
}
?>