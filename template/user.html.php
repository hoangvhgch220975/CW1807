    <?php
    // Bao gồm các file cần thiết
    require_once '../include/database.php';
    require_once '../include/databasefunction.php';

    // Gọi hàm để lấy tất cả thiết bị
    $devices = getAllDevices();
    $services = getAllServices();
    $packages = getAllPackages();
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ChealDeal.com</title>
        <link rel="stylesheet" href="../styles.css">
        <style>
            .section-heading {
                font-size: 50px;
                text-align: center;
                color: red;
                margin-left: 30px;
                margin-bottom: 10px;
                text-decoration: bold;
            }

            .product-container {
                position: relative;
                display: flex;
                align-items: center;
                overflow: hidden;
                max-width: 100%;
                padding: 20px;
                background-color: #f9f9f9;
                border-radius: 10px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                margin-bottom: 50px;
            }

            .product-grid {
                display: flex;
                gap: 1.5rem;
                overflow-x: auto;
                scroll-behavior: smooth;
                padding: 20px;
                max-width: 90%;
                scrollbar-width: none;
            }

            .product-grid::-webkit-scrollbar {
                display: none;
            }

            .product-card {
                position: relative;
                min-width: 250px;
                background: #fff;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                padding: 1.5rem;
                text-align: left;
                flex-shrink: 0;
            }

            .product-card img {
                width: 100%;
                height: 370px;
                object-fit: cover;
                border-radius: 8px;
                margin-bottom: 1rem;
            }

            /* Tên sản phẩm, giá và mô tả */
            .product-name {
                font-size: 1.2rem;
                font-weight: bold;
                margin: 0;
            }

            .product-price {
                font-size: 1.1rem;
                color: #333;
                margin: 0.5rem 0;
            }

            .product-description {
                font-size: 0.9rem;
                color: #666;
                margin-top: 0.5rem;
            }

            /* Thẻ chứa category và stock */
            .product-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 10px;
            }

            /* Hiển thị category */
            .product-category {
                background-color: gray;
                padding: 5px 10px;
                border-radius: 5px;
                font-size: 1rem;
                color: #fff;
                font-weight: bold;
                margin-right: 200px;
            }

            /* Hiển thị số lượng có sẵn */
            .product-stock {
                color: black;
                padding: 5px 10px;
                border-radius: 5px;
                font-size: 1.5rem;
            }

            /* Sold count */
            .sold-count {
                font-size: 1rem;
                color: #666;
                margin-top: 5px;
                margin-left: 70%;
            }

            .arrow-btn {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                background-color: rgba(255, 0, 0, 0.7);
                color: #fff;
                border: none;
                padding: 15px;
                cursor: pointer;
                font-size: 24px;
                z-index: 1;
                border-radius: 50%;
                transition: opacity 0.3s ease;
            }

            .arrow-btn.disabled {
                opacity: 0.5;
                cursor: not-allowed;
            }

            .left-arrow {
                left: 25px;
            }

            .right-arrow {
                right: 10px;
            }

            .arrow-btn:hover:not(.disabled) {
                background-color: rgba(200, 0, 0, 0.9);
            }
        </style>
    </head>

    <body>
        <!-- Hero Section -->
        <section class="hero" id="home" style="background-image: url('../image/banner.jpg')">
            <div class="hero-content">
                <a href="#products" class="cta-button">Shop Now</a>
            </div>
        </section>

        <!-- Submenu -->
    <section class="submenu">
        <div class="submenu-container">
            <div class="submenu-card">
                <img src="https://www.vodafone.com.au/images/icons/mobile-mid.svg" alt="Mobile" />
                <a href="../customer/mobileOnly.php">Mobile</a>
            </div>
            <div class="submenu-card">
                <img
                    src="https://www.vodafone.com.au/images/icons/tablet-mid.svg"
                    alt="Tablet" />
                <a href="../customer/tabletOnly.php">Tablet</a>
            </div>
            <div class="submenu-card">
                <img
                    src="https://www.vodafone.com.au/images/icons/home-broadband-mid.svg"
                    alt="Broandband" />
                <a href="../customer/broadbandOnly.php">Broadband</a>
            </div>
        </div>
    </section>
        <!-- Products Section -->
        <section class="products" id="products">
            <h2 class="section-heading" style="margin: centre;">Explore our Phone deals</h2>
            <div class="product-container">
                <button class="arrow-btn left-arrow disabled" data-target="productGrid">&#9664;</button>
                <div class="product-grid" id="productGrid">
                    <?php if ($devices): ?>
                        <?php foreach ($devices as $device): ?>
                            <div class="product-card">
                                <div class="product-header">
                                    <div class="product-category"><?= htmlspecialchars($device['category']); ?></div>
                                    <div class="product-stock">Available: <?= htmlspecialchars($device['stock']) ?></div>
                                </div>
                                <a href="../customer/detail_device.php?device_id=<?= $device['device_id']; ?>">
                                <img src="<?= '../image/imagedevice/' . htmlspecialchars($device['image']); ?>" alt="<?= htmlspecialchars($device['name']); ?>">
                                </a>
                                <a href="../customer/detail_device.php?device_id=<?= $device['device_id']; ?>">
                                    <h3 class="product-name"><?= htmlspecialchars($device['name']); ?></h3>
                                </a>
                                <p class="product-price">Price: $<?= htmlspecialchars(number_format($device['price'], 2)); ?></p>
                                <p class="product-description"><?= htmlspecialchars($device['description']); ?></p>
                                <div class="offer">
                                    <span class="icon">🎁</span> Discount up to 15% when ordering via app
                                </div>
                                <p class="sold-count">Sold: <?= htmlspecialchars($device['sales_count']) ?> units</p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No products available.</p>
                    <?php endif; ?>
                </div>

                <button class="arrow-btn right-arrow" data-target="productGrid">&#9654;</button>
            </div>
        </section>

        <!-- Services Section -->
        <section class="services" id="services">
            <h2 class="section-heading">Recommend for you 🌟</h2>
            <div class="product-container">
                <button class="arrow-btn left-arrow disabled" data-target="serviceGrid">&#9664;</button>
                <div class="product-grid" id="serviceGrid">
                    <?php if ($services): ?>
                        <?php foreach ($services as $service): ?>
                            <div class="product-card">
                                <a href="../customer/detail_service.php?service_id=<?= $service['service_id']; ?>">
                                    <img src="<?= '../image/serviceimage/' . htmlspecialchars($service['image']); ?>" alt="<?= htmlspecialchars($service['name']); ?>">
                                </a>
                                <a href="../customer/detail_service.php?service_id=<?= $service['service_id']; ?>">
                                    <h3 class="product-name"><?= htmlspecialchars($service['name']); ?></h3>
                                </a>
                                <p class="product-price">Price: $<?= htmlspecialchars(number_format($service['price'], 2)); ?></p>
                                <p class="product-description"><?= htmlspecialchars($service['description']); ?></p>
                                <div class="offer">
                                    <span class="icon">🎁</span> Discount up to 15% when ordering via app
                                </div>
                                <p class="sold-count">Sold: <?= htmlspecialchars($service['sales_count']) ?> units</p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No services available.</p>
                    <?php endif; ?>
                </div>

                <button class="arrow-btn right-arrow" data-target="serviceGrid">&#9654;</button>
            </div>
        </section>

        <!-- Packages Section -->
        <section class="packages" id="packages">
            <h2 class="section-heading">Our Packages 📦</h2>
            <div class="product-container">
                <button class="arrow-btn left-arrow disabled" data-target="packageGrid">&#9664;</button>
                <div class="product-grid" id="packageGrid">
                    <?php if ($packages): ?>
                        <?php foreach ($packages as $package): ?>
                            <div class="product-card">
                                <a href="../customer/detail_package.php?package_id=<?= $package['package_id']; ?>">
                                    <img src="<?= '../image/packetimage/' . htmlspecialchars($package['image']); ?>" alt="<?= htmlspecialchars($package['name']); ?>">
                                </a>
                                <a href="../customer/detail_package.php?package_id=<?= $package['package_id']; ?>">
                                    <h3 class="product-name"><?= htmlspecialchars($package['name']); ?></h3>
                                </a>
                                <p class="product-price">Price: $<?= htmlspecialchars(number_format($package['price'], 2)); ?></p>
                                <p class="product-description"><?= htmlspecialchars($package['description']); ?></p>
                                <div class="offer">
                                    <span class="icon">🎁</span> Discount up to 15% when ordering via app
                                </div>
                                <p class="sold-count">Sold: <?= htmlspecialchars($package['sales_count']) ?> units</p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No packages available.</p>
                    <?php endif; ?>
                </div>

                <button class="arrow-btn right-arrow" data-target="packageGrid">&#9654;</button>
            </div>
        </section>
    </body>

    <script>
        const buttons = document.querySelectorAll('.arrow-btn');

        buttons.forEach(button => {
            const targetId = button.getAttribute('data-target');
            const grid = document.getElementById(targetId);

            button.addEventListener('click', () => {
                const direction = button.classList.contains('left-arrow') ? -1 : 1;
                grid.scrollBy({
                    left: direction * 300,
                    behavior: 'smooth'
                });
            });

            grid.addEventListener('scroll', () => {
                const leftArrow = document.querySelector(`.left-arrow[data-target="${targetId}"]`);
                const rightArrow = document.querySelector(`.right-arrow[data-target="${targetId}"]`);

                const atStart = grid.scrollLeft === 0;
                const atEnd = grid.scrollLeft >= (grid.scrollWidth - grid.clientWidth);

                leftArrow.classList.toggle('disabled', atStart);
                rightArrow.classList.toggle('disabled', atEnd);
            });
        });
    </script>

    </html>