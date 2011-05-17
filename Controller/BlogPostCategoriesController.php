<?php
/**
 * BlogPostCategories Controller
 *
 * Pretty much just baked admin actions except add/edit use generateTreeList()
 * for finding the parents so you see the hierarchy.
 *
 * @author Neil Crookes <neil@crook.es>
 * @link http://www.neilcrookes.com http://neil.crook.es
 * @copyright (c) 2011 Neil Crookes
 * @license MIT License - http://www.opensource.org/licenses/mit-license.php *
 */
class BlogPostCategoriesController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->BlogPostCategory->recursive = 0;
		$this->set('blogPostCategories', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->BlogPostCategory->id = $id;
		if (!$this->BlogPostCategory->exists()) {
			throw new NotFoundException(__('Invalid blog post category'));
		}
		$this->set('blogPostCategory', $this->BlogPostCategory->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->BlogPostCategory->create();
			if ($this->BlogPostCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The blog post category has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The blog post category could not be saved. Please, try again.'));
			}
		}
		$parents = $this->BlogPostCategory->generateTreeList();
		$this->set(compact('parents'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->BlogPostCategory->id = $id;
		if (!$this->BlogPostCategory->exists()) {
			throw new NotFoundException(__('Invalid blog post category'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->BlogPostCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The blog post category has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The blog post category could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->BlogPostCategory->read(null, $id);
		}
		$parents = $this->BlogPostCategory->generateTreeList();
		$this->set(compact('parents'));
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
		$this->BlogPostCategory->id = $id;
		if (!$this->BlogPostCategory->exists()) {
			throw new NotFoundException(__('Invalid blog post category'));
		}
		if ($this->BlogPostCategory->delete()) {
			$this->Session->setFlash(__('Blog post category deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Blog post category was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
