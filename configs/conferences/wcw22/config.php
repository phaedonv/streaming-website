<?php

$CONFIG['CONFERENCE'] = array(
	/**
	 * Der Startzeitpunkt der Konferenz als Unix-Timestamp. Befinden wir uns davor, wird die Closed-Seite
	 * mit einem Text der Art "hat noch nicht angefangen" angezeigt.
	 *
	 * Wird dieser Zeitpunkt nicht angegeben, gilt die Konferenz immer als angefangen. (Siehe aber ENDS_AT
	 * und CLOSED weiter unten)
	 */
	'STARTS_AT' => strtotime("2022-05-28 12:00"),

	/**
	 * Der Endzeitpunkt der Konferenz als Unix-Timestamp. Befinden wir uns danach, wird eine Danke-Und-Kommen-Sie-
	 * Gut-Nach-Hause-Seite sowie einem Ausblick auf die kommenden Events angezeigt.
	 *
	 * Wird dieser Zeitpunkt nicht angegeben, endet die Konferenz nie. (Siehe aber CLOSED weiter unten)
	 */
	'ENDS_AT' => strtotime("2022-05-28 23:00"),

	/**
	 * Hiermit kann die Funktionalitaet von STARTS_AT/ENDS_AT überschrieben werden. Der Wert 'before'
	 * simuliert, dass die Konferenz noch nicht begonnen hat. Der Wert 'after' simuliert, dass die Konferenz
	 * bereits beendet ist. 'running' simuliert eine laufende Konferenz.
	 *
	 * Der Boolean true ist aus Abwärtskompatibilitätsgründen äquivalent zu 'after'. False ist äquivalent
	 * zu 'running'.
	 */
	//'CLOSED' => false,

	/**
	 * Titel der Konferenz (kann Leer- und Sonderzeichen enthalten)
	 * Dieser im Seiten-Header, im <title>-Tag, in der About-Seite und ggf. ab weiteren Stellen als
	 * Anzeigetext benutzt
	 */
	'TITLE' => 'Wireless Community Weekend',
	
	/**
	 * Veranstalter
	 * Wird für den <meta name="author">-Tag verdet. Wird diese Zeile auskommentiert, wird kein solcher
	 * <meta>-Tag generiert.
	 */
	//'AUTHOR' => '',

	/**
	 * Beschreibungstext
	 * Wird für den <meta name="description">-Tag verdet. Wird diese Zeile auskommentiert, wird kein solcher
	 * <meta>-Tag generiert.
	 */
	'DESCRIPTION' => 'Das Wireless Community Weekend (WCW) hat 15 Jahre auf der c-base in Berlin und einmal komplett im Cyber stattgefunden. In diesem Jahr nehmen wir einen neuen Anlauf und wollen es vom 27. Mai bis 29. Mai 2022 in Weimar stattfinden lassen.

	Mit Unterstützung durch den Studierendenkonvent der Bauhaus-Universität Weimar und der studentischen Initiative Maschinenraum können wir das WCW im Haus der Studierenden (M18) durchführen.',

	/**
	 * Schlüsselwortliste, Kommasepariert
	 * Wird für den <meta name="keywords">-Tag verdet. Wird diese Zeile auskommentiert, wird kein solcher
	 * <meta>-Tag generiert.
	 */
	'KEYWORDS' => 'Freifunk, Wireless Community Weekend, ffwcw',

	/**
	 * HTML-Code für den Footer (z.B. für spezielle Attribuierung mit <a>-Tags)
	 * Sollte üblicherweise nur Inline-Elemente enthalten
	 * Wird diese Zeile auskommentiert, wird die Standard-Attribuierung für (c3voc.de) verwendet
	 */
	'FOOTER_HTML' => '
		by <a href="https://freifunk.net">freifunk.net</a> with friendly support from the <a href="https://c3voc.de">C3VOC</a>
	',

	/**
	 * HTML-Code für den Banner (nur auf der Startseite, direkt unter dem Header)
	 * wird üblicherweise für KeyVisuals oder Textmarke verwendet (vgl. Blaues
	 * Wischiwaschi auf http://media.ccc.de/)
	 *
	 * Dieser HTML-Block wird üblicherweise in der main.less speziell für die
	 * Konferenz umgestaltet.
	 *
	 * Wird diese Zeile auskommentiert, wird kein Banner ausgegeben.
	 */
	'BANNER_HTML' => '<div class="logo"></div>',

	/**
	 * Link zu den Recordings
	 * Wird diese Zeile auskommentiert, wird der Link nicht angezeigt
	 */
	'RELEASES' => 'https://media.freifunk.net/c/wcw22?sort=date',
	//'RELEASES' => 'https://www.youtube.com/playlist?list=PL_AMhvchzBaeIQntCDiVNUUgmRaAzam1V',

	/**
	 * Link zu einer (externen) ReLive-Übersichts-Seite
	 * Wird diese Zeile auskommentiert, wird der Link nicht angezeigt
	 */
	//'RELIVE' => 'http://vod.c3voc.de/',

	/**
	 * Alternativ kann ein ReLive-Json konfiguriert werden, um die interne
	 * ReLive-Ansicht zu aktivieren.
	 *
	 * Wird beides aktiviert, hat der externe Link Vorrang!
	 * Wird beides auskommentiert, wird der Link nicht angezeigt
	 */
	//'RELIVE_JSON' => 'https://cdn.c3voc.de/relive/cadusdebate/index.json',

	/**
	 * APCU-Cache-Zeit in Sekunden
	 * Wird diese Zeile auskommentiert, werden die apc_*-Methoden nicht verwendet und
	 * das Relive-Json bei jedem Request von der Quelle geladen und geparst
	 */
	//'RELIVE_JSON_CACHE' => 30*60,
);

