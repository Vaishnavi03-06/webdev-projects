<?php
session_start();

//if logged in, no need to show login page
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
    header('Location: index.php');
    exit();
}

$error = "";

// $validpassword = "hangry123";

$valid_username ="admin";
$valid_password = "hangry123";

if($_SERVER['REQUEST_METHOD' ] ==  'POST'){
    $username = trim($_POST['username']);
    $password = trim($_POST['password'] );


    //storing plain text password, should use password_hash() in real project
    //if($username == $valid_username && md5($password) == md5($valid_password)){


    if($username == $valid_username && $password == $valid_password){
        $_SESSION['logged_in']=true;
        $_SESSION['username']= $username;
        header('Location: index.php');
        exit();
    } else {
        $error="Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"  content="width=device-width, initial-scale=1.0">
    <title>Hangry-Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="login-page">

<div class="login-wrap">
    <div  class="login-left">
        //fix the link
        <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=900&q=80" alt="Food">
        <div class="login-left-overlay">
            <div class="login-brand">HANGRY<span>🔥</span></div>
            <p>Fast orders. Hot food.  Zero wait.</p>
        </div>
    </div>

    <div  class="login-right">
        <div class="login-box">
            <h2>Welcome Back</h2>
            <p class="login-sub">Sign in to manage  orders </p>

            <?php if($error): ?>
                <div class="alert alert-error"><?= $error ?> </div>
            <?php endif; ?>

            <form method="POST" action="login.php">
                <label>Username</label>
                <input type="text" name="username" placeholder="Enter username" required
                    value="<?=isset($username) ? htmlspecialchars($username) : '' ?>">

                <label>Password</label>
                <input type="password" name="password" placeholder="Enter password"  required>

                <button type="submit" class="btn-submit">🔥 Sign In</button>
            </form>

            <p class="login-hint">Use:   <strong>admin</strong>/ <strong>hangry123</strong></p>
        </div>
    </div>
</div>

</body>
</html>