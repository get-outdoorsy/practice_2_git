<!DOCTYPE html>
<html>
<head>
	<title>School</title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" type="text/css" href="css/style.css">
	  <script type="text/javascript" src="js/behavior.js"></script>
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
	
	<?php include('process.php'); ?>

	<?php 
	if(isset($_SESSION['message'])): ?>
	<div class="alert alert-<?=$_SESSION['msg_type'] ?>" id="goHide">
	<?php 
	echo $_SESSION['message']; 
	unset($_SESSION['message']);
	?>
	</div>
	<?php endif ?>

	<div class="container">
	<form action="process.php" method="post">
		<input type="hidden" name="id" value="<?php echo $id; ?>">
		<fieldset class="container">
		<legend>Pupil Credentials</legend>
		<div class="form-group">
			<label>First Name</label>
			<input id="fname" class="form-control" type="text" name="pupil_firstName" placeholder="Enter first name" autocomplete="off" 
			value="<?php echo $pupil_firstName; ?>">
		</div>
		<div class="form-group">
			<label>Last Name</label>
			<input id="lname" class="form-control" type="text" name="pupil_lastName" placeholder="Enter last name" autocomplete="off"
			value="<?php echo $pupil_lastName; ?>">
		</div>
		<div class="form-group">
			<label>Age</label>
			<input id="age" class="form-control" type="number" name="pupil_age" placeholder="Enter age" autocomplete="off"
			value="<?php echo $pupil_age; ?>">
		</div>
		<div class="form-group">
			<label>Contact Number</label>
			<input id="contact" class="form-control" type="number" name="pupil_contact" placeholder="Enter contact number" autocomplete="off"
			value="<?php echo $pupil_contact; ?>">
		</div>
		<div class="form-group d-flex justify-content-end">
			<?php if($update == true): ?>
				<input id="changeButton" class="btn btn-primary" type="submit" name="btnUpdate" value="Update">
			<?php else: ?>
				<input class="btn btn-success" type="submit" name="btnSave" value="Save">
			<?php endif ?>

			<input class="btn btn-danger" type="button" value="Reset" style="margin-left: 10px;" onclick="clearEntry();">
		</div>
		</fieldset>
	</form>
	</div>

	<div class="container">
		<form action="index.php" method="post">
		<div class="d-flex justify-content-end">
			<div class="p-2">
				<select name="attributes" class="browser-default custom-select">
					<option value="" disabled selected="">Option</option>
					<option value="pupil_id">Id</option>
					<option value="pupil_firstName">First name</option>
					<option value="pupil_lastName">Last name</option>
					<option value="pupil_age">Age</option>
					<option value="pupil_contact">Contact</option>
				</select>
			</div>
			<div class="p-2" style="width: 80%;"><input class="form-control" type="text" name="txtSearch" placeholder="Search" autocomplete="off"></div>
			<div class="p-2"><input class="btn btn-light" type="submit" name="btnSearch" value="Search"></div>
		</div>
	
		</form>
	</div>
	<div class="container">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Pupil ID</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Age</th>
					<th>Contact Number</th>
					<th>Action</th>
				</tr>
			</thead>
			<?php 
			if(isset($_POST['btnSearch'])){
				$btnSearchClicked = true;		
				$selectedAtt = $_POST['attributes'];
				$searchInput = $_POST['txtSearch'];
				
				$retrieveQuery = "SELECT * FROM pupils WHERE $selectedAtt LIKE '%$txtSearch%'" or die($conn->error);
			}else{
				$retrieveQuery = "SELECT * FROM pupils" or die($conn->error);
			}
			
			$result = $conn->query($retrieveQuery);
			while($row = $result->fetch_assoc()): ?>
			<tr>
				<td><?php echo $row['pupil_id']; ?></td>
				<td><?php echo $row['pupil_firstName']; ?></td>
				<td><?php echo $row['pupil_lastName']; ?></td>
				<td><?php echo $row['pupil_age']; ?></td>
				<td><?php echo $row['pupil_contact']; ?></td>	
				<td><a href="index.php?edit=<?php echo $row['pupil_id']; ?>" class="btn btn-info">Edit</a>	
					<a href="process.php?delete_id=<?php echo $row['pupil_id']; ?>" class="btn btn-danger">Delete</a>
				</td>
			</tr>
		<?php endwhile ?>
		</table>
	</div>

	<?php $conn->close(); ?>
	<!--GUMANA KA GIT!->>
</body>
</html>