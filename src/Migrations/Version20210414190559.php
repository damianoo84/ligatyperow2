<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210414190559 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment CHANGE created created DATETIME DEFAULT NULL, CHANGE updated updated DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE history CHANGE created created DATETIME DEFAULT NULL, CHANGE updated updated DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE league CHANGE created created DATETIME DEFAULT NULL, CHANGE updated updated DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE matchday CHANGE date_from date_from DATETIME DEFAULT NULL, CHANGE date_to date_to DATETIME DEFAULT NULL, CHANGE created created DATETIME DEFAULT NULL, CHANGE updated updated DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE meet CHANGE name name VARCHAR(20) DEFAULT NULL, CHANGE host_goals host_goals INT DEFAULT NULL, CHANGE guest_goals guest_goals INT DEFAULT NULL, CHANGE term term VARCHAR(160) DEFAULT NULL, CHANGE created created DATETIME DEFAULT NULL, CHANGE updated updated DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE season CHANGE date_start date_start DATETIME DEFAULT NULL, CHANGE date_end date_end DATETIME DEFAULT NULL, CHANGE is_active is_active TINYINT(1) DEFAULT NULL, CHANGE created created DATETIME DEFAULT NULL, CHANGE updated updated DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE statistic CHANGE created created DATETIME DEFAULT NULL, CHANGE updated updated DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE team CHANGE created created DATETIME DEFAULT NULL, CHANGE updated updated DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE type CHANGE number_of_points number_of_points INT DEFAULT NULL, CHANGE created created DATETIME DEFAULT NULL, CHANGE updated updated DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE last_activity_at last_activity_at DATETIME DEFAULT NULL, CHANGE ranking_position ranking_position INT DEFAULT NULL, CHANGE max_points_per_queue max_points_per_queue INT DEFAULT NULL, CHANGE min_points_per_queue min_points_per_queue INT DEFAULT NULL, CHANGE created created DATETIME DEFAULT NULL, CHANGE updated updated DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment CHANGE created created DATETIME DEFAULT \'NULL\', CHANGE updated updated DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE history CHANGE created created DATETIME DEFAULT \'NULL\', CHANGE updated updated DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE league CHANGE created created DATETIME DEFAULT \'NULL\', CHANGE updated updated DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE matchday CHANGE date_from date_from DATETIME DEFAULT \'NULL\', CHANGE date_to date_to DATETIME DEFAULT \'NULL\', CHANGE created created DATETIME DEFAULT \'NULL\', CHANGE updated updated DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE meet CHANGE name name VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE host_goals host_goals INT DEFAULT NULL, CHANGE guest_goals guest_goals INT DEFAULT NULL, CHANGE term term VARCHAR(160) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE created created DATETIME DEFAULT \'NULL\', CHANGE updated updated DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE season CHANGE date_start date_start DATETIME DEFAULT \'NULL\', CHANGE date_end date_end DATETIME DEFAULT \'NULL\', CHANGE is_active is_active TINYINT(1) DEFAULT \'NULL\', CHANGE created created DATETIME DEFAULT \'NULL\', CHANGE updated updated DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE statistic CHANGE created created DATETIME DEFAULT \'NULL\', CHANGE updated updated DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE team CHANGE created created DATETIME DEFAULT \'NULL\', CHANGE updated updated DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE type CHANGE number_of_points number_of_points INT DEFAULT NULL, CHANGE created created DATETIME DEFAULT \'NULL\', CHANGE updated updated DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE last_activity_at last_activity_at DATETIME DEFAULT \'NULL\', CHANGE ranking_position ranking_position INT DEFAULT NULL, CHANGE max_points_per_queue max_points_per_queue INT DEFAULT NULL, CHANGE min_points_per_queue min_points_per_queue INT DEFAULT NULL, CHANGE created created DATETIME DEFAULT \'NULL\', CHANGE updated updated DATETIME DEFAULT \'NULL\'');
    }
}
