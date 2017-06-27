<?php
require '../../include/antet.php';
afiseazaAntet('Gravita&#355;ie (Paul Scripts)', 'Simulator de gravitatie planetara in Flash creat de Paul Nechifor', 'Paul Scripts, Paul Nechifor, Flash, ActionScript, Joc, gravitatie, fizica, newton, planete');
?>
<div id="titlu">
	<h3 class="t_pagina">Gravita&#355;ie</h3>
</div>
<div id="scris">

<p>&#258;sta este un simulator de gravita&#355;ie. Codul surs&#259; define&#351;te clasa Corp care se comport&#259; ca o planet&#259;. Fiecare planet&#259; este ini&#355;ializat&#259; cu urmatoarele propriet&#259;&#355;i:</p>
<ol>
<li><strong>x</strong> ini&#355;ial, care poate fi &icirc;ntre 0 &#351;i 600 de pixeli.</li>
<li><strong>y</strong> ini&#355;ial, la fel &icirc;ntre 0 &#351;i 600 de pixeli (&icirc;n Flash axa Oy este orientat&#259; &icirc;n jos, deci y=0 va fi sus)</li>
<li><strong>masa</strong></li>
<li><strong>diagonala</strong> cercului care va fi reprezenta planeta</li>
<li><strong>for&#355;a</strong> ini&#355;ial&#259; de mi&#351;care a corpului</li>
<li><strong>unghiul</strong> ini&#355;ial de mi&#351;care (0 grade &icirc;nseamn&#259; c&#259; se mi&#351;c&#259; spre dreapta, 90 &icirc;n jos, -90 (sau 270) &icirc;n sus, s.a.m.d.)</li>
</ol>
<p>Corpurile nu se ciocnesc... &icirc;nc&#259;. Probabil am s&#259; fac asta c&acirc;ndva.</p>
<p>Dac&#259; vrei s&#259; creezi un sistem trebuie s&#259; scrii &icirc;n <em>textarea</em> de mai jos pe prima linie valoarea constantei G (care nu este deloc apropiat&#259; de cea real&#259;). Pe urmatoarele linii cele 6 valori de ini&#355;ializare a unui corp separate prin virgul&#259; &#351;i far&#259; niciun spa&#355;iu.</p>

<?php
if (isset($_POST['t'])) $p=str_replace("\r", "", str_replace("\n", ";;;", $_POST['t']));
elseif (isset($_GET['p'])) $p=$_GET['p'];
else $p="10;;;300,300,100,40,0.012,-45;;;300,250,0.05,5,4.46,180;;;405,300,0.2,10,3.09,-90;;;300,475,1,12,2.48,0;;;40,300,0.5,18,1.96,90;;;300,491,0.02,5,3.2,0";
?>

<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
	<p><textarea name="t" cols="60" rows="8"><?php print str_replace(";;;","\n",$p) ?></textarea><br />
	<input type="submit" name="s" value="Atrage" /><br /><br /></p>
</form>



<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="600" height="600" id="Gravitatie" align="middle" style="margin-left:15px;">
<param name="allowScriptAccess" value="sameDomain" />
<param name="movie" value="Gravitatie.swf" />
<param name="FlashVars" value="p=<?=$p ?>" />
<param name="quality" value="high" />
<param name="bgcolor" value="#b56f3c" />
<embed src="Gravitatie.swf" FlashVars="p=<?=$p ?>" quality="high" bgcolor="#b56f3c" width="600" height="600" name="Gravitatie" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>
<form><p>Cod scurt: <input type="text" id="codul" value="<?=$p ?>" style="font-family:'Courier New', Courier, monospace; font-size:11px; width:460px;" /></p></form>

<p>Sisteme interesante:</p>

<ul class="lista_sc">
	<li><a href="<?=$_SERVER['PHP_SELF']?>?p=10;;;300,300,100,40,0.012,-45;;;300,250,0.05,5,4.46,180;;;405,300,0.2,10,3.09,-90;;;300,475,1,12,2.48,0;;;40,300,0.5,18,1.96,90;;;300,491,0.02,5,3.2,0">Un soare, patru planete &#351;i o lun&#259;</a> cel ini&#355;ial</li>
	<li><a href="<?=$_SERVER['PHP_SELF']?>?p=10;;;250,300,20,5,1,90;;;350,300,20,5,1,-90">Doua planete</a> care se una pe alta</li>
	<li><a href="<?=$_SERVER['PHP_SELF']?>?p=10;;;250,300,20,5,1,90;;;350,300,20,5,1,-90;;;300,100,30,10,1.5,0;;;300,500,30,10,1.5,180">Patru planete</a> care se rotesc in cerc</li>
</ul>
<p>Dac&#259; ai f&#259;cut un sistem &#351;i vrei s&#259; apar&#259; pe pagina asta trimite-mi aranjarea planetelor..</p>
<?php
require '../../include/footer.php';
afiseazaFooter();
?>
