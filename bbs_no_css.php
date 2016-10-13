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

  $sql = 'SELECT * FROM `posts` ORDER BY created DESC';

  $stmt = $dbh->prepare($sql);
  $stmt->execute();

  $posts = array();

  while (1) {
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($rec == false) {
      break;
    }    
    $posts[] = $rec;
  }

  $dbh = null;
}
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
    <!-- <?php //echo $posts[40]['nickname']; ?>
    <?php //echo $posts[40]['comment']; ?> -->
    <ul>
      <?php foreach ($posts as $post_each) {
        echo '<li>';
        echo $post_each['nickname'] . '';
        echo $post_each['comment'] . '';
        
        $created = strtotime($post_each['created']);
        $created = date('Y/m/d' ,$created);
        echo $created;
        echo '</li>';
      } ?>

    </ul>

</body>
</html>