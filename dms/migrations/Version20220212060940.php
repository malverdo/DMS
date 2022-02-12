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
        $this->addSql('CREATE TABLE "Provider" (id BIGINT NOT NULL,
                                                    customerId TEXT  NOT NULL,
                                                    login TEXT  NOT NULL,
                                                    password TEXT  NOT NULL,
                                                    sender TEXT  NOT NULL,
                                                    adapter TEXT  NOT NULL,
                                                    PRIMARY KEY(id))');

        $this->addSql('COMMENT ON COLUMN "Provider".customerId IS \'(DC2Type:json_array)\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE "Provider"');

    }
}
