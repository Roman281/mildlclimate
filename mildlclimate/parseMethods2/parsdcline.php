<?php 
function Godcline($data, $category_id, $db) { 
$language_id = 2; 

$docpage = phpQuery::newDocument($data);


/*print_r($docpage);*/


/*--------------Курс -------------------*/
$headerpage = $docpage->find('div.background div.main div.headerTop');
  
$rowheader = pq($headerpage);
/*.headerTop > table:nth-child(1) > tbody:nth-child(1) > tr:nth-child(1) > td:nth-child(6) > div:nth-child(2)*/
/*$currency = $rowheader->find('table  tr td div.ballance ');*/
 $currency1 = $rowheader->find(' table:nth-child(1)  > tr:nth-child(1) > td:nth-child(6) > div:nth-child(2)')->text();
 $currency2 = explode(" ", $currency1);
 
 $currency = trim($currency2[2]);
/*--------------------------------*/

$listpage = $docpage->find('div.background div.main div.content');
  
$rowpage = pq($listpage);

$listpage1 = $rowpage->find('.content-table > tbody:nth-child(1) > tr:nth-child(1) ');

/*print_r($listpage1);*/

 /* $siteprice = 'yugcontract';
  $trademargin =  R::getRow( 'SELECT `trade_margin`  FROM `oc_trade_margin` WHERE  siteprice LIKE ? LIMIT 1',
  [ "%$siteprice%" ]
  );*/
   
   /*print_r($trademargin);*/
   /*echo count($rowpage->find('.itemline'));*/

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
 

/*---------------------------- Перебираем строчки таблицы товаров ------------------------*/
for ($pi=0; $pi <= count($rowpage->find('.itemline')); $pi++) {
 /*for ($pi=0; $pi <= 10; $pi++) { */
  $brand = $rowpage->find(" .itemline:eq($pi)")->attr('data-man'); /*получаем бренд*/

    $coddcline = trim($rowpage->find(" .itemline:eq($pi) td:nth-child(2) h3:nth-child(1)")->text()); /*код поставщика*/
    $modelcod2 = trim($rowpage->find(" .itemline:eq($pi) td:nth-child(4) > h3:nth-child(1)")->text()); /*код modelcod*/
    $modelcod3 = explode(" ", $modelcod2);
    $modelcod1 = array_slice($modelcod3, -3, 3);
    $modelcod0 = $modelcod1[0].$modelcod1[1].$modelcod1[2];
    
    $modelcod = trim(strtr($modelcod0, $converter));

    /*$producttab =  R::getRow( 'SELECT `sku`  FROM oc_product WHERE sku LIKE ? LIMIT 1',
        [ "%$coddcline%" ]
    );*/ /*Проверяем есть ли код в нашей таблице*/

    /*--------------------------Pars price -------------------------------*/

  

   $pricedcline1 = $rowpage->find(" .itemline:eq($pi) div.flexcontainer > div:nth-child(1) ")->text();
   $pricedcline2 = preg_replace('#[^0-9\,]#', '', $pricedcline1);

    if(stripos($pricedcline1, "грн.") == true) {
       
         $pricedcline = round(trim($pricedcline2), 0);
    } elseif(stripos($pricedcline1, "$") == true) {
     
         $pricedcline = ceil(trim($pricedcline2)*(ceil($currency)+1));
    };

    if ($pricedcline !== 0) {
          $status = 1;
    } else {
        $status = 0;
    };

    /*-------------------------------------------------------*/
        $date_available =  date("Y-m-d");  
    /*-------------------------------------------------------*/  
        $length_class_id = 1;
    /*-------------------------------------------------------*/
        $subtract = 0;
    /*-------------------------------------------------------*/ 
      
    /*-------------------------------------------------------*/
        $idproduct = "";
        $sort_order = 0; $upc = ""; $ean = ""; $jan = ""; $isbn = ""; $mpn = ""; $location = "";
        $points =""; $tax_class_id = ""; $weight = "";$weight_class_id = "";$length = "";$width = "";
        $height = ""; $minimum= "";$viewed = 1; $youtube_code = "";$deshevle = ""; $shipping = 1;
        $dminimum = 0; $subtract = 0;
        $quantity = 1; 
        $stock_status_id = 7;


    /*---------------------------------------------------------------------*/

    $modelname = trim($rowpage->find(" .itemline:eq($pi) td:nth-child(4) h3:nth-child(1)")->text());

   $counttd = count($rowpage->find(" .itemline:eq($pi) td"));

   if ($counttd == 1) {
       $typeprod =  trim($rowpage->find(" .itemline:eq($pi) td:nth-child(1)")->text());
   } else {
      false;
   };

    /*---------------------------------------------------------------------*/
    $producttab =  $db->query("SELECT product_id FROM oc_product WHERE sku = '" .  $db->escape($coddcline) . "' ");
    /*$producttab->row['product_id']." " ;*/
     $chackattrid2 =  $db->query("SELECT pat.product_id, attribute_id FROM oc_product_attribute pat LEFT JOIN  oc_product p ON (pat.product_id = p.product_id) WHERE sku = '" .  $db->escape($coddcline) . "' LIMIT 1 ");

     /*SELECT pat.product_id, attribute_id FROM oc_product_attribute pat LEFT JOIN  oc_product p ON (pat.product_id = p.product_id) WHERE sku = 268740 LIMIT 1*/

/*-----------------------------------------------------------------------------------------------*/
   


/*-------------------Если такого товара в Табиле товаров нет, то записываем -----------------*/
  if ($producttab->row == false && !empty($modelname) || $chackattrid2->row == false) {
    /*if (!empty($modelname)) {*/
       echo "запись";
     /*-------------------------------------------------*/
    $hrefdcline1 = $rowpage->find(" .itemline:eq($pi) td:nth-child(2) h3:nth-child(1) > a:nth-child(1)")->attr('href');
       $urlitme = 'https://opt.dclink.com.ua/'.$hrefdcline1;
     
      $upOne2 = realpath(__DIR__.'/..');
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $urlitme);
     // откуда пришли на эту страницу
    /* curl_setopt($ch, CURLOPT_REFERER, $url12);*/
 
     /*-------------------------------------------------------*/
     
         /*curl_setopt($ch, CURLOPT_REFERER, 'https://opt.dclink.com.ua/');*/
        // вернем результат, вместо его вывода
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        /*-----------------------------------------*/
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
      
        // делаем POST запрос
        /*curl_setopt($ch, CURLOPT_POST, 1);*/
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
       /* curl_setopt($ch1, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:81.0) Gecko/20100101 Firefox/81.0');*/
        
        /*curl_setopt($ch, CURLOPT_AUTOREFERER, true);*/
        // добавляем данные
        /*curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post1));*/
        /*curl_setopt($ch1, CURLOPT_COOKIEJAR, __DIR__ .'/cookie2.txt');*/
        curl_setopt($ch, CURLOPT_COOKIEFILE, $upOne2.'/StartpriceFolder/cookie1.txt');
        /*curl_setopt($ch1, CURLOPT_COOKIEFILE, __DIR__.'/StartpriceFolder/cookie1.txt');*/
        // добавляем данные
        /*curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post1));*/
        /*curl_setopt($ch, CURLOPT_COOKIEJAR, __DIR__ .'/cookie1.txt');*/
        /*curl_setopt($ch, CURLOPT_COOKIEFILE, $upOne2 .'/StartpriceFolder/cookie1.txt');*/
        
         // Stop session so curl can use the same session without conflicts
         /* session_write_close();*/
         
        // cURL будет выводить подробные сообщения о всех производимых действиях
        /*curl_setopt($ch, CURLOPT_VERBOSE, 1);*/

  /*------------------------------------------------------*/


    
    $dataitme = curl_exec($ch);

    
    curl_close($ch);

    /*$filecontent = file_get_contents($upOne2 .'/StartpriceFolder/cookie1.txt');

        var_dump($filecontent);*/
    /*------------------------------------------------------------*/
    $docpage1 = phpQuery::newDocument($dataitme);
   /* print_r($docpage1);*/

    $skupage = $docpage1->find('div.background div.main div.content div.product');
    
    $descriptsku = pq($skupage);

    /*--------------------------------------------------*/
    /*html body div.background div.main div.content table.content-table tbody tr td div.product h1 span*/
    $namemodel = trim($descriptsku->find('h1 span')->text());
    /*--------------------------------------------------*/


 
      $fulldescription =  trim(strip_tags($descriptsku->find("pre#descr-ua")->text()));

     /*echo $description . ' ';*/


    /*------------------------- Brand------------------------------------------*/

    /*  $countrow = count($descriptsku->find("  table.th > tr"));

      for ($t=1; $t <= $countrow; $t++) { 


        $namecharacter = trim($descriptsku->find(" table.th > tr:eq($t)  > td:nth-child(1)")->text());

      if ($namecharacter == 'Производитель:') {
        $brand = trim($descriptsku->find(" table.th > tr:eq($t)  > td:nth-child(3)")->text()); 
      };
     
      };*/

      /*echo $brand;*/

      $brandmodel =  R::getRow( 'SELECT `manufacturer_id`, `name`  FROM `oc_manufacturer` WHERE  name LIKE ? LIMIT 1',
          [ "%$brand%" ]
      );

         /* $brandmodel['name'];*/
      if (!empty($brandmodel['manufacturer_id'])) {
          $manufacturer_id = $brandmodel['manufacturer_id'];
      }else { 
        
        $db->query("INSERT INTO oc_manufacturer SET name = '" . $db->escape($brand) . "',  sort_order =  0 ");

        $manufacturerid =  R::getRow( 'SELECT `manufacturer_id`, `name`  FROM `oc_manufacturer` WHERE  name LIKE ? LIMIT 1',
          [ "%$brand%" ]
        );

        $db->query("INSERT INTO oc_manufacturer_to_store SET manufacturer_id = '" . $db->escape($manufacturerid['manufacturer_id']) . "', store_id =  0 ");

        $manufacturer_id = $manufacturerid['manufacturer_id'];
      };

  /*-----------------parse photo---------------------------------*/
      $upOne1 = realpath(__DIR__.'/..');

/*.product-photo > span:nth-child(1) > a:nth-child(1) > img:nth-child(1)
  html body div.background div.main div.content table.content-table tbody tr td div.product table.top tbody tr td div.product-photo span a img
*/
    $imgpeview = $descriptsku->find("div.product-photo span a")->attr('href');
   /*html body div.background div.main div.content table.content-table tbody tr td div.product table.top tbody tr td div.product-photo span a*/
      /*$imgpeview = trim($descriptsku->find("table  .product-photo > span:nth-child(1) > a:nth-child(1)")->attr('href'));*/
      
      $imgpeviewf =end(explode("/", $imgpeview));
      $image_name = basename($imgpeview); //Определяем имя и расширение картинки
    
        /* $size = getimagesize($imgpeview);*/
     /*  $size = filesize($imgpeview);*/
        
      if(!file_exists($upOne1 ."/image/imgdcline/".$image_name) ){ //Проверяем нет ли такой картинки
              
              $image = file_get_contents($imgpeview);
              file_put_contents($upOne1 ."/image/imgdcline/".$image_name, $image);
         /*через file_get_contents($image) получаем картинку по ссылке и file_put_contents кладём её в нужную нам папку*/
      }else{
                 
          false;
      };  

      /*----------------demo Photo----------------------*/
      

    /*$countrow1 = count($descriptsku->find(" div.gallery > a"));*/

      for ($im=0; $im <= 3; $im++) { 

      /*echo   trim($descriptsku->find("  div.gallery a:eq($im)")->attr('href')). " ". $im;*/

          $demoimg[$im] = trim($descriptsku->find("  div.gallery a:eq($im)")->attr('href'));
    
      };

     /* print_r( $demoimg);*/

      /* $imgpeview01 = end(explode("/", $demoimg[0]));*/
        $image_name0 = basename($demoimg[0]); //Определяем имя и расширение картинки
        $image_name001 = "demoimgdcline/".$image_name0;

        if(!file_exists($upOne1 ."/image/demoimgdcline/".$image_name0) && !empty($image_name0)){ /*Проверяем нет ли такой тинки*/
   
            $image0 = file_get_contents($demoimg[0]);
            file_put_contents($upOne1  ."/image/demoimgdcline/".$image_name0, $image0);
      
        }else{
         
          false;
        };  

        /*$imgpeview10 = end(explode("/", $demoimg[1]));*/
        $image_name1 = basename($demoimg[1]); //Определяем имя и расширение картинки
        $image_name002 = "demoimgdcline/".$image_name1;

        if(!file_exists($upOne1 ."/image/demoimgdcline/".$image_name1) && !empty($image_name1)){ /*Проверяем нет ли такой картинки*/
   
            $image1 = file_get_contents($demoimg[1]);
            file_put_contents($upOne1  ."/image/demoimgdcline/".$image_name1, $image1);
      
        }else{
         
          false;
        };  


        $image_name2 = basename($demoimg[2]); //Определяем имя и расширение картинки
        $image_name003 = "demoimgdcline/".$image_name2;

        if(!file_exists($upOne1 ."/image/demoimgdcline/".$image_name2) && !empty($image_name2)){ /*Проверяем нет ли такой тинки*/
   
            $image2 = file_get_contents($demoimg[2]);
            file_put_contents($upOne1  ."/image/demoimgdcline/".$image_name2, $image2);
      
        }else{
         
          false;
        };  

      
        $image_name3 = basename($demoimg[3]); //Определяем имя и расширение картинки
        $image_name004 = "demoimgdcline/".$image_name3;

        if(!file_exists($upOne1 ."/image/demoimgdcline/".$image_name3) && !empty($image_name3)){ /*Проверяем нет ли такой тинки*/
   
            $image3 = file_get_contents($demoimg[3]);
            file_put_contents($upOne1  ."/image/demoimgdcline/".$image_name3, $image3);
      
        }else{
         
          false;
        };
  /*----------------------------------------------------*/
    
    /*-------------------------------------------------------*/   
      $imagepath = 'imgdcline/'.$image_name;

      $sitedonor = 'optdcline';

   /* $producttab =  R::getRow( 'SELECT product_id FROM oc_product WHERE sku LIKE ? LIMIT 1',
        [ "%$coddcline%" ]
    );*/

    /*-------------------------------------*/

  /*  $producttabl =  R::getRow( 'SELECT `product_id`  FROM oc_product WHERE sku LIKE ? LIMIT 1',
        [ "%$coddcline%" ]
    );*/

   

    /*----------------------  Запись товара в базу  ------------------------------------*/

   /* if (empty($producttab->row['product_id'])) {*/
       /*echo "запись";*/
    



 /* $sitedonor = 'yugcontract';*/

    $producttab1 =  $db->query("SELECT product_id FROM oc_product WHERE sku = '" .  $db->escape($coddcline) . "' ");

    /*print_r($producttab->row);*/
/*-------------------Если такого товара в Табиле товаров нет, то записываем -----------------*/
  if ($producttab1->row == false && !empty($modelname) && !empty($image_name)) {


   
   $db->query("INSERT INTO oc_product SET model = '" . $db->escape($namemodel) . "', sku = '" . $db->escape($coddcline) . "', modelcod = '" . $db->escape($modelcod) . "', upc = '" . $db->escape($upc) . "', ean = '" . $db->escape($ean) . "', jan = '" . $db->escape($jan) . "', isbn = '" . $db->escape($isbn) . "', mpn = '" . $db->escape($mpn) . "', location = '" . $db->escape($location) . "', quantity = '" . (int)$quantity . "', minimum = '" . (int)$dminimum . "', subtract = '" . (int)$subtract. "', stock_status_id = '" . (int)$stock_status_id . "', date_available = '" . $db->escape($date_available) . "', manufacturer_id = '" . (int)$manufacturer_id . "', shipping = '" . (int)$shipping . "',  price_base = '" . (float)$pricedcline. "', points = '" . (int)$points . "', weight = '" . (float)$weight. "', weight_class_id = '" . (int)$weight_class_id . "', length = '" . (float)$length. "', width = '" . (float)$width. "', height = '" . (float)$height. "', length_class_id = '" . (int)$length_class_id. "', status = '" . (int)$status . "', tax_class_id = '" . (int)$tax_class_id . "', sort_order = '" . (int)$sort_order . "', date_added = NOW(), date_modified = NOW(), sitedonor = '" . $db->escape($sitedonor) . "'");

   
    $product_id = $db->getLastId();
   
/*$product_id. "Rod2 ";
   $image_name0;*/

    if (isset($image_name)) {
            $db->query("UPDATE oc_product SET image = '" . $db->escape($imagepath) . "' WHERE product_id = '" . (int)$product_id . "'");
    }
    
    if (!empty($image_name0)) {
           /* $db->query("UPDATE oc_product SET image0 = '" . $db->escape($image_name001) . "' WHERE product_id = '" . (int)$product_id . "'");*/
            $db->query("INSERT INTO oc_product_image SET product_id = '" . (int)$product_id . "', image = '" . $db->escape($image_name001) . "', sort_order = 0");
    }
    
    if (!empty($image_name1)) {
          /*  $db->query("UPDATE oc_product SET image1 = '" . $db->escape($image_name002) . "' WHERE product_id = '" . (int)$product_id . "'");*/
            $db->query("INSERT INTO oc_product_image SET product_id = '" . (int)$product_id . "', image = '" . $db->escape($image_name002) . "', sort_order = 0");
    }
    
    if (!empty($image_name2)) {
           /* $db->query("UPDATE oc_product SET image2 = '" . $db->escape($image_name003) . "' WHERE product_id = '" . (int)$product_id . "'");*/
            $db->query("INSERT INTO oc_product_image SET product_id = '" . (int)$product_id . "', image = '" . $db->escape($image_name003) . "', sort_order = 0");
    }
   
    if (!empty($image_name3)) {
            /*$db->query("UPDATE oc_product SET image3 = '" . $db->escape($image_name004) . "' WHERE product_id = '" . (int)$product_id . "'");*/
            $db->query("INSERT INTO oc_product_image SET product_id = '" . (int)$product_id . "', image = '" . $db->escape($image_name004) . "', sort_order = 0");
    }

    /*-------------------------------------*/

  };

    /*----------------------------------------------------------------*/
    $producttabl2 = $db->query("SELECT product_id FROM oc_product WHERE sku = '" .  $db->escape($coddcline) . "' ");
/*echo $coddcline;*/
    $productid2 =  $producttabl2->row['product_id'];
    /*echo $productid2. "Rod1 ";
    echo $product_id. "Rod2 ";*/

    /*DELETE FROM `oc_product` WHERE `sku`= 3045*/
    /*------------------------- Характеристики------------------------------------------*/

    $type;
     /*html body div.background div.main div.content table.content-table tbody tr td div.product table.th*/
    $countrow1 = count($descriptsku->find("table.th tr"));
 /* html body div.background div.main div.content table.content-table tbody tr td div.product table.th tbody tr td.b*/
    /*echo $descriptsku->find(" table.th tr")->html();*/
     /*$dclin_attrarr = $db->query("SELECT charactdcline, charactyugcontr FROM dclinetoyugcot");*/
     /*$arrdcl = $dclin_attrarr->rows;*/
    for ($t=1; $t <= $countrow1; $t++) { 
  
    /*for ($t=1; $t <= 3; $t++) { */



      $namecharacter1 = trim($descriptsku->find(" table.th  tr:eq($t) td:nth-child(1)")->text());
      /*$attrdcline = $db->query("SELECT `charactdcline`, `charactyugcontr` FROM $dclin_attrarr->rows WHERE `charactdcline` = '" .  $db->escape($namecharacter1) . "' ");*/
      /*$arrtest = array(
        'Автовключение:' => 
      )*/

     $dclin_attrarr = $db->query("SELECT charactdcline FROM dclinetoyugcot WHERE charactdcline = '" .  $db->escape($namecharacter1) . "' "); 
     $namecharacter = $dclin_attrarr->row['charactdcline'];
    /* echo $namecharacter. "idatrr ";
*/
      $product_attribute = $db->query("SELECT attribute_id FROM oc_attribute_description WHERE name = '" .  $db->escape($namecharacter) . "'");

    $prodattrid = $product_attribute->row['attribute_id'];
      /* echo $prodattrid . " ";*/

        $character = trim($descriptsku->find(" table.th  tr:eq($t) td:nth-child(3)")->text());

        /*echo $productid2. " ";*/

         $chackattrid =  $db->query("SELECT product_id, attribute_id FROM oc_product_attribute WHERE product_id = '" .  $db->escape($productid2) . "' AND attribute_id = '" .  $db->escape($prodattrid) . "' ");

         /*echo $productid2. "productid2 ";*/
        if (empty($chackattrid->row) ) {
            /*echo $namecharacter; */
            /*echo $prodattr . " idattr ";*/
        
            $db->query("INSERT INTO oc_product_attribute SET product_id = '" . (int)$productid2 . "', attribute_id = '" . (int)$prodattrid . "', language_id = '" . (int)$language_id . "', text = '" .  $db->escape($character) . "' ");
        }


    };


      $chackattrid1 =  $db->query("SELECT product_id, attribute_id FROM oc_product_attribute WHERE product_id = '" .  $db->escape($productid2) . "' AND attribute_id = 852 ");

         /*echo $productid2. "productid2 ";*/
        if (empty($chackattrid1->row) ) {
            /*echo $namecharacter; */
            /*echo $prodattr . " idattr ";*/
        
            $db->query("INSERT INTO oc_product_attribute SET product_id = '" . (int)$productid2 . "', attribute_id = 852, language_id = '" . (int)$language_id . "', text = '" .  $db->escape($typeprod) . "' ");
        }  



    /*-------------------------product_description---------------------------------*/


   

    $proddescript =  R::getRow( 'SELECT `product_id`  FROM oc_product_description WHERE product_id LIKE ? LIMIT 1',
        [ "%$productid2%" ]
    );
    if (empty($proddescript)) {
       
  

   
   /* echo ' save to description ';*/


      $description = $fulldescription; /*нет на сайте короткого описания*/

    

    $db->query("INSERT INTO oc_product_description SET product_id = '" . (int)$productid2 . "', language_id = '" . (int)$language_id . "', name = '" . $db->escape($namemodel) . "', description = '" . $db->escape($fulldescription) . "',  tag = '" . $db->escape($namemodel) . "', meta_title = '" . $db->escape($namemodel) . "', meta_description = '" . $db->escape($description) . "', meta_keyword = '" . $db->escape($namemodel) . "'");
      
    } else {
          /*echo 'уже есть';*/
         /* $db->query("UPDATE oc_product_description SET description='" . $db->escape($fulldescription) . "', meta_description = '" . $db->escape($description) . "' WHERE product_id = '" . (int)$productid2 . "'");*/
         false;
    }; 

      $store_id = 0;
    /*----------------------------------------------------------------*/
    $producttostore =  R::getRow( 'SELECT `product_id`  FROM oc_product_to_store WHERE product_id LIKE ? LIMIT 1',
        [ "%$productid2%" ]
    );

    if (empty($producttostore)) {
   
    $db->query("INSERT INTO oc_product_to_store SET product_id = '" . (int)$productid2 . "', store_id = '" . (int)$store_id . "'");
    }



    /*--------------------------------- Category ----------------------------------*/


    $productpodcat =  R::getRow( 'SELECT product_id, category_id  FROM oc_product_to_category WHERE product_id LIKE ? AND category_id LIKE ? LIMIT 1',
        [ "%$productid2%", "%$category_id%"]
    );
    if (empty($productpodcat)) {
    $db->query("INSERT INTO oc_product_to_category SET product_id = '" . (int)$productid2 . "', category_id = '" . (int)$category_id . "'");
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

    $categoryid = $category_id;
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
    
       /* $db->query("INSERT INTO oc_product_filter SET product_id = '" . (int)$productid2 . "', filter_id = '" . (int)$filterid . "'");*/
    };

    /*------------------------------------------------------------*/



  

    } elseif ($producttab->row == true  && !empty($modelname))  {
          /*$date_available =  date("Y-m-d");*/
          R::exec( "UPDATE oc_product SET quantity = :quantity,  price_base = :price_base, status = :status, date_available = :date_available, date_added = :date_added, date_modified = :date_modified, modelcod =:modelcod  WHERE  sku = :sku", 
            array( 
             ':sku' => $coddcline, 
             ':quantity' => $quantity, 
             /*':stock_status_id' => $stock_status_id,*/
             
             ':price_base' => $pricedcline,
             ':status' => $status,
             ':date_available' => $date_available,
             ':date_added' => $date_available,
             ':date_modified' => $date_available,
             ':modelcod' => $modelcod,
          
            )
          );

     /*-------------------------------------------------------------------------*/
      $oldid = $db->query("SELECT product_id, image FROM oc_product  WHERE   sitedonor = 'optdcline' AND sku = '" .  $db->escape($coddcline) . "' "); 
      
      if ($oldid->row['image'] == NULL) {
          echo 'image == NULL';
        /*-----------------parse photo---------------------------------*/
        /*-------------------------------------------------*/
    $hrefdcline1 = $rowpage->find(" .itemline:eq($pi) td:nth-child(2) h3:nth-child(1) > a:nth-child(1)")->attr('href');
       $urlitme = 'https://opt.dclink.com.ua/'.$hrefdcline1;
     
      $upOne2 = realpath(__DIR__.'/..');
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $urlitme);
     // откуда пришли на эту страницу
    /* curl_setopt($ch, CURLOPT_REFERER, $url12);*/
 
     /*-------------------------------------------------------*/
     
         /*curl_setopt($ch, CURLOPT_REFERER, 'https://opt.dclink.com.ua/');*/
        // вернем результат, вместо его вывода
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        /*-----------------------------------------*/
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
      
        // делаем POST запрос
        /*curl_setopt($ch, CURLOPT_POST, 1);*/
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
       /* curl_setopt($ch1, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:81.0) Gecko/20100101 Firefox/81.0');*/
        
        /*curl_setopt($ch, CURLOPT_AUTOREFERER, true);*/
        // добавляем данные
        /*curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post1));*/
        /*curl_setopt($ch1, CURLOPT_COOKIEJAR, __DIR__ .'/cookie2.txt');*/
        curl_setopt($ch, CURLOPT_COOKIEFILE, $upOne2.'/StartpriceFolder/cookie1.txt');
        /*curl_setopt($ch1, CURLOPT_COOKIEFILE, __DIR__.'/StartpriceFolder/cookie1.txt');*/
        // добавляем данные
        /*curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post1));*/
        /*curl_setopt($ch, CURLOPT_COOKIEJAR, __DIR__ .'/cookie1.txt');*/
        /*curl_setopt($ch, CURLOPT_COOKIEFILE, $upOne2 .'/StartpriceFolder/cookie1.txt');*/
        
         // Stop session so curl can use the same session without conflicts
         /* session_write_close();*/
         
        // cURL будет выводить подробные сообщения о всех производимых действиях
        /*curl_setopt($ch, CURLOPT_VERBOSE, 1);*/

  /*------------------------------------------------------*/


    
    $dataitme = curl_exec($ch);

    
    curl_close($ch);

    /*$filecontent = file_get_contents($upOne2 .'/StartpriceFolder/cookie1.txt');

        var_dump($filecontent);*/
    /*------------------------------------------------------------*/
    $docpage1 = phpQuery::newDocument($dataitme);
   /* print_r($docpage1);*/

    $skupage = $docpage1->find('div.background div.main div.content div.product');
    
    $descriptsku = pq($skupage);



        /*----------------------------------------------------------*/
      $imgpeview = $descriptsku->find("div.product-photo span a")->attr('href');
     
     /* $imgpeviewf =end(explode("/", $imgpeview));*/
      $image_name = basename($imgpeview); //Определяем имя и расширение картинки
         
      /* $size = filesize($imgpeview);*/
        
      if(!file_exists($upOne1 ."/image/imgdcline/".$image_name) ){ //Проверяем нет ли такой картинки
          
              $image = file_get_contents($imgpeview);
              file_put_contents($upOne1 ."/image/imgdcline/".$image_name, $image);
         /*через file_get_contents($image) получаем картинку по ссылке и file_put_contents кладём её в нужную нам папку*/
    
      /*----------------demo Photo----------------------*/
      

    

      for ($im=0; $im <= 3; $im++) { 

     

          $demoimg[$im] = trim($descriptsku->find("  div.gallery a:eq($im)")->attr('href'));
    
      };

     /* print_r( $demoimg);*/

     
        $image_name0 = basename($demoimg[0]); //Определяем имя и расширение картинки
        $image_name001 = "demoimgdcline/".$image_name0;

        if(!file_exists($upOne1 ."/image/demoimgdcline/".$image_name0) && !empty($image_name0)){ /*Проверяем нет ли такой тинки*/
   
            $image0 = file_get_contents($demoimg[0]);
            file_put_contents($upOne1  ."/image/demoimgdcline/".$image_name0, $image0);
      
        }else{
         
          false;
        };  

        /*$imgpeview10 = end(explode("/", $demoimg[1]));*/
        $image_name1 = basename($demoimg[1]); //Определяем имя и расширение картинки
        $image_name002 = "demoimgdcline/".$image_name1;

        if(!file_exists($upOne1 ."/image/demoimgdcline/".$image_name1) && !empty($image_name1)){ /*Проверяем нет ли такой картинки*/
   
            $image1 = file_get_contents($demoimg[1]);
            file_put_contents($upOne1  ."/image/demoimgdcline/".$image_name1, $image1);
      
        }else{
         
          false;
        };  


        $image_name2 = basename($demoimg[2]); //Определяем имя и расширение картинки
        $image_name003 = "demoimgdcline/".$image_name2;

        if(!file_exists($upOne1 ."/image/demoimgdcline/".$image_name2) && !empty($image_name2)){ /*Проверяем нет ли такой тинки*/
   
            $image2 = file_get_contents($demoimg[2]);
            file_put_contents($upOne1  ."/image/demoimgdcline/".$image_name2, $image2);
      
        }else{
         
          false;
        };  

      
        $image_name3 = basename($demoimg[3]); //Определяем имя и расширение картинки
        $image_name004 = "demoimgdcline/".$image_name3;

        if(!file_exists($upOne1 ."/image/demoimgdcline/".$image_name3) && !empty($image_name3)){ /*Проверяем нет ли такой тинки*/
   
            $image3 = file_get_contents($demoimg[3]);
            file_put_contents($upOne1  ."/image/demoimgdcline/".$image_name3, $image3);
      
        }else{
         
          false;
        };
    /*----------------------------------------------------*/
    /*---------------------- сохраняем фото в базу данных  ----------------------*/

     /* if ($oldid->row['image'] == NULL) {*/
      $prodid = $oldid->row['product_id'];
      $imgpathmain = "imgdcline/".$image_name;
      $checkmainimg = $db->query("UPDATE oc_product SET  image = '" . $db->escape($imgpathmain) . "'  WHERE product_id = $prodid ");

      $checkdemoimg = $db->query("SELECT product_image_id, product_id, image FROM oc_product_image  WHERE product_id = $prodid ");
       /* print_r($checkdemoimg);*/
      /*foreach ($checkdemoimg->rows as $kim => $valim) {*/
        $idimg0 = $checkdemoimg->rows[0]['product_image_id'];
        if (!empty($checkdemoimg->rows) && $checkdemoimg->rows[0]['image'] == NULL  && !empty($idimg0)) {
          
          $db->query("UPDATE oc_product_image SET  image = '" . $db->escape($image_name001) . "'  WHERE product_image_id = $idimg0 ");
        } 

        $idimg1 = $checkdemoimg->rows[1]['product_image_id'];
        if (!empty($checkdemoimg->rows) && $checkdemoimg->rows[1]['image'] == NULL && !empty($idimg1)) {

          $db->query("UPDATE oc_product_image SET  image = '" . $db->escape($image_name002) . "' WHERE product_image_id = $idimg1");
        }

        $idimg2 = $checkdemoimg->rows[2]['product_image_id'];
        if (!empty($checkdemoimg->rows) && $checkdemoimg->rows[2]['image'] == NULL &&  !empty($idimg2)) {
          $db->query("UPDATE oc_product_image SET  image = '" . $db->escape($image_name003) . "' WHERE product_image_id = $idimg2 ");
        }

        $idimg3 = $checkdemoimg->rows[3]['product_image_id'];
        if (!empty($checkdemoimg->rows) && $checkdemoimg->rows[3]['image'] == NULL && !empty($idimg3)) {
          $db->query("UPDATE oc_product_image SET  image = '" . $db->escape($image_name004) . "' WHERE product_image_id = $idimg3 ");
        }
        
      }else{
                 
          false;
      };  

        
      /*}*/

    /*-------------------------------------------------------*/   
      $imagepath = 'imgdcline/'.$image_name;

      $sitedonor = 'optdcline';




      } /*Обновляем  изображение*/

      /*-------------------------------------------------------------------------*/
    
        echo "update! ";


    };  /*if $producttab*/


    /*-------------------------Filter-------------------------------------*/
    $filterdescription =  R::getRow( 'SELECT name FROM oc_filter_description  WHERE name LIKE ?  LIMIT 1',
        [ "%$brand%"]
    );
   
    $filter_group_id = 1;
    $sort_order = 0;

 /*   if (empty($filterdescription)) {
      $db->query("INSERT INTO oc_filter SET  filter_group_id = '" . (int)$filter_group_id . "', sort_order = '" . (int)$sort_order . "'");    
      
      $filter_id = $db->getLastId();
      $brand;
      $db->query("INSERT INTO oc_filter_description SET filter_id = '" . (int)$filter_id . "', language_id = '" . (int)$language_id . "', filter_group_id = '" . (int)$filter_group_id . "', name = '" . $db->escape($brand) . "'");
          
          
    }*/

    /*----------------------Описание категорий -------------------------*/
    

    /*---------------------------------------*/

} /*перебираем ряды даблицы*/

/*print_r($coddcline);*/

};


