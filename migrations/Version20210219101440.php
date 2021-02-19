<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210219101440 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE noise (id INT AUTO_INCREMENT NOT NULL, distance DOUBLE PRECISION NOT NULL, value DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE noise_configuration (noise_id INT NOT NULL, configuration_id INT NOT NULL, INDEX IDX_7A009A93D9CC8E72 (noise_id), INDEX IDX_7A009A9373F32DD8 (configuration_id), PRIMARY KEY(noise_id, configuration_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE noise_configuration ADD CONSTRAINT FK_7A009A93D9CC8E72 FOREIGN KEY (noise_id) REFERENCES noise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE noise_configuration ADD CONSTRAINT FK_7A009A9373F32DD8 FOREIGN KEY (configuration_id) REFERENCES configuration (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE noise_configuration DROP FOREIGN KEY FK_7A009A93D9CC8E72');
        $this->addSql('DROP TABLE noise');
        $this->addSql('DROP TABLE noise_configuration');
    }
}
