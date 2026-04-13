@extends('layouts.index', ['title' => 'Dashboard'])

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="admin-main">
  <div class="bg-white h-full w-full rounded-xl p-3 mb-2">
    <div class="admin-toolbar flex w-full justify-between items-start lg:items-center gap-3 flex-wrap lg:flex-nowrap">
      <p class="text-[25px] font-black text-gray-800">JENIS & SUB JENIS PELAYANAN</p>

      {{-- Search + Tambah --}}
      <div class="flex gap-2 items-center">
        <input id="searchBox" type="text" placeholder="Cari jenis atau sub jenis..."
          class="border border-gray-300 rounded-full px-3 py-1 text-sm">
        <button id="btnAddBagian"
          class="py-1 text-center items-center bg-white border border-orange-400 rounded-full font-bold text-sm px-3 text-orange-700">
          + Tambah Bagian
        </button>
        <button id="btnEditBagian"
          class="py-1 text-center items-center bg-white border border-blue-400 rounded-full font-bold text-sm px-3 text-blue-700">
          Ubah Bagian
        </button>
        <button id="btnDeleteBagian"
          class="py-1 text-center items-center bg-white border border-red-400 rounded-full font-bold text-sm px-3 text-red-700">
          Hapus Bagian
        </button>
        <button id="btnAdd"
          class="py-1 text-center items-center bg-gradient-to-br from-[#EA580C] from-60% to-[#FDBA74] to-95% rounded-full font-bold text-sm px-3 text-gray-900">
          + Tambah Sub Jenis
        </button>
      </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mt-4">
      {{-- Kolom kiri: daftar 9 Bagian --}}
      <div class="lg:col-span-1 border rounded-xl border-black">
        <div class="grid grid-cols-1 gap-1">
            @foreach($bagianList as $key => $label)
            <button
                class="bagian-btn cursor-pointer p-2 rounded-xl font-extrabold text-left text-[#0f1a2b]
                    bg-white border-2 border-white hover:bg-gray-200"
                data-id="{{ $key }}">
                {{ strtoupper($label) }}
            </button>
            @endforeach
        </div>
      </div>

      {{-- Kolom kanan: daftar sub jenis + CRUD --}}
      <div class="lg:col-span-2">
        <div class="border border-[#EA580C] rounded-lg overflow-hidden">
            <div class="bg-gradient-to-br from-[#EA580C] from-60% to-[#FDBA74] to-95% px-4 py-2">
                <div class="flex justify-between items-center">
                <div>
                    <span class="text-gray-900 font-bold">Bagian terpilih:</span>
                    <span id="selectedLabel" class="font-black text-gray-900">-</span>
                </div>
                <div class="text-gray-900 text-sm">
                    <span id="rowCount">0</span> sub jenis
                </div>
                </div>
            </div>

            <div class="p-3">
                <div id="groupWrap" class="space-y-4"><!-- render here --></div>
            </div>
            </div>
        </div>
    </div>
    </div>

    {{-- Modal Tambah / Edit --}}
    <div id="modal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">
    <div class="bg-white rounded-2xl w-[90%] max-w-md p-4">
        <h3 id="modalTitle" class="text-lg font-bold text-gray-800 mb-3">Tambah Sub Jenis</h3>
        <div class="space-y-3">
        <input type="hidden" id="formId">
        <input type="hidden" id="formBagian">

        <div>
            <label class="text-sm font-semibold text-gray-700">Program</label>
            <input id="formJenis" type="text"
                class="w-full border border-gray-300 rounded-lg px-3 py-2"
              placeholder="mis. Nama Program">
        </div>
        </div>
        <div class="flex justify-end gap-2 mt-4">
        <button id="btnCancel" class="px-3 py-1 rounded-full border">Batal</button>
        <button id="btnSave"
            class="px-4 py-1 rounded-full font-bold text-gray-900 bg-gradient-to-br from-[#EA580C] from-60% to-[#FDBA74] to-95%">
            Simpan
        </button>
        </div>
    </div>
    </div>

  </div>
</div>

