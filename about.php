<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap core CSS -->
    <?php
        require('component/links.php');
    ?>
    <link rel="stylesheet" href="assets/css/facilities_style.css">
    <title>HomeCareFix - About</title>

</head>

<body class="bg-light">

    <header>
        <?php require("component/navbar.php");
        ?>
    </header>

    <section class="bg-white p-2">
        <div class="container heading">
            <div class="my-3 px-4">
                <h2 class="fw-bold text-center">About Us</h2>
                <div class="h-line bg-dark"></div>
                <p class="text-center mt-3">
                HomeCareFix is a revolutionary platform dedicated to bringing convenience and quality to home care services. Our mission is to provide hassle-free solutions for all your home care needs, from beauty treatments to household maintenance and repairs
                </p>
            </div>
        </div>
        <div class="container bg-white">
            <div class="row justify-content-between align-items-center">
            
                <div class="col-lg-6 col-md-5 mb-4 order-lg-1 order-md-1 order-2">
                <div class="mb-4" style="font-size: 20px;">
                        <a href="index.php" class="text-secondary text-decoration-none">Home</a>
                        <span class="text-secondary"> > </span>
                        <a href="services.php?+" class="text-secondary text-decoration-none">About Us</a>
                    </div>
                    <h2 class="mb-3">Why Choose HomeCareFix?</h2>
                    <p>
                HomeCareFix stands out as your premier choice for home care services. With a commitment to excellence
                and customer satisfaction, we offer a myriad of reasons why you should trust us with your home care
                needs.
            </p>
            <ul class="mb-2">
                <li class="mb-2"><strong>Convenience:</strong> Book services from the comfort of your home at your preferred time.</li>
                <li class="mb-2"><strong>Quality:</strong> Our trained professionals ensure high-quality services tailored to your needs.</li>
                <li class="mb-2"><strong>Reliability:</strong> Trustworthy service providers with a commitment to customer satisfaction.</li>
                <li><strong>Diversity:</strong> We offer a wide range of services to cater to all your home care needs.</li>
            </ul>
                </div>
                <div class="col-lg-5 col-md-5 mb-4 order-lg-2 order-md-2 order-1">
                    <img src="assets/images/team/big_img.png" class="rounded w-100 h-100" alt="">
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4 px-4">
                    <div
                        class="bg-white rounded shadow p-4 border-start border-end border-4  text-center border-dark box">
                        <h2 class="text-muted fw-bold">45,000+</h2>
                        <h3 class="text-dark">Professionals</h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 px-4">
                    <div
                        class="bg-white rounded shadow p-4 border-start border-end border-4  text-center border-dark box">
                        <h2 class="text-muted fw-bold">10 Million+</h2>
                        <h3 class="text-dark">Happy Customers</h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 px-4">
                    <div
                        class="bg-white rounded shadow p-4 border-start border-end border-4 text-center border-dark box">
                        <h2 class="text-muted fw-bold">61</h2>
                        <h3 class="text-dark">Cities</h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 px-4">
                    <div
                        class="bg-white rounded shadow p-4 border-start border-end border-4 text-center border-dark box">
                        <h2 class="text-muted fw-bold">4</h2>
                        <h3 class="text-dark">Countries</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <h3 class="my-5 fw-bold text-center">Our Leadership Team</h3>
        <div class="container px-4">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper mb-5">
                    <?php
                        $about_r = selectAll('team_details');
                        $path = TEAM_IMG_PATH;
                        
                        while($row = mysqli_fetch_assoc($about_r)){
                            $info = $row['info'];
                            $trimmed_info = implode(' ', array_slice(explode(' ', $info), 0, 150));
                            echo <<<data
                                <div class="swiper-slide">
                                <div class="card" style="max-width: 350px; margin: auto;">
                                    <img src="$path$row[picture]" class="card-img-top"
                                        alt="...">
                                    <div class="card-body">
                                        <h5 class="mb-2 fw-bold text-center">$row[name]</h5>
                                        <div class="features mb-2">
                                            <h6 class="mb-3 text-muted text-center ">$row[position]</h6>
                                            <p>
                                                $trimmed_info.....
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            data;
                        }
                    ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </section>

    <footer>
        <?php require("component/footer.php");
        ?>
    </footer>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 3,
            spaceBetween: 5,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>
</body>

</html>