<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190225000221 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, ninea VARCHAR(255) NOT NULL, img VARCHAR(255) DEFAULT NULL, nbre_vehicule INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE abonnes ADD id_entreprise_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE abonnes ADD CONSTRAINT FK_A6C50F9C1A867E8F FOREIGN KEY (id_entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('CREATE INDEX IDX_A6C50F9C1A867E8F ON abonnes (id_entreprise_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE abonnes DROP FOREIGN KEY FK_A6C50F9C1A867E8F');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP INDEX IDX_A6C50F9C1A867E8F ON abonnes');
        $this->addSql('ALTER TABLE abonnes DROP id_entreprise_id');
    }
}
