<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210219161138 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE circular_dim (id INT NOT NULL, diameter DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE configuration (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_A5E2A5D74584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dimension (id INT AUTO_INCREMENT NOT NULL, config_id INT DEFAULT NULL, deep DOUBLE PRECISION DEFAULT NULL, discr VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_CA9BC19C24DB0683 (config_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE noise (id INT AUTO_INCREMENT NOT NULL, distance DOUBLE PRECISION NOT NULL, value DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE noise_configuration (noise_id INT NOT NULL, configuration_id INT NOT NULL, INDEX IDX_7A009A93D9CC8E72 (noise_id), INDEX IDX_7A009A9373F32DD8 (configuration_id), PRIMARY KEY(noise_id, configuration_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `product` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, base_price NUMERIC(10, 2) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rectangle_dim (id INT NOT NULL, height DOUBLE PRECISION DEFAULT NULL, width DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE circular_dim ADD CONSTRAINT FK_2B425FD8BF396750 FOREIGN KEY (id) REFERENCES dimension (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE configuration ADD CONSTRAINT FK_A5E2A5D74584665A FOREIGN KEY (product_id) REFERENCES `product` (id)');
        $this->addSql('ALTER TABLE dimension ADD CONSTRAINT FK_CA9BC19C24DB0683 FOREIGN KEY (config_id) REFERENCES configuration (id)');
        $this->addSql('ALTER TABLE noise_configuration ADD CONSTRAINT FK_7A009A93D9CC8E72 FOREIGN KEY (noise_id) REFERENCES noise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE noise_configuration ADD CONSTRAINT FK_7A009A9373F32DD8 FOREIGN KEY (configuration_id) REFERENCES configuration (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rectangle_dim ADD CONSTRAINT FK_E6B99294BF396750 FOREIGN KEY (id) REFERENCES dimension (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dimension DROP FOREIGN KEY FK_CA9BC19C24DB0683');
        $this->addSql('ALTER TABLE noise_configuration DROP FOREIGN KEY FK_7A009A9373F32DD8');
        $this->addSql('ALTER TABLE circular_dim DROP FOREIGN KEY FK_2B425FD8BF396750');
        $this->addSql('ALTER TABLE rectangle_dim DROP FOREIGN KEY FK_E6B99294BF396750');
        $this->addSql('ALTER TABLE noise_configuration DROP FOREIGN KEY FK_7A009A93D9CC8E72');
        $this->addSql('ALTER TABLE configuration DROP FOREIGN KEY FK_A5E2A5D74584665A');
        $this->addSql('DROP TABLE circular_dim');
        $this->addSql('DROP TABLE configuration');
        $this->addSql('DROP TABLE dimension');
        $this->addSql('DROP TABLE noise');
        $this->addSql('DROP TABLE noise_configuration');
        $this->addSql('DROP TABLE `product`');
        $this->addSql('DROP TABLE rectangle_dim');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE `user`');
    }
}
