<?php
require_once (__DIR__."/../includes/common.inc.php");
$logged_in = Common::is_logged_in(false);
?>
<!-- Bootstrap 4 CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous">
</script><!-- Include jQuery 3.5.1-->
<nav class="navbar navbar-expand-lg navbar-dark bg-warning">
    <ul class="navbar-nav mr-auto">
        <?php if($logged_in):?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo Common::url_for("home");?>">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo Common::url_for("game");?>">Game</a>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo Common::url_for("create_questionnaire");?>">Create Custom Survey</a>
                </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo Common::url_for("surveys");?>">Surveys</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo Common::url_for("TakenSurveys");?>">Surveys you've Taken</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo Common::url_for("search");?>">Search through Surveys</a>
            </li>
        <?php endif; ?>
        <?php if(!$logged_in):?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo Common::url_for("login");?>">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo Common::url_for("register");?>">Register</a>
            </li>
        <?php else:?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo Common::url_for("logout");?>">Logout</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>
<div id="messages">
    <?php $flash_messages = Common::getFlashMessages();?>
    <?php if(isset($flash_messages) && count($flash_messages) > 0):?>
        <?php foreach($flash_messages as $msg):?>
            <div class="alert alert-<?php echo Common::get($msg, "type");?>"><?php
                echo Common::get($msg, "message");
                //We have the opening and closing tags right after/before the div tags to remove any whitespace characters
                ?></div>
        <?php endforeach;?>
    <?php endif;?>
</div>