<?php

require_once __DIR__ . "/../../../config/env.php";
require_once __DIR__ . "/../../helpers/connectDb.php";

$dbName = getenv("DB_NAME");
$pdo = connectDb(false);

$pdo->exec("CREATE DATABASE IF NOT EXISTS $dbName");
echo "Created database $dbName.\n";

$pdo->exec("USE $dbName");
echo "Using database $dbName.\n";

$sql = "CREATE TABLE IF NOT EXISTS migrations (
id INT AUTO_INCREMENT PRIMARY KEY,
migration VARCHAR(255) NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$pdo->exec($sql);
echo "Created migrations table.\n";

require_once __DIR__ . "/../migration/start.php";

echo "Setup complete. Database and tables are ready.\n";
