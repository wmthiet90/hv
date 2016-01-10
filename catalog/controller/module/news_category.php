<?php
class ControllerModuleNewsCategory extends Controller {
	public function index() {
		$this->load->language('module/news_category');

		$data['heading_title'] = $this->language->get('heading_title');

		if (isset($this->request->get['news_path'])) {
			$parts = explode('_', (string)$this->request->get['news_path']);
		} else {
			$parts = array();
		}

		if (isset($parts[0])) {
			$data['category_id'] = $parts[0];
		} else {
			$data['category_id'] = 0;
		}

		if (isset($parts[1])) {
			$data['child_id'] = $parts[1];
		} else {
			$data['child_id'] = 0;
		}

		$this->load->model('news/category');

		$this->load->model('news/article');

		$data['categories'] = array();

		$categories = $this->model_news_category->getCategories(0);

		foreach ($categories as $category) {
			$children_data = array();

			if ($category['category_id'] == $data['category_id']) {
				$children = $this->model_news_category->getCategories($category['category_id']);

				foreach($children as $child) {					

					$children_data[] = array(
						'category_id' => $child['category_id'],
						'name' => $child['name'] .  ' (' . $this->model_news_article->getArticlesByCategory($child['category_id']) . ')',
						'href' => $this->url->link('news/category', 'news_path=' . $category['category_id'] . '_' . $child['category_id'])
					);
				}
			}

			$filter_data = array(
				'filter_category_id'  => $category['category_id'],
				'filter_sub_category' => true
			);

			$data['categories'][] = array(
				'category_id' => $category['category_id'],
				'name'        => $category['name'] . ' (' . $this->model_news_article->getArticlesByCategory($category['category_id']) . ')',
				'children'    => $children_data,
				'href'        => $this->url->link('news/category', 'news_path=' . $category['category_id'])
			);
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/news_category.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/news_category.tpl', $data);
		} else {
			return $this->load->view('default/template/module/news_category.tpl', $data);
		}
	}
}