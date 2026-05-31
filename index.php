<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/index.css">
    <title>ARC TRAIDERS</title>
</head>
<body>
   <?
   $way = "";
include "components/core.php";
include "components/header.php";

if(isset($_SESSION['user'])){
    header("Location:pages/main.php");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $stmt = $link->prepare("SELECT * FROM `users` WHERE `login` = ?");
    $stmt->bind_param("s", $_POST['login']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc();
        if (password_verify($_POST['password'], $user_data['password'])) {
            $_SESSION['user']['id'] = $user_data['id'];
            $_SESSION['user']['role'] = $user_data['role_id'];
            header("Location: pages/main.php");
            exit(); 
        } else {
            $_SESSION['error']['login'] = 'Неверный логин или пароль';
        }
    } else {
        $_SESSION['error']['login'] = 'Неверный логин или пароль';
    }
}
?>


<div class="arc-login-container">
    <form class="arc-login-form" action="" method="post">
        <div class="arc-form-header">
            <h1>АВТОРИЗАЦИЯ</h1>
            <span class="arc-sys-text">SYS.LOGIN_REQ //</span>
        </div>
        <div class="arc-input-group">
            <label for="login">Логин</label>
            <input class="arc-input" type="text" name="login" id="login" placeholder="ВВЕДИТЕ ЛОГИН" required>
        </div>
        <div class="arc-input-group">
            <label for="password">Пароль</label>
            <input class="arc-input" type="password" name="password" id="password" placeholder="••••••••" required>
        </div>
        <button class="arc-btn-submit" type="submit" name="submit">ВОЙТИ</button>
        <?php
            if(isset($_SESSION['error'])){
                echo '<div class="arc-error-box">';
                foreach($_SESSION['error'] as $key => $value ){
                    echo '<p class="arc-error-text">[ERR] ' . $value . '</p>'; 
                }
                echo '</div>';
                unset($_SESSION['error']);
            }
        ?>
        <div class="arc-form-footer">
            <a href="pages/reg.php">Нет профиля? Зарегистрироваться</a>
        </div>
    </form>
</div>
<script src="assets/js/main.js"></script>
</body>
</html>





