<?php
	$method = $_SERVER['REQUEST_METHOD'];
	header("Content-type: application/json; charset=utf-8");
	if($method=="POST"){
		$input = json_decode(file_get_contents('php://input'),true);
		echo json_encode(array("code"=>200,"message"=>(isMutant($input)?"DNA is mutant":"DNA is not mutant")));

	}
	else{
		echo json_encode(array("code"=>500,"message"=>"Method is not implemented"));
	}
	function isMutant($dna)
	{
	$vertical= count($dna);
	$horizontal = strlen($dna[0]);
	$char_t="";
	$cont=0;
	$con_global=0;
	for ($v=0; $v < $vertical ; $v++) { 
		for ($h=0; $h <$horizontal ; $h++) { 
			$char_t = $dna[$v][$h];
			if(($v+3)<$vertical){
				$cont=0;
				for ($x=1; $x < 4 ; $x++) { 
					if($char_t==$dna[$v+$x][$h])
						$cont++;
					else
						break;
				}
				if ($cont>2)
					$con_global++;
			}
			if(($h+3)<$horizontal){
				$cont=0;
				for ($x=1; $x < 4 ; $x++) { 
					if($char_t==$dna[$v][$h+$x])
						$cont++;
					else
						break;
				}
				if ($cont>2)
					$con_global++;
			}
			if(($h+3)<$vertical&&($v+3)<$horizontal){
				$cont=0;
				for ($x=1; $x < 4 ; $x++) { 
					if($char_t==$dna[$v+$x][$h+$x])
						$cont++;
					else
						break;
				}
				if ($cont>2)
					$con_global++;
			}
			if(($horizontal-$h-4)>=0&&($v+3)<$vertical){
				$cont=0;
				$char_t = $dna[$v][$horizontal-$h-1];
				for ($x=1; $x < 4 ; $x++) { 
					if($char_t==$dna[$v+$x][$horizontal-$h-$x-1]){
						$cont++;
					}
					else
						break;
				}
				if ($cont>2)
					$con_global++;
			}
		}
	}
	return ($con_global>1);
	} 