<x-layouts.master>
    <x-slot:title>
        Consulting
    </x-slot:title>
    @pushOnce('content')
<!-- ==================== Breadcumb Start Here ==================== -->
<section class="breadcumb-section bg-overlay-one" style="background-image: url(assets/images/breadcumb/breadcumb-img.png);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcumb text-center">
                    <h1 class="breadcumb-title text-white"> CONTACT WITH US</h1>
                    <ul class="breadcumb-list d-flex justify-content-center">
                        <li><a href="index.html"> Home </a></li>
                        <li> <span> - </span> </li>
                        <li> CONTACT US</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ==================== Breadcumb End Here ==================== -->

<!-- ==================== Contact Map Start Here ==================== -->

<section class=" contact-address mt-60 pb-60">
    <div class="container">
        <div class="row gy-4 justify-content-center">
            <div class="col-lg-4 col-md-4">
                <div class="address-item text-center">
                    <div class="thumb"><img src="assets/images/contact/location.png" alt=""></div>
                    <div class="content">
                        <h5 class="title">Office Address</h5>
                        <p class="para">14 Tottenham Road, N1 4EP London, United Kingdom</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="address-item text-center">
                    <div class="thumb"><img src="assets/images/contact/phone-book.png" alt=""></div>
                    <div class="content">
                        <h5 class="title">Phone Number</h5>
                        <p class="para"><a href="tel:">+701  000 1111  2222  3333</a></p>
                        <p class="para"><a href="tel:">+801  000 1111  2222  3333</a></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="address-item text-center">
                    <div class="thumb"><img src="assets/images/contact/mail.png" alt=""></div>
                    <div class="content">
                        <h5 class="title">Email Address</h5>
                        <p class="para"><a href="https://template.viserlab.com/cdn-cgi/l/email-protection#73"><span class="__cf_email__" data-cfemail="3a5e5f57555955574a5b54437a5d575b535614595557">[email&#160;protected]</span> </a></p>
                        <p class="para"><a href="https://template.viserlab.com/cdn-cgi/l/email-protection#21"><span class="__cf_email__" data-cfemail="5c3924312c303968696b1c3b313d3530723f3331">[email&#160;protected]</span></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="consultation-form pt-60 pb-60">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 col-md-10 col-sm-12">
        <form class="contact-form" autocomplete="off">
          <h3 class="title text-center mb-4">Donate to Our Association</h3>

          <div class="row g-3">
            <!-- First Name -->
            <div class="col-md-6">
              <input
                type="text"
                class="form-control form--control"
                placeholder="First Name"
                required
              />
            </div>

            <!-- Last Name -->
            <div class="col-md-6">
              <input
                type="text"
                class="form-control form--control"
                placeholder="Last Name"
                required
              />
            </div>

            <!-- Email -->
            <div class="col-md-6">
              <input
                type="email"
                class="form-control form--control"
                placeholder="Email"
                required
              />
            </div>

            <!-- Phone -->
            <div class="col-md-6">
              <input
                type="text"
                class="form-control form--control"
                placeholder="Phone"
                required
              />
            </div>

            <!-- Amount -->
            <div class="col-md-6">
              <input
                type="number"
                class="form-control form--control"
                placeholder="Donation Amount"
                required
              />
            </div>

            <!-- Currency Dropdown -->
            <div class="col-md-6">
              <select
                class="form-select form--control"
                required
              >
                <option value="">Select Currency</option>
                <option value="USD">USD ($)</option>
                <option value="EUR">EUR (€)</option>
                <option value="GBP">GBP (£)</option>
                <option value="AFN">AFN (؋)</option>
                <option value="CAD">CAD ($)</option>
                <option value="AUD">AUD ($)</option>
              </select>
            </div>

            <!-- Message -->
            <div class="col-12">
              <textarea
                class="form-control form--control"
                rows="4"
                placeholder="Message (optional)"
              ></textarea>
            </div>

            <!-- Submit Button -->
            <div class="col-12">
              <div class="contact-button mt-3">
                <button
                  type="submit"
                  class="btn--base style-three w-100"
                >
                  Donate
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="consultation-form pt-60 pb-60">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10 col-sm-12">
                        <form id="membershipForm" autocomplete="off">
                            @csrf
                            <h3 class="title text-center mb-4">Request for Membership</h3>

                            <div class="row g-3">

                                <!-- First Name -->
                                <div class="col-md-6">
                                    <input type="text" class="form-control form--control" name="first_name" placeholder="Enter your first name">
                                    <div class="text-danger small mt-1" id="error_first_name"></div>
                                </div>

                                <!-- Last Name -->
                                <div class="col-md-6">
                                    <input type="text" class="form-control form--control" name="last_name" placeholder="Enter your last name">
                                    <div class="text-danger small mt-1" id="error_last_name"></div>
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <input type="email" class="form-control form--control" name="email" placeholder="Enter your email">
                                    <div class="text-danger small mt-1" id="error_email"></div>
                                </div>

                                <!-- Phone -->
                                <div class="col-md-6">
                                    <input type="text" class="form-control form--control" name="phone" placeholder="Enter your phone number">
                                    <div class="text-danger small mt-1" id="error_phone"></div>
                                </div>

                                <!-- Gender -->
                                <div class="col-md-6">
                                    <select class="form-select form--control" name="gender">
                                        <option value="">Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                    <div class="text-danger small mt-1" id="error_gender"></div>
                                </div>

                                <!-- Date of Birth -->
                                <div class="col-md-6">
                                    <label class="form-label">Date of Birth (تاریخ تولد)</label>
                                    <input type="date" class="form-control form--control" name="date_of_birth">
                                    <div class="text-danger small mt-1" id="error_date_of_birth"></div>
                                </div>

                                <!-- Address -->
                                <div class="col-12">
                                    <input type="text" class="form-control form--control" name="address" placeholder="Enter your address">
                                    <div class="text-danger small mt-1" id="error_address"></div>
                                </div>

                                <!-- Country -->
                                <div class="col-md-6">
                                    <input type="text" class="form-control form--control" name="country" placeholder="Enter your country">
                                    <div class="text-danger small mt-1" id="error_country"></div>
                                </div>

                                <!-- Occupation -->
                                <div class="col-md-6">
                                    <input type="text" class="form-control form--control" name="occupation" placeholder="Enter your occupation">
                                    <div class="text-danger small mt-1" id="error_occupation"></div>
                                </div>

                                <!-- Organization Name -->
                                <div class="col-12">
                                    <input type="text" class="form-control form--control" name="organization_name" placeholder="Name of your organization (optional)">
                                    <div class="text-danger small mt-1" id="error_organization_name"></div>
                                </div>

                                <!-- Membership Type -->
                                <div class="col-md-6">
                                    <select class="form-select form--control" name="membership_type">
                                        <option value="">Select Membership Type</option>
                                        <option value="Regular">Regular Member</option>
                                        <option value="Volunteer">Volunteer Member</option>
                                        <option value="Honorary">Honorary Member</option>
                                    </select>
                                    <div class="text-danger small mt-1" id="error_membership_type"></div>
                                </div>

                                <!-- Reason for Joining -->
                                <div class="col-12">
                                    <textarea class="form-control form--control" name="reason_for_joining" rows="4" placeholder="Why do you want to join our Association?"></textarea>
                                    <div class="text-danger small mt-1" id="error_reason_for_joining"></div>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-12">
                                    <div class="contact-button mt-3">
                                        <button type="submit" class="btn--base style-three w-100">Submit Request</button>
                                    </div>
                                </div>

                                <!-- Message -->
                                <div class="col-12 mt-2">
                                    <div id="formMessage"></div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

<!-- ==================== Brand Srart Here ==================== -->
<div class="brand pt-60 pb-120">
    <div class="container">
        <div class="brand-slider style-two d-flex justify-content-between flex-wrap">
            <img src="assets/images/brand/brand-01.png" alt="">
            <img src="assets/images/brand/brand-02.png" alt="">
            <img src="assets/images/brand/brand-03.png" alt="">
            <img src="assets/images/brand/brand-04.png" alt="">
            <img src="assets/images/brand/brand-05.png" alt="">
            <img src="assets/images/brand/brand-02.png" alt="">
        </div>
    </div>
</div>
<!-- ==================== Brand End Here ==================== -->

<!-- ==================== CTA Start Here ==================== -->
<section class="cta bg-overlay-one">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="cta-content">
                    <div class="section-heading">
                        <h3 class="title text-white">Our Latest News Update</h3>
                        <p class="para text-white">We're here with you to analyzing your business according to different points of view and guide you in your business.</p>
                    </div>
                    <form action="#" autocomplete="off">
                        <div class="input--group">
                            <input type="email" class="form-control form--control" placeholder="Enter Email Address" required="">
                            <button type="submit"><i class="lab la-telegram-plane"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ==================== CTA End Here ==================== -->
    @endPushOnce
  @pushOnce('js')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.getElementById('membershipForm').addEventListener('submit', function(e){
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);
            const token = document.querySelector('input[name="_token"]').value;
            const messageDiv = document.getElementById('formMessage');

            // Clear previous errors
            document.querySelectorAll('.text-danger').forEach(el => el.innerText = '');
            messageDiv.innerHTML = '';

            // Front-end validation
            let hasError = false;

            // First Name
            if(form.first_name.value.trim() === ''){
                document.getElementById('error_first_name').innerText = 'First Name is required';
                hasError = true;
            }

            // Last Name
            if(form.last_name.value.trim() === ''){
                document.getElementById('error_last_name').innerText = 'Last Name is required';
                hasError = true;
            }

            // Email
            const email = form.email.value.trim();
            if(email === ''){
                document.getElementById('error_email').innerText = 'Email is required';
                hasError = true;
            } else {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if(!emailRegex.test(email)){
                    document.getElementById('error_email').innerText = 'Invalid email format';
                    hasError = true;
                }
            }

            // Gender
            if(form.gender.value === ''){
                document.getElementById('error_gender').innerText = 'Gender is required';
                hasError = true;
            }

            // Date of Birth
            if(form.date_of_birth.value === ''){
                document.getElementById('error_date_of_birth').innerText = 'Date of Birth is required';
                hasError = true;
            }

            // Membership Type
            if(form.membership_type.value === ''){
                document.getElementById('error_membership_type').innerText = 'Membership Type is required';
                hasError = true;
            }

            // Reason for Joining
            if(form.reason_for_joining.value.trim() === ''){
                document.getElementById('error_reason_for_joining').innerText = 'Reason for Joining is required';
                hasError = true;
            }

            if(hasError) return;

            // Axios submit
            axios.post("{{ route('membership.store') }}", formData, {
                headers: { 'X-CSRF-TOKEN': token }
            })
            .then(function(response){
                messageDiv.innerHTML = '<div class="alert alert-success">'+response.data.message+'</div>';
                form.reset();
                setTimeout(() => { messageDiv.innerHTML = ''; }, 10000);
            })
            .catch(function(error){
                messageDiv.innerHTML = '<div class="alert alert-danger">An error occurred. Please try again.</div>';
                setTimeout(() => { messageDiv.innerHTML = ''; }, 10000);
            });

        });
    </script>
    @endPushOnce
</x-layouts.master>