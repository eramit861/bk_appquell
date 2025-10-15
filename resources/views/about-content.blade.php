
<section class="aboutus">
    <div class="tittle_heading_about position-relative">
        <div>
            <img src="{{ asset('assets/img/hero.png')}}" alt="Hero Banner" class="hero_img w-100 hero-banner-bg">
        </div>
        <div class="main_tittle text-center w-100">
            <h1 class=""><strong>About us</strong></h1>
        </div>
        <div class="curve-img">
        <img src="{{ asset('assets/img/curve.png')}}" alt="Banner Foreground" class="w-100">
    </div>
    </div>
</section>
<div class="container">
<section class="sec_1 pb-4 pt-4">
    <div class="row">
    <div class="col-md-5 bk_tm_img">
        <img src="{{ asset('assets/img/Bk_Assistant_tm_logo.svg')}}" alt="Logo" class="">
    </div>
    <div class="col-md-7 text-center bk_right_txt">
        <p class="mb-4 p_txt">
            We are not just another bankruptcy software company,
            we bring state-of-the-art solutions, using advanced technology to the bankruptcy industry. We believe in excellence, functionality, and simplicity
        </p>

         <p class="mb-4 p_txt">
             Our Mission is to deliver a super customer experience for
            you and your clients by modernizing your bankruptcy
            business with user-friendly solutions for you and your
            client. 
        </p>
        <p class="mb-4 p_txt">
            We will be arming you with the tools that not only will
            streamline your case preparation process but will grow
            your bankruptcy business.
        </p>
    </div>
    </div>
</section>
<section class="sec_2 pt-4">
    <h3 class="fst-italic text-center txt_blue pt-4 pb-4"><strong>We are here to Raise the Bar in the Bankruptcy Industry.</strong></h3>
    <h2 class="text-center my-5 txt_blue sec2_h2_txt"><strong>This is our Story</strong></h2>
    <div class="row">
        <div class="col-md-6 p-3">
            <div class="mt-3">
                <p class="p_text_story">
                    Our story begins in June of 2010
                    when Mike Croak decided to start
                    his bankruptcy business from the
                    ground up. 
                </p>
                <p class="p_text_story">
                    He developed our software from
                    his 14 years of insights as a paralegal assistant. His extensive experience includes preparing and
                    filing over 4,500, Ch. 7 & 13 petitions, in all 4 California Districts
                    along with almost every motion
                    and order in a normal bankruptcy
                    case. 
                </p>
                <p class="p_text_story ">
                    His exposure to the limitations and
                    challenges that the client and the
                    attorneys face, inspired him to
                    invest the last three years in addressing these known issues on
                    the website and app. 
                </p>
            </div>
        </div>
        <div class="col-md-6 p-3">
            <div class="mb-5 text-center">
                 <img src="{{ asset('assets/img/client.png')}}" alt="Admin" class="circle_img p-3">
               
            </div>
            <p class="p_text_story">
                Our cutting-edge solution leaves
                behind 1980s outdated and overpriced options and brings
                cost-efficient innovative technology to your bankruptcy business
                with a focus on your client’s experience.
            </p>
            <p class="p_text_story mb-0">
                BK Assistant is founded on the
                core value of integrity and service.
                We believe in building long-term
                business relationships and fomenting inevitable growth in the legal
                industry.
            </p>
        </div>
       
    </div>
</section>
<style>

.team_img_size{
    height: 250px;
}

.tittle_heading_about h1{
    font-size: 120px;
    color:#fff;
}
.tittle_heading_about:before {
    content: "";
    background: #151c55;
    position: absolute;
    bottom: 0px;
    top: 0;
    left: 0;
    right: 0;
    opacity: 0.9;
}
.main_tittle{
    position: absolute;
    top: 16%;
}
.curve-img{
    position:absolute;
    bottom:0;
}
.txt_blue{
    color: #0a1564;
}
.bg-blue{
    background: #0a1564;
}
.p_text_story {
    font-size: 43px;
    line-height: normal;
    margin-bottom: 45px;
    color:#000;
}
.p_txt{
    font-size:34px;
    color:#000;
}
.sec_1 h3{
    font-size:50px;
}
.sec2_h2_txt{
    font-size:80px;
}
.p_justify{
  text-align: justify;
  text-justify: inter-word;
}

.circle_1{
    width:250px;
    border-radius:50%;
    height: 250px;
    border: 7px solid #0a1564;
    margin:auto;
}
.sec_3{
    background-color: #e5e4e3;
}
img.circle_img{
    border: 7px solid #0a1564;
    border-radius: 50%;
}
.parent_circle {
    height: 800px;
    border-radius: 10px;
    padding-top: 40px;
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 360px;
    box-shadow: 0 0.5rem 1rem rgb(2 0 0 / 15%) !important

}
.parent_circle_1{
    float:right;
}
.parent_circle_3{
    float:left;
}
.sec_2 h3 {
    font-size: 40px;
}
@media(max-width :2560px){
    .bk_tm_img img {
        padding:0px;
} 
}
@media(max-width :1440px){
    .sec_2 h3 {
    font-size: 36px;
}
.sec_1 h3{font-size:36px;}.p_text_story,.p_txt{font-size:24px;} .tittle_heading_about h1{font-size:80px;}  
.bk_right_txt{
    padding-top:50px;
}
.bk_tm_img img {
    padding: 10px 50px;
}
}
@media(max-width : 1024px)  { 
    .sec_1 h3 {font-size: 33px;}
    .p_text_story,.p_txt{font-size:24px;}
    .tittle_heading_about h1{font-size:70px;}
    .sec2_h2_txt {font-size: 70px;}
    .sec_2{padding-top:40px}
    .logo a img {height: 100px;}
    .parent_circle_1,.parent_circle_3{float:none;}

    .parent_circle {
        margin-left: 0px; 
        margin-right: 0px;
        width: 300px;
    }
        .team_img_size{
        height: 200px;
    }
    .fst_style{
        font-size:22px !important;
    }
    .sec_2 h3 {
       font-size: 32px;
   }
   .bk_tm_img img {
       padding: 0px;
   }
   .bk_right_txt{
       padding-top:40px;
   }
   .sec_2 h2{
    margin-top:20px !important;
}
.client_img {
    max-width: 100%;
}

} 
@media(max-width : 768px)  {
    .parent_circle {
        margin-left: 0px;
        margin-right: 0px;
        width: 220px;
    }
    .circle_1 {
        width: 175px;
        height: 175px;
    }
    .fst_style{
        font-size:20px !important;
    }
    .sec2_h2_txt {
        font-size: 60px;
   }
   .sec_2 h3 {
       font-size: 27px;
  }
  .bk_right_txt {
    padding-top: 25px;
}
}


@media (max-width: 425px){
    .tittle_heading_about h1{
    font-size: 35px;
}
.p_text_story,.resoures_txt_p,.p_txt{font-size:21px;}
.bk_tm_img img{
    padding: 0px 65px
}
.parent_circle h4{
    font-size:30px
}
.rectangle {
    height: 368px;
}
.sec_1 h3 {
    font-size: 26px;
}
.sec2_h2_txt {
    font-size: 40px;
    margin-bottom: 10px !important;
}
.sec_3 h2{
    margin-bottom:30px !important;
}
.parent_circle_1,.parent_circle_3{
    float:none;
}
.parent_circle {
        width: 365px; 
    }
    .circle_1 {
        width: 250px;
        height: 250px;
    }
    .fst_style{
        font-size:23px !important;
    }
}
</style>