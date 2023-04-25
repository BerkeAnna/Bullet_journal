<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230420153049 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE habit DROP CONSTRAINT fk_44fe21727e3c61f9');
        $this->addSql('DROP INDEX idx_44fe21727e3c61f9');
        $this->addSql('ALTER TABLE habit DROP owner_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE habit ADD owner_id INT NOT NULL');
        $this->addSql('ALTER TABLE habit ADD CONSTRAINT fk_44fe21727e3c61f9 FOREIGN KEY (owner_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_44fe21727e3c61f9 ON habit (owner_id)');
    }
}
