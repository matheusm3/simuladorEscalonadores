<?php
$processos = array();
// P1
$processos['P1']['processo'] = 'P1';
$processos['P1']['prioridade'] = 2;
$processos['P1']['carga_de_trabalho'][1] = 'C10';
$processos['P1']['carga_de_trabalho'][2] = 'E5';
$processos['P1']['carga_de_trabalho'][3] = 'C4';

//P2
$processos['P2']['processo'] = 'P2';
$processos['P2']['prioridade'] = 1;
$processos['P2']['carga_de_trabalho'][1] = 'C2';
$processos['P2']['carga_de_trabalho'][2] = 'E10';
$processos['P2']['carga_de_trabalho'][3] = 'C1';

//P3
$processos['P3']['processo'] = 'P3';
$processos['P3']['prioridade'] = 2;
$processos['P3']['carga_de_trabalho'][1] = 'C16';
$processos['P3']['carga_de_trabalho'][2] = 'E1';
$processos['P3']['carga_de_trabalho'][3] = 'C10';

//P4
$processos['P4']['processo'] = 'P4';
$processos['P4']['prioridade'] = 0;
$processos['P4']['carga_de_trabalho'][1] = 'C4';
$processos['P4']['carga_de_trabalho'][2] = 'E1';
$processos['P4']['carga_de_trabalho'][3] = 'C1';
$processos['P4']['carga_de_trabalho'][4] = 'E1';
$processos['P4']['carga_de_trabalho'][5] = 'C1';

// Compara se $a é maior que $b
function compara($a, $b) {
    $a_ciclos = formatAndSum($a);
    $b_ciclos = formatAndSum($b);

	return ($a['prioridade'] < $b['prioridade']) OR ($a_ciclos < $b_ciclos);
}

// Ordenamos o array
usort($processos, 'compara');

echo "PROCESSO DE PRIORIDADE E TEMPO <br><br><br>";

// Percorremos o array com os dados
foreach($processos as $key => $value){
	echo "PROCESSO: " . $value['processo']. "<br><br>";

    // Declaramos as variaveis
    $totalTag = 0;
	$cTag = 0;
    $eTag = 0;
    // Percorremos cada carga de trabalho
	foreach($value['carga_de_trabalho'] as $key2 => $carga_trabalho){
		echo "CARGA HORARIA EM PROCESSO: " . $carga_trabalho . "<br>";

		$segmentacao = substr($carga_trabalho, 1); //separa o primeiro caracter e guarda o restante da string
		$valor = (int)$segmentacao; //transforma em inteiro
        
        // Utilizamos expressão regular para verificar se existe determinada String
		if (preg_match('/C/', $carga_trabalho)) {
			$cTag += $valor;
		}
		if (preg_match('/E/', $carga_trabalho)) {
			$eTag += $valor;
        }
        
        // Somamos os ciclos totais
        $totalTag += $valor;

        // Fazemos um loop e exibimos em tempo real para o usuário
		for($i=$valor; $i>0; $i--){
			echo "Ciclo: " . $i . "<br>";
		}
		
	}

	echo "FIM PROCESSO <br>";
	echo "Ciclos executados pela CPU: " . $cTag . "<br>";
	echo "Ciclos executados de Entrada/Saida: " . $eTag . "<br>";
	echo "Total de ciclos executados: " . $totalTag . "<br>";
	echo "------------------------ <br>";
}

function formatAndSum($lista){
    $sum = 0;
    foreach($lista['carga_de_trabalho'] as $key => $value){
        $segmentacao = substr($value, 1); //separa o primeiro caracter e guarda o restante da string
        $valor = (int)$segmentacao; //transforma em inteiro
        $sum += $valor;
    }
    
    return $sum;
}