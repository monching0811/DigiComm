<?php
// Database Connection Details (Replace with your actual credentials)
$host = "localhost";
$username = "root";
$password = "081100";
$dbname = "digicomm";

// Function to sanitize input data
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Initialize variables to avoid errors later
$error_message = "";
$is_verified = null;

// Language handling
$language = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'en'; // Default to English

$translations = [
    'en' => [
        'register_title' => 'Register for DigiComm',
        'first_name' => 'First Name',
        'middle_name' => 'Middle Name',
        'last_name' => 'Last Name',
        'complete_address' => 'Complete Address',
        'mobile_number' => 'Mobile Number',
        'email_address' => 'Email Address',
        'username' => 'Username',
        'password' => 'Password',
        'confirm_password' => 'Confirm Password',
        'agree_terms' => 'I agree to the',
        'terms_and_conditions' => 'Terms and Conditions',
        'agree_privacy' => 'I have read and agree to the',
        'privacy_policy' => 'Privacy Policy',
        'register_button' => 'Register',
        'already_have_account' => 'Already have an account?',
        'login_here' => 'Login here',
        'username_help' => 'Must be at least 6 characters long with no spaces.',
        'password_help' => 'Must be at least 8 characters long, including uppercase, lowercase, and a number.',
        'required_field' => 'Please fill in all the required fields.',
        'invalid_email' => 'Invalid email format.',
        'password_too_short' => 'Password must be at least 8 characters long.',
        'passwords_dont_match' => 'Passwords do not match.',
        'agree_terms_error' => 'You must agree to the Terms and Conditions.',
        'agree_privacy_error' => 'You must agree to the Privacy Policy.',
        'resident_not_found' => 'You are not verified as a registered resident. Registration cannot be completed.',
        'registration_error' => 'Error during registration: ',
        'duplicate_username' => 'The username you entered is already in use. Please choose a different username.',
        'duplicate_email' => 'The email you entered is already in use. Please choose a different email.',
        'duplicate_mobile' => 'The mobile number you entered is already in use. Please choose a different mobile number.',
        'birthdate' => 'Birthdate',
        'civil_status' => 'Civil Status',
        'citizenship' => 'Citizenship',
        'single' => 'Single',
        'married' => 'Married',
        'widowed' => 'Widowed',
        'separated' => 'Separated',
        'birthdate_required' => 'Birthdate is required.',
        'civil_status_required' => 'Civil status is required.',
        'citizenship_required' => 'Citizenship is required.',
        'age' => 'Age',
        'invalid_age' => 'Invalid Age Format.',
    ],
    'tl' => [
        'register_title' => 'Magrehistro para sa DigiComm',
        'first_name' => 'Unang Pangalan',
        'middle_name' => 'Gitnang Pangalan',
        'last_name' => 'Huling Pangalan',
        'complete_address' => 'Kumpletong Address',
        'mobile_number' => 'Numero ng Mobile',
        'email_address' => 'Email Address',
        'username' => 'Username',
        'password' => 'Password',
        'confirm_password' => 'Kumpirmahin ang Password',
        'agree_terms' => 'Sumasang-ayon ako sa',
        'terms_and_conditions' => 'Mga Tuntunin at Kundisyon',
        'agree_privacy' => 'Nabasa ko at sumasang-ayon ako sa',
        'privacy_policy' => 'Patakaran sa Pagkapribado',
        'register_button' => 'Magrehistro',
        'already_have_account' => 'Mayroon ka nang account?',
        'login_here' => 'Mag-login dito',
        'username_help' => 'Dapat ay hindi bababa sa 6 na character ang haba na walang mga puwang.',
        'password_help' => 'Dapat ay hindi bababa sa 8 character ang haba, kabilang ang malalaki, maliliit na letra, at isang numero.',
        'required_field' => 'Mangyaring punan ang lahat ng kinakailangang field.',
        'invalid_email' => 'Hindi wastong format ng email.',
        'password_too_short' => 'Ang password ay dapat na hindi bababa sa 8 character ang haba.',
        'passwords_dont_match' => 'Hindi magkatugma ang mga password.',
        'agree_terms_error' => 'Dapat kang sumang-ayon sa Mga Tuntunin at Kundisyon.',
        'agree_privacy_error' => 'Dapat kang sumang-ayon sa Patakaran sa Pagkapribado.',
        'resident_not_found' => 'Hindi ka napatunayan bilang isang rehistradong residente. Hindi makukumpleto ang pagpaparehistro.',
        'registration_error' => 'Error sa pagpaparehistro: ',
        'duplicate_username' => 'Ang username na iyong ipinasok ay ginagamit na. Mangyaring pumili ng ibang username.',
        'duplicate_email' => 'Ang email na iyong ipinasok ay ginagamit na. Mangyaring pumili ng ibang email.',
        'duplicate_mobile' => 'Ang numero ng mobile na iyong ipinasok ay ginagamit na. Mangyaring pumili ng ibang numero ng mobile.',
        'birthdate' => 'Petsa ng Kapanganakan',
        'civil_status' => 'Katayuan Sibil',
        'citizenship' => 'Pagkamamamayan',
        'single' => 'Single',
        'married' => 'Kasal',
        'widowed' => 'Balo',
        'separated' => 'Hiwalay',
        'birthdate_required' => 'Kinakailangan ang Petsa ng Kapanganakan.',
        'civil_status_required' => 'Kinakailangan ang katayuan sibil.',
        'citizenship_required' => 'Kinakailangan ang Pagkamamamayan.',
        'age' => 'Edad',
        'invalid_age' => 'Hindi wastong format ng edad.',
    ],
];

