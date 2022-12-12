<p align="right"><a href="README-de.md">Deutsch</a> &nbsp; <a href="README.md">English</a> &nbsp; <a href="README-sv.md">Svenska</a></p>

# Blog 0.8.23

Blog für deine Webseite.

<p align="center"><img src="blog-screenshot.png?raw=true" alt="Bildschirmfoto"></p>

## Wie man eine Erweiterung installiert

[ZIP-Datei herunterladen](https://github.com/annaesvensson/yellow-blog/archive/main.zip) und in dein `system/extensions`-Verzeichnis kopieren. [Weitere Informationen zu Erweiterungen](https://github.com/annaesvensson/yellow-update/tree/main/README-de.md).

## Wie man ein Blog benutzt

Das Blog ist auf deiner Webseite vorhanden als `http://website/blog/`. Um das Blog auf der Startseite anzuzeigen, gehe in dein `content`-Verzeichnis und lösche das `1-home`-Verzeichnis. Um eine neue Blogseite hinzuzufügen, erstelle eine neue Datei im Blogverzeichnis. Ganz oben auf einer Seite kannst du `Published` und andere [Seiteneinstellungen](https://github.com/annaesvensson/yellow-core/tree/main/README-de.md#einstellungen-seite) festlegen. Das Veröffentlichungsdatum wird zur Sortierung der Blogseiten verwendet. Mit `Tag` kann man ähnliche Seiten gruppieren. Du kannst `[--more--]` benutzen, um an der gewünschten Stelle einen Seitenumbruch zu erzeugen.

## Wie man Bloginformationen anzeigt

Du kannst Abkürzungen verwenden, um Informationen über das Blog anzuzeigen:

`[blogauthors]` für eine Liste der Autoren  
`[blogtags]` für eine Liste der Tags  
`[blogyears]` für eine Liste der Jahre  
`[blogmonths]` für eine Liste der Monate  
`[blogrelated]` für eine Liste von Seiten, ähnlich zur aktuellen Seite  
`[blogpages]` für eine Liste von Seiten, alphabetische Reihenfolge  
`[blogchanges]` für eine Liste von Seiten, veröffentlichte Reihenfolge  

Die folgenden Argumente sind verfügbar, alle bis auf das erste Argument sind optional:

`StartLocation` = Ort der Blogstartseite  
`EntriesMax` = Anzahl der Einträge pro Abkürzung, 0 für unbegrenzt  
`FilterTag` = Seiten mit bestimmten Tag anzeigen, nur bei `[blogpages]` oder `[blogchanges]`  

## Beispiele

Inhaltsdatei fürs Blog:

    ---
    Title: Blog-Beispiel
    Published: 2020-04-07
    Author: Datenstrom
    Layout: blog
    Tag: Beispiel
    ---
    Das ist eine Beispielseite fürs Blog.

    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut 
    labore et dolore magna pizza. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
    nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit 
    esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt 
    in culpa qui officia deserunt mollit anim id est laborum.

Inhaltsdatei fürs Blog, mit Seitenumbruch:

    ---
    Title: Fika ist gut für dich
    Published: 2020-06-01
    Author: Datenstrom
    Layout: blog
    Tag: Beispiel, Kaffee
    ---
    Fika ist ein schwedischer Brauch. Es ist eine Kaffeepause, bei der Menschen  
    bei einer Tasse Kaffee oder Tee zusammenkommen. Das kann mit Arbeitskollegen  
    sein oder du lädst Freunde dazu ein. Fika ist ein so bedeutender Teil vom 
    schwedischen Alltag, dass es sowohl als Verb als auch als Nomen verwendet  
    wird. Wie oft machst du Fika? [--more--]

    [youtube SUpY1BT9Xf4]

Inhaltsdatei mit Bloginformationen:

    ---
    Title: Übersicht
    ---
    ## Jahre

    [blogyears /blog/ 0]

    ## Tags

    [blogtags /blog/ 0]

Liste mit Seiten anzeigen, alphabetische Reihenfolge:

    [blogpages /blog/ 0]
    [blogpages /blog/ 3]
    [blogpages /blog/ 10]

Liste mit Seiten anzeigen, alphabetische Reihenfolge mit einem bestimmten Tag:

    [blogpages /blog/ 0 Kaffee]
    [blogpages /blog/ 0 Milch]
    [blogpages /blog/ 0 Beispiel]

Liste mit Seiten anzeigen, veröffentlichte Reihenfolge:

    [blogchanges /blog/ 0]
    [blogchanges /blog/ 3]
    [blogchanges /blog/ 10]

Liste mit Seiten anzeigen, veröffentlichte Reihenfolge mit einem bestimmten Tag:

    [blogchanges /blog/ 0 Kaffee]
    [blogchanges /blog/ 0 Milch]
    [blogchanges /blog/ 0 Beispiel]

Links zum Blog anzeigen:

    [Siehe alle Seiten](/blog/)
    [Siehe Seiten von 2020](/blog/published:2020/)
    [Siehe Seiten von Datenstrom](/blog/author:datenstrom/)
    [Siehe Seiten über Kaffee](/blog/tag:kaffee/)
    [Siehe Seiten mit Beispielen](/blog/tag:beispiel/)

Blogstartseite in den Einstellungen festlegen, URL mit Unterverzeichnis für jedes Jahr:

    BlogStartLocation: /blog/
    BlogNewLocation: /blog/@year/@title

## Einstellungen

Die folgenden Einstellungen können in der Datei `system/extensions/yellow-system.ini` vorgenommen werden:

`BlogStartLocation` = Ort der Blogstartseite, `auto` für automatische Erkennung  
`BlogNewLocation` = Ort für neue Blogseiten, [unterstützte Platzhalter](#einstellungen-placeholders)  
`BlogEntriesMax` = Anzahl der Einträge pro Abkürzung, 0 für unbegrenzt  
`BlogPaginationLimit` = Anzahl der Einträge pro Seite, 0 für unbegrenzt 

<a id="einstellungen-placeholders"></a>Die folgenden Platzhalter für neue Blogseiten werden unterstützt:

`@title` = Seitentitel  
`@author` = Autor der Seite  
`@tag` = Tag zur Kategorisierung der Seite  
`@timestamp` = Veröffentlichungsdatum der Seite als Zeitstempel  
`@date` = Veröffentlichungsdatum der Seite, JJJJ-MM-TT Format  
`@year` = Veröffentlichungsjahr der Seite  
`@month` = Veröffentlichungsmonat der Seite  
`@day` = Veröffentlichungstag der Seite  

<a id="einstellungen-files"></a>Die folgenden Dateien können angepasst werden:

`content/shared/page-new-blog.md` = Inhaltsdatei für neue Blogseite  
`system/layouts/blog.html` = Layoutdatei für individuelle Blogseite  
`system/layouts/blog-start.html` = Layoutdatei für die Blogstartseite  

## Entwickler

Anna Svensson. [Hilfe finden](https://datenstrom.se/de/yellow/help/).
