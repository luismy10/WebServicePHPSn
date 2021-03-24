<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json; charset=UTF-8');
require_once './database/DataBaseConexion.php';
require("./ventas/VentasADO.php");
try {
	$idventa = $_GET['idventa'];
	$serie = $_GET['serie'];
	$numeracion = $_GET['numeracion'];
	$fecha = $_GET['fecha'];
	$hora = $_GET['hora'];
	$tipodocumento = $_GET['tipodocumento'];
	$monedaletras = $_GET['monedaletras'];
	$fcoddivisa = $_GET['monedaabreviatura'];

	$serienumeracion = $serie . '-' . $numeracion;
	
	$detalleventa = VentasADO::ListarDetalleVentPorId($idventa);

	$tipodocumentoemisor = $detalleventa[1]->IdAuxiliar;
	$numerodocumentoemisor =  $detalleventa[1]->NumeroDocumento;
	$nombrecomercialemisor = $detalleventa[1]->NombreComercial;
	$nombreemisor = $detalleventa[1]->RazonSocial;
	$direccionemisor = $detalleventa[1]->Domicilio;
	$codigodireccionemisor = "0000";

	$tipodocumentocliente = $detalleventa[2]->IdAuxiliar;
	$numerodocumentocliente = $detalleventa[2]->NumeroDocumento;
	$nombrecliente = $detalleventa[2]->Informacion;

	$xml = new DomDocument('1.0', 'ISO-8859-1');
	$xml->standalone         = false;
	$xml->preserveWhiteSpace = false;

	$Invoice = $xml->createElement('Invoice');
	$Invoice = $xml->appendChild($Invoice);

	// Set the attributes.
	$Invoice->setAttribute('xmlns', 'urn:oasis:names:specification:ubl:schema:xsd:Invoice-2');
	$Invoice->setAttribute('xmlns:cac', 'urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2');
	$Invoice->setAttribute('xmlns:cbc', 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2');
	$Invoice->setAttribute('xmlns:ccts', "urn:un:unece:uncefact:documentation:2");
	$Invoice->setAttribute('xmlns:ds', "http://www.w3.org/2000/09/xmldsig#");
	$Invoice->setAttribute('xmlns:ext', "urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2");
	$Invoice->setAttribute('xmlns:qdt', "urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2");
	$Invoice->setAttribute('xmlns:sac', "urn:sunat:names:specification:ubl:peru:schema:xsd:SunatAggregateComponents-1");
	$Invoice->setAttribute('xmlns:udt', "urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2");
	$Invoice->setAttribute('xmlns:xsi', "http://www.w3.org/2001/XMLSchema-instance");


	$UBLExtension = $xml->createElement('ext:UBLExtensions');
	$UBLExtension = $Invoice->appendChild($UBLExtension);

	$ext = $xml->createElement('ext:UBLExtension');
	$ext = $UBLExtension->appendChild($ext);
	$contents = $xml->createElement('ext:ExtensionContent', ' ');
	$contents = $ext->appendChild($contents);

	//Version de UBL 2.1
	$cbc = $xml->createElement('cbc:UBLVersionID', '2.1');
	$cbc = $Invoice->appendChild($cbc);

	//Versión de la estructura del documento
	$cbc = $xml->createElement('cbc:CustomizationID', '2.0');
	$cbc = $Invoice->appendChild($cbc);

	//Código de tipo de operación
	$cbc = $xml->createElement('cbc:ProfileID', '0101');
	$cbc = $Invoice->appendChild($cbc);
	$cbc->setAttribute('schemeName', "SUNAT:Identificador de Tipo de Operación");
	$cbc->setAttribute('schemeAgencyName', "PE:SUNAT");
	$cbc->setAttribute('schemeURI', "urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo17");

	//Numeración, conformada por serie y número correlativo
	$cbc = $xml->createElement('cbc:ID', $serienumeracion);
	$cbc = $Invoice->appendChild($cbc);

	//Fecha de emisión
	$cbc = $xml->createElement('cbc:IssueDate', $fecha);
	$cbc = $Invoice->appendChild($cbc);

	//Hora de emisión
	$cbc = $xml->createElement('cbc:IssueTime', $hora);
	$cbc = $Invoice->appendChild($cbc);

	//Fecha de Vencimiento
	$cbc = $xml->createElement('cbc:DueDate', $fecha);
	$cbc = $Invoice->appendChild($cbc);

	//Tipo de documento (Factura)
	$cbc = $xml->createElement('cbc:InvoiceTypeCode', $tipodocumento);
	$cbc = $Invoice->appendChild($cbc);
	$cbc->setAttribute('listID', "0101");
	$cbc->setAttribute('listAgencyName', "PE:SUNAT");
	$cbc->setAttribute('listURI', "urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo01");

	//Leyendas
	//Ejemplo:
	//Importes Totales y Código interno generado por el software de facturación
	$cbc = $xml->createElement('cbc:Note', $monedaletras);
	$cbc = $Invoice->appendChild($cbc);
	$cbc->setAttribute('languageLocaleID', "1000");

	//Tipo de moneda en la cual se emite la factura electrónica
	$cbc = $xml->createElement('cbc:DocumentCurrencyCode', $fcoddivisa);
	$cbc = $Invoice->appendChild($cbc);
	$cbc->setAttribute('listID', "ISO 4217 Alpha");
	$cbc->setAttribute('listAgencyName', "United Nations Economic Commission for Europe");

	//Número de lineas contadas
	$cbc = $xml->createElement('cbc:LineCountNumeric', $detalleventa[0]['numeroitems']);
	$cbc = $Invoice->appendChild($cbc);

	// Un ejemplo de declaración de firma electrónica en el contenedor cac:Signature sería:

	$Signature = $xml->createElement('cac:Signature');
	$Signature = $Invoice->appendChild($Signature);

	$ID = $xml->createElement('cbc:ID', 'IDSignKG');
	$ID = $Signature->appendChild($ID);

	$SignatoryParty = $xml->createElement('cac:SignatoryParty');
	$SignatoryParty = $Signature->appendChild($SignatoryParty);

	$PartyIdentification = $xml->createElement('cac:PartyIdentification');
	$PartyIdentification = $SignatoryParty->appendChild($PartyIdentification);

	$ID = $xml->createElement('cbc:ID', '20100113612');
	$ID = $PartyIdentification->appendChild($ID);

	$PartyName = $xml->createElement('cac:PartyName');
	$PartyName = $SignatoryParty->appendChild($PartyName);

	$Name = $xml->createElement('cbc:Name');
	$Name->appendChild($xml->createCDATASection('K&G Laboratorios'));
	$Name = $PartyName->appendChild($Name);

	$DigitalSignatureAttachment = $xml->createElement('cac:DigitalSignatureAttachment');
	$DigitalSignatureAttachment = $Signature->appendChild($DigitalSignatureAttachment);

	$ExternalReference = $xml->createElement('cac:ExternalReference');
	$ExternalReference = $DigitalSignatureAttachment->appendChild($ExternalReference);

	$URI = $xml->createElement('cbc:URI', '#signatureKG');
	$URI = $ExternalReference->appendChild($URI);

	//Nombre Comercial del emisor
	//Apellidos y nombres, denominación o razón social del emisor
	//Tipo y Número de RUC del emisor
	//Código del domicilio fiscal o de local anexo del emisor
	$AccountingSupplierParty = $xml->createElement('cac:AccountingSupplierParty');
	$AccountingSupplierParty = $Invoice->appendChild($AccountingSupplierParty);

	$cac_party = $xml->createElement('cac:Party');
	$cac_party = $AccountingSupplierParty->appendChild($cac_party);

	$PartyIdentification = $xml->createElement('cac:PartyIdentification');
	$PartyIdentification = $cac_party->appendChild($PartyIdentification);

	$ID = $xml->createElement('cbc:ID', $numerodocumentoemisor);
	$ID = $PartyIdentification->appendChild($ID);
	$ID->setAttribute('schemeID', $tipodocumentoemisor);
	$ID->setAttribute('schemeAgencyName', "PE:SUNAT");
	$ID->setAttribute('schemeURI', "urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06");

	$PartyName = $xml->createElement('cac:PartyName');
	$PartyName = $cac_party->appendChild($PartyName);

	$cbc = $xml->createElement('cbc:Name');
	$cbc->appendChild($xml->createCDATASection($nombrecomercialemisor));
	$cbc = $PartyName->appendChild($cbc);

	$PartyLegalEntity = $xml->createElement('cac:PartyLegalEntity');
	$PartyLegalEntity = $cac_party->appendChild($PartyLegalEntity);

	$RegistrationName = $xml->createElement('cbc:RegistrationName');
	$RegistrationName->appendChild($xml->createCDATASection($nombreemisor));
	$RegistrationName = $PartyLegalEntity->appendChild($RegistrationName);

	$RegistrationAddress = $xml->createElement('cac:RegistrationAddress');
	$RegistrationAddress = $PartyLegalEntity->appendChild($RegistrationAddress);

	$AddressTypeCode = $xml->createElement('cbc:AddressTypeCode', $codigodireccionemisor);
	$AddressTypeCode = $RegistrationAddress->appendChild($AddressTypeCode);

	$CityName = $xml->createElement('cbc:CityName', 'San Miguel');
	$CityName = $RegistrationAddress->appendChild($CityName);

	$CountrySubentity = $xml->createElement('cbc:CountrySubentity', 'San Miguel');
	$CountrySubentity = $RegistrationAddress->appendChild($CountrySubentity);

	$District = $xml->createElement('cbc:District', 'San Miguel');
	$District = $RegistrationAddress->appendChild($District);

	$AddressLine = $xml->createElement('cac:AddressLine');
	$AddressLine = $RegistrationAddress->appendChild($AddressLine);

	$Line = $xml->createElement('cbc:Line');
	$Line->appendChild($xml->createCDATASection($direccionemisor));
	$Line = $AddressLine->appendChild($Line);

	// $cbc = $xml->createElement('cbc:CompanyID',$numerodocumentoemisor);  
	// $cbc = $Invoice->appendChild($cbc);
	// $cbc->setAttribute('schemeID', "6");
	// $cbc->setAttribute('schemeName', "SUNAT:Identificador de Documento de Identidad");
	// $cbc->setAttribute('schemeAgencyName', "PE:SUNAT");
	// $cbc->setAttribute('schemeURI', "urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06");
	// $cbc = $PartyTaxSchema->appendChild($cbc);

	// $TaxScheme = $xml->createElement('cbc:TaxScheme');  
	// $TaxScheme = $PartyTaxSchema->appendChild($TaxScheme);
	// $cbc = $xml->createElement('cbc:ID',"-");  
	// $cbc = $Invoice->appendChild($cbc);
	// $cbc = $TaxScheme->appendChild($cbc);

	// $RegistrationAddress = $xml->createElement('cbc:RegistrationAddress');  
	// $RegistrationAddress = $PartyTaxSchema->appendChild($RegistrationAddress);
	// $cbc = $xml->createElement('cbc:AddressTypeCode',"0001");  
	// $cbc = $Invoice->appendChild($cbc); 
	// $cbc = $RegistrationAddress->appendChild($cbc);

	//Tipo y número de documento de identidad del adquirente o usuario
	//Apellidos y nombres, denominación o razón social del adquirente o usuario

	$AccountingCustomerParty = $xml->createElement('cac:AccountingCustomerParty');
	$AccountingCustomerParty = $Invoice->appendChild($AccountingCustomerParty);

	$Party = $xml->createElement('cac:Party');
	$Party = $AccountingCustomerParty->appendChild($Party);

	$PartyIdentification = $xml->createElement('cac:PartyIdentification');
	$PartyIdentification = $Party->appendChild($PartyIdentification);

	$ID = $xml->createElement('cbc:ID', $numerodocumentocliente);
	$ID = $PartyIdentification->appendChild($ID);
	$ID->setAttribute('schemeID', $tipodocumentocliente);
	$ID->setAttribute('schemeAgencyName', "PE:SUNAT");
	$ID->setAttribute('schemeURI', "urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06");

	// $PartyName = $xml->createElement('cac:PartyName');
	// $PartyName = $Party->appendChild($PartyName);

	// $Name = $xml->createElement('cbc:Name');
	// $Name->appendChild($xml->createCDATASection($nombrecliente)); 
	// $Name = $PartyName->appendChild($Name);

	$PartyLegalEntity = $xml->createElement('cac:PartyLegalEntity');
	$PartyLegalEntity = $Party->appendChild($PartyLegalEntity);

	$RegistrationName = $xml->createElement('cbc:RegistrationName');
	$RegistrationName->appendChild($xml->createCDATASection($nombrecliente));
	$RegistrationName = $PartyLegalEntity->appendChild($RegistrationName);

	// $cbc = $xml->createElement('cbc:CompanyID',$numerodocumentocliente);  
	// $cbc = $Invoice->appendChild($cbc);
	// $cbc->setAttribute('schemeID', "6");
	// $cbc->setAttribute('schemeName', "SUNAT:Identificador de Documento de Identidad");
	// $cbc->setAttribute('schemeAgencyName', "PE:SUNAT");
	// $cbc->setAttribute('schemeURI', "urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06");
	// $cbc = $PartyTaxSchema->appendChild($cbc);

	// $TaxScheme = $xml->createElement('cbc:TaxScheme');  
	// $TaxScheme = $PartyTaxSchema->appendChild($TaxScheme);
	// $cbc = $xml->createElement('cbc:ID',"-");  
	// $cbc = $Invoice->appendChild($cbc);
	// $cbc = $TaxScheme->appendChild($cbc);

	//Monto total de impuestos
	//Monto las operaciones gravadas
	//Monto las operaciones Exoneradas
	//Monto las operaciones inafectas del impuesto (Ver Ejemplo en la página 47)
	//Monto las operaciones gratuitas (Ver Ejemplo en la página 48)
	//Sumatoria de IGV
	//Sumatoria de ISC (Ver Ejemplo en la página 51)
	//Sumatoria de Otros Tributos (Ver Ejemplo en la página 52)

	$TaxTotal = $xml->createElement('cac:TaxTotal');
	$TaxTotal = $Invoice->appendChild($TaxTotal);

	$cbc = $xml->createElement('cbc:TaxAmount', bcdiv($detalleventa[0]['totalimpuesto'], 1, 2));
	$cbc = $TaxTotal->appendChild($cbc);
	$cbc->setAttribute('currencyID', $fcoddivisa);

	$TaxSubtotal = $xml->createElement('cac:TaxSubtotal');
	$TaxSubtotal = $TaxTotal->appendChild($TaxSubtotal);

	$TaxableAmount = $xml->createElement('cbc:TaxableAmount', bcdiv($detalleventa[0]['totalsinimpuesto'], 1, 2));
	$TaxableAmount = $TaxSubtotal->appendChild($TaxableAmount);
	$TaxableAmount->setAttribute('currencyID', $fcoddivisa);

	$TaxAmount = $xml->createElement('cbc:TaxAmount', bcdiv($detalleventa[0]['totalimpuesto'], 1, 2));
	$TaxAmount = $TaxSubtotal->appendChild($TaxAmount);
	$TaxAmount->setAttribute('currencyID', $fcoddivisa);

	$TaxCategory = $xml->createElement('cac:TaxCategory');
	$TaxCategory = $TaxSubtotal->appendChild($TaxCategory);

	$ID = $xml->createElement('cbc:ID', 'S');
	$ID = $TaxCategory->appendChild($ID);
	$ID->setAttribute('schemeID', 'UN/ECE 5305');
	$ID->setAttribute('schemeName', 'Tax Category Identifier');
	$ID->setAttribute('schemeAgencyName', 'United Nations Economic Commission for Europe');

	$TaxScheme = $xml->createElement('cac:TaxScheme');
	$TaxScheme = $TaxCategory->appendChild($TaxScheme);

	$ID = $xml->createElement('cbc:ID', '1000');
	$ID = $TaxScheme->appendChild($ID);
	$ID->setAttribute('schemeID', 'UN/ECE 5305');
	$ID->setAttribute('schemeAgencyID', '6');

	$Name = $xml->createElement('cbc:Name', 'IGV');
	$Name = $TaxScheme->appendChild($Name);

	$TaxTypeCode = $xml->createElement('cbc:TaxTypeCode', 'VAT');
	$TaxTypeCode = $TaxScheme->appendChild($TaxTypeCode);

	//Total valor de venta
	//Total precio de venta (incluye impuestos)
	//Monto total de descuentos del comprobante
	//Monto total de otros cargos del comprobante
	//Importe total de la venta, cesión en uso o del servicio prestado
	$LegalMonetaryTotal = $xml->createElement('cac:LegalMonetaryTotal');
	$LegalMonetaryTotal = $Invoice->appendChild($LegalMonetaryTotal);

	$LineExtensionAmount = $xml->createElement('cbc:LineExtensionAmount', bcdiv($detalleventa[0]['totalsinimpuesto'], 1, 2));
	$LineExtensionAmount = $LegalMonetaryTotal->appendChild($LineExtensionAmount);
	$LineExtensionAmount->setAttribute('currencyID', $fcoddivisa);

	$TaxInclusiveAmount = $xml->createElement('cbc:TaxInclusiveAmount', bcdiv($detalleventa[0]['totalconimpuesto'], 1, 2));
	$TaxInclusiveAmount = $LegalMonetaryTotal->appendChild($TaxInclusiveAmount);
	$TaxInclusiveAmount->setAttribute('currencyID', $fcoddivisa);

	$AllowanceTotalAmount = $xml->createElement('cbc:AllowanceTotalAmount', '0.00');
	$AllowanceTotalAmount = $LegalMonetaryTotal->appendChild($AllowanceTotalAmount);
	$AllowanceTotalAmount->setAttribute('currencyID', $fcoddivisa);

	$ChargeTotalAmount = $xml->createElement('cbc:ChargeTotalAmount', '0.00');
	$ChargeTotalAmount = $LegalMonetaryTotal->appendChild($ChargeTotalAmount);
	$ChargeTotalAmount->setAttribute('currencyID', $fcoddivisa);

	$PrepaidAmount = $xml->createElement('cbc:PrepaidAmount', '0.00');
	$PrepaidAmount = $LegalMonetaryTotal->appendChild($PrepaidAmount);
	$PrepaidAmount->setAttribute('currencyID', $fcoddivisa);

	$PayableAmount = $xml->createElement('cbc:PayableAmount', bcdiv($detalleventa[0]['totalconimpuesto'], 1, 2));
	$PayableAmount = $LegalMonetaryTotal->appendChild($PayableAmount);
	$PayableAmount->setAttribute('currencyID', $fcoddivisa);

	//Número de orden del Ítem
	//Cantidad y Unidad de medida por ítem
	//Valor de venta del ítem

	foreach ($detalleventa[0]['detalle'] as $key => $value) {
		$InvoiceLine = $xml->createElement('cac:InvoiceLine');
		$InvoiceLine = $Invoice->appendChild($InvoiceLine);

		$ID = $xml->createElement('cbc:ID', $value['Id']);
		$ID = $InvoiceLine->appendChild($ID);

		$InvoicedQuantity = $xml->createElement('cbc:InvoicedQuantity', bcdiv($value['Cantidad'], 1, 2));
		$InvoicedQuantity = $InvoiceLine->appendChild($InvoicedQuantity);
		$InvoicedQuantity->setAttribute('unitCode', 'CS');
		$InvoicedQuantity->setAttribute('unitCodeListID', 'UN/ECE rec 20');
		$InvoicedQuantity->setAttribute('unitCodeListAgencyName', 'United Nations Economic Commission for Europe');

		$totalventa = $value['PrecioVenta'] * $value['Cantidad'];

		$LineExtensionAmount = $xml->createElement('cbc:LineExtensionAmount', bcdiv($totalventa, 1, 2));
		$LineExtensionAmount = $InvoiceLine->appendChild($LineExtensionAmount);
		$LineExtensionAmount->setAttribute('currencyID', $fcoddivisa);

		//Precio de venta unitario por item y código

		$PricingReference = $xml->createElement('cac:PricingReference');
		$PricingReference = $InvoiceLine->appendChild($PricingReference);

		$AlternativeConditionPrice = $xml->createElement('cac:AlternativeConditionPrice');
		$AlternativeConditionPrice = $PricingReference->appendChild($AlternativeConditionPrice);

		$impuestogenerado = $value['PrecioVenta'] * ($value['ValorImpuesto'] / 100.00);
		$precioventaimpuesto = $value['PrecioVenta'] + $impuestogenerado;

		$PriceAmount = $xml->createElement('cbc:PriceAmount', bcdiv($precioventaimpuesto, 1, 2));
		$PriceAmount = $AlternativeConditionPrice->appendChild($PriceAmount);
		$PriceAmount->setAttribute('currencyID', $fcoddivisa);

		$PriceTypeCode = $xml->createElement('cbc:PriceTypeCode', '01');
		$PriceTypeCode = $AlternativeConditionPrice->appendChild($PriceTypeCode);
		$PriceTypeCode->setAttribute('listName', 'SUNAT:Indicador de Tipo de Precio');
		$PriceTypeCode->setAttribute('listAgencyName', 'PE:SUNAT');
		$PriceTypeCode->setAttribute('listURI', 'urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo16');

		$totalimpuesto = $totalventa * ($value['ValorImpuesto'] / 100.00);

		// Afectación al IGV por ítem
		$TaxTotal = $xml->createElement('cac:TaxTotal');
		$TaxTotal = $InvoiceLine->appendChild($TaxTotal);

		$TaxAmount = $xml->createElement('cbc:TaxAmount', bcdiv($totalimpuesto, 1, 2));
		$TaxAmount = $TaxTotal->appendChild($TaxAmount);
		$TaxAmount->setAttribute('currencyID', 'PEN');

		$TaxSubtotal = $xml->createElement('cac:TaxSubtotal');
		$TaxSubtotal = $TaxTotal->appendChild($TaxSubtotal);

		$TaxableAmount = $xml->createElement('cbc:TaxableAmount', bcdiv($totalventa, 1, 2));
		$TaxableAmount = $TaxSubtotal->appendChild($TaxableAmount);
		$TaxableAmount->setAttribute('currencyID', 'PEN');

		$TaxAmount = $xml->createElement('cbc:TaxAmount', bcdiv($totalimpuesto, 1, 2));
		$TaxAmount = $TaxSubtotal->appendChild($TaxAmount);
		$TaxAmount->setAttribute('currencyID', 'PEN');

		$TaxCategory = $xml->createElement('cac:TaxCategory');
		$TaxCategory = $TaxSubtotal->appendChild($TaxCategory);

		$ID = $xml->createElement('cbc:ID', 'S');
		$ID = $TaxCategory->appendChild($ID);
		$ID->setAttribute('schemeAgencyID', '6');
		$ID->setAttribute('schemeID', 'UN/ECE 5305');
		$ID->setAttribute('schemeAgencyName', 'PE:SUNAT');

		$Percent = $xml->createElement('cbc:Percent', bcdiv($value['ValorImpuesto'], 1, 2));
		$Percent = $TaxCategory->appendChild($Percent);

		$TaxExemptionReasonCode = $xml->createElement('cbc:TaxExemptionReasonCode', '10');
		$TaxExemptionReasonCode = $TaxCategory->appendChild($TaxExemptionReasonCode);
		$TaxExemptionReasonCode->setAttribute('listAgencyName', 'PE:SUNAT');
		$TaxExemptionReasonCode->setAttribute('listURI', 'urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo07');

		$TaxScheme = $xml->createElement('cac:TaxScheme');
		$TaxScheme = $TaxCategory->appendChild($TaxScheme);

		$ID = $xml->createElement('cbc:ID', $value['Numeracion']);
		$ID = $TaxScheme->appendChild($ID);
		$ID->setAttribute('schemeID', 'UN/ECE 5153');
		$ID->setAttribute('schemeAgencyName', 'PE:SUNAT');

		$Name = $xml->createElement('cbc:Name', $value['NombreImpuesto']);
		$Name = $TaxScheme->appendChild($Name);

		$TaxTypeCode = $xml->createElement('cbc:TaxTypeCode', $value['Categoria']);
		$TaxTypeCode = $TaxScheme->appendChild($TaxTypeCode);

		$Item = $xml->createElement('cac:Item');
		$Item = $InvoiceLine->appendChild($Item);

		$Description = $xml->createElement('cbc:Description');
		$Description->appendChild($xml->createCDATASection($value['NombreMarca']));
		$Description = $Item->appendChild($Description);

		$Price = $xml->createElement('cac:Price');
		$Price = $InvoiceLine->appendChild($Price);

		$PriceAmount = $xml->createElement('cbc:PriceAmount', bcdiv($value['PrecioVenta'], 1, 2));
		$PriceAmount = $Price->appendChild($PriceAmount);
		$PriceAmount->setAttribute('currencyID',  $fcoddivisa);
	}

	$xml->formatOutput = true;
	$strings_xml = $xml->saveXML();
	$xmlcreado = $numerodocumentoemisor . '-'.$tipodocumento.'-' . $serienumeracion . '.xml';

	$xml->save('factura-sin-firmar/' . $xmlcreado);
	chmod('factura-sin-firmar/' . $xmlcreado, 0777);

	print json_encode(array(
		"estado" => 1,
		"message" => "Factura creada",
		"xml" => $xmlcreado,
		"firmarxml" => "firmarxml.php"
	));

} catch (Exception $ex) {

	print json_encode(array(
		"estado" => 2,
		"message" => "Error en crear xml",
		"error" => $ex->getMessage()
	));

}
