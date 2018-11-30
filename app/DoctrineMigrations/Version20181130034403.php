<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181130034403 extends AbstractMigration
{
    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Migrations\AbortMigrationException
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cars_parts (car_id INT NOT NULL, part_id INT NOT NULL, INDEX IDX_F30DF478C3C6F69F (car_id), INDEX IDX_F30DF4784CE34BEC (part_id), PRIMARY KEY(car_id, part_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE part_car (part_id INT NOT NULL, car_id INT NOT NULL, INDEX IDX_B519C3164CE34BEC (part_id), INDEX IDX_B519C316C3C6F69F (car_id), PRIMARY KEY(part_id, car_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cars_parts ADD CONSTRAINT FK_F30DF478C3C6F69F FOREIGN KEY (car_id) REFERENCES cars (id)');
        $this->addSql('ALTER TABLE cars_parts ADD CONSTRAINT FK_F30DF4784CE34BEC FOREIGN KEY (part_id) REFERENCES parts (id)');
        $this->addSql('ALTER TABLE part_car ADD CONSTRAINT FK_B519C3164CE34BEC FOREIGN KEY (part_id) REFERENCES parts (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE part_car ADD CONSTRAINT FK_B519C316C3C6F69F FOREIGN KEY (car_id) REFERENCES cars (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Migrations\AbortMigrationException
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE cars_parts');
        $this->addSql('DROP TABLE part_car');
    }
}
