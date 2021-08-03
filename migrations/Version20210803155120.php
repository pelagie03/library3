<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210803155120 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adherent (id INT AUTO_INCREMENT NOT NULL, matricule INT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, date_naiss DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bd (id INT NOT NULL, dessinateur VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dictionnaire (id INT NOT NULL, annee_edition DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(50) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE emprunt (id INT AUTO_INCREMENT NOT NULL, adherent_id INT DEFAULT NULL, pret_id INT NOT NULL, date_emprunt DATE NOT NULL, date_retour DATE NOT NULL, INDEX IDX_364071D725F06C53 (adherent_id), INDEX IDX_364071D71B61704B (pret_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE journal (id INT NOT NULL, num_parution INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livres (id INT NOT NULL, isbn VARCHAR(20) NOT NULL, disponible TINYINT(1) NOT NULL, genre VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE volume (id INT NOT NULL, auteur VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bd ADD CONSTRAINT FK_5CCDBE9BBF396750 FOREIGN KEY (id) REFERENCES document (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dictionnaire ADD CONSTRAINT FK_AE6CDAFFBF396750 FOREIGN KEY (id) REFERENCES document (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE emprunt ADD CONSTRAINT FK_364071D725F06C53 FOREIGN KEY (adherent_id) REFERENCES adherent (id)');
        $this->addSql('ALTER TABLE emprunt ADD CONSTRAINT FK_364071D71B61704B FOREIGN KEY (pret_id) REFERENCES livres (id)');
        $this->addSql('ALTER TABLE journal ADD CONSTRAINT FK_C1A7E74DBF396750 FOREIGN KEY (id) REFERENCES document (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livres ADD CONSTRAINT FK_927187A4BF396750 FOREIGN KEY (id) REFERENCES document (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE volume ADD CONSTRAINT FK_B99ACDDEBF396750 FOREIGN KEY (id) REFERENCES document (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE emprunt DROP FOREIGN KEY FK_364071D725F06C53');
        $this->addSql('ALTER TABLE bd DROP FOREIGN KEY FK_5CCDBE9BBF396750');
        $this->addSql('ALTER TABLE dictionnaire DROP FOREIGN KEY FK_AE6CDAFFBF396750');
        $this->addSql('ALTER TABLE journal DROP FOREIGN KEY FK_C1A7E74DBF396750');
        $this->addSql('ALTER TABLE livres DROP FOREIGN KEY FK_927187A4BF396750');
        $this->addSql('ALTER TABLE volume DROP FOREIGN KEY FK_B99ACDDEBF396750');
        $this->addSql('ALTER TABLE emprunt DROP FOREIGN KEY FK_364071D71B61704B');
        $this->addSql('DROP TABLE adherent');
        $this->addSql('DROP TABLE bd');
        $this->addSql('DROP TABLE dictionnaire');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE emprunt');
        $this->addSql('DROP TABLE journal');
        $this->addSql('DROP TABLE livres');
        $this->addSql('DROP TABLE volume');
    }
}
