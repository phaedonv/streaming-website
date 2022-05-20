# **DeepL translation in English**
***
# C3VOC streaming web page

This is the code for the streaming website at
[streaming.media.ccc.de](http://streaming.media.ccc.de/), which is used by the
[C3VOC](https://c3voc.de/) to stream live video and audio from
[various conferences](https://c3voc.de/eventkalender/) on the Internet.
present. The idea behind this project is to have a generic codebase that can be used
that can be adapted to the conference with a few configuration options and a few CSS rules.
conditions and the design of the conference. 


## Development

During development the built-in PHP web server can be used:
``sh
$ ./serve.sh
PHP 7.0.4-7ubuntu2.1 Development Server started at Mon Jun 20 22:40:17 2016
Listening on http://localhost:8000
Document root is /home/peter/VOC/streaming-website
Press Ctrl-C to quit.
...
```

PHP 5.4 and higher is supported.

### Docker

If you prefer Docker, you can also use the following line:

```sh
docker run -it -p 8000:8000 -v "$PWD":/app -w /app php:7-cli -S 0.0.0.0:8000 -d short_open_tag=true index.php
```

### Dependencies

```sh
apt install php7.0-curl php7.0-xml
# - or -
apt install php-curl php-xml
```

#### Test file download

```
./download.sh
```

## Configuration of individual conferences

The page can be used for several conferences running in parallel at the same time.
at the same time. Each conference is configured via a folder underneath
[configs/conferences](configs/conferences). In these folders you can
files that determine the behavior and layout of the conference page.
of the respective conference page, in the following at :

  - [config.php](configs/conferences/nixcon15/config.php) - controls the behavior of the entire conference page. This is extensively documented and should be self-explanatory.
  - [main.less](configs/conferences/nixcon15/main.less) - controls the layout of the conference page.
  - other assets like `.png` or `.svg` files that can be referenced from within `main.less`.

See also https://c3voc.de/wiki/software:streamingwebsite#add_a_new_conference

## Setup

The setup at the VOC consists of a hidden master server, which executes the PHP code
in a nginx. Behind it come `n` frontend caches, where for small
events `n` is almost always `=1`. For large events (camp, congress)
we can easily deploy additional frontend caches at different hosters.
hosters.

For the preparation of a conference or for the further development of the page it is
helpful to set up the part locally. The easiest way to do this is with an
Apache, because the enclosed [.htaccess](.htaccess) configures the
URL rewriting correctly. With nginx this has to be set in the global nginx.conf
like this:

```
location / {
    rewrite /(.*) /index.php?route=$1 last;
}
```

Differing from the default config, the flag `short_open_tag = On` must be set in PHP.
must be set.



## Deployment (on the VOC infrastructure)

see [deploy.sh](deploy.sh) resp. https://c3voc.de/wiki/software:streamingwebsite


## JSON API

Under the URL [http://streaming.media.ccc.de/streams/v2.json](http://streaming.media.ccc.de/streams/v2.json) the
streaming website provides an overview of all configured rooms and streams in a machine-readable
in a machine-readable format. This can be used, e.g., to be used in the
various applications that have developed around the conference event,
offer players and links to live broadcasts.

As the URL suggests, the API is versioned. This means that in
fields in the `v2.json` are *removed* or change their *meaning* - but there may be
but *new fields* may be added. A more formal specification
of the JSON format is tbd. An example can be [viewed here
viewed](https://gist.github.com/MaZderMind/a91f242efb2f446a2237d4596896efd6).

### Known users of the API

  - [Kodi media.ccc.de plugin](https://github.com/cccc/plugin.video.media-ccc-de)
    - v2
    - [API compatibility test](https://github.com/cccc/plugin.video.media-ccc-de/blob/master/resources/lib/test_stream.py)
  - [re-data](https://github.com/ocdata/re-data/tree/feature/34c3)
    - Scraping code: [https://github.com/ocdata/re-data/blob/feature/34c3/scraper/34C3/scraper.js](https://github.com/ocdata/re-data/blob/feature/34c3/scraper/34C3/scraper.js)
    - During events data appears here: [http://api.conference.bits.io/](http://api.conference.bits.io/)

## Troubleshooting

### Wrong PHP version

If `serve.sh` throws an error like `PHP Fatal error: Uncaught ErrorException: Required parameter $rules follows optional parameter $value in /<path-to-repository>/lib/less.php/Less.php:5501` it could be that you are using the wrong PHP version. If `php --version` returns 8 or newer, then your version is too new. Try to install PHP 7.4 on your operating system and change the version in the scripts you need. For example
``sh
# before
php -S localhost:$port -d short_open_tag=true index.php
```
then
```sh
# after
php7.4 -S localhost:$port -d short_open_tag=true index.php
```

### Error message `Call to undefined function iconv()`
If you only see a blank page when you call the page in your browser, look in your terminal to see if there was an error. If you see an error like `PHP Fatal error: Uncaught Error: Call to undefined function iconv()`, the iconv-extention is not activated. You can enable it in your global `php.ini`. You can find out where this file is with `php --ini` or `php7 --ini`. Search the file for the right line and remove the semicolon at the beginning. If there is no semicolon, the extension should already be activated.
```
// before
;extension=iconv
```
```
// after
extension=iconv
```

### Error message `lessc: command not found`
If you get the error `lessc: command not found` when running scripts, you are missing a less compiler. There are several ways to install a less compiler. For example, if you are using `npm`, you can install less globally with `npm install -g less`. Then `lessc` should be globally available on your system.

### Translated with www.DeepL.com/Translator (free version)

***


# C3VOC Streaming-Webseite

Dies ist der Code für die Streaming-Webseite unter
[streaming.media.ccc.de](http://streaming.media.ccc.de/), welche vom
[C3VOC](https://c3voc.de/) benutzt wird, um Live-Video- und -Audio-Streams von
[diversen Konferenzen](https://c3voc.de/eventkalender/) im Internet zu
präsentieren. Die Idee hinter diesem Projekt ist es, eine generische Codebasis
zu haben, die mit wenigen Konfigurationsoptionen und ein paar CSS-Rules an die
Gegebenheiten und die Gestaltung der Konferenz angepasst werden können. 


## Development

Während der Entwicklung kann der eingebaute PHP-Webserver verwendet werden:
```sh
$ ./serve.sh
PHP 7.0.4-7ubuntu2.1 Development Server started at Mon Jun 20 22:40:17 2016
Listening on http://localhost:8000
Document root is /home/peter/VOC/streaming-website
Press Ctrl-C to quit.
…
```

Unterstützt wird PHP ab 5.4.

### Docker

Wer lieber Docker mag, kann auch folgende Zeile verwenden:

```sh
docker run -it -p 8000:8000 -v "$PWD":/app -w /app php:7-cli -S 0.0.0.0:8000 -d short_open_tag=true index.php
```

### Abhängigkeiten

```sh
apt install php7.0-curl php7.0-xml
# - or -
apt install php-curl php-xml
```

#### Dateidownload testen

```
./download.sh
```

## Konfiguration der einzelnen Konferenzen

Die Seite kann für mehrere parallel laufende Konferenzen gleichzeitig verwendet
werden. Jede Konferenz wird über einen Ordner unterhalb von
[configs/conferences](configs/conferences) konfiguriert. In diesen Ordnern können
jeweils folgende Dateien abgelegt werden, welche das Verhalten bzw. die Gestaltung
der jeweiligen Konferenzseite bestimmen, im Folgendem am :

  - [config.php](configs/conferences/nixcon15/config.php) – steuert das Verhalten der gesamten Konferenzseite. Diese ist ausführlich dokumentiert und sollte sich selbst erklären.
  - [main.less](configs/conferences/nixcon15/main.less) – steuert die Gestaltung der Konferenzseite.
  - weitere Assets wie `.png` oder `.svg`-Dateien, die aus der `main.less` heraus referenziert werden können.

Siehe auch https://c3voc.de/wiki/software:streamingwebsite#add_a_new_conference

## Setup

Das Setup beim VOC besteht aus einem Hidden-Master-Server, welcher den PHP-Code
in einem nginx ausführt. Dahinter kommen `n` Frontend-Caches, wobei für kleine
Events `n` eigentlich fast immer `=1` ist. Für große Events (Camp, Congress)
können wir aber sehr einfach weitere Frontend-Caches bei verschiedenen Hostern
hinzu deployen.

Zur Vorbereitung einer Konferenz oder zur Weiterentwickelung der Seite ist es
hilfreich, sich das Teil lokal aufzusetzen. Am einfachsten geht das mit 'nem
Apachen, denn die beiliegende [.htaccess](.htaccess) konfiguriert das
URL-Rewriting gleich richtig. Bei nginx muss das in der globalen nginx.conf
ungefähr so eingestellt werden:

```
location / {
    rewrite /(.*) /index.php?route=$1 last;
}
```

Abweichend von der Default-Config muss in PHP das Flag `short_open_tag = On`
gesetzt werden.



## Deployment (auf der VOC Infrastruktur)

see [deploy.sh](deploy.sh) bzw. https://c3voc.de/wiki/software:streamingwebsite


## JSON-API

Unter der URL [http://streaming.media.ccc.de/streams/v2.json](http://streaming.media.ccc.de/streams/v2.json) bietet die
Streaming-Webseite eine Übersicht über alle konfigurierten Räume und Streams in
einem maschinenlesbaren Format an. Dieses kann z.B. genutzt werden, um in den
diversen Anwendungen, die sich rund um das Konferenzgeschehen entwickelt haben,
Player und Links zu Liveübertragungen anzubieten.

Wie die URL vermuten lässt, ist die API versioniert. Dies bedeutet, dass in
der `v2.json` keine Felder *entfernt werden* oder ihre *Bedeutung ändern* – es
können aber durchaus *neue Felder* hinzukommen. Eine formalere Spezifikation
des JSON-Formats ist tbd. Ein Beispiel kann [hier
betrachtet](https://gist.github.com/MaZderMind/a91f242efb2f446a2237d4596896efd6) werden.

### Bekannte Nutzer der API

  - [Kodi media.ccc.de Plugin](https://github.com/cccc/plugin.video.media-ccc-de)
    - v2
    - [API Kompatibilitätstest](https://github.com/cccc/plugin.video.media-ccc-de/blob/master/resources/lib/test_stream.py)
  - [re-data](https://github.com/ocdata/re-data/tree/feature/34c3)
    - Scraping code: [https://github.com/ocdata/re-data/blob/feature/34c3/scraper/34C3/scraper.js](https://github.com/ocdata/re-data/blob/feature/34c3/scraper/34C3/scraper.js)
    - During events data appears here: [http://api.conference.bits.io/](http://api.conference.bits.io/)

## Troubleshooting

### Falsche PHP-Version

Wenn `serve.sh` einen Fehler wirft wie z.B. `PHP Fatal error:  Uncaught ErrorException: Required parameter $rules follows optional parameter $value in /<path-to-repository>/lib/less.php/Less.php:5501` kann es sein, dass du eine falsche PHP-Version verwendest. Wenn `php --version` 8 oder neuer zurückgibt, dann ist deine Version zu neu. Versuche auf deinem Betriebssystem PHP 7.4 zu installieren und in den Skripts, die zu benötigst, die Version anzupassen. Zum Beispiel wird dann aus
```sh
# vorher
php -S localhost:$port -d short_open_tag=true index.php
```
dann
```sh
# nachher
php7.4 -S localhost:$port -d short_open_tag=true index.php
```

### Fehlermeldung `Call to undefined function iconv()`
Wenn du beim Aufrufen der Seite im Browser nur eine leere Seite siehst, schau in dein Terminal, ob es einen Fehler gab. Wenn du einen Fehler wie `PHP Fatal error:  Uncaught Error: Call to undefined function iconv()` siehst, ist bei dir die iconv-Extention nicht aktiviert. Du kannst diese in deiner globalen `php.ini` aktivieren. Wo diese Datei liegt kannst du mit `php --ini` bzw. `php7 --ini` rausfinden. Suche in der Datei nach der richtigen Zeile und entferne das Semikolon am Anfang. Wenn es kein Semikolon gibt, sollte die Extension bereits aktiviert sein.
```
// vorher
;extension=iconv
```
```
// nachher
extension=iconv
```

### Fehlermeldung `lessc: command not found`
Wenn du beim Ausführen von Skripten den Fehler `lessc: command not found` bekommst, fehlt dir ein less-Compiler. Es gibt verschiedene Arten, sich einen less-Compiler zu installieren. Falls du `npm` verwendest, kannst du beispielsweise less global installieren mit `npm install -g less`. Anschließen sollte `lessc` dann global auf deinem System verfügbar sein.
