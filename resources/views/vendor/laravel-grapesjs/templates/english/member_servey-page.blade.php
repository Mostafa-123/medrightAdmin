
<main class="main-content site-wrapper-reveal">


    <section class="py-5" data-bg-color="#eaeded">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="contact-form">
              <div class="section-title text-center aos-init aos-animate" data-aos="fade-up" data-aos-duration="1100">
                <h2 class="title">Member <span> Survey</span></h2>
              </div>

              <form id="memberSurveyForm" class="contact-form-wrapper aos-init aos-animate font-size-18 formValidation"   data-aos="fade-up" data-aos-duration="1100">

                <div class="row">


                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="name-member-survey">Membership ID: </label>
                      <input required type="number" name="membershipSurvey" class="form-control" id="MembershipId-survey" placeholder="Enter your ID">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="mobile-member-survey">Mobile Number</label>
                      <input required type="number"  name="mobileSurvey" class="form-control" id="mobile-member-survey" placeholder="Enter your mobile number">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="email-member-survey">Email</label>
                      <input required type="email" name="emailSurvey"class="form-control" id="email-member-survey" placeholder="Enter your email">
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group  mt-2">
                      <label class="col-lg" for="access-method">How do you access our medical network?</label>
                      <select id="access-method" name="how-do-access" class="form-select" required>
                        <option value="" disabled selected>Select an option</option>
                        <option value="booklet">Booklet</option>
                        <option value="website">Website</option>
                        <option value="mobile-app">Mobile App</option>
                        <option value="call-center">Call Center</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group  mt-2">
                      <label class="col-lg" for="request-method">How do you request a medical approval?</label>
                      <select id="request-method" name="how-do-request" class="form-select" required>
                        <option value="" disabled selected>Select an option</option>
                        <option value="online-system">Online System</option>
                        <option value="access-website-ser">Website</option>
                        <option value="access-email-ser">Email</option>
                        <option value="whatsapp-ser">WhatsApp</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group ">
                      <div class="row align-items-center">
                        <label class="col-md-5" for="responsiveness">Approvals Responsiveness.</label>
                        <input required type="range" class="form-control-range col-md-6 col-11 p-0" value="1" id="responsiveness" min="1" max="5" oninput="updateMemberValue('responsiveness', 'responsivenessValue','additionalInputResponsiveness')">
                        <span class="col-1" id="responsivenessValue">1</span>
                      </div>
                      <div class="row align-items-start mt-3">
                        <div class="col-md-5">
                          <label for="callCenter">Call Center</label>
                          <p class="font-size-14">How quick and accurate was your complaint solved and your questions answered?</p>
                        </div>
                        <input required type="range" class="form-control-range col-md-6 col-11 p-0 mt-2" value="1" id="callCenter" min="1" max="5" oninput="updateMemberValue('callCenter', 'callCenterValue','additionalInputCallCenter')">
                        <span class="col-1" id="callCenterValue">1</span>
                      </div>
                      <div class="row align-items-start mt-3">
                        <div class="col-md-5">
                          <label for="medicalNetwork ">Medical network coverage and updates</label>
                          <p class="font-size-14">How satisfactory is the network availability in your area?</p>
                        </div>
                        <input required type="range" class="form-control-range col-md-6 col-11 p-0 mt-2" value="1" id="medicalNetwork" min="1" max="5" oninput="updateMemberValue('medicalNetwork', 'medicalNetworkValue','additionalInputMedicalNetwork')">
                        <span class="col-1" id="medicalNetworkValue">1</span>
                      </div>
                      <div class="row align-items-start mt-3">
                        <div class="col-md-5">
                          <label for="yourExperience">Your experience with our medical providers?</label>
                          <p class="font-size-14">How do you describe your experience with our medical provider?</p>
                        </div>
                        <input required type="range" class="form-control-range col-md-6 col-11 p-0 mt-2" value="1" id="yourExperience" min="1" max="5" oninput="updateMemberValue('yourExperience', 'yourExperienceValue','additionalInputYourExperience')">
                        <span class="col-1" id="yourExperienceValue">1</span>
                      </div>
                      <div class="row align-items-start mt-3">
                        <div class="col-md-5">
                          <label for="recommendOurCompany">To what extent would you recommend our company to your friends?</label>
                          <p class="font-size-14">Knowing that the lowest rating is 1 and the highest is 10</p>
                        </div>
                        <input required type="range" class="form-control-range col-md-6 col-11 p-0 mt-2" value="1" id="recommendOurCompany" min="1" max="10">
                        <span class="col-1" id="recommendOurCompanyValue">1</span>
                      </div>
                    </div>
                    </div>


                    <div class="form-group">
                      <label for="areasOfImprovement">Do you have any suggestions to improve Med Right Services?</label>
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
