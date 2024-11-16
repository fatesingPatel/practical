@extends('layouts.emp')
@section('title')
    Hire Nations - Job Posts
@endsection

@section('content')
    <div class="pagetitle">
        <h1>Form Elements</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Forms</li>
                <li class="breadcrumb-item active">Elements</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Employee Create Form</h5>

                    <!-- General Form Elements -->
                    <form method="POST" action="{{ url('/employers/store') }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-lg-6">

                                <label for="inputText" class="col-sm-2 col-form-label">First Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="first_name" id="first_name" class="form-control">
                                </div>
                                @if ($errors->has('first_name'))
                                    <span class="text-danger">
                                        <strong id="first_name-error">{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-lg-6">

                                <label for="inputText" class="col-sm-2 col-form-label">Last Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="last_name" id="first_name" class="form-control">
                                </div>
                                @if ($errors->has('last_name'))
                                    <span class="text-danger">
                                        <strong id="last_name-error">{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-6">

                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email" id="email">
                                </div>
                                @if ($errors->has('email'))
                                    <span class="text-danger">
                                        <strong id="email-error">{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-lg-2">
                                <label for="inputEmail" class="col-sm-12 col-form-label">Country Code</label>
                                <select class="form-select" aria-label="Default select example" name="country_code">
                                    <option value="">Select Country Code</option>
                                    <option value="1">+1</option>
                                    <option value="91">+91</option>
                                    <option value="92">+92</option>
                                </select>
                                @if ($errors->has('country_code'))
                                    <span class="text-danger">
                                        <strong id="country_code-error">{{ $errors->first('country_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-lg-4">

                                <label for="inputEmail" class="col-sm-4 col-form-label">Phone Number</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="phone_number" id="phone_number">
                                </div>
                                @if ($errors->has('phone_number'))
                                    <span class="text-danger">
                                        <strong id="phone_number-error">{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">

                            <div class="col-lg-6">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="address" style="height: 100px"></textarea>
                                </div>
                                @if ($errors->has('address'))
                                    <span class="text-danger">
                                        <strong id="address-error">{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-lg-6">
                                <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" name="photo" id="formFile">
                                </div>
                                @if ($errors->has('photo'))
                                    <span class="text-danger">
                                        <strong id="photo-error">{{ $errors->first('photo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <fieldset class="">
                                    <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="gridRadios1"
                                                value="male" checked>
                                            <label class="form-check-label" for="gridRadios1">
                                                Male
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender"
                                                id="gridRadios2" value="female">
                                            <label class="form-check-label" for="gridRadios2">
                                                Female
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('gender'))
                                        <span class="text-danger">
                                            <strong id="gender-error">{{ $errors->first('gender') }}</strong>
                                        </span>
                                    @endif
                                </fieldset>
                            </div>
                            <div class="col-lg-6">
                                <legend class="col-form-label col-sm-2 pt-0">Hobby</legend>
                                <div class="col-sm-10">

                                    <div class="form-check">
                                        <input class="form-check-input" name="hobby[]" type="checkbox" id="gridCheck1" value="cricket">
                                        <label class="form-check-label" for="gridCheck1">
                                            Cricket
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" name="hobby[]" type="checkbox" id="gridCheck2"
                                            value="travaling">
                                        <label class="form-check-label" for="gridCheck2">
                                            Travaling
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" name="hobby[]" type="checkbox" id="gridCheck2" value="reading">
                                        <label class="form-check-label" for="gridCheck2">
                                            Reading
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('hobby'))
                                    <span class="text-danger">
                                        <strong id="hobby-error">{{ $errors->first('hobby') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form><!-- End General Form Elements -->
                </div>
            </div>
        </div>
    </section>
@endsection
