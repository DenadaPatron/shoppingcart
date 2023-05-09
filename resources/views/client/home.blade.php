@extends('client_layout.client')

@section('title')
Home
@endsection

@section('content')
	<!-- start content -->
	<section id="home-section" class="hero vh-100 d-flex align-items-center">
		<div class="home-slider owl-carousel vh-100 d-flex align-items-center">
			@foreach ($sliders as $slider)
			<div class="slider-item vh-100 d-flex align-items-center" style="background-image: url(storage/slider_images/{{$slider->slider_image}}); background-size: cover; background-position: center; height: 100%;">
				<div class="overlay" style="background-color: rgb(0, 0, 0);"></div>
				<div class="container" style="background-color: rgb(0, 0, 0, 0.3);">
					<div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">
	
						<div class="col-md-12 ftco-animate text-center">
							<h1 class="mb-2 opensans">{{$slider->description1}}</h1>
							<h2 class="subheading mb-4">{{$slider->description2}}</h2>
							{{-- &amp; fruits --}}
							<p><a href="#" class="btn btn-primary">View Details</a></p>
						</div>
	
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</section>
	

  <section class="ftco-section">
		  <div class="container">
			  <div class="row no-gutters ftco-services">
		<div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
		  <div class="media block-6 services mb-md-0 mb-4">
			<div class="icon bg-color-2 active d-flex justify-content-center align-items-center mb-2">
				  <span class="flaticon-shipped"></span>
			</div>
			<div class="media-body">
			  <h3 class="heading">Free Shipping</h3>
			  <span>On order over $100</span>
			</div>
		  </div>      
		</div>
		<div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
		  <div class="media block-6 services mb-md-0 mb-4">
			<div class="icon bg-color-2 d-flex justify-content-center align-items-center mb-2">
				  <span class="flaticon-award"></span>
			</div>
			<div class="media-body">
			  <h3 class="heading">Great Discounts</h3>
			  <span>Always save money!</span>
			</div>
		  </div>    
		</div>
		<div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
		  <div class="media block-6 services mb-md-0 mb-4">
			<div class="icon bg-color-2 d-flex justify-content-center align-items-center mb-2">
				  <span class="flaticon-award"></span>
			</div>
			<div class="media-body">
			  <h3 class="heading">Superior Quality</h3>
			  <span>Quality Products</span>
			</div>
		  </div>      
		</div>
		<div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
		  <div class="media block-6 services mb-md-0 mb-4">
			<div class="icon bg-color-2 d-flex justify-content-center align-items-center mb-2">
				  <span class="flaticon-customer-service"></span>
			</div>
			<div class="media-body">
			  <h3 class="heading">Support</h3>
			  <span>24/7 Support</span>
			</div>
		  </div>      
		</div>
	  </div>
		  </div>
	  </section>

	  {{-- <section class="ftco-section ftco-category ftco-no-pt">
		  <div class="container">
			  <div class="row">
				  <div class="col-md-8">
					  <div class="row">
						  <div class="col-md-6 order-md-last align-items-stretch d-flex">
							  <div class="category-wrap-2 ftco-animate img align-self-stretch d-flex" style="background-image: url(frontend/images/category.jpg);">
								  <div class="text text-center">
									  <h2>Vegetables</h2>
									  <p>Protect the health of every home</p>
									  <p><a href="#" class="btn btn-primary">Shop now</a></p>
								  </div>
							  </div>
						  </div>
						  <div class="col-md-6">
							  <div class="category-wrap ftco-animate img mb-4 d-flex align-items-end" style="background-image: url(frontend/images/category-1.jpg);">
								  <div class="text px-3 py-1">
									  <h2 class="mb-0"><a href="#">Fruits</a></h2>
								  </div>
							  </div>
							  <div class="category-wrap ftco-animate img d-flex align-items-end" style="background-image: url(frontend/images/category-2.jpg);">
								  <div class="text px-3 py-1">
									  <h2 class="mb-0"><a href="#">Vegetables</a></h2>
								  </div>
							  </div>
						  </div>
					  </div>
				  </div>

				  <div class="col-md-4">
					  <div class="category-wrap ftco-animate img mb-4 d-flex align-items-end" style="background-image: url(frontend/images/category-3.jpg);">
						  <div class="text px-3 py-1">
							  <h2 class="mb-0"><a href="#">Juices</a></h2>
						  </div>		
					  </div>
					  <div class="category-wrap ftco-animate img d-flex align-items-end" style="background-image: url(frontend/images/category-4.jpg);">
						  <div class="text px-3 py-1">
							  <h2 class="mb-0"><a href="#">Dried</a></h2>
						  </div>
					  </div>
				  </div>
			  </div>
		  </div>
	  </section> --}}

  <section class="ftco-section">
	  <div class="container">
			  <div class="row justify-content-center mb-3 pb-3">
		<div class="col-md-12 heading-section text-center ftco-animate">
			<span class="subheading">Featured Products</span>
		  <h2 class="mb-4">Our Products</h2>
		  <p>Discover our stunning collection of featured piercing products, showcasing unique designs and exceptional craftsmanship for that perfect statement piece.</p>
		</div>
	  </div>   		
	  </div>
	  <div class="container">
		  <div class="row">
			  
			@foreach($products as $product)

			<div class="col-md-6 col-lg-3 ftco-animate">
				<div class="product">
					<a href="#" class="img-prod"><img class="img-fluid" src="storage/product_images/{{$product->product_image}}" alt="Colorlib Template">
						<div class="overlay"></div>
					</a>
					<div class="text py-3 pb-4 px-3 text-center">
						<h3><a href="#">{{$product->product_name}}</a></h3>
						<div class="d-flex">
							<div class="pricing">
								<p class="price"><span>{{$product->product_price . ' €'}}</span></p>
							</div>
						</div>
						<div class="bottom-area d-flex px-3">
							<div class="m-auto d-flex">
								<a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
									<span><i class="ion-ios-menu"></i></span>
								</a>
								<a href="{{url('addtocart/' .$product->id)}}" class="buy-now d-flex justify-content-center align-items-center mx-1">
									<span><i class="ion-ios-cart"></i></span>
								</a>
								<a href="#" class="heart d-flex justify-content-center align-items-center ">
									<span><i class="ion-ios-heart"></i></span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>

			@endforeach
			  
  </section>
	  


	  <!-- end content -->

@endsection



