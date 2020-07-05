<?php
if (isset($_GET["QuestionId"]) && !empty($_GET["QuestionId"])){
    if(is_numeric($_GET["QuestionId"])){
        $QuestionId = (int)$_GET["QuestionId"];
        $query = file_get_contents(__DIR__ . "/queries/DeleteFrom.sql");
        if(isset($query) && !empty($query)) {
            require("common.inc.php");
            $stmt = getDB()->prepare($query);
            $stmt->execute([":id"=>$QuestionId]);
            $e = $stmt->errorInfo();
            if($e[0] == "00000"){
                //we're just going to redirect back to the list
                //it'll reflect the delete on reload
                //also wrap it in a die() to prevent the script from any continued execution
                die(header("Location: list.php"));
            }
            else{
                echo var_export($e, true);
            }
        }
    }
}
else{
    echo "Invalid Question to delete";
}

if (isset($_GET["QuestionId"]) && !empty($_GET["QuestionId"])) {
    if (is_numeric($_GET["QuestionId"])) {
        $QuestionId = (int)$_GET["QuestionId"];
        $query = file_get_contents("DELETE FROM Answers WHERE ID = :id");
        if (isset($query) && !empty($query)) {
            require("common.inc.php");
            $stmt = getDB()->prepare($query);
            $stmt->execute([":id" => $QuestionId]);
            $e = $stmt->errorInfo();
            if ($e[0] == "00000") {
                //we're just going to redirect back to the list
                //it'll reflect the delete on reload
                //also wrap it in a die() to prevent the script from any continued execution
                die(header("Location: list.php"));
            } else {
                echo var_export($e, true);
            }
        }
    }
}
