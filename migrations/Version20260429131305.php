<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260429131305 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact_persons DROP FOREIGN KEY `FK_3873E652B804A177`');
        $this->addSql('DROP INDEX IDX_3873E652B804A177 ON contact_persons');
        $this->addSql('ALTER TABLE contact_persons DROP player_contact_id');
        $this->addSql('ALTER TABLE player_contact ADD contact_person_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE player_contact ADD CONSTRAINT FK_2D96197DFFC5B3A7 FOREIGN KEY (contact_person_id_id) REFERENCES contact_persons (id)');
        $this->addSql('CREATE INDEX IDX_2D96197DFFC5B3A7 ON player_contact (contact_person_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact_persons ADD player_contact_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contact_persons ADD CONSTRAINT `FK_3873E652B804A177` FOREIGN KEY (player_contact_id) REFERENCES player_contact (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_3873E652B804A177 ON contact_persons (player_contact_id)');
        $this->addSql('ALTER TABLE player_contact DROP FOREIGN KEY FK_2D96197DFFC5B3A7');
        $this->addSql('DROP INDEX IDX_2D96197DFFC5B3A7 ON player_contact');
        $this->addSql('ALTER TABLE player_contact DROP contact_person_id_id');
    }
}
