<?php
class ModelCatalogSTestimonial extends Model {
	public function addTestimonial($data) {
		$sql = "";
		
		if (isset($data['title'])) { 
			$sql .= "title = '" . $this->db->escape($data['title']) . "', "; 
		}
		
		if (isset($data['city'])) { 
			$sql .= "city = '" . $this->db->escape($data['city']) . "', "; 
		}
		
		if (isset($data['email'])) {
			$sql .= "email='" . $this->db->escape($data['email']) . "', "; 
		}
		
		if (isset($data['name'])) {
			$sql .= "name='" . $this->db->escape($data['name']) . "', "; 
		}
		
		if (isset($data['text'])) {
			$sql .= "text='" . $this->db->escape($data['text']) . "', "; 
		}
		
		if (isset($data['good'])) {
			$sql .= "good='" . $this->db->escape($data['good']) . "', "; 
		}
		
		if (isset($data['bad'])) {
			$sql .= "bad='" . $this->db->escape($data['bad']) . "', "; 
		}
		
		if (isset($data['rating'])) {
			$sql .= "rating='" . $this->db->escape($data['rating']) . "', "; 
		}
		
		if (isset($data['avatar'])) {
			$sql .= "avatar='" . $this->db->escape($data['avatar']) . "', "; 
		}
		
		if (isset($data['image'])) {
			$sql .= "image='" . $this->db->escape(implode('|', array_diff($data['image'], array('')))) . "', "; 
		}
		
		$this->db->query("INSERT INTO " . DB_PREFIX . "s_testimonial SET " . $sql . "status = '" . (int)$data['status'] . "', language_id = '" . (int)$data['language_id'] . "', date_added = '" . $this->db->escape($data['date_added']) . "', comment = '" . $this->db->escape($data['comment']) . "'");
		
		$testimonial_id = $this->db->getLastId();
		
		if (isset($data['testimonial_store'])) {
			foreach ($data['testimonial_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "s_testimonial_to_store SET testimonial_id = '" . (int)$testimonial_id . "', store_id = '" . (int)$store_id . "'");
			}
		}
		
		// SEO URL
		if (isset($data['testimonial_seo_url'])) {
			foreach ($data['testimonial_seo_url'] as $store_id => $language) {
				foreach ($language as $language_id => $keyword) {
					if (!empty($keyword)) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "seo_url SET store_id = '" . (int)$store_id . "', language_id = '" . (int)$language_id . "', query = 'testimonial_id=" . (int)$testimonial_id . "', keyword = '" . $this->db->escape($keyword) . "'");
					}
				}
			}
		}
		
