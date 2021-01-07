<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'registration');
$errors = array();
                   
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username)) {
        $errors= "نام کاربری را وارد نمایید";
    }
    if (empty($password)) {
        $errors= "کلمه عبور را وارد نمایید";
    }

    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
            $_SESSION['username'] = $username;
            header('location: index.php');
        }else {
            $errors[]= "نام کاربری یا کلمه عبور صحیح نیست";
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>ورود-پروژه حمیدرضا غیاث ابادی</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="header">
            <h2>ورود</h2>
        </div>

        <form method="post" action="login.php">
            <?php  if (count($errors) > 0) : ?>
                <div class="error">
                    <?php foreach ($errors as $error) : ?>
                        <p><?php echo $error ?></p>
                        <?php endforeach ?>
                </div>
                <?php  endif ?>
            <div class="input-group">
                <label>نام کاربری</label>
                <input type="text" name="username" >
            </div>
            <div class="input-group">
                <label>کلمه عبور</label>
                <input type="password" name="password">
            </div>
            <div class="input-group">
                <button type="submit" class="btn" name="login">ورود</button>
            </div>
            <p>
                <a href="register.php" class="button is-warning">ثبت نام کاربر جدید</a>
            </p>
        </form>
    </body>
</html>
