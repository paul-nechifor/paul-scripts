<?php
/*

DENUMIRE:      Name generator
VERSIUNE:      0.5
AUTOR:         Paul Nechifor
SITE:          de adaugat
LICENTA:       GNU GPL
INCEPUT:       12.02.2007
MODIFICAT:     12.05.2007
DESCRIERE:     Creaza denumiri prin metoda selectiei artificiale.



DE CORECTAT:
	- daca primeste numele "_pa" genereaza gaseste doua silabe

*/

class Comune
{
	public static function sansa($vector)
	//i se transmite un vector de sanse si intoarce ordinul celei alese +1
	{
		$suma=0;
		$n = count($vector);	
		for ($i=0; $i<$n; $i++) $suma +=$vector[$i];
		
		$ord = 0;
		$nr = $vector[$ord];
		$rand = mt_rand(1,$suma);
		
		while ($ord <= $n) //la fel cu              while ($ord <= $n)
		{
			if ($rand <= $nr) return $ord;
			$nr += $vector[++$ord];
		}	
	}
}

class Litera
{
	private static $vocale =			array('a', 'e', 'i', 'o', 'u', 'y');
	private static $vocale_sansa =		array( 78,  89,  72,  75,  46,  19);
	private static $consoane =			array('b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm', 'n', 'p', 'q', 'r', 's', 't', 'v', 'w', 'x', 'z');
	private static $consoane_sansa =	array( 14,  27,  42,  22,  20,  55,  11,  12,  40,  26,  58,  20,   3,  53,  43,  71,  12,   5,   6,   7);
	public static $lista = '';

	public static function vocala()
	{
		return Litera::$vocale[Comune::sansa(Litera::$vocale_sansa)];
	}
	public static function consoana()
	{
		return Litera::$consoane[Comune::sansa(Litera::$consoane_sansa)];
	}
	public static function este_vocala($lit)
	{
		for ($i=0; $i<count(Litera::$vocale); $i++)
			if ($lit==Litera::$vocale[$i]) return true;
		return false;
	}
}

class NameSelection
{	
	//"Scheletul" silabei si sansa de generare al unei astfel de silabe initial
	private static $forma =      		array('V','CV','CCV','CCVC','VV','VVV','VC','CVC','CVCC');
	private static $forma_sansa =		array( 14,  30,   11,     5,   5,    2,  15,   33,     4);
	
	//Ce sansa are o anumita silaba sa se transforme intr-alta, pastrandu-se unele dintre litere
	private static $transformare =		array(
							'V' => array( array('AC0','AC1','AV1','AV0') , array(28,23,16,16) ),
							'CV' => array( array('AC0','AC1','AC2','S0') , array(12,12,30,20) ),
							'CCV' => array( array('AC3','S0','S1') , array(48,9,9) ),
							'CCVC' => array( array('S0','S1','S3') , array(32,32,12) ),
							'VV' => array( array('AV2','S0','S1') , array(30,16,16) ),
							'VVV' => array( array('S0','S1','S2') , array(1,1,1) ),
							'VC' => array( array('AC0','S1') , array(12,8) ),
							'CVC' => array( array('AC0','AC1','AC3', 'S0', 'S2') , array(8,8,6,37,42) ),
							'CVCC' => array( array('S2', 'S3') , array(1,1) ),
						);
	
	public static function silaba()
	{
		$s=Comune::sansa(NameSelection::$forma_sansa);
		$sil = NameSelection::$forma[$s-1]; //"scheletul" silabei
		for ($i=0; $i<strlen($sil); $i++) //inlocuieste "scheletul" cu silaba
			if ($sil[$i]=='V') $sil[$i] = Litera::vocala();
			else $sil[$i] = Litera::consoana();
		return $sil;
	}
	private static function schim_litera($sil)
	{
		$r = mt_rand (0, strlen($sil)-1);
		if (Litera::este_vocala($sil[$r])) $sil[$r] = Litera::vocala();
		else $sil[$r] = Litera::consoana();
		return $sil;
	}
	private static function trans_silaba($sil)
	{
		//afla "scheletul" silabei
		$frm = '';
		for ($i=0; $i<strlen($sil); $i++)
			if (Litera::este_vocala($sil[$i])) $frm .= 'V';
			else $frm .= 'C';
	
		//se verifica daca exista forma de silaba $frm
		$exista = false;
		for ($i=0; $i<count(NameSelection::$forma); $i++) if ($frm == NameSelection::$forma[$i]) $exista = true;
		if (!$exista) return '[FRM_INC]';
		
		$s = Comune::sansa(NameSelection::$transformare[$frm][1]);
		$act = NameSelection::$transformare[$frm][0][$s-1]; //afla actiunea ce trebuie urmata
		
		if ($act[0]=='S') //stergere
		{
			for ($i=((int)$act[1]); $i<strlen($sil)-1; $i++)
				$sil[$i] = $sil[$i+1];
			$sil = substr($sil,0,strlen($sil)-1);	
		} else { //adaugare
			for ($i=strlen($sil); $i>((int)$act[2]); $i--)
				$sil[$i] = $sil[$i-1];
			if ($act[1]=='C') $sil[(int)$act[2]] = Litera::consoana();
			else $sil[(int)$act[2]] = Litera::vocala();
		}
		return $sil;
	}
	
