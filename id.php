<?php
include_once("connections.php");
$conn = connection(); // Connect to the database

// Start session to access user data
session_start();

// Initialize variables
$firstName = "";
$middleName = "";
$lastName = "";
$address = "";
$birthdate = "";
$contactNumber = "";
$occupation = "";
$profilePicture = ""; // Added profile picture variable
$age = ""; // Added age variable
$mobileNumber = ""; // Added mobile number variable

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $address = $_POST['address'];
    $birthdate = $_POST['birthdate'];
    $occupation = $_POST['occupation'];
    $age = $_POST['age']; // Retrieve age from POST
    $mobileNumber = $_POST['mobileNumber']; // Retrieve mobile number from POST

    // Handle profile picture upload with improved error handling
    if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] == 0) {
        $uploadDir = "uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true); // Create directory if it doesn't exist
        }
        $uploadFile = $uploadDir . basename($_FILES['profilePicture']['name']);
        if (move_uploaded_file($_FILES['profilePicture']['tmp_name'], $uploadFile)) {
            $profilePicture = $uploadFile;
        } else {
            echo "<script>alert('Profile picture upload failed. Please check file permissions or try again.');</script>";
        }
    } else if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] != 4) { //check for other upload errors besides no file chosen
        echo "<script>alert('Error uploading profile picture. Error code: " . $_FILES['profilePicture']['error'] . "');</script>";
    }

    // SQL query to insert data (use prepared statements for security)
    $sql = "INSERT INTO barangay_id_applications (firstName, middleName, lastName, address, birthdate, occupation, profilePicture, application_date, status, age, mobile_number) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), 'Pending', ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssis", $firstName, $middleName, $lastName, $address, $birthdate, $occupation, $profilePicture, $age, $mobileNumber); // Bind age and mobile number

    if ($stmt->execute()) {
        echo "<script>alert('Barangay ID application submitted successfully!'); window.location.href = 'id.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
} else {
    // If it's not a POST request, try to retrieve user data from the session
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Retrieve user data from the residents table
        $sql_user = "SELECT first_name, middle_name, last_name, complete_address, birthdate, age, mobile_number FROM residents WHERE id = ?";
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
            $birthdate = $row_user['birthdate'];
            $age = $row_user['age']; // Retrieve age from residents table
            $mobileNumber = $row_user['mobile_number']; // Retrieve mobile number from residents table
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
    <title>Barangay ID Application Form</title>
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
    <h2>Barangay ID Application Form</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <div class="form-container">
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>" required>

            <label for="middleName">Middle Name:</label>
            <input type="text" id="middleName" name="middleName" value="<?php echo htmlspecialchars($middleName); ?>">

            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>" required>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>" required>

            <label for="birthdate">Date of Birth:</label>
            <input type="date" id="birthdate" name="birthdate" value="<?php echo htmlspecialchars($birthdate); ?>" required>

            <label for="age">Age:</label>
            <input type="number" id="age" name="age" value="<?php echo htmlspecialchars($age); ?>" required>

            <label for="mobileNumber">Mobile Number:</label>
            <input type="text" id="mobileNumber" name="mobileNumber" value="<?php echo htmlspecialchars($mobileNumber); ?>" required>

            <label for="occupation">Occupation:</label>
            <input type="text" id="occupation" name="occupation" value="<?php echo htmlspecialchars($occupation); ?>" required>

            <label for="profilePicture">Profile Picture:</label>
            <input type="file" id="profilePicture" name="profilePicture" accept="image/*" required>

            <button type="submit">Submit Application</button>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>