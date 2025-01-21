<?php
include("session.php");

$update = false;
$del = false;
$profitamount = "";
$profitdate = date("Y-m-d");
$profitcategory = "";

// Update logic
if (isset($_POST['update'])) {
    $id = $_GET['edit'];
    $profitamount = $_POST['profitamount'];
    $profitdate = $_POST['profitdate'];
    $profitcategory = $_POST['profitcategory'];

    $sql = "UPDATE profit SET profit='$profitamount', profitdate='$profitdate', profitcategory='$profitcategory' 
            WHERE user_id='$userid' AND profit_id='$id'";
    if (mysqli_query($con, $sql)) {
        header('location: manage_profit.php');
        exit;
    } else {
        echo "ERROR: Could not execute $sql. " . mysqli_error($con);
    }
}

// Fetch data for editing
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $record = mysqli_query($con, "SELECT * FROM profit WHERE user_id='$userid' AND profit_id=$id");
    if (mysqli_num_rows($record) == 1) {
        $n = mysqli_fetch_array($record);
        $profitamount = $n['profit'];
        $profitdate = $n['profitdate'];
        $profitcategory = $n['profitcategory'];
    } else {
        echo "WARNING: Unauthorized access.";
    }
}

// Add new profit
if (isset($_POST['add'])) {
    $profitamount = $_POST['profitamount'];
    $profitdate = $_POST['profitdate'];
    $profitcategory = $_POST['profitcategory'] ?? null;

    if (empty($profitcategory)) {
        echo "<script>
    alert('Please Select a Category!');
    window.location.href = 'add_profit.php'; 
</script>"; 


    } else {
        if($profitamount==0){
            echo "<script>
    alert('Profit Amount Cannot be Zero');
    window.location.href = 'add_profit.php'; 
</script>";
        }else
    {

        $profit = "INSERT INTO profit (user_id, profit, profitdate, profitcategory) 
                   VALUES ('$userid', '$profitamount', '$profitdate', '$profitcategory')";
        if (mysqli_query($con, $profit)) {
            header('location: add_profit.php');
            exit;
        } else {
            echo "ERROR: Could not execute $profit. " . mysqli_error($con);
        }
    }   

    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Expendo - Add Profit</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Feather JS for Icons -->
    <script src="js/feather.min.js"></script>

<!-- Favicon -->
<link rel="icon" href="favicon/favicon.ico" type="image/x-icon">

<!-- Bootstrap Icon CSS -->
<link href="css/bootstrap-icons-1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
    .mt-4{
        font-weight: bolder;
    }
    .form-group{
        font-size: 1.2em;
    }
    .form-check-label{
        font-size: 1em;
    }
    .form-check-input{
        width: 0.89em;
        height: 0.89em;
        margin-right: 0.001em;
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
                <a href="add_expense.php" class="list-group-item list-group-item-action"><span data-feather="plus-square"></span> Add Expense</a>
                <a href="manage_expense.php" class="list-group-item list-group-item-action"><span data-feather="dollar-sign"></span> Manage Expenses</a>
                <a href="add_profit.php" class="list-group-item list-group-item-action sidebar-active"><span data-feather="plus-circle"></span> Add profit</a>
                <a href="manage_profit.php" class="list-group-item list-group-item-action"><span data-feather="anchor"></span> Manage profit</a>
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
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img img-fluid rounded-circle" src="<?php echo $userprofile ?>" width="45" height="45">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="profile.phcol-mdp">Your Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container ani">
                <h3 class="mt-4 text-center">Add Your Daily profit</h3>
                <hr>
                <div class="row ">

                    <div class="col-md-3"></div>

                    <div class="col-md" style="margin:0 auto;">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label for="profitamount" class="col-sm-6 col-form-label"><b>Enter Amount(NPR)</b></label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control col-sm-12" value="<?php echo $profitamount; ?>" id="profitamount" name="profitamount" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="profitdate" class="col-sm-6 col-form-label"><b>Date</b></label>
                                <div class="col-md-6">
                                    <input type="date" class="form-control col-sm-12" value="<?php echo $profitdate; ?>" name="profitdate" id="profitdate" required>
                                </div>
                            </div>
                            <fieldset class="form-group">
                                <div class="row">
                                    <legend class="col-form-label col-sm-6 pt-0"><b>Category</b></legend>
                                    <div class="col-md">

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="profitcategory" id="profitcategory4" value="Salarly" <?php echo ($profitcategory == 'Salarly') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="profitcategory4">
                                            Salarly
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="profitcategory" id="profitcategory3" value="Commission" <?php echo ($profitcategory == 'Commission') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="profitcategory3">
                                                Commission
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="profitcategory" id="profitcategory2" value="Rent" <?php echo ($profitcategory == 'Rent') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="profitcategory2">
                                                Rent
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="profitcategory" id="profitcategory1" value="Business Profit" <?php echo ($profitcategory == 'Business Profit') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="profitcategory1">
                                                Business Profit
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="profitcategory" id="profitcategory7" value="Allowance" <?php echo ($profitcategory == 'Allowance') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="profitcategory7">
                                                Allowance
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="profitcategory" id="profitcategory8" value="Dividend or Bonus" <?php echo ($profitcategory == 'Dividend or Bonus') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="profitcategory8">
                                                Dividend or Bonus
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="profitcategory" id="profitcategory5" value="Others" <?php echo ($profitcategory == 'Others') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="profitcategory5">
                                                Others
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-group row">
                                <div class="col-md-12 text-right">
                                    <?php if ($update == true) : ?>
                                        <button class="btn btn-lg btn-block btn-primary" style="border-radius: 0.5em;" type="submit" name="update">Update</button>
                                    <?php else : ?>
                                        <button type="submit" name="add" class="btn btn-lg btn-block btn-success" style="border-radius: 0.5em;">Add profit</button>
                                    <?php endif ?>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-3"></div>
                    
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
    <script>

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