<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230424165938 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX uniq_dd7fe9f7e7aeb3b2');
        $this->addSql('CREATE INDEX IDX_DD7FE9F7E7AEB3B2 ON habit_tracker (habit_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX IDX_DD7FE9F7E7AEB3B2');
        $this->addSql('CREATE UNIQUE INDEX uniq_dd7fe9f7e7aeb3b2 ON habit_tracker (habit_id)');
    }
}
