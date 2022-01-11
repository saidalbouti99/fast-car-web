<?php 
// include_once 'database.php';
if(!empty($_GET['id'])){ 
    // Database configuration 
    $dbHost = 'lrgs.ftsm.ukm.my'; 
    $dbUsername = 'a167552'; 
    $dbPassword = 'hugepurpledonkey'; 
    $dbName = 'a167552'; 
     
    // Create connection and select database 
    $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName); 
     
    if ($db->connect_error) { 
        die("Unable to connect database: " . $db->connect_error); 
    } 
     
    // Get content from the database 
    $query = $db->query("SELECT * FROM tbl_products_a167552_pt2 WHERE fld_product_num = {$_GET['id']}");

     
    if(!empty($query) && $query->num_rows > 0){ 
        $cmsData = $query->fetch_assoc(); 
        echo '<h5>'.$cmsData["fld_product_num"].'</h5>'; 
        echo '<p>'.$cmsData['fld_product_name'].'</p>'; 
        echo 'Me';

        
    }else{ 
        echo 'Content noti found....'; 
    } 
}else{ 
    echo 'Content not found....'; 
} 


// if(isset($_GET["id"]))

// {
//     try{
//  $query = "SELECT * FROM tbl_products_a167552_pt2 WHERE fld_product_num = '".$_GET["id"]."'";

//  $statement = $connect->prepare($query);
//  $statement->execute();
//  $result = $statement->fetchAll();
//  $output = '<div class="row">';
//  foreach($result as $row)
//  {
//   $images = '';
//   if($row["images"] != '')
//   {
//    $images = '<img src="images/'.$row["images"].'" class="img-responsive img-thumbnail" />';
//   }
//   else
//   {
//    $images = '<img src="https://www.gravatar.com/avatar/38ed5967302ec60ff4417826c24feef6?s=80&d=mm&r=g" class="img-responsive img-thumbnail" />';
//   }
//   $output .= '
//   <div class="col-md-3">
//    <br />
//    '.$images.'
//   </div>
//   <div class="col-md-9">
//    <br />
//    <p><label>Name :&nbsp;</label>'.$row["fld_product_num"].'</p>
//    <p><label>Address :&nbsp;</label>'.$row["address"].'</p>
//    <p><label>Gender :&nbsp;</label>'.$row["gender"].'</p>
//    <p><label>Designation :&nbsp;</label>'.$row["designation"].'</p>
//    <p><label>Age :&nbsp;</label>'.$row["age"].' years</p>
//   </div>
//   </div><br />
//   ';
//  }
//  echo $output;
// }
// catch(PDOException $e)
//   {
//       echo "Error: " . $e->getMessage();
//   }
// }
// include_once 'database.php';
 
// $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
// $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 
//     try {
//       // $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
//       // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//         $stmt = $conn->prepare("SELECT * FROM tbl_products_a167552_pt2 WHERE fld_product_num = :id");
//       $stmt->bindParam(':id', $pid, PDO::PARAM_STR);
//       $id = $_GET['id'];
//       $stmt->execute();


//       echo $readrow['fld_product_nanm'];
//       }
//     catch(PDOException $e) {
//         echo "Error: " . $e->getMessage();
//     }
//     $conn = null;

// require_once('database.php');
//  $con=mysqli_connect("lrgs.ftsm.ukm.my","a167552","hugepurpledonkey","a167552");
// $id=$_POST['id'];
 
// $query='select * from tbl_products_a167552_pt2 where fld_product_num="'.$id.'"';
// $execute=mysqli_query($con,$query);
 
// $result=mysqli_fetch_assoc($execute);
// $num=$result['fld_product_num'];
// $name=$result['fld_product_name'];
// $description=$result['body'];
 
// $response='<form>
//                 <div class="form-group">
//                     <label>Created Date</label>
//                     <input type="text" class="form-control" value="'.$num.'" readonly>
//                 </div>
//                 <div class="form-group">
//                     <label>Author Name</label>
//                     <input type="text" class="form-control" value="'.$name.'" readonly>
//                 </div>
//                 <div class="form-group">
//                     <label>Description</label>
//                     <textarea rows="4" cols="50" class="form-control" readonly>'.$description.'</textarea>
//                 </div>
//             </form>';
 
// echo $response;
 

?>