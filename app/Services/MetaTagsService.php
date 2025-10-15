<?php

namespace App\Services;

class MetaTagsService
{
    /**
     * Default meta tags for the application
     */
    private $defaults = [
        'title' => 'BK Assistant - Bankruptcy Case Management Software',
        'description' => 'Professional bankruptcy case management software for attorneys. Streamline client intake, document management, and case preparation with our comprehensive platform.',
        'keywords' => 'bankruptcy software, attorney software, case management, bankruptcy filing, legal software, bankruptcy questionnaire',
        'image' => '/assets/img/bkq_logo.png',
        'type' => 'website',
        'site_name' => 'BK Assistant'
    ];

    /**
     * Generate meta tags for a specific page
     */
    public function generateMetaTags($page = 'home', $data = [])
    {
        $meta = $this->getPageMeta($page, $data);

        return [
            'title' => $meta['title'],
            'description' => $meta['description'],
            'keywords' => $meta['keywords'],
            'canonical' => $meta['canonical'],
            'og' => $this->generateOpenGraphTags($meta),
            'twitter' => $this->generateTwitterCardTags($meta),
            'structured_data' => $this->generateStructuredData($page, $data)
        ];
    }

    /**
     * Get page-specific meta data
     * ALL VALUES PRESERVED FROM Helper::getTitleAndDescription()
     */
    private function getPageMeta($page, $data = [])
    {
        $baseUrl = config('app.url');

        $pages = [
            // Homepage - PRESERVED from Helper
            'home' => [
                'title' => 'Bankruptcy Software for Attorneys & Law Firms | Online Solutions',
                'description' => 'Explore top bankruptcy filing software for attorneys. Streamline processes with our online bankruptcy questionnaire, forms, and solutions for law firms.',
                'keywords' => 'Online Bankruptcy Attorney, Bankruptcy Filing Software, Bankruptcy Software for Attorneys, Bankruptcy Questionnaire, Bankruptcy Solutions, Bankruptcy Software, Bankruptcy Law Firm, Bankruptcy Forms',
                'canonical' => $baseUrl,
                'image' => $baseUrl . '/assets/img/bkq_logo.png'
            ],

            // Pricing - PRESERVED from Helper
            'pricing' => [
                'title' => 'Our Pricing Plans - BK Questionnaire',
                'description' => 'Check out our transparent pricing plans at BK Questionnaire, which offer comprehensive plans tailored to meet your needs and budget requirements.',
                'keywords' => 'bankruptcy software pricing, attorney software plans, legal software cost, bankruptcy case management pricing',
                'canonical' => $baseUrl . '/pricing',
                'image' => $baseUrl . '/assets/img/bkq_logo.png'
            ],

            // About - PRESERVED from Helper
            'about' => [
                'title' => 'BK Questionnaire - About Us',
                'description' => 'BK Questionnaire is a leading platform providing engaging and informative quizzes. Explore our website for exciting quizzes and test your knowledge today!',
                'keywords' => 'about BK Assistant, bankruptcy software company, legal technology, attorney solutions',
                'canonical' => $baseUrl . '/about-us',
                'image' => $baseUrl . '/assets/img/bkq_logo.png'
            ],

            // Benefits/Resources - PRESERVED from Helper
            'benefits' => [
                'title' => 'BK Questionnaire - Benefits',
                'description' => 'Explore our wide range of valuable benefits at BK Questionnaire. Find insightful articles, guides, and tools to enhance your knowledge and expertise in various domains.',
                'keywords' => 'bankruptcy software benefits, attorney efficiency, legal practice improvement, case management advantages',
                'canonical' => $baseUrl . '/benefits',
                'image' => $baseUrl . '/assets/img/bkq_logo.png'
            ],

            // Privacy
            'privacy' => [
                'title' => 'Privacy Policy - BK Assistant',
                'description' => 'Read our comprehensive privacy policy to understand how BK Assistant protects your data and maintains client confidentiality.',
                'keywords' => 'privacy policy, data protection, client confidentiality, legal software security',
                'canonical' => $baseUrl . '/privacy',
                'image' => $baseUrl . '/assets/img/bkq_logo.png'
            ],

            // Terms - PRESERVED from Helper
            'terms' => [
                'title' => 'Terms of Services | BK Assistant',
                'description' => 'BK Assistant - Terms of Services',
                'keywords' => 'terms of service, legal software terms, attorney software agreement',
                'canonical' => $baseUrl . '/terms-of-services',
                'image' => $baseUrl . '/assets/img/bkq_logo.png'
            ],

            // Login - PRESERVED from Helper
            'login' => [
                'title' => 'Secure Attorney Login - BK Questionnaire',
                'description' => 'Access your account or sign up for BK Questionnaire. Secure login for attorneys. Forgot password? Easily reset or create your account now.',
                'keywords' => 'attorney login, bankruptcy software login, secure access',
                'canonical' => $baseUrl . '/login',
                'image' => $baseUrl . '/assets/img/bkq_logo.png'
            ],

            // Client Login - PRESERVED from Helper
            'client_login' => [
                'title' => 'Client Login Portal - BK Questionnaire',
                'description' => 'Access your account securely with BK Assistant\'s client login portal. Forgot password? Contact us for technical support at 1-888-356-5777 or text (949) 994-4190.',
                'keywords' => 'client login, bankruptcy client portal, secure access',
                'canonical' => $baseUrl . '/client-login',
                'image' => $baseUrl . '/assets/img/bkq_logo.png'
            ],

            // Client Login Web - PRESERVED from Helper
            'client_login_web' => [
                'title' => 'Client Login Web Portal - BK Questionnaire',
                'description' => 'Access your account securely with BK Assistant\'s client login web portal. Forgot password? Contact us for technical support at 1-888-356-5777 or text (949) 994-4190.',
                'keywords' => 'client login web, bankruptcy client portal, secure access',
                'canonical' => $baseUrl . '/client-login?web=1',
                'image' => $baseUrl . '/assets/img/bkq_logo.png'
            ],

            // Password Reset - PRESERVED from Helper
            'password_request' => [
                'title' => 'Reset Password | BK Assistant',
                'description' => 'BK Assistant - Reset Password',
                'keywords' => 'password reset, forgot password, account recovery',
                'canonical' => $baseUrl . '/password/reset',
                'image' => $baseUrl . '/assets/img/bkq_logo.png'
            ],

            // Registration - Standard - PRESERVED from Helper
            'register_standard' => [
                'title' => 'Sign Up for Standard Plan - BK Assistant',
                'description' => 'Join BK Assistant\'s Standard platform to revolutionize your legal workflow. Sign up now to access exclusive bankruptcy management tools.',
                'keywords' => 'bankruptcy software signup, standard plan, attorney registration',
                'canonical' => $baseUrl . '/register?package_id=standard',
                'image' => $baseUrl . '/assets/img/bkq_logo.png'
            ],

            // Registration - Premium - PRESERVED from Helper
            'register_premium' => [
                'title' => 'Sign Up for Premium Plan - BK Assistant',
                'description' => 'Join BK Assistant\'s Premium platform to revolutionize your legal workflow. Sign up now to access exclusive bankruptcy management tools.',
                'keywords' => 'bankruptcy software signup, premium plan, attorney registration',
                'canonical' => $baseUrl . '/register?package_id=premium',
                'image' => $baseUrl . '/assets/img/bkq_logo.png'
            ],

            // Registration - Ultimate - PRESERVED from Helper
            'register_ultimate' => [
                'title' => 'Sign Up for Ultimate Plan - BK Assistant',
                'description' => 'Join BK Assistant\'s Ultimate platform to revolutionize your legal workflow. Sign up now to access exclusive bankruptcy management tools.',
                'keywords' => 'bankruptcy software signup, ultimate plan, attorney registration',
                'canonical' => $baseUrl . '/register?package_id=ultimate',
                'image' => $baseUrl . '/assets/img/bkq_logo.png'
            ],

            // Registration - Ultimate Plus - PRESERVED from Helper
            'register_ultimateplus' => [
                'title' => 'Sign Up for Ultimate Plus Plan - BK Assistant',
                'description' => 'Join BK Assistant\'s Ultimate Plus platform to revolutionize your legal workflow. Sign up now to access exclusive bankruptcy management tools.',
                'keywords' => 'bankruptcy software signup, ultimate plus plan, attorney registration',
                'canonical' => $baseUrl . '/register?package_id=ultimateplus',
                'image' => $baseUrl . '/assets/img/bkq_logo.png'
            ],

            // Registration - Premium Plus - PRESERVED from Helper
            'register_premiumplus' => [
                'title' => 'Sign Up for Premium Plus Plan - BK Assistant',
                'description' => 'Join BK Assistant\'s Premium Plus platform to revolutionize your legal workflow. Sign up now to access exclusive bankruptcy management tools.',
                'keywords' => 'bankruptcy software signup, premium plus plan, attorney registration',
                'canonical' => $baseUrl . '/register?package_id=premiumplus',
                'image' => $baseUrl . '/assets/img/bkq_logo.png'
            ],

            // Registration - Black Label - PRESERVED from Helper
            'register_black_label' => [
                'title' => 'Sign Up for Black Label Plan - BK Assistant',
                'description' => 'Join BK Assistant\'s Black Label platform to revolutionize your legal workflow. Sign up now to access exclusive bankruptcy management tools.',
                'keywords' => 'bankruptcy software signup, black label plan, attorney registration',
                'canonical' => $baseUrl . '/register?package_id=black_label',
                'image' => $baseUrl . '/assets/img/bkq_logo.png'
            ],

            // Registration - Basic Plus - PRESERVED from Helper
            'register_basic_plus' => [
                'title' => 'Sign Up for Standard Plus Plan - BK Assistant',
                'description' => 'Join BK Assistant\'s Standard Plus platform to revolutionize your legal workflow. Sign up now to access exclusive bankruptcy management tools.',
                'keywords' => 'bankruptcy software signup, standard plus plan, attorney registration',
                'canonical' => $baseUrl . '/register?package_id=basic_plus',
                'image' => $baseUrl . '/assets/img/bkq_logo.png'
            ],

            // Registration - Payroll Assistant - PRESERVED from Helper
            'register_payroll_assistant' => [
                'title' => 'Sign Up for Payroll Assistant Plan - BK Assistant',
                'description' => 'Join BK Assistant\'s Payroll Assistant platform to revolutionize your legal workflow. Sign up now to access exclusive bankruptcy management tools.',
                'keywords' => 'bankruptcy software signup, payroll assistant plan, attorney registration',
                'canonical' => $baseUrl . '/register?package_id=payroll_assistant',
                'image' => $baseUrl . '/assets/img/bkq_logo.png'
            ],

            // Registration - Default - PRESERVED from Helper
            'register_default' => [
                'title' => 'BK Questionnaire: Register for insightful surveys',
                'description' => 'Discover BK Questionnaire: Register now to gain valuable insights. Join our platform and unlock a world of knowledge and answers to your burning questions.',
                'keywords' => 'bankruptcy software signup, attorney registration, case management',
                'canonical' => $baseUrl . '/register',
                'image' => $baseUrl . '/assets/img/bkq_logo.png'
            ],

            // Video tutorials
            'video1' => [
                'title' => 'Video Tutorial 1 - BK Assistant Getting Started',
                'description' => 'Watch our first tutorial video to learn the basics of BK Assistant bankruptcy case management software.',
                'keywords' => 'BK Assistant tutorial, bankruptcy software tutorial, attorney software training',
                'canonical' => $baseUrl . '/video1',
                'image' => $baseUrl . '/assets/img/bkq_logo.png'
            ],

            'video2' => [
                'title' => 'Video Tutorial 2 - BK Assistant Advanced Features',
                'description' => 'Learn advanced features of BK Assistant in our second tutorial video. Master document management and client communication.',
                'keywords' => 'BK Assistant advanced tutorial, bankruptcy software features, attorney training',
                'canonical' => $baseUrl . '/video2',
                'image' => $baseUrl . '/assets/img/bkq_logo.png'
            ],

            'video3' => [
                'title' => 'Video Tutorial 3 - BK Assistant Document Management',
                'description' => 'Master document management with BK Assistant. Learn how to efficiently handle client documents and case files.',
                'keywords' => 'document management tutorial, bankruptcy document handling, case file management',
                'canonical' => $baseUrl . '/video3',
                'image' => $baseUrl . '/assets/img/bkq_logo.png'
            ],

            'video4' => [
                'title' => 'Video Tutorial 4 - BK Assistant Client Communication',
                'description' => 'Improve client communication with BK Assistant. Learn how to keep clients informed and engaged throughout their case.',
                'keywords' => 'client communication tutorial, attorney client management, legal communication',
                'canonical' => $baseUrl . '/video4',
                'image' => $baseUrl . '/assets/img/bkq_logo.png'
            ],

            'video5' => [
                'title' => 'Video Tutorial 5 - BK Assistant Case Preparation',
                'description' => 'Streamline case preparation with BK Assistant. Learn how to prepare bankruptcy cases efficiently and accurately.',
                'keywords' => 'case preparation tutorial, bankruptcy case management, legal case software',
                'canonical' => $baseUrl . '/video5',
                'image' => $baseUrl . '/assets/img/bkq_logo.png'
            ],

            // Spanish version
            'spanish' => [
                'title' => 'BK Assistant - Software de Gestión de Casos de Bancarrota',
                'description' => 'Optimice su práctica de bancarrota con nuestro software integral de gestión de casos. Maneje la admisión de clientes, gestión de documentos y preparación de casos de manera eficiente.',
                'keywords' => 'software de bancarrota, software para abogados, gestión de casos, presentación de bancarrota',
                'canonical' => $baseUrl . '/sp',
                'image' => $baseUrl . '/assets/img/bkq_logo.png'
            ]
        ];

        $pageMeta = $pages[$page] ?? $this->defaults;

        // Merge with provided data
        return array_merge($pageMeta, $data);
    }

