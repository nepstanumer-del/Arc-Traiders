<?
ob_start();
include "../components/core.php";
 $way = "../";
include "../components/header.php";
 if(!isset($_SESSION['user'])){
    header("Location:../../index.php");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $img = $_FILES['img'];
    $img_price = $_FILES['img_price'];
    if (strpos($img['type'], 'image') === 0 && strpos($img_price['type'], 'image') === 0) {
        
        $img_name = $img["name"];
        $img_price_name = $img_price["name"];
        move_uploaded_file($img["tmp_name"], "../img/upload/" . $img_name);
        move_uploaded_file($img_price["tmp_name"], "../img/upload/" . $img_price_name);
        $sql = "INSERT INTO `trades` (
                    `name`, `img`, `price`, `amount`, `user_id`, 
                    `client`, `trade_status`, `amount_price`, `img_price`, `embark_id`
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $create = $link->prepare($sql);
        $user_id = $_SESSION['user']['id'];
        $client = null; 
        $status = 4;
        $create->bind_param(
            "sssiisissi", 
            $_POST['name'], 
            $img_name, 
            $_POST['price'], 
            $_POST['amount'], 
            $user_id, 
            $client, 
            $status, 
            $_POST['amount_price'], 
            $img_price_name, 
            $_POST['embark_id']
        );
        if ($create->execute()) {
            header("Location: ../index.php");
            exit();
        } else {
            die("Ошибка базы данных: " . $create->error);
        }

    } else {
        $_SESSION['error'] = 'Файл не является картинкой';
        header('Location: /pages/create.php');
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/create.css">
    

    <title>Document</title>
</head>
<body>
    <div class="background">
    <div class="fog"></div>
    </div>
    <main>
        <div class = 'container'>
            <form action="" method = 'post' enctype="multipart/form-data">
                <h1>Что хотите отдать</h1>
                <input class = 'name' type="text" placeholder = 'Введите название предмета' name='name'>
                <input class = 'amount' type="text" placeholder = 'Введите количество предметов' name ='amount'>
                <input class = 'img' type="file" name = 'img'>
                <h1>Что хотите получить</h1>
                <input class = 'name' type="text" placeholder = 'Введите желаемый предмет'  name ='price'>
                <input class = 'amount'type="text" placeholder = 'Введите количество желаемого предмета'  name ='amount_price'>
                <input class = 'img' type="file" name = 'img_price'>
                <input class = 'embark 'type="text" placeholder = 'Введите ваш Embark id'  name ='embark_id'>
                <button class = 'submit-btn' type="submit" name="submit">Создать лот</button>
            </form>
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