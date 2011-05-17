<?php
/**
 * BlogPostTag Model
 *
 * @author Neil Crookes <neil@crook.es>
 * @link http://www.neilcrookes.com http://neil.crook.es
 * @copyright (c) 2011 Neil Crookes
 * @license MIT License - http://www.opensource.org/licenses/mit-license.php
 */
class BlogPostTag extends AppModel {
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Please enter a name',
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
	);

  public $findMethods = array(
    'cloud' => true,
  );

  /**
   * Returns an array of tags that have blog posts assigned to them, along with
   * a weight score which is determined by the relative blog post count of the
   * tag compared to the tags with the least counts and the tags with the most
   * counts.
   * 
   * @param string $state
   * @param array $query
   * @param array $results
   * @return array
   */
  protected function _findCloud($state, $query = array(), $results = array()) {
    
    if ($state == 'before') {

      $query['fields'] = array(
        'BlogPostTag.id',
        'BlogPostTag.name',
        'BlogPostTag.slug',
        'BlogPostTag.blog_post_count',
      );
      
      // We only want tags that have some posts assigned to them
      $query['conditions'][]['BlogPostTag.blog_post_count >'] = 0;

      $query['order'] = 'RAND()';
      
      return $query;

    } else {

      // Extract all the post counts, sort them and take the first and the last
      // so we can work out the weight for the current tag.
      $blogPostCounts = Set::extract('/BlogPostTag/blog_post_count', $results);
      sort($blogPostCounts);
      $minBlogPostCount = current($blogPostCounts);
      $maxBlogPostCount = end($blogPostCounts);
      
      foreach ($results as $k => $result) {
        $results[$k] = array(
          'text' => $result['BlogPostTag']['name'],
          'id' => $result['BlogPostTag']['id'],
          'url' => array(
            'tag' => $result['BlogPostTag']['slug'],
          ),
          'weight' => round(($result['BlogPostTag']['blog_post_count'] - $minBlogPostCount) / $maxBlogPostCount, 2),
        );
      }

      return $results;

    }
    
  }

}
