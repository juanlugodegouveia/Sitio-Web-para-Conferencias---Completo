<?php

require 'paypal/autoload.php';

//url
define('URL_SITIO', 'http://127.0.0.1/gdlwebcampnuevo%20-Copia%20sin%20Optimizar-FINAL'); //Definir la url del sitio.

$apiContext = new \PayPal\Rest\ApiContext(
  new \PayPal\Auth\OAuthTokenCredential(
    //ClienteID
    'AVYFpj_Gx3cpOhFyPT3qPx-EW98r1UjDRLFXiT-74je5qyBIxbjTeXn-IgyCcAS1KxpQhBUzdbQijh10',

    //Secret
    'ELUhDv3qn4Pd-Yfq0neginEQicjSqcf7fc3kaASGM6P7tUWw-VatD3gh3HhiL2FzL5lVQ8jWZst2nXGg'
      )
  );
 ?>
