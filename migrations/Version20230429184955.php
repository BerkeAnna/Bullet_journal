<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230429184955 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE bookCategories_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE bookTags_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE readingTrackers_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE bookCategories (id INT NOT NULL, owner INT DEFAULT NULL, name VARCHAR(255) NOT NULL, public_to_others BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2A9CF2E3CF60E67C ON bookCategories (owner)');
        $this->addSql('CREATE TABLE bookTags (id INT NOT NULL, owner INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, public_to_others BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_73985B74CF60E67C ON bookTags (owner)');
        $this->addSql('CREATE TABLE book_tag_book (book_tag_id INT NOT NULL, book_id INT NOT NULL, PRIMARY KEY(book_tag_id, book_id))');
        $this->addSql('CREATE INDEX IDX_3C150ADE9305689C ON book_tag_book (book_tag_id)');
        $this->addSql('CREATE INDEX IDX_3C150ADE16A2B381 ON book_tag_book (book_id)');
        $this->addSql('CREATE TABLE tags (book_id INT NOT NULL, book_tag_id INT NOT NULL, PRIMARY KEY(book_id, book_tag_id))');
        $this->addSql('CREATE INDEX IDX_6FBC942616A2B381 ON tags (book_id)');
        $this->addSql('CREATE INDEX IDX_6FBC94269305689C ON tags (book_tag_id)');
        $this->addSql('CREATE TABLE readingTrackers (id INT NOT NULL, owner INT DEFAULT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, read_pages INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_946C0246CF60E67C ON readingTrackers (owner)');
        $this->addSql('ALTER TABLE bookCategories ADD CONSTRAINT FK_2A9CF2E3CF60E67C FOREIGN KEY (owner) REFERENCES users (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE bookTags ADD CONSTRAINT FK_73985B74CF60E67C FOREIGN KEY (owner) REFERENCES users (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE book_tag_book ADD CONSTRAINT FK_3C150ADE9305689C FOREIGN KEY (book_tag_id) REFERENCES bookTags (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE book_tag_book ADD CONSTRAINT FK_3C150ADE16A2B381 FOREIGN KEY (book_id) REFERENCES books (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tags ADD CONSTRAINT FK_6FBC942616A2B381 FOREIGN KEY (book_id) REFERENCES books (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tags ADD CONSTRAINT FK_6FBC94269305689C FOREIGN KEY (book_tag_id) REFERENCES bookTags (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE readingTrackers ADD CONSTRAINT FK_946C0246CF60E67C FOREIGN KEY (owner) REFERENCES users (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE books ADD category INT DEFAULT NULL');
        $this->addSql('ALTER TABLE books ADD owner INT DEFAULT NULL');
        $this->addSql('ALTER TABLE books ADD readingTracker INT DEFAULT NULL');
        $this->addSql('ALTER TABLE books ADD CONSTRAINT FK_4A1B2A9264C19C1 FOREIGN KEY (category) REFERENCES bookCategories (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE books ADD CONSTRAINT FK_4A1B2A92753B2DC FOREIGN KEY (readingTracker) REFERENCES readingTrackers (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE books ADD CONSTRAINT FK_4A1B2A92CF60E67C FOREIGN KEY (owner) REFERENCES users (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_4A1B2A9264C19C1 ON books (category)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4A1B2A92753B2DC ON books (readingTracker)');
        $this->addSql('CREATE INDEX IDX_4A1B2A92CF60E67C ON books (owner)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE books DROP CONSTRAINT FK_4A1B2A9264C19C1');
        $this->addSql('ALTER TABLE books DROP CONSTRAINT FK_4A1B2A92753B2DC');
        $this->addSql('DROP SEQUENCE bookCategories_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE bookTags_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE readingTrackers_id_seq CASCADE');
        $this->addSql('ALTER TABLE bookCategories DROP CONSTRAINT FK_2A9CF2E3CF60E67C');
        $this->addSql('ALTER TABLE bookTags DROP CONSTRAINT FK_73985B74CF60E67C');
        $this->addSql('ALTER TABLE book_tag_book DROP CONSTRAINT FK_3C150ADE9305689C');
        $this->addSql('ALTER TABLE book_tag_book DROP CONSTRAINT FK_3C150ADE16A2B381');
        $this->addSql('ALTER TABLE tags DROP CONSTRAINT FK_6FBC942616A2B381');
        $this->addSql('ALTER TABLE tags DROP CONSTRAINT FK_6FBC94269305689C');
        $this->addSql('ALTER TABLE readingTrackers DROP CONSTRAINT FK_946C0246CF60E67C');
        $this->addSql('DROP TABLE bookCategories');
        $this->addSql('DROP TABLE bookTags');
        $this->addSql('DROP TABLE book_tag_book');
        $this->addSql('DROP TABLE tags');
        $this->addSql('DROP TABLE readingTrackers');
        $this->addSql('ALTER TABLE books DROP CONSTRAINT FK_4A1B2A92CF60E67C');
        $this->addSql('DROP INDEX IDX_4A1B2A9264C19C1');
        $this->addSql('DROP INDEX UNIQ_4A1B2A92753B2DC');
        $this->addSql('DROP INDEX IDX_4A1B2A92CF60E67C');
        $this->addSql('ALTER TABLE books DROP category');
        $this->addSql('ALTER TABLE books DROP owner');
        $this->addSql('ALTER TABLE books DROP readingTracker');
    }
}
