<?php
// Login template
?>
<div class="card">
    <div class="card-header">
        <h2>Login</h2>
    </div>
    
    <form class="login-form" method="post" action="login.php">
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
        </div>
        
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        
        <div class="form-group">
            <button type="submit" class="btn btn-primary" name="login">Login</button>
        </div>
    </form>
</div>
