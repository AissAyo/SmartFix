<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250414171046 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE reservations CHANGE client_id client_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE service CHANGE service_code service_code VARCHAR(100) DEFAULT NULL, CHANGE prix prix NUMERIC(10, 2) DEFAULT NULL, CHANGE status status VARCHAR(20) DEFAULT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE reservations CHANGE client_id client_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE service CHANGE service_code service_code VARCHAR(100) NOT NULL, CHANGE prix prix NUMERIC(10, 2) NOT NULL, CHANGE status status VARCHAR(20) NOT NULL
        SQL);
    }
}
