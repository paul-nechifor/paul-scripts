<?php
require '../include/antet.php';
afiseazaAntet('P&#259;reri (Paul Scripts)', '', '');
?>

<div id="titlu">
	<h2 id="pareri_titlu">P&#259;reri</h2>
</div>
<div id="scris">

<p>Aici po&#355;i s&#259;-&#355;i spui p&#259;rerea despre scripturile, imaginile &#351;i design-ul saitului sau orice altceva ce se afl&#259; pe el.</p>

<?php
require 'clasa_parere.php';

try
{
	if (isset($_POST['codul']))
	{
		Parere::adaugaParere($_POST['rasp'], $_POST['nume'], $_POST['sait'], date('Y-m-d').'T'.date('H:i:s'),
				 $_SERVER['REMOTE_ADDR'], $_POST['mesaj'], $_POST['codul'], $_POST['verif']);
	}
	
	Parere::afiseazaPareri();
	$codul = Parere::inc(Parere::cod());

	?><form class="scrie_parere" method="post" target="<?=$_SERVER['PHP_SELF']?>">
		<div class="muhaha">
			<div class="textul"><p>Nume:</p></div>
			<div class="input"><input type="text" name="nume" /></div>
		</div>
		<div class="muhaha">
			<div class="textul"><p>Sait:</p></div>
			<div class="input"><input type="text" name="sait" /></div>
		</div>
		<div class="muhaha">
			<div class="textul"><p>R&#259;spuns la:</p></div>
			<div class="input"><input type="text" id="rasp" name="rasp" /></div>
		</div>
		<div class="muhaha">
			<div class="textul"><p>Mesaj:</p></div>
			<div class="input"><textarea name="mesaj"></textarea></div>
		</div>
		<div class="muhaha">
			<div class="textul">
				<p>Verificare:<br />
				<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="59" height="24" id="fcapcha">
					<param name="allowScriptAccess" value="sameDomain" />
					<param name="movie" value="fcapcha.swf" />
					<param name="FlashVars" value="codul=<?=$codul ?>" />
					<param name="quality" value="high" />
					<embed src="fcapcha.swf" FlashVars="codul=<?=$codul ?>" quality="high" width="59" height="24" name="fcapcha" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
				</object></p>
				<input type="hidden" name="codul" value="<?=$codul ?>" />
			</div>
			<div class="input"><input type="text" name="verif" /></div>
		</div>
		<div style="width:120px; margin:0 auto">
			<input type="submit" name="tra-la-la" value="Trimite mesaj" style="width:120px"/>
		</div>
	</form><?php
} 
catch (Exceptie $e)
{
    $e->afiseaza();
}

?>

</div>
<?php
require '../include/footer.php';
afiseazaFooter();
?>