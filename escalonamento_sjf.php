<?php
$processos = array();
// P1
$processos['P1']['prioridade'] = 2;
$processos['P1']['carga_de_trabalho'][1] = 'C10';
$processos['P1']['carga_de_trabalho'][2] = 'E5';
$processos['P1']['carga_de_trabalho'][3] = 'C4';

//P2
$processos['P2']['prioridade'] = 1;
$processos['P2']['carga_de_trabalho'][1] = 'C2';
$processos['P2']['carga_de_trabalho'][2] = 'E10';
$processos['P2']['carga_de_trabalho'][3] = 'C1';

//P3
$processos['P3']['prioridade'] = 2;
$processos['P3']['carga_de_trabalho'][1] = 'C16';
$processos['P3']['carga_de_trabalho'][2] = 'E1';
$processos['P3']['carga_de_trabalho'][3] = 'C10';

//P4
$processos['P4']['prioridade'] = 0;
$processos['P4']['carga_de_trabalho'][1] = 'C4';
$processos['P4']['carga_de_trabalho'][2] = 'E1';
$processos['P4']['carga_de_trabalho'][3] = 'C1';
$processos['P4']['carga_de_trabalho'][4] = 'E1';
$processos['P4']['carga_de_trabalho'][5] = 'C1';

$menorvalor = 0;
$voltamenor = 0;
// laço que busca fazer a verificação quatro vezes
for ($i = 1; $i <= 4; $i++) {
    
    // se for a primeira volta, mostrar título
	if ($i == 1) {
		echo nl2br("ESCALONAMENTO SJF \n");
		echo nl2br("_________________ \n");	
    }
    
	// para cada processo (P?), verifica
	foreach ($processos as $volta => $p) {
        $soma = 0;
        $flag = 0;
		// dentro do processo (P?), executa a soma das execuções
		foreach($p['carga_de_trabalho'] as $key => $detalhe_processo){
			$flag = 1;
            //separa o primeiro caracter e guarda o restante da string
			$segmentacao = substr($detalhe_processo, 1); //separa o primeiro caracter e guarda o restante da string
			$valor = (int)$segmentacao; //transforma em inteiro
            
            // se for a primeira volta da soma, a soma é o valor inicial
			if ($key == 1) {
				$soma = $valor;
			} else {
				$soma += $valor;
			}
        }

		// se for o primeiro processo, o menor valor é o inicial
		if (isset($processos['P1'])){
			if($volta == 'P1') {
				$menorvalor = $soma;
				$voltamenor = $volta; //guarda o valor da menor volta
			}
		}
		
		else if ($flag == 1) {
			$menorvalor = $soma;
			$voltamenor = $volta;
		}
        
		// se a soma for menor que o menor valor, o menor valor é substituído
		if ($soma < $menorvalor) {
			$menorvalor = $soma;
			$voltamenor = $volta; //guarda o valor da menor volta
		}
    }

    // mostra a volta menor
	echo $voltamenor;
    
    // remove o processo escolhido do array de processos
	unset($processos[$voltamenor]);
}