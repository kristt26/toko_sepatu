angular.module('adminctrl', [])
    // Admin
    .controller('dashboardController', dashboardController)
    .controller('kerusakanController', kerusakanController)
    .controller('gejalaController', gejalaController)
    .controller('pengetahuanController', pengetahuanController)
    .controller('keluhanController', keluhanController)
    ;

function dashboardController($scope, dashboardServices) {
    $scope.$emit("SendUp", "Dashboard");
    $scope.datas = {};
    $scope.title = "Dashboard";
    var all = [];
    mapboxgl.accessToken = 'pk.eyJ1Ijoia3Jpc3R0MjYiLCJhIjoiY2txcWt6dHgyMTcxMzMwc3RydGFzYnM1cyJ9.FJYE8uVi-eVl_mH_DLLEmw';

    dashboardServices.get().then(res => {
        $scope.datas = res;
        $scope.$applyAsync(x => {
            var map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/satellite-v9',
                center: [140.7052499, -2.5565586],
                zoom: 12
            });
            $scope.datas.forEach(param => {
                var item = new mapboxgl.Marker({ color: param.status == 'Diajukan' ? 'red' : param.status == 'Proses' ? 'Yellow' : '' })
                    .setLngLat([Number(param.long), Number(param.lat)])
                    .setPopup(
                        new mapboxgl.Popup({ offset: 25 }) // add popups
                            .setHTML(
                                `<h4><strong>Nomor Laporan: ${param.nomor}</strong></h4><p>Permasalahan: ${param.kerusakan}<br>Status: <strong>${param.status}</strong></p>`
                            )
                    )
                    .addTo(map);
                all.push(item);
            });
        })
    })
}

function kerusakanController($scope, kerusakanServices, pesan) {
    $scope.$emit("SendUp", "Daftar Kerusakan");
    $scope.datas = {};
    $scope.title = "Dashboard";
    $.LoadingOverlay('show');
    kerusakanServices.get().then(res => {
        $scope.datas = res;
        $.LoadingOverlay('hide');
    })

    $scope.edit = (param) => {
        $scope.model = angular.copy(param);
        $scope.model.bobot = parseFloat($scope.model.bobot);
    }

    $scope.save = () => {
        pesan.dialog('Yakin ingin melanjutkan proses?', "Ya", "Tidak", "info").then(x => {
            $.LoadingOverlay('show');
            if ($scope.model.id) {
                kerusakanServices.put($scope.model).then(res => {
                    $scope.model = {}
                    $.LoadingOverlay('hide');
                })
            } else {
                kerusakanServices.post($scope.model).then(res => {
                    $scope.model = {}
                    $.LoadingOverlay('hide');
                })
            }
        })
    }

    $scope.delete = (param) => {
        pesan.dialog('Yakin ingin melanjutkan proses?', "Ya", "Tidak").then(x => {
            $.LoadingOverlay('show');
            kerusakanServices.deleted(param).then(res => {
                $.LoadingOverlay('hide');
            })
        })
    }
}

function gejalaController($scope, gejalaServices, pesan) {
    $scope.$emit("SendUp", "Daftar Gejala");
    $scope.datas = {};
    $.LoadingOverlay('show');
    gejalaServices.get().then(res => {
        $scope.datas = res;
        $.LoadingOverlay('hide');
    })

    $scope.edit = (param) => {
        $scope.model = angular.copy(param);
    }

    $scope.save = () => {
        pesan.dialog('Yakin ingin melanjutkan proses?', "Ya", "Tidak", "info").then(x => {
            $.LoadingOverlay('show');
            if ($scope.model.id) {
                gejalaServices.put($scope.model).then(res => {
                    $scope.model = {}
                    $.LoadingOverlay('hide');
                })
            } else {
                gejalaServices.post($scope.model).then(res => {
                    $scope.model = {}
                    $.LoadingOverlay('hide');
                })
            }
        })
    }

    $scope.delete = (param) => {
        pesan.dialog('Yakin ingin melanjutkan proses?', "Ya", "Tidak").then(x => {
            $.LoadingOverlay('show');
            gejalaServices.deleted(param).then(res => {
                $.LoadingOverlay('hide');
            })
        })
    }
}

function pengetahuanController($scope, pengetahuanServices, helperServices, pesan) {
    $scope.$emit("SendUp", "Daftar Pengetahuan");
    $scope.datas = {};
    $.LoadingOverlay('show');
    pengetahuanServices.get(helperServices.lastPath).then(res => {
        $scope.datas = res;
        console.log(res);
        $.LoadingOverlay('hide');
    })

    $scope.edit = (param) => {
        $scope.gejala = $scope.datas.gejala.find(x => x.id == param.gejala_id);
        $scope.model = angular.copy(param);
        $scope.model.bobot = parseFloat($scope.model.bobot);
    }

    $scope.save = () => {
        pesan.dialog('Yakin ingin melanjutkan proses?', "Ya", "Tidak", "info").then(x => {
            $.LoadingOverlay('show');
            if ($scope.model.id) {
                pengetahuanServices.put($scope.model).then(res => {
                    $scope.model = {}
                    $scope.gejala = {};
                    $.LoadingOverlay('hide');
                })
            } else {
                pengetahuanServices.post($scope.model).then(res => {
                    $scope.model = {};
                    $scope.gejala = {};
                    $.LoadingOverlay('hide');
                })
            }
        })
    }

    $scope.delete = (param) => {
        pesan.dialog('Yakin ingin melanjutkan proses?', "Ya", "Tidak").then(x => {
            $.LoadingOverlay('show');
            pengetahuanServices.deleted(param).then(res => {
                $.LoadingOverlay('hide');
            })
        })
    }
}

function keluhanController($scope, keluhanServices, pesan, gejalaServices) {
    $scope.$emit("SendUp", "Diagnosa Kerusakan");
    $scope.datas = [];
    $scope.model = {};
    $scope.kriteria = true;
    keluhanServices.get().then(res => {
        $scope.datas = res;
    })
    $scope.show = () => {
        $.LoadingOverlay('show');
        gejalaServices.get().then(res => {
            $scope.gejalas = res;
            $("#tambahDiagnosa").modal({
                backdrop: "static"
            });
            $("#tambahDiagnosa").modal("show");
            $.LoadingOverlay('hide');
        })
    }

    $scope.diagnosa = (param) => {
        $.LoadingOverlay('show');
        keluhanServices.post(param.filter(x => x.check)).then(res => {
            $scope.hasil = res.sort(function (a, b) {
                return b.nilai - a.nilai;
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
    $scope.hide = () => {
        $("#tambahDiagnosa").modal("hide");
    }
    $scope.save = () => {
        pesan.dialog('Yakin ingin menyimpan hasil?', "Ya", "Tidak", "info").then(x => {
            $.LoadingOverlay('show');
            keluhanServices.save($scope.hasil[0]).then(res => {
                $scope.gejalas = undefined;
                $scope.hasil = undefined
                $.LoadingOverlay('hide');
                $("#tambahDiagnosa").modal("hide");
            })
        })
    }

    $scope.delete = (param) => {
        pesan.dialog('Yakin ingin melanjutkan proses?', "Ya", "Tidak").then(x => {
            $.LoadingOverlay('show');
            keluhanServices.deleted(param).then(res => {
                $.LoadingOverlay('hide');
            })
        })
    }
}
