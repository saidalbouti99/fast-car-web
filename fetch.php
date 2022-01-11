<?php

//fetch.php

$connect = new PDO("mysql:host=lrgs.ftsm.ukm.my;dbname=a167552", "a167552", "hugepurpledonkey");

$output = '';

$query = '';

if(isset($_POST["query"]))
{
 $search = str_replace(",", "|", $_POST["query"]);
 $query = "
 SELECT * FROM tbl_products_a167552_pt2 
 WHERE fld_product_name REGEXP '".$search."' 
 OR fld_product_price REGEXP '".$search."' 
 OR fld_product_type REGEXP '".$search."' 
 OR fld_product_brand REGEXP '".$search."' 
 OR fld_product_quantity REGEXP '".$search."'
 ";
}
else
{
 $query = "
 SELECT * FROM tbl_products_a167552_pt2 ORDER BY fld_product_num
 ";
	// echo 'Please Input Keyword';
}

$statement = $connect->prepare($query);
$statement->execute();

while($row = $statement->fetch(PDO::FETCH_ASSOC))
{
 $data[] = $row;
}

echo json_encode($data);

?>
<!-- <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label for="staffusername" class="col-sm-3 control-label">Username</label>
                <div class="col-sm-9">
                <input type="text" placeholder="Staff Username"name="username" class="form-control" value="<?php echo $username; ?>" >
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
              </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label for="staffpassword" class="col-sm-3 control-label">Password</label>
                <div class="col-sm-9">
                <input type="password"  name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label class="col-sm-3 control-label">Confirm Password</label>
                <div class="col-sm-9">
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            </div> -->