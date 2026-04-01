@extends('layouts.app')

@section('title', 'Edit Jurusan - SPK Jurusan SMK Babussalam')

@section('styles')
<style>
.bg-gradient-primary {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.form-control:focus {
  border-color: #4e73df;
  box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
}

.btn-primary {
  background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
  border: none;
}

.btn-primary:hover {
  background: linear-gradient(135deg, #224abe 0%, #1a3a9a 100%);
  transform: translateY(-1px);
  box-shadow: 0 4px 8px rgba(78, 115, 223, 0.3);
}

.card.shadow {
  box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important;
}
</style>
@endsection

@section('content')
<!-- Header Section -->
<div class="row mb-4">
  <div class="col-12">
    <div class="d-flex align-items-center">
      <a href="{{ route('jurusan.index') }}" class="btn btn-outline-secondary me-3">
        <i class="ti ti-arrow-left"></i>
      </a>
      <div>
        <h1 class="h3 mb-0 text-gray-800">
          <i class="ti ti-edit text-warning me-2"></i>Edit Jurusan
        </h1>
        <p class="text-muted mt-1">Edit data jurusan: <strong>{{ $jurusan->nama_jurusan }}</strong></p>
      </div>
    </div>
  </div>
</div>

<!-- Form Card -->
<div class="row">
  <div class="col-xl-8 mx-auto">
    <div class="card shadow">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
          <i class="ti ti-building me-2"></i>Form Edit Data Jurusan
        </h6>
      </div>
      <div class="card-body">
        <form action="{{ route('jurusan.update', $jurusan->id_jurusan) }}" method="POST">
          @csrf
          @method('PUT')

          <!-- Nama Jurusan -->
          <div class="mb-3">
            <label for="nama_jurusan" class="form-label font-weight-bold">
              <i class="ti ti-building text-primary me-1"></i>Nama Jurusan <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control @error('nama_jurusan') is-invalid @enderror"
                   id="nama_jurusan" name="nama_jurusan"
                   value="{{ old('nama_jurusan', $jurusan->nama_jurusan) }}"
                   placeholder="Contoh: Teknik Informatika" required>
            @error('nama_jurusan')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="form-text">Masukkan nama jurusan yang sesuai dengan perguruan tinggi</div>
          </div>

          <!-- Fakultas -->
          <div class="mb-3">
            <label for="fakultas" class="form-label font-weight-bold">
              <i class="ti ti-school text-success me-1"></i>Fakultas <span class="text-danger">*</span>
            </label>
            <div class="d-flex gap-2">
              <select class="form-select @error('fakultas') is-invalid @enderror"
                      id="fakultas" name="fakultas" required>
                <option value="">Pilih Fakultas</option>
                <option value="Fakultas Teknik" {{ old('fakultas', $jurusan->fakultas) == 'Fakultas Teknik' ? 'selected' : '' }}>Fakultas Teknik</option>
                <option value="Fakultas Ekonomi" {{ old('fakultas', $jurusan->fakultas) == 'Fakultas Ekonomi' ? 'selected' : '' }}>Fakultas Ekonomi</option>
                <option value="Fakultas Kedokteran" {{ old('fakultas', $jurusan->fakultas) == 'Fakultas Kedokteran' ? 'selected' : '' }}>Fakultas Kedokteran</option>
                <option value="Fakultas Hukum" {{ old('fakultas', $jurusan->fakultas) == 'Fakultas Hukum' ? 'selected' : '' }}>Fakultas Hukum</option>
                <option value="Fakultas Pertanian" {{ old('fakultas', $jurusan->fakultas) == 'Fakultas Pertanian' ? 'selected' : '' }}>Fakultas Pertanian</option>
                <option value="Fakultas Ilmu Komputer" {{ old('fakultas', $jurusan->fakultas) == 'Fakultas Ilmu Komputer' ? 'selected' : '' }}>Fakultas Ilmu Komputer</option>
                <option value="Fakultas MIPA" {{ old('fakultas', $jurusan->fakultas) == 'Fakultas MIPA' ? 'selected' : '' }}>Fakultas MIPA</option>
                <option value="Fakultas Sastra" {{ old('fakultas', $jurusan->fakultas) == 'Fakultas Sastra' ? 'selected' : '' }}>Fakultas Sastra</option>
                <option value="Fakultas Psikologi" {{ old('fakultas', $jurusan->fakultas) == 'Fakultas Psikologi' ? 'selected' : '' }}>Fakultas Psikologi</option>
              </select>
              <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#addFakultasModal" title="Tambah Fakultas Baru">
                <i class="ti ti-plus"></i>
              </button>
            </div>
            @error('fakultas')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="form-text">Pilih fakultas tempat jurusan berada atau tambah fakultas baru</div>
          </div>

          <!-- Perguruan Tinggi -->
          <div class="mb-4">
            <label for="perguruan_tinggi" class="form-label font-weight-bold">
              <i class="ti ti-university text-info me-1"></i>Perguruan Tinggi <span class="text-danger">*</span>
            </label>
            <div class="d-flex gap-2">
              <select class="form-select @error('perguruan_tinggi') is-invalid @enderror"
                      id="perguruan_tinggi" name="perguruan_tinggi" required>
                <option value="">Pilih Perguruan Tinggi</option>
                <option value="Universitas Indonesia" {{ old('perguruan_tinggi', $jurusan->perguruan_tinggi) == 'Universitas Indonesia' ? 'selected' : '' }}>Universitas Indonesia</option>
                <option value="Institut Teknologi Bandung" {{ old('perguruan_tinggi', $jurusan->perguruan_tinggi) == 'Institut Teknologi Bandung' ? 'selected' : '' }}>Institut Teknologi Bandung</option>
                <option value="Universitas Gadjah Mada" {{ old('perguruan_tinggi', $jurusan->perguruan_tinggi) == 'Universitas Gadjah Mada' ? 'selected' : '' }}>Universitas Gadjah Mada</option>
                <option value="Institut Pertanian Bogor" {{ old('perguruan_tinggi', $jurusan->perguruan_tinggi) == 'Institut Pertanian Bogor' ? 'selected' : '' }}>Institut Pertanian Bogor</option>
                <option value="Universitas Airlangga" {{ old('perguruan_tinggi', $jurusan->perguruan_tinggi) == 'Universitas Airlangga' ? 'selected' : '' }}>Universitas Airlangga</option>
                <option value="Universitas Diponegoro" {{ old('perguruan_tinggi', $jurusan->perguruan_tinggi) == 'Universitas Diponegoro' ? 'selected' : '' }}>Universitas Diponegoro</option>
                <option value="Universitas Brawijaya" {{ old('perguruan_tinggi', $jurusan->perguruan_tinggi) == 'Universitas Brawijaya' ? 'selected' : '' }}>Universitas Brawijaya</option>
                <option value="Universitas Sebelas Maret" {{ old('perguruan_tinggi', $jurusan->perguruan_tinggi) == 'Universitas Sebelas Maret' ? 'selected' : '' }}>Universitas Sebelas Maret</option>
              </select>
              <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#addPerguruanTinggiModal" title="Tambah Perguruan Tinggi Baru">
                <i class="ti ti-plus"></i>
              </button>
            </div>
            @error('perguruan_tinggi')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="form-text">Pilih perguruan tinggi tempat jurusan berada atau tambah perguruan tinggi baru</div>
          </div>

          <!-- Submit Buttons -->
          <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('jurusan.index') }}" class="btn btn-outline-secondary">
              <i class="ti ti-x me-1"></i>Batal
            </a>
            <button type="submit" class="btn btn-primary">
              <i class="ti ti-device-floppy me-1"></i>Update Jurusan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah Fakultas -->
