<?php

if ($argc < 4) {
  echo "Usage: composer run tutorial:new <module_number> <tutorial_number> <name>";
  exit;
}

$moduleNumber = $argv[1];
$tutorialNumber = $argv[2];
$tutorialName = $argv[3];
if (!ctype_digit($moduleNumber)) {
  echo "Arg 1 <module_number> must be numeric.";
  exit;
}
if (!ctype_digit($tutorialNumber)) {
  echo "Arg 2 <tutorial_number> must be numeric.";
  exit;
}

$tutorialNumber = intval($tutorialNumber);
$moduleNumber = intval($moduleNumber);

require_once __DIR__ . "/../../helpers/kebabCase.php";
require_once __DIR__ . "/../../helpers/connectDb.php";

$pdo = connectDb();

$stmt = $pdo->query("SELECT name FROM tutorial_modules WHERE number = $moduleNumber");
$moduleName = $stmt->fetchColumn();

if (!$moduleName) {
  echo "The given module doesn't exist, enter a name to create it: ";
  $moduleName = fgets(STDIN);
  $moduleName = trim($moduleName);

  $sql = "INSERT INTO tutorial_modules (name, number) 
  VALUES (:name, :num)";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(":name", $moduleName);
  $stmt->bindParam(":num", $moduleNumber, \PDO::PARAM_INT);
  $stmt->execute();
  echo "Successfully inserted new module into the database.\n";

  $tutorialModulesFile = __DIR__ . "/../../../data/tutorial_modules.json";
  $tutorialModules = json_decode(file_get_contents($tutorialModulesFile), true);
  $tutorialModules[] = [
    "name" => $moduleName,
    "number" => $moduleNumber
  ];
  file_put_contents($tutorialModulesFile, json_encode($tutorialModules, JSON_PRETTY_PRINT));
  echo "Successfully updated tutorial module data file.\n";
}

$moduleNameSegment = kebabCase($moduleName);
$tutorialNameSegment = kebabCase($tutorialName);

$href = "/tutorials/$moduleNameSegment/$tutorialNameSegment";

echo "Inserting tutorial into database...\n";
$sql = "INSERT INTO tutorials (name, href, number, module_number) 
VALUES (:name, :href, :number, :mod_num)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":name", $tutorialName);
$stmt->bindParam(":href", $href);
$stmt->bindParam(":number", $tutorialNumber, \PDO::PARAM_INT);
$stmt->bindParam(":mod_num", $moduleNumber, \PDO::PARAM_INT);
$stmt->execute();
echo "Successfully inserted new tutorial into database.\n";

$tutorialsFile = __DIR__ . "/../../../data/tutorials.json";
$tutorials = json_decode(file_get_contents($tutorialsFile), true);
$tutorials[] = [
  "name" => $tutorialName,
  "number" => $tutorialNumber,
  "href" => $href,
  "moduleNumber" => $moduleNumber
];
file_put_contents($tutorialsFile, json_encode($tutorials, JSON_PRETTY_PRINT));
echo "Successfully updated tutorial data file.\n";

$moduleViewsFolder = __DIR__ . "/../../../src/views/tutorials/$moduleNameSegment";
if (!file_exists($moduleViewsFolder)) {
  mkdir($moduleViewsFolder);
  chgrp($moduleViewsFolder, "www-data");
  chmod($moduleViewsFolder, 0770);
}
$viewFilename = "$href.php";
$viewFile = __DIR__ . "/../../../src/views/$viewFilename";

$template = <<<PHP
<main>
  <article>
    <?php
    \$breadcrumb = ["$moduleName", "$tutorialName"];
    require_once __DIR__ . "/../../../partials/breadcrumb.php";
    ?>

    <h1>$tutorialName</h1>

    <?php
    \$tutorialNav = [
    ];
    require_once __DIR__ . "/../../../partials/tutorialNav.php";
    ?>

    <!-- Article sections here -->

    <?php
    \$keyConcepts = [
    ];
    require_once __DIR__ . "/../../../partials/keyConcepts.php";
    ?>

  </article>

  <?php require_once __DIR__ . "/../../../partials/tutorialFooter.php"; ?>
</main>
PHP;

file_put_contents($viewFile, $template);
echo "Successfully create tutorial view template.\n";

require_once __DIR__ . "/../cache/clear.php";
