<?php 
session_start();
include('header.php');
include 'Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();
?>
<title>SMR Invoice System</title>
<script src="js/invoice.js"></script>
<link href="css/style.css" rel="stylesheet">
<?php include('container.php');?>
	<div class="container">		
	  <h2 class="title mt-5">SMR Invoice System</h2>
    <!-- <form action="search.php" method="GET">
    <input type="text" name="query" placeholder="Search...">
    <button type="submit">Search</button>
    </form> -->
    <!-- <form action="<?php $_SERVER['PHP_SELF'] ?>" method="GET"> Search Here <input type="text" name="search_text"> <input type="submit" value="Search"></form> -->
    <!-- <form action="search.php" method="GET">
        <input type="text" name="query" placeholder="Search..." required>
        <button type="submit">Search</button>
    </form> -->
  <!-- <input type="text" name="" id="myInput" placeholder="Search Here..." onkeyup="searchFun()">  -->
  <form method="post" action="search.php">
<label>Search</label>
<input type="text" name="search">
<input type="submit" name="submit">
	
</form>
  <br>
    

	  <?php include('menu.php');?>			  
      <table id="data-table" class="table table-condensed table-hover table-striped">
        
        <thead>
          <tr>
            <th>Invoice No.</th>
            <th>Customer Name</th>
            <th>Create Date</th>
            <th>Total</th>
            <th>Print</th>
            <th>Edit</th>
            <th>Delete</th>
            <th>Due</th>
          </tr>
        </thead>
        <?php		
	    	$invoiceList = $invoice->getInvoiceList();
        foreach($invoiceList as $invoiceDetails){
			$invoiceDate = date("d/M/Y, H:i:s", strtotime($invoiceDetails["order_date"]));
            echo '
              <tr>
                <td>'.$invoiceDetails["order_id"].'</td>
                <td>'.$invoiceDetails["order_receiver_name"].'</td>
                <td>'.$invoiceDate.'</td>
                <td>₹'.$invoiceDetails["order_total_after_tax"].'</td>
                <td><a href="print_invoice.php?invoice_id='.$invoiceDetails["order_id"].'" title="Print Invoice"><button class="btn btn-primary btn-sm"><i class="fa fa-print"></i></button></a></td>
                <td><a href="edit_invoice.php?update_id='.$invoiceDetails["order_id"].'"  title="Edit Invoice"><button class="btn btn-success btn-sm"><i class="fa fa-edit"></i></button></a></td>
                <td><a href="delete-invoice.php?order_id='.$invoiceDetails['order_id'].'" title="Delete Invoice"><button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a></td>
                <td><a href="due_invoice.php?order_id='.$invoiceDetails['order_id'].'" title="Due Invoice"><button class="btn btn-warning btn-sm"><i class="fa fa-sign-in"></i></button></a></td>
                
                
              </tr>
            ';
        }       
        ?>
      </table>
      <!DOCTYPE html>
<html>
<head>
	<title>Search Bar using PHP</title>
</head>
<body>


<form method="post">
<label>Search</label>
<input type="text" name="search">
<input type="submit" name="submit">
	
</form>


</body>
</html>


<?php


$con = new PDO("mysql:host=localhost;dbname=simpleinvoicephp",'root','');


if (isset($_POST["submit"])) {
	$str = $_POST["search"];
	$sth = $con->prepare("SELECT * FROM `invoice_order` WHERE = '$order_id'");


	$sth->setFetchMode(PDO:: FETCH_OBJ);
	$sth -> execute();


	if($row = $sth->fetch())
	{
		?>
		<br><br><br>
		<table>
			<tr>
				<th>Name</th>
				<th>Description</th>
			</tr>
			<tr>
				<td><?php echo $row->Name; ?></td>
				<td><?php echo $row->Description;?></td>
			</tr>


		</table>
<?php 
	}
		
		
		else{
			echo "Name Does not exist";
		}




}


?>

      
      <script>
        const searchFun = () =>{
          let filter =document.getElementById('order_receiver_name').value.toUpperCase();
          let order_receiver_name = document.getElementById('order_receiver_name');
          let tr = order_receiver_name.getElementsByTagName('tr');
          for( var i=0; i<tr.length; i++){
            let td = tr[i].getElementsByTagName('td')[0];

            if(td){
              let textValue = td.textContent || td.innerHTML;

              if(textValue.toUpperCase().indexOf(filter) > -1){
                tr[i].style.display = "";
              }else{
                tr[i].style.display = "none";
              }
            }
          }
        }

      </script>
</div>	
<?php include('footer.php');?>