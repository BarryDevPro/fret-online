<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190227165434 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE zone_intervention (id INT AUTO_INCREMENT NOT NULL, nom_zone VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zone_intervention_entreprise (zone_intervention_id INT NOT NULL, entreprise_id INT NOT NULL, INDEX IDX_331D3F9FD97299F8 (zone_intervention_id), INDEX IDX_331D3F9FA4AEAFEA (entreprise_id), PRIMARY KEY(zone_intervention_id, entreprise_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE zone_intervention_entreprise ADD CONSTRAINT FK_331D3F9FD97299F8 FOREIGN KEY (zone_intervention_id) REFERENCES zone_intervention (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE zone_intervention_entreprise ADD CONSTRAINT FK_331D3F9FA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE zone_intervention_entreprise DROP FOREIGN KEY FK_331D3F9FD97299F8');
        $this->addSql('DROP TABLE zone_intervention');
        $this->addSql('DROP TABLE zone_intervention_entreprise');
    }
}
