@extends('layouts.home')
@section('content')
<div class="container col-xs-10">
<div class="text-center" dir="rtl" style="line-height:40px">
<form action="{{route('customer.store')}}" method="POST">
  {{@csrf_field()}}
<h3 >بياناتك الشخصية</h3>
<div class="form-group">
  <label for="name">الاسم</label>
  <input required class="form-control" type="text" name="name" placeholder="اكتب اسمك كاملا"/>
</div>
<div class="form-group">
  <label for="phone">الهاتف</label>
  <input required class="form-control" type="text" name="phone" placeholder="اكتب رقم هاتفك"/>
</div>

<div class="form-group">
  <label for="phone-2">رقم احتياطي</label>
  <input  class="form-control" type="text" name="phone-2" placeholder="اكتب رقم هاتفك"/>
</div>

<div class="form-group" id="div_radio"><label class="control-label requiredField" for="radio">الولاية <span class="asteriskField">*</span></label><div class=""><label class="radio-inline"><label class="radio-inline"><input name="radio" type="radio" value="now">&nbsp;&nbsp;&nbsp;توصيل فوري</label><label class="radio-inline"><input name="radio" type="radio" value="khrt">&nbsp;&nbsp;&nbsp; الخرطوم</label><input name="radio" type="radio" value="bhri">&nbsp;&nbsp;&nbsp; بحري</label><label class="radio-inline"><input name="radio" type="radio" value="omdur">&nbsp;&nbsp;&nbsp; امدرمان</label><label class="radio-inline"><input name="radio" type="radio" value="other">&nbsp;&nbsp;&nbsp; ولايات</label></div></div>

<div class="form-group"><label class="control-label requiredField" for="select">المكان <span class="asteriskField">*</span></label><select required class="select form-control" id="select" name="select"><option value="توصيل فوري">توصيل فوري</option></select></div>


<div class="form-group">
  <label for="address">العنوان</label>
  <input required class="form-control" type="text" name="address" placeholder=""/>
</div>

<div class="form-group">
  <input class="form-control btn btn-success col-6" type="submit" name="submit" value="التالي"/>
</div>

</form>
</div>

</div>




