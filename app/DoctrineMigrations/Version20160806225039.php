<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160806225039 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fos_user DROP FOREIGN KEY FK_957A6479A35D7AF0');
        $this->addSql('DROP TABLE fos_invites');
        $this->addSql('DROP INDEX UNIQ_957A6479A35D7AF0 ON fos_user');
        $this->addSql('ALTER TABLE fos_user DROP invitation_id, CHANGE username username VARCHAR(180) NOT NULL, CHANGE username_canonical username_canonical VARCHAR(180) NOT NULL, CHANGE email email VARCHAR(180) NOT NULL, CHANGE email_canonical email_canonical VARCHAR(180) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE fos_invites (code VARCHAR(6) NOT NULL COLLATE utf8_unicode_ci, email VARCHAR(256) NOT NULL COLLATE utf8_unicode_ci, sent TINYINT(1) NOT NULL, PRIMARY KEY(code)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fos_user ADD invitation_id VARCHAR(6) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE username username VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE username_canonical username_canonical VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE email email VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE email_canonical email_canonical VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE fos_user ADD CONSTRAINT FK_957A6479A35D7AF0 FOREIGN KEY (invitation_id) REFERENCES fos_invites (code)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_957A6479A35D7AF0 ON fos_user (invitation_id)');
    }
}
