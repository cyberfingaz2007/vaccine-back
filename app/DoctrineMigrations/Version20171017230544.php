<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171017230544 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE medical_detail ADD ProjectID INT DEFAULT NULL, CHANGE CreatedAt CreatedAt DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE medical_detail ADD CONSTRAINT FK_4558C83CD50CC29C FOREIGN KEY (ProjectID) REFERENCES project (id)');
        $this->addSql('CREATE INDEX IDX_4558C83CD50CC29C ON medical_detail (ProjectID)');
        $this->addSql('ALTER TABLE patient CHANGE FullName FullName VARCHAR(255) DEFAULT NULL, CHANGE Sex Sex VARCHAR(30) DEFAULT NULL, CHANGE DateOfBirth DateOfBirth DATE DEFAULT NULL, CHANGE CreatedAt CreatedAt DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE project ADD ProjectStatus VARCHAR(50) DEFAULT NULL, CHANGE ProjectName ProjectName VARCHAR(255) DEFAULT NULL, CHANGE Description Description VARCHAR(255) DEFAULT NULL, CHANGE Budget Budget DOUBLE PRECISION DEFAULT NULL, CHANGE CreatedAt CreatedAt DATETIME DEFAULT NULL, CHANGE ProjectStrtDate ProjectStrtDate DATETIME DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE medical_detail DROP FOREIGN KEY FK_4558C83CD50CC29C');
        $this->addSql('DROP INDEX IDX_4558C83CD50CC29C ON medical_detail');
        $this->addSql('ALTER TABLE medical_detail DROP ProjectID, CHANGE CreatedAt CreatedAt DATETIME NOT NULL');
        $this->addSql('ALTER TABLE patient CHANGE FullName FullName VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE Sex Sex VARCHAR(30) NOT NULL COLLATE utf8_unicode_ci, CHANGE DateOfBirth DateOfBirth DATE NOT NULL, CHANGE CreatedAt CreatedAt DATETIME NOT NULL');
        $this->addSql('ALTER TABLE project DROP ProjectStatus, CHANGE ProjectName ProjectName VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE Description Description VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE Budget Budget DOUBLE PRECISION NOT NULL, CHANGE ProjectStrtDate ProjectStrtDate DATETIME NOT NULL, CHANGE CreatedAt CreatedAt DATETIME NOT NULL');
    }
}
