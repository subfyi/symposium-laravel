<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Url;

class SitemapCall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lrvl:sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private Sitemap $sitemap;
    private SiteMapIndex $siteMapIndex;
    private $i = 0;
    private $j = 1;
    private $siteUrl = 'https://demo.telefonvertrag.de/';

    private $maxItemPerPage = 1000;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->sitemap      = Sitemap::create();
        $this->siteMapIndex = SitemapIndex::create();
    }

    private function get_link($item)
    {
        $data = [$item->url];

        while ($item->parent) {
            $data[] = $item->parent->url;
            $item   = $item->parent;
        }

        return join("/", array_reverse($data))."/";
    }

    private function is_hidden($item)
    {
        if ($item->ausblenden) {
            return true;
        }

        while ($item->parent) {
            if ($item->parent->ausblenden) {
                return true;
            }
            $item = $item->parent;
        }

        return false;
    }

    private function add($tag)
    {
        $this->sitemap->add($tag);

        if (++$this->i === $this->maxItemPerPage) {
            $this->done();
        }
    }

    private function done()
    {
        $this->sitemap->writeToFile(public_path('sitemap/sitemap_'.$this->j.'.xml'));
        $this->siteMapIndex->add($this->siteUrl."sitemap_".$this->j.".xml");
        $this->i = 0;
        ++$this->j;
        $this->sitemap = Sitemap::create();

    }

    private function doneAll()
    {
        $this->done();

        $this->siteMapIndex->writeToFile(public_path('sitemap/sitemap_index.xml'));
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $this->doneAll();
    }
}
