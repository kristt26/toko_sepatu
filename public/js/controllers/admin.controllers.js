angular
  .module("adminctrl", [])
  // Admin
  .controller("dashboardController", dashboardController)
  .controller("produkController", produkController)
  .controller("pembelianController", pembelianController)
  .controller("penjualanController", penjualanController)
  .controller("areaController", areaController)
  .controller("tokoController", tokoController)
  .controller("penggunaController", penggunaController)
  .controller("orderController", orderController)
  .controller("laporanPenjualanController", laporanPenjualanController)
  .controller("laporanPembelianController", laporanPembelianController);

function dashboardController($scope, dashboardServices) {
  $scope.$emit("SendUp", "Beranda");
  $scope.datas = {};
  $scope.title = "Beranda";
}

function produkController($scope, produkServices, variantServices, pesan) {
  $scope.$emit("SendUp", "Produk");
  $scope.datas = [];
  $scope.title = "Beranda";
  $scope.model = {};
  $scope.tampil = "produk";

  $scope.setTampilan = async (item, param) => {
    $scope.itemProduk = item;
    variantServices.get(item.id_produk).then((res) => {
      $scope.variant = res;
      $scope.tampil = param;
      console.log(res);
    });
  };

  produkServices.get().then((res) => {
    $scope.datas = res;
  });

  $scope.kembali = () => {
    $scope.tampil = "produk";
    $scope.itemProduk = {};
    $scope.variant = [];
  };

  $scope.save = (param) => {
    if (!param.id_produk) {
      produkServices.post(param).then((res) => {
        pesan.Success("Data berhasil disimpan", "Success", "info");
        $("#modals-default").modal("hide");
      });
    } else {
      produkServices.put(param).then((res) => {
        var data = $scope.datas.find((x) => x.id_produk == param.id_produk);
        if (data) {
          data.nama_produk = param.nama_produk;
          data.harga = param.harga;
          data.keterangan = param.keterangan;
        }
        $("#modals-default").modal("hide");
        pesan.Success("Data berhasil diubah", "Success", "info");
      });
    }
  };

  $scope.edit = (param) => {
    $scope.model = angular.copy(param);
    console.log(param);

    $("#modals-default").modal("show");
  };

  $scope.editVariant = (param) => {
    $scope.model = angular.copy(param);
    $("#modalVariant").modal("show");
  };

  $scope.saveVariant = (param) => {
    if (!param.id_produk) {
      $scope.model.id_produk = $scope.itemProduk.id_produk;
      variantServices.post(param).then((res) => {
        $scope.variant.push(res);
        $("#modalVariant").modal("hide");
        $scope.model = {};
        pesan.success("Data berhasil disimpan", "Success", "info");
      });
    } else {
      variantServices.put(param).then((res) => {
        var data = $scope.variant.find((x) => x.id_variant == param.id_variant);
        if (data) {
          data.nama_variant = param.nama_variant;
          data.harga = param.harga;
          data.stok = param.stok;
        }
        $scope.variant[$scope.variant.indexOf(data)] = data;
        $("#modalVariant").modal("hide");
        $scope.model = {};
        pesan.success("Data berhasil disimpan", "Success", "info");
      });
    }
  };

  $scope.delete = (param) => {
    pesan
      .dialog(
        "Apakah anda yakin ingin menghapus data ini?",
        "Hapus",
        "Tidak",
        "warning"
      )
      .then((res) => {
        if (res) {
          produkServices.deleted(param).then((res) => {
            $scope.datas.splice($scope.datas.indexOf(param), 1);
            pesan.Success("Data berhasil dihapus", "Success", "info");
          });
        }
      });
  };

  $scope.deleteVariant = (param) => {
    variantServices.deleted(param).then((res) => {
      $scope.variant.splice($scope.variant.indexOf(param), 1);
      pesan.Success("Data berhasil dihapus", "Success", "info");
    });
  };
}

