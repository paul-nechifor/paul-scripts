<?php

function afiseazaAntet($titlu, $descriere, $cuvinteCheie)
{
	if ($titlu=='') $titlu = 'Paul Scripts';
	if ($descriere=='') $descriere = 'Saitul personal al lui Paul Nechifor pe care se afla scripturi PHP, Python si Actionscript dar si altele.';
	if ($cuvinteCheie=='') $cuvinteCheie = 'Paul Nechifor, Paul Scripts, sait personal, script, PHP, Python, Flash, ActionScript, XML, XHTML, CSS, programe, jocuri';
	
	print '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ro">
<head>
	<title>'.$titlu.'</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="Paul Nechifor" />
	<meta name="copyright" content="&copy; 2007 Paul Nechifor" />
	<meta name="description" content="'.$descriere.'" />
	<meta name="keywords" content="'.$cuvinteCheie.'" />
	<meta name="generator" content="Scris cu m&acirc;inile" />
	<meta name="editor" content="Dreamweaver 8" />
	<meta name="robots" content="all" />
	<meta name="date" content="'  .date('Y-m-d') . 'T' . date('H:i:s').'+02:00'.  '" />
	<link type="text/css" rel="stylesheet" media="screen" href="/paul-scripts/css/style.css" /> 
	<link type="text/css" rel="stylesheet" media="screen" href="/paul-scripts/css/position.css" />
	<link type="image/png" href="/paul-scripts/favicon.png" rel="shortcut icon" />
</head>

<body>
<div id="root">
<div id="header">
	<h1>Paul Scripts</h1>
</div>

<div id="box">
	<div id="continut">
';
}
?>
