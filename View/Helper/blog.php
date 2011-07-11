<?php
/**
 * Blog Helper
 *
 * @author Neil Crookes <neil@crook.es>
 * @link http://www.neilcrookes.com http://neil.crook.es
 * @copyright (c) 2011 Neil Crookes
 * @license MIT License - http://www.opensource.org/licenses/mit-license.php
 */
class BlogHelper extends AppHelper {

  public $helpers = array('Html');

  /**
   * Returns a nested unordered list of links like a menu.
   *
   * @param array $items A nested list of items (see return values for
   * BlogPost::find('archives') for an example format)
   * @param array $options Keys can include:
   *     menu_id string Id attribute of top level <ul>
   *     item_id boolean Ensures each <li> has the item's id key set to it's id
   *                     attribute (also see item_id_prefix)
   *     item_id_prefix string Prefix to all <li> id attributes (see item_id)
   *     url array Gets merged with the value of the item 'url' key
   * @return string
   */
  public function nav($items, $options = null) {

    $itemCount = count($items);

    if (!$itemCount) {
      return;
    }

    $out = '<ul';
    if (!empty($options['menu_id'])){
      $out .= ' id="'.$options['menu_id'].'"';
      unset($options['menu_id']);
    }
    $out .= '>';

    $itemCounter = 1;

    foreach ($items as $item) {
      $liClasses = $aClasses = array();
      if (!empty($item['selected'])) {
        $aClasses[] = $liClasses[] = 'selected';
      }
      if (!empty($item['parent-selected'])) {
        $aClasses[] = $liClasses[] = 'parent-selected';
      }
      if ($itemCounter == 1) {
        $liClasses[] = 'first-child';
      }
      if ($itemCounter == $itemCount) {
        $liClasses[] = 'last-child';
      }
      $out .= '<li';
      if (!empty($liClasses)) {
        $out .= ' class="'.implode(' ', $liClasses).'"';
      }
      if (!empty($options['item_id'])) {
        $out .= ' id="';
        if (isset($options['item_id_prefix'])) {
          $out .= $options['item_id_prefix'];
        }
        $out .= $item['id'];
        $out .= '"';
      }
      $out .= '>';
      if (!empty($item['url'])) {
        if (!empty($options['url'])) {
          $item['url'] = array_merge($options['url'], $item['url']);
        }
        $aOptions = array();
        if (!empty($aClasses)) {
          $aOptions = array('class' => implode(' ', $aClasses));
        }
        $out .= $this->Html->link($item['text'], $item['url'], $aOptions, null, false);
      } else {
        $out .= $item['text'];
      }
      if (!empty($item['children'])) {
        $out .= $this->nav($item['children'], $options);
      }
      $out .= '</li>';
      $itemCounter++;
    }

    $out .= "</ul>";

    return $out;
  }

  /**
   * Returns the RSS link for all blog posts.
   *
   * @param string $text
   * @param array $url
   * @param array $options
   * @return string
   */
  public function rss($text = 'RSS', $url = array(), $options = array()) {
    $options = array_merge(array(
      'type' => 'application/rss+xml',
      'class' => 'rss',
      'escape' => false
    ), $options);
    return $this->Html->link(__($text, true), $this->rssUrl($url), $options);
  }

  /**
   * Returns the URL for the Blog RSS feed
   *
   * @param array URL style array
   * @return array
   */
  public function rssUrl($url = array()) {
    return array_merge(array(
      'plugin' => 'blog',
      'controller' => 'blog_posts',
      'action' => 'index',
      'ext' => 'rss',
    ), $url);
  }

  /**
   * Returns the RSS Channel Title for the default, category or tag
   *
   * @return string
   */
  public function rssChannelTitle() {
    switch ($this->filtered()) {
      case 'category':
        $rssChannelTitle = $this->_View->viewVars['category']['BlogPostCategory']['rss_channel_title'];
        break;
      case 'tag':
        $rssChannelTitle = $this->_View->viewVars['tag']['BlogPostTag']['rss_channel_title'];
        break;
      default:
        $rssChannelTitle = $this->_View->viewVars['blogSettings']['rss_channel_title'];
        break;
    }
    return htmlspecialchars($rssChannelTitle, ENT_NOQUOTES, 'UTF-8');
  }

   /**
   * Returns the RSS Channel Description for the default, category or tag
   *
   * @return string
   */
  public function rssChannelDescription() {
    switch ($this->filtered()) {
      case 'category':
        $rssChannelDescription = $this->_View->viewVars['category']['BlogPostCategory']['rss_channel_description'];
        break;
      case 'tag':
        $rssChannelDescription = $this->_View->viewVars['tag']['BlogPostTag']['rss_channel_description'];
        break;
      default:
        $rssChannelDescription = $this->_View->viewVars['blogSettings']['rss_channel_description'];
        break;
    }
    return htmlspecialchars($rssChannelDescription, ENT_NOQUOTES, 'UTF-8');
  }

