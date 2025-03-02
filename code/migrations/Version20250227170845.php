<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250227170845 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE verified_client DROP FOREIGN KEY FK_E0855668C9C86E00');
        $this->addSql('ALTER TABLE category_service DROP FOREIGN KEY FK_2645DAACDFFD48B5');
        $this->addSql('ALTER TABLE critiques DROP FOREIGN KEY FK_2712BED9DFFD48B5');
        $this->addSql('ALTER TABLE mechanics DROP FOREIGN KEY FK_32A6314DBF396750');
        $this->addSql('ALTER TABLE sellers DROP FOREIGN KEY FK_AFFE6BEFBF396750');
        $this->addSql('CREATE TABLE car_rental_services (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) DEFAULT NULL, garage_name VARCHAR(255) NOT NULL, garage_address VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, working_hours VARCHAR(255) NOT NULL, contact_info VARCHAR(255) NOT NULL, service_mail VARCHAR(255) NOT NULL, service_name VARCHAR(255) NOT NULL, service_location VARCHAR(255) NOT NULL, service_hours VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE garage_category_service (garage_id INT NOT NULL, category_service_id INT NOT NULL, INDEX IDX_B44D2A00C4FFF555 (garage_id), INDEX IDX_B44D2A00CB42F998 (category_service_id), PRIMARY KEY(garage_id, category_service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE garage_category_service ADD CONSTRAINT FK_B44D2A00C4FFF555 FOREIGN KEY (garage_id) REFERENCES garage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE garage_category_service ADD CONSTRAINT FK_B44D2A00CB42F998 FOREIGN KEY (category_service_id) REFERENCES category_service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE car_rental_service DROP FOREIGN KEY FK_FF02CE1DBF396750');
        $this->addSql('DROP TABLE car_rental_service');
        $this->addSql('DROP TABLE garagistes');
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D1419EB6921');
        $this->addSql('DROP INDEX IDX_95C71D1419EB6921 ON cars');
        $this->addSql('ALTER TABLE cars CHANGE client_id car_rental_service_id INT NOT NULL');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D14C9C86E00 FOREIGN KEY (car_rental_service_id) REFERENCES car_rental_services (id)');
        $this->addSql('CREATE INDEX IDX_95C71D14C9C86E00 ON cars (car_rental_service_id)');
        $this->addSql('ALTER TABLE cart ADD client_id INT NOT NULL');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B719EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)');
        $this->addSql('CREATE INDEX IDX_BA388B719EB6921 ON cart (client_id)');
        $this->addSql('ALTER TABLE category_service DROP FOREIGN KEY FK_2645DAACC4FFF555');
        $this->addSql('DROP INDEX IDX_2645DAACDFFD48B5 ON category_service');
        $this->addSql('DROP INDEX IDX_2645DAACC4FFF555 ON category_service');
        $this->addSql('ALTER TABLE category_service ADD mechanic_id INT NOT NULL, DROP garagiste_id, DROP garage_id');
        $this->addSql('ALTER TABLE category_service ADD CONSTRAINT FK_2645DAAC9A67DB00 FOREIGN KEY (mechanic_id) REFERENCES mechanics (id)');
        $this->addSql('CREATE INDEX IDX_2645DAAC9A67DB00 ON category_service (mechanic_id)');
        $this->addSql('ALTER TABLE clients ADD username VARCHAR(255) NOT NULL, ADD password VARCHAR(255) DEFAULT NULL, CHANGE address address VARCHAR(255) DEFAULT NULL, CHANGE name name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE comment ADD critique_id INT NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF24D1F1B FOREIGN KEY (critique_id) REFERENCES critiques (id)');
        $this->addSql('CREATE INDEX IDX_9474526CF24D1F1B ON comment (critique_id)');
        $this->addSql('ALTER TABLE critiques DROP FOREIGN KEY FK_2712BED9ED5CA9E6');
        $this->addSql('DROP INDEX IDX_2712BED9DFFD48B5 ON critiques');
        $this->addSql('ALTER TABLE critiques ADD mechanic_id INT NOT NULL, CHANGE garagiste_id garage_id INT NOT NULL');
        $this->addSql('ALTER TABLE critiques ADD CONSTRAINT FK_2712BED9C4FFF555 FOREIGN KEY (garage_id) REFERENCES garage (id)');
        $this->addSql('ALTER TABLE critiques ADD CONSTRAINT FK_2712BED99A67DB00 FOREIGN KEY (mechanic_id) REFERENCES mechanics (id)');
        $this->addSql('ALTER TABLE critiques ADD CONSTRAINT FK_2712BED9ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('CREATE INDEX IDX_2712BED9C4FFF555 ON critiques (garage_id)');
        $this->addSql('CREATE INDEX IDX_2712BED99A67DB00 ON critiques (mechanic_id)');
        $this->addSql('ALTER TABLE mechanics ADD username VARCHAR(255) NOT NULL, ADD password VARCHAR(255) DEFAULT NULL, ADD garage_name VARCHAR(255) NOT NULL, ADD garage_address VARCHAR(255) NOT NULL, ADD phone_number VARCHAR(255) NOT NULL, ADD working_hours VARCHAR(255) NOT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE product ADD order_id INT NOT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD8D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD8D9F6D38 ON product (order_id)');
        $this->addSql('ALTER TABLE reservations ADD vehicule_id INT NOT NULL');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA23919EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA2394A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicules (id)');
        $this->addSql('CREATE INDEX IDX_4DA23919EB6921 ON reservations (client_id)');
        $this->addSql('CREATE INDEX IDX_4DA2394A4A3511 ON reservations (vehicule_id)');
        $this->addSql('ALTER TABLE sellers ADD username VARCHAR(255) NOT NULL, ADD password VARCHAR(255) DEFAULT NULL, ADD garage_name VARCHAR(255) NOT NULL, ADD garage_address VARCHAR(255) NOT NULL, ADD phone_number VARCHAR(255) NOT NULL, ADD working_hours VARCHAR(255) NOT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE service_client CHANGE password password VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE verified_client DROP FOREIGN KEY FK_E0855668C9C86E00');
        $this->addSql('ALTER TABLE verified_client ADD CONSTRAINT FK_E0855668C9C86E00 FOREIGN KEY (car_rental_service_id) REFERENCES car_rental_services (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D14C9C86E00');
        $this->addSql('ALTER TABLE verified_client DROP FOREIGN KEY FK_E0855668C9C86E00');
        $this->addSql('CREATE TABLE car_rental_service (id INT NOT NULL, contact_info VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, service_mail VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, service_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, service_location VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, service_hours VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE garagistes (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, garage_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, garage_address VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, phone_number VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, working_hours VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE car_rental_service ADD CONSTRAINT FK_FF02CE1DBF396750 FOREIGN KEY (id) REFERENCES garagistes (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE garage_category_service DROP FOREIGN KEY FK_B44D2A00C4FFF555');
        $this->addSql('ALTER TABLE garage_category_service DROP FOREIGN KEY FK_B44D2A00CB42F998');
        $this->addSql('DROP TABLE car_rental_services');
        $this->addSql('DROP TABLE garage_category_service');
        $this->addSql('DROP INDEX IDX_95C71D14C9C86E00 ON cars');
        $this->addSql('ALTER TABLE cars CHANGE car_rental_service_id client_id INT NOT NULL');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D1419EB6921 FOREIGN KEY (client_id) REFERENCES clients (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_95C71D1419EB6921 ON cars (client_id)');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B719EB6921');
        $this->addSql('DROP INDEX IDX_BA388B719EB6921 ON cart');
        $this->addSql('ALTER TABLE cart DROP client_id');
        $this->addSql('ALTER TABLE category_service DROP FOREIGN KEY FK_2645DAAC9A67DB00');
        $this->addSql('DROP INDEX IDX_2645DAAC9A67DB00 ON category_service');
        $this->addSql('ALTER TABLE category_service ADD garage_id INT NOT NULL, CHANGE mechanic_id garagiste_id INT NOT NULL');
        $this->addSql('ALTER TABLE category_service ADD CONSTRAINT FK_2645DAACDFFD48B5 FOREIGN KEY (garagiste_id) REFERENCES garagistes (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE category_service ADD CONSTRAINT FK_2645DAACC4FFF555 FOREIGN KEY (garage_id) REFERENCES garage (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_2645DAACDFFD48B5 ON category_service (garagiste_id)');
        $this->addSql('CREATE INDEX IDX_2645DAACC4FFF555 ON category_service (garage_id)');
        $this->addSql('ALTER TABLE clients DROP username, DROP password, CHANGE address address VARCHAR(255) NOT NULL, CHANGE name name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CF24D1F1B');
        $this->addSql('DROP INDEX IDX_9474526CF24D1F1B ON comment');
        $this->addSql('ALTER TABLE comment DROP critique_id');
        $this->addSql('ALTER TABLE critiques DROP FOREIGN KEY FK_2712BED9C4FFF555');
        $this->addSql('ALTER TABLE critiques DROP FOREIGN KEY FK_2712BED99A67DB00');
        $this->addSql('ALTER TABLE critiques DROP FOREIGN KEY FK_2712BED9ED5CA9E6');
        $this->addSql('DROP INDEX IDX_2712BED9C4FFF555 ON critiques');
        $this->addSql('DROP INDEX IDX_2712BED99A67DB00 ON critiques');
        $this->addSql('ALTER TABLE critiques ADD garagiste_id INT NOT NULL, DROP garage_id, DROP mechanic_id');
        $this->addSql('ALTER TABLE critiques ADD CONSTRAINT FK_2712BED9DFFD48B5 FOREIGN KEY (garagiste_id) REFERENCES garagistes (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE critiques ADD CONSTRAINT FK_2712BED9ED5CA9E6 FOREIGN KEY (service_id) REFERENCES garage (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_2712BED9DFFD48B5 ON critiques (garagiste_id)');
        $this->addSql('ALTER TABLE mechanics DROP username, DROP password, DROP garage_name, DROP garage_address, DROP phone_number, DROP working_hours, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE mechanics ADD CONSTRAINT FK_32A6314DBF396750 FOREIGN KEY (id) REFERENCES garagistes (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD8D9F6D38');
        $this->addSql('DROP INDEX IDX_D34A04AD8D9F6D38 ON product');
        $this->addSql('ALTER TABLE product DROP order_id');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA23919EB6921');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA2394A4A3511');
        $this->addSql('DROP INDEX IDX_4DA23919EB6921 ON reservations');
        $this->addSql('DROP INDEX IDX_4DA2394A4A3511 ON reservations');
        $this->addSql('ALTER TABLE reservations DROP vehicule_id');
        $this->addSql('ALTER TABLE sellers DROP username, DROP password, DROP garage_name, DROP garage_address, DROP phone_number, DROP working_hours, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE sellers ADD CONSTRAINT FK_AFFE6BEFBF396750 FOREIGN KEY (id) REFERENCES garagistes (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_client CHANGE password password VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE verified_client DROP FOREIGN KEY FK_E0855668C9C86E00');
        $this->addSql('ALTER TABLE verified_client ADD CONSTRAINT FK_E0855668C9C86E00 FOREIGN KEY (car_rental_service_id) REFERENCES car_rental_service (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
