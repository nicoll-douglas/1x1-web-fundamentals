<?php

require_once __DIR__ . "/../../helpers/connectDb.php";

$pdo = connectDb();

$sql = "CREATE TABLE IF NOT EXISTS migrations (
id INT AUTO_INCREMENT PRIMARY KEY,
migration VARCHAR(255) NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$pdo->exec($sql);
echo "Created migrations table.\n";

require_once __DIR__ . "/../migration/start.php";
require_once __DIR__ . "/seed.php";

echo "Setup complete. Database and tables are ready.\n";
