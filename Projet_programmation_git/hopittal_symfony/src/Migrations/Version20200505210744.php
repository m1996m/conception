<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200505210744 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE urgence ADD personnel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE urgence ADD CONSTRAINT FK_737D6BCD1C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id)');
        $this->addSql('CREATE INDEX IDX_737D6BCD1C109075 ON urgence (personnel_id)');
        $this->addSql('ALTER TABLE maternite ADD personnel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE maternite ADD CONSTRAINT FK_7E1C52BC1C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id)');
        $this->addSql('CREATE INDEX IDX_7E1C52BC1C109075 ON maternite (personnel_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE maternite DROP FOREIGN KEY FK_7E1C52BC1C109075');
        $this->addSql('DROP INDEX IDX_7E1C52BC1C109075 ON maternite');
        $this->addSql('ALTER TABLE maternite DROP personnel_id');
        $this->addSql('ALTER TABLE urgence DROP FOREIGN KEY FK_737D6BCD1C109075');
        $this->addSql('DROP INDEX IDX_737D6BCD1C109075 ON urgence');
        $this->addSql('ALTER TABLE urgence DROP personnel_id');
    }
}
