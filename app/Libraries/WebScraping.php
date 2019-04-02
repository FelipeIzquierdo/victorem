<?php namespace Victorem\Libraries;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
use Exception;
use GuzzleHttp;

class WebScraping
{

    private $client;
    public $url;
    public $crawler;
    private $content = null;

    /**
     * Defining our Dependency Injection Here.
     * or Instantiate new Classes here.
     *
     * @return void
     */

    public function __construct(Client $client = null)
    {
        if (is_null($client)) {
            $this->client = new Client;
        } else {
            $this->client = $client;
        }
    }

    /**
     * This will be used for Outputing our Data
     * and Rendering to browser.
     *
     * @return void
     */
    public function run($doc)
    {
        $registraduriaUrl = Campaing::getRegistraduriaUrl();
        $this->url = $registraduriaUrl . $doc;

        if ($this->setScrapeUrl($this->url)) {
            $this->startScraper();
        } else {
            $this->content['status'] = false;
            $this->content['message'] = 'Lo sentimos, la Registraduría no responde';
        }

        return $this->getContents();
    }


    public function runProcuraduria($doc)
    {
        $client = new GuzzleHttp\Client();
        $response = $client->get('http://datos.vinder.info/ruaf/?doc=' . $doc);

        if (array_key_exists('name', $response->json())) {
            return ucwords(strtolower(trim($response->json()['name'])));
        }
    }

    /**
     * Setup our scraper data. Which includes the url that
     * we want to scrape
     *
     * @param (String) $url = default is NULL
     *          (String) $method = Method Types its either POST || GET
     * @return void
     */
    public function setScrapeUrl($url = NULL, $method = 'GET')
    {
        try {
            $this->crawler = $this->client->request($method, $url);
        } catch (Exception $e) {
            return false;
        }

        return true;

    }

    /**
     * This will get all the return Result from our Web Scraper
     *
     * @return array
     */
    public function getContents()
    {
        return $this->content;
    }

    /**
     * It will handle all the scraping logic, filtering
     * and getting the data from the defined url in our method setScrapeUrl()
     *
     * @return array
     */
    private function startScraper()
    {
        $countContent = $this->crawler->filter('table')->count();

        if ($countContent > 0) {
            $this->content['status'] = true;
            $this->crawler->filter('table td')->each(function (Crawler $node, $i) {
                switch ($i) {
                    case 3:
                        $this->content['location'] = strtolower(trim($node->filter('td')->text()));
                        break;
                    case 5:
                        $this->content['place'] = strtolower(trim($node->filter('td')->text()));
                        break;
                    case 7:
                        $this->content['place_address'] = strtolower(trim($node->filter('td')->text()));
                        break;
                    case 11:
                        $this->content['table_number'] = strtolower(trim($node->filter('td')->text()));
                        break;
                    default:
                        return null;
                        break;
                }
            });
        } else {
            $this->content['status'] = false;
            if ($this->crawler->filter('#info #ttlo')->count() > 0) {
                $this->content['message'] = $this->crawler->filter('#info #ttlo')->text();
            } else if ($this->crawler->filter('#info')->count() > 0) {
                $this->content['message'] = $this->crawler->filter('#info')->text();
            }
        }

        return $this->content;
    }


}