function pembelianController($scope, pembelianServices, helperServices, pesan) {
  $scope.$emit("SendUp", "Pembelian");
  $scope.datas = [];

  pembelianServices.get().then((res) => {
    $scope.datas = res;
    console.log(res);
  });
  $scope.edit = (param) => {
    $scope.model = angular.copy(param);
    $scope.model.tanggal_beli = new Date(param.tanggal_pembelian);
    $scope.produk = $scope.datas.produks.find(
      (x) => x.id_produk == param.id_produk
    );
    console.log($scope.produk);
    $scope.variant = $scope.produk.variant.find(
      (x) => x.id_variant == param.id_variant
    );
    // console.log(param);
    $("#modals-default").modal("show");
  };
  $scope.save = (param) => {
    if (!param.id_pembelian) {
      param.tanggal_pembelian = helperServices.dateToString(param.tanggal_beli);
      pembelianServices.post(param).then((res) => {
        $scope.datas.pembelian.push(res);
        $("#modals-default").modal("hide");
        $scope.model = {};
        pesan.Success("Data berhasil disimpan", "Success", "info");
      });
    } else {
      pembelianServices.put(param).then((res) => {
        var data = $scope.datas.pembelian.find(
          (x) => x.id_pembelian == param.id_pembelian
        );
        if (data) {
          data.tanggal_pembelian = param.tanggal_pembelian;
          data.qty = param.qty;
          data.harga_beli = param.harga_beli;
        }
        $("#modals-default").modal("hide");
        pesan.Success("Data berhasil diubah", "Success", "info");
      });
    }
  };

  $scope.delete = (param) => {
    pembelianServices.deleted(param).then((res) => {
      $scope.datas.pembelian.splice($scope.datas.pembelian.indexOf(param), 1);
      pesan.Success("Data berhasil dihapus", "Success", "info");
    });
  };
}

function penjualanController($scope, penjualanServices, helperServices, pesan) {
  $scope.$emit("SendUp", "Penjualan Kasir");
  $scope.datas = [];
  $scope.dataKeranjang = [];
  $scope.dataFilter = [];
  $scope.totalBayar = 0;
  $scope.tampil = "daftar";

  if (localStorage.getItem("datas")) {
    $scope.datas = JSON.parse(localStorage.getItem("datas"));
    $scope.dataKeranjang = JSON.parse(localStorage.getItem("keranjang"));
    $scope.totalBayar = $scope.dataKeranjang.reduce(
      (a, b) => a + b.harga * b.qty,
      0
    );
    $scope.tampil = "bayar";
  } else {
    penjualanServices.get().then((res) => {
      $scope.datas = res;
      $scope.datasPermanent = angular.copy(res);
      // console.log(res);
    });
  }

  $scope.check = (cari, ukuran) => {
    if (cari.length > 1) {
      $scope.dataFilter = $scope.datas.filter((x) =>
        x.nama_produk.toLowerCase().includes(cari.toLowerCase())
      );
      if (ukuran) {
        if ($scope.dataFilter.length > 0) {
          $scope.dataFilter = $scope.dataFilter.filter(
            (x) => x.ukuran == ukuran
          );
        }
      }
    } else {
      $scope.dataFilter = [];
    }
  };

  $scope.keranjang = (param) => {
    var data = $scope.dataKeranjang.find(
      (x) => x.id_variant == param.id_variant
    );
    if (data) {
      data.qty += 1;
      data.oldQty += 1;
      param.stok = param.stok - 1;
    } else {
      var item = angular.copy(param);
      item.qty = 1;
      item.oldQty = 1;
      param.stok = parseInt(param.stok) - 1;
      $scope.dataKeranjang.push(item);
    }
    console.log($scope.dataKeranjang);
    $scope.totalBayar = $scope.dataKeranjang.reduce(
      (a, b) => a + b.harga * b.qty,
      0
    );
  };

  $scope.setJumlah = (param) => {
    var data = $scope.datas.find((x) => x.id_variant == param.id_variant);
    if (data) {
      if (param.qty > 0) {
        if (param.qty > param.oldQty) {
          data.stok = data.stok + param.oldQty - param.qty;
        } else {
          data.stok = data.stok + param.oldQty - param.qty;
        }
        param.oldQty = param.qty;
      } else {
        data.stok = data.stok + param.oldQty - param.qty;
        $scope.dataKeranjang.splice($scope.dataKeranjang.indexOf(data), 1);
        param.stok = parseInt(param.stok) + 1;
      }
    }
    $scope.totalBayar = $scope.dataKeranjang.reduce(
      (a, b) => a + b.harga * b.qty,
      0
    );
  };

  $scope.setTampilan = (item) => {
    localStorage.setItem("datas", JSON.stringify($scope.datas));
    localStorage.setItem("keranjang", JSON.stringify($scope.dataKeranjang));
    $scope.dataFilter = [];
    $scope.cari = "";
    $scope.tampil = item;
  };

  $scope.setKembalian = (param) => {
    if (parseFloat(param) > $scope.totalBayar) {
      $scope.kembalian = parseFloat(param) - $scope.totalBayar;
    } else {
      $scope.kembalian = "0";
    }
  };

  $scope.save = () => {
    penjualanServices.post($scope.dataKeranjang).then((res) => {
      $scope.dataKeranjang = [];
      $scope.totalBayar = 0;
      localStorage.removeItem("datas");
      localStorage.removeItem("keranjang");
      $scope.datas = angular.copy($scope.datasPermanent);
      pesan.Success("Transaksi berhasil", "Success", "info");
      $scope.tampil = "daftar";
    });
  };

  $scope.batal = () => {
    $scope.tampil = "daftar";
    $scope.dataKeranjang = [];
    $scope.totalBayar = 0;
    localStorage.removeItem("datas");
    localStorage.removeItem("keranjang");
    $scope.datas = angular.copy($scope.datasPermanent);
  };

  $scope.delete = (param) => {
    penjualanServices.deleted(param).then((res) => {
      $scope.datas.pembelian.splice($scope.datas.pembelian.indexOf(param), 1);
      pesan.Success("Data berhasil dihapus", "Success", "info");
    });
  };
}

