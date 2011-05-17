<?php
/**
 * BlogPostTags Controller
 * 
 * Just contains baked admin actions
 *
 * @author Neil Crookes <neil@crook.es>
 * @link http://www.neilcrookes.com http://neil.crook.es
 * @copyright (c) 2011 Neil Crookes
 * @license MIT License - http://www.opensource.org/licenses/mit-license.php
 */
class BlogPostTagsController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->BlogPostTag->recursive = 0;
		$this->set('blogPostTags', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->BlogPostTag->id = $id;
		if (!$this->BlogPostTag->exists()) {
			throw new NotFoundException(__('Invalid blog post tag'));
		}
		$this->set('blogPostTag', $this->BlogPostTag->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->BlogPostTag->create();
			if ($this->BlogPostTag->save($this->request->data)) {
				$this->Session->setFlash(__('The blog post tag has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The blog post tag could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->BlogPostTag->id = $id;
		if (!$this->BlogPostTag->exists()) {
			throw new NotFoundException(__('Invalid blog post tag'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->BlogPostTag->save($this->request->data)) {
				$this->Session->setFlash(__('The blog post tag has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The blog post tag could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->BlogPostTag->read(null, $id);
		}
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->BlogPostTag->id = $id;
		if (!$this->BlogPostTag->exists()) {
			throw new NotFoundException(__('Invalid blog post tag'));
		}
		if ($this->BlogPostTag->delete()) {
			$this->Session->setFlash(__('Blog post tag deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Blog post tag was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
