<?php
  require_once("perpage.php");  
  require_once("dbcontroller.php");
  $db_handle = new DBController();
  
  $name = "";
  $code = "";
  
  $queryCondition = "";
  if(!empty($_POST["search"])) {
    foreach($_POST["search"] as $k=>$v){
      if(!empty($v)) {

        $queryCases = array("fld_product_name","fld_product_type");
        if(in_array($k,$queryCases)) {
          if(!empty($queryCondition)) {
            $queryCondition .= " AND ";
          } else {
            $queryCondition .= " WHERE ";
          }
        }
        switch($k) {
          case "fld_product_name":
            $name = $v;
            $queryCondition .= "fld_product_name LIKE '" . $v . "%'";
            break;
          case "fld_product_type":
            $code = $v;
            $queryCondition .= "fld_product_type LIKE '" . $v . "%'";
            break;
        }
      }
    }
  }
  $orderby = " ORDER BY fld_product_num asc"; 
  $sql = "SELECT * FROM tbl_products_a167552_pt2 " . $queryCondition;
  $href = 'search.php';          
    
  $perPage = 10; 
  $page = 1;
  if(isset($_POST['page'])){
    $page = $_POST['page'];
  }
  $start = ($page-1)*$perPage;
  if($start < 0) $start = 0;
    
  $query =  $sql . $orderby .  " limit " . $start . "," . $perPage; 
  $result = $db_handle->runQuery($query);
  
  if(!empty($result)) {
    $result["perpage"] = showperpage($sql, $perPage, $href);
  }
?>
<html>
  <head>
  <title>PHP CRUD with Search and Pagination</title>
  <link href="style.css" type="text/css" rel="stylesheet" />
  </head>
  <body>
    <h2>PHP CRUD with Search and Pagination</h2>
    <div style="text-align:right;margin:20px 0px 10px;">
    <a id="btnAddAction" href="add.php">Add New</a>
    </div>
    <div id="toys-grid">      
      <form name="frmSearch" method="post" action="search.php">
      <div class="search-box">
      <p><input type="text" placeholder="Name" name="search[fld_product_name]" class="demoInputBox" value="<?php echo $name; ?>"  />
        <input type="text" placeholder="Type" name="search[fld_product_type]" class="demoInputBox" value="<?php echo $code; ?>" />
        <input type="submit" name="go" class="btnSearch" value="Search"><input type="reset" class="btnSearch" value="Reset" onclick="window.location='search.php'"></p>
      </div>
      
      <table cellpadding="10" cellspacing="1">
        <thead>
          <tr>
            <th><strong>ID</strong></th>
          <th><strong>Name</strong></th>
          <th><strong>Price</strong></th>          
          <th><strong>Brand</strong></th>
          <th><strong>Type</strong></th>
          <th><strong>Quantity</strong></th>
          <th><strong>Action</strong></th>
          
          </tr>
        </thead>
        <tbody>
          <?php
          if(!empty($result)) {
            foreach($result as $k=>$v) {
              if(is_numeric($k)) {
          ?>
          <tr>
            <td><?php echo $result[$k]["fld_product_num"]; ?></td>
          <td><?php echo $result[$k]["fld_product_name"]; ?></td>
          <td><?php echo $result[$k]["fld_product_price"]; ?></td>
          <td><?php echo $result[$k]["fld_product_brand"]; ?></td>
          <td><?php echo $result[$k]["fld_product_type"]; ?></td>
          <td><?php echo $result[$k]["fld_product_quantity"]; ?></td> 
          <td>
          <a class="btnEditAction" href="edit.php?id=<?php echo $result[$k]["id"]; ?>">Edit</a> <a class="btnDeleteAction" href="delete.php?action=delete&id=<?php echo $result[$k]["id"]; ?>">Delete</a>
          </td>
          </tr>
          <?php
              }
             }
                    }
          if(isset($result["perpage"])) {
          ?>
          <tr>
          <td colspan="6" align=right> <?php echo $result["perpage"]; ?></td>
          </tr>
          <?php } ?>
        <tbody>
      </table>
      </form> 
    </div>
  </body>
</html>