function areaController($scope, areaServices, pesan) {
  $scope.$emit("SendUp", "Service Area");
  $scope.datas = [];
  $scope.title = "Beranda";
  $scope.model = {};
  $scope.tampil = "produk";
  areaServices.get().then((res) => {
    $scope.datas = res;
  });

  $scope.save = () => {
    pesan
      .dialog("Apakah anda yakin ingin menambah data?", "Ya", "Tidak", "info")
      .then((res) => {
        if (!$scope.model.id_area) {
          areaServices.post($scope.model).then((res) => {
            $scope.model = {};
            pesan.Success("Data berhasil disimpan", "Success", "info");
          });
        } else {
          areaServices.put($scope.model).then((res) => {
            $scope.model = {};
            pesan.Success("Data berhasil disimpan", "Success", "info");
          });
        }
      });
  };

  $scope.edit = (param) => {
    $scope.model = angular.copy(param);
  };

  $scope.delete = (param) => {
    pesan
      .dialog(
        "Apakah anda yakin ingin menghapus data ini?",
        "Hapus",
        "Tidak",
        "warning"
      )
      .then((res) => {
        areaServices.deleted(param).then((res) => {
          pesan.Success("Data berhasil dihapus", "Success", "info");
        });
      });
  };
}

function tokoController($scope, tokoServices, pesan, $timeout) {
  $scope.$emit("SendUp", "Profile Toko");
  $scope.banks = [
    "Bank Negara Indonesia (BNI)",
    "Bank Rakyat Indonesia (BRI)",
    "Bank Central Asia (BCA)",
    "Bank Mandiri",
    "Bank Danamon",
    "Bank CIMB Niaga",
    "Bank Permata",
    "Bank Panin",
    "Bank Mega",
    "Bank OCBC NISP",
    "Bank Bukopin",
    "Bank BTPN",
    "Bank Maybank Indonesia",
    "Bank UOB Indonesia",
    "Bank DBS Indonesia",
    "Bank Sinarmas",
    "Bank Syariah Indonesia (hasil merger BRI Syariah, BNI Syariah, Mandiri Syariah)",
    "Bank Muamalat Indonesia",
    "Bank Syariah Bukopin",
    "Bank Mega Syariah",
    "Bank Victoria Syariah",
    "Bank BNI Syariah",
    "Bank BRI Syariah",
    "Bank CIMB Niaga Syariah",
    "Bank DKI",
    "Bank Jatim",
    "Bank Jabar Banten (BJB)",
    "Bank Kalbar",
    "Bank Riau Kepri",
    "Bank Sumsel Babel",
    "Bank Maluku Malut",
    "Bank NTB",
    "Bank NTT",
    "Bank Sulselbar",
    "Bank Papua",
    "Bank Bengkulu",
    "Bank Aceh",
    "Bank Nagari",
    "Bank Lampung",
    "Bank Kaltimtara",
    "Bank DIY",
    "Bank Bali",
    "Bank Banten",
    "Bank Kalsel",
    "Bank Kalteng",
    "Bank Kaltara",
    "Bank Sulteng",
    "Bank Sumbawa",
    "Bank Sumatra Barat",
  ];
  tokoServices.get().then((res) => {
    $scope.model = res;
    console.log(res);
  });

  $scope.$watch(
    "banks",
    function () {
      $("#namaBank").select2({
        width: "100%",
      });
    },
    true
  );

  $scope.showBank = (param) => {
    console.log(param);
  };

  $scope.loading = false;

  $scope.simpan = function () {
    $scope.loading = true;
    if ($scope.formToko.$invalid) {
      return;
    }

    if ($scope.model.id_toko) {
      tokoServices.put($scope.model).then((res) => {
        console.log(res);
        pesan.Success("Data berhasil diubah", "Success", "info");
        $scope.loading = false;
      });
    } else {
      tokoServices.post($scope.model).then((res) => {
        console.log(res);
        $scope.model = res;
        pesan.Success("Data berhasil disimpan", "Success", "info");
        $scope.loading = false;
      });
    }
  };
}

