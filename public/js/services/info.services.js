angular.module('info.service', [])
    // admin
    .factory('dashboardServices', dashboardServices)
    
    ;

function dashboardServices($http, $q, helperServices, AuthService) {
    var controller = helperServices.url + 'beranda/';
    var service = {};
    service.data = [];
    service.instance = false;
    return {
        get: get,
        getItem:getItem,
        getCart:getCart,
        addToCart:addToCart
    };

    function get() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'read',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
            }
        );
        return def.promise;
    }

    function getItem(id) {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'read_detail/' + id,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
            }
        );
        return def.promise;
    }

    function getCart() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'get_cart',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
            }
        );
        return def.promise;
    }

    function addToCart(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + 'add_cart',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
            }
        );
        return def.promise;
    }
}



