<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230207190921 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reposts (id INT AUTO_INCREMENT NOT NULL, comment_id_id INT DEFAULT NULL, reason VARCHAR(255) NOT NULL, INDEX IDX_F0DDCD72D6DE06A6 (comment_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reposts ADD CONSTRAINT FK_F0DDCD72D6DE06A6 FOREIGN KEY (comment_id_id) REFERENCES commentaires (id)');
        $this->addSql('ALTER TABLE post ADD creater_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D61979421 FOREIGN KEY (creater_id_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8D61979421 ON post (creater_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reposts DROP FOREIGN KEY FK_F0DDCD72D6DE06A6');
        $this->addSql('DROP TABLE reposts');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D61979421');
        $this->addSql('DROP INDEX IDX_5A8A6C8D61979421 ON post');
        $this->addSql('ALTER TABLE post DROP creater_id_id');
    }
}
