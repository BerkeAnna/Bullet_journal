<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230426101735 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE habit_tracker_habit (habit_tracker_id INT NOT NULL, habit_id INT NOT NULL, PRIMARY KEY(habit_tracker_id, habit_id))');
        $this->addSql('CREATE INDEX IDX_5598574899CC84B0 ON habit_tracker_habit (habit_tracker_id)');
        $this->addSql('CREATE INDEX IDX_55985748E7AEB3B2 ON habit_tracker_habit (habit_id)');
        $this->addSql('ALTER TABLE habit_tracker_habit ADD CONSTRAINT FK_5598574899CC84B0 FOREIGN KEY (habit_tracker_id) REFERENCES habit_tracker (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE habit_tracker_habit ADD CONSTRAINT FK_55985748E7AEB3B2 FOREIGN KEY (habit_id) REFERENCES habit (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE habit_tracker DROP CONSTRAINT fk_dd7fe9f7e7aeb3b2');
        $this->addSql('DROP INDEX idx_dd7fe9f7e7aeb3b2');
        $this->addSql('ALTER TABLE habit_tracker DROP habit_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE habit_tracker_habit DROP CONSTRAINT FK_5598574899CC84B0');
        $this->addSql('ALTER TABLE habit_tracker_habit DROP CONSTRAINT FK_55985748E7AEB3B2');
        $this->addSql('DROP TABLE habit_tracker_habit');
        $this->addSql('ALTER TABLE habit_tracker ADD habit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE habit_tracker ADD CONSTRAINT fk_dd7fe9f7e7aeb3b2 FOREIGN KEY (habit_id) REFERENCES habit (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_dd7fe9f7e7aeb3b2 ON habit_tracker (habit_id)');
    }
}
