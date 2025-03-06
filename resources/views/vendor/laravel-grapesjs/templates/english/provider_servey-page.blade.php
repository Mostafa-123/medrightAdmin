
<main class="main-content site-wrapper-reveal">


    <section class="py-5" data-bg-color="#eaeded">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="contact-form">
              <div class="section-title text-center aos-init aos-animate" data-aos="fade-up" data-aos-duration="1100">
                <h2 class="title">Provider <span> Survey</span></h2>
              </div>
              <form id="providerSurvey" class="contact-form-wrapper aos-init aos-animate font-size-18"  data-aos="fade-up" data-aos-duration="1100">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input required type="text" class="form-control" name="providerName" id="name" placeholder="Enter your name">
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                      <label for="mobile">Mobile Number</label>
                      <input required type="tel" class="form-control" name="providerMobile" id="mobile" placeholder="Enter your mobile number">
                    </div>
                    </div>

                    <div class="col-md-12">
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input required type="email" class="form-control" name="providerEmail" id="email" placeholder="Enter your email">
                    </div>
                    </div>

                    <div class="col-md-12">
                    <div class="form-group row">
                      <label class="col-md-6">Preferred Contact Method</label>
                      <div class="custom-control custom-radio col-md-3">
                        <label class="custom-control-label" for="contactMobile">Mobile</label>
                        <input required type="radio" id="contactMobile" name="contactMethod" class="custom-control-input">
                      </div>
                      <div class="custom-control custom-radio col-md-3">
                        <label class="custom-control-label" for="contactEmail">Email</label>
                        <input required type="radio" id="contactEmail" name="contactMethod" class="custom-control-input">
                      </div>
                    </div>
                    </div>

                    <div class="col-md-12">
                    <div class="form-group ">
                      <label class="col-12" for="responsiveness">How would you rate your account manager (PRO)?</label>
                      <div class="row align-items-center">
                        <label class="col-md-5" for="responsiveness">Responsiveness:</label>
                        <input required type="range" class="form-control-range col-md-6 col-11 p-0" value="1" id="responsiveness" min="1" max="5" oninput="updateValue('responsiveness', 'responsivenessValue')">
                        <span class="col-1" id="responsivenessValue">1</span>
                      </div>
                      <div class="row align-items-center">
                        <label class="col-md-5" for="attitude">Attitude:</label>
                        <input required type="range" class="form-control-range col-md-6 col-11 p-0" value="1" id="attitude" min="1" max="5" oninput="updateValue('attitude', 'attitudeValue')">
                        <span class="col-1" id="attitudeValue">1</span>
                      </div>
                    </div>
                    </div>

                    <div class="col-md-12">
                    <div class="form-group row">
                      <label class="col-md-6">Manages to Fulfill your requests?</label>
                      <div class="custom-control custom-radio col-md-3">
                        <label class="custom-control-label" for="fulfillYes">Yes</label>
                        <input required type="radio" id="fulfillYes" name="fulfill" class="custom-control-input">
                      </div>
                      <div class="custom-control custom-radio col-md-3">
                        <label class="custom-control-label" for="fulfillNo">No</label>
                        <input required type="radio" id="fulfillNo" name="fulfill" class="custom-control-input">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>How would you rate our online system, in terms of:</label>
                      <div class="row align-items-center">
                        <label class="col-md-5" for="easeOfUse">Ease of Use:</label>
                        <input required type="range" class="form-control-range col-md-6 col-11 p-0" value="1" id="easeOfUse" oninput="updateValue('easeOfUse','easeOfUseValue')" min="1" max="5">
                        <span class="col-1" id="easeOfUseValue">1</span>
                      </div>
                      <div class="row align-items-center">
                        <label class="col-md-5" for="downTime">Down Time:</label>
                        <input required type="range" class="form-control-range col-md-6 col-11 p-0" value="1" id="downTime" min="1" max="5">
                        <span class="col-1" id="downTimeValue">1</span>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group row">
                      <label class="col-md-6" >How would you rate our payment cycle?</label>
                    </div>
                    </div>

                    <div class="col-md-12">
                    <div class="form-group row">
                      <label class="col-md-6" for="onTime">You receive your payments on time</label>
                      <div class="custom-control custom-radio col-md-3">
                        <label class="custom-control-label" for="onTimeYes">Yes</label>
                        <input required type="radio" id="onTimeYes" name="onTime" class="custom-control-input">
                      </div>
                      <div class="custom-control custom-radio col-md-3">
                        <label class="custom-control-label" for="onTimeNo">No</label>
                        <input required type="radio" id="onTimeNo" name="onTime" class="custom-control-input">
                      </div>
                    </div>
                    </div>

                    <div class="col-md-12">
                    <div class="form-group row">
                      <label class="col-md-6" for="paymentDetails">You receive the details of your payment</label>
                      <div class="custom-control custom-radio col-md-3">
                        <label class="custom-control-label" for="paymentDetailsYes">Yes</label>
                        <input required type="radio" id="paymentDetailsYes" name="paymentDetails" class="custom-control-input">
                      </div>
                      <div class="custom-control custom-radio col-md-3">
                        <label class="custom-control-label" for="paymentDetailsNo">No</label>
                        <input required type="radio" id="paymentDetailsNo" name="paymentDetails" class="custom-control-input">
                      </div>
                    </div>
                    </div>

                    <div class="col-md-12">
                    <div class="form-group row">
                      <label class="col-md-6" for="clearDetails">You receive clear details about any rejections if present</label>
                      <div class="custom-control custom-radio col-md-3">
                        <label class="custom-control-label" for="clearDetailsYes">Yes</label>
                        <input required type="radio" id="clearDetailsYes" name="clearDetails" class="custom-control-input">
                      </div>
                      <div class="custom-control custom-radio col-md-3">
                        <label class="custom-control-label" for="clearDetailsNo">No</label>
                        <input required type="radio" id="clearDetailsNo" name="clearDetails" class="custom-control-input">
                      </div>
                    </div>
                    </div>

                    <div class="col-md-12">
                    <div class="form-group row p-0 align-items-center">
                      <label class="col-md-5 p-0" for="overallExperience" >How would you rate your overall experience with MedRight</label>
                      <input required  type="range"  class="form-control-range col-md-6 col-11 p-0" value="1" oninput="updateValue('overallExperience','overallExperienceValue')" id="overallExperience" min="1" max="5">
                      <span class="col-1" id="overallExperienceValue">1</span>
                    </div>
                    </div>

                    <div class="col-md-12">
                    <div class="form-group row p-0 align-items-center">
                      <label class="col-md-5 p-0" for="recommendation">To what extent would you recommend our company to other medical service providers?</label>
                      <input required type="range" class="form-control-range col-md-6 col-11 p-0" value="1" oninput="updateValue('recommendation','recommendationValue')" id="recommendation" min="1" max="5">
                      <span class="col-1" id="recommendationValue">1</span>
                    </div>
                    </div>

                    <div class="form-group">
                      <label for="areasOfImprovement">Please state the areas of improvement</label>
                      <textarea class="form-control" id="areasOfImprovement" rows="3"></textarea>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>

              </form>
            </div>
            <!-- Message Notification -->
            <div class="form-message"></div>
          </div>
        </div>
      </div>
    </section>

    </main>
