angular
  .module("infoctrl", [])
  // Admin
  .controller("dashboardController", dashboardController)
  .controller("detailController", detailController)
  .controller("checkoutController", checkoutController)
  .controller("profileController", profileController)
  .controller("detailPesananController", detailPesananController)
  .controller("produkController", produkController);

function dashboardController($scope, dashboardServices) {
  $scope.$emit("SendUp", "Beranda");
  $scope.datas = [];
  $scope.title = "Beranda";
  dashboardServices.get().then(function (response) {
    $scope.datas = response;
    console.log(response);
  });
}

function detailController(
  $scope,
  dashboardServices,
  pesan,
  AuthService,
  helperServices,
  $sce,
  $http // Tambahkan $http
) {
  moment.locale('id');
  $scope.datas = {};
  $scope.selectedSize = null;
  $scope.selectedColor = null;
  $scope.quantity = 1;
  $scope.totalStock = 0;

  const productId = window.location.pathname.split("/").pop();
  console.log(productId);

  dashboardServices.getItem(productId).then(function (response) {
    $scope.datas = response;
    $scope.datas.keterangan = $sce.trustAsHtml($scope.datas.keterangan);
    console.log(response);
    $scope.loadReviews(); // panggil setelah data produk tersedia
  });

  $scope.selectSize = function (size, color) {
    $scope.selectedSize = size;
    $scope.itemVariant = $scope.datas.variant.find(
      (x) => x.ukuran == size && x.warna == color
    );
    $scope.totalStock = $scope.itemVariant.stok;
  };

  $scope.selectColor = function (color, size) {
    $scope.selectedColor = color;
    $scope.itemVariant = $scope.datas.variant.find(
      (x) => x.ukuran == size && x.warna == color
    );
    $scope.totalStock = $scope.itemVariant.stok;
  };

  $scope.addToCart = async function () {
    let user = localStorage.getItem("user");

    if (!user) {
      try {
        const res = await AuthService.userIsLogin();
        localStorage.setItem("user", JSON.stringify(res));
      } catch (err) {
        pesan.error("Gagal memverifikasi login.");
        return;
      }
    }

    if (!$scope.selectedSize || !$scope.selectedColor) {
      pesan.error("Silakan pilih ukuran dan warna terlebih dahulu.");
      return;
    }

    if ($scope.quantity > $scope.totalStock) {
      pesan.error("Jumlah melebihi stok yang tersedia.");
      return;
    }

    const item = angular.copy($scope.itemVariant);
    item.qty = $scope.quantity;

    try {
      const response = await dashboardServices.addToCart(item);
      $scope.$emit("setKerangjang", item);
      pesan.Success(response.message);
    } catch (error) {
      pesan.error("Gagal menambahkan ke keranjang.");
    }
  };

  $scope.checkoutNow = async function () {
    await $scope.addToCart();
    document.location.href = helperServices.url + "checkout";
  };

  // ---------- Review Handling ----------
  $scope.reviews = [];
  $scope.newReview = {
    rating: 0,
    komentar: "",
  };
  $scope.replyKomentar = {};
  $scope.replyFormVisible = {};

  $scope.submitReview = function () {
    if (!$scope.newReview.rating || !$scope.newReview.komentar) {
      pesan.dialog("Silakan isi rating dan komentar terlebih dahulu.", 'Ya', 'Tidak', 'warning').then(res=>{
        return;
      });
    }

    const data = {
      id_produk: $scope.datas.id_produk,
      rating: $scope.newReview.rating,
      komentar: $scope.newReview.komentar,
      id_parent: null,
    };

    $http.post("/api/review", data).then(() => {
      $scope.newReview = { rating: 0, komentar: "" };
      $scope.loadReviews();
      pesan.Success("Review berhasil dikirim.");
    });
  };

  $scope.submitReply = function (parentId) {
    if (!$scope.replyKomentar[parentId]) {
      pesan.Warning("Balasan tidak boleh kosong.");
      return;
    }

    const data = {
      id_produk: $scope.datas.id_produk,
      komentar: $scope.replyKomentar[parentId],
      id_parent: parentId,
    };

    $http.post("/api/review", data).then(() => {
      $scope.replyKomentar[parentId] = "";
      $scope.replyFormVisible[parentId] = false;
      $scope.loadReviews();
      pesan.Success("Balasan dikirim.");
    });
  };

  $scope.toggleReplyForm = function (id) {
    $scope.replyFormVisible[id] = !$scope.replyFormVisible[id];
  };

  $scope.setRating = function (rate) {
    $scope.newReview.rating = rate;
  };

  $scope.loadReviews = function () {
    if (!$scope.datas.id_produk) return;
    $http.get("/api/review/" + $scope.datas.id_produk).then((res) => {
      $scope.reviews = res.data;
      console.log($scope.reviews);
      
    });
  };
}

