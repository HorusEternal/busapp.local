<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241019184445 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bus (id SERIAL NOT NULL, route_id INT DEFAULT NULL, number INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2F566B6934ECB4E6 ON bus (route_id)');
        $this->addSql('CREATE TABLE route (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, direction VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE route_stop (route_id INT NOT NULL, stop_id INT NOT NULL, PRIMARY KEY(route_id, stop_id))');
        $this->addSql('CREATE INDEX IDX_1413173334ECB4E6 ON route_stop (route_id)');
        $this->addSql('CREATE INDEX IDX_141317333902063D ON route_stop (stop_id)');
        $this->addSql('CREATE TABLE schedule (id SERIAL NOT NULL, bus_id INT DEFAULT NULL, arrival_times JSON NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5A3811FB2546731D ON schedule (bus_id)');
        $this->addSql('CREATE TABLE stop (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE bus ADD CONSTRAINT FK_2F566B6934ECB4E6 FOREIGN KEY (route_id) REFERENCES route (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE route_stop ADD CONSTRAINT FK_1413173334ECB4E6 FOREIGN KEY (route_id) REFERENCES route (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE route_stop ADD CONSTRAINT FK_141317333902063D FOREIGN KEY (stop_id) REFERENCES stop (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE schedule ADD CONSTRAINT FK_5A3811FB2546731D FOREIGN KEY (bus_id) REFERENCES bus (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE bus DROP CONSTRAINT FK_2F566B6934ECB4E6');
        $this->addSql('ALTER TABLE route_stop DROP CONSTRAINT FK_1413173334ECB4E6');
        $this->addSql('ALTER TABLE route_stop DROP CONSTRAINT FK_141317333902063D');
        $this->addSql('ALTER TABLE schedule DROP CONSTRAINT FK_5A3811FB2546731D');
        $this->addSql('DROP TABLE bus');
        $this->addSql('DROP TABLE route');
        $this->addSql('DROP TABLE route_stop');
        $this->addSql('DROP TABLE schedule');
        $this->addSql('DROP TABLE stop');
    }
}
