<?php
ob_start();
include "../components/core.php";
$way = "../";
include "../components/header.php";


if (!isset($_SESSION['user'])) {
    header("Location:../../index.php");
    exit;
}
$search_query = isset($_GET['search']) ? trim($_GET['search']) : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/trade.css">
    <title>ARC TRAIDERS</title>
</head>
<body>
    <main>
        <div class="arc-market-header">
            <div class="arc-write">
                 <h1>Рынок</h1>
                 <h3>Все активные запросы</h3>
            </div>
            <div class="arc-header-actions">
                <form action="" method="GET" class="arc-search-container">
                    <input type="text" name="search" class="arc-search-input" placeholder="Поиск по предмету..." value="<?= htmlspecialchars($search_query) ?>">
                    <button type="submit" class="arc-search-btn">Найти</button>
                    <?php if($search_query): ?>
                        <a href="?" class="arc-search-btn" style="background: #444; text-decoration: none; display: flex; align-items: center;">Сброс</a>
                    <?php endif; ?>
                </form>
                <a href="../pages/create.php" class="arc-cta">СОЗДАТЬ ОБЪЯВЛЕНИЕ</a>
            </div>
        </div>

        <div class="arc-trades-list">
            <?php
            $sql = "SELECT `trades`.*, `statuses`.*, `users`.* 
                    FROM `trades` 
                    LEFT JOIN `statuses` ON `trades`.`trade_status` = `statuses`.`status_id` 
                    LEFT JOIN `users` ON `trades`.`user_id` = `users`.`id` 
                    WHERE `statuses`.`status` != 'На рассмотрении' 
                    AND `statuses`.`status` != 'Отменен'";
            if ($search_query !== '') {
                $sql .= " AND (`trades`.`name` LIKE ? OR `trades`.`price` LIKE ?)";
                $search = $link->prepare($sql);
                $searchTerm = "%$search_query%";
                $search->bind_param("ss", $searchTerm, $searchTerm);
                $search->execute();
                $requests = $search->get_result();
            } else {
                $requests = mysqli_query($link, $sql);
            }
            
            if($requests && mysqli_num_rows($requests) > 0) {
                while($value = mysqli_fetch_assoc($requests)) {
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
            </div>
            <?php
                }
            } else {
            ?>
                <div class="arc-no-data">
                    [ SYS_MSG: По вашему запросу ничего не найдено ]
                </div>
            <?php
            }
            ?>
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
    <script src="../assets/js/main.js"></script>
</body>
</html>