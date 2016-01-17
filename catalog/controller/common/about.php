<?php
class ControllerCommonAbout extends Controller {
	private $Manufactor_Home_Banner = 8;

	public function index() {

		$this->document->addStyle('catalog/view/javascript/jquery/owl-carousel/owl.carousel.css');
		$this->document->addScript('catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js');

		$this->load->language('common/common');
		$data['text_partners'] = $this->language->get('text_partners');
		$data['text_aboutus'] = $this->language->get('text_aboutus');

		$this->load->model('design/banner');
		$this->load->model('tool/image');

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

		//Load about us content
		$this->load->model('news/article');
		$article_info = $this->model_news_article->getArticle(DEFAULT_ABOUT_US_NEWS_ID);

		if($article_info){
			$this->document->setTitle($article_info['name']);
			$this->document->setDescription($article_info['meta_description']);
			$this->document->setKeywords($article_info['meta_keyword']);
			$this->document->addLink($this->url->link('common/about'), 'canonical');

			$data['description'] = html_entity_decode($article_info['description'], ENT_QUOTES, 'UTF-8');
		} else {
			$this->document->setTitle($this->config->get('config_meta_title'));
			$this->document->setDescription($this->config->get('config_meta_description'));
			$this->document->setKeywords($this->config->get('config_meta_keyword'));
			if (isset($this->request->get['route'])) {
				$this->document->addLink(HTTP_SERVER, 'canonical');
			}
			$data['description'] = 'The information not found!';
		}

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/about.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/common/about.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/common/about.tpl', $data));
		}
	}
}