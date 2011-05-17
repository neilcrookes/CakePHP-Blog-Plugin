<?php
/**
 * BlogPost Model
 *
 * @author Neil Crookes <neil@crook.es>
 * @link http://www.neilcrookes.com http://neil.crook.es
 * @copyright (c) 2011 Neil Crookes
 * @license MIT License - http://www.opensource.org/licenses/mit-license.php
 */
class BlogPost extends AppModel {

  public $actsAs = array(
    'HabtmCounterCache.HabtmCounterCache' => array(
      'counterScope' => array(
        'BlogPost.published' => 1
      ),
    ),
  );

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'title' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Please enter a title',
				'required' => false,
				'allowEmpty' => false,
				'on' => null,
				'last' => true,
			),
		),
		'slug' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Please enter a slug',
				'required' => false,
				'allowEmpty' => false,
				'on' => null,
				'last' => true,
			),
			'regex0' => array(
				'rule' => '/^[a-z0-9\_\-]*$/i',
				'message' => 'Please enter a valid slug',
				'required' => false,
				'allowEmpty' => false,
				'on' => null,
				'last' => true,
			),
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'This slug is already in use',
			),
		),
		'published' => array(
			'boolean' => array(
				'rule' => 'boolean',
				'message' => 'Please enter a valid value',
				'required' => false,
				'allowEmpty' => false,
				'on' => null,
				'last' => true,
			),
		),
		'sticky' => array(
			'boolean' => array(
				'rule' => 'boolean',
				'message' => 'Please enter a valid value',
				'required' => false,
				'allowEmpty' => false,
				'on' => null,
				'last' => true,
			),
		),
		'in_rss' => array(
			'boolean' => array(
				'rule' => 'boolean',
				'message' => 'Please enter a valid value',
				'required' => false,
				'allowEmpty' => false,
				'on' => null,
				'last' => true,
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'BlogPostCategory' => array(
			'className' => 'Blog.BlogPostCategory',
			'joinTable' => 'blog_post_categories_blog_posts',
			'foreignKey' => 'blog_post_id',
			'associationForeignKey' => 'blog_post_category_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'BlogPostTag' => array(
			'className' => 'Blog.BlogPostTag',
			'joinTable' => 'blog_post_tags_blog_posts',
			'foreignKey' => 'blog_post_id',
			'associationForeignKey' => 'blog_post_tag_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

  public function afterSave() {
    Cache::delete('blog_archives');
    Cache::delete('blog_categories');
    Cache::delete('blog_tags');
  }

  public function afterDelete() {
    Cache::delete('blog_archives');
    Cache::delete('blog_categories');
    Cache::delete('blog_tags');
  }


  /**
   * Custom find methods this model uses.
   *
   * @var array
   */
  public $findMethods = array(
    'archives' => true,
    'byCategory' => true,
    'byTag' => true,
    'forView' => true,
  );

  /**
   * Custom paginateCount method behaves as usual for normal find types but has
   * to do something special for the findByCategory custom find type.
   *
   * @param integer $conditions
   * @param integer $recursive
   * @param array $extra
   * @return integer
   */
  public function paginateCount($conditions = null, $recursive = 0, $extra = array()) {
    $options = array(
      'conditions' => $conditions,
      'recursive' => $recursive,
    );
    // Call the custom find type but add the field param for COUNT(DISTINCT)
    if (!empty($extra['type']) && in_array($extra['type'], array('byCategory', 'byTag'))) {
      $count = 'COUNT(DISTINCT BlogPost.id)';
      $options['fields'] = $count;
      $result = $this->find($extra['type'], $options);
      return $result[0][0][$count];
    }
    return $this->find('count', $options);
  }

  /**
   * Returns an array with each item being another array with keys for text, id
   * url, selected-parent, selected and children, which may contain the same
   * again. Essentially it's a datastructure that represents a hierarchical menu
   * with items being the year or month in a year, followed by the count in of
   * posts created in that year/month in brackets. E.g.
   *
   *     array(
   *       array(
   *         'text' => '2010 (10)',
   *         'id' => 2010,
   *         'selected-parent' => true,
   *         'children' => array(
   *           array(
   *             'text' => 'December (5)',
   *             'id' => 201012,
   *             'url' => array('year' => '2010', 'month' => '12'),
   *             'selected' => true,
   *             'children' => array()))))
   *
   * @param array $state
   * @param array $query
   * @param array $results
   * @return array
   */
  protected function _findArchives($state, $query = array(), $results = array()) {

    if ($state == 'before') {

      $query['conditions'][]['BlogPost.published'] = 1;

      $query['fields'] = array(
        'YEAR(BlogPost.created) AS `year`',
        "DATE_FORMAT(BlogPost.created, '%m') AS `month`",
        'MONTHNAME(BlogPost.created) AS `monthname`',
        'COUNT(*) AS `count`'
      );

      $query['group'] = array("DATE_FORMAT(BlogPost.created, '%Y%m')");

      $query['order'] = 'BlogPost.created DESC';

      return $query;

    } else {

      $return = array();

      foreach ($results as $result) {

        // If this is the first result of the given year, add it as a text node
        if (!isset($return[$result[0]['year']])) {
          $return[$result[0]['year']] = array(
            'text' => $result[0]['year'],
            'id' => $result[0]['year'],
          );
        }

        // Add in the current month result to the the current year's result's
        // children key, setting the text to "monthname (count)"
        $return[$result[0]['year']]['children'][$result[0]['month']] = array(
          'text' => $result[0]['monthname'] . ' (' . $result[0]['count'] . ')',
          'id' => $result[0]['year'] . $result[0]['month'],
          'url' => array(
            'year' => $result[0]['year'],
            'month' => $result[0]['month'],
          ),
        );

      }

      // Sets the selected month and parent-selected year keys to true
      if (isset($query['selected']['year']) && isset($query['selected']['month'])
      && isset($return[$query['selected']['year']]) && isset($return[$query['selected']['year']]['children'][$query['selected']['month']])) {
        $return[$query['selected']['year']]['children'][$query['selected']['month']]['selected'] = true;
        $return[$query['selected']['year']]['parent-selected'] = true;
      }

      return $return;

    }

  }

  /**
   * Custom find type for finding all posts assigned to a category or any of its
   * children.
   *
   * @param array $state
   * @param array $query
   * @param array $results
   * @return array
   */
  protected function _findByCategory($state, $query = array(), $results = array()) {

    if ($state == 'before') {

      $query['conditions'][]['BlogPost.published'] = 1;

      $query['joins'] = array(
        array(
          'type' => 'INNER',
          'table' => 'blog_post_categories_blog_posts',
          'alias' => 'BlogPostCategoriesBlogPost',
          'conditions' => array(
            'BlogPost.id = BlogPostCategoriesBlogPost.blog_post_id'
          ),
        ),
        array(
          'type' => 'INNER',
          'table' => 'blog_post_categories',
          'alias' => 'BlogPostCategory',
          'conditions' => array(
            'BlogPostCategoriesBlogPost.blog_post_category_id = BlogPostCategory.id'
          ),
        ),
      );

      if (!isset($query['fields']) || $query['fields'] != 'COUNT(DISTINCT BlogPost.id)') {
        $query['group'] = 'BlogPost.id';
      }

      if (!isset($query['order'])) {
        $query['order'] = array(
          'BlogPost.sticky DESC',
          'BlogPost.created DESC'
        );
      }

      if (!isset($query['limit'])) {
        $query['limit'] = 10;
      }

      if (!isset($query['recursive'])) {
        $query['recursive'] = 0;
      }

      return $query;

    } else {

      return $results;

    }

  }

  /**
   * Custom find type for finding all posts assigned to a tag.
   *
   * @param array $state
   * @param array $query
   * @param array $results
   * @return array
   */
  protected function _findByTag($state, $query = array(), $results = array()) {

    if ($state == 'before') {

      $query['conditions'][]['BlogPost.published'] = 1;

      $query['joins'] = array(
        array(
          'type' => 'INNER',
          'table' => 'blog_post_tags_blog_posts',
          'alias' => 'BlogPostTagsBlogPost',
          'conditions' => array(
            'BlogPost.id = BlogPostTagsBlogPost.blog_post_id'
          ),
        ),
        array(
          'type' => 'INNER',
          'table' => 'blog_post_tags',
          'alias' => 'BlogPostTag',
          'conditions' => array(
            'BlogPostTagsBlogPost.blog_post_tag_id = BlogPostTag.id'
          ),
        ),
      );

      if (!isset($query['fields']) || $query['fields'] != 'COUNT(DISTINCT BlogPost.id)') {
        $query['group'] = 'BlogPost.id';
      }

      if (!isset($query['order'])) {
        $query['order'] = array(
          'BlogPost.sticky DESC',
          'BlogPost.created DESC'
        );
      }

      if (!isset($query['limit'])) {
        $query['limit'] = 10;
      }

      if (!isset($query['recursive'])) {
        $query['recursive'] = 0;
      }

      return $query;

    } else {

      return $results;

    }

  }

  /**
   * Custom find type for the post view page.
   *
   * @param array $state
   * @param array $query
   * @param array $results
   * @return array
   */
  protected function _findForView($state, $query = array(), $results = array()) {

    if ($state == 'before') {

      $query['conditions'][]['BlogPost.published'] = 1;

      $query['contain'] = array(
        'BlogPostCategory' => array('order' => 'lft ASC'),
        'BlogPostTag' => array('order' => 'name'),
      );

      return $query;

    } else {

      $result = $results[0];

      foreach ($result['BlogPostCategory'] as $k => $blogPostCategory) {
        $result['BlogPostCategory'][$k] = array(
          'id' => $blogPostCategory['id'],
          'text' => $blogPostCategory['name'],
          'url' => array('category' => $blogPostCategory['slug']),
        );
      }

      foreach ($result['BlogPostTag'] as $k => $blogPostTag) {
        $result['BlogPostTag'][$k] = array(
          'id' => $blogPostTag['id'],
          'text' => $blogPostTag['name'],
          'url' => array('tag' => $blogPostTag['slug']),
        );
      }

      return $result;

    }

  }

}
