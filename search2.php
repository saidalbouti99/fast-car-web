<?php
	$conn = mysqli_connect("lrgs.ftsm.ukm.my", "a167552", "hugepurpledonkey", "a167552");	
	$with_any_one_of = "";
	$with_the_exact_of = "";
	$without = "";
	$starts_with = "";
	$search_in = "";
	$advance_search_submit = "";
	
	$queryCondition = "";
	if(!empty($_POST["search"])) {
		$advance_search_submit = $_POST["advance_search_submit"];
		foreach($_POST["search"] as $k=>$v){
			if(!empty($v)) {

				$queryCases = array("with_any_one_of","with_the_exact_of","without","starts_with");
				if(in_array($k,$queryCases)) {
					if(!empty($queryCondition)) {
						$queryCondition .= " AND ";
					} else {
						$queryCondition .= " WHERE ";
					}
				}
				switch($k) {
					case "with_any_one_of":
						$with_any_one_of = $v;
						$wordsAry = explode(" ", $v);
						$wordsCount = count($wordsAry);
						for($i=0;$i<$wordsCount;$i++) {
							if(!empty($_POST["search"]["search_in"])) {
								$queryCondition .= $_POST["search"]["search_in"] . " LIKE '%" . $wordsAry[$i] . "%'";
							} else {
								$queryCondition .= "fld_product_name LIKE '" . $wordsAry[$i] . "%' OR fld_product_brand LIKE '" . $wordsAry[$i] . "%'";
							}
							if($i!=$wordsCount-1) {
								$queryCondition .= " OR ";
							}
						}
						break;
					case "with_the_exact_of":
						$with_the_exact_of = $v;
						if(!empty($_POST["search"]["search_in"])) {
							$queryCondition .= $_POST["search"]["search_in"] . " LIKE '%" . $v . "%'";
						} else {
							$queryCondition .= "fld_product_name LIKE '%" . $v . "%' OR fld_product_brand LIKE '%" . $v . "%'";
						}
						break;
					case "without":
						$without = $v;
						if(!empty($_POST["search"]["search_in"])) {
							$queryCondition .= $_POST["search"]["search_in"] . " NOT LIKE '%" . $v . "%'";
						} else {
							$queryCondition .= "fld_product_name NOT LIKE '%" . $v . "%' AND fld_product_brand NOT LIKE '%" . $v . "%'";
						}
						break;
					case "starts_with":
						$starts_with = $v;
						if(!empty($_POST["search"]["search_in"])) {
							$queryCondition .= $_POST["search"]["search_in"] . " LIKE '" . $v . "%'";
						} else {
							$queryCondition .= "fld_product_name LIKE '" . $v . "%' OR fld_product_brand LIKE '" . $v . "%'";
						}
						break;
					case "search_in":
						$search_in = $_POST["search"]["search_in"];
						break;
				}
			}
		}
	}
	$orderby = " ORDER BY fld_product_num asc"; 
	$sql = "SELECT * FROM tbl_products_a167552_pt2 " . $queryCondition;
	$result = mysqli_query($conn,$sql);
	
?>
<html>
	<head>
	<title>Advanced Search using PHP</title>
	<style>
		body{
			width: 600px;
			font-family: "Segoe UI",Optima,Helvetica,Arial,sans-serif;
			line-height: 25px;
		}
		.search-box {
			padding: 30px;
			background-color:#C8EEFD;
		}
		.search-label{
			margin:2px;
		}
		.demoInputBox {    
			padding: 10px;
			border: 0;
			border-radius: 4px;
			margin: 0px 5px 15px;
			width: 250px;
		}
		.btnSearch{    
			padding: 10px;
			background: #84D2A7;
			border: 0;
			border-radius: 4px;
			margin: 0px 5px;
			color: #FFF;
			width: 150px;
		}
		#advance_search_link {
			color: #001FFF;
			cursor: pointer;
		}
		.result-description{
			margin: 5px 0px 15px;
		}
	</style>
	<script>
		function showHideAdvanceSearch() {
			if(document.getElementById("advanced-search-box").style.display=="none") {
				document.getElementById("advanced-search-box").style.display = "block";
				document.getElementById("advance_search_submit").value= "1";
			} else {
				document.getElementById("advanced-search-box").style.display = "none";
				document.getElementById("with_the_exact_of").value= "";
				document.getElementById("without").value= "";
				document.getElementById("starts_with").value= "";
				document.getElementById("search_in").value= "";
				document.getElementById("advance_search_submit").value= "";
			}
		}
	</script>
	</head>
	<body>
		<h2>Advanced Search using PHP</h2>
    <div>      
			<form name="frmSearch" method="post" action="search2.php">
			<input type="hidden" id="advance_search_submit" name="advance_search_submit" value="<?php echo $advance_search_submit; ?>">
			<div class="search-box">
				<label class="search-label">With Any One of the Words:</label>
				<div>
					<input type="text" name="search[with_any_one_of]" class="demoInputBox" value="<?php echo $with_any_one_of; ?>"	/>
					<span id="advance_search_link" onClick="showHideAdvanceSearch()">Advance Search</span>
				</div>				
				<div id="advanced-search-box" <?php if(empty($advance_search_submit)) { ?>style="display:none;"<?php } ?>>
					<label class="search-label">With the Exact String:</label>
					<div>
						<input type="text" name="search[with_the_exact_of]" id="with_the_exact_of" class="demoInputBox" value="<?php echo $with_the_exact_of; ?>"	/>
					</div>
					<label class="search-label">Without:</label>
					<div>
						<input type="text" name="search[without]" id="without" class="demoInputBox" value="<?php echo $without; ?>"	/>
					</div>
					<label class="search-label">Starts With:</label>
					<div>
						<input type="text" name="search[starts_with]" id="starts_with" class="demoInputBox" value="<?php echo $starts_with; ?>"	/>
					</div>
					<label class="search-label">Search Keywords in:</label>
					<div>
						<select name="search[search_in]" id="search_in" class="demoInputBox">
							<option value="">Select Column</option>
							<option value="title" <?php if($search_in=="title") { echo "selected"; } ?>>Title</option>
							<option value="description" <?php if($search_in=="description") { echo "selected"; } ?>>Description</option>
						</select>
					</div>
				</div>
				
				<div>
					<input type="submit" name="go" class="btnSearch" value="Search">
				</div>
			</div>
			</form>	
			<?php while($row = mysqli_fetch_assoc($result)) { ?>
			<div>
				<!-- <div><strong><?php echo $row["fld_product_name"]; ?></strong></div>
				<div class="result-description"><?php echo $row["fld_product_brand"]; ?></div>
			</div> -->

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
            <td><?php echo $row["fld_product_num"]; ?></td>
          <td><?php echo $row["fld_product_name"]; ?></td>
          <td><?php echo $row["fld_product_price"]; ?></td>
          <td><?php echo $row["fld_product_brand"]; ?></td>
          <td><?php echo $row["fld_product_type"]; ?></td>
          <td><?php echo $row["fld_product_quantity"]; ?></td> 
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
			<?php } ?>
		</div>
	</body>
</html>