<?php 
class ControllerInformationTestimonial extends Controller {
	public function index() {
		$this->load->language('information/testimonial');

		$this->load->model('catalog/s_testimonial');

		$description = $this->config->get('module_s_testimonial_description');
		$language_id = $this->config->get('config_language_id');
		
		if ($description[$language_id]['title']) {
			$heading_title = $description[$language_id]['title'];
		} else {
			$heading_title = $this->language->get('heading_title');
		}
		
		$this->document->setTitle($heading_title);
		
		$this->document->setDescription($description[$language_id]['meta_description']);
		$this->document->setKeywords($description[$language_id]['meta_keyword']);
		
		$data['description'] = trim(strip_tags(html_entity_decode($description[$language_id]['description'], ENT_QUOTES, 'UTF-8'))) ? html_entity_decode($description[$language_id]['description'], ENT_QUOTES, 'UTF-8') : '';
		
		if ($this->config->get('module_s_testimonial_editor')) {
			$data['wysibb_language'] = substr($this->session->data['language'], 0, 2);
						
			if ($data['wysibb_language'] != 'en') {
				$language_file = 'catalog/view/javascript/s_testimonial/wysibb/lang/' . $data['wysibb_language'] . '.js';
				
				if (file_exists($language_file)) {
					$this->document->addScript($language_file);
				}
			}
			
			$this->document->addScript('catalog/view/javascript/s_testimonial/wysibb/jquery.wysibb.min.js');
			$this->document->addStyle('catalog/view/javascript/s_testimonial/wysibb/theme/default/wbbtheme.css');
			
			$data['smiles'] = $this->model_catalog_s_testimonial->getSmiles();
		}
		$this->document->addStyle('catalog/view/theme/default/stylesheet/font-awsome.min.css');
		if ($this->config->get('module_s_testimonial_image')) {
			$this->document->addStyle('catalog/view/javascript/jquery/magnific/magnific-popup.css');
			$this->document->addScript('catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js');
		}
		
		$this->document->addStyle('catalog/view/javascript/s_testimonial/testimonial.css');

		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home')
   		);
		
		$data['breadcrumbs'][] = array(
	       	'text'      => $heading_title,
			'href'      => $this->url->link('information/testimonial')
	   	);
		
		$data['heading_title'] = $heading_title;
		$data['text_login'] = sprintf($this->language->get('text_login'), $this->url->link('account/login', '', true), $this->url->link('account/register', '', true));
		