/**
 * Konfiguration der Stream-Übersicht auf der Startseite
 */
$CONFIG['OVERVIEW'] = array(
	/**
	 * Abschnitte aud der Startseite und darunter aufgeführte Räume
	 * Es können beliebig neue Gruppen und Räume hinzugefügt werden
	 *
	 * Die Räume müssen in $CONFIG['ROOMS'] konfiguriert werden,
	 * sonst werden sie nicht angezeigt.
	 */
	'GROUPS' => array(
		'Lecture rooms' => array(
			'stream',
		),
	),
);



/**
 * Liste der Räume (= Audio & Video Produktionen, also auch DJ-Sets oä.)
 */
$CONFIG['ROOMS'] = array(
	/**
	 * Array-Key ist der Raum-Slug, der z.B. auch zum erstellen der URLs,
	 * in $CONFIG['OVERVIEW'] oder im Feedback verwendet wird.
	 */
	'stream' => array(
		/**
		 * Angezeige-Name
		 */
		'DISPLAY' => 'Hauptgebäude Raum 002',

		/**
		 * ID des Video/Audio-Streams. Die Stream-ID ist davon abhängig, welches
		 * Event-Case in welchem Raum aufgebaut wird und wird üblicherweise von
		 * s1 bis s5 durchnummeriert.
		 */
		'STREAM' => 'ffwcw',

		/**
		 * Stream-Vorschaubildchen auf der Übersichtsseite anzeigen
		 * Damit das funktioniert muss der entsprechende runit-Task auf dem
		 * CDN-Quell-Host (live.ber) laufen.
		 */
		'PREVIEW' => true,

		/**
		 * Übersetzungstonspur aktivieren
		 *
		 * Wenn diese Zeile auskommentiert oder auf false gesetzt ist werden nur
		 * die native-Streams verwendet, andernfalls wird native und translated
		 * angeboten und auch für beide Tonspuren eine Player-Seite angezeigt.
		 */
		'TRANSLATION' => false,

		/**
		 * SD-Video-Stream (1024×576) verfügbar
		 *
		 * Wenn diese Zeile auskommentiert oder auf false gesetzt ist ẃird kein SD-Video
		 * angeboten. Wird auch HD_VIDEO auf false gesetzt oder auskommentiert ist, wird
		 * für diesen Raum überhaupt kein Video angeboten.
		 *
		 * In diesem Fall wird, sofern jeweils aktiviert, Slides, Audio und zuletzt Musik
		 * als Default-Stream angenommen.
		 */
		'SD_VIDEO' => true,

		/**
		 * HD-Video-Stream (1920×1080) verfügbar
		 *
		 * Wenn diese Zeile auskommentiert oder auf false gesetzt ist ẃird kein HD-Video
		 * angeboten. Wird auch SD_VIDEO auf false gesetzt oder auskommentiert ist, wird
		 * für diesen Raum überhaupt kein Video angeboten.
		 *
		 * In diesem Fall wird, sofern jeweils aktiviert, Slides, Audio und zuletzt Musik
		 * als Default-Stream angenommen.
		 */
		'HD_VIDEO' => true,

		/**
		 * Slide-Only-Stream (1024×576) verfügbar
		 *
		 * Wenn diese Zeile auskommentiert oder auf false gesetzt ist ẃird kein Slide-Only-
		 * Stream angeboten. Für diesen Raum wird dann keim Slides-Tab angeboten.
		 *
		 * In diesem Fall wird, sofern jeweils aktiviert, Audio und zuletzt Musik als
		 * Default-Stream angenommen.
		 */
		'SLIDES' => false,
		'DASH' => true,

		/**
		 * Audio-Only-Stream verfügbar
		 *
		 * Wenn diese Zeile auskommentiert oder auf false gesetzt ist ẃird kein Audio-Only-
		 * Stream angeboten. Für diesen Raum wird dann keim Audio-Tab angeboten.
		 *
		 * In diesem Fall wird, sofern aktiviert, Musik als Default-Stream angenommen.
		 */
		'AUDIO' => false,

		/**
		 * Musik-Stream verfügbar
		 *
		 * Wenn diese Zeile auskommentiert oder auf false gesetzt ist ẃird kein Musik-Stream
		 * angeboten. Für diesen Raum wird dann keim Musik-Tab angeboten.
		 *
		 * Ist kein einziger Stream angebote, wird statt der Stream-Seite ein 404-Fehler
		 * angezeigt.
		 */
		'MUSIC' => false,

		/**
		 * Fahrplan-Ansicht auf der Raum-Seite aktivieren (boolean)
		 *
		 * Wenn diese Zeile auskommentiert oder auf false gesetzt ist,
		 * wird der Raum nicht im Fahrplan gesucht und auch auf der Startseite
		 * findet keine Darstellung statt.
		 *
		 * Ebenso können alle Fahrplan-Funktionialitäten durch auskommentieren
		 * des globalen $CONFIG['SCHEDULE']-Blocks deaktiviert werden
		 */
		'SCHEDULE' => true,

		/**
		 * Name des Raums im Fahrplan
		 * Wenn diese Zeile auskommentiert ist wird der Raum-Slug verwendet
		 */
		'SCHEDULE_NAME' => '',

		/**
		 * Feedback anzeigen (boolean)
		 *
		 * Wenn diese Zeile auskommentiert oder auf false gesetzt ist,
		 * taucht der Raum auch im globalen Feedback-Formular nicht auf.
		 *
		 * Ebenso können alle Feedback-Funktionialitäten durch auskommentieren
		 * des globalen $CONFIG['FEEDBACK']-Blocks deaktiviert werden
		 */
		'FEEDBACK' => false,

		/**
		 * Subtitles-Player aktivieren (boolean)
		 *
		 * Wenn diese Zeile auskommentiert oder auf false gesetzt ist,
		 * wird der Subtitles-Button und die damit verbundenen Funktionen deaktiviert.
		 *
		 * Ebenso können alle Subtitles-Funktionialitäten durch auskommentieren
		 * des globalen $CONFIG['SUBTITLES']-Blocks deaktiviert werden
		 */
		'SUBTITLES' => false,

		/**
		 * Embed-Form aktivieren (boolean)
		 *
		 * Ist dieses Feld auf true gesetzt, wird ein Embed-Tab unter dem Video
		 * angezeigt. Darüber kann der Player als iframe eingebunden werden.
		 *
		 * Wenn diese Zeile auskommentiert oder auf false gesetzt ist,
		 * wird kein Embed-Tab angeboten und die URL zum Einbetten existiert nicht.
		 *
		 * Ebenso können alle Embedding-Funktionialitäten durch auskommentieren
		 * des globalen $CONFIG['EMBED']-Blocks deaktiviert werden
		 */
		'EMBED' => true,

		/**
		 * IRC-Link aktivieren (boolean)
		 *
		 * Solange Twitter oder IRC aktiviert ist, wird ein "Chat"-Tab mit den
		 * jeweiligen Links angezeigt.
		 *
		 * Ist dieses Feld auf true gesetzt, wird ein irc://-Link angezeigt.
		 * WebIrc wird nach dem Congress nicht mehr unterstützt ;)
		 *
		 * Wenn diese Zeile auskommentiert oder auf false gesetzt ist,
		 * wird kein IRC-Link angezeigt
		 *
		 * Ebenso können alle IRC-Links durch auskommentieren
		 * des globalen $CONFIG['IRC']-Blocks deaktiviert werden
		 */
		'IRC' => true,

		/**
		* Mit dem Angaben in diesem Block können die Vorgaben aus dem
		* globalen $CONFIG['IRC'] Block überschrieben werden.
		*
		* Der globale $CONFIG['IRC']-Block muss trotzdem existieren,
		* da sonst überhaupt kein IRC-Link erzeugt wird. (ggf. einfach `= true` setzen)
		*/
		// 'IRC_CONFIG' => array(
		// 	'DISPLAY' => '#31C3-hall-1 @ hackint',
		// 	'URL'     => 'irc://irc.hackint.eu:6667/31C3-hall-1',
		// ),

		/**
		 * Twitter-Link aktivieren (boolean)
		 *
		 * Ist dieses Feld auf true gesetzt, wird ein Link zu Twitter angezeigt.
		 *
		 * Solange Twitter oder IRC aktiviert ist, wird ein "Chat"-Tab mit den
		 * jeweiligen Links angezeigt.
		 *
		 * Wenn diese Zeile auskommentiert oder auf false gesetzt ist,
		 * wird kein Twitter-Link angezeigt
		 *
		 * Ebenso können alle Twitter-Links durch auskommentieren
		 * des globalen $CONFIG['TWITTER']-Blocks deaktiviert werden
		 **/
		'TWITTER' => true,

		/**
		* Mit dem Angaben in diesem Block können die Vorgaben aus dem
		* globalen $CONFIG['TWITTER'] Block überschrieben werden.
		*
		* Der globale $CONFIG['TWITTER']-Block muss trotzdem existieren,
		* da sonst überhaupt kein IRC-Link erzeugt wird. (ggf. einfach `= true` setzen)
		*/
		// 'TWITTER_CONFIG' => array(
		// 	'DISPLAY' => '#fossgis2016 @ twitter',
		// 	'TEXT'    => '#fossgis2016',
		// ),
	),
);

