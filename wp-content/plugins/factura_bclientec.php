<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../main/error.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php require_once('../Connections/conectado.php'); ?>
<?php include('../contabilidad/libreria.php');?>
<?php 

$bandera=0; 
$currentPage = $_SERVER["PHP_SELF"];

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form3")) 
{
	mysql_select_db($database_conectado, $conectado);
	$query_abonos = sprintf("SELECT * FROM cliente inner join cliente_precio on cli_precio = cpre_codigo  WHERE cli_ciruc = %s", GetSQLValueString($_POST['ci'], "text"));
	$abonos = mysql_query($query_abonos, $conectado) or die(mysql_error());
	$row_abonos = mysql_fetch_assoc($abonos);
	$totalRows_abonos = mysql_num_rows($abonos);
	if($totalRows_abonos == 0)
	{
		$radio = $_POST['radio'];
		if ($radio == "CI")
		{
			$ci_ruc = $_POST['cli_ci'];
		}else if ($radio=="RUC")
		{
			$ci_ruc = $_POST['cli_ruc'];
		}
		else
		{
			$ci_ruc = $_POST['cli_pasa'];			
		}
		
		 $insertSQL = sprintf("INSERT INTO cliente (cli_ciruc, cli_apellidos, cli_nombres, cli_fechaingreso, cli_direccion, cli_direccion1, cli_telefono, cli_telefono1, cli_celular, cli_email, cli_email1, cli_ubicacion, cli_tipo, cli_porcentajedescuento, cli_precio, cli_iva, cli_diascredito, cli_sucursal, cli_atencion, cli_vendedor, cli_profesion) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
						   GetSQLValueString($ci_ruc, "text"),
						   GetSQLValueString($_POST['cli_apellidos'], "text"),
						   GetSQLValueString($_POST['cli_nombres'], "text"),
						   GetSQLValueString($_POST['cli_fechaingreso'], "date"),
						   GetSQLValueString($_POST['cli_direccion'], "text"),
						   GetSQLValueString($_POST['cli_direccion1'], "text"),
						   GetSQLValueString($_POST['cli_telefono'], "text"),
						   GetSQLValueString($_POST['cli_telefono1'], "text"),
						   GetSQLValueString($_POST['cli_celular'], "text"),
						   GetSQLValueString($_POST['cli_email'], "text"),
						   GetSQLValueString($_POST['cli_email1'], "text"),
						   GetSQLValueString($_POST['cli_ubicacion'], "int"),
						   GetSQLValueString($_POST['cli_tipo'], "int"),
						   GetSQLValueString($_POST['cli_porcentajedescuento'], "double"),
						   GetSQLValueString($_POST['cpre_descripcion'], "int"),
						   GetSQLValueString($_POST['cli_iva'], "int"),
						   GetSQLValueString($_POST['dcredito'], "int"),
						   GetSQLValueString($_POST['cli_sucursal'], "int"),
						   GetSQLValueString($_POST['cli_atencion'], "text"),
						   GetSQLValueString($_POST['vendedoringreso'], "int"),
						   GetSQLValueString($_POST['cli_profesion'], "int"));
		
		mysql_select_db($database_conectado, $conectado);
		$Result1 = mysql_query($insertSQL, $conectado) or die(mysql_error());
// creo al cliente en mi base att jd para patologico		
	   if ($_POST['txtruc']=='0190479994001')
	    { 		
		$concatenado=$_POST['cli_apellidos'].' '.$_POST['cli_nombres'];
		mysql_select_db($database_conectado, $conectado);
	    $updateSQL = "insert into lb_paciente(pac_cedula,pac_nombre,pac_mail,pac_telefono,pac_direccion,pac_nacimiento,pac_genero,pac_civil) values('$ci_ruc','$concatenado','".$_POST['cli_email']."','".$_POST['cli_telefono']."','".$_POST['cli_direccion']."','".$_POST['txtnacimiento']."','".$_POST['txtgenero']."','".$_POST['txtcivil']."')";
  $Result1 = mysql_query($updateSQL, $conectado) or die(mysql_error());
	   }
		////////////////////////////////////////////////////////	   
		mysql_select_db($database_conectado, $conectado);
		$query_cliente_datos = sprintf("SELECT * FROM cliente WHERE cli_ciruc LIKE %s", GetSQLValueString("%".$ci_ruc."%", "text"));
		$cliente_datos = mysql_query($query_cliente_datos, $conectado) or die(mysql_error());
		$row_cliente_datos = mysql_fetch_assoc($cliente_datos);
		$totalRows_cliente_datos = mysql_num_rows($cliente_datos);
	
		$codigo = $row_cliente_datos['cli_codigo'];
		
		$insertPC = sprintf("INSERT INTO cliente_cuotas (clic_cliente, clic_porcentaje, clic_dias, clic_dias_eq) VALUES (%s, %s, %s, %s)",
					   GetSQLValueString($codigo, "int"),
					   GetSQLValueString('100', "text"),
					   GetSQLValueString($_POST['dcredito'], "int"), 
					   GetSQLValueString($_POST['dcredito'], "int"));
		mysql_select_db($database_conectado, $conectado);
		$Result1 = mysql_query($insertPC, $conectado) or die(mysql_error());	
	}
	else
	{
		echo '<script LANGUAGE="JavaScript">alert("Cedula o RUC ya existente... Información no ingresada")</script>';
	}
  
	mysql_select_db($database_conectado, $conectado);
	echo $query_tipo = "SELECT * FROM cliente  inner join cliente_precio on cli_precio = cpre_codigo  where cli_ciruc='$ci_ruc' ";
	$tipo = mysql_query($query_tipo, $conectado) or die(mysql_error());
	$row_clientes = mysql_fetch_assoc($tipo);
	$totalRows_tipo = mysql_num_rows($tipo);
	
	if($row_clientes['cli_vendedor']==0){$vende=0;$v=1;} else {$vende=$row_clientes['cli_vendedor']-1;$v=$row_clientes['cli_vendedor'];}
	/* if($row_clientes['cli_mora']==1)
	{
		$texto='Cliente Bloqueado';
		echo '<script LANGUAGE="JavaScript">alert("'.$texto.'")</script>';
	} */
	// window.opener.document.form1.PAGO4.disabled = true;
	$dispo = $row_clientes['cli_cupo'] - $row_clientes['cli_dedudatotal'];
	$cero = '<script LANGUAGE="JavaScript"> 
	window.opener.document.form1.ciruc.value="'.$row_clientes['cli_ciruc'].'"; 
	window.opener.document.form1.clinombre.value="'.$row_clientes['cli_apellidos']." ".$row_clientes['cli_nombres'].'"; 
	window.opener.document.form1.clidireccion.value="'.$row_clientes['cli_direccion'].'"; 
	window.opener.document.form1.telf.value="'.$row_clientes['cli_telefono'].'"; 
	window.opener.document.form1.recordID.value="'.$row_clientes['cli_codigo'].'";
	window.opener.document.form1.dcredito.value="0"; 
	window.opener.document.form1.dcreditoeq.value="0"; 
	window.opener.document.form1.ncuotas.value="0"; 
	window.opener.document.form1.precio.value="'.$row_clientes['cpre_descripcion'].'";
	window.opener.document.form1.pre.value="'.$row_clientes['cli_precio'].'";
	window.opener.document.form1.mora.value="'.$row_clientes['cli_mora'].'"; 	
	window.opener.document.form1.cupo_ventas.value="'.$row_clientes['cli_cupo'].'";
	window.opener.document.form1.disponible_ventas.value="'.$dispo.'";	
    window.opener.document.form1.cbmvendedorcodigo.value="'.$vende.'";
	window.opener.document.form1.correoelectronico.value="'.$row_clientes['cli_email'].'";
	//window.opener.document.form1.cuantas.value="'.$row_clientes['cli_carteracuotas'].'"; 
	//window.opener.document.form1.suman.value="'.$row_clientes['cli_cartera'].'"; 
	//window.opener.document.form1.dias.value="'.$row_clientes['cli_carteradias'].'";
	window.opener.document.form1.categoria.value="'.$row_clientes['cli_categoria'].'";
	
	
	if('.$row_clientes['cli_interelacion'].' == 1 )
	{
		window.opener.document.form1.porcendesc.readOnly = false;
		window.opener.document.form1.ddesc[0].disabled = false;
		window.opener.document.form1.ddesc[1].disabled = false;
	}
	else
	{
		window.opener.document.form1.porcendesc.readOnly = false;
		window.opener.document.form1.ddesc[0].disabled = false;
		window.opener.document.form1.ddesc[1].disabled = false;
	}

	window.opener.document.form1.PAGO2.checked = true;
	window.opener.document.form1.PAGO1.disabled = false;
	window.opener.document.form1.PAGO3.disabled = false;	
	window.opener.document.form1.ocompras.focus();';
	$lineas = $_POST['lineas'];
	if($_POST['precio'] != $row_clientes['cli_precio'])
	{
		for($i=1;$i<=$lineas;$i++)
		{
			$cero = $cero.'window.opener.document.form1.COD'.$i.'.value="";
			window.opener.document.form1.DESC'.$i.'.value="";
			window.opener.document.form1.CNT'.$i.'.value=0;
			window.opener.document.form1.CNT1_'.$i.'.value=0;
			window.opener.document.form1.desct'.$i.'.value=0;
			window.opener.document.form1.COMPRA'.$i.'.value=0;
			window.opener.document.form1.TOT'.$i.'.value=0;
			window.opener.document.form1.STK'.$i.'.value=0;
			window.opener.document.form1.STK1_'.$i.'.value=0;
			window.opener.document.form1.IBA'.$i.'.value="";';						
		}
	}
	echo '<script LANGUAGE="JavaScript">'.$cero.'window.opener.document.form1.guardar.disabled=true; 
	window.opener.document.form1.ocompras.focus(); 
	window.close();
	</script>';//	
}

