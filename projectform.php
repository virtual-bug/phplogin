 <?php 
 include('server.php') ;

if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  ?>
<!DOCTYPE html>
<html>
<head>
  <title>project form </title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>project</h2>
        
  </div> 
	<link rel="stylesheet" type="text/css" href="style.css">
    <form method="post" action="projectform.php">
  	<?php include('errors.php'); ?>
        <div class="input-group">
  	  <label>ProjectID</label>
  	  <input type="int" name="proid" value="<?php echo $proid; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Projectname</label>
  	  <input type="text" name="proname" value="<?php echo $proname; ?>">
  	</div>
  	<div class="input-group">
  	  <label>project_details</label>
          <input type="text" name="details" value="<?php echo $details; ?>">
  	</div>
  	<div class="input-group">
  	  <label>start_time</label>
          <input type="time" name="time1">
  	</div>
  	<div class="input-group">
  	  <label>end_time</label>
  	  <input type="time" name="time2">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="new_project">new project</button>
  	</div>
        <p>
  		cancle <a href="index.php">cancle</a>
  	</p>
  	 
  </form>
</body>
</html>