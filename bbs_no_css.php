<?php
  // ここにDBに登録する処理を記述する
  $dsn = 'mysql:dbname=oneline_bbs;host=localhost';
  $user = 'root';
  $password='';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->query('SET NAMES utf8');

  
if (!empty($_POST)){

  $nickname = ($_POST['nickname']);
  $comment = ($_POST['comment']);

  $sql = "INSERT INTO `posts`(`id`, `nickname`, `comment`, `created`) VALUES (null,'$nickname','$comment',now())";
  $stmt = $dbh->prepare($sql);
  $stmt->execute();
 }


  $dbh = null;  


  $dsn = 'mysql:dbname=oneline_bbs;host=localhost';
  $user = 'root';
  $password = '';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->query('SET NAMES utf8');

  $sql = 'SELECT * FROM `posts` ORDER BY created DESC';

  $stmt = $dbh->prepare($sql);
  $stmt->execute();

  while (1) {
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($rec == false) {
      break;
    }
    echo $rec['id'] . '<br>';
    echo $rec['nickname'] . '<br>';
    echo $rec['comment'] . '<br>';
    echo $rec['created'] . '<br>';
    echo '<hr>';
  }

$dbh = null;

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>セブ掲示版</title>
</head>
<body>
    <form method="post" action="">
      <p><input type="text" name="nickname" placeholder="nickname"></p>
      <p><textarea type="text" name="comment" placeholder="comment"></textarea></p>
      <p><button type="submit">つぶやく</button></p>

      
      
    </form>
    <!-- ここにニックネーム、つぶやいた内容、日付を表示する -->
    <p><?php echo $nickname; ?></p>


</body>
</html>