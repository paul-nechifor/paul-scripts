<?php
require '../../include/antet.php';
afiseazaAntet('Name Generator 0.4 (Paul Scripts)', 'Generator de nume aleatoriu facut in PHP de Paul Nechifor', 'Paul Scripts, Paul Nechifor, Name generator, generator, nume, script php, rpg name');
?>

<div id="titlu">
	<h3 class="t_pagina">Name Generator 0.4</h3>
</div>
<div id="scris">

<p>Acest script genereaz&#259; denumiri proprii. Nu are rezultate foarte bune pentru c&#259; este foarte simplu. Vezi <a href="../name_selection">Name Selection</a> pentru ceva mai avansat.</p>
<p>Func&#355;ia principal&#259; pur &#351;i simplu une&#351;te silabe formate dintr-o vocal&#259; &#351;i de la 0 la 2 consoane. Nu este corect modul de formare a silabelor pentru c&#259; sunt silabe care au 3 vocale &#351;i altele care au chiar 5 litere. &Icirc;n Name Selection procedez altfel. </p>
<form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
	<p>C&acirc;te denumiri : 
	  <input type="text" name="nr" value="100" />&nbsp;&nbsp;&nbsp;
	<input type="submit" name="submit" value="Genereaz&#259;" /></p>
</form>


<?php
require 'name_generator_0_4.php';

if (isset($_POST['nr']))
{
	$nr = $_POST['nr'];
	if ($nr<20 || $nr>2000) echo '<p><strong>Eroare:</strong> Trebuie s&#259; fie un num&#259;r &icirc;ntre 20 &#351;i 2000.</p>';
	else
	{
		echo '<table align="center" style="border:0; width:600px;"><tr>';
		for ($i=0; $i<4; $i++)
		{
			echo '<td>';
			nume(ceil($nr/4));
			echo '</td>';
		}	
		echo '</tr></table>';
	}	
}
?>

</div>
<?php
require '../../include/footer.php';
afiseazaFooter();
?>
