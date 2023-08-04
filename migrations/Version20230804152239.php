<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230804152239 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE center (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE center_specialty (center_id INT NOT NULL, specialty_id INT NOT NULL, INDEX IDX_E84FDA5E5932F377 (center_id), INDEX IDX_E84FDA5E9A353316 (specialty_id), PRIMARY KEY(center_id, specialty_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE doctor (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hospitalization (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, is_vegeterian TINYINT(1) NOT NULL, is_single_room TINYINT(1) NOT NULL, is_television TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medical_file (id INT AUTO_INCREMENT NOT NULL, reservations_id INT DEFAULT NULL, allergies VARCHAR(255) DEFAULT NULL, documents VARCHAR(255) DEFAULT NULL, INDEX IDX_DF6C9C38D9A7F869 (reservations_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, hospitalization_id INT DEFAULT NULL, doctor_id INT NOT NULL, date DATETIME NOT NULL, UNIQUE INDEX UNIQ_42C849555992429E (hospitalization_id), INDEX IDX_42C8495587F4FB17 (doctor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialty (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialty_doctor (specialty_id INT NOT NULL, doctor_id INT NOT NULL, INDEX IDX_2DBBE9AC9A353316 (specialty_id), INDEX IDX_2DBBE9AC87F4FB17 (doctor_id), PRIMARY KEY(specialty_id, doctor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, medical_file_id INT DEFAULT NULL, gender VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, email_address VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, social_security INT NOT NULL, is_admin TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649D5C999A2 (medical_file_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE center_specialty ADD CONSTRAINT FK_E84FDA5E5932F377 FOREIGN KEY (center_id) REFERENCES center (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE center_specialty ADD CONSTRAINT FK_E84FDA5E9A353316 FOREIGN KEY (specialty_id) REFERENCES specialty (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE medical_file ADD CONSTRAINT FK_DF6C9C38D9A7F869 FOREIGN KEY (reservations_id) REFERENCES reservation (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849555992429E FOREIGN KEY (hospitalization_id) REFERENCES hospitalization (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495587F4FB17 FOREIGN KEY (doctor_id) REFERENCES doctor (id)');
        $this->addSql('ALTER TABLE specialty_doctor ADD CONSTRAINT FK_2DBBE9AC9A353316 FOREIGN KEY (specialty_id) REFERENCES specialty (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE specialty_doctor ADD CONSTRAINT FK_2DBBE9AC87F4FB17 FOREIGN KEY (doctor_id) REFERENCES doctor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D5C999A2 FOREIGN KEY (medical_file_id) REFERENCES medical_file (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE center_specialty DROP FOREIGN KEY FK_E84FDA5E5932F377');
        $this->addSql('ALTER TABLE center_specialty DROP FOREIGN KEY FK_E84FDA5E9A353316');
        $this->addSql('ALTER TABLE medical_file DROP FOREIGN KEY FK_DF6C9C38D9A7F869');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849555992429E');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495587F4FB17');
        $this->addSql('ALTER TABLE specialty_doctor DROP FOREIGN KEY FK_2DBBE9AC9A353316');
        $this->addSql('ALTER TABLE specialty_doctor DROP FOREIGN KEY FK_2DBBE9AC87F4FB17');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D5C999A2');
        $this->addSql('DROP TABLE center');
        $this->addSql('DROP TABLE center_specialty');
        $this->addSql('DROP TABLE doctor');
        $this->addSql('DROP TABLE hospitalization');
        $this->addSql('DROP TABLE medical_file');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE specialty');
        $this->addSql('DROP TABLE specialty_doctor');
        $this->addSql('DROP TABLE user');
    }
}