    /**
     * Generate Open Graph meta tags
     */
    private function generateOpenGraphTags($meta)
    {
        return [
            'og:title' => $meta['title'],
            'og:description' => $meta['description'],
            'og:image' => $meta['image'],
            'og:url' => $meta['canonical'],
            'og:type' => $meta['type'] ?? 'website',
            'og:site_name' => $meta['site_name'] ?? 'BK Assistant',
            'og:locale' => 'en_US',
            'og:image:width' => '1200',
            'og:image:height' => '630',
            'og:image:alt' => $meta['title']
        ];
    }

    /**
     * Generate Twitter Card meta tags
     */
    private function generateTwitterCardTags($meta)
    {
        return [
            'twitter:card' => 'summary_large_image',
            'twitter:site' => '@BKAssistant',
            'twitter:creator' => '@BKAssistant',
            'twitter:title' => $meta['title'],
            'twitter:description' => $meta['description'],
            'twitter:image' => $meta['image'],
            'twitter:image:alt' => $meta['title']
        ];
    }

    /**
     * Generate structured data (JSON-LD)
     */
    private function generateStructuredData($page, $data = [])
    {
        $baseUrl = config('app.url');

        $structuredData = [
            '@context' => 'https://schema.org',
            '@type' => 'SoftwareApplication',
            'name' => 'BK Assistant',
            'description' => 'Professional bankruptcy case management software for attorneys',
            'url' => $baseUrl,
            'applicationCategory' => 'BusinessApplication',
            'operatingSystem' => 'Web Browser',
            'offers' => [
                '@type' => 'Offer',
                'priceCurrency' => 'USD',
                'availability' => 'https://schema.org/InStock'
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'BK Assistant',
                'url' => $baseUrl
            ]
        ];

        // Add page-specific structured data
        if ($page === 'home') {
            $structuredData['@type'] = 'WebSite';
            $structuredData['potentialAction'] = [
                '@type' => 'SearchAction',
                'target' => $baseUrl . '/search?q={search_term_string}',
                'query-input' => 'required name=search_term_string'
            ];
        }

        return $structuredData;
    }

