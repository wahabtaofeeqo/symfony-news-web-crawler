<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\DomCrawler\Crawler;
use App\Repository\ArticleRepository;
use App\Entity\Article;

class NewsController extends AbstractController
{

    /**
     * @property HttpClientInterface
     * 
     */
    private $http;

    /**
     * @property ArticleRespository
     * 
     */
    private $repository;


    public function __construct(HttpClientInterface $http, ArticleRepository $repository)
    {
       $this->http = $http;
       $this->repository = $repository;
    }

    #[Route('/news', name: 'app_news')]
    public function index()
    {
        // $html = file_get_contents('https://highload.today/category/novosti/');
        $html = 
        <<<'HTML'
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>
        <body>
            <div class="lenta-item">
                <span class="cat-label"><a href="https://highload.today/category/novosti/">Новости</a></span> - 					
                <span class="meta-datetime" style="display: contents;">3 дня назад</span>
                <a href="https://highload.today/gde-u-ajtishnikov-vyshe-zarplata-v-ukraine-ili-v-polshe-issledovanie/"><h2>Где у айтишников выше зарплата: в Украине или в Польше? Исследование</h2>
                </a>

                <div class="author-block" style="float: none; display: inline-block;">
                    <div class="author-left">
                        <a href="/author/elena">
                            <img src="https://highload.today/wp-content/uploads/avatars/200/61a9e1e5257b7-bpfull.jpg?d=https://highload.today/wp-content/plugins/userswp/assets/images/no_profile.png" data-lazy-src="https://highload.today/wp-content/uploads/avatars/200/61a9e1e5257b7-bpfull.jpg?d=https://highload.today/wp-content/plugins/userswp/assets/images/no_profile.png" data-ll-status="loaded" class="entered lazyloaded"><noscript>
                            <img src="https://highload.today/wp-content/uploads/avatars/200/61a9e1e5257b7-bpfull.jpg?d=https://highload.today/wp-content/plugins/userswp/assets/images/no_profile.png"></noscript>
                        </a>
                    </div>
                    <div class="author-right">
                        <p class="author-name font-weight-bold pt-2 pb-0">
                            <a href="https://highload.today/author/elena/">Оленка Пилипчак</a>
                        </p>
                        <p class="author-info">Редактор у Highload</p>
                    </div>	
                </div>								
                
                <a href="https://highload.today/gde-u-ajtishnikov-vyshe-zarplata-v-ukraine-ili-v-polshe-issledovanie/"><div class="lenta-image"><img width="1200" height="769" src="https://highload.today/wp-content/uploads/2022/09/1617314044_yqxm26_fb_plus-2.jpeg.webp" class="attachment-201735 size-201735 wp-post-image entered lazyloaded" alt="" large="" data-lazy-srcset="https://highload.today/wp-content/uploads/2022/09/1617314044_yqxm26_fb_plus-2.jpeg.webp 1200w,https://highload.today/wp-content/uploads/2022/09/1617314044_yqxm26_fb_plus-2-300x192.jpeg.webp 300w,https://highload.today/wp-content/uploads/2022/09/1617314044_yqxm26_fb_plus-2-1024x656.jpeg.webp 1024w,https://highload.today/wp-content/uploads/2022/09/1617314044_yqxm26_fb_plus-2-768x492.jpeg.webp 768w,https://highload.today/wp-content/uploads/2022/09/1617314044_yqxm26_fb_plus-2-500x320.jpeg.webp 500w,https://highload.today/wp-content/uploads/2022/09/1617314044_yqxm26_fb_plus-2-780x500.jpeg.webp 780w" data-lazy-sizes="(max-width: 1200px) 100vw, 1200px" data-lazy-src="https://highload.today/wp-content/uploads/2022/09/1617314044_yqxm26_fb_plus-2.jpeg.webp" data-ll-status="loaded" sizes="(max-width: 1200px) 100vw, 1200px" srcset="https://highload.today/wp-content/uploads/2022/09/1617314044_yqxm26_fb_plus-2.jpeg.webp 1200w,https://highload.today/wp-content/uploads/2022/09/1617314044_yqxm26_fb_plus-2-300x192.jpeg.webp 300w,https://highload.today/wp-content/uploads/2022/09/1617314044_yqxm26_fb_plus-2-1024x656.jpeg.webp 1024w,https://highload.today/wp-content/uploads/2022/09/1617314044_yqxm26_fb_plus-2-768x492.jpeg.webp 768w,https://highload.today/wp-content/uploads/2022/09/1617314044_yqxm26_fb_plus-2-500x320.jpeg.webp 500w,https://highload.today/wp-content/uploads/2022/09/1617314044_yqxm26_fb_plus-2-780x500.jpeg.webp 780w"><noscript><img width="1200" height="769" src="https://highload.today/wp-content/uploads/2022/09/1617314044_yqxm26_fb_plus-2.jpeg.webp" class="attachment-201735 size-201735 wp-post-image" alt="" large="" srcset="https://highload.today/wp-content/uploads/2022/09/1617314044_yqxm26_fb_plus-2.jpeg.webp 1200w,https://highload.today/wp-content/uploads/2022/09/1617314044_yqxm26_fb_plus-2-300x192.jpeg.webp 300w,https://highload.today/wp-content/uploads/2022/09/1617314044_yqxm26_fb_plus-2-1024x656.jpeg.webp 1024w,https://highload.today/wp-content/uploads/2022/09/1617314044_yqxm26_fb_plus-2-768x492.jpeg.webp 768w,https://highload.today/wp-content/uploads/2022/09/1617314044_yqxm26_fb_plus-2-500x320.jpeg.webp 500w,https://highload.today/wp-content/uploads/2022/09/1617314044_yqxm26_fb_plus-2-780x500.jpeg.webp 780w" sizes="(max-width: 1200px) 100vw, 1200px" /></noscript>								
                    </div>	
                </a>
                <p>В Украине чаще всего ищут Frontend-специалистов и тестировщиков, в Польше — Backend-специалистов. Также в Польше будет легче найти работу начинающим, так количество вакансий для джуниоров выросло на 8%.</p>
            </div>      
        </body>
        </html>
        HTML;

        $crawler = new Crawler($html);
        
        /**
         * Get elements that hold news
         * 
         */
        $crawler = $crawler->filter('body div.lenta-item');

        $data = [];

        /**
         * Tranverse
         * 
         */
        $title = null;
        $image = null;

        foreach ($crawler as $domElement) {
            $nodes = $domElement->childNodes;
            foreach ($nodes as $key => $node) {
                switch ($node->nodeName) {
                    case 'a':
                        if (!$title) {
                            $title = $this->getTitle($node);
                        }
                        $image = $this->getImage($node);
                        break;

                    case 'p':
                        $desc = $this->getDesc($node);
                        break;
                }
            }

            $data = $this->createArticle($title, $image, $desc);
        }

        $response = new JsonResponse();
        return $response->setData([
            'status' => true,
            'message' => 'Hello World!',
            'data' => $data
        ]);
    }

    public function getDesc($element)
    {
        return $element->firstChild->textContent;
    }

    public function getTitle($element)
    {
        if ($element->firstChild->nodeName == 'h2') {
            return $element->firstChild->textContent;
        }
    }

    public function getImage($element)
    {
        if ($element->firstChild->nodeName == 'div') {
            $div = $element->firstChild;
            if ($div->firstChild->nodeName == 'img') {
                return $div->firstChild->getAttribute('src');
            }
        }
    }

    /**
     * Create new Article Model
     * 
     * @param string $title
     * @param string $image
     * @param string $description
     * 
     * @return Article
     */
    public function createArticle($title, $image, $description)
    {
        $model = $this->repository->findOneByTitle($title);
        if (!$model) {
            $article = new Article();
            $article->title = $title;
            $article->picture = $image;
            $article->short_description = $description;
            $this->repository->save($article, true);
        }
        return $model;
    }
}
