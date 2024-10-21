<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241021180649 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaires_emprunts ADD livres_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commentaires_emprunts ADD CONSTRAINT FK_F7B9E104EBF07F38 FOREIGN KEY (livres_id) REFERENCES livres (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F7B9E104EBF07F38 ON commentaires_emprunts (livres_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaires_emprunts DROP FOREIGN KEY FK_F7B9E104EBF07F38');
        $this->addSql('DROP INDEX UNIQ_F7B9E104EBF07F38 ON commentaires_emprunts');
        $this->addSql('ALTER TABLE commentaires_emprunts DROP livres_id');
    }
}
