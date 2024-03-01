<?php
try {
    // Set up a database connection
    $conn = new mysqli("localhost", "root", "", "driver");

    // Check for connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sample data for record 1
    $id1 = 1;
    $email1 = 'Hari@gmail.com';
    $password1 = 'Test12345!!'; // The plaintext password

    // Hash the password for record 1
    $hashedPassword1 = password_hash($password1, PASSWORD_DEFAULT);

    // Sample data for record 2
    $id2 = 1;
    $name2 = 'Ayusha Rai';
    $address2 = 'Bhaktapur';
    $vehicle_no2 = 6768;
    $lno2 = 1230112;
    $phone_no2 = '9814796247';
    $email2 = 'ayusha@gmail.com';
    $password2 = '1234'; // The plaintext password

    // Hash the password for record 2
    $hashedPassword2 = password_hash($password2, PASSWORD_DEFAULT);

    // Sample data for record 3
    $id3 = 2;
    $name3 = 'Sujina Shrestha';
    $address3 = 'Sinamangal';
    $vehicle_no3 = 529;
    $lno3 = 1230122;
    $phone_no3 = '9814796275';
    $email3 = 'sujina@gmail.com';
    $password3 = '4567'; // The plaintext password

    // Hash the password for record 3
    $hashedPassword3 = password_hash($password3, PASSWORD_DEFAULT);

    // Sample data for record 4
    $id4 = 3;
    $name4 = 'Nikita Shrestha';
    $address4 = 'Lokanthali';
    $vehicle_no4 = 6768;
    $lno4 = 1230189;
    $phone_no4 = '9811114444';
    $email4 = 'nikita@gmail.com';
    $password4 = '0987'; // The plaintext password

    // Hash the password for record 4
    $hashedPassword4 = password_hash($password4, PASSWORD_DEFAULT);

    // Sample data for record 5
    $id5 = 4;
    $name5 = 'Ram Kumar';
    $address5 = 'KTM';
    $vehicle_no5 = 529;
    $lno5 = 1230110;
    $phone_no5 = '9861623154';
    $email5 = 'ram@gmail.com';
    $password5 = '1234'; // The plaintext password

    // Hash the password for record 5
    $hashedPassword5 = password_hash($password5, PASSWORD_DEFAULT);

    // Modify your INSERT statements with hashed passwords
    $sql1 = "INSERT INTO `admin` (`id`, `email`, `password`) VALUES
        ($id1, '$email1', '$hashedPassword1')";

    $sql2 = "INSERT INTO `user` (`id`, `name`, `address`, `vehicle_no`, `lno`, `phone_no`, `email`, `password`) VALUES
        ($id2, '$name2', '$address2', $vehicle_no2, $lno2, '$phone_no2', '$email2', '$hashedPassword2')";

    $sql3 = "INSERT INTO `user` (`id`, `name`, `address`, `vehicle_no`, `lno`, `phone_no`, `email`, `password`) VALUES
        ($id3, '$name3', '$address3', $vehicle_no3, $lno3, '$phone_no3', '$email3', '$hashedPassword3')";

    $sql4 = "INSERT INTO `user` (`id`, `name`, `address`, `vehicle_no`, `lno`, `phone_no`, `email`, `password`) VALUES
        ($id4, '$name4', '$address4', $vehicle_no4, $lno4, '$phone_no4', '$email4', '$hashedPassword4')";

    $sql5 = "INSERT INTO `user` (`id`, `name`, `address`, `vehicle_no`, `lno`, `phone_no`, `email`, `password`) VALUES
        ($id5, '$name5', '$address5', $vehicle_no5, $lno5, '$phone_no5', '$email5', '$hashedPassword5')";

    // Execute the SQL queries for all records
    if ($conn->query($sql1) === TRUE) {
        echo "Admin $name1 inserted successfully<br>";
    } else {
        echo "Error: " . $sql1 . "<br>" . $conn->error . "<br>";
    }

    if ($conn->query($sql2) === TRUE) {
        echo "User $name2 inserted successfully<br>";
    } else {
        echo "Error: " . $sql2 . "<br>" . $conn->error . "<br>";
    }

    if ($conn->query($sql3) === TRUE) {
        echo "User $name3 inserted successfully<br>";
    } else {
        echo "Error: " . $sql3 . "<br>" . $conn->error . "<br>";
    }

    if ($conn->query($sql4) === TRUE) {
        echo "User $name4 inserted successfully<br>";
    } else {
        echo "Error: " . $sql4 . "<br>" . $conn->error . "<br>";
    }

    if ($conn->query($sql5) === TRUE) {
        echo "User $name5 inserted successfully<br>";
    } else {
        echo "Error: " . $sql5 . "<br>" . $conn->error . "<br>";
    }

    // Close the database connection
    $conn->close();
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage();
}
?>