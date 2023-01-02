
  {{-- entete de page  --}}
  @include('layouts.head');
{{-- fin entete de page  --}}


<body>


  <!-- Preloader -->
	<div class="preloader-it">
      <div class="loader-pendulums"></div>
  </div>
  <!-- /Preloader -->

    <!-- Modal Doctrine -->


    <!-- HK Wrapper -->
    <!-- HK Wrapper -->
  <div class="hk-wrapper hk-vertical-nav">
    {{-- menu horizontal  --}}
    @include('layouts.menu');
    {{-- fin menu horizontal --}}
    {{-- menu verital  --}}
    @include('layouts.menulateral');
    {{-- fin menu verital  --}}

    <!-- Main Content -->
    <div class="hk-pg-wrapper">

        @yield('content')
        @include('layouts.footerinclude')


    </div>
  </div>
  {{-- entete de page  --}}
      @include('layouts.script');
    {{-- fin entete de page  --}}
</body>
