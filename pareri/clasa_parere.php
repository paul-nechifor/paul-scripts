<?php

require_once "bbcode.inc.php";

class Exceptie extends Exception
{
    public function __construct($message, $code = 0) {
        parent::__construct($message, $code);
    }
	public function afiseaza()
	{
		print '<div class="eroare"><div class="nume"><p>cod: '.$this->code.'</p></div>
		<div class="descriere"><p>'.$this->message.'</p></div></div>';
	}
}

/* XML PARSER inceput */
$pareri = array();
$cur = -1;
function startElement($parser, $name, $attrs)
{
	global $pareri;
	global $cur;
	if ($name == 'PARERE')
	{
		$cur++;
		$pareri[$cur] = $attrs;
	}
}
function endElement($parser, $name) {}
function characterData($parser, $data)
{
	global $pareri;
	global $cur;
	if (strlen($data)>10)
		$pareri[$cur]['MESAJ'] .= $data;
}
function intoarcePareri()
{
	global $pareri;
	$xmlParser = xml_parser_create();
	xml_parser_set_option($xmlParser,XML_OPTION_SKIP_WHITE,1);
	xml_set_element_handler($xmlParser, "startElement", "endElement");
	xml_set_character_data_handler($xmlParser, "characterData");
	$xmlData = file_get_contents('pareri.xml');
	if (!$xmlData) throw new Exceptie('Nu s-a putut deschide fisierul care contine parerile!', 101);
	xml_parse($xmlParser, $xmlData);
	xml_parser_free($xmlParser);
	return $pareri;
}
/* XML PARSER sfarsit */

class Parere
{
	private static $L = array('39','4C','2C','08','74','6F','63','3B','C6','05','21','9A','84','93',
							'14','96','38','BD','62','54','2A','D0','67','55','EB','72');
	private static $pareri = array();
	private static $pareriOrd = array();
	