<script>
       var newOptions = {
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
         
        };
        
                var $el = $("#select");
        $el.empty(); // remove old options
        $.each(newOptions, function(key,value) {
          $el.append($("<option></option>")
             .attr("value", value).text(key));
        });
        $('input[name="radio"]').on('change', function() {
         var newOptions = {
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
        
        "توصيل فوري": "توصيل فوري",
         
        };
        var se;
        se=$('input[name="radio"]:checked').val();



        if(se=='bhri'){

       var newOptions = {
        
        "الأملاك": "الأملاك",
        
        "المنطقه الصناعيه": "المنطقه الصناعيه",
        
        "الوابورات": "الوابورات",
        
        "الدناقلة": "الدناقلة",
        
        "الدروشاب": "الدروشاب",
        
        "الكدرو": "الكدرو",
        
        "البراحة": "البراحة",
        
        "سعد قشرة": "سعد قشرة",
        
        "القري": "القري",
        
        "شمبات": "شمبات",
        
        "كوبر": "كوبر",
        
        "كافوري": "كافوري",
        
        "المزاد": "المزاد",
        
        "المغتربين": "المغتربين",
        
        "الحاج يوسف شارع واحد": "الحاج يوسف شارع واحد",
        
        "الصبابي": "الصبابي",
        
        "الحلفايا": "الحلفايا",
        
        "الصافية": "الصافية",
        
        "الختمية": "الختمية",
        
        "الشعبية": "الشعبية",
        
        "حلة حمد": "حلة حمد",
        
        "حلة خوجلي": "حلة خوجلي",
        
        "السامراب": "السامراب",
        
        "حي الهدي": "حي الهدي",
        
        "الحاج يوسف المايقوما": "الحاج يوسف المايقوما",
        
        "حي الجامعة": "حي الجامعة",
        
        " الفيحاء": " الفيحاء",
        
        "حي النصر": "حي النصر",
        
        "حلة كوكو": "حلة كوكو",
        
        "الحاج يوسف الوحدة": "الحاج يوسف الوحدة",
        
        " القادسية": " القادسية",
        
        " الردمية": " الردمية",
        
        " نبته": " نبته",
        
        "الامراء": "الامراء",
        
        "الجريف شرق": "الجريف شرق",
        
        "شرق النيل": "شرق النيل",
        
        "الميرغنية": "الميرغنية",
        
        "ديوم بحري": "ديوم بحري",
        
        };
        }


    if(se=='khrt'){
    var newOptions = {
        
        "الصفا": "الصفا",
        
        "الديوم": "الديوم",
        
        " العزوزاب": " العزوزاب",
        
        "المنطقة الصناعية": "المنطقة الصناعية",
        
        "باريس": "باريس",
        
        " القوز": " القوز",
        
        "الزهور": "الزهور",
        
        " النزهه": " النزهه",
        
        " الرميله": " الرميله",
        
        "سوبا-خارج نطاق التوصيل": "سوبا-خارج نطاق التوصيل",
        
        "السوق المحلي": "السوق المحلي",
        
        "توتي": "توتي",
        
        "الفردوس": "الفردوس",
        
        " الانقاذ": " الانقاذ",
        
        " المدرعات": " المدرعات",
        
        "العامرية": "العامرية",
        
        " الفردوس": " الفردوس",
        
        " يثرب": " يثرب",
        
        " الكلاكلة": " الكلاكلة",
        
        " الشجرة": " الشجرة",
        
        " السجانة": " السجانة",
        
        "الصحافة الامتداد": "الصحافة الامتداد",
        
        "الصحافة شرق": "الصحافة شرق",
        
        " العمارات": " العمارات",
        
        " الرياض": " الرياض",
        
        " الديم": " الديم",
        
        " المجاهدين": " المجاهدين",
        
        " الأزهري": " الأزهري",
        
        " المقرن": " المقرن",
        
        " الطائف": " الطائف",
        
        "اللاماب بحر ابيض": "اللاماب بحر ابيض",
        
        "حي المطار": "حي المطار",
        
        "قاردن": "قاردن",
        
        " جبرة": " جبرة",
        
        "الخرطوم 2": "الخرطوم 2",
        
        " بري": " بري",
        
        " أركويت": " أركويت",
        
        " المنشية": " المنشية",
        
        " المعمورة": " المعمورة",
        
        "ابوادم": "ابوادم",
        
        "العمارات": "العمارات",
        
        "عيد حسين-خارج نطاق التوصيل": "عيد حسين-خارج نطاق التوصيل",
        
        "الجريف غرب": "الجريف غرب",
        
        "السلمة": "السلمة",
        
        "الصفاء": "الصفاء",
        
        "الخرطوم 3": "الخرطوم 3",
        
        "السوق العربي-خارج نطاق التوصيل": "السوق العربي-خارج نطاق التوصيل",
        
        "استاد الخرطوم-خارج نطاق التوصيل": "استاد الخرطوم-خارج نطاق التوصيل",
        
        "مايو-خارج نطاق التوصيل": "مايو-خارج نطاق التوصيل",
        
        "الدخينات-خارج نطاق التوصيل": "الدخينات-خارج نطاق التوصيل",
        
        "الحلة الجديدة": "الحلة الجديدة",
        
        "الصحافة زلط": "الصحافة زلط",
        
        "غزة": "غزة",
        
        "قاردن سيتي": "قاردن سيتي",
        
        "العشرة": "العشرة",
        
        "السكة حديد": "السكة حديد",
        
        "ابوحمامة": "ابوحمامة",
        
        "السوق الشعبي": "السوق الشعبي",
        
        };
        }

        if(se=='omdur'){

         var newOptions = {
        
        "الشهداء": "الشهداء",
        
        "الثورة": "الثورة",
        
        " البوسته": " البوسته",
        
        " مكى": " مكى",
        
        " الواحة": " الواحة",
        
        "حي العرب": "حي العرب",
        
        " الدوحة": " الدوحة",
        
        " الموردة": " الموردة",
        
        " القماير": " القماير",
        
        " أمبدة": " أمبدة",
        
        " المربعات": " المربعات",
        
        " المهندسين": " المهندسين",
        
        " الفتيحاب": " الفتيحاب",
        
        " الملازمين": " الملازمين",
        
        " العرضة": " العرضة",
        
        " الثورات": " الثورات",
        
        " المسالمة": " المسالمة",
        
        " الركابية": " الركابية",
        
        " بانت": " بانت",
        
        "بيت المال": "بيت المال",
        
        "الامراء": "الامراء",
        
        " الهجرة": " الهجرة",
        
        " العباسية": " العباسية",
        
        "ود البخيت": "ود البخيت",
        
        " الحتانه": " الحتانه",
        
        "ود نوباوي": "ود نوباوي",
        
        "مدينة النيل": "مدينة النيل",
        
        "الروضة": "الروضة",
        
        "حي العمدة": "حي العمدة",
        
        "اب روف": "اب روف",
        
        "الأربعين": "الأربعين",
        
        "الوادي": "الوادي",
        
        "الجرافة": "الجرافة",
        
        "المنارة": "المنارة",
        
        };
        }


        if(se=='other'){

        var newOptions = {
        
        "مدني": "مدني",
        
        "بورتسودان": "بورتسودان",
        
        "القضارف": "القضارف",
        
        "الحصاحيصا": "الحصاحيصا",
        
        "شندي": "شندي",
        
        "كسلا": "كسلا",
        
        "اخري": "اخري",
        
        };
        }

        var $el = $("#select");
        $el.empty(); // remove old options
        $.each(newOptions, function(key,value) {
          $el.append($("<option></option>")
             .attr("value", value).text(key));
        });
        });
        </script>

@stop
