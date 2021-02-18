<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210218211850 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE circular_dim CHANGE deep deep NUMERIC(10, 2) DEFAULT NULL, CHANGE diameter diameter NUMERIC(10, 2) DEFAULT NULL');
        $this->addSql('ALTER TABLE rectangle_dim CHANGE deep deep NUMERIC(10, 2) DEFAULT NULL, CHANGE height height NUMERIC(10, 2) DEFAULT NULL, CHANGE width width NUMERIC(10, 2) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE circular_dim CHANGE deep deep NUMERIC(10, 2) NOT NULL, CHANGE diameter diameter NUMERIC(10, 2) NOT NULL');
        $this->addSql('ALTER TABLE rectangle_dim CHANGE deep deep NUMERIC(10, 2) NOT NULL, CHANGE height height NUMERIC(10, 2) NOT NULL, CHANGE width width NUMERIC(10, 2) NOT NULL');
    }
}
