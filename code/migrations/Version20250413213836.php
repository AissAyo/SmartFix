<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250413213836 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE `admin` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, password VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, roles VARCHAR(255) DEFAULT NULL, phone VARCHAR(20) DEFAULT NULL, reset_token VARCHAR(255) DEFAULT NULL, token_expiration DATETIME DEFAULT NULL, photo_profil VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE car_api (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, total_amount NUMERIC(10, 2) NOT NULL, UNIQUE INDEX UNIQ_BA388B719EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE category_service (id INT AUTO_INCREMENT NOT NULL, categoryname VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE garageCategoryService (category_service_id INT NOT NULL, garage_id INT NOT NULL, INDEX IDX_92C8F1CCCB42F998 (category_service_id), INDEX IDX_92C8F1CCC4FFF555 (garage_id), PRIMARY KEY(category_service_id, garage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, password VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, roles VARCHAR(255) DEFAULT NULL, phone VARCHAR(20) DEFAULT NULL, reset_token VARCHAR(255) DEFAULT NULL, token_expiration DATETIME DEFAULT NULL, photo_profil VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, verification_status TINYINT(1) NOT NULL, date_inscription DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', loyalty_points INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, critique_id INT NOT NULL, content LONGTEXT NOT NULL, INDEX IDX_9474526CF24D1F1B (critique_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE complaint (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, service_client_id INT NOT NULL, description LONGTEXT NOT NULL, service VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', status VARCHAR(50) NOT NULL, INDEX IDX_5F2732B519EB6921 (client_id), INDEX IDX_5F2732B5417A536B (service_client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE critiques (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, reservation_id INT NOT NULL, rating INT NOT NULL, INDEX IDX_2712BED919EB6921 (client_id), UNIQUE INDEX UNIQ_2712BED9B83297E7 (reservation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE garages (id INT AUTO_INCREMENT NOT NULL, mechanic_id INT NOT NULL, location_id INT DEFAULT NULL, email_garage VARCHAR(255) NOT NULL, rating DOUBLE PRECISION NOT NULL, status VARCHAR(20) NOT NULL, name VARCHAR(255) NOT NULL, working_hours VARCHAR(255) DEFAULT NULL, INDEX IDX_8C4330E29A67DB00 (mechanic_id), UNIQUE INDEX UNIQ_8C4330E264D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, address VARCHAR(255) NOT NULL, longitude DOUBLE PRECISION NOT NULL, latitude DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE mechanic (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, password VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, roles VARCHAR(255) DEFAULT NULL, phone VARCHAR(20) DEFAULT NULL, reset_token VARCHAR(255) DEFAULT NULL, token_expiration DATETIME DEFAULT NULL, photo_profil VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(20) DEFAULT NULL, working_hours VARCHAR(255) DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL, garage_address VARCHAR(255) DEFAULT NULL, specialization VARCHAR(100) DEFAULT NULL, experience_years INT DEFAULT NULL, certifications VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE repair_part (id INT AUTO_INCREMENT NOT NULL, reservation_id INT NOT NULL, part_name VARCHAR(100) NOT NULL, price NUMERIC(10, 2) NOT NULL, INDEX IDX_9C29A426B83297E7 (reservation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE reservations (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, vehicle_id INT DEFAULT NULL, garage_id INT DEFAULT NULL, reservation_date DATETIME NOT NULL, status VARCHAR(20) NOT NULL, estimated_price NUMERIC(10, 2) NOT NULL, notes LONGTEXT DEFAULT NULL, INDEX IDX_4DA239545317D1 (vehicle_id), INDEX IDX_4DA23919EB6921 (client_id), INDEX IDX_4DA239C4FFF555 (garage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, content LONGTEXT NOT NULL, rating INT NOT NULL, INDEX IDX_794381C619EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, category_service_id INT NOT NULL, service_name VARCHAR(100) NOT NULL, service_code VARCHAR(100) NOT NULL, prix NUMERIC(10, 2) NOT NULL, description LONGTEXT DEFAULT NULL, status VARCHAR(20) NOT NULL, INDEX IDX_E19D9AD2CB42F998 (category_service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE reservation_services (service_id INT NOT NULL, reservation_id INT NOT NULL, INDEX IDX_EE87037DED5CA9E6 (service_id), INDEX IDX_EE87037DB83297E7 (reservation_id), PRIMARY KEY(service_id, reservation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE service_client (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, password VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, roles VARCHAR(255) DEFAULT NULL, phone VARCHAR(20) DEFAULT NULL, reset_token VARCHAR(255) DEFAULT NULL, token_expiration DATETIME DEFAULT NULL, photo_profil VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, service_details VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE vehicules (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, car_api_id INT NOT NULL, model VARCHAR(255) NOT NULL, brand VARCHAR(255) NOT NULL, license_plate VARCHAR(255) NOT NULL, INDEX IDX_78218C2D19EB6921 (client_id), INDEX IDX_78218C2D4CFED5CA (car_api_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cart ADD CONSTRAINT FK_BA388B719EB6921 FOREIGN KEY (client_id) REFERENCES client (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garageCategoryService ADD CONSTRAINT FK_92C8F1CCCB42F998 FOREIGN KEY (category_service_id) REFERENCES category_service (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garageCategoryService ADD CONSTRAINT FK_92C8F1CCC4FFF555 FOREIGN KEY (garage_id) REFERENCES garages (id) ON DELETE CASCADE
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
            ALTER TABLE garages ADD CONSTRAINT FK_8C4330E29A67DB00 FOREIGN KEY (mechanic_id) REFERENCES mechanic (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garages ADD CONSTRAINT FK_8C4330E264D218E FOREIGN KEY (location_id) REFERENCES location (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE repair_part ADD CONSTRAINT FK_9C29A426B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservations (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservations ADD CONSTRAINT FK_4DA239545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicules (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservations ADD CONSTRAINT FK_4DA23919EB6921 FOREIGN KEY (client_id) REFERENCES client (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservations ADD CONSTRAINT FK_4DA239C4FFF555 FOREIGN KEY (garage_id) REFERENCES garages (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE review ADD CONSTRAINT FK_794381C619EB6921 FOREIGN KEY (client_id) REFERENCES client (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2CB42F998 FOREIGN KEY (category_service_id) REFERENCES category_service (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_services ADD CONSTRAINT FK_EE87037DED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_services ADD CONSTRAINT FK_EE87037DB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservations (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vehicules ADD CONSTRAINT FK_78218C2D19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vehicules ADD CONSTRAINT FK_78218C2D4CFED5CA FOREIGN KEY (car_api_id) REFERENCES car_api (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE cart DROP FOREIGN KEY FK_BA388B719EB6921
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garageCategoryService DROP FOREIGN KEY FK_92C8F1CCCB42F998
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garageCategoryService DROP FOREIGN KEY FK_92C8F1CCC4FFF555
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
            ALTER TABLE garages DROP FOREIGN KEY FK_8C4330E29A67DB00
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garages DROP FOREIGN KEY FK_8C4330E264D218E
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE repair_part DROP FOREIGN KEY FK_9C29A426B83297E7
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservations DROP FOREIGN KEY FK_4DA239545317D1
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservations DROP FOREIGN KEY FK_4DA23919EB6921
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservations DROP FOREIGN KEY FK_4DA239C4FFF555
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE review DROP FOREIGN KEY FK_794381C619EB6921
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD2CB42F998
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_services DROP FOREIGN KEY FK_EE87037DED5CA9E6
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_services DROP FOREIGN KEY FK_EE87037DB83297E7
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vehicules DROP FOREIGN KEY FK_78218C2D19EB6921
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vehicules DROP FOREIGN KEY FK_78218C2D4CFED5CA
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE `admin`
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE car_api
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE cart
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE category_service
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE garageCategoryService
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
            DROP TABLE garages
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE location
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE mechanic
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE repair_part
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE reservations
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE review
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE service
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE reservation_services
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
    }
}
