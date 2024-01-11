<?php
class m0001_initial
{
    public function up()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "CREATE TABLE users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR(255) NOT NULL,
                password VARCHAR(64) NOT NULL, 
                name VARCHAR(255) NOT NULL,
                role VARCHAR(20) NOT NULL,
                reset_password_token VARCHAR(100),
                status TINYINT  DEFAULT 0,
                updated DATETIME ON UPDATE CURRENT_TIMESTAMP,
                created TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )  ENGINE=INNODB;";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "DROP TABLE users;";
        $db->pdo->exec($SQL);
    }
}