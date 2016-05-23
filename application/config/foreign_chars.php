<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Copyright (c)2016, Jenmar "Maco" Cortes
 * Copyright TechDepot PH
 * All Rights Reserved
 * 
 * This license is a legal agreement between you and the Maco Cortes
 * for the use of ALUMNI INFORMATION SYSTEM referred to as the "Software"
 * By obtaining the Software you agree to comply with the terms and conditions of this license.
 *
 * PERMITTED USE
 * With approval from Maco Cortes, You are permitted to use the program for educational purposes only.
 * 
 * MODIFICATION AND REDISTRIBUTION 
 * Unless with written approval obtained from Maco Cortes, 
 * You are NOT allowed to modify, copy, redistribute, and sell the Software.
 *
 * For any concerns, you may reach Maco Cortes via:
 * maco.techdepot@gmail.com
 * facebook.com/Maaacoooo
 * maco@techdepot-ph.com
 * TechDepot-PH.com
 */

/*
| -------------------------------------------------------------------
| Foreign Characters
| -------------------------------------------------------------------
| This file contains an array of foreign characters for transliteration
| conversion used by the Text helper
|
*/
$foreign_characters = array(
	'/ä|æ|ǽ/' => 'ae',
	'/ö|œ/' => 'oe',
	'/ü/' => 'ue',
	'/Ä/' => 'Ae',
	'/Ü/' => 'Ue',
	'/Ö/' => 'Oe',
	'/À|Á|Â|Ã|Ä|Å|Ǻ|Ā|Ă|Ą|Ǎ/' => 'A',
	'/à|á|â|ã|å|ǻ|ā|ă|ą|ǎ|ª/' => 'a',
	'/Ç|Ć|Ĉ|Ċ|Č/' => 'C',
	'/ç|ć|ĉ|ċ|č/' => 'c',
	'/Ð|Ď|Đ/' => 'D',
	'/ð|ď|đ/' => 'd',
	'/È|É|Ê|Ë|Ē|Ĕ|Ė|Ę|Ě/' => 'E',
	'/è|é|ê|ë|ē|ĕ|ė|ę|ě/' => 'e',
	'/Ĝ|Ğ|Ġ|Ģ/' => 'G',
	'/ĝ|ğ|ġ|ģ/' => 'g',
	'/Ĥ|Ħ/' => 'H',
	'/ĥ|ħ/' => 'h',
	'/Ì|Í|Î|Ï|Ĩ|Ī|Ĭ|Ǐ|Į|İ/' => 'I',
	'/ì|í|î|ï|ĩ|ī|ĭ|ǐ|į|ı/' => 'i',
	'/Ĵ/' => 'J',
	'/ĵ/' => 'j',
	'/Ķ/' => 'K',
	'/ķ/' => 'k',
	'/Ĺ|Ļ|Ľ|Ŀ|Ł/' => 'L',
	'/ĺ|ļ|ľ|ŀ|ł/' => 'l',
	'/Ñ|Ń|Ņ|Ň/' => 'N',
	'/ñ|ń|ņ|ň|ŉ/' => 'n',
	'/Ò|Ó|Ô|Õ|Ō|Ŏ|Ǒ|Ő|Ơ|Ø|Ǿ/' => 'O',
	'/ò|ó|ô|õ|ō|ŏ|ǒ|ő|ơ|ø|ǿ|º/' => 'o',
	'/Ŕ|Ŗ|Ř/' => 'R',
	'/ŕ|ŗ|ř/' => 'r',
	'/Ś|Ŝ|Ş|Š/' => 'S',
	'/ś|ŝ|ş|š|ſ/' => 's',
	'/Ţ|Ť|Ŧ/' => 'T',
	'/ţ|ť|ŧ/' => 't',
	'/Ù|Ú|Û|Ũ|Ū|Ŭ|Ů|Ű|Ų|Ư|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ/' => 'U',
	'/ù|ú|û|ũ|ū|ŭ|ů|ű|ų|ư|ǔ|ǖ|ǘ|ǚ|ǜ/' => 'u',
	'/Ý|Ÿ|Ŷ/' => 'Y',
	'/ý|ÿ|ŷ/' => 'y',
	'/Ŵ/' => 'W',
	'/ŵ/' => 'w',
	'/Ź|Ż|Ž/' => 'Z',
	'/ź|ż|ž/' => 'z',
	'/Æ|Ǽ/' => 'AE',
	'/ß/'=> 'ss',
	'/Ĳ/' => 'IJ',
	'/ĳ/' => 'ij',
	'/Œ/' => 'OE',
	'/ƒ/' => 'f'
);

/* End of file foreign_chars.php */
/* Location: ./application/config/foreign_chars.php */