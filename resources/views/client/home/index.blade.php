@extends('client.layouts.default')

@section('content')
    <style>
    html {
        font-size: 62.5%;
        /* 1.6rem = 16px */
        line-height: 1.6rem;
        font-family: "Roboto", sans-serif;
        box-sizing: border-box;
    }

    </style>

    <!-- SlideShow -->
    <div id="demo" class="carousel slide" data-ride="carousel">

        <!-- Indicators -->
        <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <li data-target="#demo" data-slide-to="1"></li>
            <li data-target="#demo" data-slide-to="2"></li>
        </ul>

        <!-- The slideshow -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./assetsHome/img/slider_1.png" alt="Los Angeles" width="1100" height="500">
            </div>
            <div class="carousel-item">
                <img src="./assetsHome/img/slider_2.png" alt="Chicago" width="1100" height="500">
            </div>
        </div>

        <!-- Left and right controls -->
        <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>

    <!-- section -->
    <section class="section">
        <div class="grid">
            <h2 class="cate">Danh mục sản phẩm</h2>
            <ul class="category">
                <li class="items_cate">
                    <a href="#" class="link_items-cate">
                        <img src="./assetsHome/img/season_coll_1_img.png" alt="">
                        <p>Mountain bike <br> <span>19 sản phẩm</span></p>
                    </a>
                </li>
                <li class="items_cate">
                    <a href="#" class="link_items-cate">
                        <img src="./assetsHome/img/season_coll_2_img.png" alt="">
                        <p>Mountain bike <br> <span>19 sản phẩm</span></p>
                    </a>
                </li>
                <li class="items_cate">
                    <a href="#" class="link_items-cate">
                        <img src="./assetsHome/img/season_coll_3_img.png" alt="">
                        <p>Mountain bike <br> <span>19 sản phẩm</span></p>
                    </a>
                </li>
                <li class="items_cate">
                    <a href="#" class="link_items-cate">
                        <img src="./assetsHome/img/season_coll_4_img.png" alt="">
                        <p>Mountain bike <br> <span>19 sản phẩm</span></p>
                    </a>
                </li>
                <li class="items_cate">
                    <a href="#" class="link_items-cate">
                        <img src="./assetsHome/img/season_coll_5_img.png" alt="">
                        <p>Mountain bike <br> <span>19 sản phẩm</span></p>
                    </a>
                </li>
                <li class="items_cate">
                    <a href="#" class="link_items-cate">
                        <img src="./assetsHome/img/season_coll_6_img.png" alt="">
                        <p>Mountain bike <br> <span>19 sản phẩm</span></p>
                    </a>
                </li>
            </ul>
        </div>
    </section>
    <!-- Product  -->
    <article class="recent container" id="recent-view-section">
        <div class="happy">
            <h2><a href="#">Happy Summer - Giảm đến 50% </a><i class="fa-solid fa-fire"></i></h2>
        </div>
        <div class="recent-view-header ">
        </div>
        <!-- SẢN PHẪM ĐÃ XEM -->
        <div class="product-list">
            <!-- sản phẩm 1 -->
            @foreach ($products as $index => $item)
                <div class="product-item">
                    <!-- Hình ảnh sản phẩm -->
                    <div class="product-thumbnail">
                        <img class="img-primary" src="{{ $item->Image }}">
                        <img class="img-secondary"
                            src="./assetsHomeHome/img/Hotsummer/11-3-d30ef3382f6444c7a7d333bb0a0152fc-large.png">

                        <!-- Hành động xuất hiện khi hover -->
                        <div class="product-hover-actions">
                            <a href="{{ route('cart.create', ['Id_SP' => $item->Id_SP]) }}">
                                <i class="fas fa-shopping-cart"></i>
                            </a>
                            <a href="{{ route('product.detail', ['slug' => $item->Slug]) }}" title="Xem chi tiết">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Thông tin sản phẩm -->
                    <div class="product-info">
                        <div class="product-name">
                            <span>Khác</span>
                            <a id="name" href="#" title="Túi khô XTOURING">{{ $item->Name }}</a>
                        </div>

                        <!-- Đánh giá sản phẩm -->
                        <div class="product-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>

                        <!-- Giá sản phẩm -->
                        <div class="product-price">
                            <span class="price">{{ number_format($item->Price, 0, ',', '.') . ' VND' }}</span>
                            <div class="price-details">
                                <span class="compare-price">1.990.000₫</span>
                                <span class="discount">-28%</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            
        <div class="btn-1">
            <input class="btn-2" type="button" value="Xem tất cả >">
        </div>
    </article>

    <!-- Banner -->
    <div class="grid">
        <table class="table" border="0">
            <tr>
                <td>
                    <a href="#"><img style="width: 630px; height: 405px;"
                        src="./assetsHome/img/Banner/bento_grid_item_4_img.png" alt=""></a>
                </td>
            </tr>
        </table>
    </div>

    <div class="grid">
        <div class="endow">
            <div class="text_endow">
                <a class="link_endow" href="#"><span class="sp_endow">Ưu đãi</span> <br> Phụ kiện xe đạp</a>
            </div>
            <input class="btn-2" type="button" value="Xem tất cả">
        </div>
    </div>

    <!-- Product Endow -->
    <article class="recent container" id="recent-view-section">
        <div class="recent-view-header ">
        </div>
        <!-- SẢN PHẪM ĐÃ XEM -->
        <div class="product-list">
            <!-- sản phẩm 1 -->
            <div class="product-item">
                <!-- Hình ảnh sản phẩm -->
                <div class="product-thumbnail">
                    <img class="img-primary" src="./assetsHome/img/Endow/1.png">
                    <img class="img-secondary" src="./assetsHome/img/Endow/2.png">

                    <!-- Hành động xuất hiện khi hover -->
                    <div class="product-hover-actions">
                        <button type="button" title="Thêm vào giỏ">
                            <i class="fas fa-shopping-cart"></i>
                        </button>
                        <a href="#" title="Xem chi tiết">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </div>

                <!-- Thông tin sản phẩm -->
                <div class="product-info">
                    <div class="product-name">
                        <span>Khác</span>
                        <a id="name" href="#" title="Túi khô XTOURING">Xe đạp đường trường Ultegra</a>
                    </div>

                    <!-- Đánh giá sản phẩm -->
                    <div class="product-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>

                    <!-- Giá sản phẩm -->
                    <div class="product-price">
                        <span class="price">32.590.000₫</span>
                        <div class="price-details">
                            <span class="compare-price">44.990.000₫</span>
                            <span class="discount">-28%</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="product-item">
                <!-- Hình ảnh sản phẩm -->
                <div class="product-thumbnail">
                    <img class="img-primary" src="./assetsHome/img/Endow/3.png">
                    <img class="img-secondary" src="./assetsHome/img/Endow/4.png">

                    <!-- Hành động xuất hiện khi hover -->
                    <div class="product-hover-actions">
                        <button type="button" title="Thêm vào giỏ">
                            <i class="fas fa-shopping-cart"></i>
                        </button>
                        <a href="#" title="Xem chi tiết">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </div>

                <!-- Thông tin sản phẩm -->
                <div class="product-info">
                    <div class="product-name">
                        <span>Khác</span>
                        <a id="name" href="#" title="Túi khô XTOURING">Xe đạp đường trường Domane AL 5 đĩa</a>
                    </div>

                    <!-- Đánh giá sản phẩm -->
                    <div class="product-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>

                    <!-- Giá sản phẩm -->
                    <div class="product-price">
                        <span class="price">32.590.000₫</span>
                        <div class="price-details">
                            <span class="compare-price">44.990.000₫</span>
                            <span class="discount">-28%</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="product-item">
                <!-- Hình ảnh sản phẩm -->
                <div class="product-thumbnail">
                    <img class="img-primary" src="./assetsHome/img/Endow/5.png">
                    <img class="img-secondary" src="./assetsHome/img/Endow/6.png">

                    <!-- Hành động xuất hiện khi hover -->
                    <div class="product-hover-actions">
                        <button type="button" title="Thêm vào giỏ">
                            <i class="fas fa-shopping-cart"></i>
                        </button>
                        <a href="#" title="Xem chi tiết">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </div>

                <!-- Thông tin sản phẩm -->
                <div class="product-info">
                    <div class="product-name">
                        <span>Khác</span>
                        <a id="name" href="#" title="Túi khô XTOURING">Xe đạp Naughty</a>
                    </div>

                    <!-- Đánh giá sản phẩm -->
                    <div class="product-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>

                    <!-- Giá sản phẩm -->
                    <div class="product-price">
                        <span class="price">17.838.000₫</span>
                        <div class="price-details">
                            <span class="compare-price">24.580.000₫</span>
                            <span class="discount">-28%</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="product-item">
                <!-- Hình ảnh sản phẩm -->
                <div class="product-thumbnail">
                    <img class="img-primary" src="./assetsHome/img/Endow/7.png">
                    <img class="img-secondary" src="./assetsHome/img/Endow/8.png">

                    <!-- Hành động xuất hiện khi hover -->
                    <div class="product-hover-actions">
                        <button type="button" title="Thêm vào giỏ">
                            <i class="fas fa-shopping-cart"></i>
                        </button>
                        <a href="#" title="Xem chi tiết">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </div>

                <!-- Thông tin sản phẩm -->
                <div class="product-info">
                    <div class="product-name">
                        <span>Khác</span>
                        <a id="name" href="#" title="Túi khô XTOURING">Xe đạp Scott Scale RC</a>
                    </div>

                    <!-- Đánh giá sản phẩm -->
                    <div class="product-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>

                    <!-- Giá sản phẩm -->
                    <div class="product-price">
                        <span class="price">26.599.000₫</span>
                        <div class="price-details">
                            <span class="compare-price">39.900.000₫</span>
                            <span class="discount">-34%</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-item">
                <!-- Hình ảnh sản phẩm -->
                <div class="product-thumbnail">
                    <img class="img-primary" src="./assetsHome/img/Endow/9.png">
                    <img class="img-secondary" src="./assetsHome/img/Endow/10.png">

                    <!-- Hành động xuất hiện khi hover -->
                    <div class="product-hover-actions">
                        <button type="button" title="Thêm vào giỏ">
                            <i class="fas fa-shopping-cart"></i>
                        </button>
                        <a href="#" title="Xem chi tiết">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </div>

                <!-- Thông tin sản phẩm -->
                <div class="product-info">
                    <div class="product-name">
                        <span>Khác</span>
                        <a id="name" href="#" title="Túi khô XTOURING">Xe đạp đường trường Ultegra</a>
                    </div>

                    <!-- Đánh giá sản phẩm -->
                    <div class="product-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>

                    <!-- Giá sản phẩm -->
                    <div class="product-price">
                        <span class="price">32.590.000₫</span>
                        <div class="price-details">
                            <span class="compare-price">44.990.000₫</span>
                            <span class="discount">-28%</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-item">
                <!-- Hình ảnh sản phẩm -->
                <div class="product-thumbnail">
                    <img class="img-primary" src="./assetsHome/img/Endow/11.png">
                    <img class="img-secondary" src="./assetsHome/img/Endow/12.png">

                    <!-- Hành động xuất hiện khi hover -->
                    <div class="product-hover-actions">
                        <button type="button" title="Thêm vào giỏ">
                            <i class="fas fa-shopping-cart"></i>
                        </button>
                        <a href="#" title="Xem chi tiết">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </div>

                <!-- Thông tin sản phẩm -->
                <div class="product-info">
                    <div class="product-name">
                        <span>Khác</span>
                        <a id="name" href="#" title="Túi khô XTOURING">Xe đạp đường trường Ultegra</a>
                    </div>

                    <!-- Đánh giá sản phẩm -->
                    <div class="product-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>

                    <!-- Giá sản phẩm -->
                    <div class="product-price">
                        <span class="price">32.590.000₫</span>
                        <div class="price-details">
                            <span class="compare-price">44.990.000₫</span>
                            <span class="discount">-28%</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-item">
                <!-- Hình ảnh sản phẩm -->
                <div class="product-thumbnail">
                    <img class="img-primary" src="./assetsHome/img/Endow/13.png">
                    <img class="img-secondary" src="./assetsHome/img/Endow/14.png">

                    <!-- Hành động xuất hiện khi hover -->
                    <div class="product-hover-actions">
                        <button type="button" title="Thêm vào giỏ">
                            <i class="fas fa-shopping-cart"></i>
                        </button>
                        <a href="#" title="Xem chi tiết">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </div>

                <!-- Thông tin sản phẩm -->
                <div class="product-info">
                    <div class="product-name">
                        <span>Khác</span>
                        <a id="name" href="#" title="Túi khô XTOURING">Xe đạp đường trường Ultegra</a>
                    </div>

                    <!-- Đánh giá sản phẩm -->
                    <div class="product-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>

                    <!-- Giá sản phẩm -->
                    <div class="product-price">
                        <span class="price">32.590.000₫</span>
                        <div class="price-details">
                            <span class="compare-price">44.990.000₫</span>
                            <span class="discount">-28%</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-item">
                <!-- Hình ảnh sản phẩm -->
                <div class="product-thumbnail">
                    <img class="img-primary" src="./assetsHome/img/Endow/15.png">
                    <img class="img-secondary" src="./assetsHome/img/Endow/16.png">

                    <!-- Hành động xuất hiện khi hover -->
                    <div class="product-hover-actions">
                        <button type="button" title="Thêm vào giỏ">
                            <i class="fas fa-shopping-cart"></i>
                        </button>
                        <a href="#" title="Xem chi tiết">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </div>

                <!-- Thông tin sản phẩm -->
                <div class="product-info">
                    <div class="product-name">
                        <span>Khác</span>
                        <a id="name" href="#" title="Túi khô XTOURING">Xe đạp đường trường Ultegra</a>
                    </div>

                    <!-- Đánh giá sản phẩm -->
                    <div class="product-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>

                    <!-- Giá sản phẩm -->
                    <div class="product-price">
                        <span class="price">32.590.000₫</span>
                        <div class="price-details">
                            <span class="compare-price">44.990.000₫</span>
                            <span class="discount">-28%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
    <div class="grid">
        <div class="equipment">
            <h3>BIKEPACKING EQUIPMENT</h3>
            <ul class="bikepacking">
                <li class="list_packing">
                    <a href="#" class="links_packing"><img src="./assetsHome/img/Bikepacking/lookbook_1_image.png"
                            alt=""></a>
                    <p>XTOURING Full Frame</p>
                    <input class="btn-2" type="button" value="Xem tất cả">
                </li>
                <li class="list_packing">
                    <a href="#" class="links_packing"><img src="./assetsHome/img/Bikepacking/lookbook_2_image.png"
                            alt=""></a>
                    <p>XTOURING Full Frame</p>
                    <input class="btn-2" type="button" value="Xem tất cả">
                </li>
                <li class="list_packing">
                    <a href="#" class="links_packing"><img src="./assetsHome/img/Bikepacking/lookbook_3_image.png"
                            alt=""></a>
                    <p>XTOURING Full Frame</p>
                    <input class="btn-2" type="button" value="Xem tất cả">
                </li>
            </ul>
        </div>
    </div>

    <!-- Scott -->
    <div class="grid">
        <div class="container_scott">
            <div class="scott">
                <div class="img"><img src="./assetsHome/img/lookbook_oneproduct_img.png" alt=""></div>
            </div>
            <div class="content">
                <h3>SCOTT SUB CROSS 2.0 - Lựa chọn hoàn hảo cho hành trình phượt và di chuyển trong thành phố!</h3>
                <p>Chiếc xe đạp hybrid hoàn hảo cho những ai yêu thích khám phá và di chuyển linh hoạt. Với thiết kế
                    hiện đại, cùng các tính năng vượt trội, SUB CROSS 2.0 mang đến trải nghiệm lái xe tuyệt vời trên mọi
                    địa hình.</p>
                <ul class="list_content">
                    <span>Ưu điểm nổi bật:</span>
                    <li class="main_content"> - Khung xe hợp kim nhôm siêu nhẹ và bền bỉ</li>
                    <li class="main_content"> - Phuộc trước Suntour NEX HLO 63mm êm ái</li>
                    <li class="main_content"> - Hệ thống truyền động Shimano Deore T6000 30 tốc độ linh hoạt</li>
                    <li class="main_content"> - Phanh thủy lực an toàn, chính xác</li>
                    <li class="main_content"> - Lốp xe Kenda Booster bám đường tốt.</li>
                    <li class="main_content"> - Ghi đông cong, yên Selle Italia thoải mái.</li>
                    <li class="main_content"> - Trang bị đầy đủ phụ kiện.
                    </li>
                </ul>
                <input class="btn-2" type="button" value="Xem tất cả">
            </div>
        </div>
    </div>

    <!-- Banner -->
    <div class="grid">
        <div class="banner_img">
            <a href="#"><img src="./assetsHome/img/Banner/slide_product_2_img_1_img.png" alt=""></a>
        </div>
    </div>

    <!-- Accessory -->
    <div class="grid">
        <div class="endow" style="margin-top: 30px;">
            <div class="text_endow">
                <a class="link_endow" href="#"><span class="sp_endow">Ưu đãi</span> <br> Phụ tùng xe đạp</a>
            </div>
            <input class="btn-2" type="button" value="Xem tất cả">
        </div>
    </div>

    <!-- Product Endow -->
    <article class="recent container" id="recent-view-section">
        <div class="recent-view-header ">
        </div>
        <!-- SẢN PHẪM ĐÃ XEM -->
        <div class="product-list">
            <!-- sản phẩm 1 -->
            <div class="product-item">
                <!-- Hình ảnh sản phẩm -->
                <div class="product-thumbnail">
                    <img class="img-primary" src="./assetsHome/img/accessory/1.png">
                    <img class="img-secondary" src="./assetsHome/img/accessory/2.png">

                    <!-- Hành động xuất hiện khi hover -->
                    <div class="product-hover-actions">
                        <button type="button" title="Thêm vào giỏ">
                            <i class="fas fa-shopping-cart"></i>
                        </button>
                        <a href="#" title="Xem chi tiết">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </div>

                <!-- Thông tin sản phẩm -->
                <div class="product-info">
                    <div class="product-name">
                        <span>Khác</span>
                        <a id="name" href="#" title="Túi khô XTOURING">Xe đạp đường trường Ultegra</a>
                    </div>

                    <!-- Đánh giá sản phẩm -->
                    <div class="product-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>

                    <!-- Giá sản phẩm -->
                    <div class="product-price">
                        <span class="price">32.590.000₫</span>
                        <div class="price-details">
                            <span class="compare-price">44.990.000₫</span>
                            <span class="discount">-28%</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="product-item">
                <!-- Hình ảnh sản phẩm -->
                <div class="product-thumbnail">
                    <img class="img-primary" src="./assetsHome/img/accessory/3.png">
                    <img class="img-secondary" src="./assetsHome/img/accessory/4.png">

                    <!-- Hành động xuất hiện khi hover -->
                    <div class="product-hover-actions">
                        <button type="button" title="Thêm vào giỏ">
                            <i class="fas fa-shopping-cart"></i>
                        </button>
                        <a href="#" title="Xem chi tiết">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </div>

                <!-- Thông tin sản phẩm -->
                <div class="product-info">
                    <div class="product-name">
                        <span>Khác</span>
                        <a id="name" href="#" title="Túi khô XTOURING">Xe đạp đường trường Domane AL 5 đĩa</a>
                    </div>

                    <!-- Đánh giá sản phẩm -->
                    <div class="product-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>

                    <!-- Giá sản phẩm -->
                    <div class="product-price">
                        <span class="price">32.590.000₫</span>
                        <div class="price-details">
                            <span class="compare-price">44.990.000₫</span>
                            <span class="discount">-28%</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="product-item">
                <!-- Hình ảnh sản phẩm -->
                <div class="product-thumbnail">
                    <img class="img-primary" src="./assetsHome/img/accessory/5.png">
                    <img class="img-secondary" src="./assetsHome/img/accessory/6.png">

                    <!-- Hành động xuất hiện khi hover -->
                    <div class="product-hover-actions">
                        <button type="button" title="Thêm vào giỏ">
                            <i class="fas fa-shopping-cart"></i>
                        </button>
                        <a href="#" title="Xem chi tiết">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </div>

                <!-- Thông tin sản phẩm -->
                <div class="product-info">
                    <div class="product-name">
                        <span>Khác</span>
                        <a id="name" href="#" title="Túi khô XTOURING">Xe đạp Naughty</a>
                    </div>

                    <!-- Đánh giá sản phẩm -->
                    <div class="product-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>

                    <!-- Giá sản phẩm -->
                    <div class="product-price">
                        <span class="price">17.838.000₫</span>
                        <div class="price-details">
                            <span class="compare-price">24.580.000₫</span>
                            <span class="discount">-28%</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="product-item">
                <!-- Hình ảnh sản phẩm -->
                <div class="product-thumbnail">
                    <img class="img-primary" src="./assetsHome/img/accessory/7.png">
                    <img class="img-secondary" src="./assetsHome/img/accessory/7.png">

                    <!-- Hành động xuất hiện khi hover -->
                    <div class="product-hover-actions">
                        <button type="button" title="Thêm vào giỏ">
                            <i class="fas fa-shopping-cart"></i>
                        </button>
                        <a href="#" title="Xem chi tiết">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </div>

                <!-- Thông tin sản phẩm -->
                <div class="product-info">
                    <div class="product-name">
                        <span>Khác</span>
                        <a id="name" href="#" title="Túi khô XTOURING">Xe đạp Scott Scale RC</a>
                    </div>

                    <!-- Đánh giá sản phẩm -->
                    <div class="product-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>

                    <!-- Giá sản phẩm -->
                    <div class="product-price">
                        <span class="price">26.599.000₫</span>
                        <div class="price-details">
                            <span class="compare-price">39.900.000₫</span>
                            <span class="discount">-34%</span>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </article>

    <!-- News -->
     <div class="grid">
        <div class="news">
            <h2>Tin tức</h2>
            <input class="btn-2" type="button" value="Xem tất cả">
        </div>
        <div class="new">
            <ul class="list_news">
                <li class="main_news">
                    <a href="#" class="link_news"><img src="./assetsHome/img/news/1.png" alt=""></a>
                    <a href="#" id="link_news"><h4>Top 5 xe đạp thể thao chính hãng không thể bỏ qua</h4></a>
                    <p><i class="fa-solid fa-calendar-days"></i> Thứ Tư, 24/07/2024  <i style="margin-left: 10px;" class="fa-solid fa-clock"></i> 7 phút đọc</p>
                    <span>Việc mua một chiếc xe đạp thể thao giá rẻ có thể là lựa chọn tối ưu...</span>
                    <a class="see-more" href="#">Đọc tiếp</a>
                </li>
            </ul>
            <ul class="list_news">
                <li class="main_news">
                    <a href="#" class="link_news"><img src="./assetsHome/img/news/2.png" alt=""></a>
                    <a href="#" id="link_news"><h4>Xe đạp Merida của nước nào? Chất lượng có tốt không?</h4></a>
                    <p><i class="fa-solid fa-calendar-days"></i> Thứ Tư, 24/07/2024  <i style="margin-left: 10px;" class="fa-solid fa-clock"></i> 4 phút đọc</p>
                    <span>Đạp xe đường trường (road bike) mang lại nhiều lợi ích cho sức khỏe...</span>
                    <a class="see-more" href="#">Đọc tiếp</a>
                </li>
            </ul>
            <ul class="list_news">
                <li class="main_news">
                    <a href="#" class="link_news"><img src="./assetsHome/img/news/3.png" alt=""></a>
                    <a href="#" id="link_news"><h4>Top 5 xe đạp thể thao chính hãng không thể bỏ qua</h4></a>
                    <p><i class="fa-solid fa-calendar-days"></i> Thứ Tư, 24/07/2024  <i style="margin-left: 10px;" class="fa-solid fa-clock"></i> 7 phút đọc</p>
                    <span>Merida là hãng xe đạp nổi tiếng được nhiều người biết đến...</span>
                    <a class="see-more" href="#">Đọc tiếp</a>
                </li>
            </ul>
        </div>
     </div>

@endsection