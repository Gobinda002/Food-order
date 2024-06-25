<?php
// Include the database connection file
include '../components/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Fetch form data
    $name = $_POST['name'];
    $password = $_POST['password'];
    
    // Input validation
    if (empty($name) || empty($password)) {
        throw new Exception("Name and Password cannot be empty.");
    }

    // Password hashing
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Prepare SQL statement
    $stmt = $pdo->prepare("INSERT INTO admin (name, password) VALUES (:name, :password)");

    // Bind parameters
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':password', $hashedPassword);

    // Execute statement
    $stmt->execute();

    echo "Admin registered successfully.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Admin</title>
</head>
<body>
    <h2>Register Admin</h2>
    <form method="POST" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Register">
    </form>
</body>
</html>
