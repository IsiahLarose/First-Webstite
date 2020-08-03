<?php
include_once(__DIR__."/partials/header.partial.php");
if(Common::is_logged_in()){
    //this will auto redirect if user isn't logged in
}
?>
<link rel="stylesheet" type="text/css" href="style.css">
<div>
    <p>Welcome, <?php echo Common::get_username();?></p>
</div>