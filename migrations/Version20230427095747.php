<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230427095747 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE course RENAME COLUMN сщcode TO char_code');
        $this->addSql('ALTER TABLE course RENAME COLUMN description TO content');
        $this->addSql('ALTER TABLE lesson ADD course_code_id INT NOT NULL');
        $this->addSql('ALTER TABLE lesson DROP id_course');
        $this->addSql('ALTER TABLE lesson RENAME COLUMN lesson_text TO content');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F32F19FBFB FOREIGN KEY (course_code_id) REFERENCES course (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_F87474F32F19FBFB ON lesson (course_code_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE course RENAME COLUMN char_code TO "сщcode"');
        $this->addSql('ALTER TABLE course RENAME COLUMN content TO description');
        $this->addSql('ALTER TABLE lesson DROP CONSTRAINT FK_F87474F32F19FBFB');
        $this->addSql('DROP INDEX IDX_F87474F32F19FBFB');
        $this->addSql('ALTER TABLE lesson ADD id_course VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE lesson DROP course_code_id');
        $this->addSql('ALTER TABLE lesson RENAME COLUMN content TO lesson_text');
    }
}
