<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250424185246 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE garage_service (id INT AUTO_INCREMENT NOT NULL, garage_id INT NOT NULL, service_id INT NOT NULL, car_api_id INT NOT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_67DD7642C4FFF555 (garage_id), INDEX IDX_67DD7642ED5CA9E6 (service_id), INDEX IDX_67DD76424CFED5CA (car_api_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE garage_service_reservation (garage_service_id INT NOT NULL, reservation_id INT NOT NULL, INDEX IDX_4457A2E09458ECE0 (garage_service_id), INDEX IDX_4457A2E0B83297E7 (reservation_id), PRIMARY KEY(garage_service_id, reservation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garage_service ADD CONSTRAINT FK_67DD7642C4FFF555 FOREIGN KEY (garage_id) REFERENCES garages (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garage_service ADD CONSTRAINT FK_67DD7642ED5CA9E6 FOREIGN KEY (service_id) REFERENCES services (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garage_service ADD CONSTRAINT FK_67DD76424CFED5CA FOREIGN KEY (car_api_id) REFERENCES car_api (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garage_service_reservation ADD CONSTRAINT FK_4457A2E09458ECE0 FOREIGN KEY (garage_service_id) REFERENCES garage_service (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garage_service_reservation ADD CONSTRAINT FK_4457A2E0B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservations (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garages ADD logo VARCHAR(255) DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE review DROP FOREIGN KEY FK_794381C619EB6921
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_794381C619EB6921 ON review
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE review ADD created_at DATETIME NOT NULL, CHANGE client_id reservation_id INT NOT NULL, CHANGE content comment LONGTEXT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE review ADD CONSTRAINT FK_794381C6B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservations (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_794381C6B83297E7 ON review (reservation_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE garage_service DROP FOREIGN KEY FK_67DD7642C4FFF555
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garage_service DROP FOREIGN KEY FK_67DD7642ED5CA9E6
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garage_service DROP FOREIGN KEY FK_67DD76424CFED5CA
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garage_service_reservation DROP FOREIGN KEY FK_4457A2E09458ECE0
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garage_service_reservation DROP FOREIGN KEY FK_4457A2E0B83297E7
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE garage_service
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE garage_service_reservation
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garages DROP logo
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE review DROP FOREIGN KEY FK_794381C6B83297E7
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_794381C6B83297E7 ON review
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE review DROP created_at, CHANGE reservation_id client_id INT NOT NULL, CHANGE comment content LONGTEXT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE review ADD CONSTRAINT FK_794381C619EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_794381C619EB6921 ON review (client_id)
        SQL);
    }
}
