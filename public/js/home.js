angular.module('home', [
    'helper.service',
    'admin.service',
    'auth.service',
    'message.service',
    'ngLocale',
])
    .controller('diagnosaController', diagnosaController)
    .filter('numberEx', ['numberFilter', '$locale',
        function (number, $locale) {

            var formats = $locale.NUMBER_FORMATS;
            return function (input, fractionSize) {
                //Get formatted value
                var formattedValue = number(input, fractionSize);

                //get the decimalSepPosition
                var decimalIdx = formattedValue.indexOf(formats.DECIMAL_SEP);

                //If no decimal just return
                if (decimalIdx == -1) return formattedValue;


                var whole = formattedValue.substring(0, decimalIdx);
                var decimal = (Number(formattedValue.substring(decimalIdx)) || "").toString();

                return whole + decimal.substring(1);
            };
        }
    ])
    .factory('diagnosaService', diagnosaService);


function diagnosaController($scope, diagnosaService, pesan) {
    $scope.kriteria = true;
    $.LoadingOverlay('show');
    diagnosaService.get().then(res => {
        $scope.datas = res
        $scope.gejalas = angular.copy($scope.datas);
        $.LoadingOverlay('hide');
    })
    $scope.diagnosa = (param) => {
        $.LoadingOverlay('show');
        diagnosaService.diagnosa(param.filter(x => x.check)).then(res => {
            $scope.hasil = res.sort(function (a, b) {
                return b.v - a.v;
            });
            console.log($scope.hasil);
            $scope.kriteria = false;
            $.LoadingOverlay('hide');
        })
    }
    $scope.ulang = () => {
        $scope.gejalas = angular.copy($scope.datas);
        $scope.hasil = [];
        $scope.kriteria = true;
    }
}

function diagnosaService($http, $q, helperServices, AuthService, pesan) {
    var controller = helperServices.url + 'diagnosa/';
    var service = {};
    service.data = [];
    return {
        get: get,
        diagnosa: diagnosa
    };

    function get() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: helperServices.url + 'gejala/' + 'read',
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

    function diagnosa(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + 'post',
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
}