<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191124172515 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE centre (id INT AUTO_INCREMENT NOT NULL, ville_id INT NOT NULL, type VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, grade_cc VARCHAR(255) NOT NULL, nom_cc VARCHAR(255) NOT NULL, num_cc VARCHAR(255) NOT NULL, filename VARCHAR(255) DEFAULT NULL, INDEX IDX_C6A0EA75A73F0036 (ville_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE faritany (id INT AUTO_INCREMENT NOT NULL, faritany VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, faritany_id INT NOT NULL, ville VARCHAR(255) NOT NULL, INDEX IDX_43C3D9C38E88C0C5 (faritany_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE centre ADD CONSTRAINT FK_C6A0EA75A73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE ville ADD CONSTRAINT FK_43C3D9C38E88C0C5 FOREIGN KEY (faritany_id) REFERENCES faritany (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ville DROP FOREIGN KEY FK_43C3D9C38E88C0C5');
        $this->addSql('ALTER TABLE centre DROP FOREIGN KEY FK_C6A0EA75A73F0036');
        $this->addSql('DROP TABLE centre');
        $this->addSql('DROP TABLE faritany');
        $this->addSql('DROP TABLE ville');
    }
}
