<?php

// Start session to access user data
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include_once("connections.php");
$conn = connection(); // Connect to the database



// Initialize variables
$firstName = "";
$middleName = "";
$lastName = "";
$address = "";
$businessName = "";
$businessAddress = "";
$businessType = "";
$mobileNumber = ""; // Changed to mobileNumber to match residents table

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $address = $_POST['address'];
    $businessName = $_POST['businessName'];
    $businessAddress = $_POST['businessAddress'];
    $businessType = $_POST['businessType'];
    $mobileNumber = $_POST['mobileNumber']; // Changed to mobileNumber

    // SQL query to insert data (use prepared statements for security)
    $sql = "INSERT INTO business_permit_applications (firstName, middleName, lastName, address, businessName, businessAddress, businessType, mobile_number, application_date, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), 'Pending')";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $firstName, $middleName, $lastName, $address, $businessName, $businessAddress, $businessType, $mobileNumber); // Changed to mobileNumber

    if ($stmt->execute()) {
        echo "<script>alert('Business Permit application submitted successfully!'); window.location.href = 'permit.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
} else {
    // If it's not a POST request, try to retrieve user data from the session
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Retrieve user data from the residents table
        $sql_user = "SELECT first_name, middle_name, last_name, complete_address, mobile_number FROM residents WHERE id = ?"; // Added mobile_number
        $stmt_user = $conn->prepare($sql_user);
        $stmt_user->bind_param("i", $user_id);
        $stmt_user->execute();
        $result_user = $stmt_user->get_result();

        if ($result_user->num_rows > 0) {
            $row_user = $result_user->fetch_assoc();
            $firstName = $row_user['first_name'];
            $middleName = $row_user['middle_name'];
            $lastName = $row_user['last_name'];
            $address = $row_user['complete_address'];
            $mobileNumber = $row_user['mobile_number']; // Added mobileNumber
        }
        $stmt_user->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
    <title>Business Permit Application Form</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
        }

        .form-container {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 10px;
            max-width: 600px;
        }

        label {
            text-align: right;
            padding-right: 10px;
            grid-column: 1 / 2;
            align-self: center;
        }

        input, textarea, select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            grid-column: 2 / 3;
        }

        button {
            background-color: #00a355;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            grid-column: 2 / 3;
            justify-self: start;
            margin-top: 10px;
        }

        button:hover {
            background-color: red;
        }

        h2 {
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Business Permit Application Form</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-container">
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>" required>

            <label for="middleName">Middle Name:</label>
            <input type="text" id="middleName" name="middleName" value="<?php echo htmlspecialchars($middleName); ?>">

            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>" required>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>" required>

            <label for="businessName">Business Name:</label>
            <input type="text" id="businessName" name="businessName" required>

            <label for="businessAddress">Business Address:</label>
            <input type="text" id="businessAddress" name="businessAddress" required>

            <label for="businessType">Type of Business:</label>
            <input type="text" id="businessType" name="businessType" required>

            <label for="mobileNumber">Mobile Number:</label>
            <input type="text" id="mobileNumber" name="mobileNumber" value="<?php echo htmlspecialchars($mobileNumber); ?>" required>

            <button type="submit">Submit Application</button>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>