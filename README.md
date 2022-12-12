<p align="right"><a href="README-de.md">Deutsch</a> &nbsp; <a href="README.md">English</a> &nbsp; <a href="README-sv.md">Svenska</a></p>

# Blog 0.8.23

Blog for your website.

<p align="center"><img src="blog-screenshot.png?raw=true" alt="Screenshot"></p>

## How to install an extension

[Download ZIP file](https://github.com/annaesvensson/yellow-blog/archive/main.zip) and copy it into your `system/extensions` folder. [Learn more about extensions](https://github.com/annaesvensson/yellow-update).

## How to use a blog

The blog is available on your website as `http://website/blog/`. To show the blog on the home page, go to your `content` folder and delete the `1-home` folder. To create a new blog page, add a new file to the blog folder. Set `Published` and other [page settings](https://github.com/annaesvensson/yellow-core#settings-page) at the top of a page. The publishing date will be used to sort blog pages. Use `Tag` to group similar pages together. You can use `[--more--]` to add a page break at the desired spot.

## How to show blog information

You can use shortcuts to show information about the blog:

`[blogauthors]` for a list of authors  
`[blogtags]` for a list of tags  
`[blogyears]` for a list of years  
`[blogmonths]` for a list of months  
`[blogrelated]` for a list of pages, related to the current page  
`[blogpages]` for a list of pages, alphabetic order  
`[blogchanges]` for a list of pages, published order  

The following arguments are available, all but the first argument are optional:

`StartLocation` = location of blog start page  
`EntriesMax` = number of entries to show per shortcut, 0 for unlimited  
`FilterTag` = show pages with a specific tag, `[blogpages]` or `[blogchanges]` only  

## Examples

Content file for blog:

    ---
    Title: Blog example
    Published: 2020-04-07
    Author: Datenstrom
    Layout: blog
    Tag: Example
    ---
    This is an example blog page.

    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut 
    labore et dolore magna pizza. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
    nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit 
    esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt 
    in culpa qui officia deserunt mollit anim id est laborum.

Content file for blog, with page break:

    ---
    Title: Fika is good for you
    Published: 2020-06-01
    Author: Datenstrom
    Layout: blog
    Tag: Example, Coffee
    ---
    Fika is a Swedish custom. It's a social coffee break where people 
    gather to have a cup of coffee or tea together. You can have fika with 
    colleagues at work. You can invite your friends to fika. Fika is such 
    an important part of life in Sweden that it is both a verb and a noun. 
    How often do you fika? [--more--]

    [youtube SUpY1BT9Xf4]

Content file with blog information:

    ---
    Title: Overview
    ---
    ## Years

    [blogyears /blog/ 0]

    ## Tags

    [blogtags /blog/ 0]

Showing list of pages, alphabetic order:

    [blogpages /blog/ 0]
    [blogpages /blog/ 3]
    [blogpages /blog/ 10]

Showing list of pages, alphabetic order with a specific tag:

    [blogpages /blog/ 0 coffee]
    [blogpages /blog/ 0 milk]
    [blogpages /blog/ 0 example]

Showing list of pages, published order:

    [blogchanges /blog/ 0]
    [blogchanges /blog/ 3]
    [blogchanges /blog/ 10]

Showing list of pages, published order with a specific tag:

    [blogchanges /blog/ 0 coffee]
    [blogchanges /blog/ 0 milk]
    [blogchanges /blog/ 0 example]

Showing links to blog:

    [See all pages](/blog/)
    [See pages of 2020](/blog/published:2020/)
    [See pages by Datenstrom](/blog/author:datenstrom/)
    [See pages about coffee](/blog/tag:coffee/)
    [See pages with examples](/blog/tag:example/)

Configuring blog start page in the settings, URL with subfolder for each year:

    BlogStartLocation: /blog/
    BlogNewLocation: /blog/@year/@title

## Settings

The following settings can be configured in file `system/extensions/yellow-system.ini`:

`BlogStartLocation` = location of blog start page, `auto` for automatic detection  
`BlogNewLocation` = location for new blog pages, [supported placeholders](#settings-placeholders)  
`BlogEntriesMax` = number of entries to show per shortcut, 0 for unlimited  
`BlogPaginationLimit` = number of entries to show per page, 0 for unlimited  

<a id="settings-placeholders"></a>The following placeholders for new blog pages are supported:

`@title` = page title  
`@author` = page author  
`@tag` = page tag for categorisation  
`@timestamp` = page publication date as timestamp  
`@date` = page publication date, YYYY-MM-DD format  
`@year` = page publication year  
`@month` = page publication month  
`@day` = page publication day  

<a id="settings-files"></a>The following files can be customised:

`content/shared/page-new-blog.md` = content file for new blog page  
`system/layouts/blog.html` = layout file for individual blog page  
`system/layouts/blog-start.html` = layout file for blog start page  

## Developer

Anna Svensson. [Get help](https://datenstrom.se/yellow/help/).
