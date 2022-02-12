<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220212060940 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE "Provider" (id BIGINT NOT NULL AUTO_INCREMENT,
                                                    customer_id INT  NOT NULL,
                                                    login varchar(255)  NOT NULL,
                                                    password varchar(255)  NOT NULL,
                                                    sender varchar(255)  NOT NULL,
                                                    adapter varchar(255)  NOT NULL,
                                                    PRIMARY KEY(id))');

        $this->addSql('COMMENT ON COLUMN "Provider".customer_id IS \'(DC2Type:json_array)\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE "Provider"');
    }
}
