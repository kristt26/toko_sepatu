angular
  .module("infoctrl", [])
  // Admin
  .controller("dashboardController", dashboardController)
  .controller("detailController", detailController)
  .controller("checkoutController", checkoutController)
  .controller("profileController", profileController)
  .controller("detailPesananController", detailPesananController)
  ;

function dashboardController($scope, dashboardServices) {
  $scope.$emit("SendUp", "Beranda");
  $scope.datas = [];
  $scope.title = "Beranda";
  dashboardServices.get().then(function (response) {
    $scope.datas = response;
    console.log(response);
  });
}

function detailController($scope, dashboardServices, pesan) {
  // $scope.$emit("SendUp", "Beranda");
  $scope.datas = {};
  $scope.selectedSize = null;
  $scope.selectedColor = null;
  $scope.quantity = 1; // Default kuantitas
  $scope.totalStock = 0; // Total stok

  const productId = window.location.pathname.split("/").pop();
  console.log(productId);
  dashboardServices.getItem(productId).then(function (response) {
    $scope.datas = response;
    console.log(response);
  });
  $scope.selectSize = function (size, color) {
    $scope.selectedSize = size;
    $scope.itemVariant = $scope.datas.variant.find(
      (x) => x.ukuran == size && x.warna == color
    );
    $scope.totalStock = $scope.itemVariant.stok;
    console.log($scope.totalStock);
  };

  // Fungsi untuk memilih warna
  $scope.selectColor = function (color, size) {
    $scope.selectedColor = color;
    $scope.itemVariant = $scope.datas.variant.find(
      (x) => x.ukuran == size && x.warna == color
    );
    $scope.totalStock = $scope.itemVariant.stok;
    console.log($scope.itemVariant);
  };

  $scope.addToCart = function () {
    if (!$scope.selectedSize || !$scope.selectedColor) {
      pesan.error("Silakan pilih ukuran dan warna terlebih dahulu.");
      return;
    }
    if ($scope.quantity > $scope.totalStock) {
      pesan.error("Jumlah melebihi stok yang tersedia.");
      return;
    }
    var item = angular.copy($scope.itemVariant);
    item.qty = $scope.quantity;
    dashboardServices.addToCart(item).then(function (response) {
      $scope.$emit("setKerangjang", item);
      pesan.Success(response.message);
    });
  };

  // Fungsi untuk checkout langsung
  $scope.checkoutNow = function () {
    if (!$scope.selectedSize || !$scope.selectedColor) {
      pesan.error("Silakan pilih ukuran dan warna terlebih dahulu.");
      return;
    }
    window.location.href =
      "/checkout?produk=" +
      $scope.datas.id_produk +
      "&ukuran=" +
      $scope.selectedSize +
      "&warna=" +
      $scope.selectedColor +
      "&qty=" +
      $scope.quantity;
  };
}

function checkoutController($scope, dashboardServices, helperServices) {
  $scope.datas = [];
  $scope.title = "Beranda";
  $scope.model ={};
  $scope.tampil = "checkout";
  dashboardServices.getCart().then(function (response) {
    $scope.datas = response.cart.map(item => {
      item.selected = true; // Default semua item terpilih
      return item;
    });
    $scope.areas = response.area;
    console.log(response);
  });

  // $scope.areas = [
  //   { name: 'Jakarta', cost: 20000 },
  //   { name: 'Bandung', cost: 15000 },
  //   { name: 'Surabaya', cost: 25000 },
  //   { name: 'Yogyakarta', cost: 18000 }
  // ];
  $scope.model.shippingCost = 0;

  $scope.calculateTotal = function () {
    return $scope.datas
      .filter(item => item.selected)
      .reduce((total, item) => total + (item.qty * item.harga), 0);
  };

  // Update biaya pengiriman berdasarkan area yang dipilih
  $scope.updateShippingCost = function () {
    const selectedArea = $scope.areas.find(area => area.id_area === $scope.model.area);
    $scope.model.shippingCost = selectedArea ? parseFloat(selectedArea.harga_kirim) : 0;
  };

  // Proses checkout
  $scope.processCheckout = function () {
    var data = {item: $scope.datas.filter(x=>x.selected), customer: $scope.model}
    data.customer.totalItem = $scope.calculateTotal();
    dashboardServices.checkout(data).then(res =>{
      document.location.href = helperServices.url + "detail_pesanan/" + res.id_order;
    })
  };
}

function profileController($scope, profileServices, helperServices) {
  $scope.datas = [];
  $scope.title = "Beranda";
  $scope.model ={};
  $scope.tampil = "checkout";
  profileServices.get().then(res=>{
    $scope.datas = res;
    console.log(res);
  })

  $scope.detailPesanan = (param)=>{
    document.location.href = helperServices.url + "/detail_pesanan/" + param.id_order;
  }
}

function detailPesananController($scope, detailPesananServices, helperServices) {
  $scope.datas = [];
  $scope.title = "Beranda";
  $scope.model ={};
  $scope.tampil = "checkout";
  detailPesananServices.get(window.location.pathname.split("/").pop()).then(res=>{
    $scope.datas = res;
    console.log(res);
  })

  $scope.detailPesanan = (param)=>{
    document.location.href = helperServices.url + "/detail_pesanan/" + param.id_order;
  }
}
