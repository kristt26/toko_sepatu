angular.module('info.service', [])
    // admin
    .factory('dashboardServices', dashboardServices)
    .factory('dashboardServices', dashboardServices)
    .factory('profileServices', profileServices)
    .factory('detailPesananServices', detailPesananServices)
    
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
        addToCart:addToCart,
        checkout:checkout,
        getDetailPesanan:getDetailPesanan,
        uploadProof:uploadProof,
        readProduk:readProduk,
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

    function checkout(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + 'checkout',
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
    function getDetailPesanan(id) {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'read_detail_pesanan/' + id,
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

    function uploadProof(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + 'upload',
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

    function readProduk() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'read_produk',
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

function profileServices($http, $q, helperServices, AuthService) {
    var controller = helperServices.url + 'profile/';
    var service = {};
    service.data = [];
    service.instance = false;
    return {
        get: get
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
}

function detailPesananServices($http, $q, helperServices, AuthService) {
    var controller = helperServices.url + 'detail_pesanan/';
    var service = {};
    service.data = [];
    service.instance = false;
    return {
        get: get
    };

    function get(param) {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'read/' + param,
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



