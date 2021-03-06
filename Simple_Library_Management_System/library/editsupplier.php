<?php

include 'includes/dbcon.php'; //$db_conn

include 'includes/header.php'; 
	
if(!isset($_SESSION['id'])) { // goes back to public home page if not signed in
	die(header("Location: index.php"));
}
$account = $_SESSION['account'];
if($account == "user") {
	die(header("Location: home.php"));
}
?>

<head>
	<title>Supplier</title>
</head>
<body>
<div id="main">
<div id="main-content">
	<!-- Breadcrumb -->
	<p><a href="home.php">Home</a> > <a href="supplier.php">Supplier Table</a> > Edit Mode</p> 
	<h2 id="padding">Supplier Table</h2>

	<form id="form" name="frmUser" method="post">
	<table id="table" style="margin-left: 5%">
	<tr> 
	<!-- table headings -->
		<th>Supplier Number</th>
		<th>Supplier Name</th>
		<th>Supplier Phone</th>
		<th>Supplier Email</th>
		<th>Suppier Fax</th>
		<th></th>
	</tr>
	<!-- While loop to fetch data from table -->
	<?php
		$qry = "SELECT * FROM supplier Order by Supp_Num ASC";
		$result = $db_conn->query($qry);

		$i=0;
		while($row = mysqli_fetch_array($result)) { 
		
		if($i%2==0) // styling purpose for even/odd rows
			$classname="evenRow"; 
		else
			$classname="oddRow";
		?>
		<form action="includes/supplier-process.php" method="post">
		<tr class="<?php if(isset($classname)) echo $classname;?>">
			<!-- <td><input type="checkbox" name="select[]" value="<?php echo $row["Supp_Num"]; ?>" ></td> -->
			<td>
			<input type="text" name="suppnum" value="<?php echo $row['Supp_Num']; ?>">
			</td>
			
			<td>
			<input type="text" name="suppname" value="<?php echo $row['Supp_Name']; ?>">
			</td>
			
			
			<td>
			<input type="text" name="supphone" value="<?php echo $row['Supp_Phone']; ?>">
			</td>
			
			<td>
			<input type="text" name="suppemail" value="<?php echo $row['Supp_Email']; ?>">
			</td>
			
			<td>
			<input type="text" name="suppfax" value="<?php echo $row['Supp_Fax']; ?>">
			</td>
			
			<td><!-- hidden unchanged PK to target the row to be updated -->
				<input type="hidden" name="hidden" value="<?php echo $row['Supp_Num']; ?>">
				<button type="submit" name="update">Update</button>
				<button type="submit" name="delete">Delete</button>
			</td>
		</tr>
		</form>
	<?php
		$i++;
	}
	?>
	<!-- Add new row -->
	<form action="includes/supplier-process.php" method="post">
	<tr>
		<td><input type="text" name="Supp_Num"></td>
		<td><input type="text" name="Supp_Name"></td>
		<td><input type="text" name="Supp_Phone"></td>
		<td><input type="text" name="Supp_Email"></td>
		<td><input type="text" name="Supp_Fax"></td>
		<td><button type="submit" name="add">Add</button></td>
	</tr>
	</form>
	</table>
	</form>
	<br/>
	<br/>
	<br/>
	<br/><br/>
</div>
</div>


<?php include "includes/footer.php"; ?>