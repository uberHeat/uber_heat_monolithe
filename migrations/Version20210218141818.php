<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210218141818 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE circular_dim (id INT AUTO_INCREMENT NOT NULL, configuration_id INT DEFAULT NULL, deep NUMERIC(10, 2) NOT NULL, diameter NUMERIC(10, 2) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_2B425FD873F32DD8 (configuration_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE configuration (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_A5E2A5D74584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `product` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, base_price NUMERIC(10, 2) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rectangle_dim (id INT AUTO_INCREMENT NOT NULL, configuration_id INT DEFAULT NULL, deep NUMERIC(10, 2) NOT NULL, height NUMERIC(10, 2) NOT NULL, width NUMERIC(10, 2) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_E6B9929473F32DD8 (configuration_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE circular_dim ADD CONSTRAINT FK_2B425FD873F32DD8 FOREIGN KEY (configuration_id) REFERENCES configuration (id)');
        $this->addSql('ALTER TABLE configuration ADD CONSTRAINT FK_A5E2A5D74584665A FOREIGN KEY (product_id) REFERENCES `product` (id)');
        $this->addSql('ALTER TABLE rectangle_dim ADD CONSTRAINT FK_E6B9929473F32DD8 FOREIGN KEY (configuration_id) REFERENCES configuration (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE circular_dim DROP FOREIGN KEY FK_2B425FD873F32DD8');
        $this->addSql('ALTER TABLE rectangle_dim DROP FOREIGN KEY FK_E6B9929473F32DD8');
        $this->addSql('ALTER TABLE configuration DROP FOREIGN KEY FK_A5E2A5D74584665A');
        $this->addSql('DROP TABLE circular_dim');
        $this->addSql('DROP TABLE configuration');
        $this->addSql('DROP TABLE `product`');
        $this->addSql('DROP TABLE rectangle_dim');
    }
}
