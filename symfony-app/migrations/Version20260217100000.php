<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260217100000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create client table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE client (
            id INT AUTO_INCREMENT NOT NULL,
            raison_sociale VARCHAR(255) NOT NULL,
            adresse_rue VARCHAR(255) NOT NULL,
            code_postal VARCHAR(10) NOT NULL,
            ville VARCHAR(255) NOT NULL,
            telephone VARCHAR(20) NOT NULL,
            courriel VARCHAR(255) NOT NULL,
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE client');
    }
}

