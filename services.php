<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require ('component/links.php');
    ?>
    <link rel="stylesheet" href="assets/css/services_style.css">
    <title>HomeCareFix - Services</title>

    <style>
        .bb:hover {
            border: 1px solid #000000 !important;
        }

        .custom-alert {
            position: fixed;
            top: 100px;
            right: 25px;
            z-index: 999;
        }
    </style>


</head>

<body class="bg-light">

    <header>
        <?php require ("component/navbar.php");
        ?>
    </header>

    <section>
        <div class="container heading">
            <div class="row">
                <div class="col-lg-3 col-md-12 mb-lg-0 mb-4">
                    <?php
                    if (isset ($_GET["category"])) {
                        // GET parameter 'category_name' is present in the URL
                        $category_name = htmlspecialchars($_GET["category"]);
                        echo '<h2 class="text-start mb-4 fs-1">' . $category_name . '</h2>';
                    } else {
                        echo '<h2 class="text-start mb-4 fs-1">Select Service <br> From Here!!!!</h2>';
                    }
                    ?>
                    <div class="d-flex align-items-center justify-content-evenly mb-2">
                        <span>
                            <img src="assets/images/star-svg.svg" width="40px" alt="" srcset="">
                        </span>
                        <span>
                            <h5 class="text-muted">4.5+ Rating</h5>
                        </span>
                        <span>
                            <img src="assets/images/person.svg" width="40px" alt="" srcset="">
                        </span>
                        <span>
                            <h5 class="text-muted">1.5+ Million Serverd</h5>
                        </span>
                    </div>
                    <div class="mb-2" style="font-size: 24px;">
                        <a href="index.php" class="text-secondary text-decoration-none">Home</a>
                        <span class="text-secondary"> > </span>
                        <a href="#" class="text-secondary text-decoration-none">Services</a>
                    </div>
                    <nav id="navbar-example3"
                        class="navbar navtop navbar-expand-lg navbar-light bg-white rounded shadow-lg border sticky-top scrollspy-example-2"
                        data-bs-spy="scroll" data-bs-target="#navbar-example3" data-bs-smooth-scroll="true">
                        <div class="container-fluid">
                            <div class="row">
                                <h4 class="mt-2 text-muted text-start">Select Service</h4>
                                <div class="mt-2">
                                    <div class="row justify-content-start p-2 mx-0">
                                        <?php
                                        $id = "";
                                        if (isset ($_GET["id"])) {
                                            $ids = $_GET["id"];
                                        }
                                        $res = "SELECT nested_categories.id AS nest_id, nested_categories.nested_category, nested_categories.category_id, nested_categories.sub_category_id, nested_categories.icon_img, sub_categories.id 
                                    FROM nested_categories 
                                    INNER JOIN sub_categories ON sub_categories.id = nested_categories.sub_category_id
                                    WHERE nested_categories.sub_category_id = ?";
                                        $data = select($res, [$ids], 'i');
                                        $path = NESTCATEGORY_ICON_PATH;

                                        while ($row = mysqli_fetch_assoc($data)) {
                                            echo <<<data
                                        <div class="col-lg-4 col-md-5 my-1 px-0 mx-0">
                                            <button class="btn btn-outline border-0 p-0 scroll-btn" data-scroll="#item$row[nest_id]">
                                                <div class="card border shadow rounded mb-2 bb"
                                                    style="width: 70px; min-height: 70px; margin: auto; background-image: url('{$path}{$row['icon_img']}'); background-size: cover; background-position: center;">
                                                </div>
                                            </button>
                                            <div class="card-footer">
                                                <h6 class="card-text text-dark text-wrap me-2" style="width: 5rem;">{$row['nested_category']}</h6>
                                            </div>
                                        </div> 
                                        data;
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>

                <div class="col-lg-9 col-md-12 px-3">
                    <video class="mb-3 rounded shadow-lg" width="100%" autoplay muted loop>
                    <?php
                    $res = "SELECT `video` FROM `sub_categories` WHERE `id`= ?";
                    $data = select($res, [$ids], 'i');
                    $path = VIDEO_PATH;
                    while ($row = mysqli_fetch_assoc($data)){
                        echo <<<data
                            <source src="$path$row[video]" type="video/mp4">
                            Your browser does not support the video tag.
                        data;
                    }
                    ?>
                    </video>
                    <div class="h-line w-100 mb-3 border"></div>
                    <div class="row">
                        <div class="col-lg-7 col-md-7 px-3">

                            <?php
                            $id = "";
                            if (isset ($_GET["id"])) {
                                // GET parameter 'id' is present in the URL
                                $id = $_GET["id"];
                            }
                            $res = "SELECT services.id, services.service_name, services.price, services.description, services_images.image, services_images.thumb, nested_categories.nested_category, services.nested_id 
                                FROM services 
                                INNER JOIN services_images ON services_images.service_id = services.id
                                INNER JOIN nested_categories ON nested_categories.id = services.nested_id
                                WHERE nested_categories.sub_category_id = ?
                                ORDER BY nested_categories.nested_category";
                            $data = select($res, [$id], 'i');

                            $path = SERVICES_IMG_PATH;

                            $current_nested_category = "";

                            while ($row = mysqli_fetch_assoc($data)) {
                                // Split the description into individual points
                                $points = explode(",", $row['description']);

                                $facilities_html = '';
                                foreach ($points as $point) {
                                    $point = trim($point);
                                    if (substr($point, -1) == ',') {
                                        $facilities_html .= '<h3><i class="bi bi-diamond-fill">' . rtrim($point, ',') . '</i></h3>';
                                    } else {
                                        $facilities_html .= '<span class="badge fs-6 rounded-pill bg-light text-dark mb-2 text-wrap">' . $point . '</span>';
                                    }
                                }

                                // Check if the current nested category has changed
                                $title_heading = '';
                                if ($current_nested_category != $row['nested_category']) {
                                    // If changed, output the nested category title
                                    $title_heading .= '<h2 class="text-center mb-2 fs-1 bg-white rounded-pill border shadow" id="item' . $row['nested_id'] . '">' . $row['nested_category'] . '</h2>';
                                    $current_nested_category = $row['nested_category']; // Update the current nested category
                                }
                                echo <<<HTML
                                    $title_heading
                                    <div class="card border-1 mb-4 shadow-lg bg-white idclass"
                                        style="max-width: 650px; margin: auto;">
                                        <div class="row g-0 align-items-center">
                                            <img src="$path$row[image]" class="card-img-top">
                                            <div class="card-body">
                                                <input type="hidden" name="" value="$row[id]" class="card_id">
                                                <h5 class="mb-2 fw-bold h4 srname">$row[service_name]</h5>
                                                <h6 class="mb-3 h5 price">₹ $row[price]</h6>
                                                <div class="features mb-3">
                                                    <h5 class="mb-1">Facilities</h5>
                                                    $facilities_html
                                                </div>
                                                <div class="rating mb-4">
                                                    <h5 class="mb-1">Rating</h5>
                                                    <span class="badge rounded-pill bg-white">
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                    </span>
                                                </div>
                                                <div class="text-center">
                                                <button  class='btn btn-outline-dark w-100 fw-bold shadow-none add-to-cart'>Add+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                HTML;
                            }
                            ?>
                        </div>

                        <div class="col-lg-5 col-md-5">
                            <div class="navtop1 sticky-lg-top">
                                <nav class="navbar rounded border shadow bg-white navbar-expand-lg mb-3">
                                    <div class="container">
                                        <div class="collapse navbar-collapse" id="navbarNav">
                                            <div class="p-0 table-responsive-md"
                                                style="max-height: 300px; overflow-y: scroll;">
                                                <table class="table table-hover cart-table">
                                                    <thead class="sticky-top">
                                                        <tr class="text-start h4 mb-2 py-0 bg-white">
                                                            <th colspan="5">Cart View</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <div class="empty-cart">
                                                            <img src="assets/images/cart-basket.svg"
                                                                alt="<i class='bi bi-cart-check-fill'></i>">
                                                            <h5>Your cart is empty. Start adding Services!</h5>
                                                        </div>
                                                    </tbody>
                                                </table>
                                                <div class="sticky-bottom">
                                                    <?php
                                                    if (!$settings_r['shutdown']) {
                                                        $login = 0;
                                                        if (isset ($_SESSION['signin']) && $_SESSION['signin'] == true) {
                                                            $login = 1;
                                                        }
                                                    }
                                                    ?>
                                                    <button onclick='checkLoginToBook(<?php echo $login; ?>,)'
                                                        class='btn btn-info p-1 m-0 w-100 checkout-btn' disabled>
                                                        <h5>Checkout</h5>
                                                        <h6 class='total-price-display'>Total Price: ₹0.00</h6>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="navbar-toggler shadow-none" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#navbarNav"
                                            aria-controls="navbarNav">
                                            View Cart
                                        </button>
                                    </div>
                                </nav>

                                <div
                                    class="bg-white rounded shadow p-4 border-bottom border-top border-4 border-dark pop mb-4">
                                    <div class="d-flex mb-2 align-items-center">
                                        <span class="me-2">
                                            <img src="assets/images/offer-svgrepo.svg" width="40px" alt="" srcset="">
                                        </span>
                                        <span>
                                            <h5 class="m-0 mb-2 fw-bold">Offers</h5>
                                        </span>
                                    </div>
                                    <a class="shadow-none text-primary fw-bold" data-bs-toggle="collapse"
                                        href="#collapseExample" aria-expanded="false"
                                        aria-controls="collapseExample">View More Offers <i
                                            class="bi bi-caret-down-fill bi-primary"> </i></a>
                                    <div class="collapse" id="collapseExample">
                                        <div class="card border-0 card-body">
                                            <div class="row">
                                                <h5 class="text-success">2% Cashback on Kotak Credit Cards</h5>
                                                <h5 class="text-success">ExclusiveOffers with HDFC Debit Cards</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="bg-white rounded shadow p-4 border-bottom border-top border-4 border-dark pop">
                                    <div class="d-flex align-items-center mb-2">
                                        <img src="assets/images/web-certificat.svg" width="40px" alt="" srcset="">
                                        <h5 class="m-0 ms-3">HomeCareFix -Promise!</h5>
                                    </div>
                                    <p class="text-muted">At HomeCareFix, we assure seamless convenience by bringing
                                        professional care, cleaning, and salon services to your doorstep.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>
        // Smooth scrolling when clicking on a button
        document.querySelectorAll('.scroll-btn').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();

                const targetId = this.getAttribute('data-scroll');
                const target = document.querySelector(targetId);

                target.scrollIntoView({
                    behavior: 'smooth',
                });
            });
        });

        $(document).ready(function () {
        // Load cart items from session storage when the page loads
        loadCartItemsFromSession();

        // Event listener for adding item to cart
        $(".add-to-cart").click(function () {
            var serviceName = $(this).closest(".card-body").find(".srname").text();
            var price = parseFloat($(this).closest(".card-body").find(".price").text().replace(/[^0-9.-]+/g, ""));
            var cardId = $(this).closest(".card-body").find(".card_id").val();

            console.log("Card ID:", cardId); 
            
            // Send AJAX request to add item to cart
            $.post("ajax/manage_cart.php", {addToCart: true, serviceName: serviceName, price: price, cardId: cardId}, function(data) {
                // Update cart table with new data
                $(".cart-table tbody").html(data);
                // Update total price
                updateTotalPrice();
                // Show/hide empty cart message
                toggleEmptyCartMessage();
                // Store cart items in session storage
                storeCartItemsInSession();
            });
    
        });
    
    // Event listener for removing item from cart
    $(document).on("click", ".btn-remove", function () {
        var serviceName = $(this).data("service");
        
        // Send AJAX request to remove item from cart
        $.post("ajax/manage_cart.php", {removeFromCart: true, serviceName: serviceName}, function(data) {
            // Update cart table with new data
            $(".cart-table tbody").html(data);
            // Update total price
            updateTotalPrice();
            // Show/hide empty cart message
            toggleEmptyCartMessage();
            // Store cart items in session storage
            storeCartItemsInSession();
        });
    });
    
    // Function to update total price
    function updateTotalPrice() {
            // Calculate total price
        var total = 0;
        $(".cart-table tbody tr").each(function () {
            total += parseFloat($(this).find("td:eq(2)").text());
        });
        $(".total-price-display").text("Total Price: ₹" + total.toFixed(2));
        // Enable/disable checkout button based on total price
        if (total > 0) {
            $(".checkout-btn").prop("disabled", false);
        } else {
            $(".checkout-btn").prop("disabled", true);
        }
    }

    // Function to show/hide empty cart message
    function toggleEmptyCartMessage() {
        if ($(".cart-table tbody tr").length === 0) {
            $(".empty-cart").removeClass("d-none");
        } else {
            $(".empty-cart").addClass("d-none");
        }
    }

    // Function to store cart items in session storage
    function storeCartItemsInSession() {
        var cartItems = $(".cart-table tbody").html();
        sessionStorage.setItem("cartItems", cartItems);
    }
    
    // Function to load cart items from session storage
    function loadCartItemsFromSession() {
        var cartItems = sessionStorage.getItem("cartItems");
        if (cartItems) {
            $(".cart-table tbody").html(cartItems);
            updateTotalPrice();
            toggleEmptyCartMessage();
        }
    }
    });
    </script>

    <footer>
        <?php require ("component/footer.php");
        ?>
    </footer>

</body>

</html>