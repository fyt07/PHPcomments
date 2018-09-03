<?php session_start(); ?>       
<?php require_once('vars.php');
$topic_id = $_GET['topic_id'];
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 $query_tn = "SELECT  topic_name , topic_description FROM topic WHERE topic_id = '$topic_id' ";
  $data_tn = mysqli_query($dbc, $query_tn);
  $row_tn = mysqli_fetch_array($data_tn);
  $topic_description=$row_tn['topic_description'];
  $topic_title = $row_tn['topic_name'];
 $page_title = $topic_title;
 require_once('header.php'); ?>

<?php
 
  require_once('vars.php');

  $query = "SELECT * FROM posts INNER JOIN users USING (user_id)  INNER JOIN topic USING (topic_id) WHERE topic_id = '$topic_id' ";
  $data = mysqli_query($dbc, $query);

	echo '<h5 class="descritpion_h">' . $topic_description .'</h5>';
  echo '<div class="main">';
  while ($row = mysqli_fetch_array($data)) {
  
      echo 
      '<div class="topicM">
      		 <a class="name">' . $row['user_name'] . '</a>  
           <p class="post">' . $row['posts_text'] . '</p>  
      </div>';

   
  } 
  echo '</table>';
  ?>
  <?php 
  if (!empty($_SESSION['user_id'])){
    ?>
  </div>
  <form  method="post" action="sendpost.php?topic_id= <?php echo $topic_id?> ">
    <fieldset>
     <legend> <?php echo $_SESSION['username']; ?></legend>
    <label for="post">Коментарий</label><br>
    <textarea type="text" id="post" name="post" value="<?php if (!empty($post)) echo $post; ?>" > </textarea> <br />
    
    <input type="submit" class="submit_btn btn_comm" value="Отправить" name="submit" />
    </fieldset>
  </form>  
<?php
} 
  ?>
 <?php  require_once('footer.php'); ?>