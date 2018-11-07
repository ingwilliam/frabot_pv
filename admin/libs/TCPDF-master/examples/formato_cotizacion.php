<?php

require_once('tcpdf_include.php');
require '../../../libs/Config.php'; //de configuracion
require '../../../libs/SPDO.php'; //PDO con singleton
require '../../../config.php'; //Archivo con configuraciones.
		
$db = SPDO::singleton();

$array_cliente = $db->consultRegistroSql("
            SELECT 
                    u.*,
                    ba.nombre as barrio,
                    cn.nombre as ciudad_nacimiento,
                    td.sigla as tipo_documento
            FROM usuario AS u
            LEFT JOIN tipo_documento as td ON u.tipo_documento=td.id
            INNER JOIN ciudad as cn ON cn.id=u.ciudad_ubicacion
            INNER JOIN barrio as ba ON ba.id=u.barrio
            WHERE u.id = ".$_GET["cliente"].";");

$array_cotizacion = $db->consultRegistroSql("
            SELECT 
                    c.*,
                    ba.nombre as barrio,
                    cn.nombre as ciudad                    
            FROM cotizacion AS c
            INNER JOIN ciudad as cn ON cn.id=c.ciudad
            INNER JOIN barrio as ba ON ba.id=c.barrio
            WHERE c.id = ".$_GET["cotizacion"].";");

$array_carrito = $db->listArraySql("
            SELECT 
                    c.*,           
                    a.nombre as articulo,
                    a.precio,
                    a.precio_publico,
                    a.codigo
            FROM carrito AS c                    
            INNER JOIN articulo as a ON a.id=c.articulo
            WHERE c.cotizacion = ".$_GET["cotizacion"].";","id");

$productos="";
$i=1;
$gran_total=0;
foreach($array_carrito as $clave => $valor)
{
 $gran_total=$gran_total+($valor[cantidad]*$valor[precio]);
 $productos=$productos.'<tr>
  <td style="background-color: #FFFFFF;color:#000000" align="center">'.$i.'</td>    
  <td style="background-color: #FFFFFF;color:#000000" align="center">'.$valor[codigo].'</td>    
  <td style="background-color: #FFFFFF;color:#000000" align="center">'.$valor[articulo].'</td>    
  <td style="background-color: #FFFFFF;color:#000000" align="center">'.$valor[cantidad].'</td>      
  <td style="background-color: #FFFFFF;color:#000000" align="center">$'.number_format($valor[precio]).'</td>    
  <td style="background-color: #FFFFFF;color:#000000" align="center">$'.number_format($valor[cantidad]*$valor[precio]).'</td>      
 </tr>';
 $i++;
}
$iva = $gran_total*0.19;
$total = $gran_total + $iva;
$gran_total = number_format($gran_total);
$total = number_format($total);
$iva = number_format($iva);
// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES . 'logoFRABOT.png';
        $this->Image($image_file, 15, 10, 50, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 12);

        // Title
        $this->Cell(0, 0, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->Cell(0, 0, 'Cotización en Línea', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->SetFont('helvetica', 'B', 6);
        $this->Cell(0, 0, 'www.frabot.co', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        // set style for barcode
        $style = array(
            'border' => 2,
            'vpadding' => 'auto',
            'hpadding' => 'auto',
            'fgcolor' => array(0, 0, 0),
            'bgcolor' => false, //array(255,255,255)
            'module_width' => 1, // width of a single module in points
            'module_height' => 1 // height of a single module in points
        );
        $this->Ln();
        $this->write2DBarcode('JAVIER BOTERO N COTIZACION '.$_GET["id"], 'QRCODE,L', 173, 6, 22, 22, $style, 'N');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }

}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Ingeniero William Barbosa');
$pdf->SetTitle('Formato Cotizacion Frabot');
$pdf->SetSubject('Formato Cotizacion Frabot');


// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', 7));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------
// set font
$pdf->SetFont('helvetica', '', 10);


// add a page
$pdf->AddPage();

/* NOTE:
 * *********************************************************
 * You can load external XHTML using :
 *
 * $html = file_get_contents('/path/to/your/file.html');
 *
 * External CSS files will be automatically loaded.
 * Sometimes you need to fix the path of the external CSS.
 * *********************************************************
 */

// define some HTML content with style
$html = <<<EOF
<!-- EXAMPLE OF CSS STYLE -->
<style>
        table {
		font-size: 8pt;	
	}
        
	td {
		border: 1px solid #000000;	
                background-color: #009688;
                color:#FFFFFF;
	}
</style>
<br/><br/>        
<table>
 <tr>
  <td width="110" align="center"><b>N° cotización</b></td>    
  <td width="120" align="center"><b>Fecha cotización</b></td>    
  <td width="150" align="center"><b>Tipo de pago</b></td>    
  <td width="258" align="center"><b>Cliente</b></td>    
</tr>
 <tr>
  <td style="background-color: #FFFFFF;color:#000000">$array_cotizacion[id]</td>    
  <td style="background-color: #FFFFFF;color:#000000">$array_cotizacion[fecha_envio]</td>    
  <td style="background-color: #FFFFFF;color:#000000">$array_cotizacion[tipo_pago]</td>    
  <td style="background-color: #FFFFFF;color:#000000">$array_cliente[tipo_documento] $array_cliente[primer_nombre] $array_cliente[segundo_nombre] $array_cliente[primer_apellido] $array_cliente[segundo_apellido]</td>      
</tr>
<tr>        
  <td align="center"><b>Ciudad</b></td>    
  <td align="center"><b>Celular - Telefono</b></td>    
  <td align="center"><b>Email</b></td>    
  <td align="center"><b>Direccion</b></td>            
 </tr> 
        <tr>
  <td style="background-color: #FFFFFF;color:#000000">$array_cotizacion[ciudad] $array_cotizacion[barrio]</td>    
  <td style="background-color: #FFFFFF;color:#000000">$array_cotizacion[celular] - $array_cotizacion[telefono]</td>    
  <td style="background-color: #FFFFFF;color:#000000">$array_cliente[usuario]</td>    
  <td style="background-color: #FFFFFF;color:#000000">$array_cotizacion[ubicacion]</td>          
</tr>
</table>
<br/><br/>        
<table>
 <tr>
  <td align="center"><b>Item</b></td>    
  <td align="center"><b>Código</b></td>    
  <td align="center"><b>Descripción</b></td>    
  <td align="center"><b>Cantidad</b></td>      
  <td align="center"><b>Vr. Unitario</b></td>    
  <td align="center"><b>Vr. Total</b></td>    
</tr>
  $productos
 <tr>
  <td rowspan="3" style="background-color: #FFFFFF;color:#000000" colspan="4">$array_cotizacion[descripcion]</td>    
  <td align="right"><b>Gran Total</b></td>    
  <td style="background-color: #FFFFFF;color:#000000" align="center">$$gran_total</td>    
</tr> 
 <tr>
  <td align="right"><b>Iva (19%)</b></td>    
  <td style="background-color: #FFFFFF;color:#000000" align="center">$$iva</td>    
</tr> 
 <tr>  
  <td align="right"><b>Valor Total</b></td>    
  <td style="background-color: #FFFFFF;color:#000000" align="center">$$total</td>    
</tr> 
</table>
        
        
     
        
EOF;

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------
//Close and output PDF document
echo $pdf->Output('formato_cotizacion.pdf', 'S');

//============================================================+
// END OF FILE
//============================================================+
