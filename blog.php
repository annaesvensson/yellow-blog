<?php
// Blog extension, https://github.com/annaesvensson/yellow-blog

class YellowBlog {
    const VERSION = "0.8.30";
    public $yellow;         // access to API
    
    // Handle initialisation
    public function onLoad($yellow) {
        $this->yellow = $yellow;
        $this->yellow->system->setDefault("blogStartLocation", "auto");
        $this->yellow->system->setDefault("blogNewLocation", "@title");
        $this->yellow->system->setDefault("blogShortcutEntries", "0");
        $this->yellow->system->setDefault("blogPaginationLimit", "5");
    }
    
    // Handle page content of shortcut
    public function onParseContentShortcut($page, $name, $text, $type) {
        $output = null;
        if (substru($name, 0, 4)=="blog" && ($type=="block" || $type=="inline")) {
            switch($name) {
                case "blogauthors": $output = $this->getShortcutBlogauthors($page, $name, $text); break;
                case "blogtags":    $output = $this->getShortcutBlogtags($page, $name, $text); break;
                case "blogyears":   $output = $this->getShortcutBlogyears($page, $name, $text); break;
                case "blogmonths":  $output = $this->getShortcutBlogmonths($page, $name, $text); break;
                case "blogpages":   $output = $this->getShortcutBlogpages($page, $name, $text); break;
            }
        }
        return $output;
    }
        
    // Return blogauthors shortcut
    public function getShortcutBlogauthors($page, $name, $text) {
        $output = null;
        list($startLocation, $shortcutEntries) = $this->yellow->toolbox->getTextArguments($text);
        if (is_string_empty($startLocation)) $startLocation = $this->yellow->system->get("blogStartLocation");
        if (is_string_empty($shortcutEntries)) $shortcutEntries = $this->yellow->system->get("blogShortcutEntries");
        $blogStart = $this->getBlogStart($page, $startLocation);
        if (!is_null($blogStart)) {
            $pages = $this->getBlogPages($blogStart);
            $page->setLastModified($pages->getModified());
            $authors = $pages->group("author", false, "count");
            if ($shortcutEntries!=0) $authors = array_slice($authors, 0, $shortcutEntries, true);
            uksort($authors, "strnatcasecmp");
            $output = "<div class=\"".htmlspecialchars($name)."\">\n";
            $output .= "<ul>\n";
            foreach ($authors as $author=>$collection) {
                $output .= "<li><a href=\"".$blogStart->getLocation(true).$this->yellow->lookup->normaliseArguments("author:$author")."\">";
                $output .= htmlspecialchars($author)."</a></li>\n";
            }
            $output .= "</ul>\n";
            $output .= "</div>\n";
        } else {
            $page->error(500, "Blogauthors '$startLocation' does not exist!");
        }
        return $output;
    }
    
    // Return blogtags shortcut
    public function getShortcutBlogtags($page, $name, $text) {
        $output = null;
        list($startLocation, $shortcutEntries) = $this->yellow->toolbox->getTextArguments($text);
        if (is_string_empty($startLocation)) $startLocation = $this->yellow->system->get("blogStartLocation");
        if (is_string_empty($shortcutEntries)) $shortcutEntries = $this->yellow->system->get("blogShortcutEntries");
        $blogStart = $this->getBlogStart($page, $startLocation);
        if (!is_null($blogStart)) {
            $pages = $this->getBlogPages($blogStart);
            $page->setLastModified($pages->getModified());
            $tags = $pages->group("tag", false, "count");
            if ($shortcutEntries!=0) $tags = array_slice($tags, 0, $shortcutEntries, true);
            uksort($tags, "strnatcasecmp");
            $output = "<div class=\"".htmlspecialchars($name)."\">\n";
            $output .= "<ul>\n";
            foreach ($tags as $tag=>$collection) {
                $output .= "<li><a href=\"".$blogStart->getLocation(true).$this->yellow->lookup->normaliseArguments("tag:$tag")."\">";
                $output .= htmlspecialchars($tag)."</a></li>\n";
            }
            $output .= "</ul>\n";
            $output .= "</div>\n";
        } else {
            $page->error(500, "Blogtags '$startLocation' does not exist!");
        }
        return $output;
    }

    // Return blogyears shortcut
    public function getShortcutBlogyears($page, $name, $text) {
        $output = null;
        list($startLocation, $shortcutEntries) = $this->yellow->toolbox->getTextArguments($text);
        if (is_string_empty($startLocation)) $startLocation = $this->yellow->system->get("blogStartLocation");
        if (is_string_empty($shortcutEntries)) $shortcutEntries = $this->yellow->system->get("blogShortcutEntries");
        $blogStart = $this->getBlogStart($page, $startLocation);
        if (!is_null($blogStart)) {
            $pages = $this->getBlogPages($blogStart);
            $page->setLastModified($pages->getModified());
            $years = $pages->group("published", false, "Y");
            if ($shortcutEntries!=0) $years = array_slice($years, 0, $shortcutEntries, true);
            $output = "<div class=\"".htmlspecialchars($name)."\">\n";
            $output .= "<ul>\n";
            foreach ($years as $year=>$collection) {
                $output .= "<li><a href=\"".$blogStart->getLocation(true).$this->yellow->lookup->normaliseArguments("published:$year")."\">";
                $output .= htmlspecialchars($this->yellow->language->getDateStandard($year))."</a></li>\n";
            }
            $output .= "</ul>\n";
            $output .= "</div>\n";
        } else {
            $page->error(500, "Blogyears '$startLocation' does not exist!");
        }
        return $output;
    }
    
