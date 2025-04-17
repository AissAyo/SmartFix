<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250411082242 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE aire (id INT AUTO_INCREMENT NOT NULL, ville_id INT NOT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_C5093176A73F0036 (ville_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE passager (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE reservation_aire (id INT AUTO_INCREMENT NOT NULL, passager_id INT NOT NULL, aire_id INT NOT NULL, INDEX IDX_D330FC1E71A51189 (passager_id), INDEX IDX_D330FC1E89BC6E01 (aire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE reservation_voiture (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE voiture (id INT AUTO_INCREMENT NOT NULL, passager_id INT NOT NULL, INDEX IDX_E9E2810F71A51189 (passager_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE aire ADD CONSTRAINT FK_C5093176A73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_aire ADD CONSTRAINT FK_D330FC1E71A51189 FOREIGN KEY (passager_id) REFERENCES passager (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_aire ADD CONSTRAINT FK_D330FC1E89BC6E01 FOREIGN KEY (aire_id) REFERENCES aire (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810F71A51189 FOREIGN KEY (passager_id) REFERENCES passager (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE aire DROP FOREIGN KEY FK_C5093176A73F0036
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_aire DROP FOREIGN KEY FK_D330FC1E71A51189
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation_aire DROP FOREIGN KEY FK_D330FC1E89BC6E01
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810F71A51189
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE aire
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE passager
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE reservation_aire
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE reservation_voiture
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE ville
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE voiture
        SQL);
    }
}
