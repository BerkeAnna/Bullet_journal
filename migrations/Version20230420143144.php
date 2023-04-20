<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230420143144 extends AbstractMigration
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
        $this->addSql('CREATE SEQUENCE books_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE dailyNotes_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE daily_helper_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE habit_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE imageAlbums_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE moodTrackers_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE proba_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE readingTrackers_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE users_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE bookCategories (id INT NOT NULL, owner INT DEFAULT NULL, name VARCHAR(255) NOT NULL, public_to_others BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2A9CF2E3CF60E67C ON bookCategories (owner)');
        $this->addSql('CREATE TABLE bookTags (id INT NOT NULL, owner INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, public_to_others BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_73985B74CF60E67C ON bookTags (owner)');
        $this->addSql('CREATE TABLE book_tag_book (book_tag_id INT NOT NULL, book_id INT NOT NULL, PRIMARY KEY(book_tag_id, book_id))');
        $this->addSql('CREATE INDEX IDX_3C150ADE9305689C ON book_tag_book (book_tag_id)');
        $this->addSql('CREATE INDEX IDX_3C150ADE16A2B381 ON book_tag_book (book_id)');
        $this->addSql('CREATE TABLE books (id INT NOT NULL, category INT DEFAULT NULL, owner INT DEFAULT NULL, author VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, opinion VARCHAR(255) DEFAULT NULL, stars INT DEFAULT NULL, start_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, end_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, readingTracker INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4A1B2A9264C19C1 ON books (category)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4A1B2A92753B2DC ON books (readingTracker)');
        $this->addSql('CREATE INDEX IDX_4A1B2A92CF60E67C ON books (owner)');
        $this->addSql('CREATE TABLE tags (book_id INT NOT NULL, book_tag_id INT NOT NULL, PRIMARY KEY(book_id, book_tag_id))');
        $this->addSql('CREATE INDEX IDX_6FBC942616A2B381 ON tags (book_id)');
        $this->addSql('CREATE INDEX IDX_6FBC94269305689C ON tags (book_tag_id)');
        $this->addSql('CREATE TABLE dailyNotes (id INT NOT NULL, owner_id INT NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, image VARCHAR(255) NOT NULL, moodTracker INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D9F9E606F9E21957 ON dailyNotes (moodTracker)');
        $this->addSql('CREATE INDEX IDX_D9F9E6067E3C61F9 ON dailyNotes (owner_id)');
        $this->addSql('CREATE TABLE daily_helper (id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, completed BOOLEAN NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE habit (id INT NOT NULL, owner_id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, competed BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_44FE21727E3C61F9 ON habit (owner_id)');
        $this->addSql('CREATE TABLE imageAlbums (id INT NOT NULL, owner INT DEFAULT NULL, title VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, dailyNote INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6E332A4CCF60E67C ON imageAlbums (owner)');
        $this->addSql('CREATE INDEX IDX_6E332A4C20D6AABC ON imageAlbums (dailyNote)');
        $this->addSql('CREATE TABLE moodTrackers (id INT NOT NULL, owner INT DEFAULT NULL, name VARCHAR(255) NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EEF8E945CF60E67C ON moodTrackers (owner)');
        $this->addSql('CREATE TABLE proba (id INT NOT NULL, lehetnull VARCHAR(255) DEFAULT NULL, nemlehetnull VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE readingTrackers (id INT NOT NULL, owner INT DEFAULT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, read_pages INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_946C0246CF60E67C ON readingTrackers (owner)');
        $this->addSql('CREATE TABLE users (id INT NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, salt VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('ALTER TABLE bookCategories ADD CONSTRAINT FK_2A9CF2E3CF60E67C FOREIGN KEY (owner) REFERENCES users (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE bookTags ADD CONSTRAINT FK_73985B74CF60E67C FOREIGN KEY (owner) REFERENCES users (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE book_tag_book ADD CONSTRAINT FK_3C150ADE9305689C FOREIGN KEY (book_tag_id) REFERENCES bookTags (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE book_tag_book ADD CONSTRAINT FK_3C150ADE16A2B381 FOREIGN KEY (book_id) REFERENCES books (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE books ADD CONSTRAINT FK_4A1B2A9264C19C1 FOREIGN KEY (category) REFERENCES bookCategories (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE books ADD CONSTRAINT FK_4A1B2A92753B2DC FOREIGN KEY (readingTracker) REFERENCES readingTrackers (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE books ADD CONSTRAINT FK_4A1B2A92CF60E67C FOREIGN KEY (owner) REFERENCES users (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tags ADD CONSTRAINT FK_6FBC942616A2B381 FOREIGN KEY (book_id) REFERENCES books (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tags ADD CONSTRAINT FK_6FBC94269305689C FOREIGN KEY (book_tag_id) REFERENCES bookTags (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE dailyNotes ADD CONSTRAINT FK_D9F9E606F9E21957 FOREIGN KEY (moodTracker) REFERENCES moodTrackers (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE dailyNotes ADD CONSTRAINT FK_D9F9E6067E3C61F9 FOREIGN KEY (owner_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE habit ADD CONSTRAINT FK_44FE21727E3C61F9 FOREIGN KEY (owner_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE imageAlbums ADD CONSTRAINT FK_6E332A4CCF60E67C FOREIGN KEY (owner) REFERENCES users (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE imageAlbums ADD CONSTRAINT FK_6E332A4C20D6AABC FOREIGN KEY (dailyNote) REFERENCES dailyNotes (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE moodTrackers ADD CONSTRAINT FK_EEF8E945CF60E67C FOREIGN KEY (owner) REFERENCES users (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE readingTrackers ADD CONSTRAINT FK_946C0246CF60E67C FOREIGN KEY (owner) REFERENCES users (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE bookCategories_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE bookTags_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE books_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE dailyNotes_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE daily_helper_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE habit_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE imageAlbums_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE moodTrackers_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE proba_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE readingTrackers_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE users_id_seq CASCADE');
        $this->addSql('ALTER TABLE bookCategories DROP CONSTRAINT FK_2A9CF2E3CF60E67C');
        $this->addSql('ALTER TABLE bookTags DROP CONSTRAINT FK_73985B74CF60E67C');
        $this->addSql('ALTER TABLE book_tag_book DROP CONSTRAINT FK_3C150ADE9305689C');
        $this->addSql('ALTER TABLE book_tag_book DROP CONSTRAINT FK_3C150ADE16A2B381');
        $this->addSql('ALTER TABLE books DROP CONSTRAINT FK_4A1B2A9264C19C1');
        $this->addSql('ALTER TABLE books DROP CONSTRAINT FK_4A1B2A92753B2DC');
        $this->addSql('ALTER TABLE books DROP CONSTRAINT FK_4A1B2A92CF60E67C');
        $this->addSql('ALTER TABLE tags DROP CONSTRAINT FK_6FBC942616A2B381');
        $this->addSql('ALTER TABLE tags DROP CONSTRAINT FK_6FBC94269305689C');
        $this->addSql('ALTER TABLE dailyNotes DROP CONSTRAINT FK_D9F9E606F9E21957');
        $this->addSql('ALTER TABLE dailyNotes DROP CONSTRAINT FK_D9F9E6067E3C61F9');
        $this->addSql('ALTER TABLE habit DROP CONSTRAINT FK_44FE21727E3C61F9');
        $this->addSql('ALTER TABLE imageAlbums DROP CONSTRAINT FK_6E332A4CCF60E67C');
        $this->addSql('ALTER TABLE imageAlbums DROP CONSTRAINT FK_6E332A4C20D6AABC');
        $this->addSql('ALTER TABLE moodTrackers DROP CONSTRAINT FK_EEF8E945CF60E67C');
        $this->addSql('ALTER TABLE readingTrackers DROP CONSTRAINT FK_946C0246CF60E67C');
        $this->addSql('DROP TABLE bookCategories');
        $this->addSql('DROP TABLE bookTags');
        $this->addSql('DROP TABLE book_tag_book');
        $this->addSql('DROP TABLE books');
        $this->addSql('DROP TABLE tags');
        $this->addSql('DROP TABLE dailyNotes');
        $this->addSql('DROP TABLE daily_helper');
        $this->addSql('DROP TABLE habit');
        $this->addSql('DROP TABLE imageAlbums');
        $this->addSql('DROP TABLE moodTrackers');
        $this->addSql('DROP TABLE proba');
        $this->addSql('DROP TABLE readingTrackers');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
