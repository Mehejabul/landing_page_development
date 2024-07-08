@extends('server.layout.layout')

@section('css')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_template/app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('admin_template/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
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
    <style>
        a label {
            cursor: pointer;
        }
    </style>
@endsection

@section('content')

    <div class="content-header row">
        <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success: </strong>{{ Session::get('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <h5 class="content-header-title float-left pr-1 mb-0">Product Table</h5>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb p-0 mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                        class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active">Products
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <section id="basic-datatable">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Product List</h5>
                            {{-- @can('product.create')     --}}
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li class="ml-2"><a href="{{ route('product.create') }}" class="btn btn-primary">+ Create</a></li>
                                    </ul>
                                </div>
                            {{-- @endcan --}}
                        </div>
                        <div class="card-content">
                            <div class="card-body card-dashboard">
                                <div class="table-responsive">
                                    <table class="table zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>Action</th>
                                                <th>Photo</th>
                                                <th>Product Title</th>
                                                {{-- <th>Code</th>
                                                <th>Unit</th>
                                                <th>Category</th>
                                                <th>Catalogue</th>
                                                <th>Brand</th>
                                                <th>Cost Price</th> --}}
                                                <th>Price</th>
                                                {{-- <th>Has Stock</th>
                                                <th>Alert Stock</th>
                                                <th>View Section</th> --}}
                                                
                                                {{-- <th>Status</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($products)
                                                @foreach ($products as $product)
                                                    <tr>
                                                        <td>
                                                            <div class="dropdown">
                                                                <span
                                                                    class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer"
                                                                    data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false" role="menu"></span>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    {{-- @can('product.edit') --}}
                                                                    <a class="dropdown-item"
                                                                       href="{{ route('product.edit', $product->id) }}"><i class="bx bx-edit-alt mr-1"></i> edit</a>
                                                                    {{-- @endcan --}}
                                                                    {{-- @can('product.delete') --}}
                                                                    <form
                                                                        action="{{ route('product.destroy', $product->id) }}"
                                                                        method="post"> @csrf @method('Delete')
                                                                        <button type="submit" class="dropdown-item"><i class="bx bx-trash mr-1"></i>delete</button>
                                                                    </form>
                                                                    {{-- @endcan --}}



                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>@if ($product->image)

                                                            <img src="{{ asset('frontend/images/' . $product->image) }}"
                                                                class="mr-50" alt="logo" height="50" width="50">@endif
                                                        </td>
                                                        <td class="text-bold-600 text-primary">{{ ucwords($product->name) }}</td>
                                                        <td>{{ $product->price }}</td>
                                                        {{-- <td>{{ $product->unit->title }}</td>
                                                        <td>@if ($product->category)
                                                            {{ $product->category->name }}
                                                        @endif</td>
                                                        <td>@if ($product->catalogue)
                                                            {{ $product->catalogue->name }}
                                                        @endif</td>
                                                        <td>@if ($product->brand)
                                                            {{ $product->brand->name }}
                                                        @endif</td>
                                                        <td>{{ $product->cost }}</td>
                                                        <td>{{ $product->mrp }}</td>
                                                        <td>{{ $product->has_stock }}</td>
                                                        <td class="text-danger">{{ $product->alert_stock }}</td>
                                                        <td>{{ $product->view_section }}</td>
                                                        
                                                        <td>
                                                            @if ($product->status == 'Active')
                                                                <a class="updateProductStatus"
                                                                    id="product-{{ $product->id }}"
                                                                    product_id="{{ $product->id }}"
                                                                    href="javascript:void(0)">
                                                                    <label class="badge badge-success"
                                                                        status="Active">Active</label>
                                                                </a>
                                                            @else
                                                                <a class="updateProductStatus"
                                                                    id="product-{{ $product->id }}"
                                                                    product_id="{{ $product->id }}"
                                                                    href="javascript:void(0)">
                                                                    <label class="badge badge-danger"
                                                                        status="Inactive">Inactive</label>
                                                                </a>
                                                            @endif
                                                        </td> --}}
                                                    </tr>
                                                @endforeach
                                             @else
                                                {{ 'No Data Found' }}
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Action</th>
                                                <th>Photo</th>
                                                <th>Product Title</th>
                                                {{-- <th>Code</th>
                                                <th>Unit</th>
                                                <th>Category</th>
                                                <th>Catalogue</th>
                                                <th>Brand</th>
                                                <th>Cost Price</th> --}}
                                                <th>Price</th>
                                                {{-- <th>Has Stock</th>
                                                <th>Alert Stock</th>
                                                <th>View Section</th> --}}
                                                
                                                {{-- <th>Status</th> --}}
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

@section('js')
    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('admin_template/app-assets/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('admin_template/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js') }}"></script>
    <script src="{{ asset('admin_template/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js') }}"></script>
    <script src="{{ asset('admin_template/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('admin_template/app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('admin_template/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js') }}">
    </script>
    <script src="{{ asset('admin_template/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin_template/app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin_template/app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset('admin_template/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin_template/app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('admin_template/app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('admin_template/app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('admin_template/app-assets/js/core/app.js') }}"></script>
    <script src="{{ asset('admin_template/app-assets/js/scripts/components.js') }}"></script>
    <script src="{{ asset('admin_template/app-assets/js/scripts/footer.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('admin_template/app-assets/js/scripts/datatables/datatable.js') }}"></script>
    <!-- END: Page JS-->
    <script>
        // $(document).ready(function() {
        //     $(document).on("click", ".updateProductStatus", function() {
        //         var status = $(this).children("label").attr("status");
        //         var product_id = $(this).attr("product_id");

        //         $.ajax({
        //             headers: {
        //                 "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        //             },
        //             type: "post",
        //             url: "",
        //             data: {
        //                 status: status,
        //                 product_id: product_id
        //             },
        //             success: function(resp) {
        //                 if (resp["status"] == 'Inactive') {
        //                     $("#product-" + product_id).html(
        //                         "<label class='badge badge-danger' status='Inactive'>Inactive</label>"
        //                     );
        //                 } else if (resp["status"] == 'Active') {
        //                     $("#product-" + product_id).html(
        //                         "<label class='badge badge-success' status='Active'>Active</label>"
        //                     );
        //                 }
        //             },
        //             error: function() {
        //                 alert("Error");
        //             },
        //         });
        //     });
        // })
    </script>
@endsection
