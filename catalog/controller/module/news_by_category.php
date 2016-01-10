<?php
class ControllerModuleNewsByCategory extends Controller {
	public function index($setting) {
		$this->load->language('module/news_by_category');

		$data['heading_title'] = $this->language->get('heading_title');
		
		$this->load->model('news/article');
		
		$this->load->model('tool/image');

		$data['articles'] = array();
		
		$results = $this->model_news_article->getArticleCarousel($setting['category']);

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_category_description WHERE category_id = '" . (int)$setting['category'] . "'");

		$result_category = $query->rows;

		$data['category_href'] = $this->url->link('news/category', 'news_path=' . $result_category[0]['category_id']);

		if(isset($results)){
			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height']);
				} else {
					$image = false;
				}
				
				if ($this->config->get('news_review_status')) {
					$rating = array();
					$this->load->model('news/review');
					$reviews = $this->model_news_review->getReviewsByArticleId($result['article_id']);
					foreach($reviews as $review){
						$rating[] = $review['rating'];
					}
				} else {
					$rating = false;
				}

				if(($result['login_to_view'] == 1 && $this->customer->isLogged()) || $result['login_to_view'] == 0){
					$link = $this->url->link('news/article', 'article_id=' . $result['article_id']);
				} else {
					$link = $this->url->link('account/login');
				}

				$data['articles'][] = array(
					'category_name' => $result_category[0]['name'],
					'article_id' => $result['article_id'],
					'short_description' => $result['short_description'],
					'thumb'   	 => $image,
					'name'    	 => $result['name'],
					'rating'     => $rating,
					'href'    	 => $link
				);
			}
		
		}
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/news_by_category.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/news_by_category.tpl', $data);
		} else {
			return $this->load->view('default/template/module/news_by_category.tpl', $data);
		}
	}
}
?>