<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190628094455 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE division (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, location VARCHAR(255) NOT NULL, taxpayer_num VARCHAR(255) NOT NULL, employees_num INT NOT NULL, sort_activity INT NOT NULL, patent_num INT NOT NULL, period VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employees (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, post VARCHAR(255) NOT NULL, financing DOUBLE PRECISION NOT NULL, patent_num INT NOT NULL, patent_application_num INT NOT NULL, research_num INT NOT NULL, publication_num INT NOT NULL, period VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE company CHANGE taxplayer_num taxpayer_num VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD company_name VARCHAR(255) NOT NULL, ADD division_name VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6491D4E64E8 ON user (company_name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649C30EF87F ON user (division_name)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE division');
        $this->addSql('DROP TABLE employees');
        $this->addSql('ALTER TABLE company CHANGE taxpayer_num taxplayer_num VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('DROP INDEX UNIQ_8D93D6491D4E64E8 ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D649C30EF87F ON user');
        $this->addSql('ALTER TABLE user DROP company_name, DROP division_name');
    }
}
