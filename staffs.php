<?php
  include_once 'staffs_crud.php';


  // Initialize the session
session_start();

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  
  <title>My Car Accessories Ordering System : Staffs</title>
  <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    
  <?php include_once 'nav_bar.php'; ?>
 
<div class="container-fluid">
  <div class="row">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
      <div class="page-header">
        <h2>Add New Staff</h2>
      </div>
    <form action="staffs.php" method="post" class="form-horizontal">
     <div class="form-group">
          <label for="staffid" class="col-sm-3 control-label">ID</label>
          <div class="col-sm-9">
       <input name="sid"class="form-control"id="staffid" placeholder="Staff ID" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_num']; ?>"required> </div>
        </div>
      <div class="form-group">
          <label for="stafffname" class="col-sm-3 control-label">First Name</label>
          <div class="col-sm-9">
     <input name="fname"class="form-control" id="stafffname" placeholder="Staff First Name"type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_fname']; ?>"required> </div>
        </div>
      <div class="form-group">
          <label for="stafflname" class="col-sm-3 control-label">Last Name</label>
          <div class="col-sm-9">
      <input name="lname"class="form-control" id="stafflname" placeholder="Staff Last Name"type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_lname']; ?>"required> </div>
        </div>    
        <div class="form-group">
          <label for="staffgender" class="col-sm-3 control-label">Gender</label>
          <div class="col-sm-9">
          <div class="radio">
            <label>
          <input name="gender" id="staffgender"type="radio" value="Male" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_gender']=="Male") echo "checked"; ?> required> Male
          </label>

          </div>
          <div class="radio">
            <label>
      <input name="gender" type="radio"id="staffgender" value="Female" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_gender']=="Female") echo "checked"; ?>> Female </label>
            </div>
          </div>
      </div>
        <div class="form-group">
          <label for="staffphone" class="col-sm-3 control-label">Phone</label>
          <div class="col-sm-9">
     <input name="phone" class="form-control"id="staffphone" pattern="0\d{2}-\d{7}" placeholder="0##-#######"type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_phone']; ?>"required> </div>
         
      </div>
        <div class="form-group">
          <label for="staffemail" class="col-sm-3 control-label">Email</label>
          <div class="col-sm-9">
       <input name="email"class="form-control" id="staffemail"placeholder="Staff Email Address"type="email" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_email']; ?>"required> </div>
        </div>
        <div class="form-group">
          <label for="userlevel" class="col-sm-3 control-label">User Level</label>
          <div class="col-sm-9">

      <select name="level"class="form-control"id="userlevel"required>
        <option value="">Please select</option>
        <option value="admin" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_level']=="admin") echo "selected"; ?>>Admin</option>
        <option value="staff" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_level']=="staff") echo "selected"; ?>>Staff</option>
        <option value="supervisor" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_level']=="supervisor") echo "selected"; ?>>Supervisor</option>
      </select>  
    </div>
        </div>
        <div class="form-group" >
                <label for="staffusername" class="col-sm-3 control-label">Username</label>
                <div class="col-sm-9">
                <input type="text" placeholder="Staff Username"name="username" class="form-control"  value="<?php if(isset($_GET['edit'])) echo $editrow['username']; ?>" required>
               <!--  <span class="help-block"><?php echo $username_err; ?></span> -->
            </div>    
              </div>
            <div class="form-group">
                <label for="staffpassword" class="col-sm-3 control-label">Password</label>
                <div class="col-sm-9" required>
                <input type="password" id="pass" name="password" class="form-control" value="<?php if(isset($_GET['edit'])) echo $editrow['password']; ?>" readonly="false">
              

            </div>
            </div>
            <!-- <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label class="col-sm-3 control-label">Confirm Password</label>
                <div class="col-sm-9">
                <input type="password" name="confirm_password" class="form-control" required>
                            </div>
            </div> -->
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
      <?php if (isset($_GET['edit'])) { ?>
      <input type="hidden" name="oldsid" value="<?php echo $editrow['fld_staff_num']; ?>">
      <button  class="btn btn-default" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>Update</button>
      <?php } else { ?>
      <button  class="btn btn-default" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Create</button>
      <?php } ?>
      <button  class="btn btn-default" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span>Clear</button>
       </div>
      </div>
    </form>
     </div>
      </div>
   <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <div class="page-header">
        <h2>Staff List</h2>
      </div>
      <table class="table table-striped table-bordered">
      <tr>
        <th>Staff ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Gender</th>
        <th>Phone Number</th>
        <th>Email Address</th>
        <th></th>
      </tr>
    <?php
      // Read
    $per_page = 2;
      if (isset($_GET["page"]))
        $page = $_GET["page"];
      else
        $page = 1;
      $start_from = ($page-1) * $per_page;
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a167552_pt2 LIMIT $start_from, $per_page");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $readrow) {
      ?>
      <tr>
        <td><?php echo $readrow['fld_staff_num']; ?></td>
        <td><?php echo $readrow['fld_staff_fname']; ?></td>
        <td><?php echo $readrow['fld_staff_lname']; ?></td>
        <td><?php echo $readrow['fld_staff_gender']; ?></td>
        <td><?php echo $readrow['fld_staff_phone']; ?></td>
        <td><?php echo $readrow['fld_staff_email']; ?></td>
        <td>
          <a href="staffs.php?edit=<?php echo $readrow['fld_staff_num']; ?>"class="btn btn-success btn-xs btnEdit" role="button">Edit</a>
          <a href="staffs.php?delete=<?php echo $readrow['fld_staff_num']; ?>" onclick="return confirm('Are you sure to delete?');"class="btn btn-danger btn-xs" role="button">Delete</a>
        </td>
      </tr>
      <?php
      }
     $conn = null;
      ?>
    </table>
    </div>
   </div>
    <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <nav>
          <ul class="pagination">
          <?php
          try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a167552_pt2");
            $stmt->execute();
            $result = $stmt->fetchAll();
            $total_records = count($result);
          }
          catch(PDOException $e){
                echo "Error: " . $e->getMessage();
          }
          $total_pages = ceil($total_records / $per_page);
          ?>
          <?php if ($page==1) { ?>
            <li class="disabled"><span aria-hidden="true">«</span></li>
          <?php } else { ?>
            <li><a href="staffs.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
          }
          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"staffs.php?page=$i\">$i</a></li>";
            else
              echo "<li><a href=\"staffs.php?page=$i\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="staffs.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
          <?php } ?>
        </ul>
      </nav>
    </div>
  </div>
   </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script >
    document.getElementById('.btnEdit').onclick = function() {
    document.getElementById('pass').readOnly = true;
};
</script>
</body>
</html>