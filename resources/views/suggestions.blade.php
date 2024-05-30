@extends('layouts.app')
@section('style')
<style type="text/css">
        .ratingstar {
            position: relative;
            display: inline-block;
            color: transparent; /* Make the original star color transparent */
            margin-right: 20px;
        }
        .ratingstar::before {
            content: "\f005"; /* Unicode for the star icon */
            font-family: "Font Awesome 5 Free"; /* Ensure the correct font family */
            font-weight: 900; /* Ensure the correct font weight */
            color: lightgray; /* Set the desired star color */
            position: absolute;
            top: 0;
            left: 0;
        }
        .ratingstar::after {
            content: "\f005"; /* Unicode for the star icon */
            font-family: "Font Awesome 5 Free"; /* Ensure the correct font family */
            font-weight: 900; /* Ensure the correct font weight */
            color: white; /* Set the background color inside the star */
            position: absolute;
            top: 4px; /* Adjust as needed */
            left: 100px; /* Adjust as needed */
            clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%);
        }
        .ratingstar:hover::before,
        .ratingstar.hover::before,
        .ratingstar.selected::before {
            width: 100%;
            color: #ffcc00; /* Set the desired star color */
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
                    <h1>Add Suggestions</h1>
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
                    @include('_message')
                    <!-- /.card -->
                    <!-- /.card-header -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Suggestions</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" id="form" method="POST" action="{{url('suggestions/store')}}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="InputSuggestion">Suggestions *</label>
                                        <textarea name="suggestion" class="form-control" id="InputSuggestion" placeholder="Enter suggestion"></textarea>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="InputAdministrationComplaint">Administration Complaint *</label>
                                        <textarea name="administration_complaint" class="form-control" id="InputAdministrationComplaint" placeholder="Enter administration complain"></textarea>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="InputGeneralComplaint">General Complaint *</label>
                                        <textarea name="general_complaint" class="form-control" id="InputGeneralComplaint" placeholder="Enter general complain"></textarea>
                                    </div>
                                    <div class="form-group col-12 star-rating">
                                        <label for="InputAdministrativeRating">Administration Rating *</label>
                                        <br>
                                        <i class="far fa-star ratingstar" data-value="1"></i>
                                        <i class="far fa-star ratingstar" data-value="2"></i>
                                        <i class="far fa-star ratingstar" data-value="3"></i>
                                        <i class="far fa-star ratingstar" data-value="4"></i>
                                        <i class="far fa-star ratingstar" data-value="5"></i>
                                        <br>
                                        <br>
                                        <input type="hidden" id="administrative-rating-value" name="administrative_rating">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        var selectedRating = 0;

        $('.ratingstar').on('mouseover', function() {
            var value = $(this).data('value');
            highlightStars(value);
        });

        $('.ratingstar').on('mouseout', function() {
            if (selectedRating === 0) {
                resetStars();
            } else {
                highlightStars(selectedRating);
            }
        });

        $('.ratingstar').on('click', function() {
            selectedRating = $(this).data('value');
            highlightStars(selectedRating);
            $('#administrative-rating-value').val(selectedRating);
        });

        function highlightStars(rating) {
            $('.ratingstar').each(function() {
                if ($(this).data('value') <= rating) {
                    $(this).addClass('hover');
                } else {
                    $(this).removeClass('hover');
                }
            });
        }

        function resetStars() {
            $('.ratingstar').removeClass('hover');
        }
    });
</script>
@endsection