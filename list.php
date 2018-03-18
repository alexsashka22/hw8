<?php
require_once "functions.php";

if (!isAuthorizedUser()) {
    echo "Вы не авторизованы.";
    http_response_code(403);
    die;
}
else {
    echo '<p>Здравствуйте, '.$_SESSION['user']['username'].'.</p>';
}
$list = glob('tests/*.json');
// echo "<pre>";
// var_dump($list);
// exit;

if (isset($_POST['testdel'])) {
  foreach ($list as $i => $value) {
    if ($value == 'tests/' . $_POST['testdel'] . '.json') {
        unset ($list[$i]);
        sort($list);
        echo "Тест ".$_POST['testdel']." удален.";
    }
  }
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Выбор теста</title>
    <style media="screen">
      h1, ol, body>a {
      margin: 10px auto;
      padding: 0 25% 0;
      }
      li {
        margin: 10px 40px;
      }
    </style>
  </head>
  <body>
    <h1>Тесты на выбор</h1>
    <ol>
        <?php foreach ($list as $key => $test) {$name = basename($test, ".json");?>
        <li><a href="test.php?testid=<?= $key+1 ?>"><?= $name ?></a></li>
      <?php } ?>
    </ol>
    <?php if (isAuthorizedAdmin()): ?>
    <a href="admin.php">К форме загрузки тестов</a>
    <p>Удаление теста:</p>
    <form method="POST">
        <input type="text" name="testdel" placeholder="Имя удаляемого теста">
        <input type="submit">
    </form>
    <?php endif; ?>
    <p><a href="logout.php">Выход</a></p>
  </body>
</html>
