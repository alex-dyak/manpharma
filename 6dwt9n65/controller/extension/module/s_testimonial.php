<?php
class ControllerExtensionModuleSTestimonial extends Controller {
	private $error = array(); 
	
	public function index() {  
		$this->load->language('extension/module/s_testimonial');
		
		$this->load->model('catalog/s_testimonial');

		$this->document->setTitle(strip_tags($this->language->get('heading_title')));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('module_s_testimonial', $this->request->post);

			$this->model_catalog_s_testimonial->editTestimonialSeoUrl($this->request->post['module_s_testimonial_seo_url']);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}
		
		$data['user_token'] = $this->session->data['user_token'];
		
		$data['update'] = $this->model_catalog_s_testimonial->getOldTable();
		
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->error['limit'])) {
			$data['error_limit'] = $this->error['limit'];
		} else {
			$data['error_limit'] = '';
		}
		
		if (isset($this->error['text_limit'])) {
			$data['error_text_limit'] = $this->error['text_limit'];
		} else {
			$data['error_text_limit'] = '';
		}
		
		if (isset($this->error['image_limit'])) {
			$data['error_image_limit'] = $this->error['image_limit'];
		} else {
			$data['error_image_limit'] = '';
		}
		
		if (isset($this->error['upload_avatar_width'])) {
			$data['error_upload_avatar_width'] = $this->error['upload_avatar_width'];
		} else {
			$data['error_upload_avatar_width'] = '';
		}

		if (isset($this->error['upload_avatar_height'])) {
			$data['error_upload_avatar_height'] = $this->error['upload_avatar_height'];
		} else {
			$data['error_upload_avatar_height'] = '';
		}
		
		if (isset($this->error['upload_image_width'])) {
			$data['error_upload_image_width'] = $this->error['upload_image_width'];
		} else {
			$data['error_upload_image_width'] = '';
		}

		if (isset($this->error['upload_image_height'])) {
			$data['error_upload_image_height'] = $this->error['upload_image_height'];
		} else {
			$data['error_upload_image_height'] = '';
		}
		
		if (isset($this->error['avatar_width'])) {
			$data['error_avatar_width'] = $this->error['avatar_width'];
		} else {
			$data['error_avatar_width'] = '';
		}

		if (isset($this->error['avatar_height'])) {
			$data['error_avatar_height'] = $this->error['avatar_height'];
		} else {
			$data['error_avatar_height'] = '';
		}
		
		if (isset($this->error['avatar_info_width'])) {
			$data['error_avatar_info_width'] = $this->error['avatar_info_width'];
		} else {
			$data['error_avatar_info_width'] = '';
		}

		if (isset($this->error['avatar_info_height'])) {
			$data['error_avatar_info_height'] = $this->error['avatar_info_height'];
		} else {
			$data['error_avatar_info_height'] = '';
		}
		
		if (isset($this->error['thumbnail_width'])) {
			$data['error_thumbnail_width'] = $this->error['thumbnail_width'];
		} else {
			$data['error_thumbnail_width'] = '';
		}

		if (isset($this->error['thumbnail_height'])) {
			$data['error_thumbnail_height'] = $this->error['thumbnail_height'];
		} else {
			$data['error_thumbnail_height'] = '';
		}
		
		if (isset($this->error['thumbnail_info_width'])) {
			$data['error_thumbnail_info_width'] = $this->error['thumbnail_info_width'];
		} else {
			$data['error_thumbnail_info_width'] = '';
		}

		if (isset($this->error['thumbnail_info_height'])) {
			$data['error_thumbnail_info_height'] = $this->error['thumbnail_info_height'];
		} else {
			$data['error_thumbnail_info_height'] = '';
		}
		
		if (isset($this->error['thumb_width'])) {
			$data['error_thumb_width'] = $this->error['thumb_width'];
		} else {
			$data['error_thumb_width'] = '';
		}

		if (isset($this->error['thumb_height'])) {
			$data['error_thumb_height'] = $this->error['thumb_height'];
		} else {
			$data['error_thumb_height'] = '';
		}
		
		if (isset($this->error['keyword'])) {
			$data['error_keyword'] = $this->error['keyword'];
		} else {
			$data['error_keyword'] = '';
		}
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/s_testimonial', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['action'] = $this->url->link('extension/module/s_testimonial', 'user_token=' . $this->session->data['user_token'], true);

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

		if (isset($this->request->post['module_s_testimonial_status'])) {
			$data['module_s_testimonial_status'] = $this->request->post['module_s_testimonial_status'];
		} else {
			$data['module_s_testimonial_status'] = $this->config->get('module_s_testimonial_status');
		}
		
		if (isset($this->request->post['module_s_testimonial_link'])) {
			$data['module_s_testimonial_link'] = $this->request->post['module_s_testimonial_link'];
		} else {
			$data['module_s_testimonial_link'] = $this->config->get('module_s_testimonial_link');
		}
		
		if (isset($this->request->post['module_s_testimonial_link_order'])) {
			$data['module_s_testimonial_link_order'] = $this->request->post['module_s_testimonial_link_order'];
		} else {
			$data['module_s_testimonial_link_order'] = $this->config->get('module_s_testimonial_link_order');
		}

		if (isset($this->request->post['module_s_testimonial_guest'])) {
			$data['module_s_testimonial_guest'] = $this->request->post['module_s_testimonial_guest'];
		} else {
			$data['module_s_testimonial_guest'] = $this->config->get('module_s_testimonial_guest');
		}
		
		if (isset($this->request->post['module_s_testimonial_all_store'])) {
			$data['module_s_testimonial_all_store'] = $this->request->post['module_s_testimonial_all_store'];
		} else {
			$data['module_s_testimonial_all_store'] = $this->config->get('module_s_testimonial_all_store');
		}

		if (isset($this->request->post['module_s_testimonial_mail'])) {
			$data['module_s_testimonial_mail'] = $this->request->post['module_s_testimonial_mail'];
		} else {
			$data['module_s_testimonial_mail'] = $this->config->get('module_s_testimonial_mail');
		}
		
		if (isset($this->request->post['module_s_testimonial_moderation'])) {
			$data['module_s_testimonial_moderation'] = $this->request->post['module_s_testimonial_moderation'];
		} else {
			$data['module_s_testimonial_moderation'] = $this->config->get('module_s_testimonial_moderation');
		}
		
		if (isset($this->request->post['module_s_testimonial_language'])) {
			$data['module_s_testimonial_language'] = $this->request->post['module_s_testimonial_language'];
		} else {
			$data['module_s_testimonial_language'] = $this->config->get('module_s_testimonial_language');
		}
		
		if (isset($this->request->post['module_s_testimonial_date_added'])) {
			$data['module_s_testimonial_date_added'] = $this->request->post['module_s_testimonial_date_added'];
		} else {
			$data['module_s_testimonial_date_added'] = $this->config->get('module_s_testimonial_date_added');
		}
		
		if (isset($this->request->post['module_s_testimonial_limit'])) {
			$data['module_s_testimonial_limit'] = $this->request->post['module_s_testimonial_limit'];
		} elseif ($this->config->get('module_s_testimonial_limit')) {
			$data['module_s_testimonial_limit'] = $this->config->get('module_s_testimonial_limit');
		} else {
			$data['module_s_testimonial_limit'] = '10,20,30,40,50';
		}
		
		if (isset($this->request->post['module_s_testimonial_field'])) {
			$data['module_s_testimonial_field'] = $this->request->post['module_s_testimonial_field'];
		} else {
			$data['module_s_testimonial_field'] = $this->config->get('module_s_testimonial_field');
		}
		
		if (isset($this->request->post['module_s_testimonial_cut'])) {
			$data['module_s_testimonial_cut'] = $this->request->post['module_s_testimonial_cut'];
		} else {
			$data['module_s_testimonial_cut'] = $this->config->get('module_s_testimonial_cut');
		}
		
		if (isset($this->request->post['module_s_testimonial_text_limit'])) {
			$data['module_s_testimonial_text_limit'] = $this->request->post['module_s_testimonial_text_limit'];
		} elseif ($this->config->get('module_s_testimonial_text_limit')) {
			$data['module_s_testimonial_text_limit'] = $this->config->get('module_s_testimonial_text_limit');
		} else {
			$data['module_s_testimonial_text_limit'] = 500;
		}
		
		if (isset($this->request->post['module_s_testimonial_editor'])) {
			$data['module_s_testimonial_editor'] = $this->request->post['module_s_testimonial_editor'];
		} else {
			$data['module_s_testimonial_editor'] = $this->config->get('module_s_testimonial_editor');
		}
		
		if (isset($this->request->post['module_s_testimonial_smile_theme'])) {
			$data['module_s_testimonial_smile_theme'] = $this->request->post['module_s_testimonial_smile_theme'];
		} else {
			$data['module_s_testimonial_smile_theme'] = $this->config->get('module_s_testimonial_smile_theme');
		}
		
		$folder = DIR_IMAGE . 'catalog/s_testimonial/smile/';

		$smile_themes = array_diff(scandir($folder), array('..', '.'));
		$data['smile_themes'] = array();
		
		if ($smile_themes) {
			foreach ($smile_themes as $smile_theme) {
				if (is_dir($folder . $smile_theme)) {
					$data['smile_themes'][] = $smile_theme;
				}
			}
		}
		
		if (isset($this->request->post['module_s_testimonial_form'])) {
			$data['module_s_testimonial_form'] = $this->request->post['module_s_testimonial_form'];
		} else {
			$data['module_s_testimonial_form'] = $this->config->get('module_s_testimonial_form');
		}
		
		if (isset($this->request->post['module_s_testimonial_form_position'])) {
			$data['module_s_testimonial_form_position'] = $this->request->post['module_s_testimonial_form_position'];
		} else {
			$data['module_s_testimonial_form_position'] = $this->config->get('module_s_testimonial_form_position');
		}
		
		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();
		
		if (isset($this->request->post['module_s_testimonial_description'])) {
			$data['module_s_testimonial_description'] = $this->request->post['module_s_testimonial_description'];
		} else {
			$data['module_s_testimonial_description'] = $this->config->get('module_s_testimonial_description');
		}
		
		if (isset($this->request->post['module_s_testimonial_title'])) {
			$data['module_s_testimonial_title'] = $this->request->post['module_s_testimonial_title'];
		} else {
			$data['module_s_testimonial_title'] = $this->config->get('module_s_testimonial_title');
		}
		
		if (isset($this->request->post['module_s_testimonial_city'])) {
			$data['module_s_testimonial_city'] = $this->request->post['module_s_testimonial_city'];
		} else {
			$data['module_s_testimonial_city'] = $this->config->get('module_s_testimonial_city');
		}
		
		if (isset($this->request->post['module_s_testimonial_name'])) {
			$data['module_s_testimonial_name'] = $this->request->post['module_s_testimonial_name'];
		} else {
			$data['module_s_testimonial_name'] = $this->config->get('module_s_testimonial_name');
		}
		
		if (isset($this->request->post['module_s_testimonial_email'])) {
			$data['module_s_testimonial_email'] = $this->request->post['module_s_testimonial_email'];
		} else {
			$data['module_s_testimonial_email'] = $this->config->get('module_s_testimonial_email');
		}
		
		if (isset($this->request->post['module_s_testimonial_text'])) {
			$data['module_s_testimonial_text'] = $this->request->post['module_s_testimonial_text'];
		} else {
			$data['module_s_testimonial_text'] = $this->config->get('module_s_testimonial_text');
		}
		
		if (isset($this->request->post['module_s_testimonial_good'])) {
			$data['module_s_testimonial_good'] = $this->request->post['module_s_testimonial_good'];
		} else {
			$data['module_s_testimonial_good'] = $this->config->get('module_s_testimonial_good');
		}
		
		if (isset($this->request->post['module_s_testimonial_bad'])) {
			$data['module_s_testimonial_bad'] = $this->request->post['module_s_testimonial_bad'];
		} else {
			$data['module_s_testimonial_bad'] = $this->config->get('module_s_testimonial_bad');
		}
		
		if (isset($this->request->post['module_s_testimonial_rating'])) {
			$data['module_s_testimonial_rating'] = $this->request->post['module_s_testimonial_rating'];
		} else {
			$data['module_s_testimonial_rating'] = $this->config->get('module_s_testimonial_rating');
		}
		
		if (isset($this->request->post['module_s_testimonial_avatar'])) {
			$data['module_s_testimonial_avatar'] = $this->request->post['module_s_testimonial_avatar'];
		} else {
			$data['module_s_testimonial_avatar'] = $this->config->get('module_s_testimonial_avatar');
		}
		
		if (isset($this->request->post['module_s_testimonial_image'])) {
			$data['module_s_testimonial_image'] = $this->request->post['module_s_testimonial_image'];
		} else {
			$data['module_s_testimonial_image'] = $this->config->get('module_s_testimonial_image');
		}
		
		if (isset($this->request->post['module_s_testimonial_image_limit'])) {
			$data['module_s_testimonial_image_limit'] = $this->request->post['module_s_testimonial_image_limit'];
		} elseif ($this->config->get('module_s_testimonial_image_limit')) {
			$data['module_s_testimonial_image_limit'] = $this->config->get('module_s_testimonial_image_limit');
		} else {
			$data['module_s_testimonial_image_limit'] = 5;
		}
		
		if (isset($this->request->post['module_s_testimonial_captcha'])) {
			$data['module_s_testimonial_captcha'] = $this->request->post['module_s_testimonial_captcha'];
		} else {
			$data['module_s_testimonial_captcha'] = $this->config->get('module_s_testimonial_captcha');
		}
		
		if (isset($this->request->post['module_s_testimonial_upload_avatar_width'])) {
			$data['module_s_testimonial_upload_avatar_width'] = $this->request->post['module_s_testimonial_upload_avatar_width'];
		} elseif ($this->config->get('module_s_testimonial_upload_avatar_width')) {
			$data['module_s_testimonial_upload_avatar_width'] = $this->config->get('module_s_testimonial_upload_avatar_width');
		} else {
			$data['module_s_testimonial_upload_avatar_width'] = 1440;
		}
		
		if (isset($this->request->post['module_s_testimonial_upload_avatar_height'])) {
			$data['module_s_testimonial_upload_avatar_height'] = $this->request->post['module_s_testimonial_upload_avatar_height'];
		} elseif ($this->config->get('module_s_testimonial_upload_avatar_height')) {
			$data['module_s_testimonial_upload_avatar_height'] = $this->config->get('module_s_testimonial_upload_avatar_height');
		} else {
			$data['module_s_testimonial_upload_avatar_height'] = 900;
		}
		
		if (isset($this->request->post['module_s_testimonial_upload_image_width'])) {
			$data['module_s_testimonial_upload_image_width'] = $this->request->post['module_s_testimonial_upload_image_width'];
		} elseif ($this->config->get('module_s_testimonial_upload_image_width')) {
			$data['module_s_testimonial_upload_image_width'] = $this->config->get('module_s_testimonial_upload_image_width');
		} else {
			$data['module_s_testimonial_upload_image_width'] = 1440;
		}
		
		if (isset($this->request->post['module_s_testimonial_upload_image_height'])) {
			$data['module_s_testimonial_upload_image_height'] = $this->request->post['module_s_testimonial_upload_image_height'];
		} elseif ($this->config->get('module_s_testimonial_upload_image_height')) {
			$data['module_s_testimonial_upload_image_height'] = $this->config->get('module_s_testimonial_upload_image_height');
		} else {
			$data['module_s_testimonial_upload_image_height'] = 900;
		}
		
		if (isset($this->request->post['module_s_testimonial_avatar_width'])) {
			$data['module_s_testimonial_avatar_width'] = $this->request->post['module_s_testimonial_avatar_width'];
		} elseif ($this->config->get('module_s_testimonial_avatar_width')) {
			$data['module_s_testimonial_avatar_width'] = $this->config->get('module_s_testimonial_avatar_width');
		} else {
			$data['module_s_testimonial_avatar_width'] = 100;
		}
		
		if (isset($this->request->post['module_s_testimonial_avatar_height'])) {
			$data['module_s_testimonial_avatar_height'] = $this->request->post['module_s_testimonial_avatar_height'];
		} elseif ($this->config->get('module_s_testimonial_avatar_height')) {
			$data['module_s_testimonial_avatar_height'] = $this->config->get('module_s_testimonial_avatar_height');
		} else {
			$data['module_s_testimonial_avatar_height'] = 100;
		}
		
		if (isset($this->request->post['module_s_testimonial_avatar_info_width'])) {
			$data['module_s_testimonial_avatar_info_width'] = $this->request->post['module_s_testimonial_avatar_info_width'];
		} elseif ($this->config->get('module_s_testimonial_avatar_info_width')) {
			$data['module_s_testimonial_avatar_info_width'] = $this->config->get('module_s_testimonial_avatar_info_width');
		} else {
			$data['module_s_testimonial_avatar_info_width'] = 100;
		}
		
		if (isset($this->request->post['module_s_testimonial_avatar_info_height'])) {
			$data['module_s_testimonial_avatar_info_height'] = $this->request->post['module_s_testimonial_avatar_info_height'];
		} elseif ($this->config->get('module_s_testimonial_avatar_info_height')) {
			$data['module_s_testimonial_avatar_info_height'] = $this->config->get('module_s_testimonial_avatar_info_height');
		} else {
			$data['module_s_testimonial_avatar_info_height'] = 100;
		}
		
		if (isset($this->request->post['module_s_testimonial_thumbnail_width'])) {
			$data['module_s_testimonial_thumbnail_width'] = $this->request->post['module_s_testimonial_thumbnail_width'];
		} elseif ($this->config->get('module_s_testimonial_thumbnail_width')) {
			$data['module_s_testimonial_thumbnail_width'] = $this->config->get('module_s_testimonial_thumbnail_width');
		} else {
			$data['module_s_testimonial_thumbnail_width'] = 100;
		}
		
		if (isset($this->request->post['module_s_testimonial_thumbnail_height'])) {
			$data['module_s_testimonial_thumbnail_height'] = $this->request->post['module_s_testimonial_thumbnail_height'];
		} elseif ($this->config->get('module_s_testimonial_thumbnail_height')) {
			$data['module_s_testimonial_thumbnail_height'] = $this->config->get('module_s_testimonial_thumbnail_height');
		} else {
			$data['module_s_testimonial_thumbnail_height'] = 100;
		}
		
		if (isset($this->request->post['module_s_testimonial_thumbnail_info_width'])) {
			$data['module_s_testimonial_thumbnail_info_width'] = $this->request->post['module_s_testimonial_thumbnail_info_width'];
		} elseif ($this->config->get('module_s_testimonial_thumbnail_info_width')) {
			$data['module_s_testimonial_thumbnail_info_width'] = $this->config->get('module_s_testimonial_thumbnail_info_width');
		} else {
			$data['module_s_testimonial_thumbnail_info_width'] = 100;
		}
		
		if (isset($this->request->post['module_s_testimonial_thumbnail_info_height'])) {
			$data['module_s_testimonial_thumbnail_info_height'] = $this->request->post['module_s_testimonial_thumbnail_info_height'];
		} elseif ($this->config->get('module_s_testimonial_thumbnail_info_height')) {
			$data['module_s_testimonial_thumbnail_info_height'] = $this->config->get('module_s_testimonial_thumbnail_info_height');
		} else {
			$data['module_s_testimonial_thumbnail_info_height'] = 100;
		}
		
		if (isset($this->request->post['module_s_testimonial_thumb_width'])) {
			$data['module_s_testimonial_thumb_width'] = $this->request->post['module_s_testimonial_thumb_width'];
		} elseif ($this->config->get('module_s_testimonial_thumb_width')) {
			$data['module_s_testimonial_thumb_width'] = $this->config->get('module_s_testimonial_thumb_width');
		} else {
			$data['module_s_testimonial_thumb_width'] = 500;
		}
		
		if (isset($this->request->post['module_s_testimonial_thumb_height'])) {
			$data['module_s_testimonial_thumb_height'] = $this->request->post['module_s_testimonial_thumb_height'];
		} elseif ($this->config->get('module_s_testimonial_thumb_height')) {
			$data['module_s_testimonial_thumb_height'] = $this->config->get('module_s_testimonial_thumb_height');
		} else {
			$data['module_s_testimonial_thumb_height'] = 500;
		}
		
		$this->load->model('setting/store');

		$data['stores'] = array();
		
		$data['stores'][] = array(
			'store_id' => 0,
			'name'     => $this->language->get('text_default')
		);
		
		$stores = $this->model_setting_store->getStores();

		foreach ($stores as $store) {
			$data['stores'][] = array(
				'store_id' => $store['store_id'],
				'name'     => $store['name']
			);
		}
		
		if (isset($this->request->post['module_s_testimonial_seo_url'])) {
			$data['module_s_testimonial_seo_url'] = $this->request->post['module_s_testimonial_seo_url'];
		} else {
			$data['module_s_testimonial_seo_url'] = $this->config->get('module_s_testimonial_seo_url');
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/s_testimonial', $data));
	}
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/s_testimonial')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->request->post['module_s_testimonial_limit']) {
			$this->error['limit'] = $this->language->get('error_limit');
		}
		
		if (!$this->request->post['module_s_testimonial_text_limit']) {
			$this->error['text_limit'] = $this->language->get('error_limit');
		}
		
		if (!$this->request->post['module_s_testimonial_image_limit']) {
			$this->error['image_limit'] = $this->language->get('error_limit');
		}
		
		if (!$this->request->post['module_s_testimonial_upload_avatar_width']) {
			$this->error['upload_avatar_width'] = $this->language->get('error_width');
		}

		if (!$this->request->post['module_s_testimonial_upload_avatar_height']) {
			$this->error['upload_avatar_height'] = $this->language->get('error_height');
		}
		
		if (!$this->request->post['module_s_testimonial_upload_image_width']) {
			$this->error['upload_image_width'] = $this->language->get('error_width');
		}

		if (!$this->request->post['module_s_testimonial_upload_image_height']) {
			$this->error['upload_image_height'] = $this->language->get('error_height');
		}
		
		if (!$this->request->post['module_s_testimonial_avatar_width']) {
			$this->error['avatar_width'] = $this->language->get('error_width');
		}

		if (!$this->request->post['module_s_testimonial_avatar_height']) {
			$this->error['avatar_height'] = $this->language->get('error_height');
		}
		
		if (!$this->request->post['module_s_testimonial_avatar_info_width']) {
			$this->error['avatar_info_width'] = $this->language->get('error_width');
		}

		if (!$this->request->post['module_s_testimonial_avatar_info_height']) {
			$this->error['avatar_info_height'] = $this->language->get('error_height');
		}
		
		if (!$this->request->post['module_s_testimonial_thumbnail_width']) {
			$this->error['thumbnail_width'] = $this->language->get('error_width');
		}

		if (!$this->request->post['module_s_testimonial_thumbnail_height']) {
			$this->error['thumbnail_height'] = $this->language->get('error_height');
		}
		
		if (!$this->request->post['module_s_testimonial_thumbnail_info_width']) {
			$this->error['popup_testimonial_width'] = $this->language->get('error_width');
		}

		if (!$this->request->post['module_s_testimonial_thumbnail_info_height']) {
			$this->error['thumbnail_info_height'] = $this->language->get('error_height');
		}
		
		if (!$this->request->post['module_s_testimonial_thumb_width']) {
			$this->error['thumb_width'] = $this->language->get('error_width');
		}

		if (!$this->request->post['module_s_testimonial_thumb_height']) {
			$this->error['thumb_height'] = $this->language->get('error_height');
		}
		
		if ($this->request->post['module_s_testimonial_seo_url']) {
			$this->load->model('design/seo_url');
			
			foreach ($this->request->post['module_s_testimonial_seo_url'] as $store_id => $language) {
				foreach ($language as $language_id => $keyword) {
					if (!empty($keyword)) {
						if (count(array_keys($language, $keyword)) > 1) {
							$this->error['keyword'][$store_id][$language_id] = $this->language->get('error_unique');
						}						
						
						$seo_urls = $this->model_design_seo_url->getSeoUrlsByKeyword($keyword);
						
						foreach ($seo_urls as $seo_url) {
							if (($seo_url['store_id'] == $store_id) && $seo_url['query'] != 'information/testimonial') {
								$this->error['keyword'][$store_id][$language_id] = $this->language->get('error_keyword');
								
								break;
							}
						}
					}
				}
			}
		}
		
		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
		
		return !$this->error;
	}
	
	public function update_testimonials() {
		$this->load->language('extension/module/s_testimonial');
		
		$this->load->model('catalog/s_testimonial');
		$this->model_catalog_s_testimonial->updateTestimonials();
		
		$this->session->data['success'] = $this->language->get('text_update');
	}
	
	public function install() {
		$this->load->model('catalog/s_testimonial');
		$this->model_catalog_s_testimonial->createDatabaseTables();
	}
}