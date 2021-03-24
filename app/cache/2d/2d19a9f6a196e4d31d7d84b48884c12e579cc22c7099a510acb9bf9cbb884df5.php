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

/* invoice2.1.xml.twig */
class __TwigTemplate_f9c1593718fd2867f5696925f4077a1ad14db595f591d02fc0fadcd1ec1d6414 extends Template
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
<Invoice xmlns=\"urn:oasis:names:specification:ubl:schema:xsd:Invoice-2\" xmlns:cac=\"urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2\" xmlns:cbc=\"urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2\" xmlns:ds=\"http://www.w3.org/2000/09/xmldsig#\" xmlns:ext=\"urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2\">
    <ext:UBLExtensions>
        <ext:UBLExtension>
            <ext:ExtensionContent/>
        </ext:UBLExtension>
    </ext:UBLExtensions>
    ";
        // line 9
        $context["emp"] = twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "company", [], "any", false, false, false, 9);
        // line 10
        echo "    <cbc:UBLVersionID>2.1</cbc:UBLVersionID>
    <cbc:CustomizationID>2.0</cbc:CustomizationID>
    <cbc:ID>";
        // line 12
        echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "serie", [], "any", false, false, false, 12);
        echo "-";
        echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "correlativo", [], "any", false, false, false, 12);
        echo "</cbc:ID>
    <cbc:IssueDate>";
        // line 13
        echo twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "fechaEmision", [], "any", false, false, false, 13), "Y-m-d");
        echo "</cbc:IssueDate>
    <cbc:IssueTime>";
        // line 14
        echo twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "fechaEmision", [], "any", false, false, false, 14), "H:i:s");
        echo "</cbc:IssueTime>
    ";
        // line 15
        if (twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "fecVencimiento", [], "any", false, false, false, 15)) {
            // line 16
            echo "    <cbc:DueDate>";
            echo twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "fecVencimiento", [], "any", false, false, false, 16), "Y-m-d");
            echo "</cbc:DueDate>
    ";
        }
        // line 18
        echo "    <cbc:InvoiceTypeCode listID=\"";
        echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoOperacion", [], "any", false, false, false, 18);
        echo "\">";
        echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoDoc", [], "any", false, false, false, 18);
        echo "</cbc:InvoiceTypeCode>
    ";
        // line 19
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "legends", [], "any", false, false, false, 19));
        foreach ($context['_seq'] as $context["_key"] => $context["leg"]) {
            // line 20
            echo "    <cbc:Note languageLocaleID=\"";
            echo twig_get_attribute($this->env, $this->source, $context["leg"], "code", [], "any", false, false, false, 20);
            echo "\"><![CDATA[";
            echo twig_get_attribute($this->env, $this->source, $context["leg"], "value", [], "any", false, false, false, 20);
            echo "]]></cbc:Note>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['leg'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 22
        echo "    ";
        if (twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "observacion", [], "any", false, false, false, 22)) {
            // line 23
            echo "    <cbc:Note><![CDATA[";
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "observacion", [], "any", false, false, false, 23);
            echo "]]></cbc:Note>
    ";
        }
        // line 25
        echo "    <cbc:DocumentCurrencyCode>";
        echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 25);
        echo "</cbc:DocumentCurrencyCode>
    ";
        // line 26
        if (twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "compra", [], "any", false, false, false, 26)) {
            // line 27
            echo "    <cac:OrderReference>
        <cbc:ID>";
            // line 28
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "compra", [], "any", false, false, false, 28);
            echo "</cbc:ID>
    </cac:OrderReference>
    ";
        }
        // line 31
        echo "    ";
        if (twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "guias", [], "any", false, false, false, 31)) {
            // line 32
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "guias", [], "any", false, false, false, 32));
            foreach ($context['_seq'] as $context["_key"] => $context["guia"]) {
                // line 33
                echo "    <cac:DespatchDocumentReference>
        <cbc:ID>";
                // line 34
                echo twig_get_attribute($this->env, $this->source, $context["guia"], "nroDoc", [], "any", false, false, false, 34);
                echo "</cbc:ID>
        <cbc:DocumentTypeCode>";
                // line 35
                echo twig_get_attribute($this->env, $this->source, $context["guia"], "tipoDoc", [], "any", false, false, false, 35);
                echo "</cbc:DocumentTypeCode>
    </cac:DespatchDocumentReference>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['guia'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 38
            echo "    ";
        }
        // line 39
        echo "    ";
        if (twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "relDocs", [], "any", false, false, false, 39)) {
            // line 40
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "relDocs", [], "any", false, false, false, 40));
            foreach ($context['_seq'] as $context["_key"] => $context["rel"]) {
                // line 41
                echo "    <cac:AdditionalDocumentReference>
        <cbc:ID>";
                // line 42
                echo twig_get_attribute($this->env, $this->source, $context["rel"], "nroDoc", [], "any", false, false, false, 42);
                echo "</cbc:ID>
        <cbc:DocumentTypeCode>";
                // line 43
                echo twig_get_attribute($this->env, $this->source, $context["rel"], "tipoDoc", [], "any", false, false, false, 43);
                echo "</cbc:DocumentTypeCode>
    </cac:AdditionalDocumentReference>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['rel'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 46
            echo "    ";
        }
        // line 47
        echo "    ";
        if (twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "anticipos", [], "any", false, false, false, 47)) {
            // line 48
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "anticipos", [], "any", false, false, false, 48));
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
            foreach ($context['_seq'] as $context["_key"] => $context["ant"]) {
                // line 49
                echo "    <cac:AdditionalDocumentReference>
        <cbc:ID>";
                // line 50
                echo twig_get_attribute($this->env, $this->source, $context["ant"], "nroDocRel", [], "any", false, false, false, 50);
                echo "</cbc:ID>
        <cbc:DocumentTypeCode>";
                // line 51
                echo twig_get_attribute($this->env, $this->source, $context["ant"], "tipoDocRel", [], "any", false, false, false, 51);
                echo "</cbc:DocumentTypeCode>
        <cbc:DocumentStatusCode>";
                // line 52
                echo twig_get_attribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 52);
                echo "</cbc:DocumentStatusCode>
        <cac:IssuerParty>
            <cac:PartyIdentification>
                <cbc:ID schemeID=\"6\">";
                // line 55
                echo twig_get_attribute($this->env, $this->source, ($context["emp"] ?? null), "ruc", [], "any", false, false, false, 55);
                echo "</cbc:ID>
            </cac:PartyIdentification>
        </cac:IssuerParty>
    </cac:AdditionalDocumentReference>
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ant'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 60
            echo "    ";
        }
        // line 61
        echo "    <cac:Signature>
        <cbc:ID>";
        // line 62
        echo twig_get_attribute($this->env, $this->source, ($context["emp"] ?? null), "ruc", [], "any", false, false, false, 62);
        echo "</cbc:ID>
        <cac:SignatoryParty>
            <cac:PartyIdentification>
                <cbc:ID>";
        // line 65
        echo twig_get_attribute($this->env, $this->source, ($context["emp"] ?? null), "ruc", [], "any", false, false, false, 65);
        echo "</cbc:ID>
            </cac:PartyIdentification>
            <cac:PartyName>
                <cbc:Name><![CDATA[";
        // line 68
        echo twig_get_attribute($this->env, $this->source, ($context["emp"] ?? null), "razonSocial", [], "any", false, false, false, 68);
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
        // line 80
        echo twig_get_attribute($this->env, $this->source, ($context["emp"] ?? null), "ruc", [], "any", false, false, false, 80);
        echo "</cbc:ID>
            </cac:PartyIdentification>
            <cac:PartyName>
                <cbc:Name><![CDATA[";
        // line 83
        echo twig_get_attribute($this->env, $this->source, ($context["emp"] ?? null), "nombreComercial", [], "any", false, false, false, 83);
        echo "]]></cbc:Name>
            </cac:PartyName>
            <cac:PartyLegalEntity>
                <cbc:RegistrationName><![CDATA[";
        // line 86
        echo twig_get_attribute($this->env, $this->source, ($context["emp"] ?? null), "razonSocial", [], "any", false, false, false, 86);
        echo "]]></cbc:RegistrationName>
                ";
        // line 87
        $context["addr"] = twig_get_attribute($this->env, $this->source, ($context["emp"] ?? null), "address", [], "any", false, false, false, 87);
        // line 88
        echo "                <cac:RegistrationAddress>
                    <cbc:ID>";
        // line 89
        echo twig_get_attribute($this->env, $this->source, ($context["addr"] ?? null), "ubigueo", [], "any", false, false, false, 89);
        echo "</cbc:ID>
                    <cbc:AddressTypeCode>";
        // line 90
        echo twig_get_attribute($this->env, $this->source, ($context["addr"] ?? null), "codLocal", [], "any", false, false, false, 90);
        echo "</cbc:AddressTypeCode>
                    ";
        // line 91
        if (twig_get_attribute($this->env, $this->source, ($context["addr"] ?? null), "urbanizacion", [], "any", false, false, false, 91)) {
            // line 92
            echo "                    <cbc:CitySubdivisionName>";
            echo twig_get_attribute($this->env, $this->source, ($context["addr"] ?? null), "urbanizacion", [], "any", false, false, false, 92);
            echo "</cbc:CitySubdivisionName>
                    ";
        }
        // line 94
        echo "                    <cbc:CityName>";
        echo twig_get_attribute($this->env, $this->source, ($context["addr"] ?? null), "provincia", [], "any", false, false, false, 94);
        echo "</cbc:CityName>
                    <cbc:CountrySubentity>";
        // line 95
        echo twig_get_attribute($this->env, $this->source, ($context["addr"] ?? null), "departamento", [], "any", false, false, false, 95);
        echo "</cbc:CountrySubentity>
                    <cbc:District>";
        // line 96
        echo twig_get_attribute($this->env, $this->source, ($context["addr"] ?? null), "distrito", [], "any", false, false, false, 96);
        echo "</cbc:District>
                    <cac:AddressLine>
                        <cbc:Line><![CDATA[";
        // line 98
        echo twig_get_attribute($this->env, $this->source, ($context["addr"] ?? null), "direccion", [], "any", false, false, false, 98);
        echo "]]></cbc:Line>
                    </cac:AddressLine>
                    <cac:Country>
                        <cbc:IdentificationCode>";
        // line 101
        echo twig_get_attribute($this->env, $this->source, ($context["addr"] ?? null), "codigoPais", [], "any", false, false, false, 101);
        echo "</cbc:IdentificationCode>
                    </cac:Country>
                </cac:RegistrationAddress>
            </cac:PartyLegalEntity>
            ";
        // line 105
        if ((twig_get_attribute($this->env, $this->source, ($context["emp"] ?? null), "email", [], "any", false, false, false, 105) || twig_get_attribute($this->env, $this->source, ($context["emp"] ?? null), "telephone", [], "any", false, false, false, 105))) {
            // line 106
            echo "            <cac:Contact>
                ";
            // line 107
            if (twig_get_attribute($this->env, $this->source, ($context["emp"] ?? null), "telephone", [], "any", false, false, false, 107)) {
                // line 108
                echo "                <cbc:Telephone>";
                echo twig_get_attribute($this->env, $this->source, ($context["emp"] ?? null), "telephone", [], "any", false, false, false, 108);
                echo "</cbc:Telephone>
                ";
            }
            // line 110
            echo "                ";
            if (twig_get_attribute($this->env, $this->source, ($context["emp"] ?? null), "email", [], "any", false, false, false, 110)) {
                // line 111
                echo "                <cbc:ElectronicMail>";
                echo twig_get_attribute($this->env, $this->source, ($context["emp"] ?? null), "email", [], "any", false, false, false, 111);
                echo "</cbc:ElectronicMail>
                ";
            }
            // line 113
            echo "            </cac:Contact>
            ";
        }
        // line 115
        echo "        </cac:Party>
    </cac:AccountingSupplierParty>
    ";
        // line 117
        $context["client"] = twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "client", [], "any", false, false, false, 117);
        // line 118
        echo "    <cac:AccountingCustomerParty>
        <cac:Party>
            <cac:PartyIdentification>
                <cbc:ID schemeID=\"";
        // line 121
        echo twig_get_attribute($this->env, $this->source, ($context["client"] ?? null), "tipoDoc", [], "any", false, false, false, 121);
        echo "\">";
        echo twig_get_attribute($this->env, $this->source, ($context["client"] ?? null), "numDoc", [], "any", false, false, false, 121);
        echo "</cbc:ID>
            </cac:PartyIdentification>
            <cac:PartyLegalEntity>
                <cbc:RegistrationName><![CDATA[";
        // line 124
        echo twig_get_attribute($this->env, $this->source, ($context["client"] ?? null), "rznSocial", [], "any", false, false, false, 124);
        echo "]]></cbc:RegistrationName>
                ";
        // line 125
        if (twig_get_attribute($this->env, $this->source, ($context["client"] ?? null), "address", [], "any", false, false, false, 125)) {
            // line 126
            echo "                ";
            $context["addr"] = twig_get_attribute($this->env, $this->source, ($context["client"] ?? null), "address", [], "any", false, false, false, 126);
            // line 127
            echo "                <cac:RegistrationAddress>
                    ";
            // line 128
            if (twig_get_attribute($this->env, $this->source, ($context["addr"] ?? null), "ubigueo", [], "any", false, false, false, 128)) {
                // line 129
                echo "                    <cbc:ID>";
                echo twig_get_attribute($this->env, $this->source, ($context["addr"] ?? null), "ubigueo", [], "any", false, false, false, 129);
                echo "</cbc:ID>
                    ";
            }
            // line 131
            echo "                    <cac:AddressLine>
                        <cbc:Line><![CDATA[";
            // line 132
            echo twig_get_attribute($this->env, $this->source, ($context["addr"] ?? null), "direccion", [], "any", false, false, false, 132);
            echo "]]></cbc:Line>
                    </cac:AddressLine>
                    <cac:Country>
                        <cbc:IdentificationCode>";
            // line 135
            echo twig_get_attribute($this->env, $this->source, ($context["addr"] ?? null), "codigoPais", [], "any", false, false, false, 135);
            echo "</cbc:IdentificationCode>
                    </cac:Country>
                </cac:RegistrationAddress>
                ";
        }
        // line 139
        echo "            </cac:PartyLegalEntity>
            ";
        // line 140
        if ((twig_get_attribute($this->env, $this->source, ($context["client"] ?? null), "email", [], "any", false, false, false, 140) || twig_get_attribute($this->env, $this->source, ($context["client"] ?? null), "telephone", [], "any", false, false, false, 140))) {
            // line 141
            echo "            <cac:Contact>
                ";
            // line 142
            if (twig_get_attribute($this->env, $this->source, ($context["client"] ?? null), "telephone", [], "any", false, false, false, 142)) {
                // line 143
                echo "                <cbc:Telephone>";
                echo twig_get_attribute($this->env, $this->source, ($context["client"] ?? null), "telephone", [], "any", false, false, false, 143);
                echo "</cbc:Telephone>
                ";
            }
            // line 145
            echo "                ";
            if (twig_get_attribute($this->env, $this->source, ($context["client"] ?? null), "email", [], "any", false, false, false, 145)) {
                // line 146
                echo "                <cbc:ElectronicMail>";
                echo twig_get_attribute($this->env, $this->source, ($context["client"] ?? null), "email", [], "any", false, false, false, 146);
                echo "</cbc:ElectronicMail>
                ";
            }
            // line 148
            echo "            </cac:Contact>
            ";
        }
        // line 150
        echo "        </cac:Party>
    </cac:AccountingCustomerParty>
    ";
        // line 152
        $context["seller"] = twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "seller", [], "any", false, false, false, 152);
        // line 153
        echo "    ";
        if (($context["seller"] ?? null)) {
            // line 154
            echo "    <cac:SellerSupplierParty>
        <cac:Party>
            <cac:PartyIdentification>
                <cbc:ID schemeID=\"";
            // line 157
            echo twig_get_attribute($this->env, $this->source, ($context["seller"] ?? null), "tipoDoc", [], "any", false, false, false, 157);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, ($context["seller"] ?? null), "numDoc", [], "any", false, false, false, 157);
            echo "</cbc:ID>
            </cac:PartyIdentification>
            <cac:PartyLegalEntity>
                <cbc:RegistrationName><![CDATA[";
            // line 160
            echo twig_get_attribute($this->env, $this->source, ($context["seller"] ?? null), "rznSocial", [], "any", false, false, false, 160);
            echo "]]></cbc:RegistrationName>
                ";
            // line 161
            if (twig_get_attribute($this->env, $this->source, ($context["seller"] ?? null), "address", [], "any", false, false, false, 161)) {
                // line 162
                echo "                ";
                $context["addr"] = twig_get_attribute($this->env, $this->source, ($context["seller"] ?? null), "address", [], "any", false, false, false, 162);
                // line 163
                echo "                <cac:RegistrationAddress>
                    ";
                // line 164
                if (twig_get_attribute($this->env, $this->source, ($context["addr"] ?? null), "ubigueo", [], "any", false, false, false, 164)) {
                    // line 165
                    echo "                    <cbc:ID>";
                    echo twig_get_attribute($this->env, $this->source, ($context["addr"] ?? null), "ubigueo", [], "any", false, false, false, 165);
                    echo "</cbc:ID>
                    ";
                }
                // line 167
                echo "                    <cac:AddressLine>
                        <cbc:Line><![CDATA[";
                // line 168
                echo twig_get_attribute($this->env, $this->source, ($context["addr"] ?? null), "direccion", [], "any", false, false, false, 168);
                echo "]]></cbc:Line>
                    </cac:AddressLine>
                    <cac:Country>
                        <cbc:IdentificationCode>";
                // line 171
                echo twig_get_attribute($this->env, $this->source, ($context["addr"] ?? null), "codigoPais", [], "any", false, false, false, 171);
                echo "</cbc:IdentificationCode>
                    </cac:Country>
                </cac:RegistrationAddress>
                ";
            }
            // line 175
            echo "            </cac:PartyLegalEntity>
            ";
            // line 176
            if ((twig_get_attribute($this->env, $this->source, ($context["seller"] ?? null), "email", [], "any", false, false, false, 176) || twig_get_attribute($this->env, $this->source, ($context["seller"] ?? null), "telephone", [], "any", false, false, false, 176))) {
                // line 177
                echo "            <cac:Contact>
                ";
                // line 178
                if (twig_get_attribute($this->env, $this->source, ($context["seller"] ?? null), "telephone", [], "any", false, false, false, 178)) {
                    // line 179
                    echo "                <cbc:Telephone>";
                    echo twig_get_attribute($this->env, $this->source, ($context["seller"] ?? null), "telephone", [], "any", false, false, false, 179);
                    echo "</cbc:Telephone>
                ";
                }
                // line 181
                echo "                ";
                if (twig_get_attribute($this->env, $this->source, ($context["seller"] ?? null), "email", [], "any", false, false, false, 181)) {
                    // line 182
                    echo "                <cbc:ElectronicMail>";
                    echo twig_get_attribute($this->env, $this->source, ($context["seller"] ?? null), "email", [], "any", false, false, false, 182);
                    echo "</cbc:ElectronicMail>
                ";
                }
                // line 184
                echo "            </cac:Contact>
            ";
            }
            // line 186
            echo "        </cac:Party>
    </cac:SellerSupplierParty>
    ";
        }
        // line 189
        echo "    ";
        if (twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "direccionEntrega", [], "any", false, false, false, 189)) {
            // line 190
            echo "        ";
            $context["addr"] = twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "direccionEntrega", [], "any", false, false, false, 190);
            // line 191
            echo "        <cac:Delivery>
            <cac:DeliveryLocation>
                <cac:Address>
                    <cbc:ID>";
            // line 194
            echo twig_get_attribute($this->env, $this->source, ($context["addr"] ?? null), "ubigueo", [], "any", false, false, false, 194);
            echo "</cbc:ID>
                    ";
            // line 195
            if (twig_get_attribute($this->env, $this->source, ($context["addr"] ?? null), "urbanizacion", [], "any", false, false, false, 195)) {
                // line 196
                echo "                    <cbc:CitySubdivisionName>";
                echo twig_get_attribute($this->env, $this->source, ($context["addr"] ?? null), "urbanizacion", [], "any", false, false, false, 196);
                echo "</cbc:CitySubdivisionName>
                    ";
            }
            // line 198
            echo "                    <cbc:CityName>";
            echo twig_get_attribute($this->env, $this->source, ($context["addr"] ?? null), "provincia", [], "any", false, false, false, 198);
            echo "</cbc:CityName>
                    <cbc:CountrySubentity>";
            // line 199
            echo twig_get_attribute($this->env, $this->source, ($context["addr"] ?? null), "departamento", [], "any", false, false, false, 199);
            echo "</cbc:CountrySubentity>
                    <cbc:District>";
            // line 200
            echo twig_get_attribute($this->env, $this->source, ($context["addr"] ?? null), "distrito", [], "any", false, false, false, 200);
            echo "</cbc:District>
                    <cac:AddressLine>
                        <cbc:Line><![CDATA[";
            // line 202
            echo twig_get_attribute($this->env, $this->source, ($context["addr"] ?? null), "direccion", [], "any", false, false, false, 202);
            echo "]]></cbc:Line>
                    </cac:AddressLine>
                    <cac:Country>
                        <cbc:IdentificationCode listID=\"ISO 3166-1\" listAgencyName=\"United Nations Economic Commission for Europe\" listName=\"Country\">";
            // line 205
            echo twig_get_attribute($this->env, $this->source, ($context["addr"] ?? null), "codigoPais", [], "any", false, false, false, 205);
            echo "</cbc:IdentificationCode>
                    </cac:Country>
                </cac:Address>
            </cac:DeliveryLocation>
        </cac:Delivery>
    ";
        }
        // line 211
        echo "    ";
        if (twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "detraccion", [], "any", false, false, false, 211)) {
            // line 212
            echo "    ";
            $context["detr"] = twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "detraccion", [], "any", false, false, false, 212);
            // line 213
            echo "    <cac:PaymentMeans>
        <cbc:ID>Detraccion</cbc:ID>
        <cbc:PaymentMeansCode>";
            // line 215
            echo twig_get_attribute($this->env, $this->source, ($context["detr"] ?? null), "codMedioPago", [], "any", false, false, false, 215);
            echo "</cbc:PaymentMeansCode>
        <cac:PayeeFinancialAccount>
            <cbc:ID>";
            // line 217
            echo twig_get_attribute($this->env, $this->source, ($context["detr"] ?? null), "ctaBanco", [], "any", false, false, false, 217);
            echo "</cbc:ID>
        </cac:PayeeFinancialAccount>
    </cac:PaymentMeans>
    <cac:PaymentTerms>
        <cbc:ID>Detraccion</cbc:ID>
        <cbc:PaymentMeansID>";
            // line 222
            echo twig_get_attribute($this->env, $this->source, ($context["detr"] ?? null), "codBienDetraccion", [], "any", false, false, false, 222);
            echo "</cbc:PaymentMeansID>
        <cbc:PaymentPercent>";
            // line 223
            echo twig_get_attribute($this->env, $this->source, ($context["detr"] ?? null), "percent", [], "any", false, false, false, 223);
            echo "</cbc:PaymentPercent>
        <cbc:Amount currencyID=\"PEN\">";
            // line 224
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["detr"] ?? null), "mount", [], "any", false, false, false, 224)]);
            echo "</cbc:Amount>
    </cac:PaymentTerms>
    ";
        }
        // line 227
        echo "    ";
        if (twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "perception", [], "any", false, false, false, 227)) {
            // line 228
            echo "    <cac:PaymentTerms>
        <cbc:ID>Percepcion</cbc:ID>
        <cbc:Amount currencyID=\"PEN\">";
            // line 230
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "perception", [], "any", false, false, false, 230), "mtoTotal", [], "any", false, false, false, 230)]);
            echo "</cbc:Amount>
    </cac:PaymentTerms>
    ";
        }
        // line 233
        echo "    ";
        if (twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "anticipos", [], "any", false, false, false, 233)) {
            // line 234
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "anticipos", [], "any", false, false, false, 234));
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
            foreach ($context['_seq'] as $context["_key"] => $context["ant"]) {
                // line 235
                echo "    <cac:PrepaidPayment>
        <cbc:ID>";
                // line 236
                echo twig_get_attribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 236);
                echo "</cbc:ID>
        <cbc:PaidAmount currencyID=\"";
                // line 237
                echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 237);
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["ant"], "total", [], "any", false, false, false, 237)]);
                echo "</cbc:PaidAmount>
    </cac:PrepaidPayment>
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ant'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 240
            echo "    ";
        }
        // line 241
        echo "    ";
        if (twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "cargos", [], "any", false, false, false, 241)) {
            // line 242
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "cargos", [], "any", false, false, false, 242));
            foreach ($context['_seq'] as $context["_key"] => $context["cargo"]) {
                // line 243
                echo "    <cac:AllowanceCharge>
        <cbc:ChargeIndicator>true</cbc:ChargeIndicator>
        <cbc:AllowanceChargeReasonCode>";
                // line 245
                echo twig_get_attribute($this->env, $this->source, $context["cargo"], "codTipo", [], "any", false, false, false, 245);
                echo "</cbc:AllowanceChargeReasonCode>
        <cbc:MultiplierFactorNumeric>";
                // line 246
                echo twig_get_attribute($this->env, $this->source, $context["cargo"], "factor", [], "any", false, false, false, 246);
                echo "</cbc:MultiplierFactorNumeric>
        <cbc:Amount currencyID=\"";
                // line 247
                echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 247);
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["cargo"], "monto", [], "any", false, false, false, 247)]);
                echo "</cbc:Amount>
        <cbc:BaseAmount currencyID=\"";
                // line 248
                echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 248);
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["cargo"], "montoBase", [], "any", false, false, false, 248)]);
                echo "</cbc:BaseAmount>
    </cac:AllowanceCharge>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['cargo'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 251
            echo "    ";
        }
        // line 252
        echo "    ";
        if (twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "descuentos", [], "any", false, false, false, 252)) {
            // line 253
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "descuentos", [], "any", false, false, false, 253));
            foreach ($context['_seq'] as $context["_key"] => $context["desc"]) {
                // line 254
                echo "    <cac:AllowanceCharge>
        <cbc:ChargeIndicator>false</cbc:ChargeIndicator>
        <cbc:AllowanceChargeReasonCode>";
                // line 256
                echo twig_get_attribute($this->env, $this->source, $context["desc"], "codTipo", [], "any", false, false, false, 256);
                echo "</cbc:AllowanceChargeReasonCode>
        <cbc:MultiplierFactorNumeric>";
                // line 257
                echo twig_get_attribute($this->env, $this->source, $context["desc"], "factor", [], "any", false, false, false, 257);
                echo "</cbc:MultiplierFactorNumeric>
        <cbc:Amount currencyID=\"";
                // line 258
                echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 258);
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["desc"], "monto", [], "any", false, false, false, 258)]);
                echo "</cbc:Amount>
        <cbc:BaseAmount currencyID=\"";
                // line 259
                echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 259);
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["desc"], "montoBase", [], "any", false, false, false, 259)]);
                echo "</cbc:BaseAmount>
    </cac:AllowanceCharge>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['desc'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 262
            echo "    ";
        }
        // line 263
        echo "    ";
        if (twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "perception", [], "any", false, false, false, 263)) {
            // line 264
            echo "    ";
            $context["perc"] = twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "perception", [], "any", false, false, false, 264);
            // line 265
            echo "    <cac:AllowanceCharge>
        <cbc:ChargeIndicator>true</cbc:ChargeIndicator>
        <cbc:AllowanceChargeReasonCode>";
            // line 267
            echo twig_get_attribute($this->env, $this->source, ($context["perc"] ?? null), "codReg", [], "any", false, false, false, 267);
            echo "</cbc:AllowanceChargeReasonCode>
        <cbc:MultiplierFactorNumeric>";
            // line 268
            echo twig_get_attribute($this->env, $this->source, ($context["perc"] ?? null), "porcentaje", [], "any", false, false, false, 268);
            echo "</cbc:MultiplierFactorNumeric>
        <cbc:Amount currencyID=\"PEN\">";
            // line 269
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["perc"] ?? null), "mto", [], "any", false, false, false, 269)]);
            echo "</cbc:Amount>
        <cbc:BaseAmount currencyID=\"PEN\">";
            // line 270
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["perc"] ?? null), "mtoBase", [], "any", false, false, false, 270)]);
            echo "</cbc:BaseAmount>
    </cac:AllowanceCharge>
    ";
        }
        // line 273
        echo "    <cac:TaxTotal>
        <cbc:TaxAmount currencyID=\"";
        // line 274
        echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 274);
        echo "\">";
        echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "totalImpuestos", [], "any", false, false, false, 274)]);
        echo "</cbc:TaxAmount>
        ";
        // line 275
        if (twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoISC", [], "any", false, false, false, 275)) {
            // line 276
            echo "        <cac:TaxSubtotal>
            <cbc:TaxableAmount currencyID=\"";
            // line 277
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 277);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoBaseIsc", [], "any", false, false, false, 277)]);
            echo "</cbc:TaxableAmount>
            <cbc:TaxAmount currencyID=\"";
            // line 278
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 278);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoISC", [], "any", false, false, false, 278)]);
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
        // line 288
        echo "        ";
        if (twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoOperGravadas", [], "any", false, false, false, 288)) {
            // line 289
            echo "        <cac:TaxSubtotal>
            <cbc:TaxableAmount currencyID=\"";
            // line 290
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 290);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoOperGravadas", [], "any", false, false, false, 290)]);
            echo "</cbc:TaxableAmount>
            <cbc:TaxAmount currencyID=\"";
            // line 291
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 291);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoIGV", [], "any", false, false, false, 291)]);
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
        // line 301
        echo "        ";
        if (twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoOperInafectas", [], "any", false, false, false, 301)) {
            // line 302
            echo "            <cac:TaxSubtotal>
                <cbc:TaxableAmount currencyID=\"";
            // line 303
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 303);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoOperInafectas", [], "any", false, false, false, 303)]);
            echo "</cbc:TaxableAmount>
                <cbc:TaxAmount currencyID=\"";
            // line 304
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 304);
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
        // line 314
        echo "        ";
        if (twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoOperExoneradas", [], "any", false, false, false, 314)) {
            // line 315
            echo "            <cac:TaxSubtotal>
                <cbc:TaxableAmount currencyID=\"";
            // line 316
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 316);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoOperExoneradas", [], "any", false, false, false, 316)]);
            echo "</cbc:TaxableAmount>
                <cbc:TaxAmount currencyID=\"";
            // line 317
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 317);
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
        // line 327
        echo "        ";
        if (twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoOperGratuitas", [], "any", false, false, false, 327)) {
            // line 328
            echo "            <cac:TaxSubtotal>
                <cbc:TaxableAmount currencyID=\"";
            // line 329
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 329);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoOperGratuitas", [], "any", false, false, false, 329)]);
            echo "</cbc:TaxableAmount>
                <cbc:TaxAmount currencyID=\"";
            // line 330
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 330);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoIGVGratuitas", [], "any", false, false, false, 330)]);
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
        // line 340
        echo "        ";
        if (twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoOperExportacion", [], "any", false, false, false, 340)) {
            // line 341
            echo "            <cac:TaxSubtotal>
                <cbc:TaxableAmount currencyID=\"";
            // line 342
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 342);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoOperExportacion", [], "any", false, false, false, 342)]);
            echo "</cbc:TaxableAmount>
                <cbc:TaxAmount currencyID=\"";
            // line 343
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 343);
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
        // line 353
        echo "        ";
        if (twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoIvap", [], "any", false, false, false, 353)) {
            // line 354
            echo "        <cac:TaxSubtotal>
            <cbc:TaxableAmount currencyID=\"";
            // line 355
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 355);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoBaseIvap", [], "any", false, false, false, 355)]);
            echo "</cbc:TaxableAmount>
            <cbc:TaxAmount currencyID=\"";
            // line 356
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 356);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoIvap", [], "any", false, false, false, 356)]);
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
        // line 366
        echo "        ";
        if (twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoOtrosTributos", [], "any", false, false, false, 366)) {
            // line 367
            echo "        <cac:TaxSubtotal>
            <cbc:TaxableAmount currencyID=\"";
            // line 368
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 368);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoBaseOth", [], "any", false, false, false, 368)]);
            echo "</cbc:TaxableAmount>
            <cbc:TaxAmount currencyID=\"";
            // line 369
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 369);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoOtrosTributos", [], "any", false, false, false, 369)]);
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
        // line 379
        echo "        ";
        if (twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "icbper", [], "any", false, false, false, 379)) {
            // line 380
            echo "            <cac:TaxSubtotal>
                <cbc:TaxAmount currencyID=\"";
            // line 381
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 381);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "icbper", [], "any", false, false, false, 381)]);
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
        // line 391
        echo "    </cac:TaxTotal>
    <cac:LegalMonetaryTotal>
        <cbc:LineExtensionAmount currencyID=\"";
        // line 393
        echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 393);
        echo "\">";
        echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "valorVenta", [], "any", false, false, false, 393)]);
        echo "</cbc:LineExtensionAmount>
        ";
        // line 394
        if ( !(null === twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "subTotal", [], "any", false, false, false, 394))) {
            // line 395
            echo "        <cbc:TaxInclusiveAmount currencyID=\"";
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 395);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "subTotal", [], "any", false, false, false, 395)]);
            echo "</cbc:TaxInclusiveAmount>
        ";
        }
        // line 397
        echo "        ";
        if ( !(null === twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "sumOtrosDescuentos", [], "any", false, false, false, 397))) {
            // line 398
            echo "        <cbc:AllowanceTotalAmount currencyID=\"";
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 398);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "sumOtrosDescuentos", [], "any", false, false, false, 398)]);
            echo "</cbc:AllowanceTotalAmount>
        ";
        }
        // line 400
        echo "        ";
        if ( !(null === twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "sumOtrosCargos", [], "any", false, false, false, 400))) {
            // line 401
            echo "        <cbc:ChargeTotalAmount currencyID=\"";
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 401);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "sumOtrosCargos", [], "any", false, false, false, 401)]);
            echo "</cbc:ChargeTotalAmount>
        ";
        }
        // line 403
        echo "        ";
        if ( !(null === twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "totalAnticipos", [], "any", false, false, false, 403))) {
            // line 404
            echo "        <cbc:PrepaidAmount currencyID=\"";
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 404);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "totalAnticipos", [], "any", false, false, false, 404)]);
            echo "</cbc:PrepaidAmount>
        ";
        }
        // line 406
        echo "        ";
        if ( !(null === twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "redondeo", [], "any", false, false, false, 406))) {
            // line 407
            echo "        <cbc:PayableRoundingAmount currencyID=\"";
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 407);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "redondeo", [], "any", false, false, false, 407)]);
            echo "</cbc:PayableRoundingAmount>
        ";
        }
        // line 409
        echo "        <cbc:PayableAmount currencyID=\"";
        echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 409);
        echo "\">";
        echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "mtoImpVenta", [], "any", false, false, false, 409)]);
        echo "</cbc:PayableAmount>
    </cac:LegalMonetaryTotal>
    ";
        // line 411
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "details", [], "any", false, false, false, 411));
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
            // line 412
            echo "    <cac:InvoiceLine>
        <cbc:ID>";
            // line 413
            echo twig_get_attribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 413);
            echo "</cbc:ID>
        <cbc:InvoicedQuantity unitCode=\"";
            // line 414
            echo twig_get_attribute($this->env, $this->source, $context["detail"], "unidad", [], "any", false, false, false, 414);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["detail"], "cantidad", [], "any", false, false, false, 414);
            echo "</cbc:InvoicedQuantity>
        <cbc:LineExtensionAmount currencyID=\"";
            // line 415
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 415);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["detail"], "mtoValorVenta", [], "any", false, false, false, 415)]);
            echo "</cbc:LineExtensionAmount>
        <cac:PricingReference>
            ";
            // line 417
            if (twig_get_attribute($this->env, $this->source, $context["detail"], "mtoValorGratuito", [], "any", false, false, false, 417)) {
                // line 418
                echo "            <cac:AlternativeConditionPrice>
                <cbc:PriceAmount currencyID=\"";
                // line 419
                echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 419);
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format_limit')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["detail"], "mtoValorGratuito", [], "any", false, false, false, 419), 10]);
                echo "</cbc:PriceAmount>
                <cbc:PriceTypeCode>02</cbc:PriceTypeCode>
            </cac:AlternativeConditionPrice>
            ";
            } else {
                // line 423
                echo "            <cac:AlternativeConditionPrice>
                <cbc:PriceAmount currencyID=\"";
                // line 424
                echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 424);
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format_limit')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["detail"], "mtoPrecioUnitario", [], "any", false, false, false, 424), 10]);
                echo "</cbc:PriceAmount>
                <cbc:PriceTypeCode>01</cbc:PriceTypeCode>
            </cac:AlternativeConditionPrice>
            ";
            }
            // line 428
            echo "        </cac:PricingReference>
        ";
            // line 429
            if (twig_get_attribute($this->env, $this->source, $context["detail"], "cargos", [], "any", false, false, false, 429)) {
                // line 430
                echo "        ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["detail"], "cargos", [], "any", false, false, false, 430));
                foreach ($context['_seq'] as $context["_key"] => $context["cargo"]) {
                    // line 431
                    echo "        <cac:AllowanceCharge>
            <cbc:ChargeIndicator>true</cbc:ChargeIndicator>
            <cbc:AllowanceChargeReasonCode>";
                    // line 433
                    echo twig_get_attribute($this->env, $this->source, $context["cargo"], "codTipo", [], "any", false, false, false, 433);
                    echo "</cbc:AllowanceChargeReasonCode>
            <cbc:MultiplierFactorNumeric>";
                    // line 434
                    echo twig_get_attribute($this->env, $this->source, $context["cargo"], "factor", [], "any", false, false, false, 434);
                    echo "</cbc:MultiplierFactorNumeric>
            <cbc:Amount currencyID=\"";
                    // line 435
                    echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 435);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["cargo"], "monto", [], "any", false, false, false, 435);
                    echo "</cbc:Amount>
            <cbc:BaseAmount currencyID=\"";
                    // line 436
                    echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 436);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["cargo"], "montoBase", [], "any", false, false, false, 436);
                    echo "</cbc:BaseAmount>
        </cac:AllowanceCharge>
        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['cargo'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 439
                echo "        ";
            }
            // line 440
            echo "        ";
            if (twig_get_attribute($this->env, $this->source, $context["detail"], "descuentos", [], "any", false, false, false, 440)) {
                // line 441
                echo "        ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["detail"], "descuentos", [], "any", false, false, false, 441));
                foreach ($context['_seq'] as $context["_key"] => $context["desc"]) {
                    // line 442
                    echo "        <cac:AllowanceCharge>
            <cbc:ChargeIndicator>false</cbc:ChargeIndicator>
            <cbc:AllowanceChargeReasonCode>";
                    // line 444
                    echo twig_get_attribute($this->env, $this->source, $context["desc"], "codTipo", [], "any", false, false, false, 444);
                    echo "</cbc:AllowanceChargeReasonCode>
            <cbc:MultiplierFactorNumeric>";
                    // line 445
                    echo twig_get_attribute($this->env, $this->source, $context["desc"], "factor", [], "any", false, false, false, 445);
                    echo "</cbc:MultiplierFactorNumeric>
            <cbc:Amount currencyID=\"";
                    // line 446
                    echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 446);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["desc"], "monto", [], "any", false, false, false, 446);
                    echo "</cbc:Amount>
            <cbc:BaseAmount currencyID=\"";
                    // line 447
                    echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 447);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["desc"], "montoBase", [], "any", false, false, false, 447);
                    echo "</cbc:BaseAmount>
        </cac:AllowanceCharge>
        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['desc'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 450
                echo "        ";
            }
            // line 451
            echo "        <cac:TaxTotal>
            <cbc:TaxAmount currencyID=\"";
            // line 452
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 452);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["detail"], "totalImpuestos", [], "any", false, false, false, 452)]);
            echo "</cbc:TaxAmount>
            ";
            // line 453
            if (twig_get_attribute($this->env, $this->source, $context["detail"], "isc", [], "any", false, false, false, 453)) {
                // line 454
                echo "            <cac:TaxSubtotal>
                <cbc:TaxableAmount currencyID=\"";
                // line 455
                echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 455);
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["detail"], "mtoBaseIsc", [], "any", false, false, false, 455)]);
                echo "</cbc:TaxableAmount>
                <cbc:TaxAmount currencyID=\"";
                // line 456
                echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 456);
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["detail"], "isc", [], "any", false, false, false, 456)]);
                echo "</cbc:TaxAmount>
                <cac:TaxCategory>
                    <cbc:Percent>";
                // line 458
                echo twig_get_attribute($this->env, $this->source, $context["detail"], "porcentajeIsc", [], "any", false, false, false, 458);
                echo "</cbc:Percent>
                    <cbc:TierRange>";
                // line 459
                echo twig_get_attribute($this->env, $this->source, $context["detail"], "tipSisIsc", [], "any", false, false, false, 459);
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
            // line 468
            echo "            <cac:TaxSubtotal>
                <cbc:TaxableAmount currencyID=\"";
            // line 469
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 469);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["detail"], "mtoBaseIgv", [], "any", false, false, false, 469)]);
            echo "</cbc:TaxableAmount>
                <cbc:TaxAmount currencyID=\"";
            // line 470
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 470);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["detail"], "igv", [], "any", false, false, false, 470)]);
            echo "</cbc:TaxAmount>
                <cac:TaxCategory>
                    <cbc:Percent>";
            // line 472
            echo twig_get_attribute($this->env, $this->source, $context["detail"], "porcentajeIgv", [], "any", false, false, false, 472);
            echo "</cbc:Percent>
                    <cbc:TaxExemptionReasonCode>";
            // line 473
            echo twig_get_attribute($this->env, $this->source, $context["detail"], "tipAfeIgv", [], "any", false, false, false, 473);
            echo "</cbc:TaxExemptionReasonCode>
                    ";
            // line 474
            $context["afect"] = Greenter\Xml\Filter\TributoFunction::getByAfectacion(twig_get_attribute($this->env, $this->source, $context["detail"], "tipAfeIgv", [], "any", false, false, false, 474));
            // line 475
            echo "                    <cac:TaxScheme>
                        <cbc:ID>";
            // line 476
            echo twig_get_attribute($this->env, $this->source, ($context["afect"] ?? null), "id", [], "any", false, false, false, 476);
            echo "</cbc:ID>
                        <cbc:Name>";
            // line 477
            echo twig_get_attribute($this->env, $this->source, ($context["afect"] ?? null), "name", [], "any", false, false, false, 477);
            echo "</cbc:Name>
                        <cbc:TaxTypeCode>";
            // line 478
            echo twig_get_attribute($this->env, $this->source, ($context["afect"] ?? null), "code", [], "any", false, false, false, 478);
            echo "</cbc:TaxTypeCode>
                    </cac:TaxScheme>
                </cac:TaxCategory>
            </cac:TaxSubtotal>
            ";
            // line 482
            if (twig_get_attribute($this->env, $this->source, $context["detail"], "otroTributo", [], "any", false, false, false, 482)) {
                // line 483
                echo "                <cac:TaxSubtotal>
                    <cbc:TaxableAmount currencyID=\"";
                // line 484
                echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 484);
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["detail"], "mtoBaseOth", [], "any", false, false, false, 484)]);
                echo "</cbc:TaxableAmount>
                    <cbc:TaxAmount currencyID=\"";
                // line 485
                echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 485);
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["detail"], "otroTributo", [], "any", false, false, false, 485)]);
                echo "</cbc:TaxAmount>
                    <cac:TaxCategory>
                        <cbc:Percent>";
                // line 487
                echo twig_get_attribute($this->env, $this->source, $context["detail"], "porcentajeOth", [], "any", false, false, false, 487);
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
            // line 496
            echo "            ";
            if (twig_get_attribute($this->env, $this->source, $context["detail"], "icbper", [], "any", false, false, false, 496)) {
                // line 497
                echo "            <cac:TaxSubtotal>
                <cbc:TaxAmount currencyID=\"";
                // line 498
                echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 498);
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["detail"], "icbper", [], "any", false, false, false, 498)]);
                echo "</cbc:TaxAmount>
                <cbc:BaseUnitMeasure unitCode=\"";
                // line 499
                echo twig_get_attribute($this->env, $this->source, $context["detail"], "unidad", [], "any", false, false, false, 499);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["detail"], "cantidad", [], "any", false, false, false, 499);
                echo "</cbc:BaseUnitMeasure>
                <cac:TaxCategory>
                    <cbc:PerUnitAmount currencyID=\"";
                // line 501
                echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 501);
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["detail"], "factorIcbper", [], "any", false, false, false, 501)]);
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
            // line 510
            echo "        </cac:TaxTotal>
        <cac:Item>
            <cbc:Description><![CDATA[";
            // line 512
            echo twig_get_attribute($this->env, $this->source, $context["detail"], "descripcion", [], "any", false, false, false, 512);
            echo "]]></cbc:Description>
            ";
            // line 513
            if (twig_get_attribute($this->env, $this->source, $context["detail"], "codProducto", [], "any", false, false, false, 513)) {
                // line 514
                echo "            <cac:SellersItemIdentification>
                <cbc:ID>";
                // line 515
                echo twig_get_attribute($this->env, $this->source, $context["detail"], "codProducto", [], "any", false, false, false, 515);
                echo "</cbc:ID>
            </cac:SellersItemIdentification>
            ";
            }
            // line 518
            echo "            ";
            if (twig_get_attribute($this->env, $this->source, $context["detail"], "codProdGS1", [], "any", false, false, false, 518)) {
                // line 519
                echo "            <cac:StandardItemIdentification>
                <cbc:ID>";
                // line 520
                echo twig_get_attribute($this->env, $this->source, $context["detail"], "codProdGS1", [], "any", false, false, false, 520);
                echo "</cbc:ID>
            </cac:StandardItemIdentification>
            ";
            }
            // line 523
            echo "            ";
            if (twig_get_attribute($this->env, $this->source, $context["detail"], "codProdSunat", [], "any", false, false, false, 523)) {
                // line 524
                echo "            <cac:CommodityClassification>
                <cbc:ItemClassificationCode>";
                // line 525
                echo twig_get_attribute($this->env, $this->source, $context["detail"], "codProdSunat", [], "any", false, false, false, 525);
                echo "</cbc:ItemClassificationCode>
            </cac:CommodityClassification>
            ";
            }
            // line 528
            echo "            ";
            if (twig_get_attribute($this->env, $this->source, $context["detail"], "atributos", [], "any", false, false, false, 528)) {
                // line 529
                echo "                ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["detail"], "atributos", [], "any", false, false, false, 529));
                foreach ($context['_seq'] as $context["_key"] => $context["atr"]) {
                    // line 530
                    echo "                    <cac:AdditionalItemProperty >
                        <cbc:Name>";
                    // line 531
                    echo twig_get_attribute($this->env, $this->source, $context["atr"], "name", [], "any", false, false, false, 531);
                    echo "</cbc:Name>
                        <cbc:NameCode>";
                    // line 532
                    echo twig_get_attribute($this->env, $this->source, $context["atr"], "code", [], "any", false, false, false, 532);
                    echo "</cbc:NameCode>
                        ";
                    // line 533
                    if (twig_get_attribute($this->env, $this->source, $context["atr"], "value", [], "any", false, false, false, 533)) {
                        // line 534
                        echo "                        <cbc:Value>";
                        echo twig_get_attribute($this->env, $this->source, $context["atr"], "value", [], "any", false, false, false, 534);
                        echo "</cbc:Value>
                        ";
                    }
                    // line 536
                    echo "                        ";
                    if (((twig_get_attribute($this->env, $this->source, $context["atr"], "fecInicio", [], "any", false, false, false, 536) || twig_get_attribute($this->env, $this->source, $context["atr"], "fecFin", [], "any", false, false, false, 536)) || twig_get_attribute($this->env, $this->source, $context["atr"], "duracion", [], "any", false, false, false, 536))) {
                        // line 537
                        echo "                            <cac:UsabilityPeriod>
                                ";
                        // line 538
                        if (twig_get_attribute($this->env, $this->source, $context["atr"], "fecInicio", [], "any", false, false, false, 538)) {
                            // line 539
                            echo "                                <cbc:StartDate>";
                            echo twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["atr"], "fecInicio", [], "any", false, false, false, 539), "Y-m-d");
                            echo "</cbc:StartDate>
                                ";
                        }
                        // line 541
                        echo "                                ";
                        if (twig_get_attribute($this->env, $this->source, $context["atr"], "fecFin", [], "any", false, false, false, 541)) {
                            // line 542
                            echo "                                <cbc:EndDate>";
                            echo twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["atr"], "fecFin", [], "any", false, false, false, 542), "Y-m-d");
                            echo "</cbc:EndDate>
                                ";
                        }
                        // line 544
                        echo "                                ";
                        if (twig_get_attribute($this->env, $this->source, $context["atr"], "duracion", [], "any", false, false, false, 544)) {
                            // line 545
                            echo "                                <cbc:DurationMeasure unitCode=\"DAY\">";
                            echo twig_get_attribute($this->env, $this->source, $context["atr"], "duracion", [], "any", false, false, false, 545);
                            echo "</cbc:DurationMeasure>
                                ";
                        }
                        // line 547
                        echo "                            </cac:UsabilityPeriod>
                        ";
                    }
                    // line 549
                    echo "                    </cac:AdditionalItemProperty>
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['atr'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 551
                echo "            ";
            }
            // line 552
            echo "        </cac:Item>
        <cac:Price>
            <cbc:PriceAmount currencyID=\"";
            // line 554
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "tipoMoneda", [], "any", false, false, false, 554);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format_limit')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["detail"], "mtoValorUnitario", [], "any", false, false, false, 554), 10]);
            echo "</cbc:PriceAmount>
        </cac:Price>
    </cac:InvoiceLine>
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
        // line 558
        echo "</Invoice>
