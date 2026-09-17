<?php
/* Copyright (C) 2026 Michael Plas (Michi91)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 */

/**
 * \file    kernux/core/modules/modKernUX.class.php
 * \ingroup kernux
 * \brief   Descriptor of module KERN UX (KERN UX look + main menu as left sidebar)
 */
include_once DOL_DOCUMENT_ROOT.'/core/modules/DolibarrModules.class.php';

/**
 * Module descriptor for KERN UX
 */
class modKernUX extends DolibarrModules
{
	/**
	 * Constructor
	 *
	 * @param DoliDB $db Database handler
	 */
	public function __construct($db)
	{
		$this->db = $db;
		$this->numero = 450100;
		$this->rights_class = 'kernux';
		$this->family = 'other';
		$this->module_position = '90';
		$this->name = preg_replace('/^mod/i', '', get_class($this));
		$this->description = 'User interface in the style of the KERN UX design system, main menu as left sidebar';
		$this->editor_name = 'Michael Plas (Michi91)';
		$this->editor_url = 'https://github.com/MichaelSalp/dolibarr-kernux';
		$this->version = '1.0.0';
		$this->const_name = 'MAIN_MODULE_'.strtoupper($this->name);
		$this->picto = 'kernux.svg@kernux';

		$this->module_parts = array(
			'menus' => 1,
			'css' => array('/kernux/css/kernux.css'),
		);

		$this->dirs = array();
		$this->config_page_url = array();
		$this->depends = array();
		$this->requiredby = array();
		$this->conflictwith = array();
		$this->langfiles = array('kernux@kernux');
		$this->phpmin = array(7, 4);
		$this->need_dolibarr_version = array(24, 0);

		// Only inserted when not set yet. Index 6 = delete on deactivation: only for the values that belong to this module,
		// display settings a user may have chosen before stay untouched.
		$this->const = array(
			// FORCED variants win over MAIN_MENU_STANDARD
			array('MAIN_MENU_STANDARD_FORCED', 'chaine', 'kernux_menu.php', 'Set by module KERN UX', 0, 'current', 1),
			array('MAIN_MENUFRONT_STANDARD_FORCED', 'chaine', 'kernux_menu.php', 'Set by module KERN UX', 0, 'current', 1),
			// Fixed breakpoint where eldy turns the sidebar into a toggled overlay (default depends on top menu count)
			array('THEME_ELDY_WITDHOFFSET_FOR_REDUC3', 'chaine', '767', 'Set by module KERN UX', 0, 'current', 1),
			// eldy prepends this to its font list everywhere it sets font-family
			array('THEME_FONT_FAMILY', 'chaine', 'Fira Sans', 'Set by module KERN UX', 0, 'current', 0),
			array('THEME_SHOW_BORDER_ON_INPUT', 'chaine', '1', 'Set by module KERN UX', 0, 'current', 0),
			// 1 = eldy dark variables follow prefers-color-scheme, like the KERN tokens
			array('THEME_DARKMODEENABLED', 'chaine', '1', 'Set by module KERN UX', 0, 'current', 0),
		);

		$this->rights = array();
		$this->menu = array();
	}
}
