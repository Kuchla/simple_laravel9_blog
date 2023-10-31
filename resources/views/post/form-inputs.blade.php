<div class="overflow-y-auto h-64">
    <x-input-label for="title" :value="__('Title')" />
    <x-text-input :disabled="$this->disabledInputs" id="title" class="block mt-1 w-full" type="text" required autofocus
        wire:model.lazy="post.title" />
    <x-input-error :messages="$errors->get('post.title')" class="mt-2" />

    <x-input-label for="description" :value="__('Description')" class="mt-2" />
    <textarea id="description" rows="2" wire:model.lazy="post.description" @disabled($this->disabledInputs)
        class="mt-1 w-full resize-none rounded rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
    <x-input-error :messages="$errors->get('post.description')" class="mt-2" />

    <x-input-label for="text" :value="__('Text')" class="mt-2" />
    <div wire:ignore id="ckdiv-{{ @$ckeditor_class }}">
        <textarea id="text" rows="3" wire:model.lazy="post.text" @disabled($this->disabledInputs)
            class="{{ @$ckeditor_class }} mt-1 w-full resize-none rounded rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
    </div>
    <x-input-error :messages="$errors->get('post.text')" class="mt-2" />

    <x-input-label for="category_id" :value="__('Category')" class="mt-2" />
    <select wire:model="post.category_id" @disabled($this->disabledInputs) id="category_id"
        class="mt-1 w-full resize-none rounded rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
        aria-label="Default select example">
        <option selected>Select a option</option>
        @foreach ($this->category as $category)
            <option value="{{ $category->id }}" wire:key={{ $category->id }}>{{ $category->name }}</option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('post.category_id')" class="mt-2" />

    <x-input-label for="image" :value="__('Image')" class="mt-2" />
    <div class="flex items-center justify-center w-full">
        <label for="dropzone-file"
            class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                    </path>
                </svg>

                @switch($this->formAction)
                    @case('show')
                        <img class="h-32 w-40" src="{{ asset(@$this->post->image->path) }}">
                    @break

                    @case('edit')
                        <img class="h-32 w-40"
                            src="{{ $this->image ? $this->image->temporaryUrl() : asset(@$this->post->image->path) }}">
                    @break

                    @default
                        @if ($this->image)
                            <img class="h-32 w-40" src="{{ $this->image->temporaryUrl() }}">
                        @endif
                @endswitch
                <input id="dropzone-file" type="file" class="hidden" @disabled($this->disabledInputs) wire:model="image"
                    accept="image/jpg, image/jpeg, image/png" />

                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to
                        choose</span></p>
                <p class="text-xs text-gray-500 dark:text-gray-400">PNG JPEG or JPG</p>
            </div>
        </label>
    </div>
    <x-input-error :messages="$errors->get('image')" class="mt-2" />

    <div>
        <x-input-label for="image" :value="__('Tags')" class="mt-3" />
        <div wire:ignore id="tags{{ @$ckeditor_class }}" class="tags{{ @$ckeditor_class }}" wire:model="tag"></div>
    </div>

    <div class="block mt-4">
        <label for="active" class="inline-flex items-center">
            <input id="active" type="checkbox" wire:model="post.active" @disabled($this->disabledInputs)
                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <span class="ml-2 text-sm text-gray-600">{{ __('Active') }}</span>
        </label>
    </div>
