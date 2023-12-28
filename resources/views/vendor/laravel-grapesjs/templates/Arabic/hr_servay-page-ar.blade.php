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
              <h2 class="title">تقييم  <span> مسئول الموارد البشرية</span></h2>
            </div>

            <form  class="contact-form-wrapper aos-init aos-animate font-size-18 " id="hrSurveyForm"   data-aos="fade-up" data-aos-duration="1100">

              <div class="row">


                <div class="col-md-6">
                  <div class="form-group">
                    <label for="name-member-survey">الاسم</label>
                    <input required type="text" class="form-control" id="name-hr-survey" placeholder="الاسم بالكامل">
                    <div class="font-size-12 validation-message" id=""></div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="name-member-survey">اسم الشركة</label>
                    <input required type="text" class="form-control" id="company-hr-survey" name="company-hr-survey"  placeholder="اسم الشركة">
                    <div class="font-size-12 validation-message" id=""></div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="mobile-member-survey">رقم الهاتف</label>
                    <input required type="tel" class="form-control rtl" id="mobile-hr-survey" name="mobile-hr-survey" placeholder="رقم الهاتف">
                    <div class="font-size-12 validation-message" id=""></div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="email-member-survey">البريد الإلكتروني</label>
                    <input required type="email" class="form-control rtl" name="email-hr-survey" id="email-hr-survey" placeholder="البريد الالكتروني">
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group ">
                    <div class="row align-items-center">
                      <label class="col-md-5" for="responseHr">كيف تقيم استجابة ميدرايت لطلباتك؟</label>
                      <input required type="range" class="form-control-range col-md-6 col-11 p-0" value="1" id="responseHr" min="1" max="5" oninput="updateHrValueAr('responseHr', 'responseHrValue','additionalInputResponseHr')">
                      <span class="col-1" id="responseHrValue">1</span>
                    </div>
                    <div class="row align-items-start mt-3">
                      <div class="col-md-5">
                        <label for="accountHr">كيف تقييم مدير حسابك؟</label>
                      </div>
                      <input required type="range" class="form-control-range col-md-6 col-11 p-0 mt-2" value="1" id="accountHr" min="1" max="5" oninput="updateHrValueAr('accountHr', 'accountHrValue','additionalInputAccountHr')">
                      <span class="col-1" id="accountHrValue">1</span>
                    </div>
                    <div class="row align-items-start mt-3">
                      <div class="col-md-5">
                        <label for="specifyHr">كيف تقيم دورة السداد لدينا؟</label>
                      </div>
                      <input required type="range" class="form-control-range col-md-6 col-11 p-0 mt-2" value="1" id="specifyHr" min="1" max="5" oninput="updateHrValueAr('specifyHr', 'specifyHrValue','additionalInputSpecifyHr')">
                      <span class="col-1" id="specifyHrValue">1</span>
                    </div>

                    <div class="row align-items-start mt-3">
                      <div class="col-md-5">
                        <label for="recommendOurCompany">إلي أي مدي سترشح شركتنا لأصدقائك ؟</label>
                        <p class="font-size-14">مع العلم أن أقل تصنيف هو 1 والأعلى 10
                        </p>
                      </div>
                      <input type="range" class="form-control-range col-md-6 col-11 p-0 mt-2" value="1" id="recommendOurCompany" min="1" max="10">
                      <span class="col-1" id="recommendOurCompanyValue">1</span>
                    </div>
                  </div>
                  </div>


                  <div class="form-group">
                    <label for="areasOfImprovement">تعليقات اضافية</label>
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
