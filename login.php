<?php
// Database Connection Details (Replace with your actual credentials)
$host = "localhost";
$username = "root";
$password = "081100";
$dbname = "digicomm";

// Function to sanitize input data
function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Initialize variables
$error_message = "";

// Language handling
$language = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'en'; // Default to English

$translations = [
    'en' => [
        'login_title' => 'Login Here',
        'username' => 'Username',
        'password' => 'Password',
        'login_button' => 'Login',
        'forgot_password' => 'Forgot Password?',
        'register' => 'Register',
        'invalid_credentials' => 'Invalid username or password.',
    ],
    'tl' => [
        'login_title' => 'Mag-login Dito',
        'username' => 'Username',
        'password' => 'Password',
        'login_button' => 'Mag-login',
        'forgot_password' => 'Nakalimutan ang Password?',
        'register' => 'Magrehistro',
        'invalid_credentials' => 'Hindi wastong username o password.',
    ],
];

function __($key)
{
    global $language, $translations;
    return isset($translations[$language][$key]) ? $translations[$language][$key] : $key;
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve form data
    $username = sanitize_input($_POST["username"]);
    $password = $_POST["password"];

    // Basic form validation (you might add more client-side validation)
    if (empty($username) || empty($password)) {
        $error_message = __("Please enter both username and password.");
    } else {
        // Create connection
        $conn = new mysqli("localhost", "root", "081100", "digicomm");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query the database to check for the user
        $sql = "SELECT id, password_hash FROM residents WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($user_id, $hashed_password);
            $stmt->fetch();

            // Verify the password
            if (password_verify($password, $hashed_password)) {
                // Password is correct, login successful
                // Start a session and store the user ID
                session_start();
                $_SESSION['user_id'] = $user_id;

                echo "<script>alert('Login successful!'); window.location.href = 'dashboard.php';</script>";
                exit;
            } else {
                // Password is incorrect
                $error_message = __("invalid_credentials");
            }
        } else {
            // No user found with that username
            $error_message = __("invalid_credentials");
        }
        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= __('login_title') ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700;900&display=swap" rel="stylesheet" />
    <style>
        /* Your CSS here */
        :root {
            --color-primary: #00a355;
            --color-accent: #fea800;
            --color-link: #4dc9fe;
            --color-text-muted: #c6c3c3;
            --color-white: #fff;
            --shadow-input: 0 4px 4px rgba(0, 0, 0, 0.25);
            --shadow-card: 0 4px 12px rgba(0, 0, 0, 0.1);
            --border-radius: 20px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            transition: all 0.3s ease;
            /* Added transition */
        }

        body {
            font-family: "Merriweather", serif;
            line-height: 1.5;
            opacity: 0;
            /* Initial opacity for fade-in effect */
            transition: opacity 0.5s ease;
            /* Fade-in body transition */
            background-image: url('cover.jpg'); /* Add your image path */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh; /* Ensure full viewport height is covered */
        }

        body.loaded {
            opacity: 1;
            /* Fade-in when body is loaded */
        }

        .login-container {
            display: flex;
            min-height: 100vh;
            background: linear-gradient(297deg, rgba(254, 168, 0, 0.5) 0.34%, rgba(0, 163, 85, 0.5) 100%); /* Add semi-transparent gradient overlay */
        }

        .branding-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px;
            color: var(--color-white);
        }

        .brand-logo {
            width: 250px;
            height: 250px;
            border-radius: 50%;
            margin-bottom: 40px;
        }

        .brand-name {
            font-size: 50px;
            font-weight: 900;
            margin-bottom: 20px;
        }

        .brand-name-light {
            color: var(--color-white);
        }

        .brand-name-accent {
            color: var(--color-accent);
        }

        .form-section {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-container {
            padding: 40px;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-card);
            max-width: 400px;
            /* Adjusted max-width */
            width: 80%;
            /* Added width */
            background-color: rgb(8, 168, 48);;
        }

        .form-title {
            color: white;
            font-size: 40px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 40px;
        }

        .login-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-input {
            width: 100%;
            padding: 15px;
            border: 2px solid rgba(0, 0, 0, 0.25);
            border-radius: var(--border-radius);
            font-family: "Merriweather", serif;
            font-size: 16px;
            box-shadow: var(--shadow-input);
            background-color: var(--color-white);
        }

        .submit-button {
            color: var(--color-white);
            font-family: "Merriweather", serif;
            font-size: 24px;
            font-weight: 700;
            padding: 15px;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            margin-top: 20px;
            background-color: rgb(250, 65, 65);
            transition: background-color 0.3s ease;
        }

        .submit-button:hover {
            background-color:rgb(147, 125, 125);
        }

        .form-links{
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .form-links a:hover{
            color: rgb(250, 65, 65);
        }

        .form-links a {
            color: var(--color-link);
            text-decoration: none;
        }

        /* Focus styles for accessibility */
        .form-input:focus,
        .submit-button:focus,
        .form-links a:focus {
            outline: 2px solid var(--color-link);
            outline-offset: 2px;
        }

        .error-message {
            color: red;
            margin-bottom: 10px;
        }

        /* Responsive styles */
        @media (max-width: 991px) {
            .login-container {
                flex-direction: column;
            }

            .branding-section {
                padding: 20px;
            }

            .brand-logo {
                width: 200px;
                height: 200px;
            }

            .brand-name {
                font-size: 40px;
            }

            .form-container {
                margin: 0;
            }
        }

        @media (max-width: 640px) {
            .brand-logo {
                width: 150px;
                height: 150px;
            }

            .brand-name {
                font-size: 30px;
            }

            .form-title {
                font-size: 30px;
            }

            .form-input {
                font-size: 14px;
            }

            .submit-button {
                font-size: 20px;
            }
        }
    </style>

</head>

<body onload="document.body.classList.add('loaded');">
    <main class="login-container">
        <section class="branding-section">
            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/67bc096b852297a6d5f13c31edab7330eb0fd1fd" alt="DigiComm Logo" class="brand-logo" />
            <h1 class="brand-name">
                <span class="brand-name-light">DIGI</span>
                <span class="brand-name-accent">COMM</span>
            </h1>
        </section>

        <section class="form-section">
            <div class="form-container">
                <h2 class="form-title"><?= __('login_title') ?></h2>
                <?php if (isset($error_message) && $error_message) : ?>
                    <p class="error-message">
                        <?php echo $error_message; ?>
                    </p>
                <?php endif; ?>
                <form class="login-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <input type="text" name="username" placeholder="<?= __('username') ?> *" class="form-input" required aria-label="Username" />
                    <input type="password" name="password" placeholder="<?= __('password') ?> *" class="form-input" required aria-label="Password" />
                    <button type="submit" class="submit-button"><?= __('login_button') ?></button>
                    <div class="form-links">
                        <a href="register.php"><?= __('register') ?></a>
                        <a href="#"><?= __('forgot_password') ?></a>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>

</html>