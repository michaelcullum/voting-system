<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160807232600 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE polls ADD burden_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE polls ADD CONSTRAINT FK_1D3CC6EE8B95CA19 FOREIGN KEY (burden_id) REFERENCES choices (id)');
        $this->addSql('CREATE INDEX IDX_1D3CC6EE8B95CA19 ON polls (burden_id)');
        $this->addSql('ALTER TABLE poll_type ADD quorum DOUBLE PRECISION NOT NULL, ADD majority DOUBLE PRECISION NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE poll_type DROP quorum, DROP majority');
        $this->addSql('ALTER TABLE polls DROP FOREIGN KEY FK_1D3CC6EE8B95CA19');
        $this->addSql('DROP INDEX IDX_1D3CC6EE8B95CA19 ON polls');
        $this->addSql('ALTER TABLE polls DROP burden_id');
    }
}
