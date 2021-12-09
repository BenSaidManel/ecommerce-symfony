<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211122193735 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE catalogue (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DAE732C28');
        $this->addSql('DROP INDEX IDX_6EEAA67DAE732C28 ON commande');
        $this->addSql('ALTER TABLE commande ADD payement_id INT DEFAULT NULL, DROP y_id');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D868C0609 FOREIGN KEY (payement_id) REFERENCES payement (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6EEAA67D868C0609 ON commande (payement_id)');
        $this->addSql('ALTER TABLE panier ADD commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF282EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_24CC0DF282EA2E54 ON panier (commande_id)');
        $this->addSql('ALTER TABLE produit ADD client_id INT DEFAULT NULL, ADD panier_id INT DEFAULT NULL, ADD catalogue_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC2719EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27F77D927C FOREIGN KEY (panier_id) REFERENCES panier (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC274A7843DC FOREIGN KEY (catalogue_id) REFERENCES catalogue (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC2719EB6921 ON produit (client_id)');
        $this->addSql('CREATE INDEX IDX_29A5EC27F77D927C ON produit (panier_id)');
        $this->addSql('CREATE INDEX IDX_29A5EC274A7843DC ON produit (catalogue_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC274A7843DC');
        $this->addSql('DROP TABLE catalogue');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D868C0609');
        $this->addSql('DROP INDEX UNIQ_6EEAA67D868C0609 ON commande');
        $this->addSql('ALTER TABLE commande ADD y_id INT NOT NULL, DROP payement_id');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DAE732C28 FOREIGN KEY (y_id) REFERENCES client (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_6EEAA67DAE732C28 ON commande (y_id)');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF282EA2E54');
        $this->addSql('DROP INDEX UNIQ_24CC0DF282EA2E54 ON panier');
        $this->addSql('ALTER TABLE panier DROP commande_id');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC2719EB6921');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27F77D927C');
        $this->addSql('DROP INDEX IDX_29A5EC2719EB6921 ON produit');
        $this->addSql('DROP INDEX IDX_29A5EC27F77D927C ON produit');
        $this->addSql('DROP INDEX IDX_29A5EC274A7843DC ON produit');
        $this->addSql('ALTER TABLE produit DROP client_id, DROP panier_id, DROP catalogue_id');
    }
}
