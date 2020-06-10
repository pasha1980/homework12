<?php

declare(strict_types=1);

namespace App\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200610065307 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this -> addSql("INSERT INTO `users` SET email = :email, `name` = :nam, password = :passwd, cratedAt = now(), udatedAt = now()", [
            ':email' => 'pasha@khvalygin.com',
            ':nam' => 'Pasha',
            ':passwd' => password_hash('123', 3),
        ] );
        $this -> addSql('INSERT INTO `users` SET email = :email, `name` = :nam, password = :passwd, cratedAt = now(), udatedAt = now()', [
            ':email' => 'timur@gmail.com',
            ':nam' => 'Timur',
            ':passwd' => password_hash('secret', 3),
        ] );
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
