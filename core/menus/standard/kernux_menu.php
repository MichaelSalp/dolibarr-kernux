<?php
/* Copyright (C) 2026 Michael Plas (Michi91)
 * Menu loading and the use of eldy.lib.php follow core/menus/standard/eldy_menu.php
 * Copyright (C) 2005-2013 Laurent Destailleur, Regis Houssin and Dolibarr contributors
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 */

/**
 *	\file       kernux/core/menus/standard/kernux_menu.php
 *	\brief      Menu handler KERN UX: top menu entries rendered as left sidebar (reuses eldy.lib.php)
 */


/**
 *	Class to manage menu KERN UX
 *
 *	@phan-suppress PhanRedefineClass
 */
class MenuManager
{
	/**
	 * @var DoliDB Database handler.
	 */
	public $db;

	/**
	 * @var int<0,1>	0 for internal users, 1 for external users
	 */
	public $type_user = 0;

	/**
	 * @var string 		To save the default target to use onto links
	 */
	public $atarget = "";

	/**
	 * @var string 		Menu name
	 */
	public $name = "kernux";

	/**
	 * @var Menu
	 */
	public $menu;

	/**
	 * @var array<mixed>
	 */
	public $menu_array;

	/**
	 * @var array<mixed>
	 */
	public $menu_array_after;

	/**
	 * @var array<mixed>
	 */
	public $tabMenu;


	/**
	 *  Constructor
	 *
	 *  @param	DoliDB		$db     	Database handler
	 *  @param	int<0,1>	$type_user		Type of user
	 */
	public function __construct($db, $type_user)
	{
		$this->type_user = $type_user;
		$this->db = $db;
	}


	/**
	 * Load this->tabMenu (same as eldy)
	 *
	 * @param	string	$forcemainmenu		To force mainmenu to load
	 * @param	string	$forceleftmenu		To force leftmenu to load
	 * @return	void
	 */
	public function loadMenu($forcemainmenu = '', $forceleftmenu = '')
	{
		if (GETPOSTISSET("idmenu")) {
			$_SESSION["idmenu"] = GETPOSTINT("idmenu");
		}

		if (GETPOSTISSET("mainmenu")) {
			$mainmenu = GETPOST("mainmenu", 'aZ09');
			$_SESSION["mainmenu"] = $mainmenu;
			$_SESSION["leftmenuopened"] = "";
		} else {
			$mainmenu = isset($_SESSION["mainmenu"]) ? $_SESSION["mainmenu"] : '';
		}
		if (!empty($forcemainmenu)) {
			$mainmenu = $forcemainmenu;
		}

		if (GETPOSTISSET("leftmenu")) {
			$leftmenu = GETPOST("leftmenu", 'aZ09');
			$_SESSION["leftmenu"] = $leftmenu;

			if (isset($_SESSION["leftmenuopened"]) && $_SESSION["leftmenuopened"] == $leftmenu) {	// To collapse
				$_SESSION["leftmenuopened"] = "";
			} else {
				$_SESSION["leftmenuopened"] = $leftmenu;
			}
		} else {
			$leftmenu = isset($_SESSION["leftmenu"]) ? $_SESSION["leftmenu"] : '';
		}
		if (!empty($forceleftmenu)) {
			$leftmenu = $forceleftmenu;
		}

		require_once DOL_DOCUMENT_ROOT.'/core/class/menubase.class.php';
		$tabMenu = array();
		// Load entries registered for eldy so menus of external modules keep showing
		$menuArbo = new Menubase($this->db, 'eldy');
		$menuArbo->menuLoad($mainmenu, $leftmenu, $this->type_user, 'eldy', $tabMenu);
		$this->tabMenu = $tabMenu;
	}