function __($key) {
    global $language, $translations;
    return isset($translations[$language][$key]) ? $translations[$language][$key] : $key;
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve form data
    $first_name = sanitize_input($_POST["first_name"]);
    $middle_name = sanitize_input($_POST["middle_name"]);
    $last_name = sanitize_input($_POST["last_name"]);
    $complete_address = sanitize_input($_POST["complete_address"]);
    $mobile_number = sanitize_input($_POST["mobile"]);
    $email_address = sanitize_input($_POST["email"]);
    $username = sanitize_input($_POST["username"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $agreeTerms = isset($_POST["agreeTerms"]);
    $agreePrivacy = isset($_POST["agreePrivacy"]);
    $birthdate = sanitize_input($_POST["birthdate"]);
    $civil_status = sanitize_input($_POST["civil_status"]);
    $citizenship = sanitize_input($_POST["citizenship"]);
    $age = sanitize_input($_POST["age"]);

    // Basic form validation (Server-side - important!)
    if (empty($first_name) || empty($last_name) || empty($complete_address) || empty($mobile_number) || empty($email_address) || empty($username) || empty($password) || empty($birthdate) || empty($civil_status) || empty($citizenship) || empty($age)) {
        echo "<script>alert('" . __("required_field") . "');</script>";
    } elseif (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('" . __("invalid_email") . "');</script>";
    } elseif (strlen($password) < 8) {
        echo "<script>alert('" . __("password_too_short") . "');</script>";
    } elseif ($password !== $confirm_password) {
        echo "<script>alert('" . __("passwords_dont_match") . "');</script>";
    } elseif (!$agreeTerms) {
        echo "<script>alert('" . __("agree_terms_error") . "');</script>";
    } elseif (!$agreePrivacy) {
        echo "<script>alert('" . __("agree_privacy_error") . "');</script>";
    } elseif (!is_numeric($age)) {
        echo "<script>alert('" . __("invalid_age") . "');</script>";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Create connection
        $conn = new mysqli("localhost", "root", "081100", "digicomm");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if first and last name match in registered_residents table
        $stmt_check = $conn->prepare("SELECT id FROM registered_residents WHERE first_name = ? AND last_name = ?");
        if (!$stmt_check) {
            die("Error preparing statement: " . $conn->error);
        }
        $stmt_check->bind_param("ss", $first_name, $last_name);
        if (!$stmt_check->execute()) {
            die("Error executing statement: " . $stmt_check->error);
        }
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
            // Match found, set is_verified to TRUE
            $is_verified = 1;

            // Check for duplicate first and last name
            $stmt_name_check = $conn->prepare("SELECT first_name, last_name FROM residents WHERE first_name = ? AND last_name = ?");
            $stmt_name_check->bind_param("ss", $first_name, $last_name);
            $stmt_name_check->execute();
            $stmt_name_check->store_result();

            if ($stmt_name_check->num_rows > 0) {
                echo "<script>alert('A user with the same first and last name already exists.'); window.location.href = 'register.php';</script>";
                exit;
            }
            $stmt_name_check->close();

            // Check for duplicate username
            $stmt_username_check = $conn->prepare("SELECT username FROM residents WHERE username = ?");
            $stmt_username_check->bind_param("s", $username);
            $stmt_username_check->execute();
            $stmt_username_check->store_result();

            if ($stmt_username_check->num_rows > 0) {
                echo "<script>alert('" . __("duplicate_username") . "'); window.location.href = 'register.php';</script>";
                exit;
            }
            $stmt_username_check->close();

            // Check for duplicate email
            $stmt_email_check = $conn->prepare("SELECT email_address FROM residents WHERE email_address = ?");
            $stmt_email_check->bind_param("s", $email_address);
            $stmt_email_check->execute();
            $stmt_email_check->store_result();

            if ($stmt_email_check->num_rows > 0) {
                echo "<script>alert('" . __("duplicate_email") . "'); window.location.href = 'register.php';</script>";
                exit;
            }
            $stmt_email_check->close();

            // Check for duplicate mobile number
            $stmt_mobile_check = $conn->prepare("SELECT mobile_number FROM residents WHERE mobile_number = ?");
            $stmt_mobile_check->bind_param("s", $mobile_number);
            $stmt_mobile_check->execute();
            $stmt_mobile_check->store_result();

            if ($stmt_mobile_check->num_rows > 0) {
                echo "<script>alert('" . __("duplicate_mobile") . "'); window.location.href = 'register.php';</script>";
                exit;
            }
            $stmt_mobile_check->close();

            // Insert user data into residents table (with is_verified field)
            $stmt = $conn->prepare("INSERT INTO residents (first_name, middle_name, last_name, complete_address, mobile_number, email_address, username, password_hash, is_verified, birthdate, civil_status, citizenship, age) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            if (!$stmt) {
                die("Error preparing statement: " . $conn->error);
            }
            $stmt->bind_param("ssssssssisssi", $first_name, $middle_name, $last_name, $complete_address, $mobile_number, $email_address, $username, $hashed_password, $is_verified, $birthdate, $civil_status, $citizenship, $age);

            if ($stmt->execute()) {
                // Successful registration, display JavaScript alert and redirect
                echo "<script>alert('Successful registration, you are verified, continue to log in.'); window.location.href = 'login.php';</script>";
                exit; // Important: Stop further execution
            } else {
                // Display JavaScript alert for database errors
                echo "<script>alert('" . __("registration_error") . $conn->error . "');</script>";
            }
            $stmt->close();
        } else {
            // No match found, set is_verified to FALSE
            $is_verified = 0;
            echo "<script>alert('" . __("resident_not_found") . "'); window.location.href = 'register.php';</script>";
            exit; // Important: Stop further execution
        }
        $stmt_check->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= __('register_title') ?></title>
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
            background-image: url('cover.jpg');
            /* Add your image path */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            /* Ensure full viewport height is covered */
        }

        body.loaded {
            opacity: 1;
            /* Fade-in when body is loaded */
        }

        .registration-container {
            display: flex;
            min-height: 100vh;
            background: linear-gradient(297deg, var(--color-accent) 0.34%, var(--color-primary) 100%);
            background: linear-gradient(297deg, rgba(254, 168, 0, 0.5) 0.34%, rgba(0, 163, 85, 0.5) 100%);
            /* Add semi-transparent gradient overlay */
        }

        .branding-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px;
            color: var(--color-white);
        }

        .brand-logo {
            width: 329px;
            height: 326px;
            border-radius: 445px;
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

        .brand-description {
            font-size: 20px;
            font-weight: 700;
            text-align: center;
            max-width: 428px;
        }

        .form-section {
            flex: 1;
            position: relative;
        }

        .form-container {
            padding: 40px;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-card);
            max-width: 800px;
            margin: 20px auto;
            background-color: var(--color-white);
        }

        .form-title {
            color: var(--color-primary);
            font-size: 40px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 40px;
        }

        .registration-form {
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

        .input-hint {
            color: var(--color-text-muted);
            font-size: 14px;
            margin-top: -10px;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .checkbox-input {
            width: 20px;
            height: 20px;
            border: 2px solid var(--color-text-muted);
        }

        .checkbox-label {
            font-size: 16px;
            color: var(--color-text-muted);
        }

        .link-accent {
            color: var(--color-link);
            text-decoration: none;
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
            background-color: var(--color-primary);
            transition: background-color 0.3s ease;
        }

        .submit-button:hover {
            background-color: rgb(147, 125, 125);
        }

        .login-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
        }

        .login-text {
            color: var(--color-text-muted);
            font-size: 24px;
        }

        .login-link {
            color: var(--color-link);
            font-size: 21px;
            text-decoration: none;
        }

        .login-link:hover {
            color: rgb(250, 65, 65)
        }

        /* Focus styles for accessibility */
        .form-input:focus,
        .checkbox-input:focus,
        .submit-button:focus,
        .login-link:focus {
            outline: 2px solid var(--color-link);
            outline-offset: 2px;
        }

        /* Responsive styles */
        @media (max-width: 991px) {
            .registration-container {
                flex-direction: column;
            }

            .branding-section {
                padding: 20px;
            }

            .brand-logo {
                width: 250px;
                height: 250px;
            }

            .brand-name {
                font-size: 40px;
            }

            .brand-description {
                font-size: 18px;
            }

            .form-container {
                margin: 0;
            }
        }

        @media (max-width: 640px) {
            .brand-logo {
                width: 200px;
                height: 200px;
            }

            .brand-name {
                font-size: 30px;
            }

            .brand-description {
                font-size: 16px;
            }

            .form-title {
                font-size: 30px;
            }

            .form-input {
                font-size: 14px;
            }

            .checkbox-label {
                font-size: 14px;
            }

            .submit-button {
                font-size: 20px;
            }

            .login-text {
                font-size: 18px;
            }

            .login-link {
                font-size: 18px;
            }
        }
    </style>

</head>

<body onload="document.body.classList.add('loaded');">
    <main class="registration-container">
        <section class="branding-section">
            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/67bc096b852297a6d5f13c31edab7330eb0fd1fd" alt="DigiComm Logo" class="brand-logo" />
            <h1 class="brand-name">
                <span class="brand-name-light">DIGI</span>
                <span class="brand-name-accent">COMM</span>
            </h1>
            <p class="brand-description">
                Simplify your interactions with the Barangay. Request essential documents like clearances and IDs online, and stay informed about upcoming events. Explore DigiComm and experience a more connected community
            </p>
        </section>

        <section class="form-section">
            <div class="form-container">
                <h2 class="form-title"><?= __('register_title') ?></h2>
                <form class="registration-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm(this);">
                    <input type="text" name="first_name" placeholder="<?= __('first_name') ?> *" class="form-input" required aria-label="First Name" />
                    <input type="text" name="middle_name" placeholder="<?= __('middle_name') ?>" class="form-input" aria-label="Middle Name" />
                    <input type="text" name="last_name" placeholder="<?= __('last_name') ?> *" class="form-input" required aria-label="Last Name" />
                    <input type="date" name="birthdate" placeholder="<?= __('birthdate') ?> *" class="form-input" required aria-label="Birthdate" />
                    <input type="number" name="age" placeholder="<?= __('age') ?> *" class="form-input" required aria-label="Age" />
                    <select name="civil_status" class="form-input" required aria-label="Civil Status">
                        <option value="">Select...</option>
                        <option value="single"><?= __('single') ?></option>
                        <option value="married"><?= __('married') ?></option>
                        <option value="widowed"><?= __('widowed') ?></option>
                        <option value="separated"><?= __('separated') ?></option>
                    </select>
                    <input type="text" name="citizenship" placeholder="<?= __('citizenship') ?> *" class="form-input" required aria-label="Citizenship" />
                    <input type="text" name="complete_address" placeholder="<?= __('complete_address') ?> *" class="form-input" required aria-label="Complete Address" />
                    <input type="tel" name="mobile" placeholder="<?= __('mobile_number') ?> *" class="form-input" required pattern="[0-9]*" aria-label="Mobile Number" />
                    <input type="email" name="email" placeholder="<?= __('email_address') ?> *" class="form-input" required aria-label="Email Address" />
                    <input type="text" name="username" placeholder="<?= __('username') ?> *" class="form-input" required minlength="6" aria-label="Username" />
                    <p class="input-hint">
                        <?= __('username_help') ?>
                    </p>
                    <input type="password" name="password" placeholder="<?= __('password') ?> *" class="form-input" required minlength="8" aria-label="Password" />
                    <p class="input-hint">
                        <?= __('password_help') ?>
                    </p>
                    <input type="password" name="confirm_password" placeholder="<?= __('confirm_password') ?> *" class="form-input" required aria-label="Confirm Password" />
                    <div class="checkbox-group">
                        <input type="checkbox" id="terms" name="agreeTerms" class="checkbox-input" required />
                        <label for="terms" class="checkbox-label">
                            <?= __('agree_terms') ?>
                            <a href="term&condition.php" class="link-accent"><?= __('terms_and_conditions') ?></a>
                            *
                        </label>
                    </div>
                    <div class="checkbox-group">
                        <input type="checkbox" id="privacy" name="agreePrivacy" class="checkbox-input" required />
                        <label for="privacy" class="checkbox-label">
                            <?= __('agree_privacy') ?>
                            <a href="policy.php" class="link-accent"><?= __('privacy_policy') ?></a>
                            *
                        </label>
                    </div>
                    <button type="submit" class="submit-button"><?= __('register_button') ?></button>
                    <div class="login-section">
                        <p class="login-text"><?= __('already_have_account') ?></p>
                        <a href="login.php" class="login-link"><?= __('login_here') ?></a>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <script>
        function validateForm(form) {
            const inputs = form.querySelectorAll('input[required]');
            let isValid = true;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const passwordMinLength = 8;
            const usernameMinLength = 6;
            for (const input of inputs) {
                if (input.value.trim() === '') {
                    displayError(input, '<?= __('required_field') ?>');
                    isValid = false;
                } else if (input.type === 'email' && !emailRegex.test(input.value)) {
                    displayError(input, '<?= __('invalid_email') ?>');
                    isValid = false;
                } else if (input.id === 'password' && input.value.length < passwordMinLength) {
                    displayError(input, `<?= __('password_too_short') ?>`);
                    isValid = false;
                } else if (input.id === 'username' && input.value.length < usernameMinLength) {
                    displayError(input, `Username must be at least ${usernameMinLength} characters long.`);
                    isValid = false;
                } else if (input.id === 'confirmPassword' && form.querySelector('input[name="password"]').value !== input.value) {
                    displayError(input, '<?= __('passwords_dont_match') ?>');
                    isValid = false;
                } else {
                    clearError(input);
                }
            }

            const agreeTerms = form.querySelector('input[name="agreeTerms"]');
            const agreePrivacy = form.querySelector('input[name="agreePrivacy"]');
            if (agreeTerms && !agreeTerms.checked) {
                displayError(agreeTerms.closest('.checkbox-group'), '<?= __('agree_terms_error') ?>');
                isValid = false;
            }
            if (agreePrivacy && !agreePrivacy.checked) {
                displayError(agreePrivacy.closest('.checkbox-group'), '<?= __('agree_privacy_error') ?>');
                isValid = false;
            }

            return isValid;
        }

        function displayError(input, message) {
            const errorDiv = document.createElement('div');
            errorDiv.classList.add('error-message');
            errorDiv.textContent = message;
            const parent = input.closest('.form-input') ? input.closest('.form-input') : input.closest('.checkbox-group');
            if (parent) {
                parent.parentNode.insertBefore(errorDiv, parent.nextSibling);
            }
            input.style.borderColor = '#dc3545';
        }

        function clearError(input) {
            input.style.borderColor = '';
            const errorDiv = input.closest('.form-input') ? input.closest('.form-input').parentNode.querySelector('.error-message') : input.closest('.checkbox-group').parentNode.querySelector('.error-message');
            if (errorDiv) {
                errorDiv.remove();
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const registrationForm = document.querySelector('form');
            if (registrationForm) {
                registrationForm.addEventListener('submit', function(event) {
                    if (!validateForm(this)) {
                        event.preventDefault();
                    }
                });
            }
        });
    </script>
</body>

</html>