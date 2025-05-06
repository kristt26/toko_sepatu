angular
  .module("adminctrl", [])
  // Admin
  .controller("dashboardController", dashboardController)
  .controller("produkController", produkController)
  .controller("pembelianController", pembelianController)
  .controller("penjualanController", penjualanController)
  .controller("areaController", areaController)
  .controller("tokoController", tokoController)
  ;

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
    pesan.dialog("Apakah anda yakin ingin menambah data?", "Ya", "Tidak", "info").then((res) => {
      if (!$scope.model.id_area) {
        areaServices.post($scope.model).then((res) => {
          $scope.model = {};
          pesan.Success("Data berhasil disimpan", "Success", "info");
        })
      } else {
        areaServices.put($scope.model).then((res) => {
          $scope.model = {};
          pesan.Success("Data berhasil disimpan", "Success", "info");
        })
      }
    })
  }

  $scope.edit = (param) => {
    $scope.model = angular.copy(param);
  }

  $scope.delete = (param) => {
    pesan.dialog("Apakah anda yakin ingin menghapus data ini?", "Hapus", "Tidak", "warning").then((res) => {
      areaServices.deleted(param).then((res) => {
        pesan.Success("Data berhasil dihapus", "Success", "info");
      })
    })
  }
}

function tokoController($scope, tokoServices, pesan, $timeout) {
  $scope.$emit("SendUp", "Profile Toko");
  tokoServices.get().then((res) => {
    $scope.model = res;
    console.log(res);
    
  })


  $scope.loading = false;

  $scope.simpan = function () {
    $scope.loading = true;
    if ($scope.formToko.$invalid) {
      return;
    }
    
    if($scope.model.id_toko){
      tokoServices.put($scope.model).then((res) => {
        console.log(res);
        pesan.Success("Data berhasil diubah", "Success", "info");
        $scope.loading = false;
      });
    }else{
      tokoServices.post($scope.model).then((res) => {
        console.log(res);
        $scope.model = res;
        pesan.Success("Data berhasil disimpan", "Success", "info");
        $scope.loading = false;
      });
    }
  };
}
