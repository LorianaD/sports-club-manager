<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260501130711 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attendance ADD player_id INT NOT NULL');
        $this->addSql('ALTER TABLE attendance ADD CONSTRAINT FK_6DE30D9199E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('CREATE INDEX IDX_6DE30D9199E6F5DF ON attendance (player_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attendance DROP FOREIGN KEY FK_6DE30D9199E6F5DF');
        $this->addSql('DROP INDEX IDX_6DE30D9199E6F5DF ON attendance');
        $this->addSql('ALTER TABLE attendance DROP player_id');
    }
}
