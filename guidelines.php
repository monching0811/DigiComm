<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
    display: flex;
    height: 100vh;
}

.container {
    display: flex;
    width: 100%;
    background: linear-gradient(to right, #63b5f0, #99d98c);
}

.left-section {
    flex: 1;
    padding: 20px;
    color: white;
}

.logo {
    width: 100px; /* Adjust logo size */
}

h1 {
    font-size: 36px;
    margin: 20px 0;
}

.right-section {
    flex: 1;
    padding: 40px;
    background: white;
}

.right-section h2 {
    margin-bottom: 20px;
    color: #2c3e50;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    margin: 10px 0 5px;
}

input {
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    padding: 10px;
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #219639;
}

.checkbox-group {
    margin-bottom: 15px;
}

.checkbox-group input {
    margin-right: 5px;
}

small {
    color: #555;
    margin-top: -10px;
}
    </style>
    <title>DigiComm Registration</title>
</head>
<body>
    <div class="container">
        <div class="left-section">
            <img src="logo.png" alt="DigiComm Logo" class="logo"> <!-- Replace logo.png with your logo path -->
            <h1>DIGICOMM</h1>
            <p>Simplify your interactions with the Barangay. Request essential documents like clearances and IDs online, and stay informed about upcoming events. Explore DigiComm and experience a more connected community.</p>
        </div>
        <div class="right-section">
            <h2>Register Here</h2>
            <form>
                <label for="first-name">First Name *</label>
                <input type="text" id="first-name" required>

                <label for="middle-name">Middle Name</label>
                <input type="text" id="middle-name">

                <label for="last-name">Last Name *</label>
                <input type="text" id="last-name" required>

                <label for="address">Complete Address *</label>
                <input type="text" id="address" required>

                <label for="mobile">Mobile Number *</label>
                <input type="tel" id="mobile" required>

                <label for="email">Email Address *</label>
                <input type="email" id="email" required>

                <label for="username">Username *</label>
                <input type="text" id="username" required>
                <small>Must be at least 6 characters long with no spaces</small>

                <label for="password">Password *</label>
                <input type="password" id="password" required>
                <small>Must be at least 8 characters long, including uppercase, lowercase, and a number</small>

                <label for="confirm-password">Confirm Password *</label>
                <input type="password" id="confirm-password" required>

                <div class="checkbox-group">
                    <input type="checkbox" required> I agree to the <a href="#">Terms and Conditions</a> *
                    <input type="checkbox" required> I have read and agree to the <a href="#">Privacy Policy</a> *
                </div>

                <button type="submit">Register</button>
            </form>
            <p>Already have an account? <a href="#">Log in here</a></p>
        </div>
    </div>
</body>
</html>