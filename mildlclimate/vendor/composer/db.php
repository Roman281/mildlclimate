<?php 
require ROOT  .'/libs/rb.php';

R::setup( 'mysql:host=127.0.0.1;dbname=midlclimate','root', '' );
/*R::setup( 'mysql:host=localhost;dbname=wimcom_webpr','wimcom_comwim', 'db301020cart' ); */ 

if ( !R::testconnection() )
{
		exit ('no connection to the base');
}