<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180611111730 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE coeff_five ADD period VARCHAR(255) NOT NULL, DROP date');
        $this->addSql('ALTER TABLE coeff_four ADD period VARCHAR(255) NOT NULL, DROP date');
        $this->addSql('ALTER TABLE coeff_one ADD period VARCHAR(255) NOT NULL, DROP date');
        $this->addSql('ALTER TABLE coeff_three ADD period VARCHAR(255) NOT NULL, DROP date');
        $this->addSql('ALTER TABLE coeff_two ADD period VARCHAR(255) NOT NULL, DROP date');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE coeff_five ADD date DATE NOT NULL, DROP period');
        $this->addSql('ALTER TABLE coeff_four ADD date DATE NOT NULL, DROP period');
        $this->addSql('ALTER TABLE coeff_one ADD date DATE NOT NULL, DROP period');
        $this->addSql('ALTER TABLE coeff_three ADD date DATE NOT NULL, DROP period');
        $this->addSql('ALTER TABLE coeff_two ADD date DATE NOT NULL, DROP period');
    }
}
