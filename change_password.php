<?php
include("session.php");
$exp_fetched = mysqli_query($con, "SELECT * FROM expenses WHERE user_id = '$userid'");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Expendo - Change Password</title>

<!-- Bootstrap Icon CSS -->
<link href="css/bootstrap-icons-1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Feather JS for Icons -->
    <script src="js/feather.min.js"></script>

    <!-- Favicon -->
  <link rel="icon" href="favicon/favicon.ico" type="image/x-icon">

</head>

<body>

    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="border-right" id="sidebar-wrapper">
            <div class="user">
                <img class="img img-fluid rounded-circle" src="<?php echo $userprofile ?>" width="120">
                <h5><?php echo $username ?></h5>
                <p><?php echo $useremail ?></p>
            </div>
            <div class="sidebar-heading">Management</div>
            <div class="list-group list-group-flush">
                <a href="index.php" class="list-group-item list-group-item-action "><span data-feather="home"></span> Dashboard</a>
                <a href="add_expense.php" class="list-group-item list-group-item-action "><span data-feather="plus-square"></span> Add Expenses</a>
                <a href="manage_expense.php" class="list-group-item list-group-item-action "><span data-feather="dollar-sign"></span> Manage Expenses</a>
                <a href="add_profit.php" class="list-group-item list-group-item-action"><span data-feather="plus-circle"></span> Add profit</a>
                <a href="manage_profit.php" class="list-group-item list-group-item-action"><span data-feather="anchor"></span> Manage profit</a>
            </div>

            <div class="sidebar-heading">Tools </div>
            <a href="currency_con.php" class="list-group-item list-group-item-action"><span class="bi bi-cash-coin"></span> Currency-Converter</a>
            <a href="calculator.php" class="list-group-item list-group-item-action"><span class="bi bi-calculator"></span> Calculator</a>
            <div class="sidebar-heading">Settings </div>
            <div class="list-group list-group-flush">
                <a href="profile.php" class="list-group-item list-group-item-action sidebar-active "><span data-feather="user"></span> Profile</a>
                <a href="logout.php" class="list-group-item list-group-item-action "><span data-feather="power"></span> Logout</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-light  border-bottom">


                <button class="toggler" type="button" id="menu-toggle" aria-expanded="false">
                    <span data-feather="menu"></span>
                </button>
                <h3 style="text-align: center; font-weight: bold; font-size: 1.3em; position: relative; top: 0.2em; left: 0.2em;"> SSBSS </h3>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                       
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img img-fluid rounded-circle" src="<?php echo $userprofile ?>" width="45" height="45">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Your Profile</a>
                                <a class="dropdown-item" href="#">Edit Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container-fluid">
                <h5>Hi <?php echo $firstname ?>! You can change your password here</h5>
                <div class="row mt-3">
                    <div class="col-md">
                        <form class="form" action="" method="post" id="registrationForm" autocomplete="off">
                            <div class="form-group">
                                <div class="col">
                                    <label for="password">
                                        Enter Current Password
                                    </label>
                                    <input type="password" class="form-control" name="curr_password" id="password" placeholder="New Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col">
                                    <label for="password">
                                        Enter New Password
                                    </label>
                                    <input type="password" class="form-control" name="new_password" id="password" placeholder="New Password">
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="col">
                                    <label for="password2">
                                        Confirm New Password
                                    </label>
                                    <input type="password" class="form-control" name="confirm_new_password" id="confirm_password" placeholder="Confirm Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <br>
                                    <button class="btn btn-block btn-primary" name="updatepassword" type="submit">Update Password</button>
                                </div>
                            </div>
                        </form>
                        <!--/tab-content-->

                    </div>
                    <!--/col-9-->
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap core JavaScript -->
    <script src="js/jquery.slim.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <!-- Menu Toggle Script -->
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
    <script>
        feather.replace()
    </script>

<!-- Footer -->
<footer class="bg-light text-dark py-4 mt-5">
  <hr style="background-color: #2F4F4F; height: 0.02em; width: 100%;">
  <div class="container">
    <div class="row">
      <!-- About Section -->
      <div class="col-md-4">
        <h5 class="font-weight-bold">About</h5>
        <p>
          Expense Manager helps you track your expenses and profits with ease. Monitor your financial health and achieve your goals.
        </p>
      </div>

      <!-- Quick Links Section -->
      <div class="col-md-4">
        <h5 class="font-weight-bold">Quick Links</h5>
        <ul class="list-unstyled">
          <li><a href="index.php" class="text-dark text-decoration-none">Dashboard</a></li>
          <li><a href="add_expense.php" class="text-dark text-decoration-none">Add Expenses</a></li>
          <li><a href="add_profit.php" class="text-dark text-decoration-none">Add Profit</a></li>
          <li><a href="profile.php" class="text-dark text-decoration-none">Your Profile</a></li>
        </ul>
      </div>

      <!-- Contact Section -->
      <div class="col-md-4">
        <h5 class="font-weight-bold">Contact</h5>
        <p>Email: <a href="mailto:techronash@gmail.com" class="text-dark">techronash@gmail.com</a></p>
        <p>Phone: +977-9824374447</p>
        <p>Address: LETANG-3,MORANG</p>
      </div>
    </div>

    <hr class="bg-dark">
    <div class="text-center">
      <p class="m-0">© <?php echo date('Y'); ?> Expense Manager. All Rights Reserved.</p>
    </div>
  </div>
</footer>

</body>

</html>