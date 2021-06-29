<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210629165259 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE campervan (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, is_rent TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE portable_equipment (id INT AUTO_INCREMENT NOT NULL, station_id INT DEFAULT NULL, count INT NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_C17A103A21BDB235 (station_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rental_order (id INT AUTO_INCREMENT NOT NULL, pick_up_station_id INT DEFAULT NULL, return_station_id INT DEFAULT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, INDEX IDX_6EC21D77EB1C9017 (pick_up_station_id), INDEX IDX_6EC21D77EA291807 (return_station_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders_vans (rental_order_id INT NOT NULL, van_id INT NOT NULL, INDEX IDX_BAA2264FBDF9740B (rental_order_id), INDEX IDX_BAA2264F8A128D90 (van_id), PRIMARY KEY(rental_order_id, van_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rental_orders_equipments (rental_order_id INT NOT NULL, equipment_id INT NOT NULL, INDEX IDX_92FA94A6BDF9740B (rental_order_id), INDEX IDX_92FA94A6517FE9FE (equipment_id), PRIMARY KEY(rental_order_id, equipment_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stations (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE portable_equipment ADD CONSTRAINT FK_C17A103A21BDB235 FOREIGN KEY (station_id) REFERENCES stations (id)');
        $this->addSql('ALTER TABLE rental_order ADD CONSTRAINT FK_6EC21D77EB1C9017 FOREIGN KEY (pick_up_station_id) REFERENCES stations (id)');
        $this->addSql('ALTER TABLE rental_order ADD CONSTRAINT FK_6EC21D77EA291807 FOREIGN KEY (return_station_id) REFERENCES stations (id)');
        $this->addSql('ALTER TABLE orders_vans ADD CONSTRAINT FK_BAA2264FBDF9740B FOREIGN KEY (rental_order_id) REFERENCES rental_order (id)');
        $this->addSql('ALTER TABLE orders_vans ADD CONSTRAINT FK_BAA2264F8A128D90 FOREIGN KEY (van_id) REFERENCES campervan (id)');
        $this->addSql('ALTER TABLE rental_orders_equipments ADD CONSTRAINT FK_92FA94A6BDF9740B FOREIGN KEY (rental_order_id) REFERENCES rental_order (id)');
        $this->addSql('ALTER TABLE rental_orders_equipments ADD CONSTRAINT FK_92FA94A6517FE9FE FOREIGN KEY (equipment_id) REFERENCES portable_equipment (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders_vans DROP FOREIGN KEY FK_BAA2264F8A128D90');
        $this->addSql('ALTER TABLE rental_orders_equipments DROP FOREIGN KEY FK_92FA94A6517FE9FE');
        $this->addSql('ALTER TABLE orders_vans DROP FOREIGN KEY FK_BAA2264FBDF9740B');
        $this->addSql('ALTER TABLE rental_orders_equipments DROP FOREIGN KEY FK_92FA94A6BDF9740B');
        $this->addSql('ALTER TABLE portable_equipment DROP FOREIGN KEY FK_C17A103A21BDB235');
        $this->addSql('ALTER TABLE rental_order DROP FOREIGN KEY FK_6EC21D77EB1C9017');
        $this->addSql('ALTER TABLE rental_order DROP FOREIGN KEY FK_6EC21D77EA291807');
        $this->addSql('DROP TABLE campervan');
        $this->addSql('DROP TABLE portable_equipment');
        $this->addSql('DROP TABLE rental_order');
        $this->addSql('DROP TABLE orders_vans');
        $this->addSql('DROP TABLE rental_orders_equipments');
        $this->addSql('DROP TABLE stations');
    }
}
