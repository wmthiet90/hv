<?php
class ControllerNewsCategory extends Controller {
	public function index() {
		$this->load->language('news/category');
		$this->load->language('common/common');		

		$this->load->model('news/category');

		$this->load->model('news/article');

		$this->load->model('tool/image');

		$data['text_see_more'] = $this->language->get('text_see_more');

		if (isset($this->request->get['filter'])) {
			$filter = $this->request->get['filter'];
		} else {
			$filter = '';
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'p.date_added';
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
			$limit = $this->request->get['limit'];
		} else {
			$limit = $this->config->get('news_catalog_limit');
		}
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		if (isset($this->request->get['news_path'])) {
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

			$path = '';

			$parts = explode('_', (string)$this->request->get['news_path']);

			$category_id = (int)array_pop($parts);

			foreach ($parts as $path_id) {
				if (!$path) {
					$path = (int)$path_id;
				} else {
					$path .= '_' . (int)$path_id;
				}

				$category_info = $this->model_news_category->getCategory($path_id);

				if ($category_info) {
					$data['breadcrumbs'][] = array(
						'text' => $category_info['name'],
						'href' => $this->url->link('news/category', 'news_path=' . $path . $url)
					);
				}
			}
		} else {
			$category_id = 0;
		}

		$category_info = $this->model_news_category->getCategory($category_id);
		if ($category_info) {
			$this->document->setTitle($category_info['name']);
			$this->document->setDescription($category_info['meta_description']);
			$this->document->setKeywords($category_info['meta_keyword']);
			$this->document->addLink($this->url->link('news/category', 'news_path=' . $this->request->get['news_path']), 'canonical');

			$data['heading_title'] = $category_info['name'];

			$data['text_refine'] = $this->language->get('text_refine');
			$data['text_empty'] = $this->language->get('text_empty');
			$data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
			$data['text_sort'] = $this->language->get('text_sort');
			$data['text_limit'] = $this->language->get('text_limit');

			$data['button_continue'] = $this->language->get('button_continue');
			$data['button_list'] = $this->language->get('button_list');
			$data['button_grid'] = $this->language->get('button_grid');

			// Set the last category breadcrumb
			$data['breadcrumbs'][] = array(
				'text' => $category_info['name'],
				'href' => $this->url->link('news/category', 'news_path=' . $this->request->get['news_path'])
			);

			if ($category_info['image']) {
				$data['thumb'] = $this->model_tool_image->resize($category_info['image'], $this->config->get('config_image_category_width'), $this->config->get('config_image_category_height'));
			} else {
				$data['thumb'] = '';
			}
			$data['description'] = html_entity_decode($category_info['description'], ENT_QUOTES, 'UTF-8');

			$url = '';
			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['categories'] = array();
			$results = $this->model_news_category->getCategories($category_id);

			foreach ($results as $result) {
				$filter_data = array(
					'filter_category_id'  => $result['category_id'],
					'filter_sub_category' => true
				);

				$data['categories'][] = array(
					'name'  => $result['name'] . ($this->config->get('config_article_count') ? ' (' . $this->model_news_article->getTotalArticles($filter_data) . ')' : ''),
					'href'  => $this->url->link('news/category', 'news_path=' . $this->request->get['news_path'] . '_' . $result['category_id'] . $url)
				);
			}

			$data['articles'] = array();

			if($category_id == DEFAULT_RECRUITMENTCATEGORY_ID){
				$limit = PHP_INT_MAX;
			}
			$filter_data = array(
				'filter_category_id' => $category_id,
				'filter_filter'      => $filter,
				'sort'               => $sort,
				'order'              => $order,
				'start'              => ($page - 1) * $limit,
				'limit'              => $limit
			);
			$article_total = $this->model_news_article->getTotalArticlesByCategory($category_id);
			$results = $this->model_news_article->getArticles($filter_data);

			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('news_image_article_width'), $this->config->get('news_image_article_height'));
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $this->config->get('news_image_article_width'), $this->config->get('news_image_article_height'));
				}

				if ($this->config->get('news_review_status')) {
					$rating = (int)$result['rating'];
				} else {
					$rating = false;
				}

				$data['articles'][] = array(
					'article_id'  => $result['article_id'],					
					'date_added'  => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
					'thumb'       => $image,
					'name'        => $result['name'],
					'description' => html_entity_decode($result['description']), //utf8_substr(strip_tags(, ENT_QUOTES, 'UTF-8')), 0, 100) . '..',
					'short_description' => $result['short_description'],
					'rating'      => $result['rating'],
					'is_hot_news'      => $result['is_hot_news'] == '1',
					'href'        => $this->url->link('news/article', 'news_path=' . $this->request->get['news_path'] . '&article_id=' . $result['article_id'] . $url)
				);				
			}

			$url = '';
			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

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
			$pagination->total = $article_total;
			$pagination->page = $page;
			$pagination->limit = $limit;
			$pagination->url = $this->url->link('news/category', 'news_path=' . $this->request->get['news_path'] . $url . '&page={page}');
			$data['pagination'] = $pagination->render();
			$data['results'] = sprintf($this->language->get('text_pagination'), ($article_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($article_total - $limit)) ? $article_total : ((($page - 1) * $limit) + $limit), $article_total, ceil($article_total / $limit));

			$data['continue'] = $this->url->link('common/home');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			if($category_id == DEFAULT_RECRUITMENTCATEGORY_ID) {
				$data['text_workinhoaviet'] = $this->language->get('text_workinhoaviet');
				$data['text_openjobs'] = $this->language->get('text_openjobs');

				if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/news/recruitment.tpl')) {
					$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/news/recruitment.tpl', $data));
				} else {
					$this->response->setOutput($this->load->view('default/template/news/recruitment.tpl', $data));
				}
			} else {
				if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/news/category.tpl')) {
					$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/news/category.tpl', $data));
				} else {
					$this->response->setOutput($this->load->view('default/template/news/category.tpl', $data));
				}
			}
		} else {
			$url = '';

			if (isset($this->request->get['news_path'])) {
				$url .= '&news_path=' . $this->request->get['news_path'];
			}

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_error'),
				'href' => $this->url->link('news/category', $url)
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

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/error/not_found.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/error/not_found.tpl', $data));
			}
		}		
	}
}