<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171111085024 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE blog_image (id INT AUTO_INCREMENT NOT NULL, post_id INT DEFAULT NULL, file VARCHAR(45) NOT NULL, INDEX IDX_35D247974B89032C (post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE posts (id INT AUTO_INCREMENT NOT NULL, main_status_id INT DEFAULT NULL, user_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, date DATETIME NOT NULL, INDEX IDX_885DBAFA4B41A71F (main_status_id), INDEX IDX_885DBAFAA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE birds (id INT AUTO_INCREMENT NOT NULL, family_id INT DEFAULT NULL, habitat_id INT DEFAULT NULL, cd_nom INT NOT NULL, latin_name VARCHAR(50) NOT NULL, french_name VARCHAR(110) DEFAULT NULL, author VARCHAR(55) DEFAULT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_FC1659A2C35E566A (family_id), INDEX IDX_FC1659A2AFFE2D26 (habitat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE families (id INT AUTO_INCREMENT NOT NULL, order_id INT DEFAULT NULL, name VARCHAR(20) NOT NULL, INDEX IDX_995F3FCC8D9F6D38 (order_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE habitats (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(40) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE main_statuses (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE observations (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, bird_id INT DEFAULT NULL, main_status_id INT DEFAULT NULL, date DATETIME NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT DEFAULT NULL, latitude NUMERIC(9, 6) NOT NULL, longitude NUMERIC(9, 6) NOT NULL, place VARCHAR(255) NOT NULL, INDEX IDX_BBC15BA8A76ED395 (user_id), INDEX IDX_BBC15BA8E813F9 (bird_id), INDEX IDX_BBC15BA84B41A71F (main_status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photos (id INT AUTO_INCREMENT NOT NULL, observation_id INT DEFAULT NULL, file VARCHAR(75) NOT NULL, INDEX IDX_876E0D91409DD88 (observation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pictures (id INT AUTO_INCREMENT NOT NULL, bird_id INT DEFAULT NULL, link VARCHAR(100) NOT NULL, author VARCHAR(70) DEFAULT NULL, INDEX IDX_8F7C2FC0E813F9 (bird_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE badges (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(75) NOT NULL, image VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE roles (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL, current_name VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, role_id INT DEFAULT NULL, user_status_id INT DEFAULT NULL, email VARCHAR(100) NOT NULL, login VARCHAR(45) NOT NULL, mdp VARCHAR(80) NOT NULL, salt VARCHAR(80) NOT NULL, town VARCHAR(255) DEFAULT NULL, phone VARCHAR(15) DEFAULT NULL, avatar VARCHAR(75) DEFAULT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), UNIQUE INDEX UNIQ_1483A5E9AA08CB10 (login), INDEX IDX_1483A5E9D60322AC (role_id), INDEX IDX_1483A5E96B178D59 (user_status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rewards (user_id INT NOT NULL, badge_id INT NOT NULL, INDEX IDX_E9221E37A76ED395 (user_id), INDEX IDX_E9221E37F7A2C2FC (badge_id), PRIMARY KEY(user_id, badge_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bookmarks (user_id INT NOT NULL, observation_id INT NOT NULL, INDEX IDX_78D2C140A76ED395 (user_id), INDEX IDX_78D2C1401409DD88 (observation_id), PRIMARY KEY(user_id, observation_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_statuses (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE blog_image ADD CONSTRAINT FK_35D247974B89032C FOREIGN KEY (post_id) REFERENCES posts (id)');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFA4B41A71F FOREIGN KEY (main_status_id) REFERENCES main_statuses (id)');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFAA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE birds ADD CONSTRAINT FK_FC1659A2C35E566A FOREIGN KEY (family_id) REFERENCES families (id)');
        $this->addSql('ALTER TABLE birds ADD CONSTRAINT FK_FC1659A2AFFE2D26 FOREIGN KEY (habitat_id) REFERENCES habitats (id)');
        $this->addSql('ALTER TABLE families ADD CONSTRAINT FK_995F3FCC8D9F6D38 FOREIGN KEY (order_id) REFERENCES orders (id)');
        $this->addSql('ALTER TABLE observations ADD CONSTRAINT FK_BBC15BA8A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE observations ADD CONSTRAINT FK_BBC15BA8E813F9 FOREIGN KEY (bird_id) REFERENCES birds (id)');
        $this->addSql('ALTER TABLE observations ADD CONSTRAINT FK_BBC15BA84B41A71F FOREIGN KEY (main_status_id) REFERENCES main_statuses (id)');
        $this->addSql('ALTER TABLE photos ADD CONSTRAINT FK_876E0D91409DD88 FOREIGN KEY (observation_id) REFERENCES observations (id)');
        $this->addSql('ALTER TABLE pictures ADD CONSTRAINT FK_8F7C2FC0E813F9 FOREIGN KEY (bird_id) REFERENCES birds (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9D60322AC FOREIGN KEY (role_id) REFERENCES roles (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E96B178D59 FOREIGN KEY (user_status_id) REFERENCES user_statuses (id)');
        $this->addSql('ALTER TABLE rewards ADD CONSTRAINT FK_E9221E37A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rewards ADD CONSTRAINT FK_E9221E37F7A2C2FC FOREIGN KEY (badge_id) REFERENCES badges (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bookmarks ADD CONSTRAINT FK_78D2C140A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bookmarks ADD CONSTRAINT FK_78D2C1401409DD88 FOREIGN KEY (observation_id) REFERENCES observations (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE blog_image DROP FOREIGN KEY FK_35D247974B89032C');
        $this->addSql('ALTER TABLE observations DROP FOREIGN KEY FK_BBC15BA8E813F9');
        $this->addSql('ALTER TABLE pictures DROP FOREIGN KEY FK_8F7C2FC0E813F9');
        $this->addSql('ALTER TABLE birds DROP FOREIGN KEY FK_FC1659A2C35E566A');
        $this->addSql('ALTER TABLE birds DROP FOREIGN KEY FK_FC1659A2AFFE2D26');
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_885DBAFA4B41A71F');
        $this->addSql('ALTER TABLE observations DROP FOREIGN KEY FK_BBC15BA84B41A71F');
        $this->addSql('ALTER TABLE photos DROP FOREIGN KEY FK_876E0D91409DD88');
        $this->addSql('ALTER TABLE bookmarks DROP FOREIGN KEY FK_78D2C1401409DD88');
        $this->addSql('ALTER TABLE families DROP FOREIGN KEY FK_995F3FCC8D9F6D38');
        $this->addSql('ALTER TABLE rewards DROP FOREIGN KEY FK_E9221E37F7A2C2FC');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9D60322AC');
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_885DBAFAA76ED395');
        $this->addSql('ALTER TABLE observations DROP FOREIGN KEY FK_BBC15BA8A76ED395');
        $this->addSql('ALTER TABLE rewards DROP FOREIGN KEY FK_E9221E37A76ED395');
        $this->addSql('ALTER TABLE bookmarks DROP FOREIGN KEY FK_78D2C140A76ED395');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E96B178D59');
        $this->addSql('DROP TABLE blog_image');
        $this->addSql('DROP TABLE posts');
        $this->addSql('DROP TABLE birds');
        $this->addSql('DROP TABLE families');
        $this->addSql('DROP TABLE habitats');
        $this->addSql('DROP TABLE main_statuses');
        $this->addSql('DROP TABLE observations');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE photos');
        $this->addSql('DROP TABLE pictures');
        $this->addSql('DROP TABLE badges');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE rewards');
        $this->addSql('DROP TABLE bookmarks');
        $this->addSql('DROP TABLE user_statuses');
    }
}