<div class="modal fade" id="addFakultasModal" tabindex="-1" aria-labelledby="addFakultasModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addFakultasModalLabel">
          <i class="ti ti-school text-success me-2"></i>Tambah Fakultas Baru
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addFakultasForm">
          @csrf
          <div class="mb-3">
            <label for="nama_fakultas" class="form-label">Nama Fakultas <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nama_fakultas" name="nama_fakultas" placeholder="Contoh: Fakultas Teknik" required>
            <div class="form-text">Masukkan nama fakultas yang akan ditambahkan</div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
          <i class="ti ti-x me-1"></i>Batal
        </button>
        <button type="button" class="btn btn-success" id="saveFakultasBtn">
          <i class="ti ti-device-floppy me-1"></i>Simpan Fakultas
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah Perguruan Tinggi -->
<div class="modal fade" id="addPerguruanTinggiModal" tabindex="-1" aria-labelledby="addPerguruanTinggiModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addPerguruanTinggiModalLabel">
          <i class="ti ti-university text-info me-2"></i>Tambah Perguruan Tinggi Baru
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addPerguruanTinggiForm">
          @csrf
          <div class="mb-3">
            <label for="nama_perguruan_tinggi" class="form-label">Nama Perguruan Tinggi <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nama_perguruan_tinggi" name="nama_perguruan_tinggi" placeholder="Contoh: Universitas Indonesia" required>
            <div class="form-text">Masukkan nama perguruan tinggi yang akan ditambahkan</div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
          <i class="ti ti-x me-1"></i>Batal
        </button>
        <button type="button" class="btn btn-info" id="savePerguruanTinggiBtn">
          <i class="ti ti-device-floppy me-1"></i>Simpan Perguruan Tinggi
        </button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
