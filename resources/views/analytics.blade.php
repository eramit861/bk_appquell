<?php  if (in_array(Route::currentRouteName(), ['home','homesp','login','register','client_login','about','resources','pricing'])) {  ?>
<!-- Global WebSite Schema -->
<script type="application/ld+json">
@verbatim
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "@id": "https://www.bkquestionnaire.com/#website",
  "name": "BK Questionnaire",
  "alternateName": "bkquestionnaire",
  "url": "https://www.bkquestionnaire.com/",
  "description": "Professional bankruptcy questionnaire software for attorneys and law firms",
  "publisher": { "@id": "https://www.bkquestionnaire.com/#organization" },
  "inLanguage": ["en", "es"],
  "potentialAction": {
    "@type": "ReadAction",
    "target": "https://www.bkquestionnaire.com/"
  }
}
@endverbatim
</script>

<!-- Google tag (gtag.js) 
<script async src="https://www.googletagmanager.com/gtag/js?id=G-YXBJ1QWLG8">@endverbatim
</script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-YXBJ1QWLG8');
@endverbatim
</script>-->
<?php  if (in_array(Route::currentRouteName(), ['home'])) {?>
<script type="application/ld+json">
@verbatim
@verbatim
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "@id": "https://www.bkquestionnaire.com/#organization",
  "name": "BK Questionnaire",
  "alternateName": "bkquestionnaire",
  "url": "https://www.bkquestionnaire.com/",
  "logo": {
    "@type": "ImageObject",
    "url": "https://www.bkquestionnaire.com/assets/images/logo.png",
    "width": 200,
    "height": 60
  },
  "description": "Professional bankruptcy questionnaire software for attorneys and law firms",
  "foundingDate": "2020",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "1901 E 4th Street #310",
    "addressLocality": "Santa Ana",
    "addressRegion": "CA",
    "postalCode": "92705",
    "addressCountry": "US"
  },
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+1-888-356-5777",
    "contactType": "customer service",
    "availableLanguage": ["English", "Spanish"]
  }
}
@endverbatim
@endverbatim
</script>
<?php } ?>

<?php  if (in_array(Route::currentRouteName(), ['pricing'])) {?>
<script type="application/ld+json">
@verbatim
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "@id": "https://www.bkquestionnaire.com/pricing#webpage",
  "url": "https://www.bkquestionnaire.com/pricing",
  "name": "Pricing Plans - BK Questionnaire",
  "description": "Professional bankruptcy questionnaire software pricing plans for attorneys and law firms",
  "isPartOf": { "@id": "https://www.bkquestionnaire.com/#website" },
  "breadcrumb": {
    "@type": "BreadcrumbList",
    "itemListElement": [
      {
        "@type": "ListItem",
        "position": 1,
        "name": "Home",
        "item": "https://www.bkquestionnaire.com/"
      },
      {
        "@type": "ListItem",
        "position": 2,
        "name": "Pricing"
      }
    ]
  }
}
@endverbatim
</script>

