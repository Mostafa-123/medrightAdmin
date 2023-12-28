
<main class="main-content site-wrapper-reveal request-for-qou-page">

    <!--== Start Breadcrumb Wrapper ==-->

    <section class="py-5  breadcrumb-sec" data-bg-color="#eaeded">
        <div class="container">
            <div class="row">
                <h2>Request For Quotation</h2>
                <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ websiteUrl('en/home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Request For Quotation</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section-title text-center aos-init aos-animate" data-aos="fade-up"
                        data-aos-duration="1100">
                        <h2 class="title">Become<span> Our Partner</span></h2>
                        <p class="font-size-18">You’re almost there to get the best medical care for your needs, keep
                            going.</p>
                        <h4>Apply Now! And our team will contact you shortly.</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="py-5" data-bg-color="#eaeded" style="background-color: rgb(234, 237, 237);">

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact-form">
                        <div class="section-title text-center aos-init aos-animate" data-aos="fade-up"
                            data-aos-duration="1100">
                            <h2 class="title">Complete<span> Your Request </span></h2>
                            <h4>Help us match your needs by answering the following questions</h4>
                        </div>
                        <form id="requestForQoutationForm" class="contact-form-wrapper aos-init aos-animate" action=""
                            method="" data-aos="fade-up" data-aos-duration="1100">
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Company Name</label>
                                        <input required class="form-control" type="text" name="con_company"
                                            placeholder="Full Name Of Your Company">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Business Category</label>
                                        <input required class="form-control" type="text" name="con_business"
                                            placeholder="Which Industry Does Your Company Work in ?">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Total Headcount</label>
                                        <input required class="form-control" type="text" name="con_phone"
                                            placeholder="How Many Employees will be included in the coverage plan ?">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="approval">
                                            Insured
                                        </label>
                                        <input required id="approval" class="p-2" type="radio" name="option"
                                            value="option1" onclick="toggleField('option2')">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cancelation">
                                            Not Insured
                                        </label>
                                        <input required id="cancelation" type="radio" name="option" value="option1"
                                            onclick="toggleField('option1')">
                                    </div>
                                </div>

                                <div id="additionalField" class="col-lg-12 additional_field">
                                    <div class=" form-group row">
                                        <div class="col-lg-6">
                                            <label>Current Insurer</label>
                                            <input required class="form-control" type="text" id="additionalInput"
                                                name="additionalInput" placeholder="Approval Form Number">
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Renewal Date</label>
                                            <input required class="form-control" type="date" id="additionalInput"
                                                name="additionalInput" placeholder="Approval Form Number">
                                        </div>
                                    </div>
                                </div>

                                <label class="font-size-18">Contact Details :</label>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Insurer Name</label>
                                        <input required class="form-control" type="text" name="con_insurer_name"
                                            placeholder="Insurer Name">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email </label>
                                        <input required class="form-control" type="email" name="con_email"
                                            placeholder="Email Address">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Contact Number </label>
                                        <input required class="form-control" type="tel" name="con_contact_number"
                                            placeholder="Contact Number">
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <div class="form-group mb-0">
                                        <button class="btn btn-theme " type="submit">Submit My request</button>
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


    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="section-title text-center aos-init aos-animate" data-aos="fade-up" data-aos-duration="1100">
                    <h2 class="title">Med Right<span> Reviews</span></h2>
                </div>
                <div class="col-lg-6" data-aos="fade-up" data-aos-duration="1100">
                    <div>
                        <p class="font-size-16">"Med Right has proven to be an outstanding provider with regards to
                            support and customer healthcare. The Team has proven to be extremely effective throughout
                            the two years we dealt with them and their support was instrumental to our critical work
                            nature. I would highly recommend Med Right to any organization looking for a first class
                            healthcare provider to partner with."</p>
                        <div class="d-flex align-items-center">
                            <div class="img-wrapper me-3 mb-2">
                                <img src="{{ asset('frontend/assets') }}/img/icon-img/WDI-LOGO.png" alt="WDI-logo">
                            </div>
                            <div class="col-8">
                                <h5 class="mb-0 text-main">Dina Shaarawy</h5>
                                <span>HR Manager at WDI</span>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-lg-6" data-aos="fade-up" data-aos-duration="1100">
                    <div>
                        <p class="font-size-16">"It is our pleasure, that we are one of your customers, for more than 7
                            years and based on our experience with your respectful company, we found that Med Right has
                            a high responses by the website, expanding medical network, with 24/7 customer service, and
                            high quality which leads to make our employees satisfied and appreciated. We strongly
                            recommend Med Right to other companies."</p>
                        <div class="d-flex align-items-center">
                            <div class="img-wrapper me-3 mb-2">
                                <img src="{{ asset('frontend/assets') }}/img/icon-img/Teda.jpg" alt="Teda-logo">
                            </div>
                            <div class="col-8">
                                <h5 class="mb-0 text-main">HR Unit</h5>
                                <span>Egypt TEDA</span>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="divider-area bgcolor-theme bg-img py-5" data-bg-img="{{ asset('frontend/assets') }}/img/shape/01.jpg"
        style="background-image: url(&quot;{{ asset('frontend/assets') }}/img/shape/01.jpg&quot;);">
        <div class="container">
            <div class="row">
                <h2 class="text-center fw-bolder font-size-50 text-white mb-5">Useful <span
                        class="fw-light">Links</span></h2>
            </div>

            <div class="row justify-content-center text-center ">
                <div class="col-12 mb-4 mb-lg-5">
                    <h4 class="text-white">It's not a traditional medical coverage, we do more than that.</h4>
                    <a href="{{ websiteUrl('en/services') }}"
                        class="btn btn-theme btn-white fw-bold font-size-24 text-main">Discover What We Do</a>
                </div>
                <div class="col-lg-6 mb-4 mb-lg-5 ">
                    <h4 class="text-white">Learn why you should choose us?</h4>
                    <a href="{{ websiteUrl('en/about') }}"
                        class="btn btn-theme btn-white fw-bold  font-size-24 text-main">About Us</a>
                </div>
                <div class="col-lg-6 mb-4 mb-lg-5 ">
                    <h4 class="text-white">Need further assistance?</h4>
                    <a href="{{ websiteUrl('en/contact') }}"
                        class="btn btn-theme btn-white fw-bold  font-size-24 text-main">Write To Us</a>
                </div>
            </div>
        </div>
    </section>

</main>
