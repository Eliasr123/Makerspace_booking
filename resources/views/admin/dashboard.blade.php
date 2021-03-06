@extends('layout')

@section('title','Admin kontrollpanel')

@section('header-title','ADMIN-PANEL')

@section('header-description')
    Välkommen! Här kan du ändra vilken utrustning som finns tillgänglig för bokning, visa och exportera bokningshistoriken samt hantera systemets administratörer.
@endsection
@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="/css/index.css">

@endsection

@section('content')
    <div class="form-container">
        <div class="main-row row">
            <div class="col-md-2 col-xl-3"></div>
            <div class="main-column col-lg-8 col-xl-7">
                @component('components.fields.logoutfield')
                    @slot('title', 'Inloggad som')

                    @slot('name', $activeUser['email'])
                    @slot('onclick')
                        event.preventDefault();
                        document.getElementById('logout-form').submit();
                    @endslot
                    @slot('logout_route', route('logout'))
                    @slot('logout_form')
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">
                            @csrf
                        </form>
                    @endslot
                @endcomponent

                @component('components.box.expandbox')

                    @slot('title','UTRUSTNING')
                    @slot('id', 'equipment')
                    @foreach($equipments as $equipment)
                        @component('components.boxitem.equipment_boxitem')
                            @slot('equipment' , $equipment)
                        @endcomponent
                    @endforeach
                    @slot('add_button_route', route('equipment.index'))

                    @slot('add_button', 'Lägg till utrustning')

                @endcomponent

                @component('components.box.expandbox')

                    @slot('title','BOKNINGSHISTORIK')
                    @slot('id', 'history')
                    @foreach($latestBookings as $booking)
                        @component('components.boxitem.bookinghistory_boxitem')
                            @slot('booking', $booking)
                        @endcomponent
                    @endforeach

                    @slot('add_button_route', route('pdf.export'))
                    @slot('add_button_img', '/images/Ikon%20Exportera.svg')
                    @slot('add_button', 'Exportera bokningar')

                @endcomponent


                @component('components.box.expandbox')

                    @slot('title','ADMINISTRATÖR')
                    @slot('id', 'admins')
                    @foreach($adminUsers as $user)
                        @component('components.boxitem.admin_boxitem')
                            @slot('user', $user)
                            @slot('active_user_id', $activeUser['id'])
                        @endcomponent
                    @endforeach

                    @slot('add_button_route', route('register'))
                    @slot('add_button_img', '/images/Ikon%20Person-plus.svg')
                    @slot('add_button', 'Skapa ny Administratör')

                @endcomponent

                <div class="col-md-2 col-xl-2"></div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="/js/JQueryRotate.js"></script>
    <script src="/js/admin.js"></script>
@endsection
