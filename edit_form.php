<?php

require_once('connection.php');

$id = $_GET['id'];

if ( isset($_POST['edit']) && $_POST['edit'] == 'Salvesta' ) {
    // var_dump($_POST);

    $stmt = $pdo->prepare('UPDATE books SET title = :title, stock_saldo = :stock_saldo WHERE id = :id');
    $stmt->execute(['title' => $_POST['title'], 'stock_saldo' => $_POST['stock-saldo'], 'id' => $id]);
    
    $stmt = $pdo->prepare('UPDATE book_authors SET author_id = :author_id WHERE book_id = :book_id');
    $stmt->execute(['author_id' => $_POST['author_id'], 'book_id' => $id]);

    header('Location: book.php?id=' . $id);
}

$stmtBook = $pdo->prepare('SELECT * FROM books LEFT JOIN book_authors ON books.id=book_authors.book_id WHERE books.id = :id');
$stmtBook->execute(['id' => $id]);
$book = $stmtBook->fetch();

$stmtAuthors = $pdo->query('SELECT * FROM authors');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20,400,0,0" />
    <title><?=$book['title'];?></title>
</head>
<body>

<form action="edit_form.php?id=<?=$id;?>" method="POST">
    <label for="title">Pealkiri:</label> <input type="text" name="title" value="<?=$book['title'];?>" style="width: 320px;">
    <br>
    <label for="title">Laos:</label> <input type="text" name="stock-saldo" value="<?=$book['stock_saldo'];?>">
    <br>
    <div style="font-weight: bold;">Autorid</div>
    <select name="author_id">
        <?php while ($author = $stmtAuthors->fetch()) { ?>
            <option value="<?=$author['id'];?>"><?=$author['first_name'];?> <?=$author['last_name'];?></option>
        <?php } ?>
    </select>
    <br>
    <input type="submit" value="Salvesta" name="edit">
</form>
</body>
</html>