function penggunaController($scope, pesan) {
  $scope.$emit("SendUp", "Daftar Customer");
  $scope.datas = [];
  $scope.title = "Beranda";
  $scope.model = {};
}

function orderController($scope, orderServices, pesan) {
  $scope.$emit("SendUp", "Order Customer");
  $scope.datas = [];
  $scope.title = "Beranda";
  $scope.model = {};
  $scope.tampil = "produk";
  orderServices.get().then((res) => {
    $scope.datas = res;
    console.log(res);
    $scope.filterPending();
    $scope.filterPaid();
    $scope.filterProses();
    $scope.filterTerkirim();
    $scope.filterBatal();
  });

  $scope.filterPending = () => {
    $scope.dataPending = $scope.datas.filter((x) => x.status == "Pending");
  };

  $scope.filterPaid = () => {
    $scope.dataPaid = $scope.datas.filter((x) => x.status == "Paid");
  };

  $scope.filterProses = () => {
    $scope.dataProses = $scope.datas.filter((x) => x.status == "Proses");
  };

  $scope.filterTerkirim = () => {
    $scope.dataTerkirim = $scope.datas.filter((x) => x.status == "Selesai");
  };

  $scope.filterBatal = () => {
    $scope.dataBatal = $scope.datas.filter((x) => x.status == "Batal");
  };

  $scope.save = () => {
    pesan
      .dialog("Apakah anda yakin ingin menambah data?", "Ya", "Tidak", "info")
      .then((res) => {
        if (!$scope.model.id_area) {
          orderServices.post($scope.model).then((res) => {
            $scope.model = {};
            pesan.Success("Data berhasil disimpan", "Success", "info");
          });
        } else {
          orderServices.put($scope.model).then((res) => {
            $scope.model = {};
            pesan.Success("Data berhasil disimpan", "Success", "info");
          });
        }
      });
  };

  $scope.edit = (param) => {
    $scope.model = angular.copy(param);
  };

  $scope.delete = (param) => {
    pesan
      .dialog(
        "Apakah anda yakin ingin menghapus data ini?",
        "Hapus",
        "Tidak",
        "warning"
      )
      .then((res) => {
        orderServices.deleted(param).then((res) => {
          pesan.Success("Data berhasil dihapus", "Success", "info");
        });
      });
  };

  $scope.previewProof = (param) => {
    $scope.model = angular.copy(param);
    $("#proofModal").modal("show");
  };

  $scope.validasiPembayaran = (param, set, data) => {
    if (set == "Pending") {
      if (param == "valid") {
        $scope.model.pembayaran.status_bayar = "Confirmed";
        $scope.model.status = "Paid";
      } else {
        $scope.model.pembayaran.status_bayar = "Failed";
        $scope.model.status = "Batal";
      }
    } else if (set == "Paid" || set == "Proses") {
      $scope.model = data;
      $scope.model.status = param;
    }
    $scope.model.checkUpdate = set;

    var item = $scope.datas.find((x) => x.id_order == $scope.model.id_order);
    if (item) {
      item.status = $scope.model.status;
      item.pembayaran.status_bayar = $scope.model.pembayaran.status_bayar;
    }
    orderServices.put($scope.model).then((res) => {
      pesan.Success(res.message);
      $scope.filterPaid();
      $scope.filterProses();
      $scope.filterTerkirim();
      $scope.filterBatal();
      $scope.model = {};
      $("#proofModal").modal("hide");
    });
  };
}