    /**
     * Generate meta tags HTML
     */
    public function generateMetaTagsHtml($page = 'home', $data = [])
    {
        $meta = $this->generateMetaTags($page, $data);

        $html = '';

        // Basic meta tags
        $html .= '<title>' . htmlspecialchars($meta['title']) . '</title>' . "\n";
        $html .= '<meta name="description" content="' . htmlspecialchars($meta['description']) . '">' . "\n";

        // Only add keywords if not empty
        if (!empty($meta['keywords'])) {
            $html .= '<meta name="keywords" content="' . htmlspecialchars($meta['keywords']) . '">' . "\n";
        }

        $html .= '<link rel="canonical" href="' . htmlspecialchars($meta['canonical']) . '">' . "\n";

        // Open Graph tags
        foreach ($meta['og'] as $property => $content) {
            $html .= '<meta property="' . $property . '" content="' . htmlspecialchars($content) . '">' . "\n";
        }

        // Twitter Card tags
        foreach ($meta['twitter'] as $name => $content) {
            $html .= '<meta name="' . $name . '" content="' . htmlspecialchars($content) . '">' . "\n";
        }

        // Structured data
        $html .= '<script type="application/ld+json">' . "\n";
        $html .= json_encode($meta['structured_data'], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "\n";
        $html .= '</script>' . "\n";

        return $html;
    }

    /**
     * Get meta tags for specific routes
     * Handles ALL routes including dynamic ones
     */
    public function getMetaForRoute($routeName, $data = [])
    {
        // Handle registration routes with dynamic package_id
        if ($routeName === 'register') {
            $packageId = request()->get('package_id', '');

            $packageMap = [
                'standard' => 'register_standard',
                'premium' => 'register_premium',
                'ultimate' => 'register_ultimate',
                'ultimateplus' => 'register_ultimateplus',
                'premiumplus' => 'register_premiumplus',
                'black_label' => 'register_black_label',
                'basic_plus' => 'register_basic_plus',
                'payroll_assistant' => 'register_payroll_assistant',
            ];

            $page = $packageMap[$packageId] ?? 'register_default';

            return $this->generateMetaTags($page, $data);
        }

        // Handle client login with web parameter
        if ($routeName === 'client_login' && request()->has('web')) {
            return $this->generateMetaTags('client_login_web', $data);
        }

        // Handle password reset
        if ($routeName === 'password.request') {
            return $this->generateMetaTags('password_request', $data);
        }

        // Standard route mapping
        $routeMap = [
            'home' => 'home',
            'homesp' => 'spanish',
            'pricing' => 'pricing',
            'about' => 'about',
            'resources' => 'benefits',
            'privacy' => 'privacy',
            'terms_of_services' => 'terms',
            'login' => 'login',
            'client_login' => 'client_login',
            'video1' => 'video1',
            'video2' => 'video2',
            'video3' => 'video3',
            'video4' => 'video4',
            'video5' => 'video5'
        ];

        $page = $routeMap[$routeName] ?? 'home';

        return $this->generateMetaTags($page, $data);
    }

    /**
     * Backward compatibility method - replaces Helper::getTitleAndDescription()
     * Returns simplified array with just title, description, keywords
     */
    public function getTitleAndDescription()
    {
        $routeName = request()->route() ? request()->route()->getName() : 'home';
        $fullMeta = $this->getMetaForRoute($routeName);

        return [
            'title' => $fullMeta['title'],
            'description' => $fullMeta['description'],
            'keywords' => $fullMeta['keywords']
        ];
    }
}