///////// FIN DEL INSERT ////////////

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) 
{	
	$codigo = $_POST['codpro'];	
	$colname_saldo = $_POST['codigo'.$codigo];
	
// SELECT * FROM fparametros_ventas where nparametro = 'consumidor_final'
	mysql_select_db($database_conectado, $conectado);
	$query_vendeq = "SELECT * FROM fparametros_ventas where nparametro = 'consumidor_final'";
	$vendeq = mysql_query($query_vendeq, $conectado) or die(mysql_error());
	$row_vendeq = mysql_fetch_assoc($vendeq);
	$totalRows_vendeq = mysql_num_rows($vendeq);
	$codigo_final = $row_vendeq['sucursal_1'];
	
	mysql_select_db($database_conectado, $conectado);
	 $query_clientes = sprintf("SELECT * FROM cliente INNER JOIN cliente_precio ON cli_precio = cpre_codigo WHERE cli_codigo = %s", GetSQLValueString($colname_saldo, "text"));
	$clientes = mysql_query($query_clientes, $conectado) or die(mysql_error());
	$row_clientes = mysql_fetch_assoc($clientes);
	$totalRows_clientes = mysql_num_rows($clientes);

	$DiasCredito = 0;
	$Cuotas = 0;
	mysql_select_db($database_conectado, $conectado);
	$query_cuotas = "SELECT count(clic_dias) as cuenta, max(clic_dias) as dias, max(clic_dias_eq) as diaseq  FROM cliente_cuotas WHERE clic_cliente = ".$colname_saldo;
	$cuotas = mysql_query($query_cuotas, $conectado) or die(mysql_error());
	$row_cuotas = mysql_fetch_assoc($cuotas);
	$totalRows_cuotas = mysql_num_rows($cuotas);
	
	if($row_cuotas['dias'] > 0 || $row_cuotas['diaseq'] > 0)
	{
		$DiasCredito = $row_cuotas['diaseq'];	
		$Cuotas = $row_cuotas['cuenta'];	
		if($row_cuotas['dias'] > $row_cuotas['diaseq'])
			$DiasCredito = $row_cuotas['dias'];	
	}
	$dispo = $row_clientes['cli_cupo'] - $row_clientes['cli_dedudatotal'];
    
    
	if($row_clientes['cli_vendedor']==0){$vende=0;$v=1;} else {$vende=$row_clientes['cli_vendedor'];$v=$row_clientes['cli_vendedor'];}
	
	if(ver_menu($conectado, $database_conectado, $_SESSION['MM_Username'],"DESCUENTOS",0) != true)
	{		
		if($row_clientes['cli_precio'] != 1) // SI EL CLIENTE TIENE PRECIO DIFERENCTE DE CONSUMIDOR FINAL //
		{	
										
			echo '<script LANGUAGE="JavaScript"> 
			var a=0;
				window.opener.document.form1.ciruc.value="'.$row_clientes['cli_ciruc'].'"; 
				window.opener.document.form1.clinombre.value="'.$row_clientes['cli_apellidos']." ".$row_clientes['cli_nombres'].'"; 
				window.opener.document.form1.clidireccion.value="'.$row_clientes['cli_direccion'].'"; 
				window.opener.document.form1.telf.value="'.$row_clientes['cli_telefono'].'"; 
				window.opener.document.form1.recordID.value="'.$row_clientes['cli_codigo'].'";
				window.opener.document.form1.dcredito.value="'.$row_cuotas['dias'].'"; 
				window.opener.document.form1.dcreditoeq.value="'.$row_cuotas['diaseq'].'"; 
				window.opener.document.form1.ncuotas.value="'.$Cuotas.'"; 
				window.opener.document.form1.precio.value="'.$row_clientes['cpre_descripcion'].'";
				window.opener.document.form1.pre.value="'.$row_clientes['cli_precio'].'";
				window.opener.document.form1.mora.value="'.$row_clientes['cli_mora'].'"; 	
				window.opener.document.form1.cupo_ventas.value="'.$row_clientes['cli_cupo'].'";
				window.opener.document.form1.disponible_ventas.value="'.$dispo.'";
                window.opener.document.form1.cbmvendedorcodigo.value="'.$vende.'";
				window.opener.document.form1.correoelectronico.value="'.$row_clientes['cli_email'].'";
				//window.opener.document.form1.cuantas.value="'.$row_clientes['cli_carteracuotas'].'"; 
				//window.opener.document.form1.suman.value="'.$row_clientes['cli_cartera'].'"; 
				//window.opener.document.form1.dias.value="'.$row_clientes['cli_carteradias'].'";
				window.opener.document.form1.categoria.value="'.$row_clientes['cli_categoria'].'";
				
						
				if("'.$row_clientes['cli_interelacion'].'" == 1 )
				{
					window.opener.document.form1.porcendesc.readOnly = false;
					window.opener.document.form1.ddesc[0].disabled = false;
					window.opener.document.form1.ddesc[1].disabled = false;
				}
				else
				{
					window.opener.document.form1.porcendesc.readOnly = false;
					window.opener.document.form1.ddesc[0].disabled = false;
					window.opener.document.form1.ddesc[1].disabled = false;
				}					
			</script>';		 
		}
	 	else // CUANDO EL CLIENTE ES CONSUMIDOR FINAL
		{  
			echo '<script LANGUAGE="JavaScript">			 
				window.opener.document.form1.ciruc.value="'.$row_clientes['cli_ciruc'].'"; 
				window.opener.document.form1.clinombre.value="'.$row_clientes['cli_apellidos']." ".$row_clientes['cli_nombres'].'"; 
				window.opener.document.form1.clidireccion.value="'.$row_clientes['cli_direccion'].'"; 
				window.opener.document.form1.telf.value="'.$row_clientes['cli_telefono'].'"; 
				window.opener.document.form1.recordID.value="'.$row_clientes['cli_codigo'].'";
				window.opener.document.form1.dcredito.value="'.$row_cuotas['dias'].'"; 
				window.opener.document.form1.dcreditoeq.value="'.$row_cuotas['diaseq'].'"; 
				window.opener.document.form1.ncuotas.value="'.$Cuotas.'"; 
				window.opener.document.form1.precio.value="'.$row_clientes['cpre_descripcion'].'";
				window.opener.document.form1.pre.value="'.$row_clientes['cli_precio'].'";
				window.opener.document.form1.mora.value="'.$row_clientes['cli_mora'].'"; 	
				window.opener.document.form1.cupo_ventas.value="'.$row_clientes['cli_cupo'].'";
				window.opener.document.form1.disponible_ventas.value="'.$dispo.'";
                window.opener.document.form1.cbmvendedorcodigo.value="'.$vende.'";
				window.opener.document.form1.correoelectronico.value="'.$row_clientes['cli_email'].'";
				//window.opener.document.form1.cuantas.value="'.$row_clientes['cli_carteracuotas'].'"; 
				//window.opener.document.form1.suman.value="'.$row_clientes['cli_cartera'].'"; 
				//window.opener.document.form1.dias.value="'.$row_clientes['cli_carteradias'].'";
				window.opener.document.form1.categoria.value="'.$row_clientes['cli_categoria'].'";
				
											
				if("'.$row_clientes['cli_interelacion'].'" == 1 )
				{
					window.opener.document.form1.porcendesc.readOnly = false;
					window.opener.document.form1.ddesc[0].disabled = false;
					window.opener.document.form1.ddesc[1].disabled = false;
				}
				else
				{
					window.opener.document.form1.porcendesc.readOnly = false;
					window.opener.document.form1.ddesc[0].disabled = false;
					window.opener.document.form1.ddesc[1].disabled = false;
				}										
			</script>';			
		 }
	}
 	else
	{
		echo '<script LANGUAGE="JavaScript"> 				
		window.opener.document.form1.ciruc.value="'.$row_clientes['cli_ciruc'].'"; 
		window.opener.document.form1.clinombre.value="'.$row_clientes['cli_apellidos']." ".$row_clientes['cli_nombres'].'"; 
		window.opener.document.form1.clidireccion.value="'.$row_clientes['cli_direccion'].'"; 
		window.opener.document.form1.telf.value="'.$row_clientes['cli_telefono'].'"; 
		window.opener.document.form1.recordID.value="'.$row_clientes['cli_codigo'].'";
		window.opener.document.form1.dcredito.value="'.$row_cuotas['dias'].'"; 
		window.opener.document.form1.dcreditoeq.value="'.$row_cuotas['diaseq'].'"; 
		window.opener.document.form1.ncuotas.value="'.$Cuotas.'"; 
		window.opener.document.form1.precio.value="'.$row_clientes['cpre_descripcion'].'";
		window.opener.document.form1.pre.value="'.$row_clientes['cli_precio'].'";
		window.opener.document.form1.mora.value="'.$row_clientes['cli_mora'].'"; 	
		window.opener.document.form1.cupo_ventas.value="'.$row_clientes['cli_cupo'].'";
		window.opener.document.form1.disponible_ventas.value="'.$dispo.'";
        window.opener.document.form1.cbmvendedorcodigo.value="'.$vende.'";
		window.opener.document.form1.correoelectronico.value="'.$row_clientes['cli_email'].'";
		//window.opener.document.form1.cuantas.value="'.$row_clientes['cli_carteracuotas'].'"; 
		//window.opener.document.form1.suman.value="'.$row_clientes['cli_cartera'].'"; 
		//window.opener.document.form1.dias.value="'.$row_clientes['cli_carteradias'].'";
		window.opener.document.form1.categoria.value="'.$row_clientes['cli_categoria'].'";
		
				
				
		window.opener.document.form1.porcendesc.readOnly=false;
		if("'.$row_clientes['cli_interelacion'].'" == 1 )
		{
			window.opener.document.form1.porcendesc.readOnly = false;
			window.opener.document.form1.ddesc[0].disabled = false;
			window.opener.document.form1.ddesc[1].disabled = false;
		}
		else
		{
			window.opener.document.form1.porcendesc.readOnly = false;
			window.opener.document.form1.ddesc[0].disabled = false;
			window.opener.document.form1.ddesc[1].disabled = false;
		}		
	    </script>';
		
	 }
//vuelve a poner en cero la factura	 
	$texto='';
	$b=0;
	if($row_clientes['cli_cartera']>0)
	{		
		$texto='Advertencia:\n   * El cliente tiene '.$row_clientes['cli_carteracuotas'].' cuotas vencidas.\n * Suman: $'.$row_clientes['cli_cartera'].'.\n   * Un total de '.$row_clientes['cli_carteradias'].' dias.';
		$b=1;
	}
	if($row_clientes['cli_mora']==1)
	{
		$texto = $texto.'\n   * Cliente Bloqueado';
		$b=1;		
	}
	/* if($b==1) {echo '<script LANGUAGE="JavaScript">alert("'.$texto.'")</script>';} */
	$bandera=1;
	$cero='';
	$lineas = $_POST['lineas'];
	if($_POST['precio'] != $row_clientes['cli_precio'])
	{
		for($i=1;$i<=$lineas;$i++)
		{
			$cero = $cero.'window.opener.document.form1.COD'.$i.'.value="";
			window.opener.document.form1.DESC'.$i.'.value="";
			window.opener.document.form1.CNT'.$i.'.value=0;
			window.opener.document.form1.CNT1_'.$i.'.value=0;
			window.opener.document.form1.desct'.$i.'.value=0;
			window.opener.document.form1.COMPRA'.$i.'.value=0;
			window.opener.document.form1.TOT'.$i.'.value=0;
			window.opener.document.form1.STK'.$i.'.value=0;
			window.opener.document.form1.STK1_'.$i.'.value=0;
			window.opener.document.form1.IBA'.$i.'.value="";';						
		}
	}
	if($codigo_final == $row_clientes['cli_codigo'])
	{
		$cero = $cero.'window.opener.document.form1.fac_retencion.disabled = true;';		
	}else
	{
		$cero = $cero.'window.opener.document.form1.fac_retencion.disabled = false;';			
	}
	echo '<script LANGUAGE="JavaScript">
	
	if('.$DiasCredito.' == 0)
	{
		window.opener.document.form1.PAGO1.disabled = true;
	}else
	{
		window.opener.document.form1.PAGO1.disabled = false;
	}	
	window.opener.document.form1.PAGO3.disabled = false;	
	'.$cero.'window.opener.document.form1.guardar.disabled=true; 
	window.opener.document.form1.ocompras.focus(); 
	window.close();	
	</script>';//
}
/////////////////////////////////////////7777 
mysql_select_db($database_conectado, $conectado);
$query_tipo_cliente = "SELECT * FROM cliente_tipo";
$tipo_cliente = mysql_query($query_tipo_cliente, $conectado) or die(mysql_error());
$row_tipo_cliente = mysql_fetch_assoc($tipo_cliente);
$totalRows_tipo_cliente = mysql_num_rows($tipo_cliente);

