<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class MY_Lang extends CI_Lang
{
	function __construct()
	{
        parent::__construct();
	}
	
	/**
	 * Load a language file
	 * Modified to take the config->default_language in account
	 *
	 * @access	public
	 * @param	mixed	the name of the language file to be loaded. Can be an array
	 * @param	string	the language (english, etc.)
	 * @param	boolean	value to return : FALSE by default
	 * @return	mixed
	 */
	function load($langfile = '', $idiom = '', $return = FALSE, $add_suffix = TRUE, $alt_path = '')
	{
		$CI =& get_instance();
		
		// Remove extension
		$langfile = str_replace(EXT, '', str_replace('_lang.', '', $langfile)).'_lang';

		if (in_array($langfile, $this->is_loaded, TRUE))
			return FALSE;

		if ($idiom == '')
		{
			if (isset($CI->config))
			{
				$deft_lang = $CI->config->item('detected_lang_code');
				$idiom = ($deft_lang == '') ? $CI->config->item('default_lang_code') : $deft_lang;
			}
			// So Installer can output CI errors through MY_Language
			else
			{
				$idiom = 'english';
			}
		}

		// find the files to load, allow extended lang files
		$files = Finder::find_file($idiom . '/' . $langfile, 'language', 99);
		/*
		if(empty($files))
		{
			// Try with the last defualt language... 
			$idiom = $CI->config->item('language');
			$files = Finder::find_file($idiom . '/' . $langfile, 'language', 99);
		}
		*/
		
		// reverse the array, so we let the extending language files load last
		foreach(array_reverse($files) as $f)
		{
			include $f;
		}
		// End addition
		
		if ( ! isset($lang))
		{
			log_message('error', 'Language file contains no data: language/'.$idiom.'/'.$langfile);
			return FALSE;
		}
		
		if ($return == TRUE)
		{
			return $lang;
		}
		
		$this->is_loaded[] = $langfile;
		$this->language = array_merge($this->language, $lang);
		unset($lang);

		log_message('debug', 'Language file loaded: language/'.$idiom.'/'.$langfile);
		return TRUE;
	}


	/**
	 * Fetch a single line of text from the language array
	 * Modified : the original method doesn't log the key of the not found language key.
	 *
	 * @access	public
	 * @param	string	$line	the language line
	 * @return	string
	 */
	function line($line = '')
	{
		$returned_line = ($line == '' OR ! isset($this->language[$line])) ? FALSE : $this->language[$line];

		// Because killer robots like unicorns!
		if ($returned_line === FALSE)
		{
			log_message('error', 'Could not find the language line "'.$line.'"');
		}

		return $returned_line;
	}

}

