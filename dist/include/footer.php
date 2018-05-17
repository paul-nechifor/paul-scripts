<?php
function afiseazaFooter()
{
	print '
	</div>
	<div id="meniu">
		<div id="meniu_titlu">Meniu</div>
		<ul id="lista_linkuri">
			<li><a href="/paul-scripts/despre_sait.php" id="despre_sait"><span class="ascunde">Despre sait</span></a></li>
			<li><a href="/paul-scripts/php/" id="php"><span class="ascunde">PHP</span></a></li>
			<li><a href="/paul-scripts/flash/" id="flash"><span class="ascunde">Flash</span></a></li>
			<li><a href="/paul-scripts/python/" id="python"><span class="ascunde">Python</span></a></li>
			<li><a href="/paul-scripts/imagini/" id="imagini"><span class="ascunde">Imagini</span></a></li>
			<li><a href="/paul-scripts/pareri/" id="pareri"><span class="ascunde">P&#259;reri</span></a></li>
			<li><a href="/paul-scripts/linkuri.php" id="linkuri"><span class="ascunde">Link-uri</span></a></li>
		</ul>
		<div id="butoane_titlu">Butoane</div>
		<ul id="lista_butoane">
			<li><a href="http://validator.w3.org/check?uri=referer"><img src="/paul-scripts/img/btn/xhtml.png" alt="valid XHTML 1.0" /></a></li>
			<li><a href="http://jigsaw.w3.org/css-validator/validator?uri=http%3A%2F%2Fpaulscripts.iad.ro%2Fcss%2Fstyle.css&warning=1&profile=css21&usermedium=all"><img src="/paul-scripts/img/btn/css.png" alt="valid CSS" /></a></li>
			<li><a href="http://www.mozilla.com/en-US/firefox/"><img src="/paul-scripts/img/btn/spread_firefox.png" alt="ia-ti Firefox" /></a></li>
		</ul>
	</div>
</div>
<div id="footer">
	<div id="copyright">
		Copyright &copy; 2007 <em>Paul Nechifor</em><br>
    <small><a href="/">Home</a> &bull; <a href="/blog">Blog</a> &bull; <a href="/projects">Projects</a> &bull; <a href="https://twitter.com/PaulNechifor">Twitter</a></small>
	</div>

</div>
</div>
</body>
</html>';
}
?>
