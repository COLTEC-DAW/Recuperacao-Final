var app = angular.module('github',[]);

app.factory('GithubService', function($http){
    var userService = {};

    userService.getInfo = function(nome, callback) {
        $http.get('https://api.github.com/users/' + nome + '.json').then(function(response) {
          var answer = response.data;
          callback(answer);
        },
        function(response) {
          var answer = null;
          callback(answer);
        });
    };
      
    userService.getRepositorios = function(nome, callback){
      $http.get('https://api.github.com/users/' + nome + '/repos' + '.json').then(function(response) {
        var answer = response.data;
        callback(answer);
      },
      function(response) {
        var answer = null;
        callback(answer);
      });
    };

    return userService;
});

app.controller('UserController', ['GithubService', function(userService){
  var self = this;
  self.user = {};

  this.getUser = function(nome) {
    userService.getInfo(nome, function(answer) {
      if (answer !== null) {                
        self.user = answer;
      }
    });
  }

}]);