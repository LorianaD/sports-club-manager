<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260429130217 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact_persons ADD player_contact_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contact_persons ADD CONSTRAINT FK_3873E652B804A177 FOREIGN KEY (player_contact_id) REFERENCES player_contact (id)');
        $this->addSql('CREATE INDEX IDX_3873E652B804A177 ON contact_persons (player_contact_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact_persons DROP FOREIGN KEY FK_3873E652B804A177');
        $this->addSql('DROP INDEX IDX_3873E652B804A177 ON contact_persons');
        $this->addSql('ALTER TABLE contact_persons DROP player_contact_id');
    }
}
