<?php
session_start();

if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $type = $_POST['type'];

  $conn = new mysqli("localhost", "root", "", "driver");

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Use a prepared statement to prevent SQL injection
  if ($type == 1) {
    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
  } else {
    $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ?");
  }

  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Verify the entered password against the hashed password
    if (password_verify($password, $row['password'])) {
      $_SESSION['user'] = $row;
      if ($type == 2) {
        header("Location: dashboard.php");
      } else if ($type == 1) {
        header("Location: userdashboard.php");
      }
    } else {
      echo "Incorrect email or password.";
    }
  } else {
    echo "Login Information not found.";
  }

  $stmt->close();
  $conn->close();

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>

<body>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <div class="md-5 mt-md-4">
                                <form action="login.php" method="post">
                                    <h2 class="fw-bold mb-2 text-uppercase"></h2>
                                    <img src="image/logo.jfif" class="img-fluid mb-3" alt="" width="30%">
                                    <h6 class="mb-4">
                                        Driver's Information and Traffic Offense Records
                                    </h6>

                                    <div class="form-outline form-white mb-4">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control form-control-lg"
                                            required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}"
                                            title="Enter a valid email address" />
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" id="password" name="password"
                                            class="form-control form-control-lg" required />
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <label class="form-label" for="type">Type</label>
                                        <select class="form-select" name="type" id="type"
                                            aria-label="Default select example">
                                            <option value="1">User</option>
                                            <option value="2">Admin</option>
                                        </select>
                                    </div>

                                    <div class="d-flex justify-content-center text-center mt-4 pt-1">
                                        <input type="submit" name="login" value="Login"
                                            class="btn btn-primary btn-lg" />
                                    </div>

                                    <div class="register-link mt-5">
                                        <p>Don't have an account? <a href="registration.php">Register here</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>