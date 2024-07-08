@extends('server.layout.layout')

@section('css')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_template/app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_template/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_template/app-assets/vendors/css/charts/apexcharts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_template/app-assets/vendors/css/pickers/daterange/daterangepicker.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_template/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_template/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_template/app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_template/app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_template/app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_template/app-assets/css/themes/semi-dark-layout.css') }}">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_template/app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_template/assets/css/style.css') }}">
    <!-- END: Custom CSS-->
@endsection

@section('content')


        <div class="content-header row">
            <div class="content-header-left col-12 mb-2 mt-1">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb p-0 mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.dashboard') }}"
                                        ><i class="bx bx-home-alt"></i
                                    ></a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('stock.index') }}"
                                        >Stocks</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Update Stock Details
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            {{-- Validation Error Message --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success: </strong>{{ Session::get('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Success: </strong>{{ Session::get('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
            <!-- Basic Inputs start -->
            <section id="basic-input">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-content">
                                <form action="{{ Route('stock.variantUpdate',$variant->id) }}" method="post"> @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <fieldset>
                                                    <h5>Product Title</h5>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-Createon1"><i class="bx bx-file"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" aria-describedby="basic-Createon1" value="{{ $variant->product->title }}" readonly>
                                                    </div>
                                                </fieldset>
                                                <fieldset>
                                                    <h5>Size</h5>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-Createon1"><i class="bx bx-file"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" aria-describedby="basic-Createon1" value="{{ $variant->productvariation->size }}" readonly>
                                                    </div>
                                                </fieldset>
                                                <fieldset>
                                                    <h5>New Stock</h5>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-Createon1"><i class="bx bx-store-alt"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" aria-describedby="basic-Createon1" name="quantity" required>
                                                    </div>
                                                </fieldset>
                                                {{-- <fieldset>
                                                    <h5>Available Stock</h5>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-Createon1"><i class="bx bx-store-alt"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" aria-describedby="basic-Createon1" value="{{ $product->available }}" readonly>
                                                    </div>
                                                </fieldset>
                                                <fieldset class="mt-2">
                                                    <h5>Unit</h5>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-Createon1"><i class="bx bx-grid-alt"></i></span>
                                                        </div>
                                                        <select name="unit_id" id="unit" class="form-control">
                                                            <option
                                                            @if ($product->unit_id == 0)
                                                                selected
                                                            @endif value="0">Select</option>
                                                            @foreach ($units as $unit)
                                                                <option
                                                                @if ($product->unit_id == $unit->id)
                                                                    selected
                                                                @endif
                                                                value="{{ $unit->id }}">{{ $unit->unit }}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </fieldset>
                                                <fieldset class="mt-2">
                                                    <h5>Sell Unit Price</h5>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-Createon1"><i class="bx bx-money"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" aria-describedby="basic-Createon1" value="{{ $product->unit_price }}" name="unit_price">
                                                    </div>
                                                </fieldset> --}}
                                                {{-- <input type="text" hidden name="type" value="product"> --}}
                                                <button type="submit" class="btn btn-primary mt-2">Update</button>
                                            </div>
                                        </div>

                                        {{-- <div class="row">
                                            <button type="submit" class="btn btn-primary mt-2 btn-lg mx-1">Update</button>
                                        </div> --}}
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Basic Inputs end -->
        </div>

@endsection

@section('js')
    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('admin_template/app-assets/vendors/js/vendors.min.js')}}"></script>
    <script src="{{ asset('admin_template/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js')}}"></script>
    <script src="{{ asset('admin_template/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js')}}"></script>
    <script src="{{ asset('admin_template/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('admin_template/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    <script src="{{ asset('admin_template/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js')}}"></script>
    <script src="{{ asset('admin_template/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
    <script src="{{ asset('admin_template/app-assets/vendors/js/pickers/daterange/moment.min.js')}}"></script>
    <script src="{{ asset('admin_template/app-assets/vendors/js/pickers/daterange/daterangepicker.js')}}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('admin_template/app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{ asset('admin_template/app-assets/js/core/app.js')}}"></script>
    <script src="{{ asset('admin_template/app-assets/js/scripts/components.js')}}"></script>
    <script src="{{ asset('admin_template/app-assets/js/scripts/footer.js')}}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('admin_template/app-assets/js/scripts/pages/table-extended.js')}}"></script>
    <!-- END: Page JS-->
@endsection
