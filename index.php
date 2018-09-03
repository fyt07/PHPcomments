<?php session_start(); ?>       
<?php $page_title = "Главная";
 require_once('header.php'); ?>

<?php
 
  require_once('vars.php');

  // Connect to the database 
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
  
  echo '<div class="main">';
  // Retrieve the user data from MySQL
  $query = "SELECT * FROM  users  INNER JOIN topic USING (user_id)";
  $data = mysqli_query($dbc, $query);

  // Loop through the array of user data, formatting it as HTML
  
  while ($row = mysqli_fetch_array($data)) {  
    echo 
      '<div class="topicM">      
         <a class="topic_title" href="viewtopics.php?topic_id=' . $row['topic_id'] .'">' 
         . $row['topic_name'] . '</a><br/>
         <p>Автор:<a href="#" > ' . $row['user_name'] . '</a></p>
        <p>' . $row['topic_description'] . '</p> 
      </div> ';  
  }
 
  echo '</div>';

  mysqli_close($dbc);

?>

 <?php  require_once('footer.php'); ?>
