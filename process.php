<?php 
	include_once('config.php');
	session_start();

	$id = 0;
	$update = false;
	$btnSearchClicked = false;
	$selectedAtt = "";
	$searchInput = "";
	$pupil_firstName = "";
	$pupil_lastName = "";
	$pupil_age = "";
	$pupil_contact = "";

	//gawa ka naman ng bago.
	//dugay kana waya gacode ah
	
	
	if(isset($_POST['btnSave'])){
		$pupil_firstName = $_POST['pupil_firstName'];
		$pupil_lastName = $_POST['pupil_lastName'];
		$pupil_age = $_POST['pupil_age'];
		$pupil_contact = $_POST['pupil_contact'];

		$conn->query("INSERT into pupils(pupil_firstName, pupil_lastName, pupil_age, pupil_contact) 
						VALUES ('$pupil_firstName','$pupil_lastName','$pupil_age','$pupil_contact')")
						or die($conn->error);

		$_SESSION['message'] = "Record has been saved.";
		$_SESSION['msg_type'] = "success";

		header("location:index.php");
	}

	if(isset($_GET['delete_id'])){
		$id = $_GET['delete_id'];
		$conn->query("DELETE FROM pupils WHERE pupil_id = $id;") or die($conn->error);

		$_SESSION['message'] = "Record has been deleted.";
		$_SESSION['msg_type'] = "danger";

		header("location:index.php");
	}

	if(isset($_GET['edit'])){
		$update = true;
		$id = $_GET['edit'];
		$result = $conn->query("SELECT * FROM pupils WHERE pupil_id = $id") or die($conn->error());

		if(count($result) > 0){
			$row = $result->fetch_array();
			$pupil_firstName = $row['pupil_firstName'];
			$pupil_lastName = $row['pupil_lastName'];
			$pupil_age = $row['pupil_age'];
			$pupil_contact = $row['pupil_contact'];
		}
	}

	if(isset($_POST['btnUpdate'])){
		$id = $_POST['id'];
		$pupil_firstName = $_POST['pupil_firstName'];
		$pupil_lastName = $_POST['pupil_lastName'];
		$pupil_age = $_POST['pupil_age'];
		$pupil_contact = $_POST['pupil_contact'];

		$conn->query("UPDATE pupils SET pupil_firstName = '$pupil_firstName', pupil_lastName='$pupil_lastName', 
					pupil_age = '$pupil_age', pupil_contact = '$pupil_contact' WHERE pupil_id='$id';") 
					or die($conn->error());

		$_SESSION['message'] = "Record update successful.";
		$_SESSION['msg_type'] = "warning";

		header('location:index.php');
	}
?>