";
        $___internal_1206a2b10878cd5e5cc725a1c446fa6ceb45cb77653f5ad842e4112660076b5d_ = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 1
        echo twig_spaceless($___internal_1206a2b10878cd5e5cc725a1c446fa6ceb45cb77653f5ad842e4112660076b5d_);
    }

    public function getTemplateName()
    {
        return "invoice2.1.xml.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1543 => 1,  1539 => 558,  1519 => 554,  1515 => 552,  1512 => 551,  1505 => 549,  1501 => 547,  1495 => 545,  1492 => 544,  1486 => 542,  1483 => 541,  1477 => 539,  1475 => 538,  1472 => 537,  1469 => 536,  1463 => 534,  1461 => 533,  1457 => 532,  1453 => 531,  1450 => 530,  1445 => 529,  1442 => 528,  1436 => 525,  1433 => 524,  1430 => 523,  1424 => 520,  1421 => 519,  1418 => 518,  1412 => 515,  1409 => 514,  1407 => 513,  1403 => 512,  1399 => 510,  1385 => 501,  1378 => 499,  1372 => 498,  1369 => 497,  1366 => 496,  1354 => 487,  1347 => 485,  1341 => 484,  1338 => 483,  1336 => 482,  1329 => 478,  1325 => 477,  1321 => 476,  1318 => 475,  1316 => 474,  1312 => 473,  1308 => 472,  1301 => 470,  1295 => 469,  1292 => 468,  1280 => 459,  1276 => 458,  1269 => 456,  1263 => 455,  1260 => 454,  1258 => 453,  1252 => 452,  1249 => 451,  1246 => 450,  1235 => 447,  1229 => 446,  1225 => 445,  1221 => 444,  1217 => 442,  1212 => 441,  1209 => 440,  1206 => 439,  1195 => 436,  1189 => 435,  1185 => 434,  1181 => 433,  1177 => 431,  1172 => 430,  1170 => 429,  1167 => 428,  1158 => 424,  1155 => 423,  1146 => 419,  1143 => 418,  1141 => 417,  1134 => 415,  1128 => 414,  1124 => 413,  1121 => 412,  1104 => 411,  1096 => 409,  1088 => 407,  1085 => 406,  1077 => 404,  1074 => 403,  1066 => 401,  1063 => 400,  1055 => 398,  1052 => 397,  1044 => 395,  1042 => 394,  1036 => 393,  1032 => 391,  1017 => 381,  1014 => 380,  1011 => 379,  996 => 369,  990 => 368,  987 => 367,  984 => 366,  969 => 356,  963 => 355,  960 => 354,  957 => 353,  944 => 343,  938 => 342,  935 => 341,  932 => 340,  917 => 330,  911 => 329,  908 => 328,  905 => 327,  892 => 317,  886 => 316,  883 => 315,  880 => 314,  867 => 304,  861 => 303,  858 => 302,  855 => 301,  840 => 291,  834 => 290,  831 => 289,  828 => 288,  813 => 278,  807 => 277,  804 => 276,  802 => 275,  796 => 274,  793 => 273,  787 => 270,  783 => 269,  779 => 268,  775 => 267,  771 => 265,  768 => 264,  765 => 263,  762 => 262,  751 => 259,  745 => 258,  741 => 257,  737 => 256,  733 => 254,  728 => 253,  725 => 252,  722 => 251,  711 => 248,  705 => 247,  701 => 246,  697 => 245,  693 => 243,  688 => 242,  685 => 241,  682 => 240,  663 => 237,  659 => 236,  656 => 235,  638 => 234,  635 => 233,  629 => 230,  625 => 228,  622 => 227,  616 => 224,  612 => 223,  608 => 222,  600 => 217,  595 => 215,  591 => 213,  588 => 212,  585 => 211,  576 => 205,  570 => 202,  565 => 200,  561 => 199,  556 => 198,  550 => 196,  548 => 195,  544 => 194,  539 => 191,  536 => 190,  533 => 189,  528 => 186,  524 => 184,  518 => 182,  515 => 181,  509 => 179,  507 => 178,  504 => 177,  502 => 176,  499 => 175,  492 => 171,  486 => 168,  483 => 167,  477 => 165,  475 => 164,  472 => 163,  469 => 162,  467 => 161,  463 => 160,  455 => 157,  450 => 154,  447 => 153,  445 => 152,  441 => 150,  437 => 148,  431 => 146,  428 => 145,  422 => 143,  420 => 142,  417 => 141,  415 => 140,  412 => 139,  405 => 135,  399 => 132,  396 => 131,  390 => 129,  388 => 128,  385 => 127,  382 => 126,  380 => 125,  376 => 124,  368 => 121,  363 => 118,  361 => 117,  357 => 115,  353 => 113,  347 => 111,  344 => 110,  338 => 108,  336 => 107,  333 => 106,  331 => 105,  324 => 101,  318 => 98,  313 => 96,  309 => 95,  304 => 94,  298 => 92,  296 => 91,  292 => 90,  288 => 89,  285 => 88,  283 => 87,  279 => 86,  273 => 83,  267 => 80,  252 => 68,  246 => 65,  240 => 62,  237 => 61,  234 => 60,  215 => 55,  209 => 52,  205 => 51,  201 => 50,  198 => 49,  180 => 48,  177 => 47,  174 => 46,  165 => 43,  161 => 42,  158 => 41,  153 => 40,  150 => 39,  147 => 38,  138 => 35,  134 => 34,  131 => 33,  126 => 32,  123 => 31,  117 => 28,  114 => 27,  112 => 26,  107 => 25,  101 => 23,  98 => 22,  87 => 20,  83 => 19,  76 => 18,  70 => 16,  68 => 15,  64 => 14,  60 => 13,  54 => 12,  50 => 10,  48 => 9,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "invoice2.1.xml.twig", "C:\\xampp\\htdocs\\WebServicePHPSn\\app\\vendor\\greenter\\xml\\src\\Xml\\Templates\\invoice2.1.xml.twig");
    }
}
