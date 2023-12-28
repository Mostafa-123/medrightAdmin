<style>
    [data-aos] {
        opacity: 1!important;
    }

    [data-bg-color="#eaeded"] {
        background-color: rgb(234, 237, 237)!important;
    }
</style>
<main class="main-content site-wrapper-reveal complaints-page">

  <!--== Start Breadcrumb Wrapper ==-->

<section class="py-5  breadcrumb-sec" data-bg-color="#eaeded">
<div class="container">
  <div class="row" >
      <h2>الشكاوى والاقتراحات</h2>
      <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ websiteUrl('ar/home') }}">الرئيسية</a></li>
              <li class="breadcrumb-item active" aria-current="page">الشكاوى والاقتراحات</li>
          </ol>
      </nav>
  </div>
</div>
</section>

<section class="py-5 ">
<div class="container">
<div class="row align-items-center">
  <h3 class="font-size-40 fw-bold text-center">رضاكم <span class="text-main fw-light"> هو شاغلنا الأول</span></h3>
  <p class="text-center font-size-16 fw-bold">لطالما كانت ميدرايت مؤسسة تركز على العملاء وتعتبر رضا العملاء مصدر اهتمام رئيسي.</p>
    <div class="col-lg-6 d-flex order-1 order-lg-0 aos-init aos-animate" data-aos="fade-right" data-aos-duration="1100">
        <div>
            <p class="font-size-18 ">في  ميدرايت، نحن جادون بشأن رضا الشركاء. ونتأكد من أن كل شيء يتم بالطريقة الصحيحة ، لتحقيق رفاهية العملاء. ومع ذلك ، فإن فريق ميدرايت هم بشر. في بعض الأحيان ، قد لا تكون تجربتك هي نفسها التي كنت تتوقعها. في تلك المناسبات ، نحن ملتزمون بالاعتراف بالأخطاء وإجراء التعديلات المناسبة. ولذلك نود أن نسمع منك إذا كان لديك شكوى و / أو اقتراح. نحن نقدر مساهمتك لتحسين خدماتنا. ​</p>
        </div>
    </div>
    <div class="col-lg-6 mb-4 mb-lg-0 order-0 order-lg-1 d-none d-lg-block">
        <div data-aos="fade-left" data-aos-duration="1100" class="aos-init aos-animate">
            <img src="{{asset('frontend/assets')}}/img/photos/complaints-pic.png" alt="membership-club">
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
      <h2 class="title">نحن هنا لنستمع إليك <span> ونتلقى أي شكاوى أو مقترحات تود إرسالها إلينا. فنحن نقدر مساهمتك لتحسين خدماتنا.</span></h2>
    </div>
    <form id="complaintsForm" class="contact-form-wrapper"   method="">
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <input required class="form-control" type="text" name="con_name" placeholder="الاسم بالكامل">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <input required class="form-control" type="email" name="con_email" placeholder="البريد الإلكتروني">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <input required class="form-control" type="text" name="con_subject" placeholder="رقم الهاتف">
          </div>
        </div>
        <div class="col-md-12">
          <label for="character-type">يرجى تحديد شخصيتك</label>
          <div class="form-group">
            <select required id="character-select " class="form-select selectCat">
              <option value="" class="">حدد اختيار</option>
              <option value="Member" class=" ">عضو</option>
              <option value="Provider" class=" ">مقدم خدمة</option>
              <option value="Broker" class=" ">وسيط</option>
              <option value="others" class=" ">غير ذلك ( يرجي تحديد )</option>
            </select>
          </div>
        </div>

        <div class="col-md-12 hidden-input" id="other-field">
          <div class="form-group">
            <input required class="form-control" type="text" name="con_specify" placeholder="يرجي التحديد">
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group mb-0">
            <textarea name="con_message" rows="5" placeholder="شكوتك/ إقتراحك"></textarea>
          </div>
        </div>
        <div class="col-md-12 text-center">
          <div class="form-group mb-0">
            <button class="btn btn-theme font-size-24" type="submit">ارسال</button>
          </div>
        </div>
      </div>
      <div class="pt-4 text-center text-lg-start">
        <p class="font-size-16 fw-bold">سنبذل قصارى جهدنا لحل مشكلتك في أقرب وقت ممكن</p>
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
