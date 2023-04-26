<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230425121655 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE habit_tracker DROP CONSTRAINT fk_dd7fe9f7bf396750');
        $this->addSql('ALTER TABLE habit_tracker ADD habit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE habit_tracker ADD CONSTRAINT FK_DD7FE9F7E7AEB3B2 FOREIGN KEY (habit_id) REFERENCES habit (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_DD7FE9F7E7AEB3B2 ON habit_tracker (habit_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE habit_tracker DROP CONSTRAINT FK_DD7FE9F7E7AEB3B2');
        $this->addSql('DROP INDEX IDX_DD7FE9F7E7AEB3B2');
        $this->addSql('ALTER TABLE habit_tracker DROP habit_id');
        $this->addSql('ALTER TABLE habit_tracker ADD CONSTRAINT fk_dd7fe9f7bf396750 FOREIGN KEY (id) REFERENCES habit (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
