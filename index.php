<?php
  include("session.php");
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

// Calculate percentage change in profits
if ($previous_month_totalp > 0) {
    $percentage_change_profit = (($current_month_totalp - $previous_month_totalp) / $previous_month_totalp) * 100;
} else {
    $percentage_change_profit = $current_month_totalp > 0 ? 100 : 0;
}

// Calculate percentage change
if ($previous_month_total > 0) {
     $percentage_change =(($current_month_total - $previous_month_total) / $previous_month_total) * 100;
} else {
    $percentage_change = $current_month_total > 0 ? 100 : 0;
}

//remaining budjet
$buget = $current_month_totalp - $current_month_total;
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Expendo - Dashboard</title>

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

  <style>
.bargraph,.card-body,.circle-container,.row ,.mt-4,.ani{
  animation: fadeIn 0.65s ease-in-out;
}

.card a {
    color: #000;
    font-weight: 500;
  }

.card a:hover {
    color: #28a745;
    text-decoration: dotted;
  }
    

.row.mt-4 {
  width: 100%;
  display: flex; /* Establish flexbox layout */
  justify-content: space-between;
  align-items: center;
  border: 0.01em solid gray;
  border-radius: 3em;
  margin-left: 0.2em;

  
}

.col-2 {
  flex: 0 0 auto; /* Prevent the column from growing */
  margin: 2em;

}

.bargraph {
  position: relative;
  top: 1em;
  right: 2em;
  width: 35em;
  height: 25em;
  border: none;
}

.bargraph canvas {
    width:25em;
    height:17em;
  }

.bargraph h5{
  font-weight: bolder;
  font-size: 1.5em;
}
.card-body{
  border: 0.01em solid gray;
  border-radius: 0.5em;
}
.page-content-wrapper{
  display: flex;
  justify-content: center;
}

/* Keyframe for the fade-in effect */
@keyframes fadeIn {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}

  </style>

<!-- style2 -->
<style>
.progress-container {
            position: relative;
            width: 12.5em;  /* Increased width */
            height: 12.5em; /* Increased height */
        }

        svg {
            width: 16.5em;  /* Increased size of SVG */
            height: 16.5em; /* Increased size of SVG */
            transform: rotate(-90deg); /* Rotate to start progress from the top */
        }

        .circle-background {
            fill: none;
            stroke: #ddd; /* Light grey for background */
            stroke-width: 20; /* Increased stroke width */
        }

        .circle-progress {
            fill: none;
            stroke-linecap: round;
            stroke-width: 20; /* Increased stroke width */
            stroke: green;
            stroke-dasharray: 439.82; /* Circumference for r=70 */
            stroke-dashoffset: 439.82; /* Initially, fully hidden */
            transition: stroke-dashoffset 2s ease-in-out; /* Smooth animation */
        }

        .inner-circle {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 2em;
    font-weight: bold;
    color: black;
}
        
.remaining-b {
    display: flex;
    align-items: center;
    justify-content: center;
}
.feather {
    transform: rotate(0deg); /* Ensure no rotation */
}

</style>

<!-- Responsive Design -->
<style>
 @media (max-width: 480px) {
  /* Bar Graph Container */
  .bargraph {
    width: 100% !important; /* Make sure container takes full width */
    height: auto; /* Allow height to adjust dynamically */
    padding: 0.2em 0.5em; /* Smaller padding for compact layout */
    padding-left: 2.6em; /* Add space to the left side */
    margin: 1em auto; /* Space around the container */
    border-radius: 1em; /* Smooth edges */
    max-width: 95%; /* Limit container width to avoid overflow */
  }

  /* Canvas */
  .bargraph canvas {
    width: 100% !important; /* Make the canvas responsive */
    height: 230px !important; /* Set a fixed height to avoid excessive stretching */
    margin: 0 auto; /* Center the canvas */
    display: block;
    box-sizing: border-box; /* Ensure padding doesn't cause overflow */
    position:relative;
    left:1em;
  }

  /* Title */
  .bargraph h5 {
    font-size: 1em !important; /* Keep the title small but readable */
    margin-bottom: 0.5em; /* Space below the title */
    text-align: center; /* Center-align title */
  }

  /* Legend (for Chart.js) */
  .bargraph .chartjs-legend {
    font-size: 8px !important; /* Smaller font for legend */
    padding: 4px 0 !important; /* Compact padding */
    margin-top: 0.8em !important; /* Space between chart and legend */
  }

  /* Axis Labels */
  .bargraph .chartjs-axis-labels {
    font-size: 8px !important; /* Reduce font size of axis labels */
    padding: 4px !important; /* Reduce padding around axis labels */
  }

  /* Bar Width */
  .bargraph .bar {
    max-width: 8px !important; /* Narrow bars for better use of space */
  }

  /* Tooltip adjustments */
  .bargraph .chartjs-tooltip {
    font-size: 8px !important; /* Smaller font size for tooltips */
  }
}


