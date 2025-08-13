@extends('admin.app') {{-- layout dengan sidebar + navbar --}}

@section('content')
    <div class="p-6 bg-gray-100 min-h-screen">
        <h2 class="text-2xl font-bold mb-6">Halaman Buat Artikel Sejarah</h2>
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.sejarah.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label for="judul" class="block font-medium text-lg mb-1">Masukan Judul</label>
                <input type="text" name="judul" id="judul" required
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-500" />
            </div>

            <div>
                <label for="gambar" class="block font-medium text-lg mb-1">Pilih Gambar</label>
                <input type="file" name="gambar" id="gambar" class="w-full px-4 py-2 border rounded-md bg-white" />
            </div>

            <div>
                <label for="isi" class="block font-medium text-lg mb-1">Isi Artikel</label>
                <textarea name="konten" id="konten" rows="10" class="w-full px-4 py-2 border rounded-md"></textarea>
            </div>

            <div>
                <button type="submit"
                    class="bg-blue-900 hover:bg-blue-800 text-white font-semibold px-6 py-2 rounded shadow">
                    Simpan
                </button>
            </div>
        </form>
    </div>

    {{-- TinyMCE --}}

    @push('scripts')
        <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
        <script>
            class MyUploadAdapter {
                constructor(loader) {
                    this.loader = loader;
                }

                upload() {
                    return this.loader.file
                        .then(file => new Promise((resolve, reject) => {
                            const data = new FormData();
                            data.append('upload', file);

                            fetch("{{ route('admin.upload.image') }}", {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: data
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.url) {
                                        resolve({
                                            default: data.url
                                        });
                                    } else {
                                        reject(data.error || 'Upload error.');
                                    }
                                })
                                .catch(error => {
                                    reject('Upload failed: ' + error.message);
                                });
                        }));
                }

                abort() {
                    // No need to implement for now
                }
            }

            function MyCustomUploadAdapterPlugin(editor) {
                editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                    return new MyUploadAdapter(loader);
                };
            }

            ClassicEditor
                .create(document.querySelector('#konten'), {
                    extraPlugins: [MyCustomUploadAdapterPlugin],
                    toolbar: [
                        'heading', '|',
                        'fontfamily', 'fontsize', '|',
                        'bold', 'italic', 'underline', 'strikethrough', '|',
                        'fontColor', 'fontBackgroundColor', '|',
                        'numberedList', 'bulletedList', '|',
                        'alignment', 'outdent', 'indent', '|',
                        'link', 'blockQuote', 'insertTable', 'imageUpload', '|',
                        'undo', 'redo'
                    ],
                    fontFamily: {
                        options: [
                            'default',
                            'Arial, Helvetica, sans-serif',
                            'Courier New, Courier, monospace',
                            'Georgia, serif',
                            'Lucida Sans Unicode, Lucida Grande, sans-serif',
                            'Tahoma, Geneva, sans-serif',
                            'Times New Roman, Times, serif',
                            'Trebuchet MS, Helvetica, sans-serif',
                            'Verdana, Geneva, sans-serif'
                        ]
                    },
                    fontSize: {
                        options: [9, 11, 13, 'default', 17, 19, 21],
                        supportAllValues: true
                    },
                    image: {
                        toolbar: [
                            'imageTextAlternative',
                            'imageStyle:alignLeft',
                            'imageStyle:full',
                            'imageStyle:alignRight'
                        ],
                        styles: [
                            'full',
                            'alignLeft',
                            'alignRight'
                        ]
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        </script>
    @endpush
@endsection
