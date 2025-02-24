<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250224232907 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE garage_category_service (garage_id INT NOT NULL, category_service_id INT NOT NULL, INDEX IDX_B44D2A00C4FFF555 (garage_id), INDEX IDX_B44D2A00CB42F998 (category_service_id), PRIMARY KEY(garage_id, category_service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE garage_category_service ADD CONSTRAINT FK_B44D2A00C4FFF555 FOREIGN KEY (garage_id) REFERENCES garage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE garage_category_service ADD CONSTRAINT FK_B44D2A00CB42F998 FOREIGN KEY (category_service_id) REFERENCES category_service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D1419EB6921');
        $this->addSql('DROP INDEX IDX_95C71D1419EB6921 ON cars');
        $this->addSql('ALTER TABLE cars CHANGE client_id car_rental_service_id INT NOT NULL');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D14C9C86E00 FOREIGN KEY (car_rental_service_id) REFERENCES car_rental_services (id)');
        $this->addSql('CREATE INDEX IDX_95C71D14C9C86E00 ON cars (car_rental_service_id)');
        $this->addSql('ALTER TABLE cart ADD client_id INT NOT NULL');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B719EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)');
        $this->addSql('CREATE INDEX IDX_BA388B719EB6921 ON cart (client_id)');
        $this->addSql('ALTER TABLE category_service DROP FOREIGN KEY FK_2645DAACC4FFF555');
        $this->addSql('DROP INDEX IDX_2645DAACC4FFF555 ON category_service');
        $this->addSql('ALTER TABLE category_service DROP garage_id');
        $this->addSql('ALTER TABLE comment ADD critique_id INT NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF24D1F1B FOREIGN KEY (critique_id) REFERENCES critiques (id)');
        $this->addSql('CREATE INDEX IDX_9474526CF24D1F1B ON comment (critique_id)');
        $this->addSql('ALTER TABLE critiques DROP FOREIGN KEY FK_2712BED9ED5CA9E6');
        $this->addSql('ALTER TABLE critiques ADD garage_id INT NOT NULL');
        $this->addSql('ALTER TABLE critiques ADD CONSTRAINT FK_2712BED9C4FFF555 FOREIGN KEY (garage_id) REFERENCES garage (id)');
        $this->addSql('ALTER TABLE critiques ADD CONSTRAINT FK_2712BED9ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('CREATE INDEX IDX_2712BED9C4FFF555 ON critiques (garage_id)');
        $this->addSql('ALTER TABLE product ADD order_id INT NOT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD8D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD8D9F6D38 ON product (order_id)');
        $this->addSql('ALTER TABLE reservations ADD vehicule_id INT NOT NULL');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA23919EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA2394A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicules (id)');
        $this->addSql('CREATE INDEX IDX_4DA23919EB6921 ON reservations (client_id)');
        $this->addSql('CREATE INDEX IDX_4DA2394A4A3511 ON reservations (vehicule_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE garage_category_service DROP FOREIGN KEY FK_B44D2A00C4FFF555');
        $this->addSql('ALTER TABLE garage_category_service DROP FOREIGN KEY FK_B44D2A00CB42F998');
        $this->addSql('DROP TABLE garage_category_service');
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D14C9C86E00');
        $this->addSql('DROP INDEX IDX_95C71D14C9C86E00 ON cars');
        $this->addSql('ALTER TABLE cars CHANGE car_rental_service_id client_id INT NOT NULL');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D1419EB6921 FOREIGN KEY (client_id) REFERENCES clients (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_95C71D1419EB6921 ON cars (client_id)');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B719EB6921');
        $this->addSql('DROP INDEX IDX_BA388B719EB6921 ON cart');
        $this->addSql('ALTER TABLE cart DROP client_id');
        $this->addSql('ALTER TABLE category_service ADD garage_id INT NOT NULL');
        $this->addSql('ALTER TABLE category_service ADD CONSTRAINT FK_2645DAACC4FFF555 FOREIGN KEY (garage_id) REFERENCES garage (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_2645DAACC4FFF555 ON category_service (garage_id)');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CF24D1F1B');
        $this->addSql('DROP INDEX IDX_9474526CF24D1F1B ON comment');
        $this->addSql('ALTER TABLE comment DROP critique_id');
        $this->addSql('ALTER TABLE critiques DROP FOREIGN KEY FK_2712BED9C4FFF555');
        $this->addSql('ALTER TABLE critiques DROP FOREIGN KEY FK_2712BED9ED5CA9E6');
        $this->addSql('DROP INDEX IDX_2712BED9C4FFF555 ON critiques');
        $this->addSql('ALTER TABLE critiques DROP garage_id');
        $this->addSql('ALTER TABLE critiques ADD CONSTRAINT FK_2712BED9ED5CA9E6 FOREIGN KEY (service_id) REFERENCES garage (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD8D9F6D38');
        $this->addSql('DROP INDEX IDX_D34A04AD8D9F6D38 ON product');
        $this->addSql('ALTER TABLE product DROP order_id');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA23919EB6921');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA2394A4A3511');
        $this->addSql('DROP INDEX IDX_4DA23919EB6921 ON reservations');
        $this->addSql('DROP INDEX IDX_4DA2394A4A3511 ON reservations');
        $this->addSql('ALTER TABLE reservations DROP vehicule_id');
    }
}
