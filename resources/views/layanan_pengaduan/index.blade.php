@extends('main')
@section('title', 'Layanan Pengaduan')
@section('content')
<div class="content">
    <div class="container-xxl flex-grow-1 container-p-y">
      @if (session('status'))
        <div class="alert alert-success">
          {{ session('status') }}
        </div>
      @endif
      <h3 class="fw-bold mb-3" style="color: white">Data Layanan Pengaduan</h3>

          <!-- Search and Filter Container -->
          <div class="d-flex align-items-center">
            <!-- Search -->
            <div class="navbar-nav align-items-left me-2" style="width: 75%;"> <!-- Atur lebar search -->
              <form action="{{ url('layanan_pengaduan') }}" method="GET">
                {{-- style="background-color: rgba(0, 0, 0, 0.1);" --}}
                <div class="nav-item divider d-flex align-items-center" style="border-radius: 20px;height: 40px;background-color: rgb(255, 255, 255, 0.1);">
                  <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <button type="submit" class="d-inline-block bg-primary rounded-circle border-0" aria-label="Search" style="padding: 0.5rem;">
                      <i class="bx bx-search fs-4 lh-0 text-white"></i>
                    </button>
                  </div>
                  <input
                    type="text"
                    id="search2" 
                    name="search2"
                    class="form-control border-0 text-white text-sm"
                    placeholder="Search..."
                    aria-label="Search..."
                    autocomplete="off"
                    style="background-color: rgba(0, 0, 0, 0);"
                  />
                </div>
              </form>
            </div>
            <!-- /Search -->

            <!-- Filter -->
            <div class="navbar-nav align-items-left" style="width: 25%">
              <div class="nav-item divider d-flex align-items-center" style="border-radius: 20px;height: 40px;background-color: rgb(255, 255, 255, 0.1);">
                <button class="btn d-flex align-items-center" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 20px; padding: 0; margin: 0; width: 100%;">
                  <i class="bx bx-filter-alt fs-4 lh-0 text-white me-2 bg-primary rounded-circle" style="padding: 0.6rem;"></i>
                  <span style="margin: 0; padding: 0;color: rgba(255, 255, 255, 0.5)">Filter by Status</span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                  <li>
                    <label class="dropdown-item">
                      <input type="checkbox" class="status-checkbox" value="Done"> Done
                    </label>
                  </li>
                  <li>
                    <label class="dropdown-item">
                      <input type="checkbox" class="status-checkbox" value="In Progress"> In Progress
                    </label>
                  </li>
                  <li>
                    <label class="dropdown-item">
                      <input type="checkbox" class="status-checkbox" value="Not Started"> Not Started
                    </label>
                  </li>
                  <li class="dropdown-item">
                    <button id="applyFilter" class="btn btn-primary btn-sm">Apply Filter</button>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /Filter -->
          </div>
          <!-- /Search and Filter Container -->

            <!-- Bordered Table -->
            <div class="divider d-flex justify-content-center align-items-center mt-0">
              <a href="{{ url('layanan_pengaduan/export/') }}" class="btn rounded-pill btn-primary mx-1">Excel</a>
              <a href="{{ url('layanan_pengaduan/pdf/') }}" class="btn rounded-pill btn-secondary mx-1">PDF</a>
              <a href="{{ url('layanan_pengaduan/create') }}" class="btn rounded-pill btn-primary mx-1">
                <i class="bx bx-plus"></i>Add
              </a>
            </div>
          

              <div class="card">
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Nama</th>
                          <th>NIK</th>
                          <th>Alamat</th>
                          <th>No. HP/WA</th>
                          <th>File Surat Permohonan Pengajuan</th>
                          {{-- <th>Foto KTP</th>
                          <th>Foto Bukti Pengaduan</th> --}}
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody id="tbody">                         
                        @foreach($layanan_pengaduan as $item)
                          <tr>

                            <td>{{ $loop->iteration + $layanan_pengaduan->firstItem() - 1 }}</td>
                            <td><strong>{{ $item->nama }}</strong></td>
                            <td>{{ $item->nik }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->no_hp }}</td>
                            <td>
                              @if($item->file_surat_permohonan_pengajuan)
                              <a href="{{ asset($item->file_surat_permohonan_pengajuan) }}" target="_blank">Lihat File</a>
                              @else
                                  <span>File tidak tersedia</span>
                              @endif
                          
                            </td>
                            {{-- <td>
                                <a href="{{ asset('upload/' . $item->foto_ktp) }}" target="_blank">Lihat File</a>
                            </td>
                            <td>
                                <a href="{{ asset('upload/' . $item->foto_bukti_pengaduan) }}" target="_blank">Lihat File</a>
                            </td> --}}
                            <td>
                              @php
                                  $badgeClass = '';
                                  switch ($item->status) {
                                      case 'Done':
                                          $badgeClass = 'bg-label-success'; // Hijau untuk aktif
                                          break;
                                      case 'Non Started':
                                          $badgeClass = 'bg-label-danger'; // Merah untuk non-aktif
                                          break;
                                      case 'In Progress':
                                          $badgeClass = 'bg-label-warning'; // Kuning untuk pending
                                          break;
                                      default:
                                          $badgeClass = 'bg-label-danger'; // Warna default
                                          break;
                                  }
                              @endphp
                              <span class="badge {{ $badgeClass }} me-1">{{ $item->status }}</span>
                            </td>
                          
                            <td>
                                <a href="{{ url('layanan_pengaduan/edit/' . $item->id) }}" class="btn btn-secondary btn-sm">
                                    <i class="bx bx-edit-alt me-1"></i>
                                </a>
                                <!-- Tombol untuk membuka modal -->
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">
                                  <i class="bx bx-trash me-1"></i>
                                </button>

                                <!-- Modal Bootstrap -->
                                <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                                  <div class="modal-dialog modal-sm">
                                    <div class="modal-content text-center p-4">
                                      <!-- Ikon dengan margin bawah -->
                                      <i class="bi bi-exclamation-circle-fill text-danger" style="font-size: 85px; margin-top: -15px;margin-bottom: -10px"></i>
                                      
                                      <!-- Teks Konfirmasi -->
                                      <p class="mt-0 mb-3">Apakah Anda yakin ingin menghapus data ini?</p>
                                      
                                      <!-- Tombol Aksi -->
                                      <div class="d-flex justify-content-center gap-3 mb-2">
                                        <button type="button" class="btn btn-secondary bg-primary" data-bs-dismiss="modal">Batal</button>
                                        <form action="{{ url('layanan_pengaduan/delete/' . $item->id) }}" method="POST" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                {{-- <form action="{{ url('layanan_pengaduan/delete/' . $item->id) }}" method="POST" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        <i class="bx bx-trash me-1"></i>
                                    </button>
                                </form> --}}
                                <a href="{{ url('layanan_pengaduan/show/' . $item->id) }}" class="btn btn-dark btn-sm">Detail
                                    <i class="bx bx-right-arrow-alt"></i>
                                </a>

                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="mt-2">
                    {{ $layanan_pengaduan->links() }}
                  </div>
                </div>
              </div>
              <!--/ Bordered Table -->
    </div>
