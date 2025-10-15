@extends('layouts.landing-page')
@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}?v=1.2" />
<div class="container cstm-width-containers">
    <div class="trm-section-class">
<h1 style="text-align:center;"><b>About</b></h1>
</div>

<div class="trm-section-class">
<h3><b>Why BK Assistant’s software is unique?</b></h3>
<p>
Our software was developed by bankruptcy paralegals, not attorneys or software engineers. The reason that’s important is in most law firms, the legal assistants and paralegals are getting the questionnaires filled out and all documents from the clients. So why would the attorneys and/or software guys have the solutions to this process they aren’t doing themselves? That’s why our software is different than everybody else’s in the industry. Our software fixes the three biggest bankruptcy issues with: 
    <span class="uline"><i>Step-by-step video tutorials, Document uploads, that use technology to read the clients documents and auto populate the data into the system. </i> </span>
</p>
</div>
<div class="bankruptcy_video">
<!-- <div class="trm-section-class"> -->
    <video width="" height="" autoplay muted >
        <source src="https://sp.rmbl.ws/s8/2/G/7/8/Z/G78Zc.caa.mp4?u=0&b=0" type="video/mp4">
        <source src="movie.ogg" type="video/ogg">
        Your browser does not support the video tag.
    </video>
</div>



@endsection