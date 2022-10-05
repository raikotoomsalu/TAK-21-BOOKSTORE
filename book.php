<?php

require_once('connection.php');

$id = $_GET['id'];

$stmt = $pdo->prepare('SELECT * FROM books WHERE id = :id');
$stmt->execute(['id' => $id]);
$book = $stmt->fetch();

var_dump($book);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$id;?></title>
</head>
<body>
    <h1><?=$book['title'];?> * Released in <?=$book ["release_date"]?> *  €<?=$book['price']?></h1>
    <img src="<?=$book['cover_path']?>" alt="">
    <h1><?=$book ["summary"]?></h1>
    <h1>Stock- <?=$book ["stock_saldo"]?></h1>
    <h1>Pages- <?=$book["pages"]?></h1>
    <div>
        <span><a href="edit_form.php?id=<?=$id;?>"></a></span>
    </div>
</body>
</html>
