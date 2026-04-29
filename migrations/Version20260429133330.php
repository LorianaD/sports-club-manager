<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260429133330 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact_persons (id INT AUTO_INCREMENT NOT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, address VARCHAR(500) DEFAULT NULL, pc VARCHAR(6) NOT NULL, city VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE player_contact ADD contact_person_id INT NOT NULL');
        $this->addSql('ALTER TABLE player_contact ADD CONSTRAINT FK_2D96197D4F8A983C FOREIGN KEY (contact_person_id) REFERENCES contact_persons (id)');
        $this->addSql('CREATE INDEX IDX_2D96197D4F8A983C ON player_contact (contact_person_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE contact_persons');
        $this->addSql('ALTER TABLE player_contact DROP FOREIGN KEY FK_2D96197D4F8A983C');
        $this->addSql('DROP INDEX IDX_2D96197D4F8A983C ON player_contact');
        $this->addSql('ALTER TABLE player_contact DROP contact_person_id');
    }
}
