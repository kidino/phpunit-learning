<?php 

use \PHPUnit\Framework\TestCase;

class ArticleTest extends TestCase {

    protected $article;

    function setUp():void {
        $this->article = new Article;
    }
/*
    function testSlugIsEmptyByDefault() {
        $this->assertSame('', $this->article->getSlug() );
    } 

    function testSlugIsReplacedByUnderscores() {
        $this->article->title = 'Judul Cerita Hari Ini';
        $this->assertEquals('judul_cerita_hari_ini', $this->article->getSlug() );
    }

    function testSlugHasWhiteSpacesReplacedWithUnderscores() {
        $this->article->title = "Judul   !%  Cerita  \n  Hari    Ini";
        $this->assertEquals('judul_cerita_hari_ini', $this->article->getSlug() );
    }

    function testSlugDoesNotStartOrEndWithUnderscores() {
        $this->article->title = '  Judul  Cerita Hari  Ini  ';
        $this->assertEquals('judul_cerita_hari_ini', $this->article->getSlug() );
    }

    function testSlugAllLettersAreLowercase() {
        $this->article->title = '  Judul  Cerita Hari  Ini  ';
        $this->assertEquals('judul_cerita_hari_ini', $this->article->getSlug() );
    }
*/

    public function titleProvider () {
        return [
            'satu' => ['  Judul  Cerita Hari  Ini  ','judul_cerita_hari_ini'],
            'dua' => ["Judul   !%  Cerita  \n  Hari    Ini",'judul_cerita_hari_ini'],
            'tiga' => ['Judul Cerita Hari Ini','judul_cerita_hari_ini'],
            'empat' => ['  Judul &&& Cerita Hari  Ini  ','judul_cerita_hari_in'],
        ];
    }

    /**
     * @dataProvider titleProvider
     */

    public function testSlug( $title, $slug ) {
        $this->article->title = $title;
        $this->assertEquals( $slug, $this->article->getSlug() );
    }


}
