<!DOCTYPE html>
<html lang="en">
  <head>
    <title>DentaCare - Free Bootstrap 4 Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	@include('Layouts.Patient.LinkHeader')
  </head>
  <body>
    
   @include('Layouts.Patient.Header')
    <section class="home-slider owl-carousel">
      <div class="slider-item" style="background-image: url('{{asset('Web_assets/assets/images/bg_1.jpg')}}');">
        <div class="overlay"></div>
        <div class="container">
          <div class="row slider-text align-items-center" data-scrollax-parent="true">
            <div class="col-md-6 col-sm-12 ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
              <h1 class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Modern Dentistry in a Calm and Relaxed Environment</h1>
              <p class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
              <p data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><a href="#" class="btn btn-primary px-4 py-3" data-toggle="modal" data-target="#modalRequest">Make an Appointment</a></p>
            </div>
          </div>
        </div>
      </div>

      <div class="slider-item" style="background-image: url('{{asset('Web_assets/assets/images/bg_2.jpg')}}');">
        <div class="overlay"></div>
        <div class="container">
          <div class="row slider-text align-items-center" data-scrollax-parent="true">
            <div class="col-md-6 col-sm-12 ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
              <h1 class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Modern Achieve Your Desired Perfect Smile</h1>
              <p class="mb-4">A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
              <p><a href="#" class="btn btn-primary px-4 py-3">Make an Appointment</a></p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-intro">
    	<div class="container">
    		<div class="row no-gutters">
    			<div class="col-md-12 color-3 p-4">
    				<!-- Tab Navigation -->
    				<div class="d-flex justify-content-center mb-4">
    					<ul class="nav nav-pills" id="myTab" role="tablist" style="gap: 10px;">
    						<li class="nav-item" role="presentation">
    							<button class="nav-link active rounded-circle" id="appointments-tab" data-bs-toggle="tab" data-bs-target="#appointments" type="button" role="tab" aria-controls="appointments" aria-selected="true" style="width: 12px; height: 12px; padding: 0; background-color: #007bff;"></button>
    						</li>
    						<li class="nav-item" role="presentation">
    							<button class="nav-link rounded-circle" id="consultations-tab" data-bs-toggle="tab" data-bs-target="#consultations" type="button" role="tab" aria-controls="consultations" aria-selected="false" style="width: 12px; height: 12px; padding: 0; background-color: #6c757d;"></button>
    						</li>
    					</ul>
    				</div>

    				<!-- Tab Content -->
    				<div class="tab-content" id="myTabContent">
    					<!-- Appointments Tab -->
    					<div class="tab-pane fade show active" id="appointments" role="tabpanel" aria-labelledby="appointments-tab">
    						@if (session('success_message_cancel'))
    							<div class="alert alert-success alert-dismissible fade show" role="alert">
    								{{ session('success_message_cancel') }}
    								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    									<span aria-hidden="true">&times;</span>
    								</button>
    							</div>
    						@endif

    						@if (session('error_message_cancel'))
    							<div class="alert alert-danger alert-dismissible fade show" role="alert">
    								{{ session('error_message_cancel') }}
    								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    									<span aria-hidden="true">&times;</span>
    								</button>
    							</div>
    						@endif

    						<h5 class="card-title fw-semibold mb-4">My Appointments</h5>
                @if(Auth::guard('patient')->check())
     						<div class="table-responsive">
    							<table class="table text-nowrap mb-0 align-middle">
    								<thead class="text-dark fs-4">
    									<tr>
    										<th class="border-bottom-0">
    											<h6 class="fw-semibold mb-0">ID</h6>
    										</th>
    										<th class="border-bottom-0">
    											<h6 class="fw-semibold mb-0">Day</h6>
    										</th>
    										<th class="border-bottom-0">
    											<h6 class="fw-semibold mb-0">Start Time</h6>
    										</th>
    										<th class="border-bottom-0">
    											<h6 class="fw-semibold mb-0">End Time</h6>
    										</th>
    										<th class="border-bottom-0">
    											<h6 class="fw-semibold mb-0">Clinic</h6>
    										</th>
    										<th class="border-bottom-0">
    											<h6 class="fw-semibold mb-0">Doctor</h6>
    										</th>
    										<th class="border-bottom-0">
    											<h6 class="fw-semibold mb-0">Status</h6>
    										</th>
    										<th class="border-bottom-0">
    											<h6 class="fw-semibold mb-0">Actions</h6>
    										</th>
    									</tr>
    								</thead>
    								<tbody>
    									@foreach($patient->appointments as $appointment)
    										<tr>
    											<th scope="row">{{$appointment->id}}</th>
    											<td>{{$appointment->day}}</td>
    											<td>{{$appointment->start_time}}</td>
    											<td>{{$appointment->end_time}}</td>
    											<td>{{$appointment->clinic->name ?? '-'}}</td>
    											<td>{{$appointment->doctor->name ?? '-'}}</td>
    											<td>
    												@php
    													if($appointment->day < date('Y-m-d') && $appointment->status == 'pending') {
    														$appointment->status = 'cancelled';
    													}
    												@endphp
    												<span class="badge bg-{{$appointment->status == 'pending' ? 'warning' : ($appointment->status == 'completed' ? 'success' : 'danger')}}">
    													{{ucfirst($appointment->status)}}
    												</span>
    											</td>
    											<td>
    												@if($appointment->status == 'pending' && $appointment->day != date('Y-m-d'))
    												<form action="{{ route('patient.appointment.cancel', $appointment->id) }}" method="POST" class="d-inline">
    													@csrf
    													@method('PUT')
    													<input type="hidden" name="status" value="cancelled">
    													<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to cancel this appointment?')">
    														Cancel
    													</button>
    												</form>
    												@else
    													<span class="text-muted">Cannot cancel</span>
    												@endif
    											</td>
    										</tr>
    									@endforeach
    								</tbody>
    							</table>
    						</div>
                @else
                  <div class="alert alert-danger">
                    Please login to view your appointments.
                  </div>
                @endif

    					</div>

    					<!-- Consultations Tab -->
    					<div class="tab-pane fade" id="consultations" role="tabpanel" aria-labelledby="consultations-tab">
    						@if (session('success_message'))
    							<div class="alert alert-success alert-dismissible fade show" role="alert">
    								{{ session('success_message') }}
    								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    									<span aria-hidden="true">&times;</span>
    								</button>
    							</div>
    						@endif

    						@if (session('error_message'))
    							<div class="alert alert-danger alert-dismissible fade show" role="alert">
    								{{ session('error_message') }}
    								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    									<span aria-hidden="true">&times;</span>
    								</button>
    							</div>
    						@endif

    						<h5 class="card-title fw-semibold mb-4">My Consultations</h5>
                @if(Auth::guard('patient')->check())
    						<div class="table-responsive">
    							<table class="table text-nowrap mb-0 align-middle">
    								<thead class="text-dark fs-4">
    									<tr>
    										<th class="border-bottom-0">
    											<h6 class="fw-semibold mb-0">ID</h6>
    										</th>
                        <th class="border-bottom-0">
    											<h6 class="fw-semibold mb-0">Doctor</h6>
    										</th>
    										<th class="border-bottom-0">
    											<h6 class="fw-semibold mb-0">Question</h6>
    										</th>
    										<th class="border-bottom-0">
    											<h6 class="fw-semibold mb-0">Answer</h6>
    										</th>
    										<th class="border-bottom-0">
    											<h6 class="fw-semibold mb-0">Created At</h6>
    										</th>
    									</tr>
    								</thead>
    								<tbody>
    									@if($patient->consultations && count($patient->consultations) > 0)
    										@foreach($patient->consultations as $consultation)
    											<tr>
    												<th scope="row">{{$consultation->id}}</th>
    												<td>{{$consultation->doctor->name ?? '-'}}</td>
    												<td>{{$consultation->question}}</td>
    												<td>{{$consultation->answer ?? 'Not answered yet'}}</td>
    												<td>{{$consultation->created_at->format('Y-m-d H:i')}}</td>
    											</tr>
    										@endforeach
    									@else
    										<tr>
    											<td colspan="5" class="text-center">No consultations found.</td>
    										</tr>
    									@endif
    								</tbody>
    							</table>
    						</div>
                            @else
                              <div class="alert alert-danger">
                                Please login to view your consultations.
                              </div>
                            @endif
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </section>
  
    <div id="services">
    <section class="ftco-section ftco-services">
      <div class="container">
      	<div class="row justify-content-center mb-5 pb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
            <h2 class="mb-2">Our Service Keeps you Smile</h2>
            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
          </div>
        </div>
        <div class="row">
        @if($services && count($services) > 0)
        @foreach($services as $service)
        <div class="col-lg-3 col-md-6 d-flex mb-sm-4 ftco-animate">
        		<div class="staff">
      				<div class="img mb-4" style="background-image: url('{{asset('image/' . $service->image) }}');"></div>
      				<div class="info text-center">
      					<h3><a href="teacher-single.html">{{ $service->name }}</a></h3>
      					<span class="position">{{ $service->description }}</span>
      					<div class="text">
	        				
                <p class="card-text price">Price: ${{ number_format($service->price, 2) }}</p>
                  <p class="card-text more-info">{{ $service->more_info }}</p>
                  <p class="card-text status">Status: {{ $service->status }}</p>
                  <p class="card-text created-by">Created by: {{ $service->receptionist->name ?? 'Unknown' }}</p>
	        				<ul class="ftco-social">
			              <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
			              <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
			              <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
			              <li class="ftco-animate"><a href="#"><span class="icon-google-plus"></span></a></li>
			            </ul>
	        			</div>
      				</div>
        		</div>
        	</div>
          @endforeach
          @else
            <div class="col-12 text-center">
              <p>No services available at the moment.</p>
            </div>
          @endif
        </div>
      </div>
      <div id="specialization">
      <div class="container-wrap mt-5">
      	<div class="row d-flex no-gutters">
      		<div class="col-md-6 img" style="background-image: url('{{asset('Web_assets/assets/images/about-2.jpg')}}');">
      		</div>
      		<div class="col-md-6 d-flex">
      			<div class="about-wrap">
      				<div class="heading-section heading-section-white mb-5 ftco-animate">
		            <h2 class="mb-2">Our Specialization</h2>
		          </div>      				
                    @foreach($doctors as $doctor)
                        <div class="list-services d-flex ftco-animate">
                            <div class="icon d-flex justify-content-center align-items-center">
                                <span class="icon-check2"></span>
                            </div>
                            <div class="text">
                                <h3>{{ $doctor->specialization->name }}</h3>
                                <p>{{ $doctor->specialization->description }}</p>
                            </div>
                        </div>
                    @endforeach
      			</div>
      		</div>
      	</div>
      </div>
      </div>
    </section>

