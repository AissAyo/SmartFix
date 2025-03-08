<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250302225511 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE critiques DROP FOREIGN KEY FK_2712BED9C4FFF555');
        $this->addSql('ALTER TABLE garage_category_service DROP FOREIGN KEY FK_B44D2A00C4FFF555');
        $this->addSql('ALTER TABLE category_service DROP FOREIGN KEY FK_2645DAAC9A67DB00');
        $this->addSql('ALTER TABLE critiques DROP FOREIGN KEY FK_2712BED99A67DB00');
        $this->addSql('CREATE TABLE `admin` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, password VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, reset_token VARCHAR(255) DEFAULT NULL, token_expiration DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE garages (id INT AUTO_INCREMENT NOT NULL, mechanic_id INT NOT NULL, rating DOUBLE PRECISION NOT NULL, status VARCHAR(20) NOT NULL, name VARCHAR(255) NOT NULL, location VARCHAR(255) NOT NULL, INDEX IDX_8C4330E29A67DB00 (mechanic_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE garagistes (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, password VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, reset_token VARCHAR(255) DEFAULT NULL, token_expiration DATETIME DEFAULT NULL, garage_name VARCHAR(255) DEFAULT NULL, garage_address VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(20) DEFAULT NULL, working_hours VARCHAR(255) DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL, discr VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mechanic (id INT NOT NULL, location_id INT NOT NULL, role_id INT NOT NULL, status VARCHAR(20) NOT NULL, telephone_garage VARCHAR(15) NOT NULL, garage_email VARCHAR(255) NOT NULL, INDEX IDX_7137DE7964D218E (location_id), INDEX IDX_7137DE79D60322AC (role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE repair_part (id INT AUTO_INCREMENT NOT NULL, reservation_id INT NOT NULL, part_name VARCHAR(100) NOT NULL, price NUMERIC(10, 2) NOT NULL, INDEX IDX_9C29A426B83297E7 (reservation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE garages ADD CONSTRAINT FK_8C4330E29A67DB00 FOREIGN KEY (mechanic_id) REFERENCES mechanic (id)');
        $this->addSql('ALTER TABLE mechanic ADD CONSTRAINT FK_7137DE7964D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE mechanic ADD CONSTRAINT FK_7137DE79D60322AC FOREIGN KEY (role_id) REFERENCES roles (id)');
        $this->addSql('ALTER TABLE mechanic ADD CONSTRAINT FK_7137DE79BF396750 FOREIGN KEY (id) REFERENCES garagistes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE repair_part ADD CONSTRAINT FK_9C29A426B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservations (id)');
        $this->addSql('ALTER TABLE mechanics DROP FOREIGN KEY FK_32A6314DD60322AC');
        $this->addSql('ALTER TABLE mechanics DROP FOREIGN KEY FK_32A6314DC4FFF555');
        $this->addSql('ALTER TABLE mechanics DROP FOREIGN KEY FK_32A6314D64D218E');
        $this->addSql('DROP TABLE garage');
        $this->addSql('DROP TABLE mechanics');
        $this->addSql('ALTER TABLE car_rental_services DROP username, DROP password, DROP garage_name, DROP garage_address, DROP phone_number, DROP working_hours, DROP service_location, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE car_rental_services ADD CONSTRAINT FK_78F7A11CBF396750 FOREIGN KEY (id) REFERENCES garagistes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cars ADD status TINYINT(1) NOT NULL, ADD daily_rate DOUBLE PRECISION NOT NULL');
        $this->addSql('DROP INDEX IDX_2645DAAC9A67DB00 ON category_service');
        $this->addSql('ALTER TABLE category_service DROP mechanic_id, DROP status, CHANGE category_description categoryname VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE clients ADD email VARCHAR(255) NOT NULL, ADD token_expiration DATETIME DEFAULT NULL, CHANGE name name VARCHAR(255) NOT NULL, CHANGE username username VARCHAR(255) DEFAULT NULL, CHANGE address reset_token VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE critiques DROP FOREIGN KEY FK_2712BED9C4FFF555');
        $this->addSql('ALTER TABLE critiques DROP FOREIGN KEY FK_2712BED99A67DB00');
        $this->addSql('ALTER TABLE critiques ADD rating INT NOT NULL, ADD content LONGTEXT NOT NULL, ADD date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE critiques ADD CONSTRAINT FK_2712BED9C4FFF555 FOREIGN KEY (garage_id) REFERENCES garages (id)');
        $this->addSql('ALTER TABLE critiques ADD CONSTRAINT FK_2712BED99A67DB00 FOREIGN KEY (mechanic_id) REFERENCES mechanic (id)');
        $this->addSql('ALTER TABLE garage_category_service DROP FOREIGN KEY FK_B44D2A00C4FFF555');
        $this->addSql('ALTER TABLE garage_category_service ADD CONSTRAINT FK_B44D2A00C4FFF555 FOREIGN KEY (garage_id) REFERENCES garages (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993984C3A3BB');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993981AD5CDBF');
        $this->addSql('DROP INDEX IDX_F52993981AD5CDBF ON `order`');
        $this->addSql('DROP INDEX IDX_F52993984C3A3BB ON `order`');
        $this->addSql('ALTER TABLE `order` DROP cart_id, DROP payment_id');
        $this->addSql('ALTER TABLE payment ADD amount NUMERIC(10, 2) NOT NULL, ADD currency VARCHAR(3) NOT NULL, ADD status VARCHAR(255) NOT NULL, ADD transaction_id VARCHAR(255) NOT NULL, ADD payment_gateway VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6D28840D2FC0CB0F ON payment (transaction_id)');
        $this->addSql('ALTER TABLE rental MODIFY rental_id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON rental');
        $this->addSql('ALTER TABLE rental DROP customer_id, CHANGE start_date start_date DATETIME NOT NULL, CHANGE end_date end_date DATETIME NOT NULL, CHANGE total_amount total_amount NUMERIC(10, 2) NOT NULL, CHANGE rental_id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE rental ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE reservations ADD service_id INT NOT NULL, ADD vehicule_id INT NOT NULL, DROP service_type, CHANGE mecanique_id mechanic_id INT NOT NULL');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA2399A67DB00 FOREIGN KEY (mechanic_id) REFERENCES mechanic (id)');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA239ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA23919EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA2394A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicules (id)');
        $this->addSql('CREATE INDEX IDX_4DA2399A67DB00 ON reservations (mechanic_id)');
        $this->addSql('CREATE INDEX IDX_4DA239ED5CA9E6 ON reservations (service_id)');
        $this->addSql('CREATE INDEX IDX_4DA23919EB6921 ON reservations (client_id)');
        $this->addSql('CREATE INDEX IDX_4DA2394A4A3511 ON reservations (vehicule_id)');
        $this->addSql('ALTER TABLE sellers DROP FOREIGN KEY FK_AFFE6BEF4D16C4DD');
        $this->addSql('DROP INDEX IDX_AFFE6BEF4D16C4DD ON sellers');
        $this->addSql('ALTER TABLE sellers ADD role VARCHAR(255) NOT NULL, DROP shop_id');
        $this->addSql('ALTER TABLE sellers ADD CONSTRAINT FK_AFFE6BEFBF396750 FOREIGN KEY (id) REFERENCES garagistes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_client ADD email VARCHAR(255) NOT NULL, ADD reset_token VARCHAR(255) DEFAULT NULL, ADD token_expiration DATETIME DEFAULT NULL, CHANGE password password VARCHAR(255) DEFAULT NULL, CHANGE username name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE shop ADD seller_id INT NOT NULL');
        $this->addSql('ALTER TABLE shop ADD CONSTRAINT FK_AC6A4CA28DE820D9 FOREIGN KEY (seller_id) REFERENCES sellers (id)');
        $this->addSql('CREATE INDEX IDX_AC6A4CA28DE820D9 ON shop (seller_id)');
        $this->addSql('ALTER TABLE vehicules DROP FOREIGN KEY FK_78218C2DED5CA9E6');
        $this->addSql('DROP INDEX IDX_78218C2DED5CA9E6 ON vehicules');
        $this->addSql('ALTER TABLE vehicules DROP service_id');
        $this->addSql('ALTER TABLE verified_client ADD CONSTRAINT FK_E0855668C9C86E00 FOREIGN KEY (car_rental_service_id) REFERENCES car_rental_services (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE critiques DROP FOREIGN KEY FK_2712BED9C4FFF555');
        $this->addSql('ALTER TABLE garage_category_service DROP FOREIGN KEY FK_B44D2A00C4FFF555');
        $this->addSql('ALTER TABLE car_rental_services DROP FOREIGN KEY FK_78F7A11CBF396750');
        $this->addSql('ALTER TABLE sellers DROP FOREIGN KEY FK_AFFE6BEFBF396750');
        $this->addSql('ALTER TABLE critiques DROP FOREIGN KEY FK_2712BED99A67DB00');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA2399A67DB00');
        $this->addSql('CREATE TABLE garage (id INT AUTO_INCREMENT NOT NULL, rating DOUBLE PRECISION NOT NULL, status VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, location VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE mechanics (id INT NOT NULL, garage_id INT NOT NULL, location_id INT NOT NULL, role_id INT NOT NULL, status VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, telephone_garage VARCHAR(15) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, garage_email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_32A6314DC4FFF555 (garage_id), INDEX IDX_32A6314D64D218E (location_id), INDEX IDX_32A6314DD60322AC (role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE mechanics ADD CONSTRAINT FK_32A6314DD60322AC FOREIGN KEY (role_id) REFERENCES roles (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE mechanics ADD CONSTRAINT FK_32A6314DC4FFF555 FOREIGN KEY (garage_id) REFERENCES garage (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE mechanics ADD CONSTRAINT FK_32A6314D64D218E FOREIGN KEY (location_id) REFERENCES location (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE garages DROP FOREIGN KEY FK_8C4330E29A67DB00');
        $this->addSql('ALTER TABLE mechanic DROP FOREIGN KEY FK_7137DE7964D218E');
        $this->addSql('ALTER TABLE mechanic DROP FOREIGN KEY FK_7137DE79D60322AC');
        $this->addSql('ALTER TABLE mechanic DROP FOREIGN KEY FK_7137DE79BF396750');
        $this->addSql('ALTER TABLE repair_part DROP FOREIGN KEY FK_9C29A426B83297E7');
        $this->addSql('DROP TABLE `admin`');
        $this->addSql('DROP TABLE garages');
        $this->addSql('DROP TABLE garagistes');
        $this->addSql('DROP TABLE mechanic');
        $this->addSql('DROP TABLE repair_part');
        $this->addSql('ALTER TABLE car_rental_services ADD username VARCHAR(255) NOT NULL, ADD password VARCHAR(255) DEFAULT NULL, ADD garage_name VARCHAR(255) NOT NULL, ADD garage_address VARCHAR(255) NOT NULL, ADD phone_number VARCHAR(255) NOT NULL, ADD working_hours VARCHAR(255) NOT NULL, ADD service_location VARCHAR(255) NOT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE cars DROP status, DROP daily_rate');
        $this->addSql('ALTER TABLE category_service ADD mechanic_id INT NOT NULL, ADD status VARCHAR(20) NOT NULL, CHANGE categoryname category_description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE category_service ADD CONSTRAINT FK_2645DAAC9A67DB00 FOREIGN KEY (mechanic_id) REFERENCES mechanics (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_2645DAAC9A67DB00 ON category_service (mechanic_id)');
        $this->addSql('ALTER TABLE clients DROP email, DROP token_expiration, CHANGE name name VARCHAR(255) DEFAULT NULL, CHANGE username username VARCHAR(255) NOT NULL, CHANGE reset_token address VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE critiques DROP FOREIGN KEY FK_2712BED9C4FFF555');
        $this->addSql('ALTER TABLE critiques DROP FOREIGN KEY FK_2712BED99A67DB00');
        $this->addSql('ALTER TABLE critiques DROP rating, DROP content, DROP date');
        $this->addSql('ALTER TABLE critiques ADD CONSTRAINT FK_2712BED9C4FFF555 FOREIGN KEY (garage_id) REFERENCES garage (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE critiques ADD CONSTRAINT FK_2712BED99A67DB00 FOREIGN KEY (mechanic_id) REFERENCES mechanics (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE garage_category_service DROP FOREIGN KEY FK_B44D2A00C4FFF555');
        $this->addSql('ALTER TABLE garage_category_service ADD CONSTRAINT FK_B44D2A00C4FFF555 FOREIGN KEY (garage_id) REFERENCES garage (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `order` ADD cart_id INT NOT NULL, ADD payment_id INT NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993984C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993981AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_F52993981AD5CDBF ON `order` (cart_id)');
        $this->addSql('CREATE INDEX IDX_F52993984C3A3BB ON `order` (payment_id)');
        $this->addSql('DROP INDEX UNIQ_6D28840D2FC0CB0F ON payment');
        $this->addSql('ALTER TABLE payment DROP amount, DROP currency, DROP status, DROP transaction_id, DROP payment_gateway');
        $this->addSql('ALTER TABLE rental MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON rental');
        $this->addSql('ALTER TABLE rental ADD customer_id INT NOT NULL, CHANGE start_date start_date DATE NOT NULL, CHANGE end_date end_date DATE NOT NULL, CHANGE total_amount total_amount DOUBLE PRECISION NOT NULL, CHANGE id rental_id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE rental ADD PRIMARY KEY (rental_id)');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA239ED5CA9E6');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA23919EB6921');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA2394A4A3511');
        $this->addSql('DROP INDEX IDX_4DA2399A67DB00 ON reservations');
        $this->addSql('DROP INDEX IDX_4DA239ED5CA9E6 ON reservations');
        $this->addSql('DROP INDEX IDX_4DA23919EB6921 ON reservations');
        $this->addSql('DROP INDEX IDX_4DA2394A4A3511 ON reservations');
        $this->addSql('ALTER TABLE reservations ADD mecanique_id INT NOT NULL, ADD service_type VARCHAR(50) NOT NULL, DROP mechanic_id, DROP service_id, DROP vehicule_id');
        $this->addSql('ALTER TABLE sellers ADD shop_id INT NOT NULL, DROP role');
        $this->addSql('ALTER TABLE sellers ADD CONSTRAINT FK_AFFE6BEF4D16C4DD FOREIGN KEY (shop_id) REFERENCES shop (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_AFFE6BEF4D16C4DD ON sellers (shop_id)');
        $this->addSql('ALTER TABLE service_client ADD username VARCHAR(255) NOT NULL, DROP name, DROP email, DROP reset_token, DROP token_expiration, CHANGE password password VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE shop DROP FOREIGN KEY FK_AC6A4CA28DE820D9');
        $this->addSql('DROP INDEX IDX_AC6A4CA28DE820D9 ON shop');
        $this->addSql('ALTER TABLE shop DROP seller_id');
        $this->addSql('ALTER TABLE vehicules ADD service_id INT NOT NULL');
        $this->addSql('ALTER TABLE vehicules ADD CONSTRAINT FK_78218C2DED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_78218C2DED5CA9E6 ON vehicules (service_id)');
        $this->addSql('ALTER TABLE verified_client DROP FOREIGN KEY FK_E0855668C9C86E00');
    }
}
