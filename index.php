<?php
  $server="us-cdbr-east-02.cleardb.com";
  $username="b7f874d5e366ad";
  $password="f2f44323";
  $db="heroku_a5ff6984e7bd9fd";
  $con=mysqli_connect($server,$username,$password,$db);
 ?>
<html lang="en">
<head>
  <title>Index page</title>
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="style.css" >
<link href="favicon.png" rel="icon">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
  <div class="jumbotron1">
    <h2 style="text-align:center;color:white;text-shadow:2px 2px 5px black;">PHP PROJECT</h2>
  </div>
  <?php
  if(isset($_GET['edit_id'])){
    $sql= "select * from php1 WHERE sno='$_GET[edit_id]' ";
    $run= mysqli_query($con,$sql);
    //while loop used for displayin values on 'edit user' section
    while($rows2=mysqli_fetch_assoc($run)){
      $sno=$rows2['sno'];
      $Name=$rows2['Name'];
      $Marks=$rows2['Marks'];
      $numb=$rows2['numb'];
    }
    ?>
    <form   method="post" class="col-md-4">
      <h2 style="color:gray;text-shadow:1px 1px 3px black;">EDIT USER</h2>
      <div class="form-group">
        <label>sno</label>
        <input type="text" name="edit_sno" value="<?php echo $sno; ?>" class="form-control" required>
      </div>
      <div class="form-group">
        <label>Name</label>
        <input type="text" name="edit_Name" value="<?php echo $Name; ?>" class="form-control" required>
      </div>
      <div class="form-group">
        <label>Marks</label>
        <input type="text" name="edit_Marks" value="<?php echo $Marks; ?>" class="form-control" required>
      </div>
      <div class="form-group">
        <label>numb</label>
        <input type="text" name="edit_numb" value="<?php echo $numb; ?>" class="form-control" required>
      </div>
      <div class="form-group">
        <input type="submit" name="edit_submit_button" class="btn btn-success">
      </div>
    </form>
    <?php
  }
  else{
    ?>
    <form   method="post" class="col-md-4">
      <h2 style="color:gray;text-shadow:1px 1px 3px black;">INSERT NEW USER</h2>
      <div class="form-group">
        <label>sno</label>
        <input type="text" name="sno" class="form-control" required>
      </div>
      <div class="form-group">
        <label>Name</label>
        <input type="text" name="Name" class="form-control" required>
      </div>
      <div class="form-group">
        <label>Marks</label>
        <input type="text" name="Marks" class="form-control" required>
      </div>
      <div class="form-group">
        <label>numb</label>
        <input type="text" name="numb" class="form-control" required>
      </div>
      <div class="form-group">
        <input type="submit" name="submit_button" class="btn btn-success">
      </div>
    </form>
    <?php
  }
   ?>

<?php
//for showing result everytime after inserting,deleting,editing data
$sql= "select * from php1";
$run= mysqli_query($con,$sql);
  echo "
  <table class='table' >
    <thead>
      <tr>
        <th>sno</th>
        <th>Name</th>
        <th>Marks</th>
        <th>numb</th>
        <th>edit</th>
        <th>delete</th>
      </tr>
    </thead>
    <tbody>";
    while($rows=mysqli_fetch_assoc($run)){
      echo"
        <tr>
          <td>$rows[sno]</td>
          <td>$rows[Name]</td>
          <td>$rows[Marks]</td>
          <td>$rows[numb]</td>
          <td><a href='index.php?edit_id=$rows[sno]' class='btn btn-primary'>edit</a></td>
          <td><a href='index.php?del_id=$rows[sno]' class='btn btn-danger'>delete</a></td>
        </tr>";
      }
        echo"
          </tbody>
          </table>";

 ?>

</body>

</html>
<?php
//for inserting data into the table
if(isset($_POST['submit_button'])){
  //here $sno ... are local variables
  echo $sno=mysqli_real_escape_string($con,strip_tags($_POST['sno']));
  echo $Name=mysqli_real_escape_string($con,strip_tags($_POST['Name']));
  echo $Marks=mysqli_real_escape_string($con,strip_tags($_POST['Marks']));
  echo $numb=mysqli_real_escape_string($con,strip_tags($_POST['numb']));
  $ins_sql="INSERT INTO php1(sno,Name,Marks,numb) values('$sno','$Name','$Marks','$numb')";
  if(mysqli_query($con,$ins_sql)){?>
    <script>window.location="index.php";</script>
    <?php
  }
}
//for deleting specific row
if(isset($_GET['del_id'])){
  $del_sql="DELETE FROM php1 where sno='$_GET[del_id]'";
  if(mysqli_query($con,$del_sql)){?>
    <script>window.location="index.php";</script>
    <?php
}
}?>
<?php
//for updating data into the table
if(isset($_POST['edit_submit_button'])){
  echo $edit_sno=mysqli_real_escape_string($con,strip_tags($_POST['edit_sno']));
  echo $edit_Name=mysqli_real_escape_string($con,strip_tags($_POST['edit_Name']));
  echo $edit_Marks=mysqli_real_escape_string($con,strip_tags($_POST['edit_Marks']));
  echo $edit_numb=mysqli_real_escape_string($con,strip_tags($_POST['edit_numb']));
    $update_sql="UPDATE php1  set sno='$edit_sno',Name='$edit_Name',Marks='$edit_Marks',numb='$edit_numb' WHERE sno='$_GET[edit_id]'";
    if(mysqli_query($con,$update_sql)){?>
      <script>window.location="index.php";</script>
        <?php
        }
      }
      ?>
