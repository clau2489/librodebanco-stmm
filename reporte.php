<?php
	include 'plantilla.php';
	require 'conexion/db.php';
	require 'conexion/conexion.php';
	$id= $_GET['id'];	
	$query_orden=mysqli_query($conn,"select * from orden where id_orden='$id'");	
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();		
	while($rw=mysqli_fetch_array($query_orden))		
	{
		$pdf->SetMargins(15, 0 , 0);
		$pdf->SetFillColor(227, 227, 227);
		$date = $rw['fecha']; 
		$newDate = date("d/m/Y", strtotime($date)); 
		$pdf->Cell(180,0,"",0,1,'L');
		$pdf->Cell(180,14,utf8_decode("Fecha: ". $newDate),0,1,'R');

		$pdf->SetFont('Arial','B',10);
		
		$pdf->Cell(70,14,"Forma de Pago: ". $rw['forma_pago'],0,0,'L');
		$pdf->Cell(60,14,"Cheque N: ". $rw['n_cheque'],0,0,'L');
		$pdf->Cell(50,14,"Cuenta Cte. N: ". $rw['cuenta'],0,0,'L');

		$pdf->Cell(180,14,"",0,1,'L');
		$pdf->SetFont('Arial','B',12);		
		$pdf->Cell(130,14,"Beneficiario: ". $rw['beneficiario'],0,0,'L');
		$pdf->Cell(50,14,"Importe: $". $rw['importe']. ".-",0,0,'L');		
		
		$pdf->Cell(180,14,"",0,1,'L');
		function num2letras($num, $fem = false, $dec = true) { 
		   $matuni[2]  = "DOS"; 
		   $matuni[3]  = "TRES"; 
		   $matuni[4]  = "CUATRO"; 
		   $matuni[5]  = "CINCO"; 
		   $matuni[6]  = "SEIS"; 
		   $matuni[7]  = "SIETE"; 
		   $matuni[8]  = "OCHO"; 
		   $matuni[9]  = "NUEVE"; 
		   $matuni[10] = "DIEZ"; 
		   $matuni[11] = "ONCE"; 
		   $matuni[12] = "DOCE"; 
		   $matuni[13] = "TRECE"; 
		   $matuni[14] = "CATORCE"; 
		   $matuni[15] = "QUINCE"; 
		   $matuni[16] = "DIECISEIS"; 
		   $matuni[17] = "DIECISIETE"; 
		   $matuni[18] = "DIECIOCHO"; 
		   $matuni[19] = "DIECINUEVE"; 
		   $matuni[20] = "VEINTE"; 
		   $matunisub[2] = "DOS"; 
		   $matunisub[3] = "TRES"; 
		   $matunisub[4] = "CUATRO"; 
		   $matunisub[5] = "QUIN"; 
		   $matunisub[6] = "SEIS"; 
		   $matunisub[7] = "SETE"; 
		   $matunisub[8] = "OCHO"; 
		   $matunisub[9] = "NOVE"; 		 
		   $matdec[2] = "VEINT"; 
		   $matdec[3] = "TREINTA"; 
		   $matdec[4] = "CUARENTA"; 
		   $matdec[5] = "CINCUENTA"; 
		   $matdec[6] = "SESENTA"; 
		   $matdec[7] = "SETENTA"; 
		   $matdec[8] = "OCHENTA"; 
		   $matdec[9] = "NOVENTA"; 
		   $matsub[3]  = 'MILL'; 
		   $matsub[5]  = 'BILL'; 
		   $matsub[7]  = 'MILL'; 
		   $matsub[9]  = 'TRILL'; 
		   $matsub[11] = 'MILL'; 
		   $matsub[13] = 'BILL'; 
		   $matsub[15] = 'MILL'; 
		   $matmil[4]  = 'MILLONES'; 
		   $matmil[6]  = 'BILLONES'; 
		   $matmil[7]  = 'DE BILLONES'; 
		   $matmil[8]  = 'MILLONES DE BILLONES'; 
		   $matmil[10] = 'TRILLONES'; 
		   $matmil[11] = 'DE TRILLONES'; 
		   $matmil[12] = 'MILLONES DE TRILLONES'; 
		   $matmil[13] = 'DE TRILLONES'; 
		   $matmil[14] = 'BILLONES DE TRILLONES'; 
		   $matmil[15] = 'DE BILLONES DE TRILLONES'; 
		   $matmil[16] = 'MILLONES DE BILLONES DE TRILLONES'; 
		   
		   //Zi hack
		   $float=explode('.',$num);
		   $num=$float[0];
		 
		   $num = trim((string)@$num); 
		   if ($num[0] == '-') { 
		      $neg = 'menos '; 
		      $num = substr($num, 1); 
		   }else 
		      $neg = ''; 
		   while ($num[0] == '0') $num = substr($num, 1); 
		   if ($num[0] < '1' or $num[0] > 9) $num = '0' . $num; 
		   $zeros = true; 
		   $punt = false; 
		   $ent = ''; 
		   $fra = ''; 
		   for ($c = 0; $c < strlen($num); $c++) { 
		      $n = $num[$c]; 
		      if (! (strpos(".,'''", $n) === false)) { 
		         if ($punt) break; 
		         else{ 
		            $punt = true; 
		            continue; 
		         } 
		 
		      }elseif (! (strpos('0123456789', $n) === false)) { 
		         if ($punt) { 
		            if ($n != '0') $zeros = false; 
		            $fra .= $n; 
		         }else 
		 
		            $ent .= $n; 
		      }else 
		 
		         break; 
		 
		   } 
		   $ent = '     ' . $ent; 
		   if ($dec and $fra and ! $zeros) { 
		      $fin = ' coma'; 
		      for ($n = 0; $n < strlen($fra); $n++) { 
		         if (($s = $fra[$n]) == '0') 
		            $fin .= ' CERO'; 
		         elseif ($s == '1') 
		            $fin .= $fem ? ' UNA' : ' UN'; 
		         else 
		            $fin .= ' ' . $matuni[$s]; 
		      } 
		   }else 
		      $fin = ''; 
		   if ((int)$ent === 0) return 'CERO ' . $fin; 
		   $tex = ''; 
		   $sub = 0; 
		   $mils = 0; 
		   $neutro = false; 
		   while ( ($num = substr($ent, -3)) != '   ') { 
		      $ent = substr($ent, 0, -3); 
		      if (++$sub < 3 and $fem) { 
		         $matuni[1] = 'UNA'; 
		         $subcent = 'AS'; 
		      }else{ 
		         $matuni[1] = $neutro ? 'UN' : 'UNO'; 
		         $subcent = 'OS'; 
		      } 
		      $t = ''; 
		      $n2 = substr($num, 1); 
		      if ($n2 == '00') { 
		      }elseif ($n2 < 21) 
		         $t = ' ' . $matuni[(int)$n2]; 
		      elseif ($n2 < 30) { 
		         $n3 = $num[2]; 
		         if ($n3 != 0) $t = 'i' . $matuni[$n3]; 
		         $n2 = $num[1]; 
		         $t = ' ' . $matdec[$n2] . $t; 
		      }else{ 
		         $n3 = $num[2]; 
		         if ($n3 != 0) $t = ' y ' . $matuni[$n3]; 
		         $n2 = $num[1]; 
		         $t = ' ' . $matdec[$n2] . $t; 
		      } 
		      $n = $num[0]; 
		      if ($n == 1) { 
		         $t = ' CIENTO' . $t; 
		      }elseif ($n == 5){ 
		         $t = ' ' . $matunisub[$n] . 'IENT' . $subcent . $t; 
		      }elseif ($n != 0){ 
		         $t = ' ' . $matunisub[$n] . 'CIENT' . $subcent . $t; 
		      } 
		      if ($sub == 1) { 
		      }elseif (! isset($matsub[$sub])) { 
		         if ($num == 1) { 
		            $t = ' MIL'; 
		         }elseif ($num > 1){ 
		            $t .= ' MIL'; 
		         } 
		      }elseif ($num == 1) { 
		         $t .= ' ' . $matsub[$sub] . '?n'; 
		      }elseif ($num > 1){ 
		         $t .= ' ' . $matsub[$sub] . 'ONES'; 
		      }   
		      if ($num == '000') $mils ++; 
		      elseif ($mils != 0) { 
		         if (isset($matmil[$sub])) $t .= ' ' . $matmil[$sub]; 
		         $mils = 0; 
		      } 
		      $neutro = true; 
		      $tex = $t . $tex; 
		   } 
		   $tex = $neg . substr($tex, 1) . $fin; 
		   //Zi hack --> return ucfirst($tex);
		   $end_num=ucfirst($tex).' PESOS '.$float[1].'/100';
		   return $end_num; 
		}
		$pdf->Cell(180,14,"Concepto: ". $rw['concepto'],0,1,'L');
		$pdf->Cell(180,14,"Son: ". num2letras($rw['importe']),0,1,'L');
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(180,12,"Observaciones: ". $rw['obs'],0,1,'L');
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(120,10,"Autoriza:",0,1,'R');
		$pdf->SetFont('Arial','B',5);		
		$pdf->Cell(180,8,"----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------",0,1,'L');
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(180,14,"Comprobante de Egreso",0,1,'L');
		$pdf->SetFont('Arial','B',12);		
		$pdf->Cell(180,14,"Recibimos del Sindicato de Trabajadores Municipales de Merlo la suma de:",0,1,'R');
		$pdf->Cell(120,14, num2letras($rw['importe']),0,1,'L');
		$pdf->Cell(180,14,"en concepto de: ". $rw['concepto'],0,1,'L');
		$pdf->Cell(180,8,"",0,1,'L');
		$pdf->SetFont('Arial','B',20);
		$pdf->Cell(65,18,"Total: $". $rw['importe']. ".-",1,0,'L');
		$pdf->Image('img/firma.jpg',0,230,0,0);			

	}
	$pdf->Output();
?>