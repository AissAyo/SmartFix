<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250424182835 extends AbstractMigration
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
            ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F9AC0396
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_B6BD307F9AC0396 ON message
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE message CHANGE conversation_id chat_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE message ADD CONSTRAINT FK_B6BD307F1A9A7125 FOREIGN KEY (chat_id) REFERENCES chat (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_B6BD307F1A9A7125 ON message (chat_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE review ADD garage_service_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE review ADD CONSTRAINT FK_794381C69458ECE0 FOREIGN KEY (garage_service_id) REFERENCES garage_service (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_794381C69458ECE0 ON review (garage_service_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE review DROP FOREIGN KEY FK_794381C69458ECE0
        SQL);
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
            ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F1A9A7125
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_B6BD307F1A9A7125 ON message
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE message CHANGE chat_id conversation_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE message ADD CONSTRAINT FK_B6BD307F9AC0396 FOREIGN KEY (conversation_id) REFERENCES conversation (id) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_B6BD307F9AC0396 ON message (conversation_id)
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_794381C69458ECE0 ON review
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE review DROP garage_service_id
        SQL);
    }
}
