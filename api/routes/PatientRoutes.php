<?php

Flight::route('GET /patients', function(){
  $offset= Flight::routeForLimitAndOffset("offset",0);
  $limit= Flight::routeForLimitAndOffset("limit",10);
  $search = Flight::routeForLimitAndOffset("search");

  Flight::json(Flight::patient_service()->getAccountService($search,$offset,$limit));

});





 ?>
