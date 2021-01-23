<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210123172350 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE board_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE board (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE board_owner (board_id INT NOT NULL, owner_id INT NOT NULL, PRIMARY KEY(board_id, owner_id))');
        $this->addSql('CREATE INDEX IDX_6DDD0157E7EC5785 ON board_owner (board_id)');
        $this->addSql('CREATE INDEX IDX_6DDD01577E3C61F9 ON board_owner (owner_id)');
        $this->addSql('ALTER TABLE board_owner ADD CONSTRAINT FK_6DDD0157E7EC5785 FOREIGN KEY (board_id) REFERENCES board (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE board_owner ADD CONSTRAINT FK_6DDD01577E3C61F9 FOREIGN KEY (owner_id) REFERENCES owner (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE task ADD board_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25E7EC5785 FOREIGN KEY (board_id) REFERENCES board (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_527EDB25E7EC5785 ON task (board_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE board_owner DROP CONSTRAINT FK_6DDD0157E7EC5785');
        $this->addSql('ALTER TABLE task DROP CONSTRAINT FK_527EDB25E7EC5785');
        $this->addSql('DROP SEQUENCE board_id_seq CASCADE');
        $this->addSql('DROP TABLE board');
        $this->addSql('DROP TABLE board_owner');
        $this->addSql('DROP INDEX IDX_527EDB25E7EC5785');
        $this->addSql('ALTER TABLE task DROP board_id');
    }
}
