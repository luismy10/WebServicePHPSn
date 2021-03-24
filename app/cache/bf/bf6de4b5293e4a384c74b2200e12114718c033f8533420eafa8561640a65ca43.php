<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* notadb2.1.xml.twig */
class __TwigTemplate_7d73b7d6e60fc222e1b8b5ac7a7d2dacaffcc91743cda139e6055eff5c27b5da extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        ob_start(function () { return ''; });
        // line 2
        echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>
<DebitNote xmlns=\"urn:oasis:names:specification:ubl:schema:xsd:DebitNote-2\" xmlns:cac=\"urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2\" xmlns:cbc=\"urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2\" xmlns:ds=\"http://www.w3.org/2000/09/xmldsig#\" xmlns:ext=\"urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2\">
    <ext:UBLExtensions>
        <ext:UBLExtension>
            <ext:ExtensionContent/>
        </ext:UBLExtension>
    </ext:UBLExtensions>
    <cbc:UBLVersionID>2.1</cbc:UBLVersionID>
    <cbc:CustomizationID>2.0</cbc:CustomizationID>
    <cbc:ID>";
        // line 11
        echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "serie", [], "any", false, false, false, 11);
        echo "-";
        echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "correlativo", [], "any", false, false, false, 11);
        echo "</cbc:ID>
    <cbc:IssueDate>";
        // line 12
        echo twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "fechaEmision", [], "any", false, false, false, 12), "Y-m-d");
        echo "</cbc:IssueDate>
    <cbc:IssueTime>";
        // line 13
        echo twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "fechaEmision", [], "any", false, false, false, 13), "H:i:s");
        echo "</cbc:IssueTime>
    ";
        // line 14
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "legends", [], "any", false, false, false, 14));
        foreach ($context['_seq'] as $context["_key"] => $context["leg"]) {
            // line 15
            echo "        <cbc:Note languageLocaleID=\"";
            echo twig_get_attribute($this->env, $this->source, $context["leg"], "code", [], "any", false, false, false, 15);
            echo "\"><![CDATA[";
            echo twig_get_attribute($this->env, $this->source, $context["leg"], "value", [], "any", false, false, false, 15);
            echo "]]></cbc:Note>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['leg'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 17
        echo "    <cbc:DocumentCurrencyCode>";
        echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 17);
        echo "</cbc:DocumentCurrencyCode>
    <cac:DiscrepancyResponse>
        <cbc:ReferenceID>";
        // line 19
        echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "numDocfectado", [], "any", false, false, false, 19);
        echo "</cbc:ReferenceID>
        <cbc:ResponseCode>";
        // line 20
        echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "codMotivo", [], "any", false, false, false, 20);
        echo "</cbc:ResponseCode>
        <cbc:Description>";
        // line 21
        echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "desMotivo", [], "any", false, false, false, 21);
        echo "</cbc:Description>
    </cac:DiscrepancyResponse>
    ";
        // line 23
        if (twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "compra", [], "any", false, false, false, 23)) {
            // line 24
            echo "    <cac:OrderReference>
        <cbc:ID>";
            // line 25
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "compra", [], "any", false, false, false, 25);
            echo "</cbc:ID>
    </cac:OrderReference>
    ";
        }
        // line 28
        echo "    <cac:BillingReference>
        <cac:InvoiceDocumentReference>
            <cbc:ID>";
        // line 30
        echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "numDocfectado", [], "any", false, false, false, 30);
        echo "</cbc:ID>
            <cbc:DocumentTypeCode>";
        // line 31
        echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipDocAfectado", [], "any", false, false, false, 31);
        echo "</cbc:DocumentTypeCode>
        </cac:InvoiceDocumentReference>
    </cac:BillingReference>
    ";
        // line 34
        if (twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "guias", [], "any", false, false, false, 34)) {
            // line 35
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "guias", [], "any", false, false, false, 35));
            foreach ($context['_seq'] as $context["_key"] => $context["guia"]) {
                // line 36
                echo "    <cac:DespatchDocumentReference>
        <cbc:ID>";
                // line 37
                echo twig_get_attribute($this->env, $this->source, $context["guia"], "nroDoc", [], "any", false, false, false, 37);
                echo "</cbc:ID>
        <cbc:DocumentTypeCode>";
                // line 38
                echo twig_get_attribute($this->env, $this->source, $context["guia"], "tipoDoc", [], "any", false, false, false, 38);
                echo "</cbc:DocumentTypeCode>
    </cac:DespatchDocumentReference>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['guia'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 41
            echo "    ";
        }
        // line 42
        echo "    ";
        if (twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "relDocs", [], "any", false, false, false, 42)) {
            // line 43
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "relDocs", [], "any", false, false, false, 43));
            foreach ($context['_seq'] as $context["_key"] => $context["rel"]) {
                // line 44
                echo "    <cac:AdditionalDocumentReference>
        <cbc:ID>";
                // line 45
                echo twig_get_attribute($this->env, $this->source, $context["rel"], "nroDoc", [], "any", false, false, false, 45);
                echo "</cbc:ID>
        <cbc:DocumentTypeCode>";
                // line 46
                echo twig_get_attribute($this->env, $this->source, $context["rel"], "tipoDoc", [], "any", false, false, false, 46);
                echo "</cbc:DocumentTypeCode>
    </cac:AdditionalDocumentReference>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['rel'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 49
            echo "    ";
        }
        // line 50
        echo "    ";
        $context["emp"] = twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "company", [], "any", false, false, false, 50);
        // line 51
        echo "    <cac:Signature>
        <cbc:ID>";
        // line 52
        echo twig_get_attribute($this->env, $this->source, ($context["emp"] ?? null), "ruc", [], "any", false, false, false, 52);
        echo "</cbc:ID>
        <cac:SignatoryParty>
            <cac:PartyIdentification>
                <cbc:ID>";
        // line 55
        echo twig_get_attribute($this->env, $this->source, ($context["emp"] ?? null), "ruc", [], "any", false, false, false, 55);
        echo "</cbc:ID>
            </cac:PartyIdentification>
            <cac:PartyName>
                <cbc:Name><![CDATA[";
        // line 58
        echo twig_get_attribute($this->env, $this->source, ($context["emp"] ?? null), "razonSocial", [], "any", false, false, false, 58);
        echo "]]></cbc:Name>
            </cac:PartyName>
        </cac:SignatoryParty>
        <cac:DigitalSignatureAttachment>
            <cac:ExternalReference>
                <cbc:URI>#GREENTER-SIGN</cbc:URI>
            </cac:ExternalReference>
        </cac:DigitalSignatureAttachment>
    </cac:Signature>
    <cac:AccountingSupplierParty>
        <cac:Party>
            <cac:PartyIdentification>
                <cbc:ID schemeID=\"6\">";
        // line 70
        echo twig_get_attribute($this->env, $this->source, ($context["emp"] ?? null), "ruc", [], "any", false, false, false, 70);
        echo "</cbc:ID>
            </cac:PartyIdentification>
            <cac:PartyName>
                <cbc:Name><![CDATA[";
        // line 73
        echo twig_get_attribute($this->env, $this->source, ($context["emp"] ?? null), "nombreComercial", [], "any", false, false, false, 73);
        echo "]]></cbc:Name>
            </cac:PartyName>
            <cac:PartyLegalEntity>
                <cbc:RegistrationName><![CDATA[";
        // line 76
        echo twig_get_attribute($this->env, $this->source, ($context["emp"] ?? null), "razonSocial", [], "any", false, false, false, 76);
        echo "]]></cbc:RegistrationName>
                ";
        // line 77
        $context["addr"] = twig_get_attribute($this->env, $this->source, ($context["emp"] ?? null), "address", [], "any", false, false, false, 77);
        // line 78
        echo "                <cac:RegistrationAddress>
                    <cbc:ID>";
        // line 79
        echo twig_get_attribute($this->env, $this->source, ($context["addr"] ?? null), "ubigueo", [], "any", false, false, false, 79);
        echo "</cbc:ID>
                    <cbc:AddressTypeCode>";
        // line 80
        echo twig_get_attribute($this->env, $this->source, ($context["addr"] ?? null), "codLocal", [], "any", false, false, false, 80);
        echo "</cbc:AddressTypeCode>
                    ";
        // line 81
        if (twig_get_attribute($this->env, $this->source, ($context["addr"] ?? null), "urbanizacion", [], "any", false, false, false, 81)) {
            // line 82
            echo "                        <cbc:CitySubdivisionName>";
            echo twig_get_attribute($this->env, $this->source, ($context["addr"] ?? null), "urbanizacion", [], "any", false, false, false, 82);
            echo "</cbc:CitySubdivisionName>
                    ";
        }
        // line 84
        echo "                    <cbc:CityName>";
        echo twig_get_attribute($this->env, $this->source, ($context["addr"] ?? null), "provincia", [], "any", false, false, false, 84);
        echo "</cbc:CityName>
                    <cbc:CountrySubentity>";
        // line 85
        echo twig_get_attribute($this->env, $this->source, ($context["addr"] ?? null), "departamento", [], "any", false, false, false, 85);
        echo "</cbc:CountrySubentity>
                    <cbc:District>";
        // line 86
        echo twig_get_attribute($this->env, $this->source, ($context["addr"] ?? null), "distrito", [], "any", false, false, false, 86);
        echo "</cbc:District>
                    <cac:AddressLine>
                        <cbc:Line><![CDATA[";
        // line 88
        echo twig_get_attribute($this->env, $this->source, ($context["addr"] ?? null), "direccion", [], "any", false, false, false, 88);
        echo "]]></cbc:Line>
                    </cac:AddressLine>
                    <cac:Country>
                        <cbc:IdentificationCode>";
        // line 91
        echo twig_get_attribute($this->env, $this->source, ($context["addr"] ?? null), "codigoPais", [], "any", false, false, false, 91);
        echo "</cbc:IdentificationCode>
                    </cac:Country>
                </cac:RegistrationAddress>
            </cac:PartyLegalEntity>
            ";
        // line 95
        if ((twig_get_attribute($this->env, $this->source, ($context["emp"] ?? null), "email", [], "any", false, false, false, 95) || twig_get_attribute($this->env, $this->source, ($context["emp"] ?? null), "telephone", [], "any", false, false, false, 95))) {
            // line 96
            echo "                <cac:Contact>
                    ";
            // line 97
            if (twig_get_attribute($this->env, $this->source, ($context["emp"] ?? null), "telephone", [], "any", false, false, false, 97)) {
                // line 98
                echo "                        <cbc:Telephone>";
                echo twig_get_attribute($this->env, $this->source, ($context["emp"] ?? null), "telephone", [], "any", false, false, false, 98);
                echo "</cbc:Telephone>
                    ";
            }
            // line 100
            echo "                    ";
            if (twig_get_attribute($this->env, $this->source, ($context["emp"] ?? null), "email", [], "any", false, false, false, 100)) {
                // line 101
                echo "                        <cbc:ElectronicMail>";
                echo twig_get_attribute($this->env, $this->source, ($context["emp"] ?? null), "email", [], "any", false, false, false, 101);
                echo "</cbc:ElectronicMail>
                    ";
            }
            // line 103
            echo "                </cac:Contact>
            ";
        }
        // line 105
        echo "        </cac:Party>
    </cac:AccountingSupplierParty>
    ";
        // line 107
        $context["client"] = twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "client", [], "any", false, false, false, 107);
        // line 108
        echo "    <cac:AccountingCustomerParty>
        <cac:Party>
            <cac:PartyIdentification>
                <cbc:ID schemeID=\"";
        // line 111
        echo twig_get_attribute($this->env, $this->source, ($context["client"] ?? null), "tipoDoc", [], "any", false, false, false, 111);
        echo "\">";
        echo twig_get_attribute($this->env, $this->source, ($context["client"] ?? null), "numDoc", [], "any", false, false, false, 111);
        echo "</cbc:ID>
            </cac:PartyIdentification>
            <cac:PartyLegalEntity>
                <cbc:RegistrationName><![CDATA[";
        // line 114
        echo twig_get_attribute($this->env, $this->source, ($context["client"] ?? null), "rznSocial", [], "any", false, false, false, 114);
        echo "]]></cbc:RegistrationName>
                ";
        // line 115
        if (twig_get_attribute($this->env, $this->source, ($context["client"] ?? null), "address", [], "any", false, false, false, 115)) {
            // line 116
            echo "                    ";
            $context["addr"] = twig_get_attribute($this->env, $this->source, ($context["client"] ?? null), "address", [], "any", false, false, false, 116);
            // line 117
            echo "                    <cac:RegistrationAddress>
                        ";
            // line 118
            if (twig_get_attribute($this->env, $this->source, ($context["addr"] ?? null), "ubigueo", [], "any", false, false, false, 118)) {
                // line 119
                echo "                            <cbc:ID>";
                echo twig_get_attribute($this->env, $this->source, ($context["addr"] ?? null), "ubigueo", [], "any", false, false, false, 119);
                echo "</cbc:ID>
                        ";
            }
            // line 121
            echo "                        <cac:AddressLine>
                            <cbc:Line><![CDATA[";
            // line 122
            echo twig_get_attribute($this->env, $this->source, ($context["addr"] ?? null), "direccion", [], "any", false, false, false, 122);
            echo "]]></cbc:Line>
                        </cac:AddressLine>
                        <cac:Country>
                            <cbc:IdentificationCode>";
            // line 125
            echo twig_get_attribute($this->env, $this->source, ($context["addr"] ?? null), "codigoPais", [], "any", false, false, false, 125);
            echo "</cbc:IdentificationCode>
                        </cac:Country>
                    </cac:RegistrationAddress>
                ";
        }
        // line 129
        echo "            </cac:PartyLegalEntity>
            ";
        // line 130
        if ((twig_get_attribute($this->env, $this->source, ($context["client"] ?? null), "email", [], "any", false, false, false, 130) || twig_get_attribute($this->env, $this->source, ($context["client"] ?? null), "telephone", [], "any", false, false, false, 130))) {
            // line 131
            echo "                <cac:Contact>
                    ";
            // line 132
            if (twig_get_attribute($this->env, $this->source, ($context["client"] ?? null), "telephone", [], "any", false, false, false, 132)) {
                // line 133
                echo "                        <cbc:Telephone>";
                echo twig_get_attribute($this->env, $this->source, ($context["client"] ?? null), "telephone", [], "any", false, false, false, 133);
                echo "</cbc:Telephone>
                    ";
            }
            // line 135
            echo "                    ";
            if (twig_get_attribute($this->env, $this->source, ($context["client"] ?? null), "email", [], "any", false, false, false, 135)) {
                // line 136
                echo "                        <cbc:ElectronicMail>";
                echo twig_get_attribute($this->env, $this->source, ($context["client"] ?? null), "email", [], "any", false, false, false, 136);
                echo "</cbc:ElectronicMail>
                    ";
            }
            // line 138
            echo "                </cac:Contact>
            ";
        }
        // line 140
        echo "        </cac:Party>
    </cac:AccountingCustomerParty>
    <cac:TaxTotal>
        <cbc:TaxAmount currencyID=\"";
        // line 143
        echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 143);
        echo "\">";
        echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "totalImpuestos", [], "any", false, false, false, 143)]);
        echo "</cbc:TaxAmount>
        ";
        // line 144
        if (twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoISC", [], "any", false, false, false, 144)) {
            // line 145
            echo "            <cac:TaxSubtotal>
                <cbc:TaxableAmount currencyID=\"";
            // line 146
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 146);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoBaseIsc", [], "any", false, false, false, 146)]);
            echo "</cbc:TaxableAmount>
                <cbc:TaxAmount currencyID=\"";
            // line 147
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 147);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoISC", [], "any", false, false, false, 147)]);
            echo "</cbc:TaxAmount>
                <cac:TaxCategory>
                    <cac:TaxScheme>
                        <cbc:ID>2000</cbc:ID>
                        <cbc:Name>ISC</cbc:Name>
                        <cbc:TaxTypeCode>EXC</cbc:TaxTypeCode>
                    </cac:TaxScheme>
                </cac:TaxCategory>
            </cac:TaxSubtotal>
        ";
        }
        // line 157
        echo "        ";
        if (twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoOperGravadas", [], "any", false, false, false, 157)) {
            // line 158
            echo "            <cac:TaxSubtotal>
                <cbc:TaxableAmount currencyID=\"";
            // line 159
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 159);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoOperGravadas", [], "any", false, false, false, 159)]);
            echo "</cbc:TaxableAmount>
                <cbc:TaxAmount currencyID=\"";
            // line 160
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 160);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoIGV", [], "any", false, false, false, 160)]);
            echo "</cbc:TaxAmount>
                <cac:TaxCategory>
                    <cac:TaxScheme>
                        <cbc:ID>1000</cbc:ID>
                        <cbc:Name>IGV</cbc:Name>
                        <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                    </cac:TaxScheme>
                </cac:TaxCategory>
            </cac:TaxSubtotal>
        ";
        }
        // line 170
        echo "        ";
        if (twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoOperInafectas", [], "any", false, false, false, 170)) {
            // line 171
            echo "            <cac:TaxSubtotal>
                <cbc:TaxableAmount currencyID=\"";
            // line 172
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 172);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoOperInafectas", [], "any", false, false, false, 172)]);
            echo "</cbc:TaxableAmount>
                <cbc:TaxAmount currencyID=\"";
            // line 173
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 173);
            echo "\">0</cbc:TaxAmount>
                <cac:TaxCategory>
                    <cac:TaxScheme>
                        <cbc:ID>9998</cbc:ID>
                        <cbc:Name>INA</cbc:Name>
                        <cbc:TaxTypeCode>FRE</cbc:TaxTypeCode>
                    </cac:TaxScheme>
                </cac:TaxCategory>
            </cac:TaxSubtotal>
        ";
        }
        // line 183
        echo "        ";
        if (twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoOperExoneradas", [], "any", false, false, false, 183)) {
            // line 184
            echo "            <cac:TaxSubtotal>
                <cbc:TaxableAmount currencyID=\"";
            // line 185
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 185);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoOperExoneradas", [], "any", false, false, false, 185)]);
            echo "</cbc:TaxableAmount>
                <cbc:TaxAmount currencyID=\"";
            // line 186
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 186);
            echo "\">0</cbc:TaxAmount>
                <cac:TaxCategory>
                    <cac:TaxScheme>
                        <cbc:ID>9997</cbc:ID>
                        <cbc:Name>EXO</cbc:Name>
                        <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                    </cac:TaxScheme>
                </cac:TaxCategory>
            </cac:TaxSubtotal>
        ";
        }
        // line 196
        echo "        ";
        if (twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoOperGratuitas", [], "any", false, false, false, 196)) {
            // line 197
            echo "            <cac:TaxSubtotal>
                <cbc:TaxableAmount currencyID=\"";
            // line 198
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 198);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoOperGratuitas", [], "any", false, false, false, 198)]);
            echo "</cbc:TaxableAmount>
                <cbc:TaxAmount currencyID=\"";
            // line 199
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 199);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoIGVGratuitas", [], "any", false, false, false, 199)]);
            echo "</cbc:TaxAmount>
                <cac:TaxCategory>
                    <cac:TaxScheme>
                        <cbc:ID>9996</cbc:ID>
                        <cbc:Name>GRA</cbc:Name>
                        <cbc:TaxTypeCode>FRE</cbc:TaxTypeCode>
                    </cac:TaxScheme>
                </cac:TaxCategory>
            </cac:TaxSubtotal>
        ";
        }
        // line 209
        echo "        ";
        if (twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoOperExportacion", [], "any", false, false, false, 209)) {
            // line 210
            echo "            <cac:TaxSubtotal>
                <cbc:TaxableAmount currencyID=\"";
            // line 211
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 211);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoOperExportacion", [], "any", false, false, false, 211)]);
            echo "</cbc:TaxableAmount>
                <cbc:TaxAmount currencyID=\"";
            // line 212
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 212);
            echo "\">0</cbc:TaxAmount>
                <cac:TaxCategory>
                    <cac:TaxScheme>
                        <cbc:ID>9995</cbc:ID>
                        <cbc:Name>EXP</cbc:Name>
                        <cbc:TaxTypeCode>FRE</cbc:TaxTypeCode>
                    </cac:TaxScheme>
                </cac:TaxCategory>
            </cac:TaxSubtotal>
        ";
        }
        // line 222
        echo "        ";
        if (twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoIvap", [], "any", false, false, false, 222)) {
            // line 223
            echo "            <cac:TaxSubtotal>
                <cbc:TaxableAmount currencyID=\"";
            // line 224
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 224);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoBaseIvap", [], "any", false, false, false, 224)]);
            echo "</cbc:TaxableAmount>
                <cbc:TaxAmount currencyID=\"";
            // line 225
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 225);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoIvap", [], "any", false, false, false, 225)]);
            echo "</cbc:TaxAmount>
                <cac:TaxCategory>
                    <cac:TaxScheme>
                        <cbc:ID>1016</cbc:ID>
                        <cbc:Name>IVAP</cbc:Name>
                        <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                    </cac:TaxScheme>
                </cac:TaxCategory>
            </cac:TaxSubtotal>
        ";
        }
        // line 235
        echo "        ";
        if (twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoOtrosTributos", [], "any", false, false, false, 235)) {
            // line 236
            echo "            <cac:TaxSubtotal>
                <cbc:TaxableAmount currencyID=\"";
            // line 237
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 237);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoBaseOth", [], "any", false, false, false, 237)]);
            echo "</cbc:TaxableAmount>
                <cbc:TaxAmount currencyID=\"";
            // line 238
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 238);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoOtrosTributos", [], "any", false, false, false, 238)]);
            echo "</cbc:TaxAmount>
                <cac:TaxCategory>
                    <cac:TaxScheme>
                        <cbc:ID>9999</cbc:ID>
                        <cbc:Name>OTROS</cbc:Name>
                        <cbc:TaxTypeCode>OTH</cbc:TaxTypeCode>
                    </cac:TaxScheme>
                </cac:TaxCategory>
            </cac:TaxSubtotal>
        ";
        }
        // line 248
        echo "        ";
        if (twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "icbper", [], "any", false, false, false, 248)) {
            // line 249
            echo "            <cac:TaxSubtotal>
                <cbc:TaxAmount currencyID=\"";
            // line 250
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 250);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "icbper", [], "any", false, false, false, 250)]);
            echo "</cbc:TaxAmount>
                <cac:TaxCategory>
                    <cac:TaxScheme>
                        <cbc:ID>7152</cbc:ID>
                        <cbc:Name>ICBPER</cbc:Name>
                        <cbc:TaxTypeCode>OTH</cbc:TaxTypeCode>
                    </cac:TaxScheme>
                </cac:TaxCategory>
            </cac:TaxSubtotal>
        ";
        }
        // line 260
        echo "    </cac:TaxTotal>
    <cac:RequestedMonetaryTotal>
        ";
        // line 262
        if ( !(null === twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "sumOtrosCargos", [], "any", false, false, false, 262))) {
            // line 263
            echo "        <cbc:ChargeTotalAmount currencyID=\"";
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 263);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "sumOtrosCargos", [], "any", false, false, false, 263)]);
            echo "</cbc:ChargeTotalAmount>
        ";
        }
        // line 265
        echo "        ";
        if ( !(null === twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "redondeo", [], "any", false, false, false, 265))) {
            // line 266
            echo "        <cbc:PayableRoundingAmount currencyID=\"";
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 266);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "redondeo", [], "any", false, false, false, 266)]);
            echo "</cbc:PayableRoundingAmount>
        ";
        }
        // line 268
        echo "        <cbc:PayableAmount currencyID=\"";
        echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 268);
        echo "\">";
        echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoImpVenta", [], "any", false, false, false, 268)]);
        echo "</cbc:PayableAmount>
    </cac:RequestedMonetaryTotal>
    ";
        // line 270
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "details", [], "any", false, false, false, 270));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["detail"]) {
            // line 271
            echo "    <cac:DebitNoteLine>
        <cbc:ID>";
            // line 272
            echo twig_get_attribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 272);
            echo "</cbc:ID>
        <cbc:DebitedQuantity unitCode=\"";
            // line 273
            echo twig_get_attribute($this->env, $this->source, $context["detail"], "unidad", [], "any", false, false, false, 273);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["detail"], "cantidad", [], "any", false, false, false, 273);
            echo "</cbc:DebitedQuantity>
        <cbc:LineExtensionAmount currencyID=\"";
            // line 274
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 274);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["detail"], "mtoValorVenta", [], "any", false, false, false, 274)]);
            echo "</cbc:LineExtensionAmount>
        <cac:PricingReference>
            ";
            // line 276
            if (twig_get_attribute($this->env, $this->source, $context["detail"], "mtoValorGratuito", [], "any", false, false, false, 276)) {
                // line 277
                echo "            <cac:AlternativeConditionPrice>
                <cbc:PriceAmount currencyID=\"";
                // line 278
                echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 278);
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format_limit')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["detail"], "mtoValorGratuito", [], "any", false, false, false, 278), 10]);
                echo "</cbc:PriceAmount>
                <cbc:PriceTypeCode>02</cbc:PriceTypeCode>
            </cac:AlternativeConditionPrice>
            ";
            } else {
                // line 282
                echo "            <cac:AlternativeConditionPrice>
                <cbc:PriceAmount currencyID=\"";
                // line 283
                echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 283);
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format_limit')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["detail"], "mtoPrecioUnitario", [], "any", false, false, false, 283), 10]);
                echo "</cbc:PriceAmount>
                <cbc:PriceTypeCode>01</cbc:PriceTypeCode>
            </cac:AlternativeConditionPrice>
            ";
            }
            // line 287
            echo "        </cac:PricingReference>
        <cac:TaxTotal>
            <cbc:TaxAmount currencyID=\"";
            // line 289
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 289);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["detail"], "totalImpuestos", [], "any", false, false, false, 289)]);
            echo "</cbc:TaxAmount>
            ";
            // line 290
            if (twig_get_attribute($this->env, $this->source, $context["detail"], "isc", [], "any", false, false, false, 290)) {
                // line 291
                echo "            <cac:TaxSubtotal>
                <cbc:TaxableAmount currencyID=\"";
                // line 292
                echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 292);
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["detail"], "mtoBaseIsc", [], "any", false, false, false, 292)]);
                echo "</cbc:TaxableAmount>
                <cbc:TaxAmount currencyID=\"";
                // line 293
                echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 293);
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["detail"], "isc", [], "any", false, false, false, 293)]);
                echo "</cbc:TaxAmount>
                <cac:TaxCategory>
                    <cbc:Percent>";
                // line 295
                echo twig_get_attribute($this->env, $this->source, $context["detail"], "porcentajeIsc", [], "any", false, false, false, 295);
                echo "</cbc:Percent>
                    <cbc:TierRange>";
                // line 296
                echo twig_get_attribute($this->env, $this->source, $context["detail"], "tipSisIsc", [], "any", false, false, false, 296);
                echo "</cbc:TierRange>
                    <cac:TaxScheme>
                        <cbc:ID>2000</cbc:ID>
                        <cbc:Name>ISC</cbc:Name>
                        <cbc:TaxTypeCode>EXC</cbc:TaxTypeCode>
                    </cac:TaxScheme>
                </cac:TaxCategory>
            </cac:TaxSubtotal>
            ";
            }
            // line 305
            echo "            <cac:TaxSubtotal>
                <cbc:TaxableAmount currencyID=\"";
            // line 306
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 306);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["detail"], "mtoBaseIgv", [], "any", false, false, false, 306)]);
            echo "</cbc:TaxableAmount>
                <cbc:TaxAmount currencyID=\"";
            // line 307
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 307);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["detail"], "igv", [], "any", false, false, false, 307)]);
            echo "</cbc:TaxAmount>
                <cac:TaxCategory>
                    <cbc:Percent>";
            // line 309
            echo twig_get_attribute($this->env, $this->source, $context["detail"], "porcentajeIgv", [], "any", false, false, false, 309);
            echo "</cbc:Percent>
                    <cbc:TaxExemptionReasonCode>";
            // line 310
            echo twig_get_attribute($this->env, $this->source, $context["detail"], "tipAfeIgv", [], "any", false, false, false, 310);
            echo "</cbc:TaxExemptionReasonCode>
                    ";
            // line 311
            $context["afect"] = Greenter\Xml\Filter\TributoFunction::getByAfectacion(twig_get_attribute($this->env, $this->source, $context["detail"], "tipAfeIgv", [], "any", false, false, false, 311));
            // line 312
            echo "                    <cac:TaxScheme>
                        <cbc:ID>";
            // line 313
            echo twig_get_attribute($this->env, $this->source, ($context["afect"] ?? null), "id", [], "any", false, false, false, 313);
            echo "</cbc:ID>
                        <cbc:Name>";
            // line 314
            echo twig_get_attribute($this->env, $this->source, ($context["afect"] ?? null), "name", [], "any", false, false, false, 314);
            echo "</cbc:Name>
                        <cbc:TaxTypeCode>";
            // line 315
            echo twig_get_attribute($this->env, $this->source, ($context["afect"] ?? null), "code", [], "any", false, false, false, 315);
            echo "</cbc:TaxTypeCode>
                    </cac:TaxScheme>
                </cac:TaxCategory>
            </cac:TaxSubtotal>
            ";
            // line 319
            if (twig_get_attribute($this->env, $this->source, $context["detail"], "otroTributo", [], "any", false, false, false, 319)) {
                // line 320
                echo "            <cac:TaxSubtotal>
                <cbc:TaxableAmount currencyID=\"";
                // line 321
                echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 321);
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["detail"], "mtoBaseOth", [], "any", false, false, false, 321)]);
                echo "</cbc:TaxableAmount>
                <cbc:TaxAmount currencyID=\"";
                // line 322
                echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 322);
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["detail"], "otroTributo", [], "any", false, false, false, 322)]);
                echo "</cbc:TaxAmount>
                <cac:TaxCategory>
                    <cbc:Percent>";
                // line 324
                echo twig_get_attribute($this->env, $this->source, $context["detail"], "porcentajeOth", [], "any", false, false, false, 324);
                echo "</cbc:Percent>
                    <cac:TaxScheme>
                        <cbc:ID>9999</cbc:ID>
                        <cbc:Name>OTROS</cbc:Name>
                        <cbc:TaxTypeCode>OTH</cbc:TaxTypeCode>
                    </cac:TaxScheme>
                </cac:TaxCategory>
            </cac:TaxSubtotal>
            ";
            }
            // line 333
            echo "            ";
            if (twig_get_attribute($this->env, $this->source, $context["detail"], "icbper", [], "any", false, false, false, 333)) {
                // line 334
                echo "            <cac:TaxSubtotal>
                <cbc:TaxAmount currencyID=\"";
                // line 335
                echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 335);
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["detail"], "icbper", [], "any", false, false, false, 335)]);
                echo "</cbc:TaxAmount>
                <cbc:BaseUnitMeasure unitCode=\"";
                // line 336
                echo twig_get_attribute($this->env, $this->source, $context["detail"], "unidad", [], "any", false, false, false, 336);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["detail"], "cantidad", [], "any", false, false, false, 336);
                echo "</cbc:BaseUnitMeasure>
                <cac:TaxCategory>
                    <cbc:PerUnitAmount currencyID=\"";
                // line 338
                echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 338);
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["detail"], "factorIcbper", [], "any", false, false, false, 338)]);
                echo "</cbc:PerUnitAmount>
                    <cac:TaxScheme>
                        <cbc:ID>7152</cbc:ID>
                        <cbc:Name>ICBPER</cbc:Name>
                        <cbc:TaxTypeCode>OTH</cbc:TaxTypeCode>
                    </cac:TaxScheme>
                </cac:TaxCategory>
            </cac:TaxSubtotal>
            ";
            }
            // line 347
            echo "        </cac:TaxTotal>
        <cac:Item>
            <cbc:Description><![CDATA[";
            // line 349
            echo twig_get_attribute($this->env, $this->source, $context["detail"], "descripcion", [], "any", false, false, false, 349);
            echo "]]></cbc:Description>
            ";
            // line 350
            if (twig_get_attribute($this->env, $this->source, $context["detail"], "codProducto", [], "any", false, false, false, 350)) {
                // line 351
                echo "                <cac:SellersItemIdentification>
                    <cbc:ID>";
                // line 352
                echo twig_get_attribute($this->env, $this->source, $context["detail"], "codProducto", [], "any", false, false, false, 352);
                echo "</cbc:ID>
                </cac:SellersItemIdentification>
            ";
            }
            // line 355
            echo "            ";
            if (twig_get_attribute($this->env, $this->source, $context["detail"], "codProdGS1", [], "any", false, false, false, 355)) {
                // line 356
                echo "                <cac:StandardItemIdentification>
                    <cbc:ID>";
                // line 357
                echo twig_get_attribute($this->env, $this->source, $context["detail"], "codProdGS1", [], "any", false, false, false, 357);
                echo "</cbc:ID>
                </cac:StandardItemIdentification>
            ";
            }
            // line 360
            echo "            ";
            if (twig_get_attribute($this->env, $this->source, $context["detail"], "codProdSunat", [], "any", false, false, false, 360)) {
                // line 361
                echo "                <cac:CommodityClassification>
                    <cbc:ItemClassificationCode>";
                // line 362
                echo twig_get_attribute($this->env, $this->source, $context["detail"], "codProdSunat", [], "any", false, false, false, 362);
                echo "</cbc:ItemClassificationCode>
                </cac:CommodityClassification>
            ";
            }
            // line 365
            echo "            ";
            if (twig_get_attribute($this->env, $this->source, $context["detail"], "atributos", [], "any", false, false, false, 365)) {
                // line 366
                echo "                ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["detail"], "atributos", [], "any", false, false, false, 366));
                foreach ($context['_seq'] as $context["_key"] => $context["atr"]) {
                    // line 367
                    echo "                    <cac:AdditionalItemProperty >
                        <cbc:Name>";
                    // line 368
                    echo twig_get_attribute($this->env, $this->source, $context["atr"], "name", [], "any", false, false, false, 368);
                    echo "</cbc:Name>
                        <cbc:NameCode>";
                    // line 369
                    echo twig_get_attribute($this->env, $this->source, $context["atr"], "code", [], "any", false, false, false, 369);
                    echo "</cbc:NameCode>
                        ";
                    // line 370
                    if (twig_get_attribute($this->env, $this->source, $context["atr"], "value", [], "any", false, false, false, 370)) {
                        // line 371
                        echo "                            <cbc:Value>";
                        echo twig_get_attribute($this->env, $this->source, $context["atr"], "value", [], "any", false, false, false, 371);
                        echo "</cbc:Value>
                        ";
                    }
                    // line 373
                    echo "                        ";
                    if (((twig_get_attribute($this->env, $this->source, $context["atr"], "fecInicio", [], "any", false, false, false, 373) || twig_get_attribute($this->env, $this->source, $context["atr"], "fecFin", [], "any", false, false, false, 373)) || twig_get_attribute($this->env, $this->source, $context["atr"], "duracion", [], "any", false, false, false, 373))) {
                        // line 374
                        echo "                            <cac:UsabilityPeriod>
                                ";
                        // line 375
                        if (twig_get_attribute($this->env, $this->source, $context["atr"], "fecInicio", [], "any", false, false, false, 375)) {
                            // line 376
                            echo "                                    <cbc:StartDate>";
                            echo twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["atr"], "fecInicio", [], "any", false, false, false, 376), "Y-m-d");
                            echo "</cbc:StartDate>
                                ";
                        }
                        // line 378
                        echo "                                ";
                        if (twig_get_attribute($this->env, $this->source, $context["atr"], "fecFin", [], "any", false, false, false, 378)) {
                            // line 379
                            echo "                                    <cbc:EndDate>";
                            echo twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["atr"], "fecFin", [], "any", false, false, false, 379), "Y-m-d");
                            echo "</cbc:EndDate>
                                ";
                        }
                        // line 381
                        echo "                                ";
                        if (twig_get_attribute($this->env, $this->source, $context["atr"], "duracion", [], "any", false, false, false, 381)) {
                            // line 382
                            echo "                                    <cbc:DurationMeasure unitCode=\"DAY\">";
                            echo twig_get_attribute($this->env, $this->source, $context["atr"], "duracion", [], "any", false, false, false, 382);
                            echo "</cbc:DurationMeasure>
                                ";
                        }
                        // line 384
                        echo "                            </cac:UsabilityPeriod>
                        ";
                    }
                    // line 386
                    echo "                    </cac:AdditionalItemProperty>
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['atr'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 388
                echo "            ";
            }
            // line 389
            echo "        </cac:Item>
        <cac:Price>
            <cbc:PriceAmount currencyID=\"";
            // line 391
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 391);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format_limit')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["detail"], "mtoValorUnitario", [], "any", false, false, false, 391), 10]);
            echo "</cbc:PriceAmount>
        </cac:Price>
    </cac:DebitNoteLine>
   ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['detail'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 395
        echo "</DebitNote>
";
        $___internal_807a4989db9c271605d4a3aa2bc7f437296aab1e0e8fe97146fb2e1503030611_ = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 1
        echo twig_spaceless($___internal_807a4989db9c271605d4a3aa2bc7f437296aab1e0e8fe97146fb2e1503030611_);
    }

    public function getTemplateName()
    {
        return "notadb2.1.xml.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1015 => 1,  1011 => 395,  991 => 391,  987 => 389,  984 => 388,  977 => 386,  973 => 384,  967 => 382,  964 => 381,  958 => 379,  955 => 378,  949 => 376,  947 => 375,  944 => 374,  941 => 373,  935 => 371,  933 => 370,  929 => 369,  925 => 368,  922 => 367,  917 => 366,  914 => 365,  908 => 362,  905 => 361,  902 => 360,  896 => 357,  893 => 356,  890 => 355,  884 => 352,  881 => 351,  879 => 350,  875 => 349,  871 => 347,  857 => 338,  850 => 336,  844 => 335,  841 => 334,  838 => 333,  826 => 324,  819 => 322,  813 => 321,  810 => 320,  808 => 319,  801 => 315,  797 => 314,  793 => 313,  790 => 312,  788 => 311,  784 => 310,  780 => 309,  773 => 307,  767 => 306,  764 => 305,  752 => 296,  748 => 295,  741 => 293,  735 => 292,  732 => 291,  730 => 290,  724 => 289,  720 => 287,  711 => 283,  708 => 282,  699 => 278,  696 => 277,  694 => 276,  687 => 274,  681 => 273,  677 => 272,  674 => 271,  657 => 270,  649 => 268,  641 => 266,  638 => 265,  630 => 263,  628 => 262,  624 => 260,  609 => 250,  606 => 249,  603 => 248,  588 => 238,  582 => 237,  579 => 236,  576 => 235,  561 => 225,  555 => 224,  552 => 223,  549 => 222,  536 => 212,  530 => 211,  527 => 210,  524 => 209,  509 => 199,  503 => 198,  500 => 197,  497 => 196,  484 => 186,  478 => 185,  475 => 184,  472 => 183,  459 => 173,  453 => 172,  450 => 171,  447 => 170,  432 => 160,  426 => 159,  423 => 158,  420 => 157,  405 => 147,  399 => 146,  396 => 145,  394 => 144,  388 => 143,  383 => 140,  379 => 138,  373 => 136,  370 => 135,  364 => 133,  362 => 132,  359 => 131,  357 => 130,  354 => 129,  347 => 125,  341 => 122,  338 => 121,  332 => 119,  330 => 118,  327 => 117,  324 => 116,  322 => 115,  318 => 114,  310 => 111,  305 => 108,  303 => 107,  299 => 105,  295 => 103,  289 => 101,  286 => 100,  280 => 98,  278 => 97,  275 => 96,  273 => 95,  266 => 91,  260 => 88,  255 => 86,  251 => 85,  246 => 84,  240 => 82,  238 => 81,  234 => 80,  230 => 79,  227 => 78,  225 => 77,  221 => 76,  215 => 73,  209 => 70,  194 => 58,  188 => 55,  182 => 52,  179 => 51,  176 => 50,  173 => 49,  164 => 46,  160 => 45,  157 => 44,  152 => 43,  149 => 42,  146 => 41,  137 => 38,  133 => 37,  130 => 36,  125 => 35,  123 => 34,  117 => 31,  113 => 30,  109 => 28,  103 => 25,  100 => 24,  98 => 23,  93 => 21,  89 => 20,  85 => 19,  79 => 17,  68 => 15,  64 => 14,  60 => 13,  56 => 12,  50 => 11,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "notadb2.1.xml.twig", "C:\\xampp\\htdocs\\WebServicePHPSn\\app\\vendor\\greenter\\xml\\src\\Xml\\Templates\\notadb2.1.xml.twig");
    }
}
