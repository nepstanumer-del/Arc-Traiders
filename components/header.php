
<?
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>ARC TRAIDERS</title>
</head>
<body>
    <header class="arc-header">
    <nav class="arc-nav">
        <button class="arc-burger-btn hidden" aria-label="Открыть меню" aria-expanded="false">
            <span class="burger-line"></span>
            <span class="burger-line"></span>
            <span class="burger-line"></span>
        </button>
        <ul class="arc-nav-list">
            <?php
                if(isset($_SESSION['user'])){
                   if($_SESSION['user']['role'] == 2){
            ?>
                    <li class="arc-nav-item"><a class="arc-nav-link" href="<?=$way?>pages/admin/admin.php">Админ панель</a></li>
            <?php
                   } 
            ?>
                   <li class="arc-nav-item"><a class="arc-nav-link" href="<?=$way?>pages/main.php">О нас</a></li>
                   <li class="arc-nav-item"><a class="arc-nav-link" href="<?=$way?>pages/trade.php">Торговля</a></li>
                   <li class="arc-nav-item"><a class="arc-nav-link" href="<?=$way?>pages/hystory.php">Мои сделки</a></li>
                   <li class="arc-nav-item"><a class="arc-nav-link" href="<?=$way?>functions/logout.php">Выход</a></li>
            <?php
                }
                else{
            ?>
                     <li class="arc-nav-item"><a class="arc-nav-link" href="<?=$way?>index.php">Войти</a></li>
                     <li class="arc-nav-item"><a class="arc-nav-link" href="<?=$way?>pages/reg.php">Зарегистрироваться</a></li>   
            <?php
                }
            ?>
        </ul>
    </nav>
</header>
    </body>
</html>
