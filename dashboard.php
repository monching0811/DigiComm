<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include_once("connections.php");
$conn = connection(); // Connect to the database

// Retrieve user information
$user_id = $_SESSION['user_id'];
$sql = "SELECT first_name FROM residents WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($first_name);
$stmt->fetch();
$stmt->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
    <title>User Dashboard</title>
    <style>
        body {
            font-family: "Merriweather", serif;
            margin: 0;
            padding: 0;
            background-image: url('dash.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            display: flex; /* Use flexbox for layout */
        }

        .dashboard-container {
            display: flex;
            width: 100%; /* Take full width */
            background: linear-gradient(297deg, rgba(254, 168, 0, 0.5) 0.34%, rgba(0, 163, 85, 0.5) 100%);
        }

        .sidebar {
            width: 250px; /* Increased sidebar width */
            background-color: rgba(255, 255, 255, 0.85); /* Slightly less transparent */
            padding: 30px; /* Increased padding */
            border-radius: 0 25px 25px 0;
            display: flex;
            flex-direction: column; /* Stack items vertically */
        }

        .logo {
            text-align: center;
            margin-bottom: 30px; /* Increased margin */
        }

        .logo img {
            width: 180px; /* Increased logo size */
            height: 180px;
            border-radius: 50%;
            margin-bottom: 15px;
        }

        .main-nav ul {
            list-style: none;
            padding: 0;
        }

        .main-nav a {
            display: block;
            padding: 15px; /* Increased padding */
            text-decoration: none;
            color: #333;
            border-radius: 25px;
            margin-bottom: 8px; /* Slightly more space */
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .main-nav a:hover {
            background-color: rgba(0, 0, 0, 0.1);
            transform: scale(1.03); /* Reduced scale */
        }

        .main-nav .dropdown {
            display: none;
            background-color: rgba(255, 255, 255, 0.9); /* Less transparent dropdown */
            padding-left: 25px; /* Increased padding */
            border-radius: 0 0 25px 25px;
        }

        .main-nav li:hover .dropdown {
            display: block;
        }

        .main-content {
            flex: 1;
            padding: 30px; /* Increased padding */
        }

        .main-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px; /* Increased margin */
        }

        .welcome {
            font-size: 28px; /* Increased font size */
            color: #fff;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.4); /* Added text shadow */
        }

        .user-menu {
            position: relative;
            display: inline-flex; /* Use inline-flex for better alignment */
            align-items: center; /* Vertically align items */
        }

        .user-icon {
            font-size: 32px;
            cursor: pointer;
            color: #fff;
            padding: 12px;
            border-radius: 50%;
            background-color: rgba(8, 156, 33, 0.76);
            transition: transform 0.3s ease, background-color 0.3s ease, box-shadow 0.3s ease; /* Added transitions */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Subtle shadow */
        }

        .user-icon:hover {
            transform: scale(1.1);
            background-color: rgba(228, 8, 30, 0.85); /* Slightly darker on hover */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Stronger shadow on hover */
        }

        .user-menu .dropdown {
            display: none;
            position: absolute;
            top: 50px; /* Adjust as needed */
            right: 0;
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 10px; /* Rounded corners */
            padding: 10px;
            list-style: none;
            width: 150px; /* Adjust width */
            z-index: 10;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }
        .user-menu:hover .dropdown {
            display: block;
        }

        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .user-menu .dropdown li a {
            display: block;
            padding: 8px 12px;
            text-decoration: none;
            color: #333;
            border-radius: 5px;
            transition: background-color 0.3s ease; /* Add transition for smooth effect */
        }

        .user-menu .dropdown li a:hover {
            background-color: rgb(197, 19, 19); /* Light hover background */
        }

        .dropdown li:hover{
            color: red;
        }


        .announcements, .news {
            background-color: rgba(255, 255, 255, 0.85); /* Slightly less transparent */
            border-radius: 25px;
            padding: 20px;
            margin-bottom: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease; /* Added box-shadow transition */
        }

        .announcements:hover, .news:hover {
            transform: translateY(-8px); /* Increased lift */
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2); /* Added stronger shadow */
        }

        .announcements h2, .news h2 {
            color: #333;
            margin-bottom: 15px;
            font-size: 24px; /* Increased font size */
        }

        #contentFrame {
            width: 100%;
            height: 600px; /* Increased height */
            border: none;
            display: none;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="logo">
                <img src="logo.jpg" alt="DigiComm Logo">
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="#" onclick="showDashboard(event)">Dashboard</a></li>
                    <li>
                        <a href="#">Requests</a>
                        <ul class="dropdown">
                            <li><a href="#" onclick="loadFrame(event, 'cedula.php')">Cedula</a></li>
                            <li><a href="#" onclick="loadFrame(event, 'indigency.php')">Indigency</a></li>
                            <li><a href="#" onclick="loadFrame(event, 'clearance.php')">Clearance</a></li>
                            <li><a href="#" onclick="loadFrame(event, 'id.php')">ID</a></li>
                            <li><a href="#" onclick="loadFrame(event, 'permit.php')">Permit</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Programs</a>
                        <ul class="dropdown">
                            <li><a href="#" onclick="loadFrame(event, 'welcome.php')">Welcome</a></li>
                            <li><a href="#" onclick="loadFrame(event, 'pensionary.php')">Pensionary</a></li>
                        </ul>
                    </li>
                    <li><a href="#" onclick="loadFrame(event, 'message.php')">Message</a></li>
                </ul>
            </nav>
        </aside>
        <main class="main-content">
            <header class="main-header">
                <div class="welcome">Welcome <?php echo htmlspecialchars($first_name); ?></div>
                <div class="user-menu" id="userMenu">
                    <div class="user-icon" onclick="toggleUserMenu()">👤</div>
                    <ul class="dropdown" id="userDropdown">
                        <li><a href="user.php" onclick="loadFrame(event, 'user.php')">User</a></li>
                        <li><a href="settings.php" onclick="loadFrame(event, 'settings.php')">Settings</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </div>
                </header>
            <section class="announcements" id="announcementsSection">
                <h2>Announcements</h2>
            </section>
            <section class="news" id="newsSection">
                <h2>News</h2>
            </section>
            <iframe id="contentFrame"></iframe>
        </main>
    </div>
    <script>
        function toggleUserMenu() {
            var dropdown = document.getElementById("userDropdown");
            if (dropdown.style.display === "block") {
                dropdown.style.display = "none";
            } else {
                dropdown.style.display = "block";
            }
        }
        function loadFrame(event, url) {
            event.preventDefault();
            document.getElementById("contentFrame").src = url;
            document.getElementById("contentFrame").style.display = "block";
            document.getElementById("announcementsSection").style.display = "none";
            document.getElementById("newsSection").style.display = "none";
        }
        function showDashboard(event) {
            event.preventDefault();
            document.getElementById("contentFrame").style.display = "none";
            document.getElementById("announcementsSection").style.display = "block";
            document.getElementById("newsSection").style.display = "block";
        }
    </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>