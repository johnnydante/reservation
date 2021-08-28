@component('mail::message')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <p>
                            Witaj, <br>
                            Przypominamy, że od jutra masz zarezerwowany pojazd {{ $vehicleName }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    Życzymy miłego dnia,
    {{ env('MAIL_FROM_NAME') }}
@endcomponent