function laporanPenjualanController(
  $scope,
  pesan,
  $timeout,
  helperServices,
  $http
) {
  $scope.$emit("SendUp", "Laporan Penjualan");
  $scope.filter = {
    tipePeriode: "range", // default tipe periode
    tanggal_range: "",
    dari_tanggal: "",
    sampai_tanggal: "",
    bulan_tahun: "",
    tahun: "",
    status: "",
    metode_bayar: "",
  };

  $scope.laporan = [];

  // Reset semua filter tanggal saat tipe periode berganti
  $scope.resetTanggal = function () {
    $scope.filter.tanggal_range = "";
    $scope.filter.dari_tanggal = "";
    $scope.filter.sampai_tanggal = "";
    $scope.filter.bulan_tahun = "";
    $scope.filter.tahun = "";
    $scope.laporan = [];

    if ($scope.filter.tipePeriode === "range") {
      $timeout(function () {
        $scope.initDateRangePicker();
      }, 0);
    }
  };

  $scope.initDateRangePicker = () => {
    var picker = $("#tanggalRange").data("daterangepicker");
    if (picker) {
      picker.remove();
      $("#tanggalRange").off(); // hapus event sebelumnya
    }

    $("#tanggalRange").daterangepicker(
      {
        autoUpdateInput: false, // supaya kosong di awal
        locale: {
          format: "YYYY-MM-DD",
          separator: " s.d. ",
          applyLabel: "Terapkan",
          cancelLabel: "Batal",
          fromLabel: "Dari",
          toLabel: "Sampai",
          customRangeLabel: "Kustom",
          daysOfWeek: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
          monthNames: [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember",
          ],
          firstDay: 1,
        },
      },
      function (start, end) {
        $scope.filter.dari_tanggal = start.format("YYYY-MM-DD");
        $scope.filter.sampai_tanggal = end.format("YYYY-MM-DD");
        $scope.filter.tanggal_range =
          start.format("YYYY-MM-DD") + " s.d. " + end.format("YYYY-MM-DD");

        $("#tanggalRange").val($scope.filter.tanggal_range);
        $scope.$apply();
      }
    );

    $("#tanggalRange").on("cancel.daterangepicker", function (ev, picker) {
      $(this).val("");
      $scope.filter.tanggal_range = "";
      $scope.filter.dari_tanggal = "";
      $scope.filter.sampai_tanggal = "";
      $scope.$apply();
    });
  };

  // Inisialisasi daterangepicker hanya untuk tipePeriode == 'range'
  $timeout(function () {
    if ($scope.filter.tipePeriode === "range") {
      $scope.initDateRangePicker();
    }
  }, 100);

  $scope.filterLaporan = function () {
    let params = {
      status: $scope.filter.status || "",
      metode_bayar: $scope.filter.metode_bayar || "",
    };

    if ($scope.filter.tipePeriode === "range") {
      if (
        !$scope.filter.tanggal_range ||
        $scope.filter.tanggal_range.indexOf(" s.d. ") === -1
      ) {
        alert("Pilih rentang tanggal terlebih dahulu!");
        return;
      }
      var range = $scope.filter.tanggal_range.split(" s.d. ");
      $scope.filter.dari_tanggal = range[0];
      $scope.filter.sampai_tanggal = range[1];
    } else if ($scope.filter.tipePeriode === "bulan") {
      if (!$scope.filter.bulan_tahun) {
        pesan.error("Pilih bulan terlebih dahulu!");
        return;
      }
      // bulan_tahun format: yyyy-MM (input month)
      // let [tahun, bulan] = String($scope.filter.bulan_tahun).split("-");
      let date = $scope.filter.bulan_tahun;
      let tahun = date.getFullYear();
      let bulan = String(date.getMonth() + 1).padStart(2, "0");

      $scope.filter.dari_tanggal = `${tahun}-${bulan}-01`;
      $scope.filter.sampai_tanggal = new Date(tahun, bulan, 0)
        .toISOString()
        .split("T")[0]; // akhir bulan
      // $scope.filter.bulan = bulan;
      // $scope.filter.tahun = tahun;
    } else if ($scope.filter.tipePeriode === "tahun") {
      if (
        !$scope.filter.tahun ||
        isNaN($scope.filter.tahun) ||
        $scope.filter.tahun < 2000 ||
        $scope.filter.tahun > 2100
      ) {
        pesan.error("Pilih tahun yang valid!");
        return;
      }
      let tahun = $scope.filter.tahun;
      $scope.filter.dari_tanggal = `${tahun}-01-01`;
      $scope.filter.sampai_tanggal = `${tahun}-12-31`;
    }

    $http({
      method: "POST",
      url: helperServices.url + "admin/laporan/penjualan/data",
      data: $scope.filter,
    }).then(
      function (response) {
        $scope.laporan = response.data;
      },
      function (error) {
        alert("Gagal mengambil data laporan");
        console.error(error);
      }
    );
  };

  $scope.downloadExcel = function () {
    let params = {
      status: $scope.filter.status || "",
      metode_bayar: $scope.filter.metode_bayar || "",
    };

    if ($scope.filter.tipePeriode === "range") {
      if (
        !$scope.filter.tanggal_range ||
        $scope.filter.tanggal_range.indexOf(" s.d. ") === -1
      ) {
        pesan.error("Pilih rentang tanggal terlebih dahulu!");
        return;
      }
      var range = $scope.filter.tanggal_range.split(" s.d. ");
      params.dari_tanggal = range[0];
      params.sampai_tanggal = range[1];
    } else if ($scope.filter.tipePeriode === "bulan") {
      if (!$scope.filter.bulan_tahun) {
        pesan.error("Pilih bulan terlebih dahulu!");
        return;
      }
      // bulan_tahun format: yyyy-MM (input month)
      // let [tahun, bulan] = String($scope.filter.bulan_tahun).split("-");
      let date = $scope.filter.bulan_tahun;
      let tahun = date.getFullYear();
      let bulan = String(date.getMonth() + 1).padStart(2, "0");

      params.dari_tanggal = `${tahun}-${bulan}-01`;
      params.sampai_tanggal = new Date(tahun, bulan, 0)
        .toISOString()
        .split("T")[0]; // akhir bulan
      // $scope.filter.bulan = bulan;
      // $scope.filter.tahun = tahun;
    } else if ($scope.filter.tipePeriode === "tahun") {
      if (
        !$scope.filter.tahun ||
        isNaN($scope.filter.tahun) ||
        $scope.filter.tahun < 2000 ||
        $scope.filter.tahun > 2100
      ) {
        pesan.error("Pilih tahun yang valid!");
        return;
      }
      let tahun = $scope.filter.tahun;
      params.dari_tanggal = `${tahun}-01-01`;
      params.sampai_tanggal = `${tahun}-12-31`;
    }

    var queryString = new URLSearchParams(params).toString();
    window.open("/admin/laporan/penjualan/excel?" + queryString, "_blank");
  };

  $scope.cetak = function () {
    let params = {
      status: $scope.filter.status || "",
      metode_bayar: $scope.filter.metode_bayar || "",
    };

    if ($scope.filter.tipePeriode === "range") {
      if (
        !$scope.filter.tanggal_range ||
        $scope.filter.tanggal_range.indexOf(" s.d. ") === -1
      ) {
        pesan.error("Pilih rentang tanggal terlebih dahulu!");
        return;
      }
      var range = $scope.filter.tanggal_range.split(" s.d. ");
      params.dari_tanggal = range[0];
      params.sampai_tanggal = range[1];
    } else if ($scope.filter.tipePeriode === "bulan") {
      if (!$scope.filter.bulan_tahun) {
        pesan.error("Pilih bulan terlebih dahulu!");
        return;
      }
      // bulan_tahun format: yyyy-MM (input month)
      // let [tahun, bulan] = String($scope.filter.bulan_tahun).split("-");
      let date = $scope.filter.bulan_tahun;
      let tahun = date.getFullYear();
      let bulan = String(date.getMonth() + 1).padStart(2, "0");

      params.dari_tanggal = `${tahun}-${bulan}-01`;
      params.sampai_tanggal = new Date(tahun, bulan, 0)
        .toISOString()
        .split("T")[0]; // akhir bulan
      // $scope.filter.bulan = bulan;
      // $scope.filter.tahun = tahun;
    } else if ($scope.filter.tipePeriode === "tahun") {
      if (
        !$scope.filter.tahun ||
        isNaN($scope.filter.tahun) ||
        $scope.filter.tahun < 2000 ||
        $scope.filter.tahun > 2100
      ) {
        pesan.error("Pilih tahun yang valid!");
        return;
      }
      let tahun = $scope.filter.tahun;
      params.dari_tanggal = `${tahun}-01-01`;
      params.sampai_tanggal = `${tahun}-12-31`;
    }

    var queryString = new URLSearchParams(params).toString();
    window.open("/admin/laporan/penjualan/print?" + queryString, "_blank");
  };
}

