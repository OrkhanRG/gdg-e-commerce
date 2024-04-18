<div class="top-bar bg-black">
    <div class="container">
        <div class="login float-end ">
            <ul class="login-list">
                <li><a href="{{ route('login') }}" class="text-white">Daxil Ol</a></li>
                <li><a href="{{ route('register') }}" class="text-white">Qeydiyyat</a></li>
                <li><a href="" class="text-white">Sifarişlərim</a></li>
                <li><a href="" class="text-white">Səbətim</a></li>
                <li class="dropdown user-basket position-relative">
                    <a href="javascript:void(0)" class="dropdown-toggle position-relative"
                       role="button"
                       data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <i class="bi bi-cart zoom text-white fs-4"></i>
                        <span class="item-count bg-orange text-black">13</span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="row overflow-custom">
                            <div class="col-12">
                                <div class="card border-0">
                                    <div class="row">
                                        <div class="col-4">
                                            <img src="{{ asset('assets/images/shopping.webp') }}" alt="" class="img-fluid rounded-start">
                                        </div>
                                        <div class="col-8">
                                            <div class="card-body">
                                                <h5 class="card-title">Ürün Başlığı</h5>
                                                <p class="card-text">Fiyat: 10 TL</p>
                                                <p class="card-text">Adet: 1</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <hr class="my-4">
                            </div>


                            <div class="col-12">
                                <div class="card border-0">
                                    <div class="row">
                                        <div class="col-4">
                                            <img src="{{ asset('assets/images/shopping.webp') }}" alt="" class="img-fluid rounded-start">
                                        </div>
                                        <div class="col-8">
                                            <div class="card-body">
                                                <h5 class="card-title">Ürün Başlığı</h5>
                                                <p class="card-text">Fiyat: 10 TL</p>
                                                <p class="card-text">Adet: 1</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <hr class="my-4">
                            </div>


                            <div class="col-12">
                                <div class="card border-0">
                                    <div class="row">
                                        <div class="col-4">
                                            <img src="{{ asset('assets/images/shopping.webp') }}" alt="" class="img-fluid rounded-start">
                                        </div>
                                        <div class="col-8">
                                            <div class="card-body">
                                                <h5 class="card-title">Ürün Başlığı</h5>
                                                <p class="card-text">Fiyat: 10 TL</p>
                                                <p class="card-text">Adet: 1</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <hr class="my-4">
                            </div>
                        </div>
                        <div class="row total-price">
                            <div class="col-12">
                                <hr class="my-4">
                            </div>

                            <div class="col-12">
                                <h5 class="text-center">
                                    <span>Toplam:</span>
                                    <span>250.00 TL</span>
                                </h5>
                            </div>

                            <div class="col-12 basket-buttons">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="" class="btn btn-outline-warning w-100">Sepet</a>
                                    </div>

                                    <div class="col-6">
                                        <a href="" class="btn btn-outline-success w-100">Ödeme</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>