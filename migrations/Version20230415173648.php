<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230415173648 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE daily_helper_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE daily_helper (id INT NOT NULL, owner_id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, completed BOOLEAN NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6094C1C7E3C61F9 ON daily_helper (owner_id)');
        $this->addSql('CREATE TABLE daily_helper_daily_note (daily_helper_id INT NOT NULL, daily_note_id INT NOT NULL, PRIMARY KEY(daily_helper_id, daily_note_id))');
        $this->addSql('CREATE INDEX IDX_A2561B07566D278F ON daily_helper_daily_note (daily_helper_id)');
        $this->addSql('CREATE INDEX IDX_A2561B07F90CD9A1 ON daily_helper_daily_note (daily_note_id)');
        $this->addSql('ALTER TABLE daily_helper ADD CONSTRAINT FK_6094C1C7E3C61F9 FOREIGN KEY (owner_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE daily_helper_daily_note ADD CONSTRAINT FK_A2561B07566D278F FOREIGN KEY (daily_helper_id) REFERENCES daily_helper (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE daily_helper_daily_note ADD CONSTRAINT FK_A2561B07F90CD9A1 FOREIGN KEY (daily_note_id) REFERENCES dailyNotes (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE dailynotes DROP CONSTRAINT fk_d9f9e606cf60e67c');
        $this->addSql('DROP INDEX idx_d9f9e606cf60e67c');
        $this->addSql('ALTER TABLE dailynotes ADD owner_id INT NOT NULL');
        $this->addSql('ALTER TABLE dailynotes ADD image TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE dailynotes DROP owner');
        $this->addSql('ALTER TABLE dailynotes DROP todo');
        $this->addSql('ALTER TABLE dailynotes DROP event');
        $this->addSql('ALTER TABLE dailynotes DROP birthday');
        $this->addSql('ALTER TABLE dailynotes DROP nameday');
        $this->addSql('ALTER TABLE dailynotes ADD CONSTRAINT FK_D9F9E6067E3C61F9 FOREIGN KEY (owner_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_D9F9E6067E3C61F9 ON dailynotes (owner_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE daily_helper_id_seq CASCADE');
        $this->addSql('ALTER TABLE daily_helper DROP CONSTRAINT FK_6094C1C7E3C61F9');
        $this->addSql('ALTER TABLE daily_helper_daily_note DROP CONSTRAINT FK_A2561B07566D278F');
        $this->addSql('ALTER TABLE daily_helper_daily_note DROP CONSTRAINT FK_A2561B07F90CD9A1');
        $this->addSql('DROP TABLE daily_helper');
        $this->addSql('DROP TABLE daily_helper_daily_note');
        $this->addSql('ALTER TABLE dailyNotes DROP CONSTRAINT FK_D9F9E6067E3C61F9');
        $this->addSql('DROP INDEX IDX_D9F9E6067E3C61F9');
        $this->addSql('ALTER TABLE dailyNotes ADD owner INT DEFAULT NULL');
        $this->addSql('ALTER TABLE dailyNotes ADD todo VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE dailyNotes ADD event VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE dailyNotes ADD nameday TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE dailyNotes DROP owner_id');
        $this->addSql('ALTER TABLE dailyNotes RENAME COLUMN image TO birthday');
        $this->addSql('ALTER TABLE dailyNotes ADD CONSTRAINT fk_d9f9e606cf60e67c FOREIGN KEY (owner) REFERENCES users (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_d9f9e606cf60e67c ON dailyNotes (owner)');
    }
}
