<style>
    [data-aos] {
        opacity: 1!important;
    }

    [data-bg-color="#eaeded"] {
        background-color: rgb(234, 237, 237)!important;
    }
</style>
<main class="main-content site-wrapper-reveal request-for-qou-page provider-addition-page">
  <!--== Start Breadcrumb Wrapper ==-->

  <section
    class="py-5 breadcrumb-sec"
    data-bg-color="#eaeded">
    <div class="container">
      <div class="row">
        <h2>الإنضمام لشبكة ميدرايت</h2>
        <nav
          style="--bs-breadcrumb-divider: '/'"
          aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{ websiteUrl('ar/home') }}">الرئيسية</a>
            </li>
            <li
              class="breadcrumb-item active"
              aria-current="page">
              الإنضمام لشبكة ميدرايت
            </li>
          </ol>
        </nav>
      </div>
    </div>
  </section>
<!--== End  Breadcrumb Wrapper ==-->
  <section class="py-5">
    <div class="container">
      <div class="row">
        <div class="col">
          <div
            class="section-title text-center aos-init aos-animate"
            data-aos="fade-up"
            data-aos-duration="1100">
            <h2 class="title">
              انضم  <span> لشبكتنا الطبية</span>
            </h2>
            <p class="font-size-18">
              يسعدنا انضمامكم إلى شبكتنا الطبية، فهدفنا هو بناء شبكة طبية موسعة من أفضل مقدمي الخدمات الطبية لتلبية إحتياجات عملائنا على الوجه الأكمل. لذا قمنا بوضع بعض الشروط والمعايير التي يستلزم توافرها للإنضمام إلى شبكتنا. إذا كنت مهتم بأن تصبح أحد مقدمي الخدمات الطبية في شبكة ميدرايت، من فضلك قم بملئ البيانات التالية وسيقوم أحد ممثلينا بالتواصل معك إذا كنت مستوف للشروط.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section
    class="py-5"
    data-bg-color="#eaeded">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="contact-form">
            <div
              class="section-title text-center aos-init aos-animate"
              data-aos="fade-up"
              data-aos-duration="1100">
              <h2 class="title">تقديم طلب<span> إنضمام لشبكة ميدرايت</span></h2>
              <h4>
                قم بملئ الإستمارة التالية وسنقوم بالتواصل معك فور فتح باب التقديم.
              </h4>
            </div>
            <form
              class="contact-form-wrapper aos-init aos-animate"
              id="provideAddition"
              action=""
              method="post"
              data-aos="fade-up"
              data-aos-duration="1100">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>اسم مقدم الخدمة</label>
                    <input required
                      class="form-control"
                      type="text"
                      name="con_company"
                      placeholder="الاسم القانوني لمقدم الخدمة" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>البطاقة الضريبية</label>
                    <input required
                      class="form-control"
                      type="text"
                      name="con_Tax_Card"
                      placeholder="رقم البطاقة الضريبية" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                  <label>نوع مقدم الخدمة</label>
                  <select required
                  name="ProviderType"
                    class="form-select form-select-lg"
                    aria-label="Default select example">
                      <option value="" class=" ">حدد اختيارا</option>
                      <option value="Hospital" class=" ">مستشفي</option>
                      <option value="Pharmacy" class=" ">صيدلية</option>
                      <option value="Specialized Center" class=" ">مركز متخصص</option>
                      <option value="Lab" class=" ">معمل تحاليل</option>
                      <option value="Scan Center" class=" ">مركز اشعة</option>
                      <option value="Eyeglasses" class=" ">نظارات و بصريات</option>
                      <option value="Physician" class=" ">دكتور</option>
                  </select>
                </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                  <label>التخصص</label>
                  <select required
                    name="Specialty"
                    class="form-select form-select-lg"
                    aria-label="Default select example">
                    <option value="" class=" ">حدد اختيارا</option>
                    <option value="أمراض البطن والدم" class=" ">أمراض البطن والدم</option>
                    <option value="البطن والجهاز الهضمي والكبد" class=" ">البطن والجهاز الهضمي والكبد</option>
                    <option value="البطن والغدد الصماء والسكري" class=" ">البطن والغدد الصماء والسكري</option>
                    <option value="البطن والكلى" class=" ">البطن والكلى</option>
                    <option value="جراحة المخ والأعصاب" class=" ">جراحة المخ والأعصاب</option>
                    <option value="جراحات القلب والصدر" class=" ">جراحات القلب والصدر</option>
                    <option value="أسنان" class=" ">أسنان</option>
                    <option value="الجلدية" class=" ">الجلدية</option>
                    <option value="أنف وأذن وحنجرة" class=" ">أنف وأذن وحنجرة</option>
                    <option value="الجراحة العامة" class=" ">الجراحة العامة</option>
                    <option value="جراحات الكلى والمسالك البولية" class=" ">جراحات الكلى والمسالك البولية</option>
                    <option value="الفحوصات الطبية والتحاليل" class=" ">الفحوصات الطبية والتحاليل</option>
                    <option value="التغذية" class=" ">التغذية</option>
                    <option value="الأورام" class=" ">الأورام</option>
                    <option value="البصريات" class=" ">البصريات</option>
                    <option value="العظام" class=" ">العظام</option>
                    <option value="صدرية" class=" ">صدرية</option>
                    <option value="طب الأطفال" class=" ">طب الأطفال</option>
                    <option value="الروماتيزم والجهاز المناعي" class=" ">الروماتيزم والجهاز المناعي</option>
                    <option value="الآشعة والتصوير" class=" ">الآشعة والتصوير</option>
                    <option value="جراحات الأوعية الدموية" class=" ">جراحات الأوعية الدموية</option>
                  </select>

                </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>رقم الهاتف </label>
                    <input required
                      class="form-control"
                      type="text"
                      name="con_insurer_name"
                      placeholder="رقم الهاتف" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>البريد الإلكتروني </label>
                    <input required
                      class="form-control rtl"
                      type="email"
                      name="con_email"
                      placeholder="البريد الإلكتروني" />
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>المحافظة</label>
                    <input required
                      class="form-control"
                      type="text"
                      name="con_Governorate"
                      placeholder="علي سبيل المثال : القاهرة" />
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>العنوان</label>
                    <input required
                      class="form-control"
                      type="text"
                      name="con_Address"
                      placeholder="العنوان بالتفصيل " />
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label>مسؤول التواصل </label>
                    <input required
                      class="form-control"
                      type="text"
                      name="con_contact_number"
                      placeholder="الاسم و المسمي الوظيفي" />
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>رقم الهاتف </label>
                    <input required
                      class="form-control"
                      type="text"
                      name="con_Mobile_Number"
                      placeholder="رقم هاتف الشخص المسئول" />
                  </div>
                </div>
                <div class="col-12">هل لديك عقد مع مقدمي رعاية صحية آخرين؟</div>
                <div class="col-md-3">
                  <div class="form-group my-2 d-flex align-items-center">
                    <label class="font-size-16 me-2" for="cancelation"> نعم </label>
                    <input required
                      id="cancelation"
                      type="radio"
                      name="option"
                      value="option1"
                      onclick="toggleField('option2')" />
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="form-group my-2 d-flex align-items-center">
                    <label class="font-size-16 me-2" for="approval"> لا </label>
                    <input required
                      id="approval"
                      class="p-2"
                      type="radio"
                      name="option"
                      value="option1"
                      onclick="toggleField('option1')" />
                  </div>
                </div>
                <div
                  id="additionalField"
                  class="col-md-6 additional-field">
                  <div class="form-group">
                    <label>يرجى ذكر أسمائهم</label>
                    <input required
                      class="form-control"
                      type="text"
                      id="additionalInput"
                      name="additionalInput"
                      placeholder="يرجى ذكر أسمائهم" />
                  </div>
                </div>

                <div class="col-md-12 text-center">
                  <div class="form-group mb-0">
                    <button
                      class="btn btn-theme btn-block"
                      type="submit">
                      طلب اضافة
                    </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <!-- Message Notification -->
          <div class="form-message"></div>
        </div>
      </div>
    </div>
  </section>

  <section class="divider-area bgcolor-theme bg-img" data-bg-img="{{asset('frontend/assets')}}/img/shape/01.jpg" style="background-image: url(&quot;{{asset('frontend/assets')}}/img/shape/01.jpg&quot;);">
    <div class="container">
      <div class="row content-align-center">
        <div class="col-lg-12 aos-init aos-animate" data-aos="fade-up" data-aos-duration="1100">
          <div class="divider-content-area divider-content-style1">
            <div class="content-inner">
              <h2>لماذا تنضم   <span>إلى شبكتنا؟</span></h2>
              <div class="row">
                <div class="col-lg-6 px-3 aos-init aos-animate" data-aos-duration="1100" data-aos="fade-up">
                  <div class="discount-card d-flex flex-column flex-sm-row text-center text-sm-start  align-items-center house-clinic-card p-4 discount-card mb-4">
                    <div class="text-white">
                      <i  class="font-size-60 icofont-dashboard-web pe-3"></i>
                    </div>
                    <div>
                      <h4 class="mt-3 mt-lg-0 text-white">تدريب مستمر</h4>
                      <p>لأنكم شركاء النجاح نهتم بتقديم البرامج التدريبية المستمرة ومشاركة أحدث التطورات الطبية من خلال الزيارات الدورية والإجتماعات.</p>
                    </div>
                  </div>

                </div>
                <div class="col-lg-6 px-3 aos-init aos-animate" data-aos-duration="1100" data-aos="fade-up">
                  <div class="discount-card d-flex flex-column flex-sm-row text-center text-sm-start align-items-center house-clinic-card p-4 discount-card mb-4">
                  <div class="text-white">
                    <i  class="font-size-60 icofont-flash pe-3"></i>
                  </div>
                  <div>
                    <h4 class="mt-3 mt-lg-0 text-white">نظام سداد سريع</h4>
                    <p>في ميدرايت نطبق نظام سداد سريع لدفع مستحقات مقدمي الخدمات الطبية في أقرب وقت ممكن.</p>
                  </div>
                </div>
                </div>
                <div class="col-lg-6 px-3 aos-init aos-animate" data-aos-duration="1100" data-aos="fade-up">
                  <div class="discount-card d-flex flex-column flex-sm-row text-center text-sm-start align-items-center house-clinic-card p-4 discount-card mb-4">
                  <div class="text-white">
                    <i  class="font-size-60 icofont-handshake-deal pe-3"></i>
                  </div>
                  <div>
                    <h4 class="mt-3 mt-lg-0 text-white">فريق متعاون</h4>
                    <p>فريقنا متعاون ومتفاعل ويهدف إلى بناء علاقة قوية مع مقدمي الخدمات الطبية من خلال التواصل المستمر وتقديم كل الدعم لتكونوا دائمًا على إطلاع بجميع التفاصيل والتعاون لحل أي مشكلات طارئة.</p>
                  </div>
                  </div>
                </div>
                <div class="col-lg-6 px-3 aos-init aos-animate" data-aos-duration="1100" data-aos="fade-up">
                  <div class="discount-card d-flex flex-column flex-sm-row text-center text-sm-start align-items-center house-clinic-card p-4 discount-card mb-4">                  <div class="text-white">
                    <i  class="font-size-60 icofont-building-alt pe-3"></i>
                  </div>
                  <div>
                    <h4 class="mt-3 mt-lg-0 text-white">كيان قوي</h4>
                    <p>التعاون مع شركة تستمتع بدرجة عالية من المهنية والسمعة الطيبة يضمن تواجدك بقوة في سوق الخدمات الطبية.</p>
                  </div>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</main>