function checkoutController($scope, dashboardServices, helperServices) {
  $scope.datas = [];
  $scope.title = "Beranda";
  $scope.model = {};
  $scope.tampil = "checkout";
  dashboardServices.getCart().then(function (response) {
    $scope.datas = response.cart.map((item) => {
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
      .filter((item) => item.selected)
      .reduce((total, item) => total + item.qty * item.harga, 0);
  };

  // Update biaya pengiriman berdasarkan area yang dipilih
  $scope.updateShippingCost = function () {
    const selectedArea = $scope.areas.find(
      (area) => area.id_area === $scope.model.area
    );
    $scope.model.shippingCost = selectedArea
      ? parseFloat(selectedArea.harga_kirim)
      : 0;
  };

  // Proses checkout
  $scope.processCheckout = function () {
    var data = {
      item: $scope.datas.filter((x) => x.selected),
      customer: $scope.model,
    };
    data.customer.totalItem = $scope.calculateTotal();
    dashboardServices.checkout(data).then((res) => {
      document.location.href =
        helperServices.url + "/detail_pesanan/" + res.id_order;
    });
  };
}

function profileController($scope, profileServices, helperServices) {
  $scope.datas = [];
  $scope.title = "Beranda";
  $scope.model = {};
  $scope.tampil = "checkout";
  profileServices.get().then((res) => {
    $scope.datas = res;
    $scope.model = $scope.datas.profile;
    console.log(res);
  });

  $scope.detailPesanan = (param) => {
    document.location.href =
      helperServices.url + "/detail_pesanan/" + param.id_order;
  };
}

function detailPesananController(
  $scope,
  dashboardServices,
  helperServices,
  pesan
) {
  $scope.datas = [];
  $scope.title = "Beranda";
  $scope.model = {};
  $scope.tampil = "checkout";
  dashboardServices
    .getDetailPesanan(window.location.pathname.split("/").pop())
    .then((res) => {
      $scope.datas = res;
      console.log(res);
    });

  $scope.detailPesanan = (param) => {
    document.location.href =
      helperServices.url + "/detail_pesanan/" + param.id_order;
  };

  $scope.convert = (param) => {
    return parseFloat(param);
  };

  $scope.copyRek = (param) => {
    navigator.clipboard.writeText(param);
    pesan.Success("Data disalin!");
  };

  $scope.uploadProof = () => {
    $scope.model.id_pembayaran = $scope.datas.order.pembayaran.id_pembayaran;
    var data = angular.copy($scope.model);
    data.tanggal_bayar = helperServices.dateTimeToString(
      $scope.model.tanggal_bayar
    );
    console.log(data);

    dashboardServices.uploadProof(data).then((res) => {
      setTimeout(() => {
        document.location.href = helperServices.url;
      }, 1000);
    });
  };
}

// function detailPesananController(
//   $scope,
//   detailPesananServices,
//   helperServices
// ) {
//   $scope.datas = [];
//   $scope.title = "Beranda";
//   $scope.model = {};
//   $scope.tampil = "checkout";
//   detailPesananServices
//     .get(window.location.pathname.split("/").pop())
//     .then((res) => {
//       $scope.datas = res;
//       console.log(res);
//     });

//   $scope.detailPesanan = (param) => {
//     document.location.href =
//       helperServices.url + "/detail_pesanan/" + param.id_order;
//   };
// }

function produkController($scope, dashboardServices, helperServices) {
  $scope.datas = [];
  $scope.title = "Beranda";
  $scope.model = {};
  $scope.tampil = "checkout";
  dashboardServices.readProduk().then((res) => {
    $scope.datas = res;
    console.log(res);
  });

  $scope.descripsi = (param) => {
    $scope.model = param;
    $("#modalProduk1").modal("show");
  };
}
