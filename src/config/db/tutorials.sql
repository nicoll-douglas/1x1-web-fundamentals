-- Inserts the current tutorials into the tutorials table.

USE jiggys_web_fundamentals;

INSERT IGNORE INTO tutorials (href, number, name, module_number) 
VALUES ("/tutorials/the-web/how-the-web-works", 1, "How The Web Works", 1);

INSERT IGNORE INTO tutorials (href, number, name, module_number) 
VALUES ("/tutorials/the-web/domains", 2, "Domains", 1);

INSERT IGNORE INTO tutorials (href, number, name, module_number)
VALUES ("/tutorials/the-web/common-terms-on-the-web", 3, "Common Terms On The Web", 1);

INSERT IGNORE INTO tutorials (href, number, name, module_number)
VALUES ("/tutorials/the-web/links-and-urls", 4, "Links & URLs", 1);