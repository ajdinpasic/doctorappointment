<?php





  Flight::route('GET /accounts', function(){
    $offset= Flight::routeForLimitAndOffset("offset",0);
    $limit= Flight::routeForLimitAndOffset("limit",10);

    Flight::json(Flight::account()->getAllEntities($offset,$limit));
 }
  });

    Flight::route('GET /account/@id', function($id){
      $result=Flight::account()->getEntity($id);
      Flight::json($result);
    });

  Flight::route('POST /accounts', function(){
      $request = Flight::request();
      $data=$request->data->getData();
      $result=Flight::account()->insertEntity($data);
      Flight::json($result);
    });

    Flight::route('PUT /accounts/@id', function($id){
      $request=Flight::request();
      $data=$request->data->getData();
      Flight::account()->updateEntity($id,$data);
      $result=Flight::account()->getEntity($id);
      Flight::json($result);

    });




 ?>
