<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260501145316 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE team_events (team_id INT NOT NULL, events_id INT NOT NULL, INDEX IDX_259C1093296CD8AE (team_id), INDEX IDX_259C10939D6A1065 (events_id), PRIMARY KEY (team_id, events_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE team_events ADD CONSTRAINT FK_259C1093296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team_events ADD CONSTRAINT FK_259C10939D6A1065 FOREIGN KEY (events_id) REFERENCES events (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE team_events DROP FOREIGN KEY FK_259C1093296CD8AE');
        $this->addSql('ALTER TABLE team_events DROP FOREIGN KEY FK_259C10939D6A1065');
        $this->addSql('DROP TABLE team_events');
    }
}
