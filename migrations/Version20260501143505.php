<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260501143505 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sanction ADD player_id INT NOT NULL');
        $this->addSql('ALTER TABLE sanction ADD CONSTRAINT FK_6D6491AF99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('CREATE INDEX IDX_6D6491AF99E6F5DF ON sanction (player_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sanction DROP FOREIGN KEY FK_6D6491AF99E6F5DF');
        $this->addSql('DROP INDEX IDX_6D6491AF99E6F5DF ON sanction');
        $this->addSql('ALTER TABLE sanction DROP player_id');
    }
}
