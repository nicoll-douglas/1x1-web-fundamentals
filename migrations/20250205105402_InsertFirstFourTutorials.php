<?php

declare(strict_types=1);

class InsertFirstFourTutorials
{
  private \PDO $pdo;

  public function __construct(\PDO $pdo)
  {
    $this->pdo = $pdo;
  }

  public function up()
  {
    $sql = 'INSERT IGNORE INTO tutorials (href, number, name, module_number) 
    VALUES 
    ("/tutorials/the-web/how-the-web-works", 1, "How The Web Works", 1), 
    ("/tutorials/the-web/domains", 2, "Domains", 1) ,
    ("/tutorials/the-web/common-terms-on-the-web", 3, "Common Terms On The Web", 1) ,
    ("/tutorials/the-web/urls", 4, "URLs", 1)';
    $this->pdo->exec($sql);
    echo "Inserted first 4 tutorials.\n";
  }

  public function down()
  {
    $sql = "DELETE FROM tutorials WHERE module_number = 1 AND number < 5";
    $this->pdo->exec($sql);
    echo "Successfully deleted first 4 tutorials. \n";
  }
}
