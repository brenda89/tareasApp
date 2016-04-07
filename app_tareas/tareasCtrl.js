angular
  .module('App')
    .controller('tareasCtrl', ['$scope', '$http', function($scope, $http) {
      $scope.showEditInput = false;
      $scope.editableId = '';    

      $scope.cargaTareas = function() { 
       var url="http://localhost/api_tareas/slimrest/tareas/";
        $http
        .get(url).success(function(response) {
              //alert(response); 
              console.log(response);
              $scope.tareas=response; 
              $scope.nuevaTarea = '';
         
            });
      }
  
     
      $scope.update = function(id, tarea) {        
        //var data = '{ "ID_TAREA": "' + id + '", "' + 'TAREA": "' + tarea + '" }';
        var data = '{ "TAREA": "' + tarea + '" }';
        console.log(data);        
        $http
          .put("http://localhost/api_tareas/slimrest/tareas/"+id+"", 
             data ).success(function(response) {
              console.log(response);
              $scope.cancel();
            });

      }
      
      
      $scope.showEdit = function(id_tarea) {

        $scope.showEditInput = true;
        $scope.editableId = id_tarea;
      }


     
      $scope.delete = function(id_tarea) {
        //console.log(id_tarea);        
        $http.delete("http://localhost/api_tareas/slimrest/tareas/" + id_tarea, [])
          .success(function(response) {
              $scope.cargaTareas();  
          });
        
      }

 /*      
      $scope.clean = function() {
        var username = $scope.newUser.username;
        $scope.newUser = {};
        console.log(username);
        $scope.newUser.username = username;
      }
   
*/


      $scope.create = function() {
       var url="http://localhost/api_tareas/slimrest/tareas/"+$scope.nuevaTarea.nombre_tarea+"/"+$scope.nuevaTarea.fecha_tarea;
        $http
        .post(url,[]
             ).success(function(response) {
              //alert(response); 
              console.log(response); 
              $scope.cargaTareas();          
            });
      }
      
      
      $scope.cancel = function() {
        $scope.editableId = '';
        $scope.showEditInput = false;
        $scope.cargaTareas();
      }
      
    



      $scope.cargaTareas();

    }]);