		if (isset($data['testimonial_layout'])) {
			foreach ($data['testimonial_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "s_testimonial_to_layout SET testimonial_id = '" . (int)$testimonial_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}
	}
	
	public function editTestimonial($testimonial_id, $data) {
		$sql = "";
		
		if (isset($data['title'])) { 
			$sql .= "title = '" . $this->db->escape($data['title']) . "', "; 
		}
		
		if (isset($data['city'])) { 
			$sql .= "city = '" . $this->db->escape($data['city']) . "', "; 
		}
		
		if (isset($data['email'])) {
			$sql .= "email='" . $this->db->escape($data['email']) . "', "; 
		}
		
		if (isset($data['name'])) {
			$sql .= "name='" . $this->db->escape($data['name']) . "', "; 
		}
		
		if (isset($data['text'])) {
			$sql .= "text='" . $this->db->escape($data['text']) . "', "; 
		}
		
		if (isset($data['good'])) {
			$sql .= "good='" . $this->db->escape($data['good']) . "', "; 
		}
		
		if (isset($data['bad'])) {
			$sql .= "bad='" . $this->db->escape($data['bad']) . "', "; 
		}
		
		if (isset($data['rating'])) {
			$sql .= "rating='" . $this->db->escape($data['rating']) . "', "; 
		}
		
		if (isset($data['avatar'])) {
			$sql .= "avatar='" . $this->db->escape($data['avatar']) . "', "; 
		}
		
		if (isset($data['image'])) {
			$sql .= "image='" . $this->db->escape(implode('|', array_diff($data['image'], array('')))) . "', "; 
		}
		
		$this->db->query("UPDATE " . DB_PREFIX . "s_testimonial SET " . $sql . "status = '" . (int)$data['status'] . "', language_id = '" . (int)$data['language_id'] . "', date_added = '" . $this->db->escape($data['date_added']) . "', comment = '" . $this->db->escape($data['comment']) . "' WHERE testimonial_id = '" . (int)$testimonial_id . "'");
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "s_testimonial_to_store WHERE testimonial_id = '" . (int)$testimonial_id . "'");

		if (isset($data['testimonial_store'])) {
			foreach ($data['testimonial_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "s_testimonial_to_store SET testimonial_id = '" . (int)$testimonial_id . "', store_id = '" . (int)$store_id . "'");
			}
		}
		
		// SEO URL
		$this->db->query("DELETE FROM " . DB_PREFIX . "seo_url WHERE query = 'testimonial_id=" . (int)$testimonial_id . "'");
		
		if (isset($data['testimonial_seo_url'])) {
			foreach ($data['testimonial_seo_url']as $store_id => $language) {
				foreach ($language as $language_id => $keyword) {
					if (!empty($keyword)) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "seo_url SET store_id = '" . (int)$store_id . "', language_id = '" . (int)$language_id . "', query = 'testimonial_id=" . (int)$testimonial_id . "', keyword = '" . $this->db->escape($keyword) . "'");
					}
				}
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "s_testimonial_to_layout WHERE testimonial_id = '" . (int)$testimonial_id . "'");

		if (isset($data['testimonial_layout'])) {
			foreach ($data['testimonial_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "s_testimonial_to_layout SET testimonial_id = '" . (int)$testimonial_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}
		
		if (isset($data['alert']) && $data['alert']) {
			$this->load->model('localisation/language');

			$language_info = $this->model_localisation_language->getLanguage($data['language_id']);

			if ($language_info) {
				$language_code = $language_info['code'];
			} else {
				$language_code = $this->config->get('config_language');
			}
			
			$language = new Language($language_code);
			$language->load($language_code);
			$language->load('mail/s_testimonial');
			
			$subject = sprintf($language->get('text_subject'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
			
			// Text Mail
			$message  = $language->get('text_comment') . "\n";
			$message .= strip_tags(html_entity_decode($data['comment'], ENT_QUOTES, 'UTF-8')) . "\n\n";
			$message .= $language->get('text_link') . "\n";
			$message .= $data['store_url'] . 'index.php?route=information/testimonial/info&testimonial_id=' . (int)$testimonial_id . "\n\n";
			$message .= $language->get('text_footer');
			
			// Html Mail
			$data['title'] = $language->get('text_subject');
			$data['text_comment'] = $language->get('text_comment');
			$data['text_link'] = $language->get('text_link');
			$data['text_footer'] = $language->get('text_footer');
			
			$data['comment'] = html_entity_decode($data['comment'], ENT_QUOTES, 'UTF-8');
			
			$data['logo'] = $data['store_url'] . 'image/' . $this->config->get('config_logo');
			$data['testimonial_url'] = $data['store_url'] . 'index.php?route=information/testimonial/info&testimonial_id=' . (int)$testimonial_id;
			
			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

			$mail->setTo($data['email']);
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
			$mail->setSubject($subject);
			$mail->setText($message);
			$mail->setHtml($this->load->view('mail/s_testimonial', $data));
			$mail->send();
		}
	}
	
	public function deleteTestimonial($testimonial_id) {
		$query = $this->db->query("SELECT avatar, image FROM " . DB_PREFIX . "s_testimonial WHERE testimonial_id = '" . (int)$testimonial_id . "'");
		
		if ($query->row) {
			
			if (is_file(DIR_IMAGE . $query->row['avatar'])) {
				unlink(DIR_IMAGE . $query->row['avatar']);
			}
			
			if ($query->row['image']) {
				
				foreach (explode('|', $query->row['image']) as $value) {
					
					if (is_file(DIR_IMAGE . $value)) {
						unlink(DIR_IMAGE . $value);
					}
				}
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "s_testimonial WHERE testimonial_id = '" . (int)$testimonial_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "s_testimonial_to_store WHERE testimonial_id = '" . (int)$testimonial_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "seo_url WHERE query = 'testimonial_id=" . (int)$testimonial_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "s_testimonial_to_layout WHERE testimonial_id = '" . (int)$testimonial_id . "'");
	}	

	public function getTestimonial($testimonial_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "s_testimonial WHERE testimonial_id = '" . (int)$testimonial_id . "'");
		
		return $query->row;
	}
		
	public function getTestimonials($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "s_testimonial";
		
		$sort_data = array(			
			'title',
			'city',
			'name',
			'email',
			'text',
			'good',
			'bad',
			'rating',
			'language_id',
			'date_added',
			'status'
		);
	
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY date_added";	
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}
	
		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}		

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}	
		
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}	
		
		$query = $this->db->query($sql);
		
		return $query->rows;
	}

	public function getTestimonialStores($testimonial_id) {
		$testimonial_store_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "s_testimonial_to_store WHERE testimonial_id = '" . (int)$testimonial_id . "'");

		foreach ($query->rows as $result) {
			$testimonial_store_data[] = $result['store_id'];
		}

		return $testimonial_store_data;
	}
	
	public function getTotalTestimonials() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "s_testimonial");
		
