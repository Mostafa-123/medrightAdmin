<style>
    [data-aos] {
        opacity: 1!important;
    }

    [data-bg-color="#eaeded"] {
        background-color: rgb(234, 237, 237)!important;
    }
</style>
<main class="main-content site-wrapper-reveal">


    <section class="py-5" data-bg-color="#eaeded">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="contact-form">
              <div class="section-title text-center aos-init aos-animate" data-aos="fade-up" data-aos-duration="1100">
                <h2 class="title">تقييم  <span> الاعضاء</span></h2>
              </div>

              <form id="memberSurveyForm" class="contact-form-wrapper aos-init aos-animate font-size-18 formValidation"   data-aos="fade-up" data-aos-duration="1100">

                <div class="row">


                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="name-member-survey">رقم العضوية :</label>
                      <input required type="number" name="membershipSurvey" class="form-control rtl" id="MembershipId-survey" placeholder="ادخل رقم العضوية">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="mobile-member-survey ">رقم الهاتف :
                      </label>
                      <input required ='true' type="number"  name="mobileSurvey" class="form-control rtl" id="mobile-member-survey" placeholder="رقم الهاتف">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="email-member-survey ">البريد الإلكتروني :</label>
                      <input required type="email" name="emailSurvey"class="form-control rtl" id="email-member-survey" placeholder="البريد الكتروني ">
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group  mt-2">
                      <label class="col-lg" for="access-method">كيف تصل إلى شبكتك الطبية؟</label>
                      <select id="access-method" name="how-do-access" class="form-select" required>
                        <option value="" disabled selected>حدد اختيار</option>
                        <option value="call-center">خدمة العملاء</option>
                        <option value="mobile-app">تطبيق الهاتف المحمول</option>
                        <option value="website">موقعنا الإلكتروني</option>
                        <option value="booklet">كتيب الشبكة الطبية</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group  mt-2">
                      <label class="col-lg" for="request-method">كيف تطلب الموافقة الطبية؟</label>
                      <select id="request-method" name="how-do-request" class="form-select" required>
                        <option value="" disabled selected>حدد اختيار</option>
                        <option value="whatsapp-ser">الوتساب</option>
                        <option value="access-email-ser">البريد الإلكتروني</option>
                        <option value="access-website-ser">موقعنا الإلكتروني</option>
                        <option value="online-system">نظام الأونلاين</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group ">
                      <div class="row align-items-center">
                        <label class="col-md-5" for="responsiveness">سرعة إستجابة فريق الموافقات الطبية</label>
                        <input required type="range" class="form-control-range col-md-6 col-11 p-0" value="1" id="responsiveness" min="1" max="5" oninput="updateMemberValueAr('responsiveness', 'responsivenessValue','additionalInputResponsiveness')">
                        <span class="col-1" id="responsivenessValue">1</span>
                      </div>
                      <div class="row align-items-start mt-3">
                        <div class="col-md-5">
                          <label for="callCenter">خدمة العملاء</label>
                          <p class="font-size-14">ما مدى سرعة ودقة حل شكواك والإجابة على أسئلتك؟</p>
                        </div>
                        <input required type="range" class="form-control-range col-md-6 col-11 p-0 mt-2" value="1" id="callCenter" min="1" max="5" oninput="updateMemberValueAr('callCenter', 'callCenterValue','additionalInputCallCenter')">
                        <span class="col-1" id="callCenterValue">1</span>
                      </div>
                      <div class="row align-items-start mt-3">
                        <div class="col-md-5">
                          <label for="medicalNetwork ">تغطية الشبكة الطبية والتحديثات.</label>
                          <p class="font-size-14">ما مدي رضائك عن الشبكة الطبية المتوفرة في منطقتك؟</p>
                        </div>
                        <input required type="range" class="form-control-range col-md-6 col-11 p-0 mt-2" value="1" id="medicalNetwork" min="1" max="5" oninput="updateMemberValueAr('medicalNetwork', 'medicalNetworkValue','additionalInputMedicalNetwork')">
                        <span class="col-1" id="medicalNetworkValue">1</span>
                      </div>
                      <div class="row align-items-start mt-3">
                        <div class="col-md-5">
                          <label for="yourExperience">تجربتك مع الجهة العلاجية ؟</label>
                          <p class="font-size-14">كيف تصف تجربتك مع الجهة العلاجية التي قمت بزيارتها ؟</p>
                        </div>
                        <input required type="range" class="form-control-range col-md-6 col-11 p-0 mt-2" value="1" id="yourExperience" min="1" max="5" oninput="updateMemberValueAr('yourExperience', 'yourExperienceValue','additionalInputYourExperience')">
                        <span class="col-1" id="yourExperienceValue">1</span>
                      </div>
                      <div class="row align-items-start mt-3">
                        <div class="col-md-5">
                          <label for="recommendOurCompany">إلي أي مدي سترشح شركتنا لأصدقائك ؟</label>
                          <p class="font-size-14">مع العلم أن أقل تصنيف هو 1 والأعلى 10</p>
                        </div>
                        <input required type="range" class="form-control-range col-md-6 col-11 p-0 mt-2" value="1" id="recommendOurCompany" min="1" max="10">
                        <span class="col-1" id="recommendOurCompanyValue">1</span>
                      </div>
                    </div>
                    </div>


                    <div class="form-group">
                      <label for="areasOfImprovement">هل لديك أي اقتراحات لتحسين خدمات ميدرايت؟</label>
                      <textarea class="form-control" id="areasOfImprovement" rows="3"></textarea>
                    </div>
                  </div>
                <button type="submit" class="btn btn-primary font-size-24">ارسال</button>
              </form>

            </div>

          </div>
        </div>
      </div>
    </section>

    </main>
