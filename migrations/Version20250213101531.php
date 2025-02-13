<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250213101531 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE job_offer (id INT AUTO_INCREMENT NOT NULL, recruiter_id INT DEFAULT NULL, category_id INT DEFAULT NULL, type_id INT DEFAULT NULL, description LONGTEXT NOT NULL, activated TINYINT(1) NOT NULL, notes LONGTEXT NOT NULL, title VARCHAR(255) NOT NULL, location VARCHAR(255) DEFAULT NULL, end_of_contract DATE DEFAULT NULL, salary VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_288A3A4E156BE243 (recruiter_id), INDEX IDX_288A3A4E12469DE2 (category_id), INDEX IDX_288A3A4EC54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_type (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4E156BE243 FOREIGN KEY (recruiter_id) REFERENCES recruiter (id)');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4E12469DE2 FOREIGN KEY (category_id) REFERENCES job_title (id)');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4EC54C8C93 FOREIGN KEY (type_id) REFERENCES job_type (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4E156BE243');
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4E12469DE2');
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4EC54C8C93');
        $this->addSql('DROP TABLE job_offer');
        $this->addSql('DROP TABLE job_type');
    }
}
