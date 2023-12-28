
<main class="main-content site-wrapper-reveal complaints-page">

    <!--== Start Breadcrumb Wrapper ==-->

<section class="py-5  breadcrumb-sec" data-bg-color="#eaeded">
<div class="container">
    <div class="row" >
        <h2>Complaints And Suggestions</h2>
        <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ websiteUrl('en/home') }}">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Complaints And Suggestions</li>
            </ol>
        </nav>
    </div>
</div>
</section>

<section class="py-5 ">
<div class="container">
  <div class="row align-items-center">
    <h3 class="font-size-40 fw-bold text-center">Partners' Satisfaction <span class="text-main fw-light"> Is Our Main Concern</span></h3>
    <p class="text-center font-size-16 fw-bold">Med Right has always been a customer-oriented organization who considers clients satisfaction a main concern</p>
      <div class="col-lg-6 d-flex order-1 order-lg-0 aos-init aos-animate" data-aos="fade-right" data-aos-duration="1100">
          <div>
              <p class="font-size-18">At Med Right, we are serious about partners’ satisfaction. And we make sure that everything is done the right way, to fulfill clients’ well-being. Nevertheless, Med Right teams are humans. Sometimes your experience might not be the same as you’ve expected. On those occasions, we’re committed to admitting the errors and make appropriate amendments. We would love to hear from you if you’ve a complaint and/or a suggestion. We appreciate your input to improve our services. ​</p>
          </div>
      </div>
      <div class="col-lg-6 mb-4 mb-lg-0 order-0 order-lg-1 d-none d-lg-block">
          <div data-aos="fade-left" data-aos-duration="1100" class="aos-init aos-animate">
              <img src="{{ asset('frontend/assets') }}/img/photos/complaints-pic.png" alt="membership-club">
          </div>
      </div>
  </div>
</div>
</section>

<section class="py-5" data-bg-color="#eaeded">
<div class="container">
<div class="row">
  <div class="col-lg-12 aos-init aos-animate" data-aos="fade-up" data-aos-duration="1100">
    <div class="contact-form">
      <div class="section-title text-center">
        <h2 class="title">Please, fill out <span>the below form explaining your complaint and/or suggestions.</span></h2>
      </div>
      <form id="complaintsForm" class="contact-form-wrapper"   method="">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <input required class="form-control" type="text" name="con_name" placeholder="Your Name">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <input required class="form-control" type="email" name="con_email" placeholder="Email Address">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <input required class="form-control" type="text" name="con_subject" placeholder="Phone Number">
            </div>
          </div>
          <div class="col-md-12">
            <label for="character-type">Please identify your character</label>
            <div class="form-group">
              <select required id="character-select" class="form-select">
                <option value="" class="">Select An Option</option>
                <option value="Member" class=" ">Member</option>
                <option value="Provider" class=" ">Provider</option>
                <option value="Broker" class=" ">Broker</option>
                <option value="Other (Please specify)" class=" ">Other (Please specify)</option>
              </select>
            </div>
          </div>

          <div class="col-md-12 additional-field" id="member-field">
            <div class="form-group">
              <input class="form-control" type="text" name="con_Membership" placeholder="Membership-ID">
            </div>
          </div>

          <div class="col-md-12 additional-field" id="other-field">
            <div class="form-group">
              <input class="form-control" type="text" name="con_specify" placeholder="Please specify">
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group mb-0">
              <textarea name="con_message" rows="5" placeholder="Write your message here"></textarea>
            </div>
          </div>
          <div class="col-md-12 text-center">
            <div class="form-group mb-0">
              <button class="btn btn-theme" type="submit">Send Message</button>
            </div>
          </div>
        </div>
      </form>
    </div>
    <!-- Message Notification -->
    <!-- <div class="form-message"></div> -->
  </div>
</div>
</div>
</section>

</main>
