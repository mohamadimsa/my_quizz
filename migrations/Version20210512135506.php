<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210512135506 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reponsehistorique DROP FOREIGN KEY FK_6E1D1CE11E27F6BF');
        $this->addSql('ALTER TABLE reponsehistorique DROP FOREIGN KEY FK_6E1D1CE1CF18BB82');
        $this->addSql('DROP INDEX IDX_6E1D1CE11E27F6BF ON reponsehistorique');
        $this->addSql('DROP INDEX IDX_6E1D1CE1CF18BB82 ON reponsehistorique');
        $this->addSql('ALTER TABLE reponsehistorique DROP question_id, DROP reponse_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reponsehistorique ADD question_id INT NOT NULL, ADD reponse_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reponsehistorique ADD CONSTRAINT FK_6E1D1CE11E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE reponsehistorique ADD CONSTRAINT FK_6E1D1CE1CF18BB82 FOREIGN KEY (reponse_id) REFERENCES reponse (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_6E1D1CE11E27F6BF ON reponsehistorique (question_id)');
        $this->addSql('CREATE INDEX IDX_6E1D1CE1CF18BB82 ON reponsehistorique (reponse_id)');
    }
}
