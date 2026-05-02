<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260501124158 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attendance ADD attendance_status_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE attendance ADD CONSTRAINT FK_6DE30D911E73AA87 FOREIGN KEY (attendance_status_id) REFERENCES attendance_status (id)');
        $this->addSql('CREATE INDEX IDX_6DE30D911E73AA87 ON attendance (attendance_status_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attendance DROP FOREIGN KEY FK_6DE30D911E73AA87');
        $this->addSql('DROP INDEX IDX_6DE30D911E73AA87 ON attendance');
        $this->addSql('ALTER TABLE attendance DROP attendance_status_id');
    }
}
