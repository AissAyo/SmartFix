<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250409154806 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicules DROP FOREIGN KEY FK_78218C2D19EB6921');
        $this->addSql('ALTER TABLE vehicules DROP FOREIGN KEY FK_78218C2DED5CA9E6');
        $this->addSql('DROP INDEX IDX_78218C2DED5CA9E6 ON vehicules');
        $this->addSql('DROP INDEX IDX_78218C2D19EB6921 ON vehicules');
        $this->addSql('ALTER TABLE vehicules DROP client_id, DROP service_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicules ADD client_id INT NOT NULL, ADD service_id INT NOT NULL');
        $this->addSql('ALTER TABLE vehicules ADD CONSTRAINT FK_78218C2D19EB6921 FOREIGN KEY (client_id) REFERENCES clients (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE vehicules ADD CONSTRAINT FK_78218C2DED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_78218C2DED5CA9E6 ON vehicules (service_id)');
        $this->addSql('CREATE INDEX IDX_78218C2D19EB6921 ON vehicules (client_id)');
    }
}
