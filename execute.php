<?php
include_once 'init.php';


$username = getenv('SSH_USER');
$password = getenv('SSH_PASS');
$host = getenv('SSH_HOST');
try {
    $shell = new Shell($host, $username, $password);

    if (isset($_POST['command'])) {
        $command = $_POST['command'];
        $output = $shell->exec($command);
        echo "<pre style='background-color: #333; color: #fff; padding: 15px; border-radius: 8px; overflow-x: auto;'>";
        echo htmlspecialchars($output);
        echo "</pre>";
    } else {
        echo "<div class='error'>No command provided.</div>";
    }
} catch (Exception $e) {
    echo "<div class='error'><h2 style='color: #f44336;'>Error</h2>";
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p></div>";
}
