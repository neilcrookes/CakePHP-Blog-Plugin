<?php
/**
 * BlogSetting Model
 *
 * @author Neil Crookes <neil@crook.es>
 * @link http://www.neilcrookes.com http://neil.crook.es
 * @copyright (c) 2011 Neil Crookes
 * @license MIT License - http://www.opensource.org/licenses/mit-license.php
 */
class BlogSetting extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'setting';

  /**
   * The cache key used to cache the settings with
   *
   * @var string
   */
  protected $_cacheKey = 'blog_settings';

  /**
   * Clears cache files after saving
   *
   */
  public function afterSave() {
    Cache::delete($this->_cacheKey);
  }


  /**
   * Returns the an array of setting => value pairs. Handles caching.
   *
   * @return array
   */
  public function getSettings() {
    if ($blogSettings = Cache::read($this->_cacheKey)) {
      return $blogSettings;
    }
    $blogSettings = $this->find('list', array(
      'fields' => array('setting', 'value')
    ));
    Cache::write($this->_cacheKey, $blogSettings);
    return $blogSettings;
  }

}
