/*
 * Translated default messages for the jQuery validation plugin.
 * Locale: AR (Arabic; العربية)
 */
$.extend( $.validator.messages, {
	required: "هذا الحقل إلزامي",
	remote: "يرجى تصحيح هذا الحقل للمتابعة",
	email: "رجاء إدخال عنوان بريد إلكتروني صحيح",
	url: "رجاء إدخال عنوان موقع إلكتروني صحيح",
	date: "رجاء إدخال تاريخ صحيح",
	dateISO: "رجاء إدخال تاريخ صحيح (ISO)",
	number: "رجاء إدخال عدد بطريقة صحيحة",
	digits: "رجاء إدخال أرقام فقط",
	creditcard: "رجاء إدخال رقم بطاقة ائتمان صحيح",
	equalTo: "رجاء إدخال نفس القيمة",
	extension: "رجاء إدخال ملف بامتداد موافق عليه",
	maxlength: $.validator.format( "الحد الأقصى لعدد الحروف هو {0}" ),
	minlength: $.validator.format( "الحد الأدنى لعدد الحروف هو {0}" ),
	rangelength: $.validator.format( "عدد الحروف يجب أن يكون بين {0} و {1}" ),
	range: $.validator.format( "رجاء إدخال عدد قيمته بين {0} و {1}" ),
	max: $.validator.format( "رجاء إدخال عدد أقل من أو يساوي {0}" ),
	min: $.validator.format( "رجاء إدخال عدد أكبر من أو يساوي {0}" )
} );


// request Medical Approval page"

$("#requestMedicalApproval").validate({
    rules: {
      con_name: { required: !0, minlength: 10 },
      con_company: { required: !0, minlength: 2 },
      con_phone: { required: !0, minlength: 8, maxlength: 12 },
      con_email: { required: !0, email: !0 },
      con_order: { required: !0 },
      additionalInput: { required: !0 },
      con_id: { required: !0 },
      con_suggested: { required: !0, minlength: 8 },
      selectCat: {
        required: function (e) {
          return "" === $(e).val();
        },
      },
    },
    messages: {
      con_name: {
        required: "رجاء ادخل اسمك بالكامل",
        minlength: "الحد الادني للحروف هو 10",
      },
      con_client_name: {
        required: "برجاء ادخال اسم الشركة",
        minlength: "الحد الادني للاحرف 2",
      },
      con_phone: {
        required:  "هذا الحقل إلزامي",
        minlength: "الحد الادني 8 ارقام",
      },
      con_email: {
        required:  "هذا الحقل إلزامي",
        email: "رجاء إدخال عنوان بريد إلكتروني صحيح",
      },
      con_id: "رجاء ادخل رقم العضوية ",
      con_order:  "هذا الحقل إلزامي",
      additionalInput:  "هذا الحقل إلزامي",

      con_suggested: { required:  "هذا الحقل إلزامي" },
    },
  });

//   discount cards page

$("#discountCardsForm").validate({
    rules: {
      con_name: { required: !0, minlength: 10 },
      con_client_name: { required: !0, minlength: 2 },
      con_phone: { required: !0, minlength: 8, maxlength: 12 },
      con_email: { required: !0, email: !0 },
      con_id: { required: !0 },
      con_birth: "required",
    },
    messages: {
      con_name: {
        required: "رجاء ادخل اسمك بالكامل",
        minlength:  "الحد الادني للحروف هو 10",
      },
      con_client_name: {
        required:  "برجاء ادخال اسم الشركة",
        minlength:  "الحد الادني للاحرف 2" ,
      },
      con_phone: {
        required:  "هذا الحقل إلزامي",
        minlength:  "الحد الادني 8 ارقام",
      },
      con_email: {
        required:  "هذا الحقل إلزامي",
        email: "رجاء إدخال عنوان بريد إلكتروني صحيح",
      },
      con_id:  "رجاء ادخل رقم العضوية ",
    },
  })