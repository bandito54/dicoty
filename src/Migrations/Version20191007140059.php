<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191007140059 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE translation (id INT AUTO_INCREMENT NOT NULL, lang_id_id INT NOT NULL, word_id_id INT NOT NULL, theme_id_id INT DEFAULT NULL, text VARCHAR(255) NOT NULL, INDEX IDX_B469456FAC870AE5 (lang_id_id), UNIQUE INDEX UNIQ_B469456FA1F79591 (word_id_id), INDEX IDX_B469456F276615B2 (theme_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lang (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE theme (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, description VARCHAR(255) NOT NULL, picture VARCHAR(255) DEFAULT NULL, INDEX IDX_9775E7089D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, pseudo VARCHAR(255) NOT NULL, birthdate VARCHAR(255) NOT NULL, mother_tongue VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE word (id INT AUTO_INCREMENT NOT NULL, lang_id_id INT NOT NULL, theme_id_id INT NOT NULL, text VARCHAR(255) NOT NULL, INDEX IDX_C3F17511AC870AE5 (lang_id_id), INDEX IDX_C3F17511276615B2 (theme_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE translation ADD CONSTRAINT FK_B469456FAC870AE5 FOREIGN KEY (lang_id_id) REFERENCES lang (id)');
        $this->addSql('ALTER TABLE translation ADD CONSTRAINT FK_B469456FA1F79591 FOREIGN KEY (word_id_id) REFERENCES word (id)');
        $this->addSql('ALTER TABLE translation ADD CONSTRAINT FK_B469456F276615B2 FOREIGN KEY (theme_id_id) REFERENCES theme (id)');
        $this->addSql('ALTER TABLE theme ADD CONSTRAINT FK_9775E7089D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE word ADD CONSTRAINT FK_C3F17511AC870AE5 FOREIGN KEY (lang_id_id) REFERENCES lang (id)');
        $this->addSql('ALTER TABLE word ADD CONSTRAINT FK_C3F17511276615B2 FOREIGN KEY (theme_id_id) REFERENCES theme (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE translation DROP FOREIGN KEY FK_B469456FAC870AE5');
        $this->addSql('ALTER TABLE word DROP FOREIGN KEY FK_C3F17511AC870AE5');
        $this->addSql('ALTER TABLE translation DROP FOREIGN KEY FK_B469456F276615B2');
        $this->addSql('ALTER TABLE word DROP FOREIGN KEY FK_C3F17511276615B2');
        $this->addSql('ALTER TABLE theme DROP FOREIGN KEY FK_9775E7089D86650F');
        $this->addSql('ALTER TABLE translation DROP FOREIGN KEY FK_B469456FA1F79591');
        $this->addSql('DROP TABLE translation');
        $this->addSql('DROP TABLE lang');
        $this->addSql('DROP TABLE theme');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE word');
    }
}
