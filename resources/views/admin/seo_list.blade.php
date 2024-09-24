@extends('admin.layouts.layout')
@section('content')
    <div class="container-fluid">
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Seo Management</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted "
                                        href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page">Page List</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-3">
                        <div class="text-center mb-n5">
                            <img src="{{ asset('admin/dist/images/breadcrumb/ChatBc.png') }}" alt=""
                                class="img-fluid" style="height: 125px;">
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="card w-100  overflow-hidden ">
            <div class="card-header pb-0 p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="card-title fw-semibold mb-0">Page List</h5>
                    </div>
                    
                </div>
                <div>
                    <a href="" data-bs-toggle="modal" data-bs-target="#add_seo" class="btn btn-primary text-nowrap">Add
                        Page </a>
                    </div>
            </div>
            <div class="card-body p-3 px-md-4">

                <div class="table-responsive rounded-2 mb-4">
                    <table class="table" id="dataTable">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Sn.</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Meta Title</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Status</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Action</h6>
                                </th>
                                

                            </tr>
                        </thead>
                        <tbody>
                            @php $i=1 ; @endphp
                          
                                @forelse($SeoData as $key => $item)
                                
                                    <tr>
                                        <td>{{ $i }}</td>
                                       
                                        <td>
                                            <div class="">
                                                <span class="mb-0 fw-normal fs-3">{{ $item->meta_title }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="">
                                                <span class="mb-0 fw-normal fs-3">{{ $item->status }}</span>
                                            </div>
                                        </td>
                                        <td>                                           
                                        </td>
                                        @php $i++ @endphp
                                    </tr>                               
                            @empty 
                           @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add_seo" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form id="AddSeo" onsubmit="return addSeo()" enctype="multipart/form-data">
                @csrf
                <div class="modal-header d-flex align-items-center">
                    <h4 class="modal-title" id="myModalLabel">Add Page</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-4">
                        <label for="category">Meta Title</label>
                        <input type="text" class="form-control" placeholder="Please Meta title" name="meta_title" id="meta_title">
                        <span id="meta_title_error" class="text-danger"></span>
                    </div>
                    <div class="form-group mb-4">
                        <label for="category">Meta Description</label>
                        <textarea class="form-control" placeholder="Please Meta Description" name="meta_desc" id="meta_desc"></textarea>
                        <span id="meta_desc_error" class="text-danger"></span>
                    </div>
                    <div class="form-group mb-4">
                        <label for="category">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="">Select Status</option>
                            <option value="0">Active</option>
                            <option value="1">Inactive</option>
                        </select>
                        <span id="status_error" class="text-danger"></span>
                    </div>
                    <div class="form-group mb-4">
                        <label for="image">Image</label>
                        
                         <input type="file" class="form-control" name="image" id="image" accept="image/*">
                        <span id="image_error" class="text-danger"></span>
                    </div>
                </div>
                <div class="modal-footer pt-0">
                    <button type="submit" class="btn btn-primary font-medium waves-effect" id="signup_btn_btn">
                        Add 
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

  
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Include CKEditor CDN -->
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
    // Initialize CKEditor on the textarea
    CKEDITOR.replace('meta_desc');
   </script>
   <script>
    function addSeo() {
        var formData = new FormData($('#AddSeo')[0]);
        alert(formData);

            $.ajax({
                url: "{{ route('admin.addSeo') }}",
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                dataType: 'json',
                beforeSend: function() {
                    $('#signup_btn_btn').prop('disabled', true);
                    $('#signup_btn_btn').text('Process....');
                },
                success: function(res) {
                    $('#signup_btn_btn').prop('disabled', false);
                    $('#signup_btn_btn').text('Add ');
                    if (res.status == '2') {

                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: res.message,
                        }).then(function() {
                            window.location.href = '{{ route("admin.SeoList") }}';
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: res.message,
                        })
                    }
                },
                error: function(error) {
                    console.log()
                    $('#signup_btn_btn').prop('disabled', false);
                    $('#signup_btn_btn').text('Add');
                    if (error.responseJSON.errors) {
                        if (error.responseJSON.errors.meta_title) {
                            $('#meta_title_error').text(error.responseJSON.errors.meta_title [0]);
                           
                        } else {
                            $('#meta_title_error').text('');
                        }

                        if (error.responseJSON.errors.meta_desc) {
                            $('#meta_desc_error').text(error.responseJSON.errors.meta_desc[0]);
                           
                        } else {
                            $('#meta_desc_error').text('');
                        }

                        if (error.responseJSON.errors.status) {
                            $('#status_error').text(error.responseJSON.errors.status[0]);
                           
                        } else {
                            $('#status_error').text('');
                        }

                        if (error.responseJSON.errors.image) {
                            $('#image_error').text(error.responseJSON.errors.image[0]);
                           
                        } else {
                            $('#image_error').text('');
                        }
                        
                    }
                }
            });
            return false;
        }
   </script>

@endsection