mysql_select_db($database_conectado, $conectado);
$query_profesion_cliente = "SELECT * FROM cliente_profesion";
$profesion_cliente = mysql_query($query_profesion_cliente, $conectado) or die(mysql_error());
$row_profesion_cliente = mysql_fetch_assoc($profesion_cliente);
$totalRows_profesion_cliente = mysql_num_rows($profesion_cliente);

mysql_select_db($database_conectado, $conectado);
$query_precio_cliente = "SELECT * FROM cliente_precio";
$precio_cliente = mysql_query($query_precio_cliente, $conectado) or die(mysql_error());
$row_precio_cliente = mysql_fetch_assoc($precio_cliente);
$totalRows_precio_cliente = mysql_num_rows($precio_cliente);

mysql_select_db($database_conectado, $conectado);
$query_sucursal = "SELECT suc_codigo, suc_descripcion FROM sucursal ";
$sucursal = mysql_query($query_sucursal, $conectado) or die(mysql_error());
$row_sucursal = mysql_fetch_assoc($sucursal);
$totalRows_sucursal = mysql_num_rows($sucursal);

mysql_select_db($database_conectado, $conectado);
$query_provincias = "SELECT * FROM provincia";
$provincias = mysql_query($query_provincias, $conectado) or die(mysql_error());
$row_provincias = mysql_fetch_assoc($provincias);
$totalRows_provincias = mysql_num_rows($provincias); 