    // Return blogmonths shortcut
    public function getShortcutBlogmonths($page, $name, $text) {
        $output = null;
        list($startLocation, $shortcutEntries) = $this->yellow->toolbox->getTextArguments($text);
        if (is_string_empty($startLocation)) $startLocation = $this->yellow->system->get("blogStartLocation");
        if (is_string_empty($shortcutEntries)) $shortcutEntries = $this->yellow->system->get("blogShortcutEntries");
        $blogStart = $this->getBlogStart($page, $startLocation);
        if (!is_null($blogStart)) {
            $pages = $this->getBlogPages($blogStart);
            $page->setLastModified($pages->getModified());
            $months = $pages->group("published", false, "Y-m");
            if ($shortcutEntries!=0) $months = array_slice($months, 0, $shortcutEntries, true);
            $output = "<div class=\"".htmlspecialchars($name)."\">\n";
            $output .= "<ul>\n";
            foreach ($months as $month=>$collection) {
                $output .= "<li><a href=\"".$blogStart->getLocation(true).$this->yellow->lookup->normaliseArguments("published:$month")."\">";
                $output .= htmlspecialchars($this->yellow->language->getDateStandard($month))."</a></li>\n";
            }
            $output .= "</ul>\n";
            $output .= "</div>\n";
        } else {
            $page->error(500, "Blogmonths '$startLocation' does not exist!");
        }
        return $output;
    }
    
    // Return blogpages shortcut
    public function getShortcutBlogpages($page, $name, $text) {
        $output = null;
        list($startLocation, $shortcutEntries, $filterTag) = $this->yellow->toolbox->getTextArguments($text);
        if (is_string_empty($startLocation)) $startLocation = $this->yellow->system->get("blogStartLocation");
        if (is_string_empty($shortcutEntries)) $shortcutEntries = $this->yellow->system->get("blogShortcutEntries");
        $blogStart = $this->getBlogStart($page, $startLocation);
        if (!is_null($blogStart)) {
            $pages = $this->getBlogPages($blogStart)->remove($page);
            $page->setLastModified($pages->getModified());
            if (!is_string_empty($filterTag)) $pages->filter("tag", $filterTag);
            $pages->sort("published", false);
            if ($shortcutEntries!=0) $pages->limit($shortcutEntries);
            $output = "<div class=\"".htmlspecialchars($name)."\">\n";
            $output .= "<ul>\n";
            foreach ($pages as $pageBlog) {
                $output .= "<li><a".($pageBlog->isExisting("tag") ? " class=\"".$this->getClass($pageBlog)."\"" : "");
                $output .=" href=\"".$pageBlog->getLocation(true)."\">".$pageBlog->getHtml("title")."</a></li>\n";
            }
            $output .= "</ul>\n";
            $output .= "</div>\n";
        } else {
            $page->error(500, "Blogpages '$startLocation' does not exist!");
        }
        return $output;
    }
    
    // Handle page layout
    public function onParsePageLayout($page, $name) {
        if ($name=="blog-start") {
            $pages = $this->getBlogPages($page);
            $pagesFilter = array();
            if ($page->isRequest("tag")) {
                $pages->filter("tag", $page->getRequest("tag"));
                array_push($pagesFilter, $pages->getFilter());
            }
            if ($page->isRequest("author")) {
                $pages->filter("author", $page->getRequest("author"));
                array_push($pagesFilter, $pages->getFilter());
            }
            if ($page->isRequest("published")) {
                $pages->filter("published", $page->getRequest("published"), false);
                array_push($pagesFilter, $this->yellow->language->getDateStandard($pages->getFilter()));
            }
            $pages->sort("published", false);
            if (!is_array_empty($pagesFilter)) {
                $text = implode(" ", $pagesFilter);
                $page->set("titleHeader", $text." - ".$page->get("sitename"));
                $page->set("titleContent", $page->get("title").": ".$text);
                $page->set("title", $page->get("title").": ".$text);
                $page->set("blogWithFilter", true);
            }
            $page->setPages("blog", $pages);
            $page->setLastModified($pages->getModified());
            $page->setHeader("Cache-Control", "max-age=60");
        }
        if ($name=="blog") {
            $blogStartLocation = $this->yellow->system->get("blogStartLocation");
            if ($blogStartLocation=="auto") {
                $blogStart = $page->getParent();
            } else {
                $blogStart = $this->yellow->content->find($blogStartLocation);
            }
            $page->setPage("blogStart", $blogStart);
        }
    }
    
    // Handle content file editing
    public function onEditContentFile($page, $action, $email) {
        if ($page->get("layout")=="blog") $page->set("editNewLocation", $this->yellow->system->get("blogNewLocation"));
    }
    
    // Return blog start page, null if not found
    public function getBlogStart($page, $blogStartLocation) {
        if ($blogStartLocation=="auto") {
            $blogStart = null;
            foreach ($this->yellow->content->top(true, false) as $pageTop) {
                if ($pageTop->get("layout")=="blog-start") {
                    $blogStart = $pageTop;
                    break;
                }
            }
            if ($page->get("layout")=="blog-start") $blogStart = $page;
        } else {
            $blogStart = $this->yellow->content->find($blogStartLocation);
        }
        return $blogStart;
    }

    // Return blog pages for page
    public function getBlogPages($page) {
        if ($this->yellow->system->get("blogStartLocation")=="auto") {
            $pages = $page->getChildren();
        } else {
            $pages = $this->yellow->content->index();
        }
        $pages->filter("layout", "blog");
        return $pages;
    }
    
    // Return class for page
    public function getClass($page) {
        $class = "";
        if ($page->isExisting("tag")) {
            foreach (preg_split("/\s*,\s*/", $page->get("tag")) as $tag) {
                $class .= " tag-".$this->yellow->lookup->normaliseArguments($tag, false);
            }
        }
        return trim($class);
    }
}
