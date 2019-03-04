<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190301140530 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D89557A8CD546');
        $this->addSql('DROP INDEX vehicule_voyage ON voyage');
        $this->addSql('ALTER TABLE voyage CHANGE idvehicule id_vehicule_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D89555258F8E6 FOREIGN KEY (id_vehicule_id) REFERENCES vehicule (id)');
        $this->addSql('CREATE INDEX IDX_3F9D89555258F8E6 ON voyage (id_vehicule_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE vehicule CHANGE id_abonne_id id_abonne_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D89555258F8E6');
        $this->addSql('DROP INDEX IDX_3F9D89555258F8E6 ON voyage');
        $this->addSql('ALTER TABLE voyage CHANGE id_vehicule_id idVehicule INT DEFAULT NULL');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D89557A8CD546 FOREIGN KEY (idVehicule) REFERENCES vehicule (id)');
        $this->addSql('CREATE INDEX vehicule_voyage ON voyage (idVehicule)');
    }
}
