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
              <h2 class="title">تقييم  <span> مقدمي الخدمة</span></h2>
            </div>
            <form id="providerSurvey" class="contact-form-wrapper aos-init aos-animate font-size-18"  data-aos="fade-up" data-aos-duration="1100">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="name">اسم مقدم الخدمة</label>
                    <input required type="text" class="form-control" name="providerName" id="name" placeholder="الاسم بالكامل">
                  </div>
                  </div>
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="mobile">رقم الهاتف</label>
                    <input required type="tel" class="form-control rtl" name="providerMobile" id="mobile" placeholder="رقم الهاتف">
                  </div>
                  </div>

                  <div class="col-md-12">
                  <div class="form-group">
                    <label for="email">البريد الالكتروني</label>
                    <input required type="email" class="form-control rtl" name="providerEmail" id="email" placeholder="البريد الكتروني ">
                  </div>
                  </div>

                  <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-6">ما هي طريقة التواصل المفضلة لديكم؟</label>
                    <div class="custom-control custom-radio col-md-3">
                      <label class="custom-control-label" for="contactMobile">التواصل عن طريق الهاتف</label>
                      <input required type="radio" id="contactMobile" name="contactMethod" class="custom-control-input">
                    </div>
                    <div class="custom-control custom-radio col-md-3">
                      <label class="custom-control-label" for="contactEmail">التواصل من خلال البريد الإلكتروني</label>
                      <input required type="radio" id="contactEmail" name="contactMethod" class="custom-control-input">
                    </div>
                  </div>
                  </div>

                  <div class="col-md-12">
                  <div class="form-group ">
                    <label class="col-12" for="responsiveness">كيف تقيم مدير حسابك؟</label>
                    <div class="row align-items-center">
                      <label class="col-md-5" for="responsiveness">سرعة الإستجابة:</label>
                      <input required type="range" class="form-control-range col-md-6 col-11 p-0" value="1" id="responsiveness" min="1" max="5" oninput="updateValue('responsiveness', 'responsivenessValue')">
                      <span class="col-1" id="responsivenessValue">1</span>
                    </div>
                    <div class="row align-items-center">
                      <label class="col-md-5" for="attitude">سلوكياته:</label>
                      <input required type="range" class="form-control-range col-md-6 col-11 p-0" value="1" id="attitude" min="1" max="5" oninput="updateValue('attitude', 'attitudeValue')">
                      <span class="col-1" id="attitudeValue">1</span>
                    </div>
                  </div>
                  </div>

                  <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-6">قدرته على تلبية رغباتكم</label>
                    <div class="custom-control custom-radio col-md-3">
                      <label class="custom-control-label" for="fulfillYes">نعم</label>
                      <input required type="radio" id="fulfillYes" name="fulfill" class="custom-control-input">
                    </div>
                    <div class="custom-control custom-radio col-md-3">
                      <label class="custom-control-label" for="fulfillNo">لا</label>
                      <input required type="radio" id="fulfillNo" name="fulfill" class="custom-control-input">
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label>كيف تقيم نظامنا أونلاين ميدرايت؟</label>
                    <div class="row align-items-center">
                      <label class="col-md-5" for="easeOfUse">سهولة إستخدامه</label>
                      <input required type="range" class="form-control-range col-md-6 col-11 p-0" value="1" id="easeOfUse" oninput="updateValue('easeOfUse','easeOfUseValue')" min="1" max="5">
                      <span class="col-1" id="easeOfUseValue">1</span>
                    </div>
                    <div class="row align-items-center">
                      <label class="col-md-5" for="downTime">وقت التوقف</label>
                      <input required type="range" class="form-control-range col-md-6 col-11 p-0" value="1" id="downTime" oninput="updateValue('downTime','downTimeValue')" min="1" max="5">
                      <span class="col-1" id="downTimeValue">1</span>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-6" >كيف تقيم دورة الدفع الخاصة بنا؟</label>
                  </div>
                  </div>

                  <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-6" for="onTime">تتلقى مدفوعاتك في الوقت المحدد</label>
                    <div class="custom-control custom-radio col-md-3">
                      <label class="custom-control-label" for="onTimeYes">نعم</label>
                      <input required type="radio" id="onTimeYes" name="onTime" class="custom-control-input">
                    </div>
                    <div class="custom-control custom-radio col-md-3">
                      <label class="custom-control-label" for="onTimeNo">لا</label>
                      <input required type="radio" id="onTimeNo" name="onTime" class="custom-control-input">
                    </div>
                  </div>
                  </div>

                  <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-6" for="paymentDetails">تتلقى تفاصيل المدفوعات الخاصة بك</label>
                    <div class="custom-control custom-radio col-md-3">
                      <label class="custom-control-label" for="paymentDetailsYes">نعم</label>
                      <input required type="radio" id="paymentDetailsYes" name="paymentDetails" class="custom-control-input">
                    </div>
                    <div class="custom-control custom-radio col-md-3">
                      <label class="custom-control-label" for="paymentDetailsNo">لا</label>
                      <input required type="radio" id="paymentDetailsNo" name="paymentDetails" class="custom-control-input">
                    </div>
                  </div>
                  </div>

                  <div class="col-md-12">
                  <div class="form-group row">
                    <label class="col-md-6" for="clearDetails">تتلقى تفاصيل واضحة حول أي رفض في حالة وجوده</label>
                    <div class="custom-control custom-radio col-md-3">
                      <label class="custom-control-label" for="clearDetailsYes">نعم</label>
                      <input required type="radio" id="clearDetailsYes" name="clearDetails" class="custom-control-input">
                    </div>
                    <div class="custom-control custom-radio col-md-3">
                      <label class="custom-control-label" for="clearDetailsNo">لا</label>
                      <input required type="radio" id="clearDetailsNo" name="clearDetails" class="custom-control-input">
                    </div>
                  </div>
                  </div>

                  <div class="col-md-12">
                  <div class="form-group row align-items-center">
                    <label class="col-md-5 " for="overallExperience" >كيف تقيم تجربتك عموما مع ميدرايت؟</label>
                    <input required  type="range"  class="form-control-range col-md-6 col-11 p-0" value="1" oninput="updateValue('overallExperience','overallExperienceValue')" id="overallExperience" min="1" max="5">
                    <span class="col-1" id="overallExperienceValue">1</span>
                  </div>
                  </div>

                  <div class="col-md-12">
                  <div class="form-group row align-items-center">
                    <label class="col-md-5" for="recommendation">إلى أي مدى ستوصي بشركتنا لمقدمي الخدمات الطبية الآخرين</label>
                    <input required type="range" class="form-control-range col-md-6 col-11 p-0" value="1" oninput="updateValue('recommendation','recommendationValue')" id="recommendation" min="1" max="5">
                    <span class="col-1" id="recommendationValue">1</span>
                  </div>
                  </div>

                  <div class="form-group">
                    <label for="areasOfImprovement">برجاء ذكر اقتراحاتك لتحسين الخدمة</label>
                    <textarea class="form-control" id="areasOfImprovement" rows="3"></textarea>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary font-size-24">ارسال</button>
              </div>

            </form>
          </div>
          <!-- Message Notification -->
          <div class="form-message"></div>
        </div>
      </div>

  </section>

  </main>
