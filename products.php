<?php
  include_once 'products_crud.php';
  
  // Initialize the session
session_start();
 

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My Car Accessories Ordering System : Products
  </title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
   
  <?php include_once 'nav_bar.php'; ?>
 <?php
 $con=mysqli_connect("lrgs.ftsm.ukm.my","a167552","hugepurpledonkey","a167552");


$query="select * from tbl_products_a167552_pt2";
$execute=mysqli_query($con,$query);


?>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Bootstrap Modal with Dynamic Content</h4>
            </div>
            <div class="modal-body">
<h4 class="modal-title">Bootstrap Modal with Dynamic Content</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
      
    </div>
</div>
<div class="container-fluid">
  <div class="row">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
      <div class="page-header">
        <h2>Create New Product</h2>
      </div>
    <form action="products.php" method="post"class="form-horizontal">
     <div class="form-group">
          <label for="productid" class="col-sm-3 control-label">ID</label>
          <div class="col-sm-9">
      <input name="pid" placeholder="Product ID" id="productid" class="form-control" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_num']; ?>"required>
      </div>
        </div>
      <div class="form-group">
          <label for="productname" class="col-sm-3 control-label">Name</label>
          <div class="col-sm-9">
      <input name="name" placeholder="Product Name" id="productname" class="form-control" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_name']; ?>"required>  </div>
        </div>
        <div class="form-group">
          <label for="productprice" class="col-sm-3 control-label">Price</label>
          <div class="col-sm-9">
     <input name="price"placeholder="Product Price"id="productprice"class="form-control" type="number" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_price']; ?>"min="0.0" step="0.01" required> </div>
        </div>
      <div class="form-group">
          <label for="productbrand" class="col-sm-3 control-label">Brand</label>
          <div class="col-sm-9">
     <input name="brand"id="productbrand"placeholder="Product Brand"class="form-control" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_brand']; ?>"required> </div>
        </div>
      <div class="form-group">
          <label for="producttype" class="col-sm-3 control-label">Type</label>
          <div class="col-sm-9">

      <select name="type"class="form-control"id="producttype"required>
        <option value="">Please select</option>
        <option value="Engine Oil" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Engine Oil") echo "selected"; ?>>Engine Oil</option>
        <option value="Fluid" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Fluid") echo "selected"; ?>>Fluid</option>
        <option value="Car Care" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Car Care") echo "selected"; ?>>Car Care</option>
      </select>  
    </div>
        </div>
      <div class="form-group">
          <label for="productquantity" class="col-sm-3 control-label">Quantity</label>
          <div class="col-sm-9">
     <input name="quantity"placeholder="Product Quantity"id="productquantity"class="form-control" type="number" min="0" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_quantity']; ?>"required>  </div>
        </div>
      <div class="form-group">
          <label for="productvolume" class="col-sm-3 control-label">Volume</label>
          <div class="col-sm-9">
     <input name="volume"placeholder="Product Volume"id="productvolume"class="form-control" type="number" min="0" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_volume']; ?>"required>  </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">

      <?php if (isset($_GET['edit'])) { ?>
      <input type="hidden" name="oldpid" value="<?php echo $editrow['fld_product_num']; ?>">
      <button  class="btn btn-default" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>Update</button>
      <?php } else { ?>
      <button  class="btn btn-default" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Create</button>
      <?php } ?>
      <button  class="btn btn-default"type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span>Clear</button>
       </div>
      </div>
    </form>
    <hr>
     </div>
  </div>
    <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <div class="page-header">
        <h2>Products List</h2>
      </div>
      <table class="table table-striped table-bordered">
        <tr>
          <th>Product ID</th>
          <th>Name</th>
          <th>Price</th>
          <th>Brand</th>
          <th></th>
      </tr>
      <?php
      // Read
      $per_page = 5;
      if (isset($_GET["page"]))
        $page = $_GET["page"];
      else
        $page = 1;
      $start_from = ($page-1) * $per_page;
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          // $stmt = $conn->prepare("SELECT * FROM tbl_products_a167552_pt2");
        $stmt = $conn->prepare("select * from tbl_products_a167552_pt2 LIMIT $start_from, $per_page");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $readrow) {
      ?>   
      <tr>
        <td><?php echo $readrow['fld_product_num']; ?></td>
        <td><?php echo $readrow['fld_product_name']; ?></td>
        <td><?php echo $readrow['fld_product_price']; ?></td>
        <td><?php echo $readrow['fld_product_brand']; ?></td>
        <script>
// $('.openBtn').on('click',function(){
//     $('.modal-body').load('getContent.php?id=<?php echo $readrow['fld_product_num']; ?>',function(){
//         $('#myModal').modal({show:true});
//     });
// });

// $(document).ready(function(){
//     $('.openPopup').on('click',function(){
//         var dataURL = $(this).attr('data-href');
//         $('.modal-body').load(dataURL,function(){
//             $('#myModal').modal({show:true});
//         });
//     }); 
// });


</script>
        <td>
          <a class="btn btn-warning btn-xs openBtn" role="button" data-id="<?php echo $readrow['id]]fld_product_num'];?>">Details</a>
         <!--  <a href="products_details.php?pid=<?php echo $readrow['fld_product_num']; ?>" class="btn btn-warning btn-xs openBtn" role="button"> -->
          <a href="products.php?edit=<?php echo $readrow['fld_product_num']; ?>"class="btn btn-success btn-xs" role="button">Edit</a>
          <a href="products.php?delete=<?php echo $readrow['fld_product_num']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
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
            $stmt = $conn->prepare("SELECT * FROM tbl_products_a167552_pt2");
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
            <li><a href="products.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
          }
          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"products.php?page=$i\">$i</a></li>";
            else
              echo "<li><a href=\"products.php?page=$i\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="products.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
          <?php } ?>
        </ul>
      </nav>
    </div>
     </div>
</div>
<!-- Trigger the modal with a button -->
<!-- <button type="button" class="btn btn-success openBtn">Open Modal</button>
 -->
<!-- Modal -->

   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

    <script>

$('.openBtn').on('click',function(){
    $('.modal-body').load('getContent.php?id=<?php echo $readrow['fld_product_num']; ?>',function(){
        $('#myModal').modal({show:true});
    });
});
// $('.openBtn').on('click',function(){
//     $('.modal-body').load('getContent.php?id=P001',function(){
//         $('#myModal').modal({show:true});
//     });
// });
// $(document).ready(function(){
//     $('.openBtn').on('click', function(){
//         // Place the returned HTML into the selected element
//         $(this).find('.modal-body').load('getContent.php');
//     });
// });
// $(document).ready(function(){
//     $('.openPopup').on('click',function(){
//         var dataURL = $(this).attr('data-href');
//         $('.modal-body').load(dataURL,function(){
//             $('#myModal').modal({show:true});
//         });
//     }); 
// });
// $(document).ready(function(){
//     $(".openBtn").click(function(){
//         var id =$(this).data('id');
        
//         $.ajax({
//             url:"getContent.php",
//             method:"post",
//             data:{id:id},
//             success:function(response){
//                 $(".modal-body").html(response);
//                 $("#myModal").modal('show'); 
//             }
//         })
//     })
// })

</script>
</body>
</html>

