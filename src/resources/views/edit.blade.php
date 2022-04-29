<x-admin.layout.app>
    @php
    $breadcrumbs = [
        ['name' => 'Element', 'link' => route("admin.element.index")],
        ['name' => $element->title],
        ['name' => "Content"],
        ['name' => "Edit"]
    ];
    @endphp
    <x-admin.atoms.breadcrumb :breadcrumbs="$breadcrumbs" />

    <form id="myform" method="POST"
        action="{{ route('LaravelBlock2Content.edit', $element_id) }}" class="relative" enctype="multipart/form-data">

        <x-admin.atoms.required />

        @csrf
        @method("PATCH")

        @foreach (config('translatable.locales') as $locale)
            <x-admin.atoms.row>
                <x-admin.atoms.label for="text_{{ $locale }}" class="mb-2 required">
                    Text ({{ $locale }})
                </x-admin.atoms.label>
                <textarea name="text[{{ $locale }}]" id="text_{{ $locale }}" class="tinymce-textarea bg-white" style="height: 200px;">
                    {{ $collection->getTranslation("text", $locale) }}
                </textarea>
                @error("text.*")
                    <x-admin.atoms.error>
                        {{ $message }}
                    </x-admin.atoms.error>
                @enderror
            </x-admin.atoms.row>
        @endforeach

        <hr class="my-10">

        <div class="mt-4 text-right">
            <x-admin.atoms.link href="{{ url()->previous() }}">Back</x-admin.atoms.link>
            <x-admin.atoms.button class="ml-3" id="save">Save</x-admin.atoms.button>
        </div>
    </form>
    @push('js')
        <script src="https://cdn.tiny.cloud/1/oc28g760xepwuf67x0d41w72jmhs2pra79599ky264hjbjsi/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            function tinymceInit() {
                tinymce.init({
                    selector: ".tinymce-textarea",
                    height: 500,
                    plugins: [
                        "advlist autolink lists link image charmap print preview anchor",
                        "searchreplace visualblocks code fullscreen",
                        "insertdatetime media table paste imagetools wordcount template"
                    ],
                    toolbar:
                        "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | code template",
                    //content_style:"body { font-family:Helvetica,Arial,sans-serif; font-size:14px }",
                    image_title: true,
                    automatic_uploads: true,
                    images_upload_url: "{{ route('LaravelBlock2Content.api.upload') }}",
                    //images_upload_url: "/admin/media-popup",
                    relative_urls: false,
                    file_picker_types: "image",
                    content_css: "/css/app.css",
                    //file_browser_callback: "fileBrowserCallBack",
                    //images_upload_base_path: "/media",

                    /* style_formats: [
                        {
                            title: "Container",
                            selector: "div",
                            classes: "container px-8 mx-auto"
                        },
                        {
                            title: "Page Title",
                            selector: "p",
                            classes: "text-3xl sm:text-4xl lg:text-5xl lg:leading-normal"
                        },
                        {
                            title: "Block Title",
                            selector: "p",
                            classes: "text-2xl sm:text-3xl lg:text-4xl lg:leading-normal"
                        },
                        {
                            title: "Block Sub Title",
                            selector: "p",
                            classes: "text-xs lg:text-base font-bold"
                        },
                        { title: "Text", selector: "p", classes: "text-xs lg:text-base" }
                    ], */
                    file_picker_callback: function(callback, value, meta) {
                        const input = document.createElement("input");
                        input.setAttribute("type", "file");
                        input.setAttribute("accept", "image/*");
                        input.onchange = function() {
                            var file = this.files[0];
                            var reader = new FileReader();
                            reader.onload = function() {
                                var id = "blobid_" + new Date().getTime();
                                var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                                var base64 = reader.result.split(",")[1];
                                var blobInfo = blobCache.create(id, file, base64);
                                blobCache.add(blobInfo);
                                callback(blobInfo.blobUri(), { title: file.name });
                            };
                            reader.readAsDataURL(file);
                        };
                        input.click();
                    },
                    video_template_callback: function(data) {
                        return (
                            '<div class="my-test"><video width="' +
                            data.width +
                            '" height="' +
                            data.height +
                            '"' +
                            (data.poster ? ' poster="' + data.poster + '"' : "") +
                            ' controls="controls">\n' +
                            '<source src="' +
                            data.source +
                            '"' +
                            (data.sourcemime ? ' type="' + data.sourcemime + '"' : "") +
                            " />\n" +
                            (data.altsource
                                ? '<source src="' +
                                data.altsource +
                                '"' +
                                (data.altsourcemime
                                    ? ' type="' + data.altsourcemime + '"'
                                    : "") +
                                " />\n"
                                : "") +
                            "</video></div>"
                        );
                    },
                    /* setup: function(editor) {
                        editor.on("blur", function(e) {
                            const id = this.id;
                            const $element = $("#" + id);
                            const lang = $element.attr("data-lang");
                            Livewire.emit("updateContent", lang, editor.getContent());
                        });
                    } */
                    /* setup: function(editor) {
                        editor.on("change", function(e) {
                            const id = this.id;
                            const $element = $("#" + id);
                            const lang = $element.attr("data-lang");
                            Livewire.emit("updateContent", lang, editor.getContent());
                        });
                    } */
                    templates: [
                      {
                        title: "SECTION TITLE",
                        description: "For each section title",
                        content: `
                            <div style="font-size: clamp(27px, 4vw, 40px); font-weight: 600; text-align: center; margin-top: 2.75rem;">Section Title</div>
                        `,
                      },
                    ],
                });
            }
            tinymceInit();
        </script>
    @endpush
</x-admin.layout.app>