</div>

<script>
  $(document).ready(function(){
    $('#applyFilter').on('click', function(){
      var selectedStatuses = [];

      // Get all selected checkboxes
      $('.status-checkbox:checked').each(function(){
        selectedStatuses.push($(this).val());
      });

      $.ajax({
        url: "{{ route('filter') }}", // Adjust the route to match your filter route
        type: "GET",
        data: { statuses: selectedStatuses },
        success: function(data) {
          var filteredStatuses = data.statuses; // Get the response data
          var html = '';
          
          if (filteredStatuses.length > 0) {
            for (let i = 0; i < filteredStatuses.length; i++) {
              var badgeClass = '';

              // Determine badge class based on the status
              switch (filteredStatuses[i]['status']) {
                case 'Done':
                  badgeClass = 'bg-label-success'; // Green for "Done"
                  break;
                case 'Not Started':
                  badgeClass = 'bg-label-secondary'; // Grey for "Not Started"
                  break;
                case 'In Progress':
                  badgeClass = 'bg-label-warning'; // Yellow for "In Progress"
                  break;
                default:
                  badgeClass = 'bg-label-danger'; // Default color for other statuses
                  break;
              }

              // Handle file_surat_permohonan_pengajuan display
              var fileSuratLink = filteredStatuses[i]['file_surat_permohonan_pengajuan']
              ? '<a href="/' + filteredStatuses[i]['file_surat_permohonan_pengajuan'] + '" target="_blank">Lihat File</a>'
              : 'File tidak tersedia';

              // Build the table rows dynamically with badge and buttons
              html += '<tr>\
                <td>' + (i + 1) + '</td>\
                <td>' + filteredStatuses[i]['nama'] + '</td>\
                <td>' + filteredStatuses[i]['nik'] + '</td>\
                <td>' + filteredStatuses[i]['alamat'] + '</td>\
                <td>' + filteredStatuses[i]['no_hp'] + '</td>\
                <td>' + fileSuratLink + '</td>\
                <td>\
                  <span class="badge ' + badgeClass + ' me-1">' + filteredStatuses[i]['status'] + '</span>\
                </td>\
                <td>\
                  <a href="/layanan_pengaduan/edit/' + filteredStatuses[i]['id'] + '" class="btn btn-secondary btn-sm">\
                    <i class="bx bx-edit-alt me-1"></i>\
                  </a>\
                  <form action="/layanan_pengaduan/delete/' + filteredStatuses[i]['id'] + '" method="POST" class="d-inline">\
                    @method("delete")\
                    @csrf\
                    <button class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')">\
                      <i class="bx bx-trash me-1"></i>\
                    </button>\
                  </form>\
                  <a href="/layanan_pengaduan/show/' + filteredStatuses[i]['id'] + '" class="btn btn-dark btn-sm">Detail\
                    <i class="bx bx-right-arrow-alt"></i>\
                  </a>\
                </td>\
              </tr>';
            }
          } else {
            html += '<tr>\
              <td colspan="7">Tidak Ada Data</td>\
            </tr>';
          }

          // Update the table body with new data
          $("#tbody").html(html);
        }
      });
    });
  });
</script>

@endsection
