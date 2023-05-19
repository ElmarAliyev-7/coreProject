<section id="home-section" class="hero">
    <div class="home-slider  owl-carousel">
        <?php foreach ($sliders as $slider) : ?>
            <div class="slider-item ">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row d-md-flex no-gutters slider-text align-items-end justify-content-end" data-scrollax-parent="true">
                        <div class="one-third js-fullheight order-md-last img" style="background-image:url(<?=baseUrl . '/' .$slider['image'];?>);">
                            <div class="overlay"></div>
                        </div>
                        <div class="one-forth d-flex  align-items-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
                            <div class="text">
                                <span class="subheading"><?=$slider['subhead'];?></span>
                                <h1 class="mb-4 mt-3"><?=str_replace($slider['title_bold'],
                                 "<span>".$slider['title_bold']."</span>", $slider['title']);?>
                                </h1>
                                <h2 class="mb-4"><?=$slider['description'];?></h2>
                                <p><a href="#" class="btn btn-primary py-3 px-4">Hire me</a> <a href="#" class="btn btn-white btn-outline-white py-3 px-4">My works</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    </div>
</section>