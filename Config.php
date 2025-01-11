<?php
$host = 'localhost';
$db = 'galactic_empires';
$user = 'root';
$pass = 'password';

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (Exception $e) {
    die('Connection failed: ' . $e->getMessage());
}
?>
// Configuration for database connection and other global settings

// Database settings
define('DB_HOST', 'localhost'); // Database host
define('DB_USER', 'root'); // Database user
define('DB_PASS', 'password'); // Database password
define('DB_NAME', 'game_database'); // Database name

// Game settings
define('GAME_NAME', 'Galactic Empires');
define('GAME_VERSION', '1.0');
define('DEFAULT_CURRENCY', 1000); // Default starting currency for players

// Game environment
define('ENVIRONMENT', 'development'); // Options: development, production

// Debug mode settings
define('DEBUG_MODE', true); // Set to false in production

// Server settings
define('SERVER_PORT', 8080); // Port for the game server
define('MAX_PLAYERS', 1000); // Maximum number of players online at the same time

// Time settings
define('TIMEZONE', 'UTC'); // Timezone for the server

// File paths for logs
define('LOG_FILE_PATH', '/var/logs/game_logs/');
define('ERROR_LOG_FILE', 'error.log');
define('TRANSACTION_LOG_FILE', 'transactions.log');

// Define API keys or third-party integrations here
define('PAYMENT_API_KEY', 'your-payment-api-key-here');
define('EMAIL_API_KEY', 'your-email-api-key-here');

// Set up error reporting for development
if (ENVIRONMENT == 'development' && DEBUG_MODE) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// Create database connection
function createDatabaseConnection()
{
    try {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
        $pdo = new PDO($dsn, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die('Database connection failed: ' . $e->getMessage());
    }
}

// Example usage: $db = createDatabaseConnection();
?>
