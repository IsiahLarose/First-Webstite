<form method=""POST">
    <label for email="email">Email
    <input type="email" id="email" name="email"/>
    </label>
    <label for password="password">Password
    <input type="password" name="password"/>
    </label>
    <label for cpassword="cpassword">Cpassword
    <input type="password" name="cpassword"/>
    </label>
    <input type="submit" name="Register" value="Register"/>
</form>
<?php
echo var_export($_GET, true);
echo var_export($_POST, true);
echo var_export($_REQUEST,true);
?>