	/**
	 *  Output menu on screen.
	 *
	 *	@param	'top'|'topnb'|'left'|'leftdropdown'|'jmobile'	$mode			Mode
	 *  @param	?array<string,string>	$moredata	An array with more data to output
	 *  @return int<0,max>				0 or nb of top menu entries if $mode = 'topnb'
	 */
	public function showmenu($mode, $moredata = null)
	{
		global $conf, $langs;

		require_once DOL_DOCUMENT_ROOT.'/core/menus/standard/eldy.lib.php';
		require_once DOL_DOCUMENT_ROOT.'/core/class/menu.class.php';

		if ($this->type_user == 1) {
			$conf->global->MAIN_SEARCHFORM_SOCIETE_DISABLED = 1;
			$conf->global->MAIN_SEARCHFORM_CONTACT_DISABLED = 1;
		}

		$langs->load('kernux@kernux');
		$this->menu = new Menu();

		if ($mode == 'top') {
			// Accent colour: "Link colour" of Setup > Display > Theme, KERN blue when empty
			require_once DOL_DOCUMENT_ROOT.'/core/lib/functions2.lib.php';
			$accent = colorStringToArray(getDolGlobalString('THEME_ELDY_TEXTLINK'), array());
			if (count($accent) == 3) {
				$rgb = 'rgb('.((int) $accent[0]).' '.((int) $accent[1]).' '.((int) $accent[2]).')';
				print '<style>:root{--kern-color-action-default:'.$rgb.';}'
					.'@media (prefers-color-scheme: dark){:root{--kern-color-action-default:color-mix(in oklch, '.$rgb.', white 45%);}}</style>'."\n";
			}

			// Only the hamburger (.menuhider) stays on top: eldy's CSS/JS use it to toggle the sidebar on small screens
			print_eldy_menu($this->db, $this->atarget, $this->type_user, $this->tabMenu, $this->menu, 1, $mode);
			print_start_menu_array();
			foreach ($this->menu->liste as $menuval) {
				if ($menuval['idsel'] == 'menu') {
					print_start_menu_entry($menuval['idsel'], $menuval['classname'], $menuval['enabled']);
					print_text_menu_entry($menuval['titre'], $menuval['enabled'], $menuval['url'], $menuval['id'], $menuval['idsel'], $menuval['classname'], ($menuval['target'] ? $menuval['target'] : $this->atarget), $menuval);
					print_end_menu_entry($menuval['enabled']);
				}
			}
			print_end_menu_array();
		}

		if ($mode == 'left') {
			print_eldy_menu($this->db, $this->atarget, $this->type_user, $this->tabMenu, $this->menu, 1, $mode);
			$mainmenu = empty($_SESSION["mainmenu"]) ? 'home' : $_SESSION["mainmenu"];

			$this->printBrand();

			// Search and bookmarks go on top of the sidebar, not inside the opened area
			if (is_array($moredata) && !empty($moredata['searchform'])) {
				print '<div id="blockvmenusearch" class="blockvmenusearch">'."\n";
				// Static look-alike of the select2 box, shown until select2 has replaced the raw <select> (no flicker on load)
				if (strpos($moredata['searchform'], 'vmenusearchselectcombo') !== false) {
					print '<span class="kux-search-placeholder" aria-hidden="true"><span class="kux-search-placeholder__text"><span class="fa fa-search"></span>'.dol_escape_htmltag($langs->trans("Search")).'</span><b></b></span>';
				}
				print $moredata['searchform']."\n".'</div>'."\n";
			}
			if (is_array($moredata) && !empty($moredata['bookmarks'])) {
				print '<div id="blockvmenubookmarks" class="blockvmenubookmarks">'."\n".$moredata['bookmarks']."\n".'</div>'."\n";
			}

			print '<nav class="kux-nav" aria-label="'.dol_escape_htmltag($langs->trans('KernUXMainMenu')).'">'."\n";
			print '<ul class="kux-nav__list">'."\n";
			foreach ($this->menu->liste as $menuval) {
				if ($menuval['idsel'] == 'menu' || empty($menuval['enabled'])) {
					continue;
				}
				$active = ($menuval['mainmenu'] == $mainmenu);
				$url = (($menuval['url'] != '#' && !preg_match('/^(http:\/\/|https:\/\/)/i', $menuval['url'])) ? DOL_URL_ROOT : '').$menuval['url'];
				$prefix = $menuval['prefix'];
				if (preg_match('/^(fa[rsb]? )?fa-/', $prefix, $reg)) {
					$prefix = '<span class="'.(empty($reg[1]) ? 'fa ' : '').$prefix.' fa-fw"></span>';
				}
				$label = '<span class="kux-nav__icon" aria-hidden="true">'.$prefix.'</span><span class="kux-nav__label">'.ucfirst($menuval['titre']).'</span>';

				print '<li class="kux-nav__item'.($active ? ' kux-nav__item--active' : '').' mainmenu-'.dol_escape_htmltag($menuval['mainmenu']).'">';
				// title is the only label left visible when the sidebar is collapsed to icons
				$title = ' title="'.dol_escape_htmltag(dol_string_nohtmltag($menuval['titre'])).'"';
				if ($menuval['enabled'] == 1) {
					$target = $menuval['target'] ? $menuval['target'] : $this->atarget;
					print '<a class="kux-nav__link" href="'.dol_escape_htmltag($url).'"'.$title.($target ? ' target="'.dol_escape_htmltag($target).'"' : '').($active ? ' aria-current="true"' : '').'>'.$label.'</a>';
				} else {
					print '<span class="kux-nav__link kux-nav__link--disabled"'.$title.'>'.$label.'</span>';
				}
				if ($active) {
					print "\n".'<div class="kux-nav__sub">'."\n";
					$submenu = new Menu();
					print_left_eldy_menu($this->db, $this->menu_array, $this->menu_array_after, $this->tabMenu, $submenu, 0, '', '', null, $this->type_user);
					print '</div>'."\n";
				}
				print '</li>'."\n";
			}
			print '</ul>'."\n";
			print '</nav>'."\n";
		}

		if ($mode == 'leftdropdown') {
			print_left_eldy_menu($this->db, $this->menu_array, $this->menu_array_after, $this->tabMenu, $this->menu, 1, '', '', $moredata, $this->type_user);
		}

		if ($mode == 'topnb') {
			print_eldy_menu($this->db, $this->atarget, $this->type_user, $this->tabMenu, $this->menu, 1, $mode);
			return $this->menu->getNbOfVisibleMenuEntries();
		}

		// 'jmobile' (legacy jQuery Mobile layout) is not supported and outputs nothing

		unset($this->menu);

		return 0;
	}

