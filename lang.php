<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Language - Barangay 173</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Language Options</h1>
        <p>This page allows you to select your preferred language for viewing the Barangay 173 website.</p>

        <form id="languageForm">
            <div class="mb-3">
                <label for="languageSelect" class="form-label">Select Language:</label>
                <select class="form-select" id="languageSelect">
                    <option value="en" <?php if(isset($_COOKIE['language']) && $_COOKIE['language'] == 'en') echo 'selected'; ?>>English</option>
                    <option value="tl" <?php if(isset($_COOKIE['language']) && $_COOKIE['language'] == 'tl') echo 'selected'; ?>>Filipino (Tagalog)</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Apply Language</button>
        </form>
    </div>

    <script>
        document.getElementById('languageForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const selectedLanguage = document.getElementById('languageSelect').value;

            // Set a cookie to store the language preference
            document.cookie = "language=" + selectedLanguage + "; path=/";

            // Redirect to the landing page (index.php)
            window.location.href = "index.php"; // Adjust to the correct landing page filename
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>