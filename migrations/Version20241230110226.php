<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241230110226 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product ADD name VARCHAR(255) NOT NULL, ADD illustration VARCHAR(255) NOT NULL, DROP products, DROP ullustration, CHANGE description description LONGTEXT DEFAULT NULL, CHANGE tva tva DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product ADD products VARCHAR(255) NOT NULL, ADD ullustration VARCHAR(255) NOT NULL, DROP name, DROP illustration, CHANGE description description LONGTEXT NOT NULL, CHANGE tva tva DOUBLE PRECISION NOT NULL');
    }
}
