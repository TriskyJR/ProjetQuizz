<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200302183326 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tanswer (id INT AUTO_INCREMENT NOT NULL, question_id INT NOT NULL, ans_title VARCHAR(255) NOT NULL, ans_true_false TINYINT(1) NOT NULL, INDEX IDX_EE54C0C01E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tquestion (id INT AUTO_INCREMENT NOT NULL, que_title VARCHAR(255) NOT NULL, que_type TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tuser (id INT AUTO_INCREMENT NOT NULL, use_username VARCHAR(255) NOT NULL, use_class VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tuser_answer (id INT AUTO_INCREMENT NOT NULL, answer_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_88919C10AA334807 (answer_id), INDEX IDX_88919C10A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tuser_score (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, sco_score DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_16AD34E2A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tanswer ADD CONSTRAINT FK_EE54C0C01E27F6BF FOREIGN KEY (question_id) REFERENCES tquestion (id)');
        $this->addSql('ALTER TABLE tuser_answer ADD CONSTRAINT FK_88919C10AA334807 FOREIGN KEY (answer_id) REFERENCES tanswer (id)');
        $this->addSql('ALTER TABLE tuser_answer ADD CONSTRAINT FK_88919C10A76ED395 FOREIGN KEY (user_id) REFERENCES tuser (id)');
        $this->addSql('ALTER TABLE tuser_score ADD CONSTRAINT FK_16AD34E2A76ED395 FOREIGN KEY (user_id) REFERENCES tuser (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tuser_answer DROP FOREIGN KEY FK_88919C10AA334807');
        $this->addSql('ALTER TABLE tanswer DROP FOREIGN KEY FK_EE54C0C01E27F6BF');
        $this->addSql('ALTER TABLE tuser_answer DROP FOREIGN KEY FK_88919C10A76ED395');
        $this->addSql('ALTER TABLE tuser_score DROP FOREIGN KEY FK_16AD34E2A76ED395');
        $this->addSql('DROP TABLE tanswer');
        $this->addSql('DROP TABLE tquestion');
        $this->addSql('DROP TABLE tuser');
        $this->addSql('DROP TABLE tuser_answer');
        $this->addSql('DROP TABLE tuser_score');
    }
}
