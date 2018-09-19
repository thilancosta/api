<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="jumbotron">
                <h5>Company details search</h5>
                <div class="row">
                    <div class="col-md-8 offset-2">
                        <form method="get" action="{{ route('admin-getcompanydetails') }}">
                            <br>
                            <div class="row">
                                <div class="col-md-4 offset-md-2">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="company_id"><b>Company ID</b></label>
                                            <input type="text" class="form-control" id="company_id" name="company_id">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-sm btn-primary">Check details</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <br>
                <br>

                <div class="row">
                    <div class="col-md-8 offset-2">
                        <div class="form-group">
                            @if(!empty($company))
                                <label for="company_id"><b>Company Details</b></label>
                                <br>
                                <b>
                                {{ $company->name }}
                                    <br>
                                {{ $company->type_id }}
                                    <br>
                                    {{ $company->email }}
                                    <br>
                                    {{ $company->created_at }}
                                    <br>
                                    {{ $address->province }}
                                    <br>
                                    {{ $address->district }}
                                    <br>

                                    {{ $address->address1 }}{{ $address->address2 }}{{ $address->city }}
                                </b>
                            @else
                                <label for="company_name"><b>Company Name</b></label>
                                @endif
                                <br>
                                <br>
                                @if(!empty($companydirectors))
                                    <label for="company_dir"><b>Company Directors</b></label>
                                    <br>
                                <br>
                                    <b>@foreach($companydirectors as $companydirector)
                                            {{ $companydirector->title  }}
                                        {{ $companydirector->first_name }}
                                        <br>
                                            {{ "nic:-" }}
                                        {{ $companydirector->nic }}
                                        <br>
                                            {{ $companydirector->passport_issued_country }}
                                        <br>
                                            {{ $companydirector->dob }}
                                            <br>

                                            {{ $addressarrays[$companydirector->address_id]->address1 }}{{ $addressarrays[$companydirector->address_id]->address2 }}{{ $addressarrays[$companydirector->address_id]->city }}

                                            <br>
                                            {{ $companydirector->mobile }}
                                            <br>
                                            {{ $companydirector->telephone }}
                                            <br>
                                            {{ $companydirector->email }}
                                        <br><br>

                                        @endforeach
                                    </b>
                                @else
                                    <label for="company_dir"><b>Company Directors</b></label>
                                @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </body>
</html>
