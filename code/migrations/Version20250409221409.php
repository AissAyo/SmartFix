<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250409221409 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE car_api (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE car_rental (id INT AUTO_INCREMENT NOT NULL, location_id INT NOT NULL, car_rental_service_id INT NOT NULL, name VARCHAR(255) NOT NULL, logo VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_E712E8F64D218E (location_id), INDEX IDX_E712E8FC9C86E00 (car_rental_service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE cart_products (cart_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_2D2515311AD5CDBF (cart_id), INDEX IDX_2D2515314584665A (product_id), PRIMARY KEY(cart_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE category_product (id INT AUTO_INCREMENT NOT NULL, shop_id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_149244D34D16C4DD (shop_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE garage_service_reservation (garage_service_id INT NOT NULL, reservation_id INT NOT NULL, INDEX IDX_4457A2E09458ECE0 (garage_service_id), INDEX IDX_4457A2E0B83297E7 (reservation_id), PRIMARY KEY(garage_service_id, reservation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE or_der (id INT AUTO_INCREMENT NOT NULL, cart_id INT NOT NULL, delivery_id INT NOT NULL, status VARCHAR(255) NOT NULL, or_der_date DATETIME NOT NULL, delivery_date DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_B1435C791AD5CDBF (cart_id), INDEX IDX_B1435C7912136921 (delivery_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE products (id INT AUTO_INCREMENT NOT NULL, shop_id INT NOT NULL, category_product_id INT NOT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, description VARCHAR(255) NOT NULL, stock_quantity INT NOT NULL, INDEX IDX_B3BA5A5A4D16C4DD (shop_id), INDEX IDX_B3BA5A5A639A3624 (category_product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE repair_part (id INT AUTO_INCREMENT NOT NULL, reservation_id INT NOT NULL, part_name VARCHAR(100) NOT NULL, price NUMERIC(10, 2) NOT NULL, INDEX IDX_9C29A426B83297E7 (reservation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE car_rental ADD CONSTRAINT FK_E712E8F64D218E FOREIGN KEY (location_id) REFERENCES location (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE car_rental ADD CONSTRAINT FK_E712E8FC9C86E00 FOREIGN KEY (car_rental_service_id) REFERENCES car_rental_services (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cart_products ADD CONSTRAINT FK_2D2515311AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cart_products ADD CONSTRAINT FK_2D2515314584665A FOREIGN KEY (product_id) REFERENCES products (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE category_product ADD CONSTRAINT FK_149244D34D16C4DD FOREIGN KEY (shop_id) REFERENCES shop (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garage_service_reservation ADD CONSTRAINT FK_4457A2E09458ECE0 FOREIGN KEY (garage_service_id) REFERENCES garage_service (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garage_service_reservation ADD CONSTRAINT FK_4457A2E0B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservations (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE or_der ADD CONSTRAINT FK_B1435C791AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE or_der ADD CONSTRAINT FK_B1435C7912136921 FOREIGN KEY (delivery_id) REFERENCES delivery (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A4D16C4DD FOREIGN KEY (shop_id) REFERENCES shop (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A639A3624 FOREIGN KEY (category_product_id) REFERENCES category_product (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE repair_part ADD CONSTRAINT FK_9C29A426B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservations (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE category DROP FOREIGN KEY FK_64C19C14D16C4DD
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garage_category_service DROP FOREIGN KEY FK_B44D2A00C4FFF555
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garage_category_service DROP FOREIGN KEY FK_B44D2A00CB42F998
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `order` DROP FOREIGN KEY FK_F529939812136921
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `order` DROP FOREIGN KEY FK_F52993984C3A3BB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD1AD5CDBF
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE category
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE garage_category_service
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE `order`
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE product
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `admin` ADD name VARCHAR(255) DEFAULT NULL, ADD email VARCHAR(255) DEFAULT NULL, ADD photo_profil VARCHAR(255) DEFAULT NULL, ADD logo_file VARCHAR(255) DEFAULT NULL, ADD phone VARCHAR(20) DEFAULT NULL, ADD reset_token VARCHAR(255) DEFAULT NULL, ADD token_expiration DATETIME DEFAULT NULL, DROP username, CHANGE password password VARCHAR(255) DEFAULT NULL, CHANGE roles roles VARCHAR(255) DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE car_rental_services ADD name VARCHAR(255) DEFAULT NULL, ADD photo_profil VARCHAR(255) DEFAULT NULL, ADD logo_file VARCHAR(255) DEFAULT NULL, ADD roles VARCHAR(255) DEFAULT NULL, ADD phone VARCHAR(20) DEFAULT NULL, ADD reset_token VARCHAR(255) DEFAULT NULL, ADD token_expiration DATETIME DEFAULT NULL, ADD logo VARCHAR(255) DEFAULT NULL, DROP username, DROP garage_name, DROP garage_address, DROP contact_info, DROP service_name, DROP service_location, DROP service_hours, CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE phone_number phone_number VARCHAR(20) DEFAULT NULL, CHANGE working_hours working_hours VARCHAR(255) DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cars DROP FOREIGN KEY FK_95C71D14C9C86E00
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_95C71D14C9C86E00 ON cars
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cars ADD car_api_id INT NOT NULL, CHANGE car_rental_service_id car_rental_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cars ADD CONSTRAINT FK_95C71D14A02DD105 FOREIGN KEY (car_rental_id) REFERENCES car_rental (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cars ADD CONSTRAINT FK_95C71D144CFED5CA FOREIGN KEY (car_api_id) REFERENCES car_api (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_95C71D14A02DD105 ON cars (car_rental_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_95C71D144CFED5CA ON cars (car_api_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cart DROP INDEX IDX_BA388B719EB6921, ADD UNIQUE INDEX UNIQ_BA388B719EB6921 (client_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cart CHANGE total_amount total_amount NUMERIC(10, 2) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE category_service DROP status, CHANGE category_description categoryname VARCHAR(255) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE clients ADD logo_file VARCHAR(255) DEFAULT NULL, ADD roles VARCHAR(255) DEFAULT NULL, ADD phone VARCHAR(20) DEFAULT NULL, ADD reset_token VARCHAR(255) DEFAULT NULL, ADD token_expiration DATETIME DEFAULT NULL, DROP username, CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE address photo_profil VARCHAR(255) DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE critiques DROP INDEX IDX_2712BED9B83297E7, ADD UNIQUE INDEX UNIQ_2712BED9B83297E7 (reservation_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE critiques DROP FOREIGN KEY FK_2712BED99A67DB00
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE critiques DROP FOREIGN KEY FK_2712BED9C4FFF555
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE critiques DROP FOREIGN KEY FK_2712BED9ED5CA9E6
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_2712BED99A67DB00 ON critiques
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_2712BED9ED5CA9E6 ON critiques
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_2712BED9C4FFF555 ON critiques
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE critiques DROP garage_id, DROP mechanic_id, DROP service_id, DROP content, DROP date
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garage_service ADD garage_id INT NOT NULL, ADD service_id INT NOT NULL, ADD car_api_id INT NOT NULL, ADD price DOUBLE PRECISION NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garage_service ADD CONSTRAINT FK_67DD7642C4FFF555 FOREIGN KEY (garage_id) REFERENCES garages (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garage_service ADD CONSTRAINT FK_67DD7642ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garage_service ADD CONSTRAINT FK_67DD76424CFED5CA FOREIGN KEY (car_api_id) REFERENCES car_api (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_67DD7642C4FFF555 ON garage_service (garage_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_67DD7642ED5CA9E6 ON garage_service (service_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_67DD76424CFED5CA ON garage_service (car_api_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garages ADD location_id INT NOT NULL, ADD working_hours VARCHAR(255) DEFAULT NULL, CHANGE location email_garage VARCHAR(255) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garages ADD CONSTRAINT FK_8C4330E264D218E FOREIGN KEY (location_id) REFERENCES location (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_8C4330E264D218E ON garages (location_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE mechanic DROP FOREIGN KEY FK_7137DE79D60322AC
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_7137DE79D60322AC ON mechanic
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE mechanic ADD name VARCHAR(255) DEFAULT NULL, ADD photo_profil VARCHAR(255) DEFAULT NULL, ADD logo_file VARCHAR(255) DEFAULT NULL, ADD roles VARCHAR(255) DEFAULT NULL, ADD phone VARCHAR(20) DEFAULT NULL, ADD reset_token VARCHAR(255) DEFAULT NULL, ADD token_expiration DATETIME DEFAULT NULL, ADD logo VARCHAR(255) DEFAULT NULL, ADD specialization VARCHAR(100) DEFAULT NULL, ADD experience_years INT DEFAULT NULL, DROP role_id, DROP username, DROP garage_name, DROP garage_address, DROP status, DROP telephone_garage, DROP garage_email, CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE phone_number phone_number VARCHAR(20) DEFAULT NULL, CHANGE working_hours working_hours VARCHAR(255) DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE payment ADD or_der_id INT NOT NULL, ADD amount NUMERIC(10, 2) NOT NULL, ADD currency VARCHAR(3) NOT NULL, ADD status VARCHAR(255) NOT NULL, ADD transaction_id VARCHAR(255) NOT NULL, ADD payment_gateway VARCHAR(255) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE payment ADD CONSTRAINT FK_6D28840DC4BA942C FOREIGN KEY (or_der_id) REFERENCES or_der (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_6D28840D2FC0CB0F ON payment (transaction_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_6D28840DC4BA942C ON payment (or_der_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservations DROP FOREIGN KEY FK_4DA23919EB6921
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservations DROP FOREIGN KEY FK_4DA2394A4A3511
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservations DROP FOREIGN KEY FK_4DA239C3C6F69F
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_4DA239C3C6F69F ON reservations
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_4DA2394A4A3511 ON reservations
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_4DA23919EB6921 ON reservations
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservations ADD vehicle_id INT NOT NULL, DROP car_id, DROP vehicule_id, DROP mecanique_id, DROP service_type, CHANGE date_reservation reservation_date DATETIME NOT NULL, CHANGE prix_estime estimated_price NUMERIC(10, 2) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservations ADD CONSTRAINT FK_4DA239545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicules (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_4DA239545317D1 ON reservations (vehicle_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE sellers DROP FOREIGN KEY FK_AFFE6BEF4D16C4DD
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_AFFE6BEF4D16C4DD ON sellers
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE sellers ADD name VARCHAR(255) DEFAULT NULL, ADD photo_profil VARCHAR(255) DEFAULT NULL, ADD logo_file VARCHAR(255) DEFAULT NULL, ADD roles VARCHAR(255) DEFAULT NULL, ADD phone VARCHAR(20) DEFAULT NULL, ADD reset_token VARCHAR(255) DEFAULT NULL, ADD token_expiration DATETIME DEFAULT NULL, ADD logo VARCHAR(255) DEFAULT NULL, DROP shop_id, DROP username, DROP garage_name, DROP garage_address, DROP shop_name, DROP shop_email, DROP shop_phone, CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE phone_number phone_number VARCHAR(20) DEFAULT NULL, CHANGE working_hours working_hours VARCHAR(255) DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE service ADD service_code VARCHAR(100) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE service_client ADD name VARCHAR(255) DEFAULT NULL, ADD photo_profil VARCHAR(255) DEFAULT NULL, ADD logo_file VARCHAR(255) DEFAULT NULL, ADD roles VARCHAR(255) DEFAULT NULL, ADD phone VARCHAR(20) DEFAULT NULL, ADD reset_token VARCHAR(255) DEFAULT NULL, ADD token_expiration DATETIME DEFAULT NULL, DROP username, CHANGE email email VARCHAR(255) DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE shop ADD seller_id INT NOT NULL, ADD location_id INT NOT NULL, DROP location
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE shop ADD CONSTRAINT FK_AC6A4CA28DE820D9 FOREIGN KEY (seller_id) REFERENCES sellers (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE shop ADD CONSTRAINT FK_AC6A4CA264D218E FOREIGN KEY (location_id) REFERENCES location (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_AC6A4CA28DE820D9 ON shop (seller_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_AC6A4CA264D218E ON shop (location_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE cars DROP FOREIGN KEY FK_95C71D144CFED5CA
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garage_service DROP FOREIGN KEY FK_67DD76424CFED5CA
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cars DROP FOREIGN KEY FK_95C71D14A02DD105
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE payment DROP FOREIGN KEY FK_6D28840DC4BA942C
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, shop_id INT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, slug VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_64C19C14D16C4DD (shop_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE garage_category_service (garage_id INT NOT NULL, category_service_id INT NOT NULL, INDEX IDX_B44D2A00CB42F998 (category_service_id), INDEX IDX_B44D2A00C4FFF555 (garage_id), PRIMARY KEY(garage_id, category_service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, payment_id INT NOT NULL, delivery_id INT NOT NULL, status VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, order_date DATETIME NOT NULL, delivery_date DATETIME DEFAULT NULL, INDEX IDX_F52993984C3A3BB (payment_id), INDEX IDX_F529939812136921 (delivery_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE product (product_id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, cart_id INT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, price DOUBLE PRECISION NOT NULL, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, stock_quantity INT NOT NULL, INDEX IDX_D34A04AD1AD5CDBF (cart_id), INDEX IDX_D34A04AD12469DE2 (category_id), PRIMARY KEY(product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE category ADD CONSTRAINT FK_64C19C14D16C4DD FOREIGN KEY (shop_id) REFERENCES shop (id) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garage_category_service ADD CONSTRAINT FK_B44D2A00C4FFF555 FOREIGN KEY (garage_id) REFERENCES garages (id) ON UPDATE NO ACTION ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garage_category_service ADD CONSTRAINT FK_B44D2A00CB42F998 FOREIGN KEY (category_service_id) REFERENCES category_service (id) ON UPDATE NO ACTION ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `order` ADD CONSTRAINT FK_F529939812136921 FOREIGN KEY (delivery_id) REFERENCES delivery (id) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `order` ADD CONSTRAINT FK_F52993984C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE product ADD CONSTRAINT FK_D34A04AD1AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE car_rental DROP FOREIGN KEY FK_E712E8F64D218E
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE car_rental DROP FOREIGN KEY FK_E712E8FC9C86E00
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cart_products DROP FOREIGN KEY FK_2D2515311AD5CDBF
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cart_products DROP FOREIGN KEY FK_2D2515314584665A
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE category_product DROP FOREIGN KEY FK_149244D34D16C4DD
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garage_service_reservation DROP FOREIGN KEY FK_4457A2E09458ECE0
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garage_service_reservation DROP FOREIGN KEY FK_4457A2E0B83297E7
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE or_der DROP FOREIGN KEY FK_B1435C791AD5CDBF
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE or_der DROP FOREIGN KEY FK_B1435C7912136921
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A4D16C4DD
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A639A3624
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE repair_part DROP FOREIGN KEY FK_9C29A426B83297E7
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE car_api
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE car_rental
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE cart_products
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE category_product
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE garage_service_reservation
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE or_der
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE products
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE repair_part
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `admin` ADD username VARCHAR(255) NOT NULL, DROP name, DROP email, DROP photo_profil, DROP logo_file, DROP phone, DROP reset_token, DROP token_expiration, CHANGE password password VARCHAR(255) NOT NULL, CHANGE roles roles JSON NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE car_rental_services ADD username VARCHAR(255) NOT NULL, ADD garage_name VARCHAR(255) NOT NULL, ADD garage_address VARCHAR(255) NOT NULL, ADD contact_info VARCHAR(255) NOT NULL, ADD service_name VARCHAR(255) NOT NULL, ADD service_location VARCHAR(255) NOT NULL, ADD service_hours VARCHAR(255) NOT NULL, DROP name, DROP photo_profil, DROP logo_file, DROP roles, DROP phone, DROP reset_token, DROP token_expiration, DROP logo, CHANGE email email VARCHAR(255) NOT NULL, CHANGE phone_number phone_number VARCHAR(255) NOT NULL, CHANGE working_hours working_hours VARCHAR(255) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_95C71D14A02DD105 ON cars
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_95C71D144CFED5CA ON cars
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cars ADD car_rental_service_id INT NOT NULL, DROP car_rental_id, DROP car_api_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cars ADD CONSTRAINT FK_95C71D14C9C86E00 FOREIGN KEY (car_rental_service_id) REFERENCES car_rental_services (id) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_95C71D14C9C86E00 ON cars (car_rental_service_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cart DROP INDEX UNIQ_BA388B719EB6921, ADD INDEX IDX_BA388B719EB6921 (client_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cart CHANGE total_amount total_amount DOUBLE PRECISION NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE category_service ADD status VARCHAR(20) NOT NULL, CHANGE categoryname category_description VARCHAR(255) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE clients ADD username VARCHAR(255) NOT NULL, ADD address VARCHAR(255) DEFAULT NULL, DROP photo_profil, DROP logo_file, DROP roles, DROP phone, DROP reset_token, DROP token_expiration, CHANGE email email VARCHAR(255) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE critiques DROP INDEX UNIQ_2712BED9B83297E7, ADD INDEX IDX_2712BED9B83297E7 (reservation_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE critiques ADD garage_id INT NOT NULL, ADD mechanic_id INT NOT NULL, ADD service_id INT NOT NULL, ADD content LONGTEXT NOT NULL, ADD date DATETIME NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE critiques ADD CONSTRAINT FK_2712BED99A67DB00 FOREIGN KEY (mechanic_id) REFERENCES mechanic (id) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE critiques ADD CONSTRAINT FK_2712BED9C4FFF555 FOREIGN KEY (garage_id) REFERENCES garages (id) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE critiques ADD CONSTRAINT FK_2712BED9ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_2712BED99A67DB00 ON critiques (mechanic_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_2712BED9ED5CA9E6 ON critiques (service_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_2712BED9C4FFF555 ON critiques (garage_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garage_service DROP FOREIGN KEY FK_67DD7642C4FFF555
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garage_service DROP FOREIGN KEY FK_67DD7642ED5CA9E6
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_67DD7642C4FFF555 ON garage_service
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_67DD7642ED5CA9E6 ON garage_service
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_67DD76424CFED5CA ON garage_service
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garage_service DROP garage_id, DROP service_id, DROP car_api_id, DROP price
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garages DROP FOREIGN KEY FK_8C4330E264D218E
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_8C4330E264D218E ON garages
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE garages DROP location_id, DROP working_hours, CHANGE email_garage location VARCHAR(255) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE mechanic ADD role_id INT NOT NULL, ADD username VARCHAR(255) NOT NULL, ADD garage_name VARCHAR(255) NOT NULL, ADD garage_address VARCHAR(255) NOT NULL, ADD status VARCHAR(20) NOT NULL, ADD telephone_garage VARCHAR(15) NOT NULL, ADD garage_email VARCHAR(255) NOT NULL, DROP name, DROP photo_profil, DROP logo_file, DROP roles, DROP phone, DROP reset_token, DROP token_expiration, DROP logo, DROP specialization, DROP experience_years, CHANGE email email VARCHAR(255) NOT NULL, CHANGE phone_number phone_number VARCHAR(255) NOT NULL, CHANGE working_hours working_hours VARCHAR(255) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE mechanic ADD CONSTRAINT FK_7137DE79D60322AC FOREIGN KEY (role_id) REFERENCES roles (id) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_7137DE79D60322AC ON mechanic (role_id)
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_6D28840D2FC0CB0F ON payment
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_6D28840DC4BA942C ON payment
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE payment DROP or_der_id, DROP amount, DROP currency, DROP status, DROP transaction_id, DROP payment_gateway
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservations DROP FOREIGN KEY FK_4DA239545317D1
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_4DA239545317D1 ON reservations
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservations ADD vehicule_id INT NOT NULL, ADD mecanique_id INT NOT NULL, ADD service_type VARCHAR(50) NOT NULL, CHANGE vehicle_id car_id INT NOT NULL, CHANGE reservation_date date_reservation DATETIME NOT NULL, CHANGE estimated_price prix_estime NUMERIC(10, 2) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservations ADD CONSTRAINT FK_4DA23919EB6921 FOREIGN KEY (client_id) REFERENCES clients (id) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservations ADD CONSTRAINT FK_4DA2394A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicules (id) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservations ADD CONSTRAINT FK_4DA239C3C6F69F FOREIGN KEY (car_id) REFERENCES cars (id) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_4DA239C3C6F69F ON reservations (car_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_4DA2394A4A3511 ON reservations (vehicule_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_4DA23919EB6921 ON reservations (client_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE sellers ADD shop_id INT NOT NULL, ADD username VARCHAR(255) NOT NULL, ADD garage_name VARCHAR(255) NOT NULL, ADD garage_address VARCHAR(255) NOT NULL, ADD shop_name VARCHAR(255) NOT NULL, ADD shop_email VARCHAR(255) NOT NULL, ADD shop_phone VARCHAR(15) NOT NULL, DROP name, DROP photo_profil, DROP logo_file, DROP roles, DROP phone, DROP reset_token, DROP token_expiration, DROP logo, CHANGE email email VARCHAR(255) NOT NULL, CHANGE phone_number phone_number VARCHAR(255) NOT NULL, CHANGE working_hours working_hours VARCHAR(255) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE sellers ADD CONSTRAINT FK_AFFE6BEF4D16C4DD FOREIGN KEY (shop_id) REFERENCES shop (id) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_AFFE6BEF4D16C4DD ON sellers (shop_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE service DROP service_code
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE service_client ADD username VARCHAR(255) NOT NULL, DROP name, DROP photo_profil, DROP logo_file, DROP roles, DROP phone, DROP reset_token, DROP token_expiration, CHANGE email email VARCHAR(255) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE shop DROP FOREIGN KEY FK_AC6A4CA28DE820D9
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE shop DROP FOREIGN KEY FK_AC6A4CA264D218E
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_AC6A4CA28DE820D9 ON shop
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_AC6A4CA264D218E ON shop
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE shop ADD location VARCHAR(255) NOT NULL, DROP seller_id, DROP location_id
        SQL);
    }
}
