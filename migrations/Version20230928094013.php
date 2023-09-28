<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230928094013 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE agence (id INT AUTO_INCREMENT NOT NULL, ville VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, tel VARCHAR(15) DEFAULT NULL, tarif SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE envoi (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, depart VARCHAR(50) NOT NULL, nom_e VARCHAR(255) NOT NULL, prenom_e VARCHAR(255) NOT NULL, tel_e VARCHAR(15) NOT NULL, identite VARCHAR(16) NOT NULL, id_e VARCHAR(20) NOT NULL, image_id VARCHAR(255) DEFAULT NULL, nom_d VARCHAR(255) NOT NULL, prenom_d VARCHAR(255) NOT NULL, tel_d VARCHAR(15) NOT NULL, id_d VARCHAR(20) NOT NULL, n_colis SMALLINT NOT NULL, paye TINYINT(1) DEFAULT 0 NOT NULL, mode_paiement VARCHAR(6) NOT NULL, poids_t SMALLINT NOT NULL, type VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_CA7E3566A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE envoi ADD CONSTRAINT FK_CA7E3566A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE envoi DROP FOREIGN KEY FK_CA7E3566A76ED395');
        $this->addSql('DROP TABLE agence');
        $this->addSql('DROP TABLE envoi');
    }
}
