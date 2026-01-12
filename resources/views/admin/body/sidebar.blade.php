<nav class="sidebar">
      <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
          Pemprov<span>SU</span>
        </a>
        <div class="sidebar-toggler not-active">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
      <div class="sidebar-body">
        <ul class="nav">
          <li class="nav-item nav-category">Main</li>
          <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link">
              <i class="link-icon" data-feather="box"></i>
              <span class="link-title">Dashboard</span>
            </a>
          </li>

          <li class="nav-item nav-category">Kepegawaian</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
              <i class="link-icon" data-feather="mail"></i>
              <span class="link-title">PAK</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="emails">
              <ul class="nav sub-menu">
                 @if(session('is_admin'))
                <li class="nav-item">
                  <a href="{{ route('addnewlpak') }}" class="nav-link">Tambah Pegawai</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('viewPAK') }}" class="nav-link">List PAK</a>
                </li>
                @endif
                 @if(session('is_admin') === false)
                <li class="nav-item">
                  <a href="{{ route('addpenilaian') }}" class="nav-link">Pengajuan PAK</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('riwayatPengajuan') }}" class="nav-link">Riwayat PAK</a>
                </li>
                @endif
              </ul>
            </div>
          </li>
          {{-- <li class="nav-item">
            <a href="pages/apps/chat.html" class="nav-link">
              <i class="link-icon" data-feather="message-square"></i>
              <span class="link-title">Chat</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/apps/calendar.html" class="nav-link">
              <i class="link-icon" data-feather="calendar"></i>
              <span class="link-title">Calendar</span>
            </a>
          </li> --}}

        </ul>
      </div>
    </nav>
    <nav class="settings-sidebar">

    </nav>