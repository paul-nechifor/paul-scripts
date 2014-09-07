<?php
require '../../include/antet.php';
afiseazaAntet('Name Selection 0.5 (Paul Scripts)', 'Generator de nume avansat folosind metoda evolutiei care a fost creat in PHP de Paul Nechifor', 'Paul Scripts, Paul Nechifor, Name selection, NameSelection, selectie nume, PHP script, evolutie, silabe');
?>

<div id="titlu">
	<h3 class="t_pagina">Name Selection 0.5</h3>
</div>
<div id="scris">

<?php
require 'name_selection_0_5.php';

if (isset($_GET['name']))
{
	echo '<p>Muta&#355;ii primare pentru '.NameSelection::afisare($_GET['name']).'</p>';
	echo '<table style="border:0; width:600px; margin: 10px auto 10px auto;"><tr>';
	for ($i=0; $i<4; $i++)
	{
		echo '<td style="width:150px;">';
		for ($j=0; $j<3; $j++)
			print NameSelection::afisare(NameSelection::mutatie($_GET['name'])) . "<br />";
		echo '</td>';
	}
	echo '</tr></table>';
	echo '<p>Arbore de evolu&#355;ie:</p>';

	NameSelection::arbore($_GET['name']);
}
else
{
	?>
	<p>Acest script genereaz&#259; denumiri aleatorii folosind metoda evolu&#355;iei. </p>
	<p>Un cuv&acirc;nt este g&acirc;ndit ca un vector de silabe de forma V, CV, CCV, CCVC, VV, VVV, VC, CVC, CVCC, unde C este o consoan&#259; &#351;i V o vocal&#259;. Fiecare form&#259; de silab&#259; are alt&#259; &#351;ans&#259; de apari&#355;ie. Spre exemplu o silab&#259; CV este 15 ori mai &icirc;nt&acirc;lnit&#259; decat o silab&#259; VVV &icirc;n versiunea curent&#259; a programului. La fel &#351;i literele au &#351;anse diferite de apari&#355;ie. Frecven&#355;a literelor am luat-o din englez&#259;, dar am modificat ni&#351;te valori pentru c&#259; nu cred c&#259; litera &quot;t&quot; ar trebui s&#259; fie de aproximativ 900 mai &icirc;nt&acirc;lnit&#259; dec&acirc;t litera &quot;z&quot;.</p>
	<p>Sunt dou&#259; metode de pornire. Se poate da un nume de &icirc;nceput sau se alege din lista de cuvinte cu dou&#259; silabe generate aleatoriu. Dac&#259; se d&#259; un nume ini&#355;ial, silabele trebuie s&#259; fie separate printr-un <em>underscore</em> (&quot;_&quot;). Toate silabele trebuie s&#259; fie &icirc;ntr-una din formele de mai sus. Ini&#355;ial am vrut s&#259; dau posibilitatea s&#259; se scrie un nume &icirc;ntreg &#351;i s&#259; despart eu &icirc;n silabe automat, dar am renun&#355;at c&acirc;nd am v&#259;zut c&acirc;t de complicate sunt regurile de despar&#355;ire &icirc;n silabe (&#351;i-n rom&acirc;n&#259; &#351;i-n englez&#259;). </p>
	<p>Cine este interesat poate s&#259; se uite peste clasa <a href="source.html">NameSelection</a>.</p>
	<form action="<?= $_SERVER['PHP_SELF']; ?>" method="get">
		<p>Scrie un nume de &icirc;nceput (separ&#259; silabele cu-n <em>underscore</em> &quot;_&quot; )<br />
	  <input type="text" name="name" value="pa_ul" /> <input type="submit" name="mut" value="Mutatie" /></p>
	</form>
	<p>Sau alege din lista urm&#259;toare un nume:</p>
	<table align="center" style="border:0; width:600px;"><tr>
	<?php
	for ($i=0; $i<4; $i++)
	{
		echo '<td width="150">';
		for ($j=0; $j<12; $j++)
			print NameSelection::afisare(NameSelection::silaba()."_".NameSelection::silaba()) . "<br />";
		echo '</td>';
	}	
	echo '</tr></table>';
}
?>

</div>
<?php
require '../../include/footer.php';
afiseazaFooter();
?>