// Auto-capitalize nama jurusan
document.getElementById('nama_jurusan').addEventListener('input', function() {
    this.value = this.value.replace(/\b\w/g, l => l.toUpperCase());
});

// Form validation enhancement
(function () {
  'use strict'
  var forms = document.querySelectorAll('.needs-validation')
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }
        form.classList.add('was-validated')
      }, false)
    })
})()

// Tambah Fakultas
document.getElementById('saveFakultasBtn').addEventListener('click', function() {
    const namaFakultas = document.getElementById('nama_fakultas').value.trim();

    if (!namaFakultas) {
        alert('Nama fakultas tidak boleh kosong!');
        return;
    }

    // Disable button
    this.disabled = true;
    this.innerHTML = '<i class="ti ti-loader me-1"></i>Menyimpan...';

    // AJAX request
    fetch('{{ route("jurusan.addFakultas") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            nama_fakultas: namaFakultas
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Add to dropdown
            const select = document.getElementById('fakultas');
            const option = new Option(namaFakultas, namaFakultas);
            select.appendChild(option);
            select.value = namaFakultas;

            // Close modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('addFakultasModal'));
            modal.hide();

            // Reset form
            document.getElementById('nama_fakultas').value = '';

            // Show success message
            showAlert('Fakultas berhasil ditambahkan!', 'success');
        } else {
            alert(data.message || 'Terjadi kesalahan saat menambah fakultas');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menambah fakultas');
    })
    .finally(() => {
        // Re-enable button
        this.disabled = false;
        this.innerHTML = '<i class="ti ti-device-floppy me-1"></i>Simpan Fakultas';
    });
});

// Tambah Perguruan Tinggi
document.getElementById('savePerguruanTinggiBtn').addEventListener('click', function() {
    const namaPerguruanTinggi = document.getElementById('nama_perguruan_tinggi').value.trim();

    if (!namaPerguruanTinggi) {
        alert('Nama perguruan tinggi tidak boleh kosong!');
        return;
    }

    // Disable button
    this.disabled = true;
    this.innerHTML = '<i class="ti ti-loader me-1"></i>Menyimpan...';

    // AJAX request
    fetch('{{ route("jurusan.addPerguruanTinggi") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            nama_perguruan_tinggi: namaPerguruanTinggi
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Add to dropdown
            const select = document.getElementById('perguruan_tinggi');
            const option = new Option(namaPerguruanTinggi, namaPerguruanTinggi);
            select.appendChild(option);
            select.value = namaPerguruanTinggi;

            // Close modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('addPerguruanTinggiModal'));
            modal.hide();

            // Reset form
            document.getElementById('nama_perguruan_tinggi').value = '';

            // Show success message
            showAlert('Perguruan tinggi berhasil ditambahkan!', 'success');
        } else {
            alert(data.message || 'Terjadi kesalahan saat menambah perguruan tinggi');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menambah perguruan tinggi');
    })
    .finally(() => {
        // Re-enable button
        this.disabled = false;
        this.innerHTML = '<i class="ti ti-device-floppy me-1"></i>Simpan Perguruan Tinggi';
    });
});

// Function to show alert
function showAlert(message, type = 'success') {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
    alertDiv.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;

    document.body.appendChild(alertDiv);

    // Auto remove after 5 seconds
    setTimeout(() => {
        if (alertDiv.parentNode) {
            alertDiv.remove();
        }
    }, 5000);
}

// Reset form when modal is hidden
document.getElementById('addFakultasModal').addEventListener('hidden.bs.modal', function() {
    document.getElementById('nama_fakultas').value = '';
});

document.getElementById('addPerguruanTinggiModal').addEventListener('hidden.bs.modal', function() {
    document.getElementById('nama_perguruan_tinggi').value = '';
});
</script>
@endsection