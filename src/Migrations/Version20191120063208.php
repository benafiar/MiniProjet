<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191120063208 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE consultation CHANGE patients_id patients_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rdv ADD patients_id INT NOT NULL');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F86CEC3FD2F FOREIGN KEY (patients_id) REFERENCES patient (id)');
        $this->addSql('CREATE INDEX IDX_10C31F86CEC3FD2F ON rdv (patients_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE consultation CHANGE patients_id patients_id INT NOT NULL');
        $this->addSql('ALTER TABLE rdv DROP FOREIGN KEY FK_10C31F86CEC3FD2F');
        $this->addSql('DROP INDEX IDX_10C31F86CEC3FD2F ON rdv');
        $this->addSql('ALTER TABLE rdv DROP patients_id');
    }
}
