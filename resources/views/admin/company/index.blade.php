@extends('layouts.master')
@section('css')
  <!-- Internal Data table css -->
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/prism/prism.css')}}" rel="stylesheet">
<!-- Interenal Accordion Css -->
<link href="{{URL::asset('assets/plugins/accordion/accordion.css')}}" rel="stylesheet" />
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الشركات</span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection
@section('content')


    <!-- row -->
<div class="row">
	<div class="col-xl-12">
		<div class="card mg-b-20">
			<div class="card-header pb-0 col-xl-2 col-ms-2">
				<div class="d-flex justify-content-between">
                @can('اضافة منتج')
					<a class="modal-effect btn btn-outline-primary btn-block"  href="{{ route('companys.create') }}">اضافة شركه</a>
                @endcan
				</div>
			</div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'>
                        <thead>
                            <tr>
                            <th class="border-bottom-0">#</th>
                            <th class="border-bottom-0">اسم الشركه</th>
                            <th class="border-bottom-0">المالك</th>
                            <th class="border-bottom-0">اسم القسم</th>
                            <th class="border-bottom-0">العمليات</th>
                            </tr>
                        </thead>

                        <tbody>
						<?php $count =0; ?>
			            @foreach($companies as $company)
						<?php $count++; ?>
                        <tr>
                            <td>{{$count}}</td>
                            <td>{{$company->name}}</td>
                            <td>{{$company->user->name}}</td>
							<td>{{$company->section->section_name}}</td>
						    <td>
                                @can('تعديل منتج')
								<a class="modal-effect btn btn-sm btn-warning"href="{{ route('companys.show',$company) }}" title="عرض"><i class="las la-eye"></i></a>
                                @endcan
                                @can('تعديل منتج')
									<a class="modal-effect btn btn-sm btn-info"href="#exampleModal2"
									title="تعديل"><i class="las la-pen"></i></a>
                                @endcan

                                @can('حذف منتج')
								    <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
								    data-company_id="{{ $company->id }}"
                                    data-name="{{ $company->name }}"data-toggle="modal"
								    href="#modaldemo9" title="حذف"><i class="las la-trash"></i></a>
                                @endcan
							</td>
						</tr>
							@endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



   <!-- delete -->
   <div class="modal fade" id="modaldemo9" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">حذف الخدمه</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="services/destroy" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p>هل انت متاكد من عملية الحذف ؟</p><br>
                            <input type="hidden" name="company_id" id="company_id" value="">
                            <input class="form-control" name="name" id="name" type="text" readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                            <button type="submit" class="btn btn-danger">تاكيد</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        </div>
		<!-- row closed -->
	</div>
	<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')

    <!-- Internal Data tables -->
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{URL::asset('assets/js/table-data.js')}}"></script>
    <!-- Internal Prism js-->
    <script src="{{URL::asset('assets/plugins/prism/prism.js')}}"></script> --}}



	<script>
        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var company_id = button.data('company_id')
            var name = button.data('name')
            var modal = $(this)

            modal.find('.modal-body #company_id').val(company_id);
            modal.find('.modal-body #name').val(name);
        })

    </script>
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!--- Internal Accordion Js -->
<script src="{{URL::asset('assets/plugins/accordion/accordion.min.js')}}"></script>
<script src="{{URL::asset('assets/js/accordion.js')}}"></script>

@endsection
