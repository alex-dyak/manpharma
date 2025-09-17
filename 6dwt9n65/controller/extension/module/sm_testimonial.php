<?php
class ControllerExtensionModuleSMTestimonial extends Controller {
	private $error = array(); 
	
	public function index() {  
		$this->load->language('extension/module/sm_testimonial');

		$this->document->setTitle(strip_tags($this->language->get('heading_title')));
		
		$this->load->model('setting/module');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (!isset($this->request->get['module_id'])) {
				$this->model_setting_module->addModule('sm_testimonial', $this->request->post);
			} else {
				$this->model_setting_module->editModule($this->request->get['module_id'], $this->request->post);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
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
		
		if (isset($this->error['image_limit'])) {
			$data['error_image_limit'] = $this->error['image_limit'];
		} else {
			$data['error_image_limit'] = '';
		}
		
		if (isset($this->error['limit'])) {
			$data['error_limit'] = $this->error['limit'];
		} else {
			$data['error_limit'] = '';
		}
		
		if (isset($this->error['carousel_item'])) {
			$data['error_carousel_item'] = $this->error['carousel_item'];
		} else {
			$data['error_carousel_item'] = '';
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

		if (!isset($this->request->get['module_id'])) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/module/sm_testimonial', 'user_token=' . $this->session->data['user_token'], true)
			);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/module/sm_testimonial', 'user_token=' . $this->session->data['user_token'] . '&module_id=' . $this->request->get['module_id'], true)
			);
		}

		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('extension/module/sm_testimonial', 'user_token=' . $this->session->data['user_token'], true);
		} else {
			$data['action'] = $this->url->link('extension/module/sm_testimonial', 'user_token=' . $this->session->data['user_token'] . '&module_id=' . $this->request->get['module_id'], true);
		}

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_setting_module->getModule($this->request->get['module_id']);
		}
		
		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($module_info)) {
			$data['name'] = $module_info['name'];
		} else {
			$data['name'] = '';
		}
		
		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();
		
		if (isset($this->request->post['title_testimonial'])) {
			$data['title_testimonial'] = $this->request->post['title_testimonial'];
		} elseif (!empty($module_info)) {
			$data['title_testimonial'] = $module_info['title_testimonial'];
		} else {
			$data['title_testimonial'] = array();
		}
		
		if (isset($this->request->post['title'])) {
			$data['title'] = $this->request->post['title'];
		} elseif (!empty($module_info)) {
			$data['title'] = $module_info['title'];
		} else {
			$data['title'] = '';
		}
		
		if (isset($this->request->post['city'])) {
			$data['city'] = $this->request->post['city'];
		} elseif (!empty($module_info)) {
			$data['city'] = $module_info['city'];
		} else {
			$data['city'] = '';
		}
		
		if (isset($this->request->post['name_status'])) {
			$data['name_status'] = $this->request->post['name_status'];
		} elseif (!empty($module_info)) {
			$data['name_status'] = $module_info['name_status'];
		} else {
			$data['name_status'] = '';
		}
		
		if (isset($this->request->post['text'])) {
			$data['text'] = $this->request->post['text'];
		} elseif (!empty($module_info)) {
			$data['text'] = $module_info['text'];
		} else {
			$data['text'] = '';
		}

		if (isset($this->request->post['good'])) {
			$data['good'] = $this->request->post['good'];
		} elseif (!empty($module_info)) {
			$data['good'] = $module_info['good'];
		} else {
			$data['good'] = '';
		}
		
		if (isset($this->request->post['bad'])) {
			$data['bad'] = $this->request->post['bad'];
		} elseif (!empty($module_info)) {
			$data['bad'] = $module_info['bad'];
		} else {
			$data['bad'] = '';
		}
		
		if (isset($this->request->post['rating'])) {
			$data['rating'] = $this->request->post['rating'];
		} elseif (!empty($module_info)) {
			$data['rating'] = $module_info['rating'];
		} else {
			$data['rating'] = '';
		}
		
		if (isset($this->request->post['date_added'])) {
			$data['date_added'] = $this->request->post['date_added'];
		} elseif (!empty($module_info)) {
			$data['date_added'] = $module_info['date_added'];
		} else {
			$data['date_added'] = '';
		}
		
		if (isset($this->request->post['avatar'])) {
			$data['avatar'] = $this->request->post['avatar'];
		} elseif (!empty($module_info)) {
			$data['avatar'] = $module_info['avatar'];
		} else {
			$data['avatar'] = '';
		}
		
		if (isset($this->request->post['avatar_width'])) {
			$data['avatar_width'] = $this->request->post['avatar_width'];
		} elseif (!empty($module_info)) {
			$data['avatar_width'] = $module_info['avatar_width'];
		} else {
			$data['avatar_width'] = 100;
		}
		
		if (isset($this->request->post['avatar_height'])) {
			$data['avatar_height'] = $this->request->post['avatar_height'];
		} elseif (!empty($module_info)) {
			$data['avatar_height'] = $module_info['avatar_height'];
		} else {
			$data['avatar_height'] = 100;
		}
		
		if (isset($this->request->post['image'])) {
			$data['image'] = $this->request->post['image'];
		} elseif (!empty($module_info)) {
			$data['image'] = $module_info['image'];
		} else {
			$data['image'] = '';
		}
		
		if (isset($this->request->post['image_limit'])) {
			$data['image_limit'] = $this->request->post['image_limit'];
		} elseif (!empty($module_info)) {
			$data['image_limit'] = $module_info['image_limit'];
		} else {
			$data['image_limit'] = 4;
		}

		if (isset($this->request->post['thumbnail_width'])) {
			$data['thumbnail_width'] = $this->request->post['thumbnail_width'];
		} elseif (!empty($module_info)) {
			$data['thumbnail_width'] = $module_info['thumbnail_width'];
		} else {
			$data['thumbnail_width'] = 100;
		}
		
		if (isset($this->request->post['thumbnail_height'])) {
			$data['thumbnail_height'] = $this->request->post['thumbnail_height'];
		} elseif (!empty($module_info)) {
			$data['thumbnail_height'] = $module_info['thumbnail_height'];
		} else {
			$data['thumbnail_height'] = 100;
		}
		
		if (isset($this->request->post['limit'])) {
			$data['limit'] = $this->request->post['limit'];
		} elseif (!empty($module_info)) {
			$data['limit'] = $module_info['limit'];
		} else {
			$data['limit'] = 10;
		}
		
		if (isset($this->request->post['readmore'])) {
			$data['readmore'] = $this->request->post['readmore'];
		} elseif (!empty($module_info)) {
			$data['readmore'] = $module_info['readmore'];
		} else {
			$data['readmore'] = '';
		}
		
		if (isset($this->request->post['show_all'])) {
			$data['show_all'] = $this->request->post['show_all'];
		} elseif (!empty($module_info)) {
			$data['show_all'] = $module_info['show_all'];
		} else {
			$data['show_all'] = '';
		}
		
		if (isset($this->request->post['sort'])) {
			$data['sort'] = $this->request->post['sort'];
		} elseif (!empty($module_info)) {
			$data['sort'] = $module_info['sort'];
		} else {
			$data['sort'] = 'st.date_added';
		}
		
		if (isset($this->request->post['carousel'])) {
			$data['carousel'] = $this->request->post['carousel'];
		} elseif (!empty($module_info)) {
			$data['carousel'] = $module_info['carousel'];
		} else {
			$data['carousel'] = '';
		}
		
		if (isset($this->request->post['carousel_item'])) {
			$data['carousel_item'] = $this->request->post['carousel_item'];
		} elseif (!empty($module_info)) {
			$data['carousel_item'] = $module_info['carousel_item'];
		} else {
			$data['carousel_item'] = 4;
		}
		
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($module_info)) {
			$data['status'] = $module_info['status'];
		} else {
			$data['status'] = '';
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/sm_testimonial', $data));
	}
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/sm_testimonial')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}
		
		if (!$this->request->post['avatar_width']) {
			$this->error['avatar_width'] = $this->language->get('error_width');
		}

		if (!$this->request->post['avatar_height']) {
			$this->error['avatar_height'] = $this->language->get('error_height');
		}
		
		if (!$this->request->post['thumbnail_width']) {
			$this->error['thumbnail_width'] = $this->language->get('error_width');
		}

		if (!$this->request->post['thumbnail_height']) {
			$this->error['thumbnail_height'] = $this->language->get('error_height');
		}
		
		if (!$this->request->post['image_limit']) {
			$this->error['image_limit'] = $this->language->get('error_limit');
		}
		
		if (!$this->request->post['limit']) {
			$this->error['limit'] = $this->language->get('error_limit');
		}
		
		if (!$this->request->post['carousel_item']) {
			$this->error['carousel_item'] = $this->language->get('error_limit');
		}
		
		return !$this->error;
	}
}