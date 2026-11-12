<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Portofolio — {{ auth()->user()->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <style>
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            color: #9ca3af !important;
            font-size: 0.75rem;
            margin-bottom: 1rem;
        }
        .dataTables_wrapper .dataTables_filter input,
        .dataTables_wrapper .dataTables_length select {
            background-color: #111418;
            border: 1px solid #374151;
            color: #f3f4f6;
            border-radius: 0.375rem;
            padding: 0.25rem 0.5rem;
        }
    </style>
</head>
<body class="bg-[#111418] text-gray-100 min-h-screen">

    <nav class="bg-[#181c22] border-b border-gray-800 px-6 py-4 flex items-center justify-between">
        <span class="font-mono text-sm text-emerald-400 font-bold">&lt;/&gt; Portofolio Admin</span>
        <div class="flex items-center gap-4 text-xs">
            <a href="{{ route('portfolio.index') }}" target="_blank" class="text-gray-300 hover:text-emerald-400">Lihat Web &nearr;</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-red-400 hover:underline">Logout</button>
            </form>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-6 py-10 space-y-8">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold">Manajemen Proyek Portofolio</h1>
            <button onclick="openModal()" class="px-4 py-2 rounded bg-emerald-500 hover:bg-emerald-400 text-gray-950 font-semibold text-xs">
                + Tambah Proyek
            </button>
        </div>

        <div class="bg-[#181c22] border border-gray-800 rounded-xl p-6 overflow-x-auto">
            <table id="projectsTable" class="w-full text-left text-sm text-gray-300">
                <thead>
                    <tr class="border-b border-gray-700 text-xs uppercase text-gray-400">
                        <th>No</th>
                        <th>Judul Proyek</th>
                        <th>Kategori</th>
                        <th>Tech Stack</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </main>

    <!-- Modal Form Tambah / Edit -->
    <div id="projectModal" class="hidden fixed inset-0 bg-black/70 flex items-center justify-center p-4 z-50">
        <div class="bg-[#181c22] border border-gray-700 rounded-xl w-full max-w-lg p-6 space-y-4">
            <h2 id="modalTitle" class="text-lg font-bold text-white">Tambah Proyek</h2>
            <form id="projectForm" enctype="multipart/form-data" class="space-y-3 text-sm">
                <input type="hidden" id="projectId">
                <div>
                    <label class="block text-xs text-gray-400 mb-1">Judul Proyek</label>
                    <input type="text" name="title" id="title" required class="w-full bg-[#111418] border border-gray-700 rounded px-3 py-2 text-white">
                </div>
                <div>
                    <label class="block text-xs text-gray-400 mb-1">Kategori</label>
                    <input type="text" name="category" id="category" placeholder="Enterprise Web App" required class="w-full bg-[#111418] border border-gray-700 rounded px-3 py-2 text-white">
                </div>
                <div>
                    <label class="block text-xs text-gray-400 mb-1">Deskripsi</label>
                    <textarea name="description" id="description" rows="3" required class="w-full bg-[#111418] border border-gray-700 rounded px-3 py-2 text-white"></textarea>
                </div>
                <div>
                    <label class="block text-xs text-gray-400 mb-1">Tech Stack (pisahkan dengan koma)</label>
                    <input type="text" name="tech_stack" id="tech_stack" placeholder="Laravel, AJAX, Yajra DataTables" required class="w-full bg-[#111418] border border-gray-700 rounded px-3 py-2 text-white">
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs text-gray-400 mb-1">URL GitHub</label>
                        <input type="url" name="github_url" id="github_url" class="w-full bg-[#111418] border border-gray-700 rounded px-3 py-2 text-white">
                    </div>
                    <div>
                        <label class="block text-xs text-gray-400 mb-1">URL Live Demo</label>
                        <input type="url" name="demo_url" id="demo_url" class="w-full bg-[#111418] border border-gray-700 rounded px-3 py-2 text-white">
                    </div>
                </div>
                <div>
                    <label class="block text-xs text-gray-400 mb-1">Screenshot / Thumbnail (Opsional)</label>
                    <input type="file" name="thumbnail" accept="image/*" class="w-full text-xs text-gray-400">
                </div>
                <div class="flex justify-end gap-2 pt-3">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 rounded border border-gray-700 text-xs">Batal</button>
                    <button type="submit" class="px-4 py-2 rounded bg-emerald-500 text-gray-950 font-semibold text-xs">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

        const table = $('#projectsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.projects.data') }}",
            columns: [
                { data: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'title' },
                { data: 'category' },
                { data: 'tech_stack', orderable: false },
                { data: 'action', orderable: false, searchable: false }
            ]
        });

        function openModal() {
            $('#projectForm')[0].reset();
            $('#projectId').val('');
            $('#modalTitle').text('Tambah Proyek');
            $('#projectModal').removeClass('hidden');
        }

        function closeModal() {
            $('#projectModal').addClass('hidden');
        }

        function editProject(data) {
            $('#projectId').val(data.id);
            $('#title').val(data.title);
            $('#category').val(data.category);
            $('#description').val(data.description);
            $('#tech_stack').val(Array.isArray(data.tech_stack) ? data.tech_stack.join(', ') : '');
            $('#github_url').val(data.github_url || '');
            $('#demo_url').val(data.demo_url || '');
            $('#modalTitle').text('Edit Proyek');
            $('#projectModal').removeClass('hidden');
        }

        $('#projectForm').on('submit', function (e) {
            e.preventDefault();
            const id = $('#projectId').val();
            const formData = new FormData(this);
            let url = "{{ route('admin.projects.store') }}";

            if (id) {
                url = `/admin/projects/${id}`;
                formData.append('_method', 'PUT');
            }

            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function () {
                    closeModal();
                    table.ajax.reload(null, false);
                }
            });
        });

        function deleteProject(id) {
            if (!confirm('Hapus proyek ini?')) return;
            $.ajax({
                url: `/admin/projects/${id}`,
                method: 'DELETE',
                success: function () {
                    table.ajax.reload(null, false);
                }
            });
        }
    </script>
</body>
</html>
