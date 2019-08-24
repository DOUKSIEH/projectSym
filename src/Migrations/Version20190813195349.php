<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190813195349 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE actualite (id INT AUTO_INCREMENT NOT NULL, thematique VARCHAR(255) NOT NULL, contenu VARCHAR(255) NOT NULL, date_publication DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artiste (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, pays VARCHAR(255) NOT NULL, style VARCHAR(255) NOT NULL, presentation VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, num_commande INT NOT NULL, date_commande DATETIME NOT NULL, montant INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, artist_id_id INT NOT NULL, type VARCHAR(255) NOT NULL, lieu VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, prix INT NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, INDEX IDX_B26681E1F48AE04 (artist_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, motdepasse VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, phone INT NOT NULL, role VARCHAR(255) NOT NULL, pseudo VARCHAR(255) NOT NULL, collection VARCHAR(255) NOT NULL, INDEX IDX_8D93D6499D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_actualite (user_id INT NOT NULL, actualite_id INT NOT NULL, INDEX IDX_54720C73A76ED395 (user_id), INDEX IDX_54720C73A2843073 (actualite_id), PRIMARY KEY(user_id, actualite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E1F48AE04 FOREIGN KEY (artist_id_id) REFERENCES artiste (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6499D86650F FOREIGN KEY (user_id_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE user_actualite ADD CONSTRAINT FK_54720C73A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_actualite ADD CONSTRAINT FK_54720C73A2843073 FOREIGN KEY (actualite_id) REFERENCES actualite (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_actualite DROP FOREIGN KEY FK_54720C73A2843073');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E1F48AE04');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6499D86650F');
        $this->addSql('ALTER TABLE user_actualite DROP FOREIGN KEY FK_54720C73A76ED395');
        $this->addSql('DROP TABLE actualite');
        $this->addSql('DROP TABLE artiste');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_actualite');
    }
}
