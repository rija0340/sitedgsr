<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200320100601 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE actualite ADD filename VARCHAR(255) DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL, DROP filename1, DROP updated_at1, DROP filename2, DROP updated_at2, DROP filename3, DROP filename4, DROP updated_at3, DROP updated_at4');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE actualite ADD filename2 VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD updated_at2 DATETIME DEFAULT NULL, ADD filename3 VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD filename4 VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD updated_at3 DATETIME DEFAULT NULL, ADD updated_at4 DATETIME DEFAULT NULL, CHANGE filename filename1 VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE updated_at updated_at1 DATETIME DEFAULT NULL');
    }
}
