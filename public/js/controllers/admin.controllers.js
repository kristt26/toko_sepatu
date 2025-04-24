angular.module('adminctrl', [])
    // Admin
    .controller('dashboardController', dashboardController)
    ;

function dashboardController($scope, dashboardServices) {
    $scope.$emit("SendUp", "Beranda");
    $scope.datas = {};
    $scope.title = "Beranda";
}
