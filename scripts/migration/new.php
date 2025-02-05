<?php

declare(strict_types=1);

require_once __DIR__ . "/../helpers/migrationsDir.php";

if ($argc < 2) {
  echo "Usage: composer run migration:new <migration_name>\n";
  exit;
}

$migrationName = $argv[1];
$timestamp = date('YmdHis');
$filename = "{$timestamp}_{$migrationName}.php";
$filePath = $migrationsDir . DIRECTORY_SEPARATOR . $filename;

$template = <<<PHP
<?php

declare(strict_types=1);

class $migrationName {
  private \PDO \$pdo;

  public function __construct(\PDO \$pdo) {
    \$this->pdo = \$pdo;
  }

  public function up() {
    // Write SQL commands here
  }

  public function down() {
    // Write rollback SQL commands here
  }
}
PHP;

echo "Creating new migration file...\n";

$bytesPut = file_put_contents($filePath, $template);

if ($bytesPut !== false) {
  echo "Successfully created migration file: $filename.\n";
  chgrp($filePath, "www-data");
  chmod($filePath, 0770);
} else {
  echo "Failed to create migration file.\n";
}
