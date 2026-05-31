<?
ob_start();
include "../../components/core.php";
 $way = "../../";
include "../../components/header.php";

if(!isset($_SESSION['user'])){
    header("Location:../../index.php");
    exit;
}
if($_SESSION['user']['role'] !=2 ){
    header("Location:../trade.php");
}
if($_POST){
    if(isset($_POST['update'])){
        $update = mysqli_query($link,"UPDATE `trades` SET  `trade_status`='{$_POST['status_update']}' WHERE `trade_id` = '{$_POST['trade']}'");
    }
    if(isset($_POST['delete'])){
        $delete = mysqli_query($link,"DELETE FROM `trades` WHERE `trade_id`='{$_POST['trade']}'");
    }  
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../../assets/css/admin.css">
    <title>ARC TRAIDERS</title>
</head>
<body>
    <main>
        <div class="container">
            <div class="main_admin">
                <div class="main__admin-accept">
                     <div class="arc-trades-list">
            <?php
            $requests = mysqli_query($link,"SELECT `trades`.*, `statuses`.*, `users`.* 
            FROM `trades` 
            LEFT JOIN `statuses` ON `trades`.`trade_status` = `statuses`.`status_id` 
            LEFT JOIN `users` ON `trades`.`user_id` = `users`.`id`
            WHERE `statuses`.`status` = 'На рассмотрении'");
            
            if(mysqli_num_rows($requests) > 0) {
                foreach($requests as $key => $value) {

            ?>

<div class="request">
    <div class="arc-trades1">
        <span class="embark"><?=$value['embark_id']?></span>
        
        <img src="../../img/upload/<?=$value['img']?>" alt="img1">
        <div class="arc-trade-info">
            <span class="arc-trade-label">Предложение</span>
            <span class="arc-trade-name"><?=$value['name']?></span>
            <span class="arc-trade-amount">Кол-во: <?=$value['amount']?></span>
        </div>
    </div>
    <div class="arc-exchange-icon">⇌</div>
    <div class="arc-trades2">
        <div class="arc-trade-info" style="text-align: right;">
            <span class="arc-trade-label">Требуется</span>
            <span class="arc-trade-name"><?=$value['price']?></span>
            <span class="arc-trade-amount">Кол-во: <?=$value['amount_price']?></span>
        </div>
        <img src="../../img/upload/<?=$value['img_price']?>" alt="img2">
        
    </div>
    <div class="arc-status">
        <?=$value['status']?>
    </div>
        <form class="arc-trade-controls" action="" method="post">
    <input type="hidden" name="trade" value="<?=$value['trade_id']?>">
    <div class="arc-control-group">
        <select class="arc-select" name="status_update">
            <?php
                $dif = mysqli_query($link,"SELECT * FROM `statuses`");
                foreach($dif as $key => $status_val){ 
            ?>
                <option value="<?=$status_val['status_id']?>">STATUS // <?=$status_val['status']?></option>
            <?php
                }
            ?>
        </select>
        
        <button class="arc-btn arc-btn-update" type="submit" name="update">ОБНОВИТЬ</button>
    </div>
    <button class="arc-btn arc-btn-danger" type="submit" name="delete">УДАЛИТЬ ПРОТОКОЛ</button>
</form>
</div>

            <?php
                }
            } else {
            ?>
                <div class="arc-no-data">
                    [ SYS_MSG: В базе данных нет активных контрактов ]
                </div>
            <?php
            }
            ?>
            
        </div>
                </div>
            </div>

        </div>
    </main>
    <footer class="arc-footer">
    <div class="arc-footer-container">
        <div class="arc-footer-content">
            <div class="arc-footer-left">
                <h3>ARC TRAIDERS</h3>
                <p>Неофициальный торговый сайт Arc Raiders. Мы не связаны с Embark Studios.</p>
            </div>
            <div class="arc-footer-links">
                <h4>Платформа</h4>
                <ul>
                    <li><a href="#">Рынок</a></li>
                    <li><a href="#">Мои сделки</a></li>
                </ul>
            </div>
        </div>
        <div class="arc-footer-bottom">
            © 2026 ARC TRAIDERS. Все права защищены.
        </div>

    </div>
</footer>
<script src="../../assets/js/main.js"></script>
</body>
</html>