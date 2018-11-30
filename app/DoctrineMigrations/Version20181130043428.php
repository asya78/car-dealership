<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181130043428 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sales DROP FOREIGN KEY FK_6B817044C3C6F69F');
        $this->addSql('ALTER TABLE sales ADD CONSTRAINT FK_6B817044C3C6F69F FOREIGN KEY (car_id) REFERENCES cars (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sales DROP FOREIGN KEY FK_6B817044C3C6F69F');
        $this->addSql('ALTER TABLE sales ADD CONSTRAINT FK_6B817044C3C6F69F FOREIGN KEY (car_id) REFERENCES sales (id)');
    }
}
