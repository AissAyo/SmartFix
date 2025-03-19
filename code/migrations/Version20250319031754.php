<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250319031754 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car_rental_services ADD email VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE clients ADD email VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE mechanics ADD email VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE sellers ADD email VARCHAR(255) NOT NULL, DROP shop_name, DROP shop_email, DROP shop_phone');
        $this->addSql('ALTER TABLE service_client ADD email VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car_rental_services DROP email');
        $this->addSql('ALTER TABLE clients DROP email');
        $this->addSql('ALTER TABLE mechanics DROP email');
        $this->addSql('ALTER TABLE sellers ADD shop_email VARCHAR(255) NOT NULL, ADD shop_phone VARCHAR(15) NOT NULL, CHANGE email shop_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE service_client DROP email');
    }
}
