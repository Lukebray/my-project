<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190410181651 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE buys ADD customer_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE buys ADD CONSTRAINT FK_D5A0A816B171EB6C FOREIGN KEY (customer_id_id) REFERENCES login (id)');
        $this->addSql('CREATE INDEX IDX_D5A0A816B171EB6C ON buys (customer_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE buys DROP FOREIGN KEY FK_D5A0A816B171EB6C');
        $this->addSql('DROP INDEX IDX_D5A0A816B171EB6C ON buys');
        $this->addSql('ALTER TABLE buys DROP customer_id_id');
    }
}
