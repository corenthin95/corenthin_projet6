<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220131161714 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE corenthin_projet6_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE corenthin_projet6_comment (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, trick_id INT DEFAULT NULL, created_at DATETIME NOT NULL, content LONGTEXT NOT NULL, INDEX IDX_D65C0BF2A76ED395 (user_id), INDEX IDX_D65C0BF2B281BE2E (trick_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE corenthin_projet6_media (id INT AUTO_INCREMENT NOT NULL, trick_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, alt VARCHAR(255) DEFAULT NULL, INDEX IDX_146D3E8DB281BE2E (trick_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE corenthin_projet6_trick (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, category_id INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, slug VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_A6B1369FA76ED395 (user_id), INDEX IDX_A6B1369F12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE corenthin_projet6_comment ADD CONSTRAINT FK_D65C0BF2A76ED395 FOREIGN KEY (user_id) REFERENCES corenthin_projet6_user (id)');
        $this->addSql('ALTER TABLE corenthin_projet6_comment ADD CONSTRAINT FK_D65C0BF2B281BE2E FOREIGN KEY (trick_id) REFERENCES corenthin_projet6_trick (id)');
        $this->addSql('ALTER TABLE corenthin_projet6_media ADD CONSTRAINT FK_146D3E8DB281BE2E FOREIGN KEY (trick_id) REFERENCES corenthin_projet6_trick (id)');
        $this->addSql('ALTER TABLE corenthin_projet6_trick ADD CONSTRAINT FK_A6B1369FA76ED395 FOREIGN KEY (user_id) REFERENCES corenthin_projet6_user (id)');
        $this->addSql('ALTER TABLE corenthin_projet6_trick ADD CONSTRAINT FK_A6B1369F12469DE2 FOREIGN KEY (category_id) REFERENCES corenthin_projet6_category (id)');
        $this->addSql('ALTER TABLE corenthin_projet6_user ADD media_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE corenthin_projet6_user ADD CONSTRAINT FK_7D70EA44EA9FDD75 FOREIGN KEY (media_id) REFERENCES corenthin_projet6_media (id)');
        $this->addSql('CREATE INDEX IDX_7D70EA44EA9FDD75 ON corenthin_projet6_user (media_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE corenthin_projet6_trick DROP FOREIGN KEY FK_A6B1369F12469DE2');
        $this->addSql('ALTER TABLE corenthin_projet6_user DROP FOREIGN KEY FK_7D70EA44EA9FDD75');
        $this->addSql('ALTER TABLE corenthin_projet6_comment DROP FOREIGN KEY FK_D65C0BF2B281BE2E');
        $this->addSql('ALTER TABLE corenthin_projet6_media DROP FOREIGN KEY FK_146D3E8DB281BE2E');
        $this->addSql('DROP TABLE corenthin_projet6_category');
        $this->addSql('DROP TABLE corenthin_projet6_comment');
        $this->addSql('DROP TABLE corenthin_projet6_media');
        $this->addSql('DROP TABLE corenthin_projet6_trick');
        $this->addSql('DROP INDEX IDX_7D70EA44EA9FDD75 ON corenthin_projet6_user');
        $this->addSql('ALTER TABLE corenthin_projet6_user DROP media_id, CHANGE username username VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE email email VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
