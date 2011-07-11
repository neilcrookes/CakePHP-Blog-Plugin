CREATE TABLE `blog_post_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rght` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text,
  `meta_keywords` text,
  `rss_channel_title` varchar(255) DEFAULT NULL,
  `rss_channel_description` text,
  `blog_post_count` int(11) NOT NULL DEFAULT '0',
  `under_blog_post_count` int(11) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `blog_post_categories_blog_posts` (
  `blog_post_category_id` int(11) NOT NULL,
  `blog_post_id` int(11) NOT NULL,
  PRIMARY KEY (`blog_post_category_id`,`blog_post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `blog_post_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text,
  `meta_keywords` text,
  `rss_channel_title` varchar(255) DEFAULT NULL,
  `rss_channel_description` text,
  `blog_post_count` int(11) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `blog_post_tags_blog_posts` (
  `blog_post_tag_id` int(11) NOT NULL,
  `blog_post_id` int(11) NOT NULL,
  PRIMARY KEY (`blog_post_tag_id`,`blog_post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `blog_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `summary` text,
  `body` longtext,
  `published` tinyint(1) NOT NULL,
  `sticky` tinyint(1) NOT NULL DEFAULT '0',
  `in_rss` tinyint(1) NOT NULL DEFAULT '1',
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `blog_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting` varchar(255) NOT NULL,
  `setting_text` varchar(255) NOT NULL,
  `tip` varchar(255) DEFAULT NULL,
  `value` text,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `setting_text_UNIQUE` (`setting_text`),
  UNIQUE KEY `setting_UNIQUE` (`setting`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `blog_settings` VALUES (1,'meta_title','Meta Title',NULL,'My New Blog',NULL),(2,'meta_description','Meta Description',NULL,'','NULL'),(3,'meta_keywords','Meta Keywords',NULL,'',NULL),(4,'rss_channel_title','RSS Channel Title',NULL,'My New Blog',NULL),(5,'rss_channel_description','RSS Channel Description',NULL,'',NULL),(6,'show_summary_on_post_view','Show post summary on post detail page?','\'Yes\' or \'No\'','No',NULL),(7,'show_categories_on_post_view','Show post categories on post detail page?','\'Yes\' or \'No\'','No',NULL),(8,'show_tags_on_post_view','Show post tags on post detail page?','\'Yes\' or \'No\'','Yes',NULL),(9,'use_summary_or_body_on_post_index','Use the summary or the post body on the post index page?','\'Summary\' or \'Body\'','Summary',NULL),(10,'use_summary_or_body_in_rss_feed','Use the summary or the post body in the RSS feed?','\'Summary\' or \'Body\'','Body',NULL),('11', 'published_format_on_post_index', 'Published date/time format on post index page', 'e.g. \'d M Y\' see php.net/date', '<\\s\\p\\a\\n \\c\\l\\a\\s\\s="\\d\\a\\y">d</\\s\\p\\a\\n> <\\s\\p\\a\\n \\c\\l\\a\\s\\s="\\m\\o\\n\\t\\h">M</\\s\\p\\a\\n> <\\s\\p\a\\n \\c\\l\\a\\s\\s="\\y\\e\\a\\r">y</\\s\\p\\a\\n>', NULL),('12', 'published_format_on_post_view', 'Published date/time format on post view page', 'e.g. \'d M Y\' see php.net/date', '<\\s\\p\\a\\n \\c\\l\\a\\s\\s="\\d\\a\\y">d</\\s\\p\\a\\n> <\\s\\p\\a\\n \\c\\l\\a\\s\\s="\\m\\o\\n\\t\\h">M</\\s\\p\\a\\n> <\\s\\p\\a\\n \\c\\l\\a\\s\\s="\\y\\e\\a\\r">y</\\s\\p\\a\\n>', NULL),('13', 'og:site_name', 'Open Graph: Site Name', NULL, 'My New Blog', NULL),('14', 'fb_admins', 'Facebook Admins', NULL, NULL, NULL),(15, 'use_disqus', 'Use Disqus', '\'Yes\' or \'No\'','No', NULL),(16, 'disqus_shortname', 'Disqus Shortname', NULL, NULL, NULL),(17, 'disqus_developer', 'Disqus Developer Mode', '\'Yes\' or \'No\'', 'Yes', NULL);
