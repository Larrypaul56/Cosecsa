@extends('layout.app')

@section('content')
<div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
 
        <!-- Main content -->
        <section class="content">
            <!-- Multi step form -->
            <section class="multi_step_form">
                <form id="msform" method="POST" action="{{ url('admin/associates/reps/edit/'.$countryRep->reps_id) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <!-- Tittle -->
                    <div class="tittle">
                        <h2>Edit Coutry Representative</h2>
                    </div>
                    <!-- progressbar -->
                    <ul id="progressbar">
                        <li class="active">Personal Information</li>
                    </ul>
                    <!-- fieldsets -->
                    <fieldset>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Full Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $countryRep->name }}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $countryRep->user_email }}" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Leave blank if not changing">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Phone Number</label>
                                <input type="text" name="mobile_no" class="form-control" value="{{ $countryRep->mobile_no }}" required>
                            </div>
                        </div>

                        <div class="form-row">

                                <div class="form-group col-md-6">
                                    <label>Country Name</label>
                                    <select name="country_id" class="form-control" required>
                                        <option value="" disabled>Select Country</option>
                                        @foreach($getCountry as $country)
                                            <option value="{{ $country->id }}" {{ $country->id == $countryRep->id ? 'selected' : '' }}>{{ $country->country_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label> Cosecsa Email</label>
                                    <input type="email" name="cosecsa_email" class="form-control" placeholder="" value="{{ $countryRep->cosecsa_email }}" required>
                                </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Associate Type</label>
                                <select name="user_type" class="form-control" required>
                                    <option value="" disabled>Select Type...</option>
                                    <option value="2" {{ $countryRep->user_type == 2 ? 'selected' : '' }}>Trainee</option>
                                    <option value="3" {{ $countryRep->user_type == 3 ? 'selected' : '' }}>Candidate</option>
                                    <option value="4" {{ $countryRep->user_type == 4 ? 'selected' : '' }}>Programme Director</option>
                                    <option value="5" {{ $countryRep->user_type == 5 ? 'selected' : '' }}>Country Representative</option>
                                </select>
                            </div>
                        </div>

                        <div class="input-group col-md-12">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="upload" name="profile_image">
                                <label class="custom-file-label" for="upload">
                                    <i class="ion-android-cloud-outline"></i> Upload Profile Image
                                </label>
                            </div>
                        </div>
                    
                        <button type="button" class="action-button previous_button">Back</button>
                        <button type="submit" class="action-button">Submit</button>
                    </fieldset>
                </form>
            </section>
            <!-- End Multi step form -->
        </section>
        <!-- /.content -->
    </div>
</div>

<style>
    #progressbar {
        margin-bottom: 30px;
        overflow: hidden;
    }
    #progressbar li {
        list-style-type: none;
        color: #99a2a8;
        font-size: 9px;
        width: calc(100%) !important;
        float: left;
        position: relative;
        font: 500 13px/1 $roboto;
    }
    fieldset {
        border: 0;
        padding: 20px 105px 0;
    }
</style>

<script>
    $(function () {
        bsCustomFileInput.init();

        $('.next').click(function() {
            var currentFieldset = $(this).closest('fieldset');
            var isValid = true;
            currentFieldset.find('input, select').each(function() {
                if ($(this).prop('required') && !$(this).val()) {
                    isValid = false;
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });
            if (isValid) {
                currentFieldset.hide();
                currentFieldset.next().show();
                updateProgressBar();
            }
        });

        $('.previous').click(function() {
            var currentFieldset = $(this).closest('fieldset');
            currentFieldset.hide();
            currentFieldset.prev().show();
            updateProgressBar();
        });

        function updateProgressBar() {
            var activeIndex = $('fieldset:visible').index();
            $('#progressbar li').removeClass('active');
            $('#progressbar li').eq(activeIndex).addClass('active');
        }

        $('fieldset:first').show();
        $('fieldset').not(':first').hide();
    });
</script>

@endsection
