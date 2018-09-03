<?php session_start();
 $page_title = "Написать комент";
 require_once('header.php'); ?>



<?php

  require('vars.php');




  if (isset($_POST['submit'])) {
     // Connect to the database
          $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    // Grab the post data from the POST
          $topic_id = $_GET['topic_id'];
     $name = $_SESSION['user_id'];
    $post = mysqli_real_escape_string($dbc, trim($_POST['post']));
    
      if (!empty($name) && !empty($post) ) {
        
        
          // Write the data to the database
          $query = "INSERT INTO posts ( user_id , posts_text , topic_id ) VALUES ('$name', '$post' , '$topic_id' )";
          mysqli_query($dbc, $query);

          // Confirm success with the user
          echo '<h4>Комментария оставлен!</h4>';
          echo '<p><strong>Автор:</strong> ' .  $_SESSION['username'] . '<br />';
          echo '<strong>Комментарий:</strong> ' . $post . '</p>';
         

          echo '<h5><a href="viewtopics.php?topic_id=' . $topic_id . ' "><<Вернуться </a></h5>';

          // Clear the post data to clear the form
          $name = "";
          $post = "";
          

          mysqli_close($dbc);
         }  
       
        
      
      else {
      echo '<p class="error">Please enter all of the information to add your high post.</p>';
      }
 }
?>
<?php
 if (!empty($_SESSION['user_id']) && !isset($_POST['submit'])) {
    echo '<p class="error">' . $error_msg . '</p>';
?>
	
    <form  method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    
    <p> <?php echo $_SESSION['username']; ?></p>
    <label for="post">Text</label>
    <textarea type="text" id="post" name="post" value="<?php if (!empty($post)) echo $post; ?>" > </textarea> <br />
    <hr />
    <input type="submit" value="Add" name="submit" />
  </form>

  
<?php
  }
  
?>



