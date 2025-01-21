<?php
include("session.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Expendo - Currency Converter</title>
<!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- Custom styles -->
<link href="css/style.css" rel="stylesheet">

<!-- Feather JS for Icons -->
<script src="js/feather.min.js"></script>

<!-- Bootstrap Icon CSS -->
<link href="css/bootstrap-icons-1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<!-- Favicon -->
<link rel="icon" href="favicon/favicon.ico" type="image/x-icon">

<style>
body {
  display: flex;
  flex-direction: column;
  height: 100vh;
}

#page-content-wrapper {
  flex: 1;
}

/* Page content should take up available space but leave room for footer */
#page-content-wrapper {
  flex: 1;
  padding-bottom: 50px; /* Add space below the content so the footer won't overlap */
}

/* Calculator Container Styling */
.container {
  max-width: 200px;  /* Set a smaller width (for example, 280px) */
  width: 100%;
  padding: 20px;
  background: #fff;
  border-radius: 12px;
  box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
  margin-bottom: 50px; /* Keep space to avoid footer overlap */
  text-align: center;
  position: relative;
}



/* Rest of the calculator styles stay the same */
.display {
  width: 100%;
  height: 80px;
  font-size: 36px;
  text-align: right;
  padding: 10px;
  border: none;
  border-radius: 8px;
  background-color: #f1f1f1;
  color: #2F4F4F;
  font-weight: bold;
  margin-bottom: 20px;
  box-sizing: border-box;
  outline: none;
}

/* Button Layout */
.buttons {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 12px;
}

/* Styling each button */
.buttons button {
  font-size: 22px;
  padding: 15px;
  border-radius: 8px;
  border: none;
  background-color: #f0f0f0;
  color: #333;
  cursor: pointer;
  transition: background-color 0.3s ease, transform 0.1s ease-in-out;
}

.buttons button:active {
  transform: scale(0.98); /* Button click effect */
}

/* Operator button styling */
.operator {
  background-color: #2F9FFF;
  color: white;
}

/* Clear (AC) and Delete (DEL) button styles */
.operator[data-value="AC"] {
  background-color: #FF6347; /* Red for Clear */
  color: white;
}

.operator[data-value="DEL"] {
  background-color: #FF8C00; /* Orange for Delete */
  color: white;
}

/* Equal button style */
.operator[data-value="="] {
  background-color: #4CAF50;
  color: white;
  grid-column: span 4; /* Make the equals button span across all columns */
}

/* Number button hover effect */
.buttons button:hover {
  background-color: #ddd; /* Light gray on hover */
}

/* Make the numbers bold */
.buttons button:not(.operator) {
  font-weight: bold;
}

/* Responsive Design */
@media (max-width: 480px) {
  .container {
    max-width: 100%;  /* Ensure it's still full-width on smaller screens, or you can set a custom width like 90% */
    padding: 15px;
  }
}


/* The .container's width should be within the proper bounds */
.container {
    position:relative;
    top:2em;
  max-width: 100%;
  width: 30em;
  padding: 20px;
  box-sizing: border-box;
  margin-bottom: 50px;  /* Ensures there's space below the calculator */
}

/* Ensure footer content stays within bounds */
footer .container {
  padding: 0 15px;
  max-width: 1140px;
  margin: 0 auto;
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
                <a href="manage_expense.php" class="list-group-item list-group-item-action "><span data-feather="dollar-sign"></span> Manage Expenses</a>
                <a href="add_profit.php" class="list-group-item list-group-item-action"><span data-feather="plus-circle"></span> Add profit</a>
                <a href="manage_profit.php" class="list-group-item list-group-item-action"><span data-feather="anchor"></span> Manage profit</a>
            </div>
            <div class="sidebar-heading">Tools </div>
            <a href="currency_con.php" class="list-group-item list-group-item-action"><span class="bi bi-cash-coin"></span> Currency-Converter</a>
            <a href="calculator.php" class="list-group-item list-group-item-action sidebar-active"><span class="bi bi-calculator"></span> Calculator</a>

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
                                <a class="dropdown-item" href="profile.php">Your Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>


<!-- Page-Content -->
<div class="container">
      <input type="text" class="display" readonly />

      <div class="buttons">
        <button class="operator" data-value="AC">AC</button>
        <button class="operator" data-value="DEL">DEL</button>
        <button class="operator" data-value="%">%</button>
        <button class="operator" data-value="/">/</button>

        <button data-value="7">7</button>
        <button data-value="8">8</button>
        <button data-value="9">9</button>
        <button class="operator" data-value="*">*</button>

        <button data-value="4">4</button>
        <button data-value="5">5</button>
        <button data-value="6">6</button>
        <button class="operator" data-value="-">-</button>

        <button data-value="1">1</button>
        <button data-value="2">2</button>
        <button data-value="3">3</button>
        <button class="operator" data-value="+">+</button>

        <button data-value="0">0</button>
        <button data-value="00">00</button>
        <button data-value=".">.</button>
        <button class="operator" data-value="=">=</button>
      </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
     <!-- Bootstrap core JavaScript -->
     <script src="js/jquery.slim.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <!-- Menu Toggle Script -->
    <script>
        // Fix for the menu toggle button
$("#menu-toggle").click(function (e) {
  e.preventDefault();
  $("#wrapper").toggleClass("toggled");
  // Reset the output to avoid undefined if the toggle button is pressed
  output = "";
  display.value = "";
});
    </script>
    <script>
        feather.replace()
    </script>
    <!-- Footer -->
<footer class="bg-light text-dark py-4 mt-5">
  <hr style="background-color: #2F4F4F; height: 0.02em; width: 100%;">
  <div class="footer_container">
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
<script>
    const display = document.querySelector(".display");
const buttons = document.querySelectorAll("button");
const specialChars = ["%", "*", "/", "-", "+", "="];
let output = "";

// Define function to calculate based on button clicked
const calculate = (btnValue) => {
  // Prevent any interaction with the menu toggle button affecting the calculation
  if (btnValue === undefined) return;

  display.focus();
  
  if (btnValue === "=" && output !== "") {
    // If output has '%', replace with '/100' before evaluating
    output = eval(output.replace("%", "/100"));
  } else if (btnValue === "AC") {
    output = "";
  } else if (btnValue === "DEL") {
    // If DEL button is clicked, remove the last character from the output
    output = output.toString().slice(0, -1);
  } else {
    // If output is empty and button is a special character, return
    if (output === "" && specialChars.includes(btnValue)) return;
    output += btnValue;
  }
  display.value = output;
};

// Add event listener to buttons, call calculate() on click
buttons.forEach((button) => {
  // Button click listener calls calculate() with dataset value as argument
  button.addEventListener("click", (e) => {
    // Only call calculate if the button pressed is valid
    if (e.target.dataset.value !== undefined) {
      calculate(e.target.dataset.value);
    }
  });
});
</script>
</html>