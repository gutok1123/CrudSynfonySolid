<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220421231452 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE courses_entity (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, initial_date DATE NOT NULL, final_date DATE NOT NULL, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE register_entity (id INT AUTO_INCREMENT NOT NULL, student_id INT DEFAULT NULL, student_account_id INT DEFAULT NULL, courses_id INT DEFAULT NULL, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, INDEX IDX_BD983C82CB944F1A (student_id), INDEX IDX_BD983C8276B4B25B (student_account_id), INDEX IDX_BD983C82F9295384 (courses_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student_account_entity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, status VARCHAR(50) DEFAULT NULL, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, UNIQUE INDEX UNIQ_3EFEA8A0E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student_entity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, birth_day DATE NOT NULL, status VARCHAR(50) DEFAULT NULL, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, UNIQUE INDEX UNIQ_801E9CE8E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE register_entity ADD CONSTRAINT FK_BD983C82CB944F1A FOREIGN KEY (student_id) REFERENCES student_entity (id)');
        $this->addSql('ALTER TABLE register_entity ADD CONSTRAINT FK_BD983C8276B4B25B FOREIGN KEY (student_account_id) REFERENCES student_account_entity (id)');
        $this->addSql('ALTER TABLE register_entity ADD CONSTRAINT FK_BD983C82F9295384 FOREIGN KEY (courses_id) REFERENCES courses_entity (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE register_entity DROP FOREIGN KEY FK_BD983C82F9295384');
        $this->addSql('ALTER TABLE register_entity DROP FOREIGN KEY FK_BD983C8276B4B25B');
        $this->addSql('ALTER TABLE register_entity DROP FOREIGN KEY FK_BD983C82CB944F1A');
        $this->addSql('DROP TABLE courses_entity');
        $this->addSql('DROP TABLE register_entity');
        $this->addSql('DROP TABLE student_account_entity');
        $this->addSql('DROP TABLE student_entity');
    }
}