	/**
	 *  Output sidebar head: company logo (Setup > Company) and the button collapsing the sidebar to icons
	 *
	 *  @return void
	 */
	private function printBrand()
	{
		global $conf, $langs, $mysoc;

		$thumbs = $conf->mycompany->dir_output.'/logos/thumbs/';
		$logourl = function ($file) use ($thumbs) {
			if ($file === '' || !is_readable($thumbs.$file)) {
				return '';
			}
			return dolBuildUrl(DOL_URL_ROOT.'/viewimage.php', ['cache' => 1, 'modulepart' => 'mycompany', 'file' => 'logos/thumbs/'.$file]);
		};
		$logo = $logourl(getDolGlobalString('MAIN_INFO_SOCIETE_LOGO_SMALL'));
		$mark = $logourl(getDolGlobalString('MAIN_INFO_SOCIETE_LOGO_SQUARRED_MINI'));
		$name = (string) $mysoc->name;

		print '<div class="kux-brand'.($logo ? ' kux-brand--haslogo' : '').'">';
		print '<a class="kux-brand__link" href="'.DOL_URL_ROOT.'/index.php?mainmenu=home&amp;leftmenu=home" title="'.dol_escape_htmltag($name).'">';
		if ($logo) {
			print '<img class="kux-brand__logo" src="'.dol_escape_htmltag($logo).'" alt="'.dol_escape_htmltag($name).'">';
		} else {
			print '<span class="kux-brand__name">'.dol_escape_htmltag($name).'</span>';
		}
		if ($mark) {
			print '<img class="kux-brand__mark" src="'.dol_escape_htmltag($mark).'" alt="">';
		} else {
			print '<span class="kux-brand__mark kux-brand__initial" aria-hidden="true">'.dol_escape_htmltag(dol_strtoupper(dol_substr($name ? $name : 'D', 0, 1))).'</span>';
		}
		print '</a>';
		print '<button type="button" class="kux-rail-toggle" aria-expanded="true" title="'.dol_escape_htmltag($langs->trans('KernUXToggleSidebar')).'"><span class="fas fa-angle-double-left" aria-hidden="true"></span><span class="kux-sr-only">'.dol_escape_htmltag($langs->trans('KernUXToggleSidebar')).'</span></button>';
		print '</div>'."\n";
		// Collapsed state is a per-browser convenience, so localStorage is enough
		print '<script>(function(){var h=document.documentElement,k="kernux_rail",b=document.currentScript.previousElementSibling.querySelector(".kux-rail-toggle");'
			.'function set(on){h.classList.toggle("kux-rail",on);b.setAttribute("aria-expanded",on?"false":"true");}'
			.'try{set(localStorage.getItem(k)==="1");}catch(e){}'
			.'b.addEventListener("click",function(){var on=!h.classList.contains("kux-rail");set(on);try{localStorage.setItem(k,on?"1":"0");}catch(e){}});})();</script>'."\n";
	}
}
