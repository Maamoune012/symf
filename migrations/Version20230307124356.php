<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230307124356 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE carrier');
        $this->addSql('ALTER TABLE delivery ADD CONSTRAINT FK_3781EC10251A8A50 FOREIGN KEY (order__id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_3781EC10251A8A50 ON delivery (order__id)');
        $this->addSql('ALTER TABLE product CHANGE price price DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE carrier (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prix DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE delivery DROP FOREIGN KEY FK_3781EC10251A8A50');
        $this->addSql('DROP INDEX IDX_3781EC10251A8A50 ON delivery');
        $this->addSql('ALTER TABLE product CHANGE price price INT NOT NULL');
    }
}
