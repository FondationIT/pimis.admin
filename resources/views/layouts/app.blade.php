
  {{-- entete de page  --}}
  @include('layouts.head')
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
    <livewire:layouts.menu />
    {{-- fin menu horizontal --}}
    {{-- menu verital  --}}
    <livewire:layouts.menulateral />
    {{-- fin menu verital  --}}

    <!-- Main Content -->
    <div class="hk-pg-wrapper pb-0">
      @if (session()->has('error'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert" id="flash-error">
              {{ session('error') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
      @endif

        <div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <p id="confirmMessage" class="mb-0">
                            Are you sure you want to continue?
                        </p>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button id="confirmBtn" class="btn btn-danger btn-sm">
                            Confirm
                        </button>
                    </div>

                </div>
            </div>
        </div>



        @yield('content')

    </div>
  </div>
  {{-- entete de page  --}}
      @include('layouts.script')
    {{-- fin entete de page  --}}
</body>
{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const alert = document.getElementById('flash-error');
        if (alert) {
            setTimeout(() => alert.remove(), 4000);
        }
    });
</script> --}}