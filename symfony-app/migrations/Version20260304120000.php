<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260304120000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create statistique_logement table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE statistique_logement (id INT AUTO_INCREMENT NOT NULL, departement_id INT NOT NULL, construction DOUBLE PRECISION NOT NULL, nombre_logement INT NOT NULL, INDEX IDX_STAT_LOGEMENT_DEPARTEMENT (departement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE statistique_logement ADD CONSTRAINT FK_STAT_LOGEMENT_DEPARTEMENT FOREIGN KEY (departement_id) REFERENCES departement (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE statistique_logement');
    }
}

