<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230306131619 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE invoice_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE invoice (id INT NOT NULL, user_id_id INT NOT NULL, client_id_id INT NOT NULL, number_prefix VARCHAR(50) NOT NULL, number_int INT NOT NULL, status VARCHAR(100) NOT NULL, issue_date DATE NOT NULL, payment_terms VARCHAR(50) NOT NULL, line_items JSON NOT NULL, description VARCHAR(255) DEFAULT NULL, total_amount INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_906517449D86650F ON invoice (user_id_id)');
        $this->addSql('CREATE INDEX IDX_90651744DC2902E0 ON invoice (client_id_id)');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_906517449D86650F FOREIGN KEY (user_id_id) REFERENCES app_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_90651744DC2902E0 FOREIGN KEY (client_id_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE client DROP CONSTRAINT FK_C74404559D86650F');
        $this->addSql('DROP INDEX IDX_C74404559D86650F');
        $this->addSql('ALTER TABLE client RENAME COLUMN user_id TO user_id_id');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C74404559D86650F FOREIGN KEY (user_id_id) REFERENCES app_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_C74404559D86650F ON client (user_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE invoice_id_seq CASCADE');
        $this->addSql('ALTER TABLE invoice DROP CONSTRAINT FK_906517449D86650F');
        $this->addSql('ALTER TABLE invoice DROP CONSTRAINT FK_90651744DC2902E0');
        $this->addSql('DROP TABLE invoice');
        $this->addSql('ALTER TABLE client DROP CONSTRAINT fk_c74404559d86650f');
        $this->addSql('DROP INDEX idx_c74404559d86650f');
        $this->addSql('ALTER TABLE client RENAME COLUMN user_id_id TO user_id');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT fk_c74404559d86650f FOREIGN KEY (user_id) REFERENCES app_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_c74404559d86650f ON client (user_id)');
    }
}
