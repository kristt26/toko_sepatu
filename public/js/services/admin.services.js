angular.module('admin.service', [])
    // admin
    .factory('dashboardServices', dashboardServices)
    .factory('kategoriServices', kategoriServices)
    .factory('produkServices', produkServices)
    .factory('variantServices', variantServices)
    .factory('pembelianServices', pembelianServices)
    .factory('penjualanServices', penjualanServices)
    .factory('areaServices', areaServices)
    .factory('tokoServices', tokoServices)
    .factory('orderServices', orderServices)
    .factory('penggunaServices', penggunaServices)
    ;

function dashboardServices($http, $q, helperServices, AuthService) {
    var controller = helperServices.url + 'beranda/';
    var service = {};
    service.data = [];
    service.instance = false;
    return {
        get: get,
        toko:toko
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

    function toko() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: helperServices.url + 'admin/toko/read',
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

function kategoriServices($http, $q, helperServices, AuthService, pesan) {
    var controller = helperServices.url + 'admin/kategori/';
    var service = {};
    service.data = [];
    return {
        get: get,
        post: post,
        put: put,
        deleted: deleted
    };

    function get() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'read',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                pesan.error(err.data.message);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function post(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + 'add',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data.push(res.data);
                def.resolve(res.data);
            },
            (err) => {
                $.LoadingOverlay('hide');
                pesan.error(err.data.messages.error);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function put(param) {
        var def = $q.defer();
        $http({
            method: 'put',
            url: controller + 'edit',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.find(x => x.id == param.id);
                if (data) {
                    data.kode_kerusakan = param.kode_kerusakan;
                    data.kerusakan = param.kerusakan;
                    data.bobot = param.bobot;
                }
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
            }
        );
        return def.promise;
    }

    function deleted(param) {
        var def = $q.defer();
        $http({
            method: 'delete',
            url: controller + "/delete/" + param.id_produk,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }

}

function produkServices($http, $q, helperServices, AuthService, pesan) {
    var controller = helperServices.url + 'admin/produk/';
    var service = {};
    service.data = [];
    return {
        get: get,
        post: post,
        put: put,
        deleted: deleted
    };

    function get() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'read',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                pesan.error(err.data.message);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function post(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + 'add',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data.push(res.data);
                def.resolve(res.data);
            },
            (err) => {
                $.LoadingOverlay('hide');
                pesan.error(err.data.messages.error);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function put(param) {
        var def = $q.defer();
        $http({
            method: 'put',
            url: controller + 'edit',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.find(x => x.id_produk == param.id_produk);
                if (data) {
                    data.nama_produk = param.nama_produk;
                    data.harga = param.harga;
                    data.keterangan = param.keterangan;
                    data.id_kategori = param.id_kategori;
                    data.nama_kategori = param.nama_kategori;
                    data.gender = param.gender;
                }
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
            }
        );
        return def.promise;
    }

    function deleted(param) {
        var def = $q.defer();
        $http({
            method: 'delete',
            url: controller + "/delete/" + param.id_produk,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }

}

function variantServices($http, $q, helperServices, AuthService, pesan) {
    var controller = helperServices.url + 'admin/variant/';
    var service = {};
    service.data = [];
    return {
        get: get,
        post: post,
        put: put,
        deleted: deleted
    };

    function get(param) {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'read/' + param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                pesan.error(err.data.message);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function post(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + 'add',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                def.resolve(res.data);
            },
            (err) => {
                $.LoadingOverlay('hide');
                pesan.error(err.data.messages.error);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function put(param) {
        var def = $q.defer();
        $http({
            method: 'put',
            url: controller + 'edit',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.find(x => x.id_variant == param.id_variant);
                if (data) {
                    data.ukuran = param.ukuran;
                    data.warna = param.warna;
                }
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
            }
        );
        return def.promise;
    }

    function deleted(param) {
        var def = $q.defer();
        $http({
            method: 'delete',
            url: controller + "/delete/" + param.id_variant,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }

}

function pembelianServices($http, $q, helperServices, AuthService, pesan) {
    var controller = helperServices.url + 'admin/pembelian/';
    var service = {};
    service.data = [];
    return {
        get: get,
        post: post,
        put: put,
        deleted: deleted
    };

    function get() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'read',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                pesan.error(err.data.message);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function post(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + 'add',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                def.resolve(res.data);
            },
            (err) => {
                $.LoadingOverlay('hide');
                pesan.Error(err.data.status);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function put(param) {
        var def = $q.defer();
        $http({
            method: 'put',
            url: controller + 'edit',
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

    function deleted(param) {
        var def = $q.defer();
        $http({
            method: 'delete',
            url: controller + "/delete/" + param.id_pembelian,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }

}

function penjualanServices($http, $q, helperServices, AuthService, pesan) {
    var controller = helperServices.url + 'admin/penjualan/';
    var service = {};
    service.data = [];
    return {
        get: get,
        post: post,
        put: put,
        deleted: deleted
    };

    function get() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'read',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                pesan.error(err.data.message);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function post(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + 'add',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                def.resolve(res.data);
            },
            (err) => {
                $.LoadingOverlay('hide');
                pesan.Error(err.data.status);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function put(param) {
        var def = $q.defer();
        $http({
            method: 'put',
            url: controller + 'edit',
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

    function deleted(param) {
        var def = $q.defer();
        $http({
            method: 'delete',
            url: controller + "/delete/" + param.id_pembelian,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }

}

function areaServices($http, $q, helperServices, AuthService, pesan) {
    var controller = helperServices.url + 'admin/area/';
    var service = {};
    service.data = [];
    return {
        get: get,
        post: post,
        put: put,
        deleted: deleted
    };

    function get() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'read',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                pesan.error(err.data.message);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function post(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + 'add',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data.push(res.data);
                def.resolve(res.data);
            },
            (err) => {
                $.LoadingOverlay('hide');
                pesan.Error(err.data.status);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function put(param) {
        var def = $q.defer();
        $http({
            method: 'put',
            url: controller + 'edit',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.find(x => x.id_area == param.id_area);
                if(data){
                    data.nama_area = param.nama_area;
                    data.harga_kirim = param.harga_kirim;
                }
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
            }
        );
        return def.promise;
    }

    function deleted(param) {
        var def = $q.defer();
        $http({
            method: 'delete',
            url: controller + "/delete/" + param.id_area,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data.splice(service.data.indexOf(param), 1);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }

}

function tokoServices($http, $q, helperServices, AuthService, pesan) {
    var controller = helperServices.url + 'admin/toko/';
    var service = {};
    service.data = [];
    return {
        get: get,
        post: post,
        put: put,
        deleted: deleted
    };

    function get() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'read',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                pesan.error(err.data.message);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function post(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + 'add',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                def.resolve(res.data);
            },
            (err) => {
                $.LoadingOverlay('hide');
                pesan.Error(err.data.status);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function put(param) {
        var def = $q.defer();
        $http({
            method: 'put',
            url: controller + 'edit',
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

    function deleted(param) {
        var def = $q.defer();
        $http({
            method: 'delete',
            url: controller + "/delete/" + param.id_area,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data.splice(service.data.indexOf(param), 1);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }

}

function orderServices($http, $q, helperServices, AuthService, pesan) {
    var controller = helperServices.url + 'admin/order/';
    var service = {};
    service.data = [];
    return {
        get: get,
        thisDay: thisDay,
        getOrder: getOrder,
        post: post,
        put: put,
        deleted: deleted
    };

    function get() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'read',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                pesan.error(err.data.message);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function thisDay() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'read_this_day',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                pesan.error(err.data.message);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function getOrder() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'getPending',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                pesan.error(err.data.message);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function post(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + 'add',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                def.resolve(res.data);
            },
            (err) => {
                $.LoadingOverlay('hide');
                pesan.Error(err.data.status);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function put(param) {
        var def = $q.defer();
        $http({
            method: 'put',
            url: controller + 'edit',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                def.resolve(res.data);
            },
            (err) => {
                pesan.Error(err.data.message);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function deleted(param) {
        var def = $q.defer();
        $http({
            method: 'delete',
            url: controller + "/delete/" + param.id_area,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data.splice(service.data.indexOf(param), 1);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }

}
function penggunaServices($http, $q, helperServices, AuthService, pesan) {
    var controller = helperServices.url + 'admin/pengguna/';
    var service = {};
    service.data = [];
    return {
        get: get,
        aktive: aktive,
        post: post,
        put: put,
        deleted: deleted
    };

    function get() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'read',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                pesan.error(err.data.message);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function aktive() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'aktive',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                pesan.error(err.data.message);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function post(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + 'add',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                def.resolve(res.data);
            },
            (err) => {
                $.LoadingOverlay('hide');
                pesan.Error(err.data.status);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function put(param) {
        var def = $q.defer();
        $http({
            method: 'put',
            url: controller + 'edit',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                def.resolve(res.data);
            },
            (err) => {
                pesan.Error(err.data.message);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function deleted(param) {
        var def = $q.defer();
        $http({
            method: 'delete',
            url: controller + "/delete/" + param.id_area,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data.splice(service.data.indexOf(param), 1);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }

}


