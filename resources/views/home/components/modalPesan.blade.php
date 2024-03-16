<!-- Modal -->
<div class="modal fade" id="modalPesan" tabindex="-1" aria-labelledby="modalPesanLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Pesan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body overflow-auto" style="max-height: 400px">
        @if ($notifications->isNotEmpty())
          @foreach ($notifications as $notif)
            <div class="border-1 border-dark border p-2 rounded mb-3">
                <div class="border-1 border-bottom mb-2 pb-2">
                  <form action="/karuniamotor/message/delete/{{ $notif->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-danger fw-semibold p-0 btn-ubah-profil" onclick="return confirm('Yakin ingin hapus pesan?')">
                        Hapus
                    </button>
                  </form>
                </div>
                <div class="d-flex align-items-start">
                  <img src="/assets/users/profile/1704656001-test2.jpeg" class="img-fluid rounded-circle" style="max-width: 3rem">
                  <div>
                    <p class="mb-0 pb-0 fw-bold ms-2 text-danger">Karunia Motor</p>
                    <div class="overflow-auto" style="max-height: 100px">
                      <p class="ms-2">{{ $notif->message }}</p>
                    </div>
                  </div>
                </div>
            </div>
          @endforeach
          <form action="{{ route('deleteAllMessage') }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin hapus semua pesan?')">Hapus Semua</button>
          </form>
        @else
            {{-- Pesan Kosong --}}
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col">
                    <img src="/assets/data_kosong.jpg" class="img-fluid">
                </div>
            </div>
        @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>