/**
 * Globaler Schalter für die Embedding-Funktionalitäten
 *
 * Wird diese Zeile auskommentiert oder auf False gesetzt, werden alle
 * Embedding-Funktionen deaktiviert.
 */
$CONFIG['EMBED'] = true;

/**
 * Konfigurationen zum Konferenz-Fahrplan
 * Wird dieser Block auskommentiert, werden alle Fahrplan-Bezogenen Features deaktiviert
 */
$CONFIG['SCHEDULE'] = array(
	/**
	 * URL zum Fahrplan-XML
	 *
	 * Diese URL muss immer verfügbar sein, sonst können kann die Programm-Ansicht
	 * aufhören zu funktionieren. Wenn die Quelle unverlässlich ist ;) sollte ein
	 * externer HTTP-Cache vorgeschaltet werden.
	 */
	'URL' => 'https://pretalx.freifunktag.de/wireless-community-weekend-2022/schedule/export/schedule.xml',

	/**
	* Nur die angegebenen Räume aus dem Fahrplan beachten
	*
	* Wird diese Zeile auskommentiert, werden alle Räume angezeigt
	*/
	//'ROOMFILTER' => ['Galerie', 'Saal', ' GI Studio'],

	/**
	 * Skalierung der Programm-Vorschau in Sekunden pro Pixel
	 */
//	'SCALE' => 5,

	/**
	 * Simuliere das Verhalten als wäre die Konferenz bereits heute
	 *
	 * Diese folgende Beispiel-Zeile Simuliert, dass das
	 * Konferenz-Datum 2014-12-29 auf den heutigen Tag 2015-02-24 verschoben ist.
	 */
	//'SIMULATE_OFFSET' => strtotime(/* Conference-Date */ '2022-05-28') - strtotime(/* Today */ '2022-04-26'),
//	'SIMULATE_OFFSET' => 3600*2,
);
 

