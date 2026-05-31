 <?
ob_start();
include "../components/core.php";
 $way = "../";
include "../components/header.php";
if(isset($_SESSION['user'])){
    header("Location:main.php");
}
 if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $check = $link->prepare("SELECT `login` FROM `users` WHERE `login` = ?");
    $check->bind_param("s", $_POST['login']); 
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error']['login'] = 'Такой пользователь уже существует';
    } else {
        if ($_POST['password'] === $_POST['repeat_password']) {
            $hash_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $insert = $link->prepare("INSERT INTO `users` (`login`, `password`, `email`) VALUES (?, ?, ?)");
            $insert->bind_param("sss", $_POST['login'], $hash_password, $_POST['email']);
            
            if ($insert->execute()) {
                header("Location: ../index.php");
                exit(); 
            } else {
                $_SESSION['error']['password'] = 'ошибка при регистрации';
            }
        } else {
            $_SESSION['error']['password'] = 'Пароли не совпадают';
        }
    }
}


 ?>
 
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/reg.css">
    <title>ARC TRAIDERS</title>
 </head>
 <body>
    
 <div class="arc-login-container">
    <form class="arc-login-form" action="" method="post">
        <div class="arc-form-header">
            <h1>РЕГИСТРАЦИЯ</h1>
            <span class="arc-sys-text">SYS.REG_NEW //</span>
        </div>
        <div class="arc-input-group">
            <label for="login">Логин</label>
            <input class="arc-input" type="text" name="login" id="login" placeholder="Логин" required>
        </div>
        <div class="arc-input-group">
            <label for="password">Пароль</label>
            <input class="arc-input" type="password" name="password" id="password" placeholder="••••••••" required>
        </div>
        <div class="arc-input-group">
            <label for="repeat_password">Подтверждение пароля</label>
            <input class="arc-input" type="password" name="repeat_password" id="repeat_password" placeholder="••••••••" required>
        </div>
        <div class="arc-input-group">
            <label for="email">E-mail</label>
            <input class="arc-input" type="email" name="email" id="email" placeholder="USER@NETWORK.COM" required>
        </div>
        <button class="arc-btn-submit" type="submit" name="submit">СОЗДАТЬ ПРОФИЛЬ</button>
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
            <a href="../index.php">Уже есть аккаунт? Вернуться к авторизации</a>
        </div>
    </form>
</div>
    
    <?
        if(isset($_SESSION['error'])){
            foreach($_SESSION['error'] as $key => $value){
                ?>
                    <p style='color:red;'><?= $value?></p>
                <?
            }
            unset($_SESSION['error']);
        }
    
    ?>
 </form>
 </div>
 <script src="../assets/js/main.js"></script>
 </body>
 </html>
 
 
 
 