mysql_select_db($database_conectado, $conectado); // SELECT * FROM vendedor_sucursal  cod_emple, cod_sucur, fecha_asigna, usaurio_asigna
$query_vendedores = "SELECT codigo_vend, nombre_vend FROM vendedor ";
$vendedores = mysql_query($query_vendedores, $conectado) or die(mysql_error());
$row_vendedores = mysql_fetch_assoc($vendedores);

mysql_select_db($database_conectado, $conectado);
$query_ciudades = "SELECT * FROM ciudad ORDER BY ciu_nombre";
$ciudades = mysql_query($query_ciudades, $conectado) or die(mysql_error());
$row_ciudades = mysql_fetch_assoc($ciudades);
$totalRows_ciudades = mysql_num_rows($ciudades);

mysql_select_db($database_conectado, $conectado);
$query_fechas = "SELECT curdate() as fecha";
$fechas = mysql_query($query_fechas, $conectado) or die(mysql_error());
$row_fechas = mysql_fetch_assoc($fechas);
$totalRows_fechas = mysql_num_rows($fechas);

$fecha_hoy = $row_fechas['fecha'];
$lineas = $_GET['lineas'];

$colname_clientes = ""; // urlencode($_GET['cliente']);
if (isset($_GET['cliente'])) {
  $colname_clientes = $_GET['cliente'];
}

$colname_matriz = "";
if (isset($_GET['ciudad'])) {
  $colname_matriz = $_GET['ciudad'];
}
$maxRows_clientes = 20;
$pageNum_clientes = 0;
if (isset($_GET['pageNum_clientes'])) {
  $pageNum_clientes = $_GET['pageNum_clientes'];
}
$startRow_clientes = $pageNum_clientes * $maxRows_clientes;

mysql_select_db($database_conectado, $conectado);
$query_clientes = sprintf("SELECT * FROM cliente left join cliente_precio on cli_precio = cpre_codigo WHERE cli_ciruc like %s or cli_nombres like %s or cli_apellidos like %s ORDER BY cli_ciruc", GetSQLValueString("%".$colname_clientes."%", "text"), GetSQLValueString("%".$colname_clientes."%", "text"), GetSQLValueString("%".$colname_clientes."%", "text"));
$query_limit_clientes = sprintf("%s LIMIT %d, %d", $query_clientes, $startRow_clientes, $maxRows_clientes);
$clientes = mysql_query($query_limit_clientes, $conectado) or die(mysql_error());
$row_clientes = mysql_fetch_assoc($clientes);
$totalRows_clientes = mysql_num_rows($clientes);	

if ($totalRows_clientes == 0)
{
	mysql_select_db($database_conectado, $conectado);
	//echo $colname_clientes;
	
	$query_clientes = sprintf("SELECT * FROM cliente inner join cliente_precio on cli_precio = cpre_codigo 
	WHERE (cli_apellidos like %s OR cli_nombres like %s) ORDER BY cli_apellidos, cli_nombres ",
							GetSQLValueString($colname_clientes."%", "text"), 
							GetSQLValueString($colname_clientes."%", "text"));
	$query_limit_clientes = sprintf("%s LIMIT %d, %d", $query_clientes, $startRow_clientes, $maxRows_clientes);
	$clientes = mysql_query($query_clientes, $conectado) or die(mysql_error());
	$row_clientes = mysql_fetch_assoc($clientes);
	$totalRows_clientes = mysql_num_rows($clientes);	
	
	if ($totalRows_clientes == 0)
	{
		mysql_select_db($database_conectado, $conectado);
		$query_clientes = sprintf("SELECT * FROM cliente inner join cliente_precio on cli_precio = cpre_codigo 
		WHERE (cli_nombres like %s OR cli_apellidos like %s) ORDER BY cli_nombres ", 
							GetSQLValueString($colname_clientes."%", "text"), 
							GetSQLValueString($colname_clientes."%", "text"));
		$query_limit_clientes = sprintf("%s LIMIT %d, %d", $query_clientes, $startRow_clientes, $maxRows_clientes);
		$clientes = mysql_query($query_clientes, $conectado) or die(mysql_error());
		$row_clientes = mysql_fetch_assoc($clientes);
		$totalRows_clientes = mysql_num_rows($clientes);	
	}
}

if (isset($_GET['totalRows_clientes'])) {
  $totalRows_clientes = $_GET['totalRows_clientes'];
} else {
  $all_clientes = mysql_query($query_clientes);
  $totalRows_clientes = mysql_num_rows($all_clientes);
}
$totalPages_clientes = ceil($totalRows_clientes/$maxRows_clientes)-1;


