<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200609090259 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tchat (id INT AUTO_INCREMENT NOT NULL, game_id INT NOT NULL, content_text LONGTEXT NOT NULL, post_date DATETIME NOT NULL, INDEX IDX_8EA99CA4E48FD905 (game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, city_id INT NOT NULL, team_lead_id INT NOT NULL, name VARCHAR(255) NOT NULL, picture VARCHAR(255) DEFAULT NULL, INDEX IDX_C4E0A61F8BAC62AF (city_id), UNIQUE INDEX UNIQ_C4E0A61FFF2C34BA (team_lead_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, home_team_id INT NOT NULL, outside_team_id INT NOT NULL, goal_for INT DEFAULT NULL, goal_against INT DEFAULT NULL, INDEX IDX_232B318C9C4C13F6 (home_team_id), INDEX IDX_232B318C5B573341 (outside_team_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, zip_code INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, team_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, picture VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649296CD8AE (team_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pending_request_game (id INT AUTO_INCREMENT NOT NULL, team_asking_id INT NOT NULL, accepting_team_id INT NOT NULL, status INT NOT NULL, date DATE NOT NULL, INDEX IDX_C0DEB450877255E4 (team_asking_id), INDEX IDX_C0DEB450F13CAFD (accepting_team_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tchat ADD CONSTRAINT FK_8EA99CA4E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61FFF2C34BA FOREIGN KEY (team_lead_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C9C4C13F6 FOREIGN KEY (home_team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C5B573341 FOREIGN KEY (outside_team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE pending_request_game ADD CONSTRAINT FK_C0DEB450877255E4 FOREIGN KEY (team_asking_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE pending_request_game ADD CONSTRAINT FK_C0DEB450F13CAFD FOREIGN KEY (accepting_team_id) REFERENCES team (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C9C4C13F6');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C5B573341');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649296CD8AE');
        $this->addSql('ALTER TABLE pending_request_game DROP FOREIGN KEY FK_C0DEB450877255E4');
        $this->addSql('ALTER TABLE pending_request_game DROP FOREIGN KEY FK_C0DEB450F13CAFD');
        $this->addSql('ALTER TABLE tchat DROP FOREIGN KEY FK_8EA99CA4E48FD905');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61F8BAC62AF');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61FFF2C34BA');
        $this->addSql('DROP TABLE tchat');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE pending_request_game');
    }
}
