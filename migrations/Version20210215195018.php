<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210215195018 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE board_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE owner_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE task_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE board (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE board_owner (board_id INT NOT NULL, owner_id INT NOT NULL, PRIMARY KEY(board_id, owner_id))');
        $this->addSql('CREATE INDEX IDX_6DDD0157E7EC5785 ON board_owner (board_id)');
        $this->addSql('CREATE INDEX IDX_6DDD01577E3C61F9 ON board_owner (owner_id)');
        $this->addSql('CREATE TABLE category (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE owner (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE new_task (id INT NOT NULL, owner_id INT DEFAULT NULL, category_id INT NOT NULL, board_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, time_spent TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, start_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_527EDB257E3C61F9 ON new_task (owner_id)');
        $this->addSql('CREATE INDEX IDX_527EDB2512469DE2 ON new_task (category_id)');
        $this->addSql('CREATE INDEX IDX_527EDB25E7EC5785 ON new_task (board_id)');
        $this->addSql('ALTER TABLE board_owner ADD CONSTRAINT FK_6DDD0157E7EC5785 FOREIGN KEY (board_id) REFERENCES board (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE board_owner ADD CONSTRAINT FK_6DDD01577E3C61F9 FOREIGN KEY (owner_id) REFERENCES owner (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE new_task ADD CONSTRAINT FK_527EDB257E3C61F9 FOREIGN KEY (owner_id) REFERENCES owner (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE new_task ADD CONSTRAINT FK_527EDB2512469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE new_task ADD CONSTRAINT FK_527EDB25E7EC5785 FOREIGN KEY (board_id) REFERENCES board (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE board_owner DROP CONSTRAINT FK_6DDD0157E7EC5785');
        $this->addSql('ALTER TABLE new_task DROP CONSTRAINT FK_527EDB25E7EC5785');
        $this->addSql('ALTER TABLE new_task DROP CONSTRAINT FK_527EDB2512469DE2');
        $this->addSql('ALTER TABLE board_owner DROP CONSTRAINT FK_6DDD01577E3C61F9');
        $this->addSql('ALTER TABLE new_task DROP CONSTRAINT FK_527EDB257E3C61F9');
        $this->addSql('DROP SEQUENCE board_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE owner_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE task_id_seq CASCADE');
        $this->addSql('DROP TABLE board');
        $this->addSql('DROP TABLE board_owner');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE owner');
        $this->addSql('DROP TABLE new_task');
    }
}
