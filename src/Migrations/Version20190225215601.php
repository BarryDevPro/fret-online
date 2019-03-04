<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190225215601 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE abonnement (id INT AUTO_INCREMENT NOT NULL, id_vehicule_id INT DEFAULT NULL, create_at DATETIME NOT NULL, finish_at DATETIME NOT NULL, type_abonnement VARCHAR(255) NOT NULL, montant NUMERIC(10, 0) NOT NULL, INDEX IDX_351268BB5258F8E6 (id_vehicule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE abonnes (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(70) NOT NULL, ninea VARCHAR(100) DEFAULT NULL, telephone VARCHAR(25) DEFAULT NULL, email VARCHAR(100) DEFAULT NULL, file VARCHAR(100) DEFAULT NULL, password VARCHAR(200) DEFAULT NULL, type_abonne INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(100) NOT NULL, email VARCHAR(150) NOT NULL, adresse VARCHAR(150) NOT NULL, message LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE details_voyage (id INT AUTO_INCREMENT NOT NULL, ville VARCHAR(50) NOT NULL, dateDepart DATETIME NOT NULL, charge INT NOT NULL, decharge INT NOT NULL, positionX NUMERIC(10, 0) NOT NULL, positionY NUMERIC(10, 0) NOT NULL, idVoyage INT DEFAULT NULL, INDEX idVoyage (idVoyage), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, contenu LONGTEXT NOT NULL, datePublication DATETIME NOT NULL, idAbonnees INT DEFAULT NULL, INDEX abonnees_message (idAbonnees), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicule (id INT AUTO_INCREMENT NOT NULL, matricule VARCHAR(70) NOT NULL, type VARCHAR(100) DEFAULT NULL, tonnage INT DEFAULT NULL, age_vehicule INT DEFAULT NULL, idAbonnees INT DEFAULT NULL, INDEX idAbonnees (idAbonnees), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voyage (id INT AUTO_INCREMENT NOT NULL, villeDepart VARCHAR(50) NOT NULL, villeArrive VARCHAR(50) NOT NULL, quantite INT NOT NULL, status TINYINT(1) DEFAULT \'1\' NOT NULL, idVehicule INT DEFAULT NULL, INDEX vehicule_voyage (idVehicule), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE abonnement ADD CONSTRAINT FK_351268BB5258F8E6 FOREIGN KEY (id_vehicule_id) REFERENCES vehicule (id)');
        $this->addSql('ALTER TABLE details_voyage ADD CONSTRAINT FK_FB8991A5C8C21CF FOREIGN KEY (idVoyage) REFERENCES voyage (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FAD2A4AE7 FOREIGN KEY (idAbonnees) REFERENCES abonnes (id)');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1DAD2A4AE7 FOREIGN KEY (idAbonnees) REFERENCES abonnes (id)');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D89557A8CD546 FOREIGN KEY (idVehicule) REFERENCES vehicule (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FAD2A4AE7');
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1DAD2A4AE7');
        $this->addSql('ALTER TABLE abonnement DROP FOREIGN KEY FK_351268BB5258F8E6');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D89557A8CD546');
        $this->addSql('ALTER TABLE details_voyage DROP FOREIGN KEY FK_FB8991A5C8C21CF');
        $this->addSql('DROP TABLE abonnement');
        $this->addSql('DROP TABLE abonnes');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE details_voyage');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE vehicule');
        $this->addSql('DROP TABLE voyage');
    }
}
