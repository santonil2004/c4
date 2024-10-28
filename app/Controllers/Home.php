<?php

namespace App\Controllers;

class Home extends BaseController
{
    /**
     * Required PHP extensions for Magento
     */
    private $requiredExtensions = [
        'bcmath' => 'Required for accurate calculations',
        'ctype' => 'Required for character type checking',
        'curl' => 'Required for making HTTP requests',
        'dom' => 'Required for XML handling',
        'fileinfo' => 'Required for MIME type detection',
        'gd' => 'Required for image processing',
        'iconv' => 'Required for character set conversion',
        'intl' => 'Required for internationalization',
        'json' => 'Required for JSON handling',
        'mbstring' => 'Required for multi-byte string handling',
        'openssl' => 'Required for secure connections',
        'pdo_mysql' => 'Required for MySQL database',
        'simplexml' => 'Required for XML processing',
        'soap' => 'Required for SOAP API',
        'sodium' => 'Required for encryption',
        'xsl' => 'Required for XSLT transformations',
        'zip' => 'Required for ZIP file handling',
        'libxml' => 'Required for XML processing',
        'spl' => 'Required for Standard PHP Library',
        'xmlwriter' => 'Required for XML generation',
    ];

    /**
     * Recommended PHP extensions for Magento
     */
    private $recommendedExtensions = [
        'opcache' => 'Recommended for better performance',
        'redis' => 'Recommended for caching',
        'imagick' => 'Recommended for better image processing',
    ];

    public function index()
    {
        $data = [
            'php_version' => $this->checkPHPVersion(),
            'required_extensions' => $this->checkRequiredExtensions(),
            'recommended_extensions' => $this->checkRecommendedExtensions(),
            'system_info' => $this->getSystemInfo(),
        ];

        return view('extension_check', $data);
    }

    /**
     * Check PHP version compatibility
     */
    private function checkPHPVersion(): array
    {
        $currentVersion = PHP_VERSION;
        $minimumVersion = '8.1';
        $recommendedVersion = '8.2';

        return [
            'current' => $currentVersion,
            'minimum' => $minimumVersion,
            'recommended' => $recommendedVersion,
            'status' => version_compare($currentVersion, $minimumVersion, '>='),
            'message' => version_compare($currentVersion, $minimumVersion, '>=') 
                ? 'PHP version is compatible' 
                : 'PHP version is not compatible'
        ];
    }

    /**
     * Check required extensions
     */
    private function checkRequiredExtensions(): array
    {
        $results = [];
        foreach ($this->requiredExtensions as $extension => $description) {
            $installed = extension_loaded($extension);
            $results[$extension] = [
                'installed' => $installed,
                'description' => $description,
                'version' => $installed ? phpversion($extension) : null,
                'status' => $installed ? 'OK' : 'Missing'
            ];
        }
        return $results;
    }

    /**
     * Check recommended extensions
     */
    private function checkRecommendedExtensions(): array
    {
        $results = [];
        foreach ($this->recommendedExtensions as $extension => $description) {
            $installed = extension_loaded($extension);
            $results[$extension] = [
                'installed' => $installed,
                'description' => $description,
                'version' => $installed ? phpversion($extension) : null,
                'status' => $installed ? 'OK' : 'Not installed'
            ];
        }
        return $results;
    }

    /**
     * Get system information
     */
    private function getSystemInfo(): array
    {
        return [
            'server_software' => $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown',
            'server_os' => PHP_OS,
            'server_architecture' => php_uname('m'),
            'memory_limit' => ini_get('memory_limit'),
            'max_execution_time' => ini_get('max_execution_time'),
            'upload_max_filesize' => ini_get('upload_max_filesize'),
            'post_max_size' => ini_get('post_max_size'),
        ];
    }

    /**
     * Log the results
     */
    private function logResults(array $data): void
    {
        // Log PHP version status
        if (!$data['php_version']['status']) {
            log_message('error', 'PHP version is not compatible. Current: ' . 
                $data['php_version']['current'] . ', Required: ' . 
                $data['php_version']['minimum']);
        }

        // Log missing required extensions
        foreach ($data['required_extensions'] as $extension => $info) {
            if (!$info['installed']) {
                log_message('error', "Required extension missing: {$extension}");
            }
        }

        // Log missing recommended extensions
        foreach ($data['recommended_extensions'] as $extension => $info) {
            if (!$info['installed']) {
                log_message('warning', "Recommended extension not installed: {$extension}");
            }
        }

        // Log overall status
        $missingRequired = array_filter($data['required_extensions'], 
            fn($info) => !$info['installed']);
        
        if (empty($missingRequired)) {
            log_message('info', 'All required PHP extensions are installed');
        } else {
            log_message('error', count($missingRequired) . 
                ' required PHP extensions are missing');
        }
    }
}
