<?php
include_once("connections.php");
$conn = connection(); // Connect to the database

// Start session to access user data
session_start();

// Initialize variables to avoid undefined variable errors
$firstName = "";
$middleName = "";
$lastName = "";
$address = "";
$birthdate = "";
$birthplace = "";
$civilStatus = "";
$citizenship = "";
$occupation = "";
$age = "";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $address = $_POST['address'];
    $birthdate = $_POST['birthdate'];
    $birthplace = $_POST['birthplace'];
    $civilStatus = $_POST['civilStatus'];
    $citizenship = $_POST['citizenship'];
    $occupation = $_POST['occupation'];
    $age = $_POST['age'];

    // SQL query to insert data (use prepared statements for security)
    $sql = "INSERT INTO cedula_applications (firstName, middleName, lastName, address, birthdate, birthplace, civilStatus, citizenship, occupation, age) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssi", $firstName, $middleName, $lastName, $address, $birthdate, $birthplace, $civilStatus, $citizenship, $occupation, $age);

    if ($stmt->execute()) {
        echo "<script>alert('Cedula application submitted successfully!'); window.location.href = 'cedula.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
} else {
    // If it's not a POST request, try to retrieve user data from the session
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Retrieve user data from the residents table
        $sql_user = "SELECT first_name, middle_name, last_name, complete_address, birthdate, citizenship, civil_status, age FROM residents WHERE id = ?";
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
            $citizenship = $row_user['citizenship'];
            $civilStatus = $row_user['civil_status'];
            $age = $row_user['age'];
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
    <title>Cedula Application Form</title>
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

        input, select {
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
    <h2>Cedula Application Form</h2>
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

            <label for="birthdate">Date of Birth:</label>
            <input type="date" id="birthdate" name="birthdate" value="<?php echo htmlspecialchars($birthdate); ?>" required>

            <label for="age">Age:</label>
            <input type="number" id="age" name="age" value="<?php echo htmlspecialchars($age); ?>" required>

            <label for="birthplace">Place of Birth:</label>
            <input type="text" id="birthplace" name="birthplace" value="<?php echo htmlspecialchars($birthplace); ?>" required>

            <label for="civilStatus">Civil Status:</label>
            <select id="civilStatus" name="civilStatus" required>
                <option value="">Select...</option>
                <option value="single" <?php if ($civilStatus === 'single') echo 'selected'; ?>>Single</option>
                <option value="married" <?php if ($civilStatus === 'married') echo 'selected'; ?>>Married</option>
                <option value="widowed" <?php if ($civilStatus === 'widowed') echo 'selected'; ?>>Widowed</option>
                <option value="separated" <?php if ($civilStatus === 'separated') echo 'selected'; ?>>Separated</option>
            </select>

            <label for="citizenship">Citizenship:</label>
            <input type="text" id="citizenship" name="citizenship" value="<?php echo htmlspecialchars($citizenship); ?>" required>

            <label for="occupation">Occupation/Profession:</label>
            <input type="text" id="occupation" name="occupation" value="<?php echo htmlspecialchars($occupation); ?>" required>

            <button type="submit">Submit Application</button>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>