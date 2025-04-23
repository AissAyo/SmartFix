<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250422224011 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, total_amount NUMERIC(10, 2) NOT NULL, UNIQUE INDEX UNIQ_BA388B719EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE category_service (id INT AUTO_INCREMENT NOT NULL, garage_id INT NOT NULL, categoryname VARCHAR(255) NOT NULL, INDEX IDX_2645DAACC4FFF555 (garage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE chat (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, mechanic_id INT NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', is_read TINYINT(1) NOT NULL, INDEX IDX_659DF2AA19EB6921 (client_id), INDEX IDX_659DF2AA9A67DB00 (mechanic_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, location_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, password VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, roles VARCHAR(255) DEFAULT NULL, phone VARCHAR(20) DEFAULT NULL, reset_token VARCHAR(255) DEFAULT NULL, token_expiration DATETIME DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, verification_status TINYINT(1) NOT NULL, date_inscription DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', loyalty_points INT NOT NULL, photo_profil VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_C744045564D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, critique_id INT NOT NULL, content LONGTEXT NOT NULL, INDEX IDX_9474526CF24D1F1B (critique_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE complaint (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, service_client_id INT NOT NULL, description LONGTEXT NOT NULL, service VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', status VARCHAR(50) NOT NULL, INDEX IDX_5F2732B519EB6921 (client_id), INDEX IDX_5F2732B5417A536B (service_client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE critiques (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, reservation_id INT NOT NULL, garage_id INT NOT NULL, mechanic_id INT NOT NULL, rating INT NOT NULL, INDEX IDX_2712BED919EB6921 (client_id), UNIQUE INDEX UNIQ_2712BED9B83297E7 (reservation_id), INDEX IDX_2712BED9C4FFF555 (garage_id), INDEX IDX_2712BED99A67DB00 (mechanic_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, address VARCHAR(255) NOT NULL, longitude DOUBLE PRECISION NOT NULL, latitude DOUBLE PRECISION NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, postal_code VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE mechanic (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, password VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, roles VARCHAR(255) DEFAULT NULL, phone VARCHAR(20) DEFAULT NULL, reset_token VARCHAR(255) DEFAULT NULL, token_expiration DATETIME DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, specialization VARCHAR(100) DEFAULT NULL, experience_years INT DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL, photo_profil VARCHAR(255) DEFAULT NULL, certifications VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, chat_id INT NOT NULL, client_sender_id INT DEFAULT NULL, mechanic_sender_id INT DEFAULT NULL, content LONGTEXT NOT NULL, sent_at DATETIME NOT NULL, is_read TINYINT(1) NOT NULL, sender_type VARCHAR(50) NOT NULL, INDEX IDX_B6BD307F1A9A7125 (chat_id), INDEX IDX_B6BD307F1D046392 (client_sender_id), INDEX IDX_B6BD307FA836A782 (mechanic_sender_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE repair_part (id INT AUTO_INCREMENT NOT NULL, reservation_id INT NOT NULL, part_name VARCHAR(100) NOT NULL, price NUMERIC(10, 2) NOT NULL, INDEX IDX_9C29A426B83297E7 (reservation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, content LONGTEXT NOT NULL, rating INT NOT NULL, INDEX IDX_794381C619EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE service_client (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, password VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, roles VARCHAR(255) DEFAULT NULL, phone VARCHAR(20) DEFAULT NULL, reset_token VARCHAR(255) DEFAULT NULL, token_expiration DATETIME DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, service_details VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE vehicules (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, car_api_id INT NOT NULL, owner_name VARCHAR(100) NOT NULL, plate_number VARCHAR(20) NOT NULL, color VARCHAR(50) NOT NULL, mileage INT NOT NULL, vin VARCHAR(100) NOT NULL, registration_date DATE NOT NULL, UNIQUE INDEX UNIQ_78218C2DFCFF3785 (plate_number), UNIQUE INDEX UNIQ_78218C2DB1085141 (vin), INDEX IDX_78218C2D19EB6921 (client_id), INDEX IDX_78218C2D4CFED5CA (car_api_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cart ADD CONSTRAINT FK_BA388B719EB6921 FOREIGN KEY (client_id) REFERENCES client (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE category_service ADD CONSTRAINT FK_2645DAACC4FFF555 FOREIGN KEY (garage_id) REFERENCES garages (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE chat ADD CONSTRAINT FK_659DF2AA19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE chat ADD CONSTRAINT FK_659DF2AA9A67DB00 FOREIGN KEY (mechanic_id) REFERENCES mechanic (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE client ADD CONSTRAINT FK_C744045564D218E FOREIGN KEY (location_id) REFERENCES location (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment ADD CONSTRAINT FK_9474526CF24D1F1B FOREIGN KEY (critique_id) REFERENCES critiques (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE complaint ADD CONSTRAINT FK_5F2732B519EB6921 FOREIGN KEY (client_id) REFERENCES client (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE complaint ADD CONSTRAINT FK_5F2732B5417A536B FOREIGN KEY (service_client_id) REFERENCES service_client (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE critiques ADD CONSTRAINT FK_2712BED919EB6921 FOREIGN KEY (client_id) REFERENCES client (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE critiques ADD CONSTRAINT FK_2712BED9B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservations (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE critiques ADD CONSTRAINT FK_2712BED9C4FFF555 FOREIGN KEY (garage_id) REFERENCES garages (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE critiques ADD CONSTRAINT FK_2712BED99A67DB00 FOREIGN KEY (mechanic_id) REFERENCES mechanic (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE message ADD CONSTRAINT FK_B6BD307F1A9A7125 FOREIGN KEY (chat_id) REFERENCES chat (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE message ADD CONSTRAINT FK_B6BD307F1D046392 FOREIGN KEY (client_sender_id) REFERENCES client (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE message ADD CONSTRAINT FK_B6BD307FA836A782 FOREIGN KEY (mechanic_sender_id) REFERENCES mechanic (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE repair_part ADD CONSTRAINT FK_9C29A426B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservations (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE review ADD CONSTRAINT FK_794381C619EB6921 FOREIGN KEY (client_id) REFERENCES client (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vehicules ADD CONSTRAINT FK_78218C2D19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vehicules ADD CONSTRAINT FK_78218C2D4CFED5CA FOREIGN KEY (car_api_id) REFERENCES car_api (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garage_service DROP FOREIGN KEY FK_67DD76424CFED5CA
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garage_service DROP FOREIGN KEY FK_67DD7642C4FFF555
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garage_service DROP FOREIGN KEY FK_67DD7642ED5CA9E6
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
            ALTER TABLE garages ADD CONSTRAINT FK_8C4330E29A67DB00 FOREIGN KEY (mechanic_id) REFERENCES mechanic (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garages ADD CONSTRAINT FK_8C4330E264D218E FOREIGN KEY (location_id) REFERENCES location (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservations ADD CONSTRAINT FK_4DA239545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicules (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservations ADD CONSTRAINT FK_4DA239ED5CA9E6 FOREIGN KEY (service_id) REFERENCES services (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE services ADD CONSTRAINT FK_7332E169CB42F998 FOREIGN KEY (category_service_id) REFERENCES category_service (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE services DROP FOREIGN KEY FK_7332E169CB42F998
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garages DROP FOREIGN KEY FK_8C4330E264D218E
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garages DROP FOREIGN KEY FK_8C4330E29A67DB00
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservations DROP FOREIGN KEY FK_4DA239545317D1
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE garage_service (id INT AUTO_INCREMENT NOT NULL, garage_id INT NOT NULL, service_id INT NOT NULL, car_api_id INT NOT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_67DD76424CFED5CA (car_api_id), INDEX IDX_67DD7642ED5CA9E6 (service_id), INDEX IDX_67DD7642C4FFF555 (garage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE garage_service_reservation (garage_service_id INT NOT NULL, reservation_id INT NOT NULL, INDEX IDX_4457A2E0B83297E7 (reservation_id), INDEX IDX_4457A2E09458ECE0 (garage_service_id), PRIMARY KEY(garage_service_id, reservation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garage_service ADD CONSTRAINT FK_67DD76424CFED5CA FOREIGN KEY (car_api_id) REFERENCES car_api (id) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garage_service ADD CONSTRAINT FK_67DD7642C4FFF555 FOREIGN KEY (garage_id) REFERENCES garages (id) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garage_service ADD CONSTRAINT FK_67DD7642ED5CA9E6 FOREIGN KEY (service_id) REFERENCES services (id) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garage_service_reservation ADD CONSTRAINT FK_4457A2E09458ECE0 FOREIGN KEY (garage_service_id) REFERENCES garage_service (id) ON UPDATE NO ACTION ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garage_service_reservation ADD CONSTRAINT FK_4457A2E0B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservations (id) ON UPDATE NO ACTION ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cart DROP FOREIGN KEY FK_BA388B719EB6921
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE category_service DROP FOREIGN KEY FK_2645DAACC4FFF555
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE chat DROP FOREIGN KEY FK_659DF2AA19EB6921
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE chat DROP FOREIGN KEY FK_659DF2AA9A67DB00
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE client DROP FOREIGN KEY FK_C744045564D218E
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment DROP FOREIGN KEY FK_9474526CF24D1F1B
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE complaint DROP FOREIGN KEY FK_5F2732B519EB6921
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE complaint DROP FOREIGN KEY FK_5F2732B5417A536B
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE critiques DROP FOREIGN KEY FK_2712BED919EB6921
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE critiques DROP FOREIGN KEY FK_2712BED9B83297E7
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE critiques DROP FOREIGN KEY FK_2712BED9C4FFF555
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE critiques DROP FOREIGN KEY FK_2712BED99A67DB00
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F1A9A7125
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F1D046392
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FA836A782
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE repair_part DROP FOREIGN KEY FK_9C29A426B83297E7
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE review DROP FOREIGN KEY FK_794381C619EB6921
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vehicules DROP FOREIGN KEY FK_78218C2D19EB6921
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vehicules DROP FOREIGN KEY FK_78218C2D4CFED5CA
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE cart
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE category_service
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE chat
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE client
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE comment
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE complaint
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE critiques
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE location
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE mechanic
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE message
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE repair_part
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE review
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE service_client
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE vehicules
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservations DROP FOREIGN KEY FK_4DA239ED5CA9E6
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garages ADD logo VARCHAR(255) DEFAULT NULL
        SQL);
    }
}