.progress-container{
position:relative;
left:5em;
}

.text {
  font-size: 1em; /* Font size for the text */
  position:relative;
  left:0.9em;
  top:0.9em;
}

.ftxt {
  font-weight: bolder;
  font-size: 1.5em;
  display: flex; /* Use flexbox to align the content */
  position: absolute;
  right:8em;
  bottom:8.4em;
  justify-content: center; /* Center the text horizontally */
  align-items: center; /* Ensure text is centered vertically if needed */
  width: 100%; /* Ensures the text takes up full width of the container */
}

/* Define the transition properties for smooth animation */
.progress-container, .ftxt {
    transition: all 0.3s ease; /* Adjust duration (0.3s) and easing (ease) as needed */
}

/* Adjust styles when the wrapper is toggled */
#wrapper.toggled .progress-container {
    right: 20em; /* Adjust to compensate for the sidebar's width when toggled */
}

#wrapper.toggled .ftxt {
    left: 10em;
    transform: translateX(-50%);
}

</style>

<!-- Responsivne AC -->
 <style>
/* Media Query for smaller screens (max-width: 768px) */
@media (max-width: 768px) {
    .progress-container {
        width: 10em; /* Adjust the size of the circle */
        height: 10em; /* Adjust the size of the circle */
    }

    svg {
        width: 12em;  /* Adjust the size of the SVG */
        height: 12em; /* Adjust the size of the SVG */
    }

    .circle-background,
    .circle-progress {
        stroke-width: 15; /* Adjust stroke width for responsiveness */
    }

    .inner-circle {
        font-size: 1.5em; /* Adjust font size for smaller screens */
    }
}

/* Media Query for very small screens (max-width: 480px) */
@media (max-width: 480px) {
    .progress-container {
        width: 8em;  /* Adjust for very small screens */
        height: 8em; /* Adjust for very small screens */
    }

    svg {
        width: 10em;  /* Adjust the size of the SVG */
        height: 10em; /* Adjust the size of the SVG */
    }

    .circle-background,
    .circle-progress {
        stroke-width: 10; /* Adjust stroke width for very small screens */
    }

    .inner-circle {
        font-size: 1.2em; /* Reduce font size */
    }
    .ftxt {
    position: relative;
    top: 0.4em; /* Adjust this for a better fit */
    left: 0; /* Ensure it is centered */
    right: 0; /* Ensure it is centered */
    font-size: 1.2em; /* Smaller font size for smaller screens */
    line-height: 1.3;  /* Adjust line height */
    text-align: center; /* Center text if needed */
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
        <a href="index.php" class="list-group-item list-group-item-action sidebar-active"><span data-feather="home"></span> Dashboard</a>
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
        <a href="profile.php" class="list-group-item list-group-item-action "><span data-feather="user"></span> Profile</a>
        <a href="logout.php" class="list-group-item list-group-item-action "><span data-feather="power"></span> Logout</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-dark  border-bottom">
      

        <button class="toggler" type="button" id="menu-toggle" aria-expanded="false">
          <span class="ani" data-feather="menu"></span>
        </button>
        <h3 class="ani" style="text-align: center; font-weight: bold; font-size: 1.3em; position: relative; top: 0.2em; left: 0.2em;"> SSBSS </h3>

        <div class="container-fluid bg-light py-2">
      <div class="row">
          <div class="col text-center">
          <div class="remaining-b alert alert-success d-inline-block p-2 m-0"
     style="display: flex; align-items: center; justify-content: space-between; font-size: 1.3em; font-weight: bold; border-radius: 10px;">
    Remaining Budget this month: 
    <div id="remainingBudget" style="color: blue; display: inline-block;">
        <?php 
        if($buget<0){
            echo "<p style='color:red; margin: 0;'>Out of Budget</p>";
        }else{
            echo("Rs.".$buget);
        } ?>
    </div>
</div>

          </div>
    </div>
</div>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="img ani img-fluid rounded-circle" src="<?php echo $userprofile ?>" width="45" height="45">
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

      <div class="container-fluid">
        <h3 class="mt-4" style="font-weight: bolder;">Dashboard</h3>
        <div class="row">
          <div class="col-md">
            <div class="card">
            
              <div class="card-body">
                <div class="row">
                  <div class="col text-center">
                    <a href="add_expense.php"><img src="icon/add.png" width="57px" />
                      <p>Add Expenses</p>
                    </a>
                  </div>
                  <div class="col text-center">
                    <a href="add_profit.php"><img src="icon/profit.png" width="57px" />
                      <p>Add Profit</p>
                    </a>
                  </div>
                  <div class="col text-center">
                    <a href="profile.php"><img src="icon/profile.png" width="57px" />
                      <p>User Profile</p>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
<!-- percom --> 
<div class="row mt-4">
<h5 class="ftxt">Profit rate this month</h5>
<div class="progress-container">
    <svg viewBox="0 0 170 170"> <!-- Updated to fit larger circle -->
    <!-- Background Circle -->
    <circle class="circle-background" cx="85" cy="85" r="71.5"></circle>

    <!-- Progress Circle -->
    <circle id="circle-progress" class="circle-progress" cx="85" cy="85" r="71.5"></circle>
</svg>

    <!-- Percentage Display -->
    <div class="inner-circle">
        <span class="text" id="percentage-text">0%</span>
    </div>
</div>

      
  <div class="bargraph"> <!-- Flex container for horizontal layout -->
      <div class="card">
          <div class="card-header">
              <h5 class="card-title text-center">Expense Category</h5>
          </div>
          <div class="card-body">
              <canvas id="expense_category_pie" height="150"></canvas>
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
    feather.replace()
  </script>
  <script>
    // Bar Chart for Expense Category
var ctx = document.getElementById('expense_category_pie').getContext('2d');
var myChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: [<?php while ($a = mysqli_fetch_array($exp_category_dc)) { echo '"' . $a['expensecategory'] . '",'; } ?>],
    datasets: [{
      label: 'Expense by Category',
      data: [<?php while ($b = mysqli_fetch_array($exp_amt_dc)) { echo '"' . $b['SUM(expense)'] . '",'; } ?>],
      backgroundColor: [
        '#6f42c1', '#dc3545', '#28a745', '#007bff', '#ffc107',
        '#20c997', '#17a2b8', '#fd7e14', '#e83e8c', '#6610f2'
      ],
      borderWidth: 1
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      x: {
        ticks: {
          font: { size: 10 },
          autoSkip: true,
          maxRotation: 0
        }
      },
      y: {
        ticks: { font: { size: 10 } }
      }
    },
    plugins: {
      tooltip: { bodyFont: { size: 10 } }
    }
  }
});

