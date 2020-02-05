<?php

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
?> 
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo TXT_TAB_TITLE_LOGIN; ?> </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
        if(empty($username_err) || empty($password_err)) {
            require_once '../config/properties.php';        
            require_once '../views/header.php';  
        }
        ?>
    </head>
<body>
    <section id="cover">
        <div id="cover-caption">
            <div class="container">
                <div class="col-sm-10 col-sm offset-1 mt-5">
                    <h2 class="text-center"><?php echo TXT_TITLE_LOGIN; ?></h2>
                    <p><?php echo TXT_DESC_LOGIN; ?></p>
                    <form class="justify-content-center" action="index.php?action=login" method="post">
                        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                            <label><?php echo TXT_USERNAME_LOGIN; ?></label>
                            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                            <span class="help-block"><?php echo $username_err; ?></span>
                        </div>    
                        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                            <label><?php echo TXT_PASSWORD_LOGIN; ?></label>
                            <input type="password" name="password" class="form-control">
                            <span class="help-block"><?php echo $password_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="<?php echo TXT_TITLE_LOGIN; ?>">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>    
</body>
</html>