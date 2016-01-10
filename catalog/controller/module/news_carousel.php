<?php  
class ControllerModuleNewsCarousel extends Controller {
	public function index($setting) {
		static $module = 0;

		$this->load->model('news/article');
		$this->load->model('tool/image');

		$this->document->addStyle('catalog/view/javascript/jquery/owl-carousel/owl.carousel.css');
		$this->document->addScript('catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js');

		$data['articles'] = array();

		$results = $this->model_news_article->getArticleCarousel($setting['category']);

		foreach ($results as $result) {
			if(($result['login_to_view'] == 1 && $this->customer->isLogged()) || $result['login_to_view'] == 0){
					$link = $this->url->link('news/article', 'article_id=' . $result['article_id']);
				} else {
					$link = $this->url->link('account/login');
				}
			if (is_file(DIR_IMAGE . $result['image'])) {
				$data['articles'][] = array(
					'title' => $result['name'],
					'link'  => $link,
					'image' => $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height'])
				);
			}
		}

		$data['module'] = $module++;

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/news_carousel.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/news_carousel.tpl', $data);
		} else {
			return $this->load->view('default/template/module/news_carousel.tpl', $data);
		}
	}
}
?>