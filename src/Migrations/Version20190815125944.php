<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190815125944 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, meet_id INT NOT NULL, number_of_points INT DEFAULT NULL, host_type INT NOT NULL, guest_type INT NOT NULL, INDEX IDX_8CDE5729A76ED395 (user_id), INDEX IDX_8CDE57293BBBF66 (meet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, season_id INT NOT NULL, text VARCHAR(250) NOT NULL, INDEX IDX_9474526CA76ED395 (user_id), INDEX IDX_9474526C4EC001D1 (season_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meet (id INT AUTO_INCREMENT NOT NULL, host_team_id INT NOT NULL, guest_team_id INT NOT NULL, matchday_id INT NOT NULL, league_id INT NOT NULL, name VARCHAR(20) DEFAULT NULL, INDEX IDX_E9F6D3CE1E90F49F (host_team_id), INDEX IDX_E9F6D3CE69A91CE2 (guest_team_id), INDEX IDX_E9F6D3CE3D90D21B (matchday_id), INDEX IDX_E9F6D3CE58AFC4DE (league_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE history (id INT AUTO_INCREMENT NOT NULL, matchday_id INT NOT NULL, statistic_id INT NOT NULL, num_of_points INT NOT NULL, INDEX IDX_27BA704B3D90D21B (matchday_id), INDEX IDX_27BA704B53B6268F (statistic_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statistic (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, season_id INT NOT NULL, match2 INT NOT NULL, match4 INT NOT NULL, INDEX IDX_649B469CA76ED395 (user_id), INDEX IDX_649B469C4EC001D1 (season_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE league (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matchday (id INT AUTO_INCREMENT NOT NULL, season_id INT NOT NULL, name VARCHAR(20) NOT NULL, INDEX IDX_A95F40764EC001D1 (season_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE type ADD CONSTRAINT FK_8CDE5729A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE type ADD CONSTRAINT FK_8CDE57293BBBF66 FOREIGN KEY (meet_id) REFERENCES meet (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C4EC001D1 FOREIGN KEY (season_id) REFERENCES season (id)');
        $this->addSql('ALTER TABLE meet ADD CONSTRAINT FK_E9F6D3CE1E90F49F FOREIGN KEY (host_team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE meet ADD CONSTRAINT FK_E9F6D3CE69A91CE2 FOREIGN KEY (guest_team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE meet ADD CONSTRAINT FK_E9F6D3CE3D90D21B FOREIGN KEY (matchday_id) REFERENCES matchday (id)');
        $this->addSql('ALTER TABLE meet ADD CONSTRAINT FK_E9F6D3CE58AFC4DE FOREIGN KEY (league_id) REFERENCES league (id)');
        $this->addSql('ALTER TABLE history ADD CONSTRAINT FK_27BA704B3D90D21B FOREIGN KEY (matchday_id) REFERENCES matchday (id)');
        $this->addSql('ALTER TABLE history ADD CONSTRAINT FK_27BA704B53B6268F FOREIGN KEY (statistic_id) REFERENCES statistic (id)');
        $this->addSql('ALTER TABLE statistic ADD CONSTRAINT FK_649B469CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE statistic ADD CONSTRAINT FK_649B469C4EC001D1 FOREIGN KEY (season_id) REFERENCES season (id)');
        $this->addSql('ALTER TABLE matchday ADD CONSTRAINT FK_A95F40764EC001D1 FOREIGN KEY (season_id) REFERENCES season (id)');
        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677 ON user');
        $this->addSql('ALTER TABLE user DROP phone, DROP number_of_wins, DROP status, DROP priority, DROP last_activity_at, DROP rank_position, DROP max_number_of_points_per_queue, DROP min_number_of_points_per_queue, CHANGE username email VARCHAR(180) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE type DROP FOREIGN KEY FK_8CDE57293BBBF66');
        $this->addSql('ALTER TABLE history DROP FOREIGN KEY FK_27BA704B53B6268F');
        $this->addSql('ALTER TABLE meet DROP FOREIGN KEY FK_E9F6D3CE1E90F49F');
        $this->addSql('ALTER TABLE meet DROP FOREIGN KEY FK_E9F6D3CE69A91CE2');
        $this->addSql('ALTER TABLE meet DROP FOREIGN KEY FK_E9F6D3CE58AFC4DE');
        $this->addSql('ALTER TABLE meet DROP FOREIGN KEY FK_E9F6D3CE3D90D21B');
        $this->addSql('ALTER TABLE history DROP FOREIGN KEY FK_27BA704B3D90D21B');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE meet');
        $this->addSql('DROP TABLE history');
        $this->addSql('DROP TABLE statistic');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE league');
        $this->addSql('DROP TABLE matchday');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('ALTER TABLE user ADD phone VARCHAR(9) NOT NULL COLLATE utf8mb4_unicode_ci, ADD number_of_wins INT NOT NULL, ADD status INT NOT NULL, ADD priority INT NOT NULL, ADD last_activity_at DATETIME NOT NULL, ADD rank_position INT NOT NULL, ADD max_number_of_points_per_queue INT NOT NULL, ADD min_number_of_points_per_queue INT NOT NULL, CHANGE email username VARCHAR(180) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
    }
}
