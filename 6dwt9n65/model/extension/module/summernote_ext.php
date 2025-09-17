<?php
class ModelExtensionModuleSummernoteExt extends Model {
	
	   public function install() {
	    $this->load->language('extension/module/summernote_ext');
		   			
		$store_name = $this->config->get('config_name');
		
		$store_url = HTTP_CATALOG ;	
 		$subject = $this->language->get('text_subject');
        $message = $this->language->get('text_message');
		
		$message .= "\n\n";
		$message .= 'Store URL- '.$store_url . "\n\n";
		$message .= 'Store Email- '.$this->config->get('config_email') . "\n\n";
		$message .= 'Store Name- '.html_entity_decode($store_name, ENT_QUOTES, 'UTF-8');

		/*$mail = new Mail();
		$mail->protocol = $this->config->get('config_mail_protocol');
		$mail->parameter = $this->config->get('config_mail_parameter');
		$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
		$mail->smtp_username = $this->config->get('config_mail_smtp_username');
		$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
		$mail->smtp_port = $this->config->get('config_mail_smtp_port');
		$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

		$mail->setTo('sales@mikadesign.co.uk');
		$mail->setFrom($this->config->get('config_email'));
		$mail->setSender(html_entity_decode($store_name, ENT_QUOTES, 'UTF-8'));
		$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));		
		$mail->setText($message);
		$mail->send();*/
		
			
		/*Send to customer*/		
		$mail = new Mail();
        $mail->protocol = $this->config->get('config_mail_protocol');
        $mail->parameter = $this->config->get('config_mail_parameter');

        $mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
        $mail->smtp_username = $this->config->get('config_mail_smtp_username');
        $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
        $mail->smtp_port = $this->config->get('config_mail_smtp_port');
        $mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

        $subject = $this->language->get('customer_subject');
        $message = $this->language->get('customer_message');

        $mail->setTo($this->config->get('config_email'));
        $mail->setFrom($this->config->get('config_email'));
        $mail->setSender($this->config->get('config_name'));
        $mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
        $mail->setText(strip_tags($message));
        $mail->setHtml($message);
		$mail->send();		
			  
	  }	
	}
?>