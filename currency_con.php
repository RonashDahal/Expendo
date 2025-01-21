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
    .converter {
    position:relative;
    top:3em;
    background: #ffffff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 500px;
    margin: 20px auto;
    font-family: 'Arial', sans-serif;
}

.converter h1 {
    font-size: 1.5rem;
    font-weight: bold;
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

.converter .form-group {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}

.converter label {
    font-size: 1rem;
    font-weight: bold;
    color: #555;
    margin-right: 10px;
    white-space: nowrap;
}

.converter select,
.converter input {
    flex: 1;
    padding: 10px;
    font-size: 1rem;
    border: 1px solid #ccc;
    border-radius: 5px;
    outline: none;
    transition: border-color 0.3s ease-in-out;
}

.converter select:focus,
.converter input:focus {
    border-color: #007bff;
}

.converter button {
    width: 100%;
    padding: 10px;
    font-size: 1rem;
    font-weight: bold;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease-in-out;
}

.converter button:hover {
    background-color: #0056b3;
}

.converter .result {
    margin-top: 20px;
    font-size: 1.2rem;
    font-weight: bold;
    text-align: center;
    color: #333;
}
footer{
    position:relative;
    top:10em;
}

    </style>


<!-- Responsivne -->
 <style>
    /* For devices with width less than 1200px */
@media (max-width: 1199px) {
    .converter {
        width: 90%;
        padding: 15px;
    }

    .converter h1 {
        font-size: 1.3rem;
    }

    .converter .form-group {
        flex-direction: column;
    }

    .converter label {
        margin-bottom: 10px;
    }

    .converter select, .converter input {
        width: 100%;
        margin-bottom: 10px;
    }

    footer {
        padding: 20px 0;
    }
}

/* For devices with width less than 992px (Tablets) */
@media (max-width: 991px) {
    .converter {
        width: 85%;
    }

    .sidebar-wrapper {
        width: 250px;
    }

    .navbar-nav {
        font-size: 0.9rem;
    }
}

/* For devices with width less than 768px (Portrait tablets and below) */
@media (max-width: 767px) {
    .converter {
        width: 100%;
        padding: 10px;
    }

    .sidebar-wrapper {
        width: 100%;
        position: relative;
    }

    .sidebar-heading {
        font-size: 1.1rem;
    }

    .navbar h3 {
        font-size: 1.2rem;
    }

    .navbar-nav {
        font-size: 0.85rem;
    }

    footer {
        padding: 15px 0;
    }
}

/* For devices with width less than 576px (Mobile phones) */
@media (max-width: 575px) {
    .converter {
        padding: 10px;
        width: 100%;
    }

    .converter h1 {
        font-size: 1.2rem;
    }

    .converter select, .converter input {
        width: 100%;
    }

    footer {
        padding: 10px 0;
    }

    .sidebar-wrapper {
        position: absolute;
        width: 100%;
        top: 0;
        left: 0;
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
                <a href="manage_expense.php" class="list-group-item list-group-item-action "><span data-feather="dollar-sign"></span> Manage Expenses</a>
                <a href="add_profit.php" class="list-group-item list-group-item-action"><span data-feather="plus-circle"></span> Add profit</a>
                <a href="manage_profit.php" class="list-group-item list-group-item-action"><span data-feather="anchor"></span> Manage profit</a>
            </div>
            <div class="sidebar-heading">Tools </div>
            <a href="currency_con.php" class="list-group-item list-group-item-action sidebar-active"><span class="bi bi-cash-coin"></span> Currency-Converter</a>
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
                                <a class="dropdown-item" href="profile.php">Your Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

<!-- Page-Content -->
<div class="converter">
        <h1>Currency Converter</h1>
        <div class="form-group">
            <label for="fromCurrency">From Currency:</label>
            <select id="fromCurrency" class="form-select">
                <option value="USD">United States Dollar (USD)</option>
                <option value="NPR">Nepalese Rupee (NPR)</option>
                <option value="INR">Indian Rupee (INR)</option>
                <option value="JPY">Japanese Yen (JPY)</option>
                <option value="KRW">South Korean Won (KRW)</option>
                <option value="QAR">Qatari Riyal (QAR)</option>
                <option value="AED">United Arab Emirates Dirham (AED)</option>
                <option value="SAR">Saudi Riyal (SAR)</option>
                <option value="THB">Thai Baht (THB)</option>
                <option value="CNY">Chinese Yuan (CNY)</option>
            </select>
        </div>
        <div class="form-group">
            <label for="toCurrency">To Currency:</label>
            <select id="toCurrency" class="form-select">
                <option value="USD">United States Dollar (USD)</option>
                <option value="NPR">Nepalese Rupee (NPR)</option>
                <option value="INR">Indian Rupee (INR)</option>
                <option value="JPY">Japanese Yen (JPY)</option>
                <option value="KRW">South Korean Won (KRW)</option>
                <option value="QAR">Qatari Riyal (QAR)</option>
                <option value="AED">United Arab Emirates Dirham (AED)</option>
                <option value="SAR">Saudi Riyal (SAR)</option>
                <option value="THB">Thai Baht (THB)</option>
                <option value="CNY">Chinese Yuan (CNY)</option>
            </select>
        </div>
        <div class="form-group">
            <label for="amount">Amount:</label>
            <input type="number" style="width:50%;" id="amount" class="form-control" placeholder="Enter amount" />
        </div>
        <button id="convert" class="btn btn-primary">Convert</button>
        <div class="result" id="result"></div>
    </div>

    <script>
        const apiKey = 'e92e5eb5c64ef48ab0051989'; // Replace with your API key
        const convertButton = document.getElementById('convert');
        const resultDiv = document.getElementById('result');

        convertButton.addEventListener('click', async () => {
            const fromCurrency = document.getElementById('fromCurrency').value;
            const toCurrency = document.getElementById('toCurrency').value;
            const amount = document.getElementById('amount').value;

            if (!amount || amount <= 0) {
                resultDiv.textContent = 'Please enter a valid amount.';
                return;
            }

            try {
                const response = await fetch(`https://open.er-api.com/v6/latest/${fromCurrency}?apikey=${apiKey}`);
                const data = await response.json();

                if (data.result === 'success') {
                    const rate = data.rates[toCurrency];
                    const convertedAmount = (amount * rate).toFixed(2);
                    resultDiv.textContent = `${amount} ${fromCurrency} = ${convertedAmount} ${toCurrency}`;
                } else {
                    resultDiv.textContent = 'Error fetching conversion rates.';
                }
            } catch (error) {
                resultDiv.textContent = 'An error occurred. Please try again later.';
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>



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

    <hr style="background-color: #2F4F4F; height: 0.02em; width: 100%;">
    <div class="text-center">
      <p class="m-0">© <?php echo date('Y'); ?> Expense Manager. All Rights Reserved.</p>
    </div>
  </div>
  
</footer>
</body>
</html>