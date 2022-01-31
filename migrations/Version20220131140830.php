<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220131140830 extends AbstractMigration
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
        $this->addSql('CREATE TABLE corenthin_projet6_trick (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, category_id INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, slug VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_A6B1369FA76ED395 (user_id), INDEX IDX_A6B1369F12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE corenthin_projet6_comment ADD CONSTRAINT FK_D65C0BF2A76ED395 FOREIGN KEY (user_id) REFERENCES corenthin_projet6_user (id)');
        $this->addSql('ALTER TABLE corenthin_projet6_comment ADD CONSTRAINT FK_D65C0BF2B281BE2E FOREIGN KEY (trick_id) REFERENCES corenthin_projet6_trick (id)');
        $this->addSql('ALTER TABLE corenthin_projet6_trick ADD CONSTRAINT FK_A6B1369FA76ED395 FOREIGN KEY (user_id) REFERENCES corenthin_projet6_user (id)');
        $this->addSql('ALTER TABLE corenthin_projet6_trick ADD CONSTRAINT FK_A6B1369F12469DE2 FOREIGN KEY (category_id) REFERENCES corenthin_projet6_category (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE corenthin_projet6_trick DROP FOREIGN KEY FK_A6B1369F12469DE2');
        $this->addSql('ALTER TABLE corenthin_projet6_comment DROP FOREIGN KEY FK_D65C0BF2B281BE2E');
        $this->addSql('DROP TABLE corenthin_projet6_category');
        $this->addSql('DROP TABLE corenthin_projet6_comment');
        $this->addSql('DROP TABLE corenthin_projet6_trick');
        $this->addSql('ALTER TABLE corenthin_projet6_user CHANGE username username VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE email email VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
