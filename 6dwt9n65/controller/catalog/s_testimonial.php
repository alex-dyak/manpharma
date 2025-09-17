<?php
class ControllerCatalogSTestimonial extends Controller { 
	private $error = array();
	
	public function index() {
		$this->load->language('catalog/s_testimonial');

		$this->document->setTitle($this->language->get('heading_title'));
		 
		$this->load->model('catalog/s_testimonial');

		$this->getList();
	}

	public function add() {
		$this->load->language('catalog/s_testimonial');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/s_testimonial');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_s_testimonial->addTestimonial($this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			
			$this->response->redirect($this->url->link('catalog/s_testimonial', 'user_token=' . $this->session->data['user_token'] . $url, true));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('catalog/s_testimonial');

		$this->document->setTitle( $this->language->get('heading_title') );
		
		$this->load->model('catalog/s_testimonial');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_s_testimonial->editTestimonial($this->request->get['testimonial_id'], $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			
			$this->response->redirect($this->url->link('catalog/s_testimonial', 'user_token=' . $this->session->data['user_token'] . $url, true));

		}
		
		$this->getForm();
	}
 
	public function delete() {
		$this->load->language('catalog/s_testimonial');

		$this->document->setTitle( $this->language->get('heading_title'));
		
		$this->load->model('catalog/s_testimonial');
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			
			foreach ($this->request->post['selected'] as $testimonial_id) {
				$this->model_catalog_s_testimonial->deleteTestimonial($testimonial_id);
			}
			
			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			
			$this->response->redirect($this->url->link('catalog/s_testimonial', 'user_token=' . $this->session->data['user_token'] . $url, true));

		}

