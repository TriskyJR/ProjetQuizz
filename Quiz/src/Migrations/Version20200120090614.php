<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200120090614 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tanswer ADD question_id INT NOT NULL');
        $this->addSql('ALTER TABLE tanswer ADD CONSTRAINT FK_EE54C0C01E27F6BF FOREIGN KEY (question_id) REFERENCES tquestion (id)');
        $this->addSql('CREATE INDEX IDX_EE54C0C01E27F6BF ON tanswer (question_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tanswer DROP FOREIGN KEY FK_EE54C0C01E27F6BF');
        $this->addSql('DROP INDEX IDX_EE54C0C01E27F6BF ON tanswer');
        $this->addSql('ALTER TABLE tanswer DROP question_id');
    }
}
