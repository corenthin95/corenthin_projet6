<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220611125819 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_7D70EA44EA9FDD75 ON corenthin_projet6_user');
        $this->addSql('ALTER TABLE corenthin_projet6_user CHANGE media_id picture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE corenthin_projet6_user ADD CONSTRAINT FK_7D70EA44EE45BDBF FOREIGN KEY (picture_id) REFERENCES corenthin_projet6_picture (id)');
        $this->addSql('CREATE INDEX IDX_7D70EA44EE45BDBF ON corenthin_projet6_user (picture_id)');
        $this->addSql('ALTER TABLE corenthin_projet6_video ADD path VARCHAR(255) NOT NULL, DROP filename, DROP alt');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE corenthin_projet6_category CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE corenthin_projet6_comment CHANGE content content LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE corenthin_projet6_picture CHANGE filename filename VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE alt alt VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE corenthin_projet6_reset_password_request CHANGE selector selector VARCHAR(20) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE hashed_token hashed_token VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE corenthin_projet6_trick CHANGE slug slug VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image image VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE corenthin_projet6_user DROP FOREIGN KEY FK_7D70EA44EE45BDBF');
        $this->addSql('DROP INDEX IDX_7D70EA44EE45BDBF ON corenthin_projet6_user');
        $this->addSql('ALTER TABLE corenthin_projet6_user CHANGE username username VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE email email VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE token token VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE picture_id media_id INT DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_7D70EA44EA9FDD75 ON corenthin_projet6_user (media_id)');
        $this->addSql('ALTER TABLE corenthin_projet6_video ADD filename VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD alt VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP path');
    }
}
