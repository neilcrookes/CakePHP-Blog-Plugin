=CakePHP Blog Plugin=

A CakePHP blog plugin for CakePHP2.0+

==Features==

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

==Customisations==

Create custom views in your app directory e.g. app/views/plugins/blog/blog_posts/index.ctp

==Requirements==

* CakePHP 2.0+ (so PHP5.2+)
* MySQL v4+
* CakePHP HABTM Counter Cache behavior (http://github.com/neilcrookes/CakePHP-HABTM-Counter-Cache-Plugin)

==Todo==

* Custom blog post content implementations
* Internationalisation

==Copyright==

Copyright Neil Crookes 2011

==License==
The MIT License