<script type="application/ld+json">
@verbatim
{
  "@context": "https://schema.org",
  "@type": "ItemList",
  "@id": "https://www.bkquestionnaire.com/pricing#plans",
  "name": "BK Questionnaire Pricing Plans",
  "description": "Professional bankruptcy questionnaire software plans for attorneys and law firms",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "item": {
        "@type": "Product",
        "name": "Standard Plan",
        "brand": { 
          "@type": "Brand", 
          "name": "BK Questionnaire",
          "@id": "https://www.bkquestionnaire.com/#organization"
        },
        "description": "Interactive Web & App Based Questionnaire with full client features, automated document collection, and built-in follow-up system",
        "category": "Software Service",
        "offers": {
          "@type": "Offer",
          "priceCurrency": "USD",
          "price": "39.99",
          "priceValidUntil": "2025-12-31",
          "url": "https://www.bkquestionnaire.com/pricing",
          "availability": "https://schema.org/InStock",
          "seller": { "@id": "https://www.bkquestionnaire.com/#organization" }
        }
      }
    },
    {
      "@type": "ListItem",
      "position": 2,
      "item": {
        "@type": "Product",
        "name": "Standard Plus Plan",
        "brand": { 
          "@type": "Brand", 
          "name": "BK Questionnaire",
          "@id": "https://www.bkquestionnaire.com/#organization"
        },
        "description": "All Standard features plus included credit reports",
        "category": "Software Service",
        "offers": {
          "@type": "Offer",
          "priceCurrency": "USD",
          "price": "55.98",
          "priceValidUntil": "2025-12-31",
          "url": "https://www.bkquestionnaire.com/pricing",
          "availability": "https://schema.org/InStock",
          "seller": { "@id": "https://www.bkquestionnaire.com/#organization" }
        }
      }
    },
    {
      "@type": "ListItem",
      "position": 3,
      "item": {
        "@type": "Product",
        "name": "Premium Plan",
        "brand": { 
          "@type": "Brand", 
          "name": "BK Questionnaire",
          "@id": "https://www.bkquestionnaire.com/#organization"
        },
        "description": "All Standard features plus concierge service, 3-year storage, and payroll assistant discount",
        "category": "Software Service",
        "offers": {
          "@type": "Offer",
          "priceCurrency": "USD",
          "price": "89.99",
          "priceValidUntil": "2025-12-31",
          "url": "https://www.bkquestionnaire.com/pricing",
          "availability": "https://schema.org/InStock",
          "seller": { "@id": "https://www.bkquestionnaire.com/#organization" }
        }
      }
    },
    {
      "@type": "ListItem",
      "position": 4,
      "item": {
        "@type": "Product",
        "name": "Premium Plus Plan",
        "brand": { 
          "@type": "Brand", 
          "name": "BK Questionnaire",
          "@id": "https://www.bkquestionnaire.com/#organization"
        },
        "description": "All Standard and Premium features plus included credit reports",
        "category": "Software Service",
        "offers": {
          "@type": "Offer",
          "priceCurrency": "USD",
          "price": "105.98",
          "priceValidUntil": "2025-12-31",
          "url": "https://www.bkquestionnaire.com/pricing",
          "availability": "https://schema.org/InStock",
          "seller": { "@id": "https://www.bkquestionnaire.com/#organization" }
        }
      }
    },
    {
      "@type": "ListItem",
      "position": 5,
      "item": {
        "@type": "Product",
        "name": "Ultimate Plan",
        "brand": { 
          "@type": "Brand", 
          "name": "BK Questionnaire",
          "@id": "https://www.bkquestionnaire.com/#organization"
        },
        "description": "All Standard, Premium, and Premium Plus features plus included payroll assistant and bank statement features",
        "category": "Software Service",
        "offers": {
          "@type": "Offer",
          "priceCurrency": "USD",
          "price": "129.99",
          "priceValidUntil": "2025-12-31",
          "url": "https://www.bkquestionnaire.com/pricing",
          "availability": "https://schema.org/InStock",
          "seller": { "@id": "https://www.bkquestionnaire.com/#organization" }
        }
      }
    },
    {
      "@type": "ListItem",
      "position": 6,
      "item": {
        "@type": "Product",
        "name": "Ultimate Plus Plan",
        "brand": { 
          "@type": "Brand", 
          "name": "BK Questionnaire",
          "@id": "https://www.bkquestionnaire.com/#organization"
        },
        "description": "All features included - the complete bankruptcy questionnaire solution with credit reports",
        "category": "Software Service",
        "offers": {
          "@type": "Offer",
          "priceCurrency": "USD",
          "price": "145.98",
          "priceValidUntil": "2025-12-31",
          "url": "https://www.bkquestionnaire.com/pricing",
          "availability": "https://schema.org/InStock",
          "seller": { "@id": "https://www.bkquestionnaire.com/#organization" }
        }
      }
    }
  ]
}
@endverbatim
</script>
<?php } ?>
<?php  if (in_array(Route::currentRouteName(), ['login'])) {?>
<script type="application/ld+json">
@verbatim
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "@id": "https://www.bkquestionnaire.com/login#webpage",
  "url": "https://www.bkquestionnaire.com/login",
  "name": "Login - BK Questionnaire",
  "description": "Login to your BK Questionnaire account",
  "isPartOf": { "@id": "https://www.bkquestionnaire.com/#website" }
}
@endverbatim
</script>
<?php } ?>
<?php  if (in_array(Route::currentRouteName(), ['client_login'])) {?>
<script type="application/ld+json">
@verbatim
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "@id": "https://www.bkquestionnaire.com/client/login#webpage",
  "url": "https://www.bkquestionnaire.com/client/login",
  "name": "Client Login - BK Questionnaire",
  "description": "Client login portal for BK Questionnaire",
  "isPartOf": { "@id": "https://www.bkquestionnaire.com/#website" }
}
@endverbatim
</script>
<?php } ?>
<?php  if (in_array(Route::currentRouteName(), ['register'])) {?>
<script type="application/ld+json">
@verbatim
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "@id": "https://www.bkquestionnaire.com/register/ultimate#webpage",
  "url": "https://www.bkquestionnaire.com/register/ultimate",
  "name": "Register - BK Questionnaire",
  "description": "Register for BK Questionnaire software",
  "isPartOf": { "@id": "https://www.bkquestionnaire.com/#website" }
}
@endverbatim
</script>
<?php } ?>








<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-270710743-1">@endverbatim
</script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-270710743-1');
@endverbatim
</script>


<meta name="google-site-verification" content="mgOdcqig8LTWBDqbok8cEab0TiQ_jdmZLDqsLL5ZTlQ" />
<!--meta http-equiv="Content-Security-Policy" content="connect-src https://*.argyle.com; worker-src 'self' blob:" /-->
<?php } ?>