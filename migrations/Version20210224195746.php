<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210224195746 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE assets (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE assets_quantities (id INT AUTO_INCREMENT NOT NULL, recipe_id INT NOT NULL, asset_id INT NOT NULL, quantity DOUBLE PRECISION DEFAULT NULL, unit VARCHAR(255) DEFAULT NULL, info LONGTEXT DEFAULT NULL, INDEX IDX_4B98A3459D8A214 (recipe_id), INDEX IDX_4B98A345DA1941 (asset_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comments (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, recipe_id INT NOT NULL, parent_comment_id INT NOT NULL, comment LONGTEXT NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, target VARCHAR(255) NOT NULL, INDEX IDX_5F9E962AF675F31B (author_id), INDEX IDX_5F9E962A59D8A214 (recipe_id), INDEX IDX_5F9E962ABF2AF943 (parent_comment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE likes (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, recipe_id INT NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX IDX_49CA4E7DF675F31B (author_id), INDEX IDX_49CA4E7D59D8A214 (recipe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipes (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX IDX_A369E2B5F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, birth_country VARCHAR(255) NOT NULL, living_country VARCHAR(255) NOT NULL, phone VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, UNIQUE INDEX UNIQ_1483A5E9F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE assets_quantities ADD CONSTRAINT FK_4B98A3459D8A214 FOREIGN KEY (recipe_id) REFERENCES recipes (id)');
        $this->addSql('ALTER TABLE assets_quantities ADD CONSTRAINT FK_4B98A345DA1941 FOREIGN KEY (asset_id) REFERENCES assets (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AF675F31B FOREIGN KEY (author_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipes (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962ABF2AF943 FOREIGN KEY (parent_comment_id) REFERENCES comments (id)');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT FK_49CA4E7DF675F31B FOREIGN KEY (author_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT FK_49CA4E7D59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipes (id)');
        $this->addSql('ALTER TABLE recipes ADD CONSTRAINT FK_A369E2B5F675F31B FOREIGN KEY (author_id) REFERENCES users (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE assets_quantities DROP FOREIGN KEY FK_4B98A345DA1941');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962ABF2AF943');
        $this->addSql('ALTER TABLE assets_quantities DROP FOREIGN KEY FK_4B98A3459D8A214');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A59D8A214');
        $this->addSql('ALTER TABLE likes DROP FOREIGN KEY FK_49CA4E7D59D8A214');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AF675F31B');
        $this->addSql('ALTER TABLE likes DROP FOREIGN KEY FK_49CA4E7DF675F31B');
        $this->addSql('ALTER TABLE recipes DROP FOREIGN KEY FK_A369E2B5F675F31B');
        $this->addSql('DROP TABLE assets');
        $this->addSql('DROP TABLE assets_quantities');
        $this->addSql('DROP TABLE comments');
        $this->addSql('DROP TABLE likes');
        $this->addSql('DROP TABLE recipes');
        $this->addSql('DROP TABLE users');
    }
}