if($totalRows_clientes == 1)
{	
	/// VERIFICA SI EL CLIENTE TIENE CREDITO ///
	$DiasCredito = 0;
	$Cuotas = 0;
	mysql_select_db($database_conectado, $conectado);
	$query_cuotas = "SELECT count(clic_dias) as cuenta, max(clic_dias) as dias, max(clic_dias_eq) as diaseq  FROM cliente_cuotas WHERE clic_cliente = ".$row_clientes['cli_codigo'];
	$cuotas = mysql_query($query_cuotas, $conectado) or die(mysql_error());
	$row_cuotas = mysql_fetch_assoc($cuotas);
	$totalRows_cuotas = mysql_num_rows($cuotas);
	
	mysql_select_db($database_conectado, $conectado);
	$query_vendeq = "SELECT * FROM fparametros_ventas where nparametro = 'consumidor_final'";
	$vendeq = mysql_query($query_vendeq, $conectado) or die(mysql_error());
	$row_vendeq = mysql_fetch_assoc($vendeq);
	$totalRows_vendeq = mysql_num_rows($vendeq);
	$codigo_final = $row_vendeq['sucursal_1'];
	
	if($row_cuotas['dias'] > 0 || $row_cuotas['diaseq'] > 0)
	{
		$DiasCredito = $row_cuotas['diaseq'];	
		$Cuotas = $row_cuotas['cuenta'];	
		if($row_cuotas['dias'] > $row_cuotas['diaseq'])
			$DiasCredito = $row_cuotas['dias'];	
	}

	if($row_clientes['cli_vendedor']==0){$vende=1;$v=1;}else {$vende=$row_clientes['cli_vendedor'];$v=$row_clientes['cli_vendedor'];}
	$tabla='fpago_'.$_GET['ciudad'];
	$b=0;
	if($row_clientes['cli_cartera']>0)
	{		
		$texto='Advertencia:\n   * El cliente tiene '.$row_clientes['cli_carteracuotas'].' cuotas vencidas.\n * Suman: $'.$row_clientes['cli_cartera'].'.\n   * Un total de '.$row_clientes['cli_carteradias'].' dias.';
		$b=1;
	}
	if($row_clientes['cli_mora']==1)
	{
		$texto = $texto.'\n   * Cliente Bloqueado';
		$b=1;		
	}
	/* if($b==1){echo '<script LANGUAGE="JavaScript">alert("'.$texto.'")</script>';} */
	$dispo = $row_clientes['cli_cupo'] - $row_clientes['cli_dedudatotal'];
	echo '<script LANGUAGE="JavaScript"> 
	window.opener.document.form1.ciruc.value="'.$row_clientes['cli_ciruc'].'"; 
	window.opener.document.form1.clinombre.value="'.$row_clientes['cli_apellidos']." ".$row_clientes['cli_nombres'].'"; 
	window.opener.document.form1.clidireccion.value="'.$row_clientes['cli_direccion'].'"; 
	window.opener.document.form1.telf.value="'.$row_clientes['cli_telefono'].'"; 
	window.opener.document.form1.recordID.value="'.$row_clientes['cli_codigo'].'";
	window.opener.document.form1.dcredito.value="'.$row_cuotas['dias'].'"; 
	window.opener.document.form1.dcreditoeq.value="'.$row_cuotas['diaseq'].'"; 
	window.opener.document.form1.ncuotas.value="'.$Cuotas.'"; 
	window.opener.document.form1.precio.value="'.$row_clientes['cpre_descripcion'].'";
	window.opener.document.form1.pre.value="'.$row_clientes['cli_precio'].'";
	window.opener.document.form1.mora.value="'.$row_clientes['cli_mora'].'"; 	
	window.opener.document.form1.cupo_ventas.value="'.$row_clientes['cli_cupo'].'";
		window.opener.document.form1.correoelectronico.value="'.$row_clientes['cli_email'].'";
	window.opener.document.form1.disponible_ventas.value="'.$dispo.'";	
	window.opener.document.form1.cbmvendedorcodigo.value="'.$vende.'";
	//window.opener.document.form1.cuantas.value="'.$row_clientes['cli_carteracuotas'].'"; 
	//window.opener.document.form1.suman.value="'.$row_clientes['cli_cartera'].'"; 
	//window.opener.document.form1.dias.value="'.$row_clientes['cli_carteradias'].'";
	window.opener.document.form1.categoria.value="'.$row_clientes['cli_categoria'].'";

	
	if('.$row_clientes['cli_precio'].' != 1 ) 
	{
		window.opener.document.form1.porcendesc.readOnly = false;
		window.opener.document.form1.ddesc[0].disabled = false;
		window.opener.document.form1.ddesc[1].disabled = false;	
		if('.$row_clientes['cli_interelacion'].' == 1)
		{
			window.opener.document.form1.porcendesc.readOnly = false;
			window.opener.document.form1.ddesc[0].disabled = false;
			window.opener.document.form1.ddesc[1].disabled = false;
		}		
	}else
	{
	
		if('.$row_clientes['cli_interelacion'].' == 1)
		{
			window.opener.document.form1.porcendesc.readOnly = false;
			window.opener.document.form1.ddesc[0].disabled = false;
			window.opener.document.form1.ddesc[1].disabled = false;
		}
		else
		{
			window.opener.document.form1.porcendesc.readOnly = false;
			window.opener.document.form1.ddesc[0].disabled = false;
			window.opener.document.form1.ddesc[1].disabled = false;
		}
	}		
	</script>';	
	
	$lineas = $_GET['lineas'];
	$precio = $_GET['precio'];
	if($precio != $row_clientes['cli_precio'])
	{
		for($i=1;$i<=$lineas;$i++)
		{
			$cero = $cero.'window.opener.document.form1.COD'.$i.'.value="";
			window.opener.document.form1.DESC'.$i.'.value="";
			window.opener.document.form1.CNT'.$i.'.value=0;
			window.opener.document.form1.CNT1_'.$i.'.value=0;
			window.opener.document.form1.desct'.$i.'.value=0;
			window.opener.document.form1.COMPRA'.$i.'.value=0;
			window.opener.document.form1.TOT'.$i.'.value=0;
			window.opener.document.form1.STK'.$i.'.value=0;
			window.opener.document.form1.STK1_'.$i.'.value=0;
			window.opener.document.form1.IBA'.$i.'.value="";';						
		}
	}
	if($codigo_final == $row_clientes['cli_codigo'])
	{
		$cero = $cero.'window.opener.document.form1.fac_retencion.disabled = true;';		
	}else
	{
		$cero = $cero.'window.opener.document.form1.fac_retencion.disabled = false;';			
	}
	
	echo '
	<script LANGUAGE="JavaScript">
	
	if('.$DiasCredito.' == 0)
	{
		window.opener.document.form1.PAGO1.disabled = true;
	}else
	{
		window.opener.document.form1.PAGO1.disabled = false;
	}
	window.opener.document.form1.PAGO3.disabled = false;
	'.$cero.'window.opener.document.form1.guardar.disabled=true; window.opener.document.form1.ocompras.focus(); 
	window.close();
	</script>';//
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<LINK href="../sky/demo.css" rel="stylesheet">		 
<LINK href="../sky/sky-forms.css" rel="stylesheet">
<LINK href="../sky/sky-forms-green.css" rel="stylesheet">
<title>Sysadvisor</title>
<link rel="stylesheet" type="text/css" href="../calendar/scalendar/tcal.css" />
<script type="text/javascript" src="../calendar/scalendar/tcal.js"></script>

<script src="../js/tablas.js"></script>	
<script type="text/javascript" src="../js/validaciones.js"></script>
<script type="text/javascript" src="../js/combos_multiples.js"> </script>

<script type="text/javascript">
<?php if($totalRows_clientes == 0){ ?>
function makeSublist(parent,child,isSubselectOptional,childVal)
{
	$("body").append("<select style='display:none' id='"+parent+child+"'></select>");
	$('#'+parent+child).html($("#"+child+" option"));
	
		var parentValue = $('#'+parent).attr('value');
		$('#'+child).html($("#"+parent+child+" .sub_"+parentValue).clone());
	
	childVal = (typeof childVal == "undefined")? "" : childVal ;
	$("#"+child+' option[@value="'+ childVal +'"]').attr('selected','selected');
	
	$('#'+parent).change( 
		function()
		{
			var parentValue = $('#'+parent).attr('value');
			$('#'+child).html($("#"+parent+child+" .sub_"+parentValue).clone());
			if(isSubselectOptional) $('#'+child).prepend("<option value='none'> -- Select -- </option>");
			$('#'+child).trigger("change");
                        $('#'+child).focus();
		}
	);
}

$(document).ready(function()
{
	makeSublist('child','grandsun', true, '');	
	makeSublist('parent','child', false, '1');	
});

function validar_formulario(campo)
{
	if(document.form3[campo].value!=''&&document.form3.cli_nombres.value!=''&&document.form3.cli_apellidos.value!=''&&document.form3.cli_telefono.value!=''&&document.form3.cli_direccion.value!='')
		document.form3.guardar.disabled=false;
	else
		document.form3.guardar.disabled=true;	
}
<?php } ?>

function validar_documento(campo)
{
	ced=window.document.form3[campo].value;
	largo=ced.length;
	document.form3.validacionCedulaRuc.value='OK';
	if(ced.length==10)
	{
		bandera=valida_cedula(ced);
		if (bandera==false)
		{
			alert("Cedula mal ingresada");
			document.form3[campo].focus();
			document.form3[campo].select();	
			document.form3.validacionCedulaRuc.value='';
		}else
		{
			document.form3.guardar.disabled = false;
			document.form3.validacionCedulaRuc.value='OK';
			/// lamar a ventana para validar el si el ruc o ci esta ya ingresado en la tabla de clientes.			
	window.open('factura_validacli.php?cedula='+ced+'','D'+ced+'Cliente','width=400, height=400, scrollbars=yes, menubar=yes, location=yes, resizable=yes');
	window.open('resultado.php?cedula='+ced+'','miwin'+ced+'Cliente','width=40, height=40, scrollbars=yes, menubar=yes, location=yes, resizable=yes');
			window.open('resultadoSRI.php?cedula='+ced+'','miwin'+ced+'Cliente','width=40, height=40, scrollbars=yes, menubar=yes, location=yes, resizable=yes');
	//window.open("resultado.php?cedularuc="+cedularuc,"miwin","width=900,height=600,scrollbars=yes,top=100px,left=0px") ;
		}
		
	}
	else if (ced.length==13)
	{
		//bandera=valida_ruc(ced,1);
		//bandera=validarRUC(ced);
		bandera=true;
		if (bandera==false)
		{
			alert("Ruc mal ingresado");
			document.form3[campo].focus();
			document.form3[campo].select();	
			document.form3.validacionCedulaRuc.value='';	
		}else
		{
			document.form3.guardar.disabled = false;
			document.form3.validacionCedulaRuc.value='OK';
			/// lamar a ventana para validar el si el ruc o ci esta ya ingresado en la tabla de clientes.
			window.open('factura_validacli.php?cedula='+ced+'','D'+ced+'Cliente','width=400, height=400, scrollbars=yes, menubar=yes, location=yes, resizable=yes');
			window.open('resultado.php?ruc='+ced+'','miwin'+ced+'Cliente','width=40, height=40, scrollbars=yes, menubar=yes, location=yes, resizable=yes');
		}	
	
	}else
	{
		document.form3.guardar.disabled=true;
		document.form3.validacionCedulaRuc.value='';
		alert("Cedula/Ruc mal ingresados...");
		document.form3[campo].focus();
		document.form3[campo].select();
		document.form3[campo].value = "";
	}
}

function activa_campo(activar, desactivar, desactivar1)
{
	document.form3[activar].disabled=false;
	document.form3[desactivar].disabled=true;	
	document.form3[desactivar].value = "";
	document.form3[desactivar1].disabled=true;	
	document.form3[desactivar1].value = "";
	
	document.form3[activar].focus();
	document.form3[activar].select();
	
	if(activar=='cli_pasa')
		document.form3.validacionCedulaRuc.value='OK';
	else
		document.form3.validacionCedulaRuc.value='';	
}

<!--
function valida_cedula(cedula)
{
     var condicion="212121212";
     var num=0;
     var todo=0;
     for (i=0;i<9;i++)
        {
           num=(parseInt(cedula.substring(i,i+1))*parseInt(condicion.substring(i,i+1)));
           if (num > 9)
                   num=num-9;
          todo=todo+num;   
         }
     todo=todo%10;
     todo=10-todo;
     if (todo==10)
          todo=0;
      if (todo==cedula.substring(i,i+1))
            return true;
      else
            return false;
}


function validar()
{
	ced=window.document.form3.ci.value;
	largo=ced.length;
//	alert(largo);
	
//	document.form3.ci.value=valcedula(cedula);
	//alert(ci);
	if(document.form3.ci.value!=''&&document.form3.pernombres.value!=''&&document.form3.apellidos.value!=''&&document.form3.pertelefcasa.value!=''&&document.form3.perdireccasa.value!='')
		document.form3.guardar.disabled=false;
	else
		document.form3.guardar.disabled=true;
	if(ced.length==10)
	{
		bandera=valida_cedula(ced);
		if (bandera==false)
		{
			alert("Cedula mal ingresados");	
		}else
		{
			document.form3.guardar.disabled=false;
		}
		
	}
	else if (ced.length==13)
	{
		bandera=valida_ruc(ced,1);
		if (bandera==false)
		{
			alert("Ruc mal ingresados");	
		}else
		{
			document.form3.guardar.disabled=false;
		}	
	
	}else{
		document.form3.guardar.disabled=true;
		alert("Cedula/Ruc mal ingresados")
	}
}

function validarRUC(numero) 
{          
//numero = document.getElementById('ruc').value;
/* alert(numero); */
	var suma = 0;      
	var residuo = 0;      
	var pri = false;      
	var pub = false;            
	var nat = false;      
	var numeroProvincias = 24;                  
	var modulo = 11;
			  
	/* Verifico que el campo no contenga letras */                  
	var ok=1;
	for (i=0; i<numero.length && ok==1 ; i++){
	 var n = parseInt(numero.charAt(i));
	 if (isNaN(n)) ok=0;
	}
	if (ok==0)
	{
	 alert("No puede ingresar caracteres en el número");         
	 return false;
	}
			  
	if (numero.length < 10 )
	{              
	 alert('El número ingresado no es válido');                  
	 return false;
	}
	
	/* Los primeros dos digitos corresponden al codigo de la provincia */
	provincia = numero.substr(0,2);      
	if (provincia < 1 || provincia > numeroProvincias)
	{           
	 alert('El código de la provincia (dos primeros dígitos) es inválido');
	return false;       
	}
	/* Aqui almacenamos los digitos de la cedula en variables. */
	d1  = numero.substr(0,1);         
	d2  = numero.substr(1,1);         
	d3  = numero.substr(2,1);         
	d4  = numero.substr(3,1);         
	d5  = numero.substr(4,1);         
	d6  = numero.substr(5,1);         
	d7  = numero.substr(6,1);         
	d8  = numero.substr(7,1);         
	d9  = numero.substr(8,1);         
	d10 = numero.substr(9,1);                
	 
	/* El tercer digito es: */                           
	/* 9 para sociedades privadas y extranjeros   */         
	/* 6 para sociedades publicas */         
	/* menor que 6 (0,1,2,3,4,5) para personas naturales */ 
	if (d3==7 || d3==8)
	{           
	 alert('El tercer dígito ingresado es inválido');                     
	 return false;
	}         
	 
	/* Solo para personas naturales (modulo 10) */         
	if (d3 < 6)
	{           
	 nat = true;            
	 p1 = d1 * 2;  if (p1 >= 10) p1 -= 9;
	 p2 = d2 * 1;  if (p2 >= 10) p2 -= 9;
	 p3 = d3 * 2;  if (p3 >= 10) p3 -= 9;
	 p4 = d4 * 1;  if (p4 >= 10) p4 -= 9;
	 p5 = d5 * 2;  if (p5 >= 10) p5 -= 9;
	 p6 = d6 * 1;  if (p6 >= 10) p6 -= 9; 
	 p7 = d7 * 2;  if (p7 >= 10) p7 -= 9;
	 p8 = d8 * 1;  if (p8 >= 10) p8 -= 9;
	 p9 = d9 * 2;  if (p9 >= 10) p9 -= 9;             
	 modulo = 10;
	}         
	/* Solo para sociedades publicas (modulo 11) */                  
	/* Aqui el digito verficador esta en la posicion 9, en las otras 2 en la pos. 10 */
	else if(d3 == 6)
	{           
	 pub = true;             
	 p1 = d1 * 3;
	 p2 = d2 * 2;
	 p3 = d3 * 7;
	 p4 = d4 * 6;
	 p5 = d5 * 5;
	 p6 = d6 * 4;
	 p7 = d7 * 3;
	 p8 = d8 * 2;            
	 p9 = 0;            
	}          
	else if(d3 == 9) /* Solo para entidades privadas (modulo 11) */         
	{           
	 pri = true;                                   
	 p1 = d1 * 4;
	 p2 = d2 * 3;
	 p3 = d3 * 2;
	 p4 = d4 * 7;
	 p5 = d5 * 6;
	 p6 = d6 * 5;
	 p7 = d7 * 4;
	 p8 = d8 * 3;
	 p9 = d9 * 2;            
	}
			
	suma = p1 + p2 + p3 + p4 + p5 + p6 + p7 + p8 + p9;                
	residuo = suma % modulo;                                         
	/* Si residuo=0, dig.ver.=0, caso contrario 10 - residuo*/
	digitoVerificador = residuo==0 ? 0: modulo - residuo;                
	/* ahora comparamos el elemento de la posicion 10 con el dig. ver.*/                         
	if (pub==true)
	{           
	 if (digitoVerificador != d9)
	 {                          
		alert('El ruc de la empresa del sector público es incorrecto.');            
		return false;
	 }                  
	 /* El ruc de las empresas del sector publico terminan con 0001*/         
	 if ( numero.substr(9,4) != '0001' ){                    
		alert('El ruc de la empresa del sector público debe terminar con 0001');
		return false;
	 }
	}         
	else if(pri == true)
	{         
	 if (digitoVerificador != d10)
	 {                          
		alert('El ruc de la empresa del sector privado es incorrecto.');
		return false;
	 }         
	 if ( numero.substr(10,3) != '001' )
	 {                    
		alert('El ruc de la empresa del sector privado debe terminar con 001');
		return false;
	 }
	}      
	else if(nat == true)
	{         
	 if (digitoVerificador != d10)
	 {                          
		alert('El número de cédula de la persona natural es incorrecto.');
		return false;
	 }         
	 if (numero.length >10 && numero.substr(10,3) != '001' )
	 {                    
		alert('El ruc de la persona natural debe terminar con 001');
		return false;
	 }
	}      
	return true;   
}            

function valida_ruc(cedula,band)
{
 if (cedula.substring(3,2)==9)
  {
 //    alert("Nueve");
	 var condicion="432765432";
     var num=0;
     var todo=0;
     for (i=0;i<9;i++)
        {
           num=(parseInt(cedula.substring(i,i+1))*parseInt(condicion.substring(i,i+1)));
           todo=todo+num;   
         }
     todo=(todo%11);
	 if (todo!=0)
	 {
       todo=11-todo;
	 }
	 else
	 {
	   todo=0;
	 }
      if (todo==cedula.substring(i,i+1))
            return true;
      else
	  {
	   		if(band==0)
	   		    alert("El ruc esta mal ingresado");
	        return false;
	  }
   }
   else
   {
   if (cedula.substring(3,2)==6)
     {
//	     alert("seis");
		 var condicion="32765432";
		 var num=0;
		 var todo=0;
		 for (i=0;i<8;i++)
			{
			   num=(parseInt(cedula.substring(i,i+1))*parseInt(condicion.substring(i,i+1)));
			   todo=todo+num;   
			 }
		 todo=(todo%11);
		 if (todo!=0)
		 {
		   todo=11-todo;
		 }
		 else
		 {
		   todo=0;
		 }
		  if (todo==cedula.substring(i,i+1))
				return true;
		  else
		  {
				if(band==0)
					alert("El ruc esta mal ingresado");
				return false;
		  }
	   }//fin del if (cedula.substring(2)==6)
	   else
	   {
		 if (cedula.substring(3,2)<6)
		 {
			 var condicion="212121212";
			 var num=0;
			 var todo=0;
			 for (i=0;i<9;i++)
				{
				   num=(parseInt(cedula.substring(i,i+1))*parseInt(condicion.substring(i,i+1)));
				   if (num > 9)
						   num=num-9;
				  todo=todo+num;   
				 }
			 todo=todo%10;
			 todo=10-todo;
			 if (todo==10)
				  todo=0;
			  if (todo==cedula.substring(i,i+1))
					return true;
			  else
			  {
					if(band==0)
						alert("El ruc esta mal ingresado");
					return false;
			  }
	      }//fin del if (cedula.substring(2)<6)
	      else
	      {
	       if(band==0)
		     alert("El ruc esta mal ingresado");
		   return false;
		  }//fin del else del if (cedula.substring(2)<6)
	  }//fin del else del if (cedula.substring(2)==6)*/
   }//fin del else del  if (cedula.substring(2)==9)
}
function ltrim (str, charlist) {
  charlist = !charlist ? ' \\s\u00A0' : (charlist + '').replace(/([\[\]\(\)\.\?\/\*\{\}\+\$\^\:])/g, '$1');
  var re = new RegExp('^[' + charlist + ']+', 'g');
  return (str + '').replace(re, '');
}


function quitaespacios()
{
document.form3.cli_apellidos.value = ltrim(document.form3.cli_apellidos.value);
}
function sendform3()
{
	document.form3.submit();
}
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' debería contener una direccion de email.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' deberia contener un numero.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' deberia contener un numero '+min+' y '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' es requerida.\n'; }
    } if (errors) alert('Los siguientes error(es) pasaron:\n'+errors);
    document.MM_returnValue = (errors == '');
} }
</script>
</head>
<?php 
mysql_select_db($database_conectado, $conectado);
$query_Recordset1 = "select * from parametros where codigo=9";
$Recordset1 = mysql_query($query_Recordset1, $conectado) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
$ruc=$row_Recordset1['sucursal_1']; 
?>
<body class="sky-form" >
<HEADER><img src="ribbon/images/icon_doc.png" alt="Date and time" /><strong><?php if($totalRows_clientes!=0){ ?>LISTADO <?php }else{ ?>INGRESO <?php } ?>DE CLIENTES</strong></HEADER>
<table width="100%" >
  <tr>
    <td>