/**
 * Globale Konfiguration der Twitter-Links.
 *
 * Wird dieser Block auskommentiert, werden keine Twitter-Links mehr erzeugt. Sollen die
 * Twitter-Links für jeden Raum einzeln konfiguriert werden, muss dieser Block trotzdem
 * existieren sein. ggf. einfach auf true setzen:
 *
 *   $CONFIG['TWITTER'] = true
 */
$CONFIG['TWITTER'] = array(
	/**
	 * Anzeigetext für die Twitter-Links.
	 *
	 * %s wird durch den Raum-Slug ersetzt.
	 * Ist eine weitere Anpassung erfoderlich, kann ein TWITTER_CONFIG-Block in der
	 * Raum-Konfiguration zum Überschreiben dieser Angaben verwendet werden.
	 */
	'DISPLAY' => '#ffwcw @ twitter',

	/**
	 * Vorgabe-Tweet-Text für die Twitter-Links.
	 *
	 * %s wird durch den Raum-Slug ersetzt.
	 * Eine Anpassung kann ebenfalls in der Raum-Konfiguration vorgenommen werden.
	 */
	'TEXT' => '#ffwcw',
);

$CONFIG['IRC'] = array(
    /**
     * Anzeigetext für die IRC-Links.
     *
     * %s wird durch den Raum-Slug ersetzt.
     * Ist eine weitere Anpassung erfoderlich, kann ein IRC_CONFIG-Block in der
     * Raum-Konfiguration zum Überschreiben dieser Angaben verwendet werden.
     */
    'DISPLAY' => 'wcw22 @ matrix',

    /**
     * URL für die IRC-Links.
     * Hierbei kann sowohl ein irc://-Link als auch ein Link zu einem
     * WebIrc-Provider wie z.B. 'https://kiwiirc.com/client/irc.hackint.eu/#33C3-%s'
     * verwendet werden.
     *
     * %s wird durch den urlencodeten Raum-Slug ersetzt.
     * Eine Anpassung kann ebenfalls in der Raum-Konfiguration vorgenommen werden.
     */
    'URL' => 'https://matrix.to/#/#wcw22:bau-ha.us',
);

return $CONFIG;
