<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250302224333 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `admin` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, password VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, reset_token VARCHAR(255) DEFAULT NULL, token_expiration DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE car_rental_services (id INT NOT NULL, contact_info VARCHAR(255) NOT NULL, service_mail VARCHAR(255) NOT NULL, service_name VARCHAR(255) NOT NULL, service_hours VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cars (id INT AUTO_INCREMENT NOT NULL, car_rental_service_id INT NOT NULL, model VARCHAR(255) NOT NULL, brand VARCHAR(255) NOT NULL, status TINYINT(1) NOT NULL, daily_rate DOUBLE PRECISION NOT NULL, INDEX IDX_95C71D14C9C86E00 (car_rental_service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, total_amount DOUBLE PRECISION NOT NULL, INDEX IDX_BA388B719EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, shop_id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_64C19C14D16C4DD (shop_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_service (id INT AUTO_INCREMENT NOT NULL, mechanic_id INT NOT NULL, category_description VARCHAR(255) NOT NULL, status VARCHAR(20) NOT NULL, INDEX IDX_2645DAAC9A67DB00 (mechanic_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clients (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, password VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, reset_token VARCHAR(255) DEFAULT NULL, token_expiration DATETIME DEFAULT NULL, verification_status TINYINT(1) NOT NULL, date_inscription DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', loyalty_points INT NOT NULL, username VARCHAR(255) DEFAULT NULL, discr VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, critique_id INT NOT NULL, content LONGTEXT NOT NULL, INDEX IDX_9474526CF24D1F1B (critique_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE complaint (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, service_client_id INT NOT NULL, description LONGTEXT NOT NULL, service VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', status VARCHAR(50) NOT NULL, INDEX IDX_5F2732B519EB6921 (client_id), INDEX IDX_5F2732B5417A536B (service_client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE critiques (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, reservation_id INT NOT NULL, garage_id INT NOT NULL, mechanic_id INT NOT NULL, service_id INT NOT NULL, rating INT NOT NULL, content LONGTEXT NOT NULL, date DATETIME NOT NULL, INDEX IDX_2712BED919EB6921 (client_id), INDEX IDX_2712BED9B83297E7 (reservation_id), INDEX IDX_2712BED9C4FFF555 (garage_id), INDEX IDX_2712BED99A67DB00 (mechanic_id), INDEX IDX_2712BED9ED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE delivery (id INT AUTO_INCREMENT NOT NULL, address VARCHAR(255) NOT NULL, delivery_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE garages (id INT AUTO_INCREMENT NOT NULL, mechanic_id INT NOT NULL, rating DOUBLE PRECISION NOT NULL, status VARCHAR(20) NOT NULL, name VARCHAR(255) NOT NULL, location VARCHAR(255) NOT NULL, INDEX IDX_8C4330E29A67DB00 (mechanic_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE garage_category_service (garage_id INT NOT NULL, category_service_id INT NOT NULL, INDEX IDX_B44D2A00C4FFF555 (garage_id), INDEX IDX_B44D2A00CB42F998 (category_service_id), PRIMARY KEY(garage_id, category_service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE garagistes (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, password VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, reset_token VARCHAR(255) DEFAULT NULL, token_expiration DATETIME DEFAULT NULL, garage_name VARCHAR(255) DEFAULT NULL, garage_address VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(20) DEFAULT NULL, working_hours VARCHAR(255) DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL, discr VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, address VARCHAR(255) NOT NULL, longitude DOUBLE PRECISION NOT NULL, latitude DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mechanic (id INT NOT NULL, location_id INT NOT NULL, role_id INT NOT NULL, status VARCHAR(20) NOT NULL, telephone_garage VARCHAR(15) NOT NULL, garage_email VARCHAR(255) NOT NULL, INDEX IDX_7137DE7964D218E (location_id), INDEX IDX_7137DE79D60322AC (role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, delivery_id INT NOT NULL, status VARCHAR(255) NOT NULL, order_date DATETIME NOT NULL, delivery_date DATETIME DEFAULT NULL, INDEX IDX_F529939812136921 (delivery_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment (id INT AUTO_INCREMENT NOT NULL, method VARCHAR(255) NOT NULL, payment_date DATETIME NOT NULL, amount NUMERIC(10, 2) NOT NULL, currency VARCHAR(3) NOT NULL, status VARCHAR(255) NOT NULL, transaction_id VARCHAR(255) NOT NULL, payment_gateway VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_6D28840D2FC0CB0F (transaction_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (product_id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, cart_id INT NOT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, description VARCHAR(255) NOT NULL, stock_quantity INT NOT NULL, INDEX IDX_D34A04AD12469DE2 (category_id), INDEX IDX_D34A04AD1AD5CDBF (cart_id), PRIMARY KEY(product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rental (id INT AUTO_INCREMENT NOT NULL, car_id INT NOT NULL, cart_id INT NOT NULL, verified_client_id INT NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, total_amount NUMERIC(10, 2) NOT NULL, INDEX IDX_1619C27DC3C6F69F (car_id), INDEX IDX_1619C27D1AD5CDBF (cart_id), INDEX IDX_1619C27D51B6D235 (verified_client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE repair_part (id INT AUTO_INCREMENT NOT NULL, reservation_id INT NOT NULL, part_name VARCHAR(100) NOT NULL, price NUMERIC(10, 2) NOT NULL, INDEX IDX_9C29A426B83297E7 (reservation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservations (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, mechanic_id INT NOT NULL, service_id INT NOT NULL, car_id INT NOT NULL, vehicule_id INT NOT NULL, date_reservation DATETIME NOT NULL, status VARCHAR(20) NOT NULL, prix_estime NUMERIC(10, 2) NOT NULL, notes LONGTEXT DEFAULT NULL, INDEX IDX_4DA2399A67DB00 (mechanic_id), INDEX IDX_4DA239ED5CA9E6 (service_id), INDEX IDX_4DA239C3C6F69F (car_id), INDEX IDX_4DA23919EB6921 (client_id), INDEX IDX_4DA2394A4A3511 (vehicule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, content LONGTEXT NOT NULL, rating INT NOT NULL, INDEX IDX_794381C619EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE roles (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sellers (id INT NOT NULL, contact_info VARCHAR(255) NOT NULL, shop_name VARCHAR(255) NOT NULL, shop_email VARCHAR(255) NOT NULL, shop_phone VARCHAR(15) NOT NULL, role VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, category_service_id INT NOT NULL, service_name VARCHAR(100) NOT NULL, prix NUMERIC(10, 2) NOT NULL, description LONGTEXT DEFAULT NULL, status VARCHAR(20) NOT NULL, INDEX IDX_E19D9AD2CB42F998 (category_service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service_client (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, password VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, reset_token VARCHAR(255) DEFAULT NULL, token_expiration DATETIME DEFAULT NULL, service_details VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shop (id INT AUTO_INCREMENT NOT NULL, seller_id INT NOT NULL, name VARCHAR(255) NOT NULL, location VARCHAR(255) NOT NULL, INDEX IDX_AC6A4CA28DE820D9 (seller_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicules (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, model VARCHAR(255) NOT NULL, brand VARCHAR(255) NOT NULL, INDEX IDX_78218C2D19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE verified_client (id INT NOT NULL, car_rental_service_id INT NOT NULL, cin VARCHAR(20) NOT NULL, drivers_license VARCHAR(20) NOT NULL, credit_card_credentials VARCHAR(255) NOT NULL, INDEX IDX_E0855668C9C86E00 (car_rental_service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE car_rental_services ADD CONSTRAINT FK_78F7A11CBF396750 FOREIGN KEY (id) REFERENCES garagistes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D14C9C86E00 FOREIGN KEY (car_rental_service_id) REFERENCES car_rental_services (id)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B719EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C14D16C4DD FOREIGN KEY (shop_id) REFERENCES shop (id)');
        $this->addSql('ALTER TABLE category_service ADD CONSTRAINT FK_2645DAAC9A67DB00 FOREIGN KEY (mechanic_id) REFERENCES mechanic (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF24D1F1B FOREIGN KEY (critique_id) REFERENCES critiques (id)');
        $this->addSql('ALTER TABLE complaint ADD CONSTRAINT FK_5F2732B519EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)');
        $this->addSql('ALTER TABLE complaint ADD CONSTRAINT FK_5F2732B5417A536B FOREIGN KEY (service_client_id) REFERENCES service_client (id)');
        $this->addSql('ALTER TABLE critiques ADD CONSTRAINT FK_2712BED919EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)');
        $this->addSql('ALTER TABLE critiques ADD CONSTRAINT FK_2712BED9B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservations (id)');
        $this->addSql('ALTER TABLE critiques ADD CONSTRAINT FK_2712BED9C4FFF555 FOREIGN KEY (garage_id) REFERENCES garages (id)');
        $this->addSql('ALTER TABLE critiques ADD CONSTRAINT FK_2712BED99A67DB00 FOREIGN KEY (mechanic_id) REFERENCES mechanic (id)');
        $this->addSql('ALTER TABLE critiques ADD CONSTRAINT FK_2712BED9ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE garages ADD CONSTRAINT FK_8C4330E29A67DB00 FOREIGN KEY (mechanic_id) REFERENCES mechanic (id)');
        $this->addSql('ALTER TABLE garage_category_service ADD CONSTRAINT FK_B44D2A00C4FFF555 FOREIGN KEY (garage_id) REFERENCES garages (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE garage_category_service ADD CONSTRAINT FK_B44D2A00CB42F998 FOREIGN KEY (category_service_id) REFERENCES category_service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mechanic ADD CONSTRAINT FK_7137DE7964D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE mechanic ADD CONSTRAINT FK_7137DE79D60322AC FOREIGN KEY (role_id) REFERENCES roles (id)');
        $this->addSql('ALTER TABLE mechanic ADD CONSTRAINT FK_7137DE79BF396750 FOREIGN KEY (id) REFERENCES garagistes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939812136921 FOREIGN KEY (delivery_id) REFERENCES delivery (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD1AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id)');
        $this->addSql('ALTER TABLE rental ADD CONSTRAINT FK_1619C27DC3C6F69F FOREIGN KEY (car_id) REFERENCES cars (id)');
        $this->addSql('ALTER TABLE rental ADD CONSTRAINT FK_1619C27D1AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id)');
        $this->addSql('ALTER TABLE rental ADD CONSTRAINT FK_1619C27D51B6D235 FOREIGN KEY (verified_client_id) REFERENCES verified_client (id)');
        $this->addSql('ALTER TABLE repair_part ADD CONSTRAINT FK_9C29A426B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservations (id)');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA2399A67DB00 FOREIGN KEY (mechanic_id) REFERENCES mechanic (id)');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA239ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA239C3C6F69F FOREIGN KEY (car_id) REFERENCES cars (id)');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA23919EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA2394A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicules (id)');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C619EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)');
        $this->addSql('ALTER TABLE sellers ADD CONSTRAINT FK_AFFE6BEFBF396750 FOREIGN KEY (id) REFERENCES garagistes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2CB42F998 FOREIGN KEY (category_service_id) REFERENCES category_service (id)');
        $this->addSql('ALTER TABLE shop ADD CONSTRAINT FK_AC6A4CA28DE820D9 FOREIGN KEY (seller_id) REFERENCES sellers (id)');
        $this->addSql('ALTER TABLE vehicules ADD CONSTRAINT FK_78218C2D19EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)');
        $this->addSql('ALTER TABLE verified_client ADD CONSTRAINT FK_E0855668C9C86E00 FOREIGN KEY (car_rental_service_id) REFERENCES car_rental_services (id)');
        $this->addSql('ALTER TABLE verified_client ADD CONSTRAINT FK_E0855668BF396750 FOREIGN KEY (id) REFERENCES clients (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car_rental_services DROP FOREIGN KEY FK_78F7A11CBF396750');
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D14C9C86E00');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B719EB6921');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C14D16C4DD');
        $this->addSql('ALTER TABLE category_service DROP FOREIGN KEY FK_2645DAAC9A67DB00');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CF24D1F1B');
        $this->addSql('ALTER TABLE complaint DROP FOREIGN KEY FK_5F2732B519EB6921');
        $this->addSql('ALTER TABLE complaint DROP FOREIGN KEY FK_5F2732B5417A536B');
        $this->addSql('ALTER TABLE critiques DROP FOREIGN KEY FK_2712BED919EB6921');
        $this->addSql('ALTER TABLE critiques DROP FOREIGN KEY FK_2712BED9B83297E7');
        $this->addSql('ALTER TABLE critiques DROP FOREIGN KEY FK_2712BED9C4FFF555');
        $this->addSql('ALTER TABLE critiques DROP FOREIGN KEY FK_2712BED99A67DB00');
        $this->addSql('ALTER TABLE critiques DROP FOREIGN KEY FK_2712BED9ED5CA9E6');
        $this->addSql('ALTER TABLE garages DROP FOREIGN KEY FK_8C4330E29A67DB00');
        $this->addSql('ALTER TABLE garage_category_service DROP FOREIGN KEY FK_B44D2A00C4FFF555');
        $this->addSql('ALTER TABLE garage_category_service DROP FOREIGN KEY FK_B44D2A00CB42F998');
        $this->addSql('ALTER TABLE mechanic DROP FOREIGN KEY FK_7137DE7964D218E');
        $this->addSql('ALTER TABLE mechanic DROP FOREIGN KEY FK_7137DE79D60322AC');
        $this->addSql('ALTER TABLE mechanic DROP FOREIGN KEY FK_7137DE79BF396750');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939812136921');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD1AD5CDBF');
        $this->addSql('ALTER TABLE rental DROP FOREIGN KEY FK_1619C27DC3C6F69F');
        $this->addSql('ALTER TABLE rental DROP FOREIGN KEY FK_1619C27D1AD5CDBF');
        $this->addSql('ALTER TABLE rental DROP FOREIGN KEY FK_1619C27D51B6D235');
        $this->addSql('ALTER TABLE repair_part DROP FOREIGN KEY FK_9C29A426B83297E7');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA2399A67DB00');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA239ED5CA9E6');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA239C3C6F69F');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA23919EB6921');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA2394A4A3511');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C619EB6921');
        $this->addSql('ALTER TABLE sellers DROP FOREIGN KEY FK_AFFE6BEFBF396750');
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD2CB42F998');
        $this->addSql('ALTER TABLE shop DROP FOREIGN KEY FK_AC6A4CA28DE820D9');
        $this->addSql('ALTER TABLE vehicules DROP FOREIGN KEY FK_78218C2D19EB6921');
        $this->addSql('ALTER TABLE verified_client DROP FOREIGN KEY FK_E0855668C9C86E00');
        $this->addSql('ALTER TABLE verified_client DROP FOREIGN KEY FK_E0855668BF396750');
        $this->addSql('DROP TABLE `admin`');
        $this->addSql('DROP TABLE car_rental_services');
        $this->addSql('DROP TABLE cars');
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE category_service');
        $this->addSql('DROP TABLE clients');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE complaint');
        $this->addSql('DROP TABLE critiques');
        $this->addSql('DROP TABLE delivery');
        $this->addSql('DROP TABLE garages');
        $this->addSql('DROP TABLE garage_category_service');
        $this->addSql('DROP TABLE garagistes');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE mechanic');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE rental');
        $this->addSql('DROP TABLE repair_part');
        $this->addSql('DROP TABLE reservations');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE sellers');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE service_client');
        $this->addSql('DROP TABLE shop');
        $this->addSql('DROP TABLE vehicules');
        $this->addSql('DROP TABLE verified_client');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
