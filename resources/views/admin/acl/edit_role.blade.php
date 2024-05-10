@extends('layouts.app')
@section('styles')
<style>
    .image-preview {
        position: relative;
        display: inline-block;
        vertical-align: bottom;
        top: 5px;
        margin-bottom: 5px;
    }

    .color-box {
        width: 107px;
        height: 107px;
        position: relative;
        top: 0;
        left: 0;
        border: 1px solid lightgray;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .color-box img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .save-button {
        overflow: hidden;
        /* Hide overflowing content */
        transition: width 0.5s ease;
        /* Add transition for width change */
    }

    .save-button.d-flex {
        width: auto !important;
        /* Remove width constraint when loader is visible */
    }

    .loader {
        border: 2px solid #f3f3f3;
        /* Light grey */
        border-top: 2px solid #3498db;
        /* Blue */
        border-radius: 50%;
        width: 15px;
        height: 15px;
        animation: spin 2s linear infinite;
        margin: 3px 0px 0px 4px;
    }

    #selected-country-flag {
        width: 18px;
        height: 18px;
    }

    #country-dropdown {
        max-width: 200px !important;
        max-height: 200px;
        overflow-y: scroll;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    /* Add your custom CSS styles here */
    .toast {
        position: fixed;
        top: 80px;
        right: 0px;
        color: #fff;
        padding: 10px;
        display: none;
        border-radius: 5px;
    }
</style>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Role</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col -->
                <div class="col-md-12">
                    <!-- /.card -->
                    <!-- /.card-header -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Role</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">
                            <form action="{{url('admin/acl/role/update', $role->id)}}" method="POST" id="roles-form">
                                @csrf
                                @include('admin.acl.role_form', $permissions)
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id="toast" class="toast">
            </div>
        </div>
    </section>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $(document).on('submit', '#roles-form', function(e) {
            e.preventDefault();
            $('.loader').removeClass('d-none');
            var form = $(this);
            var formData = new FormData(form.get(0));
            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('.loader').addClass('d-none');
                    if (response.status == true) {
                        alert(response.message);
                        window.location.reload();
                        // $('#toast').html(response.message);
                        // $('#toast').css('background-color', 'green');
                        // $('#toast').fadeIn().delay(3000).fadeOut();
                    } else {
                        alert(response.message);
                        return false;
                        $('#toast').html(response.message);
                        $('#toast').css('background-color', 'red');
                        $('#toast').fadeIn().delay(3000).fadeOut();
                    }
                },
                error: function(xhr, status, error) {
                    $('.loader').addClass('d-none');
                    $('#toast').html("Something went wrong");
                    $('#toast').css('background-color', 'red');
                    $('#toast').fadeIn().delay(3000).fadeOut();
                }
            });
        });
        $(document).on('click', '#select-all', function() {
            var _this = $(this);
            if (_this.is(':checked')) {
                $('.check-box').each(function() {
                    $(this).prop('checked', true);
                });
            } else {
                $('.check-box').each(function() {
                    $(this).prop('checked', false);
                });
            }
        });
        $(document).on('click', '#select-all-view', function() {
            if ($(this).is(':checked')) {
                $('.view').each(function() {
                    $(this).prop('checked', true);
                });
            } else {
                $('.view').each(function() {
                    $(this).prop('checked', false);
                });
            }
        });
        $(document).on('click', '#select-all-create', function() {
            if ($(this).is(':checked')) {
                $('.create').each(function() {
                    $(this).prop('checked', true);
                });
            } else {
                $('.create').each(function() {
                    $(this).prop('checked', false);
                });
            }
        });
        $(document).on('click', '#select-all-update', function() {
            if ($(this).is(':checked')) {
                $('.update').each(function() {
                    $(this).prop('checked', true);
                });
            } else {
                $('.update').each(function() {
                    $(this).prop('checked', false);
                });
            }
        });
        $(document).on('click', '#select-all-delete', function() {
            if ($(this).is(':checked')) {
                $('.delete').each(function() {
                    $(this).prop('checked', true);
                });
            } else {
                $('.delete').each(function() {
                    $(this).prop('checked', false);
                });
            }
        });
    });
</script>
@endsection