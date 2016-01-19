<?php
class ControllerModuleNewsFeatured extends Controller {
	public function index($setting) {
		$this->load->language('module/news_featured');
		$this->load->language('common/common');

		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_see_all'] = $this->language->get('text_see_all');		
		$data['text_newsevent'] = $this->language->get('text_newsevent');	

		$this->load->model('news/article');
		$this->load->model('tool/image');

		$data['articles'] = array();

		if (!$setting['limit']) {
			$setting['limit'] = 3;
		}

		$articles = array_slice($setting['articles'], 0, (int)$setting['limit']);

		foreach ($articles as $article_id) {
			$article_info = $this->model_news_article->getArticle($article_id);

			if ($article_info) {
				if ($article_info['image']) {
					$image = $this->model_tool_image->resize($article_info['image'], $setting['width'], $setting['height']);
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
				}

				$data['articles'][] = array(
					'article_id'  => $article_info['article_id'],
					'thumb'       => $image,
					'name'        => $article_info['name'],
					'short_description' => $article_info['short_description'],
					'description' => utf8_substr(strip_tags(html_entity_decode($article_info['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
					'href'        => $this->url->link('news/article', 'article_id=' . $article_info['article_id'])
				);
			}
		}

		if ($data['articles']) {
			$data['see_all_url'] = $this->url->link('news/category', 'news_path=' . 1);

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/news_featured.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/module/news_featured.tpl', $data);
			} else {
				return $this->load->view('default/template/module/news_featured.tpl', $data);
			}
		}
	}
}