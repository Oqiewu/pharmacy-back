<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230720125938 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE active_substance_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE bar_code_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE client_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE goods_margin_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE manufacturer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "organization_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pharmacy_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pricing_category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE product_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE provider_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "soletrader_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE subtype_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE treaty_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE type_markup_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE unit_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE active_substance (id INT NOT NULL, substance_name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE bar_code (id INT NOT NULL, manufacturer_id INT NOT NULL, bar_code VARCHAR(255) NOT NULL, unit VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_70D524AAA23B42D ON bar_code (manufacturer_id)');
        $this->addSql('CREATE TABLE client_type (id INT NOT NULL, client_type_name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE goods_margin (id INT NOT NULL, product_id INT DEFAULT NULL, category_id INT DEFAULT NULL, lower_limit INT DEFAULT NULL, upper_limit NUMERIC(2, 2) DEFAULT NULL, markup_percentage INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B0B1CA144584665A ON goods_margin (product_id)');
        $this->addSql('CREATE INDEX IDX_B0B1CA1412469DE2 ON goods_margin (category_id)');
        $this->addSql('CREATE TABLE manufacturer (id INT NOT NULL, manufacture_name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3D0AE6DC4189B1B ON manufacturer (manufacture_name)');
        $this->addSql('CREATE TABLE "organization" (id INT NOT NULL, organization_name VARCHAR(255) DEFAULT NULL, shortname VARCHAR(255) DEFAULT NULL, registration_number VARCHAR(255) DEFAULT NULL, inn VARCHAR(255) DEFAULT NULL, kpp VARCHAR(255) DEFAULT NULL, ifns_code VARCHAR(255) DEFAULT NULL, data VARCHAR(255) DEFAULT NULL, legal_address VARCHAR(255) DEFAULT NULL, passport VARCHAR(255) DEFAULT NULL, ogrnip VARCHAR(255) DEFAULT NULL, account_number VARCHAR(255) DEFAULT NULL, account_type VARCHAR(255) DEFAULT NULL, bank_bik VARCHAR(255) DEFAULT NULL, firm VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C1EE637C672A409B ON "organization" (organization_name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C1EE637C38CEDFBE ON "organization" (registration_number)');
        $this->addSql('CREATE TABLE pharmacy (id INT NOT NULL, organization_id INT DEFAULT NULL, pharmacy_name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, coordinates VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, schedule VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D6C15C1E32C8A3DE ON pharmacy (organization_id)');
        $this->addSql('CREATE TABLE pricing_category (id INT NOT NULL, category_name VARCHAR(255) NOT NULL, pricing_percentage INT NOT NULL, stretch_option VARCHAR(255) NOT NULL, is_stretch_to BOOLEAN DEFAULT NULL, stretch_to INT DEFAULT NULL, is_stretch_over_border BOOLEAN DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE product (id INT NOT NULL, type_id INT DEFAULT NULL, subtype_id INT DEFAULT NULL, active_substance_id INT DEFAULT NULL, goods_margin_id INT DEFAULT NULL, type_markup_id INT DEFAULT NULL, product_name VARCHAR(255) NOT NULL, is_vital_necessity BOOLEAN NOT NULL, is_sign_oa BOOLEAN NOT NULL, is_sign_pkkn BOOLEAN NOT NULL, total INT DEFAULT NULL, free INT DEFAULT NULL, reserve INT DEFAULT NULL, obligatory_1 BOOLEAN DEFAULT NULL, obligatory_2 BOOLEAN DEFAULT NULL, top_sales BOOLEAN DEFAULT NULL, mandatory_assortyment BOOLEAN DEFAULT NULL, label_printing BOOLEAN DEFAULT NULL, tax INT NOT NULL, is_stop_sales BOOLEAN DEFAULT NULL, is_not_public BOOLEAN DEFAULT NULL, batch INT NOT NULL, is_dont_take_manufacturer BOOLEAN DEFAULT NULL, sales_limit INT NOT NULL, price_in_register INT NOT NULL, date_of_registration VARCHAR(255) DEFAULT NULL, base_unit VARCHAR(255) NOT NULL, unit_for_sales VARCHAR(255) NOT NULL, is_close_division BOOLEAN DEFAULT NULL, conversion_factor INT DEFAULT NULL, grouping INT DEFAULT NULL, is_grouping BOOLEAN DEFAULT NULL, is_included_plan BOOLEAN DEFAULT NULL, is_custom BOOLEAN DEFAULT NULL, plan_group VARCHAR(255) DEFAULT NULL, abc_group VARCHAR(255) DEFAULT NULL, minimum_balance INT DEFAULT NULL, minimum_lot_order INT DEFAULT NULL, price INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D34A04ADC54C8C93 ON product (type_id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD8E2E245C ON product (subtype_id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD265D87F5 ON product (active_substance_id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADF01D72F2 ON product (goods_margin_id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD396B7EF2 ON product (type_markup_id)');
        $this->addSql('CREATE TABLE product_manufacturer (product_id INT NOT NULL, manufacturer_id INT NOT NULL, PRIMARY KEY(product_id, manufacturer_id))');
        $this->addSql('CREATE INDEX IDX_B0AEC4B74584665A ON product_manufacturer (product_id)');
        $this->addSql('CREATE INDEX IDX_B0AEC4B7A23B42D ON product_manufacturer (manufacturer_id)');
        $this->addSql('CREATE TABLE product_pharmacy (product_id INT NOT NULL, pharmacy_id INT NOT NULL, PRIMARY KEY(product_id, pharmacy_id))');
        $this->addSql('CREATE INDEX IDX_1D7136894584665A ON product_pharmacy (product_id)');
        $this->addSql('CREATE INDEX IDX_1D7136898A94ABE2 ON product_pharmacy (pharmacy_id)');
        $this->addSql('CREATE TABLE provider (id INT NOT NULL, client_type_id INT DEFAULT NULL, provider_name VARCHAR(255) NOT NULL, inn VARCHAR(255) DEFAULT NULL, full_name VARCHAR(255) NOT NULL, phone VARCHAR(255) DEFAULT NULL, region VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, consignee_name VARCHAR(255) DEFAULT NULL, consignee_address VARCHAR(255) DEFAULT NULL, ogrn VARCHAR(255) DEFAULT NULL, okpo VARCHAR(255) DEFAULT NULL, okonh VARCHAR(255) DEFAULT NULL, kpp VARCHAR(255) DEFAULT NULL, is_invoice BOOLEAN DEFAULT NULL, is_ndsaccounting BOOLEAN DEFAULT NULL, is_ndssum BOOLEAN DEFAULT NULL, is_npaccounting BOOLEAN DEFAULT NULL, is_npsum BOOLEAN DEFAULT NULL, bank_account VARCHAR(255) DEFAULT NULL, bank VARCHAR(255) DEFAULT NULL, bank_address VARCHAR(255) DEFAULT NULL, correspondent_bank VARCHAR(255) DEFAULT NULL, correspondent_account VARCHAR(255) DEFAULT NULL, bik VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_92C4739C9771C8EE ON provider (client_type_id)');
        $this->addSql('CREATE TABLE provider_manufacturer (provider_id INT NOT NULL, manufacturer_id INT NOT NULL, PRIMARY KEY(provider_id, manufacturer_id))');
        $this->addSql('CREATE INDEX IDX_6E7CEA61A53A8AA ON provider_manufacturer (provider_id)');
        $this->addSql('CREATE INDEX IDX_6E7CEA61A23B42D ON provider_manufacturer (manufacturer_id)');
        $this->addSql('CREATE TABLE "soletrader" (id INT NOT NULL, sole_trader_name VARCHAR(255) NOT NULL, ogrnip VARCHAR(255) NOT NULL, inn VARCHAR(255) NOT NULL, account_number VARCHAR(255) NOT NULL, account_type VARCHAR(255) NOT NULL, bank_bik VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE subtype (id INT NOT NULL, type_id INT DEFAULT NULL, subtype_name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_556B25A2C54C8C93 ON subtype (type_id)');
        $this->addSql('CREATE TABLE treaty (id INT NOT NULL, provider_id INT DEFAULT NULL, treaty_number VARCHAR(255) DEFAULT NULL, treaty_type INT NOT NULL, treaty_date VARCHAR(255) NOT NULL, expiration_date VARCHAR(255) DEFAULT NULL, claim_period VARCHAR(255) DEFAULT NULL, deferment_fee VARCHAR(255) DEFAULT NULL, surplus_interest INT DEFAULT NULL, natural_discount INT DEFAULT NULL, financial_discount INT DEFAULT NULL, payment_percentage INT DEFAULT NULL, payment_deferment INT DEFAULT NULL, reserve_deferral INT DEFAULT NULL, deferred_payment_type VARCHAR(255) DEFAULT NULL, reserve_deferral_type VARCHAR(255) NOT NULL, is_not_control_credit BOOLEAN DEFAULT NULL, is_sales_contract BOOLEAN DEFAULT NULL, credit_depth INT DEFAULT NULL, amount_credit VARCHAR(255) DEFAULT NULL, minimum_delivery_lot INT DEFAULT NULL, estimated_delivery_time INT DEFAULT NULL, replacement_term_goods VARCHAR(255) DEFAULT NULL, is_default BOOLEAN DEFAULT NULL, is_block BOOLEAN DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_85048E97A53A8AA ON treaty (provider_id)');
        $this->addSql('CREATE TABLE type (id INT NOT NULL, pricing_category_id INT DEFAULT NULL, type_name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8CDE57295B04C064 ON type (pricing_category_id)');
        $this->addSql('CREATE TABLE type_markup (id INT NOT NULL, product_type_id INT DEFAULT NULL, product_subtype_id INT DEFAULT NULL, category_id INT DEFAULT NULL, lower_limit INT DEFAULT NULL, upper_limit NUMERIC(2, 2) DEFAULT NULL, markup_percentage INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5D438BB14959723 ON type_markup (product_type_id)');
        $this->addSql('CREATE INDEX IDX_5D438BB1D497B77 ON type_markup (product_subtype_id)');
        $this->addSql('CREATE INDEX IDX_5D438BB12469DE2 ON type_markup (category_id)');
        $this->addSql('CREATE TABLE unit (id INT NOT NULL, product_id INT DEFAULT NULL, unit VARCHAR(255) NOT NULL, unit_code VARCHAR(255) NOT NULL, coefficient VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DCBB0C534584665A ON unit (product_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, organization_id INT DEFAULT NULL, pharmacy_id INT DEFAULT NULL, tab_number VARCHAR(255) NOT NULL, user_identifier VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, patronymic VARCHAR(255) DEFAULT NULL, date_of_birth VARCHAR(255) NOT NULL, gender VARCHAR(255) NOT NULL, subdomain VARCHAR(255) NOT NULL, registration_data VARCHAR(255) NOT NULL, phone VARCHAR(255) DEFAULT NULL, roles JSON NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6493731581C ON "user" (tab_number)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649D0494586 ON "user" (user_identifier)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64935C246D5 ON "user" (password)');
        $this->addSql('CREATE INDEX IDX_8D93D64932C8A3DE ON "user" (organization_id)');
        $this->addSql('CREATE INDEX IDX_8D93D6498A94ABE2 ON "user" (pharmacy_id)');
        $this->addSql('ALTER TABLE bar_code ADD CONSTRAINT FK_70D524AAA23B42D FOREIGN KEY (manufacturer_id) REFERENCES manufacturer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE goods_margin ADD CONSTRAINT FK_B0B1CA144584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE goods_margin ADD CONSTRAINT FK_B0B1CA1412469DE2 FOREIGN KEY (category_id) REFERENCES pricing_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pharmacy ADD CONSTRAINT FK_D6C15C1E32C8A3DE FOREIGN KEY (organization_id) REFERENCES "organization" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD8E2E245C FOREIGN KEY (subtype_id) REFERENCES subtype (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD265D87F5 FOREIGN KEY (active_substance_id) REFERENCES active_substance (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADF01D72F2 FOREIGN KEY (goods_margin_id) REFERENCES goods_margin (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD396B7EF2 FOREIGN KEY (type_markup_id) REFERENCES type_markup (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_manufacturer ADD CONSTRAINT FK_B0AEC4B74584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_manufacturer ADD CONSTRAINT FK_B0AEC4B7A23B42D FOREIGN KEY (manufacturer_id) REFERENCES manufacturer (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_pharmacy ADD CONSTRAINT FK_1D7136894584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_pharmacy ADD CONSTRAINT FK_1D7136898A94ABE2 FOREIGN KEY (pharmacy_id) REFERENCES pharmacy (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE provider ADD CONSTRAINT FK_92C4739C9771C8EE FOREIGN KEY (client_type_id) REFERENCES client_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE provider_manufacturer ADD CONSTRAINT FK_6E7CEA61A53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE provider_manufacturer ADD CONSTRAINT FK_6E7CEA61A23B42D FOREIGN KEY (manufacturer_id) REFERENCES manufacturer (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE subtype ADD CONSTRAINT FK_556B25A2C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE treaty ADD CONSTRAINT FK_85048E97A53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE type ADD CONSTRAINT FK_8CDE57295B04C064 FOREIGN KEY (pricing_category_id) REFERENCES pricing_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE type_markup ADD CONSTRAINT FK_5D438BB14959723 FOREIGN KEY (product_type_id) REFERENCES type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE type_markup ADD CONSTRAINT FK_5D438BB1D497B77 FOREIGN KEY (product_subtype_id) REFERENCES subtype (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE type_markup ADD CONSTRAINT FK_5D438BB12469DE2 FOREIGN KEY (category_id) REFERENCES pricing_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE unit ADD CONSTRAINT FK_DCBB0C534584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D64932C8A3DE FOREIGN KEY (organization_id) REFERENCES "organization" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D6498A94ABE2 FOREIGN KEY (pharmacy_id) REFERENCES pharmacy (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE active_substance_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE bar_code_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE client_type_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE goods_margin_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE manufacturer_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "organization_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE pharmacy_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pricing_category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE product_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE provider_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "soletrader_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE subtype_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE treaty_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE type_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE type_markup_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE unit_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('ALTER TABLE bar_code DROP CONSTRAINT FK_70D524AAA23B42D');
        $this->addSql('ALTER TABLE goods_margin DROP CONSTRAINT FK_B0B1CA144584665A');
        $this->addSql('ALTER TABLE goods_margin DROP CONSTRAINT FK_B0B1CA1412469DE2');
        $this->addSql('ALTER TABLE pharmacy DROP CONSTRAINT FK_D6C15C1E32C8A3DE');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT FK_D34A04ADC54C8C93');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT FK_D34A04AD8E2E245C');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT FK_D34A04AD265D87F5');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT FK_D34A04ADF01D72F2');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT FK_D34A04AD396B7EF2');
        $this->addSql('ALTER TABLE product_manufacturer DROP CONSTRAINT FK_B0AEC4B74584665A');
        $this->addSql('ALTER TABLE product_manufacturer DROP CONSTRAINT FK_B0AEC4B7A23B42D');
        $this->addSql('ALTER TABLE product_pharmacy DROP CONSTRAINT FK_1D7136894584665A');
        $this->addSql('ALTER TABLE product_pharmacy DROP CONSTRAINT FK_1D7136898A94ABE2');
        $this->addSql('ALTER TABLE provider DROP CONSTRAINT FK_92C4739C9771C8EE');
        $this->addSql('ALTER TABLE provider_manufacturer DROP CONSTRAINT FK_6E7CEA61A53A8AA');
        $this->addSql('ALTER TABLE provider_manufacturer DROP CONSTRAINT FK_6E7CEA61A23B42D');
        $this->addSql('ALTER TABLE subtype DROP CONSTRAINT FK_556B25A2C54C8C93');
        $this->addSql('ALTER TABLE treaty DROP CONSTRAINT FK_85048E97A53A8AA');
        $this->addSql('ALTER TABLE type DROP CONSTRAINT FK_8CDE57295B04C064');
        $this->addSql('ALTER TABLE type_markup DROP CONSTRAINT FK_5D438BB14959723');
        $this->addSql('ALTER TABLE type_markup DROP CONSTRAINT FK_5D438BB1D497B77');
        $this->addSql('ALTER TABLE type_markup DROP CONSTRAINT FK_5D438BB12469DE2');
        $this->addSql('ALTER TABLE unit DROP CONSTRAINT FK_DCBB0C534584665A');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D64932C8A3DE');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D6498A94ABE2');
        $this->addSql('DROP TABLE active_substance');
        $this->addSql('DROP TABLE bar_code');
        $this->addSql('DROP TABLE client_type');
        $this->addSql('DROP TABLE goods_margin');
        $this->addSql('DROP TABLE manufacturer');
        $this->addSql('DROP TABLE "organization"');
        $this->addSql('DROP TABLE pharmacy');
        $this->addSql('DROP TABLE pricing_category');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_manufacturer');
        $this->addSql('DROP TABLE product_pharmacy');
        $this->addSql('DROP TABLE provider');
        $this->addSql('DROP TABLE provider_manufacturer');
        $this->addSql('DROP TABLE "soletrader"');
        $this->addSql('DROP TABLE subtype');
        $this->addSql('DROP TABLE treaty');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE type_markup');
        $this->addSql('DROP TABLE unit');
        $this->addSql('DROP TABLE "user"');
    }
}