  /**
   * Returns the RSS Channel Link for the default, category or tag
   *
   * @return string
   */
  public function rssChannelLink() {
    if (($filteredBy = $this->filtered()) != false) {
      return $this->rssUrl(array($filteredBy => $this->params[$filteredBy]));
    }
    return $this->rssUrl();
  }

  /**
   * Returns the <link> tag for the default RSS channel or filtered channel
   *
   * @return string
   */
  public function rssLinkTag() {
    return '<link rel="alternate" type="application/rss+xml" href="' . $this->url($this->rssChannelLink()) . '" title="' . $this->rssChannelTitle() . '">';
  }

  /**
   * Returns the RSS link for all blog posts for the selected category or the
   * selected tag.
   *
   * @param string $text
   * @param array $url
   * @param array $options
   * @return string
   */
  public function rssFiltered($filteredBy, $text = 'RSS', $url = array(), $options = array()) {
    switch ($filteredBy) {
      case 'category':
        $url['category'] = $this->params['category'];
        break;
      case 'tag':
        $url['tag'] = $this->params['tag'];
        break;
    }
    return $this->rss($text, $url, $options);
  }

  /**
   * Returns a human readable sentence that describes how the blog posts have
   * been filtered.
   *
   * @return string
   */
  public function filterDescription() {
    switch ($this->filtered()) {
      case 'category':
        return ' in category: ' . $this->_View->viewVars['category']['BlogPostCategory']['name'];
      case 'tag':
        return ' tagged with: ' . $this->_View->viewVars['tag']['BlogPostTag']['name'];
      case 'archive':
        return ' created in ' . __(date('F', mktime(0, 0, 0, (int)$this->params['month'])), true) . ' ' . $this->params['year'];
      default:
        return false;
    }
  }

  /**
   * Returns an array that can be passed to CakePHP's core Paginator::options()
   * method to ensure the filter parameters are persisted after clicking on a
   * paging link.
   *
   * @return array
   */
  public function getPaginatorOptions() {
    switch ($this->filtered()) {
      case 'category':
        return array('category' => $this->params['category']);
      case 'tag':
        return array('tag' => $this->params['tag']);
      case 'archive':
        return array(
          'year' => $this->params['year'],
          'month' => $this->params['month']
        );
      default:
        return array();
    }
  }

  /**
   * If the current request is for a filtered list of blog posts, return the
   * type of filter, e.g. 'category', 'tag' or 'archive', or false if not
   * currently being filtered.
   *
   * @return string
   */
  public function filtered() {
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
   * Returns a tag cloud for the given tags.
   *
   * @param array $tags An array of tags
   * @param array $options An array of options
   * @return string
   */
  public function tagCloud($tags, $options = array()) {
    $defaults = array(
      'cloud_id' => 'blog-post-tag-cloud',
      'url' => array(
        'plugin' => 'blog',
        'controller' => 'blog_posts',
        'action' => 'index',
      ),
      'min' => 10,
      'max' => 20,
      'precision' => 0,
      'text_format' => '<span>{{text}}</span>',
      'link_class_format' => '',
      'li_class_format' => 'tag-{{weight}}',
    );
    $options = Set::merge($defaults, $options);
    $out = '<ul';
    if ($options['cloud_id']) {
      $out .= ' id="'.$options['cloud_id'].'"';
    }
    $out .= '>';
    foreach ($tags as $tag) {
      $url = array_merge($options['url'], $tag['url']);
      $weight = round($options['min'] + $tag['weight'] * ($options['max'] - $options['min']), $options['precision']);
      $search = array(
        '{{text}}',
        '{{weight}}'
      );
      $replace = array(
        $tag['text'],
        $weight,
      );
      $text = str_replace($search, $replace, $options['text_format']);
      $linkClass = str_replace($search, $replace, $options['link_class_format']);
      $liClass = str_replace($search, $replace, $options['li_class_format']);
      $out .= '<li';
      if (!empty($liClass)) {
        $out .= ' class="'.$liClass.'"';
      }
      $linkOptions = array('escape' => false);
      if (!empty($linkClass)) {
        $linkOptions['class'] = $linkClass;
      }
      $out .= '>' . $this->Html->link($text, $url, $linkOptions) . '</li>';
    }

    return $out;

  }

  /**
   * Returns a permalink for the given $blogPost according to the routes
   */
  public function permalink($blogPost) {
    return Router::url(array(
      'plugin' => 'blog',
      'controller' => 'blog_posts',
      'action' => 'view',
      'slug' => $blogPost['BlogPost']['slug'],
    ), true);
  }

}
