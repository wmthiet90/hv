<?php
class ControllerProductCategories extends Controller {
	public function index() {
		$this->load->language('product/category');

		$data['text_empty'] = $this->language->get('text_empty');
		$data['text_product'] = $this->language->get('text_product');

		$this->load->model('catalog/category');
		$this->load->model('catalog/product');
		$this->load->model('tool/image');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);
		$data['breadcrumbs'][] = array(
			'text' => $data['text_product'],
			'href' => $this->url->link('product/categories')
		);

		$results = $this->model_catalog_category->getCategories(0);
		foreach ($results as $result) {
			
		}

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/categories.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/product/categories.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/product/categories.tpl', $data));
		}
	}
}