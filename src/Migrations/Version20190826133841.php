<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190826133841 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE actualite');
        $this->addSql('ALTER TABLE user ADD created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE event_like DROP FOREIGN KEY FK_B3A80C18A76ED395');
        $this->addSql('ALTER TABLE event_like ADD CONSTRAINT FK_B3A80C18A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE actualite (id INT AUTO_INCREMENT NOT NULL, thematique VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, contenu VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, date_publication DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE event_like DROP FOREIGN KEY FK_B3A80C18A76ED395');
        $this->addSql('ALTER TABLE event_like ADD CONSTRAINT FK_B3A80C18A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user DROP created_at');
    }
}
