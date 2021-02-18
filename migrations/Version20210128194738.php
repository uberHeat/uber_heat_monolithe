<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210128194738 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animation_user (animation_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_1F9D09BE3858647E (animation_id), INDEX IDX_1F9D09BEA76ED395 (user_id), PRIMARY KEY(animation_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE animation_user ADD CONSTRAINT FK_1F9D09BE3858647E FOREIGN KEY (animation_id) REFERENCES `animation` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE animation_user ADD CONSTRAINT FK_1F9D09BEA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE animation DROP FOREIGN KEY FK_3BAE0AA7F675F31B');
        $this->addSql('DROP INDEX IDX_3BAE0AA7F675F31B ON animation');
        $this->addSql('ALTER TABLE animation DROP author_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE animation_user');
        $this->addSql('ALTER TABLE `animation` ADD author_id INT NOT NULL');
        $this->addSql('ALTER TABLE `animation` ADD CONSTRAINT FK_3BAE0AA7F675F31B FOREIGN KEY (author_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_3BAE0AA7F675F31B ON `animation` (author_id)');
    }
}
