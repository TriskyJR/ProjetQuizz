<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200203101301 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tuser (id INT AUTO_INCREMENT NOT NULL, use_username VARCHAR(255) NOT NULL, use_class VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tuser_score ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE tuser_score ADD CONSTRAINT FK_16AD34E2A76ED395 FOREIGN KEY (user_id) REFERENCES tuser (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_16AD34E2A76ED395 ON tuser_score (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tuser_score DROP FOREIGN KEY FK_16AD34E2A76ED395');
        $this->addSql('DROP TABLE tuser');
        $this->addSql('DROP INDEX UNIQ_16AD34E2A76ED395 ON tuser_score');
        $this->addSql('ALTER TABLE tuser_score DROP user_id');
    }
}
