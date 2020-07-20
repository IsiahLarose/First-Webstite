<?php
include_once(__DIR__."/partials/header.partial.php");

if(Common::is_logged_in()){
    //this will auto redirect if user isn't logged in
    if(!Common::has_role("Admin")){
        die(header("Location: home.php"));
    }
}
$last_updated = Common::get($_SESSION, "last_sync", false);
?>
<div class="container-fluid">
     <form method="POST">
        <div class="form-group">
            <label for="questionnaire_name">Questionnaire Name</label>
            <input class="form-control" type="text" id="questionnaire_name" name="questionnaire_name" required/>
        </div>
        <div class="form-group">
            <label for="questionnaire_desc">Questionnaire Description</label>
            <textarea class="form-control" type="text" id="questionnaire_desc" name="questionnaire_desc"></textarea>
        </div>
        <div class="form-group">
            <label for="attempts_per_day">Attempts per day</label>
            <input class="form-control" type="number" id="attempts_per_day" name="attempts_per_day" value="1" min="1"/>
        </div>
        <div class="form-group">
            <label for="max_attempts">Max Attempts</label>
            <input class="form-control" type="number" id="max_attempts" name="max_attempts" value="1" min="0" />
        </div>
        <div class="form-group">
            <label for="use_max">Use Max?</label>
            <input class="form-control" type="checkbox" id="use_max" name="use_max"/>
        </div>
        <div class="list-group">
            <div class="list-group-item">
                <div class="form-group">
                    <label for="question_0">Question</label>
                    <input class="form-control" type="text" id="question_0" name="question_0" required/>
                </div>
                <button class="btn btn-danger" onclick="event.preventDefault(); deleteMe(this);">X</button>
                <div class="list-group">
                    <div class="list-group-item">
                        <div class="form-group">
                            <label for="question_0_answer_0">Answer</label>
                            <input class="form-control" type="text" id="question_0_answer_0" name="question_0_answer_0" required/>
                        </div>
                        <button class="btn btn-danger" onclick="event.preventDefault(); deleteMe(this);">X</button>
                        <div class="form-group">
                            <label for="question_0_answeroe_0">Allow Open Ended?</label>
                            <input class="form-control" type="checkbox" id="question_0_answeroe_0" name="question_0_answeroe_0"/>
                        </div>
                    </div>
                </div>
                <button class="btn btn-secondary" onclick="event.preventDefault(); cloneThis(this);">Add Answer</button>
            </div>
        </div>
        <button class="btn btn-secondary" onclick="event.preventDefault(); cloneThis(this);">Add Question</button>

        <div class="form-group">
            <input type="submit" name="submit" class="btn btn-primary" value="Create Questionnaire"/>
        </div>
    </form>