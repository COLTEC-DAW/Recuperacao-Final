var app = angular.module('github',[]);

app.factory('GithubService', function($http){
    var userService = {};

    userService.getInfo = function(nome, callback) {
        $http.get('https://api.github.com/users/' + nome).then(function(response) {
          var answer = response.data;
          callback(answer);
        },
        function(response) {
          var answer = null;
          callback(answer);
        });
    };
      
    userService.getRepositorios = function(nome, callback){
      $http.get('https://api.github.com/users/' + nome + '/repos').then(function(response) {
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
  self.repositorios = [];

  this.getUser = function(nome) {
    userService.getInfo(nome, function(answer) {
      if (answer !== null) {                
        self.user = answer;
      }
    });
    self.getRepositorios(nome);
  }

  this.getRepositorios = function(nome) {
    userService.getRepositorios(nome, function(answer) {
      if (answer !== null) {                
        self.repositorios = answer;
        console.log(self.repositorios);
      }
    });
  }

}]);