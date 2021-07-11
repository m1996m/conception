<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200417135944 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE id_patient (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE urgence (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, financement VARCHAR(255) NOT NULL, date_arrive DATE NOT NULL, heure TIME NOT NULL, suivi VARCHAR(255) NOT NULL, profession VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE urgence_personnel (urgence_id INT NOT NULL, personnel_id INT NOT NULL, INDEX IDX_5282865C578B7FBD (urgence_id), INDEX IDX_5282865C1C109075 (personnel_id), PRIMARY KEY(urgence_id, personnel_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, id_personnel_id INT DEFAULT NULL, contenu LONGTEXT NOT NULL, create_at DATE NOT NULL, INDEX IDX_B6BD307F3FD1E507 (id_personnel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message_patient (message_id INT NOT NULL, patient_id INT NOT NULL, INDEX IDX_8A52EDE7537A1329 (message_id), INDEX IDX_8A52EDE76B899279 (patient_id), PRIMARY KEY(message_id, patient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message_urgence (message_id INT NOT NULL, urgence_id INT NOT NULL, INDEX IDX_E3F551C1537A1329 (message_id), INDEX IDX_E3F551C1578B7FBD (urgence_id), PRIMARY KEY(message_id, urgence_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message_maternite (message_id INT NOT NULL, maternite_id INT NOT NULL, INDEX IDX_14A5548A537A1329 (message_id), INDEX IDX_14A5548A3689A1A3 (maternite_id), PRIMARY KEY(message_id, maternite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message_international (message_id INT NOT NULL, international_id INT NOT NULL, INDEX IDX_5C63B395537A1329 (message_id), INDEX IDX_5C63B395D26C7C99 (international_id), PRIMARY KEY(message_id, international_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnel (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, adresse VARCHAR(255) NOT NULL, telephone INT NOT NULL, email VARCHAR(255) NOT NULL, profession VARCHAR(255) NOT NULL, fonction VARCHAR(255) NOT NULL, specialite VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE convocation (id INT AUTO_INCREMENT NOT NULL, id_patient_id INT DEFAULT NULL, id_urgence_id INT DEFAULT NULL, id_maternite_id INT DEFAULT NULL, id_iinternational_id INT DEFAULT NULL, id_personnel_id INT DEFAULT NULL, intitule LONGTEXT NOT NULL, date_convocation DATETIME NOT NULL, INDEX IDX_C03B3F5FCE0312AE (id_patient_id), INDEX IDX_C03B3F5FF201FF6A (id_urgence_id), INDEX IDX_C03B3F5F1548D4D1 (id_maternite_id), INDEX IDX_C03B3F5F145C7DB5 (id_iinternational_id), INDEX IDX_C03B3F5F3FD1E507 (id_personnel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialite (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fiche_patient (id INT AUTO_INCREMENT NOT NULL, id_maternite_id INT DEFAULT NULL, id_international_id INT DEFAULT NULL, id_urgence_id INT DEFAULT NULL, id_patient_id INT DEFAULT NULL, id_personnel_id INT DEFAULT NULL, statut VARCHAR(255) NOT NULL, INDEX IDX_2DB8C311548D4D1 (id_maternite_id), INDEX IDX_2DB8C3131E62948 (id_international_id), INDEX IDX_2DB8C31F201FF6A (id_urgence_id), INDEX IDX_2DB8C31CE0312AE (id_patient_id), INDEX IDX_2DB8C313FD1E507 (id_personnel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ordonnance (id INT AUTO_INCREMENT NOT NULL, id_patient_id INT DEFAULT NULL, id_urgence_id INT DEFAULT NULL, id_maternite_id INT DEFAULT NULL, id_international_id INT DEFAULT NULL, id_personnel_id INT DEFAULT NULL, contenu VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_924B326CCE0312AE (id_patient_id), INDEX IDX_924B326CF201FF6A (id_urgence_id), INDEX IDX_924B326C1548D4D1 (id_maternite_id), INDEX IDX_924B326C31E62948 (id_international_id), INDEX IDX_924B326C3FD1E507 (id_personnel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE international (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, genre VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, adresse VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, nationalite VARCHAR(255) NOT NULL, maladie VARCHAR(255) NOT NULL, debut_maladie DATE NOT NULL, financement VARCHAR(255) NOT NULL, date_arrve DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE maternite (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, adresse VARCHAR(255) NOT NULL, telephone INT NOT NULL, email VARCHAR(255) NOT NULL, profession VARCHAR(255) NOT NULL, debut_grossesse DATE NOT NULL, accouchement_prevu DATE NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, adresse VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, profession VARCHAR(255) NOT NULL, specialite VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fiche_suivi (id INT AUTO_INCREMENT NOT NULL, id_patient_id INT DEFAULT NULL, id_maternite_id INT DEFAULT NULL, id_iternational_id INT DEFAULT NULL, id_urgence_id INT DEFAULT NULL, id_personnel_id INT DEFAULT NULL, contenu LONGTEXT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_543C20B0CE0312AE (id_patient_id), INDEX IDX_543C20B01548D4D1 (id_maternite_id), INDEX IDX_543C20B07F617BE0 (id_iternational_id), INDEX IDX_543C20B0F201FF6A (id_urgence_id), INDEX IDX_543C20B03FD1E507 (id_personnel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rendez_vous (id INT AUTO_INCREMENT NOT NULL, id_patient_id INT DEFAULT NULL, id_personnel_id INT DEFAULT NULL, id_urgence_id INT DEFAULT NULL, id_maternite_id INT DEFAULT NULL, id_international_id INT NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_65E8AA0ACE0312AE (id_patient_id), INDEX IDX_65E8AA0A3FD1E507 (id_personnel_id), INDEX IDX_65E8AA0AF201FF6A (id_urgence_id), INDEX IDX_65E8AA0A1548D4D1 (id_maternite_id), INDEX IDX_65E8AA0A31E62948 (id_international_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE consultation (id INT AUTO_INCREMENT NOT NULL, id_patient_id INT DEFAULT NULL, id_international_id INT DEFAULT NULL, id_maternite_id INT DEFAULT NULL, id_urgence_id INT DEFAULT NULL, diagnostic LONGTEXT NOT NULL, resultat LONGTEXT NOT NULL, date_consultation DATE NOT NULL, INDEX IDX_964685A6CE0312AE (id_patient_id), INDEX IDX_964685A631E62948 (id_international_id), INDEX IDX_964685A61548D4D1 (id_maternite_id), INDEX IDX_964685A6F201FF6A (id_urgence_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE urgence_personnel ADD CONSTRAINT FK_5282865C578B7FBD FOREIGN KEY (urgence_id) REFERENCES urgence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE urgence_personnel ADD CONSTRAINT FK_5282865C1C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F3FD1E507 FOREIGN KEY (id_personnel_id) REFERENCES personnel (id)');
        $this->addSql('ALTER TABLE message_patient ADD CONSTRAINT FK_8A52EDE7537A1329 FOREIGN KEY (message_id) REFERENCES message (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message_patient ADD CONSTRAINT FK_8A52EDE76B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message_urgence ADD CONSTRAINT FK_E3F551C1537A1329 FOREIGN KEY (message_id) REFERENCES message (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message_urgence ADD CONSTRAINT FK_E3F551C1578B7FBD FOREIGN KEY (urgence_id) REFERENCES urgence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message_maternite ADD CONSTRAINT FK_14A5548A537A1329 FOREIGN KEY (message_id) REFERENCES message (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message_maternite ADD CONSTRAINT FK_14A5548A3689A1A3 FOREIGN KEY (maternite_id) REFERENCES maternite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message_international ADD CONSTRAINT FK_5C63B395537A1329 FOREIGN KEY (message_id) REFERENCES message (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message_international ADD CONSTRAINT FK_5C63B395D26C7C99 FOREIGN KEY (international_id) REFERENCES international (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE convocation ADD CONSTRAINT FK_C03B3F5FCE0312AE FOREIGN KEY (id_patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE convocation ADD CONSTRAINT FK_C03B3F5FF201FF6A FOREIGN KEY (id_urgence_id) REFERENCES urgence (id)');
        $this->addSql('ALTER TABLE convocation ADD CONSTRAINT FK_C03B3F5F1548D4D1 FOREIGN KEY (id_maternite_id) REFERENCES maternite (id)');
        $this->addSql('ALTER TABLE convocation ADD CONSTRAINT FK_C03B3F5F145C7DB5 FOREIGN KEY (id_iinternational_id) REFERENCES international (id)');
        $this->addSql('ALTER TABLE convocation ADD CONSTRAINT FK_C03B3F5F3FD1E507 FOREIGN KEY (id_personnel_id) REFERENCES personnel (id)');
        $this->addSql('ALTER TABLE fiche_patient ADD CONSTRAINT FK_2DB8C311548D4D1 FOREIGN KEY (id_maternite_id) REFERENCES maternite (id)');
        $this->addSql('ALTER TABLE fiche_patient ADD CONSTRAINT FK_2DB8C3131E62948 FOREIGN KEY (id_international_id) REFERENCES international (id)');
        $this->addSql('ALTER TABLE fiche_patient ADD CONSTRAINT FK_2DB8C31F201FF6A FOREIGN KEY (id_urgence_id) REFERENCES urgence (id)');
        $this->addSql('ALTER TABLE fiche_patient ADD CONSTRAINT FK_2DB8C31CE0312AE FOREIGN KEY (id_patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE fiche_patient ADD CONSTRAINT FK_2DB8C313FD1E507 FOREIGN KEY (id_personnel_id) REFERENCES personnel (id)');
        $this->addSql('ALTER TABLE ordonnance ADD CONSTRAINT FK_924B326CCE0312AE FOREIGN KEY (id_patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE ordonnance ADD CONSTRAINT FK_924B326CF201FF6A FOREIGN KEY (id_urgence_id) REFERENCES urgence (id)');
        $this->addSql('ALTER TABLE ordonnance ADD CONSTRAINT FK_924B326C1548D4D1 FOREIGN KEY (id_maternite_id) REFERENCES maternite (id)');
        $this->addSql('ALTER TABLE ordonnance ADD CONSTRAINT FK_924B326C31E62948 FOREIGN KEY (id_international_id) REFERENCES international (id)');
        $this->addSql('ALTER TABLE ordonnance ADD CONSTRAINT FK_924B326C3FD1E507 FOREIGN KEY (id_personnel_id) REFERENCES personnel (id)');
        $this->addSql('ALTER TABLE fiche_suivi ADD CONSTRAINT FK_543C20B0CE0312AE FOREIGN KEY (id_patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE fiche_suivi ADD CONSTRAINT FK_543C20B01548D4D1 FOREIGN KEY (id_maternite_id) REFERENCES maternite (id)');
        $this->addSql('ALTER TABLE fiche_suivi ADD CONSTRAINT FK_543C20B07F617BE0 FOREIGN KEY (id_iternational_id) REFERENCES international (id)');
        $this->addSql('ALTER TABLE fiche_suivi ADD CONSTRAINT FK_543C20B0F201FF6A FOREIGN KEY (id_urgence_id) REFERENCES urgence (id)');
        $this->addSql('ALTER TABLE fiche_suivi ADD CONSTRAINT FK_543C20B03FD1E507 FOREIGN KEY (id_personnel_id) REFERENCES personnel (id)');
        $this->addSql('ALTER TABLE rendez_vous ADD CONSTRAINT FK_65E8AA0ACE0312AE FOREIGN KEY (id_patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE rendez_vous ADD CONSTRAINT FK_65E8AA0A3FD1E507 FOREIGN KEY (id_personnel_id) REFERENCES personnel (id)');
        $this->addSql('ALTER TABLE rendez_vous ADD CONSTRAINT FK_65E8AA0AF201FF6A FOREIGN KEY (id_urgence_id) REFERENCES urgence (id)');
        $this->addSql('ALTER TABLE rendez_vous ADD CONSTRAINT FK_65E8AA0A1548D4D1 FOREIGN KEY (id_maternite_id) REFERENCES maternite (id)');
        $this->addSql('ALTER TABLE rendez_vous ADD CONSTRAINT FK_65E8AA0A31E62948 FOREIGN KEY (id_international_id) REFERENCES international (id)');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A6CE0312AE FOREIGN KEY (id_patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A631E62948 FOREIGN KEY (id_international_id) REFERENCES international (id)');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A61548D4D1 FOREIGN KEY (id_maternite_id) REFERENCES maternite (id)');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A6F201FF6A FOREIGN KEY (id_urgence_id) REFERENCES urgence (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE urgence_personnel DROP FOREIGN KEY FK_5282865C578B7FBD');
        $this->addSql('ALTER TABLE message_urgence DROP FOREIGN KEY FK_E3F551C1578B7FBD');
        $this->addSql('ALTER TABLE convocation DROP FOREIGN KEY FK_C03B3F5FF201FF6A');
        $this->addSql('ALTER TABLE fiche_patient DROP FOREIGN KEY FK_2DB8C31F201FF6A');
        $this->addSql('ALTER TABLE ordonnance DROP FOREIGN KEY FK_924B326CF201FF6A');
        $this->addSql('ALTER TABLE fiche_suivi DROP FOREIGN KEY FK_543C20B0F201FF6A');
        $this->addSql('ALTER TABLE rendez_vous DROP FOREIGN KEY FK_65E8AA0AF201FF6A');
        $this->addSql('ALTER TABLE consultation DROP FOREIGN KEY FK_964685A6F201FF6A');
        $this->addSql('ALTER TABLE message_patient DROP FOREIGN KEY FK_8A52EDE7537A1329');
        $this->addSql('ALTER TABLE message_urgence DROP FOREIGN KEY FK_E3F551C1537A1329');
        $this->addSql('ALTER TABLE message_maternite DROP FOREIGN KEY FK_14A5548A537A1329');
        $this->addSql('ALTER TABLE message_international DROP FOREIGN KEY FK_5C63B395537A1329');
        $this->addSql('ALTER TABLE urgence_personnel DROP FOREIGN KEY FK_5282865C1C109075');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F3FD1E507');
        $this->addSql('ALTER TABLE convocation DROP FOREIGN KEY FK_C03B3F5F3FD1E507');
        $this->addSql('ALTER TABLE fiche_patient DROP FOREIGN KEY FK_2DB8C313FD1E507');
        $this->addSql('ALTER TABLE ordonnance DROP FOREIGN KEY FK_924B326C3FD1E507');
        $this->addSql('ALTER TABLE fiche_suivi DROP FOREIGN KEY FK_543C20B03FD1E507');
        $this->addSql('ALTER TABLE rendez_vous DROP FOREIGN KEY FK_65E8AA0A3FD1E507');
        $this->addSql('ALTER TABLE message_international DROP FOREIGN KEY FK_5C63B395D26C7C99');
        $this->addSql('ALTER TABLE convocation DROP FOREIGN KEY FK_C03B3F5F145C7DB5');
        $this->addSql('ALTER TABLE fiche_patient DROP FOREIGN KEY FK_2DB8C3131E62948');
        $this->addSql('ALTER TABLE ordonnance DROP FOREIGN KEY FK_924B326C31E62948');
        $this->addSql('ALTER TABLE fiche_suivi DROP FOREIGN KEY FK_543C20B07F617BE0');
        $this->addSql('ALTER TABLE rendez_vous DROP FOREIGN KEY FK_65E8AA0A31E62948');
        $this->addSql('ALTER TABLE consultation DROP FOREIGN KEY FK_964685A631E62948');
        $this->addSql('ALTER TABLE message_maternite DROP FOREIGN KEY FK_14A5548A3689A1A3');
        $this->addSql('ALTER TABLE convocation DROP FOREIGN KEY FK_C03B3F5F1548D4D1');
        $this->addSql('ALTER TABLE fiche_patient DROP FOREIGN KEY FK_2DB8C311548D4D1');
        $this->addSql('ALTER TABLE ordonnance DROP FOREIGN KEY FK_924B326C1548D4D1');
        $this->addSql('ALTER TABLE fiche_suivi DROP FOREIGN KEY FK_543C20B01548D4D1');
        $this->addSql('ALTER TABLE rendez_vous DROP FOREIGN KEY FK_65E8AA0A1548D4D1');
        $this->addSql('ALTER TABLE consultation DROP FOREIGN KEY FK_964685A61548D4D1');
        $this->addSql('ALTER TABLE message_patient DROP FOREIGN KEY FK_8A52EDE76B899279');
        $this->addSql('ALTER TABLE convocation DROP FOREIGN KEY FK_C03B3F5FCE0312AE');
        $this->addSql('ALTER TABLE fiche_patient DROP FOREIGN KEY FK_2DB8C31CE0312AE');
        $this->addSql('ALTER TABLE ordonnance DROP FOREIGN KEY FK_924B326CCE0312AE');
        $this->addSql('ALTER TABLE fiche_suivi DROP FOREIGN KEY FK_543C20B0CE0312AE');
        $this->addSql('ALTER TABLE rendez_vous DROP FOREIGN KEY FK_65E8AA0ACE0312AE');
        $this->addSql('ALTER TABLE consultation DROP FOREIGN KEY FK_964685A6CE0312AE');
        $this->addSql('DROP TABLE id_patient');
        $this->addSql('DROP TABLE urgence');
        $this->addSql('DROP TABLE urgence_personnel');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE message_patient');
        $this->addSql('DROP TABLE message_urgence');
        $this->addSql('DROP TABLE message_maternite');
        $this->addSql('DROP TABLE message_international');
        $this->addSql('DROP TABLE personnel');
        $this->addSql('DROP TABLE convocation');
        $this->addSql('DROP TABLE specialite');
        $this->addSql('DROP TABLE fiche_patient');
        $this->addSql('DROP TABLE ordonnance');
        $this->addSql('DROP TABLE international');
        $this->addSql('DROP TABLE maternite');
        $this->addSql('DROP TABLE patient');
        $this->addSql('DROP TABLE fiche_suivi');
        $this->addSql('DROP TABLE rendez_vous');
        $this->addSql('DROP TABLE consultation');
    }
}
