<form method="POST">
    <label for="Surveys">Thing Name
        <input type="text" id="Surveys" name="title" />
    </label>
    <label for="A">message_text
        <input type="text" id="q" name="title" />
    </label>
    <input type="submit" name="created" value="Create Thing"/>
</form>

<?php
if(isset($_POST["created"])){
    $title = $_POST["title"];
    $message_text = $_POST["message_text"];
    if(!empty($title) && !empty($message_text)){
        require("config.php");
        $connection_string = "mysql:host=$dbhost;dbtitle=$dbdatabase;charset=utf8mb4";
        try{
            $db = new PDO($connection_string, $dbuser, $dbpass);
            $stmt = $db->prepare("INSERT INTO Survey (title, message_text) VALUES (:title, :message_text)");
            $result = $stmt->execute(array(
                ":title" => $title,
                ":message_text" => $message_text
            ));
            $e = $stmt->errorInfo();
            if($e[0] != "00000"){
                echo var_export($e, true);
            }
            else{
                echo var_export($result, true);
                if ($result){
                    echo "Successfully inserted new Surveys: " . $title;
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