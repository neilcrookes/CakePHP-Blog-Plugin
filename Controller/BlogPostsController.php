<?php
/**
 * BlogPosts Controller
 *
 * @author Neil Crookes <neil@crook.es>
 * @link http://www.neilcrookes.com http://neil.crook.es
 * @copyright (c) 2011 Neil Crookes
 * @license MIT License - http://www.opensource.org/licenses/mit-license.php
 */
class BlogPostsController extends AppController {

  /**
   * Components this controller uses
   *
   * @var array
   */
  public $components = array('RequestHandler');

  /**
   * Helpers this controller uses
   *
   * @var array
   */
  public $helpers = array('Time', 'Rss', 'Blog.Blog');

  /**
   * Default pagination options
   *
   * @var array
   */
  public $paginate = array(
    'limit' => 10,
    'order' => array(
      'BlogPost.created DESC'
    ),
    'recursive' => 0,
  );

  public function beforeFilter() {
    parent::beforeFilter();
    $this->set('blogSettings', ClassRegistry::init('Blog.BlogSetting')->getSettings());
  }

  /**
   * Index action handles all blog post index views, whether filtered by
   * category, tag or archive, or rendered as HTML or RSS
   */
  public function index() {

    $this->paginate['conditions'][]['BlogPost.published'] = 1;

    if ($this->RequestHandler->isRss()) {

      // Add RSS condition to default options defined in paginate
      $options = array_merge(
        $this->paginate,
        array('conditions' => array('BlogPost.in_rss' => 1))
      );

      // Fetch blog posts according to the current mode: category, tag or
      // default
      switch ($this->_filtered()) {
        case 'category':
          $options = Set::merge($options, $this->_category());
          $blogPosts = $this->BlogPost->find('byCategory', $options);
          break;
        case 'tag':
          $options = Set::merge($options, $this->_tag());
          $blogPosts = $this->BlogPost->find('byTag', $options);
          break;
        default:
          $blogPosts = $this->BlogPost->find('all', $options);
          break;
      }

      $this->set(compact('blogPosts'));

      return;

    }

    // Add in the priority order to sticky posts when not rendering RSS
    array_unshift($this->paginate['order'], 'BlogPost.sticky DESC');

    switch ($this->_filtered()) {
      case 'category':
        $this->paginate = Set::merge($this->paginate, array('byCategory'), $this->_category());
        break;
      case 'tag':
        $this->paginate = Set::merge($this->paginate, array('byTag'), $this->_tag());
        break;
      case 'archive':
        $this->paginate['conditions'][]["DATE_FORMAT(BlogPost.created, '%Y%m')"] = $this->params['year'].$this->params['month'];
        break;
    }

    $blogPosts = $this->paginate();

    $this->set(compact('blogPosts'));

    $this->_setArchivesCategoriesAndTags();

  }

  /**
   * Returns the current filter mode, either 'category', 'tag' or 'archive'
   * determined by the params in the URL.
   *
   * @return string
   */
  protected function _filtered() {

    if (!empty($this->params['category'])) {
      return 'category';
    }

    if (!empty($this->params['tag'])) {
      return 'tag';
    }

    if (!empty($this->params['year']) && !empty($this->params['month'])) {
      return 'archive';
    }

    return false;

  }

  /**
   * Finds and sets the selected category in the view. Returns the conditions
   * where the lft value is between the selected category's lft and rght value.
   * Called from index() action for both HTML and RSS views
   *
   * @return array
   */
  protected function _category() {

    $category = $this->BlogPost->BlogPostCategory->find('first', array(
      'conditions' => array(
        'slug' => $this->params['category']
      )
    ));

    if (!$category) {
      throw new NotFoundException(__('Invalid Blog Post Category'));
    }

    $this->set(compact('category'));

    $options['conditions'][]['BlogPostCategory.lft BETWEEN ? AND ?'] = array(
      $category['BlogPostCategory']['lft'],
      $category['BlogPostCategory']['rght'],
    );

    return $options;

  }

  /**
   * Finds and sets the selected tag in the view. Returns the conditions where
   * the blog_post_tag_id in the join model is the id of the selected tag.
   * Called from index() action for both HTML and RSS views
   *
   * @return array
   */
  protected function _tag() {

    $tag = $this->BlogPost->BlogPostTag->find('first', array(
      'conditions' => array(
        'BlogPostTag.slug' => $this->params['tag']
      )
    ));

    if (!$tag) {
      throw new NotFoundException(__('Invalid Blog Post Tag'));
    }

    $this->set(compact('tag'));

    $options['conditions'][]['BlogPostTagsBlogPost.blog_post_tag_id'] = $tag['BlogPostTag']['id'];

    return $options;

  }

  /**
   * View a blog post
   */
  public function view() {

    if (empty($this->params['slug'])) {
      throw new NotFoundException(__('Invalid Blog Post'));
    }

    $blogPost = $this->BlogPost->find('forView', array(
      'conditions' => array(
        'BlogPost.slug' => $this->params['slug'],
      )
    ));

    if (!$blogPost) {
      throw new NotFoundException(__('Invalid Blog Post'));
    }

    $this->set(compact('blogPost'));

    $this->_setArchivesCategoriesAndTags();

  }

