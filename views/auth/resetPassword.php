<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
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
                <h2>Reset Password</h2>
                <p>Please fill out this form to reset your password.</p>
                <form action="index.php?action=reset_password" method="post"> 
                    <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                        <label>New Password</label>
                        <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
                        <span class="help-block"><?php echo $new_password_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control">
                        <span class="help-block"><?php echo $confirm_password_err; ?></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a class="btn btn-link" href="index.php">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </section>    
</body>
</html>