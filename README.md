![KERN UX für Dolibarr](https://raw.githubusercontent.com/MichaelSalp/dolibarr-kernux/main/docs/logo.png)

# KERN UX für Dolibarr

[![Version](https://img.shields.io/github/v/release/MichaelSalp/dolibarr-kernux?label=Version)](https://github.com/MichaelSalp/dolibarr-kernux/releases)
[![Downloads](https://img.shields.io/github/downloads/MichaelSalp/dolibarr-kernux/total?label=Downloads&cacheSeconds=3600)](https://github.com/MichaelSalp/dolibarr-kernux/releases)
[![Lizenz](https://img.shields.io/github/license/MichaelSalp/dolibarr-kernux?label=Lizenz&cacheSeconds=3600)](LICENSE)
[![Dolibarr](https://img.shields.io/badge/Dolibarr-%E2%89%A5%2024.0-263c5c)](https://www.dolibarr.org)
[![PHP](https://img.shields.io/badge/PHP-%E2%89%A5%207.4-777bb4)](https://www.php.net)

Ein Dolibarr-Modul auf Basis des **KERN Design-Systems**
([kern-ux-plain](https://gitlab.opencode.de/kern-ux/kern-ux-plain) /
npm-Paket [`@kern-ux/native`](https://www.npmjs.com/package/@kern-ux/native)). Es gestaltet die Oberfläche von
Dolibarr im Stil von KERN und verlegt das **Hauptmenü von oben in eine linke Sidebar**.

KERN ist ein Open-Source-Designsystem der öffentlichen Verwaltung, initiiert von den Ländern
**Hamburg und Schleswig-Holstein** und heute länderübergreifend weiterentwickelt – von der kommunalen bis zur
Bundesebene. Sein erklärtes Ziel ist ein digital zugänglicher Staat: barrierefrei, transparent und intuitiv
nutzbar. Genau dafür steht KERN unter der European Union Public Licence: damit Verwaltungen es nachnutzen können.

Dieses Modul ist eine solche Nachnutzung. Es bindet das **KERN-Kit unverändert** ein und übersetzt das von
Dolibarr erzeugte Markup auf die KERN-Designtokens. Am Dolibarr-Kern wird nichts geändert; das Modul bringt einen
eigenen Menü-Handler und ein Stylesheet mit und lässt sich jederzeit wieder abschalten.

> Es handelt sich um ein nachgenutztes, nicht um ein offizielles Angebot des KERN-Projekts oder eines Landes.

![Startseite](https://raw.githubusercontent.com/MichaelSalp/dolibarr-kernux/main/docs/screenshots/start.png)

## Download

### [➜ module_kernux-1.0.3.zip herunterladen](https://github.com/MichaelSalp/dolibarr-kernux/releases/download/v1.0.3/module_kernux-1.0.3.zip)

**Version 1.0.3** · [Release-Notizen](https://github.com/MichaelSalp/dolibarr-kernux/releases/tag/v1.0.3) ·
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
- Es werden die KERN-Designtokens genutzt; KERN-Komponenten wie Kopfzeile, Dialog oder Accordion werden nicht
  nachgebildet, weil Dolibarr dafür eigenes Markup erzeugt.

## Barrierefreiheit

Barrierefreiheit ist der Grund, aus dem KERN existiert – und der Grund, aus dem dieses Modul das Kit
**unverändert** einbindet: Farben, Kontraste und Schrift kommen aus den KERN-Designtokens. Für öffentliche
Stellen sind die [BITV 2.0](https://www.gesetze-im-internet.de/bitv_2_0/) bzw. die
[EN 301 549](https://www.etsi.org/deliver/etsi_en/301500_301599/301549/) verbindlich; beide verweisen auf die
[WCAG 2.1 auf Stufe AA](https://www.w3.org/Translations/WCAG21-de/).

Was das Modul selbst beiträgt: eine benannte Hauptnavigation, `aria-current` am aktiven Bereich,
`aria-expanded` am Einklapp-Schalter, dekorative Icons als `aria-hidden`, ein aktiver Menüpunkt, der nicht nur
über Farbe erkennbar ist (fett und hinterlegt), durchgängig sichtbarer Fokus über `:focus-visible` und ein
Hell-/Dunkel-Modus aus den KERN-Token.

**Was außerhalb des Moduls liegt:** Seitenstruktur, Tabellen und Formulare erzeugt Dolibarr selbst. Das Modul
ändert ihre Darstellung, nicht ihr Markup – eine vollständig barrierefreie Dolibarr-Oberfläche kann es allein
nicht herstellen. Eine eigene *Farbe für Hyperlinks* wird unverändert als Akzent übernommen; ihren Kontrast
(mindestens 4,5:1) bitte selbst prüfen.

Gemeldete Barrieren im Modul sind willkommen – bitte als
[Issue](https://github.com/MichaelSalp/dolibarr-kernux/issues).

## Grundidee

| Schicht | Aufgabe | Wird aktualisiert via |
|---|---|---|
| `vendor/kern/` | Das **unveränderte** KERN-Kit (CSS, Schrift Fira Sans) | Kopieren aus `@kern-ux/native` |
| `css/kernux.css` | Brücke: übersetzt das Dolibarr-Markup (Theme eldy) auf KERN-Tokens | manuell (Modulpflege) |
| `core/menus/standard/kernux_menu.php` | Menü-Handler: Sidebar, Einklappen, Logo (nutzt `eldy.lib.php`) | manuell (Modulpflege) |
| `core/modules/modKernUX.class.php` | Modul-Deskriptor | manuell (Modulpflege) |

> **Wichtig:** In `vendor/kern/` wird **nichts von Hand geändert**. Eigene Anpassungen gehören ausschließlich in
> `css/kernux.css` – so bleiben KERN-Updates konfliktfrei. Das Kit wird als CSS-Layer eingebunden, damit sein
> globales Reset das Dolibarr-Theme nicht überschreibt. Modul-eigene Klassen tragen das Präfix `kux-*`, um
> Kollisionen mit künftigen KERN-Updates auszuschließen.

## Entwicklung

**KERN UX aktualisieren**: `dist/kern.min.css`, `dist/fonts/fira-sans.css` und `dist/fonts/fira-sans/` aus dem
npm-Paket `@kern-ux/native` nach `vendor/kern/` kopieren (mitsamt `LICENSE.md`) und `VERSION` anpassen.

**Release-ZIP bauen** (enthält nur die Moduldateien, gesteuert über `.gitattributes`):

```bash
git archive --format=zip --prefix=kernux/ -o module_kernux-1.0.3.zip v1.0.3
```

## Autor

Michael Plas (Michi91)

## Lizenz

- Modul-Code: GNU GPL v3 oder später, siehe [LICENSE](LICENSE).
- Eingebundenes KERN-Kit (`vendor/kern/`): EUPL-1.2 – siehe
  [vendor/kern/LICENSE.md](vendor/kern/LICENSE.md).
- Schrift Fira Sans (`vendor/kern/fonts/fira-sans/`): SIL Open Font License 1.1 – siehe
  [OFL.txt](vendor/kern/fonts/fira-sans/OFL.txt).

**Zur Kombination beider Lizenzen:** Die EUPL-1.2 führt in ihrem Anhang die GNU GPL v2 und v3 ausdrücklich als
*kompatible Lizenzen*. Die Kompatibilitätsklausel in Artikel 5 erlaubt, eine Bearbeitung, die auf einem EUPL-Werk
und einem Werk unter einer kompatiblen Lizenz beruht, unter den Bedingungen dieser kompatiblen Lizenz zu
verbreiten. Das Gesamtpaket ist daher unter der GPL v3 verbreitbar.

Die Pflichten der EUPL bleiben davon unberührt und werden eingehalten: Die Lizenz- und Urheberrechtshinweise des
Kits liegen unverändert unter `vendor/kern/` bei (bitte **nicht entfernen**), der Quellcode ist öffentlich
zugänglich, und das Kit wird nicht verändert.

**Bildwortmarke / Dachmarke:** Die Bildwortmarke (Bundesadler mit dem Schriftzug *Bund Länder Kommunen*) ist ein
hoheitliches Zeichen und nicht Teil von KERN unter EUPL. Das Modul enthält sie nicht – bitte auch in Forks keine
hinzufügen. Details unter
[kern-ux.de/komponenten/bildwortmarke](https://www.kern-ux.de/komponenten/bildwortmarke/).

KERN wurde von den Ländern Hamburg und Schleswig-Holstein initiiert und wird länderübergreifend weiterentwickelt.
Mehr unter [kern-ux.de](https://www.kern-ux.de).