// Line Chart for Expense by Month
var line = document.getElementById('expense_line').getContext('2d');
var myChartLine = new Chart(line, {
  type: 'line',
  data: {
    labels: [<?php while ($c = mysqli_fetch_array($exp_date_line)) { echo '"' . $c['expensedate'] . '",'; } ?>],
    datasets: [{
      label: 'Expense by Month (Whole Year)',
      data: [<?php while ($d = mysqli_fetch_array($exp_amt_line)) { echo '"' . $d['SUM(expense)'] . '",'; } ?>],
      borderColor: '#adb5bd',
      backgroundColor: 'transparent',
      fill: false,
      borderWidth: 2
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      x: {
        ticks: {
          font: { size: 10 },
          autoSkip: true,
          maxRotation: 0
        }
      },
      y: {
        ticks: { font: { size: 10 } }
      }
    },
    plugins: {
      tooltip: { bodyFont: { size: 10 } }
    }
  }
});

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
<script>

function updateProgress(value) {
      let textv = value.toFixed(2);
        
        // Ensure value stays within the range -100 to 100
        value = Math.max(-100, Math.min(100, value));
        const circleProgress = document.getElementById('circle-progress');
        const percentageText = document.getElementById('percentage-text');
        const radius = 70; // Circle radius
        const circumference = 2 * Math.PI * radius; // Circle circumference

        // Set stroke-dasharray to match the circle circumference
        circleProgress.style.strokeDasharray = `${circumference}`;

        // Calculate stroke-dashoffset based on percentage
        const offset = (1 - Math.abs(value) / 100) * circumference;

        // Apply color and animation for positive/negative values
        if (value < 0) {
            circleProgress.style.stroke = 'red'; // Negative progress in red
            percentageText.style.color = 'red';
        } else {
            circleProgress.style.stroke = 'green'; // Positive progress in green
            percentageText.style.color = 'green';
        }

        // Set the stroke-dashoffset for progress animation
        circleProgress.style.strokeDashoffset = offset;

        // Update the text dynamically with percentage
        percentageText.textContent = `${textv}%`;
    }

    // Trigger progress update on page load
    window.onload = function () {
      var percentageChangeProfit = <?php echo $percentage_change_profit; ?>;
        updateProgress(percentageChangeProfit); // Change this value to test different percentages (e.g., 50, -50)
    };

</script>

</html>