	public static function cod()
	{
		$c = '';
		for ($i=0; $i<6; $i++)
			$c .= chr(mt_rand(ord('A'), ord('Z')));
		return $c;	
	}
	private static function lit($str)
	{
		for ($i=0; $i<26; $i++)
			if ($str==Parere::$L[$i])
				return chr(65+$i);
	}
	private static function randdhex()
	{
		$ret = '';
		$n = mt_rand(0,15);
		if ($n<10) $ret.=$n; else $ret.=chr(55+$n);
		$n = mt_rand(0,15);
		if ($n<10) $ret.=$n; else $ret.=chr(55+$n);
		return $ret;
	}
	private static function dec($s)
	{
		return Parere::lit($s[6].$s[7]) . Parere::lit($s[12].$s[13]). Parere::lit($s[14].$s[15]).
			Parere::lit($s[18].$s[19]). Parere::lit($s[22].$s[23]). Parere::lit($s[26].$s[27]);
	}
	public static function inc($str)
	{
		$ret = '';
		$ret .= Parere::randdhex();
		$ret .= Parere::randdhex();
		$ret .= Parere::randdhex();
		$ret .= Parere::$L[ord($str[0])-65];
		
		$ret .= Parere::randdhex();
		$ret .= Parere::randdhex();
		$ret .= Parere::$L[ord($str[1])-65];
		$ret .= Parere::$L[ord($str[2])-65];
		
		$ret .= Parere::randdhex();
		$ret .= Parere::$L[ord($str[3])-65];
		$ret .= Parere::randdhex();
		$ret .= Parere::$L[ord($str[4])-65];

		$ret .= Parere::randdhex();
		$ret .= Parere::$L[ord($str[5])-65];
		$ret .= Parere::randdhex();
		$ret .= Parere::randdhex();
		return $ret;
	}
	public static function adaugaParere($rasp, $nume, $sait, $timp, $ip, $mesaj, $codul, $verif)
	{
		$fisierXml = file('pareri.xml');
		if (!$fisierXml) 
			throw new Exceptie("Nu s-a putut deschide fisierul care contine parerile!", 102);
		
		// Verificare
		if (Parere::dec($codul) != $verif)
			throw new Exceptie("Nu ai scris codul de verificare corect!", 107);
		if (strlen($nume)>35 || strlen($nume)<2)
			throw new Exceptie("Numele ('$nume') pe este prea mare sau prea mic!", 103);
		if (strlen($mesaj)<8) 
			throw new Exceptie("Mesajul tau este prea mic.", 105);
		if (strlen($mesaj)>2000) 
			throw new Exceptie("Mesajul tau este prea mare! Poti scrie maxim 2000 de caractere", 106);
		if ($sait != '')
			if (!preg_match('^((ht|f)tp(s?))\://([0-9a-zA-Z\-]+\.)+[a-zA-Z]{2,6}(\:[0-9]+)?(/\S*)?$^', $sait))
				throw new Exceptie("'$sait' nu este un URL valid!", 104);
		$v = explode('"', $fisierXml[count($fisierXml)-2]);
		$sec = time() - Parere::unixTime($v[9]);
		if ($ip == $v[11] && $sec < 600)
			throw new Exceptie("Ultimul mesaj a fost trimis de time ($ip). Trebuie sa astepti 10 minute intre postari. Mai ai de asteptat inca ".(600-$sec)." de secunde", 109);
				
		$nume = htmlspecialchars($nume);
		$raspNr = (int)$rasp;
		$mesaj = str_replace("\r", '', $mesaj);
		$mesaj = str_replace("\n", "[br]", $mesaj);
		$mesaj = str_replace('\"', '"', $mesaj);
		$mesaj = str_replace("\\'", "'", $mesaj);
		$mesaj = htmlentities($mesaj);
		
		$id = count($fisierXml)-2;
		if ($raspNr >= $id || $raspNr < 0)
			throw new Exceptie("Nu exista mesajul cu id-ul '$rasp'!", 108);
		array_pop($fisierXml);
		$deScris = implode('', $fisierXml);
		$deScris .= "<parere id=\"$id\" rasp=\"$raspNr\" nume=\"$nume\" sait=\"$sait\" timp=\"$timp\" ip=\"$ip\"><![CDATA[$mesaj]]></parere>\n</pareri>";
		file_put_contents("pareri.xml", $deScris);
	}
	public static function afiseazaPareri()
	{
		Parere::$pareri = intoarcePareri();		
		Parere::genereazaOrdine(0, 0);

		$bbcode = new bbcode();
		$bbcode->add_tag(array('Name'=>'b','HtmlBegin'=>'<span style="font-weight: bold;">','HtmlEnd'=>'</span>'));
		$bbcode->add_tag(array('Name'=>'i','HtmlBegin'=>'<span style="font-style: italic;">','HtmlEnd'=>'</span>'));
		$bbcode->add_tag(array('Name'=>'u','HtmlBegin'=>'<span style="text-decoration: underline;">','HtmlEnd'=>'</span>'));
		$bbcode->add_tag(array('Name'=>'link','HasParam'=>true,'HtmlBegin'=>'<a href="%%P%%">','HtmlEnd'=>'</a>'));
		$bbcode->add_tag(array('Name'=>'color','HasParam'=>true,'ParamRegex'=>'[A-Za-z0-9#]+','HtmlBegin'=>'<span style="color: %%P%%;">','HtmlEnd'=>'</span>','ParamRegexReplace'=>array('/^[A-Fa-f0-9]{6}$/'=>'#$0')));
		$bbcode->add_tag(array('Name'=>'email','HasParam'=>true,'HtmlBegin'=>'<a href="mailto:%%P%%">','HtmlEnd'=>'</a>'));
		$bbcode->add_tag(array('Name'=>'size','HasParam'=>true,'HtmlBegin'=>'<span style="font-size: %%P%%pt;">','HtmlEnd'=>'</span>','ParamRegex'=>'[0-9]+'));
		$bbcode->add_tag(array('Name'=>'s','HtmlBegin'=>'<span style="text-decoration: line-through;">','HtmlEnd'=>'</span>'));
		$bbcode->add_alias('url','link');
		
		foreach (Parere::$pareriOrd as $i)
		{
			$indent = $i[1]*15;
			$id = Parere::$pareri[(int)$i[0]]['ID'];
			$sait = Parere::$pareri[(int)$i[0]]['SAIT'];
			$nume = Parere::$pareri[(int)$i[0]]['NUME'];	
			if ($sait != '') $nume = "<a href=\"$sait\">$nume</a>";
			$timp = Parere::formatTimp(Parere::$pareri[(int)$i[0]]['TIMP']);
			$mesaj = $bbcode->parse_bbcode( Parere::$pareri[(int)$i[0]]['MESAJ'] );
			$mesaj = str_replace("[br]", "<br />", $mesaj);
			
			?><div class="parere" style="margin-left:<?=$indent?>px">
				<div class="dela"><p>
					<span class="nr"><?=$id?></span>
					<span class="numele">Mesaj de la: <?=$nume?></span>
					<span class="timp"><?=$timp?></span>
				</p></div>
				<div class="mesaj"><p><?=$mesaj?></p></div>
			</div><?php
		}
	}
	private static function genereazaOrdine($nr, $inc)
	{
		for ($i=0; $i<count(Parere::$pareri); $i++)
			if (Parere::$pareri[$i]['RASP']==$nr)
			{
				Parere::$pareriOrd[] = array($i, $inc);
				Parere::genereazaOrdine($i+1, $inc+1);
			}
	}
	private static function formatTimp($timp)
	{
		$timp = explode("T", $timp);
		$data = explode("-", $timp[0]);
		$ora = explode(":", $timp[1]);
		return "{$ora[0]}:{$ora[1]} {$data[2]}.{$data[1]}.{$data[0]}";
	}
	private static function unixTime($timp)
	{
		$timp = explode("T", $timp);
		$data = explode("-", $timp[0]);
		$ora = explode(":", $timp[1]);
		return mktime((int)$ora[0], (int)$ora[1], (int)$ora[2], (int)$data[1], (int)$data[2], (int)$data[0]);
	}
}

?>