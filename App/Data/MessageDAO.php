<?php 

declare(strict_types=1);

namespace App\Data;

use PDO;
use PDOException;

class MessageDAO
{
    protected ?PDO $dbh = null;

    public function __construct()
    {
        // Make connection to database
        try{
            $this->dbh = new PDO(
                DBConfig::getConnString(),
                DBConfig::getUsername(),
                DBConfig::getPassword()
            );

            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
            die("Er kon geen verbinding worden gemaakt met de database.");
        }
    }

    // Create new message
    public function addMessage(string $name, string $company, string $email, string $message)
    {
        $sql = "INSERT INTO messages (name, company, email, message)
        VALUES (:name, :company, :email, :message)";
        $stmt = $this->dbh->prepare($sql);

        $stmt->execute(
            [
                ":name" => $name,
                ":company" => $company,
                ":email" => $email,
                ":message" => $message
            ]
        );
    }
}