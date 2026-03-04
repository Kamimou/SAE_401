<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260304113509 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, raison_sociale VARCHAR(255) NOT NULL, adresse_rue VARCHAR(255) NOT NULL, code_postal VARCHAR(10) NOT NULL, ville VARCHAR(255) NOT NULL, telephone VARCHAR(20) NOT NULL, courriel VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE criteres (id INT AUTO_INCREMENT NOT NULL, annee_de_publication INT NOT NULL, nombre_dhabitants INT NOT NULL, densite_de_population DOUBLE PRECISION NOT NULL, variation_population10_ans DOUBLE PRECISION NOT NULL, taux_de_chomage DOUBLE PRECISION NOT NULL, taux_de_pauvrete DOUBLE PRECISION NOT NULL, taux_de_logements_sociaux DOUBLE PRECISION NOT NULL, taux_de_logements_vacants DOUBLE PRECISION NOT NULL, departement_id INT NOT NULL, INDEX IDX_E913A5C5CCF9E01E (departement_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE departement (id INT AUTO_INCREMENT NOT NULL, nom_departement VARCHAR(255) NOT NULL, region_id INT NOT NULL, INDEX IDX_C1765B6398260155 (region_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE region (id INT AUTO_INCREMENT NOT NULL, nom_region VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE criteres ADD CONSTRAINT FK_E913A5C5CCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id)');
        $this->addSql('ALTER TABLE departement ADD CONSTRAINT FK_C1765B6398260155 FOREIGN KEY (region_id) REFERENCES region (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE criteres DROP FOREIGN KEY FK_E913A5C5CCF9E01E');
        $this->addSql('ALTER TABLE departement DROP FOREIGN KEY FK_C1765B6398260155');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE criteres');
        $this->addSql('DROP TABLE departement');
        $this->addSql('DROP TABLE region');
    }
}