	private static function valid($vector)
	{
		if (count($vector)==0) return (false); 
		
		//trebuie verificat pentru silabe suparatoare
		// doua consoane identice nu au voie sa faca parte din aceeasi silaba
		
		return (true);
	}
	
	public static function mutatie($str)
	{
		do
		{
			$silabe_mutatie = explode("_",$str);
			$n = count($silabe_mutatie);
			
			$s = Comune::sansa(array(39,13,13,42,125));
			
			if     ($s==1) //schimba o silaba
			{
				$r = mt_rand(0,$n-1);
				$silabe_mutatie[$r] = NameSelection::silaba();
			}
			elseif ($s==2) //adauga o silaba
			{
				$r = mt_rand(0, $n);
				if ($r!=$n) //trebuie mutat totul la dreapta daca nu nu este ultima+1
					for ($i=$n; $i>$r; $i--)
						$silabe_mutatie[$i] = $silabe_mutatie[$i-1];
				$silabe_mutatie[$r] = NameSelection::silaba();
			}
			elseif ($s==3) //sterge o silaba
			{
				$r = mt_rand(0, $n-1);
				if ($r!=$n-1) //trebuie mutat totul la stanga daca nu nu este ultima
					for ($i=$r; $i<$n-1; $i++)
						$silabe_mutatie[$i] = $silabe_mutatie[$i+1];
				unset($silabe_mutatie[$n-1]);
			}
			elseif ($s==4) //schimba o litera
			{
				$r = mt_rand(0,$n-1);
				$silabe_mutatie[$r] = NameSelection::schim_litera($silabe_mutatie[$r]);
			}
			elseif ($s==5) //transforma o silaba
			{
				$r = mt_rand(0,$n-1);
				$silabe_mutatie[$r] = NameSelection::trans_silaba($silabe_mutatie[$r]);
			}
		} while (!NameSelection::valid($silabe_mutatie));
		
		return implode('_',$silabe_mutatie);
	}
	
	public static function afisare($str)
	{
		return "<a href=\"".$_SERVER['PHP_SELF']."?name=$str\">".ucfirst(str_replace('_','',$str))."</a>";
	}
	public static function copac($str, $n)
	{
		if ($n==0) $lista = $n.'!'.$str;
		else $lista = "\n".$n.'!'.$str;
		
		if ($n<6)
		{
			if ($n<=1) $nr = mt_rand(2,3); else $nr = mt_rand(0,3);
			if ($nr!=0) for ($i=1; $i<=$nr; $i++)
				$lista .= NameSelection::copac(NameSelection::mutatie($str), $n+1);
		}
		return $lista;
	}
	public static function arbore($str)
	{
		$lista = explode("\n", NameSelection::copac($str, 0));
		$nr = count($lista);
		for ($i=0; $i<$nr; $i++)
			$lista[$i] = explode('!', $lista[$i]);
		for ($i=0; $i<$nr; $i++)
		{
			$niv = $lista[$i][0];
			$ultimCopil=0;
			for ($j=$i+1; $j<$nr; $j++)
			{
				if ($lista[$j][0] <= $niv) break;
				if ($lista[$j][0]-1==$niv) $ultimCopil = $j;
			}
			if ($ultimCopil==0)
			{
				$rand[$i][$niv] = 2;
			}
			else
			{
				$rand[$i][$niv] = 3;
				for ($j=$i+1; $j<$ultimCopil; $j++)
					if ($lista[$j][0]-1==$niv) $rand[$j][$niv] = 5;
					else $rand[$j][$niv] = 4;
				$rand[$ultimCopil][$niv] = 6;
			}
		}
		$rand[0][0]=1;
		print '<div style="line-height:1.0; font-size:14px;" class="copac">';
		for ($i=0; $i<$nr; $i++)
		{
			$len = count($rand[$i]);
			for ($j=0; $j<$len; $j++)
				if ($rand[$i][$j]) print '<img src="../../img/lista/tip'.$rand[$i][$j].'.gif" alt="" />';
				else 
				{
					print '<img src="../../img/lista/tip0.gif" alt="" />';
					$len++;
				}
			print " ".NameSelection::afisare($lista[$i][1])."<br />\n";
		}
		print '</div>';
	}
}
?>