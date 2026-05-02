<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260501143130 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE events (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, date DATETIME NOT NULL, location VARCHAR(255) NOT NULL, meal_type VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE sanction ADD match_context_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sanction ADD CONSTRAINT FK_6D6491AF2A1D0AE3 FOREIGN KEY (match_context_id) REFERENCES events (id)');
        $this->addSql('CREATE INDEX IDX_6D6491AF2A1D0AE3 ON sanction (match_context_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE events');
        $this->addSql('ALTER TABLE sanction DROP FOREIGN KEY FK_6D6491AF2A1D0AE3');
        $this->addSql('DROP INDEX IDX_6D6491AF2A1D0AE3 ON sanction');
        $this->addSql('ALTER TABLE sanction DROP match_context_id');
    }
}
