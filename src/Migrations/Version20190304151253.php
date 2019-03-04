<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190304151253 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE details_voyage DROP FOREIGN KEY FK_FB8991A5C8C21CF');
        $this->addSql('DROP INDEX idVoyage ON details_voyage');
        $this->addSql('ALTER TABLE details_voyage CHANGE idvoyage voyage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE details_voyage ADD CONSTRAINT FK_FB8991A68C9E5AF FOREIGN KEY (voyage_id) REFERENCES voyage (id)');
        $this->addSql('CREATE INDEX IDX_FB8991A68C9E5AF ON details_voyage (voyage_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE details_voyage DROP FOREIGN KEY FK_FB8991A68C9E5AF');
        $this->addSql('DROP INDEX IDX_FB8991A68C9E5AF ON details_voyage');
        $this->addSql('ALTER TABLE details_voyage CHANGE voyage_id idVoyage INT DEFAULT NULL');
        $this->addSql('ALTER TABLE details_voyage ADD CONSTRAINT FK_FB8991A5C8C21CF FOREIGN KEY (idVoyage) REFERENCES voyage (id)');
        $this->addSql('CREATE INDEX idVoyage ON details_voyage (idVoyage)');
        $this->addSql('ALTER TABLE vehicule CHANGE id_abonne_id id_abonne_id INT DEFAULT NULL');
    }
}