<div id="doctors">
    <section class="ftco-section">
      <div class="container">
      	<div class="row justify-content-center mb-5 pb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
            <h2 class="mb-3">Meet Our Experience Dentist</h2>
            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences</p>
          </div>
        </div>
        <div class="row">
          @foreach($doctors as $doctor)
        	<div class="col-lg-3 col-md-6 d-flex mb-sm-4 ftco-animate">
        		<div class="staff">
      				<div class="img mb-4" style="background-image: url('{{asset('image/' . $doctor->img) }}');"></div>
      				<div class="info text-center">
      					<h3><a href="teacher-single.html">{{ $doctor->name }}</a></h3>
      					<span class="position">{{ $doctor->specialization->name }}</span>
      					<div class="text">
	        				<p>{{ $doctor->specialization->description }}</p>
	        				<ul class="ftco-social">
			              <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
			              <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
			              <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
			              <li class="ftco-animate"><a href="#"><span class="icon-google-plus"></span></a></li>
			            </ul>
	        			</div>
      				</div>
        		</div>
        	</div>
          @endforeach
        </div>

      </div>
    </section>
                            </div>

    <section class="ftco-section ftco-counter img" id="section-counter" style="background-image: url('{{asset('Web_assets/assets/images/bg_1.jpg')}}');" data-stellar-background-ratio="0.5">
    	<div class="container">
    		<div class="row d-flex align-items-center">
    			<div class="col-md-3 aside-stretch py-5">
    				<div class=" heading-section heading-section-white ftco-animate pr-md-4">
	            <h2 class="mb-3">Achievements</h2>
	            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
	          </div>
    			</div>
    			<div class="col-md-9 py-5 pl-md-5">
		    		<div class="row">
		          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18">
		              <div class="text">
		                <strong class="number" data-number="14">0</strong>
		                <span>Years of Experience</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18">
		              <div class="text">
		                <strong class="number" data-number="4500">0</strong>
		                <span>Qualified Dentist</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18">
		              <div class="text">
		                <strong class="number" data-number="4200">0</strong>
		                <span>Happy Smiling Customer</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18">
		              <div class="text">
		                <strong class="number" data-number="320">0</strong>
		                <span>Patients Per Year</span>
		              </div>
		            </div>
		          </div>
		        </div>
		      </div>
	      </div>
    	</div>
    </section>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row justify-content-center mb-5 pb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
            <h2 class="mb-3">Our Best Pricing</h2>
            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
          </div>
        </div>
    		<div class="row">
        	<div class="col-md-3 ftco-animate">
        		<div class="pricing-entry pb-5 text-center">
        			<div>
	        			<h3 class="mb-4">Basic</h3>
	        			<p><span class="price">$24.50</span> <span class="per">/ session</span></p>
	        		</div>
        			<ul>
        				<li>Diagnostic Services</li>
								<li>Professional Consultation</li>
								<li>Tooth Implants</li>
								<li>Surgical Extractions</li>
								<li>Teeth Whitening</li>
        			</ul>
        			<p class="button text-center"><a href="#" class="btn btn-primary btn-outline-primary px-4 py-3">Order now</a></p>
        		</div>
        	</div>
        	<div class="col-md-3 ftco-animate">
        		<div class="pricing-entry pb-5 text-center">
        			<div>
	        			<h3 class="mb-4">Standard</h3>
	        			<p><span class="price">$34.50</span> <span class="per">/ session</span></p>
	        		</div>
        			<ul>
        				<li>Diagnostic Services</li>
								<li>Professional Consultation</li>
								<li>Tooth Implants</li>
								<li>Surgical Extractions</li>
								<li>Teeth Whitening</li>
        			</ul>
        			<p class="button text-center"><a href="#" class="btn btn-primary btn-outline-primary px-4 py-3">Order now</a></p>
        		</div>
        	</div>
        	<div class="col-md-3 ftco-animate">
        		<div class="pricing-entry active pb-5 text-center">
        			<div>
	        			<h3 class="mb-4">Premium</h3>
	        			<p><span class="price">$54.50</span> <span class="per">/ session</span></p>
	        		</div>
        			<ul>
        				<li>Diagnostic Services</li>
								<li>Professional Consultation</li>
								<li>Tooth Implants</li>
								<li>Surgical Extractions</li>
								<li>Teeth Whitening</li>
        			</ul>
        			<p class="button text-center"><a href="#" class="btn btn-primary btn-outline-primary px-4 py-3">Order now</a></p>
        		</div>
        	</div>
        	<div class="col-md-3 ftco-animate">
        		<div class="pricing-entry pb-5 text-center">
        			<div>
	        			<h3 class="mb-4">Platinum</h3>
	        			<p><span class="price">$89.50</span> <span class="per">/ session</span></p>
	        		</div>
        			<ul>
        				<li>Diagnostic Services</li>
								<li>Professional Consultation</li>
								<li>Tooth Implants</li>
								<li>Surgical Extractions</li>
								<li>Teeth Whitening</li>
        			</ul>
        			<p class="button text-center"><a href="#" class="btn btn-primary btn-outline-primary px-4 py-3">Order now</a></p>
        		</div>
        	</div>
        </div>
    	</div>
    </section>

