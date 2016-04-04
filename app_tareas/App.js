angular
  .module('App', [
    'ui.router'
  ]).config(['$urlRouterProvider', '$stateProvider', function($urlRouterProvider, $stateProvider) {
    $urlRouterProvider.otherwise('/');  
    
    $stateProvider
      .state('tareas', {
        url: '/',
        templateUrl: 'tareas.html'
      })

  }]);