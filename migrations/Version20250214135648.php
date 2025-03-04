<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250214135648 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job_offer ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_288A3A4EA76ED395 ON job_offer (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4EA76ED395');
        $this->addSql('DROP INDEX IDX_288A3A4EA76ED395 ON job_offer');
        $this->addSql('ALTER TABLE job_offer DROP user_id');
    }
}
