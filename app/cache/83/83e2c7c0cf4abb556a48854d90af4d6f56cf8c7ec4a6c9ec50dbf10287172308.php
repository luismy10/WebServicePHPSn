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

/* voided.xml.twig */
class __TwigTemplate_9567fa28a68cd1693ad9606274e35cc5d92321193f94e1b3af221682a5f18111 extends Template
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
<VoidedDocuments xmlns=\"urn:sunat:names:specification:ubl:peru:schema:xsd:VoidedDocuments-1\" xmlns:cac=\"urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2\" xmlns:cbc=\"urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2\" xmlns:ext=\"urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2\" xmlns:sac=\"urn:sunat:names:specification:ubl:peru:schema:xsd:SunatAggregateComponents-1\" xmlns:ds=\"http://www.w3.org/2000/09/xmldsig#\">
    <ext:UBLExtensions>
        <ext:UBLExtension>
            <ext:ExtensionContent/>
        </ext:UBLExtension>
    </ext:UBLExtensions>
    <cbc:UBLVersionID>2.0</cbc:UBLVersionID>
    <cbc:CustomizationID>1.0</cbc:CustomizationID>
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
        echo twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["doc"] ?? null), "fecComunicacion", [], "any", false, false, false, 13), "Y-m-d");
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
            echo "    <sac:VoidedDocumentsLine>
        <cbc:LineID>";
            // line 42
            echo twig_get_attribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 42);
            echo "</cbc:LineID>
        <cbc:DocumentTypeCode>";
            // line 43
            echo twig_get_attribute($this->env, $this->source, $context["det"], "tipoDoc", [], "any", false, false, false, 43);
            echo "</cbc:DocumentTypeCode>
        <sac:DocumentSerialID>";
            // line 44
            echo twig_get_attribute($this->env, $this->source, $context["det"], "serie", [], "any", false, false, false, 44);
            echo "</sac:DocumentSerialID>
        <sac:DocumentNumberID>";
            // line 45
            echo twig_get_attribute($this->env, $this->source, $context["det"], "correlativo", [], "any", false, false, false, 45);
            echo "</sac:DocumentNumberID>
        <sac:VoidReasonDescription><![CDATA[";
            // line 46
            echo twig_get_attribute($this->env, $this->source, $context["det"], "desMotivoBaja", [], "any", false, false, false, 46);
            echo "]]></sac:VoidReasonDescription>
    </sac:VoidedDocumentsLine>
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
        // line 49
        echo "</VoidedDocuments>
";
        $___internal_42283855ac362291ed32dca6fd4d3c07605a471025a914d95aea76fed0c26776_ = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 1
        echo twig_spaceless($___internal_42283855ac362291ed32dca6fd4d3c07605a471025a914d95aea76fed0c26776_);
    }

    public function getTemplateName()
    {
        return "voided.xml.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  163 => 1,  159 => 49,  142 => 46,  138 => 45,  134 => 44,  130 => 43,  126 => 42,  123 => 41,  106 => 40,  99 => 36,  92 => 32,  79 => 22,  73 => 19,  67 => 16,  64 => 15,  62 => 14,  58 => 13,  54 => 12,  50 => 11,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "voided.xml.twig", "C:\\xampp\\htdocs\\WebServicePHPSn\\app\\vendor\\greenter\\xml\\src\\Xml\\Templates\\voided.xml.twig");
    }
}