		return $query->row['total'];
	}
	
	public function editTestimonialSeoUrl($seo_url) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "seo_url WHERE query = 'information/testimonial'");
		
		if ($seo_url) {
			foreach ($seo_url as $store_id => $language) {
				foreach ($language as $language_id => $keyword) {
					if (!empty($keyword)) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "seo_url SET store_id = '" . (int)$store_id . "', language_id = '" . (int)$language_id . "', query = 'information/testimonial', keyword = '" . $this->db->escape($keyword) . "'");
					}
				}
			}
		}
	}
	
	public function getTestimonialSeoUrls($testimonial_id) {
		$testimonial_seo_url_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "seo_url WHERE query = 'testimonial_id=" . (int)$testimonial_id . "'");

		foreach ($query->rows as $result) {
			$testimonial_seo_url_data[$result['store_id']][$result['language_id']] = $result['keyword'];
		}

		return $testimonial_seo_url_data;
	}
	
	public function getTestimonialLayouts($testimonial_id) {
		$testimonial_layout_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "s_testimonial_to_layout WHERE testimonial_id = '" . (int)$testimonial_id . "'");

		foreach ($query->rows as $result) {
			$testimonial_layout_data[$result['store_id']] = $result['layout_id'];
		}

		return $testimonial_layout_data;
	}
	
	public function getOldTable() {
		$query = $this->db->query("SHOW TABLES LIKE '" . DB_PREFIX . "testimonial';");
		
		if ($query->rows) {
			return true;
		} else {
			return false;
		}
	}
	
	public function updateTestimonials() {
		$this->db->query("INSERT INTO " . DB_PREFIX . "s_testimonial (testimonial_id, email, title, text, good, comment, bad, name, city, status, rating, avatar, date_added) SELECT testimonial_id, email, title, text, good, comment, bad, name, city, status, rating, photo AS avatar, date_added FROM " . DB_PREFIX . "testimonial;");
		
		$this->db->query("INSERT INTO " . DB_PREFIX . "s_testimonial_to_store (testimonial_id, store_id) SELECT testimonial_id, store_id FROM " . DB_PREFIX . "testimonial_to_store;");
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "seo_url WHERE query = 'product/testimonial'");
		
		$this->db->query("DROP TABLE " . DB_PREFIX . "testimonial;");
		$this->db->query("DROP TABLE " . DB_PREFIX . "testimonial_to_store;");
	}
	
	public function createDatabaseTables() {
		$sql  = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "s_testimonial` ( ";
		$sql .= "`testimonial_id` int(11) NOT NULL AUTO_INCREMENT, "; 
		$sql .= "`language_id`  int(11) NOT NULL, ";
		$sql .= "`title` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '', ";
		$sql .= "`city` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '', ";
		$sql .= "`name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '', ";
		$sql .= "`email` varchar(96) COLLATE utf8_unicode_ci NOT NULL DEFAULT '', ";
		$sql .= "`text` text COLLATE utf8_unicode_ci NOT NULL DEFAULT '', ";
		$sql .= "`good` text COLLATE utf8_unicode_ci NOT NULL DEFAULT '', ";
		$sql .= "`bad` text COLLATE utf8_unicode_ci NOT NULL DEFAULT '', ";
		$sql .= "`comment` text COLLATE utf8_unicode_ci NOT NULL DEFAULT '', ";
		$sql .= "`avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '', ";
		$sql .= "`status` int(1) NOT NULL DEFAULT '0', ";
		$sql .= "`rating` int(1) NOT NULL DEFAULT '0', ";
		$sql .= "`date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00', ";
		$sql .= "PRIMARY KEY (`testimonial_id`) ";
		$sql .= ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;";
		$this->db->query($sql);
		
		// store_url
		$query = $this->db->query("SHOW COLUMNS FROM " . DB_PREFIX . "s_testimonial");
		$store_url = false;

		if ($query->rows) {
			
			foreach ($query->rows as $row) {
				if ($row['Field'] == 'store_url') {
					$store_url = true;
				}
			}

			if (!$store_url) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "s_testimonial`  ADD `store_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '';");
			}
		}
		
		// store_name
		$query = $this->db->query("SHOW COLUMNS FROM " . DB_PREFIX . "s_testimonial");
		$store_name = false;

		if ($query->rows) {
			
			foreach ($query->rows as $row) {
				if ($row['Field'] == 'store_name') {
					$store_name = true;
				}
			}

			if (!$store_name) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "s_testimonial`  ADD `store_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '';");
			}
		}
		
		// image
		$query = $this->db->query("SHOW COLUMNS FROM " . DB_PREFIX . "s_testimonial");
		$image = false;

		if ($query->rows) {
			
			foreach ($query->rows as $row) {
				if ($row['Field'] == 'image') {
					$image = true;
				}
			}

			if (!$image) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "s_testimonial`  ADD `image` TEXT NOT NULL;");
			}
		}
		
		$sql  = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "s_testimonial_to_store` ( ";
		$sql .= "`testimonial_id` int(11) NOT NULL, ";
		$sql .= "`store_id` int(11) NOT NULL, ";
		$sql .= "PRIMARY KEY (`testimonial_id`,`store_id`) ";
		$sql .= ") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
		$this->db->query($sql);
		
		$sql  = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "s_testimonial_to_layout` ( ";
		$sql .= "`testimonial_id` int(11) NOT NULL, ";
		$sql .= "`store_id` int(11) NOT NULL, ";
		$sql .= "`layout_id` int(11) NOT NULL, ";
		$sql .= "PRIMARY KEY (`testimonial_id`,`store_id`) ";
		$sql .= ") ENGINE=MyISAM DEFAULT CHARSET=utf8;";
		$this->db->query($sql);
		
		$this->load->model('user/user_group');
		$this->model_user_user_group->addPermission($this->user->getGroupId(), 'access', 'catalog/s_testimonial');
		$this->model_user_user_group->addPermission($this->user->getGroupId(), 'modify', 'catalog/s_testimonial');
	}
	
	public function clearBBCode($text_post) {
		$str_search = array();
		$str_replace = array();
						
		$smile_list = $this->getSmiles();
		
		$str_search = array(
			"#\[video\](.+?)\[\/video\]#is",
		    "#\\\n#is",
		    "#\[b\](.+?)\[\/b\]#is",
		    "#\[i\](.+?)\[\/i\]#is",
		    "#\[u\](.+?)\[\/u\]#is",
			"#\[s\](.+?)\[\/s\]#is",
		    "#\[quote\](.+?)\[\/quote\]#is",
		    "#\[url=(.+?)\](.+?)\[\/url\]#is",
		    "#\[url\](.+?)\[\/url\]#is",
			"#\[img\](.+?)\[\/img\]#is",
		    "#\[size=(.+?)\](.+?)\[\/size\]#is",
		    "#\[color=(.+?)\](.+?)\[\/color\]#is",
		    "#\[list\](.+?)\[\/list\]#is",
		    "#\[list=1](.+?)\[\/list\]#is",
		    "#\[\*\](.+?)\[\/\*\]#"
		);
		
		foreach ($smile_list as $smile) {
			$str_search[] = "#\:" . $smile['name'] . "\:#";
		}
		
		$str_replace = array(
			"",
			" ",
			"\\1",
			"\\1",
			"\\1",
			"\\1",
			"\\1",
			"\\2",
			"\\1",
			"",
			"\\2",
			"\\2",
			"",
			"",
			"\\1"
		);
		
		foreach ($smile_list as $smile) {
			$str_replace[] = "";
		}
    
		return preg_replace($str_search, $str_replace, $text_post);
    }
	
	public function getSmiles() {
		$theme = $this->config->get('module_s_testimonial_smile_theme');
		
		if ($this->request->server['HTTPS']) {
			$server = HTTPS_CATALOG;
		} else {
			$server = HTTP_CATALOG;
		}
		
		$server .= 'image/catalog/s_testimonial/smile/' . $theme;
		
		$folder = DIR_IMAGE . 'catalog/s_testimonial/smile/' . $theme;
		
		$filename_list = array_diff(scandir($folder), array('..', '.'));
		
		$smile_list = array();
		
		if ($filename_list) {
			foreach ($filename_list as $filename) {
				if (is_file($folder . '/' . $filename)) {
					$path = $server . '/' . $filename;
					
					$smile_list[] = array( 
						'url'  => $path,
						'name' => pathinfo($path, PATHINFO_FILENAME)
					);
				}
			}
		}
		
		return $smile_list;
	}
}