<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200504211404 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE urgence (id INT AUTO_INCREMENT NOT NULL, patient_id INT DEFAULT NULL, financement VARCHAR(255) NOT NULL, arrive DATE NOT NULL, heure TIME NOT NULL, suivi LONGTEXT NOT NULL, cause VARCHAR(255) NOT NULL, INDEX IDX_737D6BCD6B899279 (patient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, patient_id INT DEFAULT NULL, personnel_id INT DEFAULT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_B6BD307F6B899279 (patient_id), INDEX IDX_B6BD307F1C109075 (personnel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnel (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, genre VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, telephone INT NOT NULL, profession VARCHAR(255) NOT NULL, fonction VARCHAR(255) NOT NULL, specialite VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_A6BCF3DEA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialite (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fiche_patient (id INT AUTO_INCREMENT NOT NULL, patient_id INT DEFAULT NULL, personnel_id INT DEFAULT NULL, statut VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_2DB8C316B899279 (patient_id), INDEX IDX_2DB8C311C109075 (personnel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ordonnance (id INT AUTO_INCREMENT NOT NULL, patient_id INT DEFAULT NULL, personnel_id INT DEFAULT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_924B326C6B899279 (patient_id), INDEX IDX_924B326C1C109075 (personnel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE international (id INT AUTO_INCREMENT NOT NULL, patient_id INT DEFAULT NULL, nationnalite VARCHAR(255) NOT NULL, maladie VARCHAR(255) NOT NULL, debut DATE NOT NULL, financement VARCHAR(255) NOT NULL, arrive DATE NOT NULL, INDEX IDX_15CEF5ED6B899279 (patient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE maternite (id INT AUTO_INCREMENT NOT NULL, patient_id INT DEFAULT NULL, debut DATE NOT NULL, accouchement DATE NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_7E1C52BC6B899279 (patient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, genre VARCHAR(255) NOT NULL, telephone INT NOT NULL, profession VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1ADAD7EBA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE suivi (id INT AUTO_INCREMENT NOT NULL, patient_id INT DEFAULT NULL, personnel_id INT DEFAULT NULL, content LONGTEXT NOT NULL, recommandation LONGTEXT NOT NULL, creted_at DATETIME NOT NULL, INDEX IDX_2EBCCA8F6B899279 (patient_id), INDEX IDX_2EBCCA8F1C109075 (personnel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rendez_vous (id INT AUTO_INCREMENT NOT NULL, patient_id INT DEFAULT NULL, personnel_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_65E8AA0A6B899279 (patient_id), INDEX IDX_65E8AA0A1C109075 (personnel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE consultation (id INT AUTO_INCREMENT NOT NULL, patient_id INT DEFAULT NULL, personnel_id INT DEFAULT NULL, plainte LONGTEXT NOT NULL, examen LONGTEXT NOT NULL, resultat LONGTEXT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_964685A66B899279 (patient_id), INDEX IDX_964685A61C109075 (personnel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE urgence ADD CONSTRAINT FK_737D6BCD6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F1C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id)');
        $this->addSql('ALTER TABLE personnel ADD CONSTRAINT FK_A6BCF3DEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE fiche_patient ADD CONSTRAINT FK_2DB8C316B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE fiche_patient ADD CONSTRAINT FK_2DB8C311C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id)');
        $this->addSql('ALTER TABLE ordonnance ADD CONSTRAINT FK_924B326C6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE ordonnance ADD CONSTRAINT FK_924B326C1C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id)');
        $this->addSql('ALTER TABLE international ADD CONSTRAINT FK_15CEF5ED6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE maternite ADD CONSTRAINT FK_7E1C52BC6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE suivi ADD CONSTRAINT FK_2EBCCA8F6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE suivi ADD CONSTRAINT FK_2EBCCA8F1C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id)');
        $this->addSql('ALTER TABLE rendez_vous ADD CONSTRAINT FK_65E8AA0A6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE rendez_vous ADD CONSTRAINT FK_65E8AA0A1C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id)');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A66B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A61C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F1C109075');
        $this->addSql('ALTER TABLE fiche_patient DROP FOREIGN KEY FK_2DB8C311C109075');
        $this->addSql('ALTER TABLE ordonnance DROP FOREIGN KEY FK_924B326C1C109075');
        $this->addSql('ALTER TABLE suivi DROP FOREIGN KEY FK_2EBCCA8F1C109075');
        $this->addSql('ALTER TABLE rendez_vous DROP FOREIGN KEY FK_65E8AA0A1C109075');
        $this->addSql('ALTER TABLE consultation DROP FOREIGN KEY FK_964685A61C109075');
        $this->addSql('ALTER TABLE personnel DROP FOREIGN KEY FK_A6BCF3DEA76ED395');
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY FK_1ADAD7EBA76ED395');
        $this->addSql('ALTER TABLE urgence DROP FOREIGN KEY FK_737D6BCD6B899279');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F6B899279');
        $this->addSql('ALTER TABLE fiche_patient DROP FOREIGN KEY FK_2DB8C316B899279');
        $this->addSql('ALTER TABLE ordonnance DROP FOREIGN KEY FK_924B326C6B899279');
        $this->addSql('ALTER TABLE international DROP FOREIGN KEY FK_15CEF5ED6B899279');
        $this->addSql('ALTER TABLE maternite DROP FOREIGN KEY FK_7E1C52BC6B899279');
        $this->addSql('ALTER TABLE suivi DROP FOREIGN KEY FK_2EBCCA8F6B899279');
        $this->addSql('ALTER TABLE rendez_vous DROP FOREIGN KEY FK_65E8AA0A6B899279');
        $this->addSql('ALTER TABLE consultation DROP FOREIGN KEY FK_964685A66B899279');
        $this->addSql('DROP TABLE urgence');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE personnel');
        $this->addSql('DROP TABLE specialite');
        $this->addSql('DROP TABLE fiche_patient');
        $this->addSql('DROP TABLE ordonnance');
        $this->addSql('DROP TABLE international');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE maternite');
        $this->addSql('DROP TABLE patient');
        $this->addSql('DROP TABLE suivi');
        $this->addSql('DROP TABLE rendez_vous');
        $this->addSql('DROP TABLE consultation');
    }
}
