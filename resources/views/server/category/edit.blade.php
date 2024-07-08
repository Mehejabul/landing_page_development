@extends('server.layout.layout')

@section('css')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_template/app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('admin_template/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_template/app-assets/vendors/css/charts/apexcharts.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('admin_template/app-assets/vendors/css/pickers/daterange/daterangepicker.css') }}">
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
    <link rel="stylesheet" type="text/css"
        href="{{ asset('admin_template/app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
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
                    <h5 class="content-header-title float-left pr-1 mb-0">Category Edit</h5>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb p-0 mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i
                                        class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Categories</a>
                            </li>
                            <li class="breadcrumb-item active">Category Edit
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
        <!-- Basic Inputs start -->
        <section id="basic-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-content">
                            <form action="{{ route('category.update', $category['id']) }}" method="post"
                                enctype="multipart/form-data"> @csrf @method('put')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <fieldset>
                                                <h5>Category Image</h5>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-Createon1"><i class="bx bx-image"></i></span>
                                                    </div>
                                                    <input type="file" class="form-control" aria-describedby="basic-Createon1" name="image" id="image">
                                                </div>
                                                @if($category->image != null)
                                                    <img src="{{ asset('images/category/'.$category->image) }}" alt="logo" width="70px" height="70px" class="mt-2 mx-1">
                                                @endif
                                            </fieldset>
                                            <fieldset class="mt-2">
                                                <h5>Category Name</h5>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-Createon1"><i
                                                                class="bx bx-file"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="Name"
                                                        aria-describedby="basic-Createon1" name="category_name"
                                                        value="{{ $category->name }}" required>
                                                </div>
                                            </fieldset>
                                            <fieldset class="mt-2">
                                                <h5>Select Catalogue</h5>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-Createon1"><i
                                                                class="bxbx-building"></i></span>
                                                    </div>
                                                    <select name="catalogue_id" id="catalogue_id" class="form-control"
                                                        required>
                                                        <option value="">Select</option>
                                                        @foreach ($catalogues as $catalogue)
                                                            <option @if ($category['catalogue_id'] == $catalogue['id']) selected @endif
                                                                value="{{ $catalogue['id'] }}">{{ $catalogue['name'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </fieldset>
                                            <div id="appendCategoriesLevel">
                                                @include('server.category.append_categories_level')
                                            </div>
                                            {{-- <fieldset class="mt-2">
                                                <h5>Category Discount</h5>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-Createon1"><i
                                                                class="bx bxs-message"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control"
                                                        aria-describedby="basic-Createon1" name="category_discount"
                                                        id="category_discount" placeholder="Discount Value"
                                                        value{{ $category['discount'] }}>
                                                </div>
                                            </fieldset> --}}
                                            <fieldset class="mt-2">
                                                <h5>Category Description</h5>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-Createon1"><i
                                                                class="bx bxs-spreadsheet"></i></span>
                                                    </div>
                                                    <textarea name="category_description" id="category_description" cols="30" rows="5" class="form-control"
                                                        aria-describedby="basic-Createon1">{{ $category['description'] }}</textarea>
                                                </div>
                                            </fieldset>
                                            <button type="submit"
                                                class="btn btn-primary mt-2 btn-lg mx-1">Update</button>
                                        </div>
                                    </div>
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
    <script src="{{ asset('admin_template/app-assets/vendors/js/vendors.min.js') }}"></script>
    {{-- <script src="{{ asset('admin_template/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js')}}"></script>
    <script src="{{ asset('admin_template/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js')}}"></script>
    <script src="{{ asset('admin_template/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js')}}"></script> --}}
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('admin_template/app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('admin_template/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}">
    </script>
    <script src="{{ asset('admin_template/app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('admin_template/app-assets/vendors/js/pickers/daterange/moment.min.js') }}"></script>
    <script src="{{ asset('admin_template/app-assets/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('admin_template/app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('admin_template/app-assets/js/core/app.js') }}"></script>
    <script src="{{ asset('admin_template/app-assets/js/scripts/components.js') }}"></script>
    <script src="{{ asset('admin_template/app-assets/js/scripts/footer.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('admin_template/app-assets/js/scripts/pages/table-extended.js') }}"></script>
    <!-- END: Page JS-->
    <script>
        $(document).ready(function() {
            $("#catalogue_id").change(function() {
                var catalogue_id = $(this).val();
                alert(catalogue_id);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "get",
                    url: "{{ route('appendCategory') }}",
                    data: {
                        catalogue_id: catalogue_id
                    },
                    success: function(resp) {
                        alert("done");
                        $("#appendCatagoriesLevel").html(resp);
                    },
                    error: function() {
                        alert("error");
                    },
                });
            });
        })
    </script>
@endsection
