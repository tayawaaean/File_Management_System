<?php include '../connection/connection.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

	<link rel="stylesheet" href="../css/style3.css">

	<title>COE-Voting-System</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs'> <img class= "logo-img" src = "../Img/COE.png" width=60px height=60px></i>
			<span class="text">Voting System</span>
		</a>
		<ul class="side-menu top">
			<li>
				<a href="index.php">
					<i class='bx bxs-home' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="Election-Title.php">
					<i class='bx bxs-group' ></i>
					<span class="text">Election Title</span>
				</a>
			</li>
			<li>
				<a href="about_Us.php" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">About Us</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">

		</ul>
	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu'></i>
			<form action="#">
				<div class="form-input">
					<input type="hidden" placeholder="Search here">
				</div>
			</form>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<!-- candidates-->
			<div class="container-Dashboard" id="Dashboard">
				<div class="head-title">
					<div class="left">
						<h1>Candidates</h1><hr>
					</div>
				</div>

				<div class = "candidates">
					<button class = "btn_addCandidates" id="pop-upButton">ADD FOLDERS</button>
					<!--<button class = "btn_prtCandidates"> PRINT</button> -->
				</div>
                <div class = "candidates">
					<button class = "btn_addCandidates2" id="pop-upButton2"> ADD CANDIDATE</button>
					<!--<button class = "btn_prtCandidates"> PRINT</button> -->
				</div>
			</div>
			<div class="table-info">
				<table class= "content-table">
					<thead>
						<tr>
							<th>Profile</th>
							<th>Student Number</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Course</th>
							<th>Office</th>
							<th>Tagline</th>
							<th>Tools</th>
						</tr>
					</thead>
					<tbody>
						<tr>
						</tr>
					</tbody>
				</table>
			</div>
		</main>
	</section>

	<div class="pop-up">
	<div class="close-btn">&times;</div>
	<div class="form">
		<form method="POST" enctype="multipart/form-data" onsubmit="return confirm('Are you sure you want to add the candidate? All votes will be reseted if you continue')">
			<h2>Add Folder</h2>

			<div class="form-elements">
                <label for= "Folder Name">Folder Name</label>
                <input type="text" id= "Folder_Name" name="Folder_Name" required>
			</div>
			<div class="form-elements">
				<label for="photo">Photo</label>
				<input type="file" id="photo" name="image">
			</div>
			<div class="form-elements">
				<label for="platform">Description</label>
				<textarea class="form-control" id="platform" name="platform" rows="5" cols="60"></textarea>
			</div>
			<div class="form-elements">
				<button class="Submit" name="add">Submit</button>
			</div>
		</form>
        
	</div>
    <div class="pop-up">
	<div class="close-btn">&times;</div>
	<div class="form">
		<form method="POST" enctype="multipart/form-data" onsubmit="return confirm('Are you sure you want to add the candidate? All votes will be reseted if you continue')">
			<h2>Add Documents</h2>

            <div>
                <label for="Folder">Folder</label>
                <select class="form-elements" id="Folder" name="Folder">
                    <option>- Select -</option>
                    <option>Temporary</option>
                    <option>Current</option>
                    <option>Permanent</option>
                </select>
            </div>
			<div class="form-elements">
				<label for="photo">Photo</label>
				<input type="file" id="photo" name="image">
			</div>
			<div class="form-elements">
				<label for="platform">Description</label>
				<textarea class="form-control" id="platform" name="platform" rows="5" cols="60"></textarea>
			</div>
			<div class="form-elements">
				<button class="Submit" name="add">Submit</button>
			</div>
		</form>
	</div>
</div>
<div class = "pop-up-2">
		<div class= "close-btn">&times;</div>
		<div class= "form">
		</div>
	</div>
	
	<script src="../js/documents.js"></script>
	 	<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
	</script>


</body>
</html>