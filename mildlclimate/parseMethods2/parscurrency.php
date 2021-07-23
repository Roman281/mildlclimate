<?php 
function Parscurrency($url,  $choiseprice, $db) { 

foreach ($choiseprice as $key => $value) {
    $category_id = $key;
    $urlitme1 =  $value;


$language_id = 2; 
$upOne1 = realpath(__DIR__.'/..');
$sitedonor = 'smartvent';

/*echo "Goood!!!!!";*/

     $converter = array(
        'а' => '',   'б' => '',   'в' => '',
        'г' => '',   'д' => '',   'е' => '',
        'ё' => '',   'ж' => '',  'з' => '',
        'и' => '',   'й' => '',   'к' => '',
        'л' => '',   'м' => '',   'н' => '',
        'о' => '',   'п' => '',   'р' => '',
        'с' => '',   'т' => '',   'у' => '',
        'ф' => '',   'х' => '',   'ц' => '',
        'ч' => '',  'ш' => '',  'щ' => '',
        'ь' => '',  'ы' => '',   'ъ' => '',
        'э' => '',   'ю' => '',  'я' => '',
        'є' => '',   'ї' => '',  'Ї' => '',
        'і' => '',   'І' => '',  ' ' => '', 

        'А' => '',   'Б' => '',   'В' => '',
        'Г' => '',   'Д' => '',   'Е' => '',
        'Ё' => '',   'Ж' => '',  'З' => '',
        'И' => '',   'Й' => '',   'К' => '',
        'Л' => '',   'М' => '',   'Н' => '',
        'О' => '',   'П' => '',   'Р' => '',
        'С' => '',   'Т' => '',   'У' => '',
        'Ф' => '',   'Х' => '',   'Ц' => '',
        'Ч' => '',  'Ш' => '',  'Щ' => '',
        'Ь' => '',  'Ы' => '',   'Ъ' => '',
        'Э' => '',   'Ю' => '',  'Я' => '',
        ' ' => '',  'Є' => '',  '-' => '',
        '_' => '',   '(' => '',  ')' => '',
        'ґ' => '',
    );

/*php D:\OSPanel\domains\weatherinhome\StartpriceFolder\startconditioner*/
 
     /*$urlitme1 = 'https://smartvent.com.ua/ua/g28504970-pryamougolnye-kanalnye-ventilyatory';*/
     /*https://smartvent.com.ua/g28504970-pryamougolnye-kanalnye-ventilyatory/page_2?view_as=list#*/

     $ch = curl_init();
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1)'); // устанавливаем юзерагент
        curl_setopt($ch, CURLOPT_URL, $urlitme1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // возвращаем результат в переменную вместо браузера
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Следуем по редиректам
        $urlpage1 = curl_exec($ch);
        curl_close($ch);

    
   $docpage1 = phpQuery::newDocument($urlpage1);
    $rowpage1 = pq($docpage1);
/*html body.b-layout div.b-page div.b-page__main-content.b-page__wrapper div.b-page__content-wrapper div.b-page__content div.b-page__row div#catalog_controls_block.b-catalog-panel div.b-catalog-panel__pagination div.b-pager span.b-pager__link.b-pager__link_type_current.b-pager__link_pos_last*/

   $table = $rowpage1->find(' div.container.clearfix section div.mfm-grey-bg');
}; /*$choiseprice массив url*/

};