function laporanPembelianController(
  $scope,
  pesan,
  $timeout,
  helperServices,
  $http
) {
  $scope.$emit("SendUp", "Laporan Pembelian");
  $scope.filter = {
    tipePeriode: "range",
    tanggal_range: "",
    dari_tanggal: "",
    sampai_tanggal: "",
    bulan_tahun: "",
    tahun: "",
  };

  $scope.laporan = [];

  $scope.resetTanggal = function () {
    $scope.filter.tanggal_range = "";
    $scope.filter.dari_tanggal = "";
    $scope.filter.sampai_tanggal = "";
    $scope.filter.bulan_tahun = "";
    $scope.filter.tahun = "";
    $scope.laporan = [];

    if ($scope.filter.tipePeriode === "range") {
      $timeout(function () {
        $scope.initDateRangePicker();
      }, 0);
    }
  };

  $scope.initDateRangePicker = () => {
    var picker = $("#tanggalRange").data("daterangepicker");
    if (picker) {
      picker.remove();
      $("#tanggalRange").off();
    }

    $("#tanggalRange").daterangepicker(
      {
        autoUpdateInput: false,
        locale: {
          format: "YYYY-MM-DD",
          separator: " s.d. ",
          applyLabel: "Terapkan",
          cancelLabel: "Batal",
          fromLabel: "Dari",
          toLabel: "Sampai",
          customRangeLabel: "Kustom",
          daysOfWeek: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
          monthNames: [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember",
          ],
          firstDay: 1,
        },
      },
      function (start, end) {
        $scope.filter.dari_tanggal = start.format("YYYY-MM-DD");
        $scope.filter.sampai_tanggal = end.format("YYYY-MM-DD");
        $scope.filter.tanggal_range =
          start.format("YYYY-MM-DD") + " s.d. " + end.format("YYYY-MM-DD");

        $("#tanggalRange").val($scope.filter.tanggal_range);

        // Tambahkan ini supaya filter langsung jalan saat tanggal dipilih
        $scope.filterLaporan();

        // Jangan lupa $apply agar Angular tahu ada perubahan
        $scope.$apply();
      }
    );

    $("#tanggalRange").on("cancel.daterangepicker", function () {
      $(this).val("");
      $scope.filter.tanggal_range = "";
      $scope.filter.dari_tanggal = "";
      $scope.filter.sampai_tanggal = "";
      $scope.$apply();
    });
  };

  $timeout(function () {
    if ($scope.filter.tipePeriode === "range") {
      $scope.initDateRangePicker();
    }
  }, 100);

  $scope.filterLaporan = function () {
    if ($scope.filter.tipePeriode === "range") {
      if (
        !$scope.filter.tanggal_range ||
        $scope.filter.tanggal_range.indexOf(" s.d. ") === -1
      ) {
        alert("Pilih rentang tanggal terlebih dahulu!");
        return;
      }
      var range = $scope.filter.tanggal_range.split(" s.d. ");
      $scope.filter.dari_tanggal = range[0];
      $scope.filter.sampai_tanggal = range[1];
    } else if ($scope.filter.tipePeriode === "bulan") {
      if (!$scope.filter.bulan_tahun) {
        pesan.error("Pilih bulan terlebih dahulu!");
        return;
      }
      let date = $scope.filter.bulan_tahun;
      let tahun = date.getFullYear();
      let bulan = String(date.getMonth() + 1).padStart(2, "0");

      $scope.filter.dari_tanggal = `${tahun}-${bulan}-01`;
      $scope.filter.sampai_tanggal = new Date(tahun, bulan, 0)
        .toISOString()
        .split("T")[0];
    } else if ($scope.filter.tipePeriode === "tahun") {
      if (
        !$scope.filter.tahun ||
        isNaN($scope.filter.tahun) ||
        $scope.filter.tahun < 2000 ||
        $scope.filter.tahun > 2100
      ) {
        pesan.error("Pilih tahun yang valid!");
        return;
      }
      let tahun = $scope.filter.tahun;
      $scope.filter.dari_tanggal = `${tahun}-01-01`;
      $scope.filter.sampai_tanggal = `${tahun}-12-31`;
    }

    $http({
      method: "POST",
      url: helperServices.url + "admin/laporan/pembelian/data",
      data: $scope.filter,
    }).then(
      function (response) {
        $scope.laporan = response.data;
      },
      function (error) {
        alert("Gagal mengambil data laporan");
        console.error(error);
      }
    );
  };

  $scope.downloadExcel = function () {
    let params = {};

    if ($scope.filter.tipePeriode === "range") {
      if (
        !$scope.filter.tanggal_range ||
        $scope.filter.tanggal_range.indexOf(" s.d. ") === -1
      ) {
        pesan.error("Pilih rentang tanggal terlebih dahulu!");
        return;
      }
      var range = $scope.filter.tanggal_range.split(" s.d. ");
      params.dari_tanggal = range[0];
      params.sampai_tanggal = range[1];
    } else if ($scope.filter.tipePeriode === "bulan") {
      if (!$scope.filter.bulan_tahun) {
        pesan.error("Pilih bulan terlebih dahulu!");
        return;
      }
      var d = new Date($scope.filter.bulan_tahun);
      var tahun = d.getFullYear();
      var bulan = ("0" + (d.getMonth() + 1)).slice(-2);
      params.dari_tanggal = `${tahun}-${bulan}-01`;
      params.sampai_tanggal = new Date(tahun, bulan, 0)
        .toISOString()
        .split("T")[0];
    } else if ($scope.filter.tipePeriode === "tahun") {
      if (!$scope.filter.tahun) {
        pesan.error("Pilih tahun terlebih dahulu!");
        return;
      }
      params.dari_tanggal = `${$scope.filter.tahun}-01-01`;
      params.sampai_tanggal = `${$scope.filter.tahun}-12-31`;
    }

    var query = Object.keys(params)
      .map((k) => encodeURIComponent(k) + "=" + encodeURIComponent(params[k]))
      .join("&");

    window.open(
      helperServices.url + "admin/laporan/pembelian/excel?" + query,
      "_blank"
    );
  };

  $scope.cetak = function () {
    // Sama seperti downloadExcel, tapi arahkan ke halaman cetak khusus
    let params = {};

    if ($scope.filter.tipePeriode === "range") {
      if (
        !$scope.filter.tanggal_range ||
        $scope.filter.tanggal_range.indexOf(" s.d. ") === -1
      ) {
        pesan.error("Pilih rentang tanggal terlebih dahulu!");
        return;
      }
      var range = $scope.filter.tanggal_range.split(" s.d. ");
      params.dari_tanggal = range[0];
      params.sampai_tanggal = range[1];
    } else if ($scope.filter.tipePeriode === "bulan") {
      if (!$scope.filter.bulan_tahun) {
        pesan.error("Pilih bulan terlebih dahulu!");
        return;
      }
      var d = new Date($scope.filter.bulan_tahun);
      var tahun = d.getFullYear();
      var bulan = ("0" + (d.getMonth() + 1)).slice(-2);
      params.dari_tanggal = `${tahun}-${bulan}-01`;
      params.sampai_tanggal = new Date(tahun, bulan, 0)
        .toISOString()
        .split("T")[0];
    } else if ($scope.filter.tipePeriode === "tahun") {
      if (!$scope.filter.tahun) {
        pesan.error("Pilih tahun terlebih dahulu!");
        return;
      }
      params.dari_tanggal = `${$scope.filter.tahun}-01-01`;
      params.sampai_tanggal = `${$scope.filter.tahun}-12-31`;
    }

    var query = Object.keys(params)
      .map((k) => encodeURIComponent(k) + "=" + encodeURIComponent(params[k]))
      .join("&");

    window.open(
      helperServices.url + "admin/laporan/pembelian/cetak?" + query,
      "_blank"
    );
  };
}
