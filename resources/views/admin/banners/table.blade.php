<div id="custom-search-table">
    <table id="example1" class="table table-bordered table-striped">
        @php
            $count = 1;
        @endphp
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
                <td style="display:inline-flex;">
                    <a class="btn btn-warning btn-sm" href="{{ route('editBanner',$banner->id) }}" class="mr-5">Edit </a>
                </td>
            </tr>
            @php
                $count++;
            @endphp
            @endforeach
        </tbody>
    </table>
    {{$banners->links()}}
</div>
