<?php session_start();
 $page_title = "Создать тему";
 require_once('header.php'); ?>



<?php

  require('vars.php');


  if (isset($_POST['submit'])) {
     // Connect to the database
          $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    // Grab the post data from the POST
     $name = $_SESSION['user_id'];
     $topic_description = mysqli_real_escape_string($dbc, trim($_POST['topic_description']));
    $topic_name = mysqli_real_escape_string($dbc, trim($_POST['topic_name']));
    
      if (!empty($name) && !empty($topic_description) ) {               
          // Write the data to the database         
          $query = "INSERT INTO topic ( topic_name , topic_description , user_id  ) 
          VALUES ('$topic_name' , '$topic_description' , '$name'  )";
          mysqli_query($dbc, $query);

          // Confirm success with the user
          echo '<h4>Пост готов!</h4>';
          echo '<p><strong>Автор:</strong> ' . $_SESSION['username'] . '<br />';
          echo '<h5>Тема: ' . $topic_name . '</h5> ';
          echo '<strong>Описание:</strong> ' . $topic_description . '</p></br>';
          echo '</br><h5 class="back"><a  href="index.php"><< Вернутся на главную</a></h5> ';
          // Clear the post data to clear the form
          $name = "";
          $post = "";          
          mysqli_close($dbc);
         }         
      else {
      echo '<p class="error">Введите тему и описание.</p>';
      }
 }
?>
<?php
 if (!empty($_SESSION['user_id']) && !isset($_POST['submit'])) {
    echo '<p class="error">' . $error_msg . '</p>';?>	
    <form  method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>   
    <legend><?php echo $_SESSION['username']; ?></legend>
    <label for="username">Тема</label><br>
      <input type="text" name="topic_name" value="<?php if (!empty($topic_name)) echo $topic_name; ?>" /><br />
    <label for="topic_description">Описание</label><br>
    <textarea type="text" id="topic_description" name="topic_description" value="<?php if (!empty($topic_description)) echo $topic_description; ?>" > </textarea> <br />
   </fieldset> 
    <input type="submit" class="submit_btn add" value="Добавить" name="submit" />
  </form>

  
<?php
  }
?>
<?php  require_once('footer.php'); ?>