<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230421132431 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE habit_tracker_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE habit_tracker (id INT NOT NULL, habit_id INT NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DD7FE9F7E7AEB3B2 ON habit_tracker (habit_id)');
        $this->addSql('ALTER TABLE habit_tracker ADD CONSTRAINT FK_DD7FE9F7E7AEB3B2 FOREIGN KEY (habit_id) REFERENCES habit (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE habit_tracker_id_seq CASCADE');
        $this->addSql('ALTER TABLE habit_tracker DROP CONSTRAINT FK_DD7FE9F7E7AEB3B2');
        $this->addSql('DROP TABLE habit_tracker');
    }
}
