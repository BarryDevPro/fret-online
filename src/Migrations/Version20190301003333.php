<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190301003333 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1DAD2A4AE7');
        $this->addSql('DROP INDEX idAbonnees ON vehicule');
        $this->addSql('ALTER TABLE vehicule CHANGE idabonnees id_abonne_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1D43101AB1 FOREIGN KEY (id_abonne_id) REFERENCES abonnes (id)');
        $this->addSql('CREATE INDEX IDX_292FFF1D43101AB1 ON vehicule (id_abonne_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1D43101AB1');
        $this->addSql('DROP INDEX IDX_292FFF1D43101AB1 ON vehicule');
        $this->addSql('ALTER TABLE vehicule CHANGE id_abonne_id idAbonnees INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1DAD2A4AE7 FOREIGN KEY (idAbonnees) REFERENCES abonnes (id)');
        $this->addSql('CREATE INDEX idAbonnees ON vehicule (idAbonnees)');
    }
}
