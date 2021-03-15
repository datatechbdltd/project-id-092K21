@section('title')
Theta - Datatable
@endsection
@extends('layouts.main')
@section('style')
<!-- DataTables css -->
<link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Responsive Datatable css -->
<link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('rightbar-content')
<!-- Start Breadcrumbbar -->
<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">Stock Product</h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Product</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Stock Product</li>
                </ol>
            </div>
        </div>
        <div class="col-md-4 col-lg-4">
            <div class="widgetbar">
                <button onclick="openModal()" class="btn btn-primary">Add Product</button>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbbar -->
<!-- Start Contentbar -->
<div class="contentbar">
    <!-- Start row -->
    <div class="row">
        <!-- Start col -->
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="card-title">Stock Product</h5>
                </div>
                <div class="card-body">
                    @include('layouts.message')
                    <div class="table-responsive">
                        <table id="default-datatable" class="display table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Buy/Piece</th>
                                    <th>Buy-Total</th>
                                    <th>Entry</th>
                                    <th>Sell</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->buy_price }}৳/Piece</td>
                                    <td>{{ $product->buy_price * ($product->quantity + $product->sale->sum('quantity'))  }}৳</td>
                                    <td>{{ date('d/m/Y', strtotime($product->date)) }}</td>
                                    <td>{{ $product->sale->sum('quantity') }}</td>
                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Buy/Piece</th>
                                    <th>Buy-Total</th>
                                    <th>Entry</th>
                                    <th>Sell</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End col -->
    </div>
    <!-- End row -->
</div>
<!-- End Contentbar -->
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="add-product-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="staticBackdropLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-product-modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="add-product-modal-body">
                <!--data listing table-->
                <div class="card-body">
                    <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3" style="background-color: #752323">Product Name</span>
                        </div>
                        <input type="text" class="form-control" name="name" id="name" aria-describedby="basic-addon3">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3" style="background-color: #752323">Product quantity</span>
                        </div>
                        <input type="number" class="form-control" name="quantity" id="quantity" aria-describedby="basic-addon3">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3" style="background-color: #752323">Buy price per pieces</span>
                        </div>
                        <input type="number" class="form-control" name="buy_price" id="buy_price" aria-describedby="basic-addon3">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3">Sell price per pieces</span>
                        </div>
                        <input type="number" class="form-control" name="sell_price" id="sell_price" aria-describedby="basic-addon3">
                    </div>
                    <div class="input-group mb-3">
                       <lable>*Product image/ Icon/ Logo</lable>
                        <input type="file" class="form-control-file" name="image" id="image" accept="image/*">
                    </div>
                    <button type="submit" id="" class="btn btn-success btn-lg btn-block">Add Product</button>
                    </form>
                </div>
                <!--data listing table-->
            </div>
            <div class="modal-footer" id="add-product-modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal End-->
<script>
    //Open modal
    function openModal(){
        $('#add-product-modal').modal('show');
        document.getElementById('add-product-modal-title').innerHTML='Add new product';
    }
</script>
@endsection
@section('script')
<!-- Datatable js -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom-table-datatable.js') }}"></script>
@endsection
