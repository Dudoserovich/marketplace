<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220620005607 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, city VARCHAR(255) NOT NULL, street VARCHAR(255) NOT NULL, house VARCHAR(255) NOT NULL, postal_code INT NOT NULL, phone VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_64C19C1727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE img (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, mime VARCHAR(50) NOT NULL, size INT NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE img_to_product (id INT AUTO_INCREMENT NOT NULL, img_id INT NOT NULL, product_id INT NOT NULL, UNIQUE INDEX UNIQ_B33B4EC5C06A9F55 (img_id), INDEX IDX_B33B4EC54584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, shop_id INT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_D34A04AD4D16C4DD (shop_id), INDEX IDX_D34A04AD12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_characteristic (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, name VARCHAR(255) NOT NULL, value VARCHAR(255) NOT NULL, INDEX IDX_146D77C4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_option (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, product_price_id INT NOT NULL, img_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, count INT NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_38FA41144584665A (product_id), UNIQUE INDEX UNIQ_38FA41141DA4AD70 (product_price_id), UNIQUE INDEX UNIQ_38FA4114C06A9F55 (img_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_price (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, price NUMERIC(10, 2) NOT NULL, discounted_price NUMERIC(10, 2) DEFAULT NULL, INDEX IDX_6B9459854584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shop (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, status INT NOT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, status INT NOT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_to_addres (user_id INT NOT NULL, address_id INT NOT NULL, INDEX IDX_A5D4EA6A76ED395 (user_id), INDEX IDX_A5D4EA6F5B7AF75 (address_id), PRIMARY KEY(user_id, address_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_to_shop (user_id INT NOT NULL, shop_id INT NOT NULL, INDEX IDX_13894367A76ED395 (user_id), INDEX IDX_138943674D16C4DD (shop_id), PRIMARY KEY(user_id, shop_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1727ACA70 FOREIGN KEY (parent_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE img_to_product ADD CONSTRAINT FK_B33B4EC5C06A9F55 FOREIGN KEY (img_id) REFERENCES img (id)');
        $this->addSql('ALTER TABLE img_to_product ADD CONSTRAINT FK_B33B4EC54584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD4D16C4DD FOREIGN KEY (shop_id) REFERENCES shop (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE product_characteristic ADD CONSTRAINT FK_146D77C4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product_option ADD CONSTRAINT FK_38FA41144584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product_option ADD CONSTRAINT FK_38FA41141DA4AD70 FOREIGN KEY (product_price_id) REFERENCES product_price (id)');
        $this->addSql('ALTER TABLE product_option ADD CONSTRAINT FK_38FA4114C06A9F55 FOREIGN KEY (img_id) REFERENCES img (id)');
        $this->addSql('ALTER TABLE product_price ADD CONSTRAINT FK_6B9459854584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE user_to_addres ADD CONSTRAINT FK_A5D4EA6A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_to_addres ADD CONSTRAINT FK_A5D4EA6F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_to_shop ADD CONSTRAINT FK_13894367A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_to_shop ADD CONSTRAINT FK_138943674D16C4DD FOREIGN KEY (shop_id) REFERENCES shop (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_to_addres DROP FOREIGN KEY FK_A5D4EA6F5B7AF75');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1727ACA70');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2');
        $this->addSql('ALTER TABLE img_to_product DROP FOREIGN KEY FK_B33B4EC5C06A9F55');
        $this->addSql('ALTER TABLE product_option DROP FOREIGN KEY FK_38FA4114C06A9F55');
        $this->addSql('ALTER TABLE img_to_product DROP FOREIGN KEY FK_B33B4EC54584665A');
        $this->addSql('ALTER TABLE product_characteristic DROP FOREIGN KEY FK_146D77C4584665A');
        $this->addSql('ALTER TABLE product_option DROP FOREIGN KEY FK_38FA41144584665A');
        $this->addSql('ALTER TABLE product_price DROP FOREIGN KEY FK_6B9459854584665A');
        $this->addSql('ALTER TABLE product_option DROP FOREIGN KEY FK_38FA41141DA4AD70');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD4D16C4DD');
        $this->addSql('ALTER TABLE user_to_shop DROP FOREIGN KEY FK_138943674D16C4DD');
        $this->addSql('ALTER TABLE user_to_addres DROP FOREIGN KEY FK_A5D4EA6A76ED395');
        $this->addSql('ALTER TABLE user_to_shop DROP FOREIGN KEY FK_13894367A76ED395');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE img');
        $this->addSql('DROP TABLE img_to_product');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_characteristic');
        $this->addSql('DROP TABLE product_option');
        $this->addSql('DROP TABLE product_price');
        $this->addSql('DROP TABLE shop');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE user_to_addres');
        $this->addSql('DROP TABLE user_to_shop');
    }
}
