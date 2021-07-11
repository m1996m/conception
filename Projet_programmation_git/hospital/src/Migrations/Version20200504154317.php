<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200504154317 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE urgence (id INT AUTO_INCREMENT NOT NULL, financement VARCHAR(255) NOT NULL, arrive DATE NOT NULL, heure TIME NOT NULL, suivi LONGTEXT NOT NULL, cause VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE urgence_patient (urgence_id INT NOT NULL, patient_id INT NOT NULL, INDEX IDX_F4EF86F578B7FBD (urgence_id), INDEX IDX_F4EF86F6B899279 (patient_id), PRIMARY KEY(urgence_id, patient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE urgence_personnel (urgence_id INT NOT NULL, personnel_id INT NOT NULL, INDEX IDX_5282865C578B7FBD (urgence_id), INDEX IDX_5282865C1C109075 (personnel_id), PRIMARY KEY(urgence_id, personnel_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message_patient (message_id INT NOT NULL, patient_id INT NOT NULL, INDEX IDX_8A52EDE7537A1329 (message_id), INDEX IDX_8A52EDE76B899279 (patient_id), PRIMARY KEY(message_id, patient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message_personnel (message_id INT NOT NULL, personnel_id INT NOT NULL, INDEX IDX_CC05F5E8537A1329 (message_id), INDEX IDX_CC05F5E81C109075 (personnel_id), PRIMARY KEY(message_id, personnel_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialite (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fiche_patient (id INT AUTO_INCREMENT NOT NULL, statut VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fiche_patient_patient (fiche_patient_id INT NOT NULL, patient_id INT NOT NULL, INDEX IDX_6A7A5A7FC5DF968E (fiche_patient_id), INDEX IDX_6A7A5A7F6B899279 (patient_id), PRIMARY KEY(fiche_patient_id, patient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fiche_patient_personnel (fiche_patient_id INT NOT NULL, personnel_id INT NOT NULL, INDEX IDX_209833FDC5DF968E (fiche_patient_id), INDEX IDX_209833FD1C109075 (personnel_id), PRIMARY KEY(fiche_patient_id, personnel_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ordonnance (id INT AUTO_INCREMENT NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ordonnance_patient (ordonnance_id INT NOT NULL, patient_id INT NOT NULL, INDEX IDX_1873B9C62BF23B8F (ordonnance_id), INDEX IDX_1873B9C66B899279 (patient_id), PRIMARY KEY(ordonnance_id, patient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ordonnance_personnel (ordonnance_id INT NOT NULL, personnel_id INT NOT NULL, INDEX IDX_2C9CE7C72BF23B8F (ordonnance_id), INDEX IDX_2C9CE7C71C109075 (personnel_id), PRIMARY KEY(ordonnance_id, personnel_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE international (id INT AUTO_INCREMENT NOT NULL, nationalite VARCHAR(255) NOT NULL, maladie VARCHAR(255) NOT NULL, debut DATE NOT NULL, financement VARCHAR(255) NOT NULL, arrive DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE international_patient (international_id INT NOT NULL, patient_id INT NOT NULL, INDEX IDX_C3E3746ED26C7C99 (international_id), INDEX IDX_C3E3746E6B899279 (patient_id), PRIMARY KEY(international_id, patient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE international_personnel (international_id INT NOT NULL, personnel_id INT NOT NULL, INDEX IDX_AF97B4BBD26C7C99 (international_id), INDEX IDX_AF97B4BB1C109075 (personnel_id), PRIMARY KEY(international_id, personnel_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE maternite (id INT AUTO_INCREMENT NOT NULL, debut DATE NOT NULL, accouchement DATE NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE maternite_patient (maternite_id INT NOT NULL, patient_id INT NOT NULL, INDEX IDX_697791AE3689A1A3 (maternite_id), INDEX IDX_697791AE6B899279 (patient_id), PRIMARY KEY(maternite_id, patient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE maternite_personnel (maternite_id INT NOT NULL, personnel_id INT NOT NULL, INDEX IDX_B40DDF963689A1A3 (maternite_id), INDEX IDX_B40DDF961C109075 (personnel_id), PRIMARY KEY(maternite_id, personnel_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE suivi (id INT AUTO_INCREMENT NOT NULL, content LONGTEXT NOT NULL, recommandation LONGTEXT NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE suivi_patient (suivi_id INT NOT NULL, patient_id INT NOT NULL, INDEX IDX_9F1D234E7FEA59C0 (suivi_id), INDEX IDX_9F1D234E6B899279 (patient_id), PRIMARY KEY(suivi_id, patient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE suivi_personnel (suivi_id INT NOT NULL, personnel_id INT NOT NULL, INDEX IDX_CF1C08B07FEA59C0 (suivi_id), INDEX IDX_CF1C08B01C109075 (personnel_id), PRIMARY KEY(suivi_id, personnel_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rendez_vous (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rendez_vous_patient (rendez_vous_id INT NOT NULL, patient_id INT NOT NULL, INDEX IDX_B74CC7AC91EF7EAA (rendez_vous_id), INDEX IDX_B74CC7AC6B899279 (patient_id), PRIMARY KEY(rendez_vous_id, patient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rendez_vous_personnel (rendez_vous_id INT NOT NULL, personnel_id INT NOT NULL, INDEX IDX_43397EE91EF7EAA (rendez_vous_id), INDEX IDX_43397EE1C109075 (personnel_id), PRIMARY KEY(rendez_vous_id, personnel_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE consultation (id INT AUTO_INCREMENT NOT NULL, plainte LONGTEXT NOT NULL, examen LONGTEXT NOT NULL, created_at DATETIME NOT NULL, resultat LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE consultation_patient (consultation_id INT NOT NULL, patient_id INT NOT NULL, INDEX IDX_5FD9260962FF6CDF (consultation_id), INDEX IDX_5FD926096B899279 (patient_id), PRIMARY KEY(consultation_id, patient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE consultation_personnel (consultation_id INT NOT NULL, personnel_id INT NOT NULL, INDEX IDX_4EE53962FF6CDF (consultation_id), INDEX IDX_4EE5391C109075 (personnel_id), PRIMARY KEY(consultation_id, personnel_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE urgence_patient ADD CONSTRAINT FK_F4EF86F578B7FBD FOREIGN KEY (urgence_id) REFERENCES urgence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE urgence_patient ADD CONSTRAINT FK_F4EF86F6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE urgence_personnel ADD CONSTRAINT FK_5282865C578B7FBD FOREIGN KEY (urgence_id) REFERENCES urgence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE urgence_personnel ADD CONSTRAINT FK_5282865C1C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message_patient ADD CONSTRAINT FK_8A52EDE7537A1329 FOREIGN KEY (message_id) REFERENCES message (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message_patient ADD CONSTRAINT FK_8A52EDE76B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message_personnel ADD CONSTRAINT FK_CC05F5E8537A1329 FOREIGN KEY (message_id) REFERENCES message (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message_personnel ADD CONSTRAINT FK_CC05F5E81C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fiche_patient_patient ADD CONSTRAINT FK_6A7A5A7FC5DF968E FOREIGN KEY (fiche_patient_id) REFERENCES fiche_patient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fiche_patient_patient ADD CONSTRAINT FK_6A7A5A7F6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fiche_patient_personnel ADD CONSTRAINT FK_209833FDC5DF968E FOREIGN KEY (fiche_patient_id) REFERENCES fiche_patient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fiche_patient_personnel ADD CONSTRAINT FK_209833FD1C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ordonnance_patient ADD CONSTRAINT FK_1873B9C62BF23B8F FOREIGN KEY (ordonnance_id) REFERENCES ordonnance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ordonnance_patient ADD CONSTRAINT FK_1873B9C66B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ordonnance_personnel ADD CONSTRAINT FK_2C9CE7C72BF23B8F FOREIGN KEY (ordonnance_id) REFERENCES ordonnance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ordonnance_personnel ADD CONSTRAINT FK_2C9CE7C71C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE international_patient ADD CONSTRAINT FK_C3E3746ED26C7C99 FOREIGN KEY (international_id) REFERENCES international (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE international_patient ADD CONSTRAINT FK_C3E3746E6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE international_personnel ADD CONSTRAINT FK_AF97B4BBD26C7C99 FOREIGN KEY (international_id) REFERENCES international (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE international_personnel ADD CONSTRAINT FK_AF97B4BB1C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE maternite_patient ADD CONSTRAINT FK_697791AE3689A1A3 FOREIGN KEY (maternite_id) REFERENCES maternite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE maternite_patient ADD CONSTRAINT FK_697791AE6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE maternite_personnel ADD CONSTRAINT FK_B40DDF963689A1A3 FOREIGN KEY (maternite_id) REFERENCES maternite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE maternite_personnel ADD CONSTRAINT FK_B40DDF961C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE suivi_patient ADD CONSTRAINT FK_9F1D234E7FEA59C0 FOREIGN KEY (suivi_id) REFERENCES suivi (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE suivi_patient ADD CONSTRAINT FK_9F1D234E6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE suivi_personnel ADD CONSTRAINT FK_CF1C08B07FEA59C0 FOREIGN KEY (suivi_id) REFERENCES suivi (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE suivi_personnel ADD CONSTRAINT FK_CF1C08B01C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rendez_vous_patient ADD CONSTRAINT FK_B74CC7AC91EF7EAA FOREIGN KEY (rendez_vous_id) REFERENCES rendez_vous (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rendez_vous_patient ADD CONSTRAINT FK_B74CC7AC6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rendez_vous_personnel ADD CONSTRAINT FK_43397EE91EF7EAA FOREIGN KEY (rendez_vous_id) REFERENCES rendez_vous (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rendez_vous_personnel ADD CONSTRAINT FK_43397EE1C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE consultation_patient ADD CONSTRAINT FK_5FD9260962FF6CDF FOREIGN KEY (consultation_id) REFERENCES consultation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE consultation_patient ADD CONSTRAINT FK_5FD926096B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE consultation_personnel ADD CONSTRAINT FK_4EE53962FF6CDF FOREIGN KEY (consultation_id) REFERENCES consultation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE consultation_personnel ADD CONSTRAINT FK_4EE5391C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE urgence_patient DROP FOREIGN KEY FK_F4EF86F578B7FBD');
        $this->addSql('ALTER TABLE urgence_personnel DROP FOREIGN KEY FK_5282865C578B7FBD');
        $this->addSql('ALTER TABLE message_patient DROP FOREIGN KEY FK_8A52EDE7537A1329');
        $this->addSql('ALTER TABLE message_personnel DROP FOREIGN KEY FK_CC05F5E8537A1329');
        $this->addSql('ALTER TABLE fiche_patient_patient DROP FOREIGN KEY FK_6A7A5A7FC5DF968E');
        $this->addSql('ALTER TABLE fiche_patient_personnel DROP FOREIGN KEY FK_209833FDC5DF968E');
        $this->addSql('ALTER TABLE ordonnance_patient DROP FOREIGN KEY FK_1873B9C62BF23B8F');
        $this->addSql('ALTER TABLE ordonnance_personnel DROP FOREIGN KEY FK_2C9CE7C72BF23B8F');
        $this->addSql('ALTER TABLE international_patient DROP FOREIGN KEY FK_C3E3746ED26C7C99');
        $this->addSql('ALTER TABLE international_personnel DROP FOREIGN KEY FK_AF97B4BBD26C7C99');
        $this->addSql('ALTER TABLE maternite_patient DROP FOREIGN KEY FK_697791AE3689A1A3');
        $this->addSql('ALTER TABLE maternite_personnel DROP FOREIGN KEY FK_B40DDF963689A1A3');
        $this->addSql('ALTER TABLE suivi_patient DROP FOREIGN KEY FK_9F1D234E7FEA59C0');
        $this->addSql('ALTER TABLE suivi_personnel DROP FOREIGN KEY FK_CF1C08B07FEA59C0');
        $this->addSql('ALTER TABLE rendez_vous_patient DROP FOREIGN KEY FK_B74CC7AC91EF7EAA');
        $this->addSql('ALTER TABLE rendez_vous_personnel DROP FOREIGN KEY FK_43397EE91EF7EAA');
        $this->addSql('ALTER TABLE consultation_patient DROP FOREIGN KEY FK_5FD9260962FF6CDF');
        $this->addSql('ALTER TABLE consultation_personnel DROP FOREIGN KEY FK_4EE53962FF6CDF');
        $this->addSql('DROP TABLE urgence');
        $this->addSql('DROP TABLE urgence_patient');
        $this->addSql('DROP TABLE urgence_personnel');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE message_patient');
        $this->addSql('DROP TABLE message_personnel');
        $this->addSql('DROP TABLE specialite');
        $this->addSql('DROP TABLE fiche_patient');
        $this->addSql('DROP TABLE fiche_patient_patient');
        $this->addSql('DROP TABLE fiche_patient_personnel');
        $this->addSql('DROP TABLE ordonnance');
        $this->addSql('DROP TABLE ordonnance_patient');
        $this->addSql('DROP TABLE ordonnance_personnel');
        $this->addSql('DROP TABLE international');
        $this->addSql('DROP TABLE international_patient');
        $this->addSql('DROP TABLE international_personnel');
        $this->addSql('DROP TABLE maternite');
        $this->addSql('DROP TABLE maternite_patient');
        $this->addSql('DROP TABLE maternite_personnel');
        $this->addSql('DROP TABLE suivi');
        $this->addSql('DROP TABLE suivi_patient');
        $this->addSql('DROP TABLE suivi_personnel');
        $this->addSql('DROP TABLE rendez_vous');
        $this->addSql('DROP TABLE rendez_vous_patient');
        $this->addSql('DROP TABLE rendez_vous_personnel');
        $this->addSql('DROP TABLE consultation');
        $this->addSql('DROP TABLE consultation_patient');
        $this->addSql('DROP TABLE consultation_personnel');
    }
}
