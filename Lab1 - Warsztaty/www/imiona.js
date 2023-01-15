var imionaApp = angular.module("imionaApp", []);
//definicja kontrolera
imionaApp.controller("imionaCtrl", function($scope, $http) {

    //defaultowe wartości do scope'a
    $scope.filter = "";
    $scope.sort = "pozycja";
    $scope.rev = false;

    $scope.refresh = function(filter) {
            $http({
                method: "GET",
                url: "imiona.php",
                params: {"filter": filter ?? ""}
            }).then( 
                function success(result){
                    $scope.imiona = result.data; //wiemy, że wróci json więc tylko przypisanie
                },
                function error(result) {

                });
    }

    $scope.refresh(""); //pierwsze wywołanie przy uruchomieniu, bez filtracji

});