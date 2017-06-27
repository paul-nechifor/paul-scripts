<?php
require '../../include/antet.php';
afiseazaAntet('phpBB Users (Paul Scripts)', 'Script Python pentru descarcarea nick-urilor de pe un forum phpBB creat de Paul Nechifor', 'Paul Scripts, Paul Nechifor, phpBB, forum , memberlist.php, descarcare');
?>

<div id="titlu">
	<h3 class="t_pagina">phpBB Users</h3>
</div>
<div id="scris">

<p>Descarc&#259; de pe internet nick-urile tutoror utilizatorilor de pe un forum phpBB folosind <code>urllib</code>, &#351;i le scrie &icirc;ntr-un fi&#351;ier specificat.</p>

<div class="highlight"><pre><span class="k">import</span> <span class="nn">urllib</span><span class="o">,</span> <span class="nn">time</span>

<span class="k">def</span> <span class="nf">usernames</span><span class="p">(</span><span class="nb">str</span><span class="p">,</span> <span class="n">start</span><span class="o">=</span><span class="s">&#39;&quot; class=&quot;gen&quot;&gt;&#39;</span><span class="p">,</span> <span class="n">end</span><span class="o">=</span><span class="s">&#39;&lt;/a&gt;&lt;/span&gt;&lt;/td&gt;&#39;</span><span class="p">):</span>
    <span class="n">i</span> <span class="o">=</span> <span class="mi">0</span>
    <span class="n">adaug</span> <span class="o">=</span> <span class="bp">False</span>
    <span class="n">ls</span> <span class="o">=</span> <span class="nb">len</span><span class="p">(</span><span class="n">start</span><span class="p">)</span>
    <span class="n">le</span> <span class="o">=</span> <span class="nb">len</span><span class="p">(</span><span class="n">end</span><span class="p">)</span>
    <span class="n">names</span> <span class="o">=</span> <span class="p">[]</span>
    <span class="n">name</span> <span class="o">=</span> <span class="s">&#39;&#39;</span>
    <span class="k">while</span> <span class="n">i</span><span class="o">&lt;</span><span class="nb">len</span><span class="p">(</span><span class="nb">str</span><span class="p">):</span>
        <span class="k">if</span> <span class="n">adaug</span><span class="p">:</span>
            <span class="k">if</span> <span class="nb">str</span><span class="p">[</span><span class="n">i</span><span class="p">:</span><span class="n">i</span><span class="o">+</span><span class="n">le</span><span class="p">]</span> <span class="o">!=</span> <span class="n">end</span><span class="p">:</span>
                <span class="n">name</span> <span class="o">+=</span> <span class="nb">str</span><span class="p">[</span><span class="n">i</span><span class="p">]</span>
            <span class="k">else</span><span class="p">:</span>
                <span class="n">i</span> <span class="o">+=</span> <span class="n">le</span><span class="o">-</span><span class="mi">1</span>
                <span class="n">adaug</span> <span class="o">=</span> <span class="bp">False</span>
                <span class="n">names</span><span class="o">.</span><span class="n">append</span><span class="p">(</span><span class="n">name</span><span class="p">)</span>
                <span class="n">name</span> <span class="o">=</span> <span class="s">&#39;&#39;</span>
        <span class="k">else</span><span class="p">:</span>
            <span class="k">if</span> <span class="nb">str</span><span class="p">[</span><span class="n">i</span><span class="p">:</span><span class="n">i</span><span class="o">+</span><span class="n">ls</span><span class="p">]</span><span class="o">==</span><span class="n">start</span><span class="p">:</span>
                <span class="n">i</span> <span class="o">+=</span> <span class="n">ls</span><span class="o">-</span><span class="mi">1</span>
                <span class="n">adaug</span> <span class="o">=</span> <span class="bp">True</span>
        <span class="n">i</span> <span class="o">+=</span> <span class="mi">1</span>
    <span class="k">return</span> <span class="n">names</span>
<span class="k">def</span> <span class="nf">acum</span><span class="p">():</span>
    <span class="k">return</span> <span class="n">time</span><span class="o">.</span><span class="n">strftime</span><span class="p">(</span><span class="s">&quot;[%H:%M:%S]&quot;</span><span class="p">)</span>

<span class="n">site</span> <span class="o">=</span> <span class="nb">raw_input</span><span class="p">(</span><span class="s">&quot;Ce forum phpBB vrei</span><span class="se">\n</span><span class="s">Ex: www.cinemagia.ro/forum/</span><span class="se">\n</span><span class="s">&quot;</span><span class="p">)</span>
<span class="n">nr</span> <span class="o">=</span> <span class="nb">int</span><span class="p">(</span><span class="nb">raw_input</span><span class="p">(</span><span class="s">&quot;Cate pagini sunt pe memberlist: &quot;</span><span class="p">))</span>
<span class="n">pepg</span> <span class="o">=</span> <span class="nb">int</span><span class="p">(</span><span class="nb">raw_input</span><span class="p">(</span><span class="s">&quot;Cati utilizatori sunt pe pagina: &quot;</span><span class="p">))</span>
<span class="nb">file</span> <span class="o">=</span> <span class="nb">raw_input</span><span class="p">(</span><span class="s">&quot;In ce fisier sa fie salvati utilizatorii: &quot;</span><span class="p">)</span>
<span class="n">v</span> <span class="o">=</span> <span class="nb">raw_input</span><span class="p">(</span><span class="s">&quot;Sa printez utilizatori pe ecran (d/n): &quot;</span><span class="p">)</span>
<span class="k">print</span> <span class="n">acum</span><span class="p">(),</span> <span class="s">&quot;Start&quot;</span>

<span class="n">f</span> <span class="o">=</span> <span class="nb">open</span><span class="p">(</span><span class="nb">file</span><span class="p">,</span> <span class="s">&quot;w&quot;</span><span class="p">)</span>             
          
<span class="k">for</span> <span class="n">i</span> <span class="ow">in</span> <span class="nb">range</span><span class="p">(</span><span class="n">nr</span><span class="p">):</span>
    <span class="n">nume_pagina</span> <span class="o">=</span> <span class="s">&quot;http://&quot;</span> <span class="o">+</span> <span class="n">site</span> <span class="o">+</span> <span class="s">&#39;memberlist.php?mode=joindate&amp;sort_order=ASC&amp;start=&#39;</span> <span class="o">+</span> <span class="nb">str</span><span class="p">(</span><span class="n">i</span><span class="o">*</span><span class="n">pepg</span><span class="p">)</span>
    <span class="k">print</span> <span class="n">acum</span><span class="p">(),</span> <span class="s">&quot;Descarc pagina&quot;</span><span class="p">,</span> <span class="n">i</span><span class="o">+</span><span class="mi">1</span>
    <span class="n">pg</span> <span class="o">=</span> <span class="n">urllib</span><span class="o">.</span><span class="n">urlopen</span><span class="p">(</span><span class="n">nume_pagina</span><span class="p">)</span><span class="o">.</span><span class="n">read</span><span class="p">()</span>
    <span class="n">names</span> <span class="o">=</span> <span class="n">usernames</span><span class="p">(</span><span class="n">pg</span><span class="p">)</span>
    <span class="k">if</span> <span class="n">v</span><span class="o">==</span><span class="s">&quot;d&quot;</span><span class="p">:</span> <span class="k">print</span> <span class="n">names</span>
    <span class="k">for</span> <span class="n">j</span> <span class="ow">in</span> <span class="nb">xrange</span><span class="p">(</span><span class="nb">len</span><span class="p">(</span><span class="n">names</span><span class="p">)):</span>
        <span class="n">f</span><span class="o">.</span><span class="n">write</span><span class="p">(</span><span class="n">names</span><span class="p">[</span><span class="n">j</span><span class="p">]</span><span class="o">+</span><span class="s">&quot;</span><span class="se">\n</span><span class="s">&quot;</span><span class="p">)</span>

<span class="k">print</span> <span class="n">acum</span><span class="p">(),</span> <span class="s">&quot;Terminat&quot;</span>
<span class="n">f</span><span class="o">.</span><span class="n">close</span><span class="p">()</span>
</pre></div>



</div>
<?php
require '../../include/footer.php';
afiseazaFooter();
?>