		$this->getList();
	}

	private function getList() {
		
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'date_added';
		}
		
		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'DESC';
		}
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		
		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/s_testimonial', 'user_token=' . $this->session->data['user_token'] . $url, true)
		);

		$data['add'] = $this->url->link('catalog/s_testimonial/add', 'user_token=' . $this->session->data['user_token'] . $url, true);
		$data['delete'] = $this->url->link('catalog/s_testimonial/delete', 'user_token=' . $this->session->data['user_token'] . $url, true);


		$data['testimonials'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);
		
		// Show Field
		if ($this->config->get('module_s_testimonial_field')) {
			$data['field_title'] = $this->config->get('module_s_testimonial_title');
			$data['field_city'] = $this->config->get('module_s_testimonial_city');
			$data['field_name'] = $this->config->get('module_s_testimonial_name');
			$data['field_email'] = $this->config->get('module_s_testimonial_email');
			$data['field_text'] = $this->config->get('module_s_testimonial_text');
			$data['field_good'] = $this->config->get('module_s_testimonial_good');
			$data['field_bad'] = $this->config->get('module_s_testimonial_bad');
			$data['field_rating'] = $this->config->get('module_s_testimonial_rating');
			$data['field_avatar'] = $this->config->get('module_s_testimonial_avatar');
			$data['field_image'] = $this->config->get('module_s_testimonial_image');
		} else {
			$data['field_title'] = 1;
			$data['field_city'] = 1;
			$data['field_name'] = 1;
			$data['field_email'] = 1;
			$data['field_text'] = 1;
			$data['field_good'] = 1;
			$data['field_bad'] = 1;
			$data['field_rating'] = 1;
			$data['field_avatar'] = 1;
			$data['field_image'] = 1;
		}
		
		$testimonial_total = $this->model_catalog_s_testimonial->getTotalTestimonials();
		$data['testimonial_total'] = $testimonial_total;
		
		$results = $this->model_catalog_s_testimonial->getTestimonials($filter_data);
		
		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();
		
		$this->load->model('tool/image');

    	foreach ($results as $result) {	
			
			if (is_file(DIR_IMAGE . $result['avatar'])) {
				$avatar = $this->model_tool_image->resize($result['avatar'], 40, 40);
			} else {
				$avatar = $this->model_tool_image->resize('no_image.png', 40, 40);
			}
			
			$image = array();
			
			if ($result['image']) {
				foreach (explode('|', $result['image']) as $value) {
					$image[] = $this->model_tool_image->resize($value, 40, 40);
				}
			}
			
			$text = $this->config->get('module_s_testimonial_editor') ? $this->model_catalog_s_testimonial->clearBBCode($result['text']) : $result['text'];
			
			if (mb_strlen($text,'UTF-8') > 100){
				$text = utf8_substr($text, 0, 100) . '...';
			}
			
			$good = $this->config->get('module_s_testimonial_editor') ? $this->model_catalog_s_testimonial->clearBBCode($result['good']) : $result['good'];
			
			if (mb_strlen($good,'UTF-8') > 100){
				$good = utf8_substr($good, 0, 100) . '...';
			}
			
			$bad = $this->config->get('module_s_testimonial_editor') ? $this->model_catalog_s_testimonial->clearBBCode($result['bad']) : $result['bad'];
			
			if (mb_strlen($bad,'UTF-8') > 100){
				$bad = utf8_substr($bad, 0, 100) . '...';
			}
			
			$data['testimonials'][] = array(
				'testimonial_id' => $result['testimonial_id'],
				'title'          => $result['title'],
				'text'		     => $text,
				'good'		     => $good,
				'bad'		  	 => $bad,
				'name'		     => $result['name'],
				'city'		     => $result['city'],
				'avatar'	     => $avatar,
				'image'	     	 => $image,
				'rating'	     => $result['rating'],
				'language_id'    => $result['language_id'],
				'email'		     => $result['email'],
				'date_added'     => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'status' 	     => $result['status'],			
				'edit'     	     => $this->url->link('catalog/s_testimonial/edit', 'user_token=' . $this->session->data['user_token'] . '&testimonial_id=' . $result['testimonial_id'] . $url, true)
			);
		}

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		$data['sort_title'] = $this->url->link('catalog/s_testimonial', 'user_token=' . $this->session->data['user_token'] . '&sort=title' . $url, true);			
		$data['sort_text'] = $this->url->link('catalog/s_testimonial', 'user_token=' . $this->session->data['user_token'] . '&sort=text' . $url, true);
		$data['sort_good'] = $this->url->link('catalog/s_testimonial', 'user_token=' . $this->session->data['user_token'] . '&sort=good' . $url, true);
		$data['sort_bad'] = $this->url->link('catalog/s_testimonial', 'user_token=' . $this->session->data['user_token'] . '&sort=bad' . $url, true);
		$data['sort_name'] = $this->url->link('catalog/s_testimonial', 'user_token=' . $this->session->data['user_token'] . '&sort=name' . $url, true);
		$data['sort_city'] = $this->url->link('catalog/s_testimonial', 'user_token=' . $this->session->data['user_token'] . '&sort=city' . $url, true);
		$data['sort_rating'] = $this->url->link('catalog/s_testimonial', 'user_token=' . $this->session->data['user_token'] . '&sort=rating' . $url, true);
		$data['sort_language_id'] = $this->url->link('catalog/s_testimonial', 'user_token=' . $this->session->data['user_token'] . '&sort=language_id' . $url, true);
		$data['sort_email'] = $this->url->link('catalog/s_testimonial', 'user_token=' . $this->session->data['user_token'] . '&sort=email' . $url, true);			
		$data['sort_date_added'] = $this->url->link('catalog/s_testimonial', 'user_token=' . $this->session->data['user_token'] . '&sort=date_added' . $url, true);		
		$data['sort_status'] = $this->url->link('catalog/s_testimonial', 'user_token=' . $this->session->data['user_token'] . '&sort=status' . $url, true);	
		
		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
												
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $testimonial_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('catalog/s_testimonial', 'user_token=' . $this->session->data['user_token'] . $url . '&page={page}', true);
		
		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($testimonial_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($testimonial_total - $this->config->get('config_limit_admin'))) ? $testimonial_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $testimonial_total, ceil($testimonial_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/s_testimonial_list', $data));
	}

	private function getForm() {
		$data['text_form'] = !isset($this->request->get['testimonial_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		
		$data['editor'] = $this->config->get('module_s_testimonial_editor');
		$data['smiles'] = $this->model_catalog_s_testimonial->getSmiles();
		
		$data['wysibb_language'] = '';
		$language_code = substr($this->config->get('config_admin_language'), 0, 2);
		
		if ($language_code != 'en') {
			$language_file = 'view/javascript/s_testimonial/wysibb/lang/' . $language_code . '.js';
							
			if (file_exists($language_file)) {
				$data['wysibb_language'] = $language_code;
			}
		}

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->error['title'])) {
			$data['error_title'] = $this->error['title'];
		} else {
			$data['error_title'] = '';
		}
		
		if (isset($this->error['city'])) {
			$data['error_city'] = $this->error['city'];
		} else {
			$data['error_city'] = '';
		}
		
		if (isset($this->error['email'])) {
			$data['error_email'] = $this->error['email'];
		} else {
			$data['error_email'] = '';
		}
		
		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}
		
		if (isset($this->error['text'])) {
			$data['error_text'] = $this->error['text'];
		} else {
			$data['error_text'] = '';
		}
		
		if (isset($this->error['good'])) {
			$data['error_good'] = $this->error['good'];
		} else {
			$data['error_good'] = '';
		}
		
		if (isset($this->error['bad'])) {
			$data['error_bad'] = $this->error['bad'];
		} else {
			$data['error_bad'] = '';
		}
		
		if (isset($this->error['rating'])) {
			$data['error_rating'] = $this->error['rating'];
		} else {
			$data['error_rating'] = '';
		}
		
		if (isset($this->error['avatar'])) {
			$data['error_avatar'] = $this->error['avatar'];
		} else {
			$data['error_avatar'] = '';
		}
		
		if (isset($this->error['image'])) {
			$data['error_image'] = $this->error['image'];
		} else {
			$data['error_image'] = '';
		}
		
		if (isset($this->error['keyword'])) {
			$data['error_keyword'] = $this->error['keyword'];
		} else {
			$data['error_keyword'] = '';
		}

		$url = '';
			
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/s_testimonial', 'user_token=' . $this->session->data['user_token'] . $url, true)
		);

		if (!isset($this->request->get['testimonial_id'])) {
			$data['action'] = $this->url->link('catalog/s_testimonial/add', 'user_token=' . $this->session->data['user_token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('catalog/s_testimonial/edit', 'user_token=' . $this->session->data['user_token'] . '&testimonial_id=' . $this->request->get['testimonial_id'] . $url, true);
		}

		$data['cancel'] = $this->url->link('catalog/s_testimonial', 'user_token=' . $this->session->data['user_token'] . $url, true);
		
		if (isset($this->request->get['testimonial_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$testimonial_info = $this->model_catalog_s_testimonial->getTestimonial($this->request->get['testimonial_id']);
		}
		
		// Show Field
		if ($this->config->get('module_s_testimonial_field')) {
			$data['field_title'] = $this->config->get('module_s_testimonial_title');
			$data['field_city'] = $this->config->get('module_s_testimonial_city');
			$data['field_name'] = $this->config->get('module_s_testimonial_name');
			$data['field_email'] = $this->config->get('module_s_testimonial_email');
			$data['field_text'] = $this->config->get('module_s_testimonial_text');
			$data['field_good'] = $this->config->get('module_s_testimonial_good');
			$data['field_bad'] = $this->config->get('module_s_testimonial_bad');
			$data['field_rating'] = $this->config->get('module_s_testimonial_rating');
			$data['field_avatar'] = $this->config->get('module_s_testimonial_avatar');
			$data['field_image'] = $this->config->get('module_s_testimonial_image');
		} else {
			$data['field_title'] = $this->config->get('module_s_testimonial_title') ? $this->config->get('module_s_testimonial_title') : 1;
			$data['field_city'] = $this->config->get('module_s_testimonial_city') ? $this->config->get('module_s_testimonial_city') : 1;
			$data['field_name'] = $this->config->get('module_s_testimonial_name') ? $this->config->get('module_s_testimonial_name') : 1;
			$data['field_email'] = $this->config->get('module_s_testimonial_email') ? $this->config->get('module_s_testimonial_email') : 1;
			$data['field_text'] = $this->config->get('module_s_testimonial_text') ? $this->config->get('module_s_testimonial_text') : 1;
			$data['field_good'] = $this->config->get('module_s_testimonial_good') ? $this->config->get('module_s_testimonial_good') : 1;
			$data['field_bad'] = $this->config->get('module_s_testimonial_bad') ? $this->config->get('module_s_testimonial_bad') : 1;
			$data['field_rating'] = $this->config->get('module_s_testimonial_rating') ? $this->config->get('module_s_testimonial_rating') : 1;
			$data['field_avatar'] = $this->config->get('module_s_testimonial_avatar') ? $this->config->get('module_s_testimonial_avatar') : 1;
			$data['field_image'] = $this->config->get('module_s_testimonial_image') ? $this->config->get('module_s_testimonial_image') : 1;
		}
		
		if (isset($this->request->post['title'])) {
			$data['title'] = $this->request->post['title'];
		} elseif (isset($testimonial_info)) {
			$data['title'] = $testimonial_info['title'];
		} else {
			$data['title'] = '';
		} 
		
		if (isset($this->request->post['city'])) {
			$data['city'] = $this->request->post['city'];
		} elseif (isset($testimonial_info)) {
			$data['city'] = $testimonial_info['city'];
		} else {
			$data['city'] = '';
		}
		
		if (isset($this->request->post['email'])) {
			$data['email'] = $this->request->post['email'];
		} elseif (isset($testimonial_info)) {
			$data['email'] = $testimonial_info['email'];
		} else {
			$data['email'] = '';
		}
		
		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (isset($testimonial_info)) {
			$data['name'] = $testimonial_info['name'];
		} else {
			$data['name'] = '';
		}
		
		if (isset($this->request->post['text'])) {
			$data['text'] = $this->request->post['text'];
		} elseif (isset($testimonial_info)) {
			$data['text'] = $testimonial_info['text'];
		} else {
			$data['text'] = '';
		}
		
		if (isset($this->request->post['good'])) {
			$data['good'] = $this->request->post['good'];
		} elseif (isset($testimonial_info)) {
			$data['good'] = $testimonial_info['good'];
		} else {
			$data['good'] = '';
		}
		
		if (isset($this->request->post['bad'])) {
			$data['bad'] = $this->request->post['bad'];
		} elseif (isset($testimonial_info)) {
			$data['bad'] = $testimonial_info['bad'];
		} else {
			$data['bad'] = '';
		}
		
		if (isset($this->request->post['comment'])) {
			$data['comment'] = $this->request->post['comment'];
		} elseif (isset($testimonial_info)) {
			$data['comment'] = $testimonial_info['comment'];
		} else {
			$data['comment'] = '';
		}
		
		if (isset($this->request->post['rating'])) {
			$data['rating'] = $this->request->post['rating'];
		} elseif (isset($testimonial_info)) {
			$data['rating'] = $testimonial_info['rating'];
		} else {
			$data['rating'] = '5';
		}
		
		if (isset($this->request->post['avatar'])) {
			$data['avatar'] = $this->request->post['avatar'];
		} elseif (!empty($testimonial_info)) {
			$data['avatar'] = $testimonial_info['avatar'];
		} else {
			$data['avatar'] = '';
		}

		$this->load->model('tool/image');

		if (isset($this->request->post['avatar']) && is_file(DIR_IMAGE . $this->request->post['avatar'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['avatar'], 100, 100);
		} elseif (!empty($testimonial_info) && is_file(DIR_IMAGE . $testimonial_info['avatar'])) {
			$data['thumb'] = $this->model_tool_image->resize($testimonial_info['avatar'], 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}
		
		if (isset($this->request->post['image'])) {
			$data['image'] = array();
			
			if (array_diff($this->request->post['image'], array(''))) {
				foreach ($this->request->post['image'] as $value) {
					$data['image'][] = array(
						'thumb' => $this->model_tool_image->resize($value, 100, 100),
						'image' => $value
					);
				}
			}
		} elseif (isset($testimonial_info)) {
			$data['image'] = array();
			
			if ($testimonial_info['image']) {
				foreach (explode('|', $testimonial_info['image']) as $value) {
					$data['image'][] = array(
						'thumb' => $this->model_tool_image->resize($value, 100, 100),
						'image' => $value
					);
				}
			}
		} else {
			$data['image'] = array();
		}

		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		
		if (isset($this->request->post['date_added'])) {
			$data['date_added'] = $this->request->post['date_added'];
		} elseif (isset($testimonial_info)) {
			$data['date_added'] = $testimonial_info['date_added'];
		} else {
			$data['date_added'] = date("Y-m-d");
		}

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();
		
		if (isset($this->request->post['language_id'])) {
			$data['language_id'] = $this->request->post['language_id'];
		} elseif (isset($testimonial_info)) {
			$data['language_id'] = $testimonial_info['language_id'];
		} else {
			$data['language_id'] = '';
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (isset($testimonial_info)) {
			$data['status'] = $testimonial_info['status'];
		} else {
			$data['status'] = 1;
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

		if (isset($this->request->post['testimonial_store'])) {
			$data['testimonial_store'] = $this->request->post['testimonial_store'];
		} elseif (isset($this->request->get['testimonial_id'])) {
			$data['testimonial_store'] = $this->model_catalog_s_testimonial->getTestimonialStores($this->request->get['testimonial_id']);
		} else {
			$data['testimonial_store'] = array(0);
		}
		
		if (isset($this->request->post['testimonial_seo_url'])) {
			$data['testimonial_seo_url'] = $this->request->post['testimonial_seo_url'];
		} elseif (isset($this->request->get['testimonial_id'])) {
			$data['testimonial_seo_url'] = $this->model_catalog_s_testimonial->getTestimonialSeoUrls($this->request->get['testimonial_id']);
		} else {
			$data['testimonial_seo_url'] = array();
		}
		
		if (isset($this->request->post['store_name'])) {
			$data['store_name'] = $this->request->post['store_name'];
		} elseif (isset($testimonial_info)) {
			$data['store_name'] = $testimonial_info['store_name'];
		} else {
			$data['store_name'] = '';
		}
		
		if (isset($this->request->post['store_url'])) {
			$data['store_url'] = $this->request->post['store_url'];
		} elseif (isset($testimonial_info)) {
			$data['store_url'] = $testimonial_info['store_url'];
		} else {
			$data['store_url'] = '';
		}
		
		if (isset($this->request->post['testimonial_layout'])) {
			$data['testimonial_layout'] = $this->request->post['testimonial_layout'];
		} elseif (isset($this->request->get['testimonial_id'])) {
			$data['testimonial_layout'] = $this->model_catalog_s_testimonial->getTestimonialLayouts($this->request->get['testimonial_id']);
		} else {
			$data['testimonial_layout'] = array();
		}

		$this->load->model('design/layout');

		$data['layouts'] = $this->model_design_layout->getLayouts();
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/s_testimonial_form', $data));
	}

	private function validateForm() {
		if (!$this->user->hasPermission('modify', 'catalog/s_testimonial')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if ($this->config->get('module_s_testimonial_title') == 2) {
			if ((utf8_strlen($this->request->post['title']) < 1) || (utf8_strlen($this->request->post['title']) > 255)) {
				$this->error['title'] = $this->language->get('error_title');
			}
		}
		
		if ($this->config->get('module_s_testimonial_city') == 2) {
			if ((utf8_strlen($this->request->post['city']) < 1) || (utf8_strlen($this->request->post['city']) > 255)) {
				$this->error['city'] = $this->language->get('error_city');
			}
		}
		
		if ($this->config->get('module_s_testimonial_name') == 2) {
			if ((utf8_strlen($this->request->post['name']) < 1) || (utf8_strlen($this->request->post['name']) > 255)) {
				$this->error['name'] = $this->language->get('error_name');
			}
		}
		
		if ($this->config->get('module_s_testimonial_email') == 2) {
			if (utf8_strlen($this->request->post['email']) > 96 || !filter_var($this->request->post['email'], FILTER_VALIDATE_EMAIL)) {
				$this->error['email'] = $this->language->get('error_email');
			}
		}
		
		if ($this->config->get('module_s_testimonial_text') == 2) {
			if (utf8_strlen($this->request->post['text']) < 1) {
				$this->error['text'] = $this->language->get('error_text');
			}
		}
			
		if ($this->config->get('module_s_testimonial_good') == 2) {
			if (utf8_strlen($this->request->post['good']) < 1) {
				$this->error['good'] = $this->language->get('error_good');
			}
		}
			
		if ($this->config->get('module_s_testimonial_bad') == 2) {
			if (utf8_strlen($this->request->post['bad']) < 1) {
				$this->error['bad'] = $this->language->get('error_bad');
			}
		}
		
		if ($this->config->get('module_s_testimonial_rating') == 2) {
			if (empty($this->request->post['rating']) || $this->request->post['rating'] < 0 || $this->request->post['rating'] > 5) {
				$this->error['rating'] = $this->language->get('error_rating');
			}
		}

		if ($this->config->get('module_s_testimonial_avatar') == 2) {
			if (utf8_strlen($this->request->post['avatar']) == 0) {
				$this->error['avatar'] = $this->language->get('error_avatar');
			}
		}
		
		if ($this->config->get('module_s_testimonial_image') == 2) {
			if (!array_diff($this->request->post['image'], array(''))) {
				$this->error['image'] = $this->language->get('error_image');
			}
		}
		
		if ($this->request->post['testimonial_seo_url']) {
			$this->load->model('design/seo_url');
			
			foreach ($this->request->post['testimonial_seo_url'] as $store_id => $language) {
				foreach ($language as $language_id => $keyword) {
					if (!empty($keyword)) {
						if (count(array_keys($language, $keyword)) > 1) {
							$this->error['keyword'][$store_id][$language_id] = $this->language->get('error_unique');
						}						
						
						$seo_urls = $this->model_design_seo_url->getSeoUrlsByKeyword($keyword);
						
						foreach ($seo_urls as $seo_url) {
							if (($seo_url['store_id'] == $store_id) && (!isset($this->request->get['testimonial_id']) || (($seo_url['query'] != 'testimonial_id=' . $this->request->get['testimonial_id'])))) {
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

	private function validateDelete() {
		if (!$this->user->hasPermission('modify', 'catalog/s_testimonial')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}