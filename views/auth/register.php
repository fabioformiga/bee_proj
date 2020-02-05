<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <?php 
        if(empty($username_err) || empty($password_err)) {
            require_once '../config/properties.php';        
            require_once '../views/header.php';  
        }
    ?>
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
<section id="cover">
        <div id="cover-caption">
            <div class="container">
                <h2>Sign Up</h2>
                <p>Please fill this form to create an account.</p>
                <form action="index.php?action=registration" method="post">
                    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                        <span class="help-block"><?php echo $username_err; ?></span>
                    </div>    
                    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                        <span class="help-block"><?php echo $password_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                        <span class="help-block"><?php echo $confirm_password_err; ?></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <input type="reset" class="btn btn-default" value="Reset">
                    </div>
                    <p> <a href="index.php">Return to Home page</a>.</p>
                </form>
            </div>
        </div>
    </section>      
</body>
</html>