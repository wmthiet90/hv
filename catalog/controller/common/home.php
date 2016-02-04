<?php
class ControllerCommonHome extends Controller {
	private $SlideShow_Home_Banner = 7;
	private $Manufactor_Home_Banner = 8;

	public function index() {

		$this->document->setTitle($this->config->get('config_meta_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));
		$this->document->setKeywords($this->config->get('config_meta_keyword'));

		$this->document->addStyle('catalog/view/javascript/jquery/owl-carousel/owl.carousel.css');
		$this->document->addScript('catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js');

		if (isset($this->request->get['route'])) {
			$this->document->addLink(HTTP_SERVER, 'canonical');
		}

		$this->load->model('design/banner');
		$this->load->model('tool/image');

		$this->load->language('common/common');
		$data['text_partners'] = $this->language->get('text_partners');
		$data['text_featured_products'] = $this->language->get('text_featured_products');
		$data['text_see_all'] = $this->language->get('text_see_all');
		$data['see_all_url'] = $this->url->link('product/manufacturer');

		//Load home slideshow
		$data['home_slideshow_banners'] = array();
		$results = $this->model_design_banner->getBanner($this->SlideShow_Home_Banner);
		foreach ($results as $result) {
			if (is_file(DIR_IMAGE . $result['image'])) {
				$data['home_slideshow_banners'][] = array(
					'title' => $result['title'],
					'link'  => $result['link'],
					'image' => $this->model_tool_image->resize($result['image'], 1920, 675)
				);
			}
		}

		//Load home slideshow
		$data['home_brand_banners'] = array();
		$results = $this->model_design_banner->getBanner($this->Manufactor_Home_Banner);
		foreach ($results as $result) {
			if (is_file(DIR_IMAGE . $result['image'])) {
				$data['home_brand_banners'][] = array(
					'title' => $result['title'],
					'link'  => $result['link'],
					'image' => $this->model_tool_image->resize($result['image'], 278, 77)
				);
			}
		}

		//Load featured manufacturers
		$this->load->model('catalog/manufacturer');
		$data['featured_manufacturers'] = array();
		$manufacturers = $this->model_catalog_manufacturer->getManufacturers(array(
			'start' => 0,
			'limit' => 9
		));

		foreach ($manufacturers as $result) {
			if ($result['image']) {
				$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_thumb_width'), $this->config->get('config_image_thumb_height'));
			} else {
				$image = $this->model_tool_image->resize('placeholder.png', $this->config->get('config_image_thumb_width'), $this->config->get('config_image_thumb_height'));
			}
			$data['featured_manufacturers'][] = array(
				'manufacturer_id' => $result['manufacturer_id'],
				'thumb' => $image,
				'name' => $result['name'],
				'description' => $result['addtional_info'],
				'href' => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $result['manufacturer_id'])
			);
		}

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/home.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/common/home.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/common/home.tpl', $data));
		}
	}
}