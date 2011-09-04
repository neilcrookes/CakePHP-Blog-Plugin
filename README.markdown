CakePHP Blog Plugin
===================

A CakePHP blog plugin for CakePHP2.0+

Features
--------

* Blog posts
** Paginated across all filter types (see below)
** Sticky flag
** In/out RSS feed flag
* Filter by
** Categories (HABTM, hierarchy, only shows categories with posts in, displays number of posts in each category or one of its children)
** Tags (HABTM, including tag cloud)
** Year/month archive (based on created date/time, only shows months with posts in, grouped by year, displays number of posts in each month)
* RSS for all posts, or posts in a particular category or tag
* Settings
** Meta title, description, keywords for the unfiltered list and filtered by archive list

Customisations
--------------

Create custom views in your app directory e.g. app/views/plugins/blog/blog_posts/index.ctp

Requirements
------------

* CakePHP 2.0+ (so PHP5.2+)
* MySQL v4+
* CakePHP HABTM Counter Cache behavior (http://github.com/neilcrookes/CakePHP-HABTM-Counter-Cache-Plugin)

Installation
------------

    git submodule add git://github.com/neilcrookes/CakePHP-Blog-Plugin.git app/Plugin/Blog

or download from http://github.com/neilcrookes/CakePHP-Blog-Plugin

    // APP/Config/Routes.php
    include APP.'Plugin'.DS.'Blog'.DS.'Config'.DS.'routes.php';

Run the SQL script in Blog/Config/chema/schema.sql

Go to mydomain.com/blog

See:

* mydomain.com/admin/blog_posts for creating blog posts (and follow links to create the tags and categories first)
* mydomain.com/admin/blog_settings for editing the settings (things like the index page title and RSS feed title etc)

(Requires your Routing.prefixes is includes 'admin')

Todo
----

* Custom blog post content implementations
* Internationalisation
* Improve the admin interface

All contributions welcome and will be attributed

Copyright
---------

Copyright Neil Crookes 2011

License
-------

The MIT License
