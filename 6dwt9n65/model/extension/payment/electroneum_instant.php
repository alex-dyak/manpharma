<?php
class ModelExtensionPaymentElectroneumInstant extends Model{

    public function install(){
       
        // Create database table for recording payments sent via webhook from Electroneum Ltd
        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "electroneum_payments` (
				`payment_ref` VARCHAR(13) NOT NULL COMMENT 'Payload - Ref',
				`payment_date` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP COMMENT 'Header - DateTime',
				`payment_host` INT(30) NOT NULL COMMENT 'Header - Host',
				`payment_signature` VARCHAR(64) NOT NULL COMMENT 'Header - Etn-signature',
				`payment_id` VARCHAR(10) NOT NULL COMMENT 'Payload - Payment ID',
				`payment_amount` FLOAT NOT NULL COMMENT 'Payload - Amount',
				`payment_key` VARCHAR(32) NOT NULL COMMENT 'Payload - API Key',
				`payment_sent` DATETIME NOT NULL COMMENT 'Payload - Sent',
				`payment_email` TEXT NOT NULL COMMENT 'Payload - Customer Email',
				`payment_event` TEXT NOT NULL COMMENT 'Payload - type of transaction',
				PRIMARY KEY (`payment_ref`)
	  			) ENGINE = InnoDB"
        );
    }

    public function uninstall(){
        // Remove database table when uninstalling
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "electroneum_payments`;");
    }

    public function getPayments(){

        //load transactions from database
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "electroneum_payments LIMIT 50");
        $payments = $query->rows;
        return $payments;
    }
}