{{-- jQuery sudah ada di layout kamu --}}
<script>
  const bagianMap = @json($bagianList);
  let currentBagian = null;
  let currentEditingId = null;

  $.ajaxSetup({ headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content } });

  $('.bagian-btn').on('click', function() {
    $('.bagian-btn').removeClass('bg-[#0f1a2b] text-white').addClass('bg-white text-[#0f1a2b]');
    $(this).removeClass('bg-white text-[#0f1a2b]').addClass('bg-[#0f1a2b] text-white hover:text-gray-800');
    currentBagian = $(this).data('id');
    $('#selectedLabel').text(bagianMap[currentBagian]);
    loadList();
  });

  $('#btnAdd').on('click', () => {
    if (!currentBagian) { alert('Pilih bagian dulu.'); return; }
    openModal({id:null, bagian: currentBagian, bidang:'', jenis:''}, 'Tambah Sub Jenis');
  });

  $('#btnAddBagian').on('click', () => {
    const nama = prompt('Masukkan nama bagian baru (contoh: Bagian Teknologi Informasi)');
    if (nama === null) return;
    const trimmed = (nama || '').trim();
    if (!trimmed) {
      alert('Nama bagian wajib diisi.');
      return;
    }

    $.post('/sub-jenis/bagian/store', { nama: trimmed })
      .done(({ok, message}) => {
        if (ok) {
          alert('Bagian berhasil ditambahkan. Halaman akan dimuat ulang.');
          window.location.reload();
        } else {
          alert(message || 'Gagal menambah bagian');
        }
      })
      .fail((xhr) => alert(xhr.responseJSON?.message ?? 'Gagal menambah bagian'));
  });

  $('#btnEditBagian').on('click', () => {
    if (!currentBagian) {
      alert('Pilih bagian yang ingin diubah.');
      return;
    }

    const currentName = $('#selectedLabel').text().trim() || '';
    const nama = prompt('Ubah nama bagian:', currentName);
    if (nama === null) return;

    const trimmed = (nama || '').trim();
    if (!trimmed) {
      alert('Nama bagian wajib diisi.');
      return;
    }

    $.ajax({
      url: `/sub-jenis/bagian/${currentBagian}`,
      type: 'PUT',
      data: { nama: trimmed },
    })
      .done(({ok, message}) => {
        if (ok) {
          alert('Bagian berhasil diubah. Halaman akan dimuat ulang.');
          window.location.reload();
        } else {
          alert(message || 'Gagal mengubah bagian');
        }
      })
      .fail((xhr) => alert(xhr.responseJSON?.message ?? 'Gagal mengubah bagian'));
  });

  $('#btnDeleteBagian').on('click', () => {
    if (!currentBagian) {
      alert('Pilih bagian yang ingin dihapus.');
      return;
    }

    const currentName = $('#selectedLabel').text().trim() || '';
    if (!confirm(`Hapus bagian "${currentName}"?`)) return;

    $.ajax({
      url: `/sub-jenis/bagian/${currentBagian}`,
      type: 'DELETE',
    })
      .done(({ok, message}) => {
        if (ok) {
          alert('Bagian berhasil dihapus. Halaman akan dimuat ulang.');
          window.location.reload();
        } else {
          alert(message || 'Gagal menghapus bagian');
        }
      })
      .fail((xhr) => alert(xhr.responseJSON?.message ?? 'Gagal menghapus bagian'));
  });
  $('#btnCancel').on('click', closeModal);

  $('#btnSave').on('click', function() {
    const id = $('#formId').val();
    const body = {
      bagian: $('#formBagian').val(),
      bidang: 'PROGRAM', // selalu simpan sebagai PROGRAM
      jenis:  ($('#formJenis').val()||'').trim(),
    };
    if (!body.jenis) { alert('Nama program wajib diisi.'); return; }

    if (id) {
      $.ajax({ url:`/sub-jenis/${id}`, type:'PUT', data: body })
        .done(({ok,message}) => { if (ok) { closeModal(); loadList(); } else alert(message||'Gagal'); })
        .fail(xhr => alert(xhr.responseJSON?.message ?? 'Gagal menyimpan'));
    } else {
      $.post('/sub-jenis/store', body)
        .done(({ok,message}) => { if (ok) { closeModal(); loadList(); } else alert(message||'Gagal'); })
        .fail(xhr => alert(xhr.responseJSON?.message ?? 'Gagal menambah'));
    }
  });

  function loadList(){
    if (!currentBagian) return;
    const q = $('#searchBox').val() || '';
    $('#groupWrap').html('<div class="text-sm text-gray-500 px-2">Memuat…</div>');
    $.get('/sub-jenis/list', { bagian: currentBagian, q })
      .done(({data, bidangOptions}) => {
        renderDatalist(bidangOptions||[]);
        renderGrouped(data||[]);
      })
      .fail(()=> $('#groupWrap').html('<div class="text-sm text-red-600 px-2">Gagal memuat data</div>'));
  }

  function renderDatalist(opts){
    const html = (opts||[]).map(o=>`<option value="${escapeAttr(o)}">`).join('');
    $('#dlBidang').html(html);
  }

  function renderGrouped(groups){
    let total = 0;
    let html = '';
    groups.forEach(g => {
      const items = g.items || [];
      total += items.length;
      html += `
        <div class="rounded-xl border border-gray-200 overflow-hidden">
          <div class="bg-gray-100 px-3 py-2 font-bold flex items-center justify-between gap-2">
            <span>${escapeHtml(g.bidang)}</span>
            <div class="flex items-center gap-3 text-xs font-medium">
              <button class="text-orange-700 hover:underline" onclick="editJenis('${escapeAttr(g.bidang)}')">Ubah Jenis</button>
              <button class="text-red-700 hover:underline" onclick="deleteJenis('${escapeAttr(g.bidang)}')">Hapus Jenis</button>
            </div>
          </div>
          <div class="divide-y">
            ${items.map(it => `
              <div class="flex items-center justify-between px-3 py-2">
                <div class="text-sm">${escapeHtml(it.jenis)}</div>
                <div class="flex gap-3 text-xs">
                  <button class="text-orange-700 hover:underline"
                          onclick="editItem(${it.id}, ${it.bagian}, '${escapeAttr(it.bidang)}', '${escapeAttr(it.jenis)}')">Ubah</button>
                  <button class="text-red-700 hover:underline" onclick="deleteItem(${it.id})">Hapus</button>
                </div>
              </div>
            `).join('')}
          </div>
        </div>
      `;
    });

    if (!html) html = '<div class="text-sm text-gray-500 px-2">Belum ada data</div>';
    $('#groupWrap').html(html);
    $('#rowCount').text(total);
  }

  function openModal(item, title){
    $('#modalTitle').text(title);
    $('#formId').val(item.id ?? '');
    $('#formBagian').val(item.bagian ?? currentBagian);
    $('#formBidang').val(item.bidang ?? '');
    $('#formJenis').val(item.jenis ?? '');
    $('#modal').removeClass('hidden');
  }
  function closeModal(){ $('#modal').addClass('hidden'); }

  window.editItem = (id, bagian, bidang, jenis) => {
    openModal({id, bagian, bidang, jenis}, 'Ubah Sub Jenis');
  };

  window.editJenis = (oldBidang) => {
    if (!currentBagian) return;
    const newBidang = prompt('Ubah nama jenis pelayanan:', oldBidang || '');
    if (newBidang === null) return;
    const trimmed = (newBidang || '').trim();
    if (!trimmed) {
      alert('Nama jenis tidak boleh kosong.');
      return;
    }

    $.ajax({
      url: '/sub-jenis/jenis',
      type: 'PUT',
      data: {
        bagian: currentBagian,
        old_bidang: oldBidang,
        new_bidang: trimmed,
      }
    })
      .done(({ok, message}) => {
        if (ok) {
          loadList();
        } else {
          alert(message || 'Gagal mengubah jenis');
        }
      })
      .fail((xhr) => alert(xhr.responseJSON?.message ?? 'Gagal mengubah jenis'));
  };

  window.deleteJenis = (bidang) => {
    if (!currentBagian) return;
    if (!confirm(`Hapus jenis "${bidang}" beserta semua sub jenisnya?`)) return;

    $.ajax({
      url: '/sub-jenis/jenis',
      type: 'DELETE',
      data: {
        bagian: currentBagian,
        bidang,
      }
    })
      .done(({ok, message}) => {
        if (ok) {
          loadList();
        } else {
          alert(message || 'Gagal menghapus jenis');
        }
      })
      .fail((xhr) => alert(xhr.responseJSON?.message ?? 'Gagal menghapus jenis'));
  };

  window.deleteItem = (id) => {
    if (!confirm('Hapus data ini?')) return;
    $.ajax({ url:`/sub-jenis/${id}`, type:'DELETE' })
      .done(({ok}) => { if (ok) loadList(); })
      .fail(()=> alert('Gagal menghapus'));
  };

  function escapeHtml(s){ return (s||'').replace(/[&<>"']/g, m=>({ '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;' }[m])); }
  function escapeAttr(s){ return (s||'').replace(/['"\\]/g, m=>({ "'":"\\'", '"':'&quot;', "\\":"\\\\" }[m])); }
</script>
@endsection






