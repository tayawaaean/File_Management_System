
<?php
include '../connection/verifier.php';?>
<?php include '../connection/connection.php';?>
<?php include '../connection/manage_employee.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style-personal-info.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/user_css.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <title>Admin Panel</title>
</head>

<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="../img/BNHS Logo.png" alt="">
            </div>

            <span class="logo_name">Bingao NHS</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
              <li>
                <a href="index.php">
                  <i class="uil uil-estate"></i>
                  <span class="link-name">Dashboard</span>
                </a>
              </li>
              <li>
              <a href="all_files.php">
                  <i class="material-symbols-outlined">save</i>
                  <span class="link-name">All Files</span>
                </a>
              </li>
              <li>
                <a href="user.php">
                  <i class="material-symbols-outlined">person</i>
                  <span class="link-name">Employees</span>
                </a>
              </li>
            </ul>
    
            <ul class="logout-mode">
              <li>
                <a href="logout.php">
                  <i class="uil uil-signout"></i>
                  <span class="link-name">Logout</span>
                </a>
              </li>
    
              <li class="mode">
                <a href="#">
                  <i class="uil uil-moon"></i>
                  <span class="link-name">Dark Mode</span>
                </a>
    
                <div class="mode-toggle">
                  <span class="switch"></span>
                </div>
              </li>
            </ul>
          </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search anything...">
            </div>
            
            <img src="../img/Catiwa, Kenric.jpeg" alt="">
        </div>
        <div class="container">
        <div class="row justify-content-start mt-4" >
                <div class="col-md-6">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Pending Requests</h5>
                            <box-icon type='solid' name='notification'></box-icon>
                            <p class="card-text">Total requests: <?php echo $conn->query("SELECT COUNT(*) FROM pending_requests")->fetch_row()[0]; ?></p>
                            <!-- Button to trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pendingRequestsModal">
                                View All Pending Requests
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h2>User List</h2>

        <!-- Table for displaying users -->
        <div class="table-responsive scrollable-table" style="max-height: 400px; overflow-y: auto;">
            <table class="table" id="userTable">
                <thead class="thead-light">
                    <tr>
                        <th>Profile Picture</th>
                        <th>ID#</th>
                        <th>Name</th>
                        <th>User Type</th>
                        <th>Contact Number</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
              <!-- Table structure within the form for deleting users -->
              <form action="../connection/manage_employee.php" method="POST">
                <tbody id="tableBody">
                    <?php
                    $sql = "SELECT * FROM users";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td><img src='../img/Catiwa, Kenric.jpeg' alt='Profile Picture' style='width: 50px; height: 50px;'></td>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['user_type'] . "</td>";
                            echo "<td>" . $row['phone'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>";
                            echo " <button type='button' class='btn btn-primary btn-sm edit-btn' data-toggle='modal' data-target='#editModal' data-user-id='" . $row['id'] . "'>Edit</button>";
                            echo "<button type='submit' class='btn btn-danger btn-sm' name='delete_user' onclick='return confirmDelete();'>Delete</button>";
                            echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No users found.</td></tr>";
                    }
                    ?>
                </tbody>
            </form>

            </table>
         
        </div>
       

    <div class="modal fade" id="pendingRequestsModal" tabindex="-1" role="dialog" aria-labelledby="pendingRequestsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pendingRequestsModalLabel">Pending Requests</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <h2>Pending Registration Requests</h2>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>User ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="pendingRequestsTable">
                                    <?php
                                    $result = $conn->query("SELECT * FROM pending_requests");
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr id='requestRow_" . $row['id'] . "'>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['username'] . "</td>";
                                        echo "<td>";
                                        echo "<button class='btn btn-success btn-sm mr-2' onclick='approveRequest(" . $row['id'] . ")'>Accept</button>";
                                        echo "<button class='btn btn-danger btn-sm' onclick='denyRequest(" . $row['id'] . ")'>Deny</button>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!--Edit Modal-->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModallabel">Edit Modal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form>
                            <div class="form-group">
                                <label for="edit_id">ID</label>
                                <input type="text" class="form-control" id="edit_id" placeholder="Enter ID" readonly>
                            </div>
                            <div class="form-group">
                                <label for="edit_name">Name</label>
                                <input type="text" class="form-control" id="edit_name" placeholder="Enter Name">
                            </div>
                            <div class="form-group">
                                <label for="edit_job_title">User Type</label>
                                <select class="form-control" id="edit_job_title">
                                    <option value="1">Admin</option>
                                    <option value="2">Employee</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="edit_phone">Phone</label>
                                <input type="text" class="form-control" id="edit_phone" placeholder="Enter Phone">
                            </div>
                            <div class="form-group">
                                <label for="edit_email">Email</label>
                                <input type="email" class="form-control" id="edit_email" placeholder="Enter Email">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" id="saveChangesBtn">Save Changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    </div></section>
                                
        
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script src="/js/user_js.js"></script>
        <script src="../js/requests.js"></script>
        <script src="../js/edit.js"></script>
        <script src="../js/update_user.js"></script>
</html>