<?php

namespace App\Helpers;

/**
 * HTML Sanitization Helper
 * 
 * Provides simple HTML sanitization using strip_tags with allowed tags.
 * For production, consider using mews/purifier package for more robust sanitization.
 */
class HtmlSanitizer
{
    /**
     * List of allowed HTML tags for content areas
     */
    protected static array $allowedTags = [
        'p', 'br', 'strong', 'b', 'em', 'i', 'u', 'a', 'ul', 'ol', 'li',
        'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'blockquote', 'pre', 'code',
        'table', 'thead', 'tbody', 'tr', 'th', 'td', 'img', 'figure', 'figcaption',
        'div', 'span', 'hr'
    ];

    /**
     * Clean HTML content by removing dangerous elements and attributes
     *
     * @param string|null $html The raw HTML content
     * @return string Sanitized HTML
     */
    public static function clean(?string $html): string
    {
        if (empty($html)) {
            return '';
        }

        // Remove script tags and their content
        $html = preg_replace('/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/mi', '', $html);
        
        // Remove style tags and their content
        $html = preg_replace('/<style\b[^<]*(?:(?!<\/style>)<[^<]*)*<\/style>/mi', '', $html);
        
        // Remove iframe tags
        $html = preg_replace('/<iframe\b[^<]*(?:(?!<\/iframe>)<[^<]*)*<\/iframe>/mi', '', $html);
        
        // Remove object and embed tags
        $html = preg_replace('/<(object|embed)\b[^<]*(?:(?!<\/(object|embed)>)<[^<]*)*<\/(object|embed)>/mi', '', $html);
        
        // Remove on* event handlers (onclick, onerror, onload, etc.)
        $html = preg_replace('/\s*on\w+\s*=\s*["\'][^"\']*["\']|on\w+\s*=\s*[^\s>]+/i', '', $html);
        
        // Remove javascript: protocol
        $html = preg_replace('/javascript\s*:/i', '', $html);
        
        // Remove data: protocol from src attributes (can contain malicious content)
        $html = preg_replace('/\s*src\s*=\s*["\']data:[^"\']*["\']|src\s*=\s*data:[^\s>]+/i', '', $html);
        
        // Strip tags to allowed list
        $allowedTagsString = '<' . implode('><', self::$allowedTags) . '>';
        $html = strip_tags($html, $allowedTagsString);

        return $html;
    }

    /**
     * Clean HTML for rich text editor output (more permissive)
     *
     * @param string|null $html The raw HTML content
     * @return string Sanitized HTML
     */
    public static function cleanRichText(?string $html): string
    {
        return self::clean($html);
    }

    /**
     * Completely strip all HTML tags (plain text only)
     *
     * @param string|null $html The raw HTML content
     * @return string Plain text
     */
    public static function stripAll(?string $html): string
    {
        if (empty($html)) {
            return '';
        }
        
        return strip_tags($html);
    }

    /**
     * Clean map embed HTML (allows iframe for Google Maps, etc.)
     *
     * @param string|null $html The raw HTML content
     * @return string Sanitized HTML
     */
    public static function cleanMapEmbed(?string $html): string
    {
        if (empty($html)) {
            return '';
        }

        // Remove on* event handlers
        $html = preg_replace('/\s*on\w+\s*=\s*["\'][^"\']*["\']|on\w+\s*=\s*[^\s>]+/i', '', $html);
        
        // Remove javascript: protocol
        $html = preg_replace('/javascript\s*:/i', '', $html);

        // Only allow iframe tags for embeds
        return strip_tags($html, '<iframe>');
    }
}
