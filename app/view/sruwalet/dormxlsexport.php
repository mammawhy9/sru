<?
/**
 * widok eksportu
 */
class UFview_SruWalet_DormXlsExport
extends UFview_SruXlsExport {

	public function fillData() {
		$box = UFra::shared('UFbox_SruWalet');

		$this->append('title', $box->titleDormExport());
		$this->append('body', $box->dormExport());
	}
}
