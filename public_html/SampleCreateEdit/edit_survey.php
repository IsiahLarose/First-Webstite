<?php
require("config.php");
$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
$db = new PDO($connection_string, $dbuser, $dbpass);
$thingId = -1;
$result = array();
function get($arr, $key){
    if(isset($arr[$key])){
        return $arr[$key];
    }
    return "";
}
if(isset($_GET["thingId"])){
    $thingId = $_GET["thingId"];
    $stmt = $db->prepare("SELECT * FROM Things where id = :id");
    $stmt->execute([":id"=>$thingId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
}
else{
    echo "No thingId provided in url, don't forget this or sample won't work.";
}
?>

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
if(isset($_POST["updated"])){
    $name = $_POST["name"];
    $title= $_POST["title"];
    if(!empty($name) && !empty($title)){
        try{
            $stmt = $db->prepare("UPDATE Things set name = :name, title=:title where id=:id");
            $result = $stmt->execute(array(
                ":name" => $name,
                ":title" => $title,
                ":id" => $thingId
            ));
            $e = $stmt->errorInfo();
            if($e[0] != "00000"){
                echo var_export($e, true);
            }
            else{
                echo var_export($result, true);
                if ($result){
                    echo "Successfully updated thing: " . $name;
                }
                else{
                    echo "Error updating record";
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