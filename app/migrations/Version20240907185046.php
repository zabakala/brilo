<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240907185046 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, geo_id INT DEFAULT NULL, user_id INT NOT NULL, street VARCHAR(100) NOT NULL, suite VARCHAR(100) DEFAULT NULL, city VARCHAR(20) NOT NULL, zipcode VARCHAR(20) NOT NULL, UNIQUE INDEX UNIQ_D4E6F817F40B978 (geo_id), INDEX IDX_D4E6F81A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, post_id INT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(40) NOT NULL, body VARCHAR(500) NOT NULL, INDEX IDX_9474526CE85F12B8 (post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(100) NOT NULL, catch_phrase VARCHAR(150) DEFAULT NULL, bs VARCHAR(100) NOT NULL, INDEX IDX_4FBF094FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE geo (id INT AUTO_INCREMENT NOT NULL, lat NUMERIC(11, 8) NOT NULL, lng NUMERIC(11, 8) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, seo_title VARCHAR(255) NOT NULL, body VARCHAR(1000) NOT NULL, INDEX IDX_5A8A6C8D9D86650F (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, username VARCHAR(30) NOT NULL, email VARCHAR(40) NOT NULL, phone VARCHAR(50) NOT NULL, website VARCHAR(150) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F817F40B978 FOREIGN KEY (geo_id) REFERENCES geo (id)');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CE85F12B8 FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D9D86650F FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F817F40B978');
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F81A76ED395');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CE85F12B8');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FA76ED395');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D9D86650F');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE geo');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE user');
    }
}
