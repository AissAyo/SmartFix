<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250409105838 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE garage_service DROP FOREIGN KEY FK_67DD7642593E677C');
        $this->addSql('DROP INDEX IDX_67DD7642593E677C ON garage_service');
        $this->addSql('ALTER TABLE garage_service DROP prix, CHANGE id_garage_id id_garage_id INT DEFAULT NULL, CHANGE id_garages_id id_voiture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE garage_service ADD CONSTRAINT FK_67DD7642A40B286D FOREIGN KEY (id_voiture_id) REFERENCES vehicules (id)');
        $this->addSql('CREATE INDEX IDX_67DD7642A40B286D ON garage_service (id_voiture_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE garage_service DROP FOREIGN KEY FK_67DD7642A40B286D');
        $this->addSql('DROP INDEX IDX_67DD7642A40B286D ON garage_service');
        $this->addSql('ALTER TABLE garage_service ADD prix DOUBLE PRECISION DEFAULT NULL, CHANGE id_garage_id id_garage_id INT NOT NULL, CHANGE id_voiture_id id_garages_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE garage_service ADD CONSTRAINT FK_67DD7642593E677C FOREIGN KEY (id_garages_id) REFERENCES garages (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_67DD7642593E677C ON garage_service (id_garages_id)');
    }
}
