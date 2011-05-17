<?php
/**
 * BlogSettings Controller
 *
 * Contains baked admin actions for index, view and edit. Note, you shouldn't
 * be able to add or delete any settings because all existing and not other
 * settings are required in the plugin application code. If you need to add any
 * in your application it is assumed if you can use those settings in the code
 * you will also be able to add those records directly in the blog_settings
 * table in your database.
 *
 * @author Neil Crookes <neil@crook.es>
 * @link http://www.neilcrookes.com http://neil.crook.es
 * @copyright (c) 2011 Neil Crookes
 * @license MIT License - http://www.opensource.org/licenses/mit-license.php
 */
class BlogSettingsController extends AppController {

	public $helpers = array('Text', 'Time');

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->BlogSetting->recursive = 0;
		$this->set('blogSettings', $this->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->BlogSetting->id = $id;
		if (!$this->BlogSetting->exists()) {
			throw new NotFoundException(__('Invalid blog setting'));
		}
		$this->set('blogSetting', $this->BlogSetting->read(null, $id));
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->BlogSetting->id = $id;
		if (!$this->BlogSetting->exists()) {
			throw new NotFoundException(__('Invalid blog setting'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->BlogSetting->save($this->request->data)) {
				$this->Session->setFlash(__('The blog setting has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The blog setting could not be saved. Please, try again.'));
				$blogSetting = $this->BlogSetting->read(null, $id);
			}
		} else {
			$this->request->data = $blogSetting = $this->BlogSetting->read(null, $id);
		}
		$this->set('blogSetting', $blogSetting);
	}
}
