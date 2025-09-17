 <?php
class ControllerExtensionModuleSlideshow extends Controller {
	public function index($setting) {
		static $module = 0;		
		$this->language->load('extension/module/slideshow');
		$this->load->model('design/banner');
		$this->load->model('tool/image');
	 	$this->document->addScript('catalog/view/javascript/jquery/swiper/js/swiper8.min.js', 'footer');
		$data['banners'] = array();

		$results = $this->model_design_banner->getBanner($setting['banner_id']);

		foreach ($results as $result) {
			if (is_file(DIR_IMAGE . $result['image'])) {
				$data['banners'][] = array(
					'title' => $result['title'],
					'banner_text' => $result['banner_text'],
					'link'  => $result['link'],
					// 'image_mob' => $this->model_tool_image->resize($result['image'], 480,280),
					'image' => $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height']),
					'image_w' => $setting['width'],
					'image_h' => $setting['height']
				);
			}
		}
		$data['text_more'] = $this->language->get('text_more');
		$data['module'] = $module++;

		return $this->load->view('extension/module/slideshow', $data);
	}
}