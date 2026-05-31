<?
ob_start();
include "../components/core.php";
 $way = "../";
include "../components/header.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update'])) {
        $status = $link->prepare("UPDATE `trades` SET `trade_status` = ? WHERE `trade_id` = ?");
        $status->bind_param("ii", $_POST['status_update'], $_POST['trade']);
        
        if ($status->execute()) {
        }
        $status->close();
    }
    if (isset($_POST['delete'])) {
        $stmt = $link->prepare("DELETE FROM `trades` WHERE `trade_id` = ?");
        $stmt->bind_param("i", $_POST['trade']);
        if ($stmt->execute()) {
        }
        $stmt->close();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/hystory.css">
    <title>ARC TRAIDERS</title>
</head>
<body>
     <main>
        <?php
            if(!isset($_SESSION['user'])){
                header("Location:index.php");
                exit;
            }
            $requests = mysqli_query($link,"SELECT `trades`.*, `statuses`.*, `users`.* 
            FROM `trades` 
            LEFT JOIN `statuses` ON `trades`.`trade_status` = `statuses`.`status_id` 
            LEFT JOIN `users` ON `trades`.`user_id` = `users`.`id`
            WHERE `trades`.`user_id`  =  '{$_SESSION['user']['id']}'");
            if(mysqli_num_rows($requests) > 0) {
        ?>
            <div class="arc-trades-list">
                <?php
                    foreach($requests as $key => $value) {
                ?>
                        <div class="request">
                            <div class="arc-trades1">
                                <span class="embark"><?=$value['embark_id']?></span>
                                <img src="../img/upload/<?=$value['img']?>" alt="img1">
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
                                <img src="../img/upload/<?=$value['img_price']?>" alt="img2">
                            </div>
                            <div class="arc-status">
                                <?=$value['status']?>
                            </div>
                            <form class="arc-trade-controls" action="" method="post">
                                <input type="hidden" name="trade" value="<?=$value['trade_id']?>">
                                <div class="arc-control-group">
                                    <?if($value['status'] != 'На рассмотрении'){?>
                                    <select class="arc-select" name="status_update">
                                        <?php
                                            $dif = mysqli_query($link,"SELECT * FROM `statuses` WHERE `status` != 'На рассмотрении'");
                                            foreach($dif as $key_status => $status_val){ 
                                        ?>
                                            <option value="<?=$status_val['status_id']?>">STATUS // <?=$status_val['status']?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                    <button class="arc-btn arc-btn-update" type="submit" name="update">ОБНОВИТЬ</button>
                                    
                                    <?
                                    }
                                

                                
                                    ?>
                                
                                </div>
                                <button class="arc-btn arc-btn-danger" type="submit" name="delete">УДАЛИТЬ ПРОТОКОЛ</button>
                            </form>
                        </div>
                <?php
                    } 
                ?>
            </div>
        <?php
            } else { 
        ?>
            <div class="arc-no-data">
                [ SYS_MSG: В базе данных нет активных контрактов ]
            </div>
        <?php
            }
        ?>
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
<script src="../assets/js/main.js"></script>
</body>
</html>