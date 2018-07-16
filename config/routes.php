<?php

use NoahBuscher\Macaw\Macaw;


Macaw::get('(:all)', function($fu) {
  echo '未匹配到路由<br>'.$fu;
});
Macaw::get('/','HomeController@home');
Macaw::get('/translate','HomeController@translate');


Macaw::dispatch();