@extends('layouts.admin')

@section('styles')

@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard </li>
@endsection
@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <h4 class="header-title mb-4">Statistics Overview</h4>
                    <div class="text-center mt-4">
                        <div class="row">
                            <div class="col-md-6 col-xl-3">
                                    <div class="card-box widget-flat bg-danger text-white">
                                        <i class="far fa-building"></i>
                                        <h3 class="m-b-10">{{ $totalCompanies }}</h3>
                                        <h4 class="text-uppercase m-b-5">Companies</h4>
                                    </div>
                            </div>

                            <div class="col-md-6 col-xl-3">
                                    <div class="card-box widget-flat bg-success text-white">
                                        <i class="fa fa-tablet"></i>
                                        <h3 class="m-b-10">{{ $totalDevices }}</h3>
                                        <h4 class="text-uppercase m-b-5">Devices</h4>
                                    </div>
                            </div>

                            <div class="col-md-6 col-xl-3">
                                    <div class="card-box widget-flat bg-primary text-white">
                                        <i class="fa fa-map-marker"></i>
                                        <h3 class="m-b-10">{{ $totalLocations }}</h3>
                                        <h4 class="text-uppercase m-b-5">Outlets</h4>
                                    </div>
                            </div>

                            <div class="col-md-6 col-xl-3">
                                    <div class="card-box widget-flat bg-warning text-white">
                                        <i class="fas fa-list-ul"></i>
                                        <h3 class="m-b-10">{{ $totalSurvey }}</h3>
                                        <h4 class="text-uppercase m-b-5">Surveys</h4>
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xl-3">
                                    <div class="card-box widget-flat bg-info text-white">
                                        <i class="fas fa-question"></i>
                                        <h3 class="m-b-10">{{ $totalFeedback }}</h3>
                                        <h4 class="text-uppercase m-b-5"> Feedback</h4>
                                    </div>
                            </div>

                            <div class="col-md-6 col-xl-3">
                                    <div class="card-box widget-flat bg-secondary text-white">
                                        <i class="fab fa-buffer"></i>
                                        <h3 class="m-b-10">{{ $totalTemplateCategories }}</h3>
                                        <h4 class="text-uppercase m-b-5">Categories</h4>
                                    </div>
                            </div>

                            <div class="col-md-6 col-xl-3">
                                    <div class="card-box widget-flat bg-purple text-white">
                                        <i class="far fa-image"></i>
                                        <h3 class="m-b-10">{{ $totalTemplates }}</h3>
                                        <h4 class="text-uppercase m-b-5">Templates</h4>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
    </div>
</div> 

@endsection

@section('scripts')

@endsection
