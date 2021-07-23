<?php 
function Parscondition($url,  $choiseprice, $db) {

  $price = 'price_uan';
 $pricetest =  $db->query("SELECT product_id, $price FROM oc_product  ");

print_r($pricetest->rows);


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

     $numpage = count($rowpage1->find('div.b-pager a.b-pager__link:nth-child '));
  /*  echo $numpage = $rowpage->find('a.b-pager__link:nth-child(3)')->html();*/
/*for ($p=1; $p <= $numpage; $p++) { */
  for ($p=1; $p <= 1; $p++) { 
    /*echo $p;  */
    $urlitme = $urlitme1."/page_".$p;

     /*https://smartvent.com.ua/g28504970-pryamougolnye-kanalnye-ventilyatory/page_2?view_as=list#*/

     $ch = curl_init();
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1)'); // устанавливаем юзерагент
        curl_setopt($ch, CURLOPT_URL, $urlitme);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // возвращаем результат в переменную вместо браузера
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Следуем по редиректам
        $urlpage = curl_exec($ch);
        curl_close($ch);

/*html body.b-layout div.b-page div.b-page__main-content.b-page__wrapper div.b-page__content-wrapper div.b-page__content div.b-page__row

.b-page__content > div:nth-child(4)

.b-product-list*/



    $docpage2 = phpQuery::newDocument($urlpage);
    $rowpage2 = pq($docpage2);
/*html body.b-layout div.b-page div.b-page__main-content.b-page__wrapper div.b-page__content-wrapper div.b-page__content div.b-page__row div#catalog_controls_block.b-catalog-panel div.b-catalog-panel__pagination div.b-pager span.b-pager__link.b-pager__link_type_current.b-pager__link_pos_last*/


  

   $count = count($rowpage2->find('.b-page__content > div:nth-child(4) ul.b-product-list li'));

   for ($li=0; $li <= $count; $li++) { 
    /*for ($i=1; $i <= 1; $i++) { */
  
  
   /*echo $listpage = $rowpage2->find('.b-page__content ul.b-product-list li:eq($i) a.b-product-list__image-link')->attr('href');*/
  /* echo $listpage = $rowpage2->find('ul.b-product-list li.b-online-edit:nth-child($i)  div:nth-child(4)  a.b-product-list__image-link')->attr('href');*/
   /* $listpage = $rowpage2->find('.b-page__content > div:nth-child(4) ul.b-product-list li a.b-product-list__image-link:eq($i) ')->attr('href');*/
    $urlitme = "'".'.b-product-list li.b-online-edit:eq('.$li.') div:nth-child(4) > a:nth-child(1)'."'";

   $listpage = $rowpage2->find($urlitme)->attr('href');
    /* echo $li;*/

     $ch = curl_init();
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1)'); // устанавливаем юзерагент
        curl_setopt($ch, CURLOPT_URL, $listpage);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // возвращаем результат в переменную вместо браузера
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Следуем по редиректам
        $urlprod = curl_exec($ch);
        curl_close($ch);

    $docpage3 = phpQuery::newDocument($urlprod);
    $rowpage3 = pq($docpage3);

   
    $modelname = $rowpage3->find('div.b-page__content h1.b-title.b-title_type_product_name.b-online-edit')->text();
    
  $idprodmanuf = $rowpage3->find('div.b-page__content div.b-product')->attr('data-advtracking-product-id');
    $image = $rowpage3->find('div.b-page__content a.js-product-gallery-overlay')->attr('href');

    $name = $rowpage3->find('div.b-page__content  h1.b-title.b-title_type_product_name.b-online-edit span')->html();
  
    $fulldescription = str_replace('"',"",$rowpage3->find('div.b-user-content.b-user-content_with_bg')->html());

  /* html body.b-layout div.b-page div.b-page__main-content div.b-page__content-wrapper div.b-page__content div.b-page__row div.b-page__row div div.b-online-edit table.b-product-info*/
  /*---------------------------------Photo ------------------------------------------*/
        $image_name = basename($image); //Определяем имя и расширение картинки
        $info = new SplFileInfo($image_name);
        $fileexten = $info->getExtension();
        $image_name11 = explode("_", $image_name);
        $image_name12 = array_slice($image_name11, 0, 1);
        $image_name0 = $image_name12[0].".".$fileexten; 

        $image_name001 = "imgforsite/".$image_name0;

        if(!file_exists($upOne1 ."/image/imgforsite/".$image_name0) && !empty($image_name0)){ /*Проверяем нет ли такой тинки*/
   
            $image0 = file_get_contents($image);
            file_put_contents($upOne1  ."/image/imgforsite/".$image_name0, $image0);
      
        }else{
         
          false;
        };  

         $imagepath = 'imgforsite/'.$image_name0;


              
       

    $type;
        
        /*-------------------Если такого товара в Табиле товаров нет, то записываем -----------------*/
        $date_available =  date("Y-m-d");  
   
        $length_class_id = 1;
 
        $subtract = 0;
        /* $idproduct = "";*/
        $sort_order = 0; $upc = ""; $ean = ""; $jan = ""; $isbn = ""; $mpn = ""; $location = "";
        $points =""; $tax_class_id = ""; $weight = "";$weight_class_id = "";$length = "";$width = "";
        $height = ""; $minimum= "";$viewed = 1; $youtube_code = "";$deshevle = ""; $shipping = 1;
        $dminimum = 0; $subtract = 0;
        $quantity = 1; 
        $stock_status_id = 7;
        $status = 1;

        $producttab1 =  $db->query("SELECT product_id FROM oc_product WHERE sku = '" .  $db->escape($idprodmanuf) . "' ");

          if ($producttab1->row == false && !empty($modelname) && !empty($image_name)) {


           
           $db->query("INSERT INTO oc_product SET model = '" . $db->escape($modelname) . "', sku = '" . $db->escape($idprodmanuf) . "',  upc = '" . $db->escape($upc) . "', ean = '" . $db->escape($ean) . "', jan = '" . $db->escape($jan) . "', isbn = '" . $db->escape($isbn) . "', mpn = '" . $db->escape($mpn) . "', location = '" . $db->escape($location) . "', quantity = '" . (int)$quantity . "', minimum = '" . (int)$dminimum . "', subtract = '" . (int)$subtract. "', stock_status_id = '" . (int)$stock_status_id . "', date_available = '" . $db->escape($date_available) . "', manufacturer_id = '" . (int)$manufacturer_id . "', shipping = '" . (int)$shipping . "',   points = '" . (int)$points . "', weight = '" . (float)$weight. "', weight_class_id = '" . (int)$weight_class_id . "', length = '" . (float)$length. "', width = '" . (float)$width. "', height = '" . (float)$height. "', length_class_id = '" . (int)$length_class_id. "', status = '" . (int)$status . "', tax_class_id = '" . (int)$tax_class_id . "', sort_order = '" . (int)$sort_order . "', date_added = NOW(), date_modified = NOW(), sitedonor = '" . $db->escape($sitedonor) . "'");

           
            $product_id = $db->getLastId();
           
        /*$product_id. "Rod2 ";
           $image_name0;*/

            if (isset($image_name)) {
                    $db->query("UPDATE oc_product SET image = '" . $db->escape($imagepath) . "' WHERE product_id = '" . (int)$product_id . "'");
            }
            


              /*------------------------- Характеристики------------------------------------------*/
             $character = $rowpage3->find('div.b-online-edit table.b-product-info')->html();
                $countrow1 = count($rowpage3->find('.b-product-info tr'));
               
                for ($t=0; $t <= $countrow1; $t++) {
                    /*$rowpage3->find('.b-product-info tr:eq($t) th')*/
                        $namecharacter = trim($rowpage3->find(" .b-product-info tr:eq($t) th")->text());
                        
                 
                   
                   $namecharacter1 = trim($rowpage3->find(" .b-product-info tr:eq($t) td:nth-child(1)")->text());
                   $namecharacter3 = str_replace(" ","",$namecharacter1);
                        $id_attr = $db->query("SELECT `attribute_id` FROM `oc_attribute_description` WHERE `language_id`= '" . (int)$language_id . "' AND `name` = '" .  $db->escape($namecharacter1) . "' "); 
             $idchar = $id_attr->row['attribute_id'];

                     $chackattrid =  $db->query("SELECT product_id, attribute_id FROM oc_product_attribute WHERE product_id = '" .  $db->escape($product_id) . "' AND attribute_id = '" .  $db->escape($idchar) . "' ");

        $namecharacter2 = trim($rowpage3->find(" .b-product-info tr:eq($t) td:nth-child(2)")->text());

                if (empty($chackattrid->row) ) {
            /*echo $namecharacter; */
            /*echo $prodattr . " idattr ";*/
        
                    $db->query("INSERT INTO oc_product_attribute SET product_id = '" . (int)$product_id . "', attribute_id = '" . (int)$idchar . "', language_id = '" . (int)$language_id . "', text = '" .  $db->escape($namecharacter2) . "' ");
                }

      /*------------------------- Brand------------------------------------------*/
                if ($namecharacter3 =='Производитель ' || $namecharacter3 =='Виробник ' || $namecharacter3 =='Виробник ') {
                       
                  trim($namecharacter2);

                  $brandmodel =  R::getRow( 'SELECT `manufacturer_id`, `name`  FROM `oc_manufacturer` WHERE  name LIKE ? LIMIT 1',
                      [ "%$namecharacter2%" ]
                  );

                     /* $brandmodel['name'];*/
                  if (!empty($brandmodel['manufacturer_id'])) {
                      $manufacturer_id = $brandmodel['manufacturer_id'];
                  }else { 
                    
                    $db->query("INSERT INTO oc_manufacturer SET name = '" . $db->escape($namecharacter2) . "',  sort_order =  0 ");

                    $manufacturerid =  R::getRow( 'SELECT `manufacturer_id`, `name`  FROM `oc_manufacturer` WHERE  name LIKE ? LIMIT 1',
                      [ "%$namecharacter2%" ]
                    );

                    $db->query("INSERT INTO oc_manufacturer_to_store SET manufacturer_id = '" . $db->escape($manufacturerid['manufacturer_id']) . "', store_id =  0 ");

                   $manufacturer_id = $manufacturerid['manufacturer_id'];
                  };
                }
                
            $manufacturer_id;


    /*-------------------------product_description---------------------------------*/


   

            $proddescript =  R::getRow( 'SELECT `product_id`  FROM oc_product_description WHERE product_id LIKE ? LIMIT 1',
                [ "%$product_id%" ]
            );
            if (empty($proddescript)) {
               
          

           
           /* echo ' save to description ';*/


            $description = "'".$fulldescription."'"; /*нет на сайте короткого описания*/

            

            $db->query("INSERT INTO oc_product_description SET product_id = '" . (int)$product_id . "', language_id = '" . (int)$language_id . "', name = '" . $db->escape($modelname) . "', description = '" . $db->escape($fulldescription) . "',  tag = '" . $db->escape($namemodel) . "', meta_title = '" . $db->escape($namemodel) . "', meta_description = '" . $db->escape($description) . "', meta_keyword = '" . $db->escape($modelname) . "'");
              
            } else {
                  /*echo 'уже есть';*/
                  $db->query("UPDATE oc_product_description SET description='" . $db->escape($fulldescription) . "', meta_description = '" . $db->escape($description) . "' WHERE product_id = '" . (int)$product_id . "'");
                 false;
            }; 

              $store_id = 0;
            /*----------------------------------------------------------------*/
            $producttostore =  R::getRow( 'SELECT `product_id`  FROM oc_product_to_store WHERE product_id LIKE ? LIMIT 1',
                [ "%$product_id%" ]
            );

            if (empty($producttostore)) {
           
            $db->query("INSERT INTO oc_product_to_store SET product_id = '" . (int)$product_id . "', store_id = '" . (int)$store_id . "'");
            }

            /*--------------------------------- Category ----------------------------------*/


            $productpodcat =  R::getRow( 'SELECT product_id, category_id  FROM oc_product_to_category WHERE product_id LIKE ? AND category_id LIKE ? LIMIT 1',
                [ "%$product_id%", "%$category_id%"]
            );
            if (empty($productpodcat)) {
            $db->query("INSERT INTO oc_product_to_category SET product_id = '" . (int)$product_id . "', category_id = '" . (int)$category_id . "'");
            }


            $filterid =  R::getRow( 'SELECT filter_id FROM oc_filter_description WHERE  name LIKE ?  LIMIT 1',
                [ "%$brand%"]
            );

         
            $filterid = $filterid['filter_id'];

            $categoryfilter =  R::getRow( 'SELECT category_id, filter_id  FROM oc_category_filter WHERE category_id LIKE ? AND filter_id LIKE ? LIMIT 1',
                [ "%$category_id%", "%$filterid%"]
            );

            if (empty($categoryfilter)) {
                
           
            $db->query("INSERT INTO oc_category_filter SET category_id = '" . (int)$category_id . "', filter_id = '" . (int)$filterid . "'");
            }


            $productfilter =  R::getRow( 'SELECT product_id, filter_id  FROM oc_product_filter WHERE product_id LIKE ?  LIMIT 1',
                [ "%$productid2%"]
            );
           /* print_r($productfilter);*/

            if (empty($productfilter )) {
                
            
                $db->query("INSERT INTO oc_product_filter SET product_id = '" . (int)$productid2 . "', filter_id = '" . (int)$filterid . "'");
            };

       /*     $categoryid = $category_id;
            $pricemarg = R::getRow( 'SELECT `trade_margin`, `emarketcateg` FROM `oc_category` WHERE  category_id LIKE ?  LIMIT 1',
                [ "%$categoryid%"]
            );

             if (!empty($pricemarg )) {
                  
                R::exec('UPDATE oc_product_to_category SET trade_margin = :trade_margin, emarketprod = :emarketprod WHERE category_id = :category_id AND product_id = :product_id', [

                  'category_id' => $categoryid,
                  'product_id' => $productid2,
                  'trade_margin' => $pricemarg['trade_margin'],
                  'emarketprod' => $pricemarg['emarketcateg'],
                ]);
            
               
            };*/

              /*----------------------------------------------------------------*/
            $producttostore =  R::getRow( 'SELECT `product_id`  FROM oc_product_to_store WHERE product_id LIKE ? LIMIT 1',
                [ "%$product_id%" ]
            );

            if (empty($producttostore)) {
           
            $db->query("INSERT INTO oc_product_to_store SET product_id = '" . (int)$product_id . "', store_id = '" . (int)$store_id . "'");
            }

            /*-------------------------------------*/

          }; /*запись товара*/

         } 
    /*print_r($listpage);*/

   
    } /*перебрать карточки*/ 

} /*перебрать страницы*/

/*print_r($dataitme);*/

}; /*$choiseprice массив url*/

};


