<?php

namespace Thepixeldeveloper\Sitemap;

use XMLWriter;

/**
 * Class Urlset
 *
 * @package Thepixeldeveloper\Sitemap
 */
class Urlset implements OutputInterface
{
    /**
     * Array of URL objects.
     *
     * @var OutputInterface[]
     */
    protected $urls = array();

    /**
     * Add a new URL object.
     *
     * @param OutputInterface $url
     *
     * @return $this
     */
    public function addUrl(OutputInterface $url)
    {
        $this->urls[] = $url;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function generateXML(XMLWriter $XMLWriter)
    {
        $XMLWriter->startElement('urlset');

        $XMLWriter->writeAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');

        $XMLWriter->writeAttribute('xsi:schemaLocation',
            'http://www.sitemaps.org/schemas/sitemap/0.9 ' .
            'http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd');

        $XMLWriter->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        foreach ($this->getUrls() as $url) {
            $url->generateXML($XMLWriter);
        }

        $XMLWriter->endElement();
    }

    /**
     * Get array of URL objects.
     *
     * @return OutputInterface[]
     */
    public function getUrls()
    {
        return $this->urls;
    }
}
