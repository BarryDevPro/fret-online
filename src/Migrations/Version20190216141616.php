<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190216141616 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE details_voyage DROP FOREIGN KEY details_voyage_ibfk_1');
        $this->addSql('ALTER TABLE details_voyage CHANGE charge charge INT NOT NULL, CHANGE decharge decharge INT NOT NULL, CHANGE idVoyage idVoyage INT DEFAULT NULL');
        $this->addSql('ALTER TABLE details_voyage ADD CONSTRAINT FK_FB8991A5C8C21CF FOREIGN KEY (idVoyage) REFERENCES voyage (id)');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY message_ibfk_1');
        $this->addSql('ALTER TABLE message CHANGE idAbonnees idAbonnees INT DEFAULT NULL');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FAD2A4AE7 FOREIGN KEY (idAbonnees) REFERENCES abonnes (id)');
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY vehicule_ibfk_1');
        $this->addSql('ALTER TABLE vehicule CHANGE idAbonnees idAbonnees INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1DAD2A4AE7 FOREIGN KEY (idAbonnees) REFERENCES abonnes (id)');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY voyage_ibfk_1');
        $this->addSql('ALTER TABLE voyage CHANGE idVehicule idVehicule INT DEFAULT NULL');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D89557A8CD546 FOREIGN KEY (idVehicule) REFERENCES vehicule (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE details_voyage DROP FOREIGN KEY FK_FB8991A5C8C21CF');
        $this->addSql('ALTER TABLE details_voyage CHANGE charge charge INT DEFAULT 0 NOT NULL, CHANGE decharge decharge INT DEFAULT 0 NOT NULL, CHANGE idVoyage idVoyage INT NOT NULL');
        $this->addSql('ALTER TABLE details_voyage ADD CONSTRAINT details_voyage_ibfk_1 FOREIGN KEY (idVoyage) REFERENCES voyage (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FAD2A4AE7');
        $this->addSql('ALTER TABLE message CHANGE idAbonnees idAbonnees INT NOT NULL');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT message_ibfk_1 FOREIGN KEY (idAbonnees) REFERENCES abonnes (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1DAD2A4AE7');
        $this->addSql('ALTER TABLE vehicule CHANGE idAbonnees idAbonnees INT NOT NULL');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT vehicule_ibfk_1 FOREIGN KEY (idAbonnees) REFERENCES abonnes (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D89557A8CD546');
        $this->addSql('ALTER TABLE voyage CHANGE idVehicule idVehicule INT NOT NULL');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT voyage_ibfk_1 FOREIGN KEY (idVehicule) REFERENCES vehicule (id) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
