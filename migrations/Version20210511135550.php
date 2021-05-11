<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210511135550 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reponsehistorique ADD reponseuser_id INT DEFAULT NULL, DROP reponse_user');
        $this->addSql('ALTER TABLE reponsehistorique ADD CONSTRAINT FK_6E1D1CE18A09ED8F FOREIGN KEY (reponseuser_id) REFERENCES reponse (id)');
        $this->addSql('CREATE INDEX IDX_6E1D1CE18A09ED8F ON reponsehistorique (reponseuser_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reponsehistorique DROP FOREIGN KEY FK_6E1D1CE18A09ED8F');
        $this->addSql('DROP INDEX IDX_6E1D1CE18A09ED8F ON reponsehistorique');
        $this->addSql('ALTER TABLE reponsehistorique ADD reponse_user VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP reponseuser_id');
    }
}
