<?php
// Initialize error and success messages
$errorMessage = '';
$successMessage = '';

// Check if the registration form was submitted
if (isset($_POST['register'])) {
  // Retrieve form data
  $name = $_POST['name'];
  $address = $_POST['address'];
  $vehicle_no = $_POST['vehicle_no'];
  $lno = $_POST['lno'];
  $phone_no = $_POST['phone_no'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Hash the password before storing it in the database
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  // Establish a database connection
  $conn = new mysqli("localhost", "root", "", "driver");

  // Check the connection
  if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
  }

  // Check if the email or phone number already exists
  $check = "SELECT * FROM user WHERE email='$email' OR phone_no='$phone_no'";
  $result = $conn->query($check);

  if ($result->num_rows > 0) {
    $errorMessage = "Username or email already exists. Please choose another.";
  } else {
    // Prepare the SQL statement using a prepared statement
    $stmt = $conn->prepare("INSERT INTO user (name, address, vehicle_no, lno, phone_no, email, password) VALUES (?, ?, ?, ?, ?, ?, ?)");

    // Check if the statement is prepared successfully
    if ($stmt === false) {
      die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("sssssss", $name, $address, $vehicle_no, $lno, $phone_no, $email, $hashedPassword);

    // Execute the statement
    if ($stmt->execute()) {
      $successMessage = "Registered successfully!";
    } else {
      $errorMessage = "Error: " . $conn->error;
    }

    // Close the statement
    $stmt->close();
  }

  // Close the database connection
  $conn->close();
}
?>

<!DOCTYPE html>
<!---Coding By CodingLab | www.codinglabweb.com--->
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/registration.css" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <title>User Registration Form</title>
</head>

<body>

  <section class="center-section">
    <div class="registration-form">
      <header>User Registration Form</header>
      <form method="post" action="registration.php">
        <div class="form-group">
          <label for="input name">Driver's name</label>
          <div class="col-sm-10">
            <input type="text" name="name" pattern="^[A-Za-z\s]+$" class="form-control" required />
          </div>
        </div>

        <div class="form-group">
          <label for="input address">Address</label>
          <div class="col-sm-10">
            <input type="text" name="address" pattern="^[a-zA-Z0-9\s]*$" class="form-control" required />
          </div>
        </div>

        <div class="form-group">
          <label for="input number">Vehicle Number</label>
          <div class="col-sm-10">
            <input type="text" name="vehicle_no" class="form-control" id="vehicle_no" required />
          </div>
        </div>

        <div class="form-group">
          <label for="input number">License Number</label>
          <div class="col-sm-10">
            <input type="text" name="lno" class="form-control" id="lno" required />
          </div>
        </div>

        <div class="form-group">
          <label for="inputphone3">Phone Number</label>
          <div class="col-sm-10">
            <input type="text" name="phone_no" pattern="[1-9]{1}[0-9]{9}" class="form-control" required />
          </div>
        </div>

        <div class="form-group">
          <label for="inputphone3">Email</label>
          <div class="col-sm-10">
            <input type="text" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}" title="Enter valid email"
              name="email" class="form-control" required />
          </div>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <div class="col-sm-10">
            <input type="password" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
              title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
              name="password" class="form-control" required />
          </div>
        </div>

        <div class="d-flex justify-content-center text-center mt-4 pt-1">
          <button type="submit" name="register" class="btn btn-outline-primary">Register</button>
        </div>
        <!-- Error and Success Messages -->
        <?php
        // Check if error or success messages should be displayed
        if ((isset($errorMessage) && $errorMessage !== '') || (isset($successMessage) && $successMessage !== '')) {
          echo '<div class="message-container" style="margin-top: 2em;">'; // Add margin only if a message is set
          if (isset($errorMessage) && $errorMessage !== '') {
            echo '<div class="error-message">' . $errorMessage . '</div>';
          } elseif (isset($successMessage)) {
            echo '<div class="success-message">' . $successMessage . '</div>';
          }
          echo '</div>';
        }
        ?>
        <div>
          <p class="text-center text-muted mt-5 mb-0">Already have an account?
            <a href="login.php" class="fw-bold text-body">Login here</a>
          </p>
        </div>
      </form>
    </div>
  </section>
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.js"></script>

</body>

</html>