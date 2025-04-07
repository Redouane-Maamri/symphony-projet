<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250122191449 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE crud ADD CONSTRAINT FK_4735133D1A65C546 FOREIGN KEY (no_id) REFERENCES utilisateurs (id)');
        $this->addSql('CREATE INDEX IDX_4735133D1A65C546 ON crud (no_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE crud DROP FOREIGN KEY FK_4735133D1A65C546');
        $this->addSql('DROP INDEX IDX_4735133D1A65C546 ON crud');
    }
}
