<?php
class ControllerModuleSubcategories extends Controller {
	public function index() {
		$this->load->language('module/category');

		$data['heading_title'] = $this->language->get('heading_title');

		if (isset($this->request->get['path'])) {
			$parts = explode('_', (string)$this->request->get['path']);
		} else {
			$parts = array();
		}

		if (isset($parts[0])) {
			$data['category_id'] = $parts[0];
		} else {
			$data['subcategories_id'] = 0;
		}

		if (isset($parts[1])) {
			$data['child_id'] = $parts[1];
		} else {
			$data['child_id'] = 0;
		}

		$this->load->model('catalog/category');

		$this->load->model('catalog/product');

		$data['categories'] = array();



		$parts = explode('_', (string)$this->request->get['path']);

		$category_id = (int)array_pop($parts);

//		$categories = $this->model_catalog_category->getCategories($category_id);
//		if($categories){
//			foreach ($categories as $category) {
//				$children = $this->model_catalog_category->getCategories($category['category_id']);
//
//				foreach($children as $child) {
//					$filter_data = array('filter_category_id' => $child['category_id'], 'filter_sub_category' => true);
//
//					$children_data[] = array(
//						'category_id' => $child['category_id'],
//						'name' => $child['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
//						'href' => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'])
//					);
//				}
//			}
//		}
//		$data['categories']=$categories;
//
//		$category_info = $this->model_catalog_category->getCategory($category_id);
//		$data['maincategory']=$category_info['name'];
//		print_r($category_info);

		$category_info = $this->model_catalog_category->getCategory($category_id);
		$data['categoryname']=$category_info['name'];


		$categories = $this->model_catalog_category->getCategories($category_id);

		foreach ($categories as $category) {
			$children_data = array();
			$child_data = array();


				$children = $this->model_catalog_category->getCategories($category['category_id']);

				foreach($children as $child) {
					$filter_data = array('filter_category_id' => $child['category_id'], 'filter_sub_category' => true);

					$children_data[] = array(
						'category_id' => $child['category_id'],
						'name' => $child['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
						'href' => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'])
					);
				}


			$filter_data = array(
				'filter_category_id'  => $category['category_id'],
				'filter_sub_category' => true
			);

			$data['categories'][] = array(
				'category_id' => $category['category_id'],
				'name'        => $category['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
				'children'    => $children_data,
				'href'        => $this->url->link('product/category', 'path=' . $category['category_id'])
			);
		}


		return $this->load->view('module/subcategories', $data);
	}
}