		$url = '';

		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}
		
		$data['sorts'] = array();

		$data['sorts'][] = array(
			'text'  => $this->language->get('text_date_added_desc'),
			'value' => 'st.date_added-DESC',
			'href'  => $this->url->link('information/testimonial', 'sort=st.date_added&order=DESC' . $url)
		);
		
		$data['sorts'][] = array(
			'text'  => $this->language->get('text_date_added_asc'),
			'value' => 'st.date_added-ASC',
			'href'  => $this->url->link('information/testimonial', 'sort=st.date_added&order=ASC' . $url)
		);
		
		if ($this->config->get('module_s_testimonial_rating')) {
			$data['sorts'][] = array(
				'text'  => $this->language->get('text_rating_desc'),
				'value' => 'st.rating-DESC',
				'href'  => $this->url->link('information/testimonial', 'sort=st.rating&order=DESC' . $url)
			);
			
			$data['sorts'][] = array(
				'text'  => $this->language->get('text_rating_asc'),
				'value' => 'st.rating-ASC',
				'href'  => $this->url->link('information/testimonial', 'sort=st.rating&order=ASC' . $url)
			);
		}
		
		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$data['limits'] = array();

		$limits = array();

		$limits = array_unique(explode(',', $this->config->get('module_s_testimonial_limit')));

		sort($limits);

		foreach($limits as $value) {
			$data['limits'][] = array(
				'text'  => $value,
				'value' => $value,
				'href'  => $this->url->link('information/testimonial', $url . '&limit=' . $value)
			);
		}
		
		if (isset($this->request->get['sort'])) {
			$data['sort'] = $this->request->get['sort'];
		} else {
			$data['sort'] = 'st.date_added';
		}

		if (isset($this->request->get['order'])) {
			$data['order'] = $this->request->get['order'];
		} else {
			$data['order'] = 'DESC';
		}
		
		if (isset($this->request->get['limit'])) {
			$data['limit'] = $this->request->get['limit'];
		} else {
			$limits = array_unique(explode(',', $this->config->get('module_s_testimonial_limit')));
			sort($limits);
			$data['limit'] = $limits[0];
		}
		
		$data += $this->getTotal();
		$data += $this->getList();

		// Form
		if ($this->config->get('module_s_testimonial_guest') || $this->customer->isLogged()) {
			$data['guest'] = true;
		} else {
			$data['guest'] = false;
		}
		
		$data['image_limit'] = $this->config->get('module_s_testimonial_image_limit');
		
		// Captcha
		if ($this->config->get('captcha_' . $this->config->get('config_captcha') . '_status') && $this->config->get('module_s_testimonial_captcha')) {
			$data['captcha'] = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha'));
		} else {
			$data['captcha'] = '';
		}
		
		if ($this->customer->isLogged()) {
			$data['email'] = $this->customer->getEmail();
			$data['name'] = $this->customer->getFirstname();
		} else {
			$data['email'] = '';
			$data['name'] = '';
		}
		
		$data['date_added'] = $this->config->get('module_s_testimonial_date_added');
		$data['moderation'] = $this->config->get('module_s_testimonial_moderation');
		$data['form'] = $this->config->get('module_s_testimonial_form');
		$data['form_position'] = $this->config->get('module_s_testimonial_form_position');
		$data['field_title'] = $this->config->get('module_s_testimonial_title');
		$data['field_city'] = $this->config->get('module_s_testimonial_city');
		$data['field_email'] = $this->config->get('module_s_testimonial_email');
		$data['field_name'] = $this->config->get('module_s_testimonial_name');
		$data['field_text'] = $this->config->get('module_s_testimonial_text');
		$data['field_good'] = $this->config->get('module_s_testimonial_good');
		$data['field_bad'] = $this->config->get('module_s_testimonial_bad');
		$data['max_avatar'] = sprintf($this->language->get('text_max_avatar'), $this->config->get('module_s_testimonial_upload_avatar_width'), $this->config->get('module_s_testimonial_upload_avatar_height'));
		$data['max_image'] = sprintf($this->language->get('text_max_image'), $this->config->get('module_s_testimonial_upload_image_width'), $this->config->get('module_s_testimonial_upload_image_height'));
		$data['field_avatar'] = $this->config->get('module_s_testimonial_avatar');
			
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');	
			
		$this->response->setOutput($this->load->view('information/testimonial/testimonial', $data));
  	}
	
	private function getList() {
		$this->load->language('information/testimonial');

		$this->load->model('catalog/s_testimonial');
		
		$data['editor'] = $this->config->get('module_s_testimonial_editor');
		$data['field_image'] = $this->config->get('module_s_testimonial_image');

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'st.date_added';
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

		if (isset($this->request->get['limit'])) {
			$limit = (int)$this->request->get['limit'];
		} else {
			$limits = array_unique(explode(',', $this->config->get('module_s_testimonial_limit')));
			sort($limits);
			$limit = $limits[0];
		}
		
		$filter_data = array(
		    'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $limit,
			'limit' => $limit
		);
	
		$data['testimonials'] = array();
		
		$total = $this->model_catalog_s_testimonial->getTotalTestimonials();
			
		$results = $this->model_catalog_s_testimonial->getTestimonials($filter_data);

		$this->load->model('tool/image');
		
		foreach ($results as $result) {
			$avatar = '';
			
			if ($this->config->get('module_s_testimonial_avatar')) {
				
				if ($result['avatar']) {
					$avatar = $this->model_tool_image->resize($result['avatar'], $this->config->get('module_s_testimonial_avatar_width'), $this->config->get('module_s_testimonial_avatar_height'));
				} else {
					$avatar = $this->model_tool_image->resize('catalog/s_testimonial/avatar/no_avatar.png', $this->config->get('module_s_testimonial_avatar_width'), $this->config->get('module_s_testimonial_avatar_height'));
				}
			}
			
			$image = array();
			
			if ($this->config->get('module_s_testimonial_image')) {
				
				if ($result['image']) {
					
					foreach (explode('|', $result['image']) as $img) {
						$image[] = array(
							'thumbnail' => $this->model_tool_image->resize($img, $this->config->get('module_s_testimonial_thumbnail_width'), $this->config->get('module_s_testimonial_thumbnail_height')),
							'thumb'     => $this->model_tool_image->resize($img, $this->config->get('module_s_testimonial_thumb_width'), $this->config->get('module_s_testimonial_thumb_height'))
						);
					}
				}
			}
			
			$text_limit = $this->config->get('module_s_testimonial_text_limit');
			
			$text = '';
			$readmore = false;
			
			if ($this->config->get('module_s_testimonial_text')) {
				
				if ($this->config->get('module_s_testimonial_editor')) {
					$text = $this->model_catalog_s_testimonial->replaceBBCode($result['text']);
				} else {
					$text = $result['text'];
				}
			
				if ($this->config->get('module_s_testimonial_cut') && mb_strlen(strip_tags($text), 'UTF-8') > $text_limit) {
					$text = utf8_substr(strip_tags($text), 0, $text_limit) . '...';
					$readmore = true;
				}
			}
			
			$good = '';
			
			if ($this->config->get('module_s_testimonial_good')) {
				
				if ($this->config->get('module_s_testimonial_editor')) {
					$good = $this->model_catalog_s_testimonial->replaceBBCode($result['good']);
				} else {
					$good = $result['good'];
				}
			
				if ($this->config->get('module_s_testimonial_cut') && mb_strlen(strip_tags($good), 'UTF-8') > $text_limit) {
					$good = utf8_substr(strip_tags($good), 0, $text_limit) . '...';
					$readmore = true;
				}
			}
			
			$bad = '';
			
			if ($this->config->get('module_s_testimonial_bad')) {
				
				if ($this->config->get('module_s_testimonial_editor')) {
					$bad = $this->model_catalog_s_testimonial->replaceBBCode($result['bad']);
				} else {
					$bad = $result['bad'];
				}
			
				if ($this->config->get('module_s_testimonial_cut') && mb_strlen(strip_tags($bad), 'UTF-8') > $text_limit) {
					$bad = utf8_substr(strip_tags($bad), 0, $text_limit) . '...';
					$readmore = true;
				}
			}
				
			$data['testimonials'][] = array(
				'testimonial_id' => $result['testimonial_id'],
				'title'    	 	 => $this->config->get('module_s_testimonial_title') ? $result['title'] : '',
				'city'			 => $this->config->get('module_s_testimonial_city') ? $result['city'] : '',
				'name'		 	 => $this->config->get('module_s_testimonial_name') ? $result['name'] : '',
				'text'		 	 => $text,
				'good'		 	 => $good,
				'bad'		 	 => $bad,
				'rating'	 	 => $this->config->get('module_s_testimonial_rating') ? $result['rating'] : '',
				'avatar'	 	 => $avatar,
				'image'	 		 => $image,
				'comment'		 => trim(strip_tags(html_entity_decode($result['comment'], ENT_QUOTES, 'UTF-8'))) ? html_entity_decode($result['comment'], ENT_QUOTES, 'UTF-8') : '',
				'date_added'	 => $this->config->get('module_s_testimonial_date_added') ? date($this->language->get('date_format_short'), strtotime($result['date_added'])) : '',
				'href' 			 => $this->url->link('information/testimonial/info', 'testimonial_id=' . $result['testimonial_id']),
				'readmore'  	 => $readmore
			);
		}
		
		$url = '';
		
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}

		$pagination = new Pagination();
		$pagination->total = $total;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->url = $this->url->link('information/testimonial', $url . '&page={page}');

		$data['pagination'] = $pagination->render();
		
		// http://googlewebmastercentral.blogspot.com/2011/09/pagination-with-relnext-and-relprev.html
		if ($page == 1) {
		    $this->document->addLink($this->url->link('information/testimonial', '', true), 'canonical');
		} elseif ($page == 2) {
		    $this->document->addLink($this->url->link('information/testimonial', '', true), 'prev');
		} else {
		    $this->document->addLink($this->url->link('information/testimonial', 'page='. ($page - 1), true), 'prev');
		}

		if ($limit && ceil($total / $limit) > $page) {
		    $this->document->addLink($this->url->link('information/testimonial', 'page='. ($page + 1), true), 'next');
		}
		
		return $data;
	}

	public function testimonial_list() {
		$this->response->setOutput($this->load->view('information/testimonial/list', $this->getList()));
	}
	
	private function getTotal() {
		$this->load->language('information/testimonial');
		
		$data['text_rating'] = $this->language->get('text_rating');
		
		$data['field_rating'] = $this->config->get('module_s_testimonial_rating');

		$this->load->model('catalog/s_testimonial');
		
		if ($data['field_rating']) {	
			$data['rating'] = (int)$this->model_catalog_s_testimonial->getRating();
			$rating_total = (int)$this->model_catalog_s_testimonial->getRatingTotal();
			$data['rating_total'] = $rating_total ? sprintf($this->language->get('text_rating_total'), $rating_total) : $this->language->get('text_no_rating');
		} else {
			$data['rating'] = array(0);
			$data['rating_total'] = $this->language->get('text_no_rating');
		}
		
		$total = $this->model_catalog_s_testimonial->getTotalTestimonials();
		
		$data['total'] = $total ? sprintf($this->language->get('text_total'), $total) : $this->language->get('text_no_testimonial');
		
		return $data;
	}
	
	public function total() {
		$this->response->setOutput($this->load->view('information/testimonial/total', $this->getTotal()));
	}
	
	public function info() {
		$this->language->load('information/testimonial');
		
		$this->load->model('catalog/s_testimonial');
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);
		
		$description = $this->config->get('module_s_testimonial_description');
		$language_id = $this->config->get('config_language_id');
		
		if ($description[$language_id]['title']) {
			$heading_title = $description[$language_id]['title'];
		} else {
			$heading_title = $this->language->get('heading_title');
		}
		
		$data['breadcrumbs'][] = array(
	       	'text'      => $heading_title,
			'href'      => $this->url->link('information/testimonial')
	   	);

		if (isset($this->request->get['testimonial_id'])) {
			$testimonial_id = (int)$this->request->get['testimonial_id'];
		} else {
			$testimonial_id = 0;
		}
		
		$testimonial_info = $this->model_catalog_s_testimonial->getTestimonial($testimonial_id);
		
		if ($testimonial_info) {
			
			if ($this->config->get('module_s_testimonial_avatar') || $this->config->get('module_s_testimonial_image')) {
				$this->document->addStyle('catalog/view/javascript/jquery/magnific/magnific-popup.css');
				$this->document->addScript('catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js');
				
				$this->load->model('tool/image');
			}
			
			$this->document->addStyle('catalog/view/javascript/s_testimonial/testimonial.css');
			
			$data['entry_name'] = $this->language->get('entry_name');
			$data['entry_city'] = $this->language->get('entry_city');
			$data['entry_rating'] = $this->language->get('entry_rating');
			$data['entry_date_added'] = $this->language->get('entry_date_added');
			$data['entry_text'] = $this->language->get('entry_text');
			$data['entry_bad'] = $this->language->get('entry_bad');
			$data['entry_good'] = $this->language->get('entry_good');
			$data['entry_image'] = $this->language->get('entry_image');
			$data['entry_comment'] = $this->language->get('entry_comment');

			$data['avatar'] = '';
			
			if ($this->config->get('module_s_testimonial_avatar')) {
				if ($testimonial_info['avatar']) {
					$data['avatar'] = $this->model_tool_image->resize($testimonial_info['avatar'], $this->config->get('module_s_testimonial_avatar_info_width'), $this->config->get('module_s_testimonial_avatar_info_height'));
				} else {
					$data['avatar'] = $this->model_tool_image->resize('catalog/s_testimonial/avatar/no_avatar.png', $this->config->get('module_s_testimonial_avatar_info_width'), $this->config->get('module_s_testimonial_avatar_info_height'));
				}
			}
			
			$data['image'] = array();
			
			if ($this->config->get('module_s_testimonial_image')) {
				
				if ($testimonial_info['image']) {
					
					foreach (explode('|', $testimonial_info['image']) as $value) {
						$data['image'][] = array(
							'thumbnail' => $this->model_tool_image->resize($value, $this->config->get('module_s_testimonial_thumbnail_info_width'), $this->config->get('module_s_testimonial_thumbnail_info_height')),
							'thumb'     => $this->model_tool_image->resize($value, $this->config->get('module_s_testimonial_thumb_width'), $this->config->get('module_s_testimonial_thumb_height'))
						);
					}
				}
			}
				
			$data['title'] = $this->config->get('module_s_testimonial_title') ? $testimonial_info['title'] : '';
			$data['city'] = $this->config->get('module_s_testimonial_city') ? $testimonial_info['city'] : '';
			$data['name'] = $this->config->get('module_s_testimonial_name') ? $testimonial_info['name'] : '';
			$data['text'] = $this->config->get('module_s_testimonial_text') ? ($this->config->get('module_s_testimonial_editor') ? $this->model_catalog_s_testimonial->replaceBBCode($testimonial_info['text']) : $testimonial_info['text']) : '';
			$data['good'] = $this->config->get('module_s_testimonial_good') ? ($this->config->get('module_s_testimonial_editor') ? $this->model_catalog_s_testimonial->replaceBBCode($testimonial_info['good']) : $testimonial_info['good']) : '';
			$data['bad'] = $this->config->get('module_s_testimonial_bad') ? ($this->config->get('module_s_testimonial_editor') ? $this->model_catalog_s_testimonial->replaceBBCode($testimonial_info['bad']) : $testimonial_info['bad']) : '';
			$data['comment'] = trim(strip_tags(html_entity_decode($testimonial_info['comment'], ENT_QUOTES, 'UTF-8'))) ? html_entity_decode($testimonial_info['comment'], ENT_QUOTES, 'UTF-8') : '';
			$data['rating'] = $this->config->get('module_s_testimonial_rating') ? $testimonial_info['rating'] : '';
			$data['date_added'] = $this->config->get('module_s_testimonial_date_added') ? date($this->language->get('date_format_short'), strtotime($testimonial_info['date_added'])) : '';
			
			if ($data['title']) {
				$title = $data['title'];
			} else {
				$title = $this->language->get('text_title');
			}
			
			$data['breadcrumbs'][] = array(
				'text' => $title,
				'href' => $this->url->link('information/testimonial/info', '&testimonial_id=' . $this->request->get['testimonial_id'])
			);
			
			$this->document->setTitle($title);
			
			$data['heading_title'] = $title;
			
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			$this->response->setOutput($this->load->view('information/testimonial/info', $data));
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_error'),
				'href' => $this->url->link('information/testimonial/info', '&testimonial_id=' . $testimonial_id)
			);

			$this->document->setTitle($this->language->get('text_error'));

			$data['heading_title'] = $this->language->get('text_error');

			$data['text_error'] = $this->language->get('text_error');

			$data['button_continue'] = $this->language->get('button_continue');

			$data['continue'] = $this->url->link('common/home');

			$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			$this->response->setOutput($this->load->view('error/not_found', $data));
		}
	}
	
	private function checkFile($folder, $file) {
		$this->load->language('tool/upload');
		$this->load->language('information/testimonial');

		$error = array();
		
		// Sanitize the filename
		$filename = basename(preg_replace('/[^a-zA-Z0-9\.\-\s+]/', '', html_entity_decode($file['name'], ENT_QUOTES, 'UTF-8')));

		// Validate the filename length
		if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 64)) {
			$error = $this->language->get('error_filename');
		}

		// Allowed file extension types
		$allowed = array();

		$allowed = array('png', 'jpe', 'jpeg', 'jpg', 'gif');

		if (!in_array(strtolower(substr(strrchr($filename, '.'), 1)), $allowed)) {
			$error = $this->language->get('error_filetype');
		}

		// Allowed file mime types
		$allowed = array();
		
		$allowed = array('image/png', 'image/jpeg', 'image/gif');

		if (!in_array($file['type'], $allowed)) {
			$error = $this->language->get('error_filetype');
		}
		
		$allowed = array();
		
		$allowed = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
		
		$imageinfo = getimagesize($file['tmp_name']);
		
		if (!in_array($imageinfo[2], $allowed)) {
			$error = $this->language->get('error_filetype');
		}
		
		if ($folder == 'avatar') {
			$width = $this->config->get('module_s_testimonial_upload_avatar_width');
			$height = $this->config->get('module_s_testimonial_upload_avatar_height');
		} else {
			$width = $this->config->get('module_s_testimonial_upload_image_width');
			$height = $this->config->get('module_s_testimonial_upload_image_height');
		}
		
		if ($imageinfo[0] > (int)$width || $imageinfo[1] > (int)$height) {
			$error = $this->language->get('error_imagesize');
		}

		// Check to see if any PHP files are trying to be uploaded
		$content = file_get_contents($file['tmp_name']);

		if (preg_match('/\<\?php/i', $content)) {
			$error = $this->language->get('error_filetype');
		}

		// Return any upload error
		if ($file['error'] != UPLOAD_ERR_OK) {
			$error = $this->language->get('error_upload_' . $file['error']);
		}

		if ($error) {
			return $filename . ' - ' . $error;
		} else {
			return false;
		}
	}
	
	public function write() {
		if ($this->config->get('module_s_testimonial_status') && ($this->config->get('module_s_testimonial_guest') || $this->customer->isLogged())) { 
			$this->load->language('information/testimonial');

			$json = array();
			$data = array();

			if ($this->request->server['REQUEST_METHOD'] == 'POST') {
				
				$data = $this->request->post;
				
				$store_id = $this->config->get('config_store_id');
				$data['store_name'] = $this->config->get('config_name');

				if ($store_id) {
					$data['store_url'] = $this->config->get('config_url');
				} else {
					if ($this->request->server['HTTPS']) {
						$data['store_url'] = HTTPS_SERVER;
					} else {
						$data['store_url'] = HTTP_SERVER;
					}
				}

				if ($this->config->get('module_s_testimonial_title') == 2) {
					if ((utf8_strlen($this->request->post['title']) < 1) || (utf8_strlen($this->request->post['title']) > 255)) {
						$json['error'] = $this->language->get('error_title');
					}
				}
				
				if ($this->config->get('module_s_testimonial_city') == 2) {
					if ((utf8_strlen($this->request->post['city']) < 1) || (utf8_strlen($this->request->post['city']) > 255)) {
						$json['error'] = $this->language->get('error_city');
					}
				}
				
				if ($this->config->get('module_s_testimonial_name') == 2) {
					if ((utf8_strlen($this->request->post['name']) < 1) || (utf8_strlen($this->request->post['name']) > 255)) {
						$json['error'] = $this->language->get('error_name');
					}
				}
				
				if ($this->config->get('module_s_testimonial_email') == 2) {
					if (utf8_strlen($this->request->post['email']) > 96 || !filter_var($this->request->post['email'], FILTER_VALIDATE_EMAIL)) {
						$json['error'] = $this->language->get('error_email');
					}
				}
				
				if ($this->config->get('module_s_testimonial_text') == 2) {
					if (utf8_strlen($this->request->post['text']) < 1) {
						$json['error'] = $this->language->get('error_text');
					}
				}
					
				if ($this->config->get('module_s_testimonial_good') == 2) {
					if (utf8_strlen($this->request->post['good']) < 1) {
						$json['error'] = $this->language->get('error_good');
					}
				}
					
				if ($this->config->get('module_s_testimonial_bad') == 2) {
					if (utf8_strlen($this->request->post['bad']) < 1) {
						$json['error'] = $this->language->get('error_bad');
					}
				}

				if ($this->config->get('module_s_testimonial_rating') == 2) {
					if (empty($this->request->post['rating']) || $this->request->post['rating'] < 0 || $this->request->post['rating'] > 5) {
						$json['error'] = $this->language->get('error_rating');
					}
				}
				
				// Captcha
				if ($this->config->get('captcha_' . $this->config->get('config_captcha') . '_status') && $this->config->get('module_s_testimonial_captcha')) {
					$captcha = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha') . '/validate');

					if ($captcha) {
						$json['error'] = $captcha;
					}
				}
				
				if ($this->config->get('module_s_testimonial_avatar') == 2 && (empty($this->request->files['avatar']['name']) || !is_file($this->request->files['avatar']['tmp_name']))) {	
					$json['error'] = $this->language->get('error_avatar');
				} elseif ($this->config->get('module_s_testimonial_avatar') && !empty($this->request->files['avatar']['name']) && is_file($this->request->files['avatar']['tmp_name'])) {
					$avatar_error = $this->checkFile('avatar', $this->request->files['avatar']);
					
					if ($avatar_error) {
						$json['error'] = $avatar_error;
					} else {
						$avatar = $this->request->files['avatar'];
					}
				}
				
				if ($this->config->get('module_s_testimonial_image') && isset($this->request->files['image']) && $this->request->files['image']) {
					
					$image = array();
					
					foreach($this->request->files['image']['name'] as $k => $value) {
						
						if (!empty($this->request->files['image']['name'][$k]) && is_file($this->request->files['image']['tmp_name'][$k])) {
							
							$image[$k] = array(
								'name' 	   => $this->request->files['image']['name'][$k],
								'type' 	   => $this->request->files['image']['type'][$k],
								'tmp_name' => $this->request->files['image']['tmp_name'][$k],
								'error'    => $this->request->files['image']['error'][$k],
								'size'     => $this->request->files['image']['size'][$k],
							);
							
							$image_error = $this->checkFile('image', $image[$k]);
					
							if ($image_error) {
								$json['error'] = $image_error;
								break;
							}
						}
					}
				}

				if (!isset($json['error'])) {
					$this->load->model('catalog/s_testimonial');
					
					if ($this->config->get('module_s_testimonial_moderation')) {
						$data['status'] = 0;
						$success = $this->language->get('text_moderation');
					} else {
						$data['status'] = 1;
						$success = $this->language->get('text_success');
					}
					
					if (isset($avatar) && $avatar) {
						$data['avatar'] = $this->model_catalog_s_testimonial->uploadFile('avatar', $avatar);
					}
					
					if (isset($image) && $image) {
						foreach ($image as $value) {
							$data['image'][] = $this->model_catalog_s_testimonial->uploadFile('image', $value);
						}
						
						$data['image'] = implode('|', $data['image']);
					}

					$this->model_catalog_s_testimonial->addTestimonial($data);
					$json['success'] =  $success;
				}
			}

			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($json));
		}
	}
}