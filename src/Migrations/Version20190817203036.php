<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190817203036 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE lignede_commande (id INT AUTO_INCREMENT NOT NULL, commande_id INT NOT NULL, nosupport INT NOT NULL, INDEX IDX_9A8072B482EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lignede_commande ADD CONSTRAINT FK_9A8072B482EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE evenement RENAME INDEX idx_b26681e1f48ae04 TO IDX_B26681EB7970CF8');
        $this->addSql('ALTER TABLE user ADD user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6499D86650F FOREIGN KEY (user_id_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6499D86650F ON user (user_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE lignede_commande');
        $this->addSql('ALTER TABLE evenement RENAME INDEX idx_b26681eb7970cf8 TO IDX_B26681E1F48AE04');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6499D86650F');
        $this->addSql('DROP INDEX IDX_8D93D6499D86650F ON user');
        $this->addSql('ALTER TABLE user DROP user_id_id');
    }
}
