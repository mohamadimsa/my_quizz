<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210512131038 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE historique (id INT AUTO_INCREMENT NOT NULL, users_id INT NOT NULL, quizz_id INT NOT NULL, categories_id INT NOT NULL, score VARCHAR(255) NOT NULL, date DATETIME NOT NULL, INDEX IDX_EDBFD5EC67B3B43D (users_id), INDEX IDX_EDBFD5ECBA934BCD (quizz_id), INDEX IDX_EDBFD5ECA21214B7 (categories_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, quizz_id INT NOT NULL, question VARCHAR(255) NOT NULL, index_question INT NOT NULL, INDEX IDX_B6F7494EBA934BCD (quizz_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quizz (id INT AUTO_INCREMENT NOT NULL, categories_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_7C77973DA21214B7 (categories_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reponse (id INT AUTO_INCREMENT NOT NULL, question_id INT NOT NULL, reponse VARCHAR(255) NOT NULL, indice_reponse INT NOT NULL, INDEX IDX_5FB6DEC71E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reponsehistorique (id INT AUTO_INCREMENT NOT NULL, historique_id INT NOT NULL, question_id INT NOT NULL, reponse_id INT DEFAULT NULL, INDEX IDX_6E1D1CE16128735E (historique_id), INDEX IDX_6E1D1CE11E27F6BF (question_id), INDEX IDX_6E1D1CE1CF18BB82 (reponse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, pseudo VARCHAR(20) NOT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, update_at DATETIME NOT NULL, create_at DATETIME NOT NULL, lastconnect DATETIME NOT NULL, activation_token VARCHAR(255) DEFAULT NULL, reset_token VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D64986CC499D (pseudo), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE historique ADD CONSTRAINT FK_EDBFD5EC67B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE historique ADD CONSTRAINT FK_EDBFD5ECBA934BCD FOREIGN KEY (quizz_id) REFERENCES quizz (id)');
        $this->addSql('ALTER TABLE historique ADD CONSTRAINT FK_EDBFD5ECA21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494EBA934BCD FOREIGN KEY (quizz_id) REFERENCES quizz (id)');
        $this->addSql('ALTER TABLE quizz ADD CONSTRAINT FK_7C77973DA21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC71E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE reponsehistorique ADD CONSTRAINT FK_6E1D1CE16128735E FOREIGN KEY (historique_id) REFERENCES historique (id)');
        $this->addSql('ALTER TABLE reponsehistorique ADD CONSTRAINT FK_6E1D1CE11E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE reponsehistorique ADD CONSTRAINT FK_6E1D1CE1CF18BB82 FOREIGN KEY (reponse_id) REFERENCES reponse (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE historique DROP FOREIGN KEY FK_EDBFD5ECA21214B7');
        $this->addSql('ALTER TABLE quizz DROP FOREIGN KEY FK_7C77973DA21214B7');
        $this->addSql('ALTER TABLE reponsehistorique DROP FOREIGN KEY FK_6E1D1CE16128735E');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC71E27F6BF');
        $this->addSql('ALTER TABLE reponsehistorique DROP FOREIGN KEY FK_6E1D1CE11E27F6BF');
        $this->addSql('ALTER TABLE historique DROP FOREIGN KEY FK_EDBFD5ECBA934BCD');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494EBA934BCD');
        $this->addSql('ALTER TABLE reponsehistorique DROP FOREIGN KEY FK_6E1D1CE1CF18BB82');
        $this->addSql('ALTER TABLE historique DROP FOREIGN KEY FK_EDBFD5EC67B3B43D');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE historique');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE quizz');
        $this->addSql('DROP TABLE reponse');
        $this->addSql('DROP TABLE reponsehistorique');
        $this->addSql('DROP TABLE user');
    }
}
