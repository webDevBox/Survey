@extends('layouts.admin')

@section('styles')
    {{--  <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">  --}}
@endsection

@section('content')
{{-- <div class="content-page"> --}}
    
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card-header">
                        <h4 class="card-title">Banners Filter</h4>
                    </div>

                    <div class="card-box">
                        
                        <form action="{{ route('searchBannersFilter') }}" method="GET">
                            {{-- @csrf --}}
                            <div class="row ">
                                <div class="form-group col-md-3 ">
                                    <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Keyword" value="{{isset($filter)?$filter->keyword:''}}">
                                </div>
                                <div class="form-group col-md-3">
                                    <select name="verified" id="verified" plac class="form-control">
                                        <option value="" disabled selected>Select Status</option>
                                        {{-- <option value="" {{isset($filter)?($filter->verified == null)?'selected':'':''}}></option> --}}
                                        <option value="1" {{isset($filter)?($filter->verified == '1')?'selected':'':''}}>Active</option>
                                        <option value="0" {{isset($filter)?($filter->verified == '0')?'selected':'':''}}>InActive</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                    <a class="btn btn-light ml-2" href="{{ route('listBanners') }}">Clear</a>
                                </div>
                                
                            </div>
                           
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    <div class="card-header">
                        <h4 class="card-title">Banners List</h4>
                    </div>

                    <div class="card-box table-responsive">
                            <table id="bannersListTable" class="table table-bordered dt-responsive " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">Sr.#</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th style="width:70px;">Action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @php
                                        $count = 1;
                                    @endphp
                                    @foreach($banners as $banner)
                                    <tr class="odd gradeX">
                                        <td>{{ $count++ }}</td>
                                        <td>{{ $banner->name }}</td>
            
                                        @if($banner->image_url != null)
                                        <td><img src="{{ asset('storage/app/'.$banner->image_url) }}"
                                                class="thumbnail-image-100" height="100" width="100"></td>
                                        @endif
            
                                        <td>{{ $banner->description }}</td>
                                        <td>{{ ($banner->status == 1) ? 'Active' : 'In-Active'}} </td>
                                        <td>
                                            <a class="btn btn-warning btn-sm" href="{{ route('editBanner',$banner->id) }}" class="mr-5">Edit </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="ml-3">
                                @if (isset($filter))
                                    {{$banners->appends(['request' => $filter])->links()}}
                                @else
                                    {{$banners->links()}}
                                @endif
                            </div>
                        {{--  </div>  --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- </div> --}}
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            // Default Datatable
            $('#bannersListTable').DataTable({
                "columnDefs": [
                { "orderable": false, "targets": [2,3,5] },
                ],
                "bPaginate": false,
                "bFilter": false,
            });
        } );
    </script>
@endsection
