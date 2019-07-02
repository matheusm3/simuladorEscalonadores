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

// escalonamento circular de quantum 10

echo "<br/>ESCALONAMENTO CIRCULAR \n";
echo "<br/>QUANTUM: 10 u.t \n";
echo "<br/>_________________ \n";	

$processos_otimizados = array();
foreach ($processos as $key => $value) {
	foreach ($value['carga_de_trabalho'] as $a => $value) {
		$segmentacao = substr($value, 1); //separa o primeiro caracter e guarda o restante da string
		$valor = (int)$segmentacao; //transforma em inteiro
		
		$processos_otimizados[$key] = isset($processos_otimizados[$key]) ? $processos_otimizados[$key] + $valor : $valor;
	}
}

$somadosprocessos = 0;

foreach ($processos_otimizados as $value) {
	$somadosprocessos += $value;
}

$contadorprogresso = 1;
$flag = false;

// laço inicial
while ($flag == false) {
	
	//quantum
	for ($j = 1; $j <= 10; $j++) {
		
		$somadosprocessos -= 1;
		if ($somadosprocessos == 0)
			$flag = true;
		
		// une o P com o número do processo		
		$processo = "P" . $contadorprogresso;
		
		// só existem quatro processos, então para mais de quatro, volta ao primeiro
		if ($contadorprogresso > 4){
			$contadorprogresso = 1;
			$processo = "P" . $contadorprogresso;
		}	
		
		// se não houver mais execuções no processo
		if ($processos_otimizados[$processo] <= 0){
			// parte pra o próximo processo
			$contadorprogresso = $contadorprogresso + 1;
			$processo = "P" . $contadorprogresso;

			
			// só existem quatro processos, então para mais de quatro, volta ao primeiro
			if ($contadorprogresso > 4){
				$contadorprogresso = 1;
				$processo = "P" . $contadorprogresso;
			}	
			
			// se não houver mais execuções no processo
			if ($processos_otimizados[$processo] <= 0){
				// parte pra o próximo processo
				$contadorprogresso = $contadorprogresso + 1;
				$processo = "P" . $contadorprogresso;
				
				// só existem quatro processos, então para mais de quatro, volta ao primeiro
				if ($contadorprogresso > 4){
					$contadorprogresso = 1;
					$processo = "P" . $contadorprogresso;
				}	
				
				// se não houver mais execuções no processo
				if ($processos_otimizados[$processo] <= 0){
					// parte pra o próximo processo
					$contadorprogresso = $contadorprogresso + 1;
					$processo = "P" . $contadorprogresso;
					// só existem quatro processos, então para mais de quatro, volta ao primeiro
					if ($contadorprogresso > 4){
						$contadorprogresso = 1;
						$processo = "P" . $contadorprogresso;
					}	
					
					// se não houver mais execuções no processo
					if ($processos_otimizados[$processo] <= 0){
						// parte pra o próximo processo
						$contadorprogresso = $contadorprogresso + 1;
						$processo = "P" . $contadorprogresso;
						// só existem quatro processos, então para mais de quatro, volta ao primeiro
						if ($contadorprogresso > 4){
							$contadorprogresso = 1;
							$processo = "P" . $contadorprogresso;
						}	
					
						// se não houver mais execuções no processo
						if ($processos_otimizados[$processo] <= 0){
							// parte pra o próximo processo
							$contadorprogresso = $contadorprogresso + 1;
							$processo = "P" . $contadorprogresso;
							// só existem quatro processos, então para mais de quatro, volta ao primeiro
							if ($contadorprogresso > 4){
								$contadorprogresso = 1;
								$processo = "P" . $contadorprogresso;
							}	
						}
					}
				}
			}
		}
		echo "<br/>$j u.t. || $processo  || $processos_otimizados[$processo] \n";
		$processos_otimizados[$processo] = $processos_otimizados[$processo] - 1;
		
		if ($processos_otimizados[$processo] == 0) {
			echo " => $processo terminou";
		}
	}
	echo "<br/>------------------";
	$contadorprogresso += 1;
	// só existem quatro processos, então para mais de quatro, volta ao primeiro
	if ($contadorprogresso > 4){
		$contadorprogresso = 1;
		$processo = "P" . $contadorprogresso;
	}	
}