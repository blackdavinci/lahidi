(function() {
  var app = angular.module('lahidiApp', [], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
  });

   app.controller('MainCtrl', function() {
    this.choices = [{id: 'choice1'}];
      
      this.addNewChoice = function() {
        var newItemNo = this.choices.length+1;
        this.choices.push({'id':'choice'+newItemNo});
      };
        
      this.removeChoice = function() {
        var lastItem = this.choices.length-1;
        if(lastItem!=0){
        	this.choices.splice(lastItem);
        }
        
      };
            
    });

   app.controller('graphController',function() {
    this.graph = 1;

    this.isSet = function(checkgraph) {
      return this.graph === checkgraph;
    };

    this.setTab = function(activegraph) {
      this.graph = activegraph;  
    }

   });
  



})();