<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250409103924 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE garage_service (id INT AUTO_INCREMENT NOT NULL, id_garage_id INT NOT NULL, id_service_id INT DEFAULT NULL, id_garages_id INT DEFAULT NULL, prix DOUBLE PRECISION DEFAULT NULL, INDEX IDX_67DD764244CA4972 (id_garage_id), INDEX IDX_67DD764248D62931 (id_service_id), INDEX IDX_67DD7642593E677C (id_garages_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE garage_service ADD CONSTRAINT FK_67DD764244CA4972 FOREIGN KEY (id_garage_id) REFERENCES garages (id)');
        $this->addSql('ALTER TABLE garage_service ADD CONSTRAINT FK_67DD764248D62931 FOREIGN KEY (id_service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE garage_service ADD CONSTRAINT FK_67DD7642593E677C FOREIGN KEY (id_garages_id) REFERENCES garages (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE garage_service DROP FOREIGN KEY FK_67DD764244CA4972');
        $this->addSql('ALTER TABLE garage_service DROP FOREIGN KEY FK_67DD764248D62931');
        $this->addSql('ALTER TABLE garage_service DROP FOREIGN KEY FK_67DD7642593E677C');
        $this->addSql('DROP TABLE garage_service');
    }
}
