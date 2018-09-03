<?php
if ($_SERVER['PHP_SELF']=="/index.php")
{
if (isset($_SESSION['username'])) {
    echo '<a href="sendtopic.php">Создать тему</a> | ';
    echo '<a href="logout.php">Выход (' . $_SESSION['username'] . ')</a>';
  }
  else {
    echo '<a href="login.php">Войти</a> | ';
    echo '<a href="signin.php">Регистрация</a>';
  }
}else{
  if (isset($_SESSION['username'])) {
    echo '<a href="index.php">Главная</a> |  ';
    echo '<a href="sendtopic.php">Создать тему</a> | ';
    echo '<a href="logout.php">Выход (' . $_SESSION['username'] . ')</a>';
  }
  else {
    echo '<a href="index.php">Главная</a> | ';
    echo '<a href="login.php">Войти</a> | ';
    echo '<a href="signin.php">Регистрация</a>';
  }
}
?>