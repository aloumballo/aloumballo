<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220614151816 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ac (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE annee_scolaire (id INT AUTO_INCREMENT NOT NULL, libelle_annee VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, r_p_id INT DEFAULT NULL, libelle VARCHAR(20) NOT NULL, filiere VARCHAR(20) NOT NULL, niveau VARCHAR(20) NOT NULL, INDEX IDX_8F87BF96BF54E9CD (r_p_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE demande (id INT AUTO_INCREMENT NOT NULL, inscrire_id INT DEFAULT NULL, motif VARCHAR(20) NOT NULL, date DATE NOT NULL, etat VARCHAR(20) NOT NULL, UNIQUE INDEX UNIQ_2694D7A55A9C42F6 (inscrire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etudiant (id INT NOT NULL, demande_id INT DEFAULT NULL, adresse VARCHAR(40) NOT NULL, sexe VARCHAR(10) NOT NULL, matricule VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_717E22E380E95E18 (demande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscrire (id INT AUTO_INCREMENT NOT NULL, annescolaire_id INT DEFAULT NULL, etudiant_id INT DEFAULT NULL, ac_id INT DEFAULT NULL, classe_id INT DEFAULT NULL, etat_inscription VARCHAR(20) NOT NULL, INDEX IDX_84CA37A862EA4BCC (annescolaire_id), INDEX IDX_84CA37A8DDEAB1A3 (etudiant_id), INDEX IDX_84CA37A8D2E3ED2F (ac_id), INDEX IDX_84CA37A88F5EA509 (classe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE module (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(20) NOT NULL, libelle_module VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE module_professeur (module_id INT NOT NULL, professeur_id INT NOT NULL, INDEX IDX_82407904AFC2B591 (module_id), INDEX IDX_82407904BAB22EE9 (professeur_id), PRIMARY KEY(module_id, professeur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professeur (id INT NOT NULL, r_p_id INT DEFAULT NULL, grade VARCHAR(20) NOT NULL, INDEX IDX_17A55299BF54E9CD (r_p_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professeur_classe (professeur_id INT NOT NULL, classe_id INT NOT NULL, INDEX IDX_38ABBDC6BAB22EE9 (professeur_id), INDEX IDX_38ABBDC68F5EA509 (classe_id), PRIMARY KEY(professeur_id, classe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rp (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom_complet VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ac ADD CONSTRAINT FK_E98478FBBF396750 FOREIGN KEY (id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF96BF54E9CD FOREIGN KEY (r_p_id) REFERENCES rp (id)');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A55A9C42F6 FOREIGN KEY (inscrire_id) REFERENCES inscrire (id)');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E380E95E18 FOREIGN KEY (demande_id) REFERENCES demande (id)');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3BF396750 FOREIGN KEY (id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscrire ADD CONSTRAINT FK_84CA37A862EA4BCC FOREIGN KEY (annescolaire_id) REFERENCES annee_scolaire (id)');
        $this->addSql('ALTER TABLE inscrire ADD CONSTRAINT FK_84CA37A8DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id)');
        $this->addSql('ALTER TABLE inscrire ADD CONSTRAINT FK_84CA37A8D2E3ED2F FOREIGN KEY (ac_id) REFERENCES ac (id)');
        $this->addSql('ALTER TABLE inscrire ADD CONSTRAINT FK_84CA37A88F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE module_professeur ADD CONSTRAINT FK_82407904AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE module_professeur ADD CONSTRAINT FK_82407904BAB22EE9 FOREIGN KEY (professeur_id) REFERENCES professeur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE professeur ADD CONSTRAINT FK_17A55299BF54E9CD FOREIGN KEY (r_p_id) REFERENCES rp (id)');
        $this->addSql('ALTER TABLE professeur ADD CONSTRAINT FK_17A55299BF396750 FOREIGN KEY (id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE professeur_classe ADD CONSTRAINT FK_38ABBDC6BAB22EE9 FOREIGN KEY (professeur_id) REFERENCES professeur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE professeur_classe ADD CONSTRAINT FK_38ABBDC68F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rp ADD CONSTRAINT FK_CD578B7BF396750 FOREIGN KEY (id) REFERENCES `user` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscrire DROP FOREIGN KEY FK_84CA37A8D2E3ED2F');
        $this->addSql('ALTER TABLE inscrire DROP FOREIGN KEY FK_84CA37A862EA4BCC');
        $this->addSql('ALTER TABLE inscrire DROP FOREIGN KEY FK_84CA37A88F5EA509');
        $this->addSql('ALTER TABLE professeur_classe DROP FOREIGN KEY FK_38ABBDC68F5EA509');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E380E95E18');
        $this->addSql('ALTER TABLE inscrire DROP FOREIGN KEY FK_84CA37A8DDEAB1A3');
        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY FK_2694D7A55A9C42F6');
        $this->addSql('ALTER TABLE module_professeur DROP FOREIGN KEY FK_82407904AFC2B591');
        $this->addSql('ALTER TABLE module_professeur DROP FOREIGN KEY FK_82407904BAB22EE9');
        $this->addSql('ALTER TABLE professeur_classe DROP FOREIGN KEY FK_38ABBDC6BAB22EE9');
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF96BF54E9CD');
        $this->addSql('ALTER TABLE professeur DROP FOREIGN KEY FK_17A55299BF54E9CD');
        $this->addSql('ALTER TABLE ac DROP FOREIGN KEY FK_E98478FBBF396750');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3BF396750');
        $this->addSql('ALTER TABLE professeur DROP FOREIGN KEY FK_17A55299BF396750');
        $this->addSql('ALTER TABLE rp DROP FOREIGN KEY FK_CD578B7BF396750');
        $this->addSql('DROP TABLE ac');
        $this->addSql('DROP TABLE annee_scolaire');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE demande');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE inscrire');
        $this->addSql('DROP TABLE module');
        $this->addSql('DROP TABLE module_professeur');
        $this->addSql('DROP TABLE professeur');
        $this->addSql('DROP TABLE professeur_classe');
        $this->addSql('DROP TABLE rp');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
