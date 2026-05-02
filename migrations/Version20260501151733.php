<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260501151733 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE player_position (player_id INT NOT NULL, position_id INT NOT NULL, INDEX IDX_40FBA51599E6F5DF (player_id), INDEX IDX_40FBA515DD842E46 (position_id), PRIMARY KEY (player_id, position_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE position (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE player_position ADD CONSTRAINT FK_40FBA51599E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE player_position ADD CONSTRAINT FK_40FBA515DD842E46 FOREIGN KEY (position_id) REFERENCES position (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE player_position DROP FOREIGN KEY FK_40FBA51599E6F5DF');
        $this->addSql('ALTER TABLE player_position DROP FOREIGN KEY FK_40FBA515DD842E46');
        $this->addSql('DROP TABLE player_position');
        $this->addSql('DROP TABLE position');
    }
}
