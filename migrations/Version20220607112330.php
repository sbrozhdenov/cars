<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220607112330 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE survey ADD created_at VARCHAR(255) NOT NULL, ADD end_date VARCHAR(255) NOT NULL, DROP `from`, DROP `to`');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE survey ADD `from` VARCHAR(255) NOT NULL, ADD `to` VARCHAR(255) NOT NULL, DROP created_at, DROP end_date');
    }
}
