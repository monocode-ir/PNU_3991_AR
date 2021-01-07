<?php 

session_start();
$db = mysqli_connect('localhost', 'root', '', 'registration');
$errors = array();

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_again = $_POST['password_again'];
                                                                      
    if (empty($username)) {
        $errors[] = "نام کاربری را وارد نمایید "; 
    }
    if (empty($email)) { 
        $errors[] = "ایمیل خود را وارد نمایید"; 
    }
    if (empty($password)) {
        $errors[] = "کلمه عبور را وارد نمایید "; 
    }
    if ($password != $password_again) {
        $errors[] = "کلمه عبور و تکرار آن باید یکسان باشد";
    }

 
    $query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $query);
    $user = mysqli_fetch_assoc($result);
    if ($user) { 
        if ($user['username'] == $username) {
            $errors[]= "نام کاربری قبلا انتخاب شده است";
        }

        if ($user['email'] == $email) {
            $errors[]= "ایمیل قبلا ثبت شده است";
        }
    }

    if (count($errors) == 0) {
        $password = md5($password);
        $query = "INSERT INTO users (username, email, password)
        VALUES('$username', '$email', '$password')";
        mysqli_query($db, $query);
        $_SESSION['username'] = $username;
        header('location: index.php');
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>ثبت نام-پروژه حمیدرضا غیاث ابادی</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="header">
            <h2>ثبت نام کاربر جدید</h2>
        </div>
        <form method="post" action="register.php">
            <?php  if (count($errors) > 0) : ?>
                <div class="error">
                    <?php foreach ($errors as $error) : ?>
                        <p><?php echo $error ?></p>
                        <?php endforeach ?>
                </div>
                <?php  endif ?>
                   
            <div class="input-group">
                <label>نام کاربری</label>
                <input class="input" type="text" name="username" value="<?php echo @$username; ?>">
            </div>
            <div class="input-group">
                <label>ایمیل</label>
                <input class="input" type="email" name="email" value="<?php echo @$email; ?>">
            </div>
            <div class="input-group">
                <label>کلمه عبور</label>
                <input class="input" type="password" name="password">
            </div>
            <div class="input-group">
                <label>تکرار کلمه عبور</label>
                <input type="password" name="password_again">
            </div>
            <div class="input-group">
                <button type="submit" class="btn" name="register">ثبت نام</button>
            </div>
            <p>
            <a href="login.php" class="button is-warning">ورود</a>
            </p>
        </form>
    </body>
</html>
