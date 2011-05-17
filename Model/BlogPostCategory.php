<?php
/**
 * BlogPostCategory Model
 *
 * @author Neil Crookes <neil@crook.es>
 * @link http://www.neilcrookes.com http://neil.crook.es
 * @copyright (c) 2011 Neil Crookes
 * @license MIT License - http://www.opensource.org/licenses/mit-license.php
 */
class BlogPostCategory extends AppModel {

  public $actsAs = array(
    'Tree',
  );

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'parent_id' => array(
			'numeric' => array(
				'rule' => 'numeric',
				'message' => 'The parent value must be numeric',
				'required' => false,
				'allowEmpty' => true,
				'on' => null,
				'last' => true,
			),
		),
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

}
