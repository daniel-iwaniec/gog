<?php

declare(strict_types = 1);

namespace Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version1 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $sql = <<<'SQL'
        CREATE TABLE product (
            id INT UNSIGNED NOT NULL AUTO_INCREMENT,
            name VARCHAR(255) NOT NULL,
            price INT UNSIGNED NOT NULL,
            PRIMARY KEY (id),
            UNIQUE INDEX product_name_unique (name ASC)
        )
        SQL;

        $this->addSql($sql);
    }

    public function down(Schema $schema): void
    {
        $sql = <<<'SQL'
        DROP TABLE product
        SQL;

        $this->addSql($sql);
    }
}