<?php if($totalRows_clientes!=0){ ?>
      <form id="form2" name="form2" method="get" action="">
        <center>
          <table class="main">
            <tr>
              <td><label><strong>Cliente Nombre </strong>
                <input name="ciudad" type="hidden" id="ciudad" value="<?php echo $_GET['ciudad'];?>" size="5" readonly="readonly" />
                <input name="precio" type="hidden" id="precio" value="<?php echo $_GET['precio'];?>" size="5" readonly="readonly" />
                <input name="lineas" type="hidden" id="lineas" value="<?php echo $_GET['lineas'];?>" size="5" readonly="readonly" />
              </label></td>
              <td><label class="input"><input name="cliente" type="text" id="cliente"  value="<?php if(isset( $_GET['cliente']))echo $colname_clientes;?>" size="35" maxlength="50" /></label></td>
              <td><input type="submit" name="Submit" value="Buscar" class="button" /></td>
            </tr>
          </table>
          <br />
        </center>
      </form>
<?php }?>
<?php if($totalRows_clientes!=0){ ?>      
      <form id="form1" name="form1" method="post" action="<?php echo $editFormAction; ?>">        
        <table border="0" align="center" class="main" width="100%">
          <tr class="subtitulo">
            <td><strong>Cedula / RUC</strong></td>
            <td><strong>Nombres</strong></td>
            <td><strong>Email</strong></td>
            <td><strong>Direccion</strong></td>
          </tr>
          <?php
   $i=0;
    do { ?>
          <tr>
            <td align="right"><?php echo $row_clientes['cli_ciruc']; ?></td>
            <td><a href="javascript:document.form1.codpro.value=<?php echo $i; ?>;document.form1.submit();"><?php echo $row_clientes['cli_apellidos']." ".$row_clientes['cli_nombres']; ?></a>              
              <input name="codigo<?php echo $i;?>" type="hidden" value="<?php echo $row_clientes['cli_codigo']; ?>" />
              </td>
            <td><?php echo $row_clientes['cli_email']; ?></td>
            <td><?php echo $row_clientes['cli_direccion']; ?></td>
          </tr>
          <?php
	 $i=$i+1; } while ($row_clientes = mysql_fetch_assoc($clientes)); ?>
        </table>
        <br />
        <input name="codpro" type="hidden" id="codpro" />
        <input name="precio" type="hidden" id="precio" value="<?php echo $_GET['precio'];?>" size="5" readonly="readonly" />
        <input type="hidden" name="MM_insert" value="form1" />
        <input name="lineas" type="hidden" id="lineas" value="<?php echo $_GET['lineas'];?>" size="5" readonly="readonly" />
      </form>
      <?php }else{ ?>
      <br />
      <form action="<?php echo $editFormAction; ?>" method="post" name="form3" id="form3">
        <input type="hidden" name="MM_insert" value="form3" />
        <table align="center" width="100%" class="main">
          <tr >
            <td colspan="6" align="right"><table width="100%" border="0">
              <tr>
                <td><strong><em>
                  <input name="cli_direccion1" type="hidden" class="blue_fields"/>
                </em></strong>*</td>
                <td><input type="radio" name="radio" id="pasaporte" value="pasaporte" onclick="activa_campo('cli_pasa','cli_ruc', 'cli_ci');" />
                  <strong>Pasa.</strong></td>
                <td><label class="input"><input type="text" name="cli_pasa" id="cli_pasa" maxlength="13" value="<?php echo $colname_clientes; ?>" /></label></td> 
                <td><strong>
                   <input type="radio" name="radio" id="CI" value="CI" onclick="activa_campo('cli_ci','cli_ruc', 'cli_pasa');" />
                  CI</strong></td>
                <td><strong>
                  <label class="input"><input name="cli_ci" type="text" disabled="disabled" class="blue_fields" id="cli_ci" onblur="validar_documento('cli_ci')" value="<?php echo $colname_clientes; ?>" size="16" maxlength="10" /></label>
                  </strong></td>
                <td><strong>
                  <input type="radio" name="radio" id="RUC" value="RUC" onclick="activa_campo('cli_ruc','cli_ci', 'cli_pasa');" />
                  RUC</strong></td>
                <td><strong>
                  <label class="input"><input name="cli_ruc" type="text" disabled="disabled" class="blue_fields" id="cli_ruc" onblur="validar_documento('cli_ruc')" value="<?php echo $colname_clientes; ?>" size="16" maxlength="13" /></label>
                  </strong></td>
                <td><input type="hidden" name="cli_fechaingreso" value="<?php echo $fecha_hoy; ?>" size="32" />
                  <input type="hidden" name="cli_iva" value="SI" size="32" />
                  <input name="cli_porcentajedescuento" id="cli_porcentajedescuento" type="hidden" class="blue_fields" value="0" size="10" />
                  <input name="cli_diascredito" type="hidden" class="blue_fields" value="0" size="10" />
                  <strong><em>(obligatorio) </em></strong></td>
                </tr>
            </table></td>
          </tr>
          <tr >
            <td align="right"><strong>* Apellidos:</strong></td>
            <td><label class="input"><input name="cli_apellidos" type="text" class="blue_fields" id="cli_apellidos"  onblur="form3.cli_apellidos.value = form3.cli_apellidos.value.toUpperCase();quitaespacios();" value="" size="40"/></label>
              </td>
            <td align="right"><strong>* Nombres:</strong></td>
            <td colspan="3"><label class="input"><input name="cli_nombres" type="text" class="blue_fields" id="cli_nombres" onblur="form3.cli_nombres.value = form3.cli_nombres.value.toUpperCase();" onclick="this.select()" value="." size="40" /></label>
              </td>
          </tr>
          <tr >
            <td align="right" valign="top"><strong>* Dirección:</strong></td>
            <td colspan="5"><label class="input"><input name="cli_direccion" class="blue_fields" onblur="form3.cli_direccion.value = form3.cli_direccion.value.toUpperCase();"/></label>
              </td>
          </tr>
          <tr >
            <td align="right"><strong>*Celular/ Telefono:</strong></td>
            <td><label class="input"><input name="cli_telefono" type="text" class="blue_fields" id="cli_telefono" value="" size="12" /></label></td>
            <td align="right"><strong>Telefono 2:</strong></td>
            <td colspan="3"><label class="input"><input name="cli_telefono1" type="text" class="blue_fields" value="" size="12" /></label></td>
          </tr>
          <tr >
            <td align="right">&nbsp;</td>
            <td><label class="input"><input name="cli_celular" type="hidden" class="blue_fields" value="" size="15" style="width:200px" /></label></td>
            <td>&nbsp;</td>
            <td colspan="3">&nbsp;</td>
          </tr>
          <tr >
            <td align="right"><strong>Email:</strong></td>
            <td><label class="input"><input name="cli_email" type="text" class="blue_fields" id="cli_email" value="" size="40" /></label></td>
            <td align="right"><strong>Email 1:</strong></td>
            <td colspan="3"><label class="input"><input name="cli_email1" type="text" class="blue_fields" value="" size="40" /></label></td>
          </tr>
       <?php 
	   if ($ruc=='0190479994001') { ?>
          <tr >
            <td align="right"><strong>Nacimiento:</strong></td>
            <td><span class="input-group">
              <input name="txtnacimiento" id="txtnacimiento"  size="20" type="text" class="tcal" />
            </span></td>
            <td align="right"><strong>Genero:</strong></td>
            <td><span class="input-group">
              <select name="txtgenero" id="txtgenero"  class="form-control input-md">
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
              </select>
            </span></td>
            <td><strong>Civil:</strong></td>
            <td><span class="input-group">
              <select name="txtcivil" id="txtcivil"  class="form-control input-md">
                <option value="Soltero" selected="selected">Soltero</option>
                <option value="Casado">Casado</option>
                <option value="Divorciado">Divorciado</option>
                <option value="Viudo">Viudo</option>
                <option value="Union Libre">Union Libre</option>
              </select>
            </span></td>
          </tr> 
		  <?php } ?>
          <tr >
            <td align="right"><strong>Atención:</strong></td>
            <td><span title="Persona de Contacto.">
              <label class="input"><input name="cli_atencion" type="text" class="blue_fields" value="" size="40" /></label>
            </span></td>
            <td align="right">&nbsp;</td>
            <td colspan="3">&nbsp;</td>
          </tr>
          <tr >
            <td align="right"><strong>Tipo:</strong></td>
            <td><label class="select"><select name="cli_tipo" class="blue_fields">
              <?php 
do {  
?>
              <option value="<?php echo $row_tipo_cliente['ctipo_codigo']?>" ><?php echo $row_tipo_cliente['ctipo_descripcion']?></option>
              <?php
} while ($row_tipo_cliente = mysql_fetch_assoc($tipo_cliente));
?>
            </select></label></td>
            <td align="right"><strong>Profesión:</strong></td>
          
            <td colspan="3">
            <label class="select"><select name="cli_profesion" class="blue_fields">
              <?php 
do {  
?>
              <option value="<?php echo $row_profesion_cliente['cprof_codigo']?>" ><?php echo $row_profesion_cliente['cprof_descripcion']?></option>
              <?php
} while ($row_profesion_cliente = mysql_fetch_assoc($profesion_cliente)  );
?>
            </select></label>
            </td>
          </tr>
          <tr >
            <td align="right"><strong>Provincia: </strong></td>
            <td><label class="select"><select name="select" class="blue_fields" id="parent">
              <?php
do {  
?>
              <option value="<?php echo $row_provincias['pro_codigo']?>"><?php echo $row_provincias['pro_nombre']?></option>
              <?php
} while ($row_provincias = mysql_fetch_assoc($provincias));
  $rows = mysql_num_rows($provincias);
  if($rows > 0) {
      mysql_data_seek($provincias, 0);
	  $row_provincias = mysql_fetch_assoc($provincias);
  }
?>
            </select></label></td>
            <td align="right"><strong>Ciudad:</strong></td>
            <td colspan="3"><label class="select"><select name="cli_ubicacion" class="blue_fields" id="child">
              <?php 
do {  
?>
              <option value="<?php echo $row_ciudades['ciu_codigo']?>" class="<?php echo "sub_".$row_ciudades['ciu_provincia'];  ?>" ><?php echo $row_ciudades['ciu_nombre']?></option>
              <?php
} while ($row_ciudades = mysql_fetch_assoc($ciudades));
?>
            </select></label></td>
          </tr>
          <tr >
            <td align="right"><strong>* Precio Venta:</strong></td>
            <td><label class="select"><select name="cpre_descripcion" class="blue_fields">
              <option value="<?php echo "1"; ?>" selected="selected" ><?php echo "Consumidor Final"; ?></option>
			  <option value="<?php echo "2"; ?>" ><?php echo "Distribuidor"; ?></option>
            </select></label></td>
            <td align="right"><strong>Dias Credito:</strong></td>
            <td><label class="input"><input type="text" name="dcredito" id="dcredito" value="0" /></label></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr >
            <td align="right"><strong>Sucursal:</strong></td>
            <td><label class="select"><select name="cli_sucursal" class="blue_fields">
              <?php 
do {  
?>
              <option value="<?php echo $row_sucursal['suc_codigo']?>" ><?php echo $row_sucursal['suc_descripcion']?></option>
              <?php
} while ($row_sucursal = mysql_fetch_assoc($sucursal));
?>
            </select></label></td>
            <td align="right"><strong>Vendedor:</strong></td>
            <td colspan="3"><label class="select"><select name="vendedoringreso" class="blue_fields">
              <?php do {  ?>
              <option value="<?php echo $row_vendedores['codigo_vend'];?>" ><?php echo $row_vendedores['nombre_vend'];?></option>
              <?php
} while ($row_vendedores = mysql_fetch_assoc($vendedores)); ?>
            </select></label></td>
          </tr>
          <tr >
            <td align="right">&nbsp;</td>
            <td>
            <input type="hidden" name="validacionCedulaRuc" id="validacionCedulaRuc" readonly="readonly" /></td>
            <td>&nbsp;</td>
            <td colspan="3">&nbsp;</td>
          </tr>
          <tr >
            <td colspan="6" align="center"><input name="ciudad2" type="hidden" id="ciudad2" value="<?php echo $_GET['ciudad'];?>" size="5" readonly="readonly" />
              <input type="submit" name="guardar" id="guardar" value="Insertar registro" class="button" onclick="MM_validateForm('cliente','','R','cli_apellidos','','R','cli_nombres','','R','cli_telefono','','RisNum','cli_email','','RisEmail','validacionCedulaRuc','','R');return document.MM_returnValue" /></td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="form3" />
        <input name="precio" type="hidden" id="precio" value="<?php echo $_GET['precio'];?>" size="5" readonly="readonly" />
        <input name="lineas" type="hidden" id="lineas" value="<?php echo $_GET['lineas'];?>" size="5" readonly="readonly" />
        <input name="txtruc" type="hidden" id="txtruc" value="<?php echo $ruc;?>" size="5" readonly="readonly" />
      </form>
    <?php } ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php

mysql_free_result($clientes);

?>
