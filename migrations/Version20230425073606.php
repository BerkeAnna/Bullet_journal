<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230425073606 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE habit_tracker DROP CONSTRAINT fk_dd7fe9f7e7aeb3b2');
        $this->addSql('DROP INDEX idx_dd7fe9f7e7aeb3b2');
        $this->addSql('ALTER TABLE habit_tracker DROP habit_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE habit_tracker ADD habit_id INT NOT NULL');
        $this->addSql('ALTER TABLE habit_tracker ADD CONSTRAINT fk_dd7fe9f7e7aeb3b2 FOREIGN KEY (habit_id) REFERENCES habit (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_dd7fe9f7e7aeb3b2 ON habit_tracker (habit_id)');
    }
}
