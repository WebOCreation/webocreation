<?php
class ModelDesignnewsticker extends Model {
	public function addnewsticker($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "newsticker SET name = '" . $this->db->escape($data['name']) . "', status = '" . (int)$data['status'] . "'");

		$newsticker_id = $this->db->getLastId();

		if (isset($data['newsticker_image'])) {
			foreach ($data['newsticker_image'] as $language_id => $value) {
				foreach ($value as $newsticker_image) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "newsticker_image SET newsticker_id = '" . (int)$newsticker_id . "', language_id = '" . (int)$language_id . "', title = '" .  $this->db->escape($newsticker_image['title']) . "', link = '" .  $this->db->escape($newsticker_image['link']) . "', image = '" .  $this->db->escape($newsticker_image['image']) . "', sort_order = '" .  (int)$newsticker_image['sort_order'] . "'");
				}
			}
		}

		return $newsticker_id;
	}

	public function editnewsticker($newsticker_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "newsticker SET name = '" . $this->db->escape($data['name']) . "', status = '" . (int)$data['status'] . "' WHERE newsticker_id = '" . (int)$newsticker_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "newsticker_image WHERE newsticker_id = '" . (int)$newsticker_id . "'");

		if (isset($data['newsticker_image'])) {
			foreach ($data['newsticker_image'] as $language_id => $value) {
				foreach ($value as $newsticker_image) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "newsticker_image SET newsticker_id = '" . (int)$newsticker_id . "', language_id = '" . (int)$language_id . "', title = '" .  $this->db->escape($newsticker_image['title']) . "', link = '" .  $this->db->escape($newsticker_image['link']) . "', image = '" .  $this->db->escape($newsticker_image['image']) . "', sort_order = '" . (int)$newsticker_image['sort_order'] . "'");
				}
			}
		}
	}

	public function deletenewsticker($newsticker_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "newsticker WHERE newsticker_id = '" . (int)$newsticker_id . "'");
	}

	public function getnewsticker($newsticker_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "newsticker WHERE newsticker_id = '" . (int)$newsticker_id . "'");

		return $query->row;
	}

	public function getnewstickers($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "newsticker";

		$sort_data = array(
			'name',
			'status'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY name";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getnewstickerImages($newsticker_id) {
		$newsticker_image_data = array();

		$newsticker_image_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "newsticker_image WHERE newsticker_id = '" . (int)$newsticker_id . "' ORDER BY sort_order ASC");

		foreach ($newsticker_image_query->rows as $newsticker_image) {
			$newsticker_image_data[$newsticker_image['language_id']][] = array(
				'title'      => $newsticker_image['title'],
				'link'       => $newsticker_image['link'],
				'sort_order' => $newsticker_image['sort_order']
			);
		}

		return $newsticker_image_data;
	}

	public function getTotalnewstickers() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "newsticker");

		return $query->row['total'];
	}
}
