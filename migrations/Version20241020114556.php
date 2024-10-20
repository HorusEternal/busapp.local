<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241020114556 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bus (id SERIAL NOT NULL, route_id INT DEFAULT NULL, number VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2F566B6934ECB4E6 ON bus (route_id)');
        $this->addSql('CREATE TABLE route (id SERIAL NOT NULL, direction VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE schedule (id SERIAL NOT NULL, bus_id INT DEFAULT NULL, from_id INT DEFAULT NULL, to_id INT DEFAULT NULL, arrival_times JSON NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5A3811FB2546731D ON schedule (bus_id)');
        $this->addSql('CREATE INDEX IDX_5A3811FB78CED90B ON schedule (from_id)');
        $this->addSql('CREATE INDEX IDX_5A3811FB30354A65 ON schedule (to_id)');
        $this->addSql('CREATE TABLE stop (id SERIAL NOT NULL, route_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B95616B634ECB4E6 ON stop (route_id)');
        $this->addSql('ALTER TABLE bus ADD CONSTRAINT FK_2F566B6934ECB4E6 FOREIGN KEY (route_id) REFERENCES route (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE schedule ADD CONSTRAINT FK_5A3811FB2546731D FOREIGN KEY (bus_id) REFERENCES bus (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE schedule ADD CONSTRAINT FK_5A3811FB78CED90B FOREIGN KEY (from_id) REFERENCES stop (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE schedule ADD CONSTRAINT FK_5A3811FB30354A65 FOREIGN KEY (to_id) REFERENCES stop (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE stop ADD CONSTRAINT FK_B95616B634ECB4E6 FOREIGN KEY (route_id) REFERENCES route (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE bus DROP CONSTRAINT FK_2F566B6934ECB4E6');
        $this->addSql('ALTER TABLE schedule DROP CONSTRAINT FK_5A3811FB2546731D');
        $this->addSql('ALTER TABLE schedule DROP CONSTRAINT FK_5A3811FB78CED90B');
        $this->addSql('ALTER TABLE schedule DROP CONSTRAINT FK_5A3811FB30354A65');
        $this->addSql('ALTER TABLE stop DROP CONSTRAINT FK_B95616B634ECB4E6');
        $this->addSql('DROP TABLE bus');
        $this->addSql('DROP TABLE route');
        $this->addSql('DROP TABLE schedule');
        $this->addSql('DROP TABLE stop');
    }
}
