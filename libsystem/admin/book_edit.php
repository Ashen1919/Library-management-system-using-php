<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$isbn = $_POST['isbn'];
		$title = $_POST['title'];
		$category = $_POST['category'];
		$author = $_POST['author'];
		$publisher = $_POST['publisher'];
		$pub_date = $_POST['pub_date'];

		// Update books table in libsystem database
		$sql = "UPDATE books SET isbn = '$isbn', title = '$title', category_id = '$category', author = '$author', publisher = '$publisher', publish_date = '$pub_date' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Book updated successfully in libsystem';

			// Update books table in saegislibrary database
			$sql_sa = "UPDATE books SET isbn = '$isbn', title = '$title', category_id = '$category', author = '$author', publisher = '$publisher', publish_date = '$pub_date' WHERE id = '$id'";
			if($sa_conn->query($sql_sa)){
				$_SESSION['success'] .= ' and saegislibrary';
			}
			else{
				$_SESSION['error'] = 'Failed to update book in saegislibrary: ' . $sa_conn->error;
			}
		}
		else{
			$_SESSION['error'] = 'Failed to update book in libsystem: ' . $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:book.php');
?>
