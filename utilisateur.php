<?php
$servername = "localhost:3307";
$username = "nabil";
$password = "";
$dbName = "prof";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



if(isset($_GET['iduser'])){
	$id = $_GET['iduser'] ; 
  
	$update = "SELECT * FROM Allprof2 WHERE id = $id";

	$conn -> query($update);
  }



if(isset($_GET['iduser'])){
  $id = $_GET['iduser'] ; 

  $Delete = "DELETE FROM Allprof2 WHERE id = $id" ; 
  $conn->query($Delete);
  
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$nom =htmlspecialchars($_POST["Nom"]) ;
	$prenom =htmlspecialchars($_POST["Prenom"]) ;
  
	$nom = mysqli_real_escape_string($conn, $nom);
	$prenom = mysqli_real_escape_string($conn, $prenom);
  
	// Check if the name already exists
	$checkrows = "SELECT * FROM Allprof2 WHERE Nom = '$nom' AND Prenom='$prenom'";
	$result = mysqli_query($conn, $checkrows);
	$num_rows = mysqli_num_rows($result);
  
	if ($num_rows == 0) {
		// The name doesn't exist, proceed with the insertion
		$sql = "INSERT INTO Allprof2 (Nom, Prenom) VALUES ('$nom', '$prenom')";
  
		// Execute the query
		if ($conn->query($sql) === TRUE) {
			echo "<p style='color: green;'>$nom $prenom a été ajouté avec succès</p>";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	} else {
		echo "<p style='color: red;'>Le nom $nom $prenom a déjà existe dans la base de données.</p>";
	}
  }


$query = 'SELECT * FROM Allprof2';
$result = mysqli_query($conn , $query);

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Bootstrap CRUD Data Table for Database with Modal Form</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">

<link rel="stylesheet" href="style.css">
<style>
		
</style>
<script>
$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();
	
	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});
});
</script>
</head>

<body>
		
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar" class="active">
				<h1><a href="index.html" class="logo">M.</a></h1>
        <ul class="list-unstyled components mb-5">
          <li class="active">
            <a href="index.php"><span class="fa fa-home"></span> Home</a>
          </li>
          <li>
              <a href="utilisateur.php"><span class="fa fa-user"></span> About</a>
          </li>
          <li>
            <a href="#"><span class="fa fa-sticky-note"></span> Blog</a>
          </li>
          <li>
            <a href="#"><span class="fa fa-cogs"></span> Services</a>
          </li>
          <li>
            <a href="#"><span class="fa fa-paper-plane"></span> Contacts</a>
          </li>
        </ul>

        <div class="footer">
        	<p>
					  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib.com</a>
					</p>
        </div>
    	</nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">

            <button type="button" id="sidebarCollapse" class="btn btn-primary">
              <i class="fa fa-bars"></i>
              <span class="sr-only">Toggle Menu</span>
            </button>
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="nav navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Portfolio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>



		<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title bg-primary" >
				<div class="row">
					<div class="col-sm-6">
						<h2 id="SQLI">SQLI<b>i</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Ajouter</span></a>
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>
							ID
						</th>
						<th>Nom</th>
						<th>Prenom</th>
						<th>Email</th>
						<th>Edit/Supprimer</th>
					</tr>
				</thead>
				<tbody>
            <?php
            while($row = mysqli_fetch_assoc($result)){
            ?>
                <tr>
                    <td><?php echo $row['id']?></td>
                    <td><?php echo $row['Nom']?></td>
                    <td><?php echo $row['Prenom']?></td>
					<td></td>
                    <td><a href="update_page.php?iduser=<?php echo $row['id']?>" class="edit"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                    <a href="utilisateur.php?iduser=<?php echo $row['id'] ?>" class="delete"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a></td>

                </tr>
            <?php
            }
            ?>


        </tbody>
			</table>
			
		</div>
	</div>        
</div>
<!-- Edit Modal HTML -->
<div id="addEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
				<div class="modal-header">						
					<h4 class="modal-title">Add Employee</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Nom</label>
						<input type="text" name="Nom" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Prenom</label>
						<input type="text" name="Prenom" class="form-control" required>
					</div>
									
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-success" value="Add">
				</div>
			</form>
		</div>
	</div>
</div>

        

            
      </div>
		</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>

</body>
</html>