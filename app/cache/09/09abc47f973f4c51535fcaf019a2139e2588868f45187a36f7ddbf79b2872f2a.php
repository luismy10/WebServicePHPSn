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

/* summary.xml.twig */
class __TwigTemplate_b7186e1e7f967f2cd831f0f0b7ed965a2f5b91783b4309a2ed3e7b42ea0c9360 extends Template
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
<SummaryDocuments xmlns=\"urn:sunat:names:specification:ubl:peru:schema:xsd:SummaryDocuments-1\" xmlns:cac=\"urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2\" xmlns:cbc=\"urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2\" xmlns:ds=\"http://www.w3.org/2000/09/xmldsig#\" xmlns:ext=\"urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2\" xmlns:sac=\"urn:sunat:names:specification:ubl:peru:schema:xsd:SunatAggregateComponents-1\">
    <ext:UBLExtensions>
        <ext:UBLExtension>
            <ext:ExtensionContent/>
        </ext:UBLExtension>
    </ext:UBLExtensions>
    <cbc:UBLVersionID>2.0</cbc:UBLVersionID>
    <cbc:CustomizationID>1.1</cbc:CustomizationID>
    <cbc:ID>";
        // line 11
        echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "xmlId", [], "any", false, false, false, 11);
        echo "</cbc:ID>
    <cbc:ReferenceDate>";
        // line 12
        echo twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "fecGeneracion", [], "any", false, false, false, 12), "Y-m-d");
        echo "</cbc:ReferenceDate>
    <cbc:IssueDate>";
        // line 13
        echo twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "fecResumen", [], "any", false, false, false, 13), "Y-m-d");
        echo "</cbc:IssueDate>
    ";
        // line 14
        $context["emp"] = twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "company", [], "any", false, false, false, 14);
        // line 15
        echo "    <cac:Signature>
        <cbc:ID>";
        // line 16
        echo twig_get_attribute($this->env, $this->source, ($context["emp"] ?? null), "ruc", [], "any", false, false, false, 16);
        echo "</cbc:ID>
        <cac:SignatoryParty>
            <cac:PartyIdentification>
                <cbc:ID>";
        // line 19
        echo twig_get_attribute($this->env, $this->source, ($context["emp"] ?? null), "ruc", [], "any", false, false, false, 19);
        echo "</cbc:ID>
            </cac:PartyIdentification>
            <cac:PartyName>
                <cbc:Name><![CDATA[";
        // line 22
        echo twig_get_attribute($this->env, $this->source, ($context["emp"] ?? null), "razonSocial", [], "any", false, false, false, 22);
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
        <cbc:CustomerAssignedAccountID>";
        // line 32
        echo twig_get_attribute($this->env, $this->source, ($context["emp"] ?? null), "ruc", [], "any", false, false, false, 32);
        echo "</cbc:CustomerAssignedAccountID>
        <cbc:AdditionalAccountID>6</cbc:AdditionalAccountID>
        <cac:Party>
            <cac:PartyLegalEntity>
                <cbc:RegistrationName><![CDATA[";
        // line 36
        echo twig_get_attribute($this->env, $this->source, ($context["emp"] ?? null), "razonSocial", [], "any", false, false, false, 36);
        echo "]]></cbc:RegistrationName>
            </cac:PartyLegalEntity>
        </cac:Party>
    </cac:AccountingSupplierParty>
    ";
        // line 40
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "details", [], "any", false, false, false, 40));
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
        foreach ($context['_seq'] as $context["_key"] => $context["det"]) {
            // line 41
            echo "    <sac:SummaryDocumentsLine>
        <cbc:LineID>";
            // line 42
            echo twig_get_attribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 42);
            echo "</cbc:LineID>
        <cbc:DocumentTypeCode>";
            // line 43
            echo twig_get_attribute($this->env, $this->source, $context["det"], "tipoDoc", [], "any", false, false, false, 43);
            echo "</cbc:DocumentTypeCode>
        <cbc:ID>";
            // line 44
            echo twig_get_attribute($this->env, $this->source, $context["det"], "serieNro", [], "any", false, false, false, 44);
            echo "</cbc:ID>
        <cac:AccountingCustomerParty>
            <cbc:CustomerAssignedAccountID>";
            // line 46
            echo twig_get_attribute($this->env, $this->source, $context["det"], "clienteNro", [], "any", false, false, false, 46);
            echo "</cbc:CustomerAssignedAccountID>
            <cbc:AdditionalAccountID>";
            // line 47
            echo twig_get_attribute($this->env, $this->source, $context["det"], "clienteTipo", [], "any", false, false, false, 47);
            echo "</cbc:AdditionalAccountID>
        </cac:AccountingCustomerParty>
        ";
            // line 49
            if (twig_get_attribute($this->env, $this->source, $context["det"], "docReferencia", [], "any", false, false, false, 49)) {
                // line 50
                echo "        <cac:BillingReference>
            <cac:InvoiceDocumentReference>
                <cbc:ID>";
                // line 52
                echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["det"], "docReferencia", [], "any", false, false, false, 52), "nroDoc", [], "any", false, false, false, 52);
                echo "</cbc:ID>
                <cbc:DocumentTypeCode>";
                // line 53
                echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["det"], "docReferencia", [], "any", false, false, false, 53), "tipoDoc", [], "any", false, false, false, 53);
                echo "</cbc:DocumentTypeCode>
            </cac:InvoiceDocumentReference>
        </cac:BillingReference>
        ";
            }
            // line 57
            echo "        ";
            if (twig_get_attribute($this->env, $this->source, $context["det"], "percepcion", [], "any", false, false, false, 57)) {
                // line 58
                echo "        ";
                $context["perc"] = twig_get_attribute($this->env, $this->source, $context["det"], "percepcion", [], "any", false, false, false, 58);
                // line 59
                echo "        <sac:SUNATPerceptionSummaryDocumentReference>
            <sac:SUNATPerceptionSystemCode>";
                // line 60
                echo twig_get_attribute($this->env, $this->source, ($context["perc"] ?? null), "codReg", [], "any", false, false, false, 60);
                echo "</sac:SUNATPerceptionSystemCode>
            <sac:SUNATPerceptionPercent>";
                // line 61
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["perc"] ?? null), "tasa", [], "any", false, false, false, 61)]);
                echo "</sac:SUNATPerceptionPercent>
            <cbc:TotalInvoiceAmount currencyID=\"PEN\">";
                // line 62
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["perc"] ?? null), "mto", [], "any", false, false, false, 62)]);
                echo "</cbc:TotalInvoiceAmount>
            <sac:SUNATTotalCashed currencyID=\"PEN\">";
                // line 63
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["perc"] ?? null), "mtoTotal", [], "any", false, false, false, 63)]);
                echo "</sac:SUNATTotalCashed>
            <cbc:TaxableAmount currencyID=\"PEN\">";
                // line 64
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, ($context["perc"] ?? null), "mtoBase", [], "any", false, false, false, 64)]);
                echo "</cbc:TaxableAmount>
        </sac:SUNATPerceptionSummaryDocumentReference>
        ";
            }
            // line 67
            echo "        <cac:Status>
            <cbc:ConditionCode>";
            // line 68
            echo twig_get_attribute($this->env, $this->source, $context["det"], "estado", [], "any", false, false, false, 68);
            echo "</cbc:ConditionCode>
        </cac:Status>
        <sac:TotalAmount currencyID=\"";
            // line 70
            echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "moneda", [], "any", false, false, false, 70);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["det"], "total", [], "any", false, false, false, 70)]);
            echo "</sac:TotalAmount>
        ";
            // line 71
            if (twig_get_attribute($this->env, $this->source, $context["det"], "mtoOperGravadas", [], "any", false, false, false, 71)) {
                // line 72
                echo "        <sac:BillingPayment>
            <cbc:PaidAmount currencyID=\"";
                // line 73
                echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "moneda", [], "any", false, false, false, 73);
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["det"], "mtoOperGravadas", [], "any", false, false, false, 73)]);
                echo "</cbc:PaidAmount>
            <cbc:InstructionID>01</cbc:InstructionID>
        </sac:BillingPayment>
        ";
            }
            // line 77
            echo "        ";
            if (twig_get_attribute($this->env, $this->source, $context["det"], "mtoOperExoneradas", [], "any", false, false, false, 77)) {
                // line 78
                echo "        <sac:BillingPayment>
            <cbc:PaidAmount currencyID=\"";
                // line 79
                echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "moneda", [], "any", false, false, false, 79);
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["det"], "mtoOperExoneradas", [], "any", false, false, false, 79)]);
                echo "</cbc:PaidAmount>
            <cbc:InstructionID>02</cbc:InstructionID>
        </sac:BillingPayment>
        ";
            }
            // line 83
            echo "        ";
            if (twig_get_attribute($this->env, $this->source, $context["det"], "mtoOperInafectas", [], "any", false, false, false, 83)) {
                // line 84
                echo "        <sac:BillingPayment>
            <cbc:PaidAmount currencyID=\"";
                // line 85
                echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "moneda", [], "any", false, false, false, 85);
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["det"], "mtoOperInafectas", [], "any", false, false, false, 85)]);
                echo "</cbc:PaidAmount>
            <cbc:InstructionID>03</cbc:InstructionID>
        </sac:BillingPayment>
        ";
            }
            // line 89
            echo "        ";
            if (twig_get_attribute($this->env, $this->source, $context["det"], "mtoOperExportacion", [], "any", false, false, false, 89)) {
                // line 90
                echo "        <sac:BillingPayment>
            <cbc:PaidAmount currencyID=\"";
                // line 91
                echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "moneda", [], "any", false, false, false, 91);
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["det"], "mtoOperExportacion", [], "any", false, false, false, 91)]);
                echo "</cbc:PaidAmount>
            <cbc:InstructionID>04</cbc:InstructionID>
        </sac:BillingPayment>
        ";
            }
            // line 95
            echo "        ";
            if (twig_get_attribute($this->env, $this->source, $context["det"], "mtoOperGratuitas", [], "any", false, false, false, 95)) {
                // line 96
                echo "        <sac:BillingPayment>
            <cbc:PaidAmount currencyID=\"";
                // line 97
                echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "moneda", [], "any", false, false, false, 97);
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["det"], "mtoOperGratuitas", [], "any", false, false, false, 97)]);
                echo "</cbc:PaidAmount>
            <cbc:InstructionID>05</cbc:InstructionID>
        </sac:BillingPayment>
        ";
            }
            // line 101
            echo "        ";
            if (twig_get_attribute($this->env, $this->source, $context["det"], "mtoOtrosCargos", [], "any", false, false, false, 101)) {
                // line 102
                echo "        <cac:AllowanceCharge>
            <cbc:ChargeIndicator>true</cbc:ChargeIndicator>
            <cbc:Amount currencyID=\"";
                // line 104
                echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "moneda", [], "any", false, false, false, 104);
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["det"], "mtoOtrosCargos", [], "any", false, false, false, 104)]);
                echo "</cbc:Amount>
        </cac:AllowanceCharge>
        ";
            }
            // line 107
            echo "        ";
            if (twig_get_attribute($this->env, $this->source, $context["det"], "mtoIvap", [], "any", false, false, false, 107)) {
                // line 108
                echo "        ";
                $context["ivap"] = call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["det"], "mtoIvap", [], "any", false, false, false, 108)]);
                // line 109
                echo "        <cac:TaxTotal>
            <cbc:TaxAmount currencyID=\"";
                // line 110
                echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "moneda", [], "any", false, false, false, 110);
                echo "\">";
                echo ($context["ivap"] ?? null);
                echo "</cbc:TaxAmount>
            <cac:TaxSubtotal>
                <cbc:TaxAmount currencyID=\"";
                // line 112
                echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "moneda", [], "any", false, false, false, 112);
                echo "\">";
                echo ($context["ivap"] ?? null);
                echo "</cbc:TaxAmount>
                <cac:TaxCategory>
                    <cac:TaxScheme>
                        <cbc:ID>1016</cbc:ID>
                        <cbc:Name>IVAP</cbc:Name>
                        <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                    </cac:TaxScheme>
                </cac:TaxCategory>
            </cac:TaxSubtotal>
        </cac:TaxTotal>
        ";
            } else {
                // line 123
                echo "        ";
                $context["igv"] = call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["det"], "mtoIGV", [], "any", false, false, false, 123)]);
                // line 124
                echo "        <cac:TaxTotal>
            <cbc:TaxAmount currencyID=\"";
                // line 125
                echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "moneda", [], "any", false, false, false, 125);
                echo "\">";
                echo ($context["igv"] ?? null);
                echo "</cbc:TaxAmount>
            <cac:TaxSubtotal>
                <cbc:TaxAmount currencyID=\"";
                // line 127
                echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "moneda", [], "any", false, false, false, 127);
                echo "\">";
                echo ($context["igv"] ?? null);
                echo "</cbc:TaxAmount>
                <cac:TaxCategory>
                    <cac:TaxScheme>
                        <cbc:ID>1000</cbc:ID>
                        <cbc:Name>IGV</cbc:Name>
                        <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                    </cac:TaxScheme>
                </cac:TaxCategory>
            </cac:TaxSubtotal>
        </cac:TaxTotal>
        ";
            }
            // line 138
            echo "        ";
            if (twig_get_attribute($this->env, $this->source, $context["det"], "mtoISC", [], "any", false, false, false, 138)) {
                // line 139
                echo "        ";
                $context["isc"] = call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["det"], "mtoISC", [], "any", false, false, false, 139)]);
                // line 140
                echo "        <cac:TaxTotal>
            <cbc:TaxAmount currencyID=\"";
                // line 141
                echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "moneda", [], "any", false, false, false, 141);
                echo "\">";
                echo ($context["isc"] ?? null);
                echo "</cbc:TaxAmount>
            <cac:TaxSubtotal>
                <cbc:TaxAmount currencyID=\"";
                // line 143
                echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "moneda", [], "any", false, false, false, 143);
                echo "\">";
                echo ($context["isc"] ?? null);
                echo "</cbc:TaxAmount>
                <cac:TaxCategory>
                    <cac:TaxScheme>
                        <cbc:ID>2000</cbc:ID>
                        <cbc:Name>ISC</cbc:Name>
                        <cbc:TaxTypeCode>EXC</cbc:TaxTypeCode>
                    </cac:TaxScheme>
                </cac:TaxCategory>
            </cac:TaxSubtotal>
        </cac:TaxTotal>
        ";
            }
            // line 154
            echo "        ";
            if (twig_get_attribute($this->env, $this->source, $context["det"], "mtoOtrosTributos", [], "any", false, false, false, 154)) {
                // line 155
                echo "        ";
                $context["oth"] = call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["det"], "mtoOtrosTributos", [], "any", false, false, false, 155)]);
                // line 156
                echo "        <cac:TaxTotal>
            <cbc:TaxAmount currencyID=\"";
                // line 157
                echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "moneda", [], "any", false, false, false, 157);
                echo "\">";
                echo ($context["oth"] ?? null);
                echo "</cbc:TaxAmount>
            <cac:TaxSubtotal>
                <cbc:TaxAmount currencyID=\"";
                // line 159
                echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "moneda", [], "any", false, false, false, 159);
                echo "\">";
                echo ($context["oth"] ?? null);
                echo "</cbc:TaxAmount>
                <cac:TaxCategory>
                    <cac:TaxScheme>
                        <cbc:ID>9999</cbc:ID>
                        <cbc:Name>OTROS</cbc:Name>
                        <cbc:TaxTypeCode>OTH</cbc:TaxTypeCode>
                    </cac:TaxScheme>
                </cac:TaxCategory>
            </cac:TaxSubtotal>
        </cac:TaxTotal>
        ";
            }
            // line 170
            echo "        ";
            if (twig_get_attribute($this->env, $this->source, $context["det"], "mtoIcbper", [], "any", false, false, false, 170)) {
                // line 171
                echo "            ";
                $context["icbper"] = call_user_func_array($this->env->getFilter('n_format')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["det"], "mtoIcbper", [], "any", false, false, false, 171)]);
                // line 172
                echo "            <cac:TaxTotal>
                <cbc:TaxAmount currencyID=\"";
                // line 173
                echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "moneda", [], "any", false, false, false, 173);
                echo "\">";
                echo ($context["icbper"] ?? null);
                echo "</cbc:TaxAmount>
                <cac:TaxSubtotal>
                    <cbc:TaxAmount currencyID=\"";
                // line 175
                echo twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "moneda", [], "any", false, false, false, 175);
                echo "\">";
                echo ($context["icbper"] ?? null);
                echo "</cbc:TaxAmount>
                    <cac:TaxCategory>
                        <cac:TaxScheme>
                            <cbc:ID>7152</cbc:ID>
                            <cbc:Name>ICBPER</cbc:Name>
                            <cbc:TaxTypeCode>OTH</cbc:TaxTypeCode>
                        </cac:TaxScheme>
                    </cac:TaxCategory>
                </cac:TaxSubtotal>
            </cac:TaxTotal>
        ";
            }
            // line 186
            echo "    </sac:SummaryDocumentsLine>
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['det'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 188
        echo "</SummaryDocuments>
";
        $___internal_0c7b291035a40d9c3fea06d71217bcf73f9318e7c741bb5c1269bc6b059948f0_ = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 1
        echo twig_spaceless($___internal_0c7b291035a40d9c3fea06d71217bcf73f9318e7c741bb5c1269bc6b059948f0_);
    }

    public function getTemplateName()
    {
        return "summary.xml.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  475 => 1,  471 => 188,  456 => 186,  440 => 175,  433 => 173,  430 => 172,  427 => 171,  424 => 170,  408 => 159,  401 => 157,  398 => 156,  395 => 155,  392 => 154,  376 => 143,  369 => 141,  366 => 140,  363 => 139,  360 => 138,  344 => 127,  337 => 125,  334 => 124,  331 => 123,  315 => 112,  308 => 110,  305 => 109,  302 => 108,  299 => 107,  291 => 104,  287 => 102,  284 => 101,  275 => 97,  272 => 96,  269 => 95,  260 => 91,  257 => 90,  254 => 89,  245 => 85,  242 => 84,  239 => 83,  230 => 79,  227 => 78,  224 => 77,  215 => 73,  212 => 72,  210 => 71,  204 => 70,  199 => 68,  196 => 67,  190 => 64,  186 => 63,  182 => 62,  178 => 61,  174 => 60,  171 => 59,  168 => 58,  165 => 57,  158 => 53,  154 => 52,  150 => 50,  148 => 49,  143 => 47,  139 => 46,  134 => 44,  130 => 43,  126 => 42,  123 => 41,  106 => 40,  99 => 36,  92 => 32,  79 => 22,  73 => 19,  67 => 16,  64 => 15,  62 => 14,  58 => 13,  54 => 12,  50 => 11,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "summary.xml.twig", "C:\\xampp\\htdocs\\WebServicePHPSn\\app\\vendor\\greenter\\xml\\src\\Xml\\Templates\\summary.xml.twig");
    }
}
