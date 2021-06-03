<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210601140012 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user CHANGE roles_id roles_id INT NOT NULL');
        $this->addSql('ALTER TABLE user RENAME INDEX fk_8d93d64938c751c4 TO IDX_8D93D64938C751C4');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user CHANGE roles_id roles_id INT DEFAULT 2 NOT NULL');
        $this->addSql('ALTER TABLE user RENAME INDEX idx_8d93d64938c751c4 TO FK_8D93D64938C751C4');
    }
}
