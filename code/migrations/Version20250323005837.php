<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250323005837 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE garage');
        $this->addSql('DROP TABLE garage_category_service');
        $this->addSql('DROP TABLE mechanics');
        $this->addSql('DROP TABLE product');
        $this->addSql('ALTER TABLE `admin` ADD email VARCHAR(255) NOT NULL, ADD Image VARCHAR(255) DEFAULT NULL, ADD reset_token VARCHAR(255) DEFAULT NULL, ADD token_expiration DATETIME DEFAULT NULL, CHANGE password password VARCHAR(255) DEFAULT NULL, CHANGE username name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE car_rental_services ADD name VARCHAR(255) NOT NULL, ADD roles JSON NOT NULL, ADD reset_token VARCHAR(255) DEFAULT NULL, ADD token_expiration DATETIME DEFAULT NULL, ADD phoneNumber VARCHAR(20) DEFAULT NULL, ADD workingHours VARCHAR(255) DEFAULT NULL, ADD Logo VARCHAR(255) DEFAULT NULL, DROP username, DROP phone_number, DROP working_hours, DROP service_name, DROP service_location, DROP service_hours, CHANGE email email VARCHAR(255) NOT NULL, CHANGE contact_info contact_info VARCHAR(255) DEFAULT NULL, CHANGE role Image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D14C9C86E00');
        $this->addSql('DROP INDEX IDX_95C71D14C9C86E00 ON cars');
        $this->addSql('ALTER TABLE cars ADD status TINYINT(1) NOT NULL, ADD daily_rate DOUBLE PRECISION NOT NULL, ADD car_api_id INT NOT NULL, CHANGE car_rental_service_id car_rental_id INT NOT NULL');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D14A02DD105 FOREIGN KEY (car_rental_id) REFERENCES car_rental (id)');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D144CFED5CA FOREIGN KEY (car_api_id) REFERENCES car_api (id)');
        $this->addSql('CREATE INDEX IDX_95C71D14A02DD105 ON cars (car_rental_id)');
        $this->addSql('CREATE INDEX IDX_95C71D144CFED5CA ON cars (car_api_id)');
        $this->addSql('ALTER TABLE cart DROP INDEX IDX_BA388B719EB6921, ADD UNIQUE INDEX UNIQ_BA388B719EB6921 (client_id)');
        $this->addSql('ALTER TABLE cart CHANGE total_amount total_amount NUMERIC(10, 2) NOT NULL');
        $this->addSql('ALTER TABLE category_service DROP FOREIGN KEY FK_2645DAAC9A67DB00');
        $this->addSql('ALTER TABLE category_service DROP status, CHANGE category_description categoryname VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE category_service ADD CONSTRAINT FK_2645DAAC9A67DB00 FOREIGN KEY (mechanic_id) REFERENCES mechanic (id)');
        $this->addSql('ALTER TABLE clients ADD name VARCHAR(255) NOT NULL, ADD Image VARCHAR(255) DEFAULT NULL, ADD roles JSON NOT NULL, ADD reset_token VARCHAR(255) DEFAULT NULL, ADD token_expiration DATETIME DEFAULT NULL, DROP role, DROP address, CHANGE username username VARCHAR(255) DEFAULT NULL, CHANGE email email VARCHAR(255) NOT NULL, CHANGE date_inscription date_inscription DATETIME NOT NULL');
        $this->addSql('ALTER TABLE complaint CHANGE created_at created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE critiques DROP INDEX IDX_2712BED9B83297E7, ADD UNIQUE INDEX UNIQ_2712BED9B83297E7 (reservation_id)');
        $this->addSql('ALTER TABLE critiques DROP FOREIGN KEY FK_2712BED99A67DB00');
        $this->addSql('ALTER TABLE critiques DROP FOREIGN KEY FK_2712BED9C4FFF555');
        $this->addSql('ALTER TABLE critiques DROP FOREIGN KEY FK_2712BED9ED5CA9E6');
        $this->addSql('DROP INDEX IDX_2712BED9ED5CA9E6 ON critiques');
        $this->addSql('DROP INDEX IDX_2712BED99A67DB00 ON critiques');
        $this->addSql('DROP INDEX IDX_2712BED9C4FFF555 ON critiques');
        $this->addSql('ALTER TABLE critiques DROP garage_id, DROP mechanic_id, DROP service_id, DROP content, DROP date');
        $this->addSql('ALTER TABLE `order` DROP INDEX IDX_F52993981AD5CDBF, ADD UNIQUE INDEX UNIQ_F52993981AD5CDBF (cart_id)');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993984C3A3BB');
        $this->addSql('DROP INDEX IDX_F52993984C3A3BB ON `order`');
        $this->addSql('ALTER TABLE `order` DROP payment_id');
        $this->addSql('ALTER TABLE payment ADD amount NUMERIC(10, 2) NOT NULL, ADD currency VARCHAR(3) NOT NULL, ADD status VARCHAR(255) NOT NULL, ADD transaction_id VARCHAR(255) NOT NULL, ADD payment_gateway VARCHAR(255) NOT NULL, ADD order_id INT NOT NULL');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D8D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6D28840D2FC0CB0F ON payment (transaction_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6D28840D8D9F6D38 ON payment (order_id)');
        $this->addSql('ALTER TABLE rental MODIFY rental_id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON rental');
        $this->addSql('ALTER TABLE rental DROP customer_id, CHANGE start_date start_date DATETIME NOT NULL, CHANGE end_date end_date DATETIME NOT NULL, CHANGE total_amount total_amount NUMERIC(10, 2) NOT NULL, CHANGE rental_id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE rental ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA23919EB6921');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA2394A4A3511');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA239C3C6F69F');
        $this->addSql('DROP INDEX IDX_4DA2394A4A3511 ON reservations');
        $this->addSql('DROP INDEX IDX_4DA23919EB6921 ON reservations');
        $this->addSql('DROP INDEX IDX_4DA239C3C6F69F ON reservations');
        $this->addSql('ALTER TABLE reservations ADD vehicle_id INT NOT NULL, DROP car_id, DROP vehicule_id, DROP mecanique_id, DROP service_type, CHANGE date_reservation reservation_date DATETIME NOT NULL, CHANGE prix_estime estimated_price NUMERIC(10, 2) NOT NULL');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA239545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicules (id)');
        $this->addSql('CREATE INDEX IDX_4DA239545317D1 ON reservations (vehicle_id)');
        $this->addSql('ALTER TABLE sellers ADD name VARCHAR(255) NOT NULL, ADD roles JSON NOT NULL, ADD reset_token VARCHAR(255) DEFAULT NULL, ADD token_expiration DATETIME DEFAULT NULL, ADD phoneNumber VARCHAR(20) DEFAULT NULL, ADD workingHours VARCHAR(255) DEFAULT NULL, ADD Logo VARCHAR(255) DEFAULT NULL, DROP username, DROP phone_number, DROP working_hours, CHANGE email email VARCHAR(255) NOT NULL, CHANGE contact_info contact_info VARCHAR(255) DEFAULT NULL, CHANGE role Image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE service ADD service_code VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE service_client ADD roles JSON NOT NULL, ADD reset_token VARCHAR(255) DEFAULT NULL, ADD token_expiration DATETIME DEFAULT NULL, CHANGE email email VARCHAR(255) NOT NULL, CHANGE username name VARCHAR(255) NOT NULL, CHANGE role Image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE shop ADD name VARCHAR(255) NOT NULL, ADD location_id INT NOT NULL, DROP shop_name, DROP location');
        $this->addSql('ALTER TABLE shop ADD CONSTRAINT FK_AC6A4CA264D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AC6A4CA264D218E ON shop (location_id)');
        $this->addSql('ALTER TABLE vehicules DROP FOREIGN KEY FK_78218C2DED5CA9E6');
        $this->addSql('DROP INDEX IDX_78218C2DED5CA9E6 ON vehicules');
        $this->addSql('ALTER TABLE vehicules ADD license_plate VARCHAR(255) NOT NULL, CHANGE service_id car_api_id INT NOT NULL');
        $this->addSql('ALTER TABLE vehicules ADD CONSTRAINT FK_78218C2D4CFED5CA FOREIGN KEY (car_api_id) REFERENCES car_api (id)');
        $this->addSql('CREATE INDEX IDX_78218C2D4CFED5CA ON vehicules (car_api_id)');
        $this->addSql('ALTER TABLE messenger_messages CHANGE created_at created_at DATETIME NOT NULL, CHANGE available_at available_at DATETIME NOT NULL, CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE garage (id INT AUTO_INCREMENT NOT NULL, mechanic_id INT DEFAULT NULL, rating DOUBLE PRECISION NOT NULL, status VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, garage_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, location VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, telephone_garage VARCHAR(15) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_9F26610B9A67DB00 (mechanic_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE garage_category_service (garage_id INT NOT NULL, category_service_id INT NOT NULL, INDEX IDX_B44D2A00CB42F998 (category_service_id), INDEX IDX_B44D2A00C4FFF555 (garage_id), PRIMARY KEY(garage_id, category_service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE mechanics (id INT AUTO_INCREMENT NOT NULL, location_id INT NOT NULL, username VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, password VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, role VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, phone_number VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, working_hours VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, status VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_32A6314D64D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE product (product_id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, cart_id INT NOT NULL, order_id INT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, price DOUBLE PRECISION NOT NULL, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, stock_quantity INT NOT NULL, INDEX IDX_D34A04AD8D9F6D38 (order_id), INDEX IDX_D34A04AD1AD5CDBF (cart_id), INDEX IDX_D34A04AD12469DE2 (category_id), PRIMARY KEY(product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE `admin` ADD username VARCHAR(255) NOT NULL, DROP name, DROP email, DROP Image, DROP reset_token, DROP token_expiration, CHANGE password password VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE car_rental_services ADD role VARCHAR(255) DEFAULT NULL, ADD phone_number VARCHAR(255) NOT NULL, ADD working_hours VARCHAR(255) NOT NULL, ADD service_name VARCHAR(255) NOT NULL, ADD service_location VARCHAR(255) NOT NULL, ADD service_hours VARCHAR(255) NOT NULL, DROP Image, DROP roles, DROP reset_token, DROP token_expiration, DROP phoneNumber, DROP workingHours, DROP Logo, CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE contact_info contact_info VARCHAR(255) NOT NULL, CHANGE name username VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE clients ADD role VARCHAR(255) DEFAULT NULL, ADD address VARCHAR(255) DEFAULT NULL, DROP name, DROP Image, DROP roles, DROP reset_token, DROP token_expiration, CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE username username VARCHAR(255) NOT NULL, CHANGE date_inscription date_inscription DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840D8D9F6D38');
        $this->addSql('DROP INDEX UNIQ_6D28840D2FC0CB0F ON payment');
        $this->addSql('DROP INDEX UNIQ_6D28840D8D9F6D38 ON payment');
        $this->addSql('ALTER TABLE payment DROP amount, DROP currency, DROP status, DROP transaction_id, DROP payment_gateway, DROP order_id');
        $this->addSql('ALTER TABLE sellers ADD role VARCHAR(255) DEFAULT NULL, ADD phone_number VARCHAR(255) NOT NULL, ADD working_hours VARCHAR(255) NOT NULL, DROP Image, DROP roles, DROP reset_token, DROP token_expiration, DROP phoneNumber, DROP workingHours, DROP Logo, CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE contact_info contact_info VARCHAR(255) NOT NULL, CHANGE name username VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE service_client ADD role VARCHAR(255) DEFAULT NULL, DROP Image, DROP roles, DROP reset_token, DROP token_expiration, CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE name username VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE messenger_messages CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE available_at available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE delivered_at delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D14A02DD105');
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D144CFED5CA');
        $this->addSql('DROP INDEX IDX_95C71D14A02DD105 ON cars');
        $this->addSql('DROP INDEX IDX_95C71D144CFED5CA ON cars');
        $this->addSql('ALTER TABLE cars ADD car_rental_service_id INT NOT NULL, DROP status, DROP daily_rate, DROP car_rental_id, DROP car_api_id');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D14C9C86E00 FOREIGN KEY (car_rental_service_id) REFERENCES car_rental_services (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_95C71D14C9C86E00 ON cars (car_rental_service_id)');
        $this->addSql('ALTER TABLE cart DROP INDEX UNIQ_BA388B719EB6921, ADD INDEX IDX_BA388B719EB6921 (client_id)');
        $this->addSql('ALTER TABLE cart CHANGE total_amount total_amount DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE category_service DROP FOREIGN KEY FK_2645DAAC9A67DB00');
        $this->addSql('ALTER TABLE category_service ADD status VARCHAR(20) NOT NULL, CHANGE categoryname category_description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE category_service ADD CONSTRAINT FK_2645DAAC9A67DB00 FOREIGN KEY (mechanic_id) REFERENCES mechanics (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE complaint CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE critiques DROP INDEX UNIQ_2712BED9B83297E7, ADD INDEX IDX_2712BED9B83297E7 (reservation_id)');
        $this->addSql('ALTER TABLE critiques ADD garage_id INT NOT NULL, ADD mechanic_id INT NOT NULL, ADD service_id INT NOT NULL, ADD content LONGTEXT NOT NULL, ADD date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE critiques ADD CONSTRAINT FK_2712BED99A67DB00 FOREIGN KEY (mechanic_id) REFERENCES mechanics (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE critiques ADD CONSTRAINT FK_2712BED9C4FFF555 FOREIGN KEY (garage_id) REFERENCES garage (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE critiques ADD CONSTRAINT FK_2712BED9ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_2712BED9ED5CA9E6 ON critiques (service_id)');
        $this->addSql('CREATE INDEX IDX_2712BED99A67DB00 ON critiques (mechanic_id)');
        $this->addSql('CREATE INDEX IDX_2712BED9C4FFF555 ON critiques (garage_id)');
        $this->addSql('ALTER TABLE `order` DROP INDEX UNIQ_F52993981AD5CDBF, ADD INDEX IDX_F52993981AD5CDBF (cart_id)');
        $this->addSql('ALTER TABLE `order` ADD payment_id INT NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993984C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_F52993984C3A3BB ON `order` (payment_id)');
        $this->addSql('ALTER TABLE rental MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON rental');
        $this->addSql('ALTER TABLE rental ADD customer_id INT NOT NULL, CHANGE start_date start_date DATE NOT NULL, CHANGE end_date end_date DATE NOT NULL, CHANGE total_amount total_amount DOUBLE PRECISION NOT NULL, CHANGE id rental_id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE rental ADD PRIMARY KEY (rental_id)');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA239545317D1');
        $this->addSql('DROP INDEX IDX_4DA239545317D1 ON reservations');
        $this->addSql('ALTER TABLE reservations ADD vehicule_id INT NOT NULL, ADD mecanique_id INT NOT NULL, ADD service_type VARCHAR(50) NOT NULL, CHANGE vehicle_id car_id INT NOT NULL, CHANGE reservation_date date_reservation DATETIME NOT NULL, CHANGE estimated_price prix_estime NUMERIC(10, 2) NOT NULL');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA23919EB6921 FOREIGN KEY (client_id) REFERENCES clients (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA2394A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicules (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA239C3C6F69F FOREIGN KEY (car_id) REFERENCES cars (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_4DA2394A4A3511 ON reservations (vehicule_id)');
        $this->addSql('CREATE INDEX IDX_4DA23919EB6921 ON reservations (client_id)');
        $this->addSql('CREATE INDEX IDX_4DA239C3C6F69F ON reservations (car_id)');
        $this->addSql('ALTER TABLE service DROP service_code');
        $this->addSql('ALTER TABLE shop DROP FOREIGN KEY FK_AC6A4CA264D218E');
        $this->addSql('DROP INDEX UNIQ_AC6A4CA264D218E ON shop');
        $this->addSql('ALTER TABLE shop ADD location VARCHAR(255) NOT NULL, DROP location_id, CHANGE name shop_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE vehicules DROP FOREIGN KEY FK_78218C2D4CFED5CA');
        $this->addSql('DROP INDEX IDX_78218C2D4CFED5CA ON vehicules');
        $this->addSql('ALTER TABLE vehicules DROP license_plate, CHANGE car_api_id service_id INT NOT NULL');
        $this->addSql('ALTER TABLE vehicules ADD CONSTRAINT FK_78218C2DED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_78218C2DED5CA9E6 ON vehicules (service_id)');
    }
}
