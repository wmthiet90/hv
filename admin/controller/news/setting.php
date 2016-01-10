<?php
class ControllerNewsSetting extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('news/setting'); 

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('news', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('news/setting', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_items'] = $this->language->get('text_items');
		$data['text_article'] = $this->language->get('text_article');
		$data['text_voucher'] = $this->language->get('text_voucher');
		$data['text_account'] = $this->language->get('text_account');
		$data['text_browse'] = $this->language->get('text_browse');
		$data['text_clear'] = $this->language->get('text_clear');	
		
		$data['entry_catalog_limit'] = $this->language->get('entry_catalog_limit');
		$data['entry_show_viewed'] = $this->language->get('entry_show_viewed');
		$data['entry_show_date_added'] = $this->language->get('entry_show_date_added');
		$data['entry_show_date_modified'] = $this->language->get('entry_show_date_modified');
		$data['entry_show_author'] = $this->language->get('entry_show_author');
		$data['entry_review'] = $this->language->get('entry_review');
		$data['entry_tax_default'] = $this->language->get('entry_tax_default');
		$data['entry_tax_customer'] = $this->language->get('entry_tax_customer');
		$data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$data['entry_customer_group_display'] = $this->language->get('entry_customer_group_display');
		$data['entry_customer_view'] = $this->language->get('entry_customer_view');

		$data['entry_width'] = $this->language->get('entry_width');
		$data['entry_height'] = $this->language->get('entry_height');

		$data['entry_image_category'] = $this->language->get('entry_image_category');
		$data['entry_image_thumb'] = $this->language->get('entry_image_thumb');		
		$data['entry_image_article'] = $this->language->get('entry_image_article');
		$data['entry_image_additional'] = $this->language->get('entry_image_additional');
		$data['entry_image_related'] = $this->language->get('entry_image_related');


		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_image'] = $this->language->get('tab_image');
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['customer_group_display'])) {
			$data['error_customer_group_display'] = $this->error['customer_group_display'];
		} else {
			$data['error_customer_group_display'] = '';
		}

		if (isset($this->error['image_category'])) {
			$data['error_image_category'] = $this->error['image_category'];
		} else {
			$data['error_image_category'] = '';
		}

		if (isset($this->error['image_thumb'])) {
			$data['error_image_thumb'] = $this->error['image_thumb'];
		} else {
			$data['error_image_thumb'] = '';
		}

		if (isset($this->error['image_article'])) {
			$data['error_image_article'] = $this->error['image_article'];
		} else {
			$data['error_image_article'] = '';
		}

		if (isset($this->error['image_additional'])) {
			$data['error_image_additional'] = $this->error['image_additional'];
		} else {
			$data['error_image_additional'] = '';
		}	

		if (isset($this->error['image_related'])) {
			$data['error_image_related'] = $this->error['image_related'];
		} else {
			$data['error_image_related'] = '';
		}

		if (isset($this->error['catalog_limit'])) {
			$data['error_catalog_limit'] = $this->error['catalog_limit'];
		} else {
			$data['error_catalog_limit'] = '';
		}

		if (isset($this->error['admin_limit'])) {
			$data['error_admin_limit'] = $this->error['admin_limit'];
		} else {
			$data['error_admin_limit'] = '';
		}	

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL'),			
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('news/setting', 'token=' . $this->session->data['token'], 'SSL'),			
		);

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$data['action'] = $this->url->link('news/setting', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('news/article', 'token=' . $this->session->data['token'], 'SSL');

		$data['token'] = $this->session->data['token'];


		if (isset($this->request->post['news_catalog_limit'])) {
			$data['news_catalog_limit'] = $this->request->post['news_catalog_limit'];
		} else {
			$data['news_catalog_limit'] = $this->config->get('news_catalog_limit');
		}	

		if (isset($this->request->post['news_show_author'])) {
			$data['news_show_author'] = $this->request->post['news_show_author'];
		} else {
			$data['news_show_author'] = $this->config->get('news_show_author');
		}

		if (isset($this->request->post['news_show_viewed'])) {
			$data['news_show_viewed'] = $this->request->post['news_show_viewed'];
		} else {
			$data['news_show_viewed'] = $this->config->get('news_show_viewed');
		}

		if (isset($this->request->post['news_show_date_added'])) {
			$data['news_show_date_added'] = $this->request->post['news_show_date_added'];
		} else {
			$data['news_show_date_added'] = $this->config->get('news_show_date_added');
		}

		if (isset($this->request->post['news_show_date_modified'])) {
			$data['news_show_date_modified'] = $this->request->post['news_show_date_modified'];
		} else {
			$data['news_show_date_modified'] = $this->config->get('news_show_date_modified');
		}

		if (isset($this->request->post['news_review_status'])) {
			$data['news_review_status'] = $this->request->post['news_review_status'];
		} else {
			$data['news_review_status'] = $this->config->get('news_review_status');
		}

		$this->load->model('tool/image');

		$data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);

		if (isset($this->request->post['news_image_category_width'])) {
			$data['news_image_category_width'] = $this->request->post['news_image_category_width'];
		} else {
			$data['news_image_category_width'] = $this->config->get('news_image_category_width');
		}

		if (isset($this->request->post['news_image_category_height'])) {
			$data['news_image_category_height'] = $this->request->post['news_image_category_height'];
		} else {
			$data['news_image_category_height'] = $this->config->get('news_image_category_height');
		}

		if (isset($this->request->post['news_image_thumb_width'])) {
			$data['news_image_thumb_width'] = $this->request->post['news_image_thumb_width'];
		} else {
			$data['news_image_thumb_width'] = $this->config->get('news_image_thumb_width');
		}

		if (isset($this->request->post['news_image_thumb_height'])) {
			$data['news_image_thumb_height'] = $this->request->post['news_image_thumb_height'];
		} else {
			$data['news_image_thumb_height'] = $this->config->get('news_image_thumb_height');
		}

		if (isset($this->request->post['news_image_popup_width'])) {
			$data['news_image_popup_width'] = $this->request->post['news_image_popup_width'];
		} else {
			$data['news_image_popup_width'] = $this->config->get('news_image_popup_width');
		}

		if (isset($this->request->post['news_image_popup_height'])) {
			$data['news_image_popup_height'] = $this->request->post['news_image_popup_height'];
		} else {
			$data['news_image_popup_height'] = $this->config->get('news_image_popup_height');
		}

		if (isset($this->request->post['news_image_article_width'])) {
			$data['news_image_article_width'] = $this->request->post['news_image_article_width'];
		} else {
			$data['news_image_article_width'] = $this->config->get('news_image_article_width');
		}

		if (isset($this->request->post['news_image_article_height'])) {
			$data['news_image_article_height'] = $this->request->post['news_image_article_height'];
		} else {
			$data['news_image_article_height'] = $this->config->get('news_image_article_height');
		}

		if (isset($this->request->post['news_image_related_width'])) {
			$data['news_image_related_width'] = $this->request->post['news_image_related_width'];
		} else {
			$data['news_image_related_width'] = $this->config->get('news_image_related_width');
		}

		if (isset($this->request->post['news_image_related_height'])) {
			$data['news_image_related_height'] = $this->request->post['news_image_related_height'];
		} else {
			$data['news_image_related_height'] = $this->config->get('news_image_related_height');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('news/setting.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'news/setting')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->request->post['news_image_category_width'] || !$this->request->post['news_image_category_height']) {
			$this->error['image_category'] = $this->language->get('error_image_category');
		} 

		if (!$this->request->post['news_image_thumb_width'] || !$this->request->post['news_image_thumb_height']) {
			$this->error['image_thumb'] = $this->language->get('error_image_thumb');
		}	

		if (!$this->request->post['news_image_article_width'] || !$this->request->post['news_image_article_height']) {
			$this->error['image_article'] = $this->language->get('error_image_article');
		}

		if (!$this->request->post['news_image_related_width'] || !$this->request->post['news_image_related_height']) {
			$this->error['image_related'] = $this->language->get('error_image_related');
		}


		if (!$this->request->post['news_catalog_limit']) {
			$this->error['catalog_limit'] = $this->language->get('error_limit');
		}

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
}
?>