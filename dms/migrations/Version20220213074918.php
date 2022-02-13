<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220213074918 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE "User" (id SERIAL PRIMARY KEY,
                                                    login varchar(255)  NOT NULL,
                                                    password varchar(255)  NOT NULL,
                                                    roles TEXT  NOT NULL)');

        $this->addSql('COMMENT ON COLUMN "User".roles IS \'(serialize)\'');

    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE "User"');

    }
}
