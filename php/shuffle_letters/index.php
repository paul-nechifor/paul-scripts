<?php
require '../../include/antet.php';
afiseazaAntet('Shuffle Letters (Paul Scripts)', 'Un script foarte simpul care amesteca literele dintr-un cuvant creat in PHP de Paul Nechifor', 'Paul Scripts, Paul Nechifor, shuffle letters, amestecare silabe, script PHP');
?>

<div id="titlu">
	<h3 class="t_pagina">Shuffle Letters</h3>
</div>
<div id="scris">


<p>Amestec&#259; literele din centrul unui cuv&acirc;nt. Dac&#259; nu &#351;tiai, cuvintele pot fi citite chiar dac&#259; se amestec&#259; literele din mijloc. Un exemplu ar fi: &quot;<em style="font-family:'Times New Roman', Times, serif">Ttaoe fiin&#355;ele onmee&#351;ti se nsac sbolode &#351;i detprioov&#259; &icirc;n dsoietinice &#351;i  &icirc;n dpurteri. Ele sunt &icirc;nszettrae cu cgeut &#351;i &icirc;n&#355;eeegrle &#351;i tuiebre s&#259;  se protae uelne fa&#355;&#259; de aletle dup&#259; friea fr&#259;&#355;iei</em>&quot; (<a href="http://en.wikipedia.org/wiki/Romanian_language#Language_sample">citatul</a> este luat de pe Wikipedia).</p>

<form name="amestecare" method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
	<div align="center">
		<textarea name="text" rows="10" cols="70"></textarea>
		<p><input type="submit" name="Amesteca" value="Amesteca" /></p>
	</div>
</form>	
	
	<?php
	function litera ($l)
	{
		$este = false;
		for ($i='a'; $i<='z'; $i++)
			if ($l==$i) $este = true;
		for ($i='A'; $i<='Z'; $i++)
			if ($l==$i) $este = true;
		return $este;			
	}
	function amesteca ($cuvant)
	{	
		if (strlen($cuvant)<4) return $cuvant;
		else
		{
			//Hraneste generatorul o singura data, indiferent de cate ori este "called"
			if (!isset($randinit))
				{
					mt_srand((double) microtime() * 1000000);
					static $randinit = 1;
				}
			$distanta = 3; //distanta poate un caracter sa se mute
			for ($i=1; $i<=strlen($cuvant)-1; $i++)
			{
				while ($i+$distanta > strlen($cuvant)-2) 
					$distanta--;
				$r = mt_rand ($i, $i+$distanta);
				//inlocuieste valorile
				$aux = $cuvant{$i};
				$cuvant{$i} = $cuvant{$r};
				$cuvant{$r} = $aux;		
			}
			return $cuvant;
		}	
	}
	$afara = NULL;
	$cuvant = NULL;
	print "<br />";
	if (isset($_POST['text']))
	{
		$text = $_POST['text'].".";
		for ($i=0; $i<strlen($text); $i++)
		{
			if ( litera($text{$i}) ) $cuvant .= $text{$i};
			else 
			{
				$afara .= amesteca ($cuvant) . $text{$i};
				$cuvant = NULL;
			}		
		}
		print "<br /><p>Rezultatul este:</p><p>". $afara . "</p>";
	}
	?>


</div>
<?php
require '../../include/footer.php';
afiseazaFooter();
?>