</div>
@push('scripts')
    @once
        <script>
            window.addEventListener('create_ckeditor', event => {
                let tags = [
                    @foreach ($this->tags as $tag)

                        {
                            label: "{{ $tag->name }}",
                            value: "{{ $tag->id }}"
                        },
                    @endforeach
                ];

                VirtualSelect.init({
                    ele: event.detail.tag_id,
                    multiple: true,
                    options: tags,
                    selectedValue: event.detail.tag_id !== '#tagscreate' ? event.detail.selected_tags : [],
                    maxWidth: '100%',
                    placeholder: 'Select the options'
                });

                let selectedTags = document.querySelector(event.detail.tag_id);

                selectedTags.addEventListener('change', () => {

                    let data = selectedTags.value;
                    @this.set('tag', data);
                });

                CKEDITOR.ClassicEditor.create(document.querySelector(event.detail.class_name), {
                        // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
                        toolbar: {
                            items: [
                                'exportPDF', 'exportWord', '|',
                                'findAndReplace', 'selectAll', '|',
                                'heading', '|',
                                'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript',
                                'superscript', 'removeFormat', '|',
                                'bulletedList', 'numberedList', 'todoList', '|',
                                'outdent', 'indent', '|',
                                'undo', 'redo',
                                '-',
                                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                                'alignment', '|',
                                'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock',
                                'htmlEmbed', '|',
                                'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                                'textPartLanguage', '|',
                                'sourceEditing'
                            ],
                            shouldNotGroupWhenFull: true
                        },
                        // Changing the language of the interface requires loading the language file using the <script> tag.
                        // language: 'es',
                        list: {
                            properties: {
                                styles: true,
                                startIndex: true,
                                reversed: true
                            }
                        },
                        // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
                        heading: {
                            options: [{
                                    model: 'paragraph',
                                    title: 'Paragraph',
                                    class: 'ck-heading_paragraph'
                                },
                                {
                                    model: 'heading1',
                                    view: 'h1',
                                    title: 'Heading 1',
                                    class: 'ck-heading_heading1'
                                },
                                {
                                    model: 'heading2',
                                    view: 'h2',
                                    title: 'Heading 2',
                                    class: 'ck-heading_heading2'
                                },
                                {
                                    model: 'heading3',
                                    view: 'h3',
                                    title: 'Heading 3',
                                    class: 'ck-heading_heading3'
                                },
                                {
                                    model: 'heading4',
                                    view: 'h4',
                                    title: 'Heading 4',
                                    class: 'ck-heading_heading4'
                                },
                                {
                                    model: 'heading5',
                                    view: 'h5',
                                    title: 'Heading 5',
                                    class: 'ck-heading_heading5'
                                },
                                {
                                    model: 'heading6',
                                    view: 'h6',
                                    title: 'Heading 6',
                                    class: 'ck-heading_heading6'
                                }
                            ]
                        },
                        // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
                        placeholder: 'Your text here',
                        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
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
                            ],
                            supportAllValues: true
                        },
                        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
                        fontSize: {
                            options: [10, 12, 14, 'default', 18, 20, 22],
                            supportAllValues: true
                        },
                        // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
                        // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
                        htmlSupport: {
                            allow: [{
                                name: /.*/,
                                attributes: true,
                                classes: true,
                                styles: true
                            }]
                        },
                        // Be careful with enabling previews
                        // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
                        htmlEmbed: {
                            showPreviews: true
                        },
                        // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
                        link: {
                            decorators: {
                                addTargetToExternalLinks: true,
                                defaultProtocol: 'https://',
                                toggleDownloadable: {
                                    mode: 'manual',
                                    label: 'Downloadable',
                                    attributes: {
                                        download: 'file'
                                    }
                                }
                            }
                        },
                        // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
                        mention: {
                            feeds: [{
                                marker: '@',
                                feed: [
                                    '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy',
                                    '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                                    '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake',
                                    '@gingerbread', '@gummi', '@ice', '@jelly-o',
                                    '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum',
                                    '@pudding', '@sesame', '@snaps', '@soufflé',
                                    '@sugar', '@sweet', '@topping', '@wafer'
                                ],
                                minimumCharacters: 1
                            }]
                        },
                        // The "super-build" contains more premium features that require additional configuration, disable them below.
                        // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
                        removePlugins: [
                            // These two are commercial, but you can try them out without registering to a trial.
                            // 'ExportPdf',
                            // 'ExportWord',
                            'CKBox',
                            'CKFinder',
                            'EasyImage',
                            // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                            // Storing images as Base64 is usually a very bad idea.
                            // Replace it on production website with other solutions:
                            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                            // 'Base64UploadAdapter',
                            'RealTimeCollaborativeComments',
                            'RealTimeCollaborativeTrackChanges',
                            'RealTimeCollaborativeRevisionHistory',
                            'PresenceList',
                            'Comments',
                            'TrackChanges',
                            'TrackChangesData',
                            'RevisionHistory',
                            'Pagination',
                            'WProofreader',
                            // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                            // from a local file system (file://) - load this site via HTTP server if you enable MathType.
                            'MathType',
                            // The following features are part of the Productivity Pack and require additional license.
                            'SlashCommand',
                            'Template',
                            'DocumentOutline',
                            'FormatPainter',
                            'TableOfContents',
                            'PasteFromOfficeEnhanced'
                        ]
                    })
                    .then(editor => {
                        editor.model.document.on('change:data', () => {
                            @this.set('post.text', editor.getData());
                        })
                    })
                    .catch(error => {
                        console.error(error);
                    });

                document.querySelector('.ck-reset').remove();
            });
        </script>
    @endonce
@endpush
