<?php
include("session.php");

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM profit WHERE user_id='$userid' AND profit_id='$id'";
    if (mysqli_query($con, $sql)) {
        header('Location: manage_profit.php');
        exit();
    } else {
        echo "ERROR: Could not execute $sql. " . mysqli_error($con);
    }
}
?>
<?php
  $exp_category_dc = mysqli_query($con, "SELECT expensecategory FROM expenses WHERE user_id = '$userid' GROUP BY expensecategory");
  $exp_amt_dc = mysqli_query($con, "SELECT SUM(expense) FROM expenses WHERE user_id = '$userid' GROUP BY expensecategory");

  $exp_date_line = mysqli_query($con, "SELECT expensedate FROM expenses WHERE user_id = '$userid' GROUP BY expensedate");
  $exp_amt_line = mysqli_query($con, "SELECT SUM(expense) FROM expenses WHERE user_id = '$userid' GROUP BY expensedate");

  // Current month's total expenses
$current_month_expenses_query = "SELECT SUM(expense) AS total FROM expenses WHERE user_id = '$userid' AND MONTH(expensedate) = MONTH(CURDATE()) AND YEAR(expensedate) = YEAR(CURDATE())";
$current_month_result = mysqli_query($con, $current_month_expenses_query);
$current_month_total = mysqli_fetch_assoc($current_month_result)['total'] ?? 0;

// Previous month's total expenses
$previous_month_expenses_query = "SELECT SUM(expense) AS total FROM expenses WHERE user_id = '$userid' AND MONTH(expensedate) = MONTH(CURDATE() - INTERVAL 1 MONTH) AND YEAR(expensedate) = YEAR(CURDATE() - INTERVAL 1 MONTH)";
$previous_month_result = mysqli_query($con, $previous_month_expenses_query);
$previous_month_total = mysqli_fetch_assoc($previous_month_result)['total'] ?? 0;


//another code for profit
// Get profit category-wise data
$profit_category_query = mysqli_query($con, "SELECT profitcategory FROM profit WHERE user_id = '$userid' GROUP BY profitcategory");
$profit_amt_category = mysqli_query($con, "SELECT SUM(profit) FROM profit WHERE user_id = '$userid' GROUP BY profitcategory");

// Get profit date-wise data
$profit_date_line_query = mysqli_query($con, "SELECT profitdate FROM profit WHERE user_id = '$userid' GROUP BY profitdate");
$profit_amt_line_query = mysqli_query($con, "SELECT SUM(profit) FROM profit WHERE user_id = '$userid' GROUP BY profitdate");

// Current month's total profits
$current_month_profit_query = "SELECT SUM(profit) AS total FROM profit WHERE user_id = '$userid' AND MONTH(profitdate) = MONTH(CURDATE()) AND YEAR(profitdate) = YEAR(CURDATE())";
$current_month_resultp = mysqli_query($con, $current_month_profit_query);
$current_month_totalp = mysqli_fetch_assoc($current_month_resultp)['total'] ?? 0;

// Previous month's total profits
$previous_month_profit_query = "SELECT SUM(profit) AS total FROM profit WHERE user_id = '$userid' AND MONTH(profitdate) = MONTH(CURDATE() - INTERVAL 1 MONTH) AND YEAR(profitdate) = YEAR(CURDATE() - INTERVAL 1 MONTH)";
$previous_month_resultp = mysqli_query($con, $previous_month_profit_query);
$previous_month_totalp = mysqli_fetch_assoc($previous_month_resultp)['total'] ?? 0;

$profitm=$current_month_totalp;
?>


<!DOCTYPE html>
<html lang="en">
<!-- Your HTML content starts here -->

<?php
$exp_fetched = mysqli_query($con, "SELECT * FROM profit WHERE user_id = '$userid'");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Expendo - Manage Profit</title>

<!-- Favicon -->
<link rel="icon" href="favicon/favicon.ico" type="image/x-icon">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles  -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Feather JS for Icons -->
    <script src="js/feather.min.js"></script>

<!-- Bootstrap Icon CSS -->
<link href="css/bootstrap-icons-1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .mt-4{
            font-weight: bold;
        }
        .col-md-6 table{
            width:50em;
            position:relative;
            right:7em;
        }
        .profit {
            text-align:center;
}
</style>

