<?php $page_title = "Регистрация";
 require_once('header.php'); ?>
<?php
  require_once('vars.php');
  

  // Connect to the database
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  if (isset($_POST['submit'])) {
    // Grab the profile data from the POST
    $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
    $password1 = mysqli_real_escape_string($dbc, trim($_POST['password1']));
    $password2 = mysqli_real_escape_string($dbc, trim($_POST['password2']));

    if (!empty($username) && !empty($password1) && !empty($password2) && ($password1 == $password2)) {
      // Make sure someone isn't already registered using this username
      $query = "SELECT * FROM users WHERE user_name = '$username'";
      $data = mysqli_query($dbc, $query);
      if (mysqli_num_rows($data) == 0) {
        // The username is unique, so insert the data into the database
        $query = "INSERT INTO users (user_name, user_password) VALUES ('$username', SHA('$password1'))";
        mysqli_query($dbc, $query);

        // Confirm success with the user
        echo '<p>Регистрация прошла успешно.  <a href="login.php">Войдите в свой аккаунт</a>.</p>';

        mysqli_close($dbc);
        exit();
      }
      else {
        // An account already exists for this username, so display an error message
        echo '<p class="error">Такой аккаунт уже существует.</p>';
        $username = "";
      }
    }
    else {
      echo '<p class="error">Введите пароли, они должны совпадать.</p>';
    }
  }

  mysqli_close($dbc);
?>

  <p>Для регистрации введите имя и пароль.</p>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
      <legend>Регистрация</legend>
      <label for="username">Имя:</label><br>
      <input type="text" id="username" name="username" value="<?php if (!empty($username)) echo $username; ?>" /><br />
      <label for="password1">Пароль:</label><br>
      <input type="password" id="password1" name="password1" /><br />
      <label for="password2">Подтвердить пароль:</label><br>
      <input type="password" id="password2" name="password2" /><br />
    </fieldset>
    <input type="submit" class="submit_btn" value="Создать аккаунт" name="submit" />
  </form>
<?php  require_once('footer.php'); ?>