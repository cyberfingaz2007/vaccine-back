<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171014164005 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ext_translations (id INT AUTO_INCREMENT NOT NULL, locale VARCHAR(8) NOT NULL, object_class VARCHAR(255) NOT NULL, field VARCHAR(32) NOT NULL, foreign_key VARCHAR(64) NOT NULL, content LONGTEXT DEFAULT NULL, INDEX translations_lookup_idx (locale, object_class, foreign_key), UNIQUE INDEX lookup_unique_idx (locale, object_class, field, foreign_key), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ext_log_entries (id INT AUTO_INCREMENT NOT NULL, action VARCHAR(8) NOT NULL, logged_at DATETIME NOT NULL, object_id VARCHAR(64) DEFAULT NULL, object_class VARCHAR(255) NOT NULL, version INT NOT NULL, data LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', username VARCHAR(255) DEFAULT NULL, INDEX log_class_lookup_idx (object_class), INDEX log_date_lookup_idx (logged_at), INDEX log_user_lookup_idx (username), INDEX log_version_lookup_idx (object_id, object_class, version), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE User (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', MPlainPass VARCHAR(100) DEFAULT NULL, DateAdded DATE DEFAULT NULL, type VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_2DA1797792FC23A8 (username_canonical), UNIQUE INDEX UNIQ_2DA17977A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_2DA17977C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE admin_user (id INT NOT NULL, FullName VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE normal_user (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE community (id INT AUTO_INCREMENT NOT NULL, CommunityName VARCHAR(255) DEFAULT NULL, MaleAbv10 INT DEFAULT NULL, FemBtw10N15 INT DEFAULT NULL, ChildBel10 INT DEFAULT NULL, FemAbv15 INT DEFAULT NULL, current TINYINT(1) DEFAULT NULL, CreatedAt DATETIME NOT NULL, UpdatedAt DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medical_detail (id INT AUTO_INCREMENT NOT NULL, VaccinationStatus VARCHAR(50) DEFAULT NULL, VaccinationDate DATETIME DEFAULT NULL, EmployeeName VARCHAR(100) DEFAULT NULL, Description LONGTEXT DEFAULT NULL, current TINYINT(1) DEFAULT NULL, CreatedAt DATETIME NOT NULL, UpdatedAt DATETIME DEFAULT NULL, PatientId INT DEFAULT NULL, INDEX IDX_4558C83CD71B6DB (PatientId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient (id INT AUTO_INCREMENT NOT NULL, FullName VARCHAR(255) NOT NULL, Sex VARCHAR(30) NOT NULL, DateOfBirth DATE NOT NULL, UniqueNumber VARCHAR(255) NOT NULL, Residence VARCHAR(255) DEFAULT NULL, CreatedAt DATETIME NOT NULL, UpdatedAt DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_1ADAD7EBC821B0C6 (FullName), UNIQUE INDEX UNIQ_1ADAD7EBA45E916 (UniqueNumber), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, ProjectName VARCHAR(255) NOT NULL, Description VARCHAR(255) NOT NULL, NumOfFieldWorkers INT DEFAULT NULL, TimeSpan INT DEFAULT NULL, Budget DOUBLE PRECISION NOT NULL, CreatedAt DATETIME NOT NULL, UpdatedAt DATETIME DEFAULT NULL, CommunityID INT DEFAULT NULL, INDEX IDX_2FB3D0EE15F8D32D (CommunityID), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE admin_user ADD CONSTRAINT FK_AD8A54A9BF396750 FOREIGN KEY (id) REFERENCES User (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE normal_user ADD CONSTRAINT FK_9811D429BF396750 FOREIGN KEY (id) REFERENCES User (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE medical_detail ADD CONSTRAINT FK_4558C83CD71B6DB FOREIGN KEY (PatientId) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE15F8D32D FOREIGN KEY (CommunityID) REFERENCES community (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE admin_user DROP FOREIGN KEY FK_AD8A54A9BF396750');
        $this->addSql('ALTER TABLE normal_user DROP FOREIGN KEY FK_9811D429BF396750');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EE15F8D32D');
        $this->addSql('ALTER TABLE medical_detail DROP FOREIGN KEY FK_4558C83CD71B6DB');
        $this->addSql('DROP TABLE ext_translations');
        $this->addSql('DROP TABLE ext_log_entries');
        $this->addSql('DROP TABLE User');
        $this->addSql('DROP TABLE admin_user');
        $this->addSql('DROP TABLE normal_user');
        $this->addSql('DROP TABLE community');
        $this->addSql('DROP TABLE medical_detail');
        $this->addSql('DROP TABLE patient');
        $this->addSql('DROP TABLE project');
    }
}
