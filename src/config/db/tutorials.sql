USE jiggys_web_fundamentals;

INSERT IGNORE INTO tutorial_modules (number, name) 
VALUES (1, "The Web");

INSERT IGNORE INTO tutorials (href, number, name, module_id) 
VALUES ("/tutorials/the-web/how-the-web-works.php", 1, "How The Web Works", 1);

INSERT IGNORE INTO tutorials (href, number, name, module_id) 
VALUES ("/tutorials/the-web/domains.php", 2, "Domains", 1);

INSERT IGNORE INTO tutorials (href, number, name, module_id)
VALUES ("/tutorials/the-web/common-terms-on-the-web.php", 3, "Common Terms On The Web", 1);