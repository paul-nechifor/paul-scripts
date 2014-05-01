<?php
function afiseazaFooter()
{
	print '
	</div>	
	<div id="meniu">
		<div id="meniu_titlu">Meniu</div>
		<ul id="lista_linkuri">
			<li><a href="/despre_sait.php" id="despre_sait"><span class="ascunde">Despre sait</span></a></li>
			<li><a href="/php/index.php" id="php"><span class="ascunde">PHP</span></a></li>
			<li><a href="/flash/index.php" id="flash"><span class="ascunde">Flash</span></a></li>
			<li><a href="/python/index.php" id="python"><span class="ascunde">Python</span></a></li>
			<li><a href="/imagini/index.php" id="imagini"><span class="ascunde">Imagini</span></a></li>
			<li><a href="/pareri/index.php" id="pareri"><span class="ascunde">P&#259;reri</span></a></li>
			<li><a href="/linkuri.php" id="linkuri"><span class="ascunde">Link-uri</span></a></li>
		</ul>
		<div id="butoane_titlu">Butoane</div>
		<ul id="lista_butoane">
			<li><a href="http://validator.w3.org/check?uri=referer"><img src="/img/btn/xhtml.png" alt="valid XHTML 1.0" /></a></li>
			<li><a href="http://jigsaw.w3.org/css-validator/validator?uri=http%3A%2F%2Fpaulscripts.iad.ro%2Fcss%2Fstyle.css&warning=1&profile=css21&usermedium=all"><img src="/img/btn/css.png" alt="valid CSS" /></a></li>
			<li><a href="http://www.mozilla.com/en-US/firefox/"><img src="/img/btn/spread_firefox.png" alt="ia-ti Firefox" /></a></li>
			<li><a class="statcounter" href="http://www.statcounter.com/"><img class="statcounter" src="http://c26.statcounter.com/counter.php?sc_project=2604775&java=0&security=16c4854a&invisible=0" alt="web metrics" /></a></li>
		</ul>
	</div>
</div>
<div id="footer">
	<div id="copyright">
		Copyright &copy; 2007 <em>Paul Nechifor</em>
	</div>

</div>
</div>
<!-- Start of StatCounter Code -->
<script type="text/javascript">
var sc_project=2604775; 
var sc_invisible=0; 
var sc_partition=25; 
var sc_security="16c4854a"; 
</script>
<!-- End of StatCounter Code -->
</body>
</html>';
}
?>