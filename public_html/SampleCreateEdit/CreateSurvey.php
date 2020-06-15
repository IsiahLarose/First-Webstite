<form method="POST">
    <label for="Survey">Survey Name
        <input type="text" id="Survey" name="name" />
    </label>
    <label for="q">
        <input type="Text" id="T" name="title" />
    </label>
    <input type="submit" name="created" value="Create Survey"/>
</form>

<?php
if(isset($_POST["created"])){
    $name = $_POST["name"];
    $title = $_POST["title"];
    if(!empty($name) && !empty($title)){
        require("config.php");
        $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
        try{
            $db = new PDO($connection_string, $dbuser, $dbpass);
            $stmt = $db->prepare("INSERT INTO Things (name, title) VALUES (:name, :title)");
            $result = $stmt->execute(array(
                ":name" => $name,
                ":title" => $title
            ));
            $e = $stmt->errorInfo();
            if($e[0] != "00000"){
                echo var_export($e, true);
            }
            else{
                echo var_export($result, true);
                if ($result){
                    echo "Successfully inserted new Title: " . $name;
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
        echo "Name and title must not be empty.";
    }
}
?>