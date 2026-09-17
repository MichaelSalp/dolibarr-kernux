![KERN UX für Dolibarr](https://raw.githubusercontent.com/MichaelSalp/dolibarr-kernux/main/docs/logo.png)

# KERN UX für Dolibarr

[![Version](https://img.shields.io/github/v/release/MichaelSalp/dolibarr-kernux?label=Version)](https://github.com/MichaelSalp/dolibarr-kernux/releases)
[![Downloads](https://img.shields.io/github/downloads/MichaelSalp/dolibarr-kernux/total?label=Downloads&cacheSeconds=3600)](https://github.com/MichaelSalp/dolibarr-kernux/releases)
[![Lizenz](https://img.shields.io/github/license/MichaelSalp/dolibarr-kernux?label=Lizenz&cacheSeconds=3600)](LICENSE)
[![Dolibarr](https://img.shields.io/badge/Dolibarr-%E2%89%A5%2024.0-263c5c)](https://www.dolibarr.org)
[![PHP](https://img.shields.io/badge/PHP-%E2%89%A5%207.4-777bb4)](https://www.php.net)

Dolibarr-Modul, das die Oberfläche im Stil des Design-Systems **[KERN UX](https://www.kern-ux.de)** gestaltet
und das **Hauptmenü von oben in eine linke Sidebar** verlegt. Keine Änderungen am Dolibarr-Kern: Das Modul
bringt einen eigenen Menü-Handler und ein Stylesheet mit und lässt sich jederzeit wieder abschalten.

![Startseite](https://raw.githubusercontent.com/MichaelSalp/dolibarr-kernux/main/docs/screenshots/start.png)

## Download

### [➜ module_kernux-1.0.1.zip herunterladen](https://github.com/MichaelSalp/dolibarr-kernux/releases/download/v1.0.1/module_kernux-1.0.1.zip)

**Version 1.0.1** · [Release-Notizen](https://github.com/MichaelSalp/dolibarr-kernux/releases/tag/v1.0.1) ·
[alle Versionen](https://github.com/MichaelSalp/dolibarr-kernux/releases)

Die ZIP-Datei unverändert (Dateiname nicht ändern) in Dolibarr unter
*Start → Einstellungen → Module/Anwendungen → Externes Modul hinzufügen* hochladen – Details unter [Installation](#installation).

## Funktionen

- **Sidebar statt oberem Menü**: Alle Hauptbereiche stehen links untereinander. Der aktive Bereich klappt sein
  gewohntes Dolibarr-Untermenü darunter auf. Menüeinträge anderer Module, Rechte und Hooks bleiben erhalten.
- **Einklappbar**: Ein Klick auf « verkleinert die Sidebar auf eine Icon-Leiste; der Zustand wird im Browser gemerkt.
- **Mobil**: Unter 768 px Breite öffnet der Hamburger-Button die Sidebar als Overlay.
- **KERN-UX-Optik**: Schrift Fira Sans, Farben, Buttons, Formularfelder, Tabellen, Tabs, Meldungen und Tooltips
  über die Design-Tokens von KERN UX.
- **Dark Mode**: folgt automatisch der Einstellung des Betriebssystems.
- **Eigene Akzentfarbe**: Die *Farbe für Hyperlinks* unter *Einstellungen → Benutzeroberfläche* wird zur Akzentfarbe; ohne eigene Farbe
  bleibt das KERN-Blau.
- **Firmenlogo** oben in der Sidebar (Logo aus *Einstellungen → Unternehmen/Institution*, sonst der Firmenname).
- **Alles lokal**: KERN UX und die Schriften werden mit dem Modul ausgeliefert, es werden keine externen Server
  (CDN) abgefragt.

## Screenshots

| Geschäftspartner | Bankabgleich |
|---|---|
| ![Geschäftspartner](https://raw.githubusercontent.com/MichaelSalp/dolibarr-kernux/main/docs/screenshots/geschaeftspartner.png) | ![Bankabgleich](https://raw.githubusercontent.com/MichaelSalp/dolibarr-kernux/main/docs/screenshots/bankabgleich.png) |

| Dark Mode | Eingeklappte Sidebar |
|---|---|
| ![Dark Mode](https://raw.githubusercontent.com/MichaelSalp/dolibarr-kernux/main/docs/screenshots/start-dark.png) | ![Eingeklappte Sidebar](https://raw.githubusercontent.com/MichaelSalp/dolibarr-kernux/main/docs/screenshots/eingeklappt.png) |

![Mobile Ansicht mit geöffnetem Menü](https://raw.githubusercontent.com/MichaelSalp/dolibarr-kernux/main/docs/screenshots/mobil.png)

## Voraussetzungen

- Dolibarr **24.0** oder neuer, PHP 7.4 oder neuer
- Theme **eldy** (Standard-Theme von Dolibarr); das Modul legt sich darüber
- Ein aktueller Browser (Chrome, Edge, Firefox, Safari der letzten zwei Jahre)

## Installation

**Variante A – ZIP über die Oberfläche**

1. Release-ZIP `module_kernux-x.y.z.zip` von der Releases-Seite herunterladen (Dateinamen nicht ändern).
2. In Dolibarr: *Start → Einstellungen → Module/Anwendungen → Externes Modul hinzufügen* → ZIP hochladen.

**Variante B – Git**

```bash
cd /pfad/zu/dolibarr/htdocs/custom
git clone https://github.com/MichaelSalp/dolibarr-kernux.git kernux
```

Der Ordner muss `kernux` heißen. Ein Symlink (Linux) bzw. Junction (Windows) von `htdocs/custom/kernux` auf einen
anderen Ordner funktioniert ebenfalls.

**In beiden Fällen** müssen in `htdocs/conf/conf.php` beide Zeilen für eigene Module gesetzt sein
(oft nur auskommentiert):

```php
$dolibarr_main_url_root_alt='/custom';
$dolibarr_main_document_root_alt='/pfad/zu/dolibarr/htdocs/custom';
```

Danach unter *Start → Einstellungen → Module/Anwendungen* das Modul **„KERN UX“** (Bereich *Andere*) aktivieren und die
Seite einmal mit Strg+F5 neu laden.

## Anpassen

Alles über vorhandene Dolibarr-Einstellungen unter *Start → Einstellungen → Benutzeroberfläche*:

| Einstellung | Wirkung |
|---|---|
| Farbe für Hyperlinks | Akzentfarbe für aktiven Menüpunkt, Buttons und Links (leer = KERN-Blau) |
| Linken und rechten Tabellenrand anzeigen / Eckradius | Seitliche Rahmen und Rundung von Tabellen und Boxen |
| Dark Theme-Modus | beim Aktivieren auf „Je nach Browser“ gesetzt (folgt dem System), abschaltbar |

Das Firmenlogo kommt aus *Einstellungen → Unternehmen/Institution* (Logo und Logo (quadratisch) für die eingeklappte Sidebar).

## Was das Modul einstellt

Beim Aktivieren werden folgende Konstanten gesetzt, **sofern sie noch nicht existieren**:

| Konstante | Wert | beim Deaktivieren |
|---|---|---|
| `MAIN_MENU_STANDARD_FORCED`, `MAIN_MENUFRONT_STANDARD_FORCED` | `kernux_menu.php` | gelöscht |
| `THEME_ELDY_WITDHOFFSET_FOR_REDUC3` | `767` (Umbruch auf mobile Ansicht) | gelöscht |
| `THEME_FONT_FAMILY` | `Fira Sans` | bleibt |
| `THEME_SHOW_BORDER_ON_INPUT` | `1` | bleibt |
| `THEME_DARKMODEENABLED` | `1` | bleibt |

Die letzten drei sind normale Anzeige-Einstellungen, die auch vorher schon gesetzt sein können. Sie bleiben
beim Deaktivieren stehen, damit eigene Einstellungen nicht verloren gehen, und lassen sich unter
*Einstellungen → Benutzeroberfläche* ändern. Nach dem Deaktivieren hat Dolibarr wieder das obere Menü und das
normale eldy-Aussehen (ggf. Strg+F5).

## Grenzen

- Das Modul gestaltet Dolibarr über CSS. Seiten mit sehr eigenem Markup (manche Fremdmodule) übernehmen die Optik
  eventuell nur teilweise.
- Der alte jQuery-Mobile-Modus (`dol_use_jmobile`) wird nicht unterstützt.
- Inoffizielles Modul: nicht vom KERN-UX-Team herausgegeben oder geprüft. Es nutzt die veröffentlichten
  Design-Tokens, bildet aber nicht alle KERN-Komponenten nach.

## Entwicklung

- `core/menus/standard/kernux_menu.php` – Menü-Handler (Sidebar, Einklappen, Logo), nutzt `eldy.lib.php`
- `css/kernux.css` – Gestaltung; KERN UX wird als CSS-Layer eingebunden, damit dessen globales Reset eldy nicht
  überschreibt
- `vendor/kern/` – KERN UX (`@kern-ux/native`, unverändert, Version in `vendor/kern/VERSION`)

**KERN UX aktualisieren**: `dist/kern.min.css`, `dist/fonts/fira-sans.css` und `dist/fonts/fira-sans/` aus dem
npm-Paket `@kern-ux/native` nach `vendor/kern/` kopieren und `VERSION` anpassen.

**Release-ZIP bauen** (enthält nur die Moduldateien, gesteuert über `.gitattributes`):

```bash
git archive --format=zip --prefix=kernux/ -o module_kernux-1.0.1.zip v1.0.1
```

## Autor

Michael Plas (Michi91)

## Lizenz

GPL-3.0-or-later, siehe [LICENSE](LICENSE).

Mitgeliefert werden:

- **KERN UX** (`vendor/kern/`) unter der **EUPL-1.2**, siehe [vendor/kern/LICENSE.md](vendor/kern/LICENSE.md)
- **Fira Sans** (`vendor/kern/fonts/fira-sans/`) unter der **SIL Open Font License 1.1**, siehe
  [OFL.txt](vendor/kern/fonts/fira-sans/OFL.txt)
