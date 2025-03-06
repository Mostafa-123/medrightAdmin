
<main class="main-content site-wrapper-reveal">


    <section class="py-5" data-bg-color="#eaeded">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="contact-form">
              <div class="section-title text-center aos-init aos-animate" data-aos="fade-up" data-aos-duration="1100">
                <h2 class="title">HR <span> Survey</span></h2>
              </div>

              <form  class="contact-form-wrapper aos-init aos-animate font-size-18 " id="hrSurveyForm"   data-aos="fade-up" data-aos-duration="1100">

                <div class="row">


                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="name-member-survey">Name</label>
                      <input required type="text" class="form-control" id="name-hr-survey" placeholder="Enter your Full name">
                      <div class="font-size-12 validation-message" id=""></div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="name-member-survey">Company Name</label>
                      <input required type="text" class="form-control" id="company-hr-survey" name="company-hr-survey"  placeholder="Enter your name">
                      <div class="font-size-12 validation-message" id=""></div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="mobile-member-survey">Mobile Number</label>
                      <input required type="tel" class="form-control" id="mobile-hr-survey" name="mobile-hr-survey" placeholder="Enter your mobile number">
                      <div class="font-size-12 validation-message" id=""></div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="email-member-survey">Email</label>
                      <input required type="email" class="form-control" name="email-hr-survey" id="email-hr-survey" placeholder="Enter your email">
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group ">
                      <div class="row align-items-center">
                        <label class="col-md-5" for="responseHr">How would you rate Med Right response to your requests?</label>
                        <input required type="range" class="form-control-range col-md-6 col-11 p-0" value="1" id="responseHr" min="1" max="5" oninput="updateHrValue('responseHr', 'responseHrValue','additionalInputResponseHr')">
                        <span class="col-1" id="responseHrValue">1</span>
                      </div>
                      <div class="row align-items-start mt-3">
                        <div class="col-md-5">
                          <label for="accountHr">How would you rate your account manager (CRO)?</label>
                        </div>
                        <input required type="range" class="form-control-range col-md-6 col-11 p-0 mt-2" value="1" id="accountHr" min="1" max="5" oninput="updateHrValue('accountHr', 'accountHrValue','additionalInputAccountHr')">
                        <span class="col-1" id="accountHrValue">1</span>
                      </div>
                      <div class="row align-items-start mt-3">
                        <div class="col-md-5">
                          <label for="specifyHr">Please specify why like this area.</label>
                        </div>
                        <input required type="range" class="form-control-range col-md-6 col-11 p-0 mt-2" value="1" id="specifyHr" min="1" max="5" oninput="updateHrValue('specifyHr', 'specifyHrValue','additionalInputSpecifyHr')">
                        <span class="col-1" id="specifyHrValue">1</span>
                      </div>

                      <div class="row align-items-start mt-3">
                        <div class="col-md-5">
                          <label for="recommendOurCompany">To what extent would you recommend our company to your friends?</label>
                          <p class="font-size-14">Knowing that the lowest rating is 1 and the highest is 10</p>
                        </div>
                        <input type="range" class="form-control-range col-md-6 col-11 p-0 mt-2" value="1" id="recommendOurCompany" min="1" max="10">
                        <span class="col-1" id="recommendOurCompanyValue">1</span>
                      </div>
                    </div>
                    </div>


                    <div class="form-group">
                      <label for="areasOfImprovement">Additional Comments</label>
                      <textarea class="form-control" id="areasOfImprovement" rows="3"></textarea>
                    </div>
                  </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>

            </div>

          </div>
        </div>
      </div>
    </section>

    </main>
