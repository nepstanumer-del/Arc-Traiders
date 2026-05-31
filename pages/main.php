
<?
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/main.css">
    <title>ARC TRAIDERS</title>
</head>
<body>
   
    <?php
        include "../components/core.php";
        $way = "../";
        include "../components/header.php"; 
        if(!isset($_SESSION['user'])){
    header("Location:../../index.php");
    exit;
}
    ?>
    <main>
        <div class="arc-hero">
            <h1 class="arc-title">ARC  <span>TRAIDERS</span></h1>
            <h2 class="arc-subtitle">ВЫЖИВАЙ. ТОРГУЙ. СОПРОТИВЛЯЙСЯ.</h2>
            <p class="arc-desc">
                Надежная торговая сеть для обмена ресурсами среди <b>Arc Raiders</b>.
                Находите <b>чертежи оружия</b>, и заключайте выгодные контракты.
            </p>
            <a href="../pages/trade.php" class="arc-cta">НАЧАТЬ ТОРГОВАТЬ</a>
        </div>
        <div class="arc-panel arc-how">
            <div class="arc-how-header">
                <h1>ПРОТОКОЛ ОБМЕНА</h1>
                <p>Оптимизированная система торговли. Получите необходимое снаряжение за 3 простых шага.</p>
            </div>
            <div class="arc-steps">
                <div class="arc-step">
                    <div class="arc-step-header">
                        <h3>Поиск на рынке</h3>
                        <span class="num">01</span>
                    </div>
                    <p>Ищите необходимые чертежи, броню и редкие материалы в игре.</p>
                </div>
                <div class="arc-step">
                    <div class="arc-step-header">
                        <h3>Запрос на обмен</h3>
                        <span class="num">02</span>
                    </div>
                    <p>Отправьте электронное предложение с вашими ресурсами или внутриигровой валютой.</p>
                </div>
                <div class="arc-step">
                    <div class="arc-step-header">
                        <h3>Транзакция</h3>
                        <span class="num">03</span>
                    </div>
                    <p>Встретьтесь в рейде и проведите обмен снаряжением .</p>
                </div>
            </div>
        </div>
        <div class="arc-panel arc-why">
            <div class="arc-why-left">
                <h1>ПРЕИМУЩЕСТВА<br>СИСТЕМЫ</h1>
                <ul class="arc-list">
                    <li>Мгновенный поиск предложений по конкретным чертежам</li>
                    <li>Никакого спама в Discord — всё автоматизировано</li>
                    <li>Заработайте репутацию самого надежного брокера сектора</li>
                    <li>Синхронизация интерфейса с мобильными устройствами</li>
                </ul>
            </div>
            <div class="arc-why-right">
                <div class="arc-card-empty">
                    <span>SYS.RADAR_OFFLINE</span>
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
    <script src="../assets/js/main.js"></script>
</body>
</html>
</html>

