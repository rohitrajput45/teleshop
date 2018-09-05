<!-- ======================================
	        ==   Start Main Slider area  ==
	====================================== -->
	<section id="home"> 
        <!-- Carousel -->
        <div id="main-slide" class="carousel slide" data-ride="carousel">

            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#main-slide" data-slide-to="0" class="active"></li>
                <li data-target="#main-slide" data-slide-to="1" class=""></li>
                <li data-target="#main-slide" data-slide-to="2" class=""></li>
            </ol><!--/ Indicators end-->

            <!-- Carousel inner -->
            <div class="carousel-inner">
                <div class="item">
                    <img class="img-responsive" src="<?php echo base_url().FRONT_THEME;?>images/slide-1.jpg" alt="slider">
                    <div class="hero hidden-xs">
                        <h1 class="animated bounceIn">Premium Products at Great Prices. </h1>        
                    </div>
                </div><!--/ Carousel item end -->
                <div class="item active">
                    <img class="img-responsive" src="<?php echo base_url().FRONT_THEME;?>images/slide-2.jpg" alt="slider">
                    <div class="hero hidden-xs">
                        <h1 class="animated bounceIn">Limestone and Gravel Delivery.</h1>        
                    </div>
                </div><!--/ Carousel item end -->
                <div class="item">
                    <img class="img-responsive" src="<?php echo base_url().FRONT_THEME;?>images/slide-3.jpg" alt="slider">
                    <div class="hero hidden-xs">
                        <h1 class="animated bounceIn">River Sand and Dirt Delivery!</h1>        
                    </div>
                </div><!--/ Carousel item end -->
            </div><!-- Carousel inner end-->

            <!-- Controls -->
            <a class="left carousel-control" href="#main-slide" data-slide="prev">
                <span><i class="fa fa-angle-left"></i></span>
            </a>
            <a class="right carousel-control" href="#main-slide" data-slide="next">
                <span><i class="fa fa-angle-right"></i></span>
            </a>
        </div><!-- /carousel -->        
    </section>
	<!-- ======================================
	        ==   End Main Slider area  ==
	====================================== -->
	<!-- ======================================
	        ==   Start Search area  ==
	====================================== -->
	<section class="search_area">
		<div class="container">
			<div class="row">			
				<div class="col-md-12">
					<div class="search_info">
						<h1 class="txt_search" data-in-effect="bounceInUp"  data-out-effect="bounceOutDown">Start Here!</h1>
						<h6>Shop Securely Anytime, Anywhere</h6>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-offset-2 col-md-8">
					<div class="search_form">					
						<form id="fautocomplete1" action="<?php echo base_url('products'); ?>" method="post">
							<div class="search_bar">
								<input type="text" placeholder="Enter Your Delivery Location" name="address" class="autocomplete" id="autocomplete1" >
								<i class="icon ion-edit"></i>
                                <input type="hidden" class="lat" name="latitude" >
                                <input type="hidden" class="long" name="longitude" >
                                <input type="hidden" name="street_address" class="street_number">
                                <input type="hidden" name="street_address1" class="route">
                                <input type="hidden" name="city" class="locality">
                                <input type="hidden" name="state" class="administrative_area_level_1">
                                <input type="hidden" name="zipcode" class="postal_code">
                                <input type="hidden" name="country" class="country">
							</div>
							<!---<div class="search_btn">
								<button class="srch_btn btn3">Search</button>
							</div>-->
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- ======================================
	        ==  End Search area  ==
	====================================== -->
	<!-- ======================================
	        ==  Start About Me area  ==
	====================================== -->
	<section class="about_me">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
				    <div class="title_style">
				        <h1>We're Sand'n Soil!</h1>
				        <div class="clearfix"></div>
				        <p>Online sales and delivery of bulk landscape and construction materials.</p>
				    </div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-5 col-md-offset-1 col-sm-6 animated fadeIn delay-06" data-animation="fadeIn" data-animation-delay="06">
					 <div class="picks_img">
                        <iframe width="100%" height="300" src="https://www.youtube.com/embed/ac7KhViaVqc" frameborder="0" allowfullscreen></iframe>
				     </div>
				</div>
				<div class="col-sm-5 animated fadeIn delay-07" data-animation="fadeIn" data-animation-delay="07"">
					<div class="exp_info">
						<article class="experience_info">
							<h2>Shop Online, Anytime!</h2>
							<div class="experience_desc">
								<p>Duis autem vel eum iriure dolor in hendrerit in vulputate velitesse molestie consequat vel illum dolore eu feugiat nulla facilisis avero eros et accumsan et iusto odio dignissim qui blandit praesentatum zzril delenit augue duis dolore te feugait nulla facilisi. Namtempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat. Namtempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat.</p>
							</div>
							<div class="read_more btn1">
								<div class="btn1_main">						
									<a href="#">Read More<i class="fa fa-angle-right"></i></a>	
								</div>
								<div class="btn1_hover">					
									<a href="#"><i class="fa fa-angle-right"></i>Read More</a>	
								</div>
							</div>
						</article>
					</div>
				</div>
			</div>
		</div>
	</section>	
	<!-- ======================================
	        ==  End About Me area  ==
	====================================== -->
	<!-- ======================================
	        ==  Start What I do area  ==
	====================================== -->
	<section class="service-wrap">
        <div class="container">
            <div class="col-md-12">
                <div class="title_style">
				    <h1>How Does It Work</h1>
				</div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xsx-6 animated fadeIn delay-01" data-animation="fadeIn" data-animation-delay="01">
                    <div class="serviceBox">
                        <div class="service-icon">
                            <span><i class="fa fa-search"></i></span>
                        </div>
                        <div class="service-content">
                            <h3 class="title">Search Online</h3>
                            <p class="description">Use your delivery address To customized product list .</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xsx-6 animated fadeIn delay-04" data-animation="fadeIn" data-animation-delay="04">
                    <div class="serviceBox blue">
                        <div class="service-icon">
                            <span><i class="fa fa-shopping-cart"></i></span>
                        </div>
                        <div class="service-content">
                            <h3 class="title">Products Section</h3>
                            <p class="description">Select` your products and add to cart. Use our calculator to help you figure out how much material you need.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xsx-6 animated fadeIn delay-02" data-animation="fadeIn" data-animation-delay="02">
                    <div class="serviceBox green">
                        <div class="service-icon">
                            <span><i class="fa fa-calendar"></i></span>
                        </div>
                        <div class="service-content">
                            <h3 class="title">Delivery Date</h3>
                            <p class="description">Select your preferred delivery date. Orders will be delivered with an estimated 4 hour delivery window!</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-4 col-sm-6 col-xsx-6 animated fadeIn delay-05" data-animation="fadeIn" data-animation-delay="05">
                    <div class="serviceBox lightgreen">
                        <div class="service-icon">
                            <span><i class="fa fa-usd"></i></span>
                        </div>
                        <div class="service-content">
                            <h3 class="title">Payment Method</h3>
                            <p class="description">Select your payment preferences. We accept credit card online and cash or check at delivery.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xsx-6 animated fadeIn delay-03" data-animation="fadeIn" data-animation-delay="03">
                    <div class="serviceBox orange">
                        <div class="service-icon">
                            <span><i><img src="<?php echo base_url().FRONT_THEME;?>images/truck-icon.png"></i></span>
                        </div>
                        <div class="service-content">
                            <h3 class="title">Delivery</h3>
                            <p class="description">Just relax.. Our team is working to have your order delivered on time!.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </section>
	<!-- ======================================
	        == End What I do area  ==
	====================================== -->
			<!-- ======================================
	        ==   Start Search area  ==
	====================================== -->
	<section class="search_area">
		<div class="container">
			<div class="row">		
				<div class="col-md-12">
					<div class="search_info">
					    <h1 class="txt_search" data-in-effect="bounceInUp"  data-out-effect="bounceOutDown">Start Here!</h1>
					    <h6>Delivery As Little 24 Hours From Purchase</h6>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-offset-2 col-md-8">
					<div class="search_form">					
						<form id="fautocomplete2" action="<?php echo base_url('products'); ?>" method="post" >
							<div class="search_bar">
								<input type="text" name="address" placeholder="Enter your delivery location here...." class="autocomplete" id="autocomplete2">
								<i class="icon ion-edit"></i>
                                 <input type="hidden" class="lat" name="latitude" >
                                    <input type="hidden" class="long" name="longitude" >
                                    <input type="hidden" name="street_address" class="street_number"
                                    >
                                    <input type="hidden" name="street_address1" class="route"
                                   >
                                    <input type="hidden" name="city" class="locality"
                                    >
                                    <input type="hidden" name="state" class="administrative_area_level_1"
                                    >
                                    <input type="hidden" name="zipcode" class="postal_code"
                                    >
                                    <input type="hidden" name="country" class="country"
                                    >
							</div>
							<!---<div class="search_btn">
								<button class="srch_btn btn3">Search</button>
							</div>-->
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- ======================================
	        ==  End Search area  ==
	====================================== -->
	<!-- ======================================
	        == Suplier area  ==
	====================================== -->
	<section class="suplier_wrap">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="title_style">
						<h1>Sand’N Soil™ Trusted Suppliers.</h1>
						<p>Sand’N Soil™ only buys from trusted suppliers. We only sale the best product available, and refuse to let anything substandard be delivered to our customers.</p>
						<p>We also have the highest possible commitment to our customer service, with our friendly team available over the phone.</p>
						<p>We are committed to save you time and money by instantly searching online.</p>
						<p>We invite you to please take a moment to see how Sand’N Soil™ will exceed your expectations</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="suplier_box">
		<div class="container">
			<div class="row">
            <div class="col-md-4 col-sm-6 animated fadeIn delay-08" data-animation="fadeIn" data-animation-delay="08">
              <div class="text-center feature-block">
                <span class="fb-icon color-info">
                  <i><img src="<?php echo base_url().FRONT_THEME;?>images/icon.png"></i>
                </span>
                <h4 class="color-info">Title Here</h4>
                <p class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus dicta error.</p>
              </div>
            </div>
            
            <div class="col-md-4 col-sm-6 animated fadeIn delay-09" data-animation="fadeIn" data-animation-delay="09">
             <div class="text-center feature-block">
                <span class="fb-icon color-warning">
                  <i><img src="<?php echo base_url().FRONT_THEME;?>images/icon2.png"></i>
                </span>
                <h4 class="color-warning">Title Here</h4>
                <p class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus dicta error.</p>
              </div>
            </div>
            
            <div class="col-md-4 col-sm-6 animated fadeIn delay-10" data-animation="fadeIn" data-animation-delay="10">
              <div class="text-center feature-block">
                <span class="fb-icon color-success">
                  <i><img src="<?php echo base_url().FRONT_THEME;?>images/icon3.png"></i>
                </span>
                <h4 class="color-success">Title Here</h4>
                <p class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus dicta error.</p>
              </div>
            </div>
          </div> 
		</div>
	</section>
	<!-- ======================================
	        == End Suplier area  ==
	====================================== -->
	<!-- ======================================
	        == Start Feedback area  ==
	====================================== -->
	<section class="feedback">
		<div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div id="testimonial-slider" class="owl-carousel">
                    <div class="testimonial">
                        <div class="testimonial-content">
                            <div class="pic">
                                <img src="<?php echo base_url().FRONT_THEME;?>images/img-1.jpg" alt="">
                            </div>
                            <h3 class="title">Williamson</h3>
                            <span class="post">Web Developer</span>
                        </div>
                        <p class="description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam dolor tellus, efficitur ut tortor id, molestie egestas nibh. In blandit ex at erat vehicula molestie. Mauris vel volutpat nulla. Suspendisse lorem ex, congue at elit id, tincidunt tempor orci. Nullam nec augue ac tellus rhoncus tincidunt nec ut ligula. Praesent.
                        </p>
                    </div>
                    <div class="testimonial">
                        <div class="testimonial-content">
                            <div class="pic">
                                <img src="<?php echo base_url().FRONT_THEME;?>images/img-2.jpg" alt="">
                            </div>
                            <h3 class="title">kristiana</h3>
                            <span class="post">Web Designer</span>
                        </div>
                        <p class="description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam dolor tellus, efficitur ut tortor id, molestie egestas nibh. In blandit ex at erat vehicula molestie. Mauris vel volutpat nulla. Suspendisse lorem ex, congue at elit id, tincidunt tempor orci. Nullam nec augue ac tellus rhoncus tincidunt nec ut ligula. Praesent.
                        </p>
                    </div>
                    <div class="testimonial">
                        <div class="testimonial-content">
                            <div class="pic">
                                <img src="<?php echo base_url().FRONT_THEME;?>images/img-3.jpg" alt="">
                            </div>
                            <h3 class="title">kristiana</h3>
                            <span class="post">Web Designer</span>
                        </div>
                        <p class="description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam dolor tellus, efficitur ut tortor id, molestie egestas nibh. In blandit ex at erat vehicula molestie. Mauris vel volutpat nulla. Suspendisse lorem ex, congue at elit id, tincidunt tempor orci. Nullam nec augue ac tellus rhoncus tincidunt nec ut ligula. Praesent.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>	
	</section>
	<!-- ======================================
	        == End Feedback area  ==
	====================================== -->
		<!-- ======================================
	        == Start Latest News area  ==
	====================================== -->
	<section class="news">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="title_style">
					    <h1>Latest News</h1>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="news_slider owl-carousel">
						<article class="single_news">					
							<figure class="news_image">
								<a href="#"><img src="<?php echo base_url().FRONT_THEME;?>images/blog-01.png" alt="news"></a>
							</figure>
							<div class="news_desc">
								<div class="news_details">
									<h3>Augue duis dolore te feugait nulla facilisi Nam liber tempor cum soluta nobis</h3>
									<a href="#">Continue Reading....</a>
								</div>
							</div>
						</article>
						<article class="single_news">					
							<figure class="news_image">
								<a href="#"><img src="<?php echo base_url().FRONT_THEME;?>images/blog-02.png" alt="news"></a>
							</figure>
							<div class="news_desc">
								<div class="news_details">
									<h3>Augue duis dolore te feugait nulla facilisi Nam liber tempor cum soluta nobis</h3>
									<a href="#">Continue Reading....</a>
								</div>
							</div>
						</article>
						<article class="single_news">					
							<figure class="news_image">
								<a href="#"><img src="<?php echo base_url().FRONT_THEME;?>images/blog-03.png" alt="news"></a>
							</figure>
							<div class="news_desc">
								<div class="news_details">
									<h3>Augue duis dolore te feugait nulla facilisi Nam liber tempor cum soluta nobis</h3>
									<a href="#">Continue Reading....</a>
								</div>
							</div>
						</article>			
					</div>
				</div>
			</div>					
		</div>
	</section>
	<!-- ======================================
	        == End Latest News area  ==
	====================================== -->