<div id="consultations">
		<section class="ftco-quote">
    	<div class="container">
    		<div class="row">
    			<div class="col-md-6 pr-md-5 aside-stretch py-5 choose">
    				<div class="heading-section heading-section-white mb-5 ftco-animate">
	            <h2 class="mb-2">DentaCare Procedure &amp; High Quality Services</h2>
	          </div>
	          <div class="ftco-animate">
	          	<p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar. Because there were thousands of bad Commas, wild Question Marks and devious Semikoli</p>
	          	<ul class="un-styled my-5">
	          		<li><span class="icon-check"></span>Consectetur adipisicing elit</li>
	          		<li><span class="icon-check"></span>Adipisci repellat accusamus</li>
	          		<li><span class="icon-check"></span>Tempore reprehenderit vitae</li>
	          	</ul>
	          </div>
    			</div>
    			<div class="col-md-6 py-5 pl-md-5">
    				<div class="heading-section mb-5 ftco-animate">
	            <h2 class="mb-2">Submit a consultation request now</h2>
	          </div>
			    <!-- Message Section -->
				@if (session('success_message_consultation'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success_message_consultation') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                @if (session('error_message_consultation'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error_message_consultation') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <!-- End Message Section -->
                                @if(Auth::guard('patient')->check())
	          <form action="{{ route('patient.consultation.store') }}" method="post">
	            @csrf
	            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
	            <div class="row">
	            	
		            <div class="col-md-6">
		              <div class="form-group">
		                <label for="doctor_id" class="form-label">Doctor <span class="text-danger">*</span></label>
		                <select class="form-control @error('doctor_id') is-invalid @enderror" id="doctor_id" name="doctor_id" required>
		                  <option value="">Select Doctor</option>
		                  @foreach($doctors as $doctor)
		                    <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
		                      {{ $doctor->name }}
		                    </option>
		                  @endforeach
		                </select>
		                @error('doctor_id')
		                  <div class="invalid-feedback">{{ $message }}</div>
		                @enderror
		              </div>
		            </div>
					
		            
		            <div class="col-md-12">
		              <div class="form-group">
		                <label for="question" class="form-label">Your Question <span class="text-danger">*</span></label>
		                <textarea name="question" id="question" cols="30" rows="7" class="form-control @error('question') is-invalid @enderror" placeholder="Please describe your dental concern or question..." required>{{ old('question') }}</textarea>
		                @error('question')
		                    <div class="invalid-feedback">{{ $message }}</div>
		                @enderror
		              </div>
		            </div>
	            </div>
	            <div class="col-md-12">
	                <div class="form-group">
	                    <input type="submit" value="Send" class="btn btn-primary py-3 px-5">
	                </div>
	            </div>
	          </form>
            </div>
                @else
                  <div class="alert alert-danger">
                    Please login to send a consultation request.
                  </div>
                @endif
    			</div>
    		</div>
    	</div>
    </section>
</div>
		
		<div id="map"></div>

    <footer class="ftco-footer ftco-bg-dark ftco-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-3">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">DentaCare.</h2>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
            </div>
            <ul class="ftco-footer-social list-unstyled float-md-left float-lft ">
              <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
              <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
              <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
            </ul>
          </div>
          <div class="col-md-2">
            <div class="ftco-footer-widget mb-4 ml-md-5">
              <h2 class="ftco-heading-2">Quick Links</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-2 d-block">Specialization</a></li>
                <li><a href="#" class="py-2 d-block">Features</a></li>
                <li><a href="#" class="py-2 d-block">Projects</a></li>
                <li><a href="#" class="py-2 d-block">Blog</a></li>
                <li><a href="#" class="py-2 d-block">Contact</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-3">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Office</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@yourdomain.com</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">

            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
          </div>
        </div>
      </div>
    </footer>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

  <!-- Modal -->
  <div class="modal fade" id="modalRequest" tabindex="-1" role="dialog" aria-labelledby="modalRequestLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalRequestLabel">Make an Appointment</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif

          @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session('error') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif

          @if (session('success_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('success_message') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif

          @if (session('error_message'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session('error_message') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif

          @if(Auth::guard('patient')->check())
          <form action="{{ route('patient.appointment.store') }}" method="post">
            @csrf
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="clinic_id" class="form-label">Clinic <span class="text-danger">*</span></label>
                  <select class="form-control @error('clinic_id') is-invalid @enderror" id="clinic_id" name="clinic_id" required>
                    <option value="">Select Clinic</option>
                    @foreach($clinics as $clinic)
                      <option value="{{ $clinic->id }}" {{ old('clinic_id') == $clinic->id ? 'selected' : '' }}>
                        {{ $clinic->name }}
                      </option>
                    @endforeach
                  </select>
                  @error('clinic_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
			       <input type="hidden" name="patient_id" value="{{ $patient->id }}">

              <div class="col-md-6">
                <div class="form-group">
                  <label for="doctor_id" class="form-label">Doctor <span class="text-danger">*</span></label>
                  <select class="form-control @error('doctor_id') is-invalid @enderror" id="doctor_id" name="doctor_id" required>
                    <option value="">Select Doctor</option>
                    @foreach($doctors as $doctor)
                      <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                        {{ $doctor->name }}
                      </option>
                    @endforeach
                  </select>
                  @error('doctor_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="day" class="form-label">Day <span class="text-danger">*</span></label>
                  <input type="date" class="form-control @error('day') is-invalid @enderror" 
                    id="day" name="day" value="{{ old('day') }}" required>
                  @error('day')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="start_time" class="form-label">Start Time <span class="text-danger">*</span></label>
                  <input type="time" class="form-control @error('start_time') is-invalid @enderror" 
                    id="start_time" name="start_time" value="{{ old('start_time') }}" required>
                  @error('start_time')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="end_time" class="form-label">End Time <span class="text-danger">*</span></label>
                  <input type="time" class="form-control @error('end_time') is-invalid @enderror" 
                    id="end_time" name="end_time" value="{{ old('end_time') }}" required>
                  @error('end_time')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>

            <div class="form-group text-center mt-4">
              <button type="submit" class="btn btn-primary">
                <i class="fa fa-plus me-2"></i>Create Appointment
              </button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">
                <i class="fa fa-times me-2"></i>Cancel
              </button>
            </div>
         </form>
         @else
                  <div class="alert alert-danger">
                    Please login to create an appointment.
                  </div>
                @endif
        </div>
      </div>
    </div>
  </div>

@include('Layouts.Patient.LinkJS')
    
<script>
    // Initialize Bootstrap tabs
    document.addEventListener('DOMContentLoaded', function() {
        var tabEl = document.querySelectorAll('button[data-bs-toggle="tab"]');
        tabEl.forEach(function(tab) {
            tab.addEventListener('click', function(event) {
                event.preventDefault();
                var target = document.querySelector(this.getAttribute('data-bs-target'));
                var tabContent = document.querySelectorAll('.tab-pane');
                var tabLinks = document.querySelectorAll('.nav-link');
                
                // Hide all tab content
                tabContent.forEach(function(content) {
                    content.classList.remove('show', 'active');
                });
                
                // Remove active class from all tab links
                tabLinks.forEach(function(link) {
                    link.classList.remove('active');
                });
                
                // Show the selected tab content and activate the tab link
                target.classList.add('show', 'active');
                this.classList.add('active');
            });
        });
    });
</script>
  </body>
</html>