<!-- Responsivness -->
<style>
    @media (max-width: 575.98px) {
    body {
        margin-right: 0; /* Remove any right margin causing space */
        padding-right: 0; /* Remove padding if any */
        overflow-x: hidden; /* Ensure no horizontal overflow */
    }

    .navbar {
        padding: 0.3em;
        text-align: center;
        width: 100%; /* Ensure navbar takes full width */
    }

    .navbar h3 {
        font-size: 1.1em;
        margin-bottom: 8px;
    }

    .navbar .navbar-toggler {
        margin-top: 0.3em;
    }

    .col-md-6 table {
        width: 100%; /* Ensure table takes full width */
        margin: 0 auto;
        table-layout: auto;
    }

    .profit {
        font-size: 1em;
        margin: 6px 0;
    }

    .table th, .table td {
        position:relative;
        left:9em;
        font-size: 0.8em;
        padding: 4px;
        word-wrap: break-word;
        border:none;
    }

    .date, .sn {
        font-size: 0.9em;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    footer {
        padding: 0.8em 0;
        font-size: 0.8em;
    }

    footer .container {
        padding: 0 10px;
    }

    footer .col-md-4 {
        margin-bottom: 12px;
    }

    footer h5 {
        font-size: 0.9em;
        font-weight: bold;
    }

    footer p {
        font-size: 0.7em;
    }
    #wrapper.toggled table {
        border: none; /* Remove border when sidebar is toggled */
    }
}






/* Medium devices (tablets, 768px and up) */
@media (min-width: 768px) and (max-width: 991.98px) {
    .navbar {
        padding: 1em;
    }

    .navbar h3 {
        font-size: 1.5em;
    }

    .col-md-6 {
        width: 48%;
        margin-bottom: 20px;
    }

    footer .container {
        padding: 0 30px;
    }

    footer h5 {
        font-size: 1.2em;
    }
}

</style>
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
                <a href="index.php" class="list-group-item list-group-item-action"><span data-feather="home"></span> Dashboard</a>
                <a href="add_expense.php" class="list-group-item list-group-item-action "><span data-feather="plus-square"></span> Add Expenses</a>
                <a href="manage_expense.php" class="list-group-item list-group-item-action"><span data-feather="dollar-sign"></span> Manage Expenses</a>
                <a href="add_profit.php" class="list-group-item list-group-item-action"><span data-feather="plus-circle"></span> Add profit</a>
                <a href="manage_profit.php" class="list-group-item list-group-item-action sidebar-active"><span data-feather="anchor"></span> Manage profit</a>
            </div>

            <div class="sidebar-heading">Tools </div>
            <a href="currency_con.php" class="list-group-item list-group-item-action"><span class="bi bi-cash-coin"></span> Currency-Converter</a>
            <a href="calculator.php" class="list-group-item list-group-item-action"><span class="bi bi-calculator"></span> Calculator</a>
            
            <div class="sidebar-heading">Settings </div>
            <div class="list-group list-group-flush">
                <a href="profile.php" class="list-group-item list-group-item-action "><span data-feather="user"></span> Profile</a>
                <a href="logout.php" class="list-group-item list-group-item-action "><span data-feather="power"></span> Logout</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <nav class="navbar ani navbar-expand-lg navbar-light  border-bottom">


                <button class="toggler" type="button" id="menu-toggle" aria-expanded="false">
                    <span data-feather="menu"></span>
                </button>
                <h3 style="text-align: center; font-weight: bold; font-size: 1.3em; position: relative; top: 0.2em; left: 0.2em;"> SSBSS </h3>

                <div class="container-fluid bg-light py-2">
    <div class="row">
        <div class="col text-center">
            <div class="profit alert alert-success d-inline-block p-2 m-0" style="font-size: 1.3em; font-weight: bold; border-radius: 10px;">
                Profit This Month: <span style="color:blue;" id="remainingBudget"><?php 
                if($profitm<=0){
                  echo "0";
                }else{
                echo("Rs".$profitm);
                } ?></span>
            </div> 
        </div>
    </div>
</div>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img img-fluid rounded-circle" src="<?php echo $userprofile ?>" width="45" height="45">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="profile.php">Your Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container-fluid ani">
                <h3 class="mt-4 text-center">Manage profit</h3>
                <hr>
                <div class="row justify-content-center">

                    <div class="col-md-6">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>profit Category</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>

                            <?php $count=1; while ($row = mysqli_fetch_array($exp_fetched)) { ?>
                                <tr>
                                    <td><?php echo $count;?></td>
                                    <td><?php echo $row['profitdate']; ?></td>
                                    <td><?php echo 'Rs.'.$row['profit']; ?></td>
                                    <td><?php echo $row['profitcategory']; ?></td>
                                    <td class="text-center">
                                        <a href="add_profit.php?edit=<?php echo $row['profit_id']; ?>" class="btn btn-primary btn-sm" style="border-radius:15%;">Edit</a>
                                    </td>
                                    <td class="text-center">
    <a href="manage_profit.php?delete=<?php echo $row['profit_id']; ?>" 
       class="btn btn-danger btn-sm" 
       style="border-radius:15%;" 
       onclick="return confirm('Are you sure you want to delete this record?');">
       Delete
    </a>
</td>

                                </tr>
                            <?php $count++; } ?>
                        </table>
                    </div>

                </div>
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
        feather.replace();
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

    <hr style="background-color: #2F4F4F; height: 0.02em; width: 100%;">
    <div class="text-center">
      <p class="m-0">© <?php echo date('Y'); ?> Expense Manager. All Rights Reserved.</p>
    </div>
  </div>
  
</footer>

</body>

</html>