<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211124113602 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE reset_password (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, token VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_B9983CE5A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reset_password ADD CONSTRAINT FK_B9983CE5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE attachement ADD CONSTRAINT FK_901C1961A2843073 FOREIGN KEY (actualite_id) REFERENCES actualite (id)');
        $this->addSql('ALTER TABLE centre ADD CONSTRAINT FK_C6A0EA75A73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE dg_word ADD CONSTRAINT FK_AF927A7D9561F508 FOREIGN KEY (dg_id) REFERENCES dg (id)');
        $this->addSql('ALTER TABLE images_entete ADD CONSTRAINT FK_D1C92605FB3FE5C6 FOREIGN KEY (label_couverture_id) REFERENCES label_couverture (id)');
        $this->addSql('ALTER TABLE ville ADD CONSTRAINT FK_43C3D9C38E88C0C5 FOREIGN KEY (faritany_id) REFERENCES faritany (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE reset_password');
        $this->addSql('ALTER TABLE attachement DROP FOREIGN KEY FK_901C1961A2843073');
        $this->addSql('ALTER TABLE centre DROP FOREIGN KEY FK_C6A0EA75A73F0036');
        $this->addSql('ALTER TABLE dg_word DROP FOREIGN KEY FK_AF927A7D9561F508');
        $this->addSql('ALTER TABLE images_entete DROP FOREIGN KEY FK_D1C92605FB3FE5C6');
        $this->addSql('ALTER TABLE ville DROP FOREIGN KEY FK_43C3D9C38E88C0C5');
    }
}