  /**
   * Fetch the data for archives, categories and tags and set them as available
   * in the View so they can be rendered on the index and view pages.
   */
  public function _setArchivesCategoriesAndTags() {

    if (!$archives = Cache::read('blog_archives')) {
      $archives = $this->BlogPost->find('archives');
      Cache::write('blog_archives', $archives);
    }

    if (!$tags = Cache::read('blog_tags')) {
      $tags = $this->BlogPost->BlogPostTag->find('cloud');
      Cache::write('blog_tags', $tags);
    }

    if (!$categories = Cache::read('blog_categories')) {
      // getMenuWithUnderCounts() is a method on the HabtmCounterCache Behavior
      // which returns a nest list of categories, in a format that can be 
      // rendered by the BlogHelper::menu method, with the number of posts in
      // each category, or a it's child categories, next to the category name.
      $categories = $this->BlogPost->getMenuWithUnderCounts('BlogPostCategory', array('url' => array('slug' => 'category')));
      Cache::write('blog_categories', $categories);
    }

    // Set the selected keys in the options that are sent to the methods which
    // fetch the archives, categories and tags, to the selected value according
    // to the current mode. This is so when the data is rendered, we can
    // indicate the current selected one, if any.
    switch ($this->_filtered()) {
      case 'category':
        list($categories) = $this->_setSelectedCategory($categories, $this->params['category']);
        break;
      case 'archive':
        // Sets the selected month and parent-selected year keys to true
        if (isset($archives[$this->params['year']]) && isset($archives[$this->params['year']]['children'][$this->params['month']])) {
          $archives[$this->params['year']]['children'][$this->params['month']]['selected'] = true;
          $archives[$this->params['year']]['parent-selected'] = true;
        }
        break;
      default:
        break;
    }

    $this->set(compact('archives', 'categories', 'tags'));

  }

  /**
   * Recursively traverses the passed categories and sets the 'selected' => true
   * and 'parent-selected' => true in the categories array. This has to be done
   * after the list of categories is fetched, and not in the find method, which
   * would have been nicer, so that the categories array can be cached, and we
   * don't have to fetch them for each page view.
   *
   * @param $categories array A nested array of categories returned by the 
   * HabtmCounterCache::getMenuWithUnderCounts() method
   * @param $selected string The slug of the selected category
   * @return array An array with 2 keys, the first containing the modified
   * nested array of categories passed in, and the second with the
   * $parentSelected value set to tru or false for the current node in the
   * nested list. The latter is only used to set the parent-selected key in the
   * internal iterations of the nested list, so does not need to be captured
   * from the external call to this function - it's only used when the fucntion
   * calls itself.
   */
  protected function _setSelectedCategory($categories, $selected) {

    // Initalise this to false, if a category is identified as the selected,
    // category, it is set to true below and then passed back up the levels of
    // recursion so that parent-selected keys can be set.
    $parentSelected = false;

    foreach ($categories as $k => $category) {

      // Set the children and parent-selected keys by calling this method again
      // with the category's children passed into the $categories parameter.
      list ($categories[$k]['children'], $categories[$k]['parent-selected']) = $this->_setSelectedCategory($category['children'], $selected);

      // Check the data against the selected key in the options parameter and
      // set the selected key to true, and the parent selected variable, ready
      // for passing back up the levels of recursion.
      if ($categories[$k]['url']['category'] == $selected) {
        $categories[$k]['selected'] = true;
        $parentSelected = true;
      }

    }

    return array($categories, $parentSelected);

  }

  // The following methods are pretyy much just the baked admin CRUD actions.
  // The only difference is we use generateTreeList() to generate the
  // categories that can be selected in the add/edit blog post actions, so we
  // can visualise the hierarchy of categories.

/**
 * admin index method
 *
 * @return void
 */
	public function admin_index() {
		$this->BlogPost->recursive = 0;
		$this->set('blogPosts', $this->paginate());
	}

/**
 * admin view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->BlogPost->id = $id;
		if (!$this->BlogPost->exists()) {
			throw new NotFoundException(__('Invalid blog post'));
		}
		$this->set('blogPost', $this->BlogPost->read(null, $id));
	}

/**
 * admin add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->BlogPost->create();
			if ($this->BlogPost->save($this->request->data)) {
				$this->Session->setFlash(__('The blog post has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The blog post could not be saved. Please, try again.'));
			}
		}
		$blogPostCategories = $this->BlogPost->BlogPostCategory->generateTreeList();
		$blogPostTags = $this->BlogPost->BlogPostTag->find('list');
		$this->set(compact('blogPostCategories', 'blogPostTags'));
	}

/**
 * admin edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->BlogPost->id = $id;
		if (!$this->BlogPost->exists()) {
			throw new NotFoundException(__('Invalid blog post'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->BlogPost->save($this->request->data)) {
				$this->Session->setFlash(__('The blog post has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The blog post could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->BlogPost->read(null, $id);
		}
		$blogPostCategories = $this->BlogPost->BlogPostCategory->generateTreeList();
		$blogPostTags = $this->BlogPost->BlogPostTag->find('list');
		$this->set(compact('blogPostCategories', 'blogPostTags'));
	}

/**
 * admin delete method
 *
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->BlogPost->id = $id;
		if (!$this->BlogPost->exists()) {
			throw new NotFoundException(__('Invalid blog post'));
		}
		if ($this->BlogPost->delete()) {
			$this->Session->setFlash(__('Blog post deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Blog post was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
