<?php
#=================================================================#
#   DENUMIRE:       Generator de nume                             #
#   VERSIUNE:       0.4                                           #
#   AUTOR:          Angra Mainyu <medoxis@gmail.com>              #
#   TERMINARE:      2006-06-19 19:44                              #
#   LICENTA:        GPL (probabil)                                #
#   COMENTARIU:     Un program care sa genereze un nume (defapt   #
#                   mai multe) de genul celor care se  folosesc   #
#                   in jocurile RPG.                              #
#=================================================================#

/*
SCHIMBARI:

Versiunea 0.3:
	-vocalele si consoarele sunt string in loc de vector de caractere (duh!!)
Versiunea 0.4:
	-CSS Style
	-numar de denumiri sa fie generate


VIITOR:
	-o functie care sa aleaga dintr-un sir de caractere in functie de sansa data
		(o idee ar fi sa multiplic litera intr-un string in functie de sansa, str_suffle 
		si sa aleg la intamplare. Cred ca este cam costisitor, totusi, si nu e portabila la numere [decat daca fac cu vector] )
	-o conditie care sa dubleze o litera (ex din Fibonaci in Fibonacci)
	-sa accepte input variabil 
*/ 

define ('MAX_LITERE', 10);
define ('MIN_LITERE', 3);
define ('CONS_IN_SIL', 2);
define ('CU_APOSTROF', false);

function litera_aleatoare ($set)
{
	$nr = mt_rand (0, strlen($set)-1);
	return $set[$nr];
}
function silaba_aleatoare()
{
	$vocale = 'aeiouy';
	$consoane = 'bcdfghjklmnpqrstvwxz';
	$silaba = '';
	$cons = mt_rand (0, CONS_IN_SIL );
	for ($i=0; $i<$cons; $i++)
		$silaba .= litera_aleatoare($consoane);
	$silaba .= litera_aleatoare($vocale);
	str_shuffle($silaba);
	return $silaba;	
}
function nume_aleator()
{
	//procentul de probabilitate.
	$sansa = array ( 1 => 5,   2 => 15,   3 => 31,   4 => 20,
	                 5 => 15,   6 => 9,   7 => 4,    8 => 1   ); 			
	$procent = mt_rand (1, 100);
	$suma = 0;
	for ($i=1; $i<=count($sansa); $i++)
		if ( $procent <= ($suma += $sansa[$i]) ) 
		{
			$silabe = $i;
			break;
		}
	$apostrof = false;
	$cuvant = '';
	for ($i=0; $i<$silabe; $i++)
	{
		$cuvant .= silaba_aleatoare();
		//daca este singurul si nu este la prima silaba, dar nici ultima. Are sansa 1 din 10
		if ( CU_APOSTROF && !$apostrof && $i+1 < $silabe && $i>1 && (mt_rand (1,10) == 9) )
		{
			$cuvant .= "'";
			$apostrof = true;
		}	
	}	
	$cuvant = ucfirst($cuvant);
	return  $cuvant;
}
function valid($nume)
{
	$valid = true;
	if (strlen($nume) < MIN_LITERE) $valid = false;
	elseif (strlen($nume) > MAX_LITERE) $valid = false;
	return $valid;
}
function nume($nr)
{
	echo '<ul style="list-style:none; margin:0; padding:0;">';
	for ($i=0; $i<$nr; $i++)
	{
		$nume = '';
		do
		{
			$nume = nume_aleator();
		} 
		while (!valid($nume));
		echo "<li>$nume</li>";
	}	
	echo '</ul>';
}