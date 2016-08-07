<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160807004747 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE choices (id INT AUTO_INCREMENT NOT NULL, choice_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groups (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_F06D39705E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE polls (id INT AUTO_INCREMENT NOT NULL, creator_id INT DEFAULT NULL, poll_type_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, start DATETIME NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_1D3CC6EE61220EA6 (creator_id), INDEX IDX_1D3CC6EE391901AC (poll_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE poll_choice (poll_id INT NOT NULL, choice_id INT NOT NULL, INDEX IDX_2DAE19C93C947C0F (poll_id), INDEX IDX_2DAE19C9998666D1 (choice_id), PRIMARY KEY(poll_id, choice_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE poll_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_3B985CF35E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, locked TINYINT(1) NOT NULL, expired TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', credentials_expired TINYINT(1) NOT NULL, credentials_expire_at DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1483A5E992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_1483A5E9A0D96FBF (email_canonical), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fos_user_user_group (user_id INT NOT NULL, group_id INT NOT NULL, INDEX IDX_B3C77447A76ED395 (user_id), INDEX IDX_B3C77447FE54D947 (group_id), PRIMARY KEY(user_id, group_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE votes (id INT AUTO_INCREMENT NOT NULL, poll_id INT DEFAULT NULL, caster_id INT DEFAULT NULL, choice_id INT DEFAULT NULL, time DATETIME NOT NULL, INDEX IDX_518B7ACF3C947C0F (poll_id), INDEX IDX_518B7ACFDB710083 (caster_id), INDEX IDX_518B7ACF998666D1 (choice_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE polls ADD CONSTRAINT FK_1D3CC6EE61220EA6 FOREIGN KEY (creator_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE polls ADD CONSTRAINT FK_1D3CC6EE391901AC FOREIGN KEY (poll_type_id) REFERENCES poll_type (id)');
        $this->addSql('ALTER TABLE poll_choice ADD CONSTRAINT FK_2DAE19C93C947C0F FOREIGN KEY (poll_id) REFERENCES polls (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE poll_choice ADD CONSTRAINT FK_2DAE19C9998666D1 FOREIGN KEY (choice_id) REFERENCES choices (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fos_user_user_group ADD CONSTRAINT FK_B3C77447A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE fos_user_user_group ADD CONSTRAINT FK_B3C77447FE54D947 FOREIGN KEY (group_id) REFERENCES groups (id)');
        $this->addSql('ALTER TABLE votes ADD CONSTRAINT FK_518B7ACF3C947C0F FOREIGN KEY (poll_id) REFERENCES polls (id)');
        $this->addSql('ALTER TABLE votes ADD CONSTRAINT FK_518B7ACFDB710083 FOREIGN KEY (caster_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE votes ADD CONSTRAINT FK_518B7ACF998666D1 FOREIGN KEY (choice_id) REFERENCES choices (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE poll_choice DROP FOREIGN KEY FK_2DAE19C9998666D1');
        $this->addSql('ALTER TABLE votes DROP FOREIGN KEY FK_518B7ACF998666D1');
        $this->addSql('ALTER TABLE fos_user_user_group DROP FOREIGN KEY FK_B3C77447FE54D947');
        $this->addSql('ALTER TABLE poll_choice DROP FOREIGN KEY FK_2DAE19C93C947C0F');
        $this->addSql('ALTER TABLE votes DROP FOREIGN KEY FK_518B7ACF3C947C0F');
        $this->addSql('ALTER TABLE polls DROP FOREIGN KEY FK_1D3CC6EE391901AC');
        $this->addSql('ALTER TABLE polls DROP FOREIGN KEY FK_1D3CC6EE61220EA6');
        $this->addSql('ALTER TABLE fos_user_user_group DROP FOREIGN KEY FK_B3C77447A76ED395');
        $this->addSql('ALTER TABLE votes DROP FOREIGN KEY FK_518B7ACFDB710083');
        $this->addSql('DROP TABLE choices');
        $this->addSql('DROP TABLE groups');
        $this->addSql('DROP TABLE polls');
        $this->addSql('DROP TABLE poll_choice');
        $this->addSql('DROP TABLE poll_type');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE fos_user_user_group');
        $this->addSql('DROP TABLE votes');
    }
}
