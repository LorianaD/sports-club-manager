<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260509143129 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE inventory (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, category VARCHAR(255) NOT NULL, stock INT NOT NULL, unit_price NUMERIC(10, 2) DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE category CHANGE min_age min_age INT NOT NULL, CHANGE max_age max_age INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE inventory');
        $this->addSql('ALTER TABLE category CHANGE min_age min_age VARCHAR(4) NOT NULL, CHANGE max_age max_age VARCHAR(4) NOT